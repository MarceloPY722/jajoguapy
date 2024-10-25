<?php include '../include/session.php'; ?>
<?php
$title = "pedidos_prods"; 
$id= $_GET['id'];
include '../include/connexion.php';
$req = $bd->prepare('delete from pedidos_productos where id=?');
$req->execute([$id]);
header('location: /Jajoguapy/admin/pedidos_prods/index.php?msg=deleted');