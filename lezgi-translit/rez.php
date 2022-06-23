<?
session_start();

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords_inner", "лезги, латиница лезгинская, лезги чIал, lezgi latin");
$APPLICATION->SetPageProperty("keywords", "лезги, латиница лезгинская, лезги чIал, lezgi latin, lezgi latinica, лезгинская латиница, лезгинский алфавит на латинице");
$APPLICATION->SetPageProperty("description", "Читайте лезгинские тексты на латинице и мгновенно переводите на лезги латиницу кириллические тексты  и обратно");
$APPLICATION->SetPageProperty("title", "Лезгинская латиница. Лезгинский алфавит на основе латиницы");
$APPLICATION->SetTitle("Лезгинская латиница");
?>

<?
if(!empty($_POST['submit']) && !empty($_POST['text'])) {
    $_SESSION['text'] = $_POST['text'];
    header("Location: rez.php");
    die;
}

if(!isset($_POST['submit']) && !empty($_SESSION['text']))
{
    //удалим html теги для защиты от xss атак
    $text = " " . htmlspecialchars($_SESSION['text']);
    //Добавим запись в журнал событий Битрикс
    CEventLog::Add(array(
        "AUDIT_TYPE_ID" => "NEW_TEXT",
        "DESCRIPTION" => "Введенный текст: " . $text
    ));
    //отправим письмо с введенным текстом на почту
    $arEventFields = array(
        "TEXT" => $text
    );
    CEvent::Send("NEW_TEXT", SITE_ID, $arEventFields);
    //CEvent::SendImmediate("NEW_TEXT", SITE_ID, $arEventFields);
    echo '<a style="text-decoration: underline;" href="/lezgi-translit/index.php">Кьулухъ хъфин</a>';
    echo '<br><br>';

    move_uploaded_file($_FILES["file"]["tmp_name"], 'uploads/' . time() . "_" . $_FILES["file"]["name"]);



    //убираем мягкий перенос
    $text = htmlentities($text);
    $text = str_replace('&shy;', '', $text);
    $text = html_entity_decode($text);


    //echo $text;
    //echo '<br><br>';
    $arrayText = preg_split('//u',$text,-1,PREG_SPLIT_NO_EMPTY);
    $textConverted = mb_convert_encoding($text, 'utf-8', mb_detect_encoding($text));
    $fp = fopen('Alltext.php', 'a+');
    fwrite($fp, date("j F Y G:i:s") . "<br><br>");
    fwrite($fp, $textConverted);
    //fwrite($fp, "\n\n***************************************************\n\n");
    fwrite($fp, "<br><br>***************************************************<br><br>");

    $arraySimbolKey = [
        "а" => "a",
        "ая" => "aya",
        "аю" => "ayu",
        "ия" => "iya",
        "уя" => "uya",
        "ея" => "eya",
        "эя" => "eya",
        "ья" => "'ya",
        "Ая" => "Aya",
        "Ия" => "Iya",
        "Уя" => "Uya",
        "Ея" => "Yeya",
        "Эя" => "Eya",
        "ИЯ" => "IYA",
        "ЕО" => "EO",
        "А" => "A",
        "б" => "b",
        "Б" => "B",
        "в" => "v",
        "В" => "V",
        "г" => "g",
        "Г" => "G",
        "гь" => "h",
        "Гь" => "H",
        "ГЬ" => "H",
        "гъ" => "g'",
        "Гъ" => "G'",
        "ГЪ" => "G'",
        "д" => "d",
        "Д" => "D",
        " е" => " ye",
        "е" => "e",
        "Е" => "E",
        " Е" => " Ye",
        "ё" => "yo",
        "Ё" => "Yo",
        "ж" => "j",
        "Ж" => "J",
        "дж" => "jh",
        "Дж" => "Jh",
        "з" => "z",
        "З" => "Z",
        "И" => "I",
        "и" => "i",
        "й" => "y",
        "Й" => "Y",
        "к" => "k",
        "К" => "K",
        "кӀ" => "k'",
        "КӀ" => "K'",
        "кI" => "k'",
        "КI" => "K'",
        "кl" => "k'",
        "Кl" => "K'",
        "к1" => "k'",
        "К1" => "K'",
        "къ" => "q",
        "Къ" => "Q",
        "КЪ" => "Q'",
        "кь" => "q'",
        "Кь" => "Q'",
        "КЬ" => "Q'",
        "л" => "l",
        "Л" => "L",
        "м" => "m",
        "М" => "M",
        "н" => "n",
        "Н" => "N",
        "о" => "o",
        "О" => "O",
        "п" => "p",
        "П" => "P",
        "пI" => "p'",
        "ПI" => "P'",
        "п1" => "p'",
        "П1" => "P'",
        "пl" => "p'",
        "Пl" => "P'",
        "р" => "r",
        "Р" => "R",
        "с" => "s",
        "С" => "S",
        "т" => "t",
        "Т" => "T",
        "тI" => "t'",
        "ТI" => "T'",
        "тӀ" => "t'",
        "ТӀ" => "T'",
        "тl" => "t'",
        "Тl" => "T'",
        "т1" => "t'",
        "Т1" => "T'",
        "у" => "u",
        "У" => "U",
        "уь" => "y",
        "Уь" => "Y",
        "ф" => "f",
        "Ф" => "F",
        "х" => "x",
        "Х" => "X",
        "хъ" => "qh",
        "Хъ" => "Qh",
        "хь" => "x'",
        "Хь" => "X'",
        "ц" => "c",
        "Ц" => "C",
        //Ӏ иная палочка
        "цӀ" => "c'",
        "цI" => "c'",
        "ЦI" => "C'",
        "ц1" => "c'",
        "Ц1" => "C'",
        "цl" => "c'",
        "Цl" => "C'",
        "ч" => "ch",
        "Ч" => "Ch",
        "чI" => "ch'",
        "ЧI" => "Ch'",
        "ч1" => "ch'",
        "Ч1" => "Ch'",
        "чl" => "ch'",
        "Чl" => "Ch'",
        "ш" => "sh",
        "Ш" => "Sh",
        "щ" => "sh",
        "Щ" => "Sh",
        "ы" => "i",
        "Ы" => "I",
        "ъ" => "'",
        "ь" => "'",
        "э" => "e",
        "Э" => "E",
        "ю" => "y",
        "-ю" => "-yu",
        " ю" => " yu",
        "ою" => "оyu",
        "ию" => "iyu",
        "Ю" => "Yu",
        "я" => "ya",
        " я" => " ya",
        "ья" => "iya",
        "я" => "ya",
        "Я" => "Ya",
        " я" => " ya",
        " США" => " USA",
        "\n" => "<br>"
    ];


    for($i=0; $i < count($arrayText); $i++) {
        $doubleSymbol = [
            $arrayText[$i],
            $arrayText[$i+1]
        ];
        $threeSymbol = [
            $arrayText[$i],
            $arrayText[$i+1],
            $arrayText[$i+2]
        ];
        $fourSymbol = [
            $arrayText[$i],
            $arrayText[$i+1],
            $arrayText[$i+2],
            $arrayText[$i+3]
        ];
        $doubleSymbol = implode("", $doubleSymbol);
        $threeSymbol = implode("", $threeSymbol);
        $fourSymbol = implode("", $fourSymbol);

        //echo $doubleSymbol;
        //echo '<br>';
        if (array_key_exists($fourSymbol, $arraySimbolKey)){
            $newArrayText[$i] = $arraySimbolKey[$fourSymbol];
            //echo $newArrayText[$i];
            $i+=3;
        } else if (array_key_exists($threeSymbol, $arraySimbolKey)){
            $newArrayText[$i] = $arraySimbolKey[$threeSymbol];
            //echo $newArrayText[$i];
            $i+=2;
        } else if (array_key_exists($doubleSymbol, $arraySimbolKey)){
            $newArrayText[$i] = $arraySimbolKey[$doubleSymbol];
            //echo $newArrayText[$i];
            $i++;
        } else if (array_key_exists("$arrayText[$i]", $arraySimbolKey)) {
            $newArrayText[$i] = $arraySimbolKey[$arrayText[$i]];
            //echo $newArrayText[$i];
            //echo '<br>';
        }
        else {
            $newArrayText[$i] = $arrayText[$i];
        }
    }
    $printText = implode("", $newArrayText);
    echo "<hr>";
    echo '<p>' . $printText . '</p>';
    echo "<hr>";
    echo "<br><br>";
    echo '<a style="text-decoration: underline;" href="/lezgi-translit/index.php">Кьулухъ хъфин</a>';




}
else
{
    header("Location: index.php");
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>