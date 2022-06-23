<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Намаз");

?><h2>Что я делаю сейчас</h2>
 <?$APPLICATION->IncludeComponent(
	"iridwil:v_ritme_namaza_derbent2",
	".default",
	Array(
		"COMPONENT_TEMPLATE" => ".default",
		"HUSBAND_MAIL" => "r.magomed.i@mail.ru",
		"POST_EVENT_ID" => "10",
		"POST_EVENT_TYPE_ID" => "NAMAZ_POST_TYPE",
		"WIFE_MAIL" => "test.ru"
	)
);?><br>
<br>
 Пророк Мухаммад ﷺ&nbsp;читал за мусульман такую мольбу:&nbsp;«О Аллах, благослови мою умму в утренние часы»&nbsp;(Ибн Маджа). Это означает, что в том, что делается рано утром, будет больше благодати. Ученые говорят, что <b>сон после утреннего&nbsp;намаза&nbsp;до восхода солнца лишает бараката</b><br>
 <br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>