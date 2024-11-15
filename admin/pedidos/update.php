<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php
$title = "Modificar Pedido"; 

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $rq = $bd->prepare("SELECT * FROM pedidos WHERE id = ?");
    $rq->execute([$id]);
    $data = $rq->fetch();

    if (!$data) {
        header('location: /Jajoguapy/admin/pedidos/index.php?msg=error');
        exit();
    }
} else {
    header('location: /Jajoguapy/admin/pedidos/index.php?msg=error');
    exit();
}

if (isset($_POST['submit'])) {
    $fecha = $_POST['fecha'];
    $usuario_id = $_POST['usuario'];
    $req = $bd->prepare("UPDATE pedidos SET fecha = ?, usuario_id = ? WHERE id = ?");
    $req->execute([$fecha, $usuario_id, $id]);
    header('location: /Jajoguapy/admin/pedidos/index.php?msg=updated');
    exit();
}
?>
<?php include '../include/header.php'; ?>

<div class="page-container">
  <?php include '../include/sidebar.php'; ?>

  <div class="main-content">
    <?php include '../include/menu.php'; ?>
    <hr />

    <div class="row">
      <h3>Modificar un Pedido</h3>
      <br />
      <div class="card">
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <label for="fecha">Fecha</label>
              <input value="<?= $data['fecha'] ?>" type="date" name="fecha" id="fecha" class="form-control" placeholder="" aria-describedby="fecha">
            </div>
            <div class="form-group">
              <label for="usuario">Usuario</label>
              <select name="usuario" id="usuario" class="form-control" placeholder="" aria-describedby="usuario">
                <?php $qer = $bd->query("SELECT * FROM usuarios");
                      while ($dt = $qer->fetch()):
                ?>
                <option <?= ($dt['id'] == $data['usuario_id']) ? 'selected' : '' ?> value="<?= $dt['id'] ?>"><?= $dt['usuario'] ?></option>
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