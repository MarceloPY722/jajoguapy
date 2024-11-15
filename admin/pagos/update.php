<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php
$title = "Editar Pago";

// Obtener el ID del pago a editar
if (isset($_GET['id'])) {
    $pago_id = $_GET['id'];

    // Obtener los datos del pago
    $req = $bd->prepare("
        SELECT p.*, u.usuario, o.orden_id
        FROM pagos p
        JOIN usuarios u ON p.usuario_id = u.id
        JOIN ordenes o ON p.orden_id = o.orden_id
        WHERE p.id = ?
    ");
    $req->execute([$pago_id]);
    $pago = $req->fetch();

    // Si no se encuentra el pago, redirigir a la lista de pagos
    if (!$pago) {
        header('location: /jajoguapy/admin/pagos/index.php');
        exit();
    }
} else {
    header('location: /jajoguapy/admin/pagos/index.php');
    exit();
}

// Procesar el formulario de edición
if (isset($_POST['submit'])) {
    $usuario_id = $_POST['usuario_id'];
    $orden_id = $_POST['orden_id'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $fecha_pago = $_POST['fecha_pago'];
    $email_pagos = $_POST['email_pagos'];

    $req = $bd->prepare("
        UPDATE pagos
        SET usuario_id = ?, orden_id = ?, cantidad = ?, precio = ?, fecha_pago = ?, email_pagos = ?
        WHERE id = ?
    ");
    $req->execute([$usuario_id, $orden_id, $cantidad, $precio, $fecha_pago, $email_pagos, $pago_id]);

    header('location: /jajoguapy/admin/pagos/index.php?msg=updated');
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
      <h3>Editar Pago</h3>
      <br />
      <div class="card">
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <label for="usuario_id">Usuario</label>
              <select name="usuario_id" id="usuario_id" class="form-control">
                <?php while ($usuario = $usuarios->fetch()): ?>
                  <option value="<?= $usuario['id'] ?>" <?= $usuario['id'] == $pago['usuario_id'] ? 'selected' : '' ?>><?= $usuario['usuario'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="orden_id">Orden</label>
              <select name="orden_id" id="orden_id" class="form-control">
                <?php while ($orden = $ordenes->fetch()): ?>
                  <option value="<?= $orden['orden_id'] ?>" <?= $orden['orden_id'] == $pago['orden_id'] ? 'selected' : '' ?>><?= $orden['orden_id'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="cantidad">Cantidad</label>
              <input type="number" name="cantidad" id="cantidad" class="form-control" value="<?= $pago['cantidad'] ?>">
            </div>
            <div class="form-group">
              <label for="precio">Precio</label>
              <input type="number" name="precio" id="precio" class="form-control" value="<?= $pago['precio'] ?>">
            </div>
            <div class="form-group">
              <label for="fecha_pago">Fecha de Pago</label>
              <input type="datetime-local" name="fecha_pago" id="fecha_pago" class="form-control" value="<?= date('Y-m-d\TH:i', strtotime($pago['fecha_pago'])) ?>">
            </div>
            <div class="form-group">
              <label for="email_pagos">Email</label>
              <input type="email" name="email_pagos" id="email_pagos" class="form-control" value="<?= $pago['email_pagos'] ?>">
            </div>
            <div class="form-group">
              <button name="submit" class="btn btn-primary btn-block">Guardar Cambios</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <footer class="main">
      &copy; 2024 <strong>Jajoguapy</strong> Panel Admin | Pagos
    </footer>
  </div>
</div>

<?php include '../include/footer.php'; ?>