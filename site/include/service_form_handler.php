<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>
<?
	//include_once ($_SERVER["DOCUMENT_ROOT"].'/lib/config.php');
	//include_once ($_SERVER["DOCUMENT_ROOT"].'/lib/ext.class.php');
?>
<?if($_REQUEST["phrase"] == 'megasecret'):?>
<?//d($_REQUEST);?>
<?
	$headers = "Content-type: text/html; charset = \"utf-8\"";

	$name = htmlspecialchars($_REQUEST["name"], ENT_QUOTES);
	$phone = htmlspecialchars($_REQUEST["phone"], ENT_QUOTES);
	$service_name = htmlspecialchars($_REQUEST["service_name"], ENT_QUOTES);
	$email = htmlspecialchars($_REQUEST["service_email"], ENT_QUOTES);
	
	
	unset($_REQUEST["name"]);
	unset($_REQUEST["phone"]);
	unset($_REQUEST["service_name"]);
	unset($_REQUEST["phrase"]);
	unset($_REQUEST["service_email"]);

	$mess='';
	$text_mess='';
	$arr = array();
	$c=0;

	foreach($_REQUEST as $k => $arRow) {
		if($c%2 == 0) {
			$mess .= $arRow.': ';
			$text_mess .= $arRow.': ';
		} else {
			$mess .= $arRow;
			$text_mess .= $arRow.'<br>';
			$arr[] = $mess;
			$mess='';
		}
		$c++;
	}
	//d($mess);
	//d($arr);
	
	//$to=COption::GetOptionString("main","email_from");
	//$to = "spam42@yandex.ru";
	$to = $email;
	$subject = "Заявка с сайта bobrovylog.ru";

	CModule::IncludeModule('iblock'); 
	$el = new CIBlockElement;
	$PROP = array();
	$PROP[69] = $name;
	$PROP[70] = $phone;
	$PROP[71] = $service_name;
	$PROP[72] = $arr;
	
	$arLoadProductArray = Array(
	  "MODIFIED_BY"    => $USER->GetID(),
	  "IBLOCK_SECTION_ID" => false,
	  "IBLOCK_ID"      => 11,
	  "PROPERTY_VALUES"=> $PROP,
	  "NAME"           => "Заявка ".$service_name.' '.date("m.d.y H:i:s"),
	  "ACTIVE"         => "Y"
	);
	
	if($PRODUCT_ID = $el->Add($arLoadProductArray))
	  echo "New ID: ".$PRODUCT_ID.'<br>';
	else
	  echo "Error: ".$el->LAST_ERROR;

	
/*
	$message = 'Имя: '.$name;
	$message .= '<br>Телефон: '.$phone;
	$message .= '<br>Услуга: '.$service_name;
	$message .= '<br>'.$text_mess;
*/



	//отправляем письмо через событие
	$arEventFields = array(
    "NAME"                  => $name,
    "MESS"             => $text_mess,
    "PHONE"            => $phone,
    "SERVICE"         => $service_name,
    "TO"         => $email,
    "DATE"						=> date("m.d.y H:i:s")
    );

	CEvent::Send("MX_SERVICE_FORM", "s1", $arEventFields);

/*
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