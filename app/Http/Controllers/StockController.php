<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StockController extends Controller
{
    public function stockView()
    {
        $breadcrumb = [
            ['name' => 'Stock', 'url' => route('stocks')],
        ];
        return view('dashboard.stock.index', [
            'breadcrumb' => $breadcrumb
        ]);
    }
}
