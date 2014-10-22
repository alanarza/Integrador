<?php
	if(!isset($_SESSION)){
		session_start();
	}

	header("Content-Type: text/html; charset=UTF-8");


?>

<!DOCTYPE html>
<html>
<head>
	<title>Modificar perfil</title>
	<meta charset="utf-8">
	<link href="../librerias/css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>



	<div class="container">

		<h1>Modificación de perfil</h1>
		<hr>

		<div class="col-sm-4"></div>

		<div class="col-sm-4">
			<fieldset>

				<form role="form" action="CONTmodificar.php" method="post">

					<div class="form-group">
					    <label for="usuario">Usuario</label>
					    <input type="text" name="user" class="form-control" id="usuario" value=<?php echo $datauser['user'];?> required>
					</div>

				  	<div class="form-group">
				    	<label for="contraseña1">Nueva contraseña</label>
				    	<input type="password" name="pass" class="form-control" id="contraseña1" type="password">
				  	</div>

				  	 <div class="form-group">
				    	<label for="contraseña2">Confirmar nueva contraseña</label>
				    	<input type="password" name="pass" class="form-control" id="contraseña2" type="password">
				  	</div>

				  	 <div class="form-group">
				    	<label for="contraseña">Contraseña antigua</label>
				    	<input type="password" name="pass" class="form-control" id="contraseña" type="password">
				  	</div>

				  	<div class="form-group">
					    <label for="nombre">Nombre</label>
					    <input type="text" name="nombre" class="form-control" id="nombre" value=<?php echo $datauser['nombre'];?> required>
					</div>

					<div class="form-group">
					    <label for="apellido">Apellido</label>
					    <input type="text" name="apellido" class="form-control" id="apellido" value=<?php echo $datauser['apellido'];?> required>
					</div>
				  	
					<input id="action" type="hidden" name="action" value="modificar"/>

				</form>

				<button type="cancel" onclick="javascript:window.location='AreaPersonal.php';" class="btn btn-danger">Cancelar</button>
				<button type="submit" class="btn btn-success">Guardar</button>

			</fieldset>
		</div>

		<div class="col-sm-4"></div>

		<div class="col-sm-12"><hr></div>

	</div>

</body>
</html>