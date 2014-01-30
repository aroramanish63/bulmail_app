<?php
define("ROOT","");
session_start(); 
include 'CallerService.php';  
include ROOT.'payment_config/constants.php';  
$payment_handler=new Payment();

 // Response from Paypal
	// read the post from PayPal system and add 'cmd'
	$req = 'cmd=_notify-validate';
	foreach ($_POST as $key => $value) {
		$value = urlencode(stripslashes($value));
		$value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i','${1}%0D%0A${3}',$value);// IPN fix
		$req .= "&$key=$value";
	}
	 
	$planId	          = $_POST['item_number'];
	$status	          = $_POST['payment_status'];
	$amount	          = $_POST['mc_gross'];
	$payment_currency = $_POST['mc_currency']; 
	$transactionId	  = $_POST['txn_id']; 
	$userId 	  = $_POST['custom']; 
	
	 		
                        		 
	 if($transactionId != ''){
            //  here we are adding payment details in payments table
            
	    
	    // checking if transaction id already enter in payment table
	    
	    $check = $payment_handler->checkTransaction($userId, $transactionId, $planId);
	    if($check){
		     // update record
		     $payment_handler->updateTransaction($transactionId,$status);
	    }else{
		// insert new transaction
		$paymentId  = $payment_handler->addPaymentDetails($userId, $transactionId, $amount, $status, $planId, $payment_currency); 
	    }
	     
            // here we are checking if status is completed , add details in order table
            
            if($status == 'Completed'){
		
		// check if order already exists in subscription table
		
		$checkOrder = $payment_handler->checkOrder($userId, $transactionId, $planId);
		  if($checkOrder == 0){ 
			$nvpStr="&TRANSACTIONID=$transactionId"; 
			$resArray=hash_call("gettransactionDetails",$nvpStr);  
			$reqArray=$_SESSION['nvpReqArray']; 
			if(!empty($reqArray)) {
					foreach($resArray as $key => $value) { 
    			                     if($key == 'SUBSCRIPTIONID'){
                                                    $data['SUBSCRIPTIONID'] = $value;
					     } 
    				}	
			}  // end of check empty if 
		      // get payment id
		       $paymentId =  $payment_handler->getPaymentId($transactionId);
				    
                      // insert order in subscriptions table
                      // generate order ID
                      $random_order_number = $payment_handler->RandomOrderNumber();
                      $orderId  = $payment_handler->addOrderDetails($random_order_number,$paymentId, $transactionId,$planId,$userId, $data['SUBSCRIPTIONID']); 
                  } // eof check order exists 
	      } 
	 }
	  
?>