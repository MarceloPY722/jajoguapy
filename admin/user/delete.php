<?php include '../include/session.php'; ?>
<?php
$id= $_GET['id'];
include '../include/connexion.php';
$req = $bd->prepare('delete from users where id=?');
$req->execute([$id]);
header('location: /Jajoguapyv2/admin/user/index.php?msg=deleted');