<div class="mb-4">
    <label for="{{ $id }}" class="block text-gray-700 font-semibold mb-2">{{ $name }}</label>
    <div class="relative">
        <div class="flex items-center border border-gray-300 rounded-md">
            <div class="relative flex-1">
                <div class="relative w-full">
                    <input type="text" id="{{ $id }}" 
                        class="w-full border-none rounded-l-md pl-3 pr-8 py-2 focus:outline-none" 
                        placeholder="{{ $placeholder }}" autocomplete="off">
                    <input type="hidden" name="satuan" id="satuan_value">
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                        <i class="fa-solid fa-chevron-down text-gray-400"></i>
                    </div>
                    <div id="satuan_dropdown" class="hidden absolute top-full left-0 w-full bg-white border border-gray-300 rounded-md mt-1 shadow-lg max-h-40 overflow-y-auto z-50">
                        @foreach ($satuan as $item)
                            <div class="satuan-option px-3 py-2 hover:bg-gray-100 cursor-pointer" data-value="{{ $item->id }}" data-name="{{ $item->nama }}">
                                {{ $item->nama }}
                            </div>
                        @endforeach
                        <div id="no_results" class="hidden px-3 py-2 text-gray-500">
                            No results found
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" id="add_satuan" 
                class="inline-flex items-center justify-center w-10 h-[38px] border-l border-gray-300 cursor-pointer bg-gray-50 hover:bg-gray-100 rounded-r-md text-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
                <i class="fa-solid fa-plus"></i>
            </button>
        </div>
        
        <div id="satuan_results" 
            class="absolute z-10 w-full bg-white border border-gray-300 rounded-md mt-1 shadow-lg max-h-48 overflow-y-auto hidden">
        </div>
    </div>
</div>