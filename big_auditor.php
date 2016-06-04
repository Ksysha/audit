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
      <li>Список Зданий</li>
    </a>
    <a href="auditory_projector.php">
      <li>Аудитории с проектором</li>
    </a>
    <a href="big_auditor.php">
      <li class="active">Большие аудитории</li>
    </a>
  </ul>

<div id="checknum">
	<form method="post" id="BigAuditorForm" action="big_auditor.php">
      		<span><h3>Вместмость больше:</h3></span>
		<input type="number" class="input" id="num"  name="num"/>
        	<button type="submit" id="button">Показать</button>
     	</form>
</div>

<div id="chart_div" style="margin-top: -10px; height: 600px;"></div>
</div>
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>

<!-- Для диаграмки данные -->
<?php
 if (isset($_POST['num']) && !empty($_POST['num'])) {$num = $_POST['num'];}
							else {$num = 20;}
  mysqli_select_db ($db , $dbname );
  $result = mysqli_query($db,"
  SELECT  count(id), Corps_id FROM Auditorium
  WHERE capacity > '$num' GROUP BY Corps_id
  ");
  while($rows_res = mysqli_fetch_array($result)) {
    $count[] = $rows_res[0];
    $corp_id[] = $rows_res[1];
  }

  for ($i=1;$i<21;$i++){
	  if (!in_array($i, $corp_id)) {
	  $a[$i]=0;
	  }
	  else {
		  $a[$i]=$count[array_search($i, $corp_id)];
		}
  }
  mysqli_close($db);
?>

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
        ['Здание', 'Аудитории, вместимость больше <?php echo $num;?>',],
        ['1 к.', <?php echo $a[1]; ?>],
        ['2 к.', <?php echo $a[2]; ?>],
        ['3 к.', <?php echo $a[3]; ?>],
        ['4 к.', <?php echo $a[4]; ?>],
        ['5 к.', <?php echo $a[5]; ?>],
        ['6 к.', <?php echo $a[6]; ?>],
        ['8 к.', <?php echo $a[7]; ?>],
        ['9 к.', <?php echo $a[8]; ?>],
        ['10 к.', <?php echo $a[9]; ?>],
        ['11 к.', <?php echo $a[10]; ?>],
        ['15 к.', <?php echo $a[11]; ?>],
        ['16 к.', <?php echo $a[12]; ?>],
        ['ГК', <?php echo $a[13]; ?>],
        ['ГК-2', <?php echo $a[14]; ?>],
        ['ГЗ', <?php echo $a[15]; ?>],
        ['Мех. к.', <?php echo $a[16]; ?>],
        ['Не опр.', <?php echo $a[17]; ?>],
        ['НУК', <?php echo $a[18]; ?>],
        ['НОЦ', <?php echo $a[19]; ?>],
        ['СК', <?php echo $a[20]; ?>]
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
