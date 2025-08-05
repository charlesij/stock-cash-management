<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('dashboard.transaction.cashflow', [
            'breadcrumb' => $breadcrumb
        ]);
    }
    public function debtView()
    {
        $breadcrumb = [
            ['name' => 'Transaction', 'url' => route('transaction.debt')],
        ];
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
}
