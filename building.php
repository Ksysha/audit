<?php include_once("config.php"); ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="main.css">
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
      <a href="sign_in.html" >Выход</a>
    </div>
  </div>

  <hr>
  <div class = "exit back">
    <a href="index.html">Назад</a>
  </div>
  <div id="title">
    <span id="building">
    <?php
      $corp = $_GET["corp"];
      mysqli_select_db ( $db , $dbname );
      $result = mysqli_query($db,"
        SELECT Name FROM Corps WHERE id='$corp'
        ");
      $row = mysqli_fetch_row($result);
      echo $row[0];
    ?>
    </span>
  </div>
  <div id="blocks">
    <form id="auditor_Form" action="check.php" method="GET">
      <span><h2>Выбор аудитории:</h2></span>
      <input type="text" class="input" maxlength="30" placeholder="Введите номер аудитории" id="number" name="number" />
      <input type="hidden" name="corp" value='<?php echo$_GET["corp"];?>'>
      <button type="submit" id="button" onclick="setRoom()">Создать</button>
    </form>
     <?php
     $corp = $_GET["corp"];
      mysqli_select_db ($db , $dbname );
      $result = mysqli_query($db,"
        SELECT NumberAudit FROM Auditorium WHERE Corps_id='$corp'
        ");

      while($rows_res = mysqli_fetch_array($result)){
        $NumberAudit[] = $rows_res[0];
      }
    ?>
    <form action='check.php' id='room-list' method="GET">
    <?php
      if (!empty($NumberAudit)) {
        for ($i=0; $i < count($NumberAudit); $i++) {
        echo "<div class='auditorii'><a class='refer' href='check.php?corp={$_GET["corp"]}&room_id={$NumberAudit[$i]}'  onclick='setRoom(this)'>$NumberAudit[$i]</a></div>";
        }
      }
      else {
        echo "<div class='text'><p>Здесь пока нет аудиторий</p></div>";
      }
    ?>
    </form>
  </div>

  <button <?php if (empty($NumberAudit)) :?> style="display : none" <?php else: endif; ?> class="digramm" id="dtoggle" onclick="toggleDiagram()">Показать диаграмму видов аудиторий</button>
  <div id="piechart" style="margin: auto; margin-left: 100px; opacity: 0;"></div>

</div>
</div>

<?php
  if(isset($_GET["success"]) && $_GET["success"] == 'true') :
    echo "<div id='error_box'>
        <p id='error_message'></p>
      </div>";
?>
<script type="text/javascript">
  $('#error_message').html('Изменения сохранены');
  $("#error_box").fadeIn(500).delay(1500).fadeOut(500);
</script>

<?php
  else:
    endif;
?>



<!-- при вводе номера аудитории сортируется список "по совпедению"  -->
<script type='text/javascript'>

$(function() {
$('#number').keyup(function() {
var val = this.value;
var re = new RegExp('^' + val,'i');
$('#room-list a').each(function (){
$(this).toggle(re.test($(this).text()));
});
});
});
    username.textContent = localStorage.login;
   //<!-- building.textContent = localStorage.building;-->
</script>

<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1.1','packages':['corechart']}]}"></script>

<!-- Для диаграмки данные -->
<?php
  mysqli_select_db ($db , $dbname );
  $result = mysqli_query($db,"
  SELECT  count(id), Type FROM Auditorium WHERE Corps_id='$corp' GROUP BY Type
  ");
  while($rows_res = mysqli_fetch_array($result)) {
    $count[] = $rows_res[0];
    $Type[] = $rows_res[1];
  }
  if(isset($Type) && !empty($Type)) {
    if (!in_array('Компьютерная', $Type)) {
      $countComp = 0;
    }
    else {
      $a = array_search('Компьютерная', $Type);
      $countComp = $count[$a];
    }
    if (!in_array('Лаборатория', $Type)) {
      $countLaborator = 0;
    }
    else {
      $a = array_search('Лаборатория', $Type);
      $countLaborator = $count[$a];
    }
    if (!in_array('Практическая', $Type)) {
      $countPractic = 0;
    }
    else {
      $a = array_search('Практическая', $Type);
      $countPractic = $count[$a];
    }
    if (!in_array('Лекционная', $Type)) {
      $countLecture = 0;
    }
    else {
      $a = array_search('Лекционная', $Type);
      $countLecture = $count[$a];
    }
  }
  mysqli_close($db);
?>


<script>
  google.setOnLoadCallback(drawChart);

  var deletedRooms = JSON.parse(localStorage.deletedRooms || '[]');
  if (deletedRooms.length) {
    for (var i = 0; i < deletedRooms.length; i++) {
      $('.refer .list:contains(' + deletedRooms[i] + ')').remove();
    }
  }

  function randNumber() {
    return Math.floor((Math.random() * 100) + 1);
  }
  function drawChart() {
    console.log(<?php echo $countComp; ?>);
    var data = google.visualization.arrayToDataTable([
      ['Type', 'Number'],
      ['Лекционные',  <?php echo $countLecture; ?>],
      ['Практические', <?php echo $countPractic; ?>],
      ['Компьютерные', <?php echo $countComp; ?>],
      ['Лабораторные', <?php echo $countLaborator; ?>]
    ]);
    var options = {
      title: 'Виды аудиторий в здании',
      backgroundColor: 'transparent',
      width: 600,
      height: 400
    };
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
    chart.draw(data, options);
  }
  function toggleDiagram() {
    if (piechart.style.opacity == 0) {
      piechart.style.opacity = 1;
      dtoggle.textContent = 'Скрыть диаграмму видов аудиторий';
    } else {
      piechart.style.opacity = 0;
      dtoggle.textContent = 'Показать диаграмму видов аудиторий';
    }
  }
  function setRoom(link) {
    var value = link ? link.textContent : 'Новая аудитория';
    localStorage.setItem('room', value);
  }
</script>

</body>
</html>
