$(document).ready(function(){ 

// Modal Form Add Product
	$('.add_product').click(function(e){
		//Act on the event
		e.preventDefault();
		var producto= $(this).attr('product');
		var action='infoProducto';

		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			async: true,
			data: {action:action,producto:producto},

		success:function(response){
			if(response != 'error' && response != 0 && response != '' )
			{
				var info=JSON.parse(response);
				

				//$('#producto_id').val(info.codproducto);
				//$('.nameProducto').html(info.descripcion);

				$('.bodyModal').html('<form action="" method="post" name="form_add_product" id="form_add_product" onsubmit="event.preventDefault(); sendDataProducto();">'+
									'<h1><i class="fas fa-plus" style="font-size: 35pt;"></i> <br> Agregar producto</h1>'+
									'<h2 class="nameProducto">'+info.descripcion+'</h2><br>'+
									'<input type="number" name="cantidad" id="txtCantidad" placeholder="Cantidad del producto" required><br>'+
									'<input type="text" name="precio" id="txtPrecio" placeholder="Precio del producto" required>'+
									'<input type="hidden" name="producto_id" id="producto_id" value="'+info.codproducto+'" required><br>'+
									'<input type="hidden" name="action" value="addProducto" required>'+
									'<div class="alert alertAddProduct"></div>'+
									'<button type="submit" class="btn_new"><i class="fas fa-plus"></i> Agregar</button>'+
									'<a href="#" class="btn_ok closeModal" onclick="closeModal();"><i class="fas fa-ban"></i> Cerrar</a>'+
									'</form>');
			}
		},
	
		error:function(error){
			console.log(error);
		},

		
		});


		$('.modal').fadeIn();

	});

	$('#clienteInfo').on('change', function (e) {
	    var obj 		= $(this)[0].selectedOptions[0];
	    console.log(obj);
	    var nombre 		= obj.dataset.nombre;
	    var telefono 	= obj.dataset.telefono;
	    var direccion 	= obj.dataset.direccion;
	    $('#nom_cliente').val(nombre);
	    $('#tel_cliente').val(telefono);
	    $('#dir_cliente').val(direccion);
	    $('#idcliente').val(obj.value);
	});

	$('#proveedorInfo').on('change', function (e) {
	    var obj 		= $(this)[0].selectedOptions[0];
	    console.log(obj);
	    var nombre 		= obj.dataset.proveedor;
	    var telefono 	= obj.dataset.telefono;
	    var direccion 	= obj.dataset.direccion;
	    $('#nom_cliente').val(nombre);
	    $('#tel_proveedor').val(telefono);
	    $('#dir_proveedor').val(direccion);
	    $('#idproveedor').val(obj.value);
	});

	// Modal Form Delete Articulo
	$('.del_articulo').click(function(e){
		//Act on the event
		e.preventDefault();
		var articulo= $(this).attr('articulo');
		var action='infoArticulo';

		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			async: true,
			data: {action:action,articulo:articulo},

		success:function(response){
			if(response != 'error' && response != 0 && response != '' )
			{
				var info=JSON.parse(response);
				

				//$('#producto_id').val(info.codproducto);
				//$('.nameProducto').html(info.descripcion);

				$('.bodyModal').html('<form action="" method="post" name="form_del_articulo" id="form_del_articulo" onsubmit="event.preventDefault(); delArticulo();">'+
									'<h1><i class="fas fa-trash-alt" style="font-size: 35pt;"></i> <br> Eliminar articulo</h1>'+
									'<p>¿Está seguro de eliminar el siguiente registro?</p>'+
									'<h2 class="nameArticulo">'+info.articulo+'</h2><br>'+
									'<input type="hidden" name="articulo_id" id="articulo_id" value="'+info.codarticulo+'" required><br>'+
									'<input type="hidden" name="action" value="delArticulo" required>'+
									'<div class="alert alertAddArticulo"></div>'+
									'<a href="#" class="btn_cancel" onclick="closeModal();"><i class="fas fa-ban"></i> Cerrar</a>'+
									'<button type="submit" class="btn_ok"><i class="fas fa-trash-alt"></i> Eliminar</button>'+
									'</form>');
			}
		},
	
		error:function(error){
			console.log(error);
		},

		
		});


		$('.modal').fadeIn();

	});

