<?php
include_once("config.php");
$corp = $_GET["corp"];
//$corp= $_COOKIE['corp'];
$result = mysqli_query($db,"
	SELECT id, NumberAudit, Corps_id, Type, TableType, Capacity, Area, Conditioner, CountSeats, Sockets
	FROM Auditorium
	WHERE Corps_id='$corp'
	");
$result2 = mysqli_query($db,"
	SELECT Abbr, ext_id
	FROM Corps
	WHERE id='$corp'
	");
$res2 = mysqli_fetch_array($result2);
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

while($res=mysqli_fetch_array($result)) {
  $auditor_id = $res[0];
  $num_audit = $res[1];
  $abbr_corp = $res2[0];
  $ext_id_corp = $res2[1];
  $capasity_audit = $res[5];
  $type_audit = $res[3];
  $square_audit = $res[6];
  $table_type = $res[4];
  $conditioner = $res[7];

	$result3 = mysqli_query($db,"
		SELECT Amount
		from Auditorium_Equipment
		where Auditorium_id='$auditor_id' and Equipment_id=1
	");
	$res3 = mysqli_fetch_array($result3);
  $comuterAmount = $res3[0];
	$result4 = mysqli_query($db,"
		SELECT Amount
		FROM Auditorium_Equipment
		WHERE Auditorium_id='$auditor_id' and Equipment_id=2
	");
	$res4 = mysqli_fetch_array($result4);
  $projector = $res4[0];
	$result5= mysqli_query($db,"
		SELECT Amount
		FROM Auditorium_Equipment
		WHERE Auditorium_id='$auditor_id' and Equipment_id=3
	");
	$res5 = mysqli_fetch_array($result5);
	$result6 = mysqli_query($db,"
		SELECT Equipment_id
		FROM Auditorium_Equipment
		WHERE Auditorium_id='$auditor_id' and Equipment_id=1
	");
	$res6 = mysqli_fetch_array($result6);

		$Object = $Collection->appendChild($dom->createElement('Object'));
        $Object->setAttribute("name", "ауд. $num_audit");
        $Object->setAttribute("class_id", 'Auditorium');
        $Object->setAttribute("id", "$auditor_id");
        $Collection2 = $Object->appendChild($dom->createElement('Collection'));
        $Collection2->setAttribute("caption", 'Свойства');
        $Collection2->setAttribute("name", 'Prop_Values');
        $Collection2->setAttribute("child_tags", 'prop_value');
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Number');
              $prop_value->setAttribute("value", "$num_audit");
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Name');
              $prop_value->setAttribute("value", "ауд. $num_audit");
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Abbr');
              $prop_value->setAttribute("value", "$abbr_corp, ауд. $num_audit");
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
              $prop_value->setAttribute("value", "$ext_id_corp");
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Amount'); //вместимость
              $prop_value->setAttribute("value", "$capasity_audit");
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("rlt_class", '');
              $prop_value->setAttribute("prop_name", 'ID_TypeOfAuditorium'); //тип аудитории
              $prop_value->setAttribute("value", "$type_audit");
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Square'); //площадь
              $prop_value->setAttribute("value",  "$square_audit");
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Equipment'); //Оборудование ???
              $prop_value->setAttribute("value", '');
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'TableType'); //Тип столов
              $prop_value->setAttribute("value", "$table_type");
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Darken'); //???
              $prop_value->setAttribute("value", '1');
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Conditioner'); //Кондиционер
              $prop_value->setAttribute("value", "$conditioner");
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
              $prop_value->setAttribute("value", '');
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'MediaFuture'); //Проектор??
              $prop_value->setAttribute("value", "$projector");
            $prop_value = $Collection2->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'ComputerAmount'); //колич комп
              $prop_value->setAttribute("value", "$comuterAmount");
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
