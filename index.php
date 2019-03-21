<!DOCTYPE HTML>

<html>

<head>

<meta http-equiv="X-UA-Compatible" content="IE=edge">

<script src="../../../resources/sap-ui-core.js" id="sap-ui-bootstrap"

          data-sap-ui-libs="sap.m" data-sap-ui-theme="sap_mvi">

</script>

<!-- only load the mobile lib "sap.m" and the "sap_mvi" theme -->

<script>

          // Tell UI5 where to find application content

          // sap.ui.localResources("GetEmployeeListSet"); //view is the name of the folder where views are stored

          jQuery.sap.registerModulePath('Application', 'Application');

          // Launch application

          jQuery.sap.require("Application");

          var oApp = new Application( {

                    root : "content"

          }); // instantiate your application and mark the HTML element with id "content" as location for the UI

</script>

</head>

<body class="sapUiBody" role="application">

<div id="content"></div>

</body>

</html>
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

	
   // $content = file_get_contents('php://input');
   // $arrayJson = json_decode($content, true);
   // $arrayHeader = array();
   // $arrayHeader[] = "Content-Type: application/json";
   // $arrayHeader[] = "Authorization: Bearer {$accessToken}";
	
   // $url = 'http://vms4ics.ics-th.com:8000/sap/opu/odata/sap/ZPROFILE_SRV/GetEmployeeListSet';
   // $ch = curl_init($url);
   // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
   // curl_setopt($ch,  CURLOPT_SSL_VERIFYPEER,  false);
   // curl_setopt($ch,  CURLOPT_VERBOSE,  1);
   // curl_setopt($ch,  CURLOPT_POST,  true);
   // curl_setopt($ch,  CURLOPT_POSTFIELDS,  json_encode($params));
   // // curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
   // // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
   // $result = curl_exec($ch);
   // curl_close($ch);
   // $json_string = '[' . $result . ']';
   // $Profile = json_decode($json_string);
   // if ( $Profile == null)
   // {
	   // echo 'not connect';
   // }
   // else
   // {
	   // echo $Profile;
   // }
   
?>


