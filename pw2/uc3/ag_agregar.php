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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO agenda (Nombres, Apellidos, Telefono, Celular) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['fNombres'], "text"),
                       GetSQLValueString($_POST['fApellidos'], "text"),
                       GetSQLValueString($_POST['fTelefono'], "text"),
                       GetSQLValueString($_POST['fCelular'], "text"));

  mysql_select_db($database_conPW2, $conPW2);
  $Result1 = mysql_query($insertSQL, $conPW2) or die(mysql_error());

  $insertGoTo = "index.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Agregar registro</title>
<style type="text/css">
#registro {
	font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 700px;
}

#registro th, #registro td {
	border: 1px solid #09F;
    padding: 2px;
}

#registro th {
    text-align: left;
    background-color: #0066CC;
    color: white;
}
</style>
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
<h2 class="center">Agregando registro en Agenda
</h2>
<form id="form1" name="form1" method="POST" action="<?php echo $editFormAction; ?>">
  <table align="center" class="registro" id="frm_registro">
    <tr>
      <th colspan="2">Registro de Agenda</th>
    </tr>
    <tr>
      <td align="right"><label for="fNombres">Nombre(s)*</label></td>
      <td><input name="fNombres" type="text" required pattern=".{1,}" id="fNombres" size="50" maxlength="100" /><span class="validity"></span></td>
    </tr>
    <tr>
      <td align="right"><label for="fApellidos">Apellido(s)*</label></td>
      <td><input name="fApellidos" type="text" required pattern=".{1,}" id="fApellidos" size="50" maxlength="100" /><span class="validity"></span></td>
    </tr>
    <tr>
      <td align="right"><label for="fTelefono">Telefono</label></td>
      <td><input name="fTelefono" type="text" pattern='[\+]\d{2}[\(]\d{2}[\)]\d{4}[\-]\d{4}|[\+]\d{2}[\(]\d{3}[\)]\d{3}[\-]\d{4}' title='Numero de Telefono (Formato: Vacío ó +99(99)9999-9999) ó +99(999)999-9999' id="fTelefono" size="16" maxlength="16" /><span class="validity"></span></td>
    </tr>
    <tr>
      <td align="right"><label for="fCelular">Celular</label></td>
      <td><input name="fCelular" type="text" pattern='[\+]\d{2}[\(]\d{2}[\)]\d{4}[\-]\d{4}|[\+]\d{2}[\(]\d{3}[\)]\d{3}[\-]\d{4}' title='Numero de Telefono (Formato: Vacío ó +99(99)9999-9999) ó +99(999)999-9999' id="fCelular" size="16" maxlength="16" /><span class="validity"></span></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="Enviar" id="Enviar" value="Enviar" />
      <input type="reset" name="bLimpiar" id="bLimpiar" value="Restablecer" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<h3 class="center"><a href="index.php">Regresar</a></h3>
</body>
</html>