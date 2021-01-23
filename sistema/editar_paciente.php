<?php

	session_start();


	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['fecha_n']) || empty($_POST['email'])  || empty($_POST['telefono']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$idPaciente = $_POST['id'];
			$nit = $_POST['nit'];
			$nombre = $_POST['nombre'];
			$fecha_n = $_POST['fecha_n'];
			$email  = $_POST['email'];
			$telefono   = $_POST['telefono'];

      $result = 0;
     	if(is_numeric($nit) and $nit !=0)
			{
				$query = mysqli_query($conection,"SELECT * FROM cliente
														   WHERE (nit = '$nit' AND idPaciente != $idPaciente)");

      $result = mysqli_fetch_array($query);

			}

			if($result > 0){
				$alert='<p class="msg_error">El N. Afilacion ya existe, ingrese otro.</p>';
			}else{
        if($nit == '')
				{
			   	$nit = 0;
				}

					$sql_update = mysqli_query($conection,"UPDATE cliente
				  SET nit = $nit, nombre='$nombre',fecha_n='$fecha_n',email='$email',telefono='$telefono'
							WHERE idPaciente= $idPaciente ");


				if($sql_update){
					$alert='<p class="msg_save">Paciente actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar Paciente.</p>';
				}

			}


		}

	}

	//Mostrar Datos
	if(empty($_REQUEST['id']))
	{
		header('Location: lista_paciente.php');
		mysqli_close($conection);
	}
	$idPaciente = $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT * FROM cliente u
									WHERE idPaciente= $idPaciente ");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_paciente.php');
	}else{

		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$idPaciente  = $data['idPaciente'];
			$nit         = $data['nit'];
			$nombre      = $data['nombre'];
			$fecha_n     = $data['fecha_n'];
			$email       = $data['email'];
			$telefono    = $data['telefono'];




		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar Paciente</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">

		<div class="form_register">
			<h1>Actualizar Paciente</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<input type="hidden" name="id" value="<?php echo $idPaciente; ?>">
				<label for="nit">N. Afiliado</label>
				<input type="number" name="nit" id="nit" placeholder="Numero de Afiliado" value="<?php echo $nit; ?>">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="<?php echo $nombre; ?>">
				<label for="fecha_n">Fecha de Nacimiento</label>
				<input type="text" name="fecha_n" id="fecha_n" placeholder="Año - Mes - Dia" value="<?php echo $fecha_n; ?>">
				<label for="email">Correo electrónico</label>
				<input type="email" name="email" id="email" placeholder="Correo electrónico" value="<?php echo $email; ?>">
				<label for="telefono">Telefono</label>
				<input type="text" name="telefono" id="telefono" placeholder="Telefono" value="<?php echo $telefono; ?>">


				<input type="submit" value="Actualizar Paciente" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>
