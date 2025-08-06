<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransAkun extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_akun_id',
        'transakasi_id',
        'keterangan',
        'tanggal',
        'debit',
        'kredit',
        'total',
    ];

    protected $table = 'trans_akun';
    
    public function subakun()
    {
        return $this->belongsTo(SubAkun::class, 'sub_akun_id', 'id');
    }
}
