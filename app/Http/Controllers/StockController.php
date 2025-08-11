<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Satuan;
use App\Models\SaldoKas;
use App\Models\Supplier;
use App\Models\ProdukDetail;
use App\Models\TransaksiKas;
use Illuminate\Http\Request;
use App\Models\TransaksiHutang;
use App\Models\HistoryTransaksi;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function stockView(Request $request)
    {
        $breadcrumb = [
            ['name' => 'Stock', 'url' => route('stock.index')],
        ];
        
        $stock = Produk::with('produkDetail')->orderByDesc('updated_at')->paginate(20);

        $productDetailExist = false;
        if ($request->get('detail_produk_id')) {
            $produkDetailView = Produk::with('produkDetail')->where('id', $request->get('detail_produk_id'))->first();
            $productDetailExist = true;
        }

        return view('dashboard.stock.index', [
            'breadcrumb' => $breadcrumb,
            'stock' => $stock,
            'productDetailExist' => $productDetailExist,
            'produkDetailView' => $produkDetailView ?? null,
        ]);
    }

    public function create()
    {
        $breadcrumb = [
            ['name' => 'Stock', 'url' => route('stock.index')],
            ['name' => 'Create', 'url' => route('stock.create')],
        ];

        $satuan = Satuan::orderBy('nama')->get();
        $supplier = Supplier::orderBy('nama')->get();
        $saldoKas = SaldoKas::where('date', now()->format('Y-m-01'))->first();
        
        return view('dashboard.stock.create', [
            'breadcrumb' => $breadcrumb,
            'satuan' => $satuan,
            'supplier' => $supplier,
            'saldoKas' => $saldoKas,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'item_name' => 'required|string',
                'item_harga_beli' => 'required|numeric',
                'item_tanggal_masuk' => 'required|date',
                'item_supplier' => 'required|string',
                'item_metode_pembayaran' => 'required|string',
                'item_kuantitas' => 'required|array',
                'item_kuantitas.*' => 'required|numeric',
                'item_unit_satuan' => 'required|array',
                'item_unit_satuan.*' => 'required|string',
                'item_harga_jual' => 'required|array',
                'item_harga_jual.*' => 'required|numeric',
                'item_keterangan' => 'nullable|string',
                'item_jatuh_tempo' => 'nullable',
            ]);
            DB::beginTransaction();

            $produk = Produk::create([
                'nama' => $validatedData['item_name'],
                'harga_beli' => $validatedData['item_harga_beli'],
                'metode_pembayaran' => $validatedData['item_metode_pembayaran'],
                'data_supplier' => $validatedData['item_supplier'],
                'tanggal_barang_masuk' => $validatedData['item_tanggal_masuk'],
                'tanggal_jatuh_tempo' => $validatedData['item_jatuh_tempo'],
                'keterangan' => $validatedData['item_keterangan'],
            ]);

            $saldoKas = SaldoKas::where('date', now()->format('Y-m-01'))->first();

            if ($validatedData['item_metode_pembayaran'] == 'cash') {
                $saldoKas->cash = $saldoKas->cash - $validatedData['item_harga_beli'];
                $saldoKas->save();

                $newTransaksiKas = [
                    'saldo_kas_id' => $saldoKas->id,
                    'jenis_transaksi' => 'pengeluaran',
                    'keterangan' => $validatedData['item_keterangan'],
                    'cash_in' => 0,
                    'cash_out' => $validatedData['item_harga_beli'],
                    'current_saldo' => $saldoKas->cash,
                ];

                $historyLog = [
                    'jenis_transaksi' => 'pengeluaran',
                    'keterangan' => $validatedData['item_keterangan'],
                    'cash_in' => 0,
                    'cash_out' => $validatedData['item_harga_beli'],
                    'hutang_in' => 0,
                    'hutang_out' => 0,
                ];

                TransaksiKas::create($newTransaksiKas);
                HistoryTransaksi::storeTransactionHistory($historyLog);
            } else {
                $saldoKas->hutang = $saldoKas->hutang + $validatedData['item_harga_beli'];
                $saldoKas->save();

                $newTransaksiHutang = [
                    'saldo_kas_id' => $saldoKas->id,
                    'jenis_transaksi' => 'transaksi hutang',
                    'supplier' => $validatedData['item_supplier'],
                    'keterangan' => $validatedData['item_keterangan'],
                    'jatuh_tempo' => $validatedData['item_jatuh_tempo'],
                    'hutang_in' => $validatedData['item_harga_beli'],
                    'hutang_out' => 0,
                    'total_hutang' => $saldoKas->hutang,
                ];

                $historyLog = [
                    'jenis_transaksi' => 'transaksi hutang',
                    'keterangan' => $validatedData['item_keterangan'],
                    'cash_in' => 0,
                    'cash_out' => 0,
                    'hutang_in' => $validatedData['item_harga_beli'],
                    'hutang_out' => 0,
                ];

                Supplier::where('nama', $validatedData['item_supplier'])->update([
                    'hutang' => $saldoKas->hutang,
                ]);

                TransaksiHutang::create($newTransaksiHutang);
                HistoryTransaksi::storeTransactionHistory($historyLog);
            }

            for ($i = 0; $i < count($validatedData['item_unit_satuan']); $i++) {
                $log[] = [
                    'produk_id' => $produk->id,
                    'nama_satuan' => $validatedData['item_unit_satuan'][$i],
                    'kuantitas' => $validatedData['item_kuantitas'][$i],
                    'harga_jual' => $validatedData['item_harga_jual'][$i],
                ];
                ProdukDetail::create([
                    'produk_id' => $produk->id,
                    'nama_satuan' => $validatedData['item_unit_satuan'][$i],
                    'kuantitas' => $validatedData['item_kuantitas'][$i],
                    'harga_jual' => $validatedData['item_harga_jual'][$i],
                ]);
            }

            DB::commit();
            return redirect()->route('stock.index')->with('success', 'Stock created successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('stock.create')->with('error', 'Stock created failed: ' . $e->getMessage());
        }
    }

    public function createSatuan(Request $request)
    {
        try {
            $request->validate([
                'new_satuan_name' => 'required|string|max:255|unique:satuan,nama',
            ]);

            Satuan::create([
                'nama' => $request->new_satuan_name,
            ]);
            return redirect()->route('stock.create')->with('success', 'Satuan created successfully');
        } catch (\Exception $e) {
            return redirect()->route('stock.create')->with('error', 'Satuan created failed: ' . $e->getMessage());
        }
    }

    public function inventoryView()
    {
        $breadcrumb = [
            ['name' => 'Inventory', 'url' => route('stocks.inventory')],
        ];
        return view('dashboard.stock.inventory', [
            'breadcrumb' => $breadcrumb
        ]);
    }

    public function settingsView()
    {
        $breadcrumb = [
            ['name' => 'Settings', 'url' => route('stocks.settings')],
        ];
        return view('dashboard.stock.settings', [
            'breadcrumb' => $breadcrumb
        ]);
    }

    public function historyView()
    {
        $breadcrumb = [
            ['name' => 'History', 'url' => route('stocks.history')],
        ];

        $stockHistory = Produk::where('jenis_transaksi', 'penjualan')->paginate(20);

        return view('dashboard.stock.history', [
            'breadcrumb' => $breadcrumb,
            'stockHistory' => $stockHistory,
        ]);
    }
}
