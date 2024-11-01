<?php include '../include/session.php'; ?>
<?php
$id = $_GET['id'];
$title = "Eliminar Pago";
include '../include/connexion.php';

// Verificar si el pago existe
$req = $bd->prepare('SELECT * FROM pagos WHERE id = ?');
$req->execute([$id]);
$pago = $req->fetch();

if (!$pago) {
    header('location: /Jajoguapy/admin/pagos/index.php?msg=error');
    exit();
}

// Eliminar el pago
$req = $bd->prepare('DELETE FROM pagos WHERE id = ?');
$req->execute([$id]);

header('location: /Jajoguapy/admin/pagos/index.php?msg=deleted');
?>