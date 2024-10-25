<?php include '../include/session.php'; ?>
<?php
$id= $_GET['id'];
$title = "produit"; 
include '../include/connexion.php';
$req = $bd->prepare('delete from productos where id=?');
$req->execute([$id]);
header('location: /Jajoguapy/admin/productos/index.php?msg=deleted');