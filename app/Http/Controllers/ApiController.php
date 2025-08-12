<?php

namespace App\Http\Controllers;

use App\Models\ProdukDetail;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function getDetailProduct(Request $request, $id)
    {
        $detailProduct = ProdukDetail::where('produk_id', $id)->get();

        return response()->json([
            'status' => 'success',
            'detail_product' => $detailProduct,
        ]);
    }
}
