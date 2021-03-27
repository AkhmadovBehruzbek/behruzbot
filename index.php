<?php 
    define('API_KEY', '1712032695:AAH81uQUOCsAf3umM_IzjGtUYF5jBa_N8mw');

    function bot ($method, $datas=[]) {
        $url = "https://api.telegram.org/bot".API_KEY."/".$method;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
        $res = curl_exec($ch);
        if (curl_error($ch)) {
            var_dump(curl_error($ch));
        } else {
            return json_decode($res);
        }
    }

    // typing... function
    function typing ($ch) {
        return bot('sendChatAction', [
            'chat_id' => $ch,
            'action' => 'typing',
        ]);
    }

    $update = json_decode(file_get_contents('php://input'));
    $message = $update->message;
    $chat_id = $message->chat->id;
    $tx = $message->text;

    if (isset($text)) {
        typing($chat_id);
    }

    if ($text == "/start") {
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "Assalomu alaykum",
            'parse_mode' => 'markdown',
        ]);
    }

?>
