<?php include '../include/session.php'; ?>
<?php
$id = $_GET['id'];
$title = "Eliminar Orden";
include '../include/connexion.php';

// Verificar si la orden existe
$req = $bd->prepare('SELECT * FROM ordenes WHERE id = ?');
$req->execute([$id]);
$orden = $req->fetch();

if (!$orden) {
    header('location: /Jajoguapy/admin/orden/index.php?msg=error');
    exit();
}

// Eliminar la orden
$req = $bd->prepare('DELETE FROM ordenes WHERE id = ?');
$req->execute([$id]);

header('location: /Jajoguapy/admin/orden/index.php?msg=deleted');
?>