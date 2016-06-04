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
  function rollback_db($db) {
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

    if(!empty($_POST["id"])) {
      $id = $_POST["id"];
      $result = mysqli_query($db,"
        UPDATE Auditorium SET NumberAudit='$Number', Type='$Type', Capacity='$Capacity', CountSeats='$CountSeats', TableType='$TableType', Sockets='$socket', Conditioner='$conditioner', Area='$area', Date='$datePublic' WHERE id=$id
        ");
      if ($result) {
          $Auditorium_id = $id;
      } else {
          return rollback_db($db);
      }
      $result = mysqli_query($db,"
        SELECT Equipment_id FROM Auditorium_Equipment WHERE Auditorium_id=$id
        ");
      if ($result) {
        while ($rows_res = mysqli_fetch_array($result)) {
          $Eq_id[] = $rows_res[0];
        }
      }
      if (isset($_POST["computer"]) && isset($_POST["computerCount"])) {
          $computer = $_POST["computer"];
          $computerCount = $_POST["computerCount"];

          if(in_array('1', $Eq_id)) {
            $result = mysqli_query($db,"
            UPDATE Auditorium_Equipment SET Amount='$computerCount' WHERE Auditorium_id='$Auditorium_id' AND Equipment_id=1
            ");
          }
          else {
            $result = mysqli_query($db,"
            INSERT INTO Auditorium_Equipment (Equipment_id, Auditorium_id,  Amount) VALUES('$computer', '$Auditorium_id', '$computerCount')
            ");
          }

          if (!$result) {
            return rollback_db($db);
          }
      }
      else {
        if(in_array('1', $Eq_id)) {
          $result = mysqli_query($db,"
          DELETE FROM Auditorium_Equipment WHERE Auditorium_id='$Auditorium_id' AND Equipment_id=1
          ");
        }
      }

      if (isset($_POST["projector"])) {
          $projector = $_POST["projector"];
          $projectorCount = 1;
          if(in_array('2', $Eq_id)) {
            $result = mysqli_query($db,"
            UPDATE Auditorium_Equipment SET Amount='$projectorCount' WHERE Auditorium_id='$Auditorium_id' AND Equipment_id=2
            ");
          }
          else {
            $result = mysqli_query($db,"
            INSERT INTO Auditorium_Equipment (Equipment_id, Auditorium_id,  Amount) VALUES('$projector', '$Auditorium_id', '$projectorCount')
            ");
          }
          if (!$result) {
            return rollback_db($db);
          }
      }
      else {
        if(in_array('2', $Eq_id)) {
          $result = mysqli_query($db,"
          DELETE FROM Auditorium_Equipment WHERE Auditorium_id='$Auditorium_id' AND Equipment_id=2
          ");
        }
      }

      if (isset($_POST["special"])) {
          $special = $_POST["special"];
          $specialCount = 1;
          if(in_array('3', $Eq_id)) {
            $result = mysqli_query($db,"
            UPDATE Auditorium_Equipment SET Amount='$specialCount' WHERE Auditorium_id='$Auditorium_id' AND Equipment_id=3
            ");
          }
          else {
            $result = mysqli_query($db,"
            INSERT INTO Auditorium_Equipment (Equipment_id, Auditorium_id,  Amount) VALUES('$special', '$Auditorium_id', '$specialCount')
            ");
          }
          if (!$result) {
            return rollback_db($db);
          }
      }
      else {
        if(in_array('3', $Eq_id)) {
          $result = mysqli_query($db,"
          DELETE FROM Auditorium_EquipmentWHERE Auditorium_id='$Auditorium_id' AND Equipment_id=3
          ");
        }
      }

      mysqli_query($db, 'COMMIT');
      mysqli_close($db);
      header("Location: /audit/building.php?corp={$corp}&update=true");
    }
    else {
      $result = mysqli_query($db,"
          SELECT NumberAudit FROM Auditorium
          ");
      while ($rows_res = mysqli_fetch_array($result)) {
          $NumberAudit[] = $rows_res[0];
      }
      if (in_array($Number, $NumberAudit)) {
        header("Location: /audit/building.php?corp={$corp}&success=error");
      }
      else {
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
              return rollback_db($db);
            }
        }

        if (isset($_POST["projector"])) {
            $projector = $_POST["projector"];
            $projectorCount = 1;
            $result = mysqli_query($db,"
            INSERT INTO Auditorium_Equipment (Equipment_id, Auditorium_id,  Amount) VALUES('$projector', '$Auditorium_id', '$projectorCount')
            ");

            if (!$result) {
              return rollback_db($db);
            }
        }

        if (isset($_POST["special"])) {
            $special = $_POST["special"];
            $specialCount = 1;
            $result = mysqli_query($db,"
            INSERT INTO Auditorium_Equipment (Equipment_id, Auditorium_id,  Amount) VALUES('$special', '$Auditorium_id', '$specialCount')
            ");

            if (!$result) {
              return rollback_db($db);
            }
        }

        mysqli_query($db, 'COMMIT');
        mysqli_close($db);
        header("Location: /audit/building.php?corp={$corp}&success=true");
     }
    }
  }
?>
