<?php include '../include/session.php'; ?>
<?php
$title = "abastecimientos_productos"; 
$id = $_GET['id'];
include '../include/connexion.php';
$req = $bd->prepare('delete from abastecimientos_productos where id=?');
$req->execute([$id]);
header('location: /Jajoguapyv2/admin/suministro_prods/index.php?msg=deleted');