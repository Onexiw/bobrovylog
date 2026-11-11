<div class="vidget__tempr">
	<div id="raz">
		<div class="vidget_popup">
			 <!-- Weather widget by https://www.meteoservice.ru --> <a id="ms-informer-link-336850386620b24859a82937ce13fceb" class="ms-informer-link" href="https://www.meteoservice.ru/weather/overview/krasnoyarsk">Погода в Красноярске</a>
			<script class="ms-informer-script"
                    src="https://www.meteoservice.ru/informer/script/336850386620b24859a82937ce13fceb"></script> <!-- End -->
		</div> 

		<div class="vidget__tempr__value">
         <!--ищите ссылку на температуру в файле ajax_t.php в каталоге с этим виджетом -->
		</div>
	</div>
	<div class="vidget__tempr__title">
		 <?= GetMessage("tempr") ?>
	</div> 
</div>
 <a href="/about/webcam/" class="vidget__cam pull-right">
<div class="vidget__cam__value">
 <img src="/local/templates/bobrovy_log_multilang/images/icon_webcam.svg" class="img-responsive">
</div>
<div class="clear">
</div>
<div class="vidget__cam__title">
	 <?= GetMessage("webcam") ?>
</div>
 </a> <a href="/about/webcam/" class="vidget__cam_mobile"></a>