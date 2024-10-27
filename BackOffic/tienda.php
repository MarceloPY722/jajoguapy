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

// Obtener el precio máximo de los productos
$precio_max_query = $bd->query("SELECT MAX(precio_venta) AS precio_max FROM productos");
$precio_max_data = $precio_max_query->fetch();
$precio_max_default = $precio_max_data['precio_max'];

// Inicializar variables para el filtrado
$categoria_id = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$precio_min = isset($_GET['precio_min']) ? $_GET['precio_min'] : '';
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

if (!empty($precio_min)) {
    $where[] = "p.precio_venta >= ?";
    $params[] = $precio_min;
}

if (!empty($precio_max)) {
    $where[] = "p.precio_venta <= ?";
    $params[] = $precio_max;
}

if (!empty($where)) {
    $sql .= " WHERE " . implode(" AND ", $where);
}

$productos = $bd->prepare($sql);
$productos->execute($params);
?>
<div class="page-container">
    <div class="row">
      <div class="col-md-3">
        <h3 class="text-center">Filtros</h3>
        <form method="get" action="tienda.php" class="text-center">
          <div class="form-group d-flex align-items-center">
            <label for="categoria" class="mr-2">Categorías</label>
            <select name="categoria" id="categoria" class="form-control">
              <option value="">Todas las categorías</option>
              <?php while($cat = $categorias->fetch()): ?>
                <option value="<?= $cat['id'] ?>" <?= ($categoria_id == $cat['id']) ? 'selected' : '' ?>>
                  <?= $cat['nombre'] ?> (<?= $cat['cantidad'] ?>)
                </option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="form-group">
            <label for="precio_min">Precio Mínimo</label>
            <input type="number" name="precio_min" id="precio_min" class="form-control" value="<?= $precio_min ?>">
          </div>
          <div class="form-group">
            <label for="precio_max">Precio Máximo</label>
            <input type="number" name="precio_max" id="precio_max" class="form-control" value="<?= $precio_max ?>">
          </div>
          <button type="submit" class="btn btn-primary">Aplicar Filtros</button>
        </form>
      </div>



      <div class="col-md-9">
        <h3 class="text-center">Productos</h3>
        <div class="row justify-content-center">
          <?php while($producto = $productos->fetch()): ?>
            <div class="col-md-4 mb-4">
              <div class="card">
                <img src="../img/<?= $producto['imagen'] ?>" class="card-img-top" alt="<?= $producto['nombre'] ?>">
                <div class="card-body">
                  <h5 class="card-title"><?= $producto['nombre'] ?></h5>
                  <p class="card-text">Precio: <?= $producto['precio_venta'] ?></p>
                  <p class="card-text">Categoría: <?= $producto['categoria_nombre'] ?></p>
                  <a href="#" class="btn btn-primary">Ver Detalles</a>
                </div>
              </div>
            </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </div>


<?php include './include/footer.php'; ?>