<?
class TelegramAPI {
    private $token;

    function __construct($token)
    {
        $this->token = $token;
    }


    public function getToken()
    {
        return $this->token;
    }

    function curl_send($str){
        $url = "https://api.telegram.org/bot" . $this->token . $str;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, $url);
        $response = curl_exec($ch);

        $response = json_decode($response, true);
        //echo '<pre>';
        //print_r($response);
        //echo '</pre>';
        curl_close($ch);

        if($response) {
            file_put_contents('newfileSend.php', print_r($str, 1), 8);
            file_put_contents('newfileSend.php', print_r($response, 1), 8);
        }

        return $response;
    }

    function curl_send_post($str, $method){
        $url = "https://api.telegram.org/bot" . $this->token . '/' . $method;

        $headers = array(
            //'Content-Type: application/pdf'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($str));
        curl_setopt($ch, CURLOPT_URL, $url);

        $response = curl_exec($ch);

        $response = json_decode($response, true);
        //echo '<pre>';
        //print_r($response);
        //echo '</pre>';
        curl_close($ch);

        if($response) {
            file_put_contents('newfileSend.php', print_r($response, 1), 8);
        }

        return $response;
    }

    function sendMessagePost($chat_id, $text, string $parse_mode = NULL, bool $disable_web_page_preview = NULL, bool $disable_notification = NULL, int $reply_to_message_id = NULL, $reply_markup = NULL){
        $str = array();
        if($text !== NULL) $str['chat_id'] = $chat_id;
        if($text !== NULL) $str['text'] = $text;
        if($parse_mode !== NULL) $str['parse_mode'] = $parse_mode;
        if($disable_web_page_preview !== NULL) $str['disable_web_page_preview'] = $disable_web_page_preview;
        if($disable_notification !== NULL) $str['disable_notification'] = $disable_notification;
        if($reply_to_message_id !== NULL) $str['reply_to_message_id'] = $reply_to_message_id;
        if($reply_markup !== NULL) $str['reply_markup'] = $reply_markup;
        return $this->curl_send_post($str, 'sendMessage');
    }

    function sendDocumentPost($chat_id, $document, $thumb = NULL, $caption = NULL, string $parse_mode = NULL, bool $disable_notification = NULL, int $reply_to_message_id = NULL, $reply_markup = NULL){
        $str = array();
        if($chat_id !== NULL) $str['chat_id'] = $chat_id;
        if($document !== NULL) $str['document'] = $document;
        if($thumb !== NULL) $str['thumb'] = $thumb;
        if($caption !== NULL) $str['caption'] = $caption;
        if($parse_mode !== NULL) $str['parse_mode'] = $parse_mode;
        if($disable_notification !== NULL) $str['disable_notification'] = $disable_notification;
        if($reply_to_message_id !== NULL) $str['reply_to_message_id'] = $reply_to_message_id;
        if($reply_markup !== NULL) $str['reply_markup'] = $reply_markup;
        return $this->curl_send_post($str, 'sendDocument');
    }

    function sendDocument($chat_id, $document){
        $str = '/sendDocument?chat_id=' . $chat_id . '&document=' . $document;
        return $this->curl_send($str);
    }

    function sendMessage($chat_id, $text, string $parse_mode = NULL, bool $disable_web_page_preview = NULL, bool $disable_notification = NULL, int $reply_to_message_id = NULL, $reply_markup = NULL){
        $str = '/sendMessage?chat_id=' . $chat_id . '&text=' . $text;
        if($parse_mode !== NULL) $str .= '&parse_mode=' . $parse_mode;
        if($disable_web_page_preview !== NULL) $str .= '&disable_web_page_preview=' . $disable_web_page_preview;
        if($disable_notification !== NULL) $str .= '&disable_notification=' . $disable_notification;
        if($reply_to_message_id !== NULL) $str .= '&reply_to_message_id=' . $reply_to_message_id;
        if($reply_markup !== NULL) $str .= '&reply_markup=' . $reply_markup;
        return $this->curl_send($str);
    }

    function editMessageReplyMarkup($chat_id = NULL, int $message_id = NULL, string $inline_message_id = NULL, $reply_markup = NULL){
        $str = '/editMessageReplyMarkup?';
        if($chat_id !== NULL) $str .= '&chat_id=' . $chat_id;
        if($message_id !== NULL) $str .= '&message_id=' . $message_id;
        if($inline_message_id !== NULL) $str .= '&inline_message_id=' . $inline_message_id;
        if($reply_markup !== NULL) $str .= '&reply_markup=' . $reply_markup;
        return $this->curl_send($str);
    }

    function getFile(string $file_id){
        $str = '/getFile?';
        if($file_id !== NULL) $str .= '&file_id=' . $file_id;
        return $this->curl_send($str);
    }

    function editMessageText($chat_id = NULL, $message_id = NULL, string $inline_message_id = NULL, $text, string $parse_mode = NULL,  bool $disable_web_page_preview = NULL, $reply_markup = NULL){
        $str = '/editMessageText?';
        if($chat_id !== NULL) $str .= '&chat_id=' . $chat_id;
        if($message_id !== NULL) $str .= '&message_id=' . $message_id;
        if($inline_message_id !== NULL) $str .= '&inline_message_id=' . $inline_message_id;
        $str .= '&text=' . $text;
        if($parse_mode !== NULL) $str .= '&parse_mode=' . $parse_mode;
        if($disable_web_page_preview !== NULL) $str .= '&disable_web_page_preview=' . $disable_web_page_preview;
        if($reply_markup !== NULL) $str .= '&reply_markup=' . $reply_markup;
        return $this->curl_send($str);
    }

    function answerCallbackQuery(string $callback_query_id, string $text = NULL, bool $show_alert = NULL, string $url = NULL, int $cache_time = NULL){
        $str = '/answerCallbackQuery?';
        $str .= 'callback_query_id=' . $callback_query_id;
        if($text !== NULL) $str .= '&text=' . $text;
        if($show_alert !== NULL) $str .= '&show_alert=' . $show_alert;
        if($url !== NULL) $str .= '&url=' . $url;
        if($cache_time !== NULL) $str .= '&cache_time=' . $cache_time;
        return $this->curl_send($str);
    }

    function getWebhook(){
        function objectToArray($d) {
            if (is_object($d)) {
                $d = get_object_vars($d);
            }
            if (is_array($d)) {
                return array_map(__FUNCTION__, $d);
            }
            return $d;
        }

        if($json_str = file_get_contents('php://input')) { //получить из POST
            file_put_contents('newfile.php', serialize(objectToArray(json_decode($json_str))));
        }
        $response = unserialize(file_get_contents('newfile.php'));
        return $response;
    }

    //запускать только один раз
    function setWebhook(string $url, int $max_connections = NULL){
        $str = '/setWebhook?url=' . $url;
        if($max_connections !== NULL) $str .= '&max_connections=' . $max_connections;
        return $this->curl_send($str);
    }

    function deleteWebhook(){
        $str = '/deleteWebhook';
        return $this->curl_send($str);
    }

    function answerInlineQuery(string $inline_query_id = '', array $results = [])
    {
        $str = '/answerInlineQuery';
        if($inline_query_id !== '')
        {
            $str .= '?inline_query_id=' . $inline_query_id;
            if($results)
                $str .= '&results=' . json_encode($results);
            return $this->curl_send($str);
        }

    }
}

