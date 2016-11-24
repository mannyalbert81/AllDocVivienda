<?php


require('view/reportes/PDF_Code39.php');

$pdf=new PDF_Code39();
$pdf->AddPage();

$i = 1;
$y_pos1 = 1;
$y_pos2 = 1;

$trama = "";
foreach($resultRep as $res)
{
	
	
	if ($i%2==0)  //es par 
	{
		$pdf->Code39(130,$y_pos2,$res->numero_carton_impreso,1,14, "Impreso por MundoDigital http://www.digitalworld.ec");
		$y_pos2 = $y_pos2 + 30;
		
	}
	else   //es impar
	{
		$pdf->Code39(20,$y_pos1, $res->numero_carton_impreso,1,14, "Impreso por MundoDigital http://www.digitalworld.ec");
		$y_pos1 = $y_pos1 + 30;
		
	}	
	
	
	
	$i++;
} 
	        
	
$pdf->Output();

?>