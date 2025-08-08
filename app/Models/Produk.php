<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 
        'harga_beli',
        'metode_pembayaran',
        'data_supplier',
        'tanggal_barang_masuk',
        'tanggal_jatuh_tempo',
        'keterangan',
    ];

    protected $table = 'produk';
    
    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id', 'id');
    }
}
