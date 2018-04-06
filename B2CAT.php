<?php
require_once "AfricasTalkingGateway.php";
//Specify your credentials
$username   = "Barkesaid";
$apikey     = "08309281a5120c83170d608301377ed38222e4535b2f28ebda092891e6b4bcb7";
//Create an instance of our awesome gateway class and pass your credentials
$gateway = new AfricasTalkingGateway($username, $apikey);
// Specify the name of your Africa's Talking payment product
$productName  = "barke_test";
// The 3-Letter ISO currency code for the checkout amount
$currencyCode = "KES";
// Provide the details of a mobile money recipient
$recipient1   = array("phoneNumber" => "+254700138215",
                       "currencyCode" => "KES",
					   "amount"       => 10,
					   "metadata"     => array("name"   => "Clerk",
					                           "reason" => "May Salary")
		      );
// You can provide up to 10 recipients at a time
// $recipient2   = array("phoneNumber"  => "+254700138215",
//                     "currencyCode" => "KES",
// 					"amount"       => 50.10,
// 					"metadata"     => array("name"   => "Accountant",
// 					                        "reason" => "May Salary")
		     // );
// Put the recipients into an array
// $recipients  = array($recipient1, $recipient2);

$recipients  = array($recipient1);

try {
  $responses = $gateway->mobilePaymentB2CRequest($productName, $recipients);
  
  foreach($responses as $response) {
    // Parse the responses and print them out
    echo "phoneNumber=".$response->phoneNumber;
    echo ";status=".$response->status;
	
    if ($response->status == "Queued") {
      echo ";transactionId=".$response->transactionId;
    
    } else {
      echo ";errorMessage=".$response->errorMessage."\n";
    }
  }
  
}
catch(AfricasTalkingGatewayException $e){
  echo "Received error response: ".$e->getMessage();
}
?>

    