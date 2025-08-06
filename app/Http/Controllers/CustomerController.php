<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index ()
    {
        $breadcrumb = [
            ['name' => 'Dashboard', 'url' => route('dashboard.index')],
        ];

        $data = Customer::orderBy('created_at', 'desc')->paginate(10);

        return view('supplier.index', [
            'breadcrumb' => $breadcrumb,
            'title' => 'List Customer',
            'data' => $data
        ]);
    }

    public function create ()
    {
        $breadcrumb = [
            ['name' => 'Dashboard', 'url' => route('dashboard.index')],
        ];
        return view('supplier.create', [
            'breadcrumb' => $breadcrumb
        ]);
    }
}
