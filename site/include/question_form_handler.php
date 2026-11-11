<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
	//include_once ($_SERVER["DOCUMENT_ROOT"].'/lib/config.php');
	//include_once ($_SERVER["DOCUMENT_ROOT"].'/lib/ext.class.php');
?>
<?if($_REQUEST["phrase"] == 'megasecret' && $_REQUEST["hash"] == md5($_SERVER['REMOTE_ADDR'].$_SERVER['HTTP_USER_AGENT'].intval(time()/20000)) ):?>
<?//d($_REQUEST);?>
<?
	$headers = "Content-type: text/html; charset = \"utf-8\"";

	$name = htmlspecialchars($_REQUEST["name"], ENT_QUOTES);
	$question = htmlspecialchars($_REQUEST["question"], ENT_QUOTES);
	$phone = htmlspecialchars($_REQUEST["phone"], ENT_QUOTES);
	$email = htmlspecialchars($_REQUEST["email"], ENT_QUOTES);
	
	//$to=COption::GetOptionString("main","email_from");
	//$to = "spam42@yandex.ru";
	//$subject = "Вопрос с сайта bobrovylog.ru (из раздела вопрос-ответ)";

	CModule::IncludeModule('iblock'); 
	$el = new CIBlockElement;
	$PROP = array();
	$PROP[83] = $name;
	$PROP[84] = $question;
	$PROP[99] = $phone;
	$PROP[100] = $email;
	

	$params = Array(
     "max_len" => "100", // обрезает символьный код до 100 символов
     "change_case" => "L", // буквы преобразуются к нижнему регистру
     "replace_space" => "_", // меняем пробелы на нижнее подчеркивание
     "replace_other" => "_", // меняем левые символы на нижнее подчеркивание
     "delete_repeat_replace" => "true", // удаляем повторяющиеся нижние подчеркивания
     "use_google" => "false", // отключаем использование google
  ); 
  
	
	$arLoadProductArray = Array(
	  "MODIFIED_BY"    => $USER->GetID(),
	  "IBLOCK_SECTION_ID" => false,
	  "IBLOCK_ID"      => 13,
	  "PROPERTY_VALUES"=> $PROP,
	  "NAME"           => "Вопрос ".date("m.d.y H:i:s"),
	  "ACTIVE"         => "Y",
		"CODE" => CUtil::translit("Вопрос ".date("m.d.y H:i:s"), "ru" , $params)
	);
	
	if($PRODUCT_ID = $el->Add($arLoadProductArray))
	  echo "New ID: ".$PRODUCT_ID.'<br>';
	else
	  echo "Error: ".$el->LAST_ERROR;

	
	//отправляем письмо через событие
	$arEventFields = array(
    "NAME"                  => $name,
    "EMAIL"             => $email,
    "PHONE"            => $phone,
    "QUESTION"         => $question
    );

	CEvent::Send("MX_QNA_FORM", "s1", $arEventFields);



/*
	$message = 'Имя: '.$name;
	$message .= '<br>Вопрос: '.$question;
	$message .= '<br>Телефон: '.$phone;
	$message .= '<br>E-mail: '.$email;

	$mailer = new FreakMailer();
	$mailer->Subject = $subject;
	$mailer->Body = $message;
	$mailer->isHTML(true);
	$mailer->AltBody = strip_tags($message);
	$to = explode(',',$to);
	for ($k=0; $k<count($to);$k++) {
	  $mailer->AddAddress($to[$k],$to[$k]);
	}
				
	if($mailer->Send()) {
		echo "Заявка отправлена!<br>";
	} else {
		echo "Заявка не отправлена! Повторите попытку!";
	}
*/

?>
<?endif?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>