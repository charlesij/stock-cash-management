<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanDetail extends Model
{   

    use HasFactory;

    protected $fillable = ['penjualan_id', 'deskripsi', 'kuantitas', 'satuan_id', 'harga_satuan', 'diskon', 'pajak'];
    protected $table = 'penjualan_detial';
    
    public function penjualan()
    {
        return $this->belongsTo(Penjualan::class, 'penjualan_id', 'id');
    }
}
