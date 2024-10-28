<?php include '../include/session.php'; ?>
<?php
$id= $_GET['id'];
include '../include/connexion.php';
$req = $bd->prepare('delete from usuarios where id=?');
$req->execute([$id]);
header('location: /Jajoguapy/admin/user/index.php?msg=deleted');