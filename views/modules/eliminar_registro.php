<?php
 
	if(!isset($_SESSION['usuario'])&&$_SESSION['usuario']['tipo_usuario']!='admin'){
	    $URL="index.php?action=login";
	    echo "<script >document.location.href='{$URL}';</script>";
	    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
	}

	if(isset($_GET['id'])&&isset($_GET['tabla'])){
		$id = $_GET['id'];
		$tabla = $_GET['tabla'];
		MvcController::delete_registro($id,$tabla);
	}

    $URL="index.php?action=ver_$tabla";
    echo "<script >document.location.href='{$URL}';</script>";
    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
?>