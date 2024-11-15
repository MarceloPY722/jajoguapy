<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>

<?php
$title = "produit"; 
$id = $_GET['id'];
$req = $bd->prepare('SELECT * FROM productos WHERE id=?');
$req->execute([$id]);
$data = $req->fetch();
$categoria_id = $data['categoria_id'];
$req_categoria = $bd->prepare('SELECT descuentos FROM categorias WHERE id=?');
$req_categoria->execute([$categoria_id]);
$categoria_data = $req_categoria->fetch();
$descuento_categoria = $categoria_data['descuentos'];

if (isset($_POST['sub'])) {
    $image = $_FILES['image']['name'] ? basename($_FILES['image']['name']) : $data['imagen'];
    $path = '../img/' . $image;
    if ($_FILES['image']['name']) { 
        move_uploaded_file($_FILES['image']['tmp_name'], $path);
    }
    $nombre = $_POST['nombre'];
    $detalles = $_POST['detalles'];
    $precio_compra = $_POST['precio_compra'];
    $precio_venta = $_POST['precio_venta'];
    $cantidad_stock = $_POST['cantidad_stock'];
    $categoria = $_POST['categoria'];


    $precio_venta_con_descuento = $precio_venta * (1 - $descuento_categoria);

    $rq = $bd->prepare("UPDATE productos SET nombre=?, precio_compra=?, precio_venta=?, cantidad_stock=?, categoria_id=?, detalles=?, imagen=? WHERE id=?");
    $rq->execute([$nombre, $precio_compra, $precio_venta_con_descuento, $cantidad_stock, $categoria, $detalles, $image, $id]);
    
    header('location: /jajoguapy/admin/productos/index.php?msg=updated');
    exit; 
}
?>

<?php include '../include/header.php'; ?>

<div class="page-container">
  <?php include '../include/sidebar.php'; ?>
  
  <div class="main-content">
    <?php include '../include/menu.php'; ?>
    <hr />

    <div class="row">
      <h3>Modifica un Producto</h3>
      <br />
      <div class="card">
        <div class="card-body">
          <form method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="image">Imagen</label>
              <input type="file" name="image" id="image" class="form-control" aria-describedby="image">
              <?php if ($data['imagen']): ?>
                <img src="../img/<?= $data['imagen'] ?>" alt="Imagen del producto" style="max-width: 150px; display: block; margin-top: 10px;">
              <?php endif; ?>
            </div>
            <div class="form-group">
              <label for="nombre">Producto</label>
              <input value="<?= htmlspecialchars($data['nombre']) ?>" type="text" name="nombre" id="nombre" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="detalles">Detalles</label>
              <textarea class="form-control" name="detalles" id="detalles" cols="30" rows="5" required><?= htmlspecialchars($data['detalles']) ?></textarea>
            </div>
            <div class="form-group">
              <label for="precio_compra">Precio de Compra</label>
              <input value="<?= htmlspecialchars($data['precio_compra']) ?>" type="number" name="precio_compra" id="precio_compra" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="precio_venta">Precio de Venta</label>
              <input value="<?= htmlspecialchars($data['precio_venta']) ?>" type="number" name="precio_venta" id="precio_venta" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="cantidad_stock">Cantidad</label>
              <input value="<?= htmlspecialchars($data['cantidad_stock']) ?>" type="number" name="cantidad_stock" id="cantidad_stock" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="categoria">Categoria</label>
              <select name="categoria" id="categoria" class="form-control" required>
                <?php 
                $qer = $bd->query("SELECT * FROM categorias");
                foreach ($qer as $dt): 
                ?>
                <option <?= ($data['categoria_id'] == $dt['id']) ? 'selected' : '' ?> value="<?= $dt['id'] ?>"><?= htmlspecialchars($dt['nombre']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Descuento de la Categoría:</label>
              <input type="text" class="form-control" value="<?= $descuento_categoria * 100 ?>%" readonly>
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