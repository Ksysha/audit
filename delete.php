<?php include_once("config.php"); ?>
<?php
  if(isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];
    $corp = $_POST["corp"];

    mysqli_select_db ( $db , $dbname );
    $result = mysqli_query($db,"
      DELETE FROM Auditorium WHERE id=$id
      ");
    if($result) {
      mysqli_close($db);
      header("Location: /building.php?corp={$corp}&destroy=true");
    } else {
      echo "Something went wrong";
    }
  }

?>
