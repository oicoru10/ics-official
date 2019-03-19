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
$servername = "remotemysql.com:3306";
$username = "OOd1POc2ro";
$password = "EtMy0i5bdp";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";
// $display = $array['displayName'];
// echo $display;
// Create connection
 $idTo = 'U1433d8e7fabdefa79463b15e1924b4d0'.
   $sql = "SELECT Id_line, Name FROM Member Where Id_line = '" . $idTo . "'";
   $result_sql = $conn->query($sql);
   if ($result_sql->num_rows > 0) {
	   $row = $result_sql->fetch_assoc();
    // output data of each row
    // while($row = $result->fetch_assoc()) {
        echo "id: " . $row["id"]. " - Name: " . $row["Name"];
    }

?>
