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
		echo "No es posible generar el ticket.";
	}else{
		$codProveedor = $_REQUEST['cl'];
		$noTicket = $_REQUEST['f'];
		$anulada = '';

		$query_config   = mysqli_query($conection,"SELECT * FROM configuracion");
		$result_config  = mysqli_num_rows($query_config);
		if($result_config > 0){
			$configuracion = mysqli_fetch_assoc($query_config);
		}


		$query = mysqli_query($conection,"SELECT t.noticket, DATE_FORMAT(t.fecha, '%d/%m/%Y') as fecha, 
			DATE_FORMAT(t.fecha,'%H:%i:%s') as  hora, t.codproveedor,t.estatus, 
												 v.nombre as vendedor,
												 p.cuit_prov as cuit, p.proveedor, p.telefono, p.direccion
											FROM ticketcompra t
											INNER JOIN usuario v ON t.usuario = v.idusuario
											INNER JOIN proveedor p ON t.codproveedor = p.codproveedor
											WHERE t.noticket = $noTicket AND t.codproveedor = $codProveedor AND t.estatus !=10 ");

		$result = mysqli_num_rows($query);
		
		if($result > 0){

			$ticket 	= mysqli_fetch_assoc($query);
			$no_ticket 	= $ticket['noticket'];

			if($ticket['estatus'] == 2){
				$anulada = '<img class="anulada" src="img/anulado.png" alt="Anulada">';
			}

			$query_productos = mysqli_query($conection,"SELECT a.articulo,dt.cantidad,dt.precio_compra,(dt.cantidad * dt.precio_compra) as precio_total
														FROM ticketcompra t
														INNER JOIN detalleticket dt ON t.noticket = dt.noticket
														INNER JOIN articulos a ON dt.codarticulo = a.codarticulo
														WHERE t.noticket = $no_ticket ");
			$result_detalle = mysqli_num_rows($query_productos);
			
			ob_start();
		    include(dirname('__FILE__').'/ticket.php');
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