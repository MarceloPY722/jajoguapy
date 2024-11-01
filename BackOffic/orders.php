<?php include './include/head.php'?>
<?php include './include/cnx.php'?>
<?php include './include/menu.php'?>

<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Carro de la compra</h4>
                    <div class="breadcrumb__links">
                        <a href="./index.php">Inicio</a>
                        <span>Carro de Compras</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php if(isset($_GET['msg']) && $_GET['msg']=='deleted'): ?>
                <div class="alert alert-danger">Eliminado exitosamente
                    <span data-dismiss="alert" class="close" style="cursor: pointer;">&times;</span>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $id = $_SESSION['id'];
                                $req =  $bd->query("SELECT c.cantidad, m.id, p.nombre, p.precio_venta, p.imagen, u.usuario, c.producto_id, c.pedido_id FROM
                                            pedidos_productos c, productos p, pedidos m, usuarios u
                                            WHERE c.producto_id = p.id AND c.pedido_id = m.id AND m.usuario_id = u.id
                                                            AND u.id = $id");
                                while($data = $req->fetch()):
                                    $productId = $data['producto_id'];
                                    $orderId = $data['pedido_id'];
                                    $productReq = $bd->prepare("SELECT p.*, c.descuentos FROM productos p JOIN categorias c ON p.categoria_id = c.id WHERE p.id = ?");
                                    $productReq->execute([$productId]);
                                    $productData = $productReq->fetch();
                                    $descuento = $productData['descuentos'];
                                    $precioFinal = $productData['precio_venta'] * (1 - $descuento);
                            ?>
                            <tr class="cart-item" data-price="<?= $precioFinal ?>">
                                <td class="product__cart__item">
                                    <div class="product__cart__item__pic" style="width: 150px;">
                                        <img src="../admin/img/<?= $productData['imagen'] ?>" alt="">
                                    </div>
                                    <div class="product__cart__item__text">
                                        <h5><?= $productData['nombre'] ?></h5>
                                    </div>
                                </td>
                                <td class="quantity__item">
                                    <div class="quantity">
                                        <input type="number" class="quantity-input form-control" value="<?= $data['cantidad'] ?>" min="1" style="width: 70px;">
                                    </div>
                                </td>
                                <td class="cart__price">₲ <span class="item-total"><?= $precioFinal * $data['cantidad'] ?></span></td>
                                <td class="cart__close"><a href="DeleteOrder.php?id=<?= $data['id'] ?>"><i class="fa fa-close"></i></a></td>
                            </tr>
                            <?php endwhile;?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="/jajoguapy/BackOffic/index.php">Continuar Comprando</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart__total">
                    <h6>Total del carrito:</h6>
                    <p>₲ <span id="cart-total">0</span></p>

                    <!-- Formulario de pago redirigido a pay.php -->
                    <form id="payment-form" action="pay.php" method="post">
                        <!-- Campos ocultos para enviar total y productos a pay.php -->
                        <input type="hidden" name="total" id="hidden-total" value="">
                        <input type="hidden" name="products" id="hidden-products" value="">

                        <button type="submit" class="primary-btn" id="submit-payment">Proceder con el Pago</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="#"><img src="/jajoguapy/assets/logoW.png" alt="" class="footer-logo"></a>
                    </div>
                    <p>Tu Futuro Tecnologico en la palma de tu mano.</p>
                    <a href="#"><img src="img/payment.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Tienda</h6>
                    <ul>
                        <li><a href="tienda.php?categoria=1">Celulares</a></li>
                        <li><a href="tienda.php?categoria=11">Smart TV</a></li>
                        <li><a href="tienda.php?categoria=13">Notebooks</a></li>
                        <li><a href="tienda.php?categoria=12">SmartWatch</a></li>
                        <li><a href="tienda.php?categoria=3">Media Player</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-5 col-md-3 col-sm-6">
                <div class="footer__widget" id="contacto">
                    <h6>Atención al Cliente</h6>
                    <ul>
                        <li><a href="#">Contactanos</a></li>
                        <li><a href="#">Metodos de Pagos</a></li>
                        <li><a href="#">Delivery</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="footer__copyright__text">
                    <p>Todos los derechos reservado | JajoguaPy © 
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>


<?php include './include/footer.php'?>
<script src="./js/cart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const cartTotalElement = document.getElementById("cart-total");
        const hiddenTotalInput = document.getElementById("hidden-total");
        const hiddenProductsInput = document.getElementById("hidden-products");

        // Función para calcular el total
        function calculateCartTotal() {
            let total = 0;
            const cartItems = document.querySelectorAll(".cart-item");
            cartItems.forEach(item => {
                const itemTotal = parseFloat(item.querySelector(".item-total").textContent.replace(/[^0-9.-]+/g,""));
                total += itemTotal;
            });
            cartTotalElement.textContent = total;
            hiddenTotalInput.value = total;
        }

        // Llamar a la función para calcular el total en la carga de la página
        calculateCartTotal();

        // Capturar datos del carrito y enviarlos al formulario
        document.getElementById("payment-form").addEventListener("submit", function (e) {
            // Establecer el valor del total
            hiddenTotalInput.value = cartTotalElement.textContent.trim();

            // Recopilar los productos y cantidades
            const cartItems = document.querySelectorAll(".cart-item");
            let products = [];
            cartItems.forEach(item => {
                const productName = item.querySelector(".product__cart__item__text h5").textContent.trim();
                const productQuantity = item.querySelector(".quantity-input").value;
                const productPrice = item.getAttribute("data-price");
                products.push({
                    name: productName,
                    quantity: productQuantity,
                    price: productPrice
                });
            });
            hiddenProductsInput.value = JSON.stringify(products); // Convertir a JSON para pasarlo como string
        });
    });
</script>