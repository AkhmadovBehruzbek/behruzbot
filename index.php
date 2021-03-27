<?
date_default_timezone_set('Asia/Tashkent');
define('API_KEY', '1640307159:AAGVcT5S69YSZNPi2C476y0ISSRm93eCPvk');
$Manager = "1322664602";
$compane = "infomir.uz LTD";
function bot($method, $datas = []){
    $url = "https://api.telegram.org/bot".API_KEY."/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    curl_close($ch);
    if (!curl_error($ch)) return json_decode($res);
};
function html($text){
    return str_replace(['<','>'],['&#60;','&#62;'],$text);
};

$update = json_decode(file_get_contents('php://input'));
// testlog
//file_put_contents("log.txt",file_get_contents('php://input'));
// message variables
$message = $update->message;
$text = html($message->text);
$chat_id = $message->chat->id;
// $from_id = $message->from->id;
// $message_id = $message->message_id;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$full_name = html($first_name . " " . $last_name);

// // replymessage
// $reply_to_message = $message->reply_to_message;
// $reply_chat_id = $message->reply_to_message->forward_from->id;
// $reply_text = $message->text;


// Agar yozgan odam $Manager bo'lmasa ushbu kod qismiga kiramiz
// if ($chat_id != $Manager) {
    // Agar yozilgan habar /start bolsa, yani yangi foydalanuvchi
    //  botni ishga tushursa ushbu kod bajariladi
    if ($text == "/start") {
        $reply = "Assalom Alaykum <b>" . $full_name . "</b>, " . $compane . " Qabul Botiga Xush Kelibsiz !\nMurojat Yo'llashingiz Mumkin 👇";
        bot('sendmessage', [ // maxsus bot funksiyamiz orqali sendmessage ga
            'chat_id' => $chat_id, //foydalanuvchi id raqami va
            'text' => $reply, // habar matnini
            'parse_mode' => "HTML", //html formatda yuboramiz.
        ]);
}
