<aside class="bg-gray-800 text-white w-64 h-screen flex-shrink-0 transition-transform duration-300 transform lg:translate-x-0 lg:relative fixed z-30 overflow-y-auto" id="sidebar">
    <div class="flex items-center justify-between h-16 shadow-lg px-4">
        <h2 class="text-2xl font-bold">StockCash</h2>
        <button class="lg:hidden text-gray-300 hover:text-white focus:outline-none" id="sidebar-close">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>

    <nav class="mt-6">
        <div class="px-4">
            <a href="{{ route('dashboard.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('dashboard.index') ? 'bg-gray-700 rounded-lg' : 'hover:bg-gray-700 rounded-lg' }}">
                <i class="fas fa-home"></i>
                <span class="mx-4">Dashboard</span>
            </a>

            <a href="#" class="flex items-center px-4 py-3 mt-2 {{ request()->routeIs('stocks*') ? 'bg-gray-700 rounded-lg' : 'hover:bg-gray-700 rounded-lg' }}">
                <i class="fas fa-box"></i>
                <span class="mx-4">Stock Management</span>
            </a>

            <a href="#" class="flex items-center px-4 py-3 mt-2 {{ request()->routeIs('transactions*') ? 'bg-gray-700 rounded-lg' : 'hover:bg-gray-700 rounded-lg' }}">
                <i class="fas fa-exchange-alt"></i>
                <span class="mx-4">Transactions</span>
            </a>

            <a href="#" class="flex items-center px-4 py-3 mt-2 {{ request()->routeIs('reports*') ? 'bg-gray-700 rounded-lg' : 'hover:bg-gray-700 rounded-lg' }}">
                <i class="fas fa-chart-bar"></i>
                <span class="mx-4">Reports</span>
            </a>

            <a href="#" class="flex items-center px-4 py-3 {{ request()->routeIs('settings*') ? 'bg-gray-700 rounded-lg' : 'hover:bg-gray-700 rounded-lg' }}">
                <i class="fa-solid fa-user-tie"></i>
                <span class="mx-4">Customer</span>
            </a>

            <a href="/supplier" class="flex items-center px-4 py-3 {{ request()->routeIs('supplier*') ? 'bg-gray-700 rounded-lg' : 'hover:bg-gray-700 rounded-lg' }}">
                <i class="fa-solid fa-user-tie"></i>
                <span class="mx-4">Supplier</span>
            </a>

            <div class="border-t border-gray-700 mt-6 pt-4">
                <a href="#" class="flex items-center px-4 py-3 {{ request()->routeIs('settings*') ? 'bg-gray-700 rounded-lg' : 'hover:bg-gray-700 rounded-lg' }}">
                    <i class="fa-solid fa-user-tie"></i>
                    <span class="mx-4">Profile</span>
                </a>

                <a href="#" class="flex items-center px-4 py-3 {{ request()->routeIs('settings*') ? 'bg-gray-700 rounded-lg' : 'hover:bg-gray-700 rounded-lg' }}">
                    <i class="fas fa-cog"></i>
                    <span class="mx-4">Settings</span>
                </a>

                <form action="#" method="POST">
                    @csrf
                    <button type="submit" class="flex items-center px-4 py-3 mt-2 w-full text-left hover:bg-gray-700 rounded-lg text-red-400 hover:text-red-300">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="mx-4">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
</aside>
