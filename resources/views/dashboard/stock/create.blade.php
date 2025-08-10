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
                <label for="harga_beli" class="block text-gray-700 font-semibold mb-2 ">Harga Beli</label>
                <input type="text" name="harga_beli" id="harga_beli" value="{{ old('harga_beli') }}" placeholder="Input harga beli per unit"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600 number-format"
                    required>
            </div>

            <x-custom-search-input
                id="metode_pembayaran"
                name="Metode Pembayaran"
                placeholder="Pilih metode pembayaran"
                addButton="false"
            >
                <div id="cash_supplier" class="metode_pembayaran-option px-3 py-2 hover:bg-gray-100 cursor-pointer" data-value="cash" data-name="Cash">
                    Cash
                </div>
                <div id="hutang_supplier" class="metode_pembayaran-option px-3 py-2 hover:bg-gray-100 cursor-pointer" data-value="hutang" data-name="Hutang">
                    Hutang
                </div>
            </x-custom-search-input>

            <x-custom-search-input 
                id="supplier"
                name="Data Supplier"
                placeholder="Cari atau buat satuan unit..."
                addButton="true"
                formActionName="supplier.store"
                formActionMethod="POST"
            >
                @foreach ($supplier as $item)
                    <div class="supplier-option px-3 py-2 hover:bg-gray-100 cursor-pointer" data-value="{{ $item->nama }}" data-name="{{ $item->nama }}">
                        {{ $item->nama }}
                    </div>
                @endforeach

                <x-slot name="modal">
                    <div class="mb-4">
                        <input type="text" id="supplier_name" name="nama" 
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                            placeholder="Input nama supplier">
                    </div>
                    <div class="mb-4">
                        <input type="text" id="supplier_address" name="alamat" 
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                            placeholder="Input alamat supplier">
                    </div>
                    <div class="mb-4">
                        <input type="text" id="supplier_phone" name="no_telp" 
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                            placeholder="Input nomor telepon supplier">
                    </div>
                    <input type="hidden" name="send_from" value="create_stock">
                    
                </x-slot>

            </x-custom-search-input>

            <div class="mb-4">
                <label for="tanggal_masuk" class="block text-gray-700 font-semibold mb-2">Tanggal Barang Masuk</label>
                <input type="date" name="tanggal_masuk" id="tanggal_masuk" value="{{ old('tanggal_masuk') }}"
                    class="w-full text-gray-500 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                    required>
            </div>

            <div class="grid grid-cols-3 col-span-2 gap-4 border-2 border-dashed border-gray-300 rounded-md p-4">
                
                <div class="col-span-3 grid grid-cols-3 gap-4">
                    <x-custom-search-input 
                        id="satuan_master"
                        name="Unit [Master]"
                        placeholder="Cari atau buat satuan unit..."
                        addButton="true"
                        formActionName="stock.create.satuan"
                        formActionMethod="POST"
                    >
                        @foreach ($satuan as $item)
                            <div class="satuan_master-option px-3 py-2 hover:bg-gray-100 cursor-pointer" data-value="{{ $item->nama }}" data-name="{{ $item->nama }}">
                                {{ $item->nama }}
                            </div>
                        @endforeach
                        <x-slot name="modal">
                            <div class="mb-4">
                                <input type="text" id="satuan_master_unit" name="new_satuan_name" 
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
                        <input type="text" name="harga_jual" id="harga_jual" value="{{ old('harga_jual') }}" placeholder="Input harga jual per unit"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600 number-format"
                            required>
                    </div>
                </div>

                <div class="col-span-3 border-t border-dashed border-gray-300 rounded-md p-4">
                    <div id="total_preview" class="text-right text-gray-600 mb-2"></div>
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
            
            <form action="{{ route('stock.store') }}" method="POST" class="col-span-2">
            @csrf
                <!-- Hidden inputs for form data -->
                <input type="hidden" name="item_name" target-id="nama">
                <input type="hidden" name="item_harga_beli" target-id="harga_beli">
                <input type="hidden" name="item_tanggal_masuk" target-id="tanggal_masuk">
                <input type="hidden" name="item_supplier" target-id="supplier_search">
                <input type="hidden" name="item_metode_pembayaran" target-id="metode_pembayaran" value="{{ request()->has('method') == 'debt' ? 'hutang' : 'cash' }}">
                <input type="hidden" name="item_keterangan" target-id="keterangan">
                <input type="hidden" name="item_jatuh_tempo" target-id="jatuh_tempo">
                
                <!-- Array inputs -->
                <div id="array_inputs">
                    <!-- Unit Master -->
                    <input type="hidden" name="item_kuantitas[]" value="">
                    <input type="hidden" name="item_unit_satuan[]" value="">
                    <input type="hidden" name="item_harga_jual[]" value="">
                    
                    <!-- Unit [1] -->
                    {{-- <input type="hidden" name="item_kuantitas[]" value="">
                    <input type="hidden" name="item_unit_satuan[]" value="">
                    <input type="hidden" name="item_harga_jual[]" value=""> --}}
                </div>

                <div class="flex justify-end">
                    <a href="{{ route('stock.index') }}" 
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
</div>

