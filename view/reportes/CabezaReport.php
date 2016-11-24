<?php
require_once 'config/global.php';
require('view/fpdf/fpdf.php');
class PDF extends FPDF
{
	var $ProcessingTable=false;
	var $aCols=array();
	var $TableX;
	var $HeaderColor;
	var $RowColors;
	var $ColorIndex;
	var $Titulo;
	var $Carton;
   
   //Cabecera de página
   function Header()
   {

      $this->Image('view/images/logo_adocument.png',12,12,80);

      $this->SetFont('Arial','B',24);

      $this->Cell(0,20,utf8_decode(""),1,0,'R');  
      $this->SetX(80);$this->SetY(5);
      $this->Cell(0,30, $this->Carton ,0,0,'C');
      $this->SetFont('Arial','B',14);
      $this->Cell(0,18,utf8_decode($this->Titulo),0,0,'R');
      $this->SetFont('Arial','B',16);
      $this->Cell(0,32,utf8_decode(CLIENTE),0,0,'R');
      $this->SetX(100);$this->SetY(15);
      $this->SetFont('Arial','B',8);
      $fecha = date("d/m/Y H:i:s");
      $this->Cell(0,25,"Fecha: $fecha ",0,0,'R');
      
      if ($this->PageNo() > 1)
      {
      	$this->SetY(40);
      }
      

   }
   
   
   //Pie de página
   function Footer()
   {
   
   	//$this->Line(20,20,120,260);
   	
   	$this->SetY(-10);
   
   	$this->SetFont('Arial','I',8);
    //$this->Line(-100, float y1, float x2, float y2);   
   	$this->Cell(0,5,"Este documento ha sido generado por el Gestor Documental de Mundo Digital http://www.digitalworld.ec",0,0,'C');
   	
   	$this->Cell(0,15,'Pagina '.$this->PageNo(),0,0,'C');
   	
   }
   
   //tablas
   
   function Encabezado()
   {
   	//Print the table header if necessary
   	if($this->ProcessingTable)
   		$this->TableHeader();
   }
   
   function TableHeader()
   {
   	
   	$this->SetFont('Arial','B',11);
   	$this->SetX($this->TableX);
   	
   //$this->SetY(35);
   	$fill=!empty($this->HeaderColor);
   	if($fill)
   		$this->SetFillColor($this->HeaderColor[0],$this->HeaderColor[1],$this->HeaderColor[2]);
   	foreach($this->aCols as $col)
   		$this->Cell($col['w'],6,$col['c'],1,0,'C',$fill);
   	$this->Ln();
   	
   	
   }
   
   function Row($data)
   {
   	
   	$this->SetX($this->TableX);
   	$this->SetFont('Arial','',9);
   	$ci=$this->ColorIndex;
   	$fill=!empty($this->RowColors[$ci]);
   	if($fill)
   		$this->SetFillColor($this->RowColors[$ci][0],$this->RowColors[$ci][1],$this->RowColors[$ci][2]);
   	foreach($this->aCols as $col)
   		$this->Cell($col['w'],5,$data[$col['f']],1,0,$col['a'],$fill);
   	$this->Ln();
   	$this->ColorIndex=1-$ci;
   }
   
   function CalcWidths($width,$align)
   {
   	//Compute the widths of the columns
   	$TableWidth=0;
   	foreach($this->aCols as $i=>$col)
   	{
   		$w=$col['w'];
   		if($w==-1)
   			$w=$width/count($this->aCols);
   		elseif(substr($w,-1)=='%')
   		$w=$w/100*$width;
   		$this->aCols[$i]['w']=$w;
   		$TableWidth+=$w;
   	}
   	//Compute the abscissa of the table
   	if($align=='C')
   		$this->TableX=max(($this->w-$TableWidth)/2,0);
   	elseif($align=='R')
   	$this->TableX=max($this->w-$this->rMargin-$TableWidth,0);
   	else
   		$this->TableX=$this->lMargin;
   }
   
   function AddCol($field=-1,$width=-1,$caption='',$align='L')
   {
   	//Add a column to the table
   	if($field==-1)
   		$field=count($this->aCols);
   	$this->aCols[]=array('f'=>$field,'c'=>$caption,'w'=>$width,'a'=>$align);
   }
   
   function Table($resultRep,$prop=array(), $format)
   {
   	//Issue query
   	$res=$resultRep;
   	//Add all columns if none was specified
   	if(count($this->aCols)==0)
   	{
   		$nb=pg_num_fields($res);
   		for($i=0;$i<$nb;$i++)
   			$this->AddCol();
   	}
   	//Retrieve column names when not specified
   	foreach($this->aCols as $i=>$col)
   	{
   	if($col['c']=='')
   		{
   		if(is_string($col['f']))
   			$this->aCols[$i]['c']=ucfirst($col['f']);
   			else
   				$this->aCols[$i]['c']=ucfirst(pg_field_name($res,$col['f']));
   		}
   		}
   				//Handle properties
   				if(!isset($prop['width']))
   					$prop['width']=0;
   					if($prop['width']==0)
   					$prop['width']=$this->w-$this->lMargin-$this->rMargin;
   							if(!isset($prop['align']))
   								$prop['align']='C';
   								if(!isset($prop['padding']))
   										$prop['padding']=$this->cMargin;
   										$cMargin=$this->cMargin;
    $this->cMargin=$prop['padding'];
       if(!isset($prop['HeaderColor']))
       	$prop['HeaderColor']=array();
       	$this->HeaderColor=$prop['HeaderColor'];
       			if(!isset($prop['color1']))
           $prop['color1']=array();
           if(!isset($prop['color2']))
           $prop['color2']=array();
           $this->RowColors=array($prop['color1'],$prop['color2']);
           //Compute column widths
           $this->CalcWidths($prop['width'],$prop['align']);
           //Print header
			if ($format == 1)
			{
           		$this->TableHeader();
           		
			}
			
           //Print rows
           $this->SetFont('Arial','',10);
           $this->ColorIndex=0;
           $this->ProcessingTable=true;
           while($row=pg_fetch_array($res))
           	$this->Row($row);
           	$this->ProcessingTable=false;
           	
           	$this->cMargin=$cMargin;
           	$this->aCols=array();
   }
     
   
   
   
}




?>