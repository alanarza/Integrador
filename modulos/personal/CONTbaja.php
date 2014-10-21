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
			$res = deleter();
		}
		else
		{
			header ('Location: ../publico/index.php?error=1');
			die();
		}
	}	

	if($res = 'ok'){
		header ('Location: ../publico/CONTconectarse.php?action=salir');
		die();
	} else{
		header('Location: Baja.php');
	}


	function deleter(){

		include "../../modelo/usuario.class.php";

		$a = new Usuario();

		try {

			$res = $a->baja1($_SESSION['id']);

		} catch (Exception $e) {
			header("Location: ../error/ErrorBaja.php?msg".$e->getMessage());
			die();
		}

		if($res == $_POST['pass'])
		{
			$res2 = deleter2();
			return $res2;
		}else{
			header ('Location: Baja.php');
			return $res;
		}
	}

	function deleter2(){
		include "../../modelo/usuario.class.php";

		$a = new Usuario();

		try {

			$res = $a->baja2($_SESSION['id']);

		} catch (Exception $e) {
			header("Location: ../error/ErrorBaja.php?msg".$e->getMessage());

			die();
		}

		return $res;
	}