/*
//
$arr = ['keyboard' =>
            [
                [
                    ['text' => 'Обновить список заказов', 'callback_data' => 'jkjd']
                ],
            ],
            'resize_keyboard' => true,
        ];

//
$arr = ['inline_keyboard'=>
            [
                [
                    ['text' => 'Подтвердить оплату заказа', 'callback_data' => 'jkj']
                ],
                [
                    ['text' => 'Отменить заказ', 'callback_data' => 'jkjd']
                ]

            ]
        ];

        $arr = json_encode($arr);

        $a = $query->sendMessage($response["message"]["chat"]["id"], $text, NULL, NULL, NULL, $response["message"]["message_id"], $arr);
        echo '<pre>Результат исходящего запроса';
        print_r($a);
        echo '</pre>';

//
elseif ($response["callback_query"]["data"] === "jkj") {
        $query->sendMessage("Кнопка нажата", "", $arParams["TOKEN"], $response["callback_query"]["message"]["chat"]["id"]);


//
https://api.telegram.org/bot897279722:AAHwBCkXDmDc9fgYVIGQPrBYOqfoKMXvf-Q/setWebhook?url=https://zapchasti.lek.world/test/?bot_id=897279722:AAHwBCkXDmDc9fgYVIGQPrBYOqfoKMXvf-Q



*/
?>