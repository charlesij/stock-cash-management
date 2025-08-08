@extends('dashboard.layout.main')

@section('content')
<div class="flex-1 px-6 bg-gray-100 relative">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Add Supplier</h1>
    </div>
    <form action="{{ route('supplier.store') }}" method="POST" class="bg-white shadow rounded-xl p-6">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <div class="mb-4">
                <label for="nama" class="block text-gray-700 font-semibold mb-2">Supplier Name</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" placeholder="Input Supplier Name"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                    required>
                @error('nama')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="no_telp" class="block text-gray-700 font-semibold mb-2">Contact Number</label>
                <input type="text" name="no_telp" id="no_telp" value="{{ old('no_telp') }}"
                class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                placeholder="Input Phone number"
                required>
                @error('no_telp')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4 col-span-2">
                <label for="alamat" class="block text-gray-700 font-semibold mb-2">Address</label>
                <textarea name="alamat" id="alamat" rows="3"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                    placeholder="Input Supplier Address"
                    required>{{ old('alamat') }}</textarea>
                @error('alamat')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>
        <div class="flex justify-end">
            <a href="{{ route('supplier.index') }}" 
                class="inline-flex items-center px-4 py-2 mr-3 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100 transition">
                Cancel
            </a>
            <button type="submit" 
                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 transition cursor-pointer">
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
