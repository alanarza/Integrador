<?php

include "conexion.class.php";

if(!isset($_SESSION)){
		session_start();
}


class Usuario{

	function loguearse($u , $p){
	//funcion destinada al logueo de usuario en la pagina web

		$user = $u;
		$pass = $p;

		$conn = new conexion();

		try{

			$sql = "SELECT * FROM usuarios WHERE user = :usuario AND pass = :contrasenia";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':usuario', $user, PDO::PARAM_STR);
			$stmt->bindParam(':contrasenia', $pass, PDO::PARAM_STR);
			$stmt->execute();

			if($stmt->rowCount() == 1)
			{
				$fila = $stmt->fetch(PDO::FETCH_ASSOC);
				$_SESSION['nombre'] = $fila['nombre'];
				$_SESSION['apellido'] = $fila['apellido'];
				$_SESSION['id'] = $fila['id'];

				return 'ok';
			}	

		} catch(PDOException $e){
			throw new Exception($e->getMessage());
		}

		return 'fail';
	}

	function registrarse($n,$a,$u,$p){
		$nombre = ucwords(strtolower($n));
		$apellido = ucwords(strtolower($a));
		$user = $u;
		$pass = $p;

		$conn = new conexion();

		try{

			$sql = "INSERT INTO usuarios (nombre, apellido, user, pass)
					values (:nombre, :apellido, :usuario, :contrasenia)";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
			$stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
			$stmt->bindParam(':usuario', $user, PDO::PARAM_STR);
			$stmt->bindParam(':contrasenia', $pass, PDO::PARAM_STR);
			$stmt->execute();

			if($stmt->rowCount() == 1)
			{		
				$cuenta['user'] = $user;
				$cuenta['pass'] = $pass;
				return $cuenta;
			}
		
		} catch(PDOException $e){
			throw new Exception($e->getMessage());
		}

		return 'fail';
	}

	function obtener($i){

		$id = $i;

		$conn = new conexion();

		try{

			$sql = "SELECT user, nombre, apellido FROM usuarios WHERE id = :id";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':id', $id, PDO::PARAM_STR);
			$stmt->execute();

			if($stmt->rowCount() == 1)
			{
				$fila = $stmt->fetch(PDO::FETCH_ASSOC);

				$usuario['nombre'] = $fila['nombre'];
				$usuario['apellido'] = $fila['apellido'];
				$usuario['user'] = $fila['user'];
				
				return $usuario;
			}	

		} catch(PDOException $e){
			throw new Exception($e->getMessage());
		}

		return 'fail';
	}

	function buscar($n, $a){

		$n = ucwords(strtolower($n));
		$a = ucwords(strtolower($a));

		$conn = new conexion();

		if(!empty($n) && !empty($a))
		{
			try{

				$sql = "SELECT nombre, apellido FROM usuarios WHERE nombre = :nombre AND apellido = :apellido";
				$stmt = $conn->prepare($sql);
				$stmt->bindParam(':nombre',$n ,PDO::PARAM_STR);
				$stmt->bindParam(':apellido',$a ,PDO::PARAM_STR);
				$stmt->execute();

				if($stmt->rowCount() > 0)
				{
					$busqueda = $stmt->fetchAll();

					return $busqueda;
				}
				else
				{
					return 'La busqueda no devolvio resultados..';
				}

			} catch(PDOException $e){
				throw new Exception($e->getMessage());
			}
		}
		elseif (!empty($n) && empty($a)) 
		{
			try{

				$sql = "SELECT nombre, apellido FROM usuarios WHERE nombre = :nombre";
				$stmt = $conn->prepare($sql);
				$stmt->bindParam(':nombre',$n ,PDO::PARAM_STR);
				$stmt->execute();

				if($stmt->rowCount() > 0)
				{
					$busqueda = $stmt->fetchAll();

					return $busqueda;
				}
				else
				{
					return 'La busqueda no devolvio resultados..';
				}

			} catch(PDOException $e){
				throw new Exception($e->getMessage());
			}
		}
		elseif (empty($n) && !empty($a)) 
		{
			try{

				$sql = "SELECT nombre, apellido FROM usuarios WHERE apellido = :apellido";
				$stmt = $conn->prepare($sql);
				$stmt->bindParam(':apellido',$a ,PDO::PARAM_STR);
				$stmt->execute();

				if($stmt->rowCount() > 0)
				{
					$busqueda = $stmt->fetchAll();

					return $busqueda;
				}
				else
				{
					return 'La busqueda no devolvio resultados..';
				}

			} catch(PDOException $e){
				throw new Exception($e->getMessage());
			}
		}
		else
		{
			return 'La busqueda no devolvio resultados..';
		}

		return 'La busqueda no devolvio resultados..';

	}

	private function comparador(){

		$id = $_SESSION['id'];

		$conn = new conexion();

		try{

			$sql = "SELECT user, pass, nombre, apellido FROM usuarios WHERE id = :id";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':id', $id, PDO::PARAM_STR);
			$stmt->execute();

			if($stmt->rowCount() == 1)
			{
				$fila = $stmt->fetch(PDO::FETCH_ASSOC);

				$usuario['nombre'] = $fila['nombre'];
				$usuario['apellido'] = $fila['apellido'];
				$usuario['user'] = $fila['user'];
				$usuario['pass'] = $fila['pass'];
				
				return $usuario;
			}	

		} catch(PDOException $e){
			throw new Exception($e->getMessage());
		}

		return 'fail';
	}

	function modificar($usuario){
		
		$usuario['nombre'] = ucwords(strtolower($usuario['nombre']));
		$usuario['apellido'] = ucwords(strtolower($usuario['apellido']));

		$conn = new conexion();

		try{

			$comp = comparador();

		}catch(Exception $e){
			throw new Exception($e->getMessage());
		}

		if($usuario['user'] != $comp['user'])
		{
			try{

				$sql = "UPDATE usuarios SET user = :user WHERE id = :id";
				$stmt = $con->prepare($sql);
				$stmt->bindParam(':user', $usuario['user'], PDO::PARAM_STR);
				$stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);
				$stmt->execute();

				if($stmt->rowCount() == 1)
				{
					$status = 'ok';
				}
				else
				{
					$status = 'error';
					return $status;
				}

			}catch(PDOException $E){
				throw new Exception($e->getMessage());
			}
		}

		if(isset($usuario['pass_new']))
		{
			if($usuario['pass_confirm'] == $comp['pass'])
			{
				try{

				$sql = "UPDATE usuarios SET pass = :pass WHERE id = :id";
				$stmt = $con->prepare($sql);
				$stmt->bindParam(':pass', $usuario['pass_new'], PDO::PARAM_STR);
				$stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);
				$stmt->execute();

				if($stmt->rowCount() == 1)
				{
					$status = 'ok';
				}
				else
				{
					$status = 'error';
					return $status;
				}

				}catch(PDOException $E){
					throw new Exception($e->getMessage());
				}
			}
		}

		if($usuario['nombre'] != $comp['nombre'])
		{
			try{

				$sql = "UPDATE usuarios SET nombre = :nombre WHERE id = :id";
				$stmt = $con->prepare($sql);
				$stmt->bindParam(':nombre', $usuario['nombre'], PDO::PARAM_STR);
				$stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);
				$stmt->execute();

				if($stmt->rowCount() == 1)
				{
					$status = 'ok';
				}
				else
				{
					$status = 'error';
					return $status;
				}

			}catch(PDOException $E){
				throw new Exception($e->getMessage());
			}
		}

		if($usuario['apellido'] != $comp['apellido'])
		{
			try{

				$sql = "UPDATE usuarios SET apellido = :apellido WHERE id = :id";
				$stmt = $con->prepare($sql);
				$stmt->bindParam(':apellido', $usuario['apellido'], PDO::PARAM_STR);
				$stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);
				$stmt->execute();

				if($stmt->rowCount() == 1)
				{
					$status = 'ok';
				}
				else
				{
					$status = 'error';
					return $status;
				}

			}catch(PDOException $E){
				throw new Exception($e->getMessage());
			}
		}

		$status = 'ok';

		return $status;

	}	

	function baja1($id){
		$i = $id;


		$conn = new conexion();

		try{

			$sql = "SELECT pass FROM usuarios WHERE id = :id";
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(':id', $i, PDO::PARAM_STR);
			$stmt->execute();

			if($stmt->rowCount() == 1)
			{

				$pass = $stmt->fetch(PDO::FETCH_ASSOC);
				return $pass;

			}	

		} catch(PDOException $e){
			throw new Exception($e->getMessage());
		}

		return 'fail';
	}

	function baja2($id){
		$i = $id;

		$conn = new conexion();

		try{
				$sql = "DELETE FROM usuarios WHERE id = :id";
				$stmt = $conn->prepare($sql);
				$stmt->bindParam(':id', $i, PDO::PARAM_STR);
				$stmt->execute();

				if($stmt->rowCount() == 1)
				{		
					return 'ok';
				}	

		} catch(PDOException $e){
			throw new Exception($e->getMessage());
		}

		return 'fail';
	}
	
}
