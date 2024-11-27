<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php include '../include/header.php'; ?>
<?php $title = "Informe de Actividades"; ?>

<div class="page-container">
  <?php include '../include/sidebar.php'; ?>
  <div class="main-content">
    <?php include '../include/menu.php'; ?>

    <hr />

    <div class="row">
      <div class="col-md-12">
        <?php if(isset($_GET['msg']) && $_GET['msg']=='success'): ?>
        <div class="alert alert-success">Operación exitosa
          <span data-dismiss="alert" class="close">&times;</span>
        </div>
        <?php endif; ?>
      </div>
    </div>

    <div class="row">
      <h3 style="display: inline;">Últimas 10 Actividades</h3>

      <li class="has-sub" style="list-style-type: none; display: inline; float: right; margin-top: -10px;">
        <a href="/jajoguapy/admin/print/informe_print.php" target="_blank" style="color:#fff; background-color: #007bff; padding: 10px 15px; border-radius: 5px;">
          <i class="entypo-print"></i>
          <span class="title">Imprimir</span>
        </a>
      </li>

      <br />

      <table class="table table-bordered datatable" id="table-3">
        <thead>
          <tr class="replace-inputs">
            <th>#</th>
            <th>Usuario</th>
            <th>Acción</th>
            <th>Detalle</th>
            <th>Hora</th>
          </tr>
        </thead>
        <tbody>
          <?php
            
            $req = $bd->query("
              (SELECT 'Usuario Creado' AS accion, u.nombre AS usuario, u.fecha_creacion AS hora, 'Usuario creado' AS detalle
               FROM usuarios u
               ORDER BY u.fecha_creacion DESC
               LIMIT 10)
              UNION
              (SELECT 'Pedido Realizado' AS accion, u.nombre AS usuario, p.fecha_creacion AS hora, CONCAT('Pedido #', p.id) AS detalle
               FROM pedidos p
               JOIN usuarios u ON p.usuario_id = u.id
               ORDER BY p.fecha_creacion DESC
               LIMIT 10)
              UNION
              (SELECT 'Producto Agregado' AS accion, 'Admin' AS usuario, pr.fecha_creacion AS hora, pr.nombre AS detalle
               FROM productos pr
               ORDER BY pr.fecha_creacion DESC
               LIMIT 10)
              UNION
              (SELECT 'Proveedor Agregado' AS accion, 'Admin' AS usuario, prov.fecha_creacion AS hora, prov.nombre AS detalle
               FROM proveedores prov
               ORDER BY prov.fecha_creacion DESC
               LIMIT 10)
      
              
              UNION
              (SELECT 'Producto en Pedido' AS accion, 'Admin' AS usuario, pp.fecha_creacion AS hora, CONCAT('Producto #', pp.producto_id, ' en Pedido #', pp.pedido_id) AS detalle
               FROM pedidos_productos pp
               ORDER BY pp.fecha_creacion DESC
               LIMIT 10)
              ORDER BY hora DESC
              LIMIT 10
            ");

            $actividades = $req->fetchAll();
            $contador = 1;
            foreach ($actividades as $data):
          ?>
          <tr class="gradeA">
            <td><?= $contador ?></td>
            <td><?= $data['usuario'] ?></td>
            <td><?= $data['accion'] ?></td>
            <td><?= $data['detalle'] ?></td>
            <td><?= $data['hora'] ?></td>
          </tr>
          <?php
            $contador++;
            endforeach;
          ?>
        </tbody>
        <tfoot>
          <tr>
            <th>#</th>
            <th>Usuario</th>
            <th>Acción</th>
            <th>Detalle</th>
            <th>Hora</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<?php include '../include/footer.php'; ?>