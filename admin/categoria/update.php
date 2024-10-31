<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php
$id = $_GET['id'];
$req = $bd->prepare('select * from categorias where id=:id');
$req->execute(['id' => $id]);
$data = $req->fetch();

if(isset($_POST['submit'])){
    $nombre = $_POST['nombre'];
    $descuento_activo = isset($_POST['descuento_activo']) ? 1 : 0;
    $descuento_porcentaje = $_POST['descuento_porcentaje'];

    // Si el descuento no está activo, establece el porcentaje a 0
    if (!$descuento_activo) {
        $descuento_porcentaje = 0;
    }

    // Convertir el porcentaje a un valor decimal (por ejemplo, 20% a 0.20)
    $descuento_porcentaje = $descuento_porcentaje / 100;

    $req = $bd->prepare("update categorias set nombre=?, descuentos=? WHERE id=?");
    $req->execute([$nombre, $descuento_porcentaje, $id]);
    header('location: /jajoguapy/admin/categoria/index.php?msg=updated');
}
?>
<?php include '../include/header.php'; ?>

<div class="page-container">
    <?php include '../include/sidebar.php'; ?>
    <div class="main-content">
        <?php include '../include/menu.php'; ?>
        <hr />
        <div class="row">
            <h3>Modificar Categoria</h3>
            <br />
            <div class="card">
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input value="<?= $data['nombre'] ?>" type="text" name="nombre" id="nombre" class="form-control" placeholder="" aria-describedby="nombre">
                        </div>
                        <div class="form-group">
                            <label for="descuento_activo">Aplicar Descuento</label>
                            <input type="checkbox" name="descuento_activo" id="descuento_activo" <?= $data['descuentos'] > 0 ? 'checked' : '' ?>>
                        </div>
                        <div class="form-group" id="descuento_porcentaje_group" style="display: <?= $data['descuentos'] > 0 ? 'block' : 'none' ?>;">
                            <label for="descuento_porcentaje">Porcentaje de Descuento</label>
                            <input value="<?= $data['descuentos'] * 100 ?>" type="number" name="descuento_porcentaje" id="descuento_porcentaje" class="form-control" placeholder="0" step="1" min="0" max="100">
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

<script>
document.getElementById('descuento_activo').addEventListener('change', function() {
    var descuentoPorcentajeGroup = document.getElementById('descuento_porcentaje_group');
    if (this.checked) {
        descuentoPorcentajeGroup.style.display = 'block';
    } else {
        descuentoPorcentajeGroup.style.display = 'none';
    }
});
</script>

<?php include '../include/footer.php'; ?>