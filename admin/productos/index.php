<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php include '../include/header.php'; ?>
<?php $title = "productos"; ?>

<div class="page-container">
  <?php include '../include/sidebar.php'; ?>
  <div class="main-content">
    <?php include '../include/menu.php'; ?>
    <hr />

    <div class="row">
      <div class="col-md-12">
        <?php if(isset($_GET['msg']) && $_GET['msg']=='added'): ?>
        <div class="alert alert-success">Agregado exitosamente
          <span data-dismiss="alert" class="close">&times;</span>
        </div>
        <?php endif; ?>
        <?php if(isset($_GET['msg']) && $_GET['msg']=='deleted'): ?>
        <div class="alert alert-danger">Eliminado exitosamente
          <span data-dismiss="alert" class="close">&times;</span>
        </div>
        <?php endif; ?>
        <?php if(isset($_GET['msg']) && $_GET['msg']=='updated'): ?>
        <div class="alert alert-warning">Modificado exitosamente
          <span data-dismiss="alert" class="close">&times;</span>
        </div>
        <?php endif; ?>
      </div>
    </div>
    <div class="row">
      <h3>Lista de Productos</h3>
      <li class="has-sub" style="list-style-type: none; display: inline; float: right; margin-top: -10px;">
        <a href="/jajoguapy/admin/print/prod_print.php" target="_blank" style="color:#fff; background-color: #007bff; padding: 10px 15px; border-radius: 5px;">
          <i class="entypo-print"></i>
          <span class="title">Imprimir</span>
        </a>
      </li>
      <br />

      <script type="text/javascript">
      jQuery(document).ready(function($) {
          var $table3 = jQuery("#table-3");

          var table3 = $table3.DataTable({
              "aLengthMenu": [
                  [10, 25, 50, -1],
                  [10, 25, 50, "All"]
              ],
              initComplete: function () {
                  // Agrega el input de búsqueda en cada columna del pie de tabla
                  this.api().columns().every(function() {
                      var column = this;
                      $('input', column.footer()).on('keyup change clear', function() {
                          if (column.search() !== this.value) {
                              column.search(this.value).draw();
                          }
                      });
                  });
              }
          });

          // Aplica select2 para el menú de longitud de página
          $table3.closest('.dataTables_wrapper').find('select').select2({
              minimumResultsForSearch: -1
          });

          // Coloca un input en cada columna de la fila del pie de tabla
          $('#table-3 tfoot th').each(function() {
              var title = $('#table-3 thead th').eq($(this).index()).text();
              $(this).html('<input type="text" class="form-control" placeholder="Buscar ' + title + '" />');
          });
      });
      </script>

      <table class="table table-bordered datatable" id="table-3">
        <thead>
          <tr class="replace-inputs">
            <th>#</th>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio de Compra</th>
            <th>Precio de Venta</th>
            <th>Descuento</th>
            <th>Precio con Descuento</th>
            <th>Cantidad</th>
            <th>Categoria</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </tfoot>
        <tbody>
          <?php
          $req = $bd->query("SELECT p.*, c.nombre AS categoria_nombre, c.descuentos FROM productos p, categorias c WHERE c.id = p.categoria_id");
          while($data = $req->fetch()):
            $precio_con_descuento = $data['precio_venta'] * (1 - $data['descuentos']);
          ?>
          <tr class="gradeA">
            <td><?= $data['id'] ?></td>
            <td><img width="100" src="../img/<?= $data['imagen'] ?>" alt="<?= $data['nombre'] ?>"></td>
            <td><?= $data['nombre'] ?></td>
            <td>₲ <?= number_format($data['precio_compra'], 0, ',', '.') ?></td>
            <td>₲ <?= number_format($data['precio_venta'], 0, ',', '.') ?></td>
            <td><?= $data['descuentos'] * 100 ?>%</td>
            <td>₲ <?= number_format($precio_con_descuento, 0, ',', '.') ?></td>
            <td><?= $data['cantidad_stock'] ?></td>
            <td><?= $data['categoria_nombre'] ?></td>
            <td>
              <a href="/jajoguapy/admin/productos/update.php?id=<?= $data['id'] ?>" class="btn btn-default btn-sm btn-icon icon-left">
                <i class="entypo-pencil"></i> Editar
              </a>
              <a href="/jajoguapy/admin/productos/delete.php?id=<?= $data['id'] ?>" class="btn btn-danger btn-sm btn-icon icon-left">
                <i class="entypo-cancel"></i> Eliminar
              </a>
            </td>
          </tr>
          <?php
          endwhile;
          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php include '../include/footer.php'; ?>
