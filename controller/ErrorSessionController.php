<?php

class SubCategoriasController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
	
		
		$this->view("ErrorSesion",array(
				"resultSet"=>""
	
		));
	}
	
		
	
}
?>