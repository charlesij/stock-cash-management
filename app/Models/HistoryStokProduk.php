<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryStokProduk extends Model
{
    protected $table = 'history_stok_produk';
    protected $fillable = [
        'produk_id',
        'tanggal',
        'jumlah',
        'keterangan',
        'jenis_transaksi',
    ];
}
