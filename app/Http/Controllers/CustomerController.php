<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function customerView()
    {
        $breadcrumb = [
            ['name' => 'Customer', 'url' => route('customer.index')],
        ];
        return view('dashboard.customer.index', [
            'breadcrumb' => $breadcrumb
        ]);
    }
}
