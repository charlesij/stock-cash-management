<div class="border-b border-gray-200">
    <nav class="-mt-4 flex space-x-8" aria-label="Tabs">
        <a href="{{ route('stocks.index') }}" class="{{ request()->routeIs('stocks.index') ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
            Inventory
        </a>
        <a href="{{ route('stocks.settings') }}" class="{{ request()->routeIs('stocks.settings') ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
            Settings
        </a>
        <a href="{{ route('stocks.history') }}" class="{{ request()->routeIs('stocks.history') ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
            History
        </a>
    </nav>
</div>