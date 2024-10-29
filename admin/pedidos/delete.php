<?php include '../include/session.php'; ?>
<?php
$title = "commande"; 
$id = $_GET['id'];
include '../include/connexion.php';
$req = $bd->prepare('DELETE FROM pedidos WHERE id=?');
$req->execute([$id]);
header('location: /Jajoguapy/admin/pedidos/index.php?msg=deleted');