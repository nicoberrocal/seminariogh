<?php

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);

	//print_r($_REQUEST);
	//exit;
	//echo base64_encode('2');
	//exit;
	session_start();
	if(empty($_SESSION['active']))
	{
		// header('location: ../');
	}

	include "../../conexion.php";
	// require_once '../pdf/vendor/autoload.php';
	// require('../../fpdf/fpdf.php');
	// use Dompdf\Dompdf;

	if(empty($_REQUEST['cl']) || empty($_REQUEST['f']))
	{
		// echo "No es posible generar la factura.";
	}else{
		$codCliente = $_REQUEST['cl'];
		$noFactura = $_REQUEST['f'];
		$anulada = '';

		$query_config   = mysqli_query($conection,"SELECT * FROM configuracion");
		$result_config  = mysqli_num_rows($query_config);
		if($result_config > 0){
			$configuracion = mysqli_fetch_assoc($query_config);
		}


		$query = mysqli_query($conection,"SELECT f.nofactura, DATE_FORMAT(f.fecha, '%d/%m/%Y') as fecha, 
			DATE_FORMAT(f.fecha,'%H:%i:%s') as  hora, f.codcliente,f.estatus, 
												 v.nombre as vendedor,
												 cl.cuit, cl.nombre, cl.telefono,cl.direccion
											FROM factura f
											INNER JOIN usuario v
											ON f.usuario = v.idusuario
											INNER JOIN cliente cl
											ON f.codcliente = cl.idcliente
											WHERE f.nofactura = $noFactura AND f.codcliente = $codCliente AND f.estatus !=10 ");

		$result = mysqli_num_rows($query);
		if($result > 0){

			$factura = mysqli_fetch_assoc($query);
			$no_factura = $factura['nofactura'];

			if($factura['estatus'] == 2){
				$anulada = '<img class="anulada" src="img/anulado.png" alt="Anulada">';
			}

			$query_productos = mysqli_query($conection,"SELECT p.descripcion,dt.cantidad,dt.precio_venta,(dt.cantidad * dt.precio_venta) as precio_total
														FROM factura f
														INNER JOIN detallefactura dt
														ON f.nofactura = dt.nofactura
														INNER JOIN producto p
														ON dt.codproducto = p.codproducto
														WHERE f.nofactura = $no_factura ");
			$result_detalle = mysqli_num_rows($query_productos);

			ob_start();
		    include(dirname('__FILE__').'/factura.php');
		    $html = ob_get_clean();
		    ob_end_clean();
		}
	
}
		    /*
			// instantiate and use the dompdf class
			$dompdf = new Dompdf();

			$dompdf->loadHtml($html);
			// (Optional) Setup the paper size and orientation
			$dompdf->setPaper('letter', 'portrait');
			// Render the HTML as PDF
			$dompdf->render();
			// Output the generated PDF to Browser
			$dompdf->stream('factura_'.$noFactura.'.pdf',array('Attachment'=>0));
			exit;
		}
	}
*/


	if(!emptY($html)){
		echo $html;
	} else {
		echo 'No se pudo mostrar la factura';
	}
	// require_once('../../tcpdf/tcpdf.php');
	// $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	// $obj_pdf->SetCreator(PDF_CREATOR);
	// $obj_pdf->SetTitle("Reporte de stock");
	// $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
	// $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	// $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
	// $obj_pdf->SetDefaultMonospacedFont('helvetica');
	// $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	// $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
	// $obj_pdf->setPrintHeader(false);
	// $obj_pdf->setPrintFooter(false);
	// $obj_pdf->SetAutoPageBreak(TRUE, 10);
	// $obj_pdf->SetFont('helvetica', '', 12);
	// $obj_pdf->AddPage();

	// $obj_pdf->writeHTML($html);
	// $obj_pdf->Output('reporte.pdf', 'I');	
	
	

	// $pdf = new FPDF();
	// $pdf->AddPage();
	// $pdf->SetFont('Arial','B',16);
	// $pdf->
	// $pdf->Output();

?>