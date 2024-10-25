<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php
$title = "add proveedores"; 
if(isset($_POST['submit'])){
    $nombre = $_POST['nombre'];
    $direccion = $_POST['direccion'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $req = $bd->prepare("INSERT INTO proveedores (nombre, direccion, correo, telefono) VALUES (?, ?, ?, ?)");
    $req->execute([$nombre, $direccion, $correo, $telefono]);
    header('location: /jajoguapy/admin/proveedor/index.php?msg=added');
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
      <h3>Agregar Proveedor</h3>
      <br />
      <div class="card">
        <div class="card-body">
          <form method="post" onsubmit="return validateForm()">
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" aria-describedby="nombre">
            </div>
            <div class="form-group">
              <label for="direccion">Direccion</label>
              <input type="text" name="direccion" id="direccion" class="form-control" placeholder="" aria-describedby="direccion">
            </div>
            <div class="form-group">
              <label for="correo">Email</label>
              <input type="email" name="correo" id="correo" class="form-control" placeholder="" aria-describedby="correo">
            </div>
            <div class="form-group">
              <label for="telefono">Celular</label>
              <input type="tel" name="telefono" id="telefono" class="form-control" placeholder="" aria-describedby="telefono">
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

<script>
function validateForm() {
    var nombre = document.getElementById("nombre").value;
    var direccion = document.getElementById("direccion").value;
    var correo = document.getElementById("correo").value;
    var telefono = document.getElementById("telefono").value;

    if (nombre === "" || direccion === "" || correo === "" || telefono === "") {
        alert("Por favor, agregue los datos del proveedor.");
        return false;
    }
    return true;
}
</script>

<?php include '../include/footer.php'; ?>