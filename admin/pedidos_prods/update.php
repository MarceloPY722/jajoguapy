<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php
$title = "add pedidos_prods";
$id = $_GET['id'];
$rq = $bd->prepare('SELECT * FROM pedidos_productos WHERE id=?');
$rq->execute([$id]);
$data = $rq->fetch();
if(isset($_POST['submit'])){
    $idproduit = $_POST['idproduit'];
    $idcmd = $_POST['idcmd'];
    $qte = $_POST['qte'];
    $req = $bd->prepare("UPDATE pedidos_productos SET producto_id=?, pedido_id=?, cantidad=? WHERE id=?");
    $req->execute([$idproduit, $idcmd, $qte, $id]);
    header('location: /jajoguapy/admin/pedidos_prods/index.php?msg=updated');
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
      <h3>Modificar un pedido de producto</h3>
      <br />
      <div class="card">
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <label for="idproduit">Producto</label>
              <select name="idproduit" id="idproduit" class="form-control" placeholder="" aria-describedby="idproduit">
                <?php $qer = $bd->query("SELECT * FROM productos");
                      while($dt = $qer->fetch()):
                ?>
                <option <?= ($data['producto_id'] == $dt['id']) ? 'selected' : '' ?> value="<?= $dt['id'] ?>"><?= $dt['nombre'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="idcmd">Pedido</label>
              <select name="idcmd" id="idcmd" class="form-control" placeholder="" aria-describedby="idcmd">
                <?php $qer = $bd->query("SELECT * FROM pedidos");
                      while($dt = $qer->fetch()):
                ?>
                <option <?= ($data['pedido_id'] == $dt['id']) ? 'selected' : '' ?> value="<?= $dt['id'] ?>"><?= $dt['id'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="qte">Cantidad</label>
              <input value="<?= $data['cantidad'] ?>" required type="number" name="qte" id="qte" class="form-control" placeholder="" aria-describedby="qte">
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