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
   
   $servername = "remotemysql.com:3306";
   $username = "OOd1POc2ro";
   $password = "EtMy0i5bdp";
   $dbname = "OOd1POc2ro";

	// Create connection
   $conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
   $sql = "SELECT Id_line, Name FROM Member Where Id_line = '" . $idTo . "'";
   $result_sql = $conn->query($sql);
   if ($result_sql->num_rows > 0) {
    // output data of each row
    while($row = $result_sql->fetch_assoc()) {
		$name_db = $row["Name"];
		$id_db = $row["Id_line"];
    }
   }
    $conn->close();
   if($type == "follow")
   {
      $arrayPostData['to'] = $idTo;
      $arrayPostData['messages'][0]['type'] = "text";
	  $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าา คุณ " . $DisplayName . "ขอบคุณที่เพิ่มเพื่อนนะะะะะ";
      
      pushMsg($arrayHeader,$arrayPostData);
	  
	 $conn = new mysqli($servername, $username, $password, $dbname);
	 if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	 $sql = "INSERT INTO Member (Id_line, Name)
			VALUES ('" . $idTo . "', '" . $DisplayName . "')";

	if ($conn->query($sql) === TRUE) {
		
	} 
	$conn->close();
		
	
   }
   elseif($type == "unfollow")
   {
      $arrayPostData['to'] = $idTo;
      $arrayPostData['messages'][0]['type'] = "text";
	  $arrayPostData['messages'][0]['text'] = "อย่าทิ้งกันไป";
	  $arrayPostData['messages'][1]['type'] = "sticker";
	  $arrayPostData['messages'][1]['packageId'] = "1";
	  $arrayPostData['messages'][1]['stickerId'] = "131";
      pushMsg($arrayHeader,$arrayPostData);
	  
	  $conn = new mysqli($servername, $username, $password, $dbname);
	  if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		 $sql = "DELETE FROM Member Where Id_line = '" . $idTo . "'";

		if ($conn->query($sql) === TRUE) {
			
		} 
		$conn->close();
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
	  if ( $name_db <> null)
	  {
		  $arrayPostData['messages'][0]['text'] = "สวัสดี คุณ " . $name_db;
	  }
	  else
	  {
		  $arrayPostData['messages'][0]['text'] = "สวัสดี คุณ " . $DisplayName ;
	  }
	  $arrayPostData['messages'][1]['type'] = "text";
      $arrayPostData['messages'][1]['text'] = $status;
      $arrayPostData['messages'][2]['type'] = "sticker";
      $arrayPostData['messages'][2]['packageId'] = "2";
      $arrayPostData['messages'][2]['stickerId'] = "34";
	  $arrayPostData['messages'][3]['type'] = "image";
      $arrayPostData['messages'][3]['originalContentUrl']= $pic;
      $arrayPostData['messages'][3]['previewImageUrl'] = $pic;
      pushMsg($arrayHeader,$arrayPostData);
      
      // $arrayPostData['to'] = $idTo;
      // $arrayPostData['messages'][0]['type'] = "text";
      // $arrayPostData['messages'][0]['text'] = $status;
      // $arrayPostData['messages'][1]['type'] = "sticker";
      // $arrayPostData['messages'][1]['packageId'] = "2";
      // $arrayPostData['messages'][1]['stickerId'] = "34";
      // pushMsg($arrayHeader,$arrayPostData);
      
      // $arrayPostData['to'] = $idTo;
      // $arrayPostData['messages'][0]['type'] = "image";
      // $arrayPostData['messages'][0]['originalContentUrl']= $pic;
      // $arrayPostData['messages'][0]['previewImageUrl'] = $pic;
      // pushMsg($arrayHeader,$arrayPostData);
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
		  
		  $str = '
				    { "to": "'. $idTo . '",
					  "messages": [
						{
						  "type": "text",
						  "text": "เลือกประเภทลา",
						  "quickReply": {
							"items": [
							  {
								"type": "action",
								"action": {
								  "type": "postback",
								  "label": "ลาป่วย",
								  "data": "action=leave&itemid=00",
								  "displayText": "ลาป่วย"
								}
							  },
							  {
								"type": "action",
								"action": {
								  "type": "postback",
								  "label": "ลากิจ",
								  "data": "action=leave&itemid=01",
								  "displayText": "ลากิจ"
								}
							  },
							  {
								"type": "action",
								"action": {
								  "type": "postback",
								  "label": "ลาพักร้อน",
								  "data": "action=leave&itemid=02",
								  "displayText": "ลาพักร้อน"
								}
							  }
							]
						  }
						}
					   ]
					} ';
					
	// $str = ' { "to": "'. $idTo . '",
					 // "messages": [
					  // {
					   // "type": "flex",
					   // "altText": "This is a Flex Message",
					   // "contents": {
						// "type": "bubble",
						// "body": {
						 // "type": "box",
						 // "layout": "vertical",
						 // "spacing": "md",
						 // "contents": [
						  // {
						   // "type": "button",
						   // "style": "primary",
						   // "height": "sm",
						   // "action": {
						   // "type":"datetimepicker",
						   // "label":"Select date",
						   // "data":"action=Date_form",
						   // "mode":"datetime",
						   // "initial":"2017-12-25t00:00",
						   // "max":"2018-01-24t23:59",
						   // "min":"2017-12-25t00:00"
						   // }
						  // },
						  // {
						   // "type": "button",
						   // "style": "primary",
						   // "height": "sm",
						   // "action": {
						   // "type":"postback",
						   // "label":"ลากิจ",
						   // "data":"action=leave&itemid=111",
						   // "text":"ลากิจ"
						   // }
						  // }
						 // ]
						// }
					   // }
					  // }
					 // ]
				// } ';
	
	$json = json_decode($str, true);
	
	pushMsg($arrayHeader,$json);
		  
     }
   
  elseif( strpos($message, 'เว็บ') !== false  OR strpos($message, 'Web') !== false )
   {
	   $str = ' { "to": "'. $idTo . '",
					 "messages": [
					  {
					   "type": "flex",
					   "altText": "This is a Flex Message",
					   "contents": {
						"type": "bubble",
						"body": {
						 "type": "box",
						 "layout": "vertical",
						 "contents": [
						  {
						   "type": "button",
						   "style": "primary",
						   "height": "sm",
						   "action": {
							"type": "uri",
							"label": "ICS Web",
							"uri": "http://www.ics-th.com"
						   }
						  }
						 ]
						}
					   }
					  }
					 ]
				} ';
		$json = json_decode($str, true);
	
		pushMsg($arrayHeader,$json);
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
   elseif($type == "postback")
	{	
		$timestamp = $arrayJson['events'][0]['timestamp'];
	    $Data_p = $arrayJson['events'][0]['postback']['data'];
	    $date = $arrayJson['events'][0]['postback']['params']['datetime'];
		
		parse_str($Data_p);
				
		 // $arrayPostData['to'] = 'U1433d8e7fabdefa79463b15e1924b4d0';
         // $arrayPostData['messages'][0]['type'] = "text";
         // $arrayPostData['messages'][0]['text'] = "UserID : " . $id;
         // pushMsg($arrayHeader,$arrayPostData);
         
         // $arrayPostData['to'] = 'U1433d8e7fabdefa79463b15e1924b4d0';
         // $arrayPostData['messages'][0]['type'] = "text";
         // $arrayPostData['messages'][0]['text'] = "GroupID : " . $id_g;
         // pushMsg($arrayHeader,$arrayPostData);
         
         // $arrayPostData['to'] = 'U1433d8e7fabdefa79463b15e1924b4d0';
         // $arrayPostData['messages'][0]['type'] = "text";
         // $arrayPostData['messages'][0]['text'] = "RoomID : " .$id_r;
         // pushMsg($arrayHeader,$arrayPostData);
		
		// $arrayPostData['to'] = 'U1433d8e7fabdefa79463b15e1924b4d0';
	    // $arrayPostData['messages'][0]['type'] = "text";
	    // $arrayPostData['messages'][0]['text'] = "Type : " . $type;
	    // pushMsg($arrayHeader,$arrayPostData);
		
		// $arrayPostData['to'] = 'U1433d8e7fabdefa79463b15e1924b4d0';
        // $arrayPostData['messages'][0]['type'] = "text";
        // $arrayPostData['messages'][0]['text'] = "timestamp : " . $arrayJson['events'][0]['timestamp'];
        // pushMsg($arrayHeader,$arrayPostData);
		
		// $arrayPostData['to'] = 'U1433d8e7fabdefa79463b15e1924b4d0';
        // $arrayPostData['messages'][0]['type'] = "text";
        // $arrayPostData['messages'][0]['text'] = "data : " . $arrayJson['events'][0]['postback']['data'];
        // pushMsg($arrayHeader,$arrayPostData);
		
		// $arrayPostData['to'] = 'U1433d8e7fabdefa79463b15e1924b4d0';
        // $arrayPostData['messages'][0]['type'] = "text";
        // $arrayPostData['messages'][0]['text'] = "action : " . $action;
        // pushMsg($arrayHeader,$arrayPostData);
		
		// $arrayPostData['to'] = 'U1433d8e7fabdefa79463b15e1924b4d0';
        // $arrayPostData['messages'][0]['type'] = "text";
        // $arrayPostData['messages'][0]['text'] = "date Pick : " . $date;
        // pushMsg($arrayHeader,$arrayPostData);
		
		switch ($action)
		{ 
			case 'leave';
				$str = ' { "to": "'. $idTo . '",
						   "messages": [
						{
						  "type": "text",
						  "text": "เลือกวันลา(เริ่มต้น)",
						  "quickReply": {
							"items": [
							  {
								"type": "action",
								"imageUrl": "https://icla.org/wp-content/uploads/2018/02/blue-calendar-icon.png",
								"action": {
								  "type": "datetimepicker",
								  "label": "Datetime Picker",
								  "data": "action=Date_form",
								  "mode": "date",
								  "initial": "2018-08-10",
								  "max": "2018-12-31",
								  "min": "2018-08-01"
								}
							  }
							]
						  }
						}
					   ]
					}  ';
				$json = json_decode($str, true);
				pushMsg($arrayHeader,$json);
				
				$arrayPostData['to'] = $idTo;
				$arrayPostData['messages'][0]['type'] = "text";
				$arrayPostData['messages'][0]['text'] = "ตั้งแต่ วันที่ : " . $date;
				replyMsg($arrayHeader,$arrayPostData);
			case 'Date_form';
			
				$str = ' { "to": "'. $idTo . '",
					 "messages": [
						{
						  "type": "text",
						  "text": "เลือกวันลา(ถึง)",
						  "quickReply": {
							"items": [
							  {
								"type": "action",
								"imageUrl": "https://icla.org/wp-content/uploads/2018/02/blue-calendar-icon.png",
								"action": {
								  "type": "datetimepicker",
								  "label": "Datetime Picker",
								  "data": "action=Date_to",
								  "mode": "date",
								  "initial": "2018-08-10",
								  "max": "2018-12-31",
								  "min": "2018-08-01"
								}
							  }
							]
						  }
						}
					   ]
					}  ';
				$json = json_decode($str, true);
				pushMsg($arrayHeader,$json);
				
				$arrayPostData['to'] = $idTo;
				$arrayPostData['messages'][0]['type'] = "text";
				$arrayPostData['messages'][0]['text'] = "ถึง วันที่ : " . $date;
				replyMsg($arrayHeader,$arrayPostData);
				
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
   
   function replyMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }
	
   exit;
   
   
?>
