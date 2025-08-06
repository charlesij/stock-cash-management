@extends('dashboard.layout.main')

@section('content')
<div class="mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-2">
        <h1 class="text-2xl font-semibold text-gray-900">Ringkasan Transaksi</h1>
    </div>
    
    <x-transaction.tab-nav />

    <div class="mt-6">
        <div class="flex space-between mb-4">
            <h2 class="text-lg font-semibold text-gray-900 title-table">Transaksi Hari ini</h2>
        </div>

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
                            <td class="px-6 py-4 text-gray-500">6 Agustus 2025</td>
                            <td class="px-6 py-4 text-gray-500">Transaksi Hutang</td>
                            <td class="px-6 py-4 text-gray-500">Gaji Karyawan</td>
                            <td class="px-6 py-4 text-gray-500">2.500.000</td>
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-500">6 Agustus 2025</td>
                            <td class="px-6 py-4 text-gray-500">Pengeluaran</td>
                            <td class="px-6 py-4 text-gray-500">Pembayaran Hutang</td>
                            <td class="px-6 py-4 text-gray-500">10.000.000</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex space-between mb-4">
            <h2 class="text-lg font-semibold text-gray-900 title-table">Penjualan Hari Ini</h2>
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