<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianDetail extends Model
{   
    use HasFactory;
    
    protected $fillable = ['pembelian_id', 'deskripsi', 'kuantitas', 'satuan_id', 'harga_satuan', 'diskon', 'pajak'];
    protected $table = 'pembelian_detail';
    
    public function pembelian()
    {
        return $this->belongsTo(Pembelian::class, 'pembelian_id', 'id');
    }

     public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id', 'id');
    }
}
