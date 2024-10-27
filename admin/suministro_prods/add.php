<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php
$title = "add abastecimientos_productos"; 
if(isset($_POST['submit'])){
    $prod = $_POST['prod'];
    $abastecimiento = $_POST['abastecimiento'];
    $cantidad = $_POST['cantidad'];
    $req = $bd->prepare("insert into abastecimientos_productos(producto_id, abastecimiento_id, cantidad) values(?,?,?)");
    $req->execute([$prod, $abastecimiento, $cantidad]);
    header('location: /Jajoguapyv2/admin/suministro_prods/index.php?msg=added');
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
                <?php $qer = $bd->query("select * from productos");
                      while($dt = $qer->fetch()):
                ?>
                <option value="<?= $dt['id'] ?>"><?= $dt['nombre'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="abastecimiento">Suministrar</label>
              <select name="abastecimiento" id="abastecimiento" class="form-control" placeholder="" aria-describedby="abastecimiento">
                <?php $qer = $bd->query("select * from abastecimientos");
                      while($dt = $qer->fetch()):
                ?>
                <option value="<?= $dt['id'] ?>"><?= $dt['numero'] ?></option>
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