<?php include './include/head.php'?>
<?php include './include/cnx.php'?>
<?php include './include/menu.php'?>
<?php 
$id = $_GET['id'];
$date = date("Y-m-d");
$req = $bd->query("SELECT p.*, c.descuentos FROM productos p JOIN categorias c ON p.categoria_id = c.id WHERE p.id = $id");
$data = $req->fetch();
$cat = $data['categoria_id'];
$descuento = $data['descuentos'];
$precio_con_descuento = $data['precio_venta'] * (1 - $descuento);
?>

<section class="shop-details">
    <div class="product__details__pic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__breadcrumb">
                        <a href="./index.php">Inicio</a>
                        <span>Detalles de Productos</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item"></li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-9">
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="admin/img/<?= $data['imagen'] ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product__details__content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="product__details__text">
                        <h4><?= $data['nombre'] ?></h4>
                        <div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-o"></i>
                            <span> - 5 Reviews</span>
                        </div>
                        <?php if ($descuento > 0): ?>
                            <h3 class="precio-con-descuento">₲ <?= number_format($precio_con_descuento, 0, ',', '.') ?></h3>
                        
                            <span class="discount-label">-<?= $descuento * 100 ?>%</span>
                        <?php else: ?>
                            <h3>₲ <?= number_format($data['precio_venta'], 0, ',', '.') ?></h3>
                        <?php endif; ?>
                        <div class="product__details__cart__option">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input name="qte" type="text" value="1">
                                </div>
                            </div>
                            <a href="admin/login.php"><button class="primary-btn" name="sub">Añadir al carrito</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Descripcion</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <p><?= $data['detalles'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="related spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="related-title">Productos relacionados</h3>
            </div>
        </div>
        <div class="row">
            <?php
            $qer = $bd->prepare("SELECT p.*, c.descuentos FROM productos p JOIN categorias c ON p.categoria_id = c.id WHERE p.categoria_id = ? LIMIT 4");
            $qer->execute([$cat]);
            while($relatedData = $qer->fetch()):
                $relatedDescuento = $relatedData['descuentos'];
                $relatedPrecioConDescuento = $relatedData['precio_venta'] * (1 - $relatedDescuento);
            ?>
            <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="admin/img/<?= $relatedData['imagen'] ?>">
                        <span class="label">Nuevo</span>
                        <?php if ($relatedDescuento > 0): ?>
                            <span class="discount-label">-<?= $relatedDescuento * 100 ?>%</span>
                        <?php endif; ?>
                    </div>
                    <div class="product__item__text">
                        <h6><?= $relatedData['nombre'] ?></h6>
                        <a href="shop-details.php?id=<?= $relatedData['id'] ?>" class="add-cart">+ Añadir al Carrito</a>
                        <div class="rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <?php if ($relatedDescuento > 0): ?>
                            <h5 class="precio-con-descuento">₲ <?= number_format($relatedPrecioConDescuento, 0, ',', '.') ?></h5>
                            <h5 class="precio-original">₲ <?= number_format($relatedData['precio_venta'], 0, ',', '.') ?></h5>
                        <?php else: ?>
                            <h5>₲ <?= number_format($relatedData['precio_venta'], 0, ',', '.') ?></h5>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="#"><img src="assets/logoW.png" alt=""></a>
                    </div>
                    <p>Tu Futuro Tecnologico en la palma de tu mano.</p>
                    <a href="#"><img src="img/payment.png" alt=""></a>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Tienda</h6>
                    <ul>
                        <li><a href="#">Celulares</a></li>
                        <li><a href="#">Ofertas</a></li>
                        <li><a href="#">Accesorios</a></li>
                        <li><a href="#">Descuentos</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Atención al C.</h6>
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

<style>
    .discount-label {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: red;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
    }

    .precio-original {
        text-decoration: line-through;
        color: gray;
    }

    .precio-con-descuento {
        color: green;
        font-weight: bold;
    }
</style>

<?php include './include/footer.php'?>