
<?php

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
		
		if($nombre_rol=='Administrador'||$nombre_rol=='Cliente'||$nombre_rol=='Usuario'||$nombre_rol=='Usuario_Avanzado'||$nombre_rol=='Supervisor')
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
			die('Usuario no tiene acceso a Pdf(s)');
		}
		
	}else {
		
		pg_close($conn);
		die('Tenemos problemas con su Usuario');
	}

		
}


?>

