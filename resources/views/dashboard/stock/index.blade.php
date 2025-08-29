@extends('dashboard.layout.main')

@section('content')
<div class="mx-auto px-4 sm:px-6 lg:px-8">
    <x-stock-management.tab-nav />

    <div class="mt-4">
        
        <div class="flex space-between mb-4">
            <h2 class="text-lg font-semibold text-gray-900 title-table">Stock List</h2>
            <div class="flex ml-auto">
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
            </div>
        </div>

        <div class="bg-white shadow rounded-xl overflow-hidden mb-6">
            <div class="overflow-x-auto relative">
                <table class="min-w-full text-sm">
                    <thead class="bg-gray-700 text-gray-100 uppercase text-xs">
                        <tr>
                            <th class="px-4 py-3 text-left">
                                <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-blue-600 shadow-sm h-5 w-5 transition duration-150 ease-in-out cursor-pointer">
                            </th>
                            <th class="px-6 py-3 text-left">Tanggal Masuk</th>
                            <th class="px-6 py-3 text-left">Nama Item</th>
                            <th class="px-6 py-3 text-left">QTY</th>
                            <th class="px-6 py-3 text-left">Unit</th>
                            <th class="px-6 py-3 text-left">Detail Harga</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        
                        @if ($stock->count() > 0)
                            @foreach($stock as $index => $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-4 text-gray-500">
                                        <input type="checkbox" value="" class="rounded border-gray-300 text-blue-600 shadow-sm h-5 w-5 transition duration-150 ease-in-out cursor-pointer checkbox-target">
                                    </td>
                                    <td class="px-6 py-4 text-gray-500">{{ $item->tanggal_barang_masuk }}</td>
                                    <td class="px-6 py-4 text-gray-500">{{ $item->nama }}</td>
                                    <td class="px-6 py-4 text-gray-500">{{ $item->produkDetail[0]->kuantitas }}</td>
                                    <td class="px-6 py-4 text-gray-500">{{ $item->produkDetail[0]->nama_satuan }}</td>
                                    <td class="px-6 py-4 text-gray-500">
                                        <a href="?detail_produk_id={{ $item->id }}&view_edit=true" class="text-blue-500 font-semibold hover:text-blue-700">
                                            Detail Produk
                                            <span> ({{ $item->produkDetail->count() }} {{ $item->produkDetail->count() > 1 ? 'Items' : 'Item' }})</span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-gray-500 text-center">
                                Tidak ada data
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@if (request()->get('detail_produk_id') && request()->get('view_edit') == 'true')
    <div id="detail-produk-modal" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50">
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="p-2 rounded-xl bg-gray-300/50 w-full max-w-2xl">
                <div class="bg-gray-100 rounded-xl p-4 shadow-md">
                    <h2 class="text-lg font-semibold text-gray-900 title-table text-center">Detail Satuan Produk</h2>
                    <div class="mt-4">
                        <div class="overflow-x-auto shadow-md border-gray-50 relative rounded-md">
                            <table class="min-w-full text-sm">
                                <thead class="bg-gray-700 text-gray-100 uppercase text-xs ">
                                    <tr>
                                        <th class="px-6 py-3 text-left">Kuantitas</th>
                                        <th class="px-6 py-3 text-left">Satuan</th>
                                        <th class="px-6 py-3 text-left">Harga Satuan</th>
                                        <th class="px-6 py-3 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    @if ($productDetailExist)
                                        @foreach ($produkDetailView->produkDetail as $item)
                                            <tr>
                                                <td class="px-6 py-4 text-gray-500">{{ $item->kuantitas }}</td>
                                                <td class="px-6 py-4 text-gray-500">{{ $item->nama_satuan }}</td>
                                                <td class="px-6 py-4 text-gray-500">Rp. {{ number_format($item->harga_jual, 0, ',', '.') }}</td>
                                                <td calss="px-6 py-4 ">
                                                    <div class="flex justify-center items-center">
                                                        <button data-product="p-{{ $produkDetailView->id }}-d-{{ $item->id }}" class="edit-detail-button py-2 px-4 bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-400 hover:to-gray-500 text-white rounded-lg shadow-sm hover:shadow-md transition-all duration-200 cursor-pointer">
                                                            Edit
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-gray-500 text-center">
                                            Tidak ada data
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end">
                        <button id="close-detail-produk-modal" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 transition cursor-pointer">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

<script>
    $(document).ready(function() {
        $('#selectAll').click(function() {
            $('.checkbox-target').prop('checked', $(this).prop('checked'));
            if ($('.checkbox-target:checked').length > 0) {
                $('#edit-button').removeClass('hidden').addClass('inline-flex');
                $('#delete-button').removeClass('hidden').addClass('inline-flex');
            } else {
                $('#edit-button').addClass('hidden').removeClass('inline-flex'); 
                $('#delete-button').addClass('hidden').removeClass('inline-flex');
            }
        });
        $('.checkbox-target').click(function() {
            if ($('.checkbox-target:checked').length > 0) {
                $('#edit-button').removeClass('hidden').addClass('inline-flex');
                $('#delete-button').removeClass('hidden').addClass('inline-flex');
            } else {
                $('#edit-button').addClass('hidden').removeClass('inline-flex'); 
                $('#delete-button').addClass('hidden').removeClass('inline-flex');
            }

            if ($('.checkbox-target').length === $('.checkbox-target:checked').length) {
                $('#selectAll').prop('checked', true);
            } else {
                $('#selectAll').prop('checked', false);
            }
        });

        $('#edit-form').on('submit', function(e) {
            e.preventDefault();
            
            var selectedIds = [];
            $('.checkbox-target:checked').each(function() {
                selectedIds.push($(this).val());
            });

            if (selectedIds.length > 0) {
                $(this).find('input[name="ids[]"]').remove();
                
                selectedIds.forEach(function(id) {
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'ids[]',
                        value: id
                    }).appendTo('#edit-form');
                });

                this.submit();
            }
        });

        $('#delete-form').on('submit', function(e) {
            e.preventDefault();
            
            if (!confirm('Are you sure you want to delete the selected suppliers?')) {
                return false;
            }

            var selectedIds = [];
            $('.checkbox-target:checked').each(function() {
                selectedIds.push($(this).val());
            });

            if (selectedIds.length > 0) {
                $(this).find('input[name="ids[]"]').remove();
                
                selectedIds.forEach(function(id) {
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'ids[]',
                        value: id
                    }).appendTo('#delete-form');
                });

                this.submit();
            }
        });

        $('#detail-produk-modal').click(function(e) {
            if (e.target === this.children[0]) {
                $(this).hide();
            }
        });

        $('#close-detail-produk-modal').click(() => {
            $('#detail-produk-modal').hide();
        });
    });

$(document).ready(function() {
    $('.edit-detail-button').on('click', function() {
        const productData = $(this).data('product');
        window.location.href=`_stocks/_productdetails/${productData}`
    });
});
</script>

@endsection