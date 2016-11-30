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
      
    
      <form action="<?php echo $helper->url("Categorias","InsertaCategorias"); ?>" method="post" class="col-lg-5">
            <h4>Insertar Categorias</h4>
            <hr/>
            	
		   		
            
             <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	        
	            	Nombre Categoria: <input type="text" name="nombre_categorias" value="<?php echo $resEdit->nombre_categorias; ?>" class="form-control"/>
		            Path  Categoria  : <input type="text" name="path_categorias"   value="<?php echo $resEdit->path_categorias; ?>" class="form-control"/>
		            
            
		     <?php } } else {?>
		    
		            Nombre Categoria: <input type="text" name="nombre_categorias" value="" class="form-control"/>
		            Path  Categoria  : <input type="text" name="path_categorias"   value="" class="form-control"/>
		    
		            
                
		     <?php } ?>
		        
           <input type="submit" value="Guardar" class="btn btn-success"/>
          </form>
       
       
        <div class="col-lg-7">
            <h4>Categorias</h4>
            <hr/>
        </div>
        <section class="col-lg-7 usuario" style="height:400px;overflow-y:scroll;">
        <table class="table table-hover">
	         <tr>
	    		<th>Id</th>
	    		<th>Nombre Categoria</th>
	    		<th>Path categoria</th>
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php foreach($resultSet as $res) {?>
	        		<tr>
	                   <td> <?php echo $res->id_categorias; ?>  </td>
		               <td> <?php echo $res->nombre_categorias; ?>     </td> 
		               <td> <?php echo $res->nombre_categorias; ?>  </td>
		               <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("Categorias","index"); ?>&id_categorias=<?php echo $res->id_categorias; ?>" class="btn btn-warning">Editar</a>
			                </div>
			            
			             </td>
			             <td>   
			                	<div class="right">
			                    <a href="<?php echo $helper->url("Categorias","borrarId"); ?>&id_categorias=<?php echo $res->id_categorias; ?>" class="btn btn-danger">Borrar</a>
			                </div>
			                <hr/>
		               </td>
		    		</tr>
		        <?php } ?>
            
            <?php 
            
            //echo "<script type='text/javascript'> alert('Hola')  ;</script>";
            
            ?>
            
       	</table>     
      </section>
       </div></div>
  
       
       <?php include("view/modulos/footer.php"); ?>
        
     </body>  
    </html>          