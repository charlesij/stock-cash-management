@extends('dashboard.layout.main')

@section('content')
<div class="mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
        <p class="text-sm text-gray-600">Selamat datang kembali, {{ auth()->user()->name }}!</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 mb-6">
        <div title="Go to cash details" class="bg-white rounded-xl shadow-sm border-l-4 border-green-500 overflow-hidden transform transition-transform duration-300 hover:-translate-y-1">
            <a href="{{ route('transaction.cashflow') }}" class="cursor-pointer ">
                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Saldo Kas saat ini</p>
                            <p class="text-2xl font-bold text-green-600 mt-1">Rp {{ number_format($currentCash, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-500 mt-1">Terakhir diupdate: {{ $lastCashUpdate }}</p>
                        </div>
                        <div class="bg-green-50 rounded-full p-3">
                            <i class="fas fa-money-bill-wave text-xl text-green-500"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        @if(is_numeric($cashTrend))
                            <span class="{{ $cashTrend >= 0 ? 'text-green-500' : 'text-red-500' }} font-medium">
                                <i class="fas fa-{{ $cashTrend >= 0 ? 'arrow-up' : 'arrow-down' }} mr-1"></i>
                                {{ abs($cashTrend) }}%
                            </span>
                            <span class="text-gray-500 ml-2">vs bulan lalu</span>
                        @elseif($cashTrend === 'no data')
                            <span class="text-gray-500 ml-2">Tidak ada data trend</span>
                        @endif
                    </div>
                </div>
            </a>
        </div>

        <div title="Go to debt details" class="bg-white rounded-xl shadow-sm border-l-4 border-red-500 overflow-hidden transform transition-transform duration-300 hover:-translate-y-1">
            <a href="{{ route('transaction.debt') }}">
                <div class="p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Hutang saat ini</p>
                            <p class="text-2xl font-bold text-red-600 mt-1">Rp {{ number_format($outstandingDebt, 0, ',', '.') }}</p>
                            <p class="text-xs text-gray-500 mt-1">Jatuh tempo dalam 30 hari: Rp {{ number_format($debtDueSoon, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-red-50 rounded-full p-3">
                            <i class="fas fa-file-invoice-dollar text-xl text-red-500"></i>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center text-sm">
                        @if(is_numeric($debtTrend))
                            <span class="{{ $debtTrend <= 0 ? 'text-green-500' : 'text-red-500' }} font-medium">
                                <i class="fas fa-{{ $debtTrend <= 0 ? 'arrow-down' : 'arrow-up' }} mr-1"></i>
                                {{ abs($debtTrend) }}%
                            </span>
                            <span class="text-gray-500 ml-2">vs bulan lalu</span>
                        @elseif($debtTrend === 'no data')
                            <span class="text-gray-500 ml-2">Tidak ada data trend</span>
                        @endif
                    </div>
                </div>
            </a>
        </div>
    </div>

    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
        
        <a href="{{ route('stock.index') }}" class="group">
            <div class="bg-white rounded-xl shadow-sm p-5 transition-all duration-200 hover:shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Manajemen Stok</h3>
                        <p class="text-sm text-gray-500 mt-1">Kelola stok produk dan level stok</p>
                    </div>
                    <div class="bg-blue-50 rounded-full p-3">
                        <i class="fas fa-boxes text-xl text-blue-500"></i>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-500">Total Produk</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $totalStockItems }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-500">Stok Baru</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $lowStockItems }}</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-blue-600">
                    <span class="text-sm font-medium group-hover:underline">Lihat Detail</span>
                    <i class="fas fa-arrow-right ml-2 text-sm transition-transform group-hover:translate-x-1"></i>
                </div>
            </div>
        </a>

        
        <a href="{{ route('transaction.index') }}" class="group">
            <div class="bg-white rounded-xl shadow-sm p-5 transition-all duration-200 hover:shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">Transaksi</h3>
                        <p class="text-sm text-gray-500 mt-1">Lihat dan kelola semua transaksi</p>
                    </div>
                    <div class="bg-purple-50 rounded-full p-3">
                        <i class="fas fa-exchange-alt text-xl text-purple-500"></i>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-500">Transaksi Hari Ini</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $todayTransactions }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-3">
                        <p class="text-xs text-gray-500">Tertunda</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $pendingTransactions }}</p>
                    </div>
                </div>
                <div class="mt-4 flex items-center text-purple-600">
                    <span class="text-sm font-medium group-hover:underline">Lihat Detail</span>
                    <i class="fas fa-arrow-right ml-2 text-sm transition-transform group-hover:translate-x-1"></i>
                </div>
            </div>
        </a>
    </div>
</div>


@endsection
