<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function profileView()
    {
        $breadcrumb = [
            ['name' => 'Profile', 'url' => route('profile.index')],
        ];
        return view('dashboard.profile.index', [
            'breadcrumb' => $breadcrumb
        ]);
    }
}
