<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php
$title = "add user"; 
if(isset($_POST['submit'])){
    $image = basename($_FILES['img']['name']);
    $path = '../img/'.$image;
    $file = $_FILES['img']['tmp_name'];
    move_uploaded_file($file, $path);
    $usuario = $_POST['usuario'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $contraseña = md5($_POST['contrasena']);
    $correo = $_POST['correo'];
    $rol = $_POST['rol'];
    $ciudad = $_POST['ciudad'];
    $req = $bd->prepare("INSERT INTO usuarios (usuario, contrasena, correo, rol, nombre, apellido, telefono, imagen, ciudad_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $req->execute([$usuario, $contrasena, $correo, $rol, $nombre, $apellido, $telefono, $image, $ciudad]);
    header('location: /jajoguapy/admin/user/index.php?msg=added');
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
      <h3>Agregar un usuario</h3>
      <br />
      <div class="card">
        <div class="card-body">
          <form method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="img">Imagen</label>
              <input type="file" name="img" id="img" class="form-control" placeholder="" aria-describedby="img">
            </div>
            <div class="form-group">
              <label for="usuario">Usuario</label>
              <input type="text" name="usuario" id="usuario" class="form-control" placeholder="" aria-describedby="usuario">
            </div>
            <div class="form-group">
              <label for="contraseña">Contraseña</label>
              <input type="password" name="contrasena" id="contrasena" class="form-control" placeholder="" aria-describedby="contrasena">
            </div>
            <div class="form-group">
              <label for="correo">Email</label>
              <input type="email" name="correo" id="correo" class="form-control" placeholder="" aria-describedby="correo">
            </div>
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" aria-describedby="nombre">
            </div>
            <div class="form-group">
              <label for="apellido">Apellido</label>
              <input type="text" name="apellido" id="apellido" class="form-control" placeholder="" aria-describedby="apellido">
            </div>
            <div class="form-group">
              <label for="telefono">Celular</label>
              <input type="number" name="telefono" id="telefono" class="form-control" placeholder="" aria-describedby="telefono">
            </div>
            <div class="form-group">
              <label for="ciudad">Localidad</label>
              <select name="ciudad" id="ciudad" class="form-control" placeholder="" aria-describedby="ciudad">
                <?php $qer = $bd->query("SELECT * FROM ciudades");
                      while($dt = $qer->fetch()):
                ?>
                <option value="<?= $dt['id'] ?>"><?= $dt['nombre'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="rol">Rol</label>
              <select name="rol" id="rol" class="form-control" placeholder="" aria-describedby="rol">
                <option value="admin">Admin</option>
                <option value="cliente">Cliente</option>
              </select>
            </div>
            <div class="form-group">
              <button name="submit" class="btn btn-primary btn-block">Agregar</button>
            </div>
          </form>
        </div>
      </div>


    </div>


    <!-- Footer -->
    
  </div>

