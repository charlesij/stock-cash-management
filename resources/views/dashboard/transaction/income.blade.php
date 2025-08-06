@extends('dashboard.layout.main')

@section('content')

<div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-2">
        <h1 class="text-2xl font-semibold text-gray-900">Transaksi - Pendapatan</h1>
    </div>
    
    <x-transaction.tab-nav />

    <div class="mt-6">
        <div class="flex space-between mb-4">
            <h2 class="text-lg font-semibold text-gray-900 title-table">Penjualan Produk</h2>
        </div>

        <div class="bg-white shadow rounded-xl overflow-hidden mb-6">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-700 text-gray-100 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3 text-left">Tanggal</th>
                            <th class="px-6 py-3 text-left">Item</th>
                            <th class="px-6 py-3 text-left">Qty</th>
                            <th class="px-6 py-3 text-left">Satuan</th>
                            <th class="px-6 py-3 text-left">Harga</th>
                            <th class="px-6 py-3 text-left">Total</th>
                            <th class="px-6 py-3 text-left">Invoice</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-500">6 Agustus 2025</td>
                            <td class="px-6 py-4 text-gray-500">Kayu</td>
                            <td class="px-6 py-4 text-gray-500">100</td>
                            <td class="px-6 py-4 text-gray-500">meter</td>
                            <td class="px-6 py-4 text-gray-500">100.000</td>
                            <td class="px-6 py-4 text-gray-500">10.000.000</td>
                            <td class="px-6 py-4 text-gray-500" title="Detail Invoice">
                                <a href="#" class="text-blue-500 font-semibold hover:text-blue-700">INV/2025/001</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex space-between mb-4">
            <h2 class="text-lg font-semibold text-gray-900 title-table">Pendapatan Lainnya</h2>
        </div>

        <div class="bg-white shadow rounded-xl overflow-hidden mb-6">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-700 text-gray-100 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3 text-left">Tanggal</th>
                            <th class="px-6 py-3 text-left">Item</th>
                            <th class="px-6 py-3 text-left">Qty</th>
                            <th class="px-6 py-3 text-left">Satuan</th>
                            <th class="px-6 py-3 text-left">Harga</th>
                            <th class="px-6 py-3 text-left">Total</th>
                            <th class="px-6 py-3 text-left">Invoice</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-gray-50">
                            <td colspan="7" class="px-6 py-4 text-gray-500 text-center">Tidak ada data</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection