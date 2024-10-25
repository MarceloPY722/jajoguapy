<?php include 'include/cnx.php'; ?>
<?php
$id = $_GET['id'];
$req = $bd->prepare('DELETE FROM pedidos WHERE id=?');
$req->execute([$id]);
header('location: orders.php?msg=deleted');