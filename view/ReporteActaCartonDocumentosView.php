<!DOCTYPE HTML>
<html lang="es">
     <head>
        <meta charset="utf-8"/>
        <title>Registro de Cartones de Documentos - aDocument 2015</title>
   
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

			
			
			$("#numero_carton_documentos").keyup(function() { 

				var $agregarcartones = $("#agregarcartones");
				

				if ($(this).val().length == 8)
				{
					
       		 	    	

       		 	    var valor_insertar = $(this).val();

       		 		var previousOption;
       		 	
       		 		$agregarcartones.append("<option value= " +valor_insertar +" >" + valor_insertar  + "</option>");
     		 	  
       		 	    if ($("#agregarcartones option").length > 0)
       		 	    { 

       		 		  	
       		     	$("#agregarcartones option").each(function(){
					
					
							if (this.text == previousOption) $(this).remove();
						    previousOption= this.text;

						    
         		    });

       		 	    }

				$("#agregarcartones option").each(function(){
					
				    $('#agregarcartones  option').prop('selected', true);
 		    	});    
       		     $(this).val("");
       		     $("#barra_contador").text("Cartones por Registrar: " + $("#agregarcartones option").length);
				}
				  
			}); 
		}); 

	</script>
       
        
    
       <script>

		$(document).ready(function(){

			
			
			$("#agregarcartones").click(function() {

			      // obtenemos el combo de categorias
                var $agregarcartones = $("#agregarcartones");
               
				///obtengo el id seleccionado
				var numero_cartones = $(this).val();

				
				if (numero_cartones != "")
				{
				    $(this).find("option[value=  '"+ $(this).val() +"' ]").remove();  

			    }               	               

				$("#agregarcartones option").each(function(){
					
				    $('#agregarcartones  option').prop('selected', true);
 		    	}); 

				$("#barra_contador").text("Cartones por Registrar: " + $("#agregarcartones option").length);
 		    });
		}); 

	</script>
       
        
    </head>
      <body style="background-color: #F6FADE">
    
       <?php include("view/modulos/head.php"); ?>
       
       <?php include("view/modulos/menu.php"); ?>
  
    <div class="container">
      <div class="row" style="background-color: #FAFAFA;">
      
      <form action="<?php echo $helper->url("RegistroCartonDocumentos","Insert"); ?>" method="post" class="col-lg-7">
            <h4 style="color:#ec971f;">Acta de Entrega de Cartones de Documentos</h4>
            
		    <table class="table">			  	  
            
           <tr>
            		<th>  Lugar de Entrega </th>
            		<th>  Empresa </th>
            		<th>  CI Persona Entrega </th>
            		
            	</tr>
	            <tr>
			    	<td>
			    		<input type="text" name="lugar_entrega_actas" id="lugar_entrega_actas" value="" class="form-control"/>
			    	</td>
			    	<td>
			    		<input type="text" name="empresa_entrega_actas" id="empresa_entrega_actas" value="" class="form-control"/>
			    	</td>
			    	<td>
			    		<input type="text" name="ci_entrega_actas" id="ci_entrega_actas" value="" class="form-control"/>
			    	</td>
			    </tr>	    
					
            	
            	<tr>
            		<th>  Nombres Persona Entrega </th>
            		<th>  Teléfono Persona Entrega  </th>
            		<th>  Celular Persona Entrega </th>
            		
            	</tr>
            	<tr>
			    	<td>
			    		<input type="text" name="nombres_entrega_actas" id="nombres_entrega_actas" value="" class="form-control"/>
			    	</td>
			    	<td>
			    		<input type="text" name="telefono_entrega_actas" id="telefono_entrega_actas" value="" class="form-control"/>
			    	</td>
			    	<td>
			    		<input type="text" name="celular_entrega_actas" id="celular_entrega_actas" value="" class="form-control"/>
			    	</td>
			    </tr>	    
					
            	
            	<tr>
            		<th>  Cargo Persona Entrega </th>
            		<th>  Correo Persona Entrega  </th>
            	</tr>
            	<tr>
			    	<td>
			    		<input type="text" name="cargo_entrega_actas" id="cargo_entrega_actas" value="" class="form-control"/>
			    	</td>
			    	<td>
			    		<input type="email" name="correo_entrega_actas" id="correo_entrega_actas" value="" class="form-control"/>
			    	</td>
			    	
			    </tr>	    
				 
            
            
            
            
            
            
            
            
            
            
            
            
            	
            <tr>
            	<th> Número: </th>
            </tr>
		    <tr>
		    	<td>
		    		<input  type="hidden" id="id_carton_documentos" name="id_carton_documentos" value= "" >
		    		<input type="text" name="numero_carton_documentos" id="numero_carton_documentos" value="" class="form-control"/>
		    	</td>
		    </tr>	    
			<tr>
				<th>Lista de Cartones Pendientes de Agregar:</th>
			</tr>	            
			<tr>
				<td>     
				   <select name="agregarcartones[]" id="agregarcartones" multiple class="form-control">
				  </select>
				</td>
			</tr>				            
			<tr>
				<td>
					<p name="barra_contador" id="barra_contador" class="bg-warning" style="text-align: center;" >  </p>
				</td>
			</tr>		             
			<tr>
				<td>
					   <input type="submit" value="Registrar" class="btn btn-success"/>
					   <input type="submit" value="Generar Acta" name="genera_acta" id="genera_acta" class="btn btn-success"/>
				</td>
			</tr>	       	 		    
				
		  <tr>
		  	<td>
		  		<p   class="bg-warning" style="text-align: center;" ><strong>TENGA EN CUENTA:  </strong> Solo podrán subir documentos al sistema una vez que el número de cartón esté dado de alta mediante este formulario. </p>
		  	</td>
		  </tr>         
           
           </table>
           
          </form>
          
       
        <div class="col-lg-5">
            <h4 style="color:#ec971f;">Cartones de Documentos Registrados</h4>
            <hr/>
        </div>
        <section class="col-lg-5 usuario" style="height:400px;overflow-y:scroll;">
        <table class="table table-hover">
	         <tr>
	    		<th>Id</th>
	    		<th>Número Cartón Documentos</th>
	    		<th>Estado</th>
	    		<th></th>
	    		
	  		</tr>
            
	            <?php foreach($resultSet as $res) {?>
	        		<tr>
	                   <td> <?php echo $res->id_carton_documentos; ?>  </td>
		               <td> <?php echo $res->numero_carton_documentos; ?>     </td>
		               <td> <?php echo $res->estado_carton_documentos; ?>     </td> 
		               
		               <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("CartonDocumentos","index"); ?>&id_carton_documentos=<?php echo $res->id_carton_documentos; ?>" class="btn btn-warning">Editar</a>
			                </div>
			            
			             </td>
			             
		    		</tr>
		        <?php } ?>
            
            
       	</table>     
      </section>
       </div></div>
  
       
        <footer class="col-lg-12">
           <?php include("view/modulos/footer.php"); ?>
        </footer>
        
     </body>  
    </html>                