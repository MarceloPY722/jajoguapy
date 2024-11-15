<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php
$title = "Editar Orden";

// Obtener el ID de la orden a editar
if (isset($_GET['id'])) {
    $orden_id = $_GET['id'];

    // Obtener los datos de la orden
    $req = $bd->prepare("
        SELECT o.*, p.nombre AS producto_nombre
        FROM ordenes o
        JOIN productos p ON o.producto_id = p.id
        WHERE o.id = ?
    ");
    $req->execute([$orden_id]);
    $orden = $req->fetch();

    // Si no se encuentra la orden, redirigir a la lista de órdenes
    if (!$orden) {
        header('location: /jajoguapy/admin/orden/index.php');
        exit();
    }
} else {
    header('location: /jajoguapy/admin/orden/index.php');
    exit();
}

// Procesar el formulario de edición
if (isset($_POST['submit'])) {
    $orden_id_post = $_POST['orden_id'];
    $producto_id = $_POST['producto_id'];
    $precio = $_POST['precio'];

    $req = $bd->prepare("
        UPDATE ordenes
        SET orden_id = ?, producto_id = ?, precio = ?
        WHERE id = ?
    ");
    $req->execute([$orden_id_post, $producto_id, $precio, $orden_id]);

    header('location: /jajoguapy/admin/orden/index.php?msg=updated');
}

// Obtener la lista de productos para el select
$productos = $bd->query("SELECT * FROM productos");
?>
<?php include '../include/header.php'; ?>

<div class="page-container">
  <!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

  <!-- Start Sidebar -->
  <?php include '../include/sidebar.php'; ?>
  <!-- End Sidebar -->
  <div class="main-content">

    <!-- Start Menu -->
    <?php include '../include/menu.php'; ?>
    <!-- End Menu -->
    <hr />

    <div class="row">
      <h3>Editar Orden</h3>
      <br />
      <div class="card">
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <label for="orden_id">Orden ID</label>
              <input type="text" name="orden_id" id="orden_id" class="form-control" value="<?= $orden['orden_id'] ?>" required>
            </div>
            <div class="form-group">
              <label for="producto_id">Producto</label>
              <select name="producto_id" id="producto_id" class="form-control" required>
                <?php while ($producto = $productos->fetch()): ?>
                  <option value="<?= $producto['id'] ?>" <?= $producto['id'] == $orden['producto_id'] ? 'selected' : '' ?>><?= $producto['nombre'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="precio">Precio</label>
              <input type="number" name="precio" id="precio" class="form-control" value="<?= $orden['precio'] ?>" required>
            </div>
            <div class="form-group">
              <button name="submit" class="btn btn-primary btn-block">Guardar Cambios</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <footer class="main">
      &copy; 2024 <strong>Jajoguapy</strong> Panel Admin | Órdenes
    </footer>
  </div>
</div>

<?php include '../include/footer.php'; ?>