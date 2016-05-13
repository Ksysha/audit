<?php
$dblocation = "localhost";
$dbname = "Audit";
$dbuser = "root";
$dbpasswd = "";

$db = mysqli_connect($dblocation,$dbuser,$dbpasswd,$dbname);
mysqli_set_charset($db,'utf8');
?>
