<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function cashierView()
    {
        $produk = Produk::with('produkDetail')->get();
        // dd($produk);
        return view('cashier.index', compact('produk'));
    }
}