// Modal Form Delete Product
	$('.del_product').click(function(e){
		//Act on the event
		e.preventDefault();
		var producto= $(this).attr('product');
		var action='infoProducto';

		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			async: true,
			data: {action:action,producto:producto},

		success:function(response){
			if(response != 'error' && response != 0 && response != '' )
			{
				var info=JSON.parse(response);
				

				//$('#producto_id').val(info.codproducto);
				//$('.nameProducto').html(info.descripcion);

				$('.bodyModal').html('<form action="" method="post" name="form_del_product" id="form_del_product" onsubmit="event.preventDefault(); delProduct();">'+
									'<h1><i class="fas fa-trash-alt" style="font-size: 35pt;"></i> <br> Eliminar producto</h1>'+
									'<p>¿Está seguro de eliminar el siguiente registro?</p>'+
									'<h2 class="nameProducto">'+info.descripcion+'</h2><br>'+
									'<input type="hidden" name="producto_id" id="producto_id" value="'+info.codproducto+'" required><br>'+
									'<input type="hidden" name="action" value="delProduct" required>'+
									'<div class="alert alertAddProduct"></div>'+
									'<a href="#" class="btn_cancel" onclick="closeModal();"><i class="fas fa-ban"></i> Cerrar</a>'+
									'<button type="submit" class="btn_ok"><i class="fas fa-trash-alt"></i> Eliminar</button>'+
									'</form>');
			}
		},
	
		error:function(error){
			console.log(error);
		},

		
		});


		$('.modal').fadeIn();

	});


$('#search_proveedor').change(function(e){
	e.preventDefault();

	var sistema = getUrl();
	location.href = sistema+'buscar_articulo.php?proveedor='+$(this).val();

});


//activa campos para registrar cliente
$('.btn_new_cliente').click(function(e){
	e.preventDefault();
	$('#nom_cliente').removeAttr('disabled');
	$('#tel_cliente').removeAttr('disabled');
	$('#dir_cliente').removeAttr('disabled');

	$('#div_registro_cliente').slideDown();
});

//buscar cliente
$('#cuit_cliente').keyup(function(e){
	e.preventDefault();

	var cl = $(this).val();
	var prov = $(this).data('prov');
	var action = 'searchCliente';

	if(prov) {
		action = 'searchProveedor';
	}

	$.ajax({
			url: 'ajax.php',
			type: 'POST',
			async: true,
			data: {action:action,cliente:cl},

			success:function(response)
			{

				if(response == 0){
					$('#idCliente').val('');
					$('#nom_cliente').val('');
					$('#tel_cliente').val('');
					$('#dir_cliente').val('');
					//Mostrar boton agregar
					$('.btn_new_cliente').slideDown();
				}else{
					var data = $.parseJSON(response);
					$('#idCliente').val(data.idcliente);
					$('#nom_cliente').val(data.nombre);
					$('#tel_cliente').val(data.telefono);
					$('#dir_cliente').val(data.direccion);
					//ocultar boton agregar
					$('.btn_new_cliente').slideUp();

					//bloque campos
					$('#nom_cliente').attr('disabled','disabled');
					$('#tel_cliente').attr('disabled','disabled');
					$('#dir_cliente').attr('disabled','disabled');

					//oculta boton guardar
					$('#div_registro_cliente').slideUp();

				}
			},
			error:function(error){

			}
	});

});

//crear cliente - Ventas
$('#form_new_cliente_venta').submit(function(e){
	e.preventDefault();

	$.ajax({
			url: 'ajax.php',
			type: 'POST',
			async: true,
			data: $('#form_new_cliente_venta').serialize(),

			success:function(response)
			{
				if(response != 'error' && response != 0 && response != '' ){
					//agregar id a input hiden
					$('#idcliente').val(response);
					//bloque campos
					$('#nom_cliente').attr('disabled','disabled');
					$('#tel_cliente').attr('disabled','disabled');
					$('#dir_cliente').attr('disabled','disabled');

					//oculta boton agregar
					$('.btn_new_cliente').slideUp();
					//oculta boton guardar
					$('#div_registro_cliente').slideUp();
				}
				
			},

			error:function(error){

			}
	});

});



