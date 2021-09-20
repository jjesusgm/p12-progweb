<?php require_once('../Connections/conPW2.php'); ?>
<?php mysql_set_charset('utf8'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$maxRows_rsPersonas = 10;
$pageNum_rsPersonas = 0;
if (isset($_GET['pageNum_rsPersonas'])) {
  $pageNum_rsPersonas = $_GET['pageNum_rsPersonas'];
}
$startRow_rsPersonas = $pageNum_rsPersonas * $maxRows_rsPersonas;

mysql_select_db($database_conPW2, $conPW2);
$query_rsPersonas = "SELECT * FROM agenda ORDER BY Apellidos ASC";
$query_limit_rsPersonas = sprintf("%s LIMIT %d, %d", $query_rsPersonas, $startRow_rsPersonas, $maxRows_rsPersonas);
$rsPersonas = mysql_query($query_limit_rsPersonas, $conPW2) or die(mysql_error());
$row_rsPersonas = mysql_fetch_assoc($rsPersonas);

if (isset($_GET['totalRows_rsPersonas'])) {
  $totalRows_rsPersonas = $_GET['totalRows_rsPersonas'];
} else {
  $all_rsPersonas = mysql_query($query_rsPersonas);
  $totalRows_rsPersonas = mysql_num_rows($all_rsPersonas);
}
$totalPages_rsPersonas = ceil($totalRows_rsPersonas/$maxRows_rsPersonas)-1;$maxRows_rsPersonas = 10;
$pageNum_rsPersonas = 0;
if (isset($_GET['pageNum_rsPersonas'])) {
  $pageNum_rsPersonas = $_GET['pageNum_rsPersonas'];
}
$startRow_rsPersonas = $pageNum_rsPersonas * $maxRows_rsPersonas;

mysql_select_db($database_conPW2, $conPW2);
$query_rsPersonas = "SELECT * FROM agenda ORDER BY Apellidos, Nombres ASC";
$query_limit_rsPersonas = sprintf("%s LIMIT %d, %d", $query_rsPersonas, $startRow_rsPersonas, $maxRows_rsPersonas);
$rsPersonas = mysql_query($query_limit_rsPersonas, $conPW2) or die(mysql_error());
$row_rsPersonas = mysql_fetch_assoc($rsPersonas);

if (isset($_GET['totalRows_rsPersonas'])) {
  $totalRows_rsPersonas = $_GET['totalRows_rsPersonas'];
} else {
  $all_rsPersonas = mysql_query($query_rsPersonas);
  $totalRows_rsPersonas = mysql_num_rows($all_rsPersonas);
}
$totalPages_rsPersonas = ceil($totalRows_rsPersonas/$maxRows_rsPersonas)-1;
?>
<?php
function obten_fecha_y_hora(){
	$dias_semana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado");
	$meses = array("","Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Dicimbre");
	$anio_actual = date("Y");
	$mes_actual = date("n");
	$dia_actual = date("j");
	$dia_semana_actual = date("w");
	$fecha = $dias_semana[$dia_semana_actual] . ", " . $dia_actual . " de " . $meses[$mes_actual] . " de " .$anio_actual;
	$fecha = $fecha . date(", h:i:s a");
	return $fecha;
}	
?>
<?php date_default_timezone_set('America/Mexico_City'); ?>
<!doctype html>
<html lang="es-MX">
<head>
	<meta charset="utf-8">
    <title>Mi agenda</title>
    <link href="css/uc3_estilos.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" class="tabla_compatibilidad" id="tbl_compatibilidad">
  <tr>
    <td width="50%">Compatibilidad con los siguientes navegadores:</td>
    <td><img src="imagenes/chrome-47x47.jpg" width="47" height="47" alt="Chrome" title="Chrome" /></td>
    <td><img src="imagenes/edge-47x47.jpg" width="47" height="47" alt="Edge" title="Edge" /></td>
    <td><img src="imagenes/firefox-47x47.jpg" width="47" height="47" alt="Firefox" title="Firefox" /></td>
    <td><img src="imagenes/opera-47x47.jpg" width="47" height="47" alt="Opera" title="Opera" /></td>
    <td><img src="imagenes/safari-47x47.png" width="47" height="47" alt="Safari" title="Safari" /></td>
  </tr>
  <tr bgcolor="#ddd">
    <td colspan="6">Nota: La validacion de campos utilizada en las etiquetas input (pattern) no esta soportada en Internet Explorer 9 y mas recientes.</td>
  </tr>
</table>
<h1 class="center">Contactos en mi agenda</h1>
<table width="500" align="center" class="tabla_sencilla" id="tbl_datos">
  <tr>
    <th align="right">Nombre</th>
    <td>José de Jesús Gutiérrez Martínez</td>
  </tr>
  <tr>
    <th align="right">Código</th>
    <td>8602328</td>
  </tr>
  <tr>
    <th align="right">Fecha</th>
    <td><?php echo obten_fecha_y_hora(); ?></td>
  </tr>
</table>
<h3 class="center"><a href="ag_agregar.php">Agregar registro</a></h3>
<table class="tabla_contactos" id="tbl_contactos">
  <tr>
    <th>ID</th>
    <th>NOMBRES</th>
    <th>APELLIDOS</th>
    <th>TELEFONO</th>
    <th>CELULAR</th>
    <th>ACCION</th>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php echo $row_rsPersonas['ID']; ?></td>
      <td><?php echo $row_rsPersonas['Nombres']; ?></td>
      <td><?php echo $row_rsPersonas['Apellidos']; ?></td>
      <td><?php echo $row_rsPersonas['Telefono']; ?></td>
      <td><?php echo $row_rsPersonas['Celular']; ?></td>
      <td align="center"><a href="ag_eliminar.php?ID=<?php echo $row_rsPersonas['ID']; ?>">Borrar</a> | <a href="ag_editar.php?ID=<?php echo $row_rsPersonas['ID']; ?>">Editar</a></td>
    </tr>
    <?php } while ($row_rsPersonas = mysql_fetch_assoc($rsPersonas)); ?>
</table>
<h3 class="center"><a href="ag_agregar.php">Agregar registro</a></h3>
</body>
</html>
<?php
mysql_free_result($rsPersonas);
?>
