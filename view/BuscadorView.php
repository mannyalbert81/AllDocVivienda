<!DOCTYPE HTML>
<html lang="es">
     <head>
    
    
<?php require_once 'config/global.php';?> 
    
        <meta charset="utf-8"/>
        <title>Busqueda - aDocument 2015</title>
   
       <style>
            input{
                margin-top:5px;
                margin-bottom:5px;
            }
            .right{
                float:right;
            }
                
            
        </style>
        
   <script type="text/javascript">
	$(document).ready(function(){

	});

	
	function load_Documentos(pagina){

		
		//iniciar variables
		 var doc_criterio=$("#criterio_busqueda_bus").val();
		 var doc_contenido=$("#contenido_busqueda_bus").val();
		 
		 var con_datos={
				  criterio_busqueda:doc_criterio,
				  contenido_busqueda:doc_contenido,
				  action:'ajax',
				  page:pagina
				  };

		
		$("#Documentos").fadeIn('slow');
		$.ajax({
			url:"<?php echo $helper->url("Documentos","Buscador");?>",
            type : "POST",
            async: true,			
			data: con_datos,
			 beforeSend: function(objeto){
			$("#Documentos").html('<img src="view/images/ajax-loader.gif"> Cargando...');
			},
			success:function(data){
				$("#controlador").html("");
				$(".Documentos").html(data).fadeIn('slow');
				$("#Documentos").html("");
			}
		})
	}

	

	</script>
               
    </head>
    <body style="background-color: #F6FADE">
 
 
       <?php include("view/modulos/head.php"); ?>
     
       
       <?php include("view/modulos/menu.php"); ?>
     
      
	
     <div class="container">
      <div class="row" style="background-color: #FAFAFA;">
      
     <div class="table-responsive">
     
    
     <hr/>  	
	  <form id="formularioPrincipal" action="<?php echo $helper->url("Documentos","Buscador"); ?>" method="post" class="form-horizontal">
    
    
	    <table>
		    <tr> 
		    	<td>
		    		<input type="hidden" name="contenido_busqueda" id="contenido_busqueda_bus" class="form-control"   value="<?php echo $contenido; ?>" />  
		    		<input type="hidden" name="criterio_busqueda" id="criterio_busqueda_bus" class="form-control"   value="<?php echo $criterio; ?>" />
		    	</td>
		    </tr>
	    </table>
	   <div id="controlador">
		   	<div class="pull-left">
		  		<span class="form-control"><strong>Registros: </strong><?php echo $cantidadResult; ?></span>
				<input type="hidden" value="<?php echo $cantidadResult; ?>" id="total_query" name="total_query"/>
			</div><br>
			<section style="height:425px; overflow-y:scroll;">
				<table class="table table-hover">
					<thead>
						<tr class="info">
							<th>Id</th>
							<th>Fecha del Documento</th>
							<th>Categoria</th>
							<th>Subcategoria</th>
							<th>Tipo Documentos</th>
							<th>Cliente/Proveedor</th>
							<th>Carton Documentos</th>
							<th>Numero Credito</th>
							<th>Fecha de Subida</th>
							<th></th>
							<th></th>
						</tr>
					</thead>
					<tbody>
		<?php foreach ($resultSet as $res){?>
									
						<tr>
							<td style="color:#000000;font-size:80%;"><?php echo $res->id_documentos_legal; ?></td>
							<td style="color:#000000;font-size:80%;"><?php echo $res->fecha_documentos_legal; ?></td>
							<td style="color:#000000;font-size:80%;"><?php echo $res->nombre_categorias; ?></td>
							<td style="color:#000000;font-size:80%;"><?php echo $res->nombre_subcategorias; ?></td>
							<td style="color:#000000;font-size:80%;"><?php echo $res->nombre_tipo_documentos; ?></td>
							<td style="color:#000000;font-size:80%;"><?php echo $res->nombre_cliente_proveedor; ?></td>
							<td style="color:#000000;font-size:80%;"><?php echo $res->numero_carton_documentos; ?></td>
							<td style="color:#000000;font-size:80%;"><?php echo $res->numero_credito_documentos_legal; ?></td>
							<td style="color:#000000;font-size:80%;"><?php echo $res->creado; ?></td>
							<td><div class="right">						
							<?php  if ($_SESSION["tipo_usuario"]=="usuario_local") {  ?>
			            		 <a href=" <?php echo IP_INT . $res->id_documentos_legal; ?>  " class="btn btn-warning" target="blank">Ver</a>
			            	<?php } else {?>
			            		 <a href="<?php echo IP_EXT . $res->id_documentos_legal; ?>  " class="btn btn-warning" target="blank">Ver</a> 
			            	<?php }?>
								</div></td>
							<td><div class="right">
						
							</div></td>
						
		<?php } ?>
						
					</tbody>
				</table>
			</section>
		<div class="table-pagination pull-right">
		<?php echo $filaspaginacion;?>
		</div>
	 </div>
	 
	 <!-- paginacion ajax -->
        
        <div style="display: block;">
		
		 <h4 style="color:#ec971f;"></h4>
			  <div >					
					<div id="Documentos" style="text-align: center;	top: 55px;	width: 100%;display:none;"></div><!-- Carga gif animado -->
					<div class="Documentos" ></div><!-- Datos ajax Final -->
		      </div>
		       <br>
				  
		 </div>
        
        <!--termina paginacion ajax --> 
	    
 	
      </form>  
      
      <br>
      <br>
        
       
       		   	   
     </div>  		
 </div>
 </div>
 
        <footer class="col-lg-12">
           <?php include("view/modulos/footer.php"); ?>
        </footer>
       </body>  
    </html>