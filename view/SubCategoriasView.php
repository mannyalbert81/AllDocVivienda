<!DOCTYPE HTML>
<html lang="es">
      <head>
        <meta charset="utf-8"/>
        <title>Menu - aDocument 2015</title>
       
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
      
      <form action="<?php echo $helper->url("SubCategorias","InsertaSubCategorias"); ?>" method="post" class="col-lg-5">
            <h4>Insertar SubCategorias</h4>
            <hr/>
            	
		   		
            
             <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	            	 Nombre Categoria: <select name="categorias" id="categorias"  class="form-control">
									<?php foreach($resultCat as $resCat) {?>
				 						<option value="<?php echo $resCat->id_categorias; ?>" <?php if ($resCat->id_categorias == $resEdit->id_categorias )  echo  ' selected="selected" '  ;  ?> ><?php echo $resCat->nombre_categorias; ?> </option>
						            <?php } ?>
								    	
									</select>
		   		    Nombre SubCategoria: <input type="text" name="nombre_subcategorias" value="<?php echo $resEdit->nombre_subcategorias; ?>" class="form-control"/>
		            Path SubCategoria  : <input type="text" name="path_subcategorias"   value="<?php echo $resEdit->path_subcategorias; ?>" class="form-control"/>
		            
            
		     <?php } } else {?>
		    
		        	 Nombre Categoria: <select name="categorias" id="categorias"  class="form-control">
									<?php foreach($resultCat as $resCat) {?>
				 						<option value="<?php echo $resCat->id_categorias; ?>" ><?php echo $resCat->nombre_categorias; ?> </option>
						            <?php } ?>
				
									</select>
		   		    Nombre SubCategoria: <input type="text" name="nombre_subcategorias" value="" class="form-control"/>
		            Path SubCategoria  : <input type="text" name="path_subcategorias"   value="" class="form-control"/>
		    
		            
                
		     <?php } ?>
		        
           <input type="submit" value="Guardar" class="btn btn-success"/>
          </form>
       
       
        <div class="col-lg-7">
            <h4>SubCategorias</h4>
            <hr/>
        </div>
        <section class="col-lg-7 usuario" style="height:400px;overflow-y:scroll;">
        <table class="table table-hover">
	         <tr>
	    		<th>Id</th>
	    		<th>Nombre Categoria</th>
	    		<th>Nombre Subcategoria</th>
	    		<th>Path Subcategoria</th>
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	                   <td> <?php echo $res->id_subcategorias; ?>  </td>
		               <td> <?php echo $res->nombre_categorias; ?>     </td> 
		               <td> <?php echo $res->nombre_subcategorias; ?>  </td>
		               <td> <?php echo $res->path_subcategorias; ?>     </td>
		           	   <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("SubCategorias","index"); ?>&id_subcategorias=<?php echo $res->id_subcategorias; ?>" class="btn btn-warning">Editar</a>
			                </div>
			            
			             </td>
			             <td>   
			                	<div class="right">
			                    <a href="<?php echo $helper->url("SubCategorias","borrarId"); ?>&id_subcategorias=<?php echo $res->id_subcategorias; ?>" class="btn btn-danger">Borrar</a>
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
       
       
        <footer class="col-lg-12">
           <?php include("view/modulos/footer.php"); ?>
        </footer>
     </body>  
    </html>   