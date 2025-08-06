@extends('dashboard.layout.main')

@section('content')

<div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-2">
        <h1 class="text-2xl font-semibold text-gray-900">Transaksi - Biaya</h1>
    </div>
    
    <x-transaction.tab-nav />

    <div class="mt-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden hover:shadow-md transition duration-300">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Biaya Operasional</h3>
                        <div class="bg-indigo-50 rounded-full p-3">
                            <i class="fa-solid fa-money-bill-1-wave text-indigo-500"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">Biaya operasional perusahaan</p>
                    <a href="#" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 w-full">
                        <i class="fas fa-plus mr-2"></i>
                        Biaya Operasional
                    </a>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden hover:shadow-md transition duration-300">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Biaya Lainnya</h3>
                        <div class="bg-amber-50 rounded-full p-3">
                            <i class="fas fa-box text-xl text-amber-500"></i>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">Tambah produk baru ke dalam inventori</p>
                    <a href="{{ route('stock.create') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-amber-600 hover:bg-amber-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 w-full">
                        <i class="fas fa-plus mr-2"></i>
                        Biaya Lainnya
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
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-gray-500">5 Agustus 2025</td>
                                <td class="px-6 py-4 text-gray-500">Pengeluaran</td>
                                <td class="px-6 py-4 text-gray-500">Gaji Karyawan</td>
                                <td class="px-6 py-4 text-gray-500">2.500.000</td>  
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection