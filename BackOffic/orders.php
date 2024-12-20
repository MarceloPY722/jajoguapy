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
                            </tr>
                        </thead>
                        <tbody id="cart-items">
                            <?php
                                $id = $_SESSION['id'];
                                $req = $bd->query("
                                    SELECT c.cantidad, m.id, p.nombre, p.precio_venta, p.imagen, u.usuario,
                                           p.precio_venta * (1 - cat.descuentos) AS precio_con_descuento
                                    FROM pedidos_productos c
                                    JOIN productos p ON c.producto_id = p.id
                                    JOIN pedidos m ON c.pedido_id = m.id
                                    JOIN usuarios u ON m.usuario_id = u.id
                                    JOIN categorias cat ON p.categoria_id = cat.id
                                    WHERE u.id = $id
                                ");
                                while($data = $req->fetch()):
                            ?>
                            <tr class="cart-item" data-price="<?= number_format($data['precio_con_descuento'], 0, '.', '') ?>" data-product-id="<?= $data['id'] ?>">
                                <td class="product__cart__item">
                                    <div class="product__cart__item__pic" style="width: 150px;">
                                        <img src="../admin/img/<?= $data['imagen'] ?>" alt="">
                                    </div>
                                    <div class="product__cart__item__text">
                                        <h5><?= $data['nombre'] ?></h5>
                                    </div>
                                </td>
                                <td class="quantity__item">
                                    <div class="quantity">
                                        <input type="number" class="quantity-input form-control" value="<?= $data['cantidad'] ?>" min="1" style="width: 70px;" readonly>
                                    </div>
                                </td>
                                <td class="cart__price">₲ <span class="item-total"><?= number_format($data['precio_con_descuento'] * $data['cantidad'], 0, '.', '') ?></span></td>
                                <td class="cart__close"><a href="DeleteOrder.php?id=<?= $data['id'] ?>"><i class="fa fa-close"></i></a></td>
                            </tr>
                            <?php endwhile; ?>
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
                    <form id="payment-form" action="pay.php" method="post">
                        <input type="hidden" name="total" id="hidden-total" value="">
                        <input type="hidden" name="products" id="hidden-products" value="">
                        <button type="submit" class="primary-btn" id="submit-payment">Proceder con el Pago</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include './include/footer.php'?>

<script src="./js/cart.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const cartTotalElement = document.getElementById("cart-total");
        const hiddenTotalInput = document.getElementById("hidden-total");
        const hiddenProductsInput = document.getElementById("hidden-products");
        const cartItemsContainer = document.getElementById("cart-items");

        function calculateCartTotal() {
            let total = 0;
            const cartItems = document.querySelectorAll(".cart-item");
            cartItems.forEach(item => {
                const itemTotal = parseFloat(item.querySelector(".item-total").textContent.replace(/[^0-9.-]+/g,""));
                total += itemTotal;
            });
            cartTotalElement.textContent = total.toFixed(0);
            hiddenTotalInput.value = total.toFixed(0);
        }

        calculateCartTotal();

        document.getElementById("payment-form").addEventListener("submit", function (e) {
            e.preventDefault(); 
            
            hiddenTotalInput.value = cartTotalElement.textContent.trim();

            const cartItems = document.querySelectorAll(".cart-item");
            let products = [];
            cartItems.forEach(item => {
                const productId = item.getAttribute("data-product-id"); 
                const productName = item.querySelector(".product__cart__item__text h5").textContent.trim();
                const productQuantity = item.querySelector(".quantity-input").value;
                const productPrice = item.getAttribute("data-price");
                products.push({
                    id: productId,
                    name: productName,
                    quantity: productQuantity,
                    price: productPrice
                });
            });
            hiddenProductsInput.value = JSON.stringify(products); 

            this.submit();
            cartItemsContainer.innerHTML = "";
            cartTotalElement.textContent = "0";
        });
    });
</script>