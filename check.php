<?php include_once("config.php");
include_once("is_sign.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="main.css">
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
    <hr/>
    <form action="" class="a">
      <div class = "exit back">
        <a href='building.php?corp=<?php echo$_GET["corp"]?>'>Назад</a>
      </div>
    </form>
    <?php
      if(isset($_GET["room_id"]) && !empty($_GET["room_id"])) {
        $room_id = $_GET["room_id"];
        $corp = $_GET["corp"];
        mysqli_select_db ($db , $dbname );
        $result = mysqli_query($db,"
          SELECT * FROM Auditorium WHERE Corps_id='$corp' AND NumberAudit='$room_id'
          ");
        $rows_res = mysqli_fetch_array($result);
        $id = $rows_res[0];
        $Type = $rows_res[3];
        $Capacity = $rows_res[4];
        $CountSeats = $rows_res[5];
        $TableType = $rows_res[6];
        $Sockets = $rows_res[7];
        $Conditioner = $rows_res[8];
        $Area = $rows_res[9];
        $Date = $rows_res[10];

        mysqli_select_db ($db , $dbname );
        $result1 = mysqli_query($db,"
          SELECT Equipment_id FROM Auditorium_Equipment WHERE Auditorium_id=(SELECT id FROM Auditorium WHERE NumberAudit='$room_id' AND Corps_id=$corp)
          ");
        while ($rows_res1 = mysqli_fetch_array($result1)) {
          $Equipment_id[] = $rows_res1[0];
        }
      }
    ?>
    <?php if(isset($id) && !empty($id)) :?>
      <form method="post" action="delete.php" class="b">
        <button onclick="return confirm('Вы действительно хотите удалить аудиторию?')" type="submit" class="delete">Удалить</button>
          <!-- <a href='building.php?corp=<?php echo$_GET["corp"]?>'>Удалить</a> -->
        <input type="hidden" name="id" value='<?php echo$id;?>'>
        <input type="hidden" name="corp" value='<?php echo$_GET["corp"];?>'>
      </form>
    <?php else: endif; ?>

    <div id="title">
      <span id="building"></span>
      <span id="room"></span>
    </div>

    <form method="post" id="auditorForm" action="addBD.php">
    <?php if(isset($id) && !empty($id)) :?>
      <input type="hidden" name="id" value='<?php echo$id;?>'>
    <?php else: endif; ?>
      <div class="check2">
        <label class="label"> Номер аудитории </label>
        <input type="number" class="check2_num" id="Number" name="Number" required="" value='<?php echo $room_id;?>'/>
      </div>
      <input type="hidden" name="corp" value='<?php echo$_GET["corp"];?>'>
      <div class="check2">
        <p>
        <label class="label">Тип аудитории:</label>
        <select class="check2_num" name="Type" id="Type" required>
          <option value=""></option>
          <option <?php if(!empty($Type) && $Type == 'Лекционная') :?> selected <?php else: endif; ?> value="Лекционная">Лекционная</option>
          <option <?php if(!empty($Type) && $Type == 'Практическая') :?> selected <?php else: endif; ?> value="Практическая">Практическая</option>
          <option <?php if(!empty($Type) && $Type == 'Компьютерная') :?> selected <?php else: endif; ?> value="Компьютерная">Компьютерная</option>
          <option <?php if(!empty($Type) && $Type == 'Лаборатория') :?> selected <?php else: endif; ?> value="Лаборатория">Лаборатория</option>
          </select>
        </p>
      </div>

      <div class="check2">
        <label class="label"> Вмеcтимость </label>
        <input type="number" class="check2_num" name="Capacity" id="Capacity" value='<?php echo $Capacity;?>' required/>
      </div>

       <!-- стулья -->
      <div class="check2">
        <label class="label"> Количество стульев </label>
        <input type="number" class="check2_num" name="CountSeats" id="CountSeats" value='<?php echo $CountSeats;?>' />
      </div>



      <div class="check2">
        <label class="label"> Тип столов: </label>
        <div class="radio_col">
         <div class="check"> <label><input <?php if(!empty($TableType) && $TableType == 'Амфитеатр') :?> checked <?php else: endif; ?> type="radio" name="TableType" id="TableType" value="Амфитеатр" required>Амфитеатр</input></label><br></div>
          <div class="check"><label><input <?php if(!empty($TableType) && $TableType == 'Парты') :?> checked <?php else: endif; ?> type="radio" name="TableType" id="TableType" value="Парты">Парты</input></label><br></div>
          <div class="check"><label><input <?php if(!empty($TableType) && $TableType == 'Компьютерные столы') :?> checked <?php else: endif; ?> type="radio" name="TableType" id="TableType" value="Компьютерные столы">Компьютерные столы</input></label><br></div>
        </div>
      </div>

      <div class="check2">
        <label class="label"> Компьютерное оснащение: </label>
        <div class="check">
          <?php if (!empty($Equipment_id)) { $computerChecked = in_array('1', $Equipment_id); }?>
          <label><input type="checkbox" <?php if(!empty($computerChecked) && $computerChecked) :?> checked <?php else: endif; ?> name="computer" id="computer" onclick="toggleState(this)" value="1" />Компьютеры</label>
        </div>   <!-- компютеры -->
        <?php
        if (!empty($room_id)) {
          mysqli_select_db ($db , $dbname );
          $result2 = mysqli_query($db,"
          SELECT  Amount FROM Auditorium_Equipment WHERE Equipment_id=1 AND Auditorium_id=(SELECT id FROM Auditorium WHERE NumberAudit='$room_id' AND Corps_id=$corp)
          ");
          $rows_res2 = mysqli_fetch_array($result2);
          $Amount = $rows_res2[0];
          mysqli_close($db);
        }
        ?>
        <div class="check2_1" id="div_computer" style=<?php if (!isset($computerChecked) || (!empty($computerChecked) && !$computerChecked) || (!$computerChecked)) :?>"display : none"<?php else: endif; ?>>
          <label class="label_"> Количество компьютеров </label>
          <input type="number" value='<?php echo $Amount;?>' class="check2_num_" id="computerCount" name="computerCount" />
        </div>

        <div class="check">
          <label><input type="checkbox" <?php if(!empty($Equipment_id) && in_array('2', $Equipment_id)) :?> checked <?php else: endif; ?> name="projector" id="projector" value="2" />Проектор</label>
        </div>

        <div class="check">
          <label><input type="checkbox" <?php if(!empty($Equipment_id) && in_array('3', $Equipment_id)) :?> checked <?php else: endif; ?> name="special" id="special" value="3" />Специальное оборудование</label>
        </div>
      </div>



      <div class="check2">
        <label class="label"> Количество розеток </label>
        <input type="number" class="check2_num" id="socket" name="socket" value='<?php echo $Sockets;?>'/>
      </div>

      <div class="check2">
        <input type="checkbox" class="conditioner" id="conditioner" name="conditioner" <?php if(!empty($Conditioner) && $Conditioner == '1') :?> checked <?php else: endif; ?> />
        <label class="label" for="conditioner">Наличие кондиционеров</label>
      </div>

      <div class="check2">
        <label class="label"> Площадь аудитории </label>
        <input type="number" class="check2_num" id="area" name="area" value='<?php echo $Area;?>' required />
      </div>

<!--onclick="but_saves()"onclick="deleteRoom()"-->
      <strong>
        <button  type="submit" name="check" id="but_save">Сохранить</button>
        <button  type="button" id="but_remove" onclick="window.location = '/audit/building.php?corp=<?php echo$_GET["corp"]?>'">Отмена</button>
      </strong>

    </form>
  </div>

  <script>
    function deleteRoom() {
      var result = confirm('Вы действительно хотите удалить эту аудиторию?');
      if (result) {
        var deletedRooms = JSON.parse(localStorage.deletedRooms || '[]');
        deletedRooms.push(localStorage.room);
        localStorage.setItem('deletedRooms', JSON.stringify(deletedRooms));
        location = 'building.html'
      }
    }
  </script>

  <script>
    username.textContent = localStorage.login;
    building.textContent = localStorage.building;
    room.textContent = ' — ' + localStorage.room;
    numberRoom.value = localStorage.room;
  </script>

  <script> // для количества компьютеров
    function toggleState(catname){
    if(catname.checked) document.getElementById("div_"+catname.name).style.display = 'block';
    else document.getElementById("div_"+catname.name).style.display = 'none';
  }
  </script>

  <script>
    document.getElementById('Capacity').onkeypress = function (e) {
    return (/[0-9]/.test(String.fromCharCode(e.charCode))); // разрешаем вводить только цифры
    }
  </script>
  <script>
    document.getElementById('Number').onkeypress = function (e) {
    return (/[0-9а-яa-zA-ZА-Я]/.test(String.fromCharCode(e.charCode))); // разрешаем вводить только цифры
    }
  </script>
  <script>
    document.getElementById('computerCount').onkeypress = function (e) {
    return (/[0-9]/.test(String.fromCharCode(e.charCode))); // разрешаем вводить только цифры
    }
  </script>
  <script>
    document.getElementById('socket').onkeypress = function (e) {
    return (/[0-9]/.test(String.fromCharCode(e.charCode))); // разрешаем вводить только цифры
    }
  </script>
  <script>
    document.getElementById('area').onkeypress = function (e) {
    return (/[0-9]/.test(String.fromCharCode(e.charCode))); // разрешаем вводить только цифры
    }
  </script>
   <script>
    document.getElementById('CountSeats').onkeypress = function (e) {
    return (/[0-9]/.test(String.fromCharCode(e.charCode))); // разрешаем вводить только цифры
    }
  </script>



  <script>
    (function() {
      $(function() {
      return $('.icon').on('click', function() {
      if ($(this).hasClass('on')) {
      return $(this).removeClass('on');
      } else {
      return $(this).addClass('on');
      }
      });
      });
    }).call(this);
  </script>

</body>
</html>
