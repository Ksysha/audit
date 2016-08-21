<?php
include_once("config.php");
$corp= $_COOKIE['corp'];
$result = mysqli_query($db,"
	select id, NumberAudit, Corps_id, Type, TableType, Capacity, Area, Conditioner, CountSeats, sockets
	from auditorium
	where corps_id=$corp
	");
$result2 = mysqli_query($db,"
	select abbr, ext_id
	from corps
	where id=$corp
	");
$res2 = mysqli_fetch_array($result2, MYSQLI_NUM);
$dom = new domDocument("1.0", "windows-1251"); // Создаём XML-документ версии 1.0 с кодировкой windows-1251
$Data_Root = $dom->appendChild($dom->createElement( 'Data_Root' ));

$Descript = $Data_Root->appendChild($dom->createElement('Descript'));
$Descript->setAttribute("ExpSet_Code", '014');
$Descript->setAttribute("ExpSet_Name", 'Auditorium');
$Descript->appendChild($dom->createCDATASection( '' ));

$Data = $Data_Root->appendChild($dom->createElement('Data'));
$Collection = $Data->appendChild($dom->createElement('Collection'));
$Collection->setAttribute("caption", 'Аудитории');
$Collection->setAttribute("name", 'Data.Auditorium');
$Collection->setAttribute("child_tags", 'Object');

while($res=mysqli_fetch_array($result)){
	$result3 = mysqli_query($db,"
		select Amount
		from auditorium_equipment
		where auditorium_id=$res[0] and Equipment_id=1
	");
	$res3 = mysqli_fetch_array($result3, MYSQLI_NUM);
	$result4 = mysqli_query($db,"
		select Amount
		from auditorium_equipment
		where auditorium_id=$res[0] and Equipment_id=2
	");
	$res4 = mysqli_fetch_array($result4, MYSQLI_NUM);
	$result5= mysqli_query($db,"
		select Amount
		from auditorium_equipment
		where auditorium_id=$res[0] and Equipment_id=3
	");
	$res5 = mysqli_fetch_array($result5, MYSQLI_NUM);
	$result6 = mysqli_query($db,"
		select Equipment_id
		from auditorium_equipment
		where auditorium_id=$res[0] and Equipment_id=1
	");
	$res6 = mysqli_fetch_array($result6, MYSQLI_NUM);

		$Object = $Collection->appendChild($dom->createElement('Object'));
        $Object->setAttribute("name", "ауд. $res[1]");
        $Object->setAttribute("class_id", 'Auditorium');
        $Object->setAttribute("id", "$res[0]");
        $Collection2 = $Object->appendChild($dom->createElement('Collection'));
        $Collection2->setAttribute("caption", 'Свойства');
        $Collection2->setAttribute("name", 'Prop_Values');
        $Collection2->setAttribute("child_tags", 'prop_value');
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Number');
              $prop_value->setAttribute("value", "$res[1]");
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Name');
              $prop_value->setAttribute("value", "ауд. $res[1]");
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Abbr');
              $prop_value->setAttribute("value", "$res2[0], ауд. $res[1]");
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("rlt_class", '');
              $prop_value->setAttribute("prop_name", 'ID_Faculty'); //
              $prop_value->setAttribute("value", '');
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("rlt_class", '');
              $prop_value->setAttribute("prop_name", 'ID_Chair'); //
              $prop_value->setAttribute("value", '');
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("rlt_class", '');
              $prop_value->setAttribute("prop_name", 'ID_Building');
              $prop_value->setAttribute("value", "$res2[1]");
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Amount'); //вместимость
              $prop_value->setAttribute("value", "$res[5]");
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("rlt_class", '');
              $prop_value->setAttribute("prop_name", 'ID_TypeOfAuditorium'); //тип аудитории
              $prop_value->setAttribute("value", "$res[3]");
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Square'); //площадь
              $prop_value->setAttribute("value",  "$res[6]");
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Equipment'); //Оборудование ???
              $prop_value->setAttribute("value", '');
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'TableType'); //Тип столов
              $prop_value->setAttribute("value", "$res[4]");
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Darken'); //???
              $prop_value->setAttribute("value", '1');
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Conditioner'); //Кондиционер
              $prop_value->setAttribute("value", "$res[7]");
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Height'); // нет
              $prop_value->setAttribute("value", '');
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Lenght'); // нет
              $prop_value->setAttribute("value", '');
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Width'); // нет
              $prop_value->setAttribute("value", '');
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'ComputerEquipment');
              $prop_value->setAttribute("value", "$res6[0]");
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'MediaFuture'); //Проектор??
              $prop_value->setAttribute("value", "$res4[0]");
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'ComputerAmount'); //колич комп
              $prop_value->setAttribute("value", "$res3[0]");
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'MonitorDiagonal'); // нет
              $prop_value->setAttribute("value", '');
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Overlay');
              $prop_value->setAttribute("value", '');
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Note');
              $prop_value->setAttribute("value", '');
			  $dom->formatOutput = true;
	}


  // $logins = array("User1", "User2", "User3"); // Логины пользователей
  // $passwords = array("Pass1", "Pass2", "Pass3"); // Пароли пользователей

  // for ($i = 0; $i < count($logins); $i++) {
  //   $id = $i + 1; // id-пользователя
  //   $user = $dom->createElement("user"); // Создаём узел "user"
  //   $user->setAttribute("id", $id); // Устанавливаем атрибут "id" у узла "user"
  //   $login = $dom->createElement("login", $logins[$i]); // Создаём узел "login" с текстом внутри
  //   $password = $dom->createElement("password", $passwords[$i]); // Создаём узел "password" с текстом внутри
  //   $user->appendChild($login); // Добавляем в узел "user" узел "login"
  //   $user->appendChild($password);// Добавляем в узел "user" узел "password"
  //   $root->appendChild($user); // Добавляем в корневой узел "users" узел "user"
  // }

  $dom->save("Auditorium.xml"); // Сохраняем полученный XML-документ в файл

  $file = 'Auditorium.xml';

  if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;
  }

?>
