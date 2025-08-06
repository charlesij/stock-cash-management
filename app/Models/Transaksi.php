<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{   
    use HasFactory;

    protected $fillable = ['kontak_id', 'kode', 'tanggal', 'tipe', 'jenis_bayar', 'status'];
    protected $table = 'transaksi';
    
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
}
