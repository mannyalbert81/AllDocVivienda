<?php

include('view/reportes/CabezaReport.php');

$pdf = new PDF();

if ($resultRep !="" ) {





$pdf->AddPage();
//$pdf->Header('Reporte de Categorías del Sistema');
$pdf->Cell(0,20,"",1,0,'R');


$pdf->SetX(50);$pdf->SetY(10);
$pdf->Cell(0,20,utf8_decode("Reporte de Categorías del Sistema"),0,0,'R');

$pdf->SetX(100);$pdf->SetY(15);
$pdf->SetFont('Arial','B',8);
$fecha = date("d/m/Y H:i:s");
$pdf->Cell(0,20,"Fecha: $fecha ",0,0,'R');

$pdf->AddCol('id_categorias',20,'Id','C');
$pdf->AddCol('nombre_categorias',80,'Nombre');
$pdf->AddCol('path_categorias',80,'Path');
$prop=array('HeaderColor'=>array(246,31,66),
		'color1'=>array(255,255,255),
		'color2'=>array(255,255,210),
		'padding'=>2);

$pdf->SetY(40);

$pdf->Table($resultRep, $prop);



/*

//First table: put all columns automatically
$pdf->Table('select * from country order by name');

$pdf->AddPage();
//Second table: specify 3 columns
$pdf->AddCol('rank',20,'','C');
$pdf->AddCol('name',40,'Country');
$pdf->AddCol('pop',40,'Pop (2001)','R');
$prop=array('HeaderColor'=>array(255,150,100),
            'color1'=>array(210,245,255),
            'color2'=>array(255,255,210),
            'padding'=>2);
$pdf->Table('select name, format(pop,0) as pop, rank from country order by rank limit 0,10',$prop);
*/

}


/*
$miCabecera = array('Id Categorias', 'Nombre Categorías', 'Path Categorías');

//$misDatos = $resultRep;
$misDatos = array();


if ($resultRep !="" ) { foreach($resultRep as $rep) {

	
	array_push ( $misDatos , array('col1' => $rep->id_categorias, 'col2' => $rep->nombre_categorias, 'col3' => $rep->path_categorias) );
	
}

}



$misDatos = array(
		array('col1' => 'Esperbeneplatoledo', 'col2' => 'Martínez', 'col3' => '20420423'),
		array('col1' => 'Araceli', 'col2' => 'Morales', 'col3' =>  '204909'),
		
);

$pdf->tablaHorizontal($miCabecera, $misDatos);
*/


$pdf->Output();

?>