<?php
error_reporting(0);
session_start();
include("include/config.php");
include("include/functions.php");
include("include/header.php");


/************************ Payment Using Paypal Payment Pro ************/
/** DoDirectPayment NVP; 
 *
 *  Process a credit card payment. 
*/
if(isset($_REQUEST["submitCreditCardInfo"])  &&  isset($_REQUEST["planIdText"]) && isset($_SESSION['user_id']))
{
	$environment = 'sandbox';	// 'sandbox' or 'beta-sandbox' or 'live'
	 
	/**
	 * Send HTTP POST Request
	 *
	 * @param	string	The API method name
	 * @param	string	The POST Message fields in &name=value pair format
	 * @return	array	Parsed HTTP Response body
	 */
	$_SESSION['errormessage'] = "";
	if(empty($_POST['cardType']) || empty($_POST['crdtCardNum']) || empty($_POST['expryMonth']) || empty($_POST['expryYear']) || empty($_POST['cvvNum']) || empty($_REQUEST["planIdText"]))
	{
		$_SESSION['errormessage'] = "All fields are required.";
		header("location:payment.php");
		die();
	}
	
	$user_id = $_SESSION['user_id'];
	$planId = $_REQUEST["planIdText"];
	
	// Get the User Details
	$sql = "select * from users_register where id = $user_id";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	
	// Set request-specific fields.
	$paymentType = urlencode('Sale');				// 'Authorization' or 'Sale'
	$firstName = urlencode($row['fullname']);
	$email = urlencode($row['email']);
	//$lastName = urlencode($_POST['customer_last_name']);
	
	$creditCardType = urlencode($_POST['cardType']);
	$creditCardNumber = urlencode($_POST['crdtCardNum']);
	$expDateMonth = $_POST['expryMonth'];
	// Month must be padded with leading zero
	$padDateMonth = urlencode(str_pad($expDateMonth, 2, '0', STR_PAD_LEFT));
	 
	$expDateYear = urlencode($_POST['expryYear']);
	$cvv2Number = urlencode($_POST['cvvNum']);
	//$address1 = urlencode($_POST['customer_address1']);
	//$city = urlencode($_POST['customer_city']);
	//$state = urlencode($_POST['customer_state']);
	//$zip = urlencode($_POST['customer_zip']);
	$country = urlencode('US');				// US or other valid country code
	$amount = urlencode('10');
	$currencyID = urlencode('USD');			// or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')
	 
	function PPHttpPost($methodName_, $nvpStr_) {
		global $environment;
	 
		// Set up your API credentials, PayPal end point, and API version.
		$API_UserName = urlencode('sushil.singh-facilitator_api1.cyfuture.com'); // set your spi username
		$API_Password = urlencode('1379581292'); // set your spi password
		$API_Signature = urlencode('ARLeSy64Omoa1l8jVR.f3.1KqunJAJJr-FBzt558KsVBUyRT9yXrBdnX'); // set your spi Signature
		
		$API_Endpoint = "https://api-3t.paypal.com/nvp";
		if("sandbox" === $environment || "beta-sandbox" === $environment) {
			$API_Endpoint = "https://api-3t.$environment.paypal.com/nvp";
		}
		$version = urlencode('51.0');
	 
		// Set the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
	 
		// Turn off the server and peer verification (TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
	 
		// Set the API operation, version, and API signature in the request.
		$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";
	 
		// Set the request as a POST FIELD for curl.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
	 
		// Get response from the server.
		$httpResponse = curl_exec($ch);
	 
		if(!$httpResponse) {
			exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
		}
	 
		// Extract the response details.
		$httpResponseAr = explode("&", $httpResponse);
	 
		$httpParsedResponseAr = array();
		foreach ($httpResponseAr as $i => $value) {
			$tmpAr = explode("=", $value);
			if(sizeof($tmpAr) > 1) {
				$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
			}
		}
	 
		if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
			exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
		}
	 
		return $httpParsedResponseAr;
	}
	 
	// Add request-specific fields to the request string.
	$nvpStr =	"&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber".
				"&EXPDATE=$padDateMonth$expDateYear&CVV2=$cvv2Number&FIRSTNAME=$firstName".
				"&COUNTRYCODE=$country&CURRENCYCODE=$currencyID&CUSTOM=$planId&EMAIL=$email";
	 
	// Execute the API operation; see the PPHttpPost function above.
	$httpParsedResponseAr = PPHttpPost('DoDirectPayment', $nvpStr);
	 
	if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
		//exit('Direct Payment Completed Successfully: '.print_r($httpParsedResponseAr, true));
		
		$amount = urldecode($httpParsedResponseAr["AMT"]);
		$plan_id = 1;
		$sb_date = date("YmdHis",time());
		$timeStamp = urldecode($httpParsedResponseAr["TIMESTAMP"]);
		$transactionId = urldecode($httpParsedResponseAr["TRANSACTIONID"]);
		$sb_duration = '30';
		$insert_query = "update users_register set plan_id=$plan_id, plan_registered_on= '$sb_date', plan_expiry=DATE_ADD($sb_date,INTERVAL $sb_duration DAY), total_sent='0' where id=$user_id";
		if(mysql_query($insert_query)){
			if(mysql_query("insert into users_transaction(`userID`,`transactionID`,`timeStamp`,`amount`) values ('$user_id','$transactionId','$timeStamp','$amount')")){
				header("location:ordersuccess.php");
				die();	
			}
		}
		
	} else  {
		$_SESSION['errormessage'] = "Transaction Failed. Please Try Again.";
		header("location:payment.php");
		die();
		//exit('DoDirectPayment failed: ' . print_r($httpParsedResponseAr, true));
	}
}


