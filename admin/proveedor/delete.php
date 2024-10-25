<?php include '../include/session.php'; ?>
<?php
$title = "proveedores"; 
$id= $_GET['id'];
include '../include/connexion.php';
$req = $bd->prepare('delete from proveedores where id=?');
$req->execute([$id]);
header('location: /Jajoguapy/admin/proveedor/index.php?msg=deleted');