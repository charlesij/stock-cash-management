class CustomSearchInput {
    constructor(options) {
        this.id = options.id;
        this.name = options.name;
        this.placeholder = options.placeholder;
        this.addButton = options.addButton;
        this.initElements();
        this.initEventListeners();
    }

    initElements() {
        this.searchInput = document.getElementById(`${this.id}_search`);
        
        this.hiddenInput = document.getElementById(`${this.id}_value`);
        
        this.dropdown = document.getElementById(`${this.id}_dropdown`);
        
        this.noResults = this.dropdown?.querySelector(`#no_${this.id}_results`);
        
        this.addButtonEl = document.getElementById(`add_${this.id}`);
        
        this.modal = document.getElementById(`add_${this.id}_modal`);
        
        this.cancelButton = document.getElementById(`cancel_add_${this.id}`);
        
        this.saveButton = document.getElementById(`save_new_${this.id}`);
        
        this.options = this.dropdown?.querySelectorAll(`.${this.id}-option`);
        
        if (!this.searchInput || !this.dropdown) {
            console.error(`Required elements not found for ${this.id}`);
            return;
        }
    }

    initEventListeners() {
        
        if (this.searchInput) {
            this.searchInput.addEventListener('focus', () => {
                this.showDropdown();
            });
            
            this.searchInput.addEventListener('click', () => {
                this.showDropdown();
            });
            
            this.searchInput.addEventListener('input', (e) => {
                this.filterOptions(e.target.value);
            });
            
            this.searchInput.addEventListener('blur', () => {
                this.handleBlur();
            });
        }

        // Options Events
        if (this.options) {
            this.options.forEach(option => {
                option.addEventListener('click', () => {
                    this.selectOption(option);
                });
            });
        }

        // Dropdown Events
        if (this.dropdown) {
            this.dropdown.addEventListener('mouseleave', () => {
                this.handleDropdownMouseLeave();
            });
        }

        // Add Button Events
        if (this.addButton && this.addButtonEl) {
            this.addButtonEl.addEventListener('click', () => {
                this.showModal();
            });
        }

        // Modal Events
        if (this.modal) {
            this.modal.addEventListener('click', (e) => {
                this.handleModalClick(e);
            });
            
            this.cancelButton?.addEventListener('click', () => {
                this.hideModal();
            });
            
            this.saveButton?.addEventListener('click', () => {
                this.handleSave();
            });
        }

        // Document click event for closing dropdown
        document.addEventListener('click', (e) => {
            this.handleDocumentClick(e);
        });
    }

    showDropdown() {
        if (this.dropdown) {
            this.dropdown.classList.remove('hidden');
            this.filterOptions(this.searchInput.value);
        }
    }

    hideDropdown() {
        if (this.dropdown) {
            this.dropdown.classList.add('hidden');
        }
    }

    filterOptions(query) {
        query = query.toLowerCase();
        let hasResults = false;

        if (this.options) {
            this.options.forEach(option => {
                const text = option.textContent.toLowerCase();
                if (text.includes(query)) {
                    option.classList.remove('hidden');
                    hasResults = true;
                } else {
                    option.classList.add('hidden');
                }
            });
        }

        if (this.noResults) {
            this.noResults.classList.toggle('hidden', hasResults);
        }
    }

    handleBlur() {
        setTimeout(() => {
            if (this.dropdown && !this.dropdown.matches(':hover')) {
                this.hideDropdown();
            }
        }, 200);
    }

    selectOption(option) {
        const value = option.dataset.value;
        const name = option.dataset.name;
        
        if (this.searchInput && this.hiddenInput) {
            this.searchInput.value = name;
            this.hiddenInput.value = value;
            this.hideDropdown();
        }
    }

    handleDropdownMouseLeave() {
        if (this.searchInput && !this.searchInput.matches(':focus')) {
            this.hideDropdown();
        }
    }

    showModal() {
        if (this.modal) {
            this.modal.classList.remove('hidden');
            const newNameInput = document.getElementById(`new_${this.id}_name`);
            if (newNameInput) {
                newNameInput.value = this.searchInput.value;
                newNameInput.focus();
            }
        }
    }

    hideModal() {
        if (this.modal) {
            this.modal.classList.add('hidden');
            const newNameInput = document.getElementById(`new_${this.id}_name`);
            if (newNameInput) {
                newNameInput.value = '';
            }
        }
    }

    handleModalClick(e) {
        
        if (e.target === this.modal.children[0]) {
            this.hideModal();
        }
    }

    handleDocumentClick(e) {
        if (!e.target.closest('.relative')) {
            this.hideDropdown();
        }
    }
}