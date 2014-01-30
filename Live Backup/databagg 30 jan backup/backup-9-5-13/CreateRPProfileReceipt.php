<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
define("ROOT","");
require_once 'CallerService.php';
include ROOT.'payment_config/constants.php';  
$payment_handler=new Payment();
session_start();
$userId = $_SESSION['user_id'];
$planId = $_SESSION['planid'];

/**
 * Get required parameters from the web form for the request
 */
 
$paymentType ='Sale';
$firstName = urlencode( $_POST['fname']);
$lastName =urlencode( $_POST['lname']);
$creditCardType =urlencode( $_POST['cardType']);
$creditCardNumber = urlencode($_POST['card_number']);
$expDateMonth =urlencode( $_POST['expmo']);

// Month must be padded with leading zero
$padDateMonth = str_pad($expDateMonth, 2, '0', STR_PAD_LEFT); 
$expDateYear =urlencode( $_POST['expyear']);
$cvv2Number  = urlencode($_POST['security']);
$address1    = urlencode($_POST['address']);
$address2    = '';//urlencode($_POST['address2']);
$city 	     = urlencode($_POST['city']);
$state =urlencode( $_POST['state']);
$zip = urlencode($_POST['zip']);
$amount = urlencode($_POST['ccamount']);
$currencyCode="USD"; 
$countryCode=urlencode($_POST['country']);
$profileDesc = urlencode($_POST['ccprofileDesc']);
$billingPeriod = urlencode($_POST['ccperiod']);
$billingFrequency = urlencode($_POST['ccfrequency']);
$totalBillingCycles = '';//urlencode($_POST['totalBillingCycles']);
$profileStartDateDay  = date('d');
  
// Day must be padded with leading zero
$padprofileStartDateDay = str_pad($profileStartDateDay, 2, '0', STR_PAD_LEFT);
$profileStartDateMonth = date('m');
// Month must be padded with leading zero
$padprofileStartDateMonth = str_pad($profileStartDateMonth, 2, '0', STR_PAD_LEFT);
$profileStartDateYear     = date('Y');

$profileStartDate = urlencode($profileStartDateYear . '-' . $padprofileStartDateMonth . '-' . $padprofileStartDateDay . 'T00:00:00Z'); 


// here first we are doing do direct payment using creditcard details
 
$nvpstrCCPayment="&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".$padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=$state".
"&ZIP=$zip&COUNTRYCODE=$countryCode&CURRENCYCODE=$currencyCode";

$resCreditArray=hash_call("doDirectPayment",$nvpstrCCPayment); 
$ack = strtoupper($resCreditArray["ACK"]);
if($ack!="SUCCESS")  {
      $_SESSION['reshash']=$resCreditArray;
      $location = "API_Error.php";
      header("Location: $location");
   }else{
    
     // Transaction Details
     $transactionId    = $resCreditArray["TRANSACTIONID"];
     $payment_currency = $resCreditArray["CURRENCYCODE"];
     $amountReturn     = $resCreditArray["AMT"];
     $status           = $resCreditArray["ACK"];
     $paymentMehod     = 'card';
     // insert new transaction details 
     $paymentId  = $payment_handler->addPaymentDetails($userId, $transactionId, $amountReturn, $status, $planId, $payment_currency,$paymentMehod); 
    
     // create recurring profile for current user         
     $nvpstrRecurring="&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber&EXPDATE=".$padDateMonth.$expDateYear."&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName&STREET=$address1&CITY=$city&STATE=$state".
"&ZIP=$zip&COUNTRYCODE=$countryCode&CURRENCYCODE=$currencyCode&PROFILESTARTDATE=$profileStartDate&DESC=$profileDesc&BILLINGPERIOD=$billingPeriod&BILLINGFREQUENCY=$billingFrequency&TOTALBILLINGCYCLES=$totalBillingCycles";
    
    // call the API
    $resArrayRecurring=hash_call("CreateRecurringPaymentsProfile",$nvpstrRecurring);    
    $ackRecurring = strtoupper($resArrayRecurring["ACK"]);
    if($ackRecurring!="SUCCESS")  {
	    $_SESSION['reshash']=$resArrayRecurring;
	    $location = "API_Error.php";
	    header("Location: $location");
       }else{
	 $subscriptionId = $resArrayRecurring['PROFILEID'];
	 // save details in subscriptions table
	 $random_order_number = $payment_handler->RandomOrderNumber();
         $orderId  = $payment_handler->addOrderDetails($random_order_number,$paymentId, $transactionId,$planId,$userId,$subscriptionId);
	 $location = "success.php?tx=$transactionId";
	 header("Location: $location");
       } 
   }  
?>
 