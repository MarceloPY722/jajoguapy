let cardType = '';

function setCardType(type) {
    cardType = type;
    validateCardNumber();
    validateCVV();
}

function validateCardNumber() {
    const cardNumber = document.getElementById('card-number').value;
    const cardNumberInput = document.getElementById('card-number');
    let isValid = false;

    switch(cardType) {
        case 'method-1': // Visa
            isValid = /^4[0-9]{15}$/.test(cardNumber);
            break;
        case 'method-2': // Mastercard
            isValid = /^5[1-5][0-9]{14}$/.test(cardNumber);
            break;
        case 'method-3': // Discover
            isValid = /^(6011|622|64[4-9]|65)[0-9]{12}$/.test(cardNumber);
            break;
        case 'method-4': // American Express
            isValid = /^3[47][0-9]{13}$/.test(cardNumber);
            break;
        default:
            isValid = false;
    }

    cardNumberInput.setCustomValidity(isValid ? '' : 'Número de tarjeta inválido');
}

function validateCVV() {
    const cvv = document.getElementById('cvv').value;
    const cvvInput = document.getElementById('cvv');
    let isValid = false;

    switch(cardType) {
        case 'method-1': // Visa
        case 'method-2': // Mastercard
        case 'method-3': // Discover
            isValid = /^\d{3}$/.test(cvv);
            break;
        case 'method-4': // American Express
            isValid = /^\d{4}$/.test(cvv);
            break;
        default:
            isValid = false;
    }

    cvvInput.setCustomValidity(isValid ? '' : 'CVV inválido');
}

function validateForms() {
    const paymentForm = document.getElementById('payment-form');

    if (paymentForm.checkValidity()) {
        paymentForm.submit();
    } else {
        paymentForm.reportValidity();
    }
}