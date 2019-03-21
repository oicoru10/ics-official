
<?php
  echo "สวัสดี LINE BOT";
  echo "<BR>";
	 // echo '<BR>';
	// $client = new GuzzleHttp\Client();
	// $res = $client->request('GET', 'GET http://vms4ics.ics-th.com:8000/sap/opu/odata/sap/ZPROFILE_SRV/GetEmployeeListSet');
	// $people = json_decode($res, true)['value'];
	
	// // $sap_wsdl = "http://thanagone.ku:p%40ssw0rd@vms4ics.ics-th.com:8000/sap/opu/odata/sap/ZPROFILE_SRV/GetEmployeeListSet('00000001')";
	// // $sap_client = new SoapClient($sap_wsdl);
	// // $res = $sap_client->RFC_READ_TABLE();
	   // if ( $people == null)
	   // {
		   // echo 'not connect';
	   // }
	   // else
	   // {
		   // echo $people;
	   // }
	   
	// require_once "Connect.php";
   // //connect
    // $OData = new Z_WE_ASSCOCUSTOPENID_SRV_Entities('http://vms4ics.ics-th.com:8000/sap/opu/odata/sap/ZPROFILE_SRV/') ;
	// $OData->Credential = new WindowsCredential('thanagone','p@ssw0rd');
   // try
// {
    // // //Create a Customer php Object
    // // $OpenId = OpenId::CreateOpenId( "","",$_POST["Name"],$_POST["CustomerName"],$_POST["Code"]);
    // // //inserting Customers object context tracking system
    // // $OData->AddObject('OpenIdSet', $OpenId);
	   // // //SaveChange insert the object into data service
	   // // $Odata->SaveChanges();
	   
	 // $result  = $Odata->getEntities();
// }
// catch(ODataServiceException $exception)
// {
    // Echo $exception->getError();
// }

// foreach ($result as $resultx ){
            // foreach ($resultx as $v){
                // echo ("test:" .  $v);
            // }}
	// foreach ($people as $value)
   // {
      // $empp = $value->EmployeeID;
	  // echo $empp;
	  // echo "<BR>";
   // }
	// echo $people; // ["UserName" => "russellwhyte", "FirstName" => "Russell" ...]
	
	// $host  =  "http://vms4ics.ics-th.com";
	// // Port
	// $port  =  '8000';
	// // Login credentials
	// $params  =  [
			// "UserName"  =>  "thanagone.ku",
			// "Password"  =>  "p@ssw0rd",
	// ];

	
   $content = file_get_contents('php://input');
   $arrayJson = json_decode($content, true);
   $arrayHeader = array();
   // $arrayHeader[] = "Content-Type: application/json";
   $arrayHeader[] = "Content-Type:  application/xml";
   // $arrayHeader[] = "Authorization: Bearer {$accessToken}";
   $arrayHeader[] = "Authorization: Basic " .base64_encode("thanagone.ku:p@ssw0rd");
	
   // $url = 'http://thanagone.ku:p%40ssw0rd@vms4ics.ics-th.com:8000/sap/opu/odata/sap/ZPROFILE_SRV/GetEmployeeListSet';
   $url = 'http://vms4ics.ics-th.com:8000/sap/opu/odata/sap/ZPROFILE_SRV/GetEmployeeListSet';
   $ch = curl_init($url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
   $result = curl_exec($ch);
   curl_close($ch);
   $ob = simplexml_load_string($result);
   $json_string = '[' . $result . ']';
   $Profile = json_decode($json_string);
   // if ( $ob == null)
   // {
	   echo 'not connect';
	   echo "<BR>";
	   echo $result;
	   echo "<BR>";
	   echo $ob;
	   echo "<BR>";
	   foreach ($ob->entry as $item) {
			echo $item->updated . PHP_EOL;
			$ns = $item->content->children('http://schemas.microsoft.com/ado/2007/08/dataservices/metadata'); 
			print_r($ns->properties); 
		}
		echo "<BR>";
		$arr = (array) $ob;
		var_dump($arr);
		echo "<BR>";
   // }
   // else
   // {
	   // echo $ob;
   // }
   
?>


