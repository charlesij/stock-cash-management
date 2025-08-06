@extends('dashboard.layout.main')

@section('content')


<div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-2">
        <h1 class="text-2xl font-semibold text-gray-900">Riwayat Transaksi</h1>
    </div>
    
    <x-transaction.tab-nav />

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
                            <th class="px-6 py-3 text-left">Saldo Kas</th>
                            <th class="px-6 py-3 text-left">Total Hutang</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-500">6 Agustus 2025</td>
                            <td class="px-6 py-4 text-gray-500">Transaksi Hutang</td>
                            <td class="px-6 py-4 text-gray-500">Gaji Karyawan</td>
                            <td class="px-6 py-4 text-gray-500">2.500.000</td>  
                            <td class="px-6 py-4 text-gray-500">10.100.000</td>  
                            <td class="px-6 py-4 text-gray-500">2.500.000</td>  
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-500">6 Agustus 2025</td>
                            <td class="px-6 py-4 text-gray-500">Pengeluaran</td>
                            <td class="px-6 py-4 text-gray-500">Pembayaran Hutang</td>
                            <td class="px-6 py-4 text-gray-500">10.000.000</td>  
                            <td class="px-6 py-4 text-gray-500">10.100.000</td>  
                            <td class="px-6 py-4 text-gray-500">0</td>  
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-500">5 Agustus 2025</td>
                            <td class="px-6 py-4 text-gray-500">Pendapatan</td>
                            <td class="px-6 py-4 text-gray-500">Penjualan Produk</td>
                            <td class="px-6 py-4 text-gray-500">200.000</td>  
                            <td class="px-6 py-4 text-gray-500">20.100.000</td>  
                            <td class="px-6 py-4 text-gray-500">10.000.000</td>  
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-500">2 Agustus 2025</td>
                            <td class="px-6 py-4 text-gray-500">Transaksi Hutang</td>
                            <td class="px-6 py-4 text-gray-500">Pengambilan Barang</td>
                            <td class="px-6 py-4 text-gray-500">10.000.000</td>  
                            <td class="px-6 py-4 text-gray-500">19.900.000</td>  
                            <td class="px-6 py-4 text-gray-500">10.000.000</td>  
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-500">1 Agustus 2025</td>
                            <td class="px-6 py-4 text-gray-500">Pengeluaran</td>
                            <td class="px-6 py-4 text-gray-500">Pembelian Produk</td>
                            <td class="px-6 py-4 text-gray-500">100.000</td>  
                            <td class="px-6 py-4 text-gray-500">19.900.000</td>  
                            <td class="px-6 py-4 text-gray-500">0</td>  
                        </tr>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-500">1 Agustus 2025</td>
                            <td class="px-6 py-4 text-gray-500">Pengeluaran</td>
                            <td class="px-6 py-4 text-gray-500">Modal Masuk</td>
                            <td class="px-6 py-4 text-gray-500">20.000.000</td>  
                            <td class="px-6 py-4 text-gray-500">20.000.000</td>  
                            <td class="px-6 py-4 text-gray-500">0</td>  
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection