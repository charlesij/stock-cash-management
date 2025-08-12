document.addEventListener('keydown', function(e) {
    if (e.key === '/' && !['INPUT', 'TEXTAREA'].includes(document.activeElement.tagName)) {
        e.preventDefault();
        document.getElementById('search-produk-input').focus();
    }
});

$(document).ready(function () {
    $('.card-product').click(function () {
        showProductDetail($(this).attr('data-target'));
    });
});

async function showProductDetail(id) {
    // Create overlay elements
    const overlay = document.createElement('div');
    overlay.className = 'fixed inset-0 bg-black/30 z-50 flex items-center justify-center';
    
    const modalPaddingStyle = document.createElement('div');
    modalPaddingStyle.className = 'p-2 rounded-2xl bg-gray-300/50 w-full max-w-xl';

    const modal = document.createElement('div');
    modal.className = 'bg-white rounded-xl p-6 max-w-2xl w-full relative';
    
    // Add close button
    const closeBtn = document.createElement('button');
    closeBtn.className = 'absolute top-2 right-2 text-gray-400 hover:text-gray-600 transition-colors z-20 cursor-pointer';
    closeBtn.innerHTML = '<i class="fas fa-times text-xl"></i>';
    closeBtn.onclick = () => overlay.remove();

    // Add content container
    const produkImage = document.getElementById(`produk-image-${id}`);
    const content = document.createElement('div');
    content.className = 'space-y-4';
    content.innerHTML = `
        <div class="">
            <div class="h-64 flex items-center justify-center w-full bg-gray-200 rounded-xl mb-4">
                <div class="h-full aspect-square relative">
                    <img src="${produkImage.src}" alt="" class="object-cover w-full h-full rounded-xl">
                </div>
            </div>

            <div class="animate-pulse w-full h-4 bg-gray-200 rounded w-3/4 remove-later" >

            </div>

            <div class="animate-pulse w-full h-4 bg-gray-200 rounded w-1/2 mt-2 remove-later">

            </div>

            
        </div>
    `;

    
    // Assemble modal
    modal.appendChild(closeBtn);
    modal.appendChild(content);
    overlay.appendChild(modalPaddingStyle);
    modalPaddingStyle.appendChild(modal);
    
    // Add to body
    document.body.appendChild(overlay);
    
    // Close on background click
    overlay.addEventListener('click', (e) => {
        if (e.target === overlay) {
            overlay.remove();
        }
    });

    let check = await getDetailProduct(id);

    if (check) {
        console.log(check);
        $('.remove-later').remove();
    
        const detailsContainer = modal.querySelector('.space-y-4');
    
        const stockTitle = document.createElement('h3');
        stockTitle.className = 'text-lg font-semibold mt-6 text-gray-500';
        stockTitle.textContent = 'Stok Produk: ';
        detailsContainer.appendChild(stockTitle);
    
        const stockContent = document.createElement('div');
        stockContent.className = 'flex flex-wrap gap-2 mt-4'; 
        check.forEach(detail => {
            let stockItem = document.createElement('div');
            stockItem.className = 'flex justify-between w-full bg-white py-2 px-4 rounded-lg border border-gray-200 shadow-sm';
            stockItem.innerHTML = `
                <div class="flex flex-col">
                    <div class="text-sm text-gray-500">${detail.nama_satuan}</div>
                    <div class="text-lg font-bold text-gray-800 kuantitas-${detail.nama_satuan}">${detail.kuantitas}</div>
                </div>
                <div class="flex justify-center items-center">
                    <span class="text-gray-500 selected-value-${detail.nama_satuan}-${detail.id}" data-value="0"></span>
                </div>
                <div class="flex gap-2">
                    <button class="h-full bg-gray-200 text-gray-500 px-4 py-2 rounded-lg cursor-pointer substract-item" data-satuan="${detail.nama_satuan}">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button class="h-full bg-gray-200 text-gray-500 px-4 py-2 rounded-lg cursor-pointer add-item" data-satuan="${detail.nama_satuan}">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            `;
            stockContent.appendChild(stockItem);
        });
    
        detailsContainer.appendChild(stockContent);

        const submitButtonContainer = document.createElement('div');
        submitButtonContainer.className = 'flex justify-end w-full py-2 px-4';
        submitButtonContainer.innerHTML = `
            <button class="shadow-md text-gray-800 p-2 bg-blue-500 rounded-md cursor-pointer submit-button">
                <span class="text-white">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text-white">
                    Submit
                </span>
            </button>
        `;
        detailsContainer.appendChild(submitButtonContainer);
    }

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            overlay.remove();
        }
    });

    $(document).on('click', '.add-item', function() {
        const satuan = $(this).data('satuan');
        const selectedValue = $(`.selected-value-${satuan}-${id}`);
        const currentValue = parseInt(selectedValue.attr('data-value') ?? 0);
        selectedValue.text(`${currentValue + 1} ${satuan} dipilih`);
        selectedValue.attr('data-value', currentValue + 1);

        const kuantitas = $(`.kuantitas-${satuan}`);
        const currentKuantitas = parseInt(kuantitas.text() ?? 0);
        if (currentKuantitas > 0) {
            kuantitas.text(currentKuantitas - 1);
        }
    });

    $(document).on('click', '.substract-item', function() {
        const satuan = $(this).data('satuan');
        const selectedValue = $(`.selected-value-${satuan}-${id}`);   
        const currentValue = parseInt(selectedValue.attr('data-value') ?? 0);
        if (currentValue > 0) { 
            selectedValue.text(`${currentValue - 1} ${satuan} dipilih`);
            selectedValue.attr('data-value', currentValue - 1);
        } else {
            selectedValue.text(`${currentValue} ${satuan} dipilih`);
            selectedValue.attr('data-value', currentValue);
        }

        const kuantitas = $(`.kuantitas-${satuan}`);
        const currentKuantitas = parseInt(kuantitas.text() ?? 0);
        if (currentKuantitas > 0) {
            kuantitas.text(currentKuantitas + 1);
        }
    });

    $(document).on('click', '.submit-button', function() {
        const selectedValue = $(`.selected-value-${id}`);
        const currentValue = parseInt(selectedValue.attr('data-value') ?? 0);
        console.log(currentValue);
    });
}

async function getDetailProduct(id)
{
    try {
        const response = await fetch(`http://127.0.0.1:8000/api/detail-produk/${id}`, {
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            method: 'GET',
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();

        if (data.status === 'success') {
            return data.detail_product;
        } else {
            throw new Error('Gagal mendapatkan detail produk');
        }
    } catch (error) {
        console.error('Error', error);
        return null;
    }
}