<?php

class CartonImpresoController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$carton_impreso = new CartonImpresoModel();
     	//Conseguimos todos los usuarios
		$resultSet=$carton_impreso->getAll("numero_carton_impreso");

		
		
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuario']) )
		{


			$nombre_controladores = "CartonImpreso";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $carton_impreso->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' "  );
				
			if (!empty($resultPer))
			{
			
			
				if (isset ($_GET["id_carton_impreso"])   )
				{
					$nombre_controladores = "CartonImpreso";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $carton_documentos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
					
					if (!empty($resultPer))
					{
							
					
						
						$_id_carton_impreso = $_GET["id_carton_impreso"];
						
						$resultEdit = $carton_documentos->getBy("id_carton_impreso = '$_id_carton_documentos' ") ;
						
					
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No Tiene Permisos de Editar Carton Documentos"
					
						));
						exit();
					
					}
						
				}
		
				
				$this->view("CartonImpreso",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Carton Documentos"
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
	
	public function Insert(){
			
		$resultado = null;
		$carton_impreso=new CartonImpresoModel();
	
		session_start();
		

		$nombre_controladores = "CartonImpreso";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $carton_impreso->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
		
		//_nombre_categorias character varying, _path_categorias character varying
		if (isset ($_POST["numero_carton_impreso"])  && isset ($_POST["cantidad_carton_impreso"])  )
			
		{
			
			
			
			
			
			$_numero_carton_impreso = $_POST["numero_carton_impreso"];
			$_cantidad_carton_impreso = $_POST["cantidad_carton_impreso"];
			
			$funcion = "ins_carton_impreso";
			$_numero_carton_final = $_numero_carton_impreso + $_cantidad_carton_impreso;
			
			for ($i = $_numero_carton_impreso; $i < $_numero_carton_final; $i ++ )
			{

				$parametros = " '$i'  ";
				$carton_impreso->setFuncion($funcion);
				$carton_impreso->setParametros($parametros);
				$resultado=$carton_impreso->Insert();
					

				
								
			}
			//$this->redirect("CartonImpreso", "index");

			$columnas ="numero_carton_impreso";
			$tablas = "carton_impreso";
			$where = "numero_carton_impreso BETWEEN '$_numero_carton_impreso' AND  '$_numero_carton_final'  ";
			$id  = "numero_carton_impreso";
 			
			$resultRep = $carton_impreso->getCondiciones($columnas, $tablas, $where, $id);
				
			$this->report("CartonEtiquetas",array(	"resultRep"=>$resultRep));
				
			///mando a imprimir	
		}
		
		
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Editar Carton de Documentos"
		
			));
		
		
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
