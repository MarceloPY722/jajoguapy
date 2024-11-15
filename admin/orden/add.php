<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php
$title = "Agregar Orden";

// Procesar el formulario de agregar orden
if (isset($_POST['submit'])) {
    $orden_id = $_POST['orden_id'];
    $producto_id = $_POST['producto_id'];
    $precio = $_POST['precio'];

    $req = $bd->prepare("
        INSERT INTO ordenes (orden_id, producto_id, precio)
        VALUES (?, ?, ?)
    ");
    $req->execute([$orden_id, $producto_id, $precio]);

    header('location: /jajoguapy/admin/orden/index.php?msg=added');
}

$productos = $bd->query("SELECT * FROM productos");
?>
<?php include '../include/header.php'; ?>

<div class="page-container">
  <?php include '../include/sidebar.php'; ?>
  <div class="main-content">
    <?php include '../include/menu.php'; ?>
    <hr />
    <div class="row">
      <h3>Agregar Orden</h3>
      <br />
      <div class="card">
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <label for="orden_id">Orden ID</label>
              <input type="text" name="orden_id" id="orden_id" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="producto_id">Producto</label>
              <select name="producto_id" id="producto_id" class="form-control" required>
                <?php while ($producto = $productos->fetch()): ?>
                  <option value="<?= $producto['id'] ?>"><?= $producto['nombre'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="precio">Precio</label>
              <input type="number" name="precio" id="precio" class="form-control" required>
            </div>
            <div class="form-group">
              <button name="submit" class="btn btn-primary btn-block">Agregar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    
  </div>
</div>

<?php include '../include/footer.php'; ?>