?>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(e) {
	//$("#paypal").hide();
	$("#paypalDiv").hide(); 
	$("#paypal_cb").click(function(e){
		$("#creditCardDiv").hide(); 
		$("#paypalDiv").show();
	});
	$("#visa_cb").click(function(e){
		$("#paypalDiv").hide();
		$("#creditCardDiv").show();
	});
	
    $('#planIdSelect').change(function() {
        var planId = $(this).val();
        $('#planIdText').val(planId);
    });
	
 });
</script>
<!--form right section start here-->
<div class="form_rightsection">
<div class="form_topbg"><img src="images/fromtopbg.png" width="772" height="40" alt="#" /></div>
<div class="form_midbg">
  <div class="form_contentcontainer2">
  <?php
  	if(isset($_SESSION['errormessage']) && $_SESSION['errormessage']<>""){
		echo "<div class=\"formmidpanel\"><div class=\"errordiv\">".$_SESSION['errormessage']."</div></div>";
		unset($_SESSION['errormessage']);	
	}
	
  	if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
	{
  	?>
    <div class="formmidpanel">
        <div class="formfullrow">
          <div class="labeltext">
            <label>Choose Plan </label>
          </div>
          <div class="selectbox">
            <select name="planid" id="planIdSelect">
              <option value="">Select</option>
              <option value="1">$10/Month</option>
            </select>
          </div>
        </div>
        
        <div class="formfullrow" >
          <div class=" fl" style="width:172px; float:left; font-size:16px; color:#4c4c4c;"> Choose Method</div>
          <div class="imagebox fl">
            <input type="radio" name="pay" class="pay" id="paypal_cb" />
            <img src="images/paypal.jpg" width="94" height="33" /> </div>
          <div class="imagebox2 fl">
            <input type="radio" checked="checked" class="pay" name="pay" id="visa_cb" />
            <img src="images/visa.jpg" width="95" height="29" alt="#" /> </div>
        </div>
        
        <div class="fullformrow" id="paypalDiv">
          <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
            <input name="amount" type="hidden" id="amount" value="10">
            <input type="hidden" name="cmd" value="_xclick">
            <input type="hidden" name="business" value="sushil.singh-facilitator@cyfuture.com">
            <input type="hidden" name="item_name" value="Subscription Plan">
            <input type="hidden" name="item_number" value="1">
            <input type="hidden" name="custom" value="<?php echo $_SESSION['user_id']; ?>">
            <input type="hidden" name="return" value="<?php echo $root; ?>/thanks.php">
            <input type="hidden" name="cancel_return" value="<?php echo $root; ?>/cancel.php">
            <input type="hidden" name="rm" value="2">
            <input type="hidden" name="notify_url" value="<?php echo $root; ?>/ipn/ipn.php">
            <input type="hidden" name="no_note" value="1">
            <input type="hidden" name="currency_code" value="USD">
            
            <div style="clear:both"></div>
            <input class="submit" type="submit" name="submit_paypal" id="submit_paypal" value="" />
          </form>
        </div>
        
        <div class="fullformrow" id="creditCardDiv">
      	<form action="" method="post" name="paymentform">
          <div class="formfullrow">
            <div class="labeltext">
              <label>Card Type </label>
            </div>
            <div class="selectbox">
               <select name="cardType">
                    <option value="">Select</option>
                    <option value="visa">Visa</option>
                    <option value="master_card">Master Card</option>
                    <option value="discocer">Discover</option>
                    <option value="visa">Visa</option>
                 </select>
          	</div>
            
          </div>
          <div class="formfullrow">
            <div class="labeltext">
              <label>Card Number </label>
            </div>
            <input type="text" name="crdtCardNum" value="" class="smallinput" />
          </div>
          <div class="formfullrow">
            <div class="labeltext">
              <label>Expiry Month & Year </label>
            </div>
            <div style="width:315px; float:left;">
              <div class="selectbox2 fl">
                <select name="expryMonth">
                  <option value="">Month</option>
                  <?php
				  	for($i=01;$i<=12;$i++)
					{
						$month = str_pad($i, 2, '0', STR_PAD_LEFT);
						echo '<option value="'.$month.'">'.$month.'</option>';	
					}
				  ?>
                </select>
              </div>
              <div class="selectbox2 fr">
                <select name="expryYear">
                  <option value="">Year</option>
                  <?php
				  	for($i=date('Y');$i<=date('Y')+10;$i++)
					{
						echo '<option value="'.$i.'">'.$i.'</option>';	
					}
				  ?>
                </select>
              </div>
            </div>
          </div>
          <div class="formfullrow">
            <div class="labeltext">
              <label>CVV* </label>
            </div>
            <input name="cvvNum" type="text" value="" class="smallinput2" />
            <input name="planIdText" value="" id="planIdText" type="hidden" value="" />
          </div>
          <div class="fullformrow" d="paypal">
            <button name="submitCreditCardInfo" type="submit" class="submit"></button>
          </div>
     	</form>
        </div>
    </div>
    <?php
	}else{
		echo "<div class=\"formmidpanel\"><div class=\"errordiv\">Not Valid</div></div>";
	}
	?>
  </div>
</div>
<div class="form_topbg"><img src="images/bottombg.png" width="772" height="230" alt="#" /></div>
</div>
<!--form right section end here--> 
      
    </div>
  </div>
</div>
</body>
</html>