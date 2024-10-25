<style>
  .page-container .sidebar-menu #main-menu li.active > a {
    background-color: #9772FB;
    color: #fff;
  }
  .page-container .sidebar-menu #main-menu li ul > li {
    border-bottom: 1px solid #fff;
  }
  .page-container .sidebar-menu #main-menu li ul > li > a {
    background-color: #9772FB;
    padding-left: 40px;
  }
  .page-container .sidebar-menu #main-menu li ul > li > a:hover {
    background-color: rgba(69, 74, 84, 0.3);
  }
</style>
<div class="sidebar-menu" style="background: #764AF1">

  <div class="sidebar-menu-inner">

    <header class="logo-env">

     
      <div class="logo">
        <a href="index.php">
         
        </a>
      </div>

      <!-- logo collapse icon -->
      <div class="sidebar-collapse">
        <a href="#" class="sidebar-collapse-icon" style="border: 1px solid #fff;">
        
          <i class="entypo-menu" style="color:#fff"></i>
        </a>
      </div>

      <div class="sidebar-mobile-menu visible-xs">
        <a href="#" class="with-animation">
       
          <i class="entypo-menu"></i>
        </a>
      </div>

    </header>

    <ul id="main-menu" class="main-menu">
      <li class=" <?= ($title=="Home")?'active':'' ?>">
        <a href="/jajoguapy/admin/index.php" style="color:#fff">
          <i class="entypo-home"></i>
          <span class="title">Inicio</span>
        </a>
      </li>
      
      <!-- Start item menu -->
      <li class="has-sub <?= ($title=="category" || $title=="add category")?'active':'' ?>">
        <a href="/jajoguapy/admin/categoria/index.php" style="color:#fff">
          <i class="entypo-layout"></i>
          <span class="title">Categorias</span>
        </a>
        <ul>
          <li class="<?= ($title=="category")?'active':'' ?>">
            <a href="/jajoguapy/admin/categoria/" style="color:#fff">
              <i class="entypo-list"></i>
              <span class="title">Lista de Categorias</span>
            </a>
          </li>
          <li class="<?= ($title=="add category")?'active':'' ?>">
            <a href="/jajoguapy/admin/categoria/add.php" style="color:#fff">
              <i class="entypo-plus-squared"></i>
              <span class="title">Agregar una categoría</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End item menu -->
      <!-- Start item menu -->
      <li class="has-sub <?= ($title=="user" || $title=="add user")?'active':''?>">
        <a href="/jajoguapy/admin/user/" style="color:#fff">
          <i class="entypo-user"></i>
          <span class="title">Usuarios</span>
        </a>
        <ul>
          <li class="<?= ($title=="user")?'active':'' ?>">
            <a href="/jajoguapy/admin/user/" style="color:#fff">
              <i class="entypo-list"></i>
              <span class="title">Lista de Usuarios</span>
            </a>
          </li>
          <li class="<?= ($title=="add user")?'active':'' ?>">
            <a href="/jajoguapy/admin/user/add.php" style="color:#fff">
              <i class="entypo-user-add"></i>
              <span class="title">Agregar Usuarios</span>
            </a>
          </li>
        </ul>
      </li>
      <!-- End item menu -->
      <li class="has-sub <?= ($title=="produit" || $title=="add produit")?'active':''?>">
        <a href="/jajoguapy/admin/productos/" style="color:#fff">
          <i class="entypo-bag"></i>
          <span class="title">Productos</span>
        </a>
        <ul>
          <li class="<?= ($title=="produit")?'active':'' ?>">
            <a href="/jajoguapy/admin/productos/" style="color:#fff">
              <i class="entypo-list"></i>
              <span class="title">Lista de Productos</span>
            </a>
          </li>
          <li class="<?= ($title=="add produit")?'active':'' ?>">
            <a href="/jajoguapy/admin/productos/add.php" style="color:#fff">
              <i class="entypo-plus-squared"></i>
              <span class="title">Agregar un producto</span>
            </a>
          </li>
        </ul>
      </li>

      <!--Proveedores-->
      <li class="has-sub <?= ($title=="proveedor" || $title=="add proveedor")?'active':''?>">
        <a href="/jajoguapy/admin/proveedor/" style="color:#fff">
          <i class="entypo-vcard"></i>
          <span class="title">Proveedores</span>
        </a>
        <ul>
          <li class="<?= ($title=="proveedor")?'active':'' ?>">
            <a href="/jajoguapy/admin/proveedor/" style="color:#fff">
              <i class="entypo-list"></i>
              <span class="title">Lista de Proveedores</span>
            </a>
          </li>
          <li class="<?= ($title=="add proveedor")?'active':'' ?>">
            <a href="/jajoguapy/admin/proveedor/add.php" style="color:#fff">
              <i class="entypo-plus-squared"></i>
              <span class="title">Agregar Proveedores</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="has-sub <?= ($title=="pedidos" || $title=="add pedidos")?'active':''?>">
        <a href="/admin/pedidos/" style="color:#fff">
          <i class="entypo-basket"></i>
          <span class="title">Pedidos</span>
        </a>
        <ul>
          <li class="<?= ($title=="pedidos")?'active':'' ?>">
            <a href="/jajoguapy/admin/pedidos/" style="color:#fff">
              <i class="entypo-list"></i>
              <span class="title">Lista de Pedidos</span>
            </a>
          </li>
          <li class="<?= ($title=="add pedidos")?'active':'' ?>">
            <a href="/jajoguapy/admin/pedidos/add.php" style="color:#fff">
              <i class="entypo-plus-squared"></i>
              <span class="title">Añadir un pedido</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="has-sub <?= ($title=="pedidos_prods" || $title=="add pedidos_prods")?'active':''?>">
        <a href="/jajoguapy/admin/pedidos_prods/" style="color:#fff">
          <i class="entypo-publish"></i>
          <span class="title">Pedidos de productos</span>
        </a>
        <ul>
          <li class="<?= ($title=="pedidos_prods")?'active':'' ?>">
            <a href="/jajoguapy/admin/pedidos_prods/" style="color:#fff">
              <i class="entypo-list"></i>
              <span class="title">Lista de pedidos de productos</span>
            </a>
          </li>
          <li class="<?= ($title=="add pedidos_prods")?'active':'' ?>">
            <a href="/jajoguapy/admin/pedidos_prods/add.php" style="color:#fff">
              <i class="entypo-plus-squared"></i>
              <span class="title">Agregar un pedido de producto</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="has-sub <?= ($title=="suministro" || $title=="add suministro")?'active':''?>">
        <a href="/jajoguapy/admin/suministro/" style="color:#fff">
          <i class="entypo-arrows-ccw"></i>
          <span class="title">Suministros</span>
        </a>
        <ul>
          <li class="<?= ($title=="suministro")?'active':'' ?>">
            <a href="/jajoguapy/admin/suministro/" style="color:#fff">
              <i class="entypo-list"></i>
              <span class="title">Lista de Suministros</span>
            </a>
          </li>
          <li class="<?= ($title=="add suministro")?'active':'' ?>">
            <a href="/jajoguapy/admin/suministro/add.php" style="color:#fff">
              <i class="entypo-plus-squared"></i>
              <span class="title">Agregar Suministros</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="has-sub <?= ($title=="suministro_prods" || $title=="add suministro_prods")?'active':''?>">
        <a href="/jajoguapy/admin/suministro_prods/" style="color:#fff">
          <i class="entypo-clipboard"></i>
          <span class="title">Suministros de productos</span>
        </a>
        <ul>
          <li class="<?= ($title=="suministro_prods")?'active':'' ?>">
            <a href="/jajoguapy/admin/suministro_prods/" style="color:#fff">
              <i class="entypo-list"></i>
              <span class="title">Lista de Suministros de Productos</span>
            </a>
          </li>
          <li class="<?= ($title=="add suministro_prods")?'active':'' ?>">
            <a href="/jajoguapy/admin/suministro_prods/add.php" style="color:#fff">
              <i class="entypo-plus-squared"></i>
              <span class="title">Agregar Suministros de Productos</span>
            </a>
          </li>
        </ul>
      </li>

      <li class="has-sub">
        <a href="/jajoguapy/index.php" style="color:#fff" target="_blank">
          <i class="entypo-eye"></i>
          <span class="title">Vista de Visitante</span>
        </a>
      </li>
    </ul>

  </div>

</div>