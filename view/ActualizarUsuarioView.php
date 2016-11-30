<!DOCTYPE HTML>
<html lang="es">
      <head>
        <meta charset="utf-8"/>
        <title>Usuarios - aDocument 2015</title>
   
   		  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		   
          <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		  <link rel="stylesheet" href="/resources/demos/style.css">
		
		<link rel="stylesheet" href="http://jqueryvalidation.org/files/demo/site-demos.css">
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
 
   
        <style>
            input{
                margin-top:5px;
                margin-bottom:5px;
            }
            .right{
                float:right;
            }
                
            
        </style>
        
        
       	<script>

		$(document).ready(function(){

		    $("#guardar").submit(function() {


		    	if (   $('#clave_usuario').val()) ==  $('#clave_usuario_r').val()) )
		    	{
					
	    	    }
				else
				{
					alert('Clave no coinciden');
					
				}


			  });

		}); 

	</script>
        
        
    </head>
    <body style="background-color: #F6FADE">
    
       <?php include("view/modulos/head.php"); ?>
       
       <?php include("view/modulos/menu.php"); ?>
  
    
      <div class="container">
      <div class="row" style="background-color: #FAFAFA;">
      <form action="<?php echo $helper->url("Usuarios","Actualiza"); ?>" method="post" class="col-lg-5">
            <h4>Actualizar Datos de Usuario</h4>
            <hr/>
            <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
            <table class="table">
            	<tr>
            		<th style="width: 50%">Nombres Usuario </th>
            		<th style="width: 50%">Usuario </th>
            		
            	</tr>
            	<tr>
				   <td>	<input type="text" name="nombre_usuario" value="<?php echo $resEdit->nombre_usuario; ?>" class="form-control"/> </td>
		           <td> <input type="text" name="usuario_usuario" value="<?php echo $resEdit->usuario_usuario; ?>" class="form-control"/> </td>
	            </tr>
	            <tr>
            		<th style="width: 50%">Clave Usuario </th>
            		<th style="width: 50%">Repita Clave Usuario </th>
            	</tr>
	            <tr>
		            <td> <input type="password" name="clave_usuario"  id="clave_usuario" value="" class="form-control"/></td>
		            <td> <input type="password" name="clave_usuario_r" id="clave_usuario_r" value="" class="form-control"/></td>
	            </tr>
	            <tr>
            		<th style="width: 50%">Teléfono Usuario </th>
            		<th style="width: 50%">Celular  Usuario </th>
            	</tr>
	            <tr>
	        		<td> <input type="text" name="telefono_usuario" value="<?php echo $resEdit->telefono_usuario; ?>" class="form-control"/> </td>
            		<td> <input type="text" name="celular_usuario" value="<?php echo $resEdit->celular_usuario; ?>" class="form-control"/> </td>    
	            </tr>
                <tr>
            		<th> Correo Usuario </th>
            		
            	</tr>
                <tr>
                	
                   <td> <input type="email" name="correo_usuario" value="<?php echo $resEdit->correo_usuario; ?>" class="form-control"/> </td>
                </tr>
           	
		    </table>        
            
		     <?php } } else {?>
		    
		    <table class="table">
            	<tr>
            		<th style="width: 50%">Nombres Usuario </th>
            		<th style="width: 50%">Usuario </th>
            		
            	</tr>
            	<tr>
				   <td>	<input type="text" name="nombre_usuario" value="" class="form-control"/> </td>
		           <td> <input type="text" name="usuario_usuario" value="" class="form-control"/> </td>
	            </tr>
	            <tr>
            		<th style="width: 50%">Clave Usuario </th>
            		<th style="width: 50%">Repita Clave Usuario </th>
            	</tr>
	            <tr>
		            <td> <input type="password" name="clave_usuario" id="clave_usuario" value="" class="form-control"/></td>
		            <td> <input type="password" name="clave_usuario_r" id="clave_usuario_r" value="" class="form-control"/></td>
	            </tr>
	            <tr>
            		<th style="width: 50%">Teléfono Usuario </th>
            		<th style="width: 50%">Celular  Usuario </th>
            	</tr>
	            <tr>
	        		<td> <input type="text" name="telefono_usuario" value="" class="form-control"/> </td>
            		<td> <input type="text" name="celular_usuario" value="" class="form-control"/> </td>    
	            </tr>
                <tr>
            		
            		<th>Correo Usuario </th>
            	</tr>
                <tr>
                	
                   <td> <input type="email" name="correo_usuario" value="" class="form-control"/> </td>
                </tr>
            
		    </table>        
               	
		     <?php } ?>
		        
           <input type="submit" value="Guardar" name="guardar" id="guardar"  class="btn btn-success"/>
          </form>
       
       
        <div class="col-lg-7">
        
        </div>
       </div>
       </div>
       
     </body>  
    </html>   