<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php
$title = "produit"; 
$id = $_GET['id'];
$req = $bd->prepare('SELECT * FROM productos WHERE id=?');
$req->execute([$id]);
$data = $req->fetch();
if(isset($_POST['sub'])){
    $image = basename($_FILES['image']['name']);
    $path = '../img/'.$image;
    $file = $_FILES['image']['tmp_name'];
    move_uploaded_file($file, $path);
    $nombre = $_POST['nombre'];
    $detalles = $_POST['detalles'];
    $precio_compra = $_POST['precio_compra'];
    $precio_venta = $_POST['precio_venta'];
    $cantidad_stock = $_POST['cantidad_stock'];
    $categoria = $_POST['categoria'];
    $rq = $bd->prepare("UPDATE productos SET nombre=?, precio_compra=?, precio_venta=?, cantidad_stock=?, categoria_id=?, detalles=? WHERE id=?");
    $rq->execute([$nombre, $precio_compra, $precio_venta, $cantidad_stock, $categoria, $detalles, $id]);
    header('location: /jajoguapy/admin/productos/index.php?msg=updated');
}
?>
<?php include '../include/header.php'; ?>

<div class="page-container">

  <!-- Start Sidebar -->
  <?php include '../include/sidebar.php'; ?>
  <!-- End Sidebar -->
  <div class="main-content">

    <!-- Start Menu -->
    <?php include '../include/menu.php'; ?>
    <!-- End Menu -->
    <hr />

    <div class="row">
      <h3>Modifica un Producto</h3>
      <br />
      <div class="card">
        <div class="card-body">
          <form method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="image">Imagen</label>
              <input value="c:/<?= $data['imagen'] ?>" type="file" name="image" id="image" class="form-control" placeholder="" aria-describedby="image">
            </div>
            <div class="form-group">
              <label for="nombre">Producto</label>
              <input value="<?= $data['nombre'] ?>" type="text" name="nombre" id="nombre" class="form-control" placeholder="" aria-describedby="nombre">
            </div>
            <div class="form-group">
              <label for="detalles">Detalles</label>
              <textarea class="form-control" name="detalles" id="detalles" cols="30" rows="5"><?= $data['detalles'] ?></textarea>
            </div>
            <div class="form-group">
              <label for="precio_compra">Precio de Compra</label>
              <input value="<?= $data['precio_compra'] ?>" type="number" name="precio_compra" id="precio_compra" class="form-control" placeholder="" aria-describedby="precio_compra">
            </div>
            <div class="form-group">
              <label for="precio_venta">Precio de Venta</label>
              <input value="<?= $data['precio_venta'] ?>" type="number" name="precio_venta" id="precio_venta" class="form-control" placeholder="" aria-describedby="precio_venta">
            </div>
            <div class="form-group">
              <label for="cantidad_stock">Cantidad</label>
              <input value="<?= $data['cantidad_stock'] ?>" type="number" name="cantidad_stock" id="cantidad_stock" class="form-control" placeholder="" aria-describedby="cantidad_stock">
            </div>
            <div class="form-group">
              <label for="categoria">Categoria</label>
              <select name="categoria" id="categoria" class="form-control" placeholder="" aria-describedby="categoria">
                <?php $qer = $bd->query("SELECT * FROM categorias");
                      foreach($qer as $dt):
                ?>
                <option <?= ($data['categoria_id'] == $dt['id']) ? 'selected' : '' ?> value="<?= $dt['id'] ?>"><?= $dt['nombre'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <button name="sub" class="btn btn-warning btn-block">Modificar</button>
            </div>
          </form>
        </div>
      </div>

    </div>

  </div>

</div>

<?php include '../include/footer.php'; ?>