
<!DOCTYPE HTML>
<html lang="es">
      <head>
        <meta charset="utf-8"/>
        <title>Usuarios - aDocument 2015</title>

         <link href="noprint.txt" rel="alternate" media="print">



<style type="text/css" media="print"><!--
pdf{ visibility:hidden }
--></style>

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
}
else 
{

		$campo = 'archivo_archivos_pdf';
		$tabla = 'archivos_pdf';
		$id_nombre = 'id_documentos_legal';
		$id_valor = '75820';
		
		$res = pg_query($conn, "SELECT archivo_archivos_pdf FROM archivos_pdf WHERE id_documentos_legal = '$id_documentos_legal' ");
	
		if ($res)
		{
			$raw = pg_fetch_result($res, $campo );
			
			header('Content-type: application/pdf');
			echo pg_unescape_bytea($raw);
			
			
		}
	
	pg_close($conn);
	
}



?>


</body>
 </html>  
