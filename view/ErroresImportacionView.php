<!DOCTYPE HTML>
<html lang="es">
     <head>
        <meta charset="utf-8"/>
        	
   
   
  
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
      
      <form action="<?php echo $helper->url("ClienteProveedor","Update"); ?>" method="post" class="col-lg-12">
     
     	 <section class="col-sm-12" style="height:400px;overflow-y:scroll;">
    
    
	    
	    <table class="table">
	         <tr>
	    		<th>Id</th>
	    		<th>Funcion Error</th>
	    		<th>Detalle Error</th>
	    		<th>Creado</th>
	  		</tr>
         	
		    <?php  $registros = 0; ?>
	  		<?php if ($resultSet !="") { foreach($resultSet as $res) {?>
	        		<tr>
	                   <td> <?php echo $res->id_errores_importacion; ?>  </td>
	                   <td> <?php echo $res->funcion_errores_importacion; ?>  </td>
		               <td> <?php echo $res->error_errores_importacion; ?>     </td> 
		               <td> <?php echo $res->creado; ?>     </td>
		            	       <?php  $registros = $registros + 1 ; ?>
		            	       
		    
		        </tr>
		    <?php }}?>
		    
		        <tr class="bg-primary">
						<p class="text-center"> <strong> Registros Cargados: <?php echo  $registros?>  </strong>  </p>
	     		  	
				</tr>	        
							    
		</table>      		

 				
      </section>       
    
               
 	  </form>
       </div>
       </div>
      
        
     </body>  
    </html>          