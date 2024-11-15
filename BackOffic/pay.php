<?php
include './include/head.php';
include './include/cnx.php';
include './include/menu.php';

$total = 0;
$products = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $total = $_POST['total'];
    $products = json_decode($_POST['products'], true); 
} else {
    header("Location: shop-details.php");
    exit();
}

$idu = $_SESSION['id'];
$date = date("Y-m-d");
if (isset($_POST['sub'])) {
    foreach ($products as $product) {
        $id = $product['id'];
        $Q = $product['quantity'];
        $req = $bd->query("SELECT p.*, c.descuentos FROM productos p JOIN categorias c ON p.categoria_id = c.id WHERE p.id = $id");
        $data = $req->fetch();
        if ($Q > $data['cantidad_stock']) {
            echo "<script>alert('Este Producto no está disponible por stock');</script>";
        } else {
            $bd->beginTransaction();
            $qr = $bd->prepare("INSERT INTO pedidos(fecha, usuario_id) VALUES(?, ?)");
            $qr->execute([$date, $idu]);
            $pedido_id = $bd->lastInsertId();
            $qr = $bd->prepare("INSERT INTO Ventas(producto_id, pedido_id, cantidad) VALUES(?, ?, ?)");
            $qr->execute([$id, $pedido_id, $Q]);
            $bd->commit();
        }
    }
    header('location: factura.php');
}
?>
    <title>Detalles del Pago</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/tailwindcss-colors.css">
    <link rel="stylesheet" href="./css/pay.css">
    <style>
        
        .loading-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #000;
            z-index: 9999;
            justify-content: center;
            align-items: center;
            transition: background-color 1s ease;
       }
   
        .loading-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            opacity: 1;
            transition: opacity 0.5s ease;
        }

        .loading-text {
            font-size: 24px;
            margin-bottom: 16px;
            color: white;
            transition: color 1s ease;
        }

        .loading-spinner {
            width: 40px;
            height: 40px;
            border: 5px solid #fff;
            border-top-color: transparent;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        .success-message {
            font-size: 48px;
            color: #00b300;
            margin-top: 32px;
            display: flex;
            align-items: center;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .success-message svg {
            width: 48px;
            height: 48px;
            margin-right: 16px;
        }

        .show-success {
            opacity: 1;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .loading-text.hide,
        .loading-spinner.hide {
            opacity: 0;
            transition: opacity 0.5s ease;
        }
    </style>
</head>
<body>
    <div class="loading-overlay">
        <div class="loading-container">
            <div class="loading-text">Procesando Pago...</div>
            <div class="loading-spinner"></div>
            <div class="success-message">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2ZM10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z" fill="#00b300"/>
                </svg>
                Pago Exitoso!!
            </div>
        </div>
    </div>

    <section class="payment-section">
        <div class="container">
            <div class="payment-right">
                <form action="factura.php" method="POST" class="payment-form" id="payment-form">
                    <h1 class="payment-title">Detalles del Pago</h1>
                    
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
                            <img src="./img/pay/Discover.png" alt="">
                        </label>
                        <input type="radio" name="payment-method" id="method-4">
                        <label for="method-4" class="payment-method-item">
                            <img src="./img/pay/American.png" alt="">
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

                    <input type="hidden" name="total" value="<?= htmlspecialchars($total) ?>">
                    <input type="hidden" name="products" value='<?= htmlspecialchars(json_encode($products)) ?>'>

                    <button type="submit" class="payment-form-submit-button"><i class="ri-wallet-line"></i> Pagar</button>
                </form>
            </div>
        </div>
    </section>

    <script>
        document.getElementById('payment-form').addEventListener('submit', function(e) {
            e.preventDefault();
            document.querySelector('.loading-overlay').style.display = 'flex';
            setTimeout(() => {
                document.querySelector('.loading-text').classList.add('hide');
                document.querySelector('.loading-spinner').classList.add('hide');
                document.querySelector('.success-message').classList.add('show-success');
                setTimeout(() => {
                    this.submit();
                }, 3000);
            }, 10000);
        });
    </script>
