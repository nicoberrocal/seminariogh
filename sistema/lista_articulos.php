<?php 
	session_start();
	if($_SESSION['rol'] != 1)
	{
		header("location: ./");
	}
	
	include "../conexion.php";	

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista de articulos</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<h1><i class="fas fa-clipboard-list"></i> Lista de articulos</h1>
		<a href="registro_articulo.php" class="btn_new"><i class="far fa-plus-square"></i> Registrar articulo</a>
		
		<form action="buscar_articulo.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
			<button type="submit" class="btn_search"><i class="fas fa-search"></i></button>
		</form>

		<table>
			<tr>
				<th>ID</th>
				<th>Descripcion</th>
				<th>Precio compra</th>
				<th>Existencia</th>
				<th>
				<?php
					$query_proveedor=mysqli_query($conection,"SELECT codproveedor,proveedor FROM proveedor ORDER BY proveedor ASC");
					$result_proveedor=mysqli_num_rows($query_proveedor);
					
				?>
				<select name="proveedor" id="search_proveedor">
					<option value="" selected>PROVEEDOR</option>
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
				</th>
				<th>Acciones</th>
			</tr>
		<?php 
			//Paginador
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM articulos WHERE estatus=1");
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

			$query = mysqli_query($conection,"SELECT a.codarticulo, a.articulo, a.preciocompra, a.stock, pr.proveedor FROM articulos a INNER JOIN proveedor pr ON a.proveedor=pr.codproveedor ORDER BY a.codarticulo DESC LIMIT $desde,$por_pagina 
				");

			mysqli_close($conection);

			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					
					
			?>
				<tr>
					<tr class="row<?php echo $data['codarticulo']; ?>">
					<td><?php echo $data["codarticulo"]; ?></td>
					<td><?php echo $data["articulo"]; ?></td>
					<td class="celPrecio"><?php echo $data["preciocompra"]; ?></td>
					<td class="celExistencia"><?php echo $data["stock"]; ?></td>
					<td><?php echo $data["proveedor"]; ?></td>

					<?php if($_SESSION['rol'] ==1) { ?>
					<td>
						<a class="link_edit" href="editar_articulo.php?id=<?php echo $data["codarticulo"]; ?>"><i class="fas fa-edit"></i> Editar</a>
						|
						<a class="link_delete del_articulo" articulo="<?php echo $data["codarticulo"]; ?>" href="#"><i class="fas fa-trash-alt"></i> Eliminar</a>
						
					</td>
					<?php } ?>
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
				<li><a href="?pagina=<?php echo 1; ?>"><i class="fas fa-step-backward"></i></a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>"><i class="fas fa-caret-left fa-lg"></i></a></li>
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
				<li><a href="?pagina=<?php echo $pagina + 1; ?>"><i class="fas fa-caret-right fa-lg"></i></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?> "><i class="fas fa-step-forward"></i></a></li>
			<?php } ?>
			</ul>
		</div>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>