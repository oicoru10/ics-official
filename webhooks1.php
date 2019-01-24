<?php
   $accessToken = "/DJOA67LCUK/1Wt/YlQBhgRvCQh/bTA2H+6Oc9c2yt3N2YObVEgFXxlAw7/CCx5bY2R/8a25i+Nuir5h1c1FT9gg7GLKRjmtplSoPvF7lAiL9aFvsbNQV7eSlUBsTxWGhClOjBwfeAWgYnHov9/7aQdB04t89/1O/w1cDnyilFU=";//copy ข้อความ Channel access token ตอนที่ตั้งค่า
   $channelSecret = "ef410ca44d0502656720084f014c53fa";
   $content = file_get_contents('php://input');
   $arrayJson = json_decode($content, true);
   $arrayHeader = array();
   $arrayHeader[] = "Content-Type: application/json";
   $arrayHeader[] = "Authorization: Bearer {$accessToken}";
   //รับข้อความจากผู้ใช้
   $message = $arrayJson['events'][0]['message']['text'];
   //รับ id ของผู้ใช้
   $id = $arrayJson['events'][0]['source']['userId'];
   
   $chat_id = $arrayJson['events'][0]['message']['chat']['id'];
   $first_name = $arrayJson['events'][0]['source']['displayName'];

   $url = 'https://api.line.me/v2/bot/profile/'.$id;
   $ch = curl_init($url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
   $result = curl_exec($ch);
   curl_close($ch);
   $first_name = $result['displayName'];
   #ตัวอย่าง Message Type "Text + Sticker"
   if($message == "สวัสดี")
    {
      $arrayPostData['to'] = $id;
      $arrayPostData['messages'][0]['type'] = "text";
      $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าา คุณ" . $first_name;
      $arrayPostData['messages'][1]['type'] = "sticker";
      $arrayPostData['messages'][1]['packageId'] = "2";
      $arrayPostData['messages'][1]['stickerId'] = "34";
      pushMsg($arrayHeader,$arrayPostData);
    }
   ELSEIF($message == "นับ 1-10")
      {
       for($i=1;$i<=10;$i++)
       {
          $arrayPostData['to'] = $id;
          $arrayPostData['messages'][0]['type'] = "text";
          $arrayPostData['messages'][0]['text'] = $i;
          pushMsg($arrayHeader,$arrayPostData);
       }
     }
   ELSEIF($message == "ดึงข้อมูล")
    {
      if($id == "U1433d8e7fabdefa79463b15e1924b4d0")
       {
         $arrayPostData['to'] = 'U1433d8e7fabdefa79463b15e1924b4d0';
         $arrayPostData['messages'][0]['type'] = "text";
         $arrayPostData['messages'][0]['text'] = "ข้อมูลที่ดึงได้";
         pushMsg($arrayHeader,$arrayPostData);
         
         $arrayPostData['to'] = 'U1433d8e7fabdefa79463b15e1924b4d0';
         $arrayPostData['messages'][0]['type'] = "text";
         $arrayPostData['messages'][0]['text'] = $result;
         pushMsg($arrayHeader,$arrayPostData);
       }
      else
      {
         $arrayPostData['to'] = $id;
         $arrayPostData['messages'][0]['type'] = "text";
         $arrayPostData['messages'][0]['text'] = "คุณไม่มีสิทธิ์";
         pushMsg($arrayHeader,$arrayPostData);
         
         $arrayPostData['to'] = 'U1433d8e7fabdefa79463b15e1924b4d0';
         $arrayPostData['messages'][0]['type'] = "text";
         $arrayPostData['messages'][0]['text'] = "มีคนดึงข้อมูล";
         pushMsg($arrayHeader,$arrayPostData);
         
         $arrayPostData['to'] = 'U1433d8e7fabdefa79463b15e1924b4d0';
         $arrayPostData['messages'][0]['type'] = "text";
         $arrayPostData['messages'][0]['text'] = $result;
         pushMsg($arrayHeader,$arrayPostData);
      }
    }
   ELSE
     {
      $arrayPostData['to'] = $id;
      $arrayPostData['messages'][0]['type'] = "text";
      $arrayPostData['messages'][0]['text'] = "ฉันไม่เข้าใจ";
      pushMsg($arrayHeader,$arrayPostData);
    }
   function pushMsg($arrayHeader,$arrayPostData){
      $strUrl = "https://api.line.me/v2/bot/message/push";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$strUrl);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $result = curl_exec($ch);
      curl_close ($ch);
   }
   exit;
?>
