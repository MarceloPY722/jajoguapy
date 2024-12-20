<?php include '../include/session.php'; ?>
<?php include '../include/connexion.php'; ?>
<?php include '../include/header.php'; ?>
<?php $title = "user"; ?>

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
      <h3 style="display: inline;">Lista de Usuarios</h3>

      <li class="has-sub" style="list-style-type: none; display: inline; float: right; margin-top: -10px;">
  <a href="/jajoguapy/admin/print/user_print.php" target="_blank" style="color:#fff; background-color: #007bff; padding: 10px 15px; border-radius: 5px;">
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
            <th>Email</th>
            <th>Rol</th>
            <th>Accion</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $req =  $bd->query("SELECT * FROM usuarios");
            while($data = $req->fetch()):
          ?>
          <tr class="gradeA">
            <td><?= $data['id'] ?></td>
            <td><?= $data['usuario'] ?></td>
            <td><?= $data['correo'] ?></td>
            <td><?= $data['rol'] ?></td>
            <td>
              <a href="/jajoguapy/admin/user/update.php?id=<?= $data['id'] ?>"
                class="btn btn-default btn-sm btn-icon icon-left">
                <i class="entypo-pencil"></i>
                Editar
              </a>

              <a href="/jajoguapy/admin/user/delete.php?id=<?= $data['id'] ?>"
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
            <th>Usuario</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Accion</th>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>

<?php include '../include/footer.php'; ?>
