<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reportView()
    {
        $breadcrumb = [
            ['name' => 'Report', 'url' => route('reports.index')],
        ];
        return view('dashboard.report.index', [
            'breadcrumb' => $breadcrumb
        ]);
    }
}
