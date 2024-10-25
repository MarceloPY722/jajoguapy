$(document).ready(function() {
    function updateTotal() {
        let total = 0;
        $('.cart-item').each(function() {
            const price = parseFloat($(this).data('price'));
            const quantity = parseInt($(this).find('.quantity-input').val());
            const itemTotal = price * quantity;
            $(this).find('.item-total').text(itemTotal.toLocaleString('es-PY'));
            total += itemTotal;
        });
        $('#cart-total').text(total.toLocaleString('es-PY'));
    }

    $('.quantity-input').on('input', updateTotal);

    // Initial calculation
    updateTotal();
});