<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php
$title = "Agregar Pago";

// Procesar el formulario de agregar pago
if (isset($_POST['submit'])) {
    $usuario_id = $_POST['usuario_id'];
    $orden_id = $_POST['orden_id'];
    $cantidad = $_POST['cantidad'];
    $preciototal = $_POST['preciototal'];
    $fecha_pago = $_POST['fecha_pago'];
    $email_pagos = $_POST['email_pagos'];

    $req = $bd->prepare("
        INSERT INTO pagos (usuario_id, orden_id, cantidad, preciototal, fecha_pago, email_pagos)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $req->execute([$usuario_id, $orden_id, $cantidad, $preciototal, $fecha_pago, $email_pagos]);

    header('location: /jajoguapy/admin/pagos/index.php?msg=added');
}

// Obtener la lista de usuarios y órdenes para los select
$usuarios = $bd->query("SELECT * FROM usuarios");
$ordenes = $bd->query("SELECT * FROM ordenes");
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
      <h3>Agregar Pago</h3>
      <br />
      <div class="card">
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <label for="usuario_id">Usuario</label>
              <select name="usuario_id" id="usuario_id" class="form-control">
                <?php while ($usuario = $usuarios->fetch()): ?>
                  <option value="<?= $usuario['id'] ?>"><?= $usuario['usuario'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="orden_id">Orden</label>
              <select name="orden_id" id="orden_id" class="form-control">
                <?php while ($orden = $ordenes->fetch()): ?>
                  <option value="<?= $orden['orden_id'] ?>"><?= $orden['orden_id'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="cantidad">Cantidad</label>
              <input type="number" name="cantidad" id="cantidad" class="form-control">
            </div>
            <div class="form-group">
              <label for="preciototal">Precio Total</label>
              <input type="number" name="preciototal" id="preciototal" class="form-control">
            </div>
            <div class="form-group">
              <label for="fecha_pago">Fecha de Pago</label>
              <input type="datetime-local" name="fecha_pago" id="fecha_pago" class="form-control">
            </div>
            <div class="form-group">
              <label for="email_pagos">Email</label>
              <input type="email" name="email_pagos" id="email_pagos" class="form-control">
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