<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function cashierView()
    {
        return view('cashier.index');
    }
}
