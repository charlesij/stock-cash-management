@extends('dashboard.layout.main')

@section('content')
<div class="flex-1 px-6 bg-gray-100 relative">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Tambah Barang</h1>
    </div>

    <div class="bg-white shadow rounded-xl p-6">
        <form action="#" method="POST" class="">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div class="mb-4">
                    <label for="nama" class="block text-gray-700 font-semibold mb-2">Nama Item / Barang</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" placeholder="Input Nama Item"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                        required>
                </div>
    
                <div class="mb-4">
                    <label for="harga_beli" class="block text-gray-700 font-semibold mb-2">Harga Beli</label>
                    <input type="number" name="harga_beli" id="harga_beli" value="{{ old('harga_beli') }}" placeholder="Input harga beli per unit"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                        required>
                </div>

                <div class="mb-4">
                    <label for="tanggal_masuk" class="block text-gray-700 font-semibold mb-2">Tanggal Barang Masuk</label>
                    <input type="date" name="tanggal_masuk" id="tanggal_masuk" value="{{ old('tanggal_masuk') }}"
                        class="w-full text-gray-500 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                        required>
                </div>
                {{-- @dd($satuan) --}}

                <x-custom-search-input 
                    id="satuan"
                    name="Satuan Unit"
                    placeholder="Cari atau buat satuan unit..."
                    addButton="true"
                    formActionName="stock.create.satuan"
                    formActionMethod="POST"
                    :options="$satuan"
                >
                    @foreach ($satuan as $item)
                        <div class="satuan-option px-3 py-2 hover:bg-gray-100 cursor-pointer" data-value="{{ $item->id }}" data-name="{{ $item->nama }}">
                            {{ $item->nama }}
                        </div>
                    @endforeach
                    <x-slot name="modal">
                        <div class="mb-4">
                            <input type="text" id="satuan_unit" name="new_satuan_name" 
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                                placeholder="Enter unit name">
                        </div>
                    </x-slot>
                </x-custom-search-input>

                <x-custom-search-input 
                    id="supplier"
                    name="Data Supplier"
                    placeholder="Cari atau buat satuan unit..."
                    addButton="true"
                    formActionName="supplier.store"
                    formActionMethod="POST"
                    :options="$satuan"
                >
                    @foreach ($satuan as $item)
                        <div class="supplier-option px-3 py-2 hover:bg-gray-100 cursor-pointer" data-value="{{ $item->id }}" data-name="{{ $item->nama }}">
                            {{ $item->nama }}
                        </div>
                    @endforeach

                    <x-slot name="modal">
                        <div class="mb-4">
                            <input type="text" id="supplier_name" name="supplier_name" 
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                                placeholder="Input nama supplier">
                        </div>
                        <div class="mb-4">
                            <input type="text" id="supplier_address" name="supplier_address" 
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                                placeholder="Input alamat supplier">
                        </div>
                        <div class="mb-4">
                            <input type="text" id="supplier_phone" name="supplier_phone" 
                                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                                placeholder="Input nomor telepon supplier">
                        </div>
                        
                    </x-slot>

                </x-custom-search-input>

                <div class="grid grid-cols-3 col-span-2 gap-4 border-2 border-dashed border-gray-300 rounded-md p-4">
                    <div class="mb-4">
                        <label for="satuan_search" class="block text-gray-700 font-semibold mb-2">Unit [Master]</label>
                        <div class="relative">
                            <div class="flex items-center border border-gray-300 rounded-md">
                                <div class="relative flex-1">
                                    <div class="relative w-full">
                                        <input type="text" id="satuan_search" 
                                            class="w-full border-none rounded-l-md pl-3 pr-8 py-2 focus:outline-none" 
                                            placeholder="Cari atau buat satuan unit..." autocomplete="off">
                                        <input type="hidden" name="satuan" id="satuan_value">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                            <i class="fa-solid fa-chevron-down text-gray-400"></i>
                                        </div>
                                        <div id="satuan_dropdown" class="hidden absolute top-full left-0 w-full bg-white border border-gray-300 rounded-md mt-1 shadow-lg max-h-40 overflow-y-auto z-50">
                                            @foreach ($satuan as $item)
                                                <div class="satuan-option px-3 py-2 hover:bg-gray-100 cursor-pointer" data-value="{{ $item->id }}" data-name="{{ $item->nama }}">
                                                    {{ $item->nama }}
                                                </div>
                                            @endforeach
                                            <div id="no_results" class="hidden px-3 py-2 text-gray-500">
                                                No results found
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" id="add_satuan" 
                                    class="inline-flex items-center justify-center w-10 h-[38px] border-l border-gray-300 cursor-pointer bg-gray-50 hover:bg-gray-100 rounded-r-md text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                            
                            <div id="satuan_results" 
                                class="absolute z-10 w-full bg-white border border-gray-300 rounded-md mt-1 shadow-lg max-h-48 overflow-y-auto hidden">
                            </div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label for="kuantitas" class="block text-gray-700 font-semibold mb-2">Kuantitas</label>
                        <input type="number" name="kuantitas" id="kuantitas" value="{{ old('kuantitas') }}" placeholder="Input kuantitas"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="harga_jual" class="block text-gray-700 font-semibold mb-2">Harga Jual</label>
                        <input type="number" name="harga_jual" id="harga_jual" value="{{ old('harga_jual') }}" placeholder="Input harga jual per unit"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                            required>
                    </div>
                    <div class="mt-2 col-span-3">
                        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-200 flex items-center justify-center">
                            <i class="fas fa-plus mr-2"></i>
                            Tambah Unit
                        </button>
                    </div>
                </div>
                

                <div class="mb-4 col-span-2">
                    <label for="keterangan" class="block text-gray-700 font-semibold mb-2">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" placeholder="Tambahkan keterangan (opsional)" rows="3"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                        required></textarea>
                </div>
    
                <div id="add_unit_modal" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden">
                    <div class="flex items-center justify-center min-h-screen p-4">
                        <div class="bg-white py-4 px-6 rounded-lg shadow-2xl w-full max-w-md">
                            <div class="pb-4 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900">Add New Unit</h3>
                            </div>
                            
                            <form id="add_unit_form" action="" method="POST" class="px-6 py-4">
                                @csrf
                                <div class="mb-4">
                                    <input type="text" id="new_unit_name" name="new_unit_name" 
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                                        placeholder="Enter unit name">
                                </div>
    
                                <div class="bg-gray-50 rounded-b-lg flex justify-end space-x-2">
                                    <button type="button" id="cancel_add_unit"
                                        class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-600">
                                        Cancel
                                    </button>
                                    <button type="button" id="save_new_unit"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">
                                        Save Unit
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="flex justify-end">
                <a href="{{ route('stocks.index') }}" 
                    class="inline-flex items-center px-4 py-2 mr-3 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100 transition">
                    Cancel
                </a>
                <button type="submit" 
                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 transition cursor-pointer">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

@endsection