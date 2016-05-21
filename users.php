<?php
include_once("config.php");

if (isset($_POST['login']) && isset($_POST['pass']))
{ 
  
  $userid = $_POST['login'];
  $password = $_POST['pass'];


  if (mysqli_connect_errno()) {
   echo 'Невозможно подключиться к базе данных: '.mysqli_connect_error();
   exit();
  }

  $query = "select * from users "
           ."where login='$userid' "
           ." and password='$password'";

  $result = $db->query($query);
 
  if ($result->num_rows > 0 )
  { 
   
 
	header("Location: index.html");
   
  } 
  else
  {     
      
	  echo '<HTML>
     <HEAD>
	  <meta charset="utf-8">
    <link rel="stylesheet" href="audit.css">
     <META HTTP-EQUIV="Refresh" CONTENT="3; URL=sign_in.html">
     </HEAD>
     <BODY>
	 <div id="main">
      <img src="polytech_logo.svg" id="logo"></img>
      <div><span><h1>Проверка состояния аудиторного фонда</h1></span></div>
	 
     <div style = "text-align:center"><span style = "color:red; font-size: 18px;" >Вам отказано в доступе. <br>Проверьте правильность ввода логина и пароля.</span><div>
    </div>
    
     </BODY>
     </HTML>';
    
  }
  } 
?>
