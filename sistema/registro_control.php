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

	}



 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Registro de Control</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">

		<div class="form_register">
			<h1>Registro de Control</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post" >

				<label for="folio">N. Afiliado</label>
				<?php

				$query_proveedor = mysqli_query($conection,"SELECT diag, folio FROM proveedor WHERE estatus =1  ORDER BY folio ASC");

				$result_proveedor = mysqli_num_rows($query_proveedor);
				mysqli_close($conection);
				?>
        <select name="folio" id="folio">
					<?php

					if($result_proveedor > 0){
						while ($folio = mysqli_fetch_array($query_proveedor)) {
							// code...
							?>
							<option value="<?php echo $folio['diag']; ?>"><?php echo $folio['folio']; ?> </option>
							<?php
						}
					}
					 ?>

				</select>

				<label for="descripcion">Diagnostico</label>
				<input type="text" name="descripcion" id="descripcion" placeholder="Descripcion">
				<label for="talla">Talla</label>
				<input type="number" name="talla" id="talla" placeholder="Escriba la Talla">
				<label for="peso">Peso</label>
				<input type="number" name="peso" id="peso" placeholder="Escriba el Peso">
				<label for="presion">Presion</label>
				<input type="text" name="presion" id="presion" placeholder="P baja / P alta">
				<label for="cronica">Situacion Cronica</label>
				<input type="text" name="cronica" id="cronica" placeholder="Descripcion">


				<input type="submit" value="Guardar" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>
