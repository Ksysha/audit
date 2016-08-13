<?php
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
        $Object = $Collection->appendChild($dom->createElement('Object'));
        $Object->setAttribute("name", 'ауд.143');
        $Object->setAttribute("class_id", 'Auditorium');
        $Object->setAttribute("id", '15143');
          $Collection = $Object->appendChild($dom->createElement('Collection'));
          $Collection->setAttribute("caption", 'Свойства');
          $Collection->setAttribute("name", 'Prop_Values');
          $Collection->setAttribute("child_tags", 'prop_value');
            $prop_value = $Collection->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Number');
              $prop_value->setAttribute("value", '143');
            $prop_value = $Collection->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Name');
              $prop_value->setAttribute("value", 'ауд.143');
            $prop_value = $Collection->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Abbr');
              $prop_value->setAttribute("value", '11 к., ауд.143');
            $prop_value = $Collection->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("rlt_class", '');
              $prop_value->setAttribute("prop_name", 'ID_Faculty');
              $prop_value->setAttribute("value", '');
            $prop_value = $Collection->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("rlt_class", '');
              $prop_value->setAttribute("prop_name", 'ID_Chair');
              $prop_value->setAttribute("value", '');
            $prop_value = $Collection->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("rlt_class", '');
              $prop_value->setAttribute("prop_name", 'ID_Building');
              $prop_value->setAttribute("value", '15');
            $prop_value = $Collection->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Amount');
              $prop_value->setAttribute("value", '212');
            $prop_value = $Collection->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("rlt_class", '');
              $prop_value->setAttribute("prop_name", 'ID_TypeOfAuditorium');
              $prop_value->setAttribute("value", '1');
            $prop_value = $Collection->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Square');
              $prop_value->setAttribute("value", '100');
            $prop_value = $Collection->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Equipment');
              $prop_value->setAttribute("value", '1');
            $prop_value = $Collection->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'TableType');
              $prop_value->setAttribute("value", '1');
            $prop_value = $Collection->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Darken');
              $prop_value->setAttribute("value", '1');
            $prop_value = $Collection->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Conditioner');
              $prop_value->setAttribute("value", '1');
            $prop_value = $Collection->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Height');
              $prop_value->setAttribute("value", '');
            $prop_value = $Collection->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Lenght');
              $prop_value->setAttribute("value", '');
            $prop_value = $Collection->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Width');
              $prop_value->setAttribute("value", '');
            $prop_value = $Collection->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'ComputerEquipment');
              $prop_value->setAttribute("value", '');
            $prop_value = $Collection->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'MediaFuture');
              $prop_value->setAttribute("value", '');
            $prop_value = $Collection->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'ComputerAmount');
              $prop_value->setAttribute("value", '');
            $prop_value = $Collection->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'MonitorDiagonal');
              $prop_value->setAttribute("value", '');
            $prop_value = $Collection->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Overlay');
              $prop_value->setAttribute("value", '');
            $prop_value = $Collection->appendChild($dom->createElement('prop_value'));
              $prop_value->setAttribute("prop_name", 'Note');
              $prop_value->setAttribute("value", '');

  $dom->formatOutput = true;
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
  $dom->save("users1.xml"); // Сохраняем полученный XML-документ в файл
?>
