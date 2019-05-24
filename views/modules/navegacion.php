<?php
  session_start();
?>
<header class="main-header">
    <!-- Logo -->
    <a href="index.php?action=dashboard" class="logo" >
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>S</b>GH</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Sistema gestor </b>Hotel</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top"  style="border: 1px solid gray;">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <?php if(isset($_SESSION['usuario'])){ ?>
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <span class="hidden-xs"><?php echo "Usuario: ".$_SESSION['usuario']['user_name']; ?></span>
                <i class="fa fa-fw fa-info-circle"></i>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <p>
                    <?php echo "Rol: ".$_SESSION['usuario']['tipo_usuario']; ?>
                  </p>
                  <p>
                    <?php echo "Nombre: ".$_SESSION['usuario']['nombres']." ".$_SESSION['usuario']['paterno']." ".$_SESSION['usuario']['materno']; ?>
                  </p>
                </li>
                
              </ul>
            </li>
          <?php } ?>
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
      

<?php if(isset($_SESSION['usuario'])){
        if($_SESSION['usuario']['tipo_usuario']=="admin"){?>      
        <li class="header">PROCESOS - ADMINISTRADOR</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-fw fa-building-o"></i> <span>Habitaciones</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php?action=agregar_habitacion"><i class="fa fa-fw fa-plus"></i> Nueva habitación</a></li>
            <li><a href="index.php?action=ver_habitaciones"><i class="fa fa-fw fa-list"></i> Ver listado</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-fw fa-male"></i> <span>Clientes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php?action=agregar_cliente"><i class="fa fa-fw fa-plus"></i> Nuevo cliente</a></li>
            <li><a href="index.php?action=ver_clientes"><i class="fa fa-fw fa-list"></i> Ver listado</a></li>
          </ul>
        </li>
        <li><a href="index.php?action=dashboard" disable><i class="fa fa-fw fa-line-chart"></i> <span>Visualizar ganancias</span></a></li>
<?php }if($_SESSION['usuario']['tipo_usuario']=="recepcionista"){?>
        <li class="header">PROCESOS - RECEPCIONISTA</li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-fw fa-book"></i> <span>Reservaciones</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php?action=agregar_reservacion"><i class="fa fa-fw fa-plus"></i> Nueva reservación</a></li>
            <li><a href="index.php?action=ver_reservaciones"><i class="fa fa-fw fa-list"></i> Ver listado</a></li>
          </ul>
        </li>
        <li><a href="index.php?action=habitaciones" disable><i class="fa fa-fw fa-hotel "></i> <span>Habitaciones</span></a></li>
<?php } } ?>
        <li class="header">OTROS</li>
<?php if(isset($_SESSION['usuario'])){
        if($_SESSION['usuario']['tipo_usuario']=="admin"){?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-fw fa-users"></i><span>Usuarios</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="index.php?action=agregar_usuario"><i class="fa fa-fw fa-plus"></i>Agregar usuario</a></li>
            <li><a href="index.php?action=ver_usuarios"><i class="fa fa-fw fa-list"></i>Ver listado</a></li>
          </ul>
        </li>
<?php }?>
        <li><a href="index.php?action=cerrar_sesion" disable><i class="fa fa-fw fa-sign-out"></i><span>Cerrar sesión</span></a></li>
<?php }else{?>
          <li><a href="index.php?action=login" disable><i class="fa fa-fw fa-sign-in"></i><span>Iniciar sesión</span></a></li>
      <li><a href="index.php?action=registrarse" disable><i class="fa fa-fw fa-user-plus"></i><span>Registrarse</span></a></li>
    </ul>
<?php }?>
    </section>
    <!-- /.sidebar -->
  </aside>