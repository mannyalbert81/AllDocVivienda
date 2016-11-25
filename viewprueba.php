<!DOCTYPE HTML PUBLIC “-//W3C//DTD HTML 4.01 Transitional//EN”>
<html>
<head>
<link rel=”stylesheet” href=”../style/style.css”>
<meta http-equiv=”Content-Type” content=”text/html; charset=UTF-8″>
<title></title>
</head>
<body>
<table width=”500″ border=”0″ class=”Msgbox_Popup”>
<tr>
<td colspan=”2″><div align=”center” class=”title”>Completar Select con Json y Jquery </div></td>
</tr>
<tr>
<td width=”101″><div align=”right” >Departamento:</div></td>
<td width=”389″><select class=”lista1″>
</select>
</td>
</tr>
<tr>
<td><div align=”right” >Provincia:</div></td>
<td>
<select id=”cmbPro”>
</select>
</td>
</tr>
<tr>
<td><div align=”right” >
Distrito:
</div></td>
<td><select id=”cmbDist”>
</select>
</td>
</tr>
</table>
</body>
</html>

<?php

class Conexion {
private static $StateConexion = false;
private static $cnn;
/**
*
* Numero de Columnas de una Consulta
*/
public static $numColumn = 0;
/**
*
* Numero de Filas de una consulta
*/
public static $numRows = 0;
public static function OpenConexion() {
try {
self::$cnn=new mysqli('localhost','root','animes','ubigeo');
if (mysqli_connect_errno()) {
self :: $StateConexion = FALSE;
throw new Exception("Error Al Conectarse a la Base de Datos: " . mysqli_connect_error());
}
} catch (Exception $ex) {
self :: $StateConexion = FALSE;
throw new Exception($ex->getMessage());
}
}
public static function traerDatos($Consulta) {
try {
if (self :: $StateConexion == FALSE) {
self :: OpenConexion();
}
$result = self :: $cnn->query($Consulta);
if(!$result){
throw new Exception('Error: '+self::$cnn->error);
}
//obtenemos el numero de columnas de la seleccion
self :: $numColumn = $result->field_count;
//obtenemos el numero de filas de la seleccion
self :: $numRows = $result->num_rows;
return ($result);
} catch (Exception $ex) {
throw new Exception($ex->getMessage());
}
}
public static function ejecutar($Consulta) {
try {
if (self :: $StateConexion == FALSE) {
self :: OpenConexion();
}
$result = self :: $cnn->query($Consulta);
if(!$result){
throw new Exception('Error: '+self::$cnn->error);
}
} catch (Exception $ex) {
throw new Exception($ex->getMessage());
}
}
}
?>
