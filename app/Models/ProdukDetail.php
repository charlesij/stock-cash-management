<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'produk_id', 
        // 'nama_satuan', 
        'satuan_id',
        'kuantitas', 
        'harga_jual'
    ];
    protected $table = 'produk_detail';
    
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }

    public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id', 'id');
    }
}

