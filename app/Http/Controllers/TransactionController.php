<?php

namespace App\Http\Controllers;

use App\Models\SaldoKas;
use App\Models\TransaksiKas;
use Illuminate\Http\Request;
use App\Models\HistoryTransaksi;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    public function transactionView()
    {
        $breadcrumb = [
            ['name' => 'Transaction', 'url' => route('transaction.index')],
        ];
        return view('dashboard.transaction.index', [
            'breadcrumb' => $breadcrumb
        ]);
    }
    public function cashflowView()
    {
        $breadcrumb = [
            ['name' => 'Transaction', 'url' => route('transaction.cashflow')],
        ];

        $saldoKas = TransaksiKas::orderByDesc('updated_at')->paginate(20);

        return view('dashboard.transaction.cashflow', [
            'breadcrumb' => $breadcrumb,
            'saldoKas' => $saldoKas,
        ]);
    }
    public function cashflowCreate()
    {
        $breadcrumb = [
            ['name' => 'Transaction', 'url' => route('transaction.cashflow')],
            ['name' => 'Kelola Kas', 'url' => route('transaction.cashflow.create')],
        ];

        return view('dashboard.transaction.cashflow.create', [
            'breadcrumb' => $breadcrumb
        ]);
    }
    public function cashflowStore(Request $request)
    {
        try {
            $request->validate([
                'modal' => 'required|string',
                'keterangan' => 'required|string',
            ]);

            $kasSaldo = SaldoKas::where('date', date('Y-m-01'))->first();
            
            if (!$kasSaldo) {
                $kasSaldo = SaldoKas::create([
                    'date' => date('Y-m-01'),
                    'cash' => (float) str_replace('.', '', $request->modal),
                    'hutang' => 0,
                    'keterangan' => $request->keterangan,
                ]);
            } else {
                $kasSaldo->update([
                    'cash' => $kasSaldo->cash + (float) str_replace('.', '', $request->modal),
                    'keterangan' => $request->keterangan,
                ]);
            }

            $newTransaksiKas = [
                'saldo_kas_id' => $kasSaldo->id,
                'jenis_transaksi' => 'modal masuk',
                'keterangan' => $request->keterangan,
                'cash_in' => (float) str_replace('.', '', $request->modal),
                'cash_out' => 0,
                'current_saldo' => $kasSaldo->cash,
            ];
            
            $historyFormat = [
                'jenis_transaksi' => 'modal masuk',
                'keterangan' => $request->keterangan,
                'cash_in' => (float) str_replace('.', '', $request->modal),
                'cash_out' => 0,
                'hutang_in' => 0,
                'hutang_out' => 0,
            ];
            
            TransaksiKas::create($newTransaksiKas);
            HistoryTransaksi::storeTransactionHistory($historyFormat);
            return redirect()->route('transaction.cashflow')->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            Log::error('Error storing transaction history: ' . $e->getMessage());
            return redirect()->route('transaction.cashflow.create')->with('error', 'Gagal menambahkan data: ' . $e->getMessage());
        }
    }
    public function debtView()
    {
        $breadcrumb = [
            ['name' => 'Transaction', 'url' => route('transaction.debt')],
        ];

        $monthYear = date('Y-m-01');

        return view('dashboard.transaction.debt', [
            'breadcrumb' => $breadcrumb
        ]);
    }
    public function incomeView()
    {
        $breadcrumb = [
            ['name' => 'Transaction', 'url' => route('transaction.income')],
        ];
        return view('dashboard.transaction.income', [
            'breadcrumb' => $breadcrumb
        ]);
    }
    public function expensesView()
    {
        $breadcrumb = [
            ['name' => 'Transaction', 'url' => route('transaction.expenses')],
        ];
        return view('dashboard.transaction.expenses', [
            'breadcrumb' => $breadcrumb
        ]);
    }
    public function historyView()
    {
        $breadcrumb = [
            ['name' => 'Transaction', 'url' => route('transaction.history')],
        ];

        $history = HistoryTransaksi::orderByDesc('created_at')->paginate(20);

        return view('dashboard.transaction.history', [
            'breadcrumb' => $breadcrumb,
            'transactionHistory' => $history,
        ]);
    }
}
