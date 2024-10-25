<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php include '../include/header.php'; ?>
<?php $title = "pedidos_prods"; ?>

<div class="page-container">

  <?php include '../include/sidebar.php'; ?>

  <div class="main-content">
    <?php include '../include/menu.php'; ?>
    <hr />
    <div class="row">
      <div class="col-md-12">
        <?php if(isset($_GET['msg']) && $_GET['msg']=='added'): ?>
        <div class="alert alert-success">Agregado Exitosamente
          <span data-dismiss="alert" class="close">&times;</span>
        </div>
        <?php endif; ?>
        <?php if(isset($_GET['msg']) && $_GET['msg']=='deleted'): ?>
        <div class="alert alert-danger">Eliminado Exitosamente
          <span data-dismiss="alert" class="close">&times;</span>
        </div>
        <?php endif; ?>
        <?php if(isset($_GET['msg']) && $_GET['msg']=='updated'): ?>
        <div class="alert alert-warning">Modificado Exitosamente
          <span data-dismiss="alert" class="close">&times;</span>
        </div>
        <?php endif; ?>

      </div>
    </div>
    <div class="row">
      <h3>Lista de Pedidos</h3>
      <br />

      <script type="text/javascript">
      jQuery(document).ready(function($) {
        var $table3 = jQuery("#table-3");

        var table3 = $table3.DataTable({
          "aLengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
          ]
        });

        $table3.closest('.dataTables_wrapper').find('select').select2({
          minimumResultsForSearch: -1
        });

        $('#table-3 tfoot th').each(function() {
          var title = $('#table-3 thead th').eq($(this).index()).text();
          $(this).html('<input type="text" class="form-control" placeholder="Search ' + title + '" />');
        });

        table3.columns().every(function() {
          var that = this;

          $('input', this.footer()).on('keyup change', function() {
            if (that.search() !== this.value) {
              that
                .search(this.value)
                .draw();
            }
          });
        });
      });
      </script>

      <table class="table table-bordered datatable" id="table-3">
        <thead>
          <tr class="replace-inputs">
            <th>#</th>
            <th>Imagen</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Usuario</th>
            <th>Cantidad</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
					$req =  $bd->query("SELECT c.* , p.nombre, p.precio_venta, p.imagen, u.usuario FROM
                             pedidos_productos c, productos p, pedidos m, usuarios u
                             WHERE c.producto_id = p.id AND c.pedido_id = m.id AND m.usuario_id = u.id");
					while($data = $req->fetch()):
				?>
          <tr class="gradeA">
            <td><?= $data['id'] ?></td>
            <td><img width="100" src="../img/<?= $data['imagen'] ?>" alt=""></td>
            <td><?= $data['nombre'] ?></td>
            <td><?= $data['precio_venta'] ?></td>
            <td><?= $data['usuario'] ?></td>
            <td><?= $data['cantidad'] ?></td>
            <td>
              <a href="/jajoguapy/admin/pedidos_prods/update.php?id=<?= $data['id'] ?>"
                class="btn btn-default btn-sm btn-icon icon-left">
                <i class="entypo-pencil"></i>
                Editar
              </a>

              <a href="/jajoguapy/admin/pedidos_prods/delete.php?id=<?= $data['id'] ?>"
                class="btn btn-danger btn-sm btn-icon icon-left">
                <i class="entypo-cancel"></i>
                Eliminar
              </a>
            </td>
          </tr>
          <?php
					endwhile;
				?>
        </tbody>
        <tfoot>
          <tr>
            <th>#</th>
            <th>Imagen</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Usuario</th>
            <th>Cantidad</th>
            <th>Action</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<?php include '../include/footer.php'; ?>