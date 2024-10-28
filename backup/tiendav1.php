<!--Version sin el cambio de precios de categoria-->

<?php include './include/head.php'?>
<?php include './include/cnx.php'?>
<?php include './include/menu.php'?>

<?php
$title = "Tienda";

// Obtener todas las categorías con la cantidad de productos en cada una
$categorias = $bd->query("SELECT c.id, c.nombre, COUNT(p.id) AS cantidad 
                         FROM categorias c 
                         LEFT JOIN productos p ON c.id = p.categoria_id 
                         GROUP BY c.id, c.nombre");

// Obtener el precio máximo y mínimo de los productos
$precio_query = $bd->query("SELECT MAX(precio_venta) AS precio_max, MIN(precio_venta) AS precio_min FROM productos");
$precio_data = $precio_query->fetch();
$precio_max_default = $precio_data['precio_max'];
$precio_min_default = $precio_data['precio_min'];

// Inicializar variables para el filtrado
$categoria_id = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$precio_max = isset($_GET['precio_max']) ? $_GET['precio_max'] : $precio_max_default;

// Construir la consulta SQL basada en los filtros
$sql = "SELECT p.*, c.nombre AS categoria_nombre 
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

if (!empty($where)) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

$stmt = $bd->prepare($sql);
$stmt->execute($params);
$productos = $stmt;
?>

<div class="container-fluid">
    <div class="row">
      
        <div class="col-md-3 bg-light p-4">
            <h3 class="text-center mb-4">Filtros</h3>
            <form method="get" action="tienda.php">
                <input type="hidden" name="categoria" value="<?= $categoria_id ?>">
                <!-- Filtro de Categorías -->
                <div class="form-group mb-4">
                    <label class="mb-2">Categorías</label>
                    <div class="category-filters">
                        <a href="tienda.php" class="category-btn <?= empty($categoria_id) ? 'active' : '' ?>">Todas</a>
                        <?php 
                        $categorias->execute(); 
                        while($cat = $categorias->fetch()): 
                        ?>
                            <a href="tienda.php?categoria=<?= $cat['id'] ?>" 
                               class="category-btn <?= ($categoria_id == $cat['id']) ? 'active' : '' ?>">
                               <?= $cat['nombre'] ?> (<?= $cat['cantidad'] ?>)
                            </a>
                        <?php endwhile; ?>
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

                <button type="submit" class="btn btn-primary w-100">Aplicar Filtros</button>
            </form>
        </div>

      
        <div class="col-md-9">
            <div class="product-grid">
                <?php while($producto = $productos->fetch()): ?>
                <div class="product__item">
                    <div class="product__item__pic">
                        <img src="../admin/img/<?=$producto['imagen']?>" alt="<?=$producto['nombre']?>">
                       
                    </div>
                    <div class="product__item__text">
                        <h6><?=$producto['nombre']?></h6>
                        <div class="rating">
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <a href="shop-details.php?id=<?=$producto['id']?>" class="add-cart">Añadir al Carrito</a>
                        <h5>₲ <?= number_format($producto['precio_venta'], 0, ',', '.') ?></h5>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</div>
