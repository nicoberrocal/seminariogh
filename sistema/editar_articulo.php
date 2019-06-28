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
		if(empty($_POST['proveedor']) || empty($_POST['articulo']) || empty($_POST['preciocompra']) || empty($_POST['id']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$codarticulo	= $_POST['id'];
			$proveedor		= $_POST['proveedor'];
			$articulo 		= $_POST['articulo'];
			$preciocompra  	= $_POST['preciocompra'];
			
			
			$query_update = mysqli_query($conection,"UPDATE articulos
													SET articulo='$articulo',
														proveedor=$proveedor,
														preciocompra=$preciocompra
													WHERE codarticulo=$codarticulo");
			
			}
				if($query_update){
					$alert='<p class="msg_save">Articulo actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el articulo.</p>';	
			}	
	

	}

	//validar producto
	if(empty($_REQUEST['id']))
	{
		header("location:lista_articulos.php");
	}else{

		$id_articulo= $_REQUEST['id'];
		if(!is_numeric($id_articulo))
		{
			header("location:lista_articulos.php");
		}

		$query_articulo=mysqli_query($conection,"SELECT a.codarticulo,a.articulo,a.preciocompra,pr.codproveedor,pr.proveedor 
													FROM articulos a 
													INNER JOIN proveedor pr
													ON a.proveedor= pr.codproveedor
													WHERE a.codarticulo=$id_articulo AND a.estatus=1");

		$result_articulo=mysqli_num_rows($query_articulo);

		if($result_articulo >0){
			$data_articulo=mysqli_fetch_assoc($query_articulo);

			
		}else{
			header("location:lista_articulos.php");
		}
	}

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Actualizar Articulos</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1><i class="fab fa-adn"></i> Actualizar Articulos</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post" type="multipart/form-data">
				<input type="hidden" name="id" value="<?php echo $data_articulo['codarticulo']; ?>">

				<label for="proveedor">Proveedor</label>
				<?php
					$query_proveedor=mysqli_query($conection,"SELECT codproveedor,proveedor FROM proveedor WHERE estatus=1 ORDER BY proveedor ASC");
					$result_proveedor=mysqli_num_rows($query_proveedor);
					mysqli_close($conection);

				?>
				<select name="proveedor" id="proveedor" class="notItemOne">
					<option value="<?php echo $data_articulo['codarticulo']; ?>" selected><?php echo $data_articulo['proveedor']; ?></option>
					<?php
						if($result_proveedor >0){
							while($proveedor=mysqli_fetch_array($query_proveedor)){
				?>
							<option value="<?php echo $proveedor['codproveedor']; ?>"><?php echo $proveedor['proveedor']; ?></option>	
				<?php
						}
					}
				?>
					
				</select>
				
				<label for="articulo">Articulo</label>
				<input type="text" name="articulo" id="articulo" placeholder="Nombre del articulo" value="<?php echo $data_articulo['articulo']; ?>">
				<label for="preciocompra">Precio</label>
				<input type="number" name="preciocompra" id="preciocompra" placeholder="Precio del articulo" value="<?php echo $data_articulo['precio']; ?>">
				
				
				<button type="submit" class="btn_save"><i class="fas fa-save fa-lg"></i> Actualizar producto</button>

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>