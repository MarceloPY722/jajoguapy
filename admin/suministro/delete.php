<?php include '../include/session.php'; ?>
<?php
$title = "abastecimientos"; 
$id = $_GET['id'];
include '../include/connexion.php';
$req = $bd->prepare('delete from abastecimientos where id=?');
$req->execute([$id]);
header('location: /Jajoguapy/admin/suministro/index.php?msg=deleted');