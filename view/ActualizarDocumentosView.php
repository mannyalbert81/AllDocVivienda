<!DOCTYPE HTML>
<html lang="es">
      <head>
        <meta charset="utf-8"/>
        <title>Actualizar Documentos - aDocument 2015</title>
   
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
  
  
  		 <?php
   
		   $sel_id_documentos_legal = "";
		   
		   if($_SERVER['REQUEST_METHOD']=='POST' )
		   {
		      $sel_id_documentos_legal = $_POST['id_documentos_legal'];
		   
		   }
		   
		?>
    
       
        <div class="container">
  
  	  <div class="row" style="background-color: #FAFAFA;">
       
      <form action="<?php echo $helper->url("Documentos","ActualizarDocumentos"); ?>" method="post" class="col-lg-5">
            <h4>Actualizar Documentos</h4>
            <hr/>
            <table class="table">
    	    	<tr>
            		<th style="width: 50%">Id del Documento </th>
            		<th style="width: 50%"> </th>
            		
            	</tr>
        		<tr>
				
		           <td>	<input type="text" name="id_documentos_legal" value="<?php echo $sel_id_documentos_legal;?> " class="form-control"/> </td>
		           <?php if (!empty($resultSet))  { ?>
		           		<td> <input type="submit"name="btnBorrar" value="Borrar" class="btn btn-danger"/> </td>
		           <?php    } else {?>
		           		<td> <input type="submit"name="btnComprobar" value="Comprobar" class="btn btn-success"/> </td>
		           
		           <?php }?> 
		           	
		           
		           
	            </tr>
           	
		    </table>        
            <table class="table">
    	    	<tr>
            		<th style="width: 30%">Cliente/Proveedor  </th>
            		<th style="width: 70%">  </th>
            	</tr>
    	    	<tr>
            		<th style="width: 30%">RUC/CI  </th>
            		<th style="width: 70%">Nombres </th>
            		
            	</tr>
        		<tr>
				   <td>	<input type="text" name="ruc_cliente_proveedor" value="" class="form-control"/> </td>
		           <td>	<input type="text" name="nombre_cliente_proveedor" value="" class="form-control"/> </td>
	            </tr>
           	
		    </table>        
             <table class="table">
    	    	<tr>
            		<th style="width: 30%">Carton o Archivador  </th>
            		<th style="width: 70%">  </th>
            	</tr>
    	    	<tr>
            		<th style="width: 30%">Numero  </th>
            		<th style="width: 70%"> </th>
            		
            	</tr>
        		<tr>
				   <td>	<input type="text" name="numero_carton_documentos" value="" class="form-control"/> </td>
		           <td>	 </td>
	            </tr>
           	
		    </table>    
		    <table class="table">
    	    	<tr>
            		<th style="width: 30%">Credito  </th>
            		<th style="width: 70%">  </th>
            	</tr>
    	    	<tr>
            		<th style="width: 30%">Numero  </th>
            		<th style="width: 70%"> </th>
            		
            	</tr>
        		<tr>
				   <td>	<input type="text" name="numero_credito_documentos_legal" value="" class="form-control"/> </td>
		           <td>	 </td>
	            </tr>
           	
		    </table>  
			<table class="table">
    	    	<tr>
            		<th style="width: 30%">Cambiar Estado  </th>
            		<th style="width: 70%">  </th>
            	</tr>
    	    	<tr>
            		<th style="width: 30%">Estado  </th>
            		<th style="width: 70%"> </th>
            		
            	</tr>
        		<tr>
				   <td>	
				   <select name="estado_lecturas" id="estado_lecturas"  class="form-control" >
	                  <option value="TRUE"  > LEIDO</option>
	                  <option value="FALSE"  > NO LEIDO</option>
			   	    </select>
				   
                   </td>
		           <td>	 </td>
	            </tr>
           	
		    </table>     
		        
           <input type="submit"name="btnGuardar" value="Guardar" class="btn btn-success"/>
          </form>
       
        <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
        <div class="col-lg-7">
            <h4>Detalle del Documentos</h4>
            <hr/>
        </div>
        <section class="col-lg-7 usuario" style="height:600px;overflow-y:scroll;">
        <table class="table table-hover">
	         <tr>
	    		<th>Id</th>
	    		<th>Subcategroria</th>
	    		<th>Tipo de Documentos</th>
	    		<th>RUC/CI</th>
	    		<th>Nombre</th>
	    		<th>Fecha</th>
	    		
	  		  </tr>
            
	          <tr>
	              <td> <?php echo $res->id_documentos_legal; ?>  </td>
	              <td> <?php echo $res->nombre_subcategorias; ?>  </td>
		          <td> <?php echo $res->nombre_tipo_documentos; ?>     </td> 
		          <td> <?php echo $res->ruc_cliente_proveedor; ?>  </td>
		          <td> <?php echo $res->nombre_cliente_proveedor; ?>  </td>
		          
		          <td> <?php echo $res->fecha_documentos_legal; ?>  </td>
		          
		   		</tr>
	      
            
       	  </table>     
        </section>
	      
	      <?php } } ?>
            
            
      </div>
       </div>
       
     </body>  
    </html>   