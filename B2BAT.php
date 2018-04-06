<?php
// Be sure to include the file you've just downloaded
require_once('AfricasTalkingGateway.php');

// Specify your login credentials
$username   = "Barkesaid";
$apikey     = "08309281a5120c83170d608301377ed38222e4535b2f28ebda092891e6b4bcb7";
//Create an instance of our awesome gateway class and pass your credentials
$gateway = new AfricasTalkingGateway($username, $apikey);

// Specify your product name
$productName = "";

// Specify the payment provider. eg. MPESA, ATHENA (AfricasTalking Sandbox), etc
$provider = "Mpesa";

// Specify partner's business channel
$destinationChannel = "525900";
// Specify the transfer purpose

$transferType = "BusinessPaybill";
$destinationAccount = "barke";
$providerData = array('provider' => $provider,
                      'destinationChannel' => $destinationChannel,
                      'transferType' => $transferType,'destinationAccount' => $destinationAccount);

// The 3-Letter ISO currency code for the checkout amount
$currencyCode = "KES";
$amount = 30;

// Specify the metadata options. These data will be sent to you in a notification when payment has been made
$metadata = array('shopId' => "1234",
                  'itemId' => "abcde");

/*************************************************************************************
 NOTE: If connecting to the sandbox:

 1. Use "sandbox" as the username
 2. Use the apiKey generated from your sandbox application
	https://account.africastalking.com/apps/sandbox/settings/key
 3. Add the "sandbox" flag to the constructor

 $gateway  = new AfricasTalkingGateway($username, $apiKey, "sandbox");
**************************************************************************************/

// Any gateway errors will be captured by our custom Exception class below, 
// so wrap the call in a try-catch block
try 
{ 
  // Thats it, hit send and we'll take care of the rest. 
  $results = $gateway->mobilePaymentB2BRequest($productName, $providerData, $currencyCode, $amount, $metadata);
  if($results->status == "Queued") {
    echo "TransactionId: " . $results->transactionId;
    echo "\nTransactionFee: " . $results->transactionFee;
    echo "\nProviderChannel: " . $results->providerChannel;
  }
  else {
    echo "ErrorMessage: " . $results->errorMessage;
  }
}
catch ( AfricasTalkingGatewayException $e )
{
  echo "Encountered an error while sending: ".$e->getMessage();
}
?>
    