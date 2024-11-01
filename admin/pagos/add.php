<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php
$title = "Agregar Pago";

// Procesar el formulario de agregar pago
if (isset($_POST['submit'])) {
    $usuario_id = $_POST['usuario_id'];
    $producto_id = $_POST['producto_id'];
    $cantidad = $_POST['cantidad'];
    $precio = $_POST['precio'];
    $fecha_pago = $_POST['fecha_pago'];
    $email_pagos = $_POST['email_pagos'];
    $tipo_tarjeta = $_POST['tipo_tarjeta'];
    $numero_tarjeta = password_hash($_POST['numero_tarjeta'], PASSWORD_BCRYPT); // Hash del número de tarjeta
    $vencimiento = $_POST['vencimiento'];
    $cvv = password_hash($_POST['cvv'], PASSWORD_BCRYPT); // Hash del CVV

    $req = $bd->prepare("
        INSERT INTO pagos (usuario_id, producto_id, cantidad, precio, fecha_pago, email_pagos, tipo_tarjeta, numero_tarjeta, vencimiento, cvv)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $req->execute([$usuario_id, $producto_id, $cantidad, $precio, $fecha_pago, $email_pagos, $tipo_tarjeta, $numero_tarjeta, $vencimiento, $cvv]);

    header('location: /jajoguapy/admin/pagos/index.php?msg=added');
}

// Obtener la lista de usuarios y productos para los select
$usuarios = $bd->query("SELECT * FROM usuarios");
$productos = $bd->query("SELECT * FROM productos");
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
              <label for="producto_id">Producto</label>
              <select name="producto_id" id="producto_id" class="form-control">
                <?php while ($producto = $productos->fetch()): ?>
                  <option value="<?= $producto['id'] ?>"><?= $producto['nombre'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="cantidad">Cantidad</label>
              <input type="number" name="cantidad" id="cantidad" class="form-control">
            </div>
            <div class="form-group">
              <label for="precio">Precio</label>
              <input type="number" name="precio" id="precio" class="form-control">
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
              <label for="tipo_tarjeta">Tipo de Tarjeta</label>
              <input type="text" name="tipo_tarjeta" id="tipo_tarjeta" class="form-control">
            </div>
            <div class="form-group">
              <label for="numero_tarjeta">Número de Tarjeta</label>
              <input type="text" name="numero_tarjeta" id="numero_tarjeta" class="form-control">
            </div>
            <div class="form-group">
              <label for="vencimiento">Vencimiento</label>
              <input type="text" name="vencimiento" id="vencimiento" class="form-control">
            </div>
            <div class="form-group">
              <label for="cvv">CVV</label>
              <input type="text" name="cvv" id="cvv" class="form-control">
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