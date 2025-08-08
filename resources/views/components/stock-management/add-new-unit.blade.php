<div id="add_new_template" class="col-span-3 grid grid-cols-3 gap-4">
    <div class="mb-4">
        <label for="satuan_1_search" class="block text-gray-700 font-semibold-mb-2">Satuan 1</label>
        <div class="relative">
            <div class="flex items-center border border-gray-300 rounded-md">
                <div class="relative flex-1">
                    <div class="relative w-full">
                        <input type="text" id="satuan_1_search" 
                            class="w-full border-none rounded-l-md pl-3 pr-8 py-2 focus:outline-none"
                            placeholder="Cari atau buat satuan unit..." autocomplete="off">
                        <input type="hidden" name="satuan_1_name" id="satuan_1_value">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                            <i class="fa-solid fa-chevron-down text-gray-400"></i>
                        </div>
                        <div class="template-option px-3 py-2 hover:bg-gray-100 cursor pointer" data-value="template_nama" data-name="template_nama">
                        <div id="template_dropdown" class="hidden absolute top-full left-0 w-full bg-white border border-gray-300 rounded-md mt-1 shadow-lg max-h-40 overflow-y-auto z-50">
                            <div id="no_template_results" class="hidden px-3 py-2 text-gray-500">No results found</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>