<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index ()
    {
        $breadcrumb = [
            ['name' => 'Supplier', 'url' => route('supplier.index')],
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
            ['name' => 'Supplier', 'url' => route('supplier.index')],
            ['name' => 'Create', 'url' => route('supplier.create')],
        ];
        return view('supplier.create', [
            'breadcrumb' => $breadcrumb
        ]);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'no_telp' => 'required|string|max:255',
            ]);
    
            Supplier::create($request->all());
    
            return redirect()->route('supplier.index')->with('success', 'Supplier created successfully');
        } catch (\Exception $e) {
            return redirect()->route('supplier.index')->with('error', 'Supplier created failed: ' . $e->getMessage());
        }

    }
}
