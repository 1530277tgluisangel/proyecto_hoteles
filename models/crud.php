<?php

#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.

require_once "conexion.php";

class Datos extends Conexion{

	#REGISTRO DE USUARIOS
	#-------------------------------------
	public function m_insert_usuario($datosModel){

		#prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

		$query = Conexion::conectar()->prepare("INSERT INTO usuarios (usuario, passw, nombre) VALUES (:usuario,:password,:nombre)");	

		#bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente de la sentencia SQL que fue usada para preparar la sentencia.
		
		$query->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
		$query->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
		$query->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);

		$res = $query->execute();
		return $res;
	}

	public function m_login($datos_usuario){#Recibe un arreglo desde el controlador, cuyos valores de los parámetros provienen de la vista login.php, retorna un arreglo 1D dónde hayan coincidido los datos en la tabla usuarios
		$query = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE usuario=:usuario AND passw=:passw");

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




}

?>