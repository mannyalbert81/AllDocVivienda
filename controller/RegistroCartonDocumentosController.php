<?php

class RegistroCartonDocumentosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$carton_documentos = new CartonDocumentosModel();
     	//Conseguimos todos los usuarios
		$resultSet=$carton_documentos->getAll("numero_carton_documentos");
				
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuario']) )
		{


			$nombre_controladores = "RegistroCartonDocumentos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $carton_documentos->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' "  );
				
			if (!empty($resultPer))
			{
			
			
				if (isset ($_GET["id_carton_documentos"])   )
				{
					$nombre_controladores = "RegistroCartonDocumentos";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $carton_documentos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
					
					if (!empty($resultPer))
					{
							
					
						
						$_id_carton_documentos = $_GET["id_carton_documentos"];
						
						$resultEdit = $carton_documentos->getBy("id_carton_documentos = '$_id_carton_documentos' ") ;
						
					
						
						if (isset( $_POST["genera_acta"]))
						{
							$fecha_inicio = date("d-m-Y")."00:01.00";
							$fecha_final = date("d-m-Y")."23:00.00";
							
							$where = " creado BETWEEN '$_fecha_inicio' AND '$_fecha_final'  ";
							$resultSet = $carton_documentos->getBy($where);
							
							$this->view("ActaCartonDocumentos",array(
									"resultSet"=>$resultSet
										
							));
							
							exit();
						}
						
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No Tiene Permisos de Editar Carton Documentos"
					
						));
						exit();
					
					}
						
				}
		
				
				$this->view("RegistroCartonDocumentos",array(
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
		$carton_documentos=new CartonDocumentosModel();
	
		session_start();
		
			
		$nombre_controladores = "RegistroCartonDocumentos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $carton_documentos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
		
			
		//_nombre_categorias character varying, _path_categorias character varying
		if (isset ($_POST["agregarcartones"])  )
		{
			
			
			$_numero_carton_documentos = $_POST["agregarcartones"];
			
			$funcion = "ins_carton_documentos";
			$carton_documentos->SendMail("", "", $_numero_carton_documentos);
			
			
			for ($i=0;$i<count($_numero_carton_documentos);$i++)
			{
				$numero_carton_documentos = $_numero_carton_documentos[$i]; 
				$parametros = " '$numero_carton_documentos'  ";
				$carton_documentos->setFuncion($funcion);
				$carton_documentos->setParametros($parametros);
				$resultado=$carton_documentos->Insert();
			
			}
		}
			$this->redirect("RegistroCartonDocumentos", "index");
			
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Editar Carton de Documentos"
		
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
		$carton_documentos=new CartonDocumentosModel();
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
			
				
			
			
			$this->report("RegistroCategoriasDocumentos",array(	"resultRep"=>$resultRep, "resultRep2"=>$resultRep2));
	
		}
			
	
	
	}
	
	
}
?>
