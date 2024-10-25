<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php
 $title = "add category";
if(isset($_POST['submit'])){
$nombre = $_POST['nombre'];
$req = $bd->prepare("insert into categorias(nombre) values(?)");
$req->execute([$nombre]);
header('location: /jajoguapy/admin/categoria/index.php?msg=added');
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
      <h3>Agregar Una Categoria</h3>
      <br />
      <div class="card">
        <div class="card-body">
          <form method="post">
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" name="nombre" id="nombre" class="form-control" placeholder="" aria-describedby="nombre">
            </div>
            <div class="form-group">
              <button name="submit" class="btn btn-primary btn-block">Agregar</button>
            </div>
          </form>
        </div>
      </div>


    </div>


    <footer class="main">

      &copy; 2024 <strong>Jajoguapy</strong> Panel Admin | Categorias 

    </footer>
  </div>

</div>


<?php include '../include/footer.php'; ?>