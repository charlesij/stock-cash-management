<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transactionView()
    {
        return view('dashboard.transaction.transaction-view');
    }
}
