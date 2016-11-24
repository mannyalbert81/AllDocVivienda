<!DOCTYPE HTML>
<html lang="es">
     <head>
        <meta charset="utf-8"/>
        	
   
   
 
	 <script>
	
			$(document).ready(function(){
	
			    $("#ruc_cliente_proveedor").change(function() {
	
			    	///obtengo el id seleccionado
					var id_cliente_proveedor = $(this).val();
	
		               if(id_cliente_proveedor > 0)
		               {
	         		 		$('#nombre_cliente_proveedor').val( id_cliente_proveedor );//To select Blue	 
	         		   }
		               else
		               {
		            		$('#nombre_cliente_proveedor').val( 0 );//To select Blue
				       }
		               
				    });
	
			}); 
	
		</script>
			
			
	    <script>
	
			$(document).ready(function(){
	
			    $("#nombre_cliente_proveedor").change(function() {
	
		               
						///obtengo el id seleccionado
						var id_cliente_proveedor = $(this).val();
	
		               if(id_cliente_proveedor > 0)
	
		               {
	         		 		$('#ruc_cliente_proveedor').val( id_cliente_proveedor );//To select Blue	 
	         		   }
		               else
		               {
		            		$('#ruc_cliente_proveedor').val( 0 );//To select Blue
				       }
		               
				    });
	
			}); 
	
		</script>		
 
 
 
        <style>
            input{
                margin-top:5px;
                margin-bottom:5px;
            }
            .right{
                float:right;
            }
                
            
        </style>
    </head>
      <body>
    
       <?php include("view/modulos/head.php"); ?>
       
       <?php include("view/modulos/menu.php"); ?>
  
    
      <form action="<?php echo $helper->url("CartonDocumentos","Update"); ?>" method="post" class="col-lg-12">
     
     	
   
        <div class="col-lg-12 usuario">
        	<div class="row">
			  	<div class="col-xs-1 col-md-1">
		        	<h5>#</h5>
		        </div>
			  	<div class="col-xs-1 col-md-1">
		        	<h5>Nuevo Id</h5>
		        </div>
			    <div class="col-xs-1 col-md-1">
		        	<button type="submit" name="btn_index_id" id="btn_index_id" class="btn btn-default" aria-label="Left Align">
					  <span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span>
					</button>
		        	
		        </div>
			    <div class="col-xs-3 col-md-3">
		        	
		        </div>
			    <div class="col-xs-4 col-md-4">
		       	<button type="submit" name="btn_index_numero" id="btn_index_numero" class="btn btn-default" aria-label="Left Align">
					  <span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span>
					</button>
		        	
		        </div>
		         <div class="col-xs-1 col-md-1">
		        		<input type="submit" name="btn_guardar" id="btn_guardar" class="btn btn-success"   value="Guardar" />
		        </div>
		        <div class="col-xs-1 col-md-1">
		        		<h4>Registros: <?php echo count($resultCar);?></h4>
		        </div>
			  </div>  
        
        </div>
  		 
        	
	
		<section class="col-lg-12 usuario" style="height:400px;overflow-y:scroll;">
				 <?php $registro = 1;?>
				  <?php foreach($resultCar as $res) {?>
					<div class="row" style="margin-top: 5px;">
						  	<div class="col-xs-1 col-md-1">
					        	 	<?php echo  $registro ;?>  
					        </div>
						  	
						  	<div class="col-xs-1 col-md-1">
					        	 	<input type="text" name="destino_new_id[]" id="destino_new_id[]" class="form-control"   value="" />  
					        </div>
						    <div class="col-xs-3 col-md-3">
					        	<input type="text" name="destino_id[]" id="destino_id[]" class="form-control"   value="<?php echo $res->id_carton_documentos; ?>" readonly /> 
					        </div>
						    <div class="col-xs-7 col-md-7">
					        	<input type="text" name="destino_numero[]" id="destino_numero[]" class="form-control"   value="<?php echo $res->numero_carton_documentos;?>" /> 
					        </div>
						    
					    </div>
					 <?php $registro ++?> 	
			        <?php } ?>
		            
		        
		  </section>
		 
              
  </form>
       
      
        
     </body>  
    </html>     