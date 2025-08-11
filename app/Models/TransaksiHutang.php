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

    public static function debtDueSoon()
    {
        $currentDate = now();
        $startDate = $currentDate->format('Y-m-01');
        $thirtyDaysLater = $currentDate->addDays(30)->format('Y-m-d');
        $result = self::whereBetween('jatuh_tempo', [$startDate, $thirtyDaysLater])
            ->selectRaw('MIN(jatuh_tempo) as earliest_due_date, SUM(hutang_in) - SUM(hutang_out) as earliest_due_debt')
            ->first();

        return [
            'earliest_due_date' => $result->earliest_due_date,
            'earliest_due_debt' => $result->earliest_due_debt ?? 0,
        ];
    }
}
