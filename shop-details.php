<?php include './include/head.php'?>
<?php include './include/cnx.php'?>
<?php include './include/menu.php'?>
<?php 
$id = $_GET['id'];
$date = date("Y-m-d");
$req = $bd->query("SELECT * FROM productos WHERE id=$id");
$data = $req->fetch();
$cat = $data['categoria_id'];

?>
    <!-- Shop Details Section Begin -->
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
                            <li class="nav-item">
                                
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__pic__item">
                                    <img src="admin/img/<?=$data['imagen']?>" alt="">
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
                            <h4><?=$data['nombre']?></h4>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <span> - 5 Reviews</span>
                            </div>
                            <h3>₲<?=$data['precio_venta']?><span><?=$data['precio_venta'] + 450000?></span></h3>
                            <div class="product__details__cart__option">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input name="qte" type="text" value="1">
                                    </div>
                                </div>
                                <a href="admin/login.php"  ><button class="primary-btn" name="sub">Añadir al carrito</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5"
                                    role="tab">Descripcion</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p>
                                        <?=$data['detalles']?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Productos relacionados</h3>
                </div>
            </div>
           <div class="row">
            <?php
					$qer =  $bd->prepare("SELECT * FROM productos WHERE categoria_id=? LIMIT 4");
                    $qer->execute([$cat]);
					while($data=$qer->fetch()):
				?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="admin/img/<?=$data['imagen']?>">
                            <span class="label">Nuevo</span>
                        </div>
                        <div class="product__item__text">
                            <h6><?=$data['nombre']?></h6>
                            <a href="shop-details.php?id=<?= $data['id']?>" class="add-cart">+ Añadir al Carrito</a>
                            <div class="rating">
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <h5><?=$data['precio_venta']?>₲</h5>
                        </div>
                    </div>
                </div>
                <?php endwhile;?>
            </div>
        </div>
    </section>
    <!-- Related Section End -->

    <!-- Footer Section Begin -->
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
    <!-- Footer Section End -->

    <!-- Search End -->

    <!-- Js Plugins -->
    <?php include './include/footer.php'?>