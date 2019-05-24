<?php

#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.


######################## ACERCA DE LA CONEXIÓN A LA BASE DE DATOS CON PDO #####################################
#Aquí se usan las funciones php que consultan a la bd por medio de la clase PDO, esta particularmente al hacer las consultas tiene 3 funciones principales, las cuales son:
/*
	* prepare(): Retorna un objeto tipo consulta al cual llamaremos "query", a su vez este objeto cuenta con 2 funciones más
	* query->bindParam(): bindParam es una especie de apuntado hacia la sentencia anteriormente realizada, este paso se puede omitir si la sentencia fue escrita con comillas dobles ya que en php esto permite agregar variables directamente dentro de esta cadena.
	* query->execute(): Con esta función se ejecuta la función hacia el servidor de BD y retorna true o false dependiendo si se realizó la consulta satisfactoriamente o no respectivamente.

	- Otras 2 funciones extra son fetch y fetchAll, estas retornan una sola fila de una consulta o todas las filas de una consulta respectivamente en forma de un arreglo asociativo e indexado, para ver sus valores es recomendable utilizar la función var_dump($valor) que proporciona PHP

*/

require_once "conexion.php";

class Datos extends Conexion{

	#REGISTRO DE USUARIOSdf
	#-------------------------------------
	public function m_insert_usuario($datosModel){

		$query = Conexion::conectar()->prepare("INSERT INTO usuarios (usuario, passw, nombre) VALUES (:usuario,:password,:nombre)");	
		
		$query->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$query->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$query->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);

		$res = $query->execute();
		return $res;
	}

	public function m_login($datos_usuario){#Recibe un arreglo desde el controlador, cuyos valores de los parámetros provienen de la vista login.php, retorna un arreglo 1D dónde hayan coincidido los datos en la tabla usuarios
		$query = Conexion::conectar()->prepare("SELECT u.id,u.user_name,u.nombres,
					u.paterno,u.materno,u.id_tipo_usuario,
					tu.nombre as tipo_usuario FROM usuarios u 
					INNER JOIN tipo_usuarios tu 
					ON u.id_tipo_usuario=tu.id
					WHERE u.user_name=:usuario AND u.passw=:passw");
		$query->bindParam(":usuario", $datos_usuario["usuario"], PDO::PARAM_STR);
		$query->bindParam(":passw", $datos_usuario["password"], PDO::PARAM_STR);

		$res = $query->execute();
		return $query->fetch();
	}

	public function get_usuario_by_id($id_usuario){#Sirve para traer los datos de la tabla usuarios y tipo_usuarios mediante solamente el id_usuario

		$query = Conexion::conectar()->prepare("SELECT * FROM usuarios u 
										INNER JOIN tipo_usuarios tu 
										ON u.id_tipo_usuario=tu.id 
										WHERE id=:id");

		$query->bindParam(":id", $id_usuario, PDO::PARAM_STR);
		$res = $query->execute();
		return $query->fetch();
	}

	public function insert_usuario($datos_usuario){
		$query = Conexion::conectar()->prepare("INSERT INTO 
					usuarios(user_name,passw,nombres,paterno,materno,id_tipo_usuario)
					VALUES('$datos_usuario[user_name]','$datos_usuario[passw]',
					'$datos_usuario[nombres]','$datos_usuario[paterno]',
					'$datos_usuario[materno]','$datos_usuario[id_tipo_usuario]')");
		$res = $query->execute();
		return $res;
	}

	public function get_tipos_usuarios(){
		$query = Conexion::conectar()->prepare("SELECT * FROM  tipo_usuarios");
		$query->execute();
		$res = $query->fetchAll();
		return $res;
	}
	public function get_tipos_habitaciones(){
		$query = Conexion::conectar()->prepare("SELECT * FROM tipo_habitaciones");
		$query->execute();
		$return = $query->fetchAll();
		return $return;
	}
	public function get_estados_habitaciones(){
		$query = Conexion::conectar()->prepare("SELECT * FROM estado_habitaciones");
		$query->execute();
		$return = $query->fetchAll();
		return $return;
	}



}

?>