<?php 
    date_default_timezone_set('Asia/Tashkent');
    define('API_KEY', '1640307159:AAGVcT5S69YSZNPi2C476y0ISSRm93eCPvk');

    $Manager = "1322664602";
    $company = "@magical_codes";
    // bot function
    function bot ($method, $datas = []) {
        $url = "https://api.telegram.org/bot".API_KEY."/".$method;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
        $res = curl_exec($ch);
        if (!curl_error($ch)) return json_decode($res);
    }
    // html function
    function html($text) {
        return str_replace(['<','>'],['&#60;','&#62;'], $text);
    }

    $update = json_decode(file_get_contents('php://input'));

    // log file 
    file_put_contents("log.txt", file_get_contents('php://input'));

    // variables
    $message = $update->message;
    $text = html($message->text);
    $chat_id = $message->chat->id;
    $from_id = $message->from->id;
    $message_id = $message->message_id;
    $first_name = $message->from->first_name;
    $last_name = $message->from->last_name;
    $full_name = html($first_name." ".$last_name);

    //replymessage
    $reply_to_message = $message->reply_to_message;
    $reply_chat_id = $message->reply_to_message->forward_from->id;
    $reply_text = $message->text;

    // Klient 
    if ($chat_id !== $Manager) {
        if ($text == "/start") {
            $reply = "Assalomu alaykum aa";

            bot('sendMessage', [
                'chat_id' => $chat_id,
                'text' => $reply,
                'parse_mode' => "HTML",
            ]);
        }
    } else if ($text == $Manager) {
        if ($text == "/start") {
            bot('sendMessage',[
                'chat_id' => $admin,
                'text' => "salom admin",
                'parse_mode' => "HTML",
            ]);
        }
    }
?>
