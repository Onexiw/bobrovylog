<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
function dd($str) {
	echo "<pre>";
	print_r($str);
	echo "</pre>";
}
?>
<?
/*
file_put_contents("./log.txt", "print_r HTTP_RAW_POST_DATA:\n",FILE_APPEND);
file_put_contents("./log.txt", print_r($HTTP_RAW_POST_DATA, true),FILE_APPEND);

file_put_contents("./log.txt", "HTTP_RAW_POST_DATA:\n",FILE_APPEND);
file_put_contents("./log.txt", $HTTP_RAW_POST_DATA,FILE_APPEND);

file_put_contents("./log.txt", "print_r _POST:\n",FILE_APPEND);
file_put_contents("./log.txt", print_r($_POST, true),FILE_APPEND);

file_put_contents("./log.txt", "print_r _FILES:\n",FILE_APPEND);
file_put_contents("./log.txt", print_r($_FILES, true),FILE_APPEND);

file_put_contents("./log.txt", "print_r _GET:\n",FILE_APPEND);
file_put_contents("./log.txt", print_r($_GET, true),FILE_APPEND);

file_put_contents("./log.txt", "print_r _REQUEST:\n",FILE_APPEND);
file_put_contents("./log.txt", print_r($_REQUEST, true),FILE_APPEND);
*/

//file_put_contents("./log.txt", "php://input:\n",FILE_APPEND);
//file_put_contents("./log.txt", file_get_contents('php://input'),FILE_APPEND);

//вот тут получаем POST запрос с JSON
$file = file_get_contents('php://input');

//тестовый джсон
$file="[{'SRC_SYS': '1001', 'TYPE': 'timeresult', 'FirstName': 'Aleksey', 'LastName': 'Petrov', 'counrty': 'rus', 'BIB': '123', 'TOKEN': '12345', 'rank': '2', 'gap': '+2:01.1', 'inter': 'finish', 'time': '10:01.45'}, {'SRC_SYS': '1001', 'TYPE': 'timeresult', 'FirstName': 'Oleg', 'LastName': 'Sidorov', 'counrty': 'rus', 'BIB': '125', 'TOKEN': '12345', 'rank': '2', 'gap': '+1:22.2', 'inter': 'finish', 'time': '10:01.45'}]";

$request = json_decode($file, true);

d($request);


/*
file_put_contents("./log.txt", "HTTP_POST_VARS:\n",FILE_APPEND);
file_put_contents("./log.txt", $HTTP_POST_VARS,FILE_APPEND);

file_put_contents("./log.txt", "HTTP_POST_FILES:\n",FILE_APPEND);
file_put_contents("./log.txt", $HTTP_POST_FILES,FILE_APPEND);
*/


CModule::IncludeModule('highloadblock'); // подключаем модуль HL блоков

$hlblock_id = 1; // ID вашего Highload-блока
$hlblock   = Bitrix\Highloadblock\HighloadBlockTable::getById( $hlblock_id )->fetch(); // получаем объект вашего HL блока
$entity   = Bitrix\Highloadblock\HighloadBlockTable::compileEntity( $hlblock );  // получаем рабочую сущность
$entity_data_class = $entity->getDataClass(); // получаем экземпляр класса
$entity_table_name = $hlblock['sportsman']; // присваиваем переменной название HL таблицы
$sTableID = 'tbl_'.$entity_table_name; // добавляем префикс и окончательно формируем название

//добавим запись
/*
$arData = Array(
                'UF_FIRSTNAME' => $request["firstname"],
                'UF_LASTNAME' => $request["Lastname"],
                'UF_BIB' => $request["Bib"],
                'UF_COUNTRY' => $request["Country"]
            );
$result = $entity_data_class::add($arData);
 
if ($result->isSuccess()) {
  echo 'ID: ' . $result->getId() . "<br />";
} else {
  echo 'ERROR: ' . implode(', ', $result->getErrors()) . "<br />";
}
*/

?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>