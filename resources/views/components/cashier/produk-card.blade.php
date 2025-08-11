<div title="klik untuk lihat detail produk" id="produk-card-{{ $produk->id }}" class="group bg-white rounded-2xl p-4 hover:shadow-xl transition-all duration-300 cursor-pointer border-2 border-gray-100 hover:border-blue-200 relative">
    @if($isNew)
        <div class="absolute top-4 right-4 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full shadow-lg">
            NEW
        </div>
    @endif
    <div class="aspect-square mb-4 bg-gray-50 rounded-xl overflow-hidden group-hover:shadow-md transition-all duration-300">
        <img src="{{ $imageUrl }}" alt="{{ $namaProduk }}" 
             class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300">
    </div>
    <div class="space-y-2">
        <div class="flex items-center justify-between">
            <p class="text-xs text-gray-500">Stok tersedia</p>
            <div class="text-xs {{ $stock <= 3 ? 'text-red-600 bg-red-50' : ($stock <= 10 ? 'text-yellow-600 bg-yellow-50' : 'text-green-600 bg-green-50') }} px-2 py-1 rounded-full font-medium">
                {{ $stock . ' ' . $produk->produkDetail[0]->nama_satuan }}
            </div>
        </div>
        <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors duration-300">
            {{ $namaProduk }}
        </h3>
        <div class="flex items-center justify-between">
            <p class="text-blue-600 font-bold text-lg">Rp. {{ number_format($hargaProduk, 0, ',', '.') }}</p>
            <button class="bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-xl transition-all duration-300
                         shadow-lg shadow-blue-600/20 hover:shadow-blue-600/30 group-hover:scale-105">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
</div>