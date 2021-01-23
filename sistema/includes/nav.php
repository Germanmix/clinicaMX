		<nav>
			<ul>
				<li><a href="index.php"> <i class="fas fa-home"></i> Inicio</a></li>
			<?php
				if($_SESSION['rol'] == 1){
			 ?>
				<li class="principal">

					<a href="#"><i class="far fa-user"></i>  Usuarios</a>
					<ul>
						<li><a href="registro_usuario.php"><i class="fas fa-user-plus"></i> Nuevo Usuario</a></li>
						<li><a href="lista_usuarios.php"><i class="fas fa-list-ul"></i> Lista de Usuarios</a></li>
					</ul>
				</li>
			<?php } ?>
				<li class="principal">
					<a href="#"><i class="fas fa-user-circle"></i> Pacientes</a>
					<ul>
						<li><a href="registro_paciente.php"><i class="fas fa-user-plus"></i> Nuevo Paciente</a></li>
						<li><a href="lista_paciente.php"><i class="fas fa-list-ul"></i> Lista de Pacientes</a></li>
					</ul>
				</li>
				<?php
           if($_SESSION['rol']== 1 || $_SESSION['rol'] == 2){
				 ?>
				<li class="principal">
					<a href="#"><i class="fas fa-list-alt"></i> Diagnostico</a>
					<ul>
						<li><a href="registro_diagnostico.php"><i class="fas fa-stethoscope"></i> Nuevo Diagnostico</a></li>
						<li><a href="lista_diagnostico.php">Lista de los Diagnosticos</a></li>
					</ul>
				</li>
			<?php } ?>
				<li class="principal">
					<a href="#">Control</a>
					<ul>
						<li><a href="registro_control.php">Registro de control</a></li>
						<li><a href="#">Lista de Productos</a></li>
					</ul>
				</li>
				<li class="principal">
					<a href="#">Consultas Pacientes</a>
					<ul>
						<li><a href="#">Nuevo Factura</a></li>
						<li><a href="#">Facturas</a></li>
					</ul>
				</li>
			</ul>
		</nav>
