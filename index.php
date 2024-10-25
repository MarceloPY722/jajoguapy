<?php include './include/head.php'?>
<?php include './include/cnx.php'?>

    <!-- Page Preloder -->
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <?php include './include/menu.php'?>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
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
                                <a href="#" class="primary-btn">Comprar Ya!!</a>
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

            <div class="hero__items set-bg" data-setbg="assets/banner.jpg">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-5 col-lg-7 col-md-8">
                            <div class="hero__text">
                                <h6>Ofertas</h6>
                                <h2>Juegos Digitales</h2>
                                <h3 style="color: yellow">Hasta el 40% De Descuento.</h3>
                                <p></p>
                                <a href="#" class="primary-btn">Comprar Ya!!</a>
                               
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

    <!--Seccion de Productos -->
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
					$qer =  $bd->query("SELECT * FROM productos LIMIT 12");
					while($data=$qer->fetch()):
				?>


                <!--Seccion de productos agregados desde el dashboard-->
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="admin/img/<?=$data['imagen']?>">
                            <span class="label">Nuevo</span>
                        </div>
                        <div class="product__item__text">
                            <h6><?=$data['nombre']?></h6>
                            <a href="shop-details.php?id=<?= $data['id']?>" class="add-cart">+ Agregar al Carrito</a>
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
    <!-- Product Section End -->

    <!-- Categories Section Begin -->
    <section class="categories spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="categories__text">
                        <h2>Aprovecha <br /> <span>Esta Oferta por</span> <br /> Tiempo Limitado</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="categories__hot__deal">
                        <img src="img/phone1.png" alt="">
                        <div class="hot__deal__sticker">
                            <span>Sale por</span>
                            <h5>₲ 2.500.000</h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                    <div class="categories__deal__countdown">
                        <span>Descuentos</span>
                        <h2>Iphone 12 | 256 GB </h2>
                        <div class="categories__deal__countdown__timer" id="countdown">
                            <div class="cd-item">
                                <span>3</span>
                                <p>Days</p>
                            </div>
                            <div class="cd-item">
                                <span>1</span>
                                <p>Hours</p>
                            </div>
                            <div class="cd-item">
                                <span>50</span>
                                <p>Minutes</p>
                            </div>
                            <div class="cd-item">
                                <span>18</span>
                                <p>Seconds</p>
                            </div>
                        </div>
                        <a href="./admin/login.php" class="primary-btn">Compra Ya!</a>
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


.NewProduct{
    text-align: center;
    padding: 20px;
    
}

.NewProduct h4{
    font-family: 'Times New Roman', Times, serif;
    font-size: 2rem;

}
    </style>

    <?php include './include/footer.php'?>