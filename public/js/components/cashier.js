document.addEventListener('keydown', function(e) {
    if (e.key === '/' && !['INPUT', 'TEXTAREA'].includes(document.activeElement.tagName)) {
        e.preventDefault();
        document.getElementById('search-produk-input').focus();
    }
});

const API_URL = 'http://127.0.0.1:8000/api';

$(document).ready(function () {
    $(document).on('click', '.card-product', function () {
        const productId = $(this).attr('data-product-id');
        if (!productId) return;
        // console.log('click card-product: ', productId);
        showProductDetail(productId);
    });

    window.cashierCart = {
        items: [],
    };

    $(document).on('click', '#clear-cart-btn', function() {
        window.cashierCart.items = [];
        renderCart();
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
        $('.remove-later').remove();
    
        const detailsContainer = modal.querySelector('.space-y-4');
    
        const stockTitle = document.createElement('h3');
        stockTitle.className = 'text-lg font-semibold mt-6 text-gray-500';
        stockTitle.textContent = 'Stok Produk: ';
        detailsContainer.appendChild(stockTitle);
    
        const stockContent = document.createElement('div');
        stockContent.className = 'flex flex-wrap gap-2 mt-4'; 
        check.forEach(detail => {
            const safeUnitId = detail.id;
            let stockItem = document.createElement('div');
            stockItem.className = 'flex justify-between w-full bg-white py-2 px-4 rounded-lg border border-gray-200 shadow-sm';
            stockItem.innerHTML = `
                <div class="flex flex-col">
                    <div class="text-sm text-gray-500">${detail.nama_satuan}</div>
                    <div class="text-lg font-bold text-gray-800 kuantitas-${safeUnitId}">${detail.kuantitas}</div>
                </div>
                <div class="flex justify-center items-center">
                    <span class="text-gray-500 selected-value-${safeUnitId}" data-value="0"></span>
                </div>
                <div class="flex gap-2">
                    <button class="h-full bg-gray-200 text-gray-500 px-4 py-2 rounded-lg cursor-pointer substract-item" data-unit-id="${safeUnitId}" data-unit-name="${detail.nama_satuan}" data-price="${detail.harga_jual}" data-product-id="${id}">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button class="h-full bg-gray-200 text-gray-500 px-4 py-2 rounded-lg cursor-pointer add-item" data-unit-id="${safeUnitId}" data-unit-name="${detail.nama_satuan}" data-price="${detail.harga_jual}" data-product-id="${id}">
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

    const escHandler = (e) => {
        if (e.key === 'Escape') {
            overlay.remove();
            document.removeEventListener('keydown', escHandler);
        }
    };
    document.addEventListener('keydown', escHandler);

    $(document).off('click.cashierAdd').on('click.cashierAdd', '.add-item', function() {
        const unitId = $(this).data('unit-id');
        const unitName = $(this).data('unit-name');
        const selectedValue = $(`.selected-value-${unitId}`);
        const kuantitas = $(`.kuantitas-${unitId}`);
        const currentSelected = parseInt(selectedValue.attr('data-value') ?? 0);
        const currentStock = parseInt(kuantitas.text() ?? 0);
        if (currentStock <= 0) return; // cap by stock
        selectedValue.text(`${currentSelected + 1} ${unitName} dipilih`);
        selectedValue.attr('data-value', currentSelected + 1);
        kuantitas.text(currentStock - 1);
    });

    $(document).off('click.cashierSub').on('click.cashierSub', '.substract-item', function() {
        const unitId = $(this).data('unit-id');
        const unitName = $(this).data('unit-name');
        const selectedValue = $(`.selected-value-${unitId}`);
        const kuantitas = $(`.kuantitas-${unitId}`);
        const currentSelected = parseInt(selectedValue.attr('data-value') ?? 0);
        const currentStock = parseInt(kuantitas.text() ?? 0);
        if (currentSelected > 0) {
            selectedValue.text(`${currentSelected - 1} ${unitName} dipilih`);
            selectedValue.attr('data-value', currentSelected - 1);
            kuantitas.text(currentStock + 1);
        } else {
            selectedValue.text(`${currentSelected} ${unitName} dipilih`);
            selectedValue.attr('data-value', currentSelected);
        }
    });

    $(document).off('click.cashierSubmit').on('click.cashierSubmit', '.submit-button', function() {
        // Collect selections
        const productCard = document.getElementById(`produk-card-${id}`);
        const productNameEl = document.querySelector(`#nama-produk-${id}`);
        const productName = productCard ? productCard.querySelector('h3')?.textContent?.trim() : (productNameEl?.textContent?.trim() || 'Produk');
        const productImage = document.getElementById(`produk-image-${id}`);
        const imageUrl = productImage ? productImage.src : '';

        const selections = [];
        check.forEach(detail => {
            const unitId = detail.id;
            const unitName = detail.nama_satuan;
            const selectedValue = document.querySelector(`.selected-value-${unitId}`);
            if (!selectedValue) return;
            const qty = parseInt(selectedValue.getAttribute('data-value') || '0');
            if (qty > 0) {
                const price = parseInt(String(detail.harga_jual));
                selections.push({ unitId, unitName, qty, price });
            }
        });

        if (selections.length === 0) {
            overlay.remove();
            document.removeEventListener('keydown', escHandler);
            return;
        }

        // Merge into cart by productId+unitId
        selections.forEach(sel => {
            const existingIndex = window.cashierCart.items.findIndex(it => it.productId == id && it.unitId == sel.unitId);
            if (existingIndex >= 0) {
                window.cashierCart.items[existingIndex].quantity += sel.qty;
            } else {
                window.cashierCart.items.push({
                    productId: parseInt(id),
                    productName: productName,
                    unitId: sel.unitId,
                    unitName: sel.unitName,
                    price: sel.price,
                    quantity: sel.qty,
                    imageUrl: imageUrl
                });
            }
        });

        renderCart();

        overlay.remove();
        document.removeEventListener('keydown', escHandler);
    });
}

async function getDetailProduct(id)
{
    try {
        const response = await fetch(`${API_URL}/detail-produk/${id}`, {
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

// Utils
function renderCart() {
    const container = document.getElementById('cart-items');
    if (!container) return;
    container.innerHTML = '';

    const items = (window.cashierCart?.items) || [];
    let subtotal = 0;
    // Render each cart row
    items.forEach(item => {
        subtotal += (item.price * item.quantity);
        const row = document.createElement('div');
        row.className = 'group bg-gray-50 hover:bg-white rounded-xl p-3 flex items-center space-x-3 transition-all duration-300 hover:shadow-md border border-gray-100';
        row.innerHTML = `
            <div class="relative">
                <img src="${item.imageUrl}" alt="${escapeHtml(item.productName)}" class="w-14 h-14 rounded-lg object-cover shadow-sm">
            </div>
            <div class="flex-1">
                <h4 class="font-medium text-gray-900">${escapeHtml(item.productName)} <span class="text-xs text-gray-500">(${escapeHtml(item.unitName)})</span></h4>
                <div class="flex items-center justify-between mt-1">
                    <p class="text-blue-600 font-bold">${formatRupiah(item.price * item.quantity)}</p>
                    <div class="flex items-center space-x-2">
                        <button class="w-7 h-7 bg-white hover:bg-gray-100 rounded-lg flex items-center justify-center transition-colors border border-gray-200 hover:border-gray-300 cart-dec" data-product-id="${item.productId}" data-unit-id="${item.unitId}">
                            <i class="fas fa-minus text-xs text-gray-600"></i>
                        </button>
                        <span class="w-8 text-center font-medium">${item.quantity}</span>
                        <button class="w-7 h-7 bg-white hover:bg-gray-100 rounded-lg flex items-center justify-center transition-colors border border-gray-200 hover:border-gray-300 cart-inc" data-product-id="${item.productId}" data-unit-id="${item.unitId}">
                            <i class="fas fa-plus text-xs text-gray-600"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        container.appendChild(row);
    });

    // Update header count (rows count as per user preference)
    const countEl = document.getElementById('cart-item-count');
    if (countEl) {
        countEl.textContent = `${items.length} items in cart`;
    }

    // Update subtotal and total (total = subtotal for now)
    const subtotalEl = document.getElementById('cart-subtotal-amount');
    const totalEl = document.getElementById('cart-total-amount');
    if (subtotalEl) subtotalEl.textContent = formatRupiah(subtotal);
    if (totalEl) totalEl.textContent = formatRupiah(subtotal);
}

// Cart increment/decrement (delegated once)
$(document).off('click.cartInc').on('click.cartInc', '.cart-inc', function() {
    const pid = parseInt($(this).data('product-id'));
    const uid = parseInt($(this).data('unit-id'));
    const idx = window.cashierCart.items.findIndex(it => it.productId === pid && it.unitId === uid);
    if (idx >= 0) {
        window.cashierCart.items[idx].quantity += 1;
        renderCart();
    }
});

$(document).off('click.cartDec').on('click.cartDec', '.cart-dec', function() {
    const pid = parseInt($(this).data('product-id'));
    const uid = parseInt($(this).data('unit-id'));
    const idx = window.cashierCart.items.findIndex(it => it.productId === pid && it.unitId === uid);
    if (idx >= 0) {
        window.cashierCart.items[idx].quantity = Math.max(0, window.cashierCart.items[idx].quantity - 1);
        if (window.cashierCart.items[idx].quantity === 0) {
            window.cashierCart.items.splice(idx, 1);
        }
        renderCart();
    }
});

// Payment and other actions
$(document)
  .off('click.processPayment')
  .on('click.processPayment', '#process-payment-btn', function() {
    //   console.log('Process Payment clicked. Cart items:', (window.cashierCart?.items)||[]);
      processPayment(window.cashierCart?.items);
  })
  .off('click.hold')
  .on('click.hold', '#hold-btn', function() {
      console.log('Hold clicked. Cart items:', (window.cashierCart?.items)||[]);
  })
  .off('click.receipt')
  .on('click.receipt', '#receipt-btn', function() {
      console.log('Receipt clicked. Cart items:', (window.cashierCart?.items)||[]);
  })
  .off('click.share')
  .on('click.share', '#share-btn', function() {
      console.log('Share clicked. Cart items:', (window.cashierCart?.items)||[]);
  });

function formatRupiah(number) {
    try {
        const num = parseInt(String(number));
        return 'Rp ' + num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    } catch {
        return 'Rp 0';
    }
}

function escapeHtml(text) {
    const map = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;' };
    return String(text).replace(/[&<>"']/g, m => map[m]);
}

function processPayment(items)
{
    if (items.length === 0) {
        Swal.fire({
            title: 'No items in cart',
            text: 'Please add items to the cart',
            icon: 'warning',
            button: 'OK',
        });

        return;
    } else {
        Swal.fire({
            title: 'Confirmation',
            text: 'Are you sure you want to checkout?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: true,
        }).then(result => {
            if (result.isConfirmed) {
                fetch(`${API_URL}/checkout`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ items }),
                }).then(response => response.json())
                .then(data => {
                    console.log(data);
                })
                .catch(error => {
                    console.error('Error', error);
                });
            }
        });
    }

}