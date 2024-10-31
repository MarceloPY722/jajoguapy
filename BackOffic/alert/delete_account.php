<?php
include '../include/cnx.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
    $id = $_SESSION['id'];
    $req = $bd->prepare('DELETE FROM usuarios WHERE id = ?');
    $req->execute([$id]);

    session_destroy();
    header('Location: /jajoguapy/index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmar Eliminación</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Confirmar Eliminación</h4>
                    </div>
                    <div class="card-body">
                        <p>¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.</p>
                        <form method="post">
                            <button type="submit" name="confirm" class="btn btn-danger">Sí, eliminar mi cuenta</button>
                            <a href="../profile.php" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>