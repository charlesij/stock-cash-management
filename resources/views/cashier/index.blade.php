<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashier</title>
    @vite('resources/css/app.css')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        .product-card {
            transition: all 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .search-highlight {
            background: rgba(59, 130, 246, 0.1);
            border: 2px solid #3b82f6;
            animation: pulse 1.5s infinite;
        }
        @keyframes pulse {
            0% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4); }
            70% { box-shadow: 0 0 0 10px rgba(59, 130, 246, 0); }
            100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0); }
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Top Navigation -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-semibold text-gray-800">Stock Cash Management</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Cashier: {{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="ml-4">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition-colors flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Products Section -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="mb-6">
                        <input 
                            type="text" 
                            id="searchInput"
                            placeholder="Search products..."
                            class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                    </div>
                    
                    <!-- Product Grid -->
                    <div id="productGrid" class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6 flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <button id="prevPage" class="px-4 py-2 bg-gray-100 rounded-lg hover:bg-gray-200 disabled:opacity-50">
                                Previous
                            </button>
                            <span class="text-gray-600">
                                Page <span id="currentPage">1</span> of <span id="totalPages">1</span>
                            </span>
                            <button id="nextPage" class="px-4 py-2 bg-gray-100 rounded-lg hover:bg-gray-200 disabled:opacity-50">
                                Next
                            </button>
                        </div>
                        <div class="text-gray-600">
                            Showing <span id="showingStart">1</span> -
                            <span id="showingEnd">9</span>
                            of <span id="totalItems">0</span> items
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cart Section -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow p-6 sticky top-8">
                    <h2 class="text-xl font-semibold mb-4">Shopping Cart</h2>
                    
                    <!-- Cart Items -->
                    <div id="cartItems" class="space-y-4 mb-6 max-h-[400px] overflow-y-auto">
                    </div>

                    <!-- Cart Summary -->
                    <div class="border-t pt-4">
                        <div class="flex justify-between mb-2">
                            <span class="font-medium">Subtotal:</span>
                            <span id="cartTotal" class="font-bold">Rp 0</span>
                        </div>
                        <button 
                            id="checkoutBtn"
                            class="w-full bg-green-500 text-white py-3 rounded-lg hover:bg-green-600 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled
                        >
                            Proceed to Payment
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    <div id="paymentModal" class="fixed inset-0 bg-black bg-opacity-50 items-center justify-center p-4 hidden">
        <div class="bg-white rounded-lg max-w-md w-full p-6 mx-auto mt-20">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold">Payment Details</h3>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Total Amount</label>
                    <div id="modalTotal" class="text-2xl font-bold text-blue-600">Rp 0</div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Payment Method</label>
                    <select id="paymentMethod" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <option value="cash">Cash</option>
                        <option value="debit">Debit Card</option>
                        <option value="credit">Credit Card</option>
                    </select>
                </div>

                <div id="cashPayment">
                    <label class="block text-sm font-medium text-gray-700">Amount Received</label>
                    <input type="number" id="amountReceived" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    
                    <div class="mt-2">
                        <label class="block text-sm font-medium text-gray-700">Change</label>
                        <div id="changeAmount" class="text-xl font-bold">Rp 0</div>
                    </div>
                </div>

                <button id="completePayment" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition-colors">
                    Complete Payment
                </button>
            </div>
        </div>
    </div>

    <script>
        const products = [
            {
                id: 1,
                name: 'Coffee Latte',
                price: 25000,
                stock: 100,
                image: 'https://placehold.co/300'
            },
            {
                id: 2,
                name: 'Cappuccino',
                price: 28000,
                stock: 100,
                image: 'https://placehold.co/300'
            },
            {
                id: 3,
                name: 'Espresso',
                price: 20000,
                stock: 100,
                image: 'https://placehold.co/300'
            },
            {
                id: 4,
                name: 'Green Tea Latte',
                price: 23000,
                stock: 50,
                image: 'https://placehold.co/300'
            },
            {
                id: 5,
                name: 'Chocolate Frappe',
                price: 30000,
                stock: 75,
                image: 'https://placehold.co/300'
            },
            {
                id: 6,
                name: 'Caramel Macchiato',
                price: 32000,
                stock: 80,
                image: 'https://placehold.co/300'
            },
            {
                id: 7,
                name: 'Vanilla Latte',
                price: 27000,
                stock: 90,
                image: 'https://placehold.co/300'
            },
            {
                id: 8,
                name: 'Mocha',
                price: 29000,
                stock: 85,
                image: 'https://placehold.co/300'
            },
            {
                id: 9,
                name: 'Americano',
                price: 22000,
                stock: 100,
                image: 'https://placehold.co/300'
            },
            {
                id: 10,
                name: 'Croissant',
                price: 15000,
                stock: 50,
                image: 'https://placehold.co/300'
            },
            {
                id: 11,
                name: 'Chocolate Muffin',
                price: 12000,
                stock: 40,
                image: 'https://placehold.co/300'
            },
            {
                id: 12,
                name: 'Cheese Cake',
                price: 35000,
                stock: 30,
                image: 'https://placehold.co/300'
            }
        ];

        $(document).ready(function() {
            let cart = [];
            let currentPage = 1;
            const itemsPerPage = 9;
            let filteredProducts = [...products];

            function formatPrice(price) {
                return 'Rp ' + price.toLocaleString('id-ID');
            }

            function renderProducts() {
                const start = (currentPage - 1) * itemsPerPage;
                const end = start + itemsPerPage;
                const paginatedProducts = filteredProducts.slice(start, end);

                $('#productGrid').empty();
                paginatedProducts.forEach(product => {
                    $('#productGrid').append(`
                        <div class="product-card bg-white border rounded-lg p-4 hover:shadow-lg transition-shadow" data-id="${product.id}">
                            <img src="${product.image}" alt="${product.name}" class="w-full h-40 object-cover rounded-lg mb-4">
                            <h3 class="product-name text-lg font-semibold">${product.name}</h3>
                            <div class="product-details" style="display: none;">
                                <p class="text-sm text-gray-600">Stock: ${product.stock}</p>
                                <p class="text-lg font-bold text-blue-600">${formatPrice(product.price)}</p>
                                <div class="mt-2 text-sm text-gray-500">Click to add this item to cart</div>
                            </div>
                            <button 
                                class="add-to-cart-btn w-full mt-4 bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition-colors ${product.stock === 0 ? 'opacity-50 cursor-not-allowed' : ''}"
                                ${product.stock === 0 ? 'disabled' : ''}
                            >
                                ${product.stock === 0 ? 'Out of Stock' : 'Add to Cart'}
                            </button>
                        </div>
                    `);
                });

                updatePagination();
            }

            function updatePagination() {
                const totalPages = Math.ceil(filteredProducts.length / itemsPerPage);
                const start = (currentPage - 1) * itemsPerPage + 1;
                const end = Math.min(currentPage * itemsPerPage, filteredProducts.length);

                $('#currentPage').text(currentPage);
                $('#totalPages').text(totalPages);
                $('#showingStart').text(start);
                $('#showingEnd').text(end);
                $('#totalItems').text(filteredProducts.length);

                $('#prevPage').prop('disabled', currentPage === 1);
                $('#nextPage').prop('disabled', currentPage === totalPages);
            }

            function renderCart() {
                $('#cartItems').empty();
                let total = 0;

                cart.forEach(item => {
                    total += item.price * item.quantity;
                    $('#cartItems').append(`
                        <div class="flex items-center justify-between border-b pb-4">
                            <div>
                                <h4 class="font-medium">${item.name}</h4>
                                <p class="text-gray-600">${formatPrice(item.price)}</p>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button class="cart-minus px-2 py-1 bg-gray-200 rounded" data-id="${item.id}">-</button>
                                <span>${item.quantity}</span>
                                <button class="cart-plus px-2 py-1 bg-gray-200 rounded" data-id="${item.id}">+</button>
                                <button class="cart-remove text-red-500 ml-2" data-id="${item.id}">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    `);
                });

                $('#cartTotal').text(formatPrice(total));
                $('#modalTotal').text(formatPrice(total));
                $('#checkoutBtn').prop('disabled', cart.length === 0);
            }

            $('#searchInput').on('input', function() {
                const query = $(this).val().toLowerCase();
                filteredProducts = products.filter(product => 
                    product.name.toLowerCase().includes(query)
                );
                currentPage = 1;
                renderProducts();

                if (query) {
                    $('.product-card').each(function() {
                        const name = $(this).find('.product-name').text().toLowerCase();
                        if (name.includes(query)) {
                            $(this).addClass('search-highlight');
                        } else {
                            $(this).removeClass('search-highlight');
                        }
                    });
                } else {
                    $('.product-card').removeClass('search-highlight');
                }
            });

            $(document).on('click', '.add-to-cart-btn:not(:disabled)', function() {
                const card = $(this).closest('.product-card');
                const productId = parseInt(card.data('id'));
                const product = products.find(p => p.id === productId);
                
                const existingItem = cart.find(item => item.id === productId);
                if (existingItem) {
                    existingItem.quantity++;
                } else {
                    cart.push({...product, quantity: 1});
                }

                const imgClone = card.find('img').clone()
                    .offset({
                        top: card.find('img').offset().top,
                        left: card.find('img').offset().left
                    })
                    .css({
                        'position': 'absolute',
                        'height': '150px',
                        'width': '150px',
                        'z-index': '100'
                    })
                    .appendTo($('body'))
                    .animate({
                        'top': $('#cartItems').offset().top + 10,
                        'left': $('#cartItems').offset().left + 10,
                        'width': 75,
                        'height': 75
                    }, 1000, 'easeInOutExpo');

                imgClone.animate({
                    'width': 0,
                    'height': 0
                }, function() {
                    $(this).detach();
                });

                renderCart();
            });

            $(document).on('click', '.cart-minus', function() {
                const id = $(this).data('id');
                const item = cart.find(item => item.id === id);
                if (item.quantity > 1) {
                    item.quantity--;
                    renderCart();
                }
            });

            $(document).on('click', '.cart-plus', function() {
                const id = $(this).data('id');
                const item = cart.find(item => item.id === id);
                item.quantity++;
                renderCart();
            });

            $(document).on('click', '.cart-remove', function() {
                const id = $(this).data('id');
                cart = cart.filter(item => item.id !== id);
                renderCart();
            });

            $('#prevPage').click(function() {
                if (currentPage > 1) {
                    currentPage--;
                    renderProducts();
                }
            });

            $('#nextPage').click(function() {
                const totalPages = Math.ceil(filteredProducts.length / itemsPerPage);
                if (currentPage < totalPages) {
                    currentPage++;
                    renderProducts();
                }
            });

            $('#checkoutBtn').click(function() {
                $('#paymentModal').removeClass('hidden').addClass('flex');
            });

            $('#closeModal').click(function() {
                $('#paymentModal').removeClass('flex').addClass('hidden');
            });

            $('#paymentMethod').change(function() {
                if ($(this).val() === 'cash') {
                    $('#cashPayment').show();
                } else {
                    $('#cashPayment').hide();
                }
            });

            $('#amountReceived').on('input', function() {
                const received = parseFloat($(this).val()) || 0;
                const total = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                const change = received - total;
                $('#changeAmount').text(formatPrice(Math.max(0, change)));
            });

            $('#completePayment').click(function() {
                alert('Payment completed!');
                cart = [];
                renderCart();
                $('#paymentModal').removeClass('flex').addClass('hidden');
            });

            $('.product-card').hover(
                function() {
                    $(this).find('.product-details').slideDown(200);
                },
                function() {
                    $(this).find('.product-details').slideUp(200);
                }
            );

            renderProducts();
            renderCart();
        });
    </script>
</body>
</html>