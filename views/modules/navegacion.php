<?php
  session_start();
?>
<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Alexander Pierce</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <p>
                  Alexander Pierce - Web Developer
                </p>
              </li>
              
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
</header>

<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
      

<?php if(isset($_SESSION['id_usuario'])){?>      
        <li class="header">PROCESOS DEL NEGOCIO</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-fw fa-briefcase"></i> <span>Productos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php?action=agregar_producto"><i class="fa fa-fw fa-plus"></i> Nuevo producto</a></li>
            <li><a href="index.php?action=ver_productos"><i class="fa fa-fw fa-list"></i> Ver listado</a></li>
          </ul>
        </li>
        <li><a href="index.php?action=realizar_venta" disable><i class="fa fa-fw fa-calculator"></i> <span>Venta</span></a></li>
<?php }?>
        <li class="header">OTROS</li>
<?php if(isset($_SESSION['id_usuario'])){?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-fw fa-users"></i><span>Usuarios</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php?action=ver_usuarios"><i class="fa fa-fw fa-list"></i>Ver listado</a></li>
          </ul>
        </li>
<?php }if(isset($_SESSION['id_usuario'])){?>
        <li><a href="index.php?action=cerrar_sesion" disable><i class="fa fa-fw fa-sign-out"></i><span>Cerrar sesión</span></a></li>
<?php }else{?>
          <li><a href="index.php?action=login" disable><i class="fa fa-fw fa-sign-in"></i><span>Iniciar sesión</span></a></li>
      <li><a href="index.php?action=registrarse" disable><i class="fa fa-fw fa-user-plus"></i><span>Registrarse</span></a></li>
    </ul>
<?php }?>
    </section>
    <!-- /.sidebar -->
  </aside>