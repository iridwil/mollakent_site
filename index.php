<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetPageProperty("keywords", "Моллакент ру, Моллакент, село Моллакент, сайт села Моллакент, Моллакент хуьр, Моллакент хюр, Mollakent");
$APPLICATION->SetTitle("Главная");
?>
    <div class="card mb-3">
        <div class="bg-holder d-none d-lg-block bg-card"
             style="background-image:url(/local/templates/falcon/assets/img/icons/spot-illustrations/corner-4.png);">
        </div> <!--/.bg-holder-->
        <div class="card-body position-relative">
            <div class="row">
                <div class="col-lg-8">
                    <h3>Гьаваяр</h3>
                    <?php
                    $wind_dir = [
                        "nw" => "",
                        "n" => "гьуьлуьхъай",
                        "ne" => "гьуьлуьхъай",
                        "e" => "гьуьлуьхъай",
                        "se" => "гьуьлуьхъай",
                        "s" => "гьуьлуьхъ",
                        "sw" => "гьуьлуьхъ",
                        "w" => "гьуьлуьхъ",
                        "c" => "",
                    ];

                    $ch = curl_init();
                    $headers = ['X-Yandex-API-Key: 2fb0fd42-c6dc-4247-8880-05ed91595d75'];
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                    $getUrl = 'https://api.weather.yandex.ru/v1/informers?lat=41.922282&lon=48.382812&lang=ru_RU';
                    curl_setopt($ch, CURLOPT_URL, $getUrl);
                    $response = curl_exec($ch);

                    $rezArr = json_decode($response, true);
                    if($rezArr["status"] === 403){
                        $headers = ['X-Yandex-API-Key: 01cb6227-99a7-45eb-994d-ce798e93fc56'];
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
                        $getUrl = 'https://api.weather.yandex.ru/v1/informers?lat=41.922282&lon=48.382812&lang=ru_RU';
                        curl_setopt($ch, CURLOPT_URL, $getUrl);
                        $response = curl_exec($ch);
                        $rezArr = json_decode($response, true);
                    }

                    ?> <?php //echo date('d.m.Y H:i:s', intval($rezArr["now"]) );?>
                    <p class="mt-2">
                        <?php echo "Исятда хуьре " . $rezArr["fact"]["temp"] . "° чимивал, "
                            .
                            $rezArr["fact"]["humidity"] ."% " . "ламувал";

                        if($wind_dir[$rezArr["fact"]["wind_dir"]] != "")
                        {
                            echo ", " . $rezArr["fact"]["wind_speed"] . " м/c " . $wind_dir[$rezArr["fact"]["wind_dir"]] . " гар ава.";
                        } else
                        {
                            echo " ава, гар авач. ";
                        }
                        echo " Гьуьлуьн цин чимивал " . $rezArr["fact"]["temp_water"] . "° я."?> <br>
                        <?//php echo "Рагъ экъечIзвай вахт - " . $rezArr["forecast"]["sunrise"] . "<br>" . "Рагъ акIизвай вахт - " . $rezArr["forecast"]["sunset"] ?>
                    </p>
                    <?php
                    curl_close($ch);
                    ?>
                </div>
                <div class="col-lg-12">
                        <a style="float: right" href="https://yandex.ru/pogoda/mollakent">Яндекс гьава</a>
                </div>

                <div class="col-lg-8">
                <h3>KпIунин вахт</h3>
                    <?$arNamazDate = unserialize(file_get_contents('arNamazDateDerbent2.txt'));
                    ?>
                    <p>Экуьнин: <?=$arNamazDate["FAJR"]?><br>
                    Шурук: <?=$arNamazDate["VOSXOD"]?><br>
                    Нисинин: <?=$arNamazDate["ZUXR"]?><br>
                    Кьулан: <?=$arNamazDate["ASR"]?><br>
                    Нянин: <?=$arNamazDate["MAGRIB"]?><br>
                    Месин: <?=$arNamazDate["ISHA"]?></p>

                </div>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <div class="row m-2">
            <div class="col">
                <h2 class="fs-2 fs-sm-4 fs-md-5">Хабарар</h2>
            </div>
        </div>
        <?php $APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"news_list_on_home", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COMPONENT_TEMPLATE" => "news_list_on_home",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "news",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "6",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "Y",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Хабарар",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "60",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "N",
		"SET_META_KEYWORDS" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "ID",
		"SORT_ORDER1" => "ASC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N"
	),
	false
);?>
    </div>



    <div class="card mb-3">
        <div class="row m-2">
            <div class="col">
                <h2 class="fs-2 fs-sm-4 fs-md-5">Шикилар</h2>
            </div>
        </div>
        <div class="card mb-3 m-3">
        <?php $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "slider_on_home",
                    Array(
                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                        "ADD_SECTIONS_CHAIN" => "N",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "Y",
                        "CACHE_TIME" => "36000000",
                        "CACHE_TYPE" => "A",
                        "CHECK_DATES" => "Y",
                        "COMPONENT_TEMPLATE" => "news_list_on_home",
                        "DETAIL_URL" => "",
                        "DISPLAY_BOTTOM_PAGER" => "N",
                        "DISPLAY_DATE" => "Y",
                        "DISPLAY_NAME" => "Y",
                        "DISPLAY_PICTURE" => "Y",
                        "DISPLAY_PREVIEW_TEXT" => "Y",
                        "DISPLAY_TOP_PAGER" => "N",
                        "FIELD_CODE" => array(0=>"",1=>"",),
                        "FILTER_NAME" => "",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "IBLOCK_ID" => "2",
                        "IBLOCK_TYPE" => "news",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "MESSAGE_404" => "",
                        "NEWS_COUNT" => "",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "Y",
                        "PAGER_SHOW_ALWAYS" => "Y",
                        "PAGER_TEMPLATE" => ".default",
                        "PAGER_TITLE" => "Хабарар",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "PREVIEW_TRUNCATE_LEN" => "60",
                        "PROPERTY_CODE" => array(0=>"",1=>"",),
                        "SET_BROWSER_TITLE" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_STATUS_404" => "N",
                        "SET_TITLE" => "N",
                        "SHOW_404" => "N",
                        "SORT_BY1" => "SORT",
                        "SORT_BY2" => "ACTIVE_FROM",
                        "SORT_ORDER1" => "ASC",
                        "SORT_ORDER2" => "DESC",
                        "STRICT_SECTION_CHECK" => "N"
                    )
                );?>
    </div>
    </div>







