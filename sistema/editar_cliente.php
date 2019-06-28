<?php 
	
	session_start();

	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['telefono'])  || empty($_POST['direccion']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}
		else{

			$idcliente		= $_POST['id'];
			$cuit			= $_POST['cuit'];
			$nombre			= $_POST['nombre'];
			$telefono		= $_POST['telefono'];
			$direccion		= $_POST['direccion'];
			
			
			$result=0;
			
			if(is_numeric($cuit) AND $cuit !=0)
			{
				$query = mysqli_query($conection,"SELECT * FROM cliente WHERE (cuit='$cuit' AND idcliente != $idcliente)");
				$result = mysqli_fetch_array($query);
				$resultado=count($result);
			}

			if($result > 0)
			{
				$alert='<p class="msg_error">El cuit ya existe, ingrese otro.</p>';
			}else{
				if($cuit=='')
				{
					$cuit=0;
				}
				$sql_update = mysqli_query($conection,"UPDATE cliente SET cuit = $cuit, nombre='$nombre',telefono='$telefono',direccion='$direccion'
														 WHERE idcliente= $idcliente ");
			
				if($sql_update)
				{
					$alert='<p class="msg_save">Cliente actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el cliente.</p>';
				}
			
			}
			
		}
		
	}
	
		


	//Mostrar Datos
	if(empty($_REQUEST['id']))
	{
		header('Location: lista_clientes.php');
		mysqli_close($conection);
	}
	$idcliente = $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT * FROM cliente WHERE idcliente= $idcliente AND estatus=1");

	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_clientes.php');
	}else{
		while ($data = mysqli_fetch_array($sql)) //almaceno la variable data un array
		{
			
			$idcliente		= $data['idcliente'];
			$cuit			= $data['cuit'];
			$nombre			= $data['nombre'];
			$telefono		= $data['telefono'];
			$domicilio		= $data['direccion'];
			

		}
	}

 ?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar cliente</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1><i class="fas fa-edit"></i> Actualizar cliente</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>
			
			<form action="" method="post">
				<input type="hidden" name="id" value="<?php echo $idcliente;?>">
				<label for="cuit">Cuit/Cuil</label>
				<input type="number" name="cuit" id="cuit" placeholder="Numero de Cuit" value="<?php echo $cuit;?>">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="<?php echo $nombre;?>">
				<label for="telefono">Telefono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Telefono" value="<?php echo $telefono;?>">
				<label for="direccion">Direccion</label>
				<input type="text" name="direccion" id="direccion" placeholder="Direccion" value="<?php echo $domicilio;?>" >
				
				
				<button type="submit" class="btn_save"><i class="fas fa-edit"></i> Actualizar cliente</button>

			</form>
		</div>


	</section>
<?php include "includes/footer.php"; ?>
</body>
</html>