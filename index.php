<?php include './include/head.php'?>
<?php include './include/cnx.php'?>
<?php include './include/menu.php'?>

<section class="hero">
    <div class="hero__slider owl-carousel">
        <div class="hero__items set-bg" data-setbg="assets/o.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Ofertas</h6>
                            <h2>Black Friday</h2>
                            <h3 style="color: yellow">Hasta el 60% De Descuento en Productos Seleccionados.</h3>
                            <p></p>
                            <a href="./admin/login.php" class="primary-btn">Comprar Ya!!</a>
                            <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="hero__items set-bg" data-setbg="assets/banner2.png">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Ofertas</h6>
                            <h2>Juegos Digitales</h2>
                            <h3 style="color: yellow">Hasta el 40% De Descuento.</h3>
                            <p></p>
                            <a href="./admin/login.php" class="primary-btn">Comprar Ya!!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="NewProduct">
    <h4>Productos Nuevos</h4>
</div>


<section id="product" class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                </ul>
            </div>
        </div>
        <div class="row product__filter">
            <?php
            $qer = $bd->query("SELECT p.*, c.descuentos FROM productos p JOIN categorias c ON p.categoria_id = c.id LIMIT 20");
            while($data = $qer->fetch()):
                $descuento = $data['descuentos'];
                $precio_con_descuento = $data['precio_venta'] * (1 - $descuento);
            ?>
            <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                <div class="product__item">
                    <div class="product__item__pic set-bg" data-setbg="admin/img/<?= $data['imagen'] ?>">
                        <?php if ($descuento > 0): ?>
                            <span class="discount-label">-<?= $descuento * 100 ?>%</span>
                        <?php endif; ?>
                    </div>
                    <div class="product__item__text">
                        <h6><?= $data['nombre'] ?></h6>
                        <a href="./admin/login.php" class="add-cart">+ Agregar al Carrito</a>
                        <div class="rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <h5>
                            <?php if ($descuento > 0): ?>
                                <span class="precio-con-descuento">₲ <?= number_format($precio_con_descuento, 0, ',', '.') ?></span>
                            <?php else: ?>
                                ₲ <?= number_format($data['precio_venta'], 0, ',', '.') ?>
                            <?php endif; ?>
                        </h5>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</section>


<?php include './include/footerfinal.php'; ?>

<style>
    .categories__hot__deal {
        position: relative;
        padding: 20px;
    }

    .hot__deal__sticker {
        position: absolute;
        top: -20px;
        right: -20px;
        background-color: black;
        color: white;
        border-radius: 50%;
        width: 120px;
        height: 120px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 10px;
        box-sizing: border-box;
    }

    .hot__deal__sticker span {
        font-size: 18px;
        font-weight: bold;
    }

    .hot__deal__sticker h5 {
        font-size: 20px;
        margin: 0;
    }

    .NewProduct {
        text-align: center;
        padding: 20px;
    }

    .discount-label {
        position: absolute;
        top: 10px;
        right: 10px;
        background-color: red;
        color: white;
        padding: 5px;
        border-radius: 5px;
        font-weight: bold;
    }
</style>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.nice-select.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/jquery.slicknav.js"></script>
<script src="js/mixitup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/main.js"></script>
</body>
</html>
