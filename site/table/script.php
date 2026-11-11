<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
function dd($str) {
	echo "<pre>";
	print_r($str);
	echo "</pre>";
}
?>
<?

$IBLOCK_ID = 21; //ID инфоблока с таблицей соревнований
$COMPETITION_ID = 1508; //ID ЭЛЕМЕНТА инфоблока с таблицей соревнований. Это отдельное соревнование.

	

CModule::IncludeModule('highloadblock'); // подключаем модуль HL блоков
CModule::IncludeModule('iblock'); // подключаем модуль HL блоков

$hlblock_id = 1; // ID вашего Highload-блока
$hlblock   = Bitrix\Highloadblock\HighloadBlockTable::getById( $hlblock_id )->fetch(); // получаем объект вашего HL блока
$entity   = Bitrix\Highloadblock\HighloadBlockTable::compileEntity( $hlblock );  // получаем рабочую сущность
$entity_data_class = $entity->getDataClass(); // получаем экземпляр класса
$entity_table_name = $hlblock['sportsman']; // присваиваем переменной название HL таблицы
$sTableID = 'tbl_'.$entity_table_name; // добавляем префикс и окончательно формируем название





//вот тут получаем POST запрос с JSON
$file = file_get_contents('php://input');

//тестовый джсон (перебивает POST)
$file='[{"SRC_SYS": "1001", "TYPE": "timeresult", "FirstName": "Aleksey", "LastName": "Petrov", "counrty": "rus", "BIB": "8123", "TOKEN": "12345", "rank": "5", "gap": "+2:01.1", "inter": "finish", "time": "10:01.45"}, {"SRC_SYS": "1001", "TYPE": "timeresult", "FirstName": "Oleg", "LastName": "Sidorov", "counrty": "rus", "BIB": "8225", "TOKEN": "12345", "rank": "21", "gap": "+1:22.2", "inter": "finish", "time": "10:01.45"}]';

$request = json_decode($file, true);
//echo $request;

//d($file);
d($request);




