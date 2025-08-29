<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function cashierView()
    {
        $produk = Produk::with('produkDetail')
        ->where(function ($query) {
            $query->whereHas('produkDetail', function ($q) {
                $q->where('harga_jual', '>', 0)
                ->where('kuantitas', '>', 0);
            })
            ->orWhere(function ($q) {
                $q->has('produkDetail', '>', 1);
            });
        })
        ->get();
        return view('cashier.index', [
            'produk' => $produk
        ]);
    }
}
