<div class="border-b border-gray-200">
    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
        <a href="{{ route('transaction.index') }}" class="{{ request()->routeIs('transaction.index') ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
            Rangkuman
        </a>
        <a href="{{ route('transaction.cashflow') }}" class="{{ request()->routeIs('transaction.cashflow') ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
            Cashflow
        </a>
        <a href="{{ route('transaction.debt') }}" class="{{ request()->routeIs('transaction.debt') ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
            Hutang
        </a>
        <a href="{{ route('transaction.income') }}" class="{{ request()->routeIs('transaction.income') ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
            Pendapatan
        </a>
        <a href="{{ route('transaction.expenses') }}" class="{{ request()->routeIs('transaction.expenses') ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
            Pengeluaran
        </a>
        <a href="{{ route('transaction.history') }}" class="{{ request()->routeIs('transaction.history') ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
            Riwayat
        </a>
    </nav>
</div>