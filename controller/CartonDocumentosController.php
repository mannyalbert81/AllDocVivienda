<?php

class CartonDocumentosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
		

		//Creamos el objeto usuario
		$carton_documentos = new CartonDocumentosModel();
		//Conseguimos todos los usuarios
		$columnas = "carton_documentos.numero_carton_documentos, carton_documentos.id_carton_documentos";
	    $tablas = " carton_documentos , documentos_legal";
		$where   = "documentos_legal.id_carton_documentos = carton_documentos.id_carton_documentos GROUP BY carton_documentos.numero_carton_documentos, carton_documentos.ID_carton_documentos";
		$id = " carton_documentos.numero_carton_documentos";
		$resultCar=$carton_documentos-> getCondiciones($columnas ,$tablas , $where, $id);
		
		$resultEdit = "";
		
		
		session_start();
		
		
		if (isset(  $_SESSION['usuario_usuario']) )
		{
				
			$nombre_controladores = "CartonDocumentos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $carton_documentos->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
			if (!empty($resultPer))
			{
				
		
				$this->view("CartonDocumentos",array(
						"resultCar"=>$resultCar, "resultEdit" =>$resultEdit
							
				));
		
		
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No Tiene Permisos de Acceso a Clientes/Proveedor"
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
	
	public function Update()
	{
		$resultado = null;
		$carton_documentos = new CartonDocumentosModel();
		$documentos_legal = new  DocumentosLegalModel();
		session_start();
		
		$nombre_controladores = "CartonDocumentos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $carton_documentos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
		
			$_destino_id = "";
			$_destino_numero = "";
			
				
				
			if (isset ($_POST["btn_guardar"]) )
			{
		
				if ($_POST["destino_id"])
				{
					$destino_new_id = $_POST["destino_new_id"];
					$destino_id = $_POST["destino_id"];
					$destino_numero = $_POST["destino_numero"];
					
					 
						
					if(count($destino_id) != count($destino_numero))
					{
						$resNumero = array_combine(array_intersect_key($destino_id, $destino_numero), array_intersect_key($destino_numero, $destino_id) );
					}
					else
					{
						$resNumero =  array_combine($destino_id, $destino_numero);
					}
						
					
					foreach($resNumero  as $id => $numero )
					{
						if (!empty($id) || !empty($numero))
						{
							
							$colval = "numero_carton_documentos = rtrim('$numero') ";
							$tabla = "carton_documentos";
							$where = "id_carton_documentos = '$id' ";
							$carton_documentos->UpdateBy($colval, $tabla, $where);
						}
		
					}
					 
					 
						
					if(count($destino_id) != count($destino_new_id))
					{
						$resId = array_combine(array_intersect_key($destino_id, $destino_new_id), array_intersect_key($destino_new_id, $destino_id) );
					}
					else
					{
						$resId =  array_combine($destino_id, $destino_new_id);
					}
						
						
					foreach($resId  as $id => $id_new )
					{
						if (!empty($id_new) )
						{
							//busco si exties este nuevo id
							 
							try {
								$resCar = $carton_documentos->getBy("id_carton_documentos = '$id_new' ");
							} catch (Exception $e) {
		
							}
		
							if (count($resCar) > 0)
							{
								///act documentos
								$colval = " id_carton_documentos = '$id_new' ";
								$tabla  = "documentos_legal";
								$where = "id_carton_documentos = '$id' ";
								$documentos_legal->UpdateBy($colval, $tabla, $where);
		
								//delete los proveedores
								$carton_documentos->deleteBy("id_carton_documentos", $id);
							}
		
							 
						}
							
							
					}
						
						
						
				}
		
			}
		
			$resultCar=$carton_documentos->getAll("numero_carton_documentos");
			$resultEdit = "";
			if (isset($_POST["btn_index_id"]))
			{
				$resultCar=$carton_documentos->getAll("id_carton_documentos");
			}
				
			if (isset($_POST["btn_index_numero"]))
			{
				$resultCar=$carton_documentos->getAll("numero_carton_documentos");
			}
			
				
		
			$this->view("CartonDocumentos",array(
					"resultCar"=>$resultCar, "resultEdit" =>$resultEdit
						
			));
		
				
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Editar Clientes/Proveedor"
		
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
