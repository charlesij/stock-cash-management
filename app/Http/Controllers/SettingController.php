<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function settingView()
    {
        $breadcrumb = [
            ['name' => 'Setting', 'url' => route('settings.index')],
        ];
        return view('dashboard.settings.index', [
            'breadcrumb' => $breadcrumb
        ]);
    }
}
