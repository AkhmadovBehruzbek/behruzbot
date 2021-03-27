<?php 
echo "hello world";
    define('API_KEY', '1640307159:AAGVcT5S69YSZNPi2C476y0ISSRm93eCPvk');
    $Manager = "1322664602";
    
    function bot($method, $datas=[]) {
        $url = "https://api.telegram.org".API_KEY."/".$method;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
        
        $res = curl_exec($ch);

        if (!curl_error($ch)) return json_decode($res);
    };

    function html ($text) {
        return str_replace(['<','>'],['&#60','&#62;'], $text);
    };
    
    $update = json_decode(file_get_contents('php://input'));

    // testlog
    file_put_contents("log.txt", file_get_contents('php://input'));

    $myfile = fopen("log.txt", "r") or die("Unable to open file!");
    echo fread($myfile,filesize("log.txt"));
    fclose($myfile);
    


?>
