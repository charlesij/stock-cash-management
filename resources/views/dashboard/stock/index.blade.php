@extends('dashboard.layout.main')

@section('content')
<div class="mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-2">
        <h1 class="text-2xl font-semibold text-gray-900">Transaction - Overview</h1>
    </div>
    
    <x-transaction.tab-nav />

    <div class="mt-6">
        <div class="bg-white shadow-sm rounded-lg p-6">
            <p class="text-gray-500">Transaction overview content will be displayed here.</p>
        </div>
    </div>
</div>
@endsection