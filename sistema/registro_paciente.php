<?php
	session_start();


	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['telefono']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

      $nit    = $_POST['nit'];
			$nombre = $_POST['nombre'];
			$nombre = $_POST['nombre'];
			$fecha_n = $_POST['fecha_n'];
			$email  = $_POST['email'];
			$telefono  = $_POST['telefono'];
			$sexo  = $_POST['cmbSexo'];
			$usuario_id = $_SESSION['idUser'];
//codigo para hacer la comprobacion del numero de afiliado
			$result = 0;
      if(is_numeric($nit) and $nit !=0)
			{
				$query = mysqli_query($conection,"SELECT * FROM cliente WHERE nit = '$nit'");
				$result = mysqli_fetch_array($query);
			}
//codigo de validacion
      if($result > 0){
				$alert = '<p class="msg_error">El N. Afilacion ya existe.</p>';
			}
			else{
				$query_insert = mysqli_query($conection,"INSERT INTO cliente(nit,nombre,fecha_n,email,telefono,sexo,usuario_id)
																	VALUES('$nit','$nombre', '$fecha_n','$email','$telefono','$sexo','$usuario_id')");
			if($query_insert){
			$alert='<p class="msg_save">Paciente guardado correctamente.</p>';
		 }else{
			$alert='<p class="msg_error">Error al guardar Paciente.</p>';
		  		}
			}
		}
    mysqli_close($conection);
	}



 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Registro de Pacientes</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">

		<div class="form_register">
			<h1>Registro de Pacientes</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<label for="nit">N. Afiliado</label>
				<input type="number" name="nit" id="nit" placeholder="Numero de Afiliado">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre completo">
				<label for="fecha_n">Fecha de Nacimiento</label>
				<input type="text" name="fecha_n" id="fecha_n" placeholder="Año - Mes - Dia">
				<label for="email">Correo electrónico</label>
				<input type="email" name="email" id="email" placeholder="Correo electrónico">
				<label for="telefono">Telefono</label>
				<input type="text" name="telefono" id="telefono" placeholder="Telefono">
				<label for="sexo">Sexo:</label>
        <select name="cmbSexo">
          <option disabled="disabled" selected="selected">Genero</option>
          <option value="Masculino">Masculino</option>
          <option value="Femenino">Femenino</option>
        </select>

				<input type="submit" value="Guardar Paciente" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>
