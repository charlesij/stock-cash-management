@php
    $routeObject = Route::getRoutes()->getByName($route);
    // dd($routeObject);
    $routePath = $routeObject->uri;
    $routeSegments = explode('/', $routePath);
    $parentPath = implode('/', array_slice($routeSegments, 0, count($routeSegments)));
    $childrenRoutePath = $parentPath . '/*';

    // dd($parentPath, $childrenRoutePath);
    // dd($route, $childrenRoutePath, Route::is($route), Route::is($childrenRoutePath));
    $active = Route::is($route) || request()->is($childrenRoutePath) ? 'bg-gray-700 rounded-lg' : 'hover:bg-gray-700 rounded-lg';
@endphp

{{-- @dd($childrenRoutePath) --}}
{{-- @dd(request()->routeIs($childrenRoutePath), $childrenRoutePath) --}}
<div>
    <a href="{{ route($route) }}" class="flex items-center px-4 py-3 mt-2 {{ $active }}">
        <i class="{{ $icon }}"></i>
        <span class="mx-4">{{ $title }}</span>
    </a>
</div>