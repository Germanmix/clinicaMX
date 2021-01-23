<?php
	session_start();
	if($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2 )
	{
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['folio']) ||  empty($_POST['valor']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

      $folio    = $_POST['folio'];
			$valor = $_POST['valor'];
			$usuario_id = $_SESSION['idUser'];

				$query_insert = mysqli_query($conection,"INSERT INTO proveedor(folio, valor,usuario_id)
																	VALUES('$folio','$valor', '$usuario_id')");
			if($query_insert){

			$alert='<p class="msg_save"> guardado correctamente.</p>';
		 }else{
			$alert='<p class="msg_error">Error al guardar.</p>';
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
	<title>Registro Diagnostico</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">

		<div class="form_register">
			<h1>Registro Diagnostico</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<label for="folio">N. Afiliado</label>
				<input type="text" name="folio" id="folio" placeholder="Numero de Afiliado">
				<label for="valor">Diagnostico</label>
				<input type="text" name="valor" id="valor" placeholder="Descripcion">


				<input type="submit" value="Guardar" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>
