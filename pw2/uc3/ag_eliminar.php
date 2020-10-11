<?php require_once('../Connections/conPW2.php'); ?>
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

if ((isset($_POST['fID'])) && ($_POST['fID'] != "")) {
  $deleteSQL = sprintf("DELETE FROM agenda WHERE ID=%s",
                       GetSQLValueString($_POST['fID'], "int"));

  mysql_select_db($database_conPW2, $conPW2);
  $Result1 = mysql_query($deleteSQL, $conPW2) or die(mysql_error());

  $deleteGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_rsContacto = "-1";
if (isset($_GET['ID'])) {
  $colname_rsContacto = $_GET['ID'];
}
mysql_select_db($database_conPW2, $conPW2);
$query_rsContacto = sprintf("SELECT * FROM agenda WHERE ID = %s", GetSQLValueString($colname_rsContacto, "int"));
$rsContacto = mysql_query($query_rsContacto, $conPW2) or die(mysql_error());
$row_rsContacto = mysql_fetch_assoc($rsContacto);
$totalRows_rsContacto = mysql_num_rows($rsContacto);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
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
<h2 class="center">Eliminando registro de Agenda</h2>
<form id="form1" name="form1" method="POST">
  <table align="center" class="registro" id="frm_registro">
    <tr>
      <th colspan="2">Registro de Agenda</th>
    </tr>
    <tr>
      <td align="right"><input name="fID" type="hidden" id="fID" value="<?php echo $row_rsContacto['ID']; ?>" />
      <label for="fID">ID</label></td>
      <td><?php echo $row_rsContacto['ID']; ?></td>
    </tr>
    <tr>
      <td align="right"><label for="fNombres">Nombre(s)*</label></td>
      <td><span class="validity"><?php echo $row_rsContacto['Nombres']; ?></span></td>
    </tr>
    <tr>
      <td align="right"><label for="fApellidos">Apellido(s)*</label></td>
      <td><span class="validity"><?php echo $row_rsContacto['Apellidos']; ?></span></td>
    </tr>
    <tr>
      <td align="right"><label for="fTelefono">Teléfono</label></td>
      <td><span class="validity"><?php echo $row_rsContacto['Telefono']; ?></span></td>
    </tr>
    <tr>
      <td align="right"><label for="fCelular">Celular</label></td>
      <td><span class="validity"><?php echo $row_rsContacto['Celular']; ?></span></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="bEnviar" id="bEnviar" value="Enviar" />
      <input type="reset" name="bRestablecer" id="bRestablecer" value="Restablecer" /></td>
    </tr>
  </table>
</form>
<h3 class="center"><a href="index.php">Regresar</a></h3>
</body>
</html>
<?php
mysql_free_result($rsContacto);
?>
