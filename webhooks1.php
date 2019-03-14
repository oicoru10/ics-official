<?php
   $accessToken = "tpTjAZ5RC1rcUiqnVXDeVgdQJ0f+u0zf9MOYZQGlRlcEk64J6zH+QBpeZiJNjcfcY2R/8a25i+Nuir5h1c1FT9gg7GLKRjmtplSoPvF7lAgiTvdNMoscrt8aCG3aAD1irfEQjjDY2o+52Oq74j0MmQdB04t89/1O/w1cDnyilFU=";//copy ข้อความ Channel access token ตอนที่ตั้งค่า
   $channelSecret = "ef410ca44d0502656720084f014c53fa";
   $content = file_get_contents('php://input');
   $arrayJson = json_decode($content, true);
   $arrayHeader = array();
   $arrayHeader[] = "Content-Type: application/json";
   $arrayHeader[] = "Authorization: Bearer {$accessToken}";
   
   $type = $arrayJson['events'][0]['type'];
   $replyToken = $arrayJson['events'][0]['type']['replyToken'];
   //รับข้อความจากผู้ใช้
   $message = $arrayJson['events'][0]['message']['text'];
   //รับ id ของผู้ใช้
   $id = $arrayJson['events'][0]['source']['userId'];
   $id_g = $arrayJson['events'][0]['source']['groupId'];
   $id_r = $arrayJson['events'][0]['source']['roomId'];
   
   $idTo = $id;
   if(!is_null($id_g))
   {
      $idTo = $id_g;
   }
   
   if(!is_null($id_r))
   {
      $idTo = $id_r;
   }

   $url = 'https://api.line.me/v2/bot/profile/'.$id;
   $ch = curl_init($url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
   $result = curl_exec($ch);
   curl_close($ch);
   $json_string = '[' . $result . ']';
   $Profile = json_decode($json_string);
   $jsData = 'DATA:' . $arrayJson['events'][0];
   foreach ($Profile as $value)
   {
      $DisplayName = $value->displayName;
      $pic = $value->pictureUrl;
      $status = $value->statusMessage;
   }
   if($type == "follow")
   {
      $arrayPostData['to'] = $idTo;
      $arrayPostData['messages'][0]['type'] = "text";
      $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าา คุณ " . $DisplayName . "ขอบคุณที่เพิ่มเพื่อนนะะะะะ";
      pushMsg($arrayHeader,$arrayPostData);
   }
   elseif($type == "unfollow")
   {
      $arrayPostData['to'] = $idTo;
      $arrayPostData['messages'][0]['type'] = "text";
      $arrayPostData['messages'][0]['text'] = "ม่ายยยย";
      pushMsg($arrayHeader,$arrayPostData);
   }
   elseif($type == "join")
   {
      $arrayPostData['to'] = $idTo;
      $arrayPostData['messages'][0]['type'] = "text";
      $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าา ทุกโคนนน";
      pushMsg($arrayHeader,$arrayPostData);
   }
   elseif($type == "memberJoined")
   {
      $arrayPostData['to'] = $idTo;
      $arrayPostData['messages'][0]['type'] = "text";
      $arrayPostData['messages'][0]['text'] = "ยินดีตอนรับน้าาาา";
      pushMsg($arrayHeader,$arrayPostData);
   }
   elseif($type == "message")
   {   
      
   #ตัวอย่าง Message Type "Text + Sticker"
   if( strpos($message, 'สวัสดี') !== false )
    {
      $arrayPostData['to'] = $idTo;
      $arrayPostData['messages'][0]['type'] = "text";
      $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าา คุณ " . $DisplayName;
      pushMsg($arrayHeader,$arrayPostData);
      
      $arrayPostData['to'] = $idTo;
      $arrayPostData['messages'][0]['type'] = "text";
      $arrayPostData['messages'][0]['text'] = $status;
      $arrayPostData['messages'][1]['type'] = "sticker";
      $arrayPostData['messages'][1]['packageId'] = "2";
      $arrayPostData['messages'][1]['stickerId'] = "34";
      pushMsg($arrayHeader,$arrayPostData);
      
      $arrayPostData['to'] = $idTo;
      $arrayPostData['messages'][0]['type'] = "image";
      $arrayPostData['messages'][0]['originalContentUrl']= $pic;
      $arrayPostData['messages'][0]['previewImageUrl'] = $pic;
      pushMsg($arrayHeader,$arrayPostData);
    }
   ELSEIF($message == "นับ 1-10")
      {
       for($i=1;$i<=10;$i++)
       {
          $arrayPostData['to'] = $idTo;
          $arrayPostData['messages'][0]['type'] = "text";
          $arrayPostData['messages'][0]['text'] = $i;
          pushMsg($arrayHeader,$arrayPostData);
       }
     }
   ELSEIF( strpos($message, 'ลางาน') !== false )
      {
          // $arrayPostData['to'] = $idto;
          // $arraypostdata['messages'][0]['type'] = "text";
          // $arraypostdata['messages'][0]['text'] = "เลือกประเภทลา";
          // $arraypostdata['messages'][0]['quickreply']['items'][0]['type'] = "action";
          // $arraypostdata['messages'][0]['quickreply']['items'][0]['action']['type'] = "message";
          // $arraypostdata['messages'][0]['quickreply']['items'][0]['action']['label'] = "message";
          // $arraypostdata['messages'][0]['quickreply']['items'][0]['action']['text'] = "ลาป่วย";
		  
		  var $js_string = ' { 
					"to": "U1433d8e7fabdefa79463b15e1924b4d0",
				  "messages": [
					{
					  "type": "text",
					  "text": "Hello Quick Reply!",
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
				}	'.
		  
		  $arrayPostData = json_decode($json_string);
          pushMsg($arrayHeader,$arrayPostData);
     }
   ELSEIF( strpos($message, 'ดึงข้อมูล') !== false )
    {
      if($id == "U1433d8e7fabdefa79463b15e1924b4d0")
       {
         $arrayPostData['to'] = 'U1433d8e7fabdefa79463b15e1924b4d0';
         $arrayPostData['messages'][0]['type'] = "text";
         $arrayPostData['messages'][0]['text'] = "ข้อมูลที่ดึงได้";
         pushMsg($arrayHeader,$arrayPostData);
         
         $arrayPostData['to'] = 'U1433d8e7fabdefa79463b15e1924b4d0';
         $arrayPostData['messages'][0]['type'] = "text";
         $arrayPostData['messages'][0]['text'] = "UserID : " . $id;
         pushMsg($arrayHeader,$arrayPostData);
         
         $arrayPostData['to'] = 'U1433d8e7fabdefa79463b15e1924b4d0';
         $arrayPostData['messages'][0]['type'] = "text";
         $arrayPostData['messages'][0]['text'] = "GroupID : " . $id_g;
         pushMsg($arrayHeader,$arrayPostData);
         
         $arrayPostData['to'] = 'U1433d8e7fabdefa79463b15e1924b4d0';
         $arrayPostData['messages'][0]['type'] = "text";
         $arrayPostData['messages'][0]['text'] = "RoomID : " .$id_r;
         pushMsg($arrayHeader,$arrayPostData);
         
         $arrayPostData['to'] = 'U1433d8e7fabdefa79463b15e1924b4d0';
         $arrayPostData['messages'][0]['type'] = "text";
         $arrayPostData['messages'][0]['text'] = "Type : " . $type;
         pushMsg($arrayHeader,$arrayPostData);
         
            
         $arrayPostData['to'] = 'U1433d8e7fabdefa79463b15e1924b4d0';
         $arrayPostData['messages'][0]['type'] = "text";
         $arrayPostData['messages'][0]['text'] = "replyToken : " . $replyToken;
         pushMsg($arrayHeader,$arrayPostData);
         
         $arrayPostData['to'] = 'U1433d8e7fabdefa79463b15e1924b4d0';
         $arrayPostData['messages'][0]['type'] = "text";
         $arrayPostData['messages'][0]['text'] = $result;
         pushMsg($arrayHeader,$arrayPostData);
        }
      else
      {
         $arrayPostData['to'] = $idTo;
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
      $arrayPostData['to'] = $idTo;
      $arrayPostData['messages'][0]['type'] = "text";
      $arrayPostData['messages'][0]['text'] = "ไม่มี Code ส่วนนี้อยู๋๋๋๋๋๋";
      pushMsg($arrayHeader,$arrayPostData);
    }
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
