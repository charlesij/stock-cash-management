<nav class="flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <li class="inline-flex items-center">
            <a href="{{ route('dashboard.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                <i class="fas fa-home mr-2"></i>
                Home
            </a>
        </li>

        @foreach($links as $index => $link)
            <li>
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2 text-sm"></i>
                    @if(!$loop->last)
                        <a href="{{ $link['url'] }}" class="text-sm font-medium text-gray-700 hover:text-blue-600">
                            {{ $link['name'] }}
                        </a>
                    @else
                        <span class="text-sm font-medium text-gray-500">
                            {{ $link['name'] }}
                        </span>
                    @endif
                </div>
            </li>
        @endforeach
    </ol>
</nav>