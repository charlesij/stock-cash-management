@extends('dashboard.layout.main')

@section('content')
<div class="flex-1 px-6 bg-gray-100 relative">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Tambah Barang</h1>
    </div>

    <div class="bg-white shadow rounded-xl p-6">
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

            <x-custom-search-input 
                id="supplier"
                name="Data Supplier"
                placeholder="Cari atau buat satuan unit..."
                addButton="true"
                formActionName="supplier.store"
                formActionMethod="POST"
                :options="$supplier"
            >
                @foreach ($supplier as $item)
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
                
                <x-custom-search-input 
                    id="satuan"
                    name="Unit [Master]"
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
                    <button type="button" id="add_unit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-200 flex items-center justify-center">
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

        </div>

        <form action="{{ route('stock.store') }}" method="POST">
            @csrf
            <div class="flex justify-end">
                <input type="hidden" name="item_name" target-id="nama">
                <input type="hidden" name="item_harga_beli" target-id="harga_beli">
                <input type="hidden" name="item_tanggal_masuk" target-id="tanggal_masuk">
                <input type="hidden" name="item_supplier" target-id="supplier">
                <input type="hidden" name="item_satuan" target-id="satuan">
                <input type="hidden" name="item_kuantitas" target-id="kuantitas">
                <input type="hidden" name="item_harga_jual" target-id="harga_jual">
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