<?php

class TiposDocumentosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



public function index(){
		

		//Creamos el objeto usuario
		$tipo_documentos = new TipoDocumentosModel();
		//Conseguimos todos los usuarios
		$resultTip=$tipo_documentos->getContador( "COUNT(id_tipo_documentos) AS contador ");
		
		
		
		//getAll("nombre_tipo_documentos");
		
		$resultEdit = "";
		
		
		session_start();
		
		
		if (isset(  $_SESSION['usuario_usuario']) )
		{
				
			$nombre_controladores = "TipoDocumentos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $tipo_documentos->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
			if (!empty($resultPer))
			{
				$id_consulta= "nombre_tipo_documentos";
				
				$resultado = null;
				$tipo_documentos = new TipoDocumentosModel();
				$documentos_legal = new  DocumentosLegalModel();
				
				$nombre_controladores = "TipoDocumentos";
				$id_rol= $_SESSION['id_rol'];
				$resultPer = $tipo_documentos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
					
				if (!empty($resultPer))
				{
				
					$_destino_id = "";
					$_destino_nombre = "";
						
				
				
					if (isset ($_POST["btn_guardar"]) )
					{
				
						if ($_POST["destino_id"])
						{
							$destino_new_id = $_POST["destino_new_id"];
							$destino_id = $_POST["destino_id"];
							$destino_nombre = $_POST["destino_nombre"];
								
				
				
							if(count($destino_id) != count($destino_nombre))
							{
								$resNombre = array_combine(array_intersect_key($destino_id, $destino_nombre), array_intersect_key($destino_nombre, $destino_id) );
							}
							else
							{
								$resNombre =  array_combine($destino_id, $destino_nombre);
							}
				
								
							foreach($resNombre  as $id => $nombre )
							{
								if (!empty($id) || !empty($nombre))
								{
									$colval = "nombre_tipo_documentos = '$nombre ' ";
									$tabla = "tipo_documentos";
									$where = "id_tipo_documentos = '$id' ";
									$tipo_documentos->UpdateBy($colval, $tabla, $where);
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
										$resCar = $tipo_documentos->getBy("id_tipo_documentos = '$id_new' ");
									} catch (Exception $e) {
				
									}
				
									if (count($resCar) > 0)
									{
										///act documentos
										$colval = " id_tipo_documentos = '$id_new' ";
										$tabla  = "documentos_legal";
										$where = "id_tipo_documentos = '$id' ";
										$documentos_legal->UpdateBy($colval, $tabla, $where);
				
										//delete los proveedores
										$tipo_documentos->deleteBy("id_tipo_documentos", $id);
									}
				
				
								}
									
									
							}
				
				
				
						}
				
					}
				
					
					
					if (isset($_POST["btn_index_id"]))
					{
						$id_consulta = "id_tipo_documentos";
						
					}
				
					if (isset($_POST["btn_index_nombre"]))
					{
						$id_consulta = "nombre_tipo_documentos";
					}
						
				
				
				
				
				}
				else
				{
					$this->view("Error",array(
							"resultado"=>"No tiene Permisos de Editar Clientes/Proveedor"
				
					));
				
				
				}
				
				
				
				

				///aqui va la paginacion  ///
				$articulosTotales = 0;
				$paginasTotales = 0;
				$paginaActual = 0;
				$ultima_pagina = 1;
				if(isset($_POST["pagina"])){
				
					// en caso que haya datos, los casteamos a int
					$paginaActual = (int)$_POST["pagina"];
					$ultima_pagina = (int)$_POST["ultima_pagina"] - 10;
				}
				
				if(isset($_POST["siguiente_pagina"])){
				
					// en caso que haya datos, los casteamos a int
					$ultima_pagina = (int)$_POST["ultima_pagina"];
				}
				
			
			if(isset($_POST["btn_navegar_pagina"])){
				
					// en caso que haya datos, los casteamos a int
					$ultima_pagina = (int)$_POST["txt_navegar_pagina"];
				}
				
				
		    	if(isset($_POST["anterior_pagina"])){
				
						if ((int)$_POST["ultima_pagina"] - 20 > 0)
						{
							$ultima_pagina = (int)$_POST["ultima_pagina"] - 20;
						}
						else 
						{
							$ultima_pagina = 1;
						}
						
						
					
				}
				
				
				
				
				
				
				if ($resultTip != "")
				{
					
					foreach($resultTip as $res)
					{
						$articulosTotales = $res->contador;
					}
				
				
					$articulosPorPagina = 100;
				
					$paginasTotales = ceil($articulosTotales / $articulosPorPagina);
				
				
					// el número de la página actual no puede ser menor a 0
					if($paginaActual < 1){
						$paginaActual = 1;
					}
					else if($paginaActual > $paginasTotales){ // tampoco mayor la cantidad de páginas totales
						$paginaActual = $paginasTotales;
					}
				
					// obtenemos cuál es el artículo inicial para la consulta
					$articuloInicial = ($paginaActual - 1) * $articulosPorPagina;
				
					$columnas = " * ";
					$tablas   = "tipo_documentos";
					$where_to = " id_tipo_documentos   > 0 ";
				
				
					//agregamos el limit
					$limit = " LIMIT   '$articulosPorPagina' OFFSET '$articuloInicial'";
				
					//volvemos a pedir el resultset con la pginacion
				
					$resultTip=$tipo_documentos->getCondicionesPag($columnas ,$tablas ,$where_to,  $id_consulta, $limit );
				
				
				
				}  //
				
				$this->view("TipoDocumentos",array(
						"resultTip"=>$resultTip, "resultEdit" =>$resultEdit
						, "paginasTotales"=>$paginasTotales, "registrosTotales"=> $articulosTotales,"pagina_actual"=>$paginaActual,
						"ultima_pagina"=>$ultima_pagina
							
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