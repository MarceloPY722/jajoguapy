<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php
$id = $_GET['id'];
$req = $bd->prepare('select * from usuarios where id=:id');
$req->execute(['id' => $id]);
$data = $req->fetch();

if(isset($_POST['submit'])){
    $usuario = $_POST['usuario'];
    $contrasena = md5($_POST['contraseña']);
    $correo = $_POST['correo'];
    $rol = $_POST['rol'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $nombre_mascota = $_POST['nombre_mascota']; // Nuevo campo
    $req = $bd->prepare("UPDATE usuarios SET usuario=?, contrasena=?, correo=?, rol=?, nombre=?, apellido=?, telefono=?, nombre_mascota=? WHERE id=?");
    $req->execute([$usuario, $contrasena, $correo, $rol, $nombre, $apellido, $telefono, $nombre_mascota, $id]);
    header('location: /Jajoguapy/admin/user/index.php?msg=updated');
}
?>
<?php include '../include/header.php'; ?>
<div class="page-container">
  <?php include '../include/sidebar.php'; ?>
  <div class="main-content">
    <?php include '../include/menu.php'; ?>
    <hr />

    <div class="row">
      <h3>Modificar Usuario</h3>
      <br />
      <div class="card">
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <label for="img">Imagen</label>
              <input type="file" name="img" id="img" class="form-control" placeholder="" aria-describedby="img">
            </div>
            <div class="form-group">
              <label for="usuario">Usuario</label>
              <input value="<?= $data['usuario'] ?>" type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario" aria-describedby="usuario">
            </div>
            <div class="form-group">
              <label for="contraseña">Contraseña</label>
              <input value="<?= md5($data['contrasena']) ?>" type="password" name="contrasena" id="contrasena" class="form-control" placeholder="" aria-describedby="contrasena">
            </div>
            <div class="form-group">
              <label for="correo">Email</label>
              <input value="<?= $data['correo'] ?>" type="email" name="correo" id="correo" class="form-control" placeholder="" aria-describedby="correo">
            </div>
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input value="<?= $data['nombre'] ?>" type="text" name="nombre" id="nombre" class="form-control" placeholder="" aria-describedby="nombre">
            </div>
            <div class="form-group">
              <label for="apellido">Apellido</label>
              <input value="<?= $data['apellido'] ?>" type="text" name="apellido" id="apellido" class="form-control" placeholder="" aria-describedby="apellido">
            </div>
            <div class="form-group">
              <label for="telefono">Celular</label>
              <input value="<?= $data['telefono'] ?>" type="number" name="telefono" id="telefono" class="form-control" placeholder="" aria-describedby="telefono">
            </div>
            <div class="form-group">
              <label for="nombre_mascota">Nombre de la Mascota</label>
              <input value="<?= $data['nombre_mascota'] ?>" type="text" name="nombre_mascota" id="nombre_mascota" class="form-control" placeholder="Nombre de su primera mascota" aria-describedby="nombre_mascota">
            </div>
            <div class="form-group">
              <label for="rol">Rol</label>
              <select name="rol" id="rol" class="form-control" placeholder="" aria-describedby="rol">
                <option <?= ($data['rol'] == "admin") ? 'selected' : '' ?> value="admin">Admin</option>
                <option <?= ($data['rol'] == "cliente") ? 'selected' : '' ?> value="cliente">Cliente</option>
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