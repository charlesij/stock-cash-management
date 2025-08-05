<aside class="bg-gray-800 text-white w-64 h-screen flex-shrink-0 transition-transform duration-300 transform lg:translate-x-0 lg:relative fixed z-30 overflow-y-auto hidden sm:hidden md:hidden lg:block" id="sidebar">
    <div class="flex items-center justify-between h-16 shadow-lg px-4">
        <h2 class="text-2xl font-bold"><i class="fa-solid fa-cubes"></i> StockCash</h2>
        <button class="lg:hidden text-gray-300 hover:text-white focus:outline-none" id="sidebar-close">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>

    <nav class="mt-6">
        <div class="px-4">
            {{-- <a href="{{ route('dashboard.index') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('dashboard.index') ? 'bg-gray-700 rounded-lg' : 'hover:bg-gray-700 rounded-lg' }}">
                <i class="fas fa-home"></i>
                <span class="mx-4">Dashboard</span>
            </a> --}}

            <x-sidebar-item.single route="dashboard.index" title="Dashboard" icon="fas fa-home"/>
            <x-sidebar-item.single route="stocks" title="Stock Management" icon="fas fa-box"/>

            {{-- <div class="mt-2">
                <button class="flex items-center px-4 py-3 w-full hover:bg-gray-700 rounded-lg" onclick="toggleSubmenu('exampleSubmenu')">
                    <i class="fas fa-folder"></i>
                    <span class="mx-4">Example Menu</span>
                    <i class="fas fa-chevron-down ml-auto"></i>
                </button>
                <div id="exampleSubmenu" class="hidden pl-4">
                    <a href="#" class="flex items-center px-4 py-3 mt-1 hover:bg-gray-700 rounded-lg">
                        <i class="fas fa-circle text-xs"></i>
                        <span class="mx-4">Example Item 1</span>
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 mt-1 hover:bg-gray-700 rounded-lg">
                        <i class="fas fa-circle text-xs"></i>
                        <span class="mx-4">Example Item 2</span>
                    </a>
                </div>
            </div> --}}

            <x-sidebar-item.single route="transaction.index" title="Transactions" icon="fas fa-exchange-alt"/>

            {{-- <a href="{{ route('transaction.index') }}" class="flex items-center px-4 py-3 mt-2 {{ request()->routeIs('transaction.index*') ? 'bg-gray-700 rounded-lg' : 'hover:bg-gray-700 rounded-lg' }}">
                <i class="fas fa-exchange-alt"></i>
                <span class="mx-4">Transactions</span>
            </a> --}}

            <a href="{{ route('reports') }}" class="flex items-center px-4 py-3 mt-2 {{ request()->routeIs('reports*') ? 'bg-gray-700 rounded-lg' : 'hover:bg-gray-700 rounded-lg' }}">
                <i class="fas fa-chart-bar"></i>
                <span class="mx-4">Reports</span>
            </a>

            <div class="border-t border-gray-700 mt-6 pt-4">
                <a href="{{ route('profile') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('profile*') ? 'bg-gray-700 rounded-lg' : 'hover:bg-gray-700 rounded-lg' }}">
                    <i class="fa-solid fa-user-tie"></i>
                    <span class="mx-4">Profile</span>
                </a>

                <a href="{{ route('settings') }}" class="flex items-center px-4 py-3 {{ request()->routeIs('settings*') ? 'bg-gray-700 rounded-lg' : 'hover:bg-gray-700 rounded-lg' }}">
                    <i class="fas fa-cog"></i>
                    <span class="mx-4">Settings</span>
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="cursor-pointer flex items-center px-4 py-3 w-full text-left hover:bg-gray-700 rounded-lg text-red-400 hover:text-red-300">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="mx-4">Logout</span>
                    </button>
                </form>
            </div>
        </div>
    </nav>
</aside>
