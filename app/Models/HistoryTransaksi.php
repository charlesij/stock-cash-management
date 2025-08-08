<?php

namespace App\Models;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class HistoryTransaksi extends Model
{
    protected $fillable = [
        'saldo_kas_id',
        'jenis_transaksi',
        'keterangan',
        'cash_in',
        'cash_out',
        'saldo_kas',
        'hutang_in',
        'hutang_out',
        'total_hutang',
    ];

    protected $table = 'history_transaksi';

    public static function storeTransactionHistory(array $data):void
    {
        try {
            Validator::make($data, [
                'jenis_transaksi' => 'required|string',
                'keterangan' => 'required|string',
                'cash_in' => 'required|numeric',
                'cash_out' => 'required|numeric',
                'hutang_in' => 'required|numeric',
                'hutang_out' => 'required|numeric',
            ]);

            $monthYear = date('Y-m-01');

            $saldoKas = SaldoKas::where('date', $monthYear)->first();

            $storeData = [
                'saldo_kas_id' => $saldoKas->id,
                'jenis_transaksi' => $data['jenis_transaksi'],
                'keterangan' => $data['keterangan'],
                'cash_in' => $data['cash_in'],
                'cash_out' => $data['cash_out'],
                'saldo_kas' => $saldoKas->cash,
                'hutang_in' => $data['hutang_in'],
                'hutang_out' => $data['hutang_out'],
                'total_hutang' => $saldoKas->hutang,
            ];

            self::create($storeData);

            Log::info('Transaction history stored successfully');
        } catch (\Exception $e) {
            Log::error('Error storing transaction history: ' . $e->getMessage());
        }
    }

    public function saldoKas()
    {
        return $this->belongsTo(SaldoKas::class, 'saldo_kas_id');
    }
}