<script>
$(document).ready(function() {
    const urlParams = new URLSearchParams(window.location.search);

    $('#add_unit').on('click', function() {
        const newFields = `
            <input type="hidden" name="item_kuantitas[]" value="">
            <input type="hidden" name="item_unit_satuan[]" value="">
            <input type="hidden" name="item_harga_jual[]" value="">
        `;
        
        $('#array_inputs').append(newFields);
        
        $('#kuantitas').val('');
        $('#satuan_master').val('').attr('data-selected-id', '');
        $('#harga_jual').val('');
    });

    const method = urlParams.get('method');
    
    if (method === 'cash') {
        $('#cash_supplier').trigger('click');
        $('#jatuh_tempo_div').remove();
    } else if (method === 'debt') {
        $('#hutang_supplier').trigger('click');
        if (!$('#jatuh_tempo_div').length) {
            $('#tanggal_masuk').parent().after(`
                <div class="mb-4" id="jatuh_tempo_div">
                    <label for="jatuh_tempo" class="block text-gray-700 font-semibold mb-2">Waktu Jatuh Tempo</label>
                    <input type="date" name="jatuh_tempo" id="jatuh_tempo" 
                        class="w-full text-gray-500 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                        required>
                </div>
            `);
        }
    }
    $('#nama').on('input', function() {
        $('input[name="item_name"]').val($(this).val());
    });

    $('#harga_beli').on('input', function() {
        const cleanValue = $(this).val().replace(/\./g, '');
        $('input[name="item_harga_beli"]').val(cleanValue);
    });

    $('#tanggal_masuk').on('input change', function() {
        $('input[name="item_tanggal_masuk"]').val($(this).val());
    });

    $('.supplier-option').on('click', function() {
        const nama = $(this).data('value');
        $('#supplier').attr('data-selected-id', nama);
        $('input[name="item_supplier"]').val(nama);
    });
    
    $('.metode_pembayaran-option').on('click', function() {
        const metode = $(this).data('value');
        $('#metode_pembayaran').attr('data-selected-id', metode);
        $('input[name="item_metode_pembayaran"]').val(metode);
    });
    
    // Handler untuk Unit Master
    $('.satuan_master-option').on('click', function() {
        const satuan = $(this).data('value');
        $('#satuan_master').attr('data-selected-id', satuan);
        $('input[name="item_unit_satuan[]"]').eq(0).val(satuan);
    });

    $('#kuantitas').on('input', function() {
        $('input[name="item_kuantitas[]"]').eq(0).val($(this).val());
    });

    $('#harga_jual').on('input', function() {
        const value = $(this).val();
        const cleanValue = value.replace(/\./g, '');
        $('input[name="item_harga_jual[]"]').eq(0).val(cleanValue);
    });

    // Handler untuk Unit tambahan
    $('.satuan_1-option').on('click', function() {
        const satuan = $(this).data('value');
        $('#satuan_1').attr('data-selected-id', satuan);
        $('input[name="item_unit_satuan[]"]').eq(1).val(satuan);
    });

    $('#kuantitas_1').on('input', function() {
        $('input[name="item_kuantitas[]"]').eq(1).val($(this).val());
    });

    $('#harga_jual_1').on('input', function() {
        const value = $(this).val();
        const cleanValue = value.replace(/\./g, '');
        $('input[name="item_harga_jual[]"]').eq(1).val(cleanValue);
    });

    $('#keterangan').on('input', function() {
        $('input[name="item_keterangan"]').val($(this).val());
    });

    $('#hutang_supplier').on('click', function() {
        if (!$('#jatuh_tempo_div').length) {
            $('#tanggal_masuk').parent().after(`
                <div class="mb-4" id="jatuh_tempo_div">
                    <label for="jatuh_tempo" class="block text-gray-700 font-semibold mb-2">Waktu Jatuh Tempo</label>
                    <input type="date" name="jatuh_tempo" id="jatuh_tempo" 
                        class="w-full text-gray-500 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                        required>
                </div>
            `);
        }
    });

    $('#cash_supplier').on('click', function() {
        $('#jatuh_tempo_div').remove();
    });

    $(document).on('input', '#jatuh_tempo', function() {
        $('input[name="item_jatuh_tempo"]').val($(this).val());
    });

});
</script>

@endsection