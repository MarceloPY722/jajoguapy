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
        case 'mastercard':
            isValid = /^5[1-5]\d{14}$/.test(cardNumber);
            break;
        case 'visa':
            isValid = /^4\d{12}(\d{3})?$/.test(cardNumber);
            break;
        case 'discover':
            isValid = /^(6011|622|64[4-9]|65)\d{12}$/.test(cardNumber);
            break;
        case 'amex':
            isValid = /^3[47]\d{13}$/.test(cardNumber);
            break;
        default:
            isValid = false;
    }

    cardNumberInput.setCustomValidity(isValid ? '' : 'Número de tarjeta inválido');
}

function validateCVV() {
    const cvv = document.getElementById('cvv').value;
    const cvvInput = document.getElementById('cvv');
    const isValid = /^\d{3,4}$/.test(cvv);

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