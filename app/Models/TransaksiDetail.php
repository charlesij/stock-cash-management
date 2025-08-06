<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{   
    use HasFactory;
    
    protected $fillable = ['transaksi_id', 'keterangan', 'kuantitas', 'satuan_id', 'harga_satuan', 'diskon'];
    protected $table = 'pembelian_detail';
    
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'id');
    }

     public function satuan()
    {
        return $this->belongsTo(Satuan::class, 'satuan_id', 'id');
    }
}
