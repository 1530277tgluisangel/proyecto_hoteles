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
		$query = Conexion::conectar()->prepare("SELECT * FROM usuarios WHERE id=$id_usuario");
		$query->execute();
		$res = $query->fetch();
		return $res;
	}

	public function get_cliente_by_id($id_cliente){
		$query = Conexion::conectar()->prepare("SELECT * FROM clientes WHERE id=$id_cliente");
		$query->execute();
		$res = $query->fetch();
		return $res;
	}

	public function habitaciones_disponibles(){
		$query = Conexion::conectar()->prepare("SELECT * FROM habitaciones WHERE id_estado=1");
		$query->execute();
		return $query->fetchAll();
	}

	public function show_reservaciones(){
		$query = Conexion::conectar()->prepare("SELECT c.nombres as n,c.paterno as p,c.materno as m,r.id_cliente,r.id,r.id_habitacion,h.numero as numero_habitacion,c.numero_cliente,r.dias_estadia,r.numero_reservacion,r.fecha_reserva as fecha
			FROM reservaciones r INNER JOIN habitaciones h ON r.id_habitacion=h.id INNER JOIN clientes c ON c.id=r.id_cliente");
		$query->execute();

		return $query->fetchAll();
	}

	public function show_clientes(){
		$query = Conexion::conectar()->prepare("SELECT c.id,c.numero_cliente,c.nombres,c.paterno,c.materno,tc.id as id_tipo_cliente,tc.nombre as nombre_tipo FROM clientes c INNER JOIN tipo_clientes tc ON tc.id=c.id_tipo_cliente");
		$query->execute();
		return $query->fetchAll();
	}

	public function show_habitaciones(){
		$query = Conexion::conectar()->prepare("SELECT h.id,h.numero,h.foto,
			h.descripcion,eh.nombre as estado,
			th.nombre as tipo,h.precio FROM habitaciones h
			INNER JOIN tipo_habitaciones th
			ON th.id=h.id_tipo_habitacion
			INNER JOIN estado_habitaciones eh
			ON eh.id=h.id_estado");
		$query->execute();
		return $query->fetchAll();
	}

	public function show_usuarios(){
		$query = Conexion::conectar()->prepare("SELECT u.id,u.nombres,u.paterno,u.materno,u.user_name,u.passw,tu.id as id_tipo, tu.nombre as nombre_tipo
			FROM usuarios u INNER JOIN tipo_usuarios tu ON u.id_tipo_usuario=tu.id");
		$query->execute();
		$res = $query->fetchAll();

		return $res;
	}

	public function get_reservacion_by_id($id_reservacion){
		$query = Conexion::conectar()->prepare("SELECT * FROM reservaciones WHERE id=$id_reservacion");
		$query->execute();
		return $query->fetch();
	}

	public function get_habitacion_by_id($id_habitacion){
		$query = Conexion::conectar()->prepare("SELECT * FROM habitaciones
				WHERE id=$id_habitacion");
		$query->execute();
		return $query->fetch();
	}
	
	public function insert_reservacion($datos_consulta){
		$query = Conexion::conectar()->prepare("INSERT INTO reservaciones(id_cliente,id_habitacion,numero_reservacion,fecha_reserva,dias_estadia)VALUES('$datos_consulta[id_cliente]','$datos_consulta[id_habitacion]','$datos_consulta[numero_reservacion]','$datos_consulta[fecha_reserva]','$datos_consulta[dias_estadia]')");
		$res = $query->execute();
		return $res;
	}

	//Inserción de datos a tabla habitaciones
	public function insert_habitacion($datos_consulta){
		$query = Conexion::conectar()->prepare("INSERT INTO 
			habitaciones(numero,foto,precio,descripcion,id_estado,id_tipo_habitacion)
			VALUES('$datos_consulta[numero]','$datos_consulta[foto]','$datos_consulta[precio]','$datos_consulta[descripcion]','$datos_consulta[id_estado]','$datos_consulta[id_tipo_habitacion]')");
		$res = $query->execute();
		return $res;
	}

	//Inserción de datos en la tabla clientes
	public function insert_cliente($datos_consulta){
		$query = Conexion::conectar()->prepare("INSERT INTO clientes(numero_cliente,nombres,paterno,materno,id_tipo_cliente)VALUES('$datos_consulta[numero_cliente]','$datos_consulta[nombres]','$datos_consulta[paterno]','$datos_consulta[materno]','$datos_consulta[id_tipo_cliente]')");
		$res = $query->execute();
		return $res;
	}

	//Inserción de datos a tabla usuarios
	public function insert_usuario($datos_usuario){
		$query = Conexion::conectar()->prepare("INSERT INTO 
					usuarios(user_name,passw,nombres,paterno,materno,id_tipo_usuario)
					VALUES('$datos_usuario[user_name]','$datos_usuario[passw]',
					'$datos_usuario[nombres]','$datos_usuario[paterno]',
					'$datos_usuario[materno]','$datos_usuario[id_tipo_usuario]')");
		$res = $query->execute();
		return $res;
	}

	public function get_tipos_clientes(){
		$query = Conexion::conectar()->prepare("SELECT * FROM tipo_clientes");
		$query->execute();
		$res = $query->fetchAll();
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

	public function update_reservacion($datos_consulta){
		$query = Conexion::conectar()->prepare("UPDATE reservaciones SET
				id_cliente = '$datos_consulta[id_cliente]',
				id_habitacion = '$datos_consulta[id_habitacion]',
				numero_reservacion = '$datos_consulta[numero_reservacion]',
				fecha_reserva = '$datos_consulta[fecha_reserva]',
				dias_estadia = '$datos_consulta[dias_estadia]'
			WHERE id='$datos_consulta[id]'");
		$res = $query->execute();

		return $res;
	}

	public function update_estado_habitacion($id_habitacion,$estado){
		$query = Conexion::conectar()->prepare("UPDATE habitaciones SET 
					id_estado=$estado
				WHERE id=$id_habitacion
			");
		$res = $query->execute();
		return $res;
	}

	public function update_cliente($datos_consulta){
		$query = Conexion::conectar()->prepare("UPDATE clientes SET
					numero_cliente = '$datos_consulta[numero_cliente]',
					nombres = '$datos_consulta[nombres]',
					paterno = '$datos_consulta[paterno]',
					materno = '$datos_consulta[materno]',
					id_tipo_cliente = '$datos_consulta[id_tipo_cliente]'
			WHERE id='$datos_consulta[id]'");
		$res = $query->execute();
		return $res;
	}
	public function update_usuario($datos_consulta){
		$query = Conexion::conectar()->prepare("UPDATE usuarios SET
				user_name = '$datos_consulta[user_name]',
				passw = '$datos_consulta[passw]',
				nombres = '$datos_consulta[nombres]',
				paterno = '$datos_consulta[paterno]',
				materno = '$datos_consulta[materno]',
				id_tipo_usuario = $datos_consulta[id_tipo_usuario]
			WHERE id=$datos_consulta[id]");
		$res = $query->execute();
		return $res;
	}
	public function update_habitacion($datos_consulta){
		$query = Conexion::conectar()->prepare(" UPDATE habitaciones SET
					numero = '$datos_consulta[numero]',
					foto = '$datos_consulta[foto]',
					precio = '$datos_consulta[precio]',
					descripcion = '$datos_consulta[descripcion]',
					id_estado = '$datos_consulta[id_estado]',
					id_tipo_habitacion = '$datos_consulta[id_tipo_habitacion]'
			WHERE id='$datos_consulta[id]'");
		$res = $query->execute();
		return $res;
	}

	public function delete_registro($id,$tabla){
		$query = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id=$id");
		$query->execute();
	}


}

?>