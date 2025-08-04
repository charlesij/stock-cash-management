<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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
        
        // Example data - replace these with actual database queries later
        $data = [
            'title' => 'Dashboard',
            
            // Current Cash Data
            'currentCash' => 150000000, // Rp 150,000,000
            'lastCashUpdate' => $currentDate->format('d M Y H:i'),
            'cashTrend' => 15, // 15% increase from last month
            
            // Outstanding Debt Data
            'outstandingDebt' => 50000000, // Rp 50,000,000
            'debtDueSoon' => 20000000, // Rp 20,000,000 due in 30 days
            'debtTrend' => -5, // 5% decrease from last month (positive trend)
            
            // Stock Statistics
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
