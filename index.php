<?php
   $num = "+55888888888888";
   $url = "https://api.telegram.org/bot"._TELEGRAM_BOT_TOKEN."/sendContact?chat_id=".$chat_id."&phone_number=".$num."&first_name=".$first_name;
  $response = file_get_contents($url, false, NULL);
  $jsondata = json_decode($response,true);
  echo "<pre>";
  print_r($jsondata);
  echo "</pre><br>";
?>
