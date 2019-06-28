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
		if(empty($_POST['proveedor']) || empty($_POST['articulo']) || empty($_POST['preciocompra']) || empty($_POST['stock']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios.</p>';
		}else{

			$proveedor		= $_POST['proveedor'];
			$descripcion	= $_POST['articulo'];
			$preciocompra	= $_POST['preciocompra'];
			$cantidad		= $_POST['stock'];
			$usuario_id		= $_SESSION['idUser'];
			
			$query_insert = mysqli_query($conection,"INSERT INTO articulos(proveedor,articulo,preciocompra,stock,usuario_id)
						VALUES('$proveedor','$descripcion','$preciocompra','$cantidad','$usuario_id')");

			
				if($query_insert){
					$alert='<p class="msg_save">Articulo guardado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al guardar el articulo.</p>';	
				
			}
		}
	}


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Registro Articulo</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1><i class="far fa-plus-square"></i> Registro Articulo</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post" type="multipart/form-data">
				<label for="proveedor">Proveedor</label>
				<?php
					$query_proveedor=mysqli_query($conection,"SELECT codproveedor,proveedor FROM proveedor WHERE estatus=1 ORDER BY proveedor ASC");
					$result_proveedor=mysqli_num_rows($query_proveedor);
					mysqli_close($conection);

				?>
				<select name="proveedor" id="proveedor">
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

				<label for="descripcion">Descripcion</label>
				<input type="text" name="descripcion" id="descripcion" placeholder="Nombre del articulo">
				<label for="preciocompra">Precio compra</label>
				<input type="number" name="preciocompra" id="preciocompra" placeholder="Precio de compra">
				<label for="cantidad">Cantidad</label>
				<input type="number" name="cantidad" id="cantidad" placeholder="Cantidad del articulo">
				
				
				<button type="submit" class="btn_save"><i class="fas fa-save fa-lg"></i> Guardar articulo</button>
				<a href="<?=$_SERVER["HTTP_REFERER"]?>" class="btn_back"><i class="fas fa-arrow-left"></i></a>

			</form>


		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>