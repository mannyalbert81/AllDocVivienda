<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Login aDocument 2015</title>
       
       
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		
		
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>   
       
        <style>
            input{
                margin-top:5px;
                margin-bottom:5px;
            }
            .right{
                float:right;
            }
        </style>
        <style>
			body {
			
			    /* Ubicación de la imagen */
		  background-image: url(view/images/wallpaper.png);
		
		  /* Nos aseguramos que la imagen de fondo este centrada vertical y
		    horizontalmente en todo momento */
		  background-position: center center;
		
		  /* La imagen de fondo no se repite */
		  background-repeat: no-repeat;
		
		  /* La imagen de fondo está fija en el viewport, de modo que no se mueva cuando
		     la altura del contenido supere la altura de la imagen. */
		  background-attachment: fixed;
		
		  /* La imagen de fondo se reescala cuando se cambia el ancho de ventana
		     del navegador */
		  background-size: cover;
		
		  /* Fijamos un color de fondo para que se muestre mientras se está
		    cargando la imagen de fondo o si hay problemas para cargarla  */
		  background-color: #464646;
			}
			</style>
    </head>
   
   
   
    <body class="img-responsive" >
     <?php include("view/modulos/head.php"); ?>
       
   
    
        <form action="<?php echo $helper->url("usuarios","Loguear"); ?>" method="post"  class="col-lg-5" style=" padding-top:100px;">
        <div   style="background:#F6FADE ;border-radius: 5px;  border: 3px solid #063B41;"  >
        
        <h4 class="text-center" >Inicio de Sesión</h4>
        <hr/>
        <div class="text-center"  >
            
            <strong>USUARIO</strong> <input type="text" name="usuario" class="form-control"  style="text-align: center; " />
            
            <strong>CLAVE</strong> <input type="password" name="clave" class="form-control"  style="text-align: center; "/>
            
            <div class="text-center" style="height: 60px">
            <input type="submit" value="Login" class="btn btn-warning" style="width: 50%; "/>
            </div>
        </div>
            
          
    	</div>    
        </form>
        
    	<footer class="col-lg-12">
           <?php include("view/modulos/footer.php"); ?>
        </footer>     
    </body>
</html>