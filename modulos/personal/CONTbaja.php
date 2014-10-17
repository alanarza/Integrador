<?php

session_start();


	if($_SERVER['REQUEST_METHOD'] == 'GET' && !isset($_GET['action']))
	{
		header("Location: ../publico/index.php");
	}	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['action']))
	{
		header("Location: ../publico/index.php");
	}

	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$action = $_POST['action'];

		if($action == 'baja')
		{
			$nombre = $_POST['nombre'];
			$apellido = $_POST['apellido'];
			$user = $_POST['user'];
			$pass = $_POST['pass'];

			$res = modificar($usuario,$_SESSION['id']);

			return $res;
		}
		else
		{
			header ('Location: ../publico/index.php?error=1');
			die();
		}
	}	

	function delete(){
		include "../../modelo/usuario.class.php";

		$a = new Usuario();

		try {

			$res = $a->baja($_SESSION['id']);

		} catch (Exception $e) {
			header("Location: ../error/ErrorBaja.php?msg".$e->getMessage());
			die();
		}

		if($res == 'ok')
		{
			header ('Location: /Baja_ok.php');
			die();
		}
		elseif ($res == 'fail') 
		{
			header ('Location: ../publico/index.php?error=1');
			die();
		}
	}
