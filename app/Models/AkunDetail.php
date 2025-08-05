<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AkunDetail extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'akun_id',
        'kode_transaksi',
        'tanggal',
        'saldo',
    ];

    protected $table = 'akun_detail';
    
    public function akun()
    {
        return $this->belongsTo(Akun::class, 'akun_id', 'id');
    }
}
