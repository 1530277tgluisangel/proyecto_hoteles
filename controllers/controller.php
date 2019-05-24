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
		include $respuesta;

	}
	
	#Inserta usuario
	#------------------------------------
	public function c_insert_usuario(){

		if(isset($_POST["registrar"])){

			$datos_usuario = array( "usuario"=>$_POST["usuario"], 
								      "password"=>$_POST["password"],
								      "nombre"=>$_POST["nombres"]." ".$_POST['apellidos']);
			$datos=new Datos();
			$respuesta = $datos->m_insert_usuario($datos_usuario);

		/*	if($respuesta){
				header("location:index.php?action=login");
			}
			else{
				header("location:index.php");
			}*/
		}

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
				#header('location:index.php?action=dashboard');
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

	public function get_estados_habitaciones(){
		$return = Datos::get_estados_habitaciones();
		return $return;
	}
	public function insert_usuario(){
		if(isset($_POST['guardar'])){
			$datos_usuario = array('user_name' => $_POST['user_name'] ,
							'passw'=>$_POST['passw'],
							'nombres'=>$_POST['nombres'],
							'paterno'=>$_POST['paterno'],
							'materno'=>$_POST['materno'],
							'id_tipo_usuario'=>$_POST['id_tipo_usuario'] );
			$res = Datos::insert_usuario($datos_usuario);
			return $res;
		}
	}
	public function insert_habitacion(){
		$ruta_img = "views/img/habitaciones";

		if(isset($_POST['guardar'])){
			$nombre_img = 'foto_habitacion';
			if($this->subir_fichero($ruta_img,$nombre_img)){
				return true;
			}else
				return false;
		}
		return false;

	}


	private function subir_fichero($directorio_destino, $nombre_fichero){
	    $tmp_name = $_FILES[$nombre_fichero]['tmp_name'];
	    echo "<br><br>".getcwd()."<br>";
	    //si hemos enviado un directorio que existe realmente y hemos subido el archivo    
	    if (is_dir($directorio_destino) && is_uploaded_file($tmp_name))
	    {
	        $img_file = $_FILES[$nombre_fichero]['name'];
	        $img_type = $_FILES[$nombre_fichero]['type'];	        // Si se trata de una imagen   
	        if (((strpos($img_type, "gif") || strpos($img_type, "jpeg") ||
	 			strpos($img_type, "jpg")) || strpos($img_type, "png")))
	        {
	            //¿Tenemos permisos para subir la imágen?
	            move_uploaded_file($tmp_name, $directorio_destino . '/' . $img_file);
				#move_uploaded_file($img_file, "/temp");
				##touch("/temp", filemtime($img_file)); 
	        }
	    }
	    //Si llegamos hasta aquí es que algo ha fallado
	    return false;
	}

	#INGRESO DE USUARIOS
	#------------------------------------
/*	public function ingresoUsuarioController(){

		if(isset($_POST["usuarioIngreso"])){

			$datosController = array( "usuario"=>$_POST["usuarioIngreso"], 
								      "password"=>$_POST["passwordIngreso"]);

			$respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");

			if($respuesta["usuario"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $_POST["passwordIngreso"]){

				session_start();

				$_SESSION["validar"] = true;

				header("location:index.php?action=usuarios");

			}

			else{

				header("location:index.php?action=fallo");

			}

		}	

	}

	#VISTA DE USUARIOS
	#------------------------------------

	public function vistaUsuariosController(){

		$respuesta = Datos::vistaUsuariosModel("usuarios");

		#El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

		foreach($respuesta as $row => $item){
		echo'<tr>
				<td>'.$item["usuario"].'</td>
				<td>'.$item["password"].'</td>
				<td>'.$item["email"].'</td>
				<td><a href="index.php?action=editar&id='.$item["id"].'"><button>Editar</button></a></td>
				<td><a href="index.php?action=usuarios&idBorrar='.$item["id"].'"><button>Borrar</button></a></td>
			</tr>';

		}

	}

	#EDITAR USUARIO
	#------------------------------------

	public function editarUsuarioController(){

		$datosController = $_GET["id"];
		$respuesta = Datos::editarUsuarioModel($datosController, "usuarios");

		echo'<input type="hidden" value="'.$respuesta["id"].'" name="idEditar">

			 <input type="text" value="'.$respuesta["usuario"].'" name="usuarioEditar" required>

			 <input type="text" value="'.$respuesta["password"].'" name="passwordEditar" required>

			 <input type="email" value="'.$respuesta["email"].'" name="emailEditar" required>

			 <input type="submit" value="Actualizar">';

	}

	#ACTUALIZAR USUARIO
	#------------------------------------
	public function actualizarUsuarioController(){

		if(isset($_POST["usuarioEditar"])){

			$datosController = array( "id"=>$_POST["idEditar"],
							          "usuario"=>$_POST["usuarioEditar"],
				                      "password"=>$_POST["passwordEditar"],
				                      "email"=>$_POST["emailEditar"]);
			
			$respuesta = Datos::actualizarUsuarioModel($datosController, "usuarios");

			if($respuesta == "success"){

				header("location:index.php?action=cambio");

			}

			else{

				echo "error";

			}

		}
	
	}

	#BORRAR USUARIO
	#------------------------------------
	public function borrarUsuarioController(){

		if(isset($_GET["idBorrar"])){

			$datosController = $_GET["idBorrar"];
			
			$respuesta = Datos::borrarUsuarioModel($datosController, "usuarios");

			if($respuesta == "success"){

				header("location:index.php?action=usuarios");
			
			}

		}

	}*/

}

?>