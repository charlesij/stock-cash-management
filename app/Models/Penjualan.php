<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{   
    use HasFactory;

    protected $fillable = ['customer_id', 'kode', 'tanggal', 'jenis_pembayaran', 'status'];
    protected $table = 'penjualan';
    
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
