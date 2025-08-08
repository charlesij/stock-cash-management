<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiKas extends Model
{
    protected $fillable = [
        'saldo_kas_id',
        'jenis_transaksi',
        'keterangan',
        'cash_in',
        'cash_out',
        'current_saldo',
    ];

    protected $table = 'transaksi_kas';
}
