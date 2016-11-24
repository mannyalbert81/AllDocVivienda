<?php

include('view/reportes/CabezaReport.php');

$pdf = new PDF();

if ($resultRep !="" ) {

	$pdf->Carton = "";
	$pdf->Titulo  = "Reporte de Documentos por SubCategorías";
	
	
	$pdf->AddPage();
	//$pdf->Header('Reporte de Categorías del Sistema');
	
	$pdf->AddCol('nombre_subcategorias',50,utf8_decode('Nombre de SubCategoría'),'L');
	$pdf->AddCol('lecturas_documentos',50,utf8_decode('Cantidad de Documentos'),'C');
	$pdf->AddCol('paginas_documentos',50,'Cantidad Hojas','C');
	$prop=array('HeaderColor'=>array(246,31,66),
			'color1'=>array(255,255,255),
			'color2'=>array(255,255,210),
			'padding'=>2);
	
	$pdf->SetY(40);
	$format = 1;
	$pdf->Table($resultRep, $prop, $format);
	
	$pdf->AddCol('totales',50,utf8_decode(''),'L');
	$pdf->AddCol('total_documentos',50,utf8_decode('Total Documentos'),'C');
	$pdf->AddCol('total_paginas',50,utf8_decode('Total de Páginas'),'C');
	
	$prop2=array('HeaderColor'=>array(246,31,66),
			'color1'=>array(232,237,233),
			'color2'=>array(255,255,210),
			'padding'=>2);
	
	//$pdf->SetY(40);
	$format = 0;
	$pdf->Table($resultRep2, $prop2, $format);

}

$pdf->Output();

?>