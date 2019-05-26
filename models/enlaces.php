<?php 

class Paginas{
	
	public function enlacesPaginasModel($enlaces){
		$nombres = ['eliminar_registro','ver_usuarios','ver_reservaciones','ver_habitaciones','ver_clientes','modificar_usuarios','modificar_reservaciones','modificar_habitaciones','modificar_clientes','agregar_cliente','agregar_habitacion','agregar_reservacion','agregar_usuario','cerrar_sesion','dashboard','login'];

		$module = "views/modules/login.php";//Se inicializa con una url por defecto, por si el parámetro no coincide con ningun valor en el arreglo así la variable de retorno ya contiene un valor, si coincide el parámetro con algún valor del arreglo solo se sobre escribe.
		for($i = 0;$i < count($nombres);$i ++)
			if($enlaces==$nombres[$i]){
				$module =  "views/modules/".$enlaces.".php";
			}
		
		return $module;

	}

}

?>