<?php

class PermisosRolesController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario_usuario']) )
		{
	
			$permisos_rol = new PermisosRolesModel();
			
			$nombre_controladores = "PermisosRoles";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $permisos_rol->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
					
					//roles
					$rol = new RolesModel();
					$resultRol=$rol->getAll("nombre_rol");
					
					$controladores=new ControladoresModel();
					$resultCon=$controladores->getAll("nombre_controladores");
			
			
					$acciones=new AccionesModel();
					$resultAcc=$acciones->getAll("id_controladores");
		
			
		
					$resultEdit = "";
					$resul = "";
			
					if (isset ($_GET["id_permisos_rol"])   )
					{
						$nombre_controladores = "PermisosRoles";
						$id_rol= $_SESSION['id_rol'];
						$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
						if (!empty($resultPer))
						{
						
							$_id_permisos_rol = $_GET["id_permisos_rol"];
							$resultEdit = $permisos_rol->getBy("id_permisos_rol = '$_id_permisos_rol' ");
							
						}
						else
						{
							$this->view("Error",array(
									"resultado"=>"No tiene Permisos de Editar Permisos Roles"
						
									
							));
						
							exit();
						}
						
						
						
					}
			
					
					$columnas = "permisos_rol.id_permisos_rol, rol.nombre_rol, permisos_rol.nombre_permisos_rol, controladores.nombre_controladores, permisos_rol.ver_permisos_rol, permisos_rol.editar_permisos_rol, permisos_rol.borrar_permisos_rol  ";
					$tablas   = "public.controladores,  public.permisos_rol, public.rol";
					$where    = " controladores.id_controladores = permisos_rol.id_controladores AND permisos_rol.id_rol = rol.id_rol";
					$id       = " permisos_rol.nombre_permisos_rol, controladores.nombre_controladores";
						
					$permisos_rol = new PermisosRolesModel();
					$resultSet=$permisos_rol->getCondiciones($columnas ,$tablas ,$where, $id);
					
					
					$this->view("PermisosRoles",array(
							"resultCon"=>$resultCon, "resultAcc"=>$resultAcc, "resultSet"=>$resultSet,  "resultEdit"=>$resultEdit, "resultRol"=>$resultRol
					));
			
			
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Permisos Rol"
			
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
	
	
	public function InsertaPermisosRoles(){

		session_start();
		
		$resultado = null;
		$permisos_rol=new PermisosRolesModel();
	
		
		$nombre_controladores = "PermisosRoles";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
		
		
		//_nombre_categorias character varying, _path_categorias character varying
		if (isset ($_POST["nombre_permisos_rol"]) && isset ($_POST["id_controladores"]) && isset ($_POST["id_rol"])  )
			
		{
			$_nombre_permisos_rol = $_POST["nombre_permisos_rol"];
			$_id_controladores = $_POST["id_controladores"];
			$_ver_permisos_rol = $_POST["ver_permisos_rol"];
			$_editar_permisos_rol = $_POST["editar_permisos_rol"];
			$_borrar_permisos_rol = $_POST["borrar_permisos_rol"];
			$_id_rol = $_POST["id_rol"];
		
			 
			$funcion = "ins_permisos_rol";
			
			$parametros = " '$_nombre_permisos_rol' ,'$_id_controladores' , '$_ver_permisos_rol' , '$_editar_permisos_rol', '$_borrar_permisos_rol', '$_id_rol' ";

			try {
				
				$permisos_rol->setFuncion($funcion);
				$permisos_rol->setParametros($parametros);
				$resultado=$permisos_rol->Insert();
				

			$this->redirect("PermisosRoles", "index");
			
			}
			catch (Exeption $Ex)
			{
				$this->view("Error",array(
						"resultado"=>$Ex
				));
				
				
			}
			
	
		}
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos Para Crear Permisos Roles"
		
			));
		
		
		}
		
		
		
	}
	
	public function borrarId()
	{
		$permisos_rol = new PermisosRolesModel();

		session_start();
		
		$nombre_controladores = "PermisosRoles";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosBorrar("   nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
			if(isset($_GET["id_permisos_rol"]))
			{
				$id_permisos_rol=(int)$_GET["id_permisos_rol"];
		
				$permisos_rol=new PermisosRolesModel();
				
				$permisos_rol->deleteBy(" id_permisos_rol",$id_permisos_rol);
			}
			
			$this->redirect("PermisosRoles", "index");
			
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Borrar Permisos Roles"
		
			));
		
		
		}
		
	}
	
	public function devuelveAcciones()
	{
		$resultAcc = array();
	
		if(isset($_POST["id_controladores"]))
		{
	
			$id_controladores=(int)$_POST["id_controladores"];
	
			$acciones=new AccionesModel();
	
			$resultAcc = $acciones->getBy(" id_controladores = '$id_controladores'  ");
	
	
		}
	
		echo json_encode($resultAcc);
	
	}
	
	
	public function devuelveSubByAcciones()
	{
		$resultAcc = array();
	
		if(isset($_POST["id_acciones"]))
		{
	
			$id_acciones=(int)$_POST["id_acciones"];
	
			$acciones=new AccionesModel();
	
			$resultAcc = $acciones->getBy(" id_acciones = '$id_acciones'  ");
	
	
		}
	
		echo json_encode($resultAcc);
	
	}
	
	
	
	
	
	
	public function devuelveAllAcciones()
	{
		$resultAcc = array();
	
		$acciones=new AccionesModel();
	
		$resultAcc = $acciones->getAll(" id_controladores, nombre_acciones");
	
		echo json_encode($resultAcc);
	
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
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $subcategorias->getCondicionesPDF($columnas, $tablas, $where, $id);
			
			$this->report("SubCategorias",array(	"resultRep"=>$resultRep));
	
		}
			
	
	}
	

	
}
?>