<?php

class MvcController{

	#LLAMADA A LA PLANTILLA
	#-------------------------------------

	public function pagina(){	
		
		include "views/template.php";
	
	}

	#ENLACES
	#-------------------------------------

	public function enlacesPaginasController(){
		$enlaces="index";
		if(isset( $_GET['action'])){
			
			$enlaces = $_GET['action'];
		
		}

		$respuesta = Paginas::enlacesPaginasModel($enlaces);
		

		include_once ($respuesta);

	}
	
	//Función que detecta el clic (con ayuda del protocolo POST) del botón cuyo name es 'registrar', validando esto procede a hacer una consulta con los datos ingresados en el form para ver si existen en la BD, de no ser asi se recarga el login 
	public function c_login(){
		if(isset($_POST['registrar'])){
			$datos_usuario = array('usuario' => $_POST['usuario'],
									'password' => $_POST['password'] );
			$datos = new Datos();

			$respuesta = $datos->m_login($datos_usuario);
			if(!empty($respuesta)){
				$_SESSION['usuario']=$respuesta;
			    $URL="index.php?action=dashboard";
			    echo "<script >document.location.href='{$URL}';</script>";
			    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
			}else{
				#header('location:index.php?action=registrar');
			    $URL="index.php?action=login";
			    echo "<script >document.location.href='{$URL}';</script>";
			    echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
			}
		}
	}

	public function get_tipos_habitaciones(){
		$return = Datos::get_tipos_habitaciones();
		return $return;
	}

	public function get_tipos_clientes(){
		$return = Datos::get_tipos_clientes();
		return $return;
	}

	public function get_tipos_usuarios(){
		$return = Datos::get_tipos_usuarios();
		return $return;
	}

	public function get_reservacion_by_id($id_reservacion){
		$return = Datos::get_reservacion_by_id($id_reservacion);
		return $return;
	}

	public function get_habitacion_by_id($id_habitacion){
		$return = Datos::get_habitacion_by_id($id_habitacion);
		return $return;
	}

	public function get_cliente_by_id($id_cliente){
		$return = Datos::get_cliente_by_id($id_cliente);
		return $return;
	}

	public function get_usuario_by_id($id_usuario){
		$return = Datos::get_usuario_by_id($id_usuario);
		return $return;
	}

	public function get_estados_habitaciones(){
		$return = Datos::get_estados_habitaciones();
		return $return;
	}
	//Solo existe una función para eliminar cualquier registro de cualquier tabla, esto se puede lograr porque el atributo llave primaria de todas las tablas se llama 'id' y es entero.
	public function delete_registro($id,$tabla){
		Datos::delete_registro($id,$tabla);
	}

	//
	public function insert_usuario(){
		if(isset($_POST['guardar'])){
			$datos_usuario = array('user_name' => $_POST['user_name'],
					'passw' => $_POST['passw'],
					'nombres' => $_POST['nombres'],
					'paterno' => $_POST['paterno'],
					'materno' => $_POST['materno'],
					'id_tipo_usuario' => $_POST['tipo_usuario'] );

			$res = Datos::insert_usuario($datos_usuario);
			return $res;
		}
		return 0;
	}

	public function insert_cliente(){
		if(isset($_POST['guardar'])){
			$datos_consulta = array('numero_cliente' => $_POST['numero_cliente'],
				'nombres' => $_POST['nombres'],
				'paterno' => $_POST['paterno'],
				'materno' => $_POST['materno'],
				'id_tipo_cliente' => $_POST['tipo_cliente']);
			$res = Datos::insert_cliente($datos_consulta);

			return $res;
		}
		return 0;
	}

	public function insert_habitacion(){
		$ruta_img = "views/img/habitaciones";

		if(isset($_POST['guardar'])){
			$nombre_fichero = 'foto_habitacion';
			$nombre_img = $_FILES[$nombre_fichero]['name'];
			if($this->subir_fichero($ruta_img,$nombre_fichero) == $nombre_img){
				$datos_consulta = array('numero'=>$_POST['numero'],
					'foto'=>$nombre_img,
					'descripcion'=>$_POST['descripcion'],
					'id_estado'=>$_POST['estado'],
					'id_tipo_habitacion'=>$_POST['tipo_habitacion']);

				$res = Datos::insert_habitacion($datos_consulta);
				return $res;
			}else
				return false;
		}
		return false;

	}
	
	public function insert_reservacion(){
		$fecha_actual=getdate();

		$d = $fecha_actual["mday"];
		$m = $fecha_actual["mon"];
		$y = $fecha_actual["year"];

		$fecha_actual=$y."-".$m."-".$d;

		if(isset($_POST['guardar'])){
			$datos_consulta = array('id_cliente' => $_POST['id_cliente'],
				'id_habitacion' => $_POST['id_habitacion'],
				'numero_reservacion' => $_POST['numero_reservacion'],
				'fecha_reserva' => $fecha_actual,
				'dias_estadia' => $_POST['dias_estadia']);
			$res = Datos::insert_reservacion($datos_consulta);
			Datos::update_estado_habitacion($_POST['id_habitacion'],2);
			return $res;
		}else{
			return false;
		}
	}

	public function habitaciones_disponibles(){
		$respuesta = Datos::habitaciones_disponibles();
		return $respuesta;
	}

	public function show_reservaciones(){
		$respuesta = Datos::show_reservaciones();
		return $respuesta;
	}

	public function show_clientes(){
		$respuesta = Datos::show_clientes();
		return $respuesta;
	}

	public function show_habitaciones(){
		$respuesta = Datos::show_habitaciones();
		return $respuesta;
	}
	public function show_usuarios(){
		$respuesta = Datos::show_usuarios();
		return $respuesta;
	}

