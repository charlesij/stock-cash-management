<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index ()
    {
        $breadcrumb = [
            ['name' => 'Dashboard', 'url' => route('dashboard.index')],
        ];

        $data = Supplier::orderBy('created_at', 'desc')->paginate(10);

        return view('supplier.index', [
            'breadcrumb' => $breadcrumb,
            'title' => 'List Supplier',
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