<!-- portfolio -->

<!--<section id="portfolio" class="py-lg-5 portfolio-agile pt-3 pb-5">-->
<!--    <div class="container py-lg-5">-->
<!--	<div class="title-section pb-lg-5 text-center">-->
<!--		<h4>Реклама</h4>-->
<!--	</div>-->
<!--	<div class="row">-->
<!--		<ul class="nav nav-pills my-3" id="pills-tab" role="tablist">-->
<!--			<li class="nav-item"> <a class="nav-link active" id="showall-tab" data-toggle="pill" href="#showall" role="tab" aria-controls="showall" aria-selected="true">Вири</a> </li>-->
<!--			<li class="nav-item"> <a class="nav-link" id="categorys-tab" data-toggle="pill" href="#categorys" role="tab" aria-controls="categorys" aria-selected="false">Маса гуда</a> </li>-->
<!--			<li class="nav-item"> <a class="nav-link" id="Tab2-Image-tab" data-toggle="pill" href="#Tab2-Image" role="tab" aria-controls="Tab2-Image" aria-selected="false">Маса къачуда</a> </li>-->
<!--			<li class="nav-item"> <a class="nav-link" id="Tab3-Image-tab" data-toggle="pill" href="#Tab3-Image" role="tab" aria-controls="Tab3-Image" aria-selected="false">Аренда</a> </li>-->
<!--		</ul>-->
<!--	</div>-->
<!--	<hr style="margin-top:-20px;">-->
<!--	<div class="container">-->
<!--		<div class="tab-content" id="pills-tabContent">-->
<!--			<div class="tab-pane fade show active clearfix" id="showall" role="tabpanel" aria-labelledby="showall-tab">-->
<!--				<div class="portfolio">-->
<!--                    <a href="/upload/cherem.jpg" class="img-fluid" data-lightbox="example-set" data-title="Куплю черемшу свежую и свеже-соленую. Звонить по телефону +7 977-618-08-48">-->
<!--                        <img alt="flyer-portfolio" src="/upload/cherem.jpg" class="categoryd-img img-fluid"> </a>-->
<!--					<div class="desc">-->
<!--						 Куплю черемшу-->
<!--					</div>-->
<!--				</div>-->
<!-- <a href="images/g2.jpg" class="img-fluid" data-lightbox="example-set" data-title="Add text to your image to make a commentary for it!"> <img alt="flyer-portfolio" src="images/g2.jpg" class="categoryd-img img-fluid"> </a>-->
<!--					<div class="desc">-->
<!--						 Дарманар-->
<!--					</div>-->
<!--				</div>-->
<!--				<div class="portfolio">-->
<!-- <a href="images/g6.jpg" class="img-fluid" data-lightbox="example-set" data-title="Add text to your image to make a commentary for it!"> <img alt="flyer-portfolio" src="images/g6.jpg" class="categoryd-img img-fluid"> </a>-->
<!--					<div class="desc">-->
<!--						 Аялрин игрушкаяр-->
<!--					</div>-->
<!--				</div>-->
<!--				<div class="portfolio">-->
<!-- <a href="images/g8.jpg" class="img-fluid" data-lightbox="example-set" data-title="Add text to your image to make a commentary for it!"> <img alt="flyer-portfolio" src="images/g8.jpg" class="categoryd-img img-fluid"> </a>-->
<!--					<div class="desc">-->
<!--						 Авто-->
<!--					</div>-->
<!--			</div>-->
<!--				<div class="portfolio">-->
<!-- <a href="images/g2.jpg" class="img-fluid" data-lightbox="example-set" data-title="Add text to your image to make a commentary for it!"> <img alt="flyer-portfolio" src="images/g2.jpg" class="categoryd-img img-fluid"> </a>-->
<!--					<div class="desc">-->
<!--						 Дарманар-->
<!--					</div>-->
<!--				</div>-->
<!--				<div class="portfolio">-->
<!-- <a href="images/g6.jpg" class="img-fluid" data-lightbox="example-set" data-title="Add text to your image to make a commentary for it!"> <img alt="flyer-portfolio" src="images/g6.jpg" class="categoryd-img img-fluid"> </a>-->
<!--					<div class="desc">-->
<!--						 Аялрин игрушкаяр-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--			<div class="tab-pane fade clearfix" id="Tab3-Image" role="tabpanel" aria-labelledby="Tab3-Image-tab">-->
<!--				<div class="portfolio">-->
<!-- <a href="images/g8.jpg" class="img-fluid" data-lightbox="example-set" data-title="Add text to your image to make a commentary for it!"> <img alt="flyer-portfolio" src="images/g8.jpg" class="categoryd-img img-fluid"> </a>-->
<!--					<div class="desc">-->
<!--						 Авто-->
<!--					</div>-->
<!--				</div>-->
<!--			<div class="tab-pane fade clearfix" id="Tab2-Image" role="tabpanel" aria-labelledby="Tab2-Image-tab">-->
<!--                <div class="portfolio">-->
<!--                    <a href="/upload/cherem.jpg" class="img-fluid" data-lightbox="example-set" data-title="Куплю черемшу свежую и свеже-соленую. Звонить по телефону +7 977-618-08-48">-->
<!--                        <img alt="flyer-portfolio" src="/upload/cherem.jpg" class="categoryd-img img-fluid"> </a>-->
<!--                    <div class="desc">-->
<!--                        Куплю черемшу-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
<!--</section>-->
<!---->
<!--<hr>-->
<!--<div class="row no-gutters align-items-center abbot-main" id="services2">-->
<!--    <div class="col-lg-6 px-sm-5 mx-auto py-lg-0 py-4">-->
<!--        <section class="px-sm-5 px-3 accordion-agile">-->
<!--            <div class="typo-grid my-auto">-->
<!--                <div class="panel-group" id="accordion4" role="tablist" aria-multiselectable="true">-->
<!--                    <div class="panel panel-default">-->
<!--                        <div class="panel-heading" role="tab" id="headingOne4">-->
<!--                            <h4 class="panel-title"> <a role="button" data-toggle="collapse" data-parent="#accordion4" href="#collapseOne4" aria-expanded="true" aria-controls="collapseOne4" data-blast="bgColor">-->
<!--                                    Хуьруьн тарих </a> </h4>-->
<!--                        </div>-->
<!--                        <div id="collapseOne4" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne4">-->
<!--                            <div class="panel-body">-->
<!--                                <p>-->
<!--                                    1895 йисуз Муллахуьр Куьре округдин Уллу магалдин Аглоби хуьруьнжемятдик квай гъвечIи азербайжан хуьр тир. Хуьре 7 кIвале 36 касди уьмуьр гьалзавай. ХХ виш йисан 1920-й йисарай гатIумна иниз Кьурагь райондин Кутул хуьруьн эгьлияр къвез-къвез куьч жезвай. ЦIуру эгьлийрин эхтилатралди, хуьруьз сифте куьч хьанвай ксар 19 виш йисан, тахминан 1880 йисуз, арадал акъатнай. <br>-->
<!--                                    <br>-->
<!--                                    Къе хуьре кутулвийрилай гъейри, гьакIни эхнигвияр, штулвияр ва муькуь хуьрерин эгьлийрини уьмуьр гьалзавайди я. Хуьре кьулан мектеб, культурадин КIвал, клуб, 10 тахтунин идарадин начагъхана, улубхана, аялрин бахча ва администрациядин дараматар ава. Вири хуьр газдив таъмин я, гила рекьериз асфалт чIугунин кIвалахар гатIумнавайди я. Халкьдин «Образование» проэктдин куьмекдалди хуьре 240 чка гьакьарзавай, вири къулайвилер авай мектеб эцигнава. <br>-->
<!--                                    <br>-->
<!--                                    Кьве вишелай пара ксариз вини дережадин чирвилер ава. Мирзоев Аллагьверди, Хаметов Сабир ва Нагиев Рамазан хьтин ксар — докторар ва илимрин кандидатар, ибур хуьруьн дамах я. Эхиримжи йисара, бизнесдал алахънавай ксарни пара хьана, абурукай Мирзоев Мирза, Алиев Нурмет хьтин бизнесменар хуьруьн социалвилинни - экономикадин ва культурадин уьмуьрда активдаказ иштирак ийизвайди я. Абурун такьатрин куьмекдалди хуьре цIийи мискIиндин эцигунар кьилиз акъатзава.-->
<!--                                </p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="panel panel-default">-->
<!--                        <div class="panel-heading" role="tab" id="headingTwo4">-->
<!--                            <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion4" href="#collapseTwo4" aria-expanded="false" aria-controls="collapseTwo4" data-blast="bgColor">-->
<!--                                    Герек тилифунар </a> </h4>-->
<!--                        </div>-->
<!--                        <div id="collapseTwo4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo4">-->
<!--                            <div class="panel-body">-->
<!--                                <p>-->
<!--                                    Интернет FLY-TECH: +7 960 412-55-00.<br>-->
<!--                                    Почтунин индекс: 368198-->
<!--                                </p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="panel panel-default">-->
<!--                        <div class="panel-heading" role="tab" id="headingThree">-->
<!--                            <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion4" href="#collapseThree" aria-expanded="false" aria-controls="collapseTwo4" data-blast="bgColor">-->
<!--                                    Инфраструктура</a> </h4>-->
<!--                        </div>-->
<!--                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">-->
<!--                            <div class="panel-body">-->
<!--                                <p>-->
<!--                                    Хуьре квез гьихьтин идараяр, инфраструктурадин объектар хьана кIанзватIа чаз кхьихь. Белки квез хуьре еке спортзал, кинотеатр, парк, футбол стадион, белки маса объектар хьана кIанзва. Ша чна вирида санал чи хуьруьн акунар хъсанарин, хуьруьнвийриз чи Моллакент регьят, мублагь ийин. Сифтени сифте суьгьбет ийин чаз вуч герекзватIа, ахпа яваш-яваш кьилиз акъудин чи фикирар.
Телеграм чат <a href="https://tele.click/mollakent">https://tele.click/mollakent</a> Телеграм чат <a href=" tg://resolve?domain=mollakent">https://tele.click/mollakent</a>-->
<!--                                </p>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="panel panel-default">-->
<!--                        <div class="panel-heading" role="tab" id="headingFour">-->
<!--                            <h4 class="panel-title"> <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion5" href="#collapseFour" aria-expanded="false" aria-controls="collapseTwo5" data-blast="bgColor">-->
<!--                                    Четинвилер</a> </h4>-->
<!--                        </div>-->
<!--                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">-->
<!--                            <div class="panel-body">-->
<!--                                <p>-->
<!--                                    Алай чIавуз хуьруьн агьайлийриз ихьтин четинвилер ава:-->
<!--                                </p>-->
<!--                                <ol style="margin-left: 30px;">-->
<!--                                    <li><p><b>Белиждиз физвай рекье къир цванавач.</b></p>-->
<!--                                        <p>Лап патав гвай Белиждиз физ жезвач са пай инсанривай, вучиз лагьайтIа рехъ къайдада авач. Са бубат иномарка фад чикIизва и рекьяй фейила, чара авачиз яргъа авай Дербендиз физва эхир чпин машиндикай араба ийиз кIан тийизвай инсанар.</p></li>-->
<!--                                    <li><p><b>Эквер хкатзава са тIимил гар акъатнамаз, марф къванамаз, ахпа сятералди кухтазвач.</b></p>-->
<!--                                        <p>Инсанрин туьквенра, кIвалера авай холдильникда авай кьван затI цIразва, чIур жезва, компьютер, ва маса герек техника хкатзва, пара зиян гузва халкьдиз.</p>-->
<!--                                    </li>-->
<!--                                    <li>-->
<!--                                        <p><b>Мусор тухвана гадардай чка, я службаяр авач.</b></p>-->
<!--                                        <p>Инсанри вацIун кьваларилай гадариз хуьруьн экология пара чIурзава. Экология чIур хьайитIа начагъвилер, азарар гзаф жеда хуьре, им вахтундамаз гъиле кьуна кIанзавай кIвалах я!</p>-->
<!--                                        <p>Дуьз лагьайтIа мусор тухудай службайри са вахтунда кIвалахиз гатIумнай хуьре, амма абуруз кIан хьана гьар кIвале авай инсанрин кьадардиз килигна пул къачуз. Хуьруьнвийриз и кар хуш атаначтIани чидач, я тахьайтIа абуру це лагьай пулунин кьадар гзаф акунатIани чидач, мад а службайри хуьре кIвалах хъувунач.</p>-->
<!--                                    </li>-->
<!--                                    <li>-->
<!--                                        <p><b>Райондин центр яргъа ава.</b></p>-->
<!--                                        <p>Им четинвал тушир хьи, эгер хуьре жуван МФЦ аваз хьанайтIа, я онлайн туькIуьриз жезвайтIа гьар са герек кар, Курагьиз хъфин герек къвезвачиртIа.</p>-->
<!--                                        <p>Белиждин МФЦ-да гила са пай герек крар кьилиз акъудиз жезва, амма гьайиф хьи, вири ваъ.</p>-->
<!--                                        <p>Эхь, хъсан я чун жуван лезги райондик акатиз, амма чи хуьр анклав тир виляй чаз центрди гана кIан я особы регьятвилер. Исятда авай положени, са справка патал 4 сят Кьурагьиз фин, я документар масадав вугана са шумуд йикъуз вил алаз акъвазун дуьз туш. Къе, компьютер, интернет авай вахтунда ихьтин положенидал чун рази туш. Дербендизни 4 сеферда фена хуьквез жезва садра Кьурагьиз фидалди. ТIалабзва Кьурагь райондин администрацидивай и кардиз фикир гун, чаз куьмек авун.</p>-->
<!--                                    </li>-->
<!--                                </ol>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </section>-->
<!--    </div>-->
<!--	<div class="col-lg-6 about-grid-agileits py-sm-5 py-4" data-blast="bgColor">-->
<!--		<div class="about-grid">-->
<!--			<div class="container">-->
<!--				<div class="d-flex">-->
<!--					<div class="mx-auto">-->
<!--						<div class="title-section py-lg-5 pb-4">-->
<!--							<h4>Реклама це</h4>-->
<!--							<h3 class="w3ls-title text-uppercase text-white">хийир къачу</h3>-->
<!--						</div>-->
<!--						<div class="wthree-list-grid d-flex flex-wrap">-->
<!--							<div class="wthree-list-icon">-->
<!-- <span class="fa fa-thumbs-up" aria-hidden="true"></span>-->
<!--							</div>-->
<!--							<div class="wthree-list-desc">-->
<!--								<h5>Виридаз аквада</h5>-->
<!--								<p>-->
<!--									 Mollakent.ru кхьенамаз браузерда, хуьрунвийриз гьамиша куь реклама аквада.-->
<!--								</p>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div class="wthree-list-grid d-flex flex-wrap">-->
<!--							<div class="wthree-list-icon">-->
<!-- <span class="fa fa-money" aria-hidden="true"></span>-->
<!--							</div>-->
<!--							<div class="wthree-list-desc">-->
<!--								<h5>Уьжуьз я</h5>-->
<!--								<p>-->
<!--									 100 манатдихъ 5 вацралди реклама амукьда сайтда-->
<!--								</p>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div class="wthree-list-grid d-flex flex-wrap">-->
<!--							<div class="wthree-list-icon">-->
<!-- <span class="fa fa-picture-o" aria-hidden="true"></span>-->
<!--							</div>-->
<!--							<div class="wthree-list-desc">-->
<!--								<h5>Шикилар вегь</h5>-->
<!--								<p>-->
<!--									 Инсанривай куь товардин, я авур кIвалахрин шикилриз килигиз жеда-->
<!--								</p>-->
<!--							</div>-->
<!--						</div>-->
<!--						<div class="wthree-list-grid d-flex flex-wrap">-->
<!--							<div class="wthree-list-icon">-->
<!-- <span class="fa fa-phone" aria-hidden="true"></span>-->
<!--							</div>-->
<!--							<div class="wthree-list-desc">-->
<!--								<h5>Реклама гуз регьят я</h5>-->
<!--								<p>-->
<!--									 Кхьихь чаз <a target="_blank" href="https://wa.me/79299459799">Whatsapp'диз</a>, вегь шикилар, чна иердаказ сайтдиз акъудда реклама.-->
<!--								</p>-->
<!--							</div>-->
<!--						</div>-->
<!--					</div>-->
<!--				</div>-->
<!--			</div>-->
<!--		</div>-->
<!--	</div>-->
<!--</div>-->
<!--<hr>-->
<!--<div class="map contact-right">-->
<!--	 <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A8fb3e5481aab3b86e0e679a3824d4ee1f684d5ff0d955f21fbb7ed7ad2a436ee&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=false"></script> -->

<!--</div>-->
<?php
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');
?>