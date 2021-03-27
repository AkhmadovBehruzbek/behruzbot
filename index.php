<?php 
	$botToken = "1640307159:AAGVcT5S69YSZNPi2C476y0ISSRm93eCPvk";
	$website = "https://api.telegram.org/bot".$botToken;

	function curl_get_contents($url) {
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);

		$data = curl_exec($ch);
		curl_close($ch);

		return $data;
	}

	$update = curl_get_contents($website."php://input");

    $updateArray = json_decode($update, TRUE);

    $chat_id = $updateArray["result"][0]["message"]["chat"]["id"];

    $first_name = $updateArray["result"]["0"]["message"]["from"]["first_name"];

    curl_get_contents($website."/sendMessage?chat_id=".$chat_id."&text=Assalomu alaykum, ".$first_name);
    
    echo $first_name;
    
    print_r($chat_id);
    ?>
