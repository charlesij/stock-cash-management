<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index ()
    {
        $breadcrumb = [
            ['name' => 'Supplier', 'url' => route('supplier.index')],
        ];

        $data = Kontak::where('jenis', 'supplier')->orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.supplier.index', [
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
        return view('dashboard.supplier.create', [
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
            
            $allReq = $request->all();
            $allReq['jenis'] = 'supplier';
            
            Kontak::create($allReq);
    
            return redirect()->route('supplier.index')->with('success', 'Supplier created successfully');
        } catch (\Exception $e) {
            return redirect()->route('supplier.index')->with('error', 'Supplier created failed: ' . $e->getMessage());
        }
    }

    public function edit(Request $request)
    {
        $breadcrumb = [
            ['name' => 'Supplier', 'url' => route('supplier.index')],
            ['name' => 'Edit', 'url' => route('supplier.edit')],
        ];
        $ids = $request->ids;
        $data = Kontak::whereIn('id', $ids)->get();

        return view('dashboard.supplier.edit', [
            'breadcrumb' => $breadcrumb,
            'data' => $data
        ]);
    }

    public function update(Request $request)
    {        
        try {
            $ids = $request->id;
            $request->validate([
                'nama.*' => 'required|string|max:255',
                'alamat.*' => 'required|string|max:255',
                'no_telp.*' => 'required|string|max:255',
            ]);

            $data = Kontak::whereIn('id', $ids)->get();
            foreach ($data as $index => $item) {
                $item->update([
                    'nama' => $request->nama[$index],
                    'alamat' => $request->alamat[$index],
                    'no_telp' => $request->no_telp[$index],
                ]);
            }

            return redirect()->route('supplier.index')->with('success', 'Supplier updated successfully');

        } catch (\Exception $e) {
            return redirect()->route('supplier.index')->with('error', 'Supplier updated failed: ' . $e->getMessage());
        }
    }

    public function redirectIndex()
    {
        return redirect()->route('supplier.index');
    }
}
