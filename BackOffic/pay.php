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
$paymentMethod = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $total = $_POST['total'];
    $products = json_decode($_POST['products'], true); 
    $paymentMethod = isset($_POST['paymentMethod']) ? $_POST['paymentMethod'] : '';
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
            <div class="payment-left">
                <form id="shipping-form" class="payment-form" action="./cargando.php" method="POST">
                    <h1 class="payment-title">Detalles de Envío</h1>
                    <div class="payment-form-group">
                        <input type="text" name="direccion" placeholder=" " class="payment-form-control" id="direccion" required>
                        <label for="direccion" class="payment-form-label payment-form-label-required">Dirección</label>
                    </div>
                    <div class="payment-form-group">
                        <select name="ciudad" class="payment-form-control" id="ciudad" required>
                            <option value="">Selecciona un Departamento</option>
                            <?php while ($ciudad = $ciudades->fetch()): ?>
                                <option value="<?= $ciudad['id'] ?>"><?= $ciudad['nombre'] ?></option>
                            <?php endwhile; ?>
                        </select>
                        <label for="ciudad" class="payment-form-label payment-form-label-required">Departamento</label>
                    </div>
                    <div class="payment-form-group">
                        <input type="text" name="ciudad_nombre" placeholder=" " class="payment-form-control" id="ciudad_nombre" required>
                        <label for="ciudad_nombre" class="payment-form-label payment-form-label-required">Ciudad</label>
                    </div>
                    <div class="payment-form-group">
                        <input type="text" name="telefono" placeholder=" " class="payment-form-control" id="telefono" required>
                        <label for="telefono" class="payment-form-label payment-form-label-required">Teléfono de Contacto</label>
                    </div>
                    
                    <div class="payment-form-group">
                        <textarea name="datos_adicionales" placeholder=" " class="payment-form-control" id="datos_adicionales"></textarea>
                        <label for="datos_adicionales" class="payment-form-label">Datos Adicionales</label>
                    </div>

                    <!-- Botón para mostrar/ocultar la tabla de productos -->
                    <button type="button" class="payment-toggle-button" onclick="toggleProductsTable()">
                        <i class="entypo entypo-circled-info"></i> Ver Productos Seleccionados
                    </button>

                    <!-- Tabla de productos (inicialmente oculta) -->
                    <div class="payment-products" id="products-table" style="display: none;">
                        <h1 class="payment-title">Productos Seleccionados</h1>
                        <table class="payment-products-table">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($product['name']) ?></td>
                                        <td><?= htmlspecialchars($product['quantity']) ?></td>
                                        <td>₲ <?= htmlspecialchars($product['price']) ?></td>
                                        <td>₲ <?= htmlspecialchars($product['price'] * $product['quantity']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right">Total:</td>
                                    <td>₲ <?= htmlspecialchars($total) ?></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <input type="hidden" name="usuario_id" value="<?= $_SESSION['id'] ?>">
                </form>
            </div>

            <!-- Formulario de Pago -->
            <div class="payment-right">
                <form id="payment-form" action="./cargando.php" method="POST" class="payment-form">
                    <h1 class="payment-title">Detalles del Pago</h1>
                    <div class="payment-total">
                        <h6>Monto total: ₲ <span id="payment-amount"><?= htmlspecialchars($total) ?></span></h6>
                    </div>
                    
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
                        <input type="text" name="card-number" placeholder=" " class="payment-form-control" id="card-number" required oninput="validateCardNumber()">
                        <label for="card-number" class="payment-form-label payment-form-label-required">Número de Tarjeta</label>
                    </div>
                    <div class="payment-form-group-flex">
                        <div class="payment-form-group">
                            <input type="month" name="expiry-date" placeholder=" " class="payment-form-control" id="expiry-date" required>
                            <label for="expiry-date" class="payment-form-label payment-form-label-required">Fecha de Vencimiento</label>
                        </div>
                        <div class="payment-form-group">
                            <input type="text" name="cvv" placeholder=" " class="payment-form-control" id="cvv" required oninput="validateCVV()">
                            <label for="cvv" class="payment-form-label payment-form-label-required">CVV</label>
                        </div>
                    </div>

                    <input type="hidden" name="total" value="<?= htmlspecialchars($total) ?>">
                    <input type="hidden" name="products" value='<?= htmlspecialchars(json_encode($products)) ?>'>
                    <input type="hidden" name="paymentMethod" id="paymentMethod" value="<?= htmlspecialchars($paymentMethod) ?>">
                    <button type="button" class="payment-form-submit-button" onclick="validateForms()"><i class="ri-wallet-line"></i> Pagar</button>
                </form>
            </div>
        </div>
    </div>
</section>
<script src="./js/validacion.js"></script>
<script>
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
            case 'mastercard':
                isValid = /^5[1-5]\d{14}$/.test(cardNumber);
                break;
            case 'visa':
                isValid = /^4\d{12}(\d{3})?$/.test(cardNumber); // Ajuste para Visa 13 o 16 dígitos
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
        let isValid = false;

        switch(cardType) {
            case 'mastercard':
            case 'visa':
            case 'discover':
                isValid = /^\d{3}$/.test(cvv);
                break;
            case 'amex':
                isValid = /^\d{4}$/.test(cvv);
                break;
            default:
                isValid = false;
        }

        cvvInput.setCustomValidity(isValid ? '' : 'CVV inválido');
    }

    function validateForms() {
        const shippingForm = document.getElementById('shipping-form');
        const paymentForm = document.getElementById('payment-form');

        if (shippingForm.checkValidity() && paymentForm.checkValidity()) {
            paymentForm.submit();
        } else {
            shippingForm.reportValidity();
            paymentForm.reportValidity();
        }
    }

    function toggleProductsTable() {
        var table = document.getElementById("products-table");
        if (table.style.display === "none") {
            table.style.display = "block";
        } else {
            table.style.display = "none";
        }
    }
</script>
</body>
</html>