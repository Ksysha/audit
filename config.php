<?php
/* For beget production
$dblocation = "localhost";
$dbname = "i96268oa_audit";
$dbuser = "i96268oa_audit";
$dbpasswd = "000000";
*/

$dblocation = "localhost";
$dbname = "Audit";
$dbuser = "root";
$dbpasswd = "";

$db = mysqli_connect($dblocation,$dbuser,$dbpasswd,$dbname);
mysqli_set_charset($db,'utf8');
?>
