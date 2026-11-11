<?php
// Настройки для MY site

// Настройки Email
//$site['from_name'] = 'bobrovylog.ru'; // from (от) имя
//$site['from_email'] = 'site@bobrovylog.ru'; // from (от) email адрес
// На всякий случай указываем настройки
// для дополнительного (внешнего) SMTP сервера.
/*$site['smtp_mode'] = 'disabled'; // enabled or disabled (включен или выключен)
$site['smtp_host'] = null;
$site['smtp_port'] = null;
$site['smtp_username'] = null;
*/

function genfrom () {
$alpha = array ('Сергей И.','Иванов Сергей','Сергей Юрьевич Иванов','Иванов С.','Сергей Иванов','Сергей Юрьевич','Сергей Юр.','Ив. Сер. Юр.','С.Ю. Иванов','Иванов С.Ю.','Иванов Сергей Ю.','Сергей Ю. Иванов','Сергей Юрьевич И.','Сер. Ю. Иванов');

    $name = $alpha[mt_rand(0,count($alpha)-1)];
    
    return $name;
}

function genleft () {
$alpha = array ('some','begin','infogo','this','that','biz','item','best','run','play','buy','dir','kind','click','will','more','time','quick','sign','zakaz','oplata','success','real','flame','god','step','smile','bepos','pokemon','site','every','nice','sergei','mikhail','fedor','ivan','slava','alexandr','alex','petr','nikita','alexey','aleksey','maria','nastya','klava','sonya','katya','sidorov','ivanov','popov','korkin','perov','vasya','zoya','sveta','oksana','konstantin','vera','varvara','uglova','polyanskaya','skryabina','pont','leykina','masha','dasha','luba','sanya','serg','boris','valera','red','green','black','grey','orange','purple','yellow','over','game','otdel','marketing','logistic','bravo','kadry','goods','director','boss','perec','sever','vostok','zapad','yug','hello','taknado','obed','malyshka','power','finance','department','hr','style','tot','support','moscow','krsk','buryatiya','ivanovo','kaluga','piter','sochi','krasnodar','tula','kemerovo','irkutsk','norilsk','ulanude','almaty','astana','minsk','kiev','ekat','magnitogorsk','chelyabinsk','orel','samara','saratov','kazan','chelny','rostov','voronezh','belgorod','pskov','tver','yaroslavl','novosib','vladivostok','khabarovsk','nakhodka','tambov','tomsk','omsk','tumen','orsk','novokuzneck','balakovo','kirov','abakan','barnaul','blagoveshensk','astrakhan','arkhangelsk','cherepovec','izhevsk','chita','yakutsk','kaliningrad','kostroma','kursk','kyzyl','magadan','makhachkala','minusinsk','sayanogorsk','murmansk','nizhnevartovsk','novgorod','orenburg','penza','perm','odincovo','podolsk','petrozavodsk','ryazan','saransk','syzran','oskol','smolensk','surgut','tobolsk','tolyatti','ufa','ulyanovsk','volgograd','sterlitamak','ussuriysk','pochka','selena','bar','kafe','zakupki','docs','oformlenie','zayavka','prihod','check','kon','gazeta','otovar','pimenov','simonov','dolya','affiliate','lead','landing','magazin','shop','ctr','roi','money','dengi','raschet','faktura','suda','pismo','smotri','gorod','tapki','stol','stul','vazhno','srochno','rost','pribyl','prodazha','geshevt','uspeh','ipo');

    $name = $alpha[mt_rand(0,count($alpha)-1)];
    
    return $name;
}
?>
