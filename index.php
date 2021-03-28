<?php 
    define('API_KEY', '1640307159:AAGVcT5S69YSZNPi2C476y0ISSRm93eCPvk');

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
    $text = $message->text;

    $button = json_encode([
        'resize_keyboard' => true,
        'keyboard' => [
            [['text' => "Biz haqimizda"], ["text" => "Manzil"],],
        ]
    ]);

    $cancel = json_encode([
        'resize_keyboard' => true,
        'keyboard' => [
            [['text' => 'Ortga'],],
        ]
    ]);

    if (isset($text)) {
        typing($chat_id);
    }

    if ($text == "/start") {
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "Assalomu alaykum",
            'parse_mode' => 'markdown',
            'reply_markup' => $button,
        ]);
    }

    if ($text == "Biz haqimizda") {
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "Biz haqimizda bo'limi",
            'parse_mode' => "markdown",
            "reply_markup" => $cancel,
        ]);
    }

    if ($text == "Ortga") {
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "Sizga qanday yordam bera olishim mumkin",
            'parse_mode' => 'markdown',
            'reply_markup' => $button,
        ]);
    }

    if ($text == "Manzil") {
        bot('sendLocation', [
            'chat_id' => $chat_id,
            'latitude' => 41.341123,
            'longtitude' => 69.287298,
            'reply_markup' => $button,
        ]);
    }

?>
