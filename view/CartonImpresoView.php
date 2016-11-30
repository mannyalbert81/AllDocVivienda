<!DOCTYPE HTML>
<html lang="es">
     <head>
        <meta charset="utf-8"/>
        <title>Impresión de Etiquetas para Cartones - aDocument 2015</title>
   
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
        
      <form action="<?php echo $helper->url("CartonImpreso","Insert"); ?>" method="post" class="col-lg-5">
            <h4 style="color:#ec971f;">Modificar Cartón de Documentos</h4>
            <hr/>
            <table class="table">
            
            	<tr>
		            <th>
		        		Número de Cartón Inicial
		            </th>
		            <th>
		        		Cantidad de Cartones
		            </th>
		        </tr>
            
            
            
            	<tr>
		            <td>
		    
		    	   <?php if ($resultSet !="" ) { foreach($resultSet as $resSet) {?>
	        		
	        		<?php  $ultimo_numero_carton_impreso = $resSet->numero_carton_impreso; ?>  
	            	
            
		     		<?php } } ?>  
		    
		        		<input type="number" name="numero_carton_impreso" value="<?php echo $ultimo_numero_carton_impreso?>" class="form-control"  readonly  maxlength="8"/>
		            
		            </td>
		            <td>
		        		<input type="number" name="cantidad_carton_impreso" value="1" class="form-control"   maxlength="2"/>
		            </td>
		        </tr>
            
            
            </table>	
		   				  	  
            
		            <input  type="hidden" id="id_carton_impreso" name="id_carton_impreso" value= "" >
		            
		            
                
		        
		    
		        
           <input type="submit" value="Generar Etiquetas" class="btn btn-success"/>
           
           
           <p   class="bg-warning" style="text-align: center;" ><strong>TENGA EN CUENTA:  </strong> Este formulario ha sido diseñado para imprimir etiquetas para iddentificar cartones. Esto no significa que estos queden dados de alta en el sistema, para ello debe usar la opción de Registro de Cartones. </p>
          </form>
       
       
        <div class="col-lg-7">
            <h4 style="color:#ec971f;">Etiquetas Generadas</h4>
            <hr/>
        </div>
        <section class="col-lg-7 usuario" style="height:400px;overflow-y:scroll;">
        <table class="table table-hover">
	         <tr>
	    		<th>Id</th>
	    		<th>Número Cartón Impreso</th>
	    		<th></th>
	    		
	  		</tr>
            
	            <?php foreach($resultSet as $res) {?>
	        		<tr>
	                   <td> <?php echo $res->id_carton_impreso; ?>  </td>
		               <td> <?php echo $res->numero_carton_impreso; ?>     </td> 
		               
		               <td>
			           		<div class="right">
			                  
			                </div>
			            
			             </td>
			             
		    		</tr>
		        <?php } ?>
            
            
       	</table>     
      </section>
       </div>
       </div>
       
  
       
        <footer class="col-lg-12">
           <?php include("view/modulos/footer.php"); ?>
        </footer>
        
     </body>  
    </html>    