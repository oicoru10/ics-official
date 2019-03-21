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
   // &date_now = date("Y-m-d");
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
		$sql = "INSERT INTO `leave_number`(`Id_line`, `leave_id`, `number_leave`)
			VALUES ('" . $idTo . "', '01', 30 )";
		
		if ($conn->query($sql) === TRUE) { } 
		
		$sql = "INSERT INTO `leave_number`(`Id_line`, `leave_id`, `number_leave`)
			VALUES ('" . $idTo . "', '02', 2 )";
		
		if ($conn->query($sql) === TRUE) { } 
		
		$sql = "INSERT INTO `leave_number`(`Id_line`, `leave_id`, `number_leave`)
			VALUES ('" . $idTo . "', '03', 15 )";
		
		if ($conn->query($sql) === TRUE) { } 
		
		$sql = "INSERT INTO `leave_number`(`Id_line`, `leave_id`, `number_leave`)
			VALUES ('" . $idTo . "', '04', 0 )";
		
		if ($conn->query($sql) === TRUE) { } 
		
		$sql = "INSERT INTO `leave_number`(`Id_line`, `leave_id`, `number_leave`)
			VALUES ('" . $idTo . "', '05', 0 )";
		
		if ($conn->query($sql) === TRUE) { } 
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
								  "label": "Sick Leave",
								  "data": "action=leave&leaveid=01",
								  "displayText": "Sick Leave"
								}
							  },
							  {
								"type": "action",
								"action": {
								  "type": "postback",
								  "label": " Personal Leave",
								  "data": "action=leave&leaveid=02",
								  "displayText": "Personal Leave"
								}
							  },
							  {
								"type": "action",
								"action": {
								  "type": "postback",
								  "label": "Annual Leave",
								  "data": "action=leave&leaveid=03",
								  "displayText": "Annual Leave"
								}
							  },
							  {
								"type": "action",
								"action": {
								  "type": "postback",
								  "label": "Compensate",
								  "data": "action=leave&leaveid=04",
								  "displayText": "Compensate"
								}
							  },
							  {
								"type": "action",
								"action": {
								  "type": "postback",
								  "label": " Leave with out pay",
								  "data": "action=leave&leaveid=05",
								  "displayText": "Leave with out pay"
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
	ELSEIF( strpos($message, 'SAP') !== false )
	{
		   $content_od = file_get_contents('php://input');
		   $arrayJson_od = json_decode($content_od, true);
		   $arrayHeader_od = array();
		   // $arrayHeader[] = "Content-Type: application/json";
		   $arrayHeader_od[] = "Content-Type:  application/xml";
		   // $arrayHeader[] = "Authorization: Bearer {$accessToken}";
		   $arrayHeader_od[] = "Authorization: Basic " .base64_encode("thanagone.ku:p@ssw0rd");
			
		   // $url = 'http://thanagone.ku:p%40ssw0rd@vms4ics.ics-th.com:8000/sap/opu/odata/sap/ZPROFILE_SRV/GetEmployeeListSet';
		   $url_od = 'http://vms4ics.ics-th.com:8000/sap/opu/odata/sap/ZPROFILE_SRV/GetEmployeeListSet';
		   $ch_od = curl_init($url_od);
		   curl_setopt($ch_od, CURLOPT_RETURNTRANSFER, true);
		   curl_setopt($ch_od, CURLOPT_HTTPHEADER, $arrayHeader_od);
		   curl_setopt($ch_od, CURLOPT_FOLLOWLOCATION, 1);
		   $result_od = curl_exec($ch_od);
		   curl_close($ch_od);
		   $ob = simplexml_load_string($result_od);
		   
		   foreach ($ob->entry as $item) {
			// echo $item->updated;
			$ns = $item->content->children('http://schemas.microsoft.com/ado/2007/08/dataservices/metadata'); 
			$nsd = $ns->properties->children("http://schemas.microsoft.com/ado/2007/08/dataservices");
			// print_r($ns->properties); 
			
			$filter = explode(" ", $message);
			foreach ($nsd as $key => $val) {
				if($key == 'EmployeeID')
				{
					if($filter[1] == $val)
					{
						$chk = 'X';
					}
					else
					{
						$chk = '';
					}
				}
				if($chk == 'X')
				{
					$arrayPostData['to'] = $idTo;
					$arrayPostData['messages'][0]['type'] = "text";
					$arrayPostData['messages'][0]['text'] = $key . " : " . $val;
					pushMsg($arrayHeader,$arrayPostData);
				}
			}
			// print_r($nsd); 
		}
	}
   elseif( strpos($message, 'help') !== false )
   {
		$arrayPostData['to'] = $idTo;
		$arrayPostData['messages'][0]['type'] = "text";
		$arrayPostData['messages'][0]['text'] = "Name";
		pushMsg($arrayHeader,$arrayPostData);
		
		$arrayPostData['to'] = $idTo;
		$arrayPostData['messages'][0]['type'] = "text";
		$arrayPostData['messages'][0]['text'] = "NickName";
		pushMsg($arrayHeader,$arrayPostData);
		
		$arrayPostData['to'] = $idTo;
		$arrayPostData['messages'][0]['type'] = "text";
		$arrayPostData['messages'][0]['text'] = "Sample command";
		pushMsg($arrayHeader,$arrayPostData);
   }
   elseif( strpos($message, 'Sample command') !== false )
   {
		$arrayPostData['to'] = $idTo;
		$arrayPostData['messages'][0]['type'] = "text";
		$arrayPostData['messages'][0]['text'] = "Name " . "ชื่อ";
		pushMsg($arrayHeader,$arrayPostData);
		$arrayPostData['to'] = $idTo;
		$arrayPostData['messages'][0]['type'] = "text";
		$arrayPostData['messages'][0]['text'] = "NickName " . "ชื่อเล่น";
		pushMsg($arrayHeader,$arrayPostData);
   }
   ELSEIF( strpos($message, 'Name') !== false OR strpos($message, 'NickName') !== false)
	{
		   $content_od = file_get_contents('php://input');
		   $arrayJson_od = json_decode($content_od, true);
		   $arrayHeader_od = array();
		   // $arrayHeader[] = "Content-Type: application/json";
		   $arrayHeader_od[] = "Content-Type:  application/xml";
		   // $arrayHeader[] = "Authorization: Bearer {$accessToken}";
		   $arrayHeader_od[] = "Authorization: Basic " .base64_encode("thanagone.ku:p@ssw0rd");
			
		   // $url = 'http://thanagone.ku:p%40ssw0rd@vms4ics.ics-th.com:8000/sap/opu/odata/sap/ZPROFILE_SRV/GetEmployeeListSet';
		   $url_od = 'http://vms4ics.ics-th.com:8000/sap/opu/odata/sap/ZPROFILE_SRV/GetEmployeeListSet';
		   $ch_od = curl_init($url_od);
		   curl_setopt($ch_od, CURLOPT_RETURNTRANSFER, true);
		   curl_setopt($ch_od, CURLOPT_HTTPHEADER, $arrayHeader_od);
		   curl_setopt($ch_od, CURLOPT_FOLLOWLOCATION, 1);
		   $result_od = curl_exec($ch_od);
		   curl_close($ch_od);
		   $ob = simplexml_load_string($result_od);
		   
		   foreach ($ob->entry as $item) {
			// echo $item->updated;
			$ns = $item->content->children('http://schemas.microsoft.com/ado/2007/08/dataservices/metadata'); 
			$nsd = $ns->properties->children("http://schemas.microsoft.com/ado/2007/08/dataservices");
			// print_r($ns->properties); 
			
			$filter = explode(" ", $message);
			if($filter[0] == "Name")
			{
				$comm = "Firstname";
			}
			else
			{
				$comm = "Nickname";
			}
			foreach ($nsd as $key => $val) {
				if($key == $comm)
				{
					if($filter[1] == $val)
					{
						$chk = 'X';
					}
					else
					{
						$chk = '';
					}
				}
				if($chk == 'X')
				{
					switch($key)
					{
						case 'Firstname' :
							$f_name = $val;
						 break;
						case 'Lastname' :
							$l_name = $val;
						 break;
						case 'Tel' :
							$Tel = $val;
						 break;
						case 'Email' :
							$Email = $val;
						 break;
					}
					
				}
			}
			// print_r($nsd); 
		}
		$arrayPostData['to'] = $idTo;
		$arrayPostData['messages'][0]['type'] = "text";
		$arrayPostData['messages'][0]['text'] = "ชื่อ " $f_name . " " . $l_name . " โทร " . $Tel . " E-mail " . $Email;
		pushMsg($arrayHeader,$arrayPostData);
	}
   ELSE
     {
      $arrayPostData['to'] = $idTo;
      $arrayPostData['messages'][0]['type'] = "text";
      $arrayPostData['messages'][0]['text'] = "ไม่มี Code ส่วนนี้อยู๋";
      pushMsg($arrayHeader,$arrayPostData);
    }
   }
   elseif($type == "postback")
	{	
		$timestamp = $arrayJson['events'][0]['timestamp'];
	    $Data_p = $arrayJson['events'][0]['postback']['data'];
	    $datepick = $arrayJson['events'][0]['postback']['params']['date'];
		
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
        // $arrayPostData['messages'][0]['text'] = "date Pick : " . $datepick;
        // pushMsg($arrayHeader,$arrayPostData);
		
		switch ($action)
		{ 
			case 'leave':
				$conn = new mysqli($servername, $username, $password, $dbname);
			    if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 
				 $sql = "INSERT INTO temp_leave (`Id_line`, `Date_from`, `Date_to`, `leave_id`) value('" . $idTo . "','2019-01-01','2019-03-01','" . $leaveid ."')";

				if ($conn->query($sql) === TRUE) {
					
				} 
				$conn->close();
				
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
								  "initial": "2019-03-19",
								  "max": "2020-12-31",
								  "min": "2018-01-31"
								}
							  }
							]
						  }
						}
					   ]
					}  ';
				$json = json_decode($str, true);
				pushMsg($arrayHeader,$json);
				break;
			case 'Date_form':
				$conn = new mysqli($servername, $username, $password, $dbname);
				  if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					} 
					 $sql = "UPDATE temp_leave 
							 SET Date_from = '". $datepick ."'
							 where Id_line = '" . $idTo . "'";

					if ($conn->query($sql) === TRUE) {
						
					} 
					$conn->close();
		
				// $arrayPostData['to'] = $idTo;
				// $arrayPostData['messages'][0]['type'] = "text";
				// $arrayPostData['messages'][0]['text'] = "ตั้งแต่ วันที่ : " . $datepick;
				// pushMsg($arrayHeader,$arrayPostData);
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
								  
								  "initial": "2019-03-19",
								  "max": "2020-12-31",
								  "min": "2018-01-31"
								}
							  }
							]
						  }
						}
					   ]
					}  ';
				$json = json_decode($str, true);
				pushMsg($arrayHeader,$json);
				break;
				// "initial": "'. $date_now .'",
			case 'Date_to':
				$conn = new mysqli($servername, $username, $password, $dbname);
			  if ($conn->connect_error) {
					die("Connection failed: " . $conn->connect_error);
				} 
				 $sql = "UPDATE temp_leave 
						 SET Date_to = '". $datepick ."'
						 where Id_line = '" . $idTo . "'";

				if ($conn->query($sql) === TRUE) {
					
				} 
				
			   $sql = "SELECT Date_from,leave_id,DATEDIFF(Date_to,Date_from) as numl FROM temp_leave Where Id_line = '" . $idTo . "'";
			   $result_sql = $conn->query($sql);
			   if ($result_sql->num_rows > 0) {
				// output data of each row
				while($row = $result_sql->fetch_assoc()) {
					$Date_from = $row["Date_from"];
					$numl = $row["numl"];
					$leave_desc = get_desc_leave($row["leave_id"]);
				}
			   }
				$conn->close();
				
				$text = $leave_desc . " ตั้งแต่ วันที่ : " . $Date_from . " ถึง วันที่ : " . $datepick . " เป็นจำนวน : " . $numl . " วัน ";
				$arrayPostData['to'] = $idTo;
				$arrayPostData['messages'][0]['type'] = "text";
				$arrayPostData['messages'][0]['text'] = $text;
				pushMsg($arrayHeader,$arrayPostData);
				
				$str = '{ "line": {
							"type": "template",
							"altText": "this is a confirm template",
							"template": {
							  "type": "confirm",
							  "text": "ยืนยันข้อมูลหรือไม่?",
							  "actions": [
								{
								  "type": "message",
								  "label": "ใช่",
								  "text": "ใช่"
								},
								{
								  "type": "message",
								  "label": "ไม่",
								  "text": "ไม่"
								}
							  ]
							}
						 }
						}';
				$json = json_decode($str, true);
				replyMsg($arrayHeader,$json);
				
				$conn = new mysqli($servername, $username, $password, $dbname);
				  if ($conn->connect_error) {
						die("Connection failed: " . $conn->connect_error);
					} 
					 $sql = "DELETE FROM temp_leave Where Id_line = '" . $idTo . "'";

					if ($conn->query($sql) === TRUE) {
						
					} 
				$conn->close();
				
				break;
				
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
	
	function get_desc_leave($leave_id)
	{
		switch ($leave_id)
		{
			case '01':
				return 'Sick Leave';
				break;
			case '02':
				return 'Personal Leave';
				break;
			case '03':
				return 'Annual Leave';
				break;
			case '04':
				return 'Compensate';
				break;
			case '05':
				return 'Leave with out pay';
				break;
		}
	}
	
   exit;
   
   
?>
