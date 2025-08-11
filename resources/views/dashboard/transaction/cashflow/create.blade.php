@extends('dashboard.layout.main')
@section('content')
{{-- @dd($saldoKas) --}}
<div class="flex-1 px-6 bg-gray-100 relative">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-900">Kelola Cash</h1>
    </div>

    <div class="bg-white shadow rounded-xl p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Tambah Kas</h2>
        <form action="{{ route('transaction.cashflow.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-4">
        
                <div class="mb-4">
                    <label for="modal_awal" class="block text-gray-700 font-semibold mb-2">Tambah Modal/Kas (Rp)</label>
                    <input type="text" name="modal" id="modal" value="{{ old('modal') }}" placeholder="Input Modal"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600 number-format"
                        required>
                </div>
        
                <div class="mb-6">
                    <label for="keterangan" class="block text-gray-700 font-semibold mb-2">Keterangan Tambahan</label>
                    <input type="text" name="keterangan" id="keterangan" value="{{ old('keterangan') }}"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                    placeholder="Input Keterangan Tambahan"
                    required>
                    @error('no_telp')
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
                    Tambah Kas
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white shadow rounded-xl p-6 mb-6">

        <h2 class="text-lg font-semibold text-gray-900 mb-4">Ubah Saldo Kas</h2>
        <form action="{{ route('transaction.cashflow.update') }}" method="POST">
            @method('PUT')
            @csrf
            <div class="grid grid-cols-2 gap-4">
        
                <div class="mb-4">
                    <label for="current_cash" class="block text-gray-700 font-semibold mb-2">Saldo saat ini (Rp)</label>
                    <input type="text" name="current_cash" id="current_cash" value="{{ empty($current_cash) ? 0 : number_format($current_cash->cash, 0, ',', '.') }}" placeholder="Saldo saat ini"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 number-format bg-gray-100 cursor-not-allowed"
                        disabled
                        >
                </div>
        
                <div class="mb-4">
                    <label for="cash_in" class="block text-gray-700 font-semibold mb-2">Ubah Saldo (Rp)</label>
                    <input type="text" name="cash_in" id="cash_in" value="{{ old('cash_in') ?? 0 }}" placeholder="Ubah Saldo Kas"
                        class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600 number-format"
                        required>
                </div>
        
                <div class="mb-6 col-span-2">
                    <label for="keterangan" class="block text-gray-700 font-semibold mb-2">Keterangan Pengubahan Saldo<span class="text-red-500">*</span></label>
                    <textarea name="keterangan" id="keterangan" cols="30" rows="3"
                    class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-600"
                    placeholder="Input Keterangan Pengubahan Saldo"
                    required>{{ old('keterangan') }}</textarea>
                </div>
                
            </div>
            <div class="flex justify-end">
                <a href="{{ route('supplier.index') }}" 
                    class="inline-flex items-center px-4 py-2 mr-3 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-100 transition ">
                    Cancel
                </a>
                <button type="submit" 
                    class="inline-flex items-center px-4 py-2 bg-amber-600 border border-transparent rounded-md font-semibold text-white hover:bg-amber-700 transition cursor-pointer">
                    Ubah Kas
                </button>
            </div>
        </form>
    </div>
</div>
<script>
$(document).ready(() => {
    $('.number-format').on('input', function() {
        let value = $(this).val().replace(/[^\d]/g, '');
        
        if (value !== '') {
            value = parseInt(value);
            value = value.toLocaleString('id-ID');
        }
        
        $(this).val(value);
    });
});
</script>
@endsection