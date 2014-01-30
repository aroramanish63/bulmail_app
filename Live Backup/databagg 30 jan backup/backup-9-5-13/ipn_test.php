<?php
 error_reporting(E_ALL);
 ini_set("display_errors", 1);
session_unset(); 
require_once 'CallerService.php'; 
session_start(); 
$transactionID='88T58303NN7332019';
 
$nvpStr="&TRANSACTIONID=$transactionID";

 
$resArray=hash_call("gettransactionDetails",$nvpStr);  
 
$reqArray=$_SESSION['nvpReqArray'];


echo "<pre>";

print_r($resArray);

 
    		foreach($resArray as $key => $value) {
    			echo $key."<br>";
    			  if($key == 'SUBSCRIPTIONID'){
                                                    $data['SUBSCRIPTIONID'] = $value;
                                                    $data['FIRSTNAME'] = $value;
                                                    $data['LASTNAME'] = $value;
                                                    $data['PAYMENTSTATUS'] = $value;
                                                  } 
    			}	
				
				echo "SUBSCRIPTION".$data['SUBSCRIPTIONID']; 
       			
				 
?>
 