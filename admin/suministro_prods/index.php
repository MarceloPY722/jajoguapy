<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php include '../include/header.php'; ?>
<?php $title = "abastecimientos_productos"; ?>

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
      <h3>Lista de suministro de productos</h3>
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
            <th>Imagen</th>
            <th>Producto</th>
            <th>Precio de Compra</th>
            <th>Cantidad</th>
            <th>Categoria</th>
            <th>Proveedor</th>
            <th>Accion</th>
            <th>Accion</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $req = $bd->query("SELECT p.*, r.imagen, r.nombre, r.precio_compra, c.nombre AS categoria_nombre, f.nombre AS proveedor_nombre 
                             FROM abastecimientos a, proveedores f, abastecimientos_productos p, productos r, categorias c
                             WHERE a.proveedor_id = f.id AND p.abastecimiento_id = a.id AND r.id = p.producto_id AND c.id = r.categoria_id");
          while($data = $req->fetch()):
          ?>
          <tr class="gradeA">
            <td><?= $data['id'] ?></td>
            <td><img width="100" src="../img/<?= $data['imagen'] ?>" alt=""></td>
            <td><?= $data['nombre'] ?></td>
            <td><?= $data['precio_compra'] ?></td>
            <td><?= $data['cantidad'] ?></td>
            <td><?= $data['categoria_nombre'] ?></td>
            <td><?= $data['proveedor_nombre'] ?></td>
            <td>
              <a href="/Jajoguapyv2/admin/abastecimientos_productos/update.php?id=<?= $data['id'] ?>"
                class="btn btn-default btn-sm btn-icon icon-left">
                <i class="entypo-pencil"></i>
                Editar
              </a>
            </td>
            <td>
              <a href="/Jajoguapyv2/admin/abastecimientos_productos/delete.php?id=<?= $data['id'] ?>"
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
      </table>
    </div>
  </div>
</div>

<?php include '../include/footer.php'; ?>