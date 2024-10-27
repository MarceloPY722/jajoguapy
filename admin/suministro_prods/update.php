<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php
$title = "add abastecimientos_productos"; 
$id = $_GET['id'];
$rq = $bd->prepare("select * from abastecimientos_productos where id=?");
$rq->execute([$id]);
$data = $rq->fetch();
if(isset($_POST['submit'])){
    $prod = $_POST['prod'];
    $abastecimiento = $_POST['abastecimiento'];
    $cantidad = $_POST['cantidad'];
    $req = $bd->prepare("update abastecimientos_productos set producto_id=?, abastecimiento_id=?, cantidad=? where id=?");
    $req->execute([$prod, $abastecimiento, $cantidad, $id]);
    header('location: /Jajoguapyv2/admin/abastecimientos_productos/index.php?msg=updated');
}
?>
<?php include '../include/header.php'; ?>

<div class="page-container">
  <?php include '../include/sidebar.php'; ?>
  <div class="main-content">
    <?php include '../include/menu.php'; ?>
    <hr />

    <div class="row">
      <h3>Editar un suministro de producto</h3>
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
                <option <?= ($data['producto_id'] == $dt['id']) ? 'selected' : '' ?> value="<?= $dt['id'] ?>"><?= $dt['nombre'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="abastecimiento">Suministrar</label>
              <select name="abastecimiento" id="abastecimiento" class="form-control" placeholder="" aria-describedby="abastecimiento">
                <?php $qer = $bd->query("select * from abastecimientos");
                      while($dt = $qer->fetch()):
                ?>
                <option <?= ($data['abastecimiento_id'] == $dt['id']) ? 'selected' : '' ?> value="<?= $dt['id'] ?>"><?= $dt['numero'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="cantidad">Cantidad</label>
              <input value="<?= $data['cantidad'] ?>" type="number" name="cantidad" id="cantidad" class="form-control" placeholder="" aria-describedby="cantidad">
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