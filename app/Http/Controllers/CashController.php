<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashController extends Controller
{
    public function cashView()
    {
        return view('dashboard.cash.cash-view');
    }
}
