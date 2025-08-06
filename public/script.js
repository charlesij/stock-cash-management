$(document).ready(function() {
    // Unit Select Functionality
    if ($('#satuan_search').length > 0) {
        const searchInput = $('#satuan_search');
        const unitSelect = $('#satuan');
        const addButton = $('#add_satuan');
        const modal = $('#add_unit_modal');
        const cancelButton = $('#cancel_add_unit');
        const saveButton = $('#save_new_unit');

        const dropdown = $('#satuan_dropdown');
        const noResults = $('#no_results');
        const hiddenInput = $('#satuan_value');

        function filterOptions(query) {
            query = query.toLowerCase();
            let hasResults = false;
            
            $('.satuan-option').each(function() {
                const text = $(this).text().toLowerCase();
                if (text.includes(query)) {
                    $(this).removeClass('hidden');
                    hasResults = true;
                } else {
                    $(this).addClass('hidden');
                }
            });

            if (hasResults) {
                noResults.addClass('hidden');
            } else {
                noResults.removeClass('hidden');
            }
        }

        searchInput.on('focus click', function() {
            dropdown.removeClass('hidden');
            filterOptions($(this).val());
        });

        searchInput.on('input', function() {
            filterOptions($(this).val());
        });

        searchInput.on('blur', function() {
            setTimeout(() => {
                if (!dropdown.is(':hover')) {
                    dropdown.addClass('hidden');
                }
            }, 200);
        });

        $('.satuan-option').on('click', function() {
            const value = $(this).data('value');
            const name = $(this).data('name');
            
            searchInput.val(name);
            hiddenInput.val(value);
            dropdown.addClass('hidden');
        });

        dropdown.on('mouseleave', function() {
            if (!searchInput.is(':focus')) {
                dropdown.addClass('hidden');
            }
        });

        // Handle add button click
        addButton.on('click', function() {
            modal.removeClass('hidden');
            $('#new_unit_name').val(searchInput.val()).focus();
        });

        // Handle modal close
        cancelButton.on('click', function() {
            modal.addClass('hidden');
            $('#new_unit_name').val('');
        });

        // Handle save new unit
        saveButton.on('click', function() {
            const name = $('#new_unit_name').val().trim();
            if (name) {
                modal.addClass('hidden');
                $('#new_unit_name').val('');
            }
        });

        // Close modal when clicking outside
        modal.on('click', function(e) {
            if ($(e.target).is(modal)) {
                modal.addClass('hidden');
            }
        });

        // Close select when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.relative').length) {
                unitSelect.removeClass('block').addClass('hidden');
            }
        });
    }
    if ($('.table-action-button').length > 0) {
        $('.table-action-button').click(function() {
            // Get the menu element
            const menu = $(this).siblings('.table-action-menu');
            
            // Calculate position relative to button
            const buttonPos = $(this).offset();
            const buttonHeight = $(this).outerHeight();
            const buttonWidth = $(this).outerWidth();
            const windowWidth = $(window).width();
            
            // Update menu position
            menu.css({
                'top': buttonPos.top + buttonHeight + 8, // 8px margin
                'right': windowWidth - (buttonPos.left + buttonWidth)
            });

            // Show this menu and hide others
            $('.table-action-menu').not(menu).addClass('hidden');
            menu.toggleClass('hidden');

            // Close menu when clicking outside
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.table-action-button').length) {
                    $('.table-action-menu').remove();
                }
            });
        });
    }
});