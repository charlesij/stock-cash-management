<aside class="bg-gray-800 text-white w-64 h-screen flex-shrink-0 transition-transform duration-300 transform lg:translate-x-0 lg:relative fixed z-30 overflow-y-auto hidden sm:hidden md:hidden lg:block" id="sidebar">
    <div class="flex items-center justify-between h-16 shadow-lg px-4">
        <h2 class="text-2xl font-bold"><i class="fa-solid fa-cubes"></i> StockCash</h2>
        <button class="lg:hidden text-gray-300 hover:text-white focus:outline-none" id="sidebar-close">
            <i class="fas fa-times text-xl"></i>
        </button>
    </div>

    <nav class="mt-6">
        <div class="px-4">

            <x-sidebar-item.single route="dashboard.index" title="Dashboard" icon="fas fa-home"/>
            <x-sidebar-item.single route="stocks.index" title="Stock Management" icon="fas fa-box"/>
            <x-sidebar-item.single route="transaction.index" title="Transactions" icon="fas fa-exchange-alt"/>
            <x-sidebar-item.single route="reports.index" title="Reports" icon="fas fa-chart-bar"/>
            <x-sidebar-item.single route="customer.index" title="Customer" icon="fas fa-user-tag"/>
            <x-sidebar-item.single route="supplier.index" title="Supplier" icon="fas fa-regular fa-briefcase"/>

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


            <div class="border-t border-gray-700 mt-6 pt-4">
                
            <x-sidebar-item.single route="profile.index" title="Profile" icon="fas fa-user-tie"/>    
            <x-sidebar-item.single route="settings.index" title="Settings" icon="fas fa-cog"/>

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
