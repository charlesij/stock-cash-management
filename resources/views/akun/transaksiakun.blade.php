@extends('dashboard.layout.main')

@section('content')
<div class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">{{ $title }}</h1>
    </div>
    
    <div class="flex justify-end mb-4">
        <a href="{{ route('supplier.create') }}" 
        class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-blue-700 transition">
            <i class="fas fa-plus mr-2"></i> Create
        </a>
    </div> --}}

    <div class="flex justify-between mb-4">
        <div>
            <p class="text-sm text-gray-500">Akun</p>
            <h1 class="text-xl font-semibold text-blue-800">Daftar Akun</h1>
        </div>
    </div>

    <div class="bg-white shadow rounded-xl overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left w-[10%]">Tanggal</th>
                        <th class="px-6 py-3 text-left w-[60%]">Kontak</th>
                        <th class="px-6 py-3 text-left w-[20%]">Deskripsi</th>
                        <th class="px-6 py-3 text-left w-[20%]">Terima</th>
                        <th class="px-6 py-3 text-left w-[20%]">Kirim</th>
                        <th class="px-6 py-3 text-right w-[15%]">Saldo</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach ($data as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-1 text-gray-500">{{ date('d-m-Y', strtotime($item->tanggal)) }}</td>
                            <td class="px-6 py-1 text-gray-500"><a href="{{ route('akun.transaksiakun', $item->id) }}" class="text-blue-500">{{ $item->nama }}</a></td>
                            <td class="px-6 py-1 text-gray-500"><a href="{{ route('akun.transaksiakun', $item->id) }}" class="text-blue-500">{{ $item->akun->nama }}</a></td>
                            <td class="px-6 py-1 text-gray-500 text-right">Rp 0</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4 p-6">
                {{ $data->links() }}
            </div>
        </div>
    </div>

    <!-- Quick Access Buttons -->
    
</div>


@endsection
