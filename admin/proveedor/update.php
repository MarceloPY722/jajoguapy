<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php
$title = "proveedores"; 
$id = $_GET['id'];
$req = $bd->prepare('SELECT * FROM proveedores WHERE id=?');
$req->execute([$id]);
$data = $req->fetch();
if(isset($_POST['submit'])){
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $req = $bd->prepare("UPDATE proveedores SET nombre=?, direccion=?, correo=?, telefono=? WHERE id=?");
    $req->execute([$nombre, $direccion, $correo, $telefono, $id]);
    header('location: /jajoguapy/admin/proveedor/index.php?msg=updated');
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
      <h3>Modificar Proveedor</h3>
      <br />
      <div class="card">
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input value="<?= $data['nombre'] ?>" type="text" name="nombre" id="nombre" class="form-control" placeholder="" aria-describedby="nombre">
            </div>
            <div class="form-group">
              <label for="direccion">Direccion</label>
              <input value="<?= $data['direccion'] ?>" type="text" name="direccion" id="direccion" class="form-control" placeholder="" aria-describedby="direccion">
            </div>
            <div class="form-group">
              <label for="correo">Email</label>
              <input value="<?= $data['correo'] ?>" type="email" name="correo" id="correo" class="form-control" placeholder="" aria-describedby="correo">
            </div>
            <div class="form-group">
              <label for="telefono">Celular</label>
              <input value="<?= $data['telefono'] ?>" type="tel" name="telefono" id="telefono" class="form-control" placeholder="" aria-describedby="telefono">
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