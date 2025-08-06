@extends('dashboard.layout.main')

@section('content')
<div class="mx-auto px-4 sm:px-6 lg:px-8">
    <x-stock-management.tab-nav />

    <div class="mt-4">
        
        <div class="flex space-between mb-4">
            <h2 class="text-lg font-semibold text-gray-900 title-table">Riwayat Stok</h2>
            {{-- <div class="flex ml-auto">
                <a href="{{ route('stock.create') }}" 
                class="mx-1 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-blue-700 transition">
                    <i class="fas fa-plus mr-2"></i> Create
                </a>
                <form action="{{ route('stock.edit') }}" method="POST" id="edit-form">
                    @csrf
                    <button id="edit-button" type="submit" class="hidden mx-1 items-center px-4 py-2 bg-lime-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-green-700 transition cursor-pointer">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </button>
                </form>
                <form action="{{ route('stock.delete') }}" method="POST" id="delete-form">
                    @csrf
                    <button id="delete-button" type="submit" class="hidden mx-1 items-center px-4 py-2 bg-rose-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-red-700 transition cursor-pointer">
                        <i class="fas fa-trash mr-2"></i> Delete
                    </button>
                </form>
            </div> --}}
        </div>

        <div class="bg-white shadow rounded-xl overflow-hidden mb-6">
            <div class="overflow-x-auto relative">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-700 text-gray-100 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-3 text-left">Tanggal</th>
                            <th class="px-6 py-3 text-left">Item</th>
                            <th class="px-6 py-3 text-left">Qty In</th>
                            <th class="px-6 py-3 text-left">Qty Out</th>
                            <th class="px-6 py-3 text-left">Unit</th>
                            <th class="px-6 py-3 text-left">Harga</th>
                            <th class="px-6 py-3 text-left">Sisa Stok</th>
                            <th class="px-6 py-3 text-left">Total Harga</th>
                            <th class="px-6 py-3 text-left">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-gray-500">6 Agustus 2025</td>
                            <td class="px-6 py-4 text-gray-500">Kayu Jati</td>
                            <td class="px-6 py-4 text-gray-500">0</td>
                            <td class="px-6 py-4 text-gray-500">10</td>
                            <td class="px-6 py-4 text-gray-500">Meter</td>
                            <td class="px-6 py-4 text-gray-500">Rp. 100.000</td>
                            <td class="px-6 py-4 text-gray-500">90</td>
                            <td class="px-6 py-4 text-gray-500">Rp. 1.000.000</td>
                            <td class="px-6 py-4 text-gray-500">Penjualan Produk</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection