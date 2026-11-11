<?
include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/wsrubi.smtp/classes/general/wsrubismtp.php");

function d($str) {
	global $USER;
	if ($USER->IsAdmin()) {
		echo "<pre>";
		print_r($str);
		echo "</pre>";
	}
}

define("LOG_FILENAME", dirname($_SERVER["DOCUMENT_ROOT"])."/logs/mx_log.txt");

//перебираем все объекты на карте и перегенерим файлы json при добавлении или изменении объектов в инфоблоке "Объекты на карте"
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "OnAfterIBlockElementUpdateHandler");
AddEventHandler("iblock", "OnAfterIBlockElementAdd", "OnAfterIBlockElementUpdateHandler");

function OnAfterIBlockElementUpdateHandler(&$arFields) { 
  if(!$arFields["RESULT"]) return false; 
  if($arFields['IBLOCK_ID'] == 8) { //инфоблок Объекты на карте 
		
		
		if (CModule::IncludeModule('iblock')) {

			///////////////////// ЛЕТО ///////////////////////
			/********************* ЛЕТО РУССКИЙ ЯЗЫК ********/
				$fp = fopen("../../karta/map-data-leto.json", "w"); //открыли файл и удалили все внутри
				fclose($fp); //закрыли файл
				
				$fp = fopen("../../karta/map-data-leto.json", "a"); // Открываем файл в режиме записи и передвигаем курсор в конец
				$mytext = '{
				"mapwidth":"1920",
				"mapheight":"1920",
				"categories":[],
				"levels":[
					{
						"id":"landmarks-leto",
						"title":"Летняя карта",
						"map":"/karta/map-leto.svg",
						"locations":[
				'; // добавим шапку
				$test = fwrite($fp, $mytext); // Запись в файл
				fclose($fp); //Закрытие файла
			
			
			$des = '';
			$counter = 0;
			$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*","DETAIL_TEXT","IBLOCK_SECTION_ID");
			$arFilter = Array("IBLOCK_ID"=>IntVal(8), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","IBLOCK_SECTION_ID"=>7);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while($ob = $res->GetNextElement()){ 
				$arFields = $ob->GetFields();  
				$arProps = $ob->GetProperties();	
				
				$sec = CIBlockSection::GetByID($arFields["IBLOCK_SECTION_ID"]);
				if($ar_res = $sec->GetNext()) {
				  $razdel = $ar_res['NAME'];
				}
				
				$name = $arFields["NAME"];
				$id = $arProps["CLASS"]["VALUE"];
				$X = $arProps["X"]["VALUE"];
				$Y = $arProps["Y"]["VALUE"];
				$services = array();
				$des = '';

							$txt1 = str_replace("\"","'",$arFields['~DETAIL_TEXT']);
/*
							$txt1 = str_replace("<br>", '\n',$txt1);
							$txt1 = str_replace("\n", '',$txt1);
							$txt1 = str_replace("\r", '',$txt1);
*/
							if($arFields["DETAIL_TEXT"] != '') {
								$des .= "<div class='map_bubble__list__description'>".$txt1."</div>";
							}

				 
				foreach($arProps["SERVICES"]["VALUE"] as $arSrv) {
			
						$arrSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_TEXT","PROPERTY_*");
						$arrFilter = Array("IBLOCK_ID"=>IntVal(7), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","ID"=>$arSrv);
						$rres = CIBlockElement::GetList(Array(), $arrFilter, false, false, $arrSelect);
						while($rob = $rres->GetNextElement()){ 
							$arrFields = $rob->GetFields();  
							$arrProps = $rob->GetProperties();
							
							$txt = str_replace("\"","'",$arrFields['~DETAIL_TEXT']);
/*
							$txt = str_replace("<br>", '\n',$txt);
							$txt = str_replace("\n", '',$txt);
							$txt = str_replace("\r", '',$txt);
*/
							
							
							$des .= "<div class='map_bubble__list__item'><div class='map_bubble__list__item__icon'><img src='".CFile::GetPath($arrProps['ICON']['VALUE'])."' class='map_bubble__list__item__icon__img'></div><div class='map_bubble__list__item__text'>".$txt."</div></div>";
							
							//$services[$arrFields["ID"]]["ID"] = $arrFields["ID"];
							//$services[$arrFields["ID"]]["ICON"] = CFile::GetPath($arrProps["ICON"]["VALUE"]);
							//$services[$arrFields["ID"]]["TEXT"] = $arrFields["~DETAIL_TEXT"];
							
						}
						
				}//endforeach				
				
				
				if($counter != 0) {
					$fp = fopen("../../karta/map-data-leto.json", "a"); // Открываем файл в режиме записи 
					$mytext = ','; // добавим зарятую
					$test = fwrite($fp, $mytext); // Запись в файл
					fclose($fp); //Закрытие файла
				}
			
				
				$fp = fopen("../../karta/map-data-leto.json", "a"); // Открываем файл в режиме записи 
				$mytext = '
				{
						"id": "'.$id.'",
						"title": "'.$name.'",
						"description": "'.$des.'",
						"pin": "hidden",
						"x": "'.$X.'",
						"y": "'.$Y.'"
					}'; // добавим объект
				$test = fwrite($fp, $mytext); // Запись в файл
				fclose($fp); //Закрытие файла
				
				$counter++;
			}
						
			$fp = fopen("../../karta/map-data-leto.json", "a"); // Открываем файл в режиме записи и передвигаем курсор в конец
			$mytext = '
						]
					}
				]
			}
			'; // добавим футер
			$test = fwrite($fp, $mytext); // Запись в файл
			fclose($fp); //Закрытие файла



/********************* ЛЕТО english********/
				$fp = fopen("../../karta/map-data-leto-eng.json", "w"); //открыли файл и удалили все внутри
				fclose($fp); //закрыли файл
				
				$fp = fopen("../../karta/map-data-leto-eng.json", "a"); // Открываем файл в режиме записи и передвигаем курсор в конец
				$mytext = '{
				"mapwidth":"1920",
				"mapheight":"1920",
				"categories":[],
				"levels":[
					{
						"id":"landmarks-leto",
						"title":"Summer map",
						"map":"/karta/map-leto_en.svg",
						"locations":[
				'; // добавим шапку
				$test = fwrite($fp, $mytext); // Запись в файл
				fclose($fp); //Закрытие файла
			
			
			$des = '';
			$counter = 0;
			$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*","DETAIL_TEXT","IBLOCK_SECTION_ID");
			$arFilter = Array("IBLOCK_ID"=>IntVal(8), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","IBLOCK_SECTION_ID"=>7);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while($ob = $res->GetNextElement()){ 
				$arFields = $ob->GetFields();  
				$arProps = $ob->GetProperties();	
				
				$sec = CIBlockSection::GetByID($arFields["IBLOCK_SECTION_ID"]);
				if($ar_res = $sec->GetNext()) {
				  $razdel = $ar_res['DESCRIPTION'];
				}
				
				$name = $arProps["NAME_ENG"]["VALUE"];
				$id = $arProps["CLASS"]["VALUE"];
				$X = $arProps["X"]["VALUE"];
				$Y = $arProps["Y"]["VALUE"];
				$services = array();
				$des = '';

							$txt1 = str_replace("\"","'",$arProps["TEXT_ENG"]["~VALUE"]["TEXT"]);
/*
							$txt1 = str_replace("<br>", '\n',$txt1);
							$txt1 = str_replace("\n", '',$txt1);
							$txt1 = str_replace("\r", '',$txt1);
*/
							if($arProps["TEXT_ENG"]["~VALUE"]["TEXT"] != '') {
								$des .= "<div class='map_bubble__list__description'>".$txt1."</div>";
							}

				 
				foreach($arProps["SERVICES"]["VALUE"] as $arSrv) {
			
						$arrSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_TEXT","PROPERTY_*");
						$arrFilter = Array("IBLOCK_ID"=>IntVal(7), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","ID"=>$arSrv);
						$rres = CIBlockElement::GetList(Array(), $arrFilter, false, false, $arrSelect);
						while($rob = $rres->GetNextElement()){ 
							$arrFields = $rob->GetFields();  
							$arrProps = $rob->GetProperties();
							
							$txt = str_replace("\"","'",$arrFields['~DETAIL_TEXT']);
/*
							$txt = str_replace("<br>", '\n',$txt);
							$txt = str_replace("\n", '',$txt);
							$txt = str_replace("\r", '',$txt);
*/
							
							
							$des .= "<div class='map_bubble__list__item'><div class='map_bubble__list__item__icon'><img src='".CFile::GetPath($arrProps['ICON']['VALUE'])."' class='map_bubble__list__item__icon__img'></div><div class='map_bubble__list__item__text'>".$txt."</div></div>";
							
							//$services[$arrFields["ID"]]["ID"] = $arrFields["ID"];
							//$services[$arrFields["ID"]]["ICON"] = CFile::GetPath($arrProps["ICON"]["VALUE"]);
							//$services[$arrFields["ID"]]["TEXT"] = $arrFields["~DETAIL_TEXT"];
							
						}
						
				}//endforeach				
				
				
				if($counter != 0) {
					$fp = fopen("../../karta/map-data-leto-eng.json", "a"); // Открываем файл в режиме записи 
					$mytext = ','; // добавим зарятую
					$test = fwrite($fp, $mytext); // Запись в файл
					fclose($fp); //Закрытие файла
				}
			
				
				$fp = fopen("../../karta/map-data-leto-eng.json", "a"); // Открываем файл в режиме записи 
				$mytext = '
				{
						"id": "'.$id.'",
						"title": "'.$name.'",
						"description": "'.$des.'",
						"pin": "hidden",
						"x": "'.$X.'",
						"y": "'.$Y.'"
					}'; // добавим объект
				$test = fwrite($fp, $mytext); // Запись в файл
				fclose($fp); //Закрытие файла
				
				$counter++;
			}
						
			$fp = fopen("../../karta/map-data-leto-eng.json", "a"); // Открываем файл в режиме записи и передвигаем курсор в конец
			$mytext = '
						]
					}
				]
			}
			'; // добавим футер
			$test = fwrite($fp, $mytext); // Запись в файл
			fclose($fp); //Закрытие файла
			
			
			
///////////////////// далее ЗИМА ///////////////////////
			
/************** ЗИМА РУССКИЙ ***************/			
				$fp = fopen("../../karta/map-data-zima.json", "w"); //открыли файл и удалили все внутри
				fclose($fp); //закрыли файл
				
				$fp = fopen("../../karta/map-data-zima.json", "a"); // Открываем файл в режиме записи и передвигаем курсор в конец
				$mytext = '{
				"mapwidth":"1920",
				"mapheight":"1920",
				"categories":[],
				"levels":[
					{
						"id":"landmarks-zima",
						"title":"Зимняя карта",
						"map":"/karta/map-zima.svg",
						"locations":[
				'; // добавим шапку
				$test = fwrite($fp, $mytext); // Запись в файл
				fclose($fp); //Закрытие файла
			
			
								
			$des = '';
			$counter = 0;
			$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*","DETAIL_TEXT","IBLOCK_SECTION_ID");
			$arFilter = Array("IBLOCK_ID"=>IntVal(8), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","IBLOCK_SECTION_ID"=>6);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while($ob = $res->GetNextElement()){ 
				$arFields = $ob->GetFields();  
				$arProps = $ob->GetProperties();	
				
				$sec = CIBlockSection::GetByID($arFields["IBLOCK_SECTION_ID"]);
				if($ar_res = $sec->GetNext()) {
				  $razdel = $ar_res['NAME'];
				}
				
				$name = $arFields["NAME"];
				$id = $arProps["CLASS"]["VALUE"];
				$X = $arProps["X"]["VALUE"];
				$Y = $arProps["Y"]["VALUE"];
				$services = array();
				$des = '';

							$txt1 = str_replace("\"","'",$arFields['~DETAIL_TEXT']);
/*
							$txt1 = str_replace("<br>", '\n',$txt1);
							$txt1 = str_replace("\n", '',$txt1);
							$txt1 = str_replace("\r", '',$txt1);
*/
							if($arFields["DETAIL_TEXT"] != '') {
								$des .= "<div class='map_bubble__list__description'>".$txt1."</div>";
							}

				 
				foreach($arProps["SERVICES"]["VALUE"] as $arSrv) {
			
						$arrSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_TEXT","PROPERTY_*");
						$arrFilter = Array("IBLOCK_ID"=>IntVal(7), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","ID"=>$arSrv);
						$rres = CIBlockElement::GetList(Array(), $arrFilter, false, false, $arrSelect);
						while($rob = $rres->GetNextElement()){ 
							$arrFields = $rob->GetFields();  
							$arrProps = $rob->GetProperties();
							
							$txt = str_replace("\"","'",$arrFields['~DETAIL_TEXT']);
/*
							$txt = str_replace("<br>", '\n',$txt);
							$txt = str_replace("\n", '',$txt);
							$txt = str_replace("\r", '',$txt);
*/
							
							
							$des .= "<div class='map_bubble__list__item'><div class='map_bubble__list__item__icon'><img src='".CFile::GetPath($arrProps['ICON']['VALUE'])."' class='map_bubble__list__item__icon__img'></div><div class='map_bubble__list__item__text'>".$txt."</div></div>";
							
							//$services[$arrFields["ID"]]["ID"] = $arrFields["ID"];
							//$services[$arrFields["ID"]]["ICON"] = CFile::GetPath($arrProps["ICON"]["VALUE"]);
							//$services[$arrFields["ID"]]["TEXT"] = $arrFields["~DETAIL_TEXT"];
							
						}
						
				}//endforeach
				
				
				
				if($counter != 0) {
					$fp = fopen("../../karta/map-data-zima.json", "a"); // Открываем файл в режиме записи 
					$mytext = ','; // добавим зарятую
					$test = fwrite($fp, $mytext); // Запись в файл
					fclose($fp); //Закрытие файла
				}
			
				
				$fp = fopen("../../karta/map-data-zima.json", "a"); // Открываем файл в режиме записи 
				$mytext = '
				{
						"id": "'.$id.'",
						"title": "'.$name.'",
						"description": "'.$des.'",
						"pin": "hidden",
						"x": "'.$X.'",
						"y": "'.$Y.'"
					}'; // добавим объект
				$test = fwrite($fp, $mytext); // Запись в файл
				fclose($fp); //Закрытие файла
				
				$counter++;
			}

			$fp = fopen("../../karta/map-data-zima.json", "a"); // Открываем файл в режиме записи и передвигаем курсор в конец
			$mytext = '
						]
					}
				]
			}
			'; // добавим футер
			$test = fwrite($fp, $mytext); // Запись в файл
			fclose($fp); //Закрытие файла
		
		
		
/************** ЗИМА ENG ***************/			
				$fp = fopen("../../karta/map-data-zima-eng.json", "w"); //открыли файл и удалили все внутри
				fclose($fp); //закрыли файл
				
				$fp = fopen("../../karta/map-data-zima-eng.json", "a"); // Открываем файл в режиме записи и передвигаем курсор в конец
				$mytext = '{
				"mapwidth":"1920",
				"mapheight":"1920",
				"categories":[],
				"levels":[
					{
						"id":"landmarks-zima",
						"title":"Winter map",
						"map":"/karta/map-zima_en.svg",
						"locations":[
				'; // добавим шапку
				$test = fwrite($fp, $mytext); // Запись в файл
				fclose($fp); //Закрытие файла
			
			
								
			$des = '';
			$counter = 0;
			$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_*","DETAIL_TEXT","IBLOCK_SECTION_ID");
			$arFilter = Array("IBLOCK_ID"=>IntVal(8), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","IBLOCK_SECTION_ID"=>6);
			$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
			while($ob = $res->GetNextElement()){ 
				$arFields = $ob->GetFields();  
				$arProps = $ob->GetProperties();	
				
				$sec = CIBlockSection::GetByID($arFields["IBLOCK_SECTION_ID"]);
				if($ar_res = $sec->GetNext()) {
				  $razdel = $ar_res['DESCRIPTION'];
				}
				
				$name = $arProps["NAME_ENG"]["VALUE"];
				$id = $arProps["CLASS"]["VALUE"];
				$X = $arProps["X"]["VALUE"];
				$Y = $arProps["Y"]["VALUE"];
				$services = array();
				$des = '';

							$txt1 = str_replace("\"","'",$arProps["TEXT_ENG"]["~VALUE"]["TEXT"]);
/*
							$txt1 = str_replace("<br>", '\n',$txt1);
							$txt1 = str_replace("\n", '',$txt1);
							$txt1 = str_replace("\r", '',$txt1);
*/
							if($arProps["TEXT_ENG"]["~VALUE"]["TEXT"] != '') {
								$des .= "<div class='map_bubble__list__description'>".$txt1."</div>";
							}

				 
				foreach($arProps["SERVICES"]["VALUE"] as $arSrv) {
			
						$arrSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_TEXT","PROPERTY_*");
						$arrFilter = Array("IBLOCK_ID"=>IntVal(7), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y","ID"=>$arSrv);
						$rres = CIBlockElement::GetList(Array(), $arrFilter, false, false, $arrSelect);
						while($rob = $rres->GetNextElement()){ 
							$arrFields = $rob->GetFields();  
							$arrProps = $rob->GetProperties();
							
							$txt = str_replace("\"","'",$arrFields['~DETAIL_TEXT']);
/*
							$txt = str_replace("<br>", '\n',$txt);
							$txt = str_replace("\n", '',$txt);
							$txt = str_replace("\r", '',$txt);
*/
							
							
							$des .= "<div class='map_bubble__list__item'><div class='map_bubble__list__item__icon'><img src='".CFile::GetPath($arrProps['ICON']['VALUE'])."' class='map_bubble__list__item__icon__img'></div><div class='map_bubble__list__item__text'>".$txt."</div></div>";
							
							//$services[$arrFields["ID"]]["ID"] = $arrFields["ID"];
							//$services[$arrFields["ID"]]["ICON"] = CFile::GetPath($arrProps["ICON"]["VALUE"]);
							//$services[$arrFields["ID"]]["TEXT"] = $arrFields["~DETAIL_TEXT"];
							
						}
						
				}//endforeach
				
				
				
				if($counter != 0) {
					$fp = fopen("../../karta/map-data-zima-eng.json", "a"); // Открываем файл в режиме записи 
					$mytext = ','; // добавим зарятую
					$test = fwrite($fp, $mytext); // Запись в файл
					fclose($fp); //Закрытие файла
				}
			
				
				$fp = fopen("../../karta/map-data-zima-eng.json", "a"); // Открываем файл в режиме записи 
				$mytext = '
				{
						"id": "'.$id.'",
						"title": "'.$name.'",
						"description": "'.$des.'",
						"pin": "hidden",
						"x": "'.$X.'",
						"y": "'.$Y.'"
					}'; // добавим объект
				$test = fwrite($fp, $mytext); // Запись в файл
				fclose($fp); //Закрытие файла
				
				$counter++;
			}

			$fp = fopen("../../karta/map-data-zima-eng.json", "a"); // Открываем файл в режиме записи и передвигаем курсор в конец
			$mytext = '
						]
					}
				]
			}
			'; // добавим футер
			$test = fwrite($fp, $mytext); // Запись в файл
			fclose($fp); //Закрытие файла
		}
			
	}
}
// конец обработки Объектов на карте





//при добавлении элемента в Расписание, смотрим поле SORT его родительской группы и проставляем этому элементу такую же сортировку
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "OnAfterIBlockElementUpdateHandlerRasp");
AddEventHandler("iblock", "OnAfterIBlockElementAdd", "OnAfterIBlockElementUpdateHandlerRasp");

function OnAfterIBlockElementUpdateHandlerRasp(&$arFields) { 
  if(!$arFields["RESULT"]) return false; 
  if($arFields['IBLOCK_ID'] == 10) { //инфоблок Расписание
		if (CModule::IncludeModule('iblock')) {
		 
			$ibsection = $arFields["IBLOCK_SECTION"];
			//AddMessage2Log(var_export($arFields,true));
				
			$ibres = CIBlockSection::GetByID($ibsection[0]);
			if($ar_ibres = $ibres->GetNext()) {
			  $ibsort = $ar_ibres['SORT'];
				//AddMessage2Log(var_export($ibsort,true));
			}

			if($ibsort != $arFields["SORT"]) {			
				$el = new CIBlockElement;
				$arLoadProductArray = Array(
		      "SORT" =>$ibsort,
				);
				$res = $el->Update($arFields["ID"], $arLoadProductArray);
			}
			
		}
	}
}



AddEventHandler("iblock", "OnBeforeIBlockSectionUpdate", Array("OnAfterIBlockSectionUpdateHandlerRasp", "OnBeforeIBlockSectionUpdateHandler"));

class OnAfterIBlockSectionUpdateHandlerRasp
{
    // создаем обработчик события "OnBeforeIBlockSectionUpdate"
    function OnBeforeIBlockSectionUpdateHandler(&$arFields)
    {
      //AddMessage2Log(var_export($arFields,true));
			$section_active = $arFields["ACTIVE"];


      //AddMessage2Log(var_export($arFields["ACTIVE"],true));
      //AddMessage2Log(var_export($arFields["ID"],true));

			if($section_active == "Y") {

						$arrSelect = Array("ID", "NAME", "ACTIVE");
						$arrFilter = Array("IBLOCK_ID"=>IntVal(10), "SECTION_ID" => $arFields["ID"]);
						$rres = CIBlockElement::GetList(Array(), $arrFilter, false, false, $arrSelect);
						while($rob = $rres->GetNextElement())
						{
						 $arrFields = $rob->GetFields();
						 
							$ell = new CIBlockElement;
							$arrLoadProductArray = Array(
					      "ACTIVE" => "Y",
							);
							$rrres = $ell->Update($arrFields["ID"], $arrLoadProductArray);

						}

			} else {
						$arrSelect = Array("ID", "NAME", "ACTIVE");
						$arrFilter = Array("IBLOCK_ID"=>IntVal(10), "SECTION_ID" => $arFields["ID"]);
						$rres = CIBlockElement::GetList(Array(), $arrFilter, false, false, $arrSelect);
						while($rob = $rres->GetNextElement())
						{
						 $arrFields = $rob->GetFields();
						 
							$ell = new CIBlockElement;
							$arrLoadProductArray = Array(
					      "ACTIVE" => "N",
							);
							$rrres = $ell->Update($arrFields["ID"], $arrLoadProductArray);

						}			
			}
    }
}


// делаем сортировку фото по имени-номеру при добавлении. Свойство "Фотографии (много)"
AddEventHandler("iblock", "OnAfterIBlockElementAdd", "SortUploadedPhoto");

function SortUploadedPhoto($arFields) {
  global $APPLICATION;
  CModule::IncludeModule('iblock');
		
	$morePhoto = CIBlockElement::GetProperty($arFields['IBLOCK_ID'],$arFields['ID'],'sort', 'asc',array('CODE'=>'PHOTOS')); 
	while ($phot = $morePhoto->GetNext()) {
		$mx_arFile = CFile::GetFileArray($phot["VALUE"]);		
		//AddMessage2Log(var_export($mx_arFile,true));
		$newMorePhoto[$mx_arFile["ORIGINAL_NAME"]] = $phot["VALUE"];
	}
	//AddMessage2Log(var_export($newMorePhoto,true));
	ksort($newMorePhoto);
	//AddMessage2Log(var_export($newMorePhoto,true));

	foreach($newMorePhoto as $p => $arUnit) {
		$rightPhoto[$p]["VALUE"] = $arUnit;
		$rightPhoto[$p]["DESCRIPTION"] = "";
	}

	//AddMessage2Log(var_export($rightPhoto,true));


	//записываем массив в новом порядке
/*
	CIBlockElement::SetPropertyValuesEx(
                        $arFields['ID'],
                        $arFields['IBLOCK_ID'],
                        array('PHOTOS' => $rightPhoto)
                    );
*/
}



// делаем ресайз фоток в Новости при добавлении или изменении. Свойство "Фотографии (много)"
AddEventHandler("iblock", "OnAfterIBlockElementAdd", "ResizeUploadedPhoto");
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "ResizeUploadedPhoto");

function ResizeUploadedPhoto($arFields) {
  global $APPLICATION;
  CModule::IncludeModule('iblock');
  $IBLOCK_ID = 4; // ID инфоблока свойство которых нуждается в масштабировании
  $PROPERTY_CODE = "PHOTOS";  // код свойства
  $imageMaxWidth = 1920; // Максимальная ширина картинки
  $imageMaxHeight = 1920; // Максимальная высота картинки
  // для начала убедимся, что изменяется элемент нужного нам инфоблока
  if($arFields["IBLOCK_ID"] == $IBLOCK_ID) {
	$VALUES = $VALUES_OLD = array();
	//Получаем свойство значение сво-ва $PROPERTY_CODE
	$res = CIBlockElement::GetProperty($arFields["IBLOCK_ID"], $arFields["ID"], "sort", "asc", array("CODE" => $PROPERTY_CODE));
	while ($ob = $res->GetNext()) {
		
//		$mx_arFile = CFile::GetFileArray($ob["VALUE"]);
//		$mx_key = $mx_arFile["ORIGINAL_NAME"];

//    AddMessage2Log(var_export($mx_arFile,true));
		
//	}
	
//	foreach(){
		$file_path = CFile::GetPath($ob['VALUE']); // Получаем путь к файлу
		if($file_path) {
			$imsize = getimagesize($_SERVER["DOCUMENT_ROOT"].$file_path); //Узнаём размер файла
			// Если размер больше установленного максимума
			if($imsize[0] > $imageMaxWidth or $imsize[1] > $imageMaxHeight) {
				// Уменьшаем размер картинки
				$file = CFile::ResizeImageGet($ob['VALUE'], array(
						'width'=>$imageMaxWidth,
						'height'=>$imageMaxHeight
					), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				// добавляем в массив VALUES новую уменьшенную картинку
				$VALUES[] = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"].$file["src"]);
			} else {
				// добавляем в массив VALUES старую картинку
				$VALUES[] = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"].$file_path);
			}
			// Собираем в массив ID старых файлов для их удаления (чтобы не занимали место)
			$VALUES_OLD[] = $ob['VALUE']; 
		}
	}

	// Если в массиве есть информация о новых файлах
	if(count($VALUES) > 0) {
		$PROPERTY_VALUE = $VALUES;  // значение свойства
		// Установим новое значение для данного свойства данного элемента
		CIBlockElement::SetPropertyValuesEx($arFields["ID"], $arFields["IBLOCK_ID"], array($PROPERTY_CODE => $PROPERTY_VALUE));
		// Удаляем старые большие изображения
		foreach ($VALUES_OLD as $key=>$val) {
			CFile::Delete($val);
		}
	}
	unset($VALUES);
	unset($VALUES_OLD);
  }
}

