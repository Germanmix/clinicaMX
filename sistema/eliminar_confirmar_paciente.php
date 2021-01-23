<?php
	session_start();
	if($_SESSION['rol'] != 1 and $_SESSION['rol'] !=2)
	{
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST))
	{
    if(empty($_POST['idPaciente']))
		{
    	header("location: lista_paciente.php");
			mysqli_close($conection);
		}

		$idPaciente = $_POST['idPaciente'];

		//$query_delete = mysqli_query($conection,"DELETE FROM usuario WHERE idusuario =$idusuario ");
		$query_delete = mysqli_query($conection,"UPDATE cliente SET estatus = 0 WHERE idPaciente = $idPaciente ");
		mysqli_close($conection);
		if($query_delete){
			header("location: lista_paciente.php");
		}else{
			echo "Error al eliminar";
		}

	}


//codigo sirve para obtener el id y saber si existe

	if(empty($_REQUEST['id']))
	{
		header("location: lista_paciente.php");
		mysqli_close($conection);
	}else{

		$idPaciente = $_REQUEST['id'];

		$query = mysqli_query($conection,"SELECT *
												FROM cliente
												WHERE idPaciente = $idPaciente ");

		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$nit    = $data['nit'];
				$nombre = $data['nombre'];

			}
		}else{
			header("location: lista_paciente.php");
		}


	}


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Eliminar Paciente</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<div class="data_delete">
			<h2>¿Está seguro de eliminar el siguiente Paciente?</h2>
			<p>N. de Afiliado: <span><?php echo $nit; ?></span></p>
			<p>Nombre: <span><?php echo $nombre; ?></span></p>


			<form method="post" action="">
				<input type="hidden" name="idPaciente" value="<?php echo $idPaciente; ?>">
				<a href="lista_paciente.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Eliminar" class="btn_ok">
			</form>
		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>
