<?php

require('../fpdf/fpdf.php');

class PDFp extends FPDF
{

	//Pie de página
	function Footer()
	{

		$this->SetY(-10);

		$this->SetFont('Arial','I',8);

		$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
}

//Creación del objeto de la clase heredada
$pdfp=new PDFp();
$pdfp->AddPage();
$pdfp->SetFont('Times','',12);
//Aquí escribimos lo que deseamos mostrar


$pdfp->Output();
?>