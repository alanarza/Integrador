<?php

class Conexion extends PDO
{

	private $tipo_de_base = 'mysql';
	private $host = 'localhost';
	private $nombre_de_base = 'clientes_db';
	private $user = 'root';
	private $pass = 'udc';

	public function __construct(){
	  
	  try{
			parent::__construct($this->tipo_de_base.':host='.$this->host.';dbname='.$this->nombre_de_base, $this->user, $this->pass);
		 
	  }catch(PDOException $e){
			echo 'No se puede conectar a la base de datos. Detalle: ' . $e->getMessage();
			exit;
	  }
	  
	  //DEBUG HABILITADO
	  $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  
   } 
}