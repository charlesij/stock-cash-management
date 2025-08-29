@extends('dashboard.layout.main')
@section('content')
<div class="mx-auto px-4 sm:px-2 lg:px-8">
	<x-stock-management.tab-nav />
	<div class="mt-4">
		<h2 class="text-2xl font-semibold text-gray-900">{{ !$withSatuan ? 'Detail Satuan dan Harga Jual Produk' : 'Pengaturan harga jual: ' . $produk->nama }}</h2>

		<ul class="mt-2 flex flex-col border-b border-gray-200">
			@if (!$withSatuan)
				@foreach ($produk as $index => $item)
					<li class="flex border-t border-gray-200 capitalize text-lg hover:bg-gray-50 hover:text-blue-500 hover:font-semibold cursor-pointer">
						<a href="{{ route('stock.product.details', ['ppd' => 'p-'.$item->id]) }}" class="py-4 px-2 flex-1">{{ ($index + 1).'). ' . $item->nama }}</a>
					</li>
				@endforeach
			@else
				@foreach ($produk->produkDetail as $index => $item)
					<li class="flex border-t border-gray-200 capitalize text-lg hover:bg-gray-50 hover:text-blue-500 hover:font-semibold cursor-pointer">
						<a href="{{ route('stock.product.details', ['ppd' => 'p-'.$produk->id.'-d-'.$item->id]) }}" class="flex justify-between py-4 px-2 flex-1">
							<div><span class="{{ $item->kuantitas < 5 ? 'text-red-500' : 'text-gray-800' }} font-semibold">{{ $item->kuantitas . ' ' . $item->nama_satuan }}</span> @ Rp.{{ $item->harga_jual }}</div>
							<span class="bg-indigo-400 rounded-md px-2 mr-4 text-gray-100 hover:bg-indigo-500 font-normal">
								Edit
							</span>
						</a>
					</li>
				@endforeach
			@endif
		</ul>
	</div>
</div>

@endsection