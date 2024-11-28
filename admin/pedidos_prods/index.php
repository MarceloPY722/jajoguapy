<?php
include '../include/session.php';
include '../include/connexion.php';
include '../include/header.php';
$title = "pedidos_prods";

$req = $bd->query("
    SELECT 
        u.id AS usuario_id,
        u.usuario,
        COUNT(c.id) AS cantidad_productos
    FROM 
        usuarios u
    JOIN 
        pedidos m ON u.id = m.usuario_id
    JOIN 
        pedidos_productos c ON m.id = c.pedido_id
    GROUP BY 
        u.id, u.usuario
");
?>
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
          <th>Usuario</th>
          <th>Cantidad de Productos</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        while($data = $req->fetch()):
        ?>
        <tr class="gradeA">
          <td><?= $data['usuario_id'] ?></td>
          <td><?= $data['usuario'] ?></td>
          <td><?= $data['cantidad_productos'] ?></td>
          <td>
            <a href="/jajoguapy/admin/pedidos_prods/ver.php?usuario_id=<?= $data['usuario_id'] ?>"
              class="btn btn-primary btn-sm btn-icon icon-left">
              <i class="entypo-eye"></i>
              Ver
            </a>
           
            <a href="/jajoguapy/admin/print/imprimir_productos_pdf.php?usuario_id=<?= $data['usuario_id'] ?>"
              class="btn btn-success btn-sm btn-icon icon-left" target="_blank">
              <i class="entypo-print"></i>
              Imprimir
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
          <th>Usuario</th>
          <th>Cantidad de Productos</th>
          <th>Action</th>
        </tr>
      </tfoot>
    </table>
  </div>
</div>
</div>

<?php include '../include/footer.php'; ?>