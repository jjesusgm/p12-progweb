<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_conPW2 = "localhost";
$database_conPW2 = "pw2";
$username_conPW2 = "pw2";
$password_conPW2 = "p12pw2";
$conPW2 = mysql_pconnect($hostname_conPW2, $username_conPW2, $password_conPW2) or trigger_error(mysql_error(),E_USER_ERROR); 
?>