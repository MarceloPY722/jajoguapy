<?php include './include/head.php'?>
<?php include './include/cnx.php'?>
<?php include './include/menu.php'?>
<?php 
$idu = $_SESSION['id'];
$id = $_GET['id'];
$date = date("Y-m-d");
$req = $bd->query("SELECT p.*, c.descuentos FROM productos p JOIN categorias c ON p.categoria_id = c.id WHERE p.id = $id");
$data = $req->fetch();
$cat = $data['categoria_id'];
$descuento = $data['descuentos'];
$precio_final = $data['precio_venta'] * (1 - $descuento);

if(isset($_POST['sub'])){
  $Q = $_POST['qte'];
  if ($Q > $data['cantidad_stock']) {
    echo "<script>alert('Este Producto no está disponible por stock');</script>";
  } else {
    $qr = $bd->prepare("BEGIN;
                        INSERT INTO pedidos(fecha, usuario_id) VALUES(?, ?);
                        INSERT INTO pedidos_productos(producto_id, pedido_id, cantidad) VALUES(?, LAST_INSERT_ID(), ?);
                        COMMIT;");
    $qr->execute([$date, $idu, $id, $Q]);
    header('location: orders.php');
  }
}
?>
<section class="shop-details">
    <div class="product__details__pic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__breadcrumb">
                        <a href="./index.php">Inicio</a>
                        <span>Detalles del producto</span>
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
                                <img src="../admin/img/<?= $data['imagen'] ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form method="post">
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
                            <h3>₲ <?= number_format($precio_final, 0, ',', '.') ?></h3>
                            <div class="status">
                                <?php if ($data['cantidad_stock'] > 0): ?>
                                    <span class="stock-status available">Disponible</span>
                                <?php else: ?>
                                    <span class="stock-status out-of-stock">Agotado</span>
                                <?php endif; ?>
                            </div>
                            <div class="product__details__cart__option">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input name="qte" type="text" value="1">
                                    </div>
                                </div>
                                <?php if ($data['cantidad_stock'] > 0): ?>
                                    <button class="primary-btn" name="sub">Añadir al carrito</button>
                                <?php else: ?>
                                    <button class="primary-btn" name="sub" disabled>Añadir al carrito</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Descripción</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p>
                                            <?= nl2br(htmlspecialchars($data['detalles'])) ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
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
            $qer = $bd->prepare("SELECT p.*, c.descuentos FROM productos p JOIN categorias c ON p.categoria_id = c.id WHERE p.categoria_id = ? AND p.id != ? LIMIT 4");
            $qer->execute([$cat, $id]);

            while ($relatedData = $qer->fetch()):
                $relatedDescuento = $relatedData['descuentos'];
                $relatedPrecioFinal = $relatedData['precio_venta'] * (1 - $relatedDescuento);
            ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="../admin/img/<?= $relatedData['imagen'] ?>">
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
                            <h5>₲ <?= number_format($relatedPrecioFinal, 0, ',', '.') ?>
                                <?php if ($relatedData['cantidad_stock'] > 0): ?>
                                    <span class="stock-status available">Disponible</span>
                                <?php else: ?>
                                    <span class="stock-status out-of-stock">Agotado</span>
                                <?php endif; ?>
                            </h5>
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

<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form">
            <input type="text" id="search-input" placeholder="Search here.....">
        </form>
    </div>
</div>
<?php include './include/footer.php'?>
<style>
    .status {
        margin-right: 60px;
        margin-bottom: 20px;
    }

    .stock-status {
        padding: 5px 10px;
        border-radius: 5px;
        margin-left: 10px;
        font-size: 14px;
        font-weight: bold;
    }

    .available {
        background-color: green;
        color: white;
    }

    .out-of-stock {
        background-color: red;
        color: white;
    }

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
</style>