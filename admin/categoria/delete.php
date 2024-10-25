<?php include '../include/session.php'; ?>
<?php
$id = $_GET['id'];
include '../include/connexion.php';
$req = $bd->prepare(query: 'delete from categorias where id=?');
$req->execute([$id]);
header('location: /Jajoguapy/admin/categoria/index.php?msg=deleted');