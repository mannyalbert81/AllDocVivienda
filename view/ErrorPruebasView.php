<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Error - aDocument 2015</title>
   
        
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
      
      <form  method="post" class="col-lg-5">
      
      
            <h3 style="color:#ec971f;">Error Detectado</h3>
            <hr/>
            <table>
            <?php echo $resultado ;?>
             </table>
     </form>
  </div>
  </div>
  		  <footer class="col-lg-12">
           <?php include("view/modulos/footer.php"); ?>
        </footer>
     </body>  
    </html>