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
  function rollback_db() {
      mysqli_query($db, 'ROLLBACK');
      echo "<div class='popup'>Ваши данные не добавлены</div>";
      mysqli_close($db);
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
    mysqli_query($db,'SET AUTOCOMMIT=0');
    mysqli_query($db,'START TRANSACTION');

    $result = mysqli_query($db,"
        INSERT INTO Auditorium (NumberAudit, Corps_id, Type, Capacity, CountSeats, TableType, Sockets, Conditioner, Area, Date) VALUES('$Number', '$corp', '$Type', '$Capacity', '$CountSeats', '$TableType', '$socket', '$conditioner', '$area', '$datePublic')
        ");
    if ($result) {
        $Auditorium_id = mysqli_insert_id($db);
    } else {
        return rollback_db($db);
    }

    if (isset($_POST["computer"]) && isset($_POST["computerCount"])) {
        $computer = $_POST["computer"];
        $computerCount = $_POST["computerCount"];
        $result = mysqli_query($db,"
        INSERT INTO Auditorium_Equipment (Equipment_id, Auditorium_id,  Amount) VALUES('$computer', '$Auditorium_id', '$computerCount')
        ");

        if (!$result) {
          return rollback_db();
        }
    }

    if (isset($_POST["projector"])) {
        $projector = $_POST["projector"];
        $projectorCount = 1;
        $result = mysqli_query($db,"
        INSERT INTO Auditorium_Equipment (Equipment_id, Auditorium_id,  Amount) VALUES('$projector', '$Auditorium_id', '$projectorCount')
        ");

        if (!$result) {
          return rollback_db();
        }
    }

    if (isset($_POST["special"])) {
        $special = $_POST["special"];
        $specialCount = 1;
        $result = mysqli_query($db,"
        INSERT INTO Auditorium_Equipment (Equipment_id, Auditorium_id,  Amount) VALUES('$special', '$Auditorium_id', '$specialCount')
        ");

        if (!$result) {
          return rollback_db();
        }
    }

    mysqli_query($db, 'COMMIT');
    echo "<div class='popup'>Ваши данные добавлены</div>";
    mysqli_close($db);
    header("Location: /audit/building.php?corp={$corp}&success=true");
  }
?>
