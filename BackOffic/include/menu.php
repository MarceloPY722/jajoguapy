<?php
include 'session.php';
include 'cnx.php';
$id = $_SESSION['id'];
$req = $bd->prepare('SELECT * FROM usuarios 
                      WHERE id=?');
$req->execute([$id]);
$data = $req->fetch();
$rq = $bd->prepare('SELECT count(*) FROM pedidos
                      WHERE usuario_id=?');
$rq->execute([$id]);
$dt = $rq->fetch();
?>

<header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Envío gratuito, devolución de 30 días o garantía de reembolso.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-mdproduct spad-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                <a href="../admin/logout.php">Cerrar Sesion</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3"style="height: 100px;">
                    <div class="header__logo">
                        <a href="./index.php">
                            <img src="/jajoguapy/assets/logo10.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="./index.php">Inicio</a></li>
                            <li><a href="./tienda.php">Tienda</a></li>
                            <li><a href="/jajoguapy/BackOffic/contactanos.php">Contactos</a></li>
                            
                        
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="orders.php"><img src="img/icon/cart.png" alt=""><span></span></a>
                        <a class="nav-link" href="profile.php"><img class="img-responsive rounded-circle border border-dark"  width="30" height="30" src="../admin/img/<?=$data['imagen']?>" alt="" ></a>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>