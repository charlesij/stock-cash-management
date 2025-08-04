<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [AuthController::class, 'loginView'])->name('login');
Route::post('login', [AuthController::class, 'authLogin'])->name('login');


Route::get('dashboard', [DashboardController::class, 'dashboardView'])->name('dashboard');
Route::get('stocks', [StockController::class, 'stockView'])->name('stocks');
Route::get('transactions', [TransactionController::class, 'transactionView'])->name('transactions');
Route::get('reports', [ReportController::class, 'reportView'])->name('reports');
Route::get('settings', [SettingController::class, 'settingView'])->name('settings');

Route::post('logout', [AuthController::class, 'authLogout'])->name('logout');