//buscar producto
$('#txt_cod_producto').on('change', function(e){
	e.preventDefault();
	
	var producto 	= $(this).val();
	var action 		= 'infoProducto';
	var es_producto = $(this).data('producto');
	if(es_producto == 0) {
		action = 'infoArticulo';
	}
	if(producto != '')
	{
		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			async: true,
			data: {action:action,producto:producto,es_producto:es_producto},

			success:function(response)
			{
				if(response != 'error' && response != 0 && response != '' )
				{
					var info= JSON.parse(response);

					if(es_producto == 1) {

						$('#txt_descripcion').html(info.descripcion);
						$('#txt_existencia').html(info.existencia);
						$('#txt_cant_producto').val('1');
						$('#txt_precio').html(info.precio);
						$('#txt_precio_total').html(info.precio);
					} else {
						$('#txt_descripcion').html(info.articulo);
						$('#txt_existencia').html(info.stock);
						$('#txt_cant_producto').val('1');
						$('#txt_precio').html(info.preciocompra);
						$('#txt_precio_total').html(info.preciocompra);
					}
					
					

					//activar cantidad
					$('#txt_cant_producto').removeAttr('disabled');

					//mostrar boton agregar
					$('#add_product_venta').slideDown();
				}else{
					$('#txt_descripcion').html('-');
					$('#txt_existencia').html('-');
					$('#txt_cant_producto').val('0');
					$('#txt_precio').html('0.00');
					$('#txt_precio_total').html('0.00');

					//bloquear cantidad
					$('#txt_cant_producto').attr('disabled','disabled');

					//ocultar boton agregar
					$('#add_product_venta').slideUp();
				}
				
			},

			error:function(error){

			}
	});

	}

});

//validar cantidad del producto antes de agregar
$('#txt_cant_producto').keyup(function(e){
	e.preventDefault();

	var precio_total= $(this).val() * $('#txt_precio').html();
	var existencia= parseInt($('#txt_existencia').html());
	$('#txt_precio_total').html(precio_total);

	//oculta el boton agregar si la cantidad es menor que 1
	if( ($(this).val() < 1 || isNaN($(this).val())) || ($(this).val() > existencia) ) {
		$('#add_product_venta').slideUp();
	}else{
		$('#add_product_venta').slideDown();
	}

	});

	
//agregar producto al detalle
$('#add_product_venta').click(function(e){
	e.preventDefault();

	if($('#txt_cant_producto').val() > 0){

		var codproducto = $('#txt_cod_producto').val();
		var cantidad 	= $('#txt_cant_producto').val();
		var action 		= 'addProductoDetalle';
		var venta 		= $(this).data('venta');
		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			async: true,
			data: {action:action,producto:codproducto,cantidad:cantidad, venta:venta},

			success:function(response)
			{
				if(response !='error')
				{
					var info = JSON.parse(response);
					$('#detalle_venta').html(info.detalle);
					$('#detalle_totales').html(info.totales);


					$('#txt_cod_producto').val('');
					$('#txt_descripcion').html('-');
					$('#txt_existencia').html('-');
					$('#txt_cant_producto').val('0');
					$('#txt_precio').html('0.00');
					$('#txt_precio_total').html('0.00');

					//bloquear cantidad
					$('#txt_cant_producto').attr('disabled','disabled');

					//ocultar boton agregar
					$('#add_product_venta').slideUp();


				}else{
					console.log('no data');
				}

				viewProcesar();
			},

			error: function(error){

			}

		});
	}

});

//anular venta
$('#btn_anular_venta').click(function(e){
	e.preventDefault();

	var rows = $('#detalle_venta tr').length;
	var venta = $(this).data('venta');
	if(rows > 0)
	{
		var action = 'anularVenta';

		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			async: true,
			data: {action:action, venta:venta},

			success:function(response)
			{
				if(response != 'error' && response != 0 && response != '' )
				{
					location.reload();
				}
			},
			error: function(error) {
				
			}

		});
	}

});



//facturar venta
$('#btn_facturar_venta').click(function(e){
	e.preventDefault();

	var rows = $('#detalle_venta tr').length;

	if(rows > 0)
	{
		var action = 'procesarVenta';
		var codcliente = $('#idcliente').val();
		if(codcliente == '') {
			alert('Debe seleccionar un cliente');
			return;
		}
		var codproveedor = $('#idproveedor').val();
		
		if(codproveedor == ''){
			alert('Debe seleccionar un proveedor');
			return;
		}
		
		
		console.log(codcliente);
		var venta = $(this).data('venta');
		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			async: true,
			data: {action:action,codcliente:codcliente,venta:venta},

			success:function(response)
			{
				if(response != 'error' && response != 0 && response != '' )
				{
					var info = JSON.parse(response);
					
					generarPDF(info.codcliente,info.nofactura);
					location.reload();
				}else{
					console.log('no data');
				}
			},
			error: function(error) {
				
			}

		});
	}

});


