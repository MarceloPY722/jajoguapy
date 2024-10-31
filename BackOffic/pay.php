<?php
// Incluir archivos necesarios
include './include/head.php';
include './include/cnx.php';
include './include/menu.php';

// Inicializar variables
$total = 0;
$products = [];

// Verificar si se recibió información del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el total y los productos del formulario
    $total = $_POST['total'];
    $products = json_decode($_POST['products'], true); // Decodificar el JSON a un array
} else {
    // Redirigir si no se accede por POST
    header("Location: shopping-cart.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/tailwindcss-colors.css">
    <link rel="stylesheet" href="./css/pay.css">
    <title>Página de Pago</title>
</head>
<body>
<section class="payment-section">
    <div class="container">
        <div class="payment-right">
            <form action="process_payment.php" method="POST" class="payment-form">
                <h1 class="payment-title">Detalles del Pago</h1>
                
                <!-- Mostrar el monto total de la compra -->
                <div class="payment-total">
                    <h6>Monto total: ₲ <span id="payment-amount"><?= htmlspecialchars($total) ?></span></h6>
                </div>
                
                <div class="payment-method">
                    <input type="radio" name="payment-method" id="method-1" checked>
                    <label for="method-1" class="payment-method-item">
                        <img src="./img/pay/visa.png" alt="">
                    </label>
                    <input type="radio" name="payment-method" id="method-2">
                    <label for="method-2" class="payment-method-item">
                        <img src="./img/pay/mastercard.png" alt="">
                    </label>
                    <input type="radio" name="payment-method" id="method-3">
                    <label for="method-3" class="payment-method-item">
                        <img src="./img/pay/QR.png" alt="">
                    </label>
                    <input type="radio" name="payment-method" id="method-4">
                    <label for="method-4" class="payment-method-item">
                        <img src="./img/pay/Bancard.png" alt="">
                    </label>
                </div>

                <div class="payment-form-group">
                    <input type="email" name="email" placeholder=" " class="payment-form-control" id="email" required>
                    <label for="email" class="payment-form-label payment-form-label-required">Email Address</label>
                </div>
                <div class="payment-form-group">
                    <input type="text" name="card-number" placeholder=" " class="payment-form-control" id="card-number" required>
                    <label for="card-number" class="payment-form-label payment-form-label-required">Número de Tarjeta</label>
                </div>
                <div class="payment-form-group-flex">
                    <div class="payment-form-group">
                        <input type="month" name="expiry-date" placeholder=" " class="payment-form-control" id="expiry-date" required>
                        <label for="expiry-date" class="payment-form-label payment-form-label-required">Fecha de Vencimiento</label>
                    </div>
                    <div class="payment-form-group">
                        <input type="text" name="cvv" placeholder=" " class="payment-form-control" id="cvv" required>
                        <label for="cvv" class="payment-form-label payment-form-label-required">CVV</label>
                    </div>
                </div>

                <!-- Agregar datos del total y productos como campos ocultos -->
                <input type="hidden" name="total" value="<?= htmlspecialchars($total) ?>">
                <input type="hidden" name="products" value='<?= htmlspecialchars(json_encode($products)) ?>'>

                <button type="submit" class="payment-form-submit-button"><i class="ri-wallet-line"></i> Pagar</button>
            </form>
        </div>
    </div>
</section>

</body>
</html>
