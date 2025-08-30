@extends('dashboard.layout.main')

@section('content')
<div class="flex-1 px-6 bg-gray-100 relative">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Tambah Barang</h1>
    </div>

    <div class="bg-white shadow rounded-xl p-6">
        <div class="grid grid-cols-2 gap-4">
            <x-custom-search-input 
                id="produk_master"
                name="Produk"
                placeholder="Cari atau tambah produk..."
                addButton="true"
                formActionName="stock.create.produkmaster"
                formActionMethod="POST"
            >
                @foreach ($produkMaster as $item)
                    <div class="produk_master-option px-3 py-2 hover:bg-gray-100 cursor-pointer" data-value="{{ $item->nama }}" data-name="{{ $item->nama }}" onclick="showProdukId({{ $item->id }})">
                        {{ $item->nama }}
                    </div>
                @endforeach
                <x-slot name="modal">
                    <div class="mb-4">
                        <x-custom-search-input
                            id="produk_master_satuan_id"
                            name="produk_master_satuan_id"
                            placeholder="Pilih metode pembayaran"
                            addButton="false"
                            showLabel="false"
                        >
                            @foreach ($satuan as $item)
                                <div  class="produk_master_satuan_id-option px-3 py-2 hover:bg-gray-100 cursor-pointer" data-value="{{ $item->id }}" data-name="{{ $item->nama }}">
                                    {{ $item->nama }}
                                </div>
                            @endforeach
                        </x-custom-search-input>
                    </div>
                    <div class="mb-4">
                        <input type="text" id="produk_master_nama" name="produk_master_nama" value="{{ old('produk_master_nama') }}"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                            placeholder="Enter unit name">
                    </div>
                    <div class="mb-4">
                        <input type="text" name="produk_master_harga_beli" id="produk_master_harga_beli" value="{{ old('produk_master_harga_beli') }}" placeholder="Input harga beli per unit"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600 number-format"
                            required>
                    </div>
                </x-slot>
            </x-custom-search-input>

            <x-custom-search-input 
                id="satuan_master"
                name="Unit"
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
                <label for="harga_beli" class="block text-gray-700 font-semibold mb-2 ">Harga Beli Per Unit</label>
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
                <input type="date" name="tanggal_masuk" id="tanggal_masuk" value="{{ old('tanggal_masuk', date('Y-m-d')) }}"
                    class="w-full text-gray-500 border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                    required>
            </div>

            <div class="mb-4 flex justify-end items-center">
                <span class="block text-gray-700 font-semibold text-md">Total Pembelian : <i class="font-bold text-xl number-format">Rp </i><i id="total-pembelian" class="font-bold text-xl number-format">0</i></span>
            </div>

            <div id="detail-wrapper" class="col-span-2 gap-4 border-2 border-dashed border-gray-300 rounded-md p-4">
                <div class="flex justify-between mb-5">
                    <p class="font-semibold text-gray-600 border-b-2 border-grays-600 hover:text-blue-500 transition">Pengaturan Harga Jual</p>
                    
                    <div class="flex">
                        <button id="button-add-detail" class="w-6 h-6 flex items-center justify-center rounded-full bg-green-500 text-white hover:bg-green-600 transition-all duration-200 transform hover:scale-110 active:scale-95 shadow-md cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                        </button>
                    </div>
                    
                </div>
                
                <!-- Row Pertama -->
                <div class="grid grid-cols-4 gap-4 detail-row relative p-4">
                    <!-- tombol remove -->
                    <button type="button" 
                        class="remove-row absolute top-0 right-0 -mt-2 -mr-2 hidden w-6 h-6 flex items-center justify-center rounded-full bg-red-500 text-white hover:bg-red-600 transition-all duration-200 transform hover:scale-110 active:scale-95 shadow-md cursor-pointer">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" 
                            width="20" height="20" viewBox="0 0 24 24" stroke-width="2" 
                            stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M18 6l-12 12" />
                            <path d="M6 6l12 12" />
                        </svg>
                    </button>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Urutan</label>
                        <input type="number" min="1" name="urutan_detail[]" value="1"
                            class="urutan-input w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600 number-format bg-gray-100"
                            required readonly>
                    </div>

                    <div class="mb-4">
                        <x-custom-search-input 
                            id="satuan_produk_setting_1"
                            name="unit_detail[]"
                            placeholder="Cari atau buat satuan unit..."
                            addButton="true"
                            label="Unit"
                            formActionName="stock.create.satuan"
                            formActionMethod="POST"
                        >
                            @foreach ($satuan as $item)
                                <div class="satuan_produk_setting_1-option body-select-satian_produk_setting px-3 py-2 hover:bg-gray-100 cursor-pointer"
                                    data-value="{{ $item->nama }}" data-name="{{ $item->nama }}">
                                    {{ $item->nama }}
                                </div>
                            @endforeach

                            <x-slot name="modal">
                                <div class="mb-4">
                                    <input type="text" name="new_satuan_name" 
                                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                                        placeholder="Enter unit name">
                                </div>
                            </x-slot>
                        </x-custom-search-input>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Kuantitas</label>
                        <input type="number" name="konversi_detail[]" value="1"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                            required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold mb-2">Harga Jual Per Unit</label>
                        <input type="text" name="harga_jual_detail[]" placeholder="Input harga jual per unit"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600 number-format"
                            required>
                    </div>
                </div>
            </div>
            <div>
                <span>Total Pembelian</span>
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

        const saldoCash = new Intl.NumberFormat('id-ID').format({{ $saldoKas->cash }});
        $(document).on('click', '#cash_supplier', function() {
            $('label[for="metode_pembayaran_search"]').html(`Metode Pembayaran <span class="text-gray-400">(Kas Tersedia: ${saldoCash})</span>`);
        });

        const saldoHutang = new Intl.NumberFormat('id-ID').format({{ $saldoKas->hutang }});
            $(document).on('click', '#hutang_supplier', function() {
            $('label[for="metode_pembayaran_search"]').html(`Metode Pembayaran <span class="text-gray-400">(Hutang Saat Ini: ${saldoHutang})</span>`);
        });

        $('form').on('submit', function(e) {
        e.preventDefault(); // mencegah submit default

        // Ambil data form utama
        let formData = {
            _token: $('input[name="_token"]').val(),
            item_name: $('#produk_master_nama').val() || $('#produk_master').val(),
            item_harga_beli: $('#harga_beli').val() || $('#produk_master_harga_beli').val(),
            item_tanggal_masuk: $('#tanggal_masuk').val(),
            item_supplier: $('#supplier_name').val() || $('#supplier').val(),
            item_metode_pembayaran: $('#metode_pembayaran').val(),
            item_keterangan: $('#keterangan').val(),
            item_jatuh_tempo: $('#jatuh_tempo').val(),
            item_kuantitas: [],
            item_unit_satuan: [],
            item_harga_jual: [],
        };

        // Ambil semua row detail unit dinamis
        $('#detail-wrapper .detail-row').each(function() {
            let urutan = $(this).find('input[name="urutan_detail[]"]').val();
            let kuantitas = $(this).find('input[name="konversi_detail[]"]').val();
            let unit = $(this).find('.body-select-satian_produk_setting').data('value') || '';
            let hargaJual = $(this).find('input[name="harga_jual_detail[]"]').val();

            formData.item_kuantitas.push(kuantitas);
            formData.item_unit_satuan.push(unit);
            formData.item_harga_jual.push(hargaJual);
        });

        // AJAX request
        $.ajax({
            url: '{{ route("stock.store") }}',
            method: 'POST',
            data: formData,
            success: function(response) {
                // Handle sukses
                alert('Data berhasil disimpan!');
                console.log(response);
            },
            error: function(xhr) {
                // Handle error
                let errors = xhr.responseJSON.errors;
                console.log(errors);
                alert('Terjadi kesalahan, cek console untuk detail.');
            }
        });
    });

    });

    function showProdukId(id) {
        $.ajax({
            url: '/getdataProduck/' + id, 
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response.data);
                $('#satuan_master_search').val(response.data.satuan.nama);
                $('#satuan_master_value').val(response.data.satuan.id);
                $('#kuantitas').val(1);
                $('#harga_beli').val(formatCurrency(response.data.harga_beli));

                let totalPembelian = 1 * response.data.harga_beli;
                
                $("#total-pembelian").text(formatCurrency(totalPembelian));

            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }

    function formatCurrency(value) {
        if (typeof value === 'number') {
            value = value.toString();
        }

        if (!value) {
            value = "0";
        }

        value = value.replace(/[^0-9]/g, '');
        
        let number = parseInt(value, 10) || 0;

        return number.toLocaleString('id-ID');
    }

    function calculateTotal() {
        let qty = parseInt($('#kuantitas').val(), 10) || 0;

        let harga = $('#harga_beli').val().toString().replace(/[^0-9]/g, '');
        harga = parseInt(harga, 10) || 0;

        let total = qty * harga;
        $('#total-pembelian').text(formatCurrency(total));
    }

    $('#harga_beli').on('input', function () {
        let value = $(this).val().replace(/[^0-9]/g, '');
        if (value) {
            $(this).val(parseInt(value, 10).toLocaleString('id-ID'));
        } else {
            $(this).val('');
        }
        calculateTotal();
    });

    $('#kuantitas').on('input', function () {
        calculateTotal();
    });

</script>

<script>
    let counter = $(".detail-row").length;

    $("#button-add-detail").on("click", function() {
        counter++;
        $.ajax({
            url: '/harga-jual-row/' + counter,
            type: 'GET',
            success: function(html) {
                $("#detail-wrapper").append(html);
                reindexUrutan();
                new CustomSearchInput({
                    id: `satuan_produk_setting_${counter}`,
                    name: 'unit[]',
                    placeholder: 'Cari atau buat satuan unit...',
                    addButton: true
                });
            },
            error: function() {
                alert('Gagal memuat row baru!');
            }
        });
    });

    $(document).on("click", ".remove-row", function() {
        if ($(".detail-row").length > 1) {
            $(this).closest(".detail-row").remove();
            reindexUrutan();
        }
    });

    function reindexUrutan() {
        $(".detail-row").each(function(index) {
            $(this).find(".urutan-input").val(index + 1);
        });
    }
</script>

@endsection