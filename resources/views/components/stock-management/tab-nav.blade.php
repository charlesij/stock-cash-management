<div class="border-b border-gray-300">
    <nav class="-mt-4 flex space-x-8" aria-label="Tabs">
        <a href="{{ route('stock.index') }}" class="{{ request()->routeIs('stock.index') ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
            Stok Produk
        </a>
        <a href="{{ route('stock.product.details') }}" class="{{ request()->routeIs('stock.product.details') ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
            Detail Satuan
        </a>
        <a href="{{ route('stocks.settings') }}" class="{{ request()->routeIs('stocks.settings') ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
            Pengaturan
        </a>
        <a href="{{ route('stocks.inventory') }}" class="{{ request()->routeIs('stocks.inventory') ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
            Inventory Lainnya
        </a>
        <a href="{{ route('stocks.history') }}" class="{{ request()->routeIs('stocks.history') ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
            Riwayat Stok
        </a>
    </nav>
</div>