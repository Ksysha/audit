<?php include_once("config.php"); ?>
<?php
  function clean($value = "") {
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);

    return $value;
  }
  function check_length($value = "", $min, $max) {
      $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
      return !$result;
  }
  if(!$db) {
    echo "<h2>MySQL Error!</h2>";
    exit;
  }

  if (isset($_POST["Number"]) && isset($_POST["Type"]) && isset($_POST["Capacity"]) && isset($_POST["TableType"]) && isset($_POST["area"])) {
    $Number = clean($_POST["Number"]);
    $corp = $_POST["corp"];
    $Type = clean($_POST["Type"]);
    $Capacity = clean($_POST["Capacity"]);
    $CountSeats = 0;
    $TableType = clean($_POST["TableType"]);
    $socket = 0;
    $area = clean($_POST["area"]);
    $conditioner = '0';
    $datePublic = date("Y-m-d");

    if (isset($_POST["conditioner"])) {
      $conditioner = $_POST["conditioner"];
    }

    if(isset($_POST["CountSeats"])) {
      $CountSeats = clean($_POST["CountSeats"]);
    }
    if (isset($_POST["socket"])) {
      $socket = clean($_POST["socket"]);
    }

    if ($conditioner) {
      $conditioner = "1";
    }

    mysqli_select_db ( $db , $dbname );
    $result = mysqli_query($db,"
        INSERT INTO Auditorium (Number, Corps_id, Type, Capacity, CountSeats, TableType, Sockets, Conditioner, Area, Date) VALUES('$Number', '$corp', '$Type', '$Capacity', '$CountSeats', '$TableType', '$socket', '$conditioner', '$area', '$datePublic')
        ");
    if ($result== 'true') {
        echo "<div class='popup'>Ваши данные успешно добавлены</div>";
      }
    else {
        echo "<div class='popup'>Ваши данные не добавлены</div>";
    }
    mysqli_close($db);
  }
?>
