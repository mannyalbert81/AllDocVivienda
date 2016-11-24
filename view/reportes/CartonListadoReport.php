<?php

include('view/reportes/CabezaReport.php');

$pdf = new PDF();

if ($resultRep !="" ) {

	$pdf->Carton = "";
	$pdf->Titulo  = "Listado de Cartones Registrados";
	
	$pdf->AddPage('P');
	
	
	 
	

	
	//$pdf->AddCol('fecha_documentos_legal',19,utf8_decode('Fecha'),'L');
	$pdf->AddCol('id_carton_documentos',20,utf8_decode('Id'),'L');
	$pdf->AddCol('numero_carton_documentos',40,utf8_decode('Numero'),'L');
	$pdf->AddCol('creado',50,'Creado','L');
	
	
	
	$prop=array('HeaderColor'=>array(63,202,254),
			'color1'=>array(255,255,255),
			'color2'=>array(206,239,252),
			'padding'=>1);
	$format = 1;
	
	
	$pdf->SetY(40);
	
	$pdf->Table($resultRep, $prop, $format);
	
	$pdf->AddCol('totales',50,utf8_decode(''),'L');
	$pdf->AddCol('total_cartones',50,utf8_decode('Total Cartones'),'C');
	
	
	
	$prop2=array('HeaderColor'=>array(63,202,254),
			'color1'=>array(255,255,255),
			'color2'=>array(206,239,252),
			'padding'=>1);
	
	//$pdf->SetY(40);
	$format = 1;
	
	$pdf->Table($resultRep2, $prop2, $format);

}




$pdf->Output();

?>