<!DOCTYPE HTML>
<html lang="es">
     <head>
        <meta charset="utf-8"/>
        <title>Soat - aDocument 2015</title>
   
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
      
      <form action="<?php echo $helper->url("Soat","Update"); ?>" method="post" class="col-lg-5">
            <h4>Modificar SOAT</h4>
            <hr/>
            	
		   				  	  
            
             <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	        
	            	<input  type="hidden" id="id_soat" name="id_soat" value= "<?php echo $resEdit->id_soat ?>" >
	            	Cierre Venta: <input type="text" name="cierre_ventas_soat" value="<?php echo $resEdit->cierre_ventas_soat; ?>" class="form-control"/>
		            
		            
            
		     <?php } } else {?>
		    
		            <input  type="hidden" id="id_soat" name="id_soat" value= "" >
		            Cierre Venta: <input type="text" name="cierre_ventas_soat" value="" class="form-control"/>
		            
		            
                
		     <?php } ?>
		        
		    
		        
           <input type="submit" value="Guardar" class="btn btn-success"/>
           
           
           <p   class="bg-warning" style="text-align: center;" ><strong>TENGA EN CUENTA:  </strong> Primero debe ver que este cierre de ventas no este creado. Si este existe debe ir a la opción Búsuqeda de documentos y desde ahi cambiar el cierre de ventas al que pertenece el archivo <strong>   Esta opción es solo para Tipos de Documentos que no estén creados en el sistema.  </strong> </p>
          </form>
       
       
        <div class="col-lg-7">
            <h4>Cierres de Ventas</h4>
            <hr/>
        </div>
        <section class="col-lg-7 usuario" style="height:400px;overflow-y:scroll;">
        <table class="table table-hover">
	         <tr>
	    		<th>Id</th>
	    		<th>Cierre de Venta</th>
	    		<th></th>
	    		
	  		</tr>
            
	            <?php foreach($resultSet as $res) {?>
	        		<tr>
	                   <td> <?php echo $res->id_soat; ?>  </td>
		               <td> <?php echo $res->cierre_ventas_soat; ?>     </td> 
		               
		               <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("Soat","index"); ?>&id_soat=<?php echo $res->id_soat; ?>" class="btn btn-warning">Editar</a>
			                </div>
			            
			             </td>
			             
		    		</tr>
		        <?php } ?>
            
            
       	</table>     
      </section>
       
  </div></div>
       
       <?php include("view/modulos/footer.php"); ?>
        
     </body>  
    </html>    