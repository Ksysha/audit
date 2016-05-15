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
    <hr/>
    <div class = "exit back">
      <a href="building.html">Назад</a>
    </div>
    <div id="title">
      <span id="building"></span>
      <span id="room"></span>
    </div>

    <form method="post" id="auditorForm" action="addBD.php">
      <div class="check2">
        <label class="label"> Номер аудитории </label>
        <input type="number" class="check2_num" id="Number" name="Number" required="" />
      </div>
      <input type="hidden" name="corp" value='<?php echo$_POST["corp"];?>'>
      <div class="check2">
        <p>
        <label class="label">Тип аудитории:</label>
        <select class="check2_num" name="Type" id="Type" required>
          <option value=""></option>
          <option value="Лекционная">Лекционная</option>
          <option value="Практическая">Практическая</option>
          <option value="Компьютерный класс">Компьютерный класс</option>
          <option value="Лаборатория">Лаборатория</option>
          </select>
        </p>
      </div>

      <div class="check2">
        <label class="label"> Вмеcтимость </label>
        <input type="number" class="check2_num" name="Capacity" id="Capacity" required/>
      </div>

       <!-- стулья -->
      <div class="check2">
        <label class="label"> Количество стульев </label>
        <input type="number" class="check2_num" name="CountSeats" id="CountSeats" />
      </div>



      <div class="check2">
        <label class="label"> Тип столов: </label>
        <div class="radio_col">
         <div class="check"> <label><input type="radio" name="TableType" id="TableType" value="Амфитеатр" checked>Амфитеатр</input></label><br></div>
          <div class="check"><label><input type="radio" name="TableType" id="TableType" value="Парты">Парты</input></label><br></div>
          <div class="check"><label><input type="radio" name="TableType" id="TableType" value="Компьютерные столы">Компьютерные столы</input></label><br></div>
        </div>
      </div>

      <div class="check2">
        <label class="label"> Компьютерное оснащение: </label>
        <div class="check">
          <label><input type="checkbox" name="computer" id="computer" onclick="showCat(this)" value="1" />Компьютеры</label>
        </div>   <!-- компютеры -->

        <div class="check2_1" id="div_computer" style="display : none">
          <label class="label_"> Количество компьютеров </label>
          <input type="number" class="check2_num_" id="computerCount" name="computerCount" />
        </div>

        <div class="check">
          <label><input type="checkbox" name="projector" id="projector" value="2" />Проектор</label>
        </div>

        <div class="check">
          <label><input type="checkbox" name="special" id="special" value="3" />Специальное оборудование</label>
        </div>
      </div>



      <div class="check2">
        <label class="label"> Количество розеток </label>
        <input type="number" class="check2_num" id="socket" name="socket" value="outlets_number" />
      </div>

      <div class="check2">
        <input type="checkbox" class="conditioner" id="conditioner" name="conditioner" />
        <label class="label" for="conditioner">Наличие кондиционеров</label>
      </div>

      <div id='error_box'>
      	<p id='error_message'></p>
      </div>

      <div class="check2">
        <label class="label"> Площадь аудитории </label>
        <input type="number" class="check2_num" id="area" name="area" value="Area" required />
      </div>

<!--onclick="but_saves()"onclick="deleteRoom()"-->
      <strong><button  type="submit" name="check" id="but_save">Сохранить</button></strong>
      <button  type="submit" id="but_remove" >Отмена</button>
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
    function showCat(catname){
    if(catname.checked) document.getElementById("div_"+catname.name).style.display = 'block';
    else document.getElementById("div_"+catname.name).style.display = 'none';
  }
  </script>

  <script>
    document.getElementById('check2_').onkeypress = function (e) {
    return (/[0-9]/.test(String.fromCharCode(e.charCode))); // разрешаем вводить только цифры
    }
  </script>
  <script>
    document.getElementById('check2_1').onkeypress = function (e) {
    return (/[0-9]/.test(String.fromCharCode(e.charCode))); // разрешаем вводить только цифры
    }
  </script>
  <script>
    document.getElementById('check2_2').onkeypress = function (e) {
    return (/[0-9]/.test(String.fromCharCode(e.charCode))); // разрешаем вводить только цифры
    }
  </script>
  <script>
    document.getElementById('check2_3').onkeypress = function (e) {
    return (/[0-9]/.test(String.fromCharCode(e.charCode))); // разрешаем вводить только цифры
    }
  </script>
  <script>
    document.getElementById('check2_4').onkeypress = function (e) {
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
