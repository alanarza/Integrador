<?php
	
  if(!isset($_SESSION)){
    session_start();
  }

	header("Content-Type: text/html; charset=UTF-8");


	if (!isset($_SESSION['nombre'])) 
	{
		header("Location: ../publico/index.php");
	}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Bienvenido <?php echo $_SESSION['nombre'];?></title>
  <meta charset="utf-8">
  <script src="../librerias/js/jquery-2.1.1.min.js"></script>
  <script>
    $(document).ready(function () {
        $('.dropdown-toggle').dropdown();
    });
  </script>
  <script src="../librerias/js/bootstrap.min.js"></script>
	<link href="../librerias/css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>


<body>

  

  <div class="container">
	  <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">

        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Usuarios.com</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="#staff"><a href="#">Personal</a></li>
            <li><a href="#about">Sobre</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
              
            <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">
              Opciones
              <span class="caret"></span>
            </a>
              <ul class="dropdown-menu">
                <li><a href="CONTmodificar.php?action=modificar">Editar mi Perfil</a></li>
                <li><a href="Baja.php">Eliminar mi Perfil</a></li>
                <li class="divider"></li>
                <li><a href="../publico/CONTconectarse.php?action=salir">Cerrar Sesion</a></li>
              </ul>

            </li>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
  </div>


    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->
      <div class="page-header">
			 <h2>Bienvenido de nuevo <?php echo($_SESSION['nombre']); ?> te estabamos esperando..</h2>
		  </div>

    </div>

	<div class="container">
  <!--Cuerpo de la pagina. donde se encuentran los resultados de la busqueda-->

    <div class="panel panel-primary">
      <div class="panel-heading">

        <h3 class="panel-title">Busqueda de Usuarios</h3>

      </div>

      <div class="panel-body">
        <form role="form" action="CONTbuscar.php" method="post">

          <div class="col-sm-3">
            <div class="form-group">
                <input type="text" name="nombre" class="form-control" id="nombre"
                    placeholder="Nombre">
            </div>
          </div>

          <div class="col-sm-3">
            <div class="form-group">
                <input type="text" name="apellido" class="form-control" id="apellido"
                    placeholder="Apellido">
            </div>
          </div>

          <div class="col-sm-6">
            <input id="action" type="hidden" name="action" value="buscar"/>

            <button type="submit" class="btn btn-default">Buscar</button>
          </div>
          <hr>
        </form>

      </div>



      <div class="panel-body">
        
      <?php
      if(!empty($busqueda)):
    
          foreach ($busqueda as $val):
      ?>
        <div class="col-sm-6">
          <div class="panel panel-default">
            <div class="panel-body">
              <?php 

              echo "Nombre: ".$val['nombre']."  -  Apellido: ".$val['apellido'];

              ?>
            </div>
          </div>
        </div>

      <?php
        endforeach;
        
      endif;
      ?>

      </div>
    </div>

  </div> <!--Fin del cuerpo de la pagina-->

</body>
</html>