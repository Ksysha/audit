<?php
include_once("config.php");
session_start();

function generateCode($length=6) {

    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;  
    while (strlen($code) < $length) {

            $code .= $chars[mt_rand(0,$clen)];  
    }
    return $code;

}


if (isset($_POST['login']) && isset($_POST['pass'])) {
	$userid = $_POST['login'];
  	$password = md5($_POST['pass']);

	if (mysqli_connect_errno()) {
		echo 'Невозможно подключиться к базе данных: '.mysqli_connect_error();
		exit();
	}

  	$query = "select * from users "
           ."where login='$userid' "
           ." and password='$password'";
	$result = mysqli_query($db, $query);
	$my = mysqli_fetch_array($result);
  	$result = $db->query($query);

  if ($result->num_rows > 0 )
  {
	$hash = md5(generateCode(10));
	setcookie("log", $hash, time()+ 3600 ,"/");
	header("Location: /audit/index.php");

  }
  else
  {

	echo ' <html>
		  <head>
			<meta charset="utf-8">
			<link rel="stylesheet" href="audit.css">
		  </head>

		  <body>
			<div id="main">
			  <img src="polytech_logo.svg" id="logo"></img>
			  <div><span><h1>Проверка состояния аудиторного фонда</h1><span></div>
		 <div style = "text-align:center"><span style = "color:red; font-size: 18px;" >Вам отказано в доступе. <br>Проверьте правильность ввода логина и пароля.</span><div>
			 </div>
			<form method="post" id="loginForm" action="users.php" onsubmit="doLogin(this); return false;">
			  <div class="field">
				<label>Имя пользователя:</label>
				<div class="input"><input type="text" id="login" name="login" /></div>
			  </div>

			  <div class="field">
				<label>Пароль:</label>
				<div class="input"><input type="password" id="pass" name="pass" /></div>
			  </div>

			  <div class="submit">
				<button type="submit">Войти</button>
			  </div>
			</form>

			</div>
			<script>
			  function doLogin(form) {
				localStorage.setItem(\'login\', form.login.value); // сохраняем наш логин в куки у пользователя на компе
				form.submit(); // продолжаем сабмитить
			  }
			</script>
		  </body>
		</html>';

  	}
  }
?>
