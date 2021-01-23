<?php

	session_start();


	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['valor']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$idDiagn = $_POST['id'];
			$folio = $_POST['folio'];
			$valor = $_POST['valor'];


					$sql_update = mysqli_query($conection,"UPDATE proveedor
				  SET folio = $folio, valor='$valor'
							WHERE diag= $idDiagn ");


				if($sql_update){
					$alert='<p class="msg_save"> Actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al Actualizar.</p>';
				}

			}


		}

	//Mostrar Datos
	if(empty($_REQUEST['id']))
	{
		header('Location: lista_diagnostico.php');
		mysqli_close($conection);
	}
	$idDiagn = $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT * FROM proveedor u
									WHERE diag= $idDiagn ");
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_diagnostico.php');
	}else{

		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$idDiagn       = $data['diag'];
			$folio         = $data['folio'];
			$valor         = $data['valor'];

		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar Diagnostico</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">

		<div class="form_register">
			<h1>Diagnosticos</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<input type="hidden" name="id" value="<?php echo $idDiagn; ?>">
				<label for="folio">N. Afiliado</label>
				<input type="text" name="folio" id="folio" placeholder="Numero de Afiliado" value="<?php echo $folio; ?>">
				<label for="valor">Descripcion</label>
				<input type="text" name="valor" id="valor" placeholder="Descripcion de sintomas" value="<?php echo $valor; ?>">


				<input type="submit" value="Actualizar Diagnostico" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>
