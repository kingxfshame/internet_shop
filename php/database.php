<?php 
$sql_server = "localhost";
$sql_user  = "root";
$sql_password = "";
$sql_database = "qwerty";
$sql_connection = new mysqli($sql_server, $sql_user, $sql_password, $sql_database);
$sql_connection-> set_charset("utf8");
?>