<?php include './include/head.php'?>
<?php include './include/cnx.php'?>
<?php include './include/menu.php'?>

<?php
$title = "Tienda";
$categorias = $bd->query("SELECT c.id, c.nombre, COUNT(p.id) AS cantidad 
                         FROM categorias c 
                         LEFT JOIN productos p ON c.id = p.categoria_id 
                         GROUP BY c.id, c.nombre");

$categoria_id = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : '';
$black_friday = isset($_GET['black_friday']) ? $_GET['black_friday'] : '';

if (!empty($categoria_id)) {
    $precio_query = $bd->prepare("SELECT MAX(precio_venta) AS precio_max, MIN(precio_venta) AS precio_min 
                                  FROM productos 
                                  WHERE categoria_id = ?");
    $precio_query->execute([$categoria_id]);
} else {
    $precio_query = $bd->query("SELECT MAX(precio_venta) AS precio_max, MIN(precio_venta) AS precio_min FROM productos");
}
$precio_data = $precio_query->fetch();
$precio_max_default = $precio_data['precio_max'];
$precio_min_default = $precio_data['precio_min'];

$precio_max = isset($_GET['precio_max']) ? $_GET['precio_max'] : $precio_max_default;

$sql = "SELECT p.*, c.nombre AS categoria_nombre, c.descuentos 
        FROM productos p 
        JOIN categorias c ON p.categoria_id = c.id";

$where = [];
$params = [];

if (!empty($categoria_id)) {
    $where[] = "p.categoria_id = ?";
    $params[] = $categoria_id;
}

if (!empty($precio_max)) {
    $where[] = "p.precio_venta <= ?";
    $params[] = $precio_max;
}

if (!empty($busqueda)) {
    $where[] = "p.nombre LIKE ?";
    $params[] = "%$busqueda%";
}

if (!empty($black_friday)) {
    $where[] = "c.descuentos > 0";
}

if (!empty($where)) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

if (empty($categoria_id)) {
    $sql .= " LIMIT 20";
}

$stmt = $bd->prepare($sql);
$stmt->execute($params);
$productos = $stmt;
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 bg-light p-4">
            <h3 style="text-align: right; font-size: 1.2rem;" class="mb-4">Buscador</h3>
            <form method="get" action="tienda.php">
                <div class="form-group mb-4">
                    <input type="text" name="busqueda" class="form-control" placeholder="Buscar productos" value="<?= isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : '' ?>">
                </div>
                <button type="submit" class="btn primary-btn w-100 mb-4">Buscar</button>
            </form>

            <h3 style="text-align: right; font-size: 1.2rem;" class="mb-4">Filtros</h3>
            <form method="get" action="tienda.php">
                <input type="hidden" name="categoria" value="<?= $categoria_id ?>">
                <div class="form-group mb-4">
                    <label class="mb-2">Categorías</label>
                    <div class="category-filters">
                        <a href="tienda.php" class="category-btn <?= empty($categoria_id) ? 'active' : '' ?>">Todas</a>
                        <?php 
                        $categorias->execute(); 
                        while($cat = $categorias->fetch()): 
                            if ($cat['nombre'] !== 'Ofertas'): // Excluir la categoría "Ofertas"
                        ?>
                            <a href="tienda.php?categoria=<?= $cat['id'] ?>&busqueda=<?= isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : '' ?>" 
                               class="category-btn <?= ($categoria_id == $cat['id']) ? 'active' : '' ?>">
                               <?= $cat['nombre'] ?> (<?= $cat['cantidad'] ?>)
                            </a>
                        <?php 
                            endif;
                        endwhile; 
                        ?>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label class="mb-2">Descuentos</label>
                    <div class="category-filters">
                        <a href="tienda.php?black_friday=1&busqueda=<?= isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : '' ?>" 
                           class="category-btn <?= ($black_friday == 1) ? 'active' : '' ?>">
                           Black Friday
                        </a>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="precio_max_range" class="mb-2">Precio Máximo</label>
                    <div class="range-container">
                        <input type="range" id="precio_max_range" name="precio_max" min="<?= $precio_min_default ?>" max="<?= $precio_max_default ?>" value="<?= $precio_max ?>" class="form-range">
                    </div>
                    <div class="range-values">
                        <span>Hasta: Gs.</span>
                        <input type="text" id="precio_max_display" value="<?= number_format($precio_max, 0, ',', '.') ?>" class="form-control" readonly>
                    </div>
                </div>
                <button type="submit" class="btn primary-btn w-100">Aplicar Filtros</button>
            </form>
        </div>
        <div class="col-md-9">
            <div class="product-grid">
                <?php while($producto = $productos->fetch()): 
                    $descuento = $producto['descuentos'];
                    $precioFinal = $producto['precio_venta'] * (1 - $descuento);
                ?>
                <div class="product__item">
                    <div class="product__item__pic">
                        <img src="../admin/img/<?= $producto['imagen'] ?>" alt="<?= $producto['nombre'] ?>">
                        <?php if ($descuento > 0): ?>
                            <span class="discount-label">-<?= $descuento * 100 ?>%</span>
                        <?php endif; ?>
                    </div>
                    <div class="product__item__text">
                        <h6><?= $producto['nombre'] ?></h6>
                        <div class="rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <a href="shop-details.php?id=<?= $producto['id'] ?>" class="add-cart">Añadir al Carrito</a>
                        <h5>₲ <?= number_format($precioFinal, 0, ',', '.') ?></h5>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="#"><img src="/jajoguapy/assets/logoW.png" alt=""></a>
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
                        <li><a href="tienda.php?categoria=15">Juegos</a></li>
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

<style>
    .primary-btn {
        background-color: black; 
        color: white; 
        transition: background-color 0.3s, color 0.3s; 
    }

    .primary-btn:hover {
        background-color: black; 
        color: white; 
    }

    .product__item {
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        background: white;
    }

    .product__item:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transform: translateY(-3px);
    }

    .product__item__pic {
        width: 100%;
        height: 200px;
        overflow: hidden;
        border-radius: 6px;
        margin-bottom: 15px;
        position: relative;
    }

    .product__item__pic img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .product__item__text {
        text-align: center;
        padding: 10px 0;
        position: relative;  
    }

    .product__item__text h6 {
        font-size: 14px;
        margin-bottom: 10px;
        transition: opacity 0.3s ease; 
    }

    .product__item__text h5 {
        color: #000;  
        font-weight: normal;
        font-size: 16px;
        margin-top: 10px;
    }

    .product__item:hover .product__item__text h6 {
        opacity: 0;  
    }

    .add-cart {
        position: absolute;  
        left: 0;
        right: 0;
        top: 0;  
        color: #ff0000;
        text-decoration: none;
        font-size: 14px;
        background: transparent;
        border: none;
        padding: 5px 0;
        opacity: 0; 
        transition: opacity 0.3s ease;  
        pointer-events: none; 
    }

    .add-cart:before {
        content: "+ ";  
        color: #ff0000;
    }

    .add-cart:hover {
        color: #ff0000; 
        text-decoration: none;
    }

    .product__item:hover .add-cart {
        opacity: 1; 
        pointer-events: auto;  
    }

    .rating {
        margin: 10px 0;
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
        padding: 20px;
    }

    .category-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 10px;
    }

    .category-btn {
        padding: 8px 15px;
        font-size: 14px;
        background-color: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 20px;
        text-decoration: none;
        color: #333;
        transition: all 0.3s ease;
    }

    .category-btn:hover,
    .category-btn.active {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
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

<?php include './include/footer.php'?>

<script src="./js/rango.js"></script>