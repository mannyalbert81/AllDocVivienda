

<!DOCTYPE HTML>
<html lang="es">
      <head>
        <meta charset="utf-8"/>
        <title>Usuarios - aDocument 2015</title>

         
 <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
          <link rel="stylesheet" href="view/css/bootstrap.css">
          <link rel="stylesheet" type="text/css" href="css/jquery-ui-1.7.2.custom.css" />
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>  
          <script src="view/js/jquery.js"></script>
		  
	      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>




<script>
    var imagenes=new Array(

        'images/publicidad/1.png',
        'images/publicidad/2.png',
        'images/publicidad/3.jpg'

    );

    function rotarImagenes()
    {
        var index=Math.floor((Math.random()*imagenes.length));
        document.getElementById("imagen").src=imagenes[index];
    }

    onload=function()
    {
        rotarImagenes();
        setInterval(rotarImagenes,3000);
    }
    </script>
</head>



<body>


<?php


$id_documentos_legal = '';

if (isset ($_GET["id_documentos_legal"]))
{
	$id_documentos_legal = $_GET["id_documentos_legal"];

}

$image = "";
//$conn  = pg_connect("user=postgres port=5432 password=.Romina.2012 dbname=coactiva host=192.168.100.3");
$conn  = pg_connect("user=postgres port=5433 password=.Romina.2012 dbname=ad_capremci host=186.4.241.148");
if(!$conn)
{
	echo  "No se pudo conectar";
	die();
}
else 
{
	$id_documentos_legal = '';
	
	if (isset ($_GET["id_documentos_legal"]))
	{
		$id_documentos_legal = $_GET["id_documentos_legal"];
	
	}
	
	session_start();
	
	$id_rol=$_SESSION['id_rol'];
	
	$nombre_rol="Usuario_Consultor";
	
	$query = pg_query($conn, "SELECT nombre_rol FROM rol WHERE id_rol = '$id_rol' ");
	$resultRol=array();

	if ($query)
	{
		while ($row = pg_fetch_object($query)) {
			$resultRol[]=$row;
		}
		
		$nombre_rol = $resultRol[0]->nombre_rol;
		
		$campo = 'archivo_archivos_pdf';
		$tabla = 'archivos_pdf';
		$id_nombre = 'id_documentos_legal';
		$id_valor = '75820';
		
		if($nombre_rol=='Administrador')
		{
		
			$res = pg_query($conn, "SELECT archivo_archivos_pdf FROM archivos_pdf WHERE id_documentos_legal = '$id_documentos_legal' ");
			
			if ($res)
			{
				$raw = pg_fetch_result($res, $campo );
					
				header('Content-type: application/pdf');
				//header("Content-Disposition:inline;filename=downloaded.pdf");
				echo pg_unescape_bytea($raw);
				
			}
			
			pg_close($conn);
		}
		else {
			pg_close($conn);
			$publicidad = '<center><img src="" id="imagen" width="700" height="700"></center>';
		    //echo ;
		    die($publicidad);
			
			
		}
		
	}else {
		
		pg_close($conn);
		die('Tenemos problemas con su Usuario');
	}

		
}


?>





</body>
 </html>  

