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
use App\Models\ProdukMaster;
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

        $produkMaster = ProdukMaster::orderBy('nama')->get();
        $satuan = Satuan::orderBy('nama')->get();
        $supplier = Supplier::orderBy('nama')->get();
        $saldoKas = SaldoKas::where('date', now()->format('Y-m-01'))->first();
        
        return view('dashboard.stock.create', [
            'breadcrumb' => $breadcrumb,
            'satuan' => $satuan,
            'supplier' => $supplier,
            'saldoKas' => $saldoKas,
            'produkMaster' => $produkMaster
        ]);
    }

    public function store(Request $request)
    {
        dd($request->all());
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
                // 'item_harga_jual' => 'required|array',
                // 'item_harga_jual.*' => 'required|numeric',
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
                    'harga_jual' => 0,
                ];
                ProdukDetail::create([
                    'produk_id' => $produk->id,
                    'nama_satuan' => $validatedData['item_unit_satuan'][$i],
                    'kuantitas' => $validatedData['item_kuantitas'][$i],
                    'harga_jual' => 0,
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

    public function createProdukMaster(Request $request)
    {
        try {
            $request->merge([
                'produk_master_harga_beli' => str_replace('.', '', $request->produk_master_harga_beli)
            ]);

            $request->validate([
                'produk_master_satuan_id' => 'required|numeric',
                'produk_master_nama' => 'required|string|max:255',
                'produk_master_harga_beli' => 'required|numeric|min:0',
            ]);

            ProdukMaster::create([
                'satuan_id' => $request->produk_master_satuan_id,
                'nama' => $request->produk_master_nama,
                'harga_beli' => $request->produk_master_harga_beli
            ]);

            return redirect()->route('stock.create')->with('success', 'Master Produk created successfully');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->route('stock.create')->with('error', 'Master Produk created failed: ' . $e->getMessage());
        }
    }

    public function inventoryView()
    {
        $breadcrumb = [
            ['name' => 'Stock', 'url' => route('stock.index')],
            ['name' => 'Inventory', 'url' => route('stocks.inventory')],
        ];
        return view('dashboard.stock.inventory', [
            'breadcrumb' => $breadcrumb
        ]);
    }

    public function productDetail($productDetailData = null)
    {
        $explodeData = explode('-', $productDetailData);
        if ($productDetailData) {
            $breadcrumb = [
                ['name' => 'Stock', 'url' => route('stock.index')],
                ['name' => 'Produk', 'url' => route('stock.product.details')],
                ['name' => 'Produk Detail', 'url' => route('stock.product.details', ['id' => number_format($explodeData[1])])],
            ];
        } else {
            $breadcrumb = [
                ['name' => 'Stock', 'url' => route('stock.index')],
                ['name' => 'Produk', 'url' => route('stock.product.details')],
            ];
        }

        if ($productDetailData) {
            $withSatuan = true;
            $productId = number_format($explodeData[1]);
            $productDetailId = null;

            if (count($explodeData) > 2 && count($explodeData) === 4) {
                $productDetailId = explode('-', $productDetailData)[3];
            }

            $produk = Produk::with('produkDetail')->where('id', $productId)->orderByDesc('updated_at')->first();
        } else {
            $withSatuan = false;
            $produk = Produk::with('produkDetail')->orderByDesc('updated_at')->paginate(20);
        }

        return view('dashboard.stock.details', [
            'breadcrumb' => $breadcrumb,
            'produk' => $produk,
            'withSatuan' => $withSatuan,
        ]);
    }

    public function settingsView()
    {
        $breadcrumb = [
            ['name' => 'Stock', 'url' => route('stock.index')],
            ['name' => 'Settings', 'url' => route('stocks.settings')],
        ];
        return view('dashboard.stock.settings', [
            'breadcrumb' => $breadcrumb
        ]);
    }

    public function historyView()
    {
        $breadcrumb = [
            ['name' => 'Stock', 'url' => route('stock.index')],
            ['name' => 'History', 'url' => route('stocks.history')],
        ];

        $stockHistory = Produk::paginate(20);

        return view('dashboard.stock.history', [
            'breadcrumb' => $breadcrumb,
            'stockHistory' => $stockHistory,
        ]);
    }

    public function getdataProduck($id)
    {
        try {
            $masterProduk = ProdukMaster::with('satuan')->find($id);
            
            if (!$masterProduk) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }
            
            return response()->json([
                'success' => true,
                'data' => $masterProduk
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan server'
            ], 500);
        }
    }

    public function ajaxRow($index)
    {
        $satuan = Satuan::all(); // ambil semua satuan
        return view('dashboard.partials._harga_jual_row', compact('index', 'satuan'));
    }
}
