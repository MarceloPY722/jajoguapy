<?php include './include/head.php'?>
<?php include './include/cnx.php'?>
<?php include './include/menu.php'?>

<?php
$idu = $_SESSION['id'];

if (isset($_POST['total']) && isset($_POST['products'])) {
    $total = floatval($_POST['total']); 
    $products = json_decode($_POST['products'], true);
} else {
    header("Location: index.php");
    exit();
}

$totalCalculado = 0;
foreach ($products as $product) {
    $totalCalculado += floatval($product['price']) * intval($product['quantity']);
}
?>

<script>
    // Redirecciona automáticamente a la descarga del PDF al cargar la página
    window.onload = function() {
        const form = document.createElement('form');
        form.method = 'post';
        form.action = '/jajoguapy/admin/print/factura_electronica.php?usuario_id=<?= $idu ?>';

        const totalInput = document.createElement('input');
        totalInput.type = 'hidden';
        totalInput.name = 'total';
        totalInput.value = '<?= $totalCalculado ?>';

        const productsInput = document.createElement('input');
        productsInput.type = 'hidden';
        productsInput.name = 'products';
        productsInput.value = '<?= json_encode($products) ?>';

        form.appendChild(totalInput);
        form.appendChild(productsInput);
        
        document.body.appendChild(form);
        form.submit();
    };
</script>

<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Factura</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.php">Inicio</a>
                        <span>Factura</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="factura-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="factura__messages">
                    <p class="success-message">Pago Exitoso...</p>
                    <p class="thank-you-message">Gracias por su compra!!</p>
                    <p class="instruction-message">Favor Presione el Boton "Enviar Ubicacion" para enviarle su pedido lo mas antes posible <br/> con el documento PDF Descargado</p>
                </div>
                <div class="factura__table">
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= htmlspecialchars($product['name']) ?></td>
                                <td><?= htmlspecialchars($product['quantity']) ?></td>
                                <td>₲ <?= number_format(floatval($product['price']), 0, ',', '.') ?></td>
                                <td>₲ <?= number_format(floatval($product['price']) * intval($product['quantity']), 0, ',', '.') ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Total:</strong></td>
                                <td><strong>₲ <?= number_format($totalCalculado, 0, ',', '.') ?></strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="factura__button">
    <a href="./index.php">
        <button class="volver-inicio-btn">Volver al Inicio</button>
    </a>
    <a href="https://wa.me/595994275953?text=Hola,%20quiero%20enviar%20mi%20ubicación%20para%20el%20envío%20de%20mi%20pedido." target="_blank">
        <button class="enviar-ubicacion-btn">Enviar Ubicación</button>
    </a>
</div>



            </div>
        </div>
    </div>
</section>


<?php include './include/footerfinal.php'?>
<?php include './include/footer.php'?>

<style>
    .volver-inicio-btn {
    padding: 15px 30px;
    background-color: black;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-size: 20px;
    margin-right: 15px; /* Espaciado entre los botones */
}

.volver-inicio-btn:hover {
    background-color: #696969;
}

.styled-table {
    width: 100%;
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 18px;
    text-align: left;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}

.styled-table thead tr {
    background-color: #00BFFF;
    color: #ffffff;
    text-align: left;
}

.styled-table th,
.styled-table td {
    padding: 12px 15px;
}

.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #00BFFF; 
}

.styled-table tfoot tr {
    background-color: #f1f1f1;
}

.styled-table tfoot td {
    font-weight: bold;
}

.factura__messages {
    margin-bottom: 20px;
}

.success-message {
    color: green;
    font-weight: bold;
    font-size: 44px; 
    margin-top: 70px; 
}

.thank-you-message {
    color: #333;
    font-weight: bold;
    font-size: 34px; 
    margin-top: 30px; 
}

.instruction-message {
    margin-top: 30px;
    color: #333;
    font-size: 23px; 
}

.factura__button {
    margin-top: 40px; 
    text-align: center;
}

.enviar-ubicacion-btn {
    padding: 15px 30px; 
    background-color: #00BFFF; 
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-size: 20px; 
    margin-bottom: 50px;
}

.enviar-ubicacion-btn:hover {
    background-color: #009ACD;
}
</style>