	private function subir_fichero($directorio_destino, $nombre_fichero){
	    $tmp_name = $_FILES[$nombre_fichero]['tmp_name'];
	    //si hemos enviado un directorio que existe realmente y hemos subido el archivo    
	    if (is_dir($directorio_destino) && is_uploaded_file($tmp_name)){
	        $img_file = $_FILES[$nombre_fichero]['name'];
	        $img_type = $_FILES[$nombre_fichero]['type'];	        
	        // Si se trata de una imagen   
	        if (((strpos($img_type, "gif") || strpos($img_type, "jpeg") ||
	 			strpos($img_type, "jpg")) || strpos($img_type, "png"))){
	            move_uploaded_file($tmp_name, $directorio_destino . '/' . $img_file);
				move_uploaded_file($img_file, "/temp");

				return $img_file;
			}
	    }
	    //Si llegamos hasta aquí es que algo ha fallado
	    return false;
	}

	public function update_reservacion($id_reservacion,$id_habitacion){
		if(isset($_POST['guardar'])){
			if($id_habitacion==$_POST['id_habitacion']){
				$datos_consulta = array('id' => $id_reservacion,
						'id_cliente' => $_POST['id_cliente'],
						'id_habitacion' => $_POST['id_habitacion'],
						'numero_reservacion' => $_POST['numero_reservacion'],
						'fecha_reserva' => $_POST['fecha_reserva'],
						'dias_estadia' => $_POST['dias_estadia']);
				Datos::update_estado_habitacion($id_habitacion,2);
			}else{
				$datos_consulta = array('id' => $id_reservacion,
						'id_cliente' => $_POST['id_cliente'],
						'id_habitacion' => $id_habitacion,
						'numero_reservacion' => $_POST['numero_reservacion'],
						'fecha_reserva' => $_POST['fecha_reserva'],
						'dias_estadia' => $_POST['dias_estadia']);
				Datos::update_estado_habitacion($id_habitacion,1);
				Datos::update_estado_habitacion($_POST['id_habitacion'],2);
			}
			$res = Datos::update_reservacion($datos_consulta);
			//Al terminar se manda a la vista de todos los registros
	        $URL="index.php?action=ver_reservaciones";
	        echo "<script >document.location.href='{$URL}';</script>";
	        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
		}
		return false;
	}

	public function update_cliente($id_cliente){
		if(isset($_POST['guardar'])){
			$datos_consulta = array('id' => $id_cliente,
				'numero_cliente' => $_POST['numero_cliente'],
				'nombres' => $_POST['nombres'],
				'paterno' => $_POST['paterno'],
				'materno' => $_POST['materno'],
				'id_tipo_cliente' => $_POST['tipo_cliente']);
			
			Datos::update_cliente($datos_consulta);

			//Al terminar se manda a la vista de todos los registros
	        $URL="index.php?action=ver_clientes";
	        echo "<script >document.location.href='{$URL}';</script>";
	        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
		}
		return false;
	}

	public function update_usuario($id_usuario){
		if(isset($_POST['guardar'])){
			$datos_consulta = array('id' => $id_usuario,'user_name' => $_POST['user_name'],
					'passw' => $_POST['passw'],'nombres' => $_POST['nombres'],
					'paterno' => $_POST['paterno'], 'materno' => $_POST['materno'],
					'id_tipo_usuario' => $_POST['tipo_usuario']);
			$res = Datos::update_usuario($datos_consulta);

			//Al terminar se manda a la vista de todos los registros
	        $URL="index.php?action=ver_habitaciones";
	        echo "<script >document.location.href='{$URL}';</script>";
	        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
		}
		return false;
	}
	public function update_habitacion($id_habitacion,$foto){
		$ruta_img = "views/img/habitaciones";

		if(isset($_POST['guardar'])){
			$nombre_fichero = 'foto_habitacion';
			if(!empty($_FILES[$nombre_fichero]['name'])){//Si en el atributo 'name' del indice $nombre_fichero del arreglo $_FILES contiene algo distinto a vacío significa que se ha agregado una nueva imagen, de otra forma no y se va a insertar en la consulta la imagen que antes ya se contaba.
				$nombre_img = $_FILES[$nombre_fichero]['name'];
				echo "<br>entre 1<br>";
				if($this->subir_fichero($ruta_img,$nombre_fichero) == $nombre_img){		
					echo "<br>entre 2<br>";
					$datos_consulta = array('id' => $id_habitacion,
							'numero'=>$_POST['numero'],
							'foto'=>$nombre_img,//Si se agregó una nueva foto se asigna al arreglo que se envia a la consulta SQL
							'precio' => $_POST['precio'],
							'descripcion'=>$_POST['descripcion'],
							'id_estado'=>$_POST['estado'],
							'id_tipo_habitacion'=>$_POST['tipo_habitacion']);
				}
			}else{		
				$datos_consulta = array('id' => $id_habitacion,
						'numero'=>$_POST['numero'],
						'foto'=>$foto,//Si no se agregó una nueva foto se mantiene la misma
						'precio' => $_POST['precio'],
						'descripcion'=>$_POST['descripcion'],
						'id_estado'=>$_POST['estado'],
						'id_tipo_habitacion'=>$_POST['tipo_habitacion']);
			}
			//Aplica el update
			$res = Datos::update_habitacion($datos_consulta);
			
			//Al terminar se manda a la vista de todos los registros
	        $URL="index.php?action=ver_habitaciones";
	        echo "<script >document.location.href='{$URL}';</script>";
	        echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
		}else
			return false;
	}


	
}

?>