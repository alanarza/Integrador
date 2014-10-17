<?php

session_start();

	if (isset($_SESSION['nombre'])) 
	{
		header("Location: AreaPersonal.php");
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
			$usuario = modify();
			$res = modificar($usuario,$_SESSION['id']);

		}
	}	

	if($res == 'ok'){
		header ('Location: Modificacion_ok.php');
	}
	else
	{
		header ('Location: ../publico/index.php?error=1');
		die();
	}


	function modify(){
		include "../../modelo/usuario.class.php";

		$a = new Usuario();

		try {

			$res = $a->obtener($_SESSION['id']);

		} catch (Exception $e) {
			header("Location: ../error/ErrorModify.php?msg".$e->getMessage());
			die();
		}

		if($res == 'ok')
		{
			return $a;
			header ('Location: /Modificacion.php');
			die();
		}
		elseif ($res == 'fail') 
		{
			header ('Location: ../publico/index.php?error=1');
			die();
		}
	}


	