// Modal Form Anular Factura
	$('.anular_factura').click(function(e){
		//Act on the event
		e.preventDefault();

		var nofactura = $(this).attr('fac');
		var action = 'infoFactura';

		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			async: true,
			data: {action:action,nofactura:nofactura},

		success:function(response){
			if(response != 'error' && response != 0 && response != '' ){
				var info=JSON.parse(response);
				

				$('.bodyModal').html('<form action="" method="post" name="form_anular_factura" id="form_anular_factura" onsubmit="event.preventDefault(); anularFactura();">'+
									'<h1><i class="fas fa-trash-alt" style="font-size: 35pt;"></i> <br> Anular Factura</h1><br>'+
									'<p>¿Realmente desea anular la factura?</p>'+

									
									'<p><strong>No. '+info.nofactura+'</strong></p>'+
									'<p><strong>Monto. $. '+info.totalfactura+'</strong></p>'+
									'<p><strong>Fecha. '+info.fecha+'</strong></p>'+
									'<input type="hidden" name="action" value="anularFactura">'+
									'<input type="hidden" name="no_factura" id="no_factura" value="'+info.nofactura+'" required>'+

									
									'<div class="alert alertAddProduct"></div>'+
									'<button type="submit" class="btn_ok"><i class="fas fa-trash-alt"></i> Anular</button>'+
									'<a href="#" class="btn_cancel" onclick="closeModal();"><i class="fas fa-ban"></i> Cerrar</a>'+
									
									'</form>');
			}
		},
	
		error:function(error){
			console.log(error);
		},

		
		});


		$('.modal').fadeIn();

	});	

	//Ver factura
	$('.view_factura').click(function(e){
		e.preventDefault();

		var codCliente = $(this).attr('cl');
		var noFactura = $(this).attr('f');
		generarPDF(codCliente,noFactura, 0);

	});
	$('.view_ticket').click(function(e){
		e.preventDefault();

		var codCliente 	= $(this).attr('cl');
		var noFactura 	= $(this).attr('f');
		var t 			= 1;
		generarPDF(codCliente,noFactura, 1);

	});

	//cambiar password
	$('.newPass').keyup(function(){
		validPass();
	});

	//Form cambiar contraseña
	$('#frmChangePass').submit(function(e){
		e.preventDefault();

		var passActual = $('#txtPassUser').val();
		var passNuevo = $('#txtNewPassUser').val();
		var confirmPassNuevo = $('#txtPassConfirm').val();
		var action = "changePassword";

		if(passNuevo != confirmPassNuevo){
			$('.alertChangePass').html('<p style="color:red;">Las contraseñas no son iguales.</p>');
			$('.alertChangePass').slideDown();
			return false;
		}
		if(passNuevo.length < 6){
			$('.alertChangePass').html('<p style="color:red;">La nueva contraseña deber ser de 6 caracteres como minimo.</p>');
			$('.alertChangePass').slideDown();
			return false;
		}

		$.ajax({
			url: 'ajax.php',
			type: 'POST',
			async: true,
			data: {action:action,passActual:passActual,passNuevo:passNuevo},

			success:function(response)
			{
				if(response !='error')
				{
					var info = JSON.parse(response);
					if(info.cod == '00'){
						$('.alertChangePass').html('<p style="color:green;">'+info.msg+'</p>');
						$('#frmChangePass')[0].reset();
					}else{
						$('.alertChangePass').html('<p>'+info.msg+'</p>');
					}
					$('.alertChangePass').slideDown();
				}
			},
			error: function(error) {
				
			}

		});
	});


	//Actualizar datos empresa
	$('#frmEmpresa').submit(function(e){
		e.preventDefault();

		var intCuit 			= $('#txtCuit').val();
		var strNombreEmp 		= $('#txtNombre').val();
		var strRSocialEmp 		= $('#txtRSocial').val();
		var intTelEmp 			= $('#txtTelEmpresa').val();
		var strEmailEmp			= $('#txtEmailEmpresa').val();
		var strDirEmp		 	= $('#txtDirEmpresa').val();
		var intIva 				= $('#txtIva').val();


		if(intCuit == '' || strNombreEmp == '' || strRSocialEmp == '' || intTelEmp == '' || strEmailEmp == '' || strDirEmp == '' || intIva == ''){
			$('.alertFormEmpresa').html('<p style="color:red">Todos los campos son obligatorio.</p>');
			$('.alertFormEmpresa').slideDown();
			return false;
		}

		$.ajax({
			url: 'ajax.php',
			type: "POST",
			async: true,
			data: $('#frmEmpresa').serialize(),
			beforeSend: function(){
				$('.alertFormEmpresa').slideUp();
				$('.alertFormEmpresa').html('');
				$('#frmEmpresa input').attr('disabled', 'disabled');
			},

			success: function(response)
			{
				
					var info = JSON.parse(response);
					if(info.cod == '00'){
						$('.alertFormEmpresa').html('<p style="color: #23922d;">'+info.msg+'</p>');
						$('.alertFormEmpresa').slideDown();
					}else{
						$('.alertFormEmpresa').html('<p style="color:red;">'+info.msg+'</p>');

					}
					$('.alertFormEmpresa').slideDown();
					$('#frmEmpresa input').removeAttr('disabled');
				
			},
			error:function(error){

			}

		});


	});


}); //End ready

