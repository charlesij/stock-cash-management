@extends('dashboard.layout.main')

@section('content')

<div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-2">
        <h1 class="text-2xl font-semibold text-gray-900">Transaction - Cashflow</h1>
    </div>
    
    <x-transaction.tab-nav />

    <div class="mt-6">
        <div class="bg-white shadow-sm rounded-lg p-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Card Tambah Cash -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden hover:shadow-md transition duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Tambah Cash</h3>
                            <div class="bg-green-50 rounded-full p-3">
                                <i class="fas fa-money-bill-wave text-xl text-green-500"></i>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">Tambahkan atau kurangi saldo kas secara langsung</p>
                        <a href="#" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 w-full">
                            <i class="fas fa-plus mr-2"></i>
                            Kelola Cash
                        </a>
                    </div>
                </div>

                <!-- Card Tambah Produk -->
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden hover:shadow-md transition duration-300">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Tambah Produk</h3>
                            <div class="bg-blue-50 rounded-full p-3">
                                <i class="fas fa-box text-xl text-blue-500"></i>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">Tambah produk baru ke dalam inventori</p>
                        <a href="{{ route('stock.create') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 w-full">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Produk
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <div class="bg-white shadow rounded-xl p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Transaksi Cash</h2>
                    <p class="text-gray-600 mb-4">Daftar semua transaksi cashflow yang telah dilakukan</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection