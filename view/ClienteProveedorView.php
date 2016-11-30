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
      <body style="background-color: #F6FADE">
    
       <?php include("view/modulos/head.php"); ?>
       
       <?php include("view/modulos/menu.php"); ?>
  
    <div class="container">
      <div class="row" style="background-color: #FAFAFA;">
      
      <form action="<?php echo $helper->url("ClienteProveedor","index"); ?>" method="post" class="col-lg-12">
     
     	
   
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
		        	<button type="submit" name="btn_index_ruc" id="btn_index_ruc" class="btn btn-default" aria-label="Left Align">
					  <span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span>
					</button>
		        	
		        </div>
			    <div class="col-xs-4 col-md-4">
		        	<button type="submit" name="btn_index_nombre" id="btn_index_nombre" class="btn btn-default" aria-label="Left Align">
					  <span class="glyphicon glyphicon-sort-by-alphabet" aria-hidden="true"></span>
					</button>
		        	
		        </div>
		         <div class="col-xs-1 col-md-1">
		        		<input type="submit" name="btn_guardar" id="btn_guardar" class="btn btn-success"   value="Guardar" />
		        </div>
		        <div class="col-xs-1 col-md-1">
		        		<h4>Registros: <?php echo $registrosTotales;?></h4>
		        </div>
			  </div>  
        
        </div>
  		 
        	
	
		<section class="col-lg-12 usuario" style="height:400px;overflow-y:scroll;">
				 <?php $registros = 0;?>
				  <?php foreach($resultCli as $res) {?>
					<div class="row" style="margin-top: 5px;">
						  	<div class="col-xs-1 col-md-1">
					        	 	<?php echo  $registros +1 ;?>  
					        </div>
						  	
						  	<div class="col-xs-1 col-md-1">
					        	 	<input type="text" name="destino_new_id[]" id="destino_new_id[]" class="form-control"   value="" />  
					        </div>
						    <div class="col-xs-1 col-md-1">
					        	<input type="text" name="destino_id[]" id="destino_id[]" class="form-control"   value="<?php echo $res->id_cliente_proveedor; ?>" readonly /> 
					        </div>
						    <div class="col-xs-3 col-md-3">
					        	<input type="text" name="destino_ruc[]" id="destino_ruc[]" class="form-control"   value="<?php echo $res->ruc_cliente_proveedor;?>" /> 
					        </div>
						    <div class="col-xs-6 col-md-6">
					        	<input type="text" name="destino_nombre[]" id="destino_nombre[]" class="form-control"   value="<?php if ($res->nombre_cliente_proveedor != "") { echo $res->nombre_cliente_proveedor;} else {echo "S/N";}  ?>" /> 
					        </div>
			        	    
					    </div>
					 <?php $registros ++?> 	
			        <?php } ?>
		            
		        
		  </section>
		 
	 <table class="table">
				<th class="text-center">
				    	<nav>
						  <ul id="pagina" name="pagina" class="pagination">
						    <?php if ($paginasTotales > 0) {?>
						    		<?php if ($ultima_pagina > 1 ) {?>
						    			<input type="submit" value="<?php echo "<<"; ?>" id="anterior_pagina"    name="anterior_pagina" class="btn btn-info"/>
						    		<?php }?>
						    <?php for ($i = $ultima_pagina; $i< $paginasTotales+1; $i++)  { ?>
						    		
						    		<?php if ($i  < $ultima_pagina + 10) {  ?>
						    			<input type="hidden" value="<?php echo $i+1; ?>" id="ultima_pagina"    name="ultima_pagina" class="btn btn-info"/>
						    			<input type="submit" value="<?php echo $i; ?>" id="pagina"  <?php if ($i == $pagina_actual ) { echo 'style="color: #1454a3 " '; }  ?>     name="pagina" class="btn btn-info"/>
						    			
						    		<?php } ?>
						    		<?php if ($paginasTotales  == $i) {  ?>
						    			<input type="submit" value="<?php echo ">>"; ?>" id="siguiente_pagina"    name="siguiente_pagina" class="btn btn-info"/>
						    				<hr>	
						    		<div class="row">
						    		  <div class="col-xs-12 col-md-12">
										<div class="col-xs-3 col-md-3">
										</div>
										<div class="col-xs-3 col-md-3">
								 			<input type="text" name="txt_navegar_pagina" id="txt_navegar_pagina"  style="width: 60px;" class="form-control"   value="" />	
					 	 					
					 	 				</div>
					 	 				<div class="col-xs-3 col-md-3">
					 	 		 			<input type="submit" value="<?php echo "Navegar"; ?>" id="btn_navegar_pagina"    name="btn_navegar_pagina" class="btn btn-info"/>
										</div>
										<div class="col-xs-3 col-md-3">
										</div>
									</div>
									</div>
						    		
						    		<?php } ?>
						    		
						    <?php    } }?>
						    
						  </ul>
						</nav>	   	   
			
				</th>
				<tr class="bg-primary">
						<p class="text-center"> <strong> Registros Cargados: <?php echo  $registros?>  Registros Totales: <?php echo  $registrosTotales?> </strong>  </p>
	     		  	
				</tr>			
		</table>
      	 	
              
  </form>
       
      </div>
      </div>
        
     </body>  
    </html>          