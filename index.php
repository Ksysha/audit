<?php

	if (isset($_COOKIE['log'])){
	echo '
<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="opentip.css">
    <script src="opentip.js"></script>
    <script src="main.js"></script>
  </head>

  <body>
    <div id="main">
      <a href="index.php"><img src="polytech_logo.svg" id="logo"></a>
      <div id="authorized">
      <img src="icon3.png" id="icon">
      <span id="username"></span>
      <div class = "exit">
        <a href="instruction.html">Инструкции</a>
        <a href="exit.php" >Выход</a>
      </div>
      </div>


      <ul id="menu">
        <a href="index.php">
          <li class="active">Список Зданий</li>
        </a>
        <a href="auditory_projector.php">
          <li>Аудитории с проектором</li>
        </a>
        <a href="big_auditor.php">
          <li>Большие аудитории</li>
        </a>
      </ul>

      <form id="corpForm" action="building.php" method="GET" >
        <div>
          <div class="line_button">
            <button type="submit" data-ot="1-й учебный корпус" name="corp" value="1" id="corp" onclick="setBuilding(this)">1 к.</button>
            <button type="submit" data-ot="2-й учебный корпус" name="corp" value="2" id="corp" onclick="setBuilding(this)">2 к.</button>
            <button type="submit" data-ot="3-й учебный корпус" name="corp" value="3" id="corp" onclick="setBuilding(this)">3 к.</button>
            <button type="submit" data-ot="4-й учебный корпус" name="corp" value="4" id="corp" onclick="setBuilding(this)">4 к.</button>
          </div>

          <div class="line_button">
            <button type="submit" data-ot="5-й учебный корпус" name="corp" value="5" id="corp" onclick="setBuilding(this)">5 к.</button>
            <button type="submit" data-ot="6-й учебный корпус" name="corp" value="6" id="corp" onclick="setBuilding(this)">6 к.</button>
            <button type="submit" data-ot="8-й учебный корпус" name="corp" value="7" id="corp" onclick="setBuilding(this)">8 к.</button>
            <button type="submit" data-ot="9-й учебный корпус" name="corp" value="8" id="corp" onclick="setBuilding(this)">9 к.</button>
          </div>

          <div class="line_button">
            <button type="submit" data-ot="10-й учебный корпус" name="corp" value="9" id="corp" onclick="setBuilding(this)">10 к.</button>
            <button type="submit" data-ot="11-й учебный корпус" name="corp" value="10" id="corp" onclick="setBuilding(this)">11 к.</button>
            <button type="submit" data-ot="15-й учебный корпус" name="corp" value="11" id="corp" onclick="setBuilding(this)">15 к.</button>
            <button type="submit" data-ot="16-й учебный корпус (НУК)" name="corp" value="12" id="corp" onclick="setBuilding(this)">16 к.</button>
          </div>

          <div class="line_button">
            <button type="submit" data-ot="Гидротехнический корпус-1" name="corp" value="13" id="corp" onclick="setBuilding(this)">ГК</button>
            <button type="submit" data-ot="Гидротехнический корпус-2" name="corp" value="14" id="corp" onclick="setBuilding(this)">ГК-2</button>
            <button type="submit" data-ot="Главное здание" name="corp" value="15" id="corp" onclick="setBuilding(this)">ГЗ</button>
            <button type="submit" data-ot="Механический корпус" name="corp" value="16" id="corp" onclick="setBuilding(this)">Мех. к.</button>

          </div>

          <div class="line_button">
            <button type="submit" data-ot="НОЦ УчК" name="corp" value="17" id="corp" onclick="setBuilding(this)">НОЦ</button>
            <button type="submit" data-ot="Не определено" name="corp" value="18" id="corp" onclick="setBuilding(this)">Не опр.</button>
            <button type="submit" data-ot="Спорткомплекс" name="corp" value="19" id="corp" onclick="setBuilding(this)">СК</button>
            <button type="submit" data-ot="Химический корпус" name="corp" value="20" id="corp" onclick="setBuilding(this)">Хим к.</button>
          </div>
        </div>
      </form>
    </div>

    <script>
      username.textContent = localStorage.login;

      function setBuilding(link) {
        localStorage.setItem("building", link.getAttribute("data-ot"));
      }
    </script>
  </body>
</html>';

	}
	else {
		header("Location: /sign_in.html");
	}
?>
