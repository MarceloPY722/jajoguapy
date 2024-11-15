<?php
// Incluir archivos necesarios
include './include/head.php';
include './include/cnx.php';
include './include/menu.php';

// Verificar si la sesión ya está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$total = 0;
$products = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $total = filter_input(INPUT_POST, 'total', FILTER_VALIDATE_FLOAT);
    $products = json_decode(filter_input(INPUT_POST, 'products', FILTER_SANITIZE_FULL_SPECIAL_CHARS), true);

    // Verificar que los datos se estén recibiendo correctamente
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";
} else {
    header("Location: shopping-details.php");
    exit();
}

// Obtener la lista de ciudades
$ciudades = $bd->query("SELECT * FROM ciudades");
?>
<link rel="stylesheet" href="./css/tailwindcss-colors.css">
<link rel="stylesheet" href="./css/pay.css">

<section class="payment-section">
    <div class="container">
        <div class="payment-wrapper">
            <!-- Formulario de Pago -->
            <div class="payment-right">
                <form id="payment-form" action="./cargando.php" method="POST" class="payment-form">
                    <h1 class="payment-title">Detalles del Pago</h1>
                    <div class="payment-total">
                        <h6>Monto total: ₲ <span id="payment-amount"><?= htmlspecialchars($total) ?></span></h6>
                    </div>
                    
                    <!-- Opciones de método de pago con imágenes -->
                    <div class="payment-method">
                        <input type="radio" name="payment-method" id="method-1" onclick="setCardType('visa')" checked>
                        <label for="method-1" class="payment-method-item">
                            <img src="./img/pay/visa.png" alt="" id="visa-image">
                        </label>
                        <input type="radio" name="payment-method" id="method-2" onclick="setCardType('mastercard')">
                        <label for="method-2" class="payment-method-item">
                            <img src="./img/pay/mastercard.png" alt="" id="mastercard-image">
                        </label>
                        <input type="radio" name="payment-method" id="method-3" onclick="setCardType('discover')">
                        <label for="method-3" class="payment-method-item">
                            <img src="./img/pay/Discover.png" alt="" id="discover-image">
                        </label>
                        <input type="radio" name="payment-method" id="method-4" onclick="setCardType('amex')">
                        <label for="method-4" class="payment-method-item">
                            <img src="./img/pay/American.png" alt="" id="american-image">
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

                    <!-- Campos ocultos para enviar datos a cargando.php -->
                    <input type="hidden" name="total" value="<?= htmlspecialchars($total) ?>">
                    <input type="hidden" name="products" value='<?= htmlspecialchars(json_encode($products)) ?>'>
                    <button type="submit" class="payment-form-submit-button"><i class="ri-wallet-line"></i> Pagar</button>
                </form>
            </div>
        </div>
    </div>
</section>
<script>
function setCardType(type) {
    cardType = type;
}
</script>