<?php 
	session_start();
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['nombre']) || empty($_POST['cuit']) || empty($_POST['telefono']) || empty($_POST['direccion']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$nombre		= $_POST['nombre'];
			$cuit		= $_POST['cuit'];
			$telefono	= $_POST['telefono'];
			$direccion	= $_POST['direccion'];
			$usuario_id	= $_SESSION['idUser'];
			
			
			
			$result=0;

		if(is_numeric($cuit) and $cuit !=0)
			{
				$resultado = mysqli_query($conection,"SELECT * FROM cliente WHERE cuit='$cuit'");
				$result=mysqli_fetch_array($resultado);
			}

		if ($result >0)
		{
			$alert='<p class="msg_error">El numero de Cuit ya existe.</p>';
		}else{

			$query_insert = mysqli_query($conection,"INSERT INTO cliente(nombre,cuit,telefono,direccion,usuario_id) 
													VALUES('$nombre','$cuit','$telefono','$direccion','$usuario_id')");
		
		if($query_insert){
					$alert='<p class="msg_save">Cliente guardado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al guardar el cliente.</p>';
				}
			}
		}
		mysqli_close($conection);
	}	

 ?>


<html>
	<head>
		<meta charset="UTF-8">
		<?php include "includes/scripts.php";?>
		<title>Registro Cliente</title>
	</head>
<body>
	<?php include "includes/header.php";?>
	<section id="container">
		
		<div class="form_register">
			<h1><i class="fas fa-user-plus"></i> Registro cliente</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert: '';?></div>
			

			<form action="" method="post">
				<label for="cuit">Cuit/Cuil</label>
				<input type="number" name="cuit" id="cuit" placeholder="Numero de Cuit">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" id="nombre" placeholder="Nombre completo">
				<label for="telefono">Telefono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Telefono">
				<label for="direccion">Direccion</label>
				<input type="text" name="direccion" id="direccion" placeholder="Direccion">
				
				<button type="submit" class="btn_save"><i class="fas fa-save fa-lg"></i> Guardar cliente</button>
				<a href="<?=$_SERVER["HTTP_REFERER"]?>" class="btn_back"><i class="fas fa-arrow-left"></i></a>

			</form>
		</div>
	</section>
</body>
</html>