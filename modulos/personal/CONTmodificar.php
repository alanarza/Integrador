<?php

session_start();

	if (!isset($_SESSION['nombre'])) 
	{
		header("Location: ../publico/index.php");
	}

	if($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['action']))
	{
		header("Location: ../publico/index.php");
	}	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['action']))
	{
		header("Location: ../publico/index.php");
	}

	if($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		$action = $_GET['action'];

		if($action == 'modificar')
		{
			mostrar_datos();
		}
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$action = $_POST['action'];

		if($action == 'datos') 
		{
			modificar_datos();
		}
	}


	function mostrar_datos(){

		include "../../modelo/usuario.class.php";

		$u = new Usuario();

		try {

			$datauser = $u->obtener($_SESSION['id']);

			include "Modificacion.php";

			die();

		} catch (Exception $e) {
			header("Location: ../error/ErrorModify.php?msg".$e->getMessage());
			die();
		}

	}

	function modificar_datos(){

		include "../../modelo/usuario.class.php";

		$u =  new Usuario();

		try{

			$user_perfil["user"] = $_POST["user"];
			$user_perfil["pass_new"] = $_POST["pass_new"];
			$user_perfil["pass_confirm"] = $_POST["pass_confirm"];
			$user_perfil["nombre"] = $_POST["nombre"];
			$user_perfil["apellido"] = $_POST["apellido"];

			$resp = $u->modificar($user_perfil);

			if($resp == 'ok')
			{
				header("Location: AreaPersonal.php");
				die();
			}
			else
			{
				header("Location: ../error/errorModificar.php");
			}

		}catch(Exception $e){
			header("Location: ../error/ErrorModify.php?msg".$e->getMessage());
			die();
		}
	}
