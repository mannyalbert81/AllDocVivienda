<?php

class ErroresImportacionController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$errores_importacion = new ErroresImportacionModel();
					//Conseguimos todos los usuarios
		$resultSet=$errores_importacion->getAll("funcion_errores_importacion");
				
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuario']) )
		{
			
			///pido permiso
			$nombre_controladores = "ErroresImportacion";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $errores_importacion->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
						
				
				$this->view("ErroresImportacion",array(
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
		
}
?>