<?php

use App\Http\Controllers\AkunController;
use App\Http\Middleware\WebGuest;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CashierAccess;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\DashboardAccess;
use App\Http\Middleware\WebAuthenticate;
use App\Http\Controllers\StockController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(WebGuest::class)->group(function () {
    Route::get('login', [AuthController::class, 'loginView'])->name('login');
    Route::post('login', [AuthController::class, 'authLogin'])->name('login');
});

Route::middleware([WebAuthenticate::class, DashboardAccess::class])->group(function () {
    Route::get('_dashboard', [DashboardController::class, 'dashboardView'])->name('dashboard.index');
    Route::get('_stocks', [StockController::class, 'stockView'])->name('stocks.index');
    Route::get('_stocks/create', [StockController::class, 'create'])->name('stock.create');
    Route::get('_stocks/edit', [StockController::class, 'redirectIndex']);
    Route::post('_stocks/edit', [StockController::class, 'edit'])->name('stock.edit');
    Route::put('_stocks/edit', [StockController::class, 'update'])->name('stock.update');
    Route::post('_stocks/delete', [StockController::class, 'delete'])->name('stock.delete');
    Route::get('_stocks/_settings', [StockController::class, 'settingsView'])->name('stocks.settings');
    Route::get('_stocks/_history', [StockController::class, 'historyView'])->name('stocks.history');

    Route::get('_transaction/', [TransactionController::class, 'transactionView'])->name('transaction.index');
    Route::get('_transaction/_cashflow', [TransactionController::class, 'cashflowView'])->name('transaction.cashflow');
    Route::get('_transaction/_debt', [TransactionController::class, 'debtView'])->name('transaction.debt');
    Route::get('_transaction/_income', [TransactionController::class, 'incomeView'])->name('transaction.income');
    Route::get('_transaction/_expenses', [TransactionController::class, 'expensesView'])->name('transaction.expenses');
    Route::get('_transaction/_history', [TransactionController::class, 'historyView'])->name('transaction.history');
    
    Route::get('_customer', [CustomerController::class, 'customerView'])->name('customer.index');

    Route::get('_reports', [ReportController::class, 'reportView'])->name('reports.index');
    Route::get('_settings', [SettingController::class, 'settingView'])->name('settings.index');
    Route::get('_profile', [ProfileController::class, 'profileView'])->name('profile.index');
    
    // master
    Route::get('supplier', [SupplierController::class, 'index'])->name('supplier.index');
    Route::get('supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
    Route::get('supplier/edit', [SupplierController::class, 'redirectIndex']);
    Route::post('supplier/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
    Route::put('supplier/edit', [SupplierController::class, 'update'])->name('supplier.update');
    Route::post('supplier/delete', [SupplierController::class, 'delete'])->name('supplier.delete');
    Route::post('supplier/create', [SupplierController::class, 'store'])->name('supplier.store');

    Route::get('customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('customer/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('customer/create', [CustomerController::class, 'store'])->name('customer.store');

    Route::get('akun', [AkunController::class, 'index'])->name('akun.index');
    Route::get('transaksiakun/{sub_akun_id}', [AkunController::class, 'transaksiakun'])->name('akun.transaksiakun');

    Route::post('_logout', [AuthController::class, 'authLogout'])->name('logout');
});

Route::middleware([WebAuthenticate::class, CashierAccess::class])->group(function () {
    Route::get('_cashier', [CashierController::class, 'cashierView'])->name('cashier.index');
});