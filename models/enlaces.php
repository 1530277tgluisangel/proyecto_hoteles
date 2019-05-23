<?php 

class Paginas{
	
	public function enlacesPaginasModel($enlaces){

		if($enlaces == "ver_usuarios" || $enlaces == "ver_productos" || $enlaces == "realizar_reservacion" || $enlaces == "dashboard" || $enlaces == "cerrar_sesion" || $enlaces == "login"){

			$module =  "views/modules/".$enlaces.".php";
		}

		else {

			$module =  "views/modules/login.php";
		
		}
		
		return $module;

	}

}

?>