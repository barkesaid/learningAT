<?php
$data  = json_decode(file_get_contents('php://input'), true);
print_r($data);
// Process the data...
$category = $data["category"];
if ( $category == "MobileB2B" ) {
   // We have been paid by one of our customers!!
   $status = $data["status "];
   $transactionId      = $data["transactionId"];
   $transactionFee     = $data["transactionFee"];
   $providerChannel    = $data["providerChannel"];
    
    echo "printing results";
    echo $status; 
    echo $transactionId; 
    echo $transactionFee; 
    echo $providerChannel; 
    
   // manipulate the data as required by your business logic
   // Perhaps send an SMS to confirm the payment using our APIs...
} else if ( $category == "MobileB2C" ) {

} else if ( $category == "MobileCheckout" ) {
   
} else {

}