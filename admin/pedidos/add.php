<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php
$title = "add commande"; 
if(isset($_POST['submit'])){
$num = $_POST['num'];
$date = $_POST['date'];
$user = $_POST['user'];
$req = $bd->prepare("INSERT INTO pedidos(fecha, usuario_id) VALUES(?, ?)");
$req->execute([$date, $user]);
header('location: /Jajoguapy/admin/pedidos/index.php?msg=added');
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
      <h3>Agregar un pedido</h3>
      <br />
      <div class="card">
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <label for="date">Fecha</label>
              <input type="date" name="date" id="date" class="form-control" placeholder="" aria-describedby="date">
            </div>
            <div class="form-group">
              <label for="user">Usuario</label>
              <select name="user" id="user" class="form-control" placeholder="" aria-describedby="user">
                <?php $qer = $bd->query("SELECT * FROM usuarios");
                      while($dt = $qer->fetch()):
                ?>
                <option value="<?= $dt['id']?>"><?= $dt['usuario']?></option>
                <?php endwhile;?>
              </select>
            </div>
            <div class="form-group">
              <button name="submit" class="btn btn-primary btn-block">Agregar</button>
            </div>
          </form>
        </div>
      </div>


    </div>


 
    
  </div>

