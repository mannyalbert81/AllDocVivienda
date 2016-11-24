<?php

include('view/reportes/CabezaReport.php');

$pdf = new PDF();

if ($resultRep !="" ) {

	$pdf->Carton = "No.  $Carton";
	$pdf->Titulo  = "Reporte de Documentos por Cartón";
	
	$pdf->AddPage('L');
	
	
	 
	
	
	/*
	$pdf->Cell(0,30, "No.  $Carton",0,0,'C');
	$pdf->SetFont('Arial','B',14);
	$pdf->Cell(0,20,utf8_decode("Reporte de Documentos por Cartón"),0,0,'R');
	*/
	
	

	
	//$pdf->AddCol('fecha_documentos_legal',19,utf8_decode('Fecha'),'L');
	$pdf->AddCol('nombre_categorias',22,utf8_decode('Categoría'),'L');
	$pdf->AddCol('nombre_subcategorias',30,'SubCategoria','L');
	$pdf->AddCol('nombre_tipo_documentos',40,'Tipo Documento','L');
	$pdf->AddCol('ruc_cliente_proveedor',26,'RUC','L');
	$pdf->AddCol('nombre_cliente_proveedor',80,'Cliente/Proveedor','L');
	$pdf->AddCol('paginas_documentos_legal',20,'Paginas','C');
	$pdf->AddCol('numero_credito_documentos_legal',35,'Numero de Credito','L');
	
	
	
	
	$prop=array('HeaderColor'=>array(63,202,254),
			'color1'=>array(255,255,255),
			'color2'=>array(206,239,252),
			'padding'=>1);
	$format = 1;
	
	
	$pdf->SetY(40);
	
	$pdf->Table($resultRep, $prop, $format);
	
	$pdf->AddCol('totales',50,utf8_decode(''),'L');
	$pdf->AddCol('total_documentos',50,utf8_decode('Total Documentos'),'C');
	$pdf->AddCol('total_paginas',50,utf8_decode('Total de Páginas'),'C');
	
	
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