<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiHutang extends Model
{
    protected $table = 'transaksi_hutang';

    protected $fillable = [
        'saldo_kas_id',
        'jenis_transaksi',
        'supplier',
        'keterangan',
        'jatuh_tempo',
        'hutang_in',
        'hutang_out',
        'total_hutang',
    ];

    public function saldoKas()
    {
        return $this->belongsTo(SaldoKas::class, 'saldo_kas_id');
    }
}
