<?php include_once("config.php"); ?>
<?php
  mysqli_select_db ($db , $dbname );
  $result = mysqli_query($db,"
  SELECT  count(id), Type FROM Auditorium WHERE Corps_id='10' GROUP BY Type
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
  echo $countComp,$countLaborator,$countPractic,$countLecture;
  mysqli_close($db);
?>
