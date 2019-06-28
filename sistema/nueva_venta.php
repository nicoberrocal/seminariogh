<?php

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	session_start();
	include "../conexion.php";

	//echo md5($_SESSION['idUser']);
	
	$sql 		= 'SELECT idCliente, cuit, nombre, telefono, direccion FROM cliente WHERE estatus = 1';
	$resultado 	= mysqli_query($conection, $sql);
	$clientes 	= mysqli_fetch_all($resultado, MYSQLI_ASSOC);

	$sql 		= 'SELECT codproducto, descripcion FROM producto WHERE estatus = 1';
	$resultado 	= mysqli_query($conection, $sql);
	$productos 	= mysqli_fetch_all($resultado, MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php include "includes/scripts.php"; ?>
	<title>Nueva Venta</title>
</head>
<body>
	<?php include "includes/header.php"; ?>
	
	<section id="container">
		<div class="title_page">
			<h1><i class="fas fa-cash-register"></i> Nueva venta </h1>	
		</div>
		<div class="datos_cliente">
			<div class="action_cliente">
				<h4>Datos del cliente</h4>
				<a href="#" class="btn_new btn_new_cliente"><i class="fas fa-user-plus"></i> Nuevo cliente</a>
			</div>
			<form name="form_new_cliente_venta" id="form_new_cliente_venta" class="datos">
				<input type="hidden" name="action" value="addCliente">
				<input type="hidden" id="idcliente" name="idcliente" value="" required>
				<div class="wd30">
					<label>Cuit</label>
					<select name="cliente" id="clienteInfo" data-prov="0">
						<option value="">Seleccionar un cliente</option>
						<?php if(!empty($clientes)): foreach($clientes as $cliente): ?>
						<option data-nombre="<?=$cliente['nombre']?>" data-direccion="<?=$cliente['direccion']?>" data-telefono="<?=$cliente['telefono']?>" value="<?=$cliente['idCliente']?>"><?=$cliente['cuit']?> - <?=$cliente['nombre']?></option>
					<?php endforeach; endif; ?>
					</select>
				</div>
				<div class="wd30">
					<label>Nombre</label>
					<input type="text" name="nom_cliente" id="nom_cliente" disabled required>
				</div>
				<div class="wd30">
					<label>Telefono</label>
					<input type="number" name="tel_cliente" id="tel_cliente" disabled required>
				</div>
				<div class="wd100">
					<label>Direccion</label>
					<input type="text" name="dir_cliente" id="dir_cliente" disabled required>
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
					<label>Vendedor</label>
					<p><?php echo $_SESSION['nombre']; ?></p>
				</div>
				<div class="wd50">
					<label> Acciones</label>
					<div id="acciones_venta">
						<a href="#" class="btn_ok textcenter" id="btn_anular_venta" data-venta="1"><i class="fas fa-ban"></i> Anular</a>
						<a href="#" class="btn_new textcenter" id="btn_facturar_venta" style="display: none;" data-venta="1"><i class="far fa-edit"></i> Procesar</a>
					</div>
				</div>
			</div>
		</div>

		<table class="tbl_venta">
			<thead>
				<tr>
					<th>Codigo</th>
					<th>Descripcion</th>
					<th>Existencia</th>
					<th width="100px">Cantidad</th>
					<th class="textright">Precio</th>
					<th class="textright">Total</th>
					<th> Accion</th>
				</tr>
				<tr>
					<td><!-- <input type="text" name="txt_cod_producto" id="txt_cod_producto"> -->
						<select name="txt_cod_producto" id="txt_cod_producto" data-producto="1">
							<option>Seleccionar producto</option>
							<?php if(!empty($productos)): foreach($productos as $producto): ?>
								<option value="<?=$producto['codproducto']?>"><?=$producto['descripcion']?></option>
							<?php endforeach; endif; ?>
						</select>
					</td>
					<td id="txt_descripcion">-</td>
					<td id="txt_existencia">-</td>
					<td><input type="text" name="txt_cant_producto" id="txt_cant_producto" value="0" min="1" disabled></td>
					<td id="txt_precio" class="textright">0.00</td>
					<td id="txt_precio_total" class="textright">0.00</td>
					<td><a href="#" id="add_product_venta" class="link_add" data-venta="1"><i class="fas fa-plus"></i> Agregar</a></td>
				</tr>
				<tr>
					<th>Codigo</th>
					<th colspan="2">Descripcion</th>
					<th>Cantidad</th>
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
			searchForDetalle(usuarioid, 1);
		});

	</script>
</body>
</html>