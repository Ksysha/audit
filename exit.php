<?php
	
	setcookie("log", '', time() - 3600, "/");
	//echo $_COOKIE['log'];
	//unset($_SESSION["log"]);
	session_destroy();
	$_SESSION = array(); //Очищаем сессию
    session_destroy(); 
	header("Location: sign_in.html");
?>
