<?php include_once("config.php"); 
include_once("is_sign.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="main.css">
  <link rel="stylesheet" href="check.css">
  <script src='http://code.jquery.com/jquery-latest.js'></script>
</head>

<body>

<div id="main">
    <a href="index.html"><img src="polytech_logo.svg" id="logo"></a>
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
      <li>Список Зданий</li>
    </a>
    <a href="auditory_projector.php">
      <li>Аудитории с проектором</li>
    </a>
    <a href="big_auditor.php">
      <li class="active">Большие аудитории</li>
    </a>
  </ul>
<div id="chart_div" style="margin-top: 0px; height: 600px;"></div>
</div>
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script>
    function doLogin(form) {
      localStorage.setItem('login', form.login.value); // сохраняем наш логин в куки у пользователя на компе
      form.submit(); // продолжаем сабмитить

    }
username.textContent = localStorage.login;
</script>

<script>
google.load('visualization', '1', {packages: ['corechart', 'bar']});
google.setOnLoadCallback(drawBasic);

function randNumber() {
  return Math.floor((Math.random() * 100) + 1);
}

function drawBasic() {

      var data = google.visualization.arrayToDataTable([
        ['Здание', 'Большие аудитории',],
        ['1 к.', randNumber()],
        ['2 к.', randNumber()],
        ['3 к.', randNumber()],
        ['4 к.', randNumber()],
        ['5 к.', randNumber()],
        ['6 к.', randNumber()],
        ['8 к.', randNumber()],
        ['9 к.', randNumber()],
        ['10 к.', randNumber()],
        ['11 к.', randNumber()],
        ['15 к.', randNumber()],
        ['16 к.', randNumber()],
        ['ГК', randNumber()],
        ['ГК-2', randNumber()],
        ['ГЗ', randNumber()],
        ['Мех. к.', randNumber()],
        ['Не опр.', randNumber()],
        ['НУК', randNumber()],
        ['НОЦ', randNumber()],
        ['СК', randNumber()]
      ]);

      var options = {
        title: 'Большие аудитории',
        colors: ['#004E63'],
        backgroundColor: 'transparent',
        chartArea: {width: '50%'},
        hAxis: {
          title: '',
          minValue: 0
        },
        vAxis: {
          title: 'Аудитории'
        }
      };

      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

      chart.draw(data, options);
    }
</script>

</body>
</html>
