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
				

				if ($(this).val().length == 9)
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
            <h4>Agregar Cartón de Documentos</h4>
            
		     <table class="table">			  	  
            
            <tr>
            	<th> Número: </th>
            	<th>Lista de Cartones Pendientes de Agregar:</th>
            	<th> Accion</th>
            </tr>
		    <tr>
		    	<td>
		    		<input  type="hidden" id="id_carton_documentos" name="id_carton_documentos" value= "" >
		    		<input type="text" name="numero_carton_documentos" id="numero_carton_documentos" value="" class="form-control"/>
		    	</td>
		    	<td>     
				   <select name="agregarcartones[]" id="agregarcartones" multiple class="form-control">
				  </select>
				</td>
				<td>
					   <input type="submit" value="Registrar" class="btn btn-success"/>
					
				</td>
		    </tr>	    
					             
			<tr>
				<td>
					
					<p name="barra_contador" id="barra_contador" class="bg-warning" style="text-align: center;" >  </p>
				</td>
				
			</tr>	       	 		    
				
		
           </table>
           
          </form>
          
       
        <div class="col-lg-5">
            <h4>Cartones de Documentos Registrados</h4>
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
  
       
       <?php include("view/modulos/footer.php"); ?>
        
     </body>  
    </html>                