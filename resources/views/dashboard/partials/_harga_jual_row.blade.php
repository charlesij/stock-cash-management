<div class="grid grid-cols-4 gap-4 detail-row relative p-4">
    <button type="button" class="remove-row absolute top-0 right-0 -mt-2 -mr-2 w-6 h-6 flex items-center justify-center rounded-full bg-red-500 text-white hover:bg-red-600 transition-all duration-200 transform hover:scale-110 active:scale-95 shadow-md cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M18 6l-12 12"/>
            <path d="M6 6l12 12"/>
        </svg>
    </button>

    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-2">Urutan</label>
        <input type="number" min="1" name="urutan[]" value="{{ $index }}" class="urutan-input w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600 number-format bg-gray-100" readonly>
    </div>

    <x-custom-search-input 
        id="satuan_produk_setting_{{ $index }}"
        name="unit[]"
        placeholder="Cari atau buat satuan unit..."
        addButton="true"
        label="Unit"
        formActionName="stock.create.satuan"
        formActionMethod="POST"
    >
        @foreach ($satuan as $item)
            <div class="satuan_produk_setting_{{ $index }}-option px-3 py-2 hover:bg-gray-100 cursor-pointer" data-value="{{ $item->nama }}" data-name="{{ $item->nama }}">
                {{ $item->nama }}
            </div>
        @endforeach

        <x-slot name="modal">
            <div class="mb-4">
                <input type="text" name="new_satuan_name" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Enter unit name">
            </div>
        </x-slot>
    </x-custom-search-input>

    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-2">Kuantitas</label>
        <input type="number" name="konversi[]" value="1" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 font-semibold mb-2">Harga Jual Per Unit</label>
        <input type="text" name="harga_jual[]" placeholder="Input harga jual per unit" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600 number-format" required>
    </div>
</div>
