<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php
$title = "add abastecimientos_productos"; 
if(isset($_POST['submit'])){
    $prod = $_POST['prod'];
    $abastecimiento = $_POST['abastecimiento'];
    $cantidad = $_POST['cantidad'];

    // Insertar el registro en la tabla abastecimientos_productos
    $req = $bd->prepare("INSERT INTO abastecimientos_productos (producto_id, abastecimiento_id, cantidad) VALUES (?, ?, ?)");
    $req->execute([$prod, $abastecimiento, $cantidad]);

    // Actualizar el stock del producto
    $updateStock = $bd->prepare("UPDATE productos SET cantidad_stock = cantidad_stock + ? WHERE id = ?");
    $updateStock->execute([$cantidad, $prod]);

    header('location: /Jajoguapy/admin/suministro_prods/index.php?msg=added');
}
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
      <h3>Agregar un suministro a un producto</h3>
      <br />
      <div class="card">
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <label for="prod">Producto</label>
              <select name="prod" id="prod" class="form-control" placeholder="" aria-describedby="prod">
                <?php $qer = $bd->query("SELECT * FROM productos");
                      while($dt = $qer->fetch()):
                ?>
                <option value="<?= $dt['id'] ?>"><?= $dt['nombre'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="abastecimiento">Quien suministra</label>
              <select name="abastecimiento" id="abastecimiento" class="form-control" placeholder="" aria-describedby="abastecimiento">
                <?php 
                $qer = $bd->query("SELECT a.id, a.numero, a.fecha, p.nombre AS proveedor_nombre 
                                   FROM abastecimientos a 
                                   JOIN proveedores p ON a.proveedor_id = p.id");
                while($dt = $qer->fetch()):
                ?>
                <option value="<?= $dt['id'] ?>"><?= $dt['proveedor_nombre'] ?> - <?= $dt['numero'] ?> - <?= $dt['fecha'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="cantidad">Cantidad</label>
              <input type="number" name="cantidad" id="cantidad" class="form-control" placeholder="" aria-describedby="cantidad">
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