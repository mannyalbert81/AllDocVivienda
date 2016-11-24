<?php

class SoatController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$soat = new SoatModel();
     	//Conseguimos todos los usuarios
		$resultSet=$soat->getAll("cierre_ventas_soat");
				
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuario']) )
		{


			$nombre_controladores = "Soat";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $soat->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' "  );
				
			if (!empty($resultPer))
			{
			
			
				if (isset ($_GET["id_soat"])   )
				{
					$nombre_controladores = "Soat";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $soat->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
					
					if (!empty($resultPer))
					{
							
					
						
						$_id_soat = $_GET["id_soat"];
						
						$resultEdit = $soat->getBy("id_soat = '$_id_soat' ") ;
						
					
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No Tiene Permisos de Editar Soat"
					
						));
						exit();
					
					}
						
				}
		
				
				$this->view("Soat",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Soat"
					));
				
				
			}
				
		}
		else 
		{
				$this->view("ErrorSesion",array(
						"resultSet"=>""
			
				));
		
		}
	
	}
	
	public function Update(){
			
		$resultado = null;
		$soat=new SoatModel();
	
		session_start();
		

		$nombre_controladores = "Soat";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $soat->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
		
		//_nombre_categorias character varying, _path_categorias character varying
		if (isset ($_POST["id_soat"]) && isset ($_POST["cierre_ventas_soat"])  )
			
		{
			
			$_id_soat = $_POST["id_soat"];
			$_cierre_ventas_soat = $_POST["cierre_ventas_soat"];
			
	     	$colval = "cierre_ventas_soat = '$_cierre_ventas_soat' ";
			$tabla  = "soat";
			$where   = " id_soat = '$_id_soat' ";
	
			$resultado=$soat->UpdateBy($colval, $tabla, $where);
	
	
		}
		$this->redirect("Soat", "index");
			
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Editar Soat"
		
			));
		
		
		}
		
	}
	
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$categorias=new CategoriasModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $categorias->getByPDF("id_categorias, nombre_categorias, path_categorias", " nombre_categorias != '' ");
			$this->report("Categorias",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	

	public function ReporteTotal(){
	
	
		//Creamos el objeto usuario
		$categorias=new CategoriasModel();
		//Conseguimos todos los usuarios
	
		$documentos_legal=new DocumentosLegalModel();
		
	
		$columnas = " categorias.nombre_categorias, COUNT(documentos_legal.paginas_documentos_legal) AS lecturas_documentos, SUM(documentos_legal.paginas_documentos_legal)  AS paginas_documentos";
		$tablas   = " public.categorias, public.subcategorias, public.documentos_legal";
		$where    = " subcategorias.id_categorias = categorias.id_categorias AND subcategorias.id_subcategorias = documentos_legal.id_subcategorias GROUP BY categorias.nombre_categorias";
		$id       = "categorias.nombre_categorias";
	
	
		$columnas2 = " 'TOTALES' AS totales,  SUM(paginas_documentos_legal) AS total_paginas, COUNT(id_documentos_legal) AS total_documentos";
		$where2 = "id_documentos_legal > 0";
		
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $categorias->getCondicionesPDF($columnas, $tablas, $where, $id);

			$resultRep2 = $documentos_legal->getByPDF($columnas2, $where2);
			
				
			
			
			$this->report("CategoriasDocumentos",array(	"resultRep"=>$resultRep, "resultRep2"=>$resultRep2));
	
		}
			
	
	
	}
	
	
}
?>