foreach($request as $r => $arRec) {
	
		switch ($arRec["TYPE"]) {
		case "startlist":
			
			echo "Стартлист<br>";
			
		    $arFilter = array("UF_BIB" => $arRec["BIB"]); // зададим фильтр по ID пользователя
				$arSelect = array('*'); // выбираем все поля
				$arOrder = array(); // сортировка будет по возрастанию ID статей
				 
				// подготавливаем данные
				$rsData = $entity_data_class::getList(array(
				    "select" => $arSelect,
				    "filter" => $arFilter,
				    "limit" => '999', //ограничим выборку 999 элементами
				    "order" => $arOrder
				));
				 
				// выполняем запрос. Передаем в него наши данные и название таблицы, которое мы получили в самом начале
				$rsData = new CDBResult($rsData, $sTableID); // записываем в переменную объект CDBResult
				 
				// а далее простой цикл и знакомый нам метод Fetch (или GetNext, кому что нравится)
				while($arRes = $rsData->Fetch()){
				  //print_r($arRes);
				  $exist = 1;
				  $sport_id = $arRes["ID"];
				}
				
				if($exist == 1) {//если BIB уже есть, то делаем апдейт записи
					
						echo "Апдейт Стартлист<br>";
												
						$arNewData = array(
							'UF_FIRSTNAME' => $arRec["FirstName"],
							'UF_LASTNAME' => $arRec["LastName"],
							'UF_BIB' => $arRec["BIB"],
	            'UF_OLDBIB' => $arRec["OLDBIB"],
							'UF_RANK' => $arRec["rank"],
							'UF_GAP' => $arRec["gap"],
							'UF_INTER' => $arRec["inter"],
							'UF_TIME' => $arRec["time"],
							'UF_COUNTRY' => $arRec["counrty"],					
						);
						$entity_data_class::update($sport_id, $arNewData);
				} else {//если BIB новый, то делаем новую запись
					
						echo "Новый Стартлист<br>";
					
						$xmlId = $arRec["FirstName"].'_'.$arRec["LastName"].'_'.$COMPETITION_ID;
					
						$res = CIBlockElement::GetProperty($IBLOCK_ID, $COMPETITION_ID, "sort", "asc", array("CODE" => "MAN"));
				    while ($ob = $res->GetNext())
				    {
				        $VALUES[] = $ob['VALUE'];
				    }
				    
				    if(!in_array($xmlId, $VALUES)) {
					    $VALUES[] = $xmlId;
					  }
					
						//добавим запись
						$arData = Array(
	            'UF_XML_ID' => $xmlId,
	            'UF_FIRSTNAME' => $arRec["FirstName"],
	            'UF_LASTNAME' => $arRec["LastName"],
	            'UF_BIB' => $arRec["BIB"],
	            'UF_OLDBIB' => $arRec["OLDBIB"],
	            'UF_RANK' => $arRec["rank"],
	            'UF_GAP' => $arRec["gap"],
	            'UF_INTER' => $arRec["inter"],
	            'UF_TIME' => $arRec["time"],
	            'UF_COUNTRY' => $arRec["counrty"],
		        );
						$result = $entity_data_class::add($arData);
						
						if ($result->isSuccess()) {
						echo 'ID: ' . $result->getId() . "<br />";
						
						//и добавим привязку к соревнованию
							CIBlockElement::SetPropertyValuesEx(
							    $COMPETITION_ID,
							    $IBLOCK_ID,
							    array('MAN' => Array($VALUES))
							);
						//Закончили  добавим привязку к соревнованию
						
						} else {
						echo 'ERROR: ' . implode(', ', $result->getErrors()) . "<br />";
						}
						
						
						
						
						
				}

		    break;
		    
		    
		    
		    
		    
		    
		    
		case "bibchange":
			echo "Смена номера<br>";
				$arFilter = array("UF_BIB" => $arRec["BIB"]); // зададим фильтр по ID пользователя
				$arSelect = array('*'); // выбираем все поля
				$arOrder = array(); // сортировка будет по возрастанию ID статей
				 
				// подготавливаем данные
				$rsData = $entity_data_class::getList(array(
				    "select" => $arSelect,
				    "filter" => $arFilter,
				    "limit" => '999', //ограничим выборку 999 элементами
				    "order" => $arOrder
				));
				 
				// выполняем запрос. Передаем в него наши данные и название таблицы, которое мы получили в самом начале
				$rsData = new CDBResult($rsData, $sTableID); // записываем в переменную объект CDBResult
				 
				// а далее простой цикл и знакомый нам метод Fetch (или GetNext, кому что нравится)
				while($arRes = $rsData->Fetch()){
				  //print_r($arRes);
				  $exist = 1;
				  $sport_id = $arRes["ID"];
				}
			
				$arNewData = array(
					'UF_FIRSTNAME' => $arRec["FirstName"],
					'UF_LASTNAME' => $arRec["LastName"],
					'UF_BIB' => $arRec["BIB"],
          'UF_OLDBIB' => $arRec["OLDBIB"],
				);
				$entity_data_class::update($sport_id, $arNewData);
		    break;
		    
		    
		    
		    
		    
		    
		    
		case "timeresult":
				
								
			echo "Результат<br>";
			
		    $arFilter = array("UF_BIB" => $arRec["BIB"]); // зададим фильтр по ID пользователя
				$arSelect = array('*'); // выбираем все поля
				$arOrder = array(); // сортировка будет по возрастанию ID статей
				 
				// подготавливаем данные
				$rsData = $entity_data_class::getList(array(
				    "select" => $arSelect,
				    "filter" => $arFilter,
				    "limit" => '999', //ограничим выборку 999 элементами
				    "order" => $arOrder
				));
				 
				// выполняем запрос. Передаем в него наши данные и название таблицы, которое мы получили в самом начале
				$rsData = new CDBResult($rsData, $sTableID); // записываем в переменную объект CDBResult
				 
				// а далее простой цикл и знакомый нам метод Fetch (или GetNext, кому что нравится)
				while($arRes = $rsData->Fetch()){
				  //print_r($arRes);
				  $exist = 1;
				  $sport_id = $arRes["ID"];
				}
				
				if($exist == 1) {//если BIB уже есть, то делаем апдейт записи
					
						echo "Апдейт результат<br>";
												
						$arNewData = array(
							'UF_FIRSTNAME' => $arRec["FirstName"],
							'UF_LASTNAME' => $arRec["LastName"],
							'UF_BIB' => $arRec["BIB"],
	            'UF_OLDBIB' => $arRec["OLDBIB"],
							'UF_RANK' => $arRec["rank"],
							'UF_GAP' => $arRec["gap"],
							'UF_INTER' => $arRec["inter"],
							'UF_TIME' => $arRec["time"],
							'UF_COUNTRY' => $arRec["counrty"],					
						);
						$entity_data_class::update($sport_id, $arNewData);
				} else {//если BIB новый, то делаем новую запись
					
						echo "Новый результат и новый человек<br>";
					
						$xmlId = $arRec["FirstName"].'_'.$arRec["LastName"].'_'.$COMPETITION_ID;
					
						$res = CIBlockElement::GetProperty($IBLOCK_ID, $COMPETITION_ID, "sort", "asc", array("CODE" => "MAN"));
				    while ($ob = $res->GetNext())
				    {
				        $VALUES[] = $ob['VALUE'];
				    }
				    
				    if(!in_array($xmlId, $VALUES)) {
					    $VALUES[] = $xmlId;
					  }
				    d($VALUES);
				    
					
						//добавим запись
						$arData = Array(
	            'UF_XML_ID' => $xmlId,
	            'UF_FIRSTNAME' => $arRec["FirstName"],
	            'UF_LASTNAME' => $arRec["LastName"],
	            'UF_BIB' => $arRec["BIB"],
	            'UF_OLDBIB' => $arRec["OLDBIB"],
	            'UF_RANK' => $arRec["rank"],
	            'UF_GAP' => $arRec["gap"],
	            'UF_INTER' => $arRec["inter"],
	            'UF_TIME' => $arRec["time"],
	            'UF_COUNTRY' => $arRec["counrty"],
		        );
						$result = $entity_data_class::add($arData);
						
						if ($result->isSuccess()) {
						echo 'ID: ' . $result->getId() . "<br />";
						
						//и добавим привязку к соревнованию
							CIBlockElement::SetPropertyValuesEx(
							    $COMPETITION_ID,
							    $IBLOCK_ID,
							    array('MAN' => Array($VALUES))
							);
						//Закончили  добавим привязку к соревнованию
						
						} else {
						echo 'ERROR: ' . implode(', ', $result->getErrors()) . "<br />";
						}
						
						
						
						
						
				}

		    break;
		}
	
		
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>