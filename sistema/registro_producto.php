<?php 
	session_start();
	if($_SESSION['rol'] != 1)
	{
		header("location: ./");
	}
	
	
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['producto']) || empty($_POST['precio']) || empty($_POST['cantidad']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			
			$producto 		= $_POST['producto'];
			$precio  		= $_POST['precio'];
			$cantidad		= $_POST['cantidad'];
			$usuario_id		= $_SESSION['idUser'];
		
			
			$query_insert = mysqli_query($conection,"INSERT INTO producto(descripcion,precio,existencia,usuario_id)
											VALUES('$producto','$precio','$cantidad','$usuario_id')");

			

			if($query_insert){
					$alert='<p class="msg_save">Producto guardado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al guardar el producto.</p>';	
			}

		}

	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Registro Producto</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1><i class="fas fa-plus"></i> Registro Producto</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post" type="multipart/form-data">
				<label for="producto">Producto elaborado</label>
				<input type="text" name="producto" id="producto" placeholder="Nombre del producto">
				<label for="precio">Precio</label>
				<input type="number" name="precio" id="precio" placeholder="Precio del producto">
				<label for="cantidad">Cantidad</label>
				<input type="number" name="cantidad" id="cantidad" placeholder="Cantidad del producto">
				
				
				<button type="submit" class="btn_save"><i class="fas fa-save fa-lg"></i> Guardar producto</button>
				<a href="<?=$_SERVER["HTTP_REFERER"]?>" class="btn_back"><i class="fas fa-arrow-left"></i></a>

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>