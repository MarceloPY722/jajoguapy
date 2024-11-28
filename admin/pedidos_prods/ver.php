<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php include '../include/header.php'; ?>
<?php $title = "Ver Productos"; ?>

<div class="page-container">
    <?php include '../include/sidebar.php'; ?>

    <div class="main-content">
        <?php include '../include/menu.php'; ?>
        <hr />
        
        <div class="row">
            <h3>Productos Añadidos por Usuario</h3>
            <br />

            <!-- Botón para retroceder -->
            <a href="/jajoguapy/admin/pedidos_prods/index.php" class="btn btn-primary">
                <i class="entypo-arrow-left"></i>
                Volver
            </a>
            
      



            <table class="table table-bordered datatable">
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $usuario_id = $_GET['usuario_id'];
                    $req = $bd->query("
                        SELECT 
                            p.nombre, 
                            p.precio_con_descuento, 
                            p.imagen, 
                            c.cantidad
                        FROM 
                            pedidos_productos c
                        JOIN 
                            productos p ON c.producto_id = p.id
                        JOIN 
                            pedidos m ON c.pedido_id = m.id
                        WHERE 
                            m.usuario_id = $usuario_id
                    ");
                    while($data = $req->fetch()):
                    ?>
                    <tr>
                        <td><img width="100" src="../img/<?= $data['imagen'] ?>" alt=""></td>
                        <td><?= $data['nombre'] ?></td>
                        <td><?= $data['precio_con_descuento'] ?></td>
                        <td><?= $data['cantidad'] ?></td>
                    </tr>
                    <?php
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
document.getElementById('printButton').addEventListener('click', function() {
    var usuarioId = <?php echo json_encode($_GET['usuario_id']); ?>;
    window.open('imprimir_productos_pdf.php?usuario_id=' + usuarioId, '_blank');
});
</script>
<?php include '../include/footer.php'; ?>