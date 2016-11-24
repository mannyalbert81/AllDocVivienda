<?php 


$dbconn = pg_connect("host=192.168.0.50 port=5432 dbname=ad_copseguros user=postgres password=.Romina.2012");

// Leer en un fichero binario
$data = file_get_contents('pruebaPdf.pdf');

// Escapar el dato binario
$escaped = pg_escape_bytea($data);

// Insertarlo en la base de datos
pg_query("INSERT INTO pdf (archivo_pdf) VALUES ('{$escaped}')");



$res = pg_query("SELECT archivo_pdf FROM pdf WHERE id_pdf='1'");
$raw = pg_fetch_result($res, 'archivo_pdf');

// Convert to binary and send to the browser
header('Content-type: application/pdf');
echo pg_unescape_bytea($raw);


?>