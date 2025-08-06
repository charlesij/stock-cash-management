<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index ()
    {
        $breadcrumb = [
            ['name' => 'Customer', 'url' => route('customer.index')],
        ];

        $data = Kontak::where('jenis', 'customer')->orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard.customer.index', [
            'breadcrumb' => $breadcrumb,
            'title' => 'List Customer',
            'data' => $data
        ]);
    }

    public function create ()
    {
        $breadcrumb = [
            ['name' => 'Customer', 'url' => route('customer.index')],
            ['name' => 'Create', 'url' => route('customer.create')],
        ];
        return view('dashboard.customer.create', [
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
            $allReq['jenis'] = 'customer';
            
            Kontak::create($allReq);
    
            return redirect()->route('customer.index')->with('success', 'Customer created successfully');
        } catch (\Exception $e) {
            return redirect()->route('customer.index')->with('error', 'Customer created failed: ' . $e->getMessage());
        }
    }

    public function edit(Request $request)
    {
        $breadcrumb = [
            ['name' => 'Customer', 'url' => route('customer.index')],
            ['name' => 'Edit', 'url' => route('customer.edit')],
        ];
        $ids = $request->ids;
        $data = Kontak::whereIn('id', $ids)->get();

        return view('dashboard.customer.edit', [
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

            return redirect()->route('customer.index')->with('success', 'Customer updated successfully');

        } catch (\Exception $e) {
            return redirect()->route('customer.index')->with('error', 'Customer updated failed: ' . $e->getMessage());
        }
    }

    public function redirectIndex()
    {
        return redirect()->route('customer.index');
    }
}
