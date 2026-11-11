<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$lm = GetMessage("contacts");
$APPLICATION->SetTitle($lm);

//$APPLICATION->SetTitle("Контакты");
?>

<?if(LANGUAGE_ID != 'en'):?>
	<script src="https://api-maps.yandex.ru/2.1/?apikey=4bc74d97-8213-459e-a64e-d7bff9fc8798&lang=ru_RU" type="text/javascript">
    </script>
<?else:?>
	<script src="https://api-maps.yandex.ru/2.1/?apikey=4bc74d97-8213-459e-a64e-d7bff9fc8798&lang=en_RU" type="text/javascript">
    </script>
<?endif?>

<div class="contacts_page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12 news_page__head">
				<div class="news_page__head__title"><h1><?=GetMessage("contacts")?></h1></div>
		
				<div class="news_page__head__social__title"><?=GetMessage("social")?></div>
					<div class="news_page__head__social__links">
						<?$APPLICATION->IncludeComponent(
						"bitrix:main.include",
						"",
						Array(
							"AREA_FILE_SHOW" => "file",
							"AREA_FILE_SUFFIX" => "inc",
							"EDIT_TEMPLATE" => "",
							"PATH" => "/include/social.php"
						)
					);?>
					</div>

		
			</div>
		</div>
		
		<div class="row contacts_page__block">

				<script>
					ymaps.ready(init);

					function init() {
					    var myMap = new ymaps.Map("cont_map", {
			            center: [55.968040, 92.790194],
			            zoom: 14,
                  controls: ['zoomControl', 'routeButtonControl']

			        }, {

			        });
			        
	        <?if(LANGUAGE_ID != 'en'):?>
			        myMap.geoObjects
					        .add(new ymaps.Placemark([55.961399, 92.794968], {
					            balloonContent: 'Фанпарк Бобровый лог'
					        }, {
						            preset: 'islands#redMountainIcon'
					        }))
					        .add(new ymaps.Placemark([55.964586, 92.792658], {
					            balloonContent: 'Автобусная остановка (37 маршрут)'
					        }, {
						            preset: 'islands#blueMassTransitIcon'
					        }))
					        .add(new ymaps.Placemark([55.964661, 92.796316], {
					            balloonContent: 'Автобусная остановка (30 маршрут)'
					        }, {
						            preset: 'islands#blueMassTransitIcon'
					        }))
					        .add(new ymaps.Placemark([55.973333, 92.793017], {
					            balloonContent: 'Автобусная остановка(маршруты:19, 50, 78, 80 вых.дни, 106а-маршрутное такси)'
					        }, {
						            preset: 'islands#blueMassTransitIcon'
					        }));
					        
					        
					<?else:?>

					    myMap.geoObjects
					        .add(new ymaps.Placemark([55.961399, 92.794968], {
					            balloonContent: 'Funpark Bobrovy Log'
					        }, {
 					            preset: 'islands#redMountainIcon'
					        }))
					        .add(new ymaps.Placemark([55.964586, 92.792658], {
					            balloonContent: 'Bus station (37 route)'
					        }, {
 					            preset: 'islands#blueMassTransitIcon'
					        }))
					        .add(new ymaps.Placemark([55.964661, 92.796316], {
					            balloonContent: 'Bus station (30 route)'
					        }, {
 					            preset: 'islands#blueMassTransitIcon'
					        }))
					        .add(new ymaps.Placemark([55.973333, 92.793017], {
					            balloonContent: 'Bus station (routes:19, 50, 78, 80 вых.дни, 106а-bus taxi)'
					        }, {
 					            preset: 'islands#blueMassTransitIcon'
					        }));
			      <?endif?>  
					        
					        myMap.behaviors.disable('scrollZoom');
					        
					}
				</script>
				
				
				<div class="contacts_page__block__map" id="cont_map">
					
				</div>

			<div class="col-xs-12">
				

				<br/>
				<?$APPLICATION->IncludeComponent(
					"bitrix:main.include",
					"",
					Array(
						"AREA_FILE_SHOW" => "file",
						"AREA_FILE_SUFFIX" => "inc",
						"EDIT_TEMPLATE" => "",
						"PATH" => "/include/about/contacts_".LANGUAGE_ID.".php"
					)
				);?>
			</div>
		</div>
	</div>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>