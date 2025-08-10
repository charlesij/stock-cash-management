<div class="mb-4">
    <label for="{{ $id }}_search" class="block text-gray-700 font-semibold mb-2">{{ $name }}</label>
    <div class="relative">
        <div class="flex items-center border border-gray-300 rounded-md">
            <div class="relative flex-1">
                <div class="relative w-full">
                    <input type="text" id="{{ $id }}_search" 
                        class="w-full border-none rounded-l-md pl-3 pr-8 py-2 focus:outline-none" 
                        placeholder="{{ $placeholder }}" autocomplete="off">
                    <input type="hidden" name="{{ $name }}" id="{{ $id }}_value">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                        <i class="fa-solid fa-chevron-down text-gray-400"></i>
                    </div>
                    <div id="{{ $id }}_dropdown" class="hidden absolute top-full left-0 w-full bg-white border border-gray-300 rounded-md mt-1 shadow-lg max-h-40 overflow-y-auto z-50">

                        {{ $slot }}
                        
                        <div id="no_{{ $id }}_results" class="hidden px-3 py-2 text-gray-500">
                            No results found
                        </div>
                    </div>
                </div>
            </div>
            @if ($addButton)
                <button type="button" id="add_{{ $id }}" 
                    class="inline-flex items-center justify-center w-10 h-[38px] border-l border-gray-300 cursor-pointer bg-gray-50 hover:bg-gray-100 rounded-r-md text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <i class="fa-solid fa-plus"></i>
                </button>
            @endif
        </div>
        
        <div id="{{ $id }}_results" 
            class="absolute z-10 w-full bg-white border border-gray-300 rounded-md mt-1 shadow-lg max-h-48 overflow-y-auto hidden">
        </div>
    </div>

    @if ($addButton)
    <div id="add_{{ $id }}_modal" class="fixed inset-0 bg-black/30 backdrop-blur-sm z-50 hidden">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="p-2 rounded-xl bg-gray-300/50 w-full max-w-md">
                <div class="bg-white py-4 px-6 rounded-lg shadow-md">
                    <div class="pb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Tambah {{ $name }}</h3>
                    </div>
                    
                    <form id="add_{{ $id }}_form" action="{{ route($formActionName) }}" method="POST">
                        @if ($formActionMethod === 'POST')
                            @csrf
                        @else
                            @method($formActionMethod)
                            @csrf
                        @endif

                        {{ $modal }}
        
                        <div class="bg-gray-50 rounded-b-lg flex justify-end space-x-2">
                            <button type="button" id="cancel_add_{{ $id }}"
                                class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-600">
                                Cancel
                            </button>
                            <button type="submit" id="save_new_{{ $id }}"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        new CustomSearchInput({
            id: '{{ $id }}',
            name: '{{ $name }}',
            placeholder: '{{ $placeholder }}',
            addButton: {{ $addButton ? 'true' : 'false' }}
        });
    });
</script>
