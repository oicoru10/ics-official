<?php
  echo "สวัสดี LINE BOT";
echo "<BR>";
// $access_token = 'tpTjAZ5RC1rcUiqnVXDeVgdQJ0f+u0zf9MOYZQGlRlcEk64J6zH+QBpeZiJNjcfcY2R/8a25i+Nuir5h1c1FT9gg7GLKRjmtplSoPvF7lAgiTvdNMoscrt8aCG3aAD1irfEQjjDY2o+52Oq74j0MmQdB04t89/1O/w1cDnyilFU=';
// $userid = 'u1433d8e7fabdefa79463b15e1924b4d0';
// $url = 'https://api.line.me/v2/bot/profile/'.$userid;
// $headers = array('authorization: bearer ' . $access_token);
// $ch = curl_init($url);
// curl_setopt($ch, curlopt_returntransfer, true);
// curl_setopt($ch, curlopt_httpheader, $headers);
// curl_setopt($ch, curlopt_followlocation, 1);
// $result = curl_exec($ch);
// curl_close($ch);
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

// $arraypostdata['messages'][0]['type'] = "text";
// $arraypostdata['messages'][0]['text'] = "เลือกประเภทลา";

// $arraypostdata['messages'][0]['quickReply']['items'][0]['type'] = "action";
// $arraypostdata['messages'][0]['quickReply']['items'][0]['imageUrl'] = "https://cdn1.iconfinder.com/data/icons/mix-color-3/502/Untitled-1-512.png";
// $arraypostdata['messages'][0]['quickReply']['items'][0]['action']['type'] = "message";
// $arraypostdata['messages'][0]['quickReply']['items'][0]['action']['label'] = "Message";
// $arraypostdata['messages'][0]['quickReply']['items'][0]['action']['text'] = "ลาป่วย";

// $arraypostdata['messages'][0]['quickReply']['items'][1]['type'] = "action";
// $arraypostdata['messages'][0]['quickReply']['items'][1]['action']['type'] = "postback";
// $arraypostdata['messages'][0]['quickReply']['items'][1]['action']['label'] = "Postback";
// $arraypostdata['messages'][0]['quickReply']['items'][1]['action']['data'] = "action=buy&itemid=123";
// $arraypostdata['messages'][0]['quickReply']['items'][1]['action']['displayText'] = "Buy";

// $json_string = '[' . $result . ']';
// $array = json_decode($json_string);

// $data = json_encode($arraypostdata);
// $json = 'apiBlockTicketRequest:'.$data;
// echo $json;

// echo $json;
$idTo = 'Test';
$str = '{
					  "to": "'. $idTo . '"
					  "messages": [
						{
						  "type": "text",
						  "text": "เลือกประเภทลา",
						  "quickReply": {
							"items": [
							  {
								"type": "action",
								"action": {
								  "type": "cameraRoll",
								  "label": "Camera Roll"
								}
							  },
							  {
								"type": "action",
								"action": {
								  "type": "camera",
								  "label": "Camera"
								}
							  },
							  {
								"type": "action",
								"action": {
								  "type": "location",
								  "label": "Location"
								}
							  },
							  {
								"type": "action",
								"imageUrl": "https://cdn1.iconfinder.com/data/icons/mix-color-3/502/Untitled-1-512.png",
								"action": {
								  "type": "message",
								  "label": "Message",
								  "text": "Hello World!"
								}
								},
							  {
								"type": "action",
								"action": {
								  "type": "postback",
								  "label": "Postback",
								  "data": "action=buy&itemid=123",
								  "displayText": "Buy"
								}
								},
							  {
								"type": "action",
								"imageUrl": "https://icla.org/wp-content/uploads/2018/02/blue-calendar-icon.png",
								"action": {
								  "type": "datetimepicker",
								  "label": "Datetime Picker",
								  "data": "storeId=12345",
								  "mode": "datetime",
								  "initial": "2018-08-10t00:00",
								  "max": "2018-12-31t23:59",
								  "min": "2018-08-01t00:00"
								}
							  }
							]
						  }
						}
					   ]
					}';
	
	$json = json_decode($str, true);
	echo $json;
	print_r($json);
	echo $str;
// $display = $array['displayName'];
// echo $display;

?>
