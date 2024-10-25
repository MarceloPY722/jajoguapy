<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php
$id = $_GET['id'];
$req = $bd->prepare('select * from categorias where id=:id');
$req->execute(['id' => $id]);
$data = $req->fetch();

if(isset($_POST['submit'])){
    $nombre = $_POST['nombre'];
    $req = $bd->prepare("update categorias set nombre=? WHERE id=?");
    $req->execute([$nombre, $id]);
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
                    <form method="post" >
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input value="<?= $data['nombre'] ?>" type="text" name="nombre" id="nombre" class="form-control" placeholder=""
                                aria-describedby="nombre">
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