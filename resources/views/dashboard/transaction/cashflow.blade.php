@extends('dashboard.layout.main')

@section('content')

<div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-2">
        <h1 class="text-2xl font-semibold text-gray-900">Transaksi - Kas</h1>
    </div>
    
    <x-transaction.tab-nav />

    <div class="mt-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
            <div class="bg-white shadow rounded-xl overflow-hidden mb-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-700 text-gray-100 uppercase text-xs">
                            <tr>
                                <th class="px-6 py-3 text-left">Tanggal</th>
                                <th class="px-6 py-3 text-left">Jenis Transaksi</th>
                                <th class="px-6 py-3 text-left">Keterangan</th>
                                <th class="px-6 py-3 text-left">Jumlah</th>
                                <th class="px-6 py-3 text-left">Saldo</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-gray-500">6 Agustus 2025</td>
                                <td class="px-6 py-4 text-gray-500">Pengeluaran</td>
                                <td class="px-6 py-4 text-gray-500">Pembayaran Hutang</td>
                                <td class="px-6 py-4 text-gray-500">10.000.000</td>  
                                <td class="px-6 py-4 text-gray-500">10.100.000</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-gray-500">5 Agustus 2025</td>
                                <td class="px-6 py-4 text-gray-500">Pendapatan</td>
                                <td class="px-6 py-4 text-gray-500">Penjualan Produk</td>
                                <td class="px-6 py-4 text-gray-500">200.000</td>  
                                <td class="px-6 py-4 text-gray-500">20.100.000</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-gray-500">1 Agustus 2025</td>
                                <td class="px-6 py-4 text-gray-500">Pengeluaran</td>
                                <td class="px-6 py-4 text-gray-500">Pembelian Produk</td>
                                <td class="px-6 py-4 text-gray-500">100.000</td>  
                                <td class="px-6 py-4 text-gray-500">19.900.000</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-gray-500">1 Agustus 2025</td>
                                <td class="px-6 py-4 text-gray-500">Modal Masuk</td>
                                <td class="px-6 py-4 text-gray-500">-</td>
                                <td class="px-6 py-4 text-gray-500">20.000.000</td>  
                                <td class="px-6 py-4 text-gray-500">20.000.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection