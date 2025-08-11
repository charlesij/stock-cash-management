<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Cashier - POS System</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-gradient-to-r from-blue-600 to-blue-800 shadow-lg">
        <div class="max-w-full px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="bg-black/10 backdrop-blur-lg text-white p-3 rounded-xl shadow-inner">
                        <i class="fas fa-cash-register text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">StockCash Cashier</h1>
                        <p class="text-sm text-blue-100">Cashier Terminal</p>
                    </div>
                </div>
                <div class="flex items-center space-x-6">
                    <div id="clock" class="text-white text-lg font-medium bg-black/10 backdrop-blur-sm px-4 py-2 rounded-lg">
                        <i class="far fa-clock mr-2"></i>
                        <span>00:00:00</span>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-blue-100 capitalize">Cashier: <span class="text-indigo-200 font-bold text-lg">{{ auth()->user()->name ?? 'John Doe' }}</span></p>
                        <p class="text-sm text-blue-100">Terminal #{{ auth()->user()->id ?? '001' }}</p>
                    </div>
                    <div class="relative group">
                        <div class="w-11 h-11 bg-white bg-opacity-20 hover:bg-opacity-30 transition-all duration-300 rounded-full flex items-center justify-center cursor-pointer shadow-inner">
                            <i class="fas fa-user text-white text-lg"></i>
                        </div>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 hidden group-hover:block transition-all duration-300 z-50">
                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600">
                                <i class="fas fa-user-circle mr-2"></i>Profile
                            </a>
                            <a href="#" class="block px-4 py-2 text-gray-800 hover:bg-blue-50 hover:text-blue-600">
                                <i class="fas fa-cog mr-2"></i>Settings
                            </a>
                            <div class="border-t border-gray-100 my-1"></div>
                            <a href="#" class="block px-4 py-2 text-red-600 hover:bg-red-50">
                                <i class="fas fa-sign-out-alt mr-2"></i>Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Add Clock Script -->
    <script>
        function updateClock() {
            const now = new Date();
            const time = now.toLocaleTimeString('en-US', { 
                hour12: false,
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            document.querySelector('#clock span').textContent = time;
        }
        
        // Update clock immediately and then every second
        updateClock();
        setInterval(updateClock, 1000);
    </script>

    <!-- Main Content -->
    <div class="flex h-screen">
        <!-- Left Panel - Products -->
        <div class="flex-1 p-6 overflow-hidden">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 h-full flex flex-col">
                <!-- Search Section -->
                <div class="p-6 border-b border-gray-200">
                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-2xl font-bold text-gray-900">Products</h2>
                            {{-- <div class="flex items-center space-x-2">
                                <button class="text-gray-500 hover:text-gray-700 p-2 rounded-lg hover:bg-gray-100 transition-all">
                                    <i class="fas fa-th-large text-lg"></i>
                                </button>
                                <button class="text-gray-500 hover:text-gray-700 p-2 rounded-lg hover:bg-gray-100 transition-all">
                                    <i class="fas fa-list text-lg"></i>
                                </button>
                            </div> --}}
                        </div>
                        <div class="flex space-x-3">
                            <!-- Search Bar -->
                            <div class="flex-1 relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400 group-focus-within:text-blue-500 transition-colors"></i>
                                </div>
                                <input id="search-produk-input" type="text" placeholder="Search products or scan barcode..." class="w-full pl-11 pr-16 py-3.5 bg-gray-50 border-2 border-gray-200 rounded-xl focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-300 text-gray-600 placeholder-gray-400 outline-none">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                    <kbd class="hidden sm:inline-block px-2 py-1 text-xs text-gray-400 bg-gray-100 rounded">⌘K</kbd>
                                </div>
                            </div>
                            {{-- <!-- Barcode Scanner Button -->
                            <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3.5 rounded-xl
                                         transition-all duration-300 flex items-center space-x-2 shadow-lg shadow-blue-600/20
                                         hover:shadow-blue-600/30 focus:ring-4 focus:ring-blue-500/20">
                                <i class="fas fa-barcode text-lg"></i>
                                <span class="hidden sm:inline font-medium">Scanner</span>
                            </button> --}}
                        </div>
                    </div>
                    
                    <!-- Category Filters -->
                    {{-- <div class="flex items-center space-x-4">
                        <div class="relative">
                            <select class="appearance-none bg-gray-50 border-2 border-gray-200 rounded-xl px-4 py-2.5 pr-10
                                         focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-300
                                         text-gray-600 font-medium cursor-pointer">
                                <option>All Categories</option>
                                <option>Electronics</option>
                                <option>Groceries</option>
                                <option>Clothing</option>
                                <option>Books</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <i class="fas fa-chevron-down text-gray-400"></i>
                            </div>
                        </div>
                        <div class="flex-1 flex space-x-2 overflow-x-auto py-1 scrollbar-thin scrollbar-thumb-gray-200 scrollbar-track-transparent">
                            <button class="bg-blue-600 text-white px-4 py-2.5 rounded-xl font-medium shadow-sm hover:shadow-md transition-all duration-300">
                                All Items
                            </button>
                            <button class="bg-gray-50 hover:bg-gray-100 text-gray-700 px-4 py-2.5 rounded-xl font-medium transition-all duration-300
                                         border-2 border-gray-200 hover:border-gray-300">
                                Best Sellers
                            </button>
                            <button class="bg-gray-50 hover:bg-gray-100 text-gray-700 px-4 py-2.5 rounded-xl font-medium transition-all duration-300
                                         border-2 border-gray-200 hover:border-gray-300">
                                New Arrivals
                            </button>
                            <button class="bg-gray-50 hover:bg-gray-100 text-gray-700 px-4 py-2.5 rounded-xl font-medium transition-all duration-300
                                         border-2 border-gray-200 hover:border-gray-300">
                                On Sale
                            </button>
                        </div>
                    </div> --}}
                </div>

                <!-- Products Grid -->
                <div class="flex-1 p-6 overflow-y-auto">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

                        {{-- @dd($produk) --}}
                        @foreach($produk as $p)
                            <x-cashier.produk-card 
                                :produk="$p" 
                                :isNew="false" 
                                imageUrl="https://placehold.co/200x200/e2e8f0/64748b?text={{ $p->nama }}" 
                                :stock="$p->produkDetail[0]->kuantitas" 
                                :namaProduk="$p->nama" 
                                :hargaProduk="$p->produkDetail[0]->harga_jual" 
                            />
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Panel - Cart -->
        <div class="w-96 p-6 bg-white border-l border-gray-200">
            <div class="h-full flex flex-col">
                <!-- Cart Header -->
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">Checkout Items</h2>
                            <p class="text-sm text-gray-500">0 items in cart</p>
                        </div>
                        <button class="text-red-500 hover:text-red-600 text-sm font-medium px-3 py-1.5 rounded-lg hover:bg-red-50 transition-all duration-300 cursor-pointer">
                            <i class="fas fa-trash mr-1.5"></i>Hapus Semua
                        </button>
                    </div>
                </div>

                <!-- Cart Items -->
                <div class="flex-1 overflow-y-auto mb-6 space-y-3 pr-2">
                    <!-- Cart Item Template -->
                    <template x-for="item in [
                        { name: 'iPhone 14 Pro', price: 999.00, quantity: 1, image: 'https://placehold.co/60x60/e2e8f0/64748b?text=iPhone' },
                        { name: 'Premium Coffee Beans', price: 24.99, quantity: 2, image: 'https://placehold.co/60x60/f0fdf4/16a34a?text=Coffee' },
                        { name: 'Wireless Mouse', price: 39.99, quantity: 1, image: 'https://placehold.co/60x60/fefce8/ca8a04?text=Mouse' }
                    ]">
                        <div class="group bg-gray-50 hover:bg-white rounded-xl p-3 flex items-center space-x-3
                                  transition-all duration-300 hover:shadow-md border border-gray-100">
                            <div class="relative">
                                <img :src="item.image" :alt="item.name" 
                                     class="w-14 h-14 rounded-lg object-cover shadow-sm">
                                <button class="absolute -top-2 -right-2 bg-red-500 text-white w-5 h-5 rounded-full 
                                           flex items-center justify-center opacity-0 group-hover:opacity-100 
                                           transition-opacity duration-300 hover:bg-red-600">
                                    <i class="fas fa-times text-xs"></i>
                                </button>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-900" x-text="item.name"></h4>
                                <div class="flex items-center justify-between mt-1">
                                    <p class="text-blue-600 font-bold">
                                        $<span x-text="(item.price * item.quantity).toFixed(2)"></span>
                                    </p>
                                    <div class="flex items-center space-x-2">
                                        <button class="w-7 h-7 bg-white hover:bg-gray-100 rounded-lg flex items-center justify-center 
                                                   transition-colors border border-gray-200 hover:border-gray-300">
                                            <i class="fas fa-minus text-xs text-gray-600"></i>
                                        </button>
                                        <span class="w-8 text-center font-medium" x-text="item.quantity"></span>
                                        <button class="w-7 h-7 bg-white hover:bg-gray-100 rounded-lg flex items-center justify-center 
                                                   transition-colors border border-gray-200 hover:border-gray-300">
                                            <i class="fas fa-plus text-xs text-gray-600"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Cart Summary -->
                <div class="border-t border-gray-200 pt-4">
                    <!-- Discount Code -->
                    {{-- <div class="mb-4">
                        <div class="flex space-x-2">
                            <input type="text" placeholder="Discount code" 
                                   class="flex-1 px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm
                                          focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                            <button class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium
                                         hover:bg-gray-200 transition-colors">
                                Apply
                            </button>
                        </div>
                    </div> --}}

                    <!-- Summary Details -->
                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="font-medium">$1,088.97</span>
                        </div>
                        {{-- <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Tax (8.5%)</span>
                            <span class="font-medium">$92.56</span>
                        </div>
                        <div class="flex justify-between text-sm text-green-600">
                            <span>Discount</span>
                            <span class="font-medium">-$0.00</span>
                        </div> --}}
                        <div class="border-t border-gray-200 pt-3">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold">Total</span>
                                <div class="text-right">
                                    <span class="text-2xl font-bold text-blue-600">$1,088.97</span>
                                    <p class="text-sm text-gray-500">Sudah termasuk PPN 11%</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Buttons -->
                    <div class="space-y-3">
                        <button class="w-full bg-green-600 hover:bg-green-700 text-white py-3.5 rounded-xl
                                     font-semibold transition-all duration-300 shadow-lg shadow-green-600/20
                                     hover:shadow-green-600/30 focus:ring-4 focus:ring-green-500/20">
                            <i class="fas fa-credit-card mr-2"></i>Process Payment
                        </button>
                        <div class="flex space-x-2">
                            <button title="Simpan transaksi untuk nanti" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 py-2.5 px-4 rounded-xl
                                         text-sm font-medium transition-all duration-300 hover:shadow-sm cursor-pointer">
                                <i class="fas fa-save mr-1.5"></i>Hold
                            </button>
                            <button title="Cetak invoice" class="flex-1 bg-blue-50 hover:bg-blue-100 text-blue-600 py-2.5 px-4 rounded-xl
                                         text-sm font-medium transition-all duration-300 hover:shadow-sm cursor-pointer">
                                <i class="fas fa-receipt mr-1.5"></i>Receipt
                            </button>
                            <button title="Bagikan invoice" class="flex-1 bg-purple-50 hover:bg-purple-100 text-purple-600 py-2.5 px-4 rounded-xl
                                         text-sm font-medium transition-all duration-300 hover:shadow-sm cursor-pointer">
                                <i class="fas fa-share-alt mr-1.5"></i>Share
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('keydown', function(e) {
            if (e.key === '/' && !['INPUT', 'TEXTAREA'].includes(document.activeElement.tagName)) {
                e.preventDefault();
                document.getElementById('search-produk-input').focus();
            }
        });
    </script>
</body>
</html>