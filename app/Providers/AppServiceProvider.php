<?php

namespace App\Providers;

use App\Models\SaldoKas;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // $now = now();
        // $lastMonth = now()->subMonth()->endOfMonth()->format('Y-m-d');
        // // $lastYear = now()->subYear()->endOfYear()->format('Y-m-d');

        // if ($now->format('Y-m-d') <= $lastMonth) {
        //     $saldoKas = SaldoKas::where('date', $now->format('Y-m-01'))->first();

        //     if (!$saldoKas) {
        //         SaldoKas::create([
        //             'date' => $now->format('Y-m-01'),
        //             'cash' => 0,
        //             'hutang' => 0,
        //             'keterangan' => 'Saldo Kas Bulan ' . $now->format('F Y'),
        //         ]);
        //     } else {
        //         SaldoKas::create([
        //             'date' => $now->format('Y-m-01'),
        //             'cash' => $saldoKas->cash,
        //             'hutang' => $saldoKas->hutang,
        //             'keterangan' => 'Saldo Kas Bulan ' . $now->format('F Y'),
        //         ]);
        //     }
            
        // }
        // test dulu
    }
}
