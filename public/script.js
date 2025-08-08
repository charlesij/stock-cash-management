$(document).ready(() => {
    $('.number-format').on('input', function() {
        let value = $(this).val().replace(/[^\d]/g, '');
        
        if (value !== '') {
            value = parseInt(value);
            value = value.toLocaleString('id-ID');
        }
        
        $(this).val(value);
    });
});