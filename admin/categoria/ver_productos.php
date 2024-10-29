<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php include '../include/header.php'; ?>
<?php
$id = $_GET['id'];
$req = $bd->prepare('SELECT * FROM categorias WHERE id = ?');
$req->execute([$id]);
$categoria = $req->fetch();

$req = $bd->prepare('SELECT * FROM productos WHERE categoria_id = ?');
$req->execute([$id]);
$productos = $req->fetchAll();
?>

<div class="page-container">

  <?php include '../include/sidebar.php'; ?>
  
  <div class="main-content">

    <?php include '../include/menu.php'; ?>
  
    <hr />

    <div class="row">
      <h3><?= $categoria['nombre'] ?></h3>
      
      <br />

      <table class="table table-bordered datatable" id="table-3">
        <thead>
          <tr class="replace-inputs">
            <th>#</th>
            <th>Nombre</th>
            <th>Precio de Venta</th>
            <th>Stock</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($productos as $producto): ?>
          <tr class="gradeA">
            <td><?= $producto['id'] ?></td>
            <td><?= $producto['nombre'] ?></td>
            <td>₲ <?= number_format($producto['precio_venta'], 0, ',', '.') ?></td>
            <td><?= $producto['cantidad_stock'] ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
       
      </table>
    </div>

   
  </div>

</div>

<?php include '../include/footer.php'; ?>