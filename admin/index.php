<?php include 'include/session.php'; ?>
<?php include 'include/header3.php'; ?>
<?php include 'include/connexion.php'; ?>
<?php $title = "Home"; 
$A = $bd->query("SELECT COUNT(*) FROM usuarios");
$dt = $A->fetch();
$B = $bd->query("SELECT COUNT(*) FROM productos");
$dt1 = $B->fetch();
$C = $bd->query("SELECT COUNT(*) FROM pedidos_productos");
$dt2 = $C->fetch();
$D = $bd->query("SELECT COUNT(*) FROM abastecimientos_productos");
$dt3 = $D->fetch();
?>

<div class="page-container">
  <?php include 'include/sidebar.php'; ?>
  
  <div class="main-content">
  <?php include 'include/menu.php'; ?>
      <hr />



    <div class="row">
      <div class="col-sm-3 col-xs-6">

        <div class="tile-stats tile-red">
          <div class="icon"><i class="entypo-users"></i></div>
          <div class="num" data-start="0" data-end="<?=$dt[0]?>" data-postfix="" data-duration="500" data-delay="0">0</div>

          <h3>Numero de Usuarios</h3>
        </div>

      </div>

      <div class="col-sm-3 col-xs-6">

        <div class="tile-stats tile-green">
          <div class="icon"><i class="entypo-chart-bar"></i></div>
          <div class="num" data-start="0" data-end="<?=$dt1[0]?>" data-postfix="" data-duration="500" data-delay="200">0</div>

          <h3>Productos</h3>
        </div>

      </div>

      <div class="clear visible-xs"></div>

      <div class="col-sm-3 col-xs-6">

        <div class="tile-stats tile-aqua">
          <div class="icon"><i class="entypo-mail"></i></div>
          <div class="num" data-start="0" data-end="<?=$dt2[0]?>" data-postfix="" data-duration="500" data-delay="200">0</div>

          <h3>Ordenes</h3>
        </div>

      </div>

      <div class="col-sm-3 col-xs-6">

        <div class="tile-stats tile-blue">
          <div class="icon"><i class="entypo-rss"></i></div>
          <div class="num" data-start="0" data-end="<?=$dt3[0]?>" data-postfix="" data-duration="500" data-delay="200">0</div>

          <h3>Suministros</h3>
        </div>

      </div>
    </div>

    <br />
  </div>

</div>

<?php include 'include/footer2.php'; ?>