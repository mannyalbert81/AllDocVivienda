<!DOCTYPE HTML>
<html lang="es">
      <head>
        <meta charset="utf-8"/>
        <title>Permisos Rol - aDocument 2015</title>
   
  
		
      <script>
        
       $(document).ready(function(){

		    // cada vez que se cambia el valor del combo
		    $("#id_controladores").change(function() {

               // obtenemos el combo de subcategorias
                var $id_acciones = $("#id_acciones");
               // lo vaciamos
               
				///obtengo el id seleccionado
				

               var id_controladores = $(this).val();


               $id_acciones.empty();

               $id_acciones.append("<option value= " +"0" +" > --TODOS--</option>");
           
               if(id_controladores > 0)
               {
            	   var datos = {
            			   id_controladores : $(this).val()
                   };


            	   $.post("<?php echo $helper->url("PermisosRoles","devuelveAcciones"); ?>", datos, function(resultAcc) {

            		 		$.each(resultAcc, function(index, value) {
               		 	    $id_acciones.append("<option value= " +value.id_acciones +" >" + value.nombre_acciones  + "</option>");	
                       		 });

            		 		 	 		   
            		  }, 'json');


               }
               else
               {
            	   $.post("<?php echo $helper->url("PermisosRoles","devuelveAllAcciones"); ?>", datos, function(resultAcc) {

   		 		        $.each(resultAcc, function(index, value) {
          		 	    $id_acciones.append("<option value= " +value.id_acciones +" >" + value.nombre_acciones  + "</option>");	
                	  });
     		  		}, 'json');

               }
               
		    });
    
		}); 

	</script>
		
	<script>

		$(document).ready(function(){

			$("#id_acciones").change(function() {

	               // obtenemos el combo de categorias
	                var $id_controladores = $("#id_controladores");
	               
					///obtengo el id seleccionado
					var id_acciones = $(this).val();

	               if(id_acciones > 0)

	               {
	            	   var datos = {
	            			   id_acciones : $(this).val()
	                   };


	            	   //$categorias.append("<option value= " +"0" +" >"+ id_subcategorias  +"</option>");
	                   $.post("<?php echo $helper->url("PermisosRoles","devuelveSubByAcciones"); ?>", datos, function(resultAcc) {
	            		   
         		 		  $.each(resultAcc, function(index, value) {
         		 			$('#id_controladores').val( value.id_controladores );//To select Blue	 
 								
							 });

         		 		 	 		   
         		  		}, 'json');
	                   
	               }
	               else
	               {

	          		 $('#controladres').val( 0 );//To select Blue

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
      
      <form action="<?php echo $helper->url("PermisosRoles","InsertaPermisosRoles"); ?>" method="post" class="col-lg-5">
            <h4>Insertar Permisos Roles</h4>
            <hr/>
            	
		   		
            
             <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	            	
	            	Nombre Permisos Rol: <input type="text" id="nombre_permisos_rol" name="nombre_permisos_rol" value="<?php echo $resEdit->nombre_permisos_rol; ?>" class="form-control"/>
	            	
	            	Nombre Rol: <select name="id_rol" id="id_rol"  class="form-control">
									<?php foreach($resultRol as $resRol) {?>
				 						<option value="<?php echo $resRol->id_rol; ?>" <?php if ($resRol->id_rol == $resEdit->id_rol )  echo  ' selected="selected" '  ;  ?> ><?php echo $resRol->nombre_rol; ?> </option>
						            <?php } ?>
								    	
									</select>
		   		   
	            	 Nombre Controlador: <select name="id_controladores" id="id_controladores"  class="form-control">
									<?php foreach($resultCon as $resCon) {?>
				 						<option value="<?php echo $resCon->id_controladores; ?>" <?php if ($resCon->id_controladores == $resEdit->id_controladores )  echo  ' selected="selected" '  ;  ?> ><?php echo $resCon->nombre_controladores; ?> </option>
						            <?php } ?>
								    	
									</select>
		   		   
		   		   <table class="table">
		   		   	<tr>
		   		   		<th style="width: 33.3%" > Ver</th>
		   		   		<th style="width: 33.3%"> Editar</th>
		   		   		<th style="width: 33.3%"> Borrar</th>
		   		   	</tr>
		   		   	<tr>
					  <td> 
		   		   		<select name="ver_permisos_rol" id="ver_permisos_rol"  class="form-control">
										<option value="TRUE"  <?php  if ( $resEdit->ver_permisos_rol =='t')  echo ' selected="selected" ' ; ?> >Permitir </option>
						            	<option value="FALSE" <?php  if ( $resEdit->ver_permisos_rol =='f')  echo ' selected="selected" ' ; ?> >Denegar </option>
					    </select>
		   		   		</td>
		   		   		<td> 
		   		   		<select name="editar_permisos_rol" id="editat_permisos_rol"  class="form-control">
										<option value="TRUE"  <?php  if ( $resEdit->editar_permisos_rol =='t')  echo ' selected="selected" ' ; ?>>Permitir </option>
						            	<option value="FALSE" <?php  if ( $resEdit->editar_permisos_rol =='f')  echo ' selected="selected" ' ; ?>  >Denegar </option>
					    </select>
					    </td>
		   		   		<td>
		   		   		<select name="borrar_permisos_rol" id="borrar_permisos_rol"  class="form-control">
										<option value="TRUE"  <?php  if ( $resEdit->borrar_permisos_rol =='t')  echo ' selected="selected" ' ; ?> >Permitir </option>
						            	<option value="FALSE" <?php  if ( $resEdit->borrar_permisos_rol =='f')  echo ' selected="selected" ' ; ?>  >Denegar </option>
					    </select>
		   		   		</td>
		   		
		   		   	</tr>
		   		   </table>
		    
		     <?php } } else {?>
		    
		     		
		     		
		     		
		     		Nombre Permisos Rol: <input type="text" id="nombre_permisos_rol" name="nombre_permisos_rol" value="" class="form-control"/>
	            	
	            	Nombre Rol: <select name="id_rol" id="id_rol"  class="form-control">
									<?php foreach($resultRol as $resRol) {?>
				 						<option value="<?php echo $resRol->id_rol; ?>" ><?php echo $resRol->nombre_rol; ?> </option>
						            <?php } ?>
								    	
									</select>
		   		   
	            	 Nombre Controlador: <select name="id_controladores" id="id_controladores"  class="form-control">
									<?php foreach($resultCon as $resCon) {?>
				 						<option value="<?php echo $resCon->id_controladores; ?>"  ><?php echo $resCon->nombre_controladores; ?> </option>
						            <?php } ?>
								    	
									</select>
		   		   
		    	   <table class="table">
		   		   	<tr>
		   		   		<th style="width: 33.3%"> Ver</th>
		   		   		<th style="width: 33.3%"> Editar</th>
		   		   		<th style="width: 33.3%"> Borrar</th>
		   		   	</tr>
		   		   	<tr>
		   		   		<td> 
		   		   		<select name="ver_permisos_rol" id="ver_permisos_rol"  class="form-control">
										<option value="TRUE"  >Permitir </option>
						            	<option value="FALSE"  >Denegar </option>
					    </select>
		   		   		</td>
		   		   		<td> 
		   		   		<select name="editar_permisos_rol" id="editat_permisos_rol"  class="form-control">
										<option value="TRUE"  >Permitir </option>
						            	<option value="FALSE"  >Denegar </option>
					    </select>
					    </td>
		   		   		<td>
		   		   		<select name="borrar_permisos_rol" id="borrar_permisos_rol"  class="form-control">
										<option value="TRUE"  >Permitir </option>
						            	<option value="FALSE"  >Denegar </option>
					    </select>
		   		   		</td>
		   		   	</tr>
		   		   </table>
		        
		     <?php } ?>
		        
           <input type="submit" value="Guardar" class="btn btn-success"/>
          </form>
       
       
        <div class="col-lg-7">
            <h4>Permisos Rol</h4>
            <hr/>
        </div>
        <section class="col-lg-7 usuario" style="height:400px;overflow-y:scroll;">
        <table class="table table-hover">
	         <tr>
	    		<th>Id</th>
	    		<th>Nombre Permisos Rol</th>
	    		<th>Nombre Rol</th>
	    		<th>Nombre Controlador</th>
	    		<th>Ver</th>
	    		<th>Editar</th>
	    		<th>Borrar</th>
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	                   <td> <?php echo $res->id_permisos_rol; ?>  </td>
		               <td> <?php echo $res->nombre_permisos_rol; ?>     </td>
		               <td> <?php echo $res->nombre_rol; ?>     </td> 
		               <td> <?php echo $res->nombre_controladores; ?>  </td>
		               <td> <?php echo $res->ver_permisos_rol; ?>     </td>
		               <td> <?php echo $res->editar_permisos_rol; ?>     </td>
		               <td> <?php echo $res->borrar_permisos_rol; ?>     </td>
		           	   <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("PermisosRoles","index"); ?>&id_permisos_rol=<?php echo $res->id_permisos_rol; ?>" class="btn btn-warning">Editar</a>
			                </div>
			            
			             </td>
			             <td>   
			                	<div class="right">
			                    <a href="<?php echo $helper->url("PermisosRoles","borrarId"); ?>&id_permisos_rol=<?php echo $res->id_permisos_rol; ?>" class="btn btn-danger">Borrar</a>
			                </div>
			                <hr/>
		               </td>
		    		</tr>
		        <?php } } ?>
            
            <?php 
            
            //echo "<script type='text/javascript'> alert('Hola')  ;</script>";
            
            ?>
            
       	</table>     
      </section>
      </div>
       </div>
     </body>  
    </html>   