<!DOCTYPE HTML>

<html>

<head>


<!-- only load the mobile lib "sap.m" and the "sap_mvi" theme -->

<script>

pressBtn_oDataRead_multiple: function() {
		
		// var lv_oDataUrl = "proxy/http/<fioriHost>:8000//sap/opu/odata/sap/ZTEST_ODATA_SRV/"; //When running app from Eclipse
		var lv_oDataUrl = "http://vms4ics.ics-th.com:8000/sap/opu/odata/sap/ZPROFILE_SRV/"; //When running app from Eclipse
		//var lv_oDataUrl = "/sap/opu/odata/sap/zmpq_sto_po_srv_srv/";		//When running app from FioriLaunchpad
		
		//var lv_OModel = new sap.ui.model.odata.ODataModel(lv_oDataUrl, true);
		var lv_OModel = new sap.ui.model.odata.ODataModel(lv_oDataUrl, true, "thanagone.ku","p@ssw0rd");
		sap.ui.getCore().setModel(lv_OModel);	
	
		var entitySet_url = lv_oDataUrl + "GetEmployeeListSet('00000001')";
		
		OData.read(entitySet_url, function(oResponse) {
			
			var output = JSON.stringify(oResponse.results);
			
			//Extract 'DcumentType' result
			//var lv_NAVDOCTYP = oResponse.results[0].NAVDOCTYP;
			var lv_NAVDOCTYP = oResponse.results[0].NAVDOCTYP.results;
			var lv_NAVPURCHGRP = oResponse.results[0].NAVPURCHGRP.results;
			var lv_NAVVENDOR = oResponse.results[0].NAVVENDOR.results; 
			
			var lv_msg = "DocumentType: " + JSON.stringify(lv_NAVDOCTYP)
						+ "\nPurchaseGroup: " + JSON.stringify(lv_NAVPURCHGRP) 
						+ "\nVendorList:" + JSON.stringify(lv_NAVVENDOR);
			
			
			//To display result in pop-up
			sap.m.MessageBox.show( "Data Received \n" + lv_msg, {
			 	icon: sap.m.MessageBox.Icon.SUCCESS,
		        title: "oData Response",				       			      
		        onClose: function(oAction) {				        	
				     //do somthing if required   	
		    }});			
		}, function(err) {	
			
			var lvErrTxt = err.message;
			sap.m.MessageBox.show( "OData Response: " + lvErrTxt, {
			 	icon: sap.m.MessageBox.Icon.ERROR,
		        title: "Do you want to try again ?",
		        actions: [sap.m.MessageBox.Action.YES, sap.m.MessageBox.Action.NO],			      
		        onClose: function(oAction) {			    		
		        	 if ( oAction === sap.m.MessageBox.Action.YES ) { 		        		
		        		//If Yes clicked, one more chance to try again	 
		        	 }
		        	 if ( oAction === sap.m.MessageBox.Action.NO ) { 
		        		//If No clicked, then Cancel
		        	 }		        	
		   }});	//MessageBox close
		});  	//End of OData Service Call
		
	},

</script>

</head>

<body>
	
	<input type="button" text="Click" onclick="pressBtn_oDataRead_multiple" />
	
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