function validPass(){
	var passNuevo = $('#txtNewPassUser').val();
	var confirmPassNuevo = $('#txtPassConfirm').val();
	if(passNuevo != confirmPassNuevo){
		$('.alertChangePass').html('<p style="color:red;">Las contraseñas no son iguales.</p>');
		$('.alertChangePass').slideDown();
		return false;
	}
	if(passNuevo.length < 6){
		$('.alertChangePass').html('<p style="color:red;">La nueva contraseña deber ser de 6 caracteres como minimo.</p>');
		$('.alertChangePass').slideDown();
		return false;
	}

	$('.alertChangePass').html('');
	$('.alertChangePass').slideUp();
}

//Anular Factura
function anularFactura(){
	var noFactura = $('#no_factura').val();
	var action = 'anularFactura';

	$.ajax({
		url: 'ajax.php',
		type: "POST",
		async: true,
		data: {action:action,noFactura:noFactura},

		success: function(response)
		{
			if(response == 'error'){
				$('.alertAddProduct').html('<p style="color:red;">Error al anular la factura.</p>');

			}else{
				$('#row_'+noFactura+' .estado').html('<span class="anulada">Anulada</span>');
				$('#form_anular_factura .btn_ok').remove();
				$('#row_'+noFactura+' .div_factura').html('<button type="button" class="btn_anular inactive" ><i class="fas fa-ban"></i></button>');
				$('.alertAddProduct').html('<p>Factura anulada.</p>');

			}
			
		},
		error: function(error){

		}
		
	});
}

function generarPDF(cliente,factura,t){

	var ancho = 1000;
	var alto = 800;
	//calcular posicion x,y para centrar la ventana
	var x = parseInt((window.screen.width/2) - (ancho / 2));
	var y = parseInt((window.screen.height/2) - (alto / 2));

	if(t == 0) {
		$url = 'factura/generaFactura.php?cl='+cliente+'&f='+factura;
	} else {
		$url = 'factura/generarTicket.php?cl='+cliente+'&f='+factura;
	}

	window.open($url,"Factura","left="+x+",top="+y+",height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");
}


function del_product_detalle(correlativo, venta){
	
	var action = 'delProductoDetalle';
	var id_detalle = correlativo;


	$.ajax({
			url: 'ajax.php',
			type: 'POST',
			async: true,
			data: {action:action,id_detalle:id_detalle, venta:venta},

			success:function(response)
			{
				try{
					
					var info = JSON.parse(response);

					$('#detalle_venta').html(info.detalle);
					$('#detalle_totales').html(info.totales);


					$('#txt_cod_producto').val('');
					$('#txt_descripcion').html('-');
					$('#txt_existencia').html('-');
					$('#txt_cant_producto').val('0');
					$('#txt_precio').html('0.00');
					$('#txt_precio_total').html('0.00');

					//bloquear cantidad
					$('#txt_cant_producto').attr('disabled','disabled');

					//ocultar boton agregar
					$('#add_product_venta').slideUp();


				}catch(e){

					$('#detalle_venta').html('');
					$('#detalle_totales').html('');

				}

				viewProcesar();
				
			},

			error: function(error){

			}

		});


}


