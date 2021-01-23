<?php
	session_start();
	include "../conexion.php";

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista de Diagnostico</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		<?php

			$busqueda = strtolower($_REQUEST['busqueda']);
			if(empty($busqueda))
			{
				header("location: lista_diagnostico.php");
				mysqli_close($conection);
			}


		 ?>

		<h1>Lista de Diagnostico</h1>
		<a href="registro_diagnostico.php" class="btn_new">Crear Diagnostico</a>

		<form action="buscar_diagnostico.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table>
			<tr>
				<th>Id Diagnostico</th>
				<th>N.Afiliado</th>
				<th>Descripcion del Diagnostico</th>
				<th>Fecha........Hora</th>
				<th>Acciones</th>
			</tr>
		<?php
			//Paginador

			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM proveedor
																WHERE ( diag LIKE '%$busqueda%' OR
                                    folio LIKE '%$busqueda%' OR
																		valor LIKE '%$busqueda%'
																	 )
																AND estatus = 1  ");

			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 5;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

			$query = mysqli_query($conection,"SELECT *  FROM proveedor
										WHERE
										( diag LIKE '%$busqueda%' OR
												folio LIKE '%$busqueda%' OR
												valor LIKE '%$busqueda%')
										AND
										estatus = 1 ORDER BY diag ASC LIMIT $desde,$por_pagina
				");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
            $formato = 'Y-m-d H:i:s';
						$fecha = DateTime::createFromFormat($formato,$data["date_add"]);
			?>
				<tr>
					<td><?php echo $data["diag"]; ?></td>
					<td><?php echo $data["folio"]; ?></td>
					<td><?php echo $data["valor"]; ?></td>
					<td><?php echo $data["date_add"]; ?></td>
					<td>

						<a class="link_edit" href="editar_diagnostico.php?id=<?php echo $data["idDiag"]; ?>">Editar</a>

					<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){ ?>

					<?php } ?>

					</td>
				</tr>

		<?php
				}

			}
		 ?>


		</table>
<?php

	if($total_registro != 0)
	{
 ?>
		<div class="paginador">
			<ul>
			<?php
				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>&busqueda=<?php echo $busqueda; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>&busqueda=<?php echo $busqueda; ?>"><<</a></li>
			<?php
				}
				for ($i=1; $i <= $total_paginas; $i++) {
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>&busqueda=<?php echo $busqueda; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?>&busqueda=<?php echo $busqueda; ?> ">>|</a></li>
			<?php } ?>
			</ul>
		</div>
<?php } ?>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>
