<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
// https://api.telegram.org/bot1148706854:AAH8KURPKaZBJVKMDB25TVBlMFkvKSgTCoA
if(date("H:i") == "01:00"){

    /// Скачивание расписания намазов со стороннего сайта
    require ('phpQuery.php');
    $hbr = file_get_contents('http://online.kogdanamaz.ru/fullTimeTable.php?city=DRBN2');
    $document = phpQuery::newDocument($hbr);
    $hentry = $document->find('tr');

    $arNamazDate = array(
        "FAJR"      =>  $hentry->elements[date("j")]->childNodes[1]->textContent,
        "VOSXOD"    =>  $hentry->elements[date("j")]->childNodes[2]->textContent,
        "ZUXR"      =>  $hentry->elements[date("j")]->childNodes[4]->textContent,
        "ASR"       =>  $hentry->elements[date("j")]->childNodes[5]->textContent,
        "MAGRIB"    =>  $hentry->elements[date("j")]->childNodes[6]->textContent,
        "ISHA"      =>  $hentry->elements[date("j")]->childNodes[7]->textContent,
    );

    file_put_contents('arNamazDateDerbent2.txt', serialize($arNamazDate));

    $arMessageId = [];
    $arMessageId = unserialize(file_get_contents('messageids.php'));

    telegramQuery("", "", "deleteMessage", $arMessageId);
    file_put_contents('messageids.php', serialize([]));
}else{
    $arNamazDate = unserialize(file_get_contents('arNamazDateDerbent2.txt'));
}

echo '<pre>';
print_r($arNamazDate);
echo '</pre><br>';

function telegramQuery($heading="", $text="", $method = "sendMessage", $arMessageId = []){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $getUrl = 'https://api.telegram.org/bot1852667933:AAFCPe4JHOkiNpqitQRZJPyVGUkvqzT_8kQ/'.$method.'?chat_id=-1001565932726';
    if($method === "deleteMessage")
    {
        if($arMessageId)
        {
            foreach ($arMessageId as $key=>$value)
            {
                curl_setopt($ch, CURLOPT_URL, $getUrl.'&message_id='.$value);
                $response = curl_exec($ch);
                sleep(1);
            }
        }
    }
    else
    {
        $getUrl .= '&text=' . '*' . $heading . '*   ' . $text . '&parse_mode=markdown';

        curl_setopt($ch, CURLOPT_URL, $getUrl);
        $response = curl_exec($ch);
        //print_r($response);
        ?>
        <pre>
        <?
        $response = json_decode($response, true);
        if($response["ok"] == 1)
        {
            if($response["result"]["message_id"])
            {
                $arMessageId = unserialize(file_get_contents('messageids.php'))?:[];
                $arMessageId[] = $response["result"]["message_id"];
                file_put_contents('messageids.php', serialize($arMessageId));
            }
        }
        /*if($response["ok"] = 1){
            foreach($response["result"] as $key => $value){
                var_dump($value);
                echo '<br><br>';
            }
        }*/

        //print_r($response);

        ?>
        </pre>
        <?
    }
    curl_close($ch);
}

/// расчет первой трети ночи
function seconds2times($seconds)
{
    $times = array();

    // считать нули в значениях
    $count_zero = false;

    // количество секунд в году не учитывает високосный год
    // поэтому функция считает что в году 365 дней
    // секунд в минуте|часе|сутках|году
    $periods = array(60, 3600, 86400, 31536000);

    for ($i = 3; $i >= 0; $i--)
    {
        $period = floor($seconds/$periods[$i]);
        if (($period > 0) || ($period == 0 && $count_zero))
        {
            $times[$i+1] = $period;
            $seconds -= $period * $periods[$i];

            $count_zero = true;
        }
    }

    $times[0] = $seconds;
    return $times;
}

$min = 60;
$hour = 60*60;
$dayLength = strtotime ($arNamazDate["ISHA"]) - strtotime($arNamazDate["FAJR"]);
$dayLengthArr = seconds2times($dayLength);
echo "Длительность рабочего дня - ". $dayLengthArr["2"] . ":" . $dayLengthArr["1"] . "<br>";

$nightLength = strtotime("24:00") - strtotime($dayLengthArr["2"] . ":" . $dayLengthArr["1"]);
$nightLength13 = $nightLength/3;
$nightLengthArr = seconds2times($nightLength13);
$nightSleepTime = $nightLengthArr["2"]*$hour + $nightLengthArr["1"]*$min + explode(':', $arNamazDate["ISHA"])[0]*$hour + explode(':', $arNamazDate["ISHA"])[1]*$min;
$nightSleepTime = seconds2times($nightSleepTime);
echo "Рекомендуемое время сна - не позднее " . $nightSleepTime["2"] . ":" . $nightSleepTime[1] . "<br><br>";
///

if(date("H:i") == $arNamazDate["FAJR"]){

    $arEventFields = array(
        "NAMAZ_NAME"          => urlencode(date("H:i ") . "Утренний намаз"),
    );
    $arEventFields["MESSAGE"] .= '

Расписание на день:
Фаджр '.$arNamazDate["FAJR"].'
Восход '.$arNamazDate["VOSXOD"].'
Зухр '.$arNamazDate["ZUXR"].'
\'Аср '.$arNamazDate["ASR"].'
Магриб '.$arNamazDate["MAGRIB"].'
\'Иша '.$arNamazDate["ISHA"];

}

//за 15 минут до Фаджра. Для Рамадана
/*
elseif(date("H:i", time()+60*15) == $arNamazDate["FAJR"]){
    $arEventFields = array(
        "MESSAGE"             =>"
Не забудьте вовремя прекратить принятие пищи.",
        "NAMAZ_NAME"          => date("H:i ") . "15 минут до утреннего азана",
    );
}
*/


elseif(date("H:i") == $arNamazDate["ZUXR"]){
    $arEventFields = array(
        "NAMAZ_NAME"          => date("H:i ") . "Полуденный намаз.",
    );
}

elseif(date("H:i") == $arNamazDate["ASR"]){
    $arEventFields = array(
        "NAMAZ_NAME"          => date("H:i ") . "ПОСЛЕполуденный намаз.",
    );
}

elseif(date("H:i") == $arNamazDate["MAGRIB"]){
    $arEventFields = array(
        "NAMAZ_NAME"          => date("H:i ") . "Вечерний намаз.",
    );
}

elseif(date("H:i") == $arNamazDate["ISHA"]){
    $arEventFields = array(
        "NAMAZ_NAME"          => date("H:i ") . "Ночной намаз.",
    );
}


//if(date("H:i", strtotime("14:26")) == $arNamazDate["ASR"]){
if(false){
    echo "ttttt";
    $arEventFields = array(
        "MESSAGE"             => '
' . $arNamazDate["FAJR"]  . '
' . $arNamazDate["VOSXOD"]  . '
' . $arNamazDate["ZUXR"]  . '
' . $arNamazDate["ASR"]  . '
' . $arNamazDate["MAGRIB"] . '
' . $arNamazDate["ISHA"] ,
        "EMAIL_TO"            => $arParams["HUSBAND_MAIL"],
        "NAMAZ_NAME"          => "TEST",
    );
}

if(!empty($arEventFields)){
    //echo CEvent::Send($arParams["POST_EVENT_TYPE_ID"], SITE_ID, $arEventFields, "N", $arParams["POST_EVENT_ID"]);
    telegramQuery($arEventFields["NAMAZ_NAME"], urlencode($arEventFields["MESSAGE"]));
}

$this->IncludeComponentTemplate();
?>