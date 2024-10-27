<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php
$title = "abastecimientos"; 
$id = $_GET['id'];
$rq = $bd->prepare("select * from abastecimientos where id=?");
$rq->execute([$id]);
$data = $rq->fetch();
if(isset($_POST['submit'])){
    $numero = $_POST['numero'];
    $fecha = $_POST['fecha'];
    $proveedor = $_POST['proveedor'];
    $req = $bd->prepare("update abastecimientos set numero=?, fecha=?, proveedor_id=? where id=?");
    $req->execute([$numero, $fecha, $proveedor, $id]);
    header('location: /Jajoguapy/admin/suministro/index.php?msg=updated');
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
      <h3>Modificar un abastecimiento</h3>
      <br />
      <div class="card">
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <label for="numero">Número</label>
              <input value="<?= $data['numero'] ?>" required type="number" name="numero" id="numero" class="form-control" placeholder="" aria-describedby="numero">
            </div>
            <div class="form-group">
              <label for="fecha">Fecha de abastecimiento</label>
              <input value="<?= $data['fecha'] ?>" required type="date" name="fecha" id="fecha" class="form-control" placeholder="" aria-describedby="fecha">
            </div>
            <div class="form-group">
              <label for="proveedor">Proveedor</label>
              <select name="proveedor" id="proveedor" class="form-control" placeholder="" aria-describedby="proveedor">
                <?php $qer = $bd->query("select * from proveedores");
                      while($dt = $qer->fetch()):
                ?>
                <option <?= ($data['proveedor_id'] == $dt['id']) ? 'selected' : '' ?> value="<?= $dt['id'] ?>"><?= $dt['nombre'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group">
              <button name="submit" class="btn btn-warning btn-block">Modificar</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    
  </div>
</div>

<?php include '../include/footer.php'; ?>