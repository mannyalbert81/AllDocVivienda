<!DOCTYPE html>
<html lang="en">
<head>

<?php require_once 'config/global.php';?> 

  <title>aDocument</title>
  <link rel="shortcut icon" href="view/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  

     
       <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
   		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>   
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<link rel="stylesheet" href="view/css/estilo.css">
		<link rel="stylesheet" href="view/css/bootstrap.css">
		<link rel="stylesheet" href="http://jqueryvalidation.org/files/demo/site-demos.css">
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
 
 
        <style>

.sub-menu {
    padding: 0;
    max-height: 200px; /* 1.5 x 3 */
    overflow-y: auto;
}
</style>
 
 
 <script>
$(document).ready(function(){
	$("46").click(function(){
		alert("hola");

		});
});

</script>
	
</head>
<body>

<div class="container"  style=" -webkit-box-shadow: 0px 2px 2px 2px rgba(0,0,0,0.49);-moz-box-shadow: 0px 2px 2px 4px rgba(0,0,0,0.49); box-shadow: 0px 2px 2px 4px rgba(0,0,0,0.49);">

  
  
  <div class="row head" >
  
  <div style=" margin-top: 20px; "   class="col-xs-6 col-md-8"  >
  <img src="view/images/logo_adocument.png" class="img-responsive" alt="Responsive image"  width="350" height="350">
  <br>
  </div>
  
  
  
  
  
  <div  style="margin-top: 20px;" class="col-xs-6 col-md-4">
 		<div class="margin-top: 20px;" class="col-xs-6 col-md-4">
 		<p> <strong> <?php echo CLIENTE?>  </strong>  </p>
 		</div>	
		<?php  
			 $status = session_status();
			 if  (isset( $_SESSION['nombre_usuario'] ))  {  
		?>
		
		 	 <div class="dropdown">
				  <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-user" ><?php echo " Bienvenid@  ".$_SESSION['nombre_usuario'];?></span>
				  <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu">
				    <li><a href="index.php?controller=Usuarios&action=cerrar_sesion">Cerrar Sesión</a></li>
				    <li><a href="index.php?controller=Usuarios&action=Actualiza">Actualizar Datos de Usuario</a></li>
				    <li><a href="#">Conectado desde: <?php echo $_SESSION['ip_usuario']?></a></li>
				  </ul>
				  
			</div>
		 	
		 	
		 	
		    
		    <?php  ?> 
		<?php 
			 }
			 else 
			 {     ?>
		
		
			<div class="dropdown">
					  <button class="btn btn-warning dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-lock" > Iniciar Sesión </span>
					  
					  </button>
					  
				</div>
		<?php }
				
		 ?>
			</div>  
  
  </div>
        
</div>

</body>
</html>


