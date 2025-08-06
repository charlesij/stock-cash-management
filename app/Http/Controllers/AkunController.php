<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\SubAkun;
use App\Models\TransAkun;
use Illuminate\Http\Request;

class AkunController extends Controller
{
    public function index() {
        $breadcrumb = [
            ['name' => 'Dashboard', 'url' => route('dashboard.index')],
        ];

        $data = SubAkun::with('akun')->orderBy('created_at', 'desc')->paginate(10);
        return view('akun.index', [
            'breadcrumb' => $breadcrumb,
            'title' => 'Akun',
            'title2' => 'Daftar Akun',
            'data' => $data
        ]);
    }
    
    public function transaksiakun($sub_akun_id) {
        $breadcrumb = [
            ['name' => 'Dashboard', 'url' => route('dashboard.index')],
        ];

        $data = TransAkun::where('sub_akun_id', $sub_akun_id)->paginate(10);
    
        return view('akun.transaksiakun', [
            'breadcrumb' => $breadcrumb,
            'title' => 'Detail Transaksi Akun',
            'data' => $data
        ]);
    }
    
    public function create() {
        $breadcrumb = [
            ['name' => 'Dashboard', 'url' => route('dashboard.index')],
        ];
        return view('akun.create', [
            'breadcrumb' => $breadcrumb
        ]);
    }
}
