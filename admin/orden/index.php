<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php include '../include/header.php'; ?>
<?php $title = "Órdenes"; ?>

<div class="page-container">
  <!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->

  <!-- Start Sidebar -->
  <?php include '../include/sidebar.php'; ?>
  <!-- End Sidebar -->
  <div class="main-content">

    <!-- Start Menu -->
    <?php include '../include/menu.php'; ?>
    <!-- End Menu -->
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
      <h3>Lista de Órdenes</h3>
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

          // Initalize Select Dropdown after DataTables is created
          $table3.closest('.dataTables_wrapper').find('select').select2({
            minimumResultsForSearch: -1
          });

          // Setup - add a text input to each footer cell
          $('#table-3 tfoot th').each(function() {
            var title = $('#table-3 thead th').eq($(this).index()).text();
            $(this).html('<input type="text" class="form-control" placeholder="Search ' + title + '" />');
          });

          // Apply the search
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
            <th>Orden ID</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Fecha de Creación</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $req = $bd->query("SELECT o.*, p.nombre AS producto_nombre FROM ordenes o JOIN productos p ON o.producto_id = p.id");
          while($data = $req->fetch()):
          ?>
          <tr class="gradeA">
            <td><?= $data['id'] ?></td>
            <td><?= $data['orden_id'] ?></td>
            <td><?= $data['producto_nombre'] ?></td>
            <td><?= $data['precio'] ?></td>
            <td><?= $data['fecha_creacion'] ?></td>
            <td>
              <a href="/Jajoguapy/admin/orden/update.php?id=<?= $data['id'] ?>"
                class="btn btn-default btn-sm btn-icon icon-left">
                <i class="entypo-pencil"></i>
                Editar
              </a>

              <a href="/Jajoguapy/admin/orden/delete.php?id=<?= $data['id'] ?>"
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
            <th>Orden ID</th>
            <th>Producto</th>
            <th>Precio</th>
            <th>Fecha de Creación</th>
            <th>Acciones</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<?php include '../include/footer.php'; ?>