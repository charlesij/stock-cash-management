@extends('dashboard.layout.main')

@section('content')
<div class="mx-auto px-4 sm:px-6 lg:px-8">    
    <div class="flex space-between mb-4">
        <h2 class="text-lg font-semibold text-gray-900 title-table">Supplier List</h2>
        <div class="flex ml-auto">
            <a href="{{ route('supplier.create') }}" 
            class="mx-1 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-blue-700 transition">
                <i class="fas fa-plus mr-2"></i> Create
            </a>
            <form action="{{ route('supplier.edit') }}" method="POST" id="edit-form">
                @csrf
                <button id="edit-button" type="submit" class="hidden mx-1 items-center px-4 py-2 bg-lime-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-green-700 transition cursor-pointer">
                    <i class="fas fa-edit mr-2"></i> Edit
                </button>
            </form>
            <form action="{{ route('supplier.delete') }}" method="POST" id="delete-form">
                @csrf
                <button id="delete-button" type="submit" class="hidden mx-1 items-center px-4 py-2 bg-rose-600 border border-transparent rounded-md font-semibold text-sm text-white hover:bg-red-700 transition cursor-pointer">
                    <i class="fas fa-trash mr-2"></i> Delete
                </button>
            </form>
        </div>
    </div>

    <div class="bg-white shadow rounded-xl overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-gray-700 text-gray-100 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3 text-left">
                            <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-blue-600 shadow-sm h-5 w-5 transition duration-150 ease-in-out cursor-pointer">
                        </th>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Address</th>
                        <th class="px-6 py-3 text-left">Debt</th>
                        <th class="px-6 py-3 text-left">Contact Number</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @if ($data->count() > 0)
                        @foreach ($data as $index => $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-4 text-gray-500">
                                    <input type="checkbox" value="{{ $item->id }}" class="rounded border-gray-300 text-blue-600 shadow-sm h-5 w-5 transition duration-150 ease-in-out cursor-pointer checkbox-target">
                                </td>
                                <td class="px-6 py-4 text-gray-500">{{ $item->nama }}</td>
                                <td class="px-6 py-4 text-gray-500 max-w-[200px] truncate">{{ $item->alamat }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $item->hutang == 0 ? '-' : 'Rp. ' . number_format($item->hutang, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $item->no_telp }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-gray-500 text-center">No data found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
                {{ $data->links() }}
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#selectAll').click(function() {
            $('.checkbox-target').prop('checked', $(this).prop('checked'));
            if ($('.checkbox-target:checked').length > 0) {
                $('#edit-button').removeClass('hidden').addClass('inline-flex');
                $('#delete-button').removeClass('hidden').addClass('inline-flex');
            } else {
                $('#edit-button').addClass('hidden').removeClass('inline-flex'); 
                $('#delete-button').addClass('hidden').removeClass('inline-flex');
            }
        });
        $('.checkbox-target').click(function() {
            if ($('.checkbox-target:checked').length > 0) {
                $('#edit-button').removeClass('hidden').addClass('inline-flex');
                $('#delete-button').removeClass('hidden').addClass('inline-flex');
            } else {
                $('#edit-button').addClass('hidden').removeClass('inline-flex'); 
                $('#delete-button').addClass('hidden').removeClass('inline-flex');
            }

            if ($('.checkbox-target').length === $('.checkbox-target:checked').length) {
                $('#selectAll').prop('checked', true);
            } else {
                $('#selectAll').prop('checked', false);
            }
        });

        // Handle edit form submission
        $('#edit-form').on('submit', function(e) {
            e.preventDefault();
            
            // Get all selected supplier IDs
            var selectedIds = [];
            $('.checkbox-target:checked').each(function() {
                selectedIds.push($(this).val());
            });

            // Add the selected IDs to the form
            if (selectedIds.length > 0) {
                // Remove any existing hidden inputs
                $(this).find('input[name="ids[]"]').remove();
                
                // Add new hidden inputs for each selected ID
                selectedIds.forEach(function(id) {
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'ids[]',
                        value: id
                    }).appendTo('#edit-form');
                });

                // Submit the form
                this.submit();
            }
        });

        // Handle delete form submission
        $('#delete-form').on('submit', function(e) {
            e.preventDefault();
            
            if (!confirm('Are you sure you want to delete the selected suppliers?')) {
                return false;
            }

            // Get all selected supplier IDs
            var selectedIds = [];
            $('.checkbox-target:checked').each(function() {
                selectedIds.push($(this).val());
            });

            // Add the selected IDs to the form
            if (selectedIds.length > 0) {
                // Remove any existing hidden inputs
                $(this).find('input[name="ids[]"]').remove();
                
                // Add new hidden inputs for each selected ID
                selectedIds.forEach(function(id) {
                    $('<input>').attr({
                        type: 'hidden',
                        name: 'ids[]',
                        value: id
                    }).appendTo('#delete-form');
                });

                // Submit the form
                this.submit();
            }
        });

    });
</script>

@endsection
