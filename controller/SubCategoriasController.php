<?php

class SubCategoriasController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		session_start();
		if (isset(  $_SESSION['usuario_usuario']) )
		{

					
					
					
		  //Creamos el objeto usuario
			$subcategorias=new SubCategoriasModel();
			
			

			$nombre_controladores = "Categorias";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $subcategorias->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
				$categorias=new CategoriasModel();

				$columnas = " subcategorias.id_subcategorias, categorias.id_categorias, categorias.nombre_categorias, subcategorias.nombre_subcategorias, subcategorias.path_subcategorias ";
				$tablas   = "public.subcategorias, public.categorias";
				$where    = "subcategorias.id_categorias = categorias.id_categorias";
				$id       = "categorias.nombre_categorias,subcategorias.nombre_subcategorias"; 
		
				
				//Conseguimos todos los usuarios
				$resultSet=$categorias->getCondiciones($columnas ,$tablas ,$where, $id);
				
				
				$resultCat=$categorias->getAll("id_categorias");
				
				
		
				$resultEdit = "";
		
				if (isset ($_GET["id_subcategorias"])   )
				{

					$nombre_controladores = "SubCategorias";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $subcategorias->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
						$_id_subcategorias = $_GET["id_subcategorias"];
						$where    = "subcategorias.id_categorias = categorias.id_categorias AND subcategorias.id_subcategorias = '$_id_subcategorias' "; 
						$resultEdit = $categorias->getCondiciones($columnas ,$tablas ,$where, $id);
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar  SubCategorías"
					
						));
					
					
					}
					
				}
		
				
				$this->view("SubCategorias",array(
						"resultSet"=>$resultSet, "resultCat"=>$resultCat, "resultEdit" =>$resultEdit
			
				));
			
		
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a SubCategorías"
			
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
	
	public function InsertaSubCategorias(){
			
			
			$subcategorias=new SubCategoriasModel();
			
			
		session_start();
		$nombre_controladores = "SubCategorias";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $subcategorias->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
		
			$resultado = null;
			$subcategorias=new SubCategoriasModel();
		
			//_nombre_categorias character varying, _path_categorias character varying
			if (isset ($_POST["categorias"]) && isset ($_POST["nombre_subcategorias"]) && isset($_POST["path_subcategorias"])  )
				
			{
				$_id_categorias = $_POST["categorias"];
				$_nombre_subcategorias = $_POST["nombre_subcategorias"];
				$_path_subcategorias = $_POST["path_subcategorias"];
		
				 
				$funcion = "ins_subcategorias";
				$parametros = " '$_id_categorias' ,'$_nombre_subcategorias' , '$_path_subcategorias'  ";
					
				$subcategorias->setFuncion($funcion);
		
				$subcategorias->setParametros($parametros);
		
		
				$resultado=$subcategorias->Insert();
		
				/*
					$this->view("Categorias",array(
					"resultado"=>$resultado
					));
		
				*/
		
			}
			$this->redirect("SubCategorias", "index");

		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Editar a SubCategorías"
		
			));
		
		
		}
		
		
	}
	
	public function borrarId()
	{
		session_start();
		$subcategorias=new SubCategoriasModel();
		
		$nombre_controladores = "SubCategorias";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $subcategorias->getPermisosBorrar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
		
		
			if(isset($_GET["id_subcategorias"]))
			{
				$id_subcategorias=(int)$_GET["id_subcategorias"];
		
				$subcategorias=new SubCategoriasModel();
				
				$subcategorias->deleteBy(" id_subcategorias",$id_subcategorias);
				
				
			}
			
			$this->redirect("SubCategorias", "index");
			
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Acceso a Categorías"
		
			));
		
		
		}
		
	}
	
	
	public function devuelveSubcategorias()
	{
		$resultSub = array();
		
		if(isset($_POST["id_categorias"]))
		{
		
			$id_categorias=(int)$_POST["id_categorias"];
		
			$subcategorias=new SubCategoriasModel();
				
			$resultSub = $subcategorias->getBy(" id_categorias = '$id_categorias' ORDER BY nombre_subcategorias ");
				
				
		}

		echo json_encode($resultSub);
		
	}
	

	public function devuelveSubBySubcategorias()
	{
		$resultSub = array();
	
		if(isset($_POST["id_subcategorias"]))
		{
	
			$id_subcategorias=(int)$_POST["id_subcategorias"];
	
			$subcategorias=new SubCategoriasModel();
	
			$resultSub = $subcategorias->getBy(" id_subcategorias = '$id_subcategorias'  ");
	
	
		}
	
		echo json_encode($resultSub);
	
	}
	
	
	
	
	
	
	public function devuelveAllSubcategorias()
	{
		$resultSub = array();
	
			$subcategorias=new SubCategoriasModel();
	
			$resultSub = $subcategorias->getAll(" nombre_subcategorias");
	
		echo json_encode($resultSub);
	
	}
		
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$subcategorias=new SubCategoriasModel();
		//Conseguimos todos los usuarios
	
	
		$columnas = " subcategorias.id_subcategorias, categorias.nombre_categorias, subcategorias.nombre_subcategorias, subcategorias.path_subcategorias";
		$tablas   = "public.subcategorias, public.categorias";
		$where    = "subcategorias.id_categorias = categorias.id_categorias";
		$id       = "categorias.nombre_categorias,subcategorias.nombre_subcategorias";
		
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario_usuario']) )
		{
			$resultRep = $subcategorias->getCondicionesPDF($columnas, $tablas, $where, $id);
			
			$this->report("SubCategorias",array(	"resultRep"=>$resultRep));
	
		}
			
	
	}
	
	
	
	public function ReporteTotal(){
	
	
		//Creamos el objeto usuario
		$subcategorias=new SubCategoriasModel();
		//Conseguimos todos los usuarios
	
		$documentos_legal=new DocumentosLegalModel();
	
	
		$columnas = " subcategorias.nombre_subcategorias, COUNT(documentos_legal.paginas_documentos_legal) AS lecturas_documentos, SUM(documentos_legal.paginas_documentos_legal)  AS paginas_documentos";
		$tablas   = " public.subcategorias, public.documentos_legal";
		$where    = " subcategorias.id_subcategorias = documentos_legal.id_subcategorias GROUP BY subcategorias.nombre_subcategorias";
		$id       = " subcategorias.nombre_subcategorias";
	
	
		$columnas2 = " 'TOTALES' AS totales,  SUM(paginas_documentos_legal) AS total_paginas, COUNT(id_documentos_legal) AS total_documentos";
		$where2 = "id_documentos_legal > 0";
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario_usuario']) )
		{
			$resultRep = $subcategorias->getCondicionesPDF($columnas, $tablas, $where, $id);
	
			$resultRep2 = $documentos_legal->getByPDF($columnas2,"",  $where2);
			$this->report("SubCategoriasDocumentos",array(	"resultRep"=>$resultRep, "resultRep2"=>$resultRep2));
	
		}
	
	}
	
	
	
}
?>