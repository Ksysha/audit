<?php include_once("config.php"); ?>
<?php
  if(isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];
    $corp = $_POST["corp"];
    echo $id;
    mysqli_select_db ( $db , $dbname );
    $result = mysqli_query($db,"
      DELETE FROM Auditorium WHERE id=$id
      ");
    if($result) {
      mysqli_close($db);
      header("Location: /audit/building.php?corp={$corp}&destroy=true");
    }
  }

?>
