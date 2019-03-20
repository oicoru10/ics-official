<?php
class SapTest {
 const SAP_WSDL_URI  = 'http://vms4ics.ics-th.com:8000/sap/opu/odata/sap/ZPROFILE_SRV/GetEmployeeListSet';
 const SAP_USER =  'thanagone.ku';
 const SAP_PWD  = 'p@ssw0rd';

public function execute() {

        $client = new SoapClient('http://'.urlencode(self::SAP_USER).':'.urldecode(self::SAP_PWD).'@'.self::SAP_WSDL_URI,
                array("trace" => 1,
                      "exceptions" => 1,
                      "login" => self::SAP_USER,
                      "password" => self::SAP_PWD,
                      'features' => SOAP_SINGLE_ELEMENT_ARRAYS)
        );

        $method = '_-bic_-nf2';

        $parameter = array('ETColumnDescription' => null,
                           'ETGridData' => null,
                           'ETMessageLog' => null,
                           'ETRowDescription' => null,
                           'ISVar_01xwerbet' => array('Sign' => 'I',
                                                      'Option' => 'LE',
                                                      'Low' => '3',
                                                      'High' => null));

        try
        {

        $result = $client->$method($parameter);
        print_r($result);
        } catch(SoapFault $e) {

        echo "REQUEST HEADER:\n" . $client->__getLastRequestHeaders() . "\n";
          echo "REQUEST:\n" . $client->__getLastRequest() . "\n";

          echo "RESPONSE HEADER:\n" . $client->__getLastResponseHeaders() . "\n";

          echo "RESPONSE:\n" . $client->__getLastResponse() . "\n";
        print_r($e);
    }


}

}

$oSap = new SapTest();
$oSap->execute();
?>


<?php
  echo "สวัสดี LINE BOT";
echo "<BR>";


// echo $json;
// $servername = "remotemysql.com:3306";
// $username = "OOd1POc2ro";
// $password = "EtMy0i5bdp";
// $dbname = "OOd1POc2ro";

// // Create connection
// $conn = new mysqli($servername, $username, $password, $dbname);
// // Check connection
// if ($conn->connect_error) {
    // die("Connection failed: " . $conn->connect_error);
// } 
// // $display = $array['displayName'];
// // echo $display;
// // Create connection
   // $idTo = 'U1433d8e7fabdefa79463b15e1924b4d0'.
   // $sql = "SELECT Id_line,Name FROM Member";
   // $result_sql = $conn->query($sql);
   // if ($result_sql->num_rows > 0) {
    // // output data of each row
    // while($row = $result_sql->fetch_assoc()) {
        // echo "id: " . $row["Id_line"]. " - Name: " . $row["Name"];
    // }
   // }
   // else {
    // echo "0 results";
	// }
	   
  // $conn->close();
  
  // echo date("Y-m-d");
  
	// $client = new GuzzleHttp\Client();
	// $res = $client->request('GET', 'GET http://vms4ics.ics-th.com:8000/sap/opu/odata/sap/ZPROFILE_SRV/GetEmployeeListSet("00000001")');
	// $people = json_decode($res, true)['value'];
	// // print_r($people[1]); // ["UserName" => "russellwhyte", "FirstName" => "Russell" ...]
	// echo $people; // ["UserName" => "russellwhyte", "FirstName" => "Russell" ...]
	/* connect to the OData service  */
	
	// $client = new GuzzleHttp\Client();
	// $res = $client->request('GET', 'GET http://services.odata.org/TripPinRESTierService/People');
	// $people = json_decode($res, true)['value'];
	// echo $people; // ["UserName" => "russellwhyte", "FirstName" => "Russell" ...]
   
	// $svc = new NorthwindEntities('http://vms4ics.ics-th.com:8000/sap/opu/odata/sap/ZPROFILE_SRV');
     
// /* get the list of Customers in the USA, for each customer get the list of Orders */
    // $query = $svc->GetEmployeeListSet();
    // $customerResponse = $query->Execute()
						 // ->filter("EmployeeID = '00000001'");
	
	// echo $customerResponse;

// /* get only CustomerID and CustomerName */
    // $query = $svc->Customers()
                 // ->filter("Country eq 'USA'")
                 // ->Select('CustomerID, CustomerName');
    // $customerResponse = $query->Execute();

// /* create a new customer */
    // $customer = Customers::CreateCustomers('00000001', 'CHAN9');
    // $proxy->AddToCustomers($customer); 

// /* commit the change on the server */        
    // $proxy->SaveChanges();
	$SOAP_AUTH= array( 'login' => 'thanagone.ku', 'password' => 'p@ssw0rd');
	#SpecifyWSDL
	$WSDL="http://vms4ics.ics-th.com:8000/sap/opu/odata/sap/ZPROFILE_SRV/GetEmployeeListSet";
	#CreateClient Object, download and parse WSDL
	$client= new SoapClient($WSDL,$SOAP_AUTH);
	$HEAD_DATA= new stdClass();
	$HEAD_DATA->EmployeeID = '00000001';
	#Setup input parameters (SAP Likes to Capitalise the parameter names)
	$params= array('HEADDATA' => $HEAD_DATA );
	#Call Operation (Function). Catch and display any errors
	try {
	   $result = $client->StandardMaterialSaveData($params);
	}catch(SoapFault $exception) {
	   print "***Caught Exception***\n";
	   print_r($exception);
	   print "***END Exception***\n";
	   die();
	}
	#Out the results
	print_r($result);
	error:SOAP-ERROR: Encoding: object has no 'HeadData' property
?>
