<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaldoKas extends Model
{
    protected $fillable = [
        'cash',
        'hutang',
        'date',
        'keterangan',
        'updated_at',
    ];

    protected $table = 'saldo_kas';
}
