<?php

class DocumentosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){

		session_start();
		
		$documentos_legal = new DocumentosLegalModel();
		
		if (isset(  $_SESSION['usuario_usuario']) )
		{
			$nombre_controladores = "Documentos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $documentos_legal->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
			
				$registrosTotales = 0;
				$hojasTotales = 0;
					
					// Categorias
				$categorias=new CategoriasModel();
				$resultCat=$categorias->getAll("nombre_categorias");
				
				
				$subcategorias=new SubCategoriasModel();
				$resultSub=$subcategorias->getAll("nombre_subcategorias");
				
				//cliente_proveedor
				$cliente_proveedor=new ClienteProveedorModel();
				$columnas_cp = " cliente_proveedor.id_cliente_proveedor,  cliente_proveedor.ruc_cliente_proveedor,  cliente_proveedor.nombre_cliente_proveedor";
				$tablas_cp   = "   public.cliente_proveedor, public.documentos_legal";
				$where_cp  = " cliente_proveedor.id_cliente_proveedor = documentos_legal.id_cliente_proveedor GROUP BY  cliente_proveedor.ruc_cliente_proveedor, cliente_proveedor.nombre_cliente_proveedor ,cliente_proveedor.id_cliente_proveedor";
				$id_cp = " cliente_proveedor.nombre_cliente_proveedor";
				$resultCli=$cliente_proveedor->getCondiciones($columnas_cp, $tablas_cp, $where_cp, $id_cp);;
				
				//Tipo de Documento
				$tipo_documentos=new TipoDocumentosModel();
				$columnas_td = "  tipo_documentos.nombre_tipo_documentos, tipo_documentos.id_tipo_documentos";
				$tablas_td   = " public.documentos_legal, public.tipo_documentos";
				$where_td  = " documentos_legal.id_tipo_documentos = tipo_documentos.id_tipo_documentos GROUP BY tipo_documentos.nombre_tipo_documentos, tipo_documentos.id_tipo_documentos";
				$id_td = " tipo_documentos.nombre_tipo_documentos";
				$resultTip=$tipo_documentos->getCondiciones($columnas_td, $tablas_td, $where_td, $id_td);;
				
				//Carton Documento
				$carton_documentos=new CartonDocumentosModel();
				$columnas_cd = " carton_documentos.id_carton_documentos, carton_documentos.numero_carton_documentos";
				$tablas_cd   = " public.carton_documentos, public.documentos_legal";
				$where_cd  = "carton_documentos.id_carton_documentos = documentos_legal.id_carton_documentos GROUP BY carton_documentos.id_carton_documentos, carton_documentos.numero_carton_documentos";
				$id_cd = " carton_documentos.numero_carton_documentos";
				$resultCar=$carton_documentos->getCondiciones($columnas_cd, $tablas_cd, $where_cd, $id_cd);;
				
				
				//SOAT
				$soat=new SoatModel();
				$columnas_so = " id_soat, cierre_ventas_soat";
				$tablas_so   = " soat";
				$where_so  = " id_soat > 0";
				$id_so = "cierre_ventas_soat";
				$resultSoa= "";
				//$resultSoa=$soat->getCondiciones($columnas_so, $tablas_so, $where_so, $id_so);;
				
				
		         
				//documentos Legl
				
				//$resultPol = $documentos_legal->getCondiciones("numero_poliza_documentos_legal", "documentos_legal", "numero_poliza_documentos_legal !='' GROUP BY numero_poliza_documentos_legal", "numero_poliza_documentos_legal");
				$resultPol = "";
				
				$resultEdit = "";
				$resul = "";
		
				if (isset ($_GET["id_documentos_legal"])   )
				{
					$nombre_controladores = "Documentos";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $documentos_legal->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
					
					if (!empty($resultPer))
					{
						$_id_documentos_legal = $_GET["id_documentos_legal"];
						$resultEdit = $documentos_legal->getBy("id_documentos_legal = '$_id_documentos_legal'     ");
						
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar a Documentos"
					
						));
					
						exit();
					}
						
				}
		
				
					
				
				
				
				if (isset ($_POST["categorias"]) && isset ($_POST["subcategorias"]) && isset($_POST["ruc_cliente_proveedor"]) && isset($_POST["nombre_cliente_proveedor"]) && isset($_POST["tipo_documentos"]) && isset($_POST["carton_documentos"])   && isset($_POST["fecha_documento_desde"]) && isset($_POST["fecha_documento_hasta"])  && isset($_POST["fecha_subida_desde"])  && isset($_POST["fecha_subida_hasta"])   )
				
				{
					
					///creo el array con los valores seleccionados
		
					
					$arraySel = "";
				    $columnas = "documentos_legal.id_documentos_legal,  documentos_legal.fecha_documentos_legal, categorias.nombre_categorias, subcategorias.nombre_subcategorias, tipo_documentos.nombre_tipo_documentos, cliente_proveedor.nombre_cliente_proveedor, carton_documentos.numero_carton_documentos, documentos_legal.paginas_documentos_legal, documentos_legal.fecha_desde_documentos_legal, documentos_legal.fecha_hasta_documentos_legal, documentos_legal.ramo_documentos_legal, documentos_legal.numero_poliza_documentos_legal, documentos_legal.ciudad_emision_documentos_legal, soat.cierre_ventas_soat,   documentos_legal.creado , documentos_legal.monto_documentos_legal , documentos_legal.numero_credito_documentos_legal  "; 
					$tablas   = "public.documentos_legal, public.categorias, public.subcategorias, public.tipo_documentos, public.carton_documentos, public.cliente_proveedor, public.soat";
					$where    = "categorias.id_categorias = subcategorias.id_categorias AND subcategorias.id_subcategorias = documentos_legal.id_subcategorias AND tipo_documentos.id_tipo_documentos = documentos_legal.id_tipo_documentos AND carton_documentos.id_carton_documentos = documentos_legal.id_carton_documentos AND cliente_proveedor.id_cliente_proveedor = documentos_legal.id_cliente_proveedor   AND documentos_legal.id_soat = soat.id_soat ";
					$id       = "documentos_legal.fecha_documentos_legal, carton_documentos.numero_carton_documentos";
						
					
					$documentos = new DocumentosLegalModel();
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";
					$where_5 = "";
					$where_6 = "";
					$where_7 = "";
					$where_8 = "";
					$where_9 = "";
					$where_10 = "";
					$where_11 = "";
					$where_12 = "";
					$where_13 = "";
						
					
					
					$_id_categorias = $_POST["categorias"];
					$_id_subcategorias = $_POST["subcategorias"];
					$_id_cliente_proveedor = $_POST["ruc_cliente_proveedor"];
					$_id_tipo_documentos = $_POST["tipo_documentos"];
					$_id_carton_documentos = $_POST["carton_documentos"];
					$_numero_poliza  = $_POST["numero_poliza"];
					$_id_soat  = $_POST["cierre_ventas_soat"];
					$_year     = 	$_POST["year"];
					
					$_fecha_documento_desde = $_POST["fecha_documento_desde"];
					$_fecha_documento_hasta = $_POST["fecha_documento_hasta"];
					$_fecha_subida_desde = $_POST["fecha_subida_desde"];
					$_fecha_subida_hasta = $_POST["fecha_subida_hasta"];
					$_fecha_poliza_desde = $_POST["fecha_poliza_desde"];
					$_fecha_poliza_hasta = $_POST["fecha_poliza_hasta"];
						
		        	if ($_id_categorias > 0)
					{
		
						$where_1 =  " AND categorias.id_categorias = '$_id_categorias' ";
						
					}
					
					if ($_id_subcategorias > 0)
					{
					
						$where_2 = " AND subcategorias.id_subcategorias = '$_id_subcategorias' ";
					
					}
					if ($_id_cliente_proveedor > 0)
					{
						
						$where_4 = " AND cliente_proveedor.id_cliente_proveedor = '$_id_cliente_proveedor' ";
					}	
					if ($_id_tipo_documentos > 0)
					{
					
						$where_5 = " AND tipo_documentos.id_tipo_documentos = '$_id_tipo_documentos' ";
					}
					if ($_id_carton_documentos > 0)
					{
							
						$where_6 = " AND carton_documentos.id_carton_documentos = '$_id_carton_documentos' ";
					}
					
					if ($_numero_poliza > 0)
					{
						$where_7 = " AND documentos_legal.numero_poliza_documentos_legal = '$_numero_poliza' ";
					}
					
					if ($_fecha_documento_desde != "" && $_fecha_documento_hasta != "")
					{
						$where_8 = " AND documentos_legal.fecha_documentos_legal BETWEEN '$_fecha_documento_desde' AND '$_fecha_documento_hasta'  ";
					}
		
					if ($_fecha_subida_desde != "" && $_fecha_subida_hasta != "")
					{
						$where_9 = " AND documentos_legal.creado BETWEEN '$_fecha_subida_desde' AND '$_fecha_subida_hasta'  ";
					}
					
					if ($_fecha_poliza_desde != "" && $_fecha_poliza_hasta != "")
					{
						$where_10 = " AND documentos_legal.fecha_desde_documentos_legal > '$_fecha_poliza_desde' AND documentos_legal.fecha_desde_documentos_legal < '$_fecha_poliza_hasta'  ";
					}
					if ($_id_soat > 0)
					{
							
						$where_12 = "  AND soat.id_soat = '$_id_soat' ";
					}
					$resul = $_year;
					if ($_year > 0)
					{
						$fecha_desde = $_year ."-01-01";
						$fecha_hasta = $_year ."-12-31";
						$where_13 = "  AND documentos_legal.fecha_documentos_legal BETWEEN '$fecha_desde' AND  '$fecha_hasta'  "  ;
										
					}
						
		
					$where_to  = $where . $where_1 . $where_2 . $where_3 . $where_4 . $where_5 . $where_6 . $where_7 . $where_8 . $where_9 . $where_10. $where_11. $where_12. $where_13;
					
					//Conseguimos todos los usuarios
					
					//$resul = $where_to;
					$resultSet=$documentos->getCondiciones($columnas ,$tablas ,$where_to, $id);
					
					foreach($resultSet as $res) 
					{
						$hojasTotales =  $hojasTotales + $res->paginas_documentos_legal;
						$registrosTotales = $registrosTotales + 1 ;
					}
					
			}
			else 
			{
			//$arraySel = array();
				$registrosTotales = 0;
				$hojasTotales = 0;
					
			
			$arraySel = "";
			$resultSet = "";
			}
		
		
			///aqui va la paginacion  ///
			$articulosTotales = 0;
			$paginasTotales = 0;
			$paginaActual = 0;
			
			if(isset($_POST["pagina"])){
				
				// en caso que haya datos, los casteamos a int
				$paginaActual = (int)$_POST["pagina"];
			}
				
			
			if ($resultSet != "")
			{
					
					foreach($resultSet as $res)
					{
						$articulosTotales = $articulosTotales + 1;
					}
						
						
					$articulosPorPagina = 50;
						
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
						
					//agregamos el limit
					$limit = " LIMIT   '$articulosPorPagina' OFFSET '$articuloInicial'";
						
					//volvemos a pedir el resultset con la pginacion
						
					$resultSet=$documentos->getCondicionesPag($columnas ,$tablas ,$where_to,  $id, $limit );
						
					
			
			}
			
			if (isset ($_POST["btnGuardar"])  && isset ($_POST["id_documentos_legal"]) )
			{
			
				$nombre_controladores = "Documentos";
				$id_rol= $_SESSION['id_rol'];
				$resultPer = $documentos_legal->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
					
				if (!empty($resultPer))
				{
						
				
						$resul = "";
						
						
						$columnas = "documentos_legal.id_documentos_legal, documentos_legal.fecha_documentos_legal, categorias.nombre_categorias, subcategorias.nombre_subcategorias, tipo_documentos.nombre_tipo_documentos, cliente_proveedor.nombre_cliente_proveedor, carton_documentos.numero_carton_documentos, documentos_legal.paginas_documentos_legal, documentos_legal.fecha_desde_documentos_legal, documentos_legal.fecha_hasta_documentos_legal, documentos_legal.ramo_documentos_legal, documentos_legal.numero_poliza_documentos_legal, documentos_legal.ciudad_emision_documentos_legal, documentos_legal.creado  ";
						$tablas   = "public.documentos_legal, public.categorias, public.subcategorias, public.tipo_documentos, public.carton_documentos, public.cliente_proveedor";
						$where    = "categorias.id_categorias = subcategorias.id_categorias AND subcategorias.id_subcategorias = documentos_legal.id_subcategorias AND tipo_documentos.id_tipo_documentos = documentos_legal.id_tipo_documentos AND carton_documentos.id_carton_documentos = documentos_legal.id_carton_documentos AND cliente_proveedor.id_cliente_proveedor = documentos_legal.id_cliente_proveedor ";
						$id       = "categorias.nombre_categorias, subcategorias.nombre_subcategorias, tipo_documentos.nombre_tipo_documentos";
						
			
						$_id_categorias = $_POST["categorias"];
						$_id_subcategorias = $_POST["subcategorias"];
						$_id_cliente_proveedor = $_POST["ruc_cliente_proveedor"];
						$_id_tipo_documentos = $_POST["tipo_documentos"];
						$_id_carton_documentos = $_POST["carton_documentos"];
						$_numero_poliza  = $_POST["numero_poliza"];
						$_id_soat  = $_POST["cierre_ventas_soat"];
						$_fecha_documento_desde = $_POST["fecha_documento_desde"];
						$_fecha_documento_hasta = $_POST["fecha_documento_hasta"];
						$_fecha_subida_desde = $_POST["fecha_subida_desde"];
						$_fecha_subida_hasta = $_POST["fecha_subida_hasta"];
						$_fecha_poliza_desde = $_POST["fecha_poliza_desde"];
						$_fecha_poliza_hasta = $_POST["fecha_poliza_hasta"];
							
						if ($_numero_poliza == 0)
						{
							$_numero_poliza = null;
							
						}
						
					
						$_id_documentos_legal = $_POST["id_documentos_legal"];
					
					
						
							
						////guardamos en caso de que esten todos seleccionados
						if ( $_id_categorias > 0 &&	$_id_subcategorias > 0 && $_id_cliente_proveedor  > 0 && $_id_tipo_documentos > 0 && $_id_carton_documentos > 0)
						{
					
								
							$colval = "id_subcategorias = '$_id_subcategorias', id_cliente_proveedor = '$_id_cliente_proveedor' , id_tipo_documentos = '$_id_tipo_documentos' , id_carton_documentos = '$_id_carton_documentos', numero_poliza_documentos_legal = '$_numero_poliza' , fecha_documentos_legal = '$_fecha_documento_desde' , fecha_desde_documentos_legal = '$_fecha_poliza_desde', fecha_hasta_documentos_legal = '$_fecha_poliza_hasta' , id_soat =  '$_id_soat'  ";
							$tabla = "documentos_legal";
							$where_update = "id_documentos_legal = '$_id_documentos_legal' ";
								
							$documentos_legal=new DocumentosLegalModel();
								
							$documentos_legal->UpdateBy($colval, $tabla, $where_update);
					
							
						}
					
				
				}
				else
				{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar a Documentos"
					
						));
						exit();
				
				}
					
				
				
			}
			
				$this->view("Documentos",array(
						"resultCat"=>$resultCat, "resultSub"=>$resultSub, "resultCli"=>$resultCli, "resultTip"=>$resultTip, "resultCar"=>$resultCar, "resultSet"=>$resultSet, "resultPol"=>$resultPol, "arraySel"=>$arraySel, "resultEdit"=>$resultEdit, "resul"=>$resul  , "paginasTotales"=>$paginasTotales, "registrosTotales"=> $registrosTotales,"hojasTotales"=>$hojasTotales,"resultSoa"=>$resultSoa , "pagina_actual"=>$paginaActual
					 
							));
			

		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Acceso a Busqueda de Documentos 1 "
				));
				exit();
		}
				
				
				
				
		}
		else 
		{
	
				$this->view("ErrorSesion",array(
					"resultSet"=>""
						));
				
		}
	
	}
	
	public function Visualizar()
	{

		$documentos_legal = new DocumentosLegalModel();
		
		session_start();
		
		$nombre_controladores = "Documentos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $documentos_legal->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if (isset ($_GETT["id_documentos_legal"]) )
			{
			
				$_id_documentos = $_GETT["id_documentos_legal"];
			$this->afuera("Default.aspx?id=".$_id_documentos  ,array(
					"resultado"=>""
			
			));
			}	
		}
		
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Visualizar Documentos"
		
			));
			exit();
		
		}
		
	}
	
		
	
	public function  Buscador ()
	{
		
		
	$documentos_legal = new DocumentosLegalModel();
		
		$criterio = "";
		$contenido = "";
		
 		session_start();
		
		$nombre_controladores = "Documentos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $documentos_legal->getPermisosVer("  controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			
			$cantidadResult=0;
			$filaspaginacion='';
			$resultSet=array();
			$contenido = '';
			$criterio = 0;
		
				if (isset ($_POST["criterio_busqueda"])  && isset ($_POST["contenido_busqueda"])  )
				{
					
		
					$paginasTotales = 0;
					$registrosTotales = 0;
					$hojasTotales  = 0;
					

					$documentos = new DocumentosLegalModel();
					
				    $columnas = "documentos_legal.id_documentos_legal,  documentos_legal.fecha_documentos_legal, categorias.nombre_categorias, subcategorias.nombre_subcategorias, tipo_documentos.nombre_tipo_documentos, cliente_proveedor.nombre_cliente_proveedor, carton_documentos.numero_carton_documentos, documentos_legal.paginas_documentos_legal, documentos_legal.fecha_desde_documentos_legal, documentos_legal.fecha_hasta_documentos_legal, documentos_legal.ramo_documentos_legal, documentos_legal.numero_poliza_documentos_legal, documentos_legal.ciudad_emision_documentos_legal, soat.cierre_ventas_soat,   documentos_legal.creado, documentos_legal.numero_credito_documentos_legal  "; 
					$tablas   = "public.documentos_legal, public.categorias, public.subcategorias, public.tipo_documentos, public.carton_documentos, public.cliente_proveedor, public.soat";
					$where    = "categorias.id_categorias = subcategorias.id_categorias AND subcategorias.id_subcategorias = documentos_legal.id_subcategorias AND tipo_documentos.id_tipo_documentos = documentos_legal.id_tipo_documentos AND carton_documentos.id_carton_documentos = documentos_legal.id_carton_documentos AND cliente_proveedor.id_cliente_proveedor = documentos_legal.id_cliente_proveedor   AND documentos_legal.id_soat = soat.id_soat ";
					$id       = "documentos_legal.fecha_documentos_legal, carton_documentos.numero_carton_documentos";
									
						
					$criterio = $_POST["criterio_busqueda"];
					$contenido = $_POST["contenido_busqueda"];
					
					if ($contenido !="")
					{
					
						$where_0 = "";
						$where_1 = "";
						$where_2 = "";
						$where_3 = "";
						$where_4 = "";
						$where_5 = "";
						$where_6 = "";
						$where_7 = "";
							
						
						switch ($criterio) {
							case 0:
								//$where_0 = "OR cliente_proveedor.ruc_cliente_proveedor LIKE '$contenido'   OR cliente_proveedor.nombre_cliente_proveedor LIKE '$contenido'   OR carton_documentos.numero_carton_documentos LIKE '$contenido'  OR documentos_legal.numero_poliza_documentos_legal LIKE '$contenido'  OR documentos_legal.ramo_documentos_legal LIKE '$contenido'  OR documentos_legal.ciudad_emision_documentos_legal LIKE '$contenido'     ";
								break;
							case 1:
								//Ruc Cliente/Proveedor
								$where_1 = " AND cliente_proveedor.ruc_cliente_proveedor LIKE '$contenido'  ";
								break;
							case 2:
								//Nombre Cliente/Proveedor
								$where_2 = " AND cliente_proveedor.nombre_cliente_proveedor LIKE '$contenido'  ";
								break;
							case 3:
								//Número Carton
								$where_3 = " AND carton_documentos.numero_carton_documentos LIKE '$contenido' ";
								break;
							case 4:
								//Número Credito
								$where_4 = " AND documentos_legal.numero_credito_documentos_legal LIKE '$contenido' ";
								break;
							case 5:
								//Ramo Póliza
								$where_5 = " AND documentos_legal.ramo_documentos_legal LIKE '$contenido' ";
								break;
							case 6:
								//Ciudad Emisión		
								$where_6 = " AND documentos_legal.ciudad_emision_documentos_legal LIKE '$contenido' ";
								break;
							case 7:
								//Tipo Documento
								$where_7 = " AND tipo_documentos.nombre_tipo_documentos LIKE '$contenido' ";
								break;
						}
						
						
						
						$where_to  = $where .  $where_0 . $where_1 . $where_2 . $where_3 . $where_4 . $where_5 . $where_6. $where_7 ;
							
						$resultSet=$documentos->getCantidad("*", $tablas, $where_to);
						
						$html="";
						
						$cantidadResult=(int)$resultSet[0]->total;
						
						$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
						
						if($action == 'ajax')
						{
						
							$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
						
							$per_page = 50; //la cantidad de registros que desea mostrar
							$adjacents  = 9; //brecha entre páginas después de varios adyacentes
							$offset = ($page - 1) * $per_page;
						
							$limit = " LIMIT   '$per_page' OFFSET '$offset'";
						
						
							$resultSet=$documentos->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
						
							$count_query   = $cantidadResult;
						
							$total_pages = ceil($cantidadResult/$per_page);
						
							if ($cantidadResult>0)
							{
						
								//<th style="color:#456789;font-size:80%;"></th>
						
						
								$html.='<div class="pull-left">';
								$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
								$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
								$html.='</div><br>';
								$html.='<section style="height:425px; overflow-y:scroll;">';
								$html.='<table class="table table-hover">';
								$html.='<thead>';
								$html.='<tr class="info">';
								$html.='<th><b>Id</b></th>';
								$html.='<th>Fecha del Documento</th>';
								$html.='<th>Categoria</th>';
								$html.='<th>Subcategoria</th>';
								$html.='<th>Tipo Documentos</th>';
								$html.='<th>Cliente/Proveedor</th>';
								$html.='<th>Carton Documentos</th>';
								$html.='<th>Numero Credito</th>';
								$html.='<th>Fecha de Subida</th>';
								$html.='<th></th>';
								$html.='<th></th>';
								$html.='</tr>';
								$html.='</thead>';
								$html.='<tbody>';
						
								foreach ($resultSet as $res)
								{
									//<td style="color:#000000;font-size:80%;"> <?php echo ;</td>
										
						
									$html.='<tr>';
									$html.='<td style="color:#000000;font-size:80%;">'.$res->id_documentos_legal.'</td>';
									$html.='<td style="color:#000000;font-size:80%;">'.$res->fecha_documentos_legal.'</td>';
									$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_categorias.'</td>';
									$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_subcategorias.'</td>';
									$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_tipo_documentos.'</td>';
									$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_cliente_proveedor.'</td>';
									$html.='<td style="color:#000000;font-size:80%;">'.$res->numero_carton_documentos.'</td>';
									$html.='<td style="color:#000000;font-size:80%;">'.$res->numero_credito_documentos_legal.'</td>';
									$html.='<td style="color:#000000;font-size:80%;">'.$res->creado.'</td>';
									$html.='<td><div class="right">';
						
									if ($_SESSION["tipo_usuario"]=="usuario_local") {
										$html.=' <a href="'.IP_EXT . $res->id_documentos_legal.'" class="btn btn-warning" target="blank">Ver</a>';
									} else {
										$html.=' <a href="'.IP_EXT . $res->id_documentos_legal.'" class="btn btn-warning" target="blank">Ver</a>';
									}
									$html.='</div></td>';
									$html.='<td><div class="right">';
						
									$html.='</div></td>';
						
								}
						
								$html.='</tbody>';
								$html.='</table>';
								$html.='</section>';
								$html.='<div class="table-pagination pull-right">';
								$html.=''. $this->paginate("index.php", $page, $total_pages, $adjacents).'';
								$html.='</div>';
								$html.='</section>';
						
						
							}else{
						
								$html.='<div class="alert alert-warning alert-dismissable">';
								$html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
								$html.='<h4>Aviso!!!</h4> No hay datos para mostrar';
								$html.='</div>';
						
							}
						
							echo $html;
							die();
								
						
						}else 
						{
							//en caso de q la carga de datos venga por controlador
							
							$page = 1;
							
							$per_page = 50; //la cantidad de registros que desea mostrar
							$adjacents  = 9; //brecha entre páginas después de varios adyacentes
							$offset = ($page - 1) * $per_page;
							
							$limit = " LIMIT   '$per_page' OFFSET '$offset'";
							
							
							$resultSet=$documentos->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
							
							$total_pages = ceil($cantidadResult/$per_page);
							
							$filaspaginacion=$this->paginate("index.php", $page, $total_pages, $adjacents);
							
						}
						
					}
					
				}else if(isset($_POST['action'])) {
					
					die('error en el envio de Datos');
				}
					
				
		$this->view("Buscador",array(
			"resultSet"=>$resultSet,  "cantidadResult"=>$cantidadResult, "filaspaginacion"=> $filaspaginacion,
			"contenido"=>$contenido,"criterio"=>$criterio 
			
		));
				
				
				
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Buscar Documentos"
		
			));
			exit();
		
		}
		
		
	}
		


	public function  BuscaxCarton ()
	{
		$documentos_legal = new DocumentosLegalModel();
	
		session_start();
	
		$nombre_controladores = "Documentos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $documentos_legal->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
	
	
	
			if (isset ($_POST["numero_carton_documentos"]) )
			{
	
					
				$documentos = new DocumentosLegalModel();
					
				$columnas = "documentos_legal.id_documentos_legal, documentos_legal.fecha_documentos_legal, categorias.nombre_categorias, subcategorias.nombre_subcategorias, tipo_documentos.nombre_tipo_documentos, cliente_proveedor.ruc_cliente_proveedor, cliente_proveedor.nombre_cliente_proveedor, carton_documentos.numero_carton_documentos, documentos_legal.paginas_documentos_legal, documentos_legal.fecha_desde_documentos_legal, documentos_legal.fecha_hasta_documentos_legal, documentos_legal.ramo_documentos_legal, documentos_legal.numero_poliza_documentos_legal, documentos_legal.ciudad_emision_documentos_legal, documentos_legal.creado  ";
				$tablas   = "public.documentos_legal, public.categorias, public.subcategorias, public.tipo_documentos, public.carton_documentos, public.cliente_proveedor";
				$where    = "categorias.id_categorias = subcategorias.id_categorias AND subcategorias.id_subcategorias = documentos_legal.id_subcategorias AND tipo_documentos.id_tipo_documentos = documentos_legal.id_tipo_documentos AND carton_documentos.id_carton_documentos = documentos_legal.id_carton_documentos AND cliente_proveedor.id_cliente_proveedor = documentos_legal.id_cliente_proveedor ";
				$id       = "documentos_legal.fecha_documentos_legal";
					
				
				$contenido = trim( $_POST["numero_carton_documentos"]);
					
				if ($contenido !="")
				{
						
					$where_0 = "";
					
						
	
							//Número Carton
					$where_0 = " AND carton_documentos.numero_carton_documentos LIKE '$contenido' ";
	
	
	
					$where_to  = $where .  $where_0 ;
						
					//Conseguimos todos los usuarios
						
					$resul = $where_to;
	
					$resultSet=$documentos->getCondiciones($columnas ,$tablas ,$where_to, $id);
	
					$this->view("BuscarCartonDocumentos",array(
							"resultSet"=>$resultSet
					));
	
				}
			}
			else
			{
				$this->view("BuscarCartonDocumentos",array(
						"resultSet"=>""
				));
				
					
			}
	
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Buscar Documentos"
	
			));
			exit();
	
		}
	
	
	}


	public function ReportexCarton(){
	
	
	
		$documentos_legal=new DocumentosLegalModel();
	
	
			$columnas = "documentos_legal.id_documentos_legal, documentos_legal.fecha_documentos_legal, categorias.nombre_categorias, subcategorias.nombre_subcategorias, tipo_documentos.nombre_tipo_documentos, cliente_proveedor.ruc_cliente_proveedor, cliente_proveedor.nombre_cliente_proveedor, carton_documentos.numero_carton_documentos, documentos_legal.paginas_documentos_legal, documentos_legal.fecha_desde_documentos_legal, documentos_legal.fecha_hasta_documentos_legal, documentos_legal.ramo_documentos_legal, documentos_legal.numero_poliza_documentos_legal, documentos_legal.ciudad_emision_documentos_legal, documentos_legal.creado  , documentos_legal.numero_credito_documentos_legal ";
			$tablas   = "public.documentos_legal, public.categorias, public.subcategorias, public.tipo_documentos, public.carton_documentos, public.cliente_proveedor";
			$where    = "categorias.id_categorias = subcategorias.id_categorias AND subcategorias.id_subcategorias = documentos_legal.id_subcategorias AND tipo_documentos.id_tipo_documentos = documentos_legal.id_tipo_documentos AND carton_documentos.id_carton_documentos = documentos_legal.id_carton_documentos AND cliente_proveedor.id_cliente_proveedor = documentos_legal.id_cliente_proveedor ";
			$id       = "documentos_legal.numero_credito_documentos_legal";
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario_usuario']) )
		{

			$contenido = trim( $_GET["numero_carton_documentos"]);
			$numero_carton_documentos = $contenido;
			
			if ($contenido !="")
			{
			
				$where_0 = "";
					
			
			
				//Número Carton
				$where_0 = " AND carton_documentos.numero_carton_documentos LIKE '$contenido' ";
			
			
			
				$where_to  = $where .  $where_0 ;
			
				//Conseguimos todos los usuarios
				
				$columnas2 = " 'TOTALES' AS totales,  SUM(documentos_legal.paginas_documentos_legal) AS total_paginas, COUNT(documentos_legal.id_documentos_legal) AS total_documentos";
				
				$resultRep = $documentos_legal->getCondicionesPDF($columnas, $tablas, $where_to, $id);
	
				$resultRep2 = $documentos_legal->getByPDF($columnas2,  $tablas, $where_to);
				 
				$this->report("DocumentosxCarton",array(	"resultRep"=>$resultRep, "resultRep2"=>$resultRep2 , "Carton"=>$numero_carton_documentos  ));
			}
		
		}
			
	
	
	}
	
	
	public function ActualizarDocumentos(){
	
		$documentos_legal=new DocumentosLegalModel();
		$cliente_proveedor = new ClienteProveedorModel();
		$carton_documentos = new CartonDocumentosModel();
		$lecturas = new LecturasModel();
	
		$archivos_pdf = new ArchivosPdfModel();
	
	
	
		$resultSet = "";
		$resultado = null;
		$_id_cliente_proveedor = 0;
		$_id_carton_documentos = 0;
		$_id_lecturas = 0;
	
		///primero comprobamos
		if (isset ($_POST["btnComprobar"]) && isset ($_POST["id_documentos_legal"])    )
		{
			$_id_documentos_legal = $_POST["id_documentos_legal"];
			$columnas = "documentos_legal.id_documentos_legal,
  							subcategorias.nombre_subcategorias,
  							cliente_proveedor.ruc_cliente_proveedor,
  							cliente_proveedor.nombre_cliente_proveedor,
  							tipo_documentos.nombre_tipo_documentos,
  							documentos_legal.fecha_documentos_legal";
			$tablas = " public.documentos_legal,
  							public.subcategorias,
  							public.cliente_proveedor,
  							public.tipo_documentos";
			$where_to = " subcategorias.id_subcategorias = documentos_legal.id_subcategorias AND
			cliente_proveedor.id_cliente_proveedor = documentos_legal.id_cliente_proveedor AND
			tipo_documentos.id_tipo_documentos = documentos_legal.id_tipo_documentos
			AND documentos_legal.id_documentos_legal = '$_id_documentos_legal' 	";
			$id = "documentos_legal.id_documentos_legal";
				
			$resultSet=$documentos_legal->getCondiciones($columnas ,$tablas ,$where_to, $id);
				
		}
	
	
		//_nombre_categorias character varying, _path_categorias character varying
		if (isset ($_POST["nombre_cliente_proveedor"]) && isset ($_POST["ruc_cliente_proveedor"]) && isset ($_POST["btnGuardar"])   )
		{
			$_nombre_cliente_proveedor     =  rtrim($_POST["nombre_cliente_proveedor"]);
			$_ruc_cliente_proveedor     = rtrim($_POST["ruc_cliente_proveedor"]);
			$_id_documentos_legal = rtrim($_POST["id_documentos_legal"]);
				
			if (strlen($_nombre_cliente_proveedor) > 0 && strlen($_ruc_cliente_proveedor) > 0  )
			{
	
				$funcion = "ins_cliente_proveedor";
				//ins_cliente_proveedor(_ruc_cliente_proveedor character varying, _nombre_cliente_proveedor character varying)
				$parametros = " '$_ruc_cliente_proveedor' ,'$_nombre_cliente_proveedor' ";
				$cliente_proveedor->setFuncion($funcion);
	
				$cliente_proveedor->setParametros($parametros);
	
	
				$resultado=$cliente_proveedor->Insert();
				$where = "nombre_cliente_proveedor = '$_nombre_cliente_proveedor'  ";
				$resultCli=$cliente_proveedor->getBy($where);
				if (!empty($resultCli)) {
					foreach($resultCli as $res) {
						$_id_cliente_proveedor = $res->id_cliente_proveedor;
					}
				}
				if ($_id_cliente_proveedor > 0)
				{
					$colval = "id_cliente_proveedor = '$_id_cliente_proveedor' ";
					$tabla  = "documentos_legal";
					$where  = "id_documentos_legal = '$_id_documentos_legal'  ";
						
					$resultado = $documentos_legal->UpdateBy($colval ,$tabla , $where);
				}
	
			}
		}
		//_nombre_categorias character varying, _path_categorias character varying
		if (isset ($_POST["numero_carton_documentos"]) && isset ($_POST["btnGuardar"])   )
		{
			$_numero_carton_documentos     =  rtrim($_POST["numero_carton_documentos"]);
			$_id_documentos_legal = rtrim($_POST["id_documentos_legal"]);
	
			if (strlen($_numero_carton_documentos) > 0)
			{
				$where = "numero_carton_documentos = '$_numero_carton_documentos'  ";
				$resultCar=$carton_documentos->getBy($where);
				if (!empty($resultCar)) {
					foreach($resultCar as $res) {
						$_id_carton_documentos = $res->id_carton_documentos;
					}
				}
				if ($_id_carton_documentos > 0)
				{
					$colval = "id_carton_documentos = '$_id_carton_documentos' ";
					$tabla  = "documentos_legal";
					$where  = "id_documentos_legal = '$_id_documentos_legal'  ";
						
					$resultado = $documentos_legal->UpdateBy($colval ,$tabla , $where);
				}
					
			}
		}
		if (isset ($_POST["estado_lecturas"]) && isset ($_POST["btnGuardar"])   )
		{
			$_estado_lecturas     =  rtrim($_POST["estado_lecturas"]);
			$_id_documentos_legal = rtrim($_POST["id_documentos_legal"]);
				
			if ( $_estado_lecturas == "FALSE" )
			{
	
				$where = "id_documentos_legal = '$_id_documentos_legal'  ";
				$resultDoc=$documentos_legal->getBy($where);
				if (!empty($resultDoc)) {
					foreach($resultDoc as $res) {
						$_id_lecturas = $res->id_lecturas;
					}
				}
				if ($_id_lecturas > 0)
				{
					$colval = "estado_lecturas = 'FALSE' ";
					$tabla  = "lecturas";
					$where  = "id_lecturas = '$_id_lecturas'  ";
						
					$resultado = $lecturas->UpdateBy($colval ,$tabla , $where);
				}
			}
	
		}
		
		if (isset ($_POST["numero_credito_documentos_legal"]) && isset ($_POST["btnGuardar"])   )
		{
			$_numero_credito_documentos_legal     =  rtrim($_POST["numero_credito_documentos_legal"]);
			$_id_documentos_legal = rtrim($_POST["id_documentos_legal"]);
		
			if (strlen($_numero_credito_documentos_legal) > 0)
			{
				
				
					$colval = "numero_credito_documentos_legal = '$_numero_credito_documentos_legal'  ";
					$tabla  = "documentos_legal";
					$where  = "id_documentos_legal = '$_id_documentos_legal'  ";
		
					$resultado = $documentos_legal->UpdateBy($colval ,$tabla , $where);
				
					
			}
		}
	
		if (isset ($_POST["id_documentos_legal"]) && isset ($_POST["btnBorrar"])   )
		{
			$_id_documentos_legal = rtrim($_POST["id_documentos_legal"]);
	
			$where = "id_documentos_legal = '$_id_documentos_legal'  ";
			//lo pongo en no leido
			$resultDoc=$documentos_legal->getBy($where);
			if (!empty($resultDoc)) {
				foreach($resultDoc as $res) {
					$_id_lecturas = $res->id_lecturas;
				}
			}
			if ($_id_lecturas > 0)
			{
				$colval = "estado_lecturas = 'FALSE' ";
				$tabla  = "lecturas";
				$where1  = "id_lecturas = '$_id_lecturas'  ";
	
				$resultado = $lecturas->UpdateBy($colval ,$tabla , $where1);
			}
			// lo elimino de los archivos
			$archivos_pdf->deleteById($where);
			$documentos_legal->deleteById($where);
	
	
	
		}
	
	
		$this->view("ActualizarDocumentos",array(
				"resultSet"=>$resultSet
		));
	
	
	
	}
	
	
	public function buscar()
	{
		require_once 'config/global.php';
	
		session_start();
	
		$documentos_legal = new DocumentosLegalModel();
	
		if (isset(  $_SESSION['usuario_usuario']) )
		{
			$nombre_controladores = "Documentos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $documentos_legal->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
				if (isset ($_POST["categorias"]) && isset ($_POST["subcategorias"]) && isset($_POST["ruc_cliente_proveedor"]) && isset($_POST["nombre_cliente_proveedor"]) && isset($_POST["tipo_documentos"]) && isset($_POST["carton_documentos"])   && isset($_POST["fecha_documento_desde"]) && isset($_POST["fecha_documento_hasta"])  && isset($_POST["fecha_subida_desde"])  && isset($_POST["fecha_subida_hasta"])   )
				
				{
					
					///creo el array con los valores seleccionados
		
					
					$arraySel = "";
				    $columnas = "documentos_legal.id_documentos_legal,  documentos_legal.fecha_documentos_legal, categorias.nombre_categorias, subcategorias.nombre_subcategorias, tipo_documentos.nombre_tipo_documentos, cliente_proveedor.nombre_cliente_proveedor, carton_documentos.numero_carton_documentos, documentos_legal.paginas_documentos_legal, documentos_legal.fecha_desde_documentos_legal, documentos_legal.fecha_hasta_documentos_legal, documentos_legal.ramo_documentos_legal, documentos_legal.numero_poliza_documentos_legal, documentos_legal.ciudad_emision_documentos_legal, soat.cierre_ventas_soat,   documentos_legal.creado , documentos_legal.monto_documentos_legal , documentos_legal.numero_credito_documentos_legal  "; 
					$tablas   = "public.documentos_legal, public.categorias, public.subcategorias, public.tipo_documentos, public.carton_documentos, public.cliente_proveedor, public.soat";
					$where    = "categorias.id_categorias = subcategorias.id_categorias AND subcategorias.id_subcategorias = documentos_legal.id_subcategorias AND tipo_documentos.id_tipo_documentos = documentos_legal.id_tipo_documentos AND carton_documentos.id_carton_documentos = documentos_legal.id_carton_documentos AND cliente_proveedor.id_cliente_proveedor = documentos_legal.id_cliente_proveedor   AND documentos_legal.id_soat = soat.id_soat ";
					$id       = "documentos_legal.fecha_documentos_legal, carton_documentos.numero_carton_documentos";
						
					
					$documentos = new DocumentosLegalModel();
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";
					$where_5 = "";
					$where_6 = "";
					$where_7 = "";
					$where_8 = "";
					$where_9 = "";
					$where_10 = "";
					$where_11 = "";
					$where_12 = "";
					$where_13 = "";
						
					
					
					$_id_categorias = $_POST["categorias"];
					$_id_subcategorias = $_POST["subcategorias"];
					$_id_cliente_proveedor = $_POST["ruc_cliente_proveedor"];
					$_id_tipo_documentos = $_POST["tipo_documentos"];
					$_id_carton_documentos = $_POST["carton_documentos"];
					$_numero_poliza  = $_POST["numero_poliza"];
					$_id_soat  = $_POST["cierre_ventas_soat"];
					$_year     = 	$_POST["year"];
					
					$_fecha_documento_desde = $_POST["fecha_documento_desde"];
					$_fecha_documento_hasta = $_POST["fecha_documento_hasta"];
					$_fecha_subida_desde = $_POST["fecha_subida_desde"];
					$_fecha_subida_hasta = $_POST["fecha_subida_hasta"];
					$_fecha_poliza_desde = $_POST["fecha_poliza_desde"];
					$_fecha_poliza_hasta = $_POST["fecha_poliza_hasta"];
						
		        	if ($_id_categorias > 0)
					{
		
						$where_1 =  " AND categorias.id_categorias = '$_id_categorias' ";
						
					}
					
					if ($_id_subcategorias > 0)
					{
					
						$where_2 = " AND subcategorias.id_subcategorias = '$_id_subcategorias' ";
					
					}
					if ($_id_cliente_proveedor > 0)
					{
						
						$where_4 = " AND cliente_proveedor.id_cliente_proveedor = '$_id_cliente_proveedor' ";
					}	
					if ($_id_tipo_documentos > 0)
					{
					
						$where_5 = " AND tipo_documentos.id_tipo_documentos = '$_id_tipo_documentos' ";
					}
					if ($_id_carton_documentos > 0)
					{
							
						$where_6 = " AND carton_documentos.id_carton_documentos = '$_id_carton_documentos' ";
					}
					
					if ($_numero_poliza > 0)
					{
						$where_7 = " AND documentos_legal.numero_poliza_documentos_legal = '$_numero_poliza' ";
					}
					
					if ($_fecha_documento_desde != "" && $_fecha_documento_hasta != "")
					{
						$where_8 = " AND documentos_legal.fecha_documentos_legal BETWEEN '$_fecha_documento_desde' AND '$_fecha_documento_hasta'  ";
					}
		
					if ($_fecha_subida_desde != "" && $_fecha_subida_hasta != "")
					{
						$where_9 = " AND documentos_legal.creado BETWEEN '$_fecha_subida_desde' AND '$_fecha_subida_hasta'  ";
					}
					
					if ($_fecha_poliza_desde != "" && $_fecha_poliza_hasta != "")
					{
						$where_10 = " AND documentos_legal.fecha_desde_documentos_legal > '$_fecha_poliza_desde' AND documentos_legal.fecha_desde_documentos_legal < '$_fecha_poliza_hasta'  ";
					}
					if ($_id_soat > 0)
					{
							
						$where_12 = "  AND soat.id_soat = '$_id_soat' ";
					}
					$resul = $_year;
					if ($_year > 0)
					{
						$fecha_desde = $_year ."-01-01";
						$fecha_hasta = $_year ."-12-31";
						$where_13 = "  AND documentos_legal.fecha_documentos_legal BETWEEN '$fecha_desde' AND  '$fecha_hasta'  "  ;
										
					}
						
		
					$where_to  = $where . $where_1 . $where_2 . $where_3 . $where_4 . $where_5 . $where_6 . $where_7 . $where_8 . $where_9 . $where_10. $where_11. $where_12. $where_13;
					
	
					//$resul = $where_to;
					//$resultSet=$documentos->getCondiciones($columnas ,$tablas ,$where_to, $id);
					$resultSet=$documentos->getCantidad("*", $tablas, $where_to);
	
					$html="";
					$cantidadResult=0;
	
					$cantidadResult=(int)$resultSet[0]->total;
	
					$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	
					if($action == 'ajax')
					{
	
						$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
	
						$per_page = 50; //la cantidad de registros que desea mostrar
						$adjacents  = 9; //brecha entre páginas después de varios adyacentes
						$offset = ($page - 1) * $per_page;
	
						$limit = " LIMIT   '$per_page' OFFSET '$offset'";
	
	
						$resultSet=$documentos->getCondicionesPag($columnas, $tablas, $where_to, $id, $limit);
	
						$count_query   = $cantidadResult;
	
						$total_pages = ceil($cantidadResult/$per_page);
	
						if ($cantidadResult>0)
						{
	
							//<th style="color:#456789;font-size:80%;"></th>
	
	
							$html.='<div class="pull-left">';
							$html.='<span class="form-control"><strong>Registros: </strong>'.$cantidadResult.'</span>';
							$html.='<input type="hidden" value="'.$cantidadResult.'" id="total_query" name="total_query"/>' ;
							$html.='</div><br>';
							$html.='<section style="height:425px; overflow-y:scroll;">';
							$html.='<table class="table table-hover">';
							$html.='<thead>';
							$html.='<tr class="info">';
							$html.='<th><b>Id</b></th>';
							$html.='<th>Fecha del Documento</th>';
							$html.='<th>Categoria</th>';
							$html.='<th>Subcategoria</th>';
							$html.='<th>Tipo Documentos</th>';
							$html.='<th>Cliente/Proveedor</th>';
							$html.='<th>Carton Documentos</th>';
							$html.='<th>Numero Credito</th>';
							$html.='<th>Fecha de Subida</th>';
							$html.='<th></th>';
							$html.='<th></th>';
							$html.='</tr>';
							$html.='</thead>';
							$html.='<tbody>';
	
							foreach ($resultSet as $res)
							{
								//<td style="color:#000000;font-size:80%;"> <?php echo ;</td>
									
	
								$html.='<tr>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->id_documentos_legal.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->fecha_documentos_legal.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_categorias.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_subcategorias.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_tipo_documentos.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->nombre_cliente_proveedor.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->numero_carton_documentos.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->numero_credito_documentos_legal.'</td>';
								$html.='<td style="color:#000000;font-size:80%;">'.$res->creado.'</td>';
								$html.='<td><div class="right">';
								
								if ($_SESSION["tipo_usuario"]=="usuario_local") {
							      	$html.=' <a href="'.IP_EXT . $res->id_documentos_legal.'" class="btn btn-warning" target="blank">Ver</a>';
								} else {
									$html.=' <a href="'.IP_EXT . $res->id_documentos_legal.'" class="btn btn-warning" target="blank">Ver</a>';
								}
								$html.='</div></td>';
								$html.='<td><div class="right">';
								
								$html.='</div></td>';
		
							}
	
							$html.='</tbody>';
							$html.='</table>';
							$html.='</section>';
							$html.='<div class="table-pagination pull-right">';
							$html.=''. $this->paginate("index.php", $page, $total_pages, $adjacents).'';
							$html.='</div>';
							$html.='</section>';
	
	
						}else{
	
							$html.='<div class="alert alert-warning alert-dismissable">';
							$html.='<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
							$html.='<h4>Aviso!!!</h4> No hay datos para mostrar';
							$html.='</div>';
	
						}
	
						echo $html;
							
	
					}
	
	
				}
	
			}
		}
	}
	
	
	public function paginate($reload, $page, $tpages, $adjacents) {
	
		$prevlabel = "&lsaquo; Prev";
		$nextlabel = "Next &rsaquo;";
		$out = '<ul class="pagination pagination-large">';
	
		// previous label
	
		if($page==1) {
			$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
		} else if($page==2) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_Documentos(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_Documentos(".($page-1).")'>$prevlabel</a></span></li>";
	
		}
	
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_Documentos(1)'>1</a></li>";
		}
		// interval
		if($page>($adjacents+2)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// pages
	
		$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
		$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
		for($i=$pmin; $i<=$pmax; $i++) {
			if($i==$page) {
				$out.= "<li class='active'><a>$i</a></li>";
			}else if($i==1) {
				$out.= "<li><a href='javascript:void(0);' onclick='load_Documentos(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_Documentos(".$i.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_Documentos($tpages)'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_Documentos(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
	
		$out.= "</ul>";
		return $out;
	}
	
	public function paginate_Buscador($reload, $page, $tpages, $adjacents) {
	
		$prevlabel = "&lsaquo; Prev";
		$nextlabel = "Next &rsaquo;";
		$out = '<ul class="pagination pagination-large">';
	
		// previous label
	
		if($page==1) {
			$out.= "<li class='disabled'><span><a>$prevlabel</a></span></li>";
		} else if($page==2) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_Documentos(1)'>$prevlabel</a></span></li>";
		}else {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_Documentos(".($page-1).")'>$prevlabel</a></span></li>";
	
		}
	
		// first label
		if($page>($adjacents+1)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_Documentos(1)'>1</a></li>";
		}
		// interval
		if($page>($adjacents+2)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// pages
	
		$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
		$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
		for($i=$pmin; $i<=$pmax; $i++) {
			if($i==$page) {
				$out.= "<li class='active'><a>$i</a></li>";
			}else if($i==1) {
				$out.= "<li><a href='javascript:void(0);' onclick='load_Documentos(1)'>$i</a></li>";
			}else {
				$out.= "<li><a href='javascript:void(0);' onclick='load_Documentos(".$i.")'>$i</a></li>";
			}
		}
	
		// interval
	
		if($page<($tpages-$adjacents-1)) {
			$out.= "<li><a>...</a></li>";
		}
	
		// last
	
		if($page<($tpages-$adjacents)) {
			$out.= "<li><a href='javascript:void(0);' onclick='load_Documentos($tpages)'>$tpages</a></li>";
		}
	
		// next
	
		if($page<$tpages) {
			$out.= "<li><span><a href='javascript:void(0);' onclick='load_Documentos(".($page+1).")'>$nextlabel</a></span></li>";
		}else {
			$out.= "<li class='disabled'><span><a>$nextlabel</a></span></li>";
		}
	
		$out.= "</ul>";
		return $out;
	}
	
	public function AutocompleteNombreCliente(){
	
		session_start();
		
		$nombre_cliente = strtoupper($_GET['term']);
		
		
		//cliente_proveedor
		$cliente_proveedor=new ClienteProveedorModel();
		$columnas_cp = " cliente_proveedor.id_cliente_proveedor,  cliente_proveedor.ruc_cliente_proveedor,  
		 cliente_proveedor.nombre_cliente_proveedor";
	    $tablas_cp   = "   public.cliente_proveedor, public.documentos_legal";
		$where_cp  = " cliente_proveedor.id_cliente_proveedor = documentos_legal.id_cliente_proveedor AND 
		cliente_proveedor.nombre_cliente_proveedor LIKE '$nombre_cliente%' 
		GROUP BY  cliente_proveedor.ruc_cliente_proveedor, cliente_proveedor.nombre_cliente_proveedor ,
		cliente_proveedor.id_cliente_proveedor";
		$id_cp = " cliente_proveedor.nombre_cliente_proveedor";
		
		$resultCli=$cliente_proveedor->getCondiciones($columnas_cp, $tablas_cp, $where_cp, $id_cp);
	
		
		if(!empty($resultCli)){
	
			foreach ($resultCli as $res){	
				$_nombre_cliente[] = array('id' => $res->id_cliente_proveedor.','.$res->ruc_cliente_proveedor, 'value' => $res->nombre_cliente_proveedor);
			}
			header('Content-type: application/json');
			echo json_encode($_nombre_cliente);
		}else 
		{
	    header('Content-type: application/json');
		echo json_encode(array("0"=>'No Data'));
		}
	}
	
	public function AutocompleteRucCliente(){
	
		session_start();
	
		$ruc_cliente = strtoupper($_GET['term']);
		$_ruc_cliente = array();
	
	
		//cliente_proveedor
		$cliente_proveedor=new ClienteProveedorModel();
		$columnas_cp = " cliente_proveedor.id_cliente_proveedor,  cliente_proveedor.ruc_cliente_proveedor,
		 cliente_proveedor.nombre_cliente_proveedor";
		$tablas_cp   = "   public.cliente_proveedor, public.documentos_legal";
		$where_cp  = " cliente_proveedor.id_cliente_proveedor = documentos_legal.id_cliente_proveedor AND
		cliente_proveedor.ruc_cliente_proveedor LIKE '$ruc_cliente%'
		GROUP BY  cliente_proveedor.ruc_cliente_proveedor, cliente_proveedor.nombre_cliente_proveedor ,
		cliente_proveedor.id_cliente_proveedor";
		$id_cp = " cliente_proveedor.nombre_cliente_proveedor";
	
		$resultCli=$cliente_proveedor->getCondiciones($columnas_cp, $tablas_cp, $where_cp, $id_cp);
	
	
		if(!empty($resultCli)){
	
			foreach ($resultCli as $res){
	
				$_ruc_cliente[] = array('id' => $res->id_cliente_proveedor.','.$res->nombre_cliente_proveedor, 'value' => $res->ruc_cliente_proveedor);
			}
			echo json_encode($_ruc_cliente);
		}else
		{
			echo json_encode(array(array('id' =>'0,NO DATA', 'value' =>'NO DATA')));
		}
	}
	
	
	public function AutocompleteTipoDoc(){
	
		session_start();
	
		$nombre_tipo_documento = strtoupper($_GET['term']);
		$_tipo_documento = array();
	
	
		//Tipo de Documento
		$tipo_documentos=new TipoDocumentosModel();
		$columnas_td = "  tipo_documentos.nombre_tipo_documentos, tipo_documentos.id_tipo_documentos";
		$tablas_td   = " public.documentos_legal, public.tipo_documentos";
		$where_td  = " documentos_legal.id_tipo_documentos = tipo_documentos.id_tipo_documentos AND tipo_documentos.nombre_tipo_documentos LIKE '$nombre_tipo_documento%'
				GROUP BY tipo_documentos.nombre_tipo_documentos, tipo_documentos.id_tipo_documentos ";
		$id_td = " tipo_documentos.nombre_tipo_documentos";
		
		
		$resultTip=$tipo_documentos->getCondiciones($columnas_td, $tablas_td, $where_td, $id_td);;
				
	
		
		if(!empty($resultTip)){
	
			foreach ($resultTip as $res){
	
				$_tipo_documento[] = array('id' => $res->id_tipo_documentos, 'value' => $res->nombre_tipo_documentos);
			}
			//echo json_encode($_ruc_cliente);
			
		}else
		{
			//echo json_encode(array(array('id' =>'0,NO DATA', 'value' =>'NO DATA')));
			$_tipo_documento = array(array('id' =>'0', 'value' =>'--TODOS--'));
		}
		
		echo  json_encode($_tipo_documento);
	}
	
}

?>