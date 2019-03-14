<?php
  echo "สวัสดี LINE BOT";
echo "<BR>";
$access_token = 'tpTjAZ5RC1rcUiqnVXDeVgdQJ0f+u0zf9MOYZQGlRlcEk64J6zH+QBpeZiJNjcfcY2R/8a25i+Nuir5h1c1FT9gg7GLKRjmtplSoPvF7lAgiTvdNMoscrt8aCG3aAD1irfEQjjDY2o+52Oq74j0MmQdB04t89/1O/w1cDnyilFU=';
$userid = 'u1433d8e7fabdefa79463b15e1924b4d0';
$url = 'https://api.line.me/v2/bot/profile/'.$userid;
$headers = array('authorization: bearer ' . $access_token);
$ch = curl_init($url);
curl_setopt($ch, curlopt_returntransfer, true);
curl_setopt($ch, curlopt_httpheader, $headers);
curl_setopt($ch, curlopt_followlocation, 1);
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
//$json_string = '[	{"productId":"epIJp9","name":"Product A","amount":"5","identifier":"242"},{"productId":"a93fHL","name":"Product B","amount":"2","identifier":"985"}]';

//$array = json_decode($json_string);

//foreach ($array as $value)
//{
   //echo $value->productId; // epIJp9
   //echo $value->name; // Product A
//}

$arrayPostData['to'] = 'U1433d8e7fabdefa79463b15e1924b4d0';
$arraypostdata['messages'][0]['type'] = "text";
$arraypostdata['messages'][0]['text'] = "เลือกประเภทลา";
$arraypostdata['messages'][0]['quickreply']['items'][0]['type'] = "action";
$arraypostdata['messages'][0]['quickreply']['items'][0]['action']['type'] = "message";
$arraypostdata['messages'][0]['quickreply']['items'][0]['action']['label'] = "message";
$arraypostdata['messages'][0]['quickreply']['items'][0]['action']['text'] = "ลาป่วย";

// $json_string = '[' . $result . ']';
// $array = json_decode($json_string);

$data = json_encode($arraypostdata);
$json = 'apiBlockTicketRequest:'.$data;
echo $json;

$arrayPostData1['to'] = 'U1433d8e7fabdefa79463b15e1924b4d0';
$arrayPostData1['messages'][0]['type'] = "text";
$arrayPostData1['messages'][0]['text'] = "สวัสดีจ้าา คุณ ";
echo "<BR>";
$data1 = json_encode($arraypostdata1);
$json1 = 'apiBlockTicketRequest:'.$data1;
echo $json1;
// $display = $array['displayName'];
// echo $display;

?>
