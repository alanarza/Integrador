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
			deleter();
		}
		else
		{
			header ('Location: ../publico/index.php?error=1');
			die();
		}
	}	

	die();


	function deleter(){

		include "../../modelo/usuario.class.php";

		$a = new Usuario();

		try {

			$resp = $a->baja($_POST['pass']);

			if($resp == 'ok')
			{
				session_destroy();
				header("Location: ../publico/index.php");
				die();
			}
			elseif($resp == 'fail')
			{
				header("Location: Baja.php?error=1");
			}

		} catch (Exception $e) {
			header("Location: ../error/ErrorBaja.php?msg".$e->getMessage());
			die();
		}

	}
