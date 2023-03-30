<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php";
require_once $_SERVER["DOCUMENT_ROOT"]. "/local/classes/TelegramAPI.php";

function sendAnswer($title, $detail)
{

}
//$query = new TelegramAPI("6010009572:AAEoM-6aMbqNjxHNV1gEMhTY3XYJklyaC7U");
$query = new TelegramAPI("6224918354:AAGStxz1ERTGUI2T5P212-ab8qaftbG9pa0");
$response = $query->getWebhook();
\Bitrix\Main\Diag\Debug::dump($response);
if($inlineId = $response["inline_query"]["id"])
    if($response["inline_query"]["query"]){
        if($dictionaryFile = file_get_contents($_SERVER["DOCUMENT_ROOT"].'/rusLezDictionary.json'))
        {
            $dictionary = unserialize($dictionaryFile);
        }
        else
        {
            $file = file_get_contents($_SERVER["DOCUMENT_ROOT"]."/rus_lezgi_dict_hajiyev.json");
            $file = json_decode($file, 1);
            $dictionary = [];
            foreach ($file["dictionary"] as $value)
            {
                $dictionary[$value["spelling"]][] = $value["definitions"];
            }
            file_put_contents($_SERVER["DOCUMENT_ROOT"].'/rusLezDictionary.json', serialize($dictionary));
        }

        echo $response["inline_query"]["query"];
        echo mb_strtoupper($response["inline_query"]["query"]);
        //var_dump(array_search(mb_strtoupper($response["inline_query"]["query"]), $dictionary));


        $queryStr = mb_strtoupper($response["inline_query"]["query"]);
        //\Bitrix\Main\Diag\Debug::dump($dictionary[$queryStr]);
        if(array_key_exists($queryStr, $dictionary))
        {
            $messageContent = [];
            foreach ($dictionary[$queryStr] as $k=>$v)
            {
                $messageContent[] =
                    [
                        'type' => 'article',
                        'id' => $k."12",
                        'title' => mb_substr($v[0], 0, 50),
                        'input_message_content' =>
                            [
                                "message_text"=> $queryStr."
".implode('.

',$v),
                                "parse_mode" => 'Markdown'
                            ]
                    ];
            }
            $res = $query->answerInlineQuery(
                $inlineId,
                $messageContent
            );

        }
        else
            $res = $query->answerInlineQuery(
                $inlineId,
                [[
                    'type' => 'article',
                    'id' => '001',
                    'title' => 'ЗатIни жагъанач',
                    'input_message_content' =>
                        ["message_text"=> "ЗатIни жагъанач"]
                ]]
            );


    }
//\Bitrix\Main\Diag\Debug::dump($res);