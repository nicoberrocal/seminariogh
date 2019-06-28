<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	session_start();
	include "../conexion.php";

	//echo md5($_SESSION['idUser']);

	$sql 			= 'SELECT codproveedor, proveedor, cuit_prov, direccion, telefono, direccion FROM proveedor WHERE estatus = 1';
	$resultado 		= mysqli_query($conection, $sql);
	$proveedores 	= mysqli_fetch_all($resultado, MYSQLI_ASSOC);

	$sql 		= 'SELECT codarticulo, articulo FROM articulos WHERE estatus = 1';
	$resultado 	= mysqli_query($conection, $sql);
	$articulos 	= mysqli_fetch_all($resultado, MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Nueva Compra</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	
	<section id="container">
		<div class="title_page">
			<h1><i class="fas fa-cash-register"></i> Nueva compra </h1>	
		</div>
		<div class="datos_cliente">
			<div class="action_cliente">
				<h4>Datos del proveedor</h4>
				<a href="#" class="btn_new btn_new_proveedor"><i class="fas fa-user-plus"></i> Nuevo proveedor</a>
			</div>
			<form name="form_new_proveedor_compra" id="form_new_proveedor_compra" class="datos">
				<input type="hidden" name="action" value="addProveedor">
				<input type="hidden" id="idproveedor" name="idproveedor" value="" required>
				<div class="wd30">
					 <label>Cuit</label>
					<!--<input type="text" name="cuit_cliente" id="cuit_cliente" data-prov="1"> -->
					<select name="cliente" id="clienteInfo" data-prov="1">
						<option value="">Seleccionar un proveedor</option>
						<?php if(!empty($proveedores)): foreach($proveedores as $proveedor): ?>
							<option data-nombre="<?=$proveedor['proveedor']?>" data-direccion="<?=$proveedor['direccion']?>" data-telefono="<?=$proveedor['telefono']?>" value="<?=$proveedor['codproveedor']?>"><?=$proveedor['cuit_prov']?> - <?=$proveedor['proveedor']?></option>
						<?php endforeach; endif; ?>
					</select>
				</div>
				<div class="wd30">
					<label>Razon Social</label>
					<input type="text" name="nom_cliente" id="nom_cliente" disabled required>
				</div>
				<div class="wd30">
					<label>Telefono</label>
					<input type="number" name="tel_proveedor" id="tel_cliente" disabled required>
				</div>
				<div class="wd100">
					<label>Direccion</label>
					<input type="text" name="dir_proveedor" id="dir_cliente" disabled required>
				</div>
				<div id="div_registro_cliente" class="wd100">
					<button type="submit" class="btn_save"><i class="far fa-save fa-lg"></i> Guardar</button>
				</div>
			</form>
		</div>
		
		<div class="datos_venta">
			<h4> Datos de Venta</h4>
			<div class="datos">
				<div class="wd50">
					<label>Comprador</label>
					<p><?php echo $_SESSION['nombre']; ?></p>
				</div>
				<div class="wd50">
					<label> Acciones</label>
					<div id="acciones_venta">
						<a href="#" class="btn_ok textcenter" id="btn_anular_venta" data-venta="0"><i class="fas fa-ban"></i> Anular</a>
						<a href="#" class="btn_new textcenter" id="btn_facturar_venta" style="display: none;" data-venta="0"><i class="far fa-edit"></i> Procesar</a>
					</div>
				</div>
			</div>
		</div>
		<table class="tbl_venta">
			<thead>
				<tr>
					<th width="100px"> Codigo</th>
					<th> Articulo</th>
					<th> Stock</th>
					<th width="100px"> Cantidad</th>
					<th class="textright"> Precio</th>
					<th class="textright"> Precio Total</th>
					<th> Accion </th>
				</tr>
				<tr>
					<td><!-- <input type="text" name="txt_cod_producto" id="txt_cod_producto"> -->
						<select name="txt_cod_producto" id="txt_cod_producto" data-producto="0">
							<option>Seleccionar articulo</option>
							<?php if(!empty($articulos)): foreach($articulos as $articulo): ?>
								<option value="<?=$articulo['codarticulo']?>"><?=$articulo['articulo']?></option>
							<?php endforeach; endif; ?>
						</select>
					</td>
					<td id="txt_descripcion">-</td>
					<td id="txt_existencia">-</td>
					<td><input type="text" name="txt_cant_producto" id="txt_cant_producto" value="0" min="1" disabled></td>
					<td id="txt_precio" class="textright">0.00</td>
					<td id="txt_precio_total" class="textright">0.00</td>
					<td><a href="#" id="add_product_venta" data-venta="0" class="link_add"><i class="fas fa-plus"></i> Agregar</a></td>
				</tr>
				<tr>
					<th>Codigo</th>
					<th colspan="2">Articulo</th>
					<th>Stock</th>
					<th class="textright">Precio</th>
					<th class="textright">Precio Total</th>
					<th> Accion</th>
				</tr>
			</thead>
			<tbody id="detalle_venta">
				<!--CONTENIDO AJAX-->
			</tbody>
			<tfoot id="detalle_totales">
				<!--CONTENIDO AJAX-->
			</tfoot>
		</table>

	</section>


	<?php include "includes/footer.php"; ?>

	<script type="text/javascript">
		$(document).ready(function(){
			var usuarioid='<?php echo $_SESSION['idUser']; ?>';
			searchForDetalle(usuarioid, 0);
		});

	</script>
</body>
</html>