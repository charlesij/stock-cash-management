<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Satuan;
use App\Models\Supplier;
use App\Models\ProdukDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function stockView()
    {
        $breadcrumb = [
            ['name' => 'Stock', 'url' => route('stock.index')],
        ];
        return view('dashboard.stock.index', [
            'breadcrumb' => $breadcrumb
        ]);
    }

    public function create()
    {
        $breadcrumb = [
            ['name' => 'Stock', 'url' => route('stock.index')],
            ['name' => 'Create', 'url' => route('stock.create')],
        ];
        $satuan = Satuan::get();
        $supplier = Supplier::get();
        return view('dashboard.stock.create', [
            'breadcrumb' => $breadcrumb,
            'satuan' => $satuan,
            'supplier' => $supplier,
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
        return view('dashboard.stock.history', [
            'breadcrumb' => $breadcrumb
        ]);
    }
}
