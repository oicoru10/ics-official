<?php
  echo "สวัสดี LINE BOT";

$access_token = '/DJOA67LCUK/1Wt/YlQBhgRvCQh/bTA2H+6Oc9c2yt3N2YObVEgFXxlAw7/CCx5bY2R/8a25i+Nuir5h1c1FT9gg7GLKRjmtplSoPvF7lAiL9aFvsbNQV7eSlUBsTxWGhClOjBwfeAWgYnHov9/7aQdB04t89/1O/w1cDnyilFU=';
$userId = 'U1433d8e7fabdefa79463b15e1924b4d0';
$url = 'https://api.line.me/v2/bot/profile/'.$userId;
$headers = array('Authorization: Bearer ' . $access_token);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);
//echo "<BR>";
//$ar = explode('"', $result, -1);
//var_dump($ar);
//echo "<BR>";
//$array = json_decode( $result);
//$testname = $array[0]['displayName'];
//echo $testname;
//echo "<BR>";
//echo 'test';
echo "<BR>";
//$json_string = '[{"productId":"epIJp9","name":"Product A","amount":"5","identifier":"242"},{"productId":"a93fHL","name":"Product B","amount":"2","identifier":"985"}]';

//$array = json_decode($json_string);

//foreach ($array as $value)
//{
   //echo $value->productId; // epIJp9
   //echo $value->name; // Product A
//}
 $json_string = '[' . $result . ']';
$array = json_decode($json_string);

echo $array->displayName;

?>
