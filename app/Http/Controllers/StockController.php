<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
use App\Models\Supplier;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function stockView()
    {
        $breadcrumb = [
            ['name' => 'Stock', 'url' => route('stocks.index')],
        ];
        return view('dashboard.stock.index', [
            'breadcrumb' => $breadcrumb
        ]);
    }

    public function create()
    {
        $breadcrumb = [
            ['name' => 'Stock', 'url' => route('stocks.index')],
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
        dd($request->all());
    }

    public function createTest()
    {
        $breadcrumb = [
            ['name' => 'Stock', 'url' => route('stocks.index')],
            ['name' => 'Create', 'url' => route('stock.create.test')],
        ];
        $satuan = Satuan::get();
        // $supplier = Supplier::get();
        return view('dashboard.stock.create-test', [
            'breadcrumb' => $breadcrumb,
            'satuan' => $satuan,
            // 'supplier' => $supplier
        ]);
    }

    public function createSatuan(Request $request)
    {
        try {
            $request->validate([
                'new_satuan_name' => 'required|string|max:255',
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
