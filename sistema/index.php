<?php 
	session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Sistema de Panaderia</title>
</head>
<body>
	<?php 

	include "includes/header.php"; 
	include "../conexion.php";

	//Datos de la empresa
	$cuit = '';
	$nombreEmpresa = '';
	$razonSocial = '';
	$telEmpresa = '';
	$emailEmpresa = '';
	$dirEmpresa = '';
	$iva = '';

	$query_empresa = mysqli_query($conection,"SELECT * FROM configuracion");
	$row_empresa = mysqli_num_rows($query_empresa);
	if($row_empresa > 0)
	{
		while ($arrInfoEmpresa = mysqli_fetch_assoc($query_empresa)) {
			$cuit = $arrInfoEmpresa['cuit'];
			$nombreEmpresa = $arrInfoEmpresa['nombre'];
			$razonSocial = $arrInfoEmpresa['razon_social'];
			$telEmpresa = $arrInfoEmpresa['telefono'];
			$emailEmpresa = $arrInfoEmpresa['email'];
			$dirEmpresa = $arrInfoEmpresa['direccion'];
			$iva = $arrInfoEmpresa['iva'];

		}
	}




	$query_dash = mysqli_query($conection,"CALL dataDashboard();");
	$result_das = mysqli_num_rows($query_dash);
	if($result_das > 0){
		$data_dash = mysqli_fetch_assoc($query_dash);
		mysqli_close($conection);
	}


	?>
	<section id="container">
		<div class="divContainer">
			<div>
				<h1 class="titlePanelControl">Panel de Control</h1>
			</div>
			<div class="dashboard">
				<?php 
					if($_SESSION['rol'] == 1)
					{
					
				?>
				<a href="lista_usuarios.php">
					<i class="fas fa-users"></i>
					<p>
						<strong>Usuarios</strong><br>
						<span><?= $data_dash['usuarios']; ?></span>
					</p>
				</a>
				<?php
					}
				?>
				<a href="lista_clientes.php">
					<i class="fas fa-user"></i>
					<p>
						<strong>Clientes</strong><br>
						<span><?= $data_dash['clientes']; ?></span>
					</p>
				</a>
				<?php 
					if($_SESSION['rol'] == 1)
					{
					
				?>
				<a href="lista_proveedores.php">
					<i class="fas fa-address-card"></i>
					<p>
						<strong>Proveedores</strong><br>
						<span><?= $data_dash['proveedores']; ?></span>
					</p>
				</a>
				<?php
					}
				?>
				<a href="lista_productos.php">
					<i class="fab fa-product-hunt"></i>
					<p>
						<strong>Productos</strong><br>
						<span><?= $data_dash['productos']; ?></span>
					</p>
				</a>
				<a href="ventas.php">
					<i class="fas fa-money-check"></i>
					<p>
						<strong>Ventas</strong><br>
						<span><?= $data_dash['ventas']; ?></span>
					</p>
				</a>
				<a href="lista_articulos.php">
					<i class="fas fa-clipboard-list"></i>
					<p>
						<strong>Articulos</strong><br>
						<span><?= $data_dash['articulos']; ?></span>
					</p>
				</a>
				<a href="compras.php">
					<i class="fas fa-shopping-bag"></i>
					<p>
						<strong>Compras</strong><br>
						<span><?= $data_dash['compras']; ?></span>
					</p>
				</a>
			</div>
			

		</div>


		<div class="divInfoSistema">
			<div>
				<h1 class="titlePanelControl">Configuracion</h1>
			</div>
			<div class="containerPerfil">
				<div class="containerDataUser">
					<div class="logoUser">
						<img src="img/logoUser.png">
					</div>
					<div class="divDataUser">
						<br>
						<h4>Informacion personal</h4>


						<div>
							<label>Nombre:</label> <span><?= $_SESSION['nombre']; ?></span>
						</div>
						<div>
							<label>Correo:</label> <span><?= $_SESSION['email']; ?></span>
						</div>
						<br>
						<h4>Datos usuario</h4>
						<div>
							<label>Rol:</label> <span><?= $_SESSION['rol_name']; ?></span>
						</div>
						<div>
							<label>Usuario:</label> <span><?= $_SESSION['user']; ?></span>
						</div>
						<br>
						<h4>Cambiar contraseña:</h4>
						<form action="" method="post" name="frmChangePass" id="frmChangePass">

							<div>
								<input type="password" name="txtPassUser" id="txtPassUser" placeholder="Contraseña actual" required>
							</div>
							<div>
								<input class="newPass" type="password" name="txtNewPassUser" id="txtNewPassUser" placeholder="Nueva contraseña" required>
							</div>
							<div>
								<input class="newPass" type="password" name="txtPassConfirm" id="txtPassConfirm" placeholder="Confirmar contraseña" required>
							</div>
							<div class="alertChangePass" style="display: none;">
							</div>
							<div>
								<button type="submit" class="btn_save btnChangePass"><i class="fas fa-key"></i> Cambiar contraseña</button>
							</div>
						</form>


					</div>


				</div>
				<?php if($_SESSION['rol']==1){ ?>
				<div class="containerDataEmpresa">
					<div class="logoEmpresa">
						<img src="img/logoEmpresa.png">
					</div>
					<h4> Datos de la empresa </h4>
					<br>
						<form action="" method="post" name="frmEmpresa" id="frmEmpresa">
							<input type="hidden" name="action" value="updateDataEmpresa">
								<div>
									<label>Cuit:</label><input type="text" name="txtCuit" id="txtCuit" placeholder="Cuit de la empresa" value="<?=$cuit; ?>" required>
								</div>
								<div>
									<label>Nombre:</label><input type="text" name="txtNombre" id="txtNombre" placeholder="Nombre de la empresa" value="<?=$nombreEmpresa; ?>" required>
								</div>
								<div>
									<label>Razon social:</label><input type="text" name="txtRSocial" id="txtRSocial" placeholder="Razon social" value="<?=$razonSocial; ?>">
								</div>
								<div>
									<label>Telefono:</label><input type="text" name="txtTelEmpresa" id="txtTelEmpresa" placeholder="Numero de telefono" value="<?=$telEmpresa; ?>" required>
								</div>
								<div>
									<label>Correo Electronico:</label><input type="email" name="txtEmailEmpresa" id="txtEmailEmpresa" placeholder="Correo electronico" value="<?=$emailEmpresa; ?>" required>
								</div>
								<div>
									<label>Direccion:</label><input type="text" name="txtDirEmpresa" id="txtDirEmpresa" placeholder="Direccion de la empresa" value="<?=$dirEmpresa; ?>" required>
								</div>
								<div>
									<label>IVA (%):</label><input type="text" name="txtIva" id="txtIva" placeholder="Impuesto del valor agregado (IVA)" value="<?=$iva; ?>" required>
								</div>

								<div class="alertFormEmpresa" style="display: none;"></div>
								<div>
									<button type="submit" class="btn_save btnChangePass"><i class="far fa-save fa-lg"></i> Guardar datos</button>
								</div>
						</form>
				</div>
				<?php } ?>
			</div>	
		</div>
	</section>

	<?php include "includes/footer.php"; ?>
</body>
</html>