<?php

namespace App\Services;

use App\Models\SaldoKas;

class Service
{
    public static function storeTransactionHistory($historyLog)
    {
        $now = now();
        $lastMonth = now()->subMonth()->endOfMonth()->format('Y-m-d');

        if ($now->format('Y-m-d') <= $lastMonth) {
            $saldoKas = SaldoKas::where('date', $now->format('Y-m-01'))->first();

            if (!$saldoKas) {
                SaldoKas::create([
                    'date' => $now->format('Y-m-01'),
                    'cash' => 0,
                    'hutang' => 0,
                    'keterangan' => 'Saldo Kas Bulan ' . $now->format('F Y'),
                ]);
            } else {
                SaldoKas::create([
                    'date' => $now->format('Y-m-01'),
                    'cash' => $saldoKas->cash,
                    'hutang' => $saldoKas->hutang,
                    'keterangan' => 'Saldo Kas Bulan ' . $now->format('F Y'),
                ]);
            }
            
        }
    }
}