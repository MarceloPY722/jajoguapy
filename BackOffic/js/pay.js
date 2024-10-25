
    document.getElementById('payment-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        var cardNumber = document.getElementById('card-number').value;
        var expiryDate = document.getElementById('expiry-date').value;
        var cvc = document.getElementById('cvc').value;
        
        // Validación del número de tarjeta
        var visaRegex = /^4[0-9]{15}$/;
        var mastercardRegex = /^5[1-5][0-9]{14}$/;
        var amexRegex = /^3[47][0-9]{13}$/;
        
        if (!visaRegex.test(cardNumber) && !mastercardRegex.test(cardNumber) && !amexRegex.test(cardNumber)) {
            alert('Por favor, ingrese un número de tarjeta válido (Visa, MasterCard o American Express).');
            return;
        }

        // Validación de la fecha de vencimiento
        if (!/^\d{4}$/.test(expiryDate)) {
            alert('La fecha de vencimiento debe tener 4 dígitos (MMYY).');
            return;
        }
        
        var month = parseInt(expiryDate.substring(0, 2));
        if (month < 1 || month > 12) {
            alert('Por favor, ingrese un mes válido (MM en el rango 01-12).');
            return;
        }

        // Validación del CVC
        if (!/^\d{3}$/.test(cvc)) {
            alert('El CVC debe tener 3 dígitos.');
            return;
        }

        // Si todas las validaciones pasan, puedes procesar el pago o redirigir
        // Aquí iría la lógica para procesar el pago
       
        // Redirigir a la página de confirmación o procesar el pedido
        window.location.href = '/jajoguapyv2/BackOffic/transaccion.php';
    });