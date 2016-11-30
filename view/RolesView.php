<!DOCTYPE HTML>
<html lang="es">
     <head>
        <meta charset="utf-8"/>
        <title>Roles - aDocument 2015</title>
   
      
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
      
      <form action="<?php echo $helper->url("Roles","InsertaRoles"); ?>" method="post" class="col-lg-5">
            <h4 style="color:#ec971f;">Insertar Roles</h4>
            <hr/>
            	
		   		
            
             <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	        
	            	Nombre Rol: <input type="text" name="nombre_rol" value="<?php echo $resEdit->nombre_rol; ?>" class="form-control"/>
		            
		            
            
		     <?php } } else {?>
		    
		            Nombre Rol: <input type="text" name="nombre_rol" value="" class="form-control"/>
		            
		     <?php } ?>
		        
           <input type="submit" value="Guardar" class="btn btn-success"/>
          </form>
       
       
        <div class="col-lg-7">
            <h4 style="color:#ec971f;">Roles de Usuario</h4>
            
        </div>
        <section class="col-lg-7 usuario" style="height:400px;overflow-y:scroll;">
        <table class="table table-hover">
	         <tr>
	    		<th>Id</th>
	    		<th>Nombre Rol</th>
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php foreach($resultSet as $res) {?>
	        		<tr>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_rol; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_rol; ?>     </td> 
		               
		               <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("Roles","index"); ?>&id_rol=<?php echo $res->id_rol; ?>" class="btn btn-warning" style="font-size:65%;"><i class='glyphicon glyphicon-edit'></i></a>
			                </div>
			            
			             </td>
			             <td>   
			                	<div class="right">
			                    <a href="<?php echo $helper->url("Roles","borrarId"); ?>&id_rol=<?php echo $res->id_rol; ?>" class="btn btn-danger" style="font-size:65%;"><i class="glyphicon glyphicon-trash"></i></a>
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
       
        <footer class="col-lg-12">
           <?php include("view/modulos/footer.php"); ?>
        </footer>
        
     </body>  
    </html>          