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
		if(empty($_POST['producto']) || empty($_POST['precio']) || empty($_POST['id']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$codproducto	= $_POST['id'];
			$producto 		= $_POST['producto'];
			$precio  		= $_POST['precio'];
			
			
			$query_update = mysqli_query($conection,"UPDATE producto
													SET descripcion='$producto',
														precio=$precio
													WHERE codproducto=$codproducto");
			
			}
				if($query_update){
					$alert='<p class="msg_save">Producto actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el producto.</p>';	
			}	
	

	}

	//validar producto
	if(empty($_REQUEST['id']))
	{
		header("location:lista_productos.php");
	}else{

		$id_producto= $_REQUEST['id'];
		if(!is_numeric($id_producto))
		{
			header("location:lista_productos.php");
		}

		$query_producto=mysqli_query($conection,"SELECT codproducto,descripcion,precio FROM producto WHERE codproducto=$id_producto AND estatus=1");

		$result_producto=mysqli_num_rows($query_producto);

		if($result_producto >0){
			$data_producto=mysqli_fetch_assoc($query_producto);

			
		}else{
			header("location:lista_productos.php");
		}
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar Producto</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1><i class="fab fa-palfed"></i> Actualizar Producto</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post" type="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $data_producto['codproducto']; ?>">
				
				<label for="producto">Producto</label>
				<input type="text" name="producto" id="producto" placeholder="Nombre del producto elaborado" value="<?php echo $data_producto['descripcion']; ?>">
				<label for="precio">Precio</label>
				<input type="number" name="precio" id="precio" placeholder="Precio del producto" value="<?php echo $data_producto['precio']; ?>">
				
				
				<button type="submit" class="btn_save"><i class="fas fa-save fa-lg"></i> Actualizar producto</button>

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>