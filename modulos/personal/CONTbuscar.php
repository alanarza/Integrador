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
	//verifica acciones por metodo post
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
		$action = $_POST['action'];

		if($action == 'buscar')
		{
			$nombre = $_POST['nombre'];
			$apellido = $_POST['apellido'];

			buscar($nombre, $apellido);
		}
		else
		{
			header("Location: ../publico/index.php");
			die();
		}

	}

	//verifica acciones por metodo get


function buscar($n, $a){

	include "../../modelo/usuario.class.php";

	$a = new Usuario();

	try
	{
		$busqueda = $a->buscar($n,$a);

		include "AreaPersonal.php";

		die();
	}
	catch(Exception $e)
	{
		header("Location: ../error/ErrorLogin.php?msg".$e->getMessage());
		die();
	}

}