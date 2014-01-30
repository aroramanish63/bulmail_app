<?php 
 
// PayPal settings
$paypal_email = 'sarita.rawat@cyfuture.com';
$return_url   = 'http://databagg.com/ipn_return.php';
$cancel_url   = 'http://databagg.com/payment_cancelled.php';
$notify_url   = 'http://databagg.com/ipn.php';

$item_name   = $_POST['plan_name'];
$item_amount = $_POST['price'];
$userId      = $_POST['userid'];
 
// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])){

	// Firstly Append paypal account to querystring
	$querystring .= "?business=".urlencode($paypal_email)."&";	
	
	// Append amount& currency (£) to quersytring so it cannot be edited in html
	
	//The item name and amount can be brought in dynamically by querying the $_POST['item_number'] variable.
	$querystring .= "item_name=".urlencode($item_name)."&";
	$querystring .= "amount=".urlencode($item_amount)."&";
	
	//loop for posted values and append to querystring
	foreach($_POST as $key => $value){
		$value 		= urlencode(stripslashes($value));
		$querystring   .= "$key=$value&";
	}
	
	// Append paypal return addresses
	$querystring .= "return=".urlencode(stripslashes($return_url))."&";
	$querystring .= "cancel_return=".urlencode(stripslashes($cancel_url))."&";
	$querystring .= "notify_url=".urlencode($notify_url);
	
	// Append querystring with custom field
	$querystring .= "&custom=".$userId;
	
	// Redirect to paypal IPN
	header('location:https://www.sandbox.paypal.com/cgi-bin/webscr'.$querystring);
	exit(); 
} 
?>