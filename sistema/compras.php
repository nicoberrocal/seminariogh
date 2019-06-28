<?php 
	session_start();
	include "../conexion.php";	

 ?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Lista de compras</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	<section id="container">
		
		<h1><i class="fas fa-money-check"></i> Lista de compras</h1>
		<a href="nueva_compra.php" class="btn_new"><i class="fas fa-plus"></i> Nueva compra</a>
		
		<form action="buscar_compra.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="No. Factura">
			<button type="submit" class="btn_search"><i class="fas fa-search"></i></button>
		</form>
		<div>
			<h5>Buscar por fecha</h5>
			<form action="buscar_venta.php" method="get" class="form_search_date">
				<label>De:</label>
				<input type="date" name="fecha_de" id="fecha_de" required>
				<label> A</label>
				<input type="date" name="fecha_a" id="fecha_a" required>
				<button type="submit" class="btn_view"><i class="fas fa-search"></i></button>
			</form>
		</div>

		<table>
			<tr>
				<th>No.</th>
				<th>Fecha / Hora</th>
				<th>Proveedor</th>
				<th>Cuit</th>
				<th>Vendedor</th>
				<th>Estado</th>
				<th class="textright">Total </th>
				<th class="textright">Acciones</th>
			</tr>

			<?php 
				//Paginador
				$sql_registe 		= mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM ticketcompra WHERE estatus != 10 ");
				$result_register 	= mysqli_fetch_array($sql_registe);
				$total_registro 	= $result_register['total_registro'];
				$por_pagina 		= 5;

				if(empty($_GET['pagina']))
				{
					$pagina = 1;
				}else{
					$pagina = $_GET['pagina'];
				}

				$desde 			= ($pagina-1) * $por_pagina;
				$total_paginas 	= ceil($total_registro / $por_pagina);

				$query = mysqli_query($conection,"SELECT  	t.noticket, 
															t.fecha,
															t.totalticket,
															t.codproveedor,
															p.cuit_prov as cuit,
															t.estatus, 
															u.nombre as vendedor, 
															p.proveedor as proveedor
												FROM ticketcompra t
												INNER JOIN usuario u ON t.usuario = u.idusuario
												INNER JOIN proveedor p ON t.codproveedor = p.codproveedor
												WHERE t.estatus != 10
												ORDER BY t.fecha DESC LIMIT $desde,$por_pagina");
				mysqli_close($conection);

				$result = mysqli_num_rows($query);

				if($result > 0):

					while ($data = mysqli_fetch_array($query)) :
						if($data["estatus"]==1)	{
							$estado = '<span class="pagada">Pagada</span>';
						}else{
							$estado = '<span class="anulada">Anulada</span>';
						}				
			?>
						<tr id="row_<?= $data["noticket"]; ?>">
							<td><?= $data['noticket']; ?></td>
							<td><?= $data['fecha']; ?></td>
							<td><?= $data['proveedor'] ?></td>
							<td><?= $data['cuit'] ?></td>
							<td><?= $data['vendedor'] ?></td>
							<td class="estado"><?php echo $estado; ?></td>
							<td class="textright totalfactura"><span>$.</span><?php echo $data["totalticket"]; ?></td>
							
							<td>
								<div class="div_acciones">
									<div>
										<button class="btn_view view_ticket" type="button" cl="<?php echo $data["codproveedor"]; ?>" f="<?php echo $data["noticket"]; ?>"><i class="fas fa-eye"></i></button>
									</div>
								
								<?php if($_SESSION['rol']==1){
									if($data["estatus"]==1)
										{
									?>
								<div class="div_factura">
									<button class="btn_anular anular_factura" fac="<?php echo $data["noticket"]; ?>"><i class="fas fa-ban"></i></button>
								</div>
							<?php 		}else{ ?>

								<div class="div_factura">
									<button type="button" class="btn_anular inactive"><i class="fas fa-ban"></i></button>

								</div>
							<?php 		} 
									}?>


							</td>
						</tr>
			
		<?php 
					endwhile;
				endif;
		 ?>
	<?php include "includes/footer.php"; ?>
</body>
</html>