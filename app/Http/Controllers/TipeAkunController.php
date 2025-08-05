<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TipeAkunController extends Controller
{
    public function index() {
        $breadcrumb = [
            ['name' => 'Dashboard', 'url' => route('dashboard.index')],
        ];
        return view('supplier.index', [
            'breadcrumb' => $breadcrumb
        ]);
    }

    public function create() {
        $breadcrumb = [
            ['name' => 'Dashboard', 'url' => route('dashboard.index')],
        ];
        return view('supplier.create', [
            'breadcrumb' => $breadcrumb
        ]);
    }
}
