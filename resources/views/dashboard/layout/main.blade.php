<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stock Cash Management</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 flex">
    <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm z-20 hidden opacity-0 transition-all duration-300 ease-in-out" id="sidebar-overlay"></div>

    @include('dashboard.partials.sidebar')

    <div class="h-screen overflow-auto flex-1 flex flex-col">
        <div class="sticky top-0 z-10 bg-white">
            @include('dashboard.partials.navbar')
        </div>

        <main class="flex-1 bg-gray-100 relative">
            <div class="py-6">
                @yield('content')
            </div>
        </main>

        @include('dashboard.partials.footer')
    </div>

    @vite('resources/js/app.js')
    <script src="{{ asset('script.js') }}"></script>
    <script src="{{ asset('js/components/custom-search-input.js') }}"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success',
                text: '{{ session('success') }}',
                icon: 'success'
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                title: 'Error',
                text: '{{ session('error') }}',
                icon: 'error'
            });
        </script>
    @endif
</body>
</html>