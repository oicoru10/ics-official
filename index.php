<?php
  echo "สวัสดี LINE BOT";

$access_token = '/djoa67lcuk/1wt/ylqbhgrvcqh/bta2h+6oc9c2yt3n2yobvegfxxlaw7/ccx5by2r/8a25i+nuir5h1c1ft9gg7glkrjmtplsopvf7lail9afvsbnqv7eslubstxwghclojbwfeawgynhov9/7aqdb04t89/1o/w1cdnyilfu=';
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
//$json_string = '[{"productId":"epIJp9","name":"Product A","amount":"5","identifier":"242"},{"productId":"a93fHL","name":"Product B","amount":"2","identifier":"985"}]';

//$array = json_decode($json_string);

//foreach ($array as $value)
//{
   //echo $value->productId; // epIJp9
   //echo $value->name; // Product A
//}
$json_string = '[' . $result . ']';
$array = json_decode($json_string);

$data =json_encode($array);
$json='apiBlockTicketRequest:'.$data;
echo $json;
$display = $array['displayName'];
echo $display;

$mystring = 'bac';
$findme   = 'a';
$pos = strpos($mystring, $findme);

// Note our use of ===.  Simply == would not work as expected
// because the position of 'a' was the 0th (first) character.
if ($pos === false) {
    echo "The string '$findme' was not found in the string '$mystring'";
} else {
    echo "The string '$findme' was found in the string '$mystring'";
    echo " and exists at position $pos";
}
?>
