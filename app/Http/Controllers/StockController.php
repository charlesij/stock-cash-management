<?php

namespace App\Http\Controllers;

use App\Models\Satuan;
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
        return view('dashboard.stock.create', [
            'breadcrumb' => $breadcrumb,
            'satuan' => $satuan
        ]);
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