//mostrar/ocultar boton procesar
function viewProcesar(){
	if($('#detalle_venta tr').length >0)
	{
		$('#btn_facturar_venta').show();	
	}else{
		$('#btn_facturar_venta').hide();
	}
}



function searchForDetalle(id, venta){

	var action='searchForDetalle';
	var user=id;

	$.ajax({
			url: 'ajax.php',
			type: 'POST',
			async: true,
			data: {action:action,user:user, venta:venta},

			success:function(response)
			{
				if(response !='error')
				{
					var info = JSON.parse(response);
					$('#detalle_venta').html(info.detalle);
					$('#detalle_totales').html(info.totales);


				}else{
					console.log('no data');
				}

				viewProcesar();
			},

			error: function(error){

			}

		});

}

function getUrl(){
	var loc= window.location;
	var pathName= loc.pathName.substring(0,loc.pathName.lastIndexOf('/') + 1);
	return loc.href.substring(0, loc.href.length - ((loc.pathName + loc.search + loc.hash).length - pathName.length));

}

function sendDataProducto(){
	$('.alertAddProduct').html('');

	$.ajax({
			url: 'ajax.php',
			type: 'POST',
			async: true,
			data: $('#form_add_product').serialize(),

		success:function(response){
			if(response == 'error')
			{
				$('.alertAddProduct').html('<p style="color:red;"> Error el agregar el producto</p>');
			}else{
				var info=JSON.parse(response);
				$('.row'+info.producto_id+'.CelPrecio').html(info.nuevo_precio);
				$('.row'+info.producto_id+' .celExistencia').html(info.nuevo_existencia);
				$('#txtCantidad').val('');
				$('#txtPrecio').val('');
				$('.alertAddProduct').html('<p> Producto guardado correctamente</p>');
			}
		},

		error:function(error){
			console.log(error);
		},

		
		});

}


function sendDataProduct(){
	$('.alertAddProduct').html('');

	$.ajax({
			url: 'ajax.php',
			type: 'POST',
			async: true,
			data: $('#form_add_product').serialize(),

		success:function(response){
			if(response == 'error')
			{
				$('.alertAddProduct').html('<p style="color:red;"> Error el agregar el producto</p>');
			}else{
				var info=JSON.parse(response);
				$('.row'+info.producto_id+'.CelPrecio').html(info.nuevo_precio);
				$('.row'+info.producto_id+'.CelExistencia').html(info.nuevo_existencia);
				$('#txtCantidad').val('');
				$('#txtPrecio').val('');
				$('.alertAddProduct').html('<p> Producto guardado correctamente</p>');
			}
		},

		error:function(error){
			console.log(error);
		},

		
		});

}



//eliminar producto
function delProduct(){

	var pr = $('#producto_id').val();
	$('.alertAddProduct').html('');

	$.ajax({
			url: 'ajax.php',
			type: 'POST',
			async: true,
			data: $('#form_del_product').serialize(),

		success:function(response){

			if(response == 'error')
			{
				$('.alertAddProduct').html('<p style="color:red;"> Error al eliminar el producto</p>');
			}else{
				//var info=JSON.parse(response);
				$('.row'+pr).remove();
				$('#form_del_product .btn_ok').remove();
				$('.alertAddProduct').html('<p> Producto eliminado correctamente</p>');
			}
		},

		error:function(error){
			console.log(error);
		},

	});

}

//eliminar articulo
function delArticulo(){

	var pr = $('#articulo_id').val();
	$('.alertAddArticulo').html('');

	$.ajax({
			url: 'ajax.php',
			type: 'POST',
			async: true,
			data: $('#form_del_articulo').serialize(),

		success:function(response){

			if(response == 'error')
			{
				$('.alertAddArticulo').html('<p style="color:red;"> Error al eliminar el articulo</p>');
			}else{
				//var info=JSON.parse(response);
				$('.row'+pr).remove();
				$('#form_del_articulo .btn_ok').remove();
				$('.alertAddArticulo').html('<p> Articulo eliminado correctamente</p>');
			}
		},

		error:function(error){
			console.log(error);
		},

	});

}


function closeModal(){

	$('.alertAddProduct').html('');
	$('#txtCantidad').val('');
	$('#txtPrecio').val('');
	$('.modal').fadeOut();
}