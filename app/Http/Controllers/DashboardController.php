<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\SaldoKas;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardView()
    {
        // Get current date for last update
        $currentDate = Carbon::now();

        $breadcrumb = [
            ['name' => 'Dashboard', 'url' => route('dashboard.index')],
        ];

        // $lastMonth = $currentDate->subMonth()->format('Y-m-01');
        $currentMonth = $currentDate->format('Y-m-01');
        // $saldoKasLastMonth = SaldoKas::where('date', $lastMonth)->first();
        $saldoKas = SaldoKas::where('date', $currentMonth)->first();

        if (!$saldoKas) {
            $currentCash = 0;
            $cashTrend = 'no data';
            $lastCashUpdate = 'no data';
        } else {
            $currentCash = floatval($saldoKas->cash);
            $cashTrend = 0;
            // $cashTrend = (($currentCash - $saldoKasLastMonth->cash) / $saldoKasLastMonth->cash) * 100;
            $lastCashUpdate = Carbon::parse($saldoKas->updated_at)->format('d M Y H:i');
        }

        $data = [
            'title' => 'Dashboard',
            
            'currentCash' => $currentCash,
            'lastCashUpdate' => $lastCashUpdate,
            'cashTrend' => $cashTrend,

            'outstandingDebt' => 50000000,
            'debtDueSoon' => 20000000,
            'debtTrend' => -5,
            
            'totalStockItems' => 156, // Total items in inventory
            'lowStockItems' => 8, // Items with low stock
            
            // Transaction Statistics
            'todayTransactions' => 24, // Transactions today
            'pendingTransactions' => 5, // Pending transactions
            
            'breadcrumb' => $breadcrumb,
        ];

        return view('dashboard.index', $data);
    }

    /**
     * Get actual current cash balance
     * This is a placeholder method - implement actual logic
     */
    private function getCurrentCashBalance()
    {
        // TODO: Implement actual cash balance calculation
        // Example: return Transaction::where('type', 'cash')->sum('amount');
        return 150000000;
    }

    /**
     * Get actual outstanding debt
     * This is a placeholder method - implement actual logic
     */
    private function getOutstandingDebt()
    {
        // TODO: Implement actual debt calculation
        // Example: return Debt::where('status', 'unpaid')->sum('amount');
        return 50000000;
    }

    /**
     * Calculate cash trend compared to last month
     * This is a placeholder method - implement actual logic
     */
    private function calculateCashTrend()
    {
        // TODO: Implement actual trend calculation
        // Example:
        // $lastMonth = Transaction::whereMonth('created_at', '=', Carbon::now()->subMonth())
        //     ->where('type', 'cash')
        //     ->sum('amount');
        // $thisMonth = Transaction::whereMonth('created_at', '=', Carbon::now())
        //     ->where('type', 'cash')
        //     ->sum('amount');
        // return (($thisMonth - $lastMonth) / $lastMonth) * 100;
        return 15;
    }

    /**
     * Get stock statistics
     * This is a placeholder method - implement actual logic
     */
    private function getStockStatistics()
    {
        // TODO: Implement actual stock statistics
        // Example:
        // $total = Stock::count();
        // $lowStock = Stock::where('quantity', '<=', 'min_quantity')->count();
        return [
            'total' => 156,
            'lowStock' => 8
        ];
    }

    /**
     * Get transaction statistics
     * This is a placeholder method - implement actual logic
     */
    private function getTransactionStatistics()
    {
        // TODO: Implement actual transaction statistics
        // Example:
        // $today = Transaction::whereDate('created_at', Carbon::today())->count();
        // $pending = Transaction::where('status', 'pending')->count();
        return [
            'today' => 24,
            'pending' => 5
        ];
    }
}
