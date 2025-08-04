<nav class="bg-white shadow-lg w-full">
    <div class="mx-auto px-6 py-3">
        <div class="flex items-center justify-between py-1">
            <div class="flex items-center">
                <button id="sidebar-toggle" class="text-gray-500 focus:outline-none lg:hidden">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <div class="ml-4">
                    <x-breadcrumb-component :links="$breadcrumb" />
                </div>
            </div>
        </div>
    </div>
</nav>
