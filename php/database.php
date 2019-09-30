<?php 
$servernimi = "localhost";
$kasutaja  = "root";
$parool = "";
$andmebaas = "qwerty";
$yhendus = new mysqli($servernimi,$kasutaja,$parool,$andmebaas);
$yhendus-> set_charset("utf8");


?>