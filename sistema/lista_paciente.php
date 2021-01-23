<?php
	session_start();

	include "../conexion.php";

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista de Pacientes</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">

		<h1>Lista de Pacientes</h1>
		<a href="registro_paciente.php" class="btn_new">Crear Paciente</a>

		<form action="buscar_paciente.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table>
			<tr>
				<th>Id Paciente</th>
				<th>N.Afiliado</th>
				<th>Nombre</th>
				<th>Fecha de Nacimiento</th>
				<th>Correo</th>
				<th>Telefono</th>
				<th>Sexo</th>
				<th>Acciones</th>
			</tr>
		<?php
			//Paginador de listas
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM cliente WHERE estatus = 1 ");
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
//funcion
			$query = mysqli_query($conection,"SELECT* FROM cliente
				        WHERE estatus = 1 ORDER BY idPaciente ASC LIMIT $desde,$por_pagina
				");

			mysqli_close($conection);

			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					if ($data["nit"] == 0)
					{
						$nit = 'S/N';
					}
					else
					{
						$nit = $data["nit"];
					}
			?>
				<tr>
					<td><?php echo $data["idPaciente"]; ?></td>
					<td><?php echo $data["nit"]; ?></td>
					<td><?php echo $data["nombre"]; ?></td>
					<td><?php echo $data["fecha_n"]; ?></td>
					<td><?php echo $data["email"]; ?></td>
					<td><?php echo $data["telefono"]; ?></td>
					<td><?php echo $data['sexo'] ?></td>
					<td>
						<a class="link_edit" href="editar_paciente.php?id=<?php echo $data["idPaciente"]; ?>">Editar</a>
						<?php if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){ ?>
						|
						<a class="link_delete" href="eliminar_confirmar_paciente.php?id=<?php echo $data["idPaciente"]; ?>">Eliminar</a>
					  <?php   } ?>

					</td>
				</tr>

		<?php
				}

			}
		 ?>


		</table>
		<div class="paginador">
			<ul>
			<?php
				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
			<?php
				}
				for ($i=1; $i <= $total_paginas; $i++) {
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
			<?php } ?>
			</ul>
		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>
