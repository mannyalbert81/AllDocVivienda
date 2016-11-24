<?php

class CategoriasController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$categorias=new CategoriasModel();
					//Conseguimos todos los usuarios
		$resultSet=$categorias->getAll("nombre_categorias");
				
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuario']) )
		{
			
			///pido permiso
			$nombre_controladores = "Categorias";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $categorias->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_categorias"])   )
				{

					$nombre_controladores = "Categorias";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $categorias->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
						$_id_categorias = $_GET["id_categorias"];
						$columnas = " id_categorias, nombre_categorias, path_categorias ";
						$tablas   = "categorias";
						$where    = "id_categorias = '$_id_categorias' "; 
						$id       = "nombre_categorias";
							
						$resultEdit = $categorias->getCondiciones($columnas ,$tablas ,$where, $id);

					
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar  Categorías"
					
						));
					
						exit();
					}
						
				}
		
				
				$this->view("Categorias",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
			}
			else 
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Categorías"
		
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
	
	public function InsertaCategorias(){
			
		session_start();
		
		$resultado = null;
		$categorias=new CategoriasModel();
	
		$nombre_controladores = "Categorias";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $categorias->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
		
		
		
			//_nombre_categorias character varying, _path_categorias character varying
			if (isset ($_POST["nombre_categorias"]) && isset($_POST["path_categorias"])  )
				
			{
				
				$_nombre_categorias = $_POST["nombre_categorias"];
				$_path_categorias = $_POST["path_categorias"];
		
				 
				$funcion = "ins_categorias";
				$parametros = " '$_nombre_categorias' , '$_path_categorias'  ";
					
				$categorias->setFuncion($funcion);
		
				$categorias->setParametros($parametros);
		
		
				$resultado=$categorias->Insert();
		
		
			}
			$this->redirect("Categorias", "index");

		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Guardar  Categorías"
		
			));
		
		
		}
		
		
		
	}
	
	public function borrarId()
	{
		
			session_start();
	$categorias=new CategoriasModel();
	
	
			
		$nombre_controladores = "Categorias";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $categorias->getPermisosBorrar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
		
		
		
		
			if(isset($_GET["id_categorias"]))
			{
				$id_categorias=(int)$_GET["id_categorias"];
		
				$categorias=new CategoriasModel();
				
				$categorias->deleteBy(" id_categorias",$id_categorias);
				
				
			}
			
			$this->redirect("Categorias", "index");
			
		
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Borrar  Categorías"
		
			));
		
		
		}
		
		
		
		
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$categorias=new CategoriasModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario_usuario']) )
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
	
	
		if (isset(  $_SESSION['usuario_usuario']) )
		{
			$resultRep = $categorias->getCondicionesPDF($columnas, $tablas, $where, $id);

			$resultRep2 = $documentos_legal->getByPDF($columnas2, "",   $where2);
			
				
			
			
			$this->report("CategoriasDocumentos",array(	"resultRep"=>$resultRep, "resultRep2"=>$resultRep2));
	
		}
			
	
	
	}
	
	
}
?>