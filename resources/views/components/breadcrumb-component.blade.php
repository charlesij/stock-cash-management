@props(['breadcrumbs' => [
    [
        'title' => 'Dashboard',
        'url' => route('dashboard'),
        'active' => request()->routeIs('dashboard')
    ]
]])

<nav class="flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                <i class="fas fa-home mr-2"></i>
                Home
            </a>
        </li>

        @foreach($breadcrumbs as $breadcrumb)
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2 text-sm"></i>
                    @if(!$loop->last)
                        <a href="{{ $breadcrumb['url'] }}" class="text-sm font-medium text-gray-700 hover:text-blue-600">
                            {{ $breadcrumb['title'] }}
                        </a>
                    @else
                        <span class="text-sm font-medium text-gray-500">
                            {{ $breadcrumb['title'] }}
                        </span>
                    @endif
                </div>
            </li>
        @endforeach
    </ol>
</nav>

{{-- Example Usage in Views:
<x-breadcrumb-component :breadcrumbs="[
    [
        'title' => 'Dashboard',
        'url' => route('dashboard'),
        'active' => false
    ],
    [
        'title' => 'Stock Management',
        'url' => route('stocks'),
        'active' => false
    ],
    [
        'title' => 'Add New Item',
        'url' => '#',
        'active' => true
    ]
]" />

Or for Transactions:
<x-breadcrumb-component :breadcrumbs="[
    [
        'title' => 'Dashboard',
        'url' => route('dashboard'),
        'active' => false
    ],
    [
        'title' => 'Transactions',
        'url' => route('transactions'),
        'active' => false
    ],
    [
        'title' => 'Transaction Details #123',
        'url' => '#',
        'active' => true
    ]
]" />

Or for Settings:
<x-breadcrumb-component :breadcrumbs="[
    [
        'title' => 'Dashboard',
        'url' => route('dashboard'),
        'active' => false
    ],
    [
        'title' => 'Settings',
        'url' => route('settings'),
        'active' => false
    ],
    [
        'title' => 'User Profile',
        'url' => '#',
        'active' => true
    ]
]" />
--}}