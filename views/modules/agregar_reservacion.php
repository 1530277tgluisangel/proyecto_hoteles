<?php
	
    if(!isset($_SESSION['usuario'])&&$_SESSION['usuario']['tipo_usuario']!='admin'){
      $URL="index.php?action=login";
      echo "<script >document.location.href='{$URL}';</script>";
      echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
    }
    $clientes = MvcController::show_clientes();
    $habitaciones = MvcController::show_habitaciones();
    
    $res = MvcController::insert_habitacion();
?>