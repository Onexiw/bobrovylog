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
	//тестовый  POST
$_POST["json_object"] = "[
{SRC_SYS=run-lite
TYPE=startlist
TOKEN=KDSF(9jfdhj;!
firstname=Алексей 
Lastname=александров
Bib=111
Country=rus},
{SRC_SYS=run-lite
TYPE=startlist
TOKEN=KDSF(9jfdhj;!
firstname=Егор 
Lastname=Летов
Bib=112
Country=rus}
]";
*/

//принимаем POST запрос
$input = json_decode(file_get_contents("php://input"), true);

//
$file = fopen($_SERVER["DOCUMENT_ROOT"]."/table/saved_post.php", "a");
$new_file = $input;

$test1 = fwrite($file, $new_file); // Запись в файл

fclose($file);




//читаем результат из файла и выводим дамп
$result = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/table/saved_post.php");
dd($result);
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>