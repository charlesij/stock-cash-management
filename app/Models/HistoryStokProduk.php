<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryStokProduk extends Model
{
    protected $table = 'history_stok_produk';
    protected $fillable = [
        'produk_id',
        'produk_detail_id',
        'qty_in',
        'qty_out',
        'unit',
        'harga_unit',
        'sisa_stok',
        'total_harga',
        'keterangan',
        'jenis_transaksi',
    ];
}
