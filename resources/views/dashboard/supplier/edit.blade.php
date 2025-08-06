@extends('dashboard.layout.main')

@section('content')
<div class="flex-1 px-6 bg-gray-100 relative">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Suppliers</h1>
    </div>

    {{-- @dd($data) --}}
    <form action="{{ route('supplier.update') }}" method="POST" class="bg-white shadow rounded-xl p-6">
        @method('PUT')
        @csrf

        <div class="grid grid-cols-2 gap-4">
            @foreach ($data as $index => $item)
            <input type="hidden" name="id[{{ $index }}]" value="{{ $item->id }}">
            <div class="col-span border bg-indigo-50 border-indigo-200 shadow-sm rounded-md p-4" data-index="{{ $index }}">
                <div class="mb-4">
                    <label for="nama" class="block text-gray-700 font-semibold mb-2">Supplier Name [{{ $index + 1 }}]</label>
                    <input type="text" name="nama[{{ $index }}]" id="nama-{{ $index }}" value="{{ $item->nama }}"
                        class="bg-white w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                        required>
                </div>
        
                <div class="mb-4">
                    <label for="alamat" class="block text-gray-700 font-semibold mb-2">Address [{{ $index + 1 }}]</label>
                    <textarea name="alamat[{{ $index }}]" id="alamat-{{ $index }}" rows="3"
                        class="bg-white w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                        required>{{ $item->alamat }}</textarea>
                </div>
        
                <div class="mb-6">
                    <label for="no_telp" class="block text-gray-700 font-semibold mb-2">Contact Number [{{ $index + 1 }}]</label>
                    <input type="text" name="no_telp[{{ $index }}]" id="no_telp-{{ $index }}" value="{{ $item->no_telp }}"
                        class="bg-white w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                        required>
                </div>
            </div>
            @endforeach
        </div>

        <div class="flex justify-end mt-6">
            <a href="{{ route('supplier.index') }}" 
                class="inline-flex items-center px-4 py-2 mr-3 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100 transition">
                Cancel
            </a>
            <button type="submit" 
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 transition cursor-pointer">
                Save
            </button>
        </div>
    </form>

@endsection