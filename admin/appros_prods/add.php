<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php
$title = "add appros_prods"; 
if(isset($_POST['submit'])){
$prod = $_POST['prod'];
$appro = $_POST['appro'];
$qte = $_POST['qte'];
$req = $bd->prepare("insert into appros_prods(prod_id,appro_id,qte) values(?,?,?)");
$req->execute([$prod,$appro,$qte]);
header('location: /Jajoguapyv2/admin/appros_prods/index.php?msg=added');
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
      <h3>Agregar un suministro a un producto</h3>
      <br />
      <div class="card">
        <div class="card-body">
          <form method="post">
          <div class="form-group">
              <label for="prod">Producto</label>
              <select name="prod" id="prod" class="form-control" placeholder="" aria-describedby="prod">
                <?php $qer=$bd->query("select * from produits");
                      while($dt = $qer->fetch()):
                ?>
                <option value="<?= $dt['id']?>"><?= $dt['libelle']?></option>
                <?php endwhile;?>
              </select>
            </div>
            <div class="form-group">
              <label for="appro">Suministrar</label>
              <select name="appro" id="appro" class="form-control" placeholder="" aria-describedby="appro">
                <?php $qer=$bd->query("select * from appros");
                      while($dt = $qer->fetch()):
                ?>
                <option value="<?= $dt['id']?>"><?= $dt['num']?></option>
                <?php endwhile;?>
              </select>
            </div>
            <div class="form-group">
              <label for="qte">Cantidad</label>
              <input type="number" name="qte" id="qte" class="form-control" placeholder="" aria-describedby="qte">
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