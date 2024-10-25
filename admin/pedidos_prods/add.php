<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php
$title = "add pedidos_productos"; 
if(isset($_POST['submit'])){
    $producto_id = $_POST['producto_id'];
    $pedido_id = $_POST['pedido_id'];
    $cantidad = $_POST['cantidad'];
    $req = $bd->prepare("INSERT INTO pedidos_productos (producto_id, pedido_id, cantidad) VALUES (?, ?, ?)");
    $req->execute([$producto_id, $pedido_id, $cantidad]);
    header('location: /jajoguapy/admin/pedidos_prods/index.php?msg=added');
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
      <h3>Agregar un pedido de producto</h3>
      <br />
      <div class="card">
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <label for="idproduit">Producto</label>
              <select name="producto_id" id="producto_id" class="form-control" placeholder="" aria-describedby="producto_id">
                <?php $qer = $bd->query("select * from productos");
                      while($dt = $qer->fetch()):
                ?>
                <option value="<?= $dt['id'] ?>"><?= $dt['nombre'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="pedido_id">Pedido</label>
              <select name="pedido_id" id="pedido_id" class="form-control" placeholder="" aria-describedby="pedido_id">
                <?php $qer = $bd->query("select * from pedidos");
                      while($dt = $qer->fetch()):
                ?>
                <option value="<?= $dt['id'] ?>"><?= $dt['id'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="qte">Cantidad</label>
              <input required type="number" name="cantidad" id="cantidad" class="form-control" placeholder="" aria-describedby="cantidad">
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