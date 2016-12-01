<!DOCTYPE HTML>
<html lang="es">

  <head>
      
        <meta charset="utf-8"/>
        <title>PDF AllDocVivienda</title>
        
   <style type="text/css">
       .pagina {
		   position: relative;
		   padding-bottom: 50.25%;
		   overflow: hidden;
		}
		.pagina iframe
	 	{
	    position: absolute;
	    display: block;
	    top: 0;
	    left: 0;
	    width: 100%;
	    height: 100%;
	    align:center;
		}
		
   </style>
   
   <script type="text/javascript">
   document.oncontextmenu = function(){return false} 
   </script>
   <script type="text/javascript">
	function click() { if (event.button==2) { console.log('Lo Siento Mucho No Puedes Coopear'); }} 
	function keypresed() {console.log('Teclado Desabilitado');} 
	document.onkeydown=keypresed; 
	document.onmousedown=click; 
	</script>
       
         	
  </head>
  <body  oncontextmenu="return false" onkeydown="return false" >
  
   <div class="pagina" >
   
<?php    
	
	$id_documentos_legal = '';

		if (isset ($_GET["id_documentos_legal"]))
		{
			$id_documentos_legal = $_GET["id_documentos_legal"];
		
		}
		
 ?>
 
 
 
  <iframe src="DevuelveImagenView.php?id_documentos_legal=<?php echo $id_documentos_legal;?>#toolbar=0" align="middle" noresize frameborder="0" marginwidth="0" marginheight="0">
  
  </iframe>
 
 <?php /*?>
  <embed src="DevuelveImagenView.php?id_documentos_legal=<?php echo $id_documentos_legal; ?>" toolbar="0" width="100%">
 
  <?php */?>
  
  </div>
  
     
  </body>  

  </html>   
    
  
    