<?php
 	 
define("ROOT","");
include ROOT.'payment_config/constants.php'; 

$payment_handler=new Payment();

if(!isset($_SESSION['user_id'])) {   
    header("Location:login.php");
}
$userId = $_SESSION['user_id'];
if(!isset($_SESSION['planid'])) {
     $planId = $_GET['planid'];
     $_SESSION['planid'] = $planId;
}else{
     $planId = $_SESSION['planid'];
} 
  
 // here we are getting user information 
    $arrUser   = $payment_handler->userDetails($userId);  
    $email     = $arrUser['txt_email'];
    $firstname = $arrUser['txt_first_name'];
    $lastname  = $arrUser['txt_last_name'];
    
 // here we are getting plan information
 
    $plan="select * from plans where id = '$planId'";
    $result_plan  = mysql_query($plan) or die(mysql_error());
    $arrPlan      = mysql_fetch_array($result_plan);  
    $planname = $arrPlan['plan'];
    $price    = $arrPlan['price'];
    $planId   = $arrPlan['id'];
    $period   = $arrPlan['period'];
    if($period == 'M'){
	$frequency = '1';
	$ccperiod = 'Month';
    }else{
	$frequency = '12';
	$ccperiod = 'Year';
    }
    
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Databagg</title>

<link href="App_Theme/mainstyle.css" rel="stylesheet" type="text/css" />

<!--pricing tab start-->
<script type="text/javascript" src="Script/tabhow-it/jquery.min.js"></script>
<script type="text/javascript" src="Script/tabhow-it/tytabs.jquery.min.js"></script>
<script type="text/javascript">
<!--
$(document).ready(function(){
	$("#tabsholder").tytabs({
							tabinit:"2",
							fadespeed:"fast"
							});
	$("#tabsholder2").tytabs({
							prefixtabs:"tabz",
							prefixcontent:"contentz",
							classcontent:"tabscontent",
							tabinit:"3",
							catchget:"tab2",
							fadespeed:"normal"
							});
});
-->
</script>
<!--pricing tab closed-->

<!--tooltips start-->

<script>
function showdiv()
  {

	    document.getElementById("tooltip").style.display = 'block';

 }
 
 function hidediv()
  {

	    document.getElementById("tooltip").style.display = 'none';

 }
	
	
</script>

<!--<script type="text/javascript" src="Script/tooltips/tooltip.js"></script>-->
<!-- tooltips cend-->
<link href='http://fonts.googleapis.com/css?family=PT+Sans:400' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="mainpageheader">
<div class="databag-menu">
    	<div class="databag-menu-left">
   <div class="underlinemenu-left">     
    <div class="underlinemenu">
<ul>
<li><a href="features.html" style="background:none;">Features</a></li>
<li><a href="free-trial.html">Free Trial</a></li>
</ul>
</div>
<div style="clear:both;"></div>
</div>
</div>
        <div class="databag-menu-middle">
        <div class="home"><a href="index.php"><img src="images/home.png" width="35" height="36" border="0" alt="" /></a></div>
        
</div>
        <div class="databag-menu-right">
        	<div class="underlinemenu-right-top">            
		
		<?php if(!isset($_SESSION['user_id'])) {  ?>   
			<div class="login"><a href="login.html"><img src="images/login.png" alt="" width="81" height="36" border="0" /></a></div>
			<div class="loginsign"><a href="signuup.html"><img src="images/signup.png" alt=""  width="91" height="36" border="0" /></a>
			</div>
		<?php } ?>
            </div>
        
        <div class="underlinemenu-right">     
    <div class="underlinemenu">
<ul>
<li><a href="pricing.php" style="background:none;">Pricing</a></li>
<li><a href="how-works.html">How it Works</a></li>
</ul>
</div>
<div style="clear:both;"></div>
</div>
</div>
  </div>
  
  

  <div class="other-content">
  <div class="other-content-top"></div>
    <div class="other-content-middle">
   <div class="avail"><img src="images/avail.png" width="941" height="87" alt="" /></div>
   <div class="freetrialpricing">
    <div class="freetrialpricing-row">Your Current plan - 5GB FREE</div>
    <div class="freetrialpricing-row-t">Good choice! You have selected 250 GB Plan</div>
    <div style="margin-left: 40px;" class="captionnew"><?php echo $planname; ?> : $<?php echo $price; ?>
     
    
    </div>
        	
              <div class="captionnew">Pay with a credit card or payPal</div>
              
              <div class="newpricing-tab"><div class="center">
    <p>&nbsp;</p>
    <!-- Tabs -->
    <div id="tabsholder">

        <ul class="tabs">
         <li id="tab2">Pay with PayPal</li>
            <li id="tab1">Pay with Credit Card</li>
           
   
        </ul>
        <div class="contents marginbot">

            <div id="content1" class="tabscontent">


<div class="visaaccountmain">


<div style="width:700px; position: relative; display:none;" id="tooltip" >

<div style="width:700px; position: absolute; top:110px; left:22px;">


<div class="tooltipContent" id="sprytooltip1">

<div class="tooltipContent-left">

<h2>Card security code</h2>
<p>Your card code is a 3 or 4 digit number that is found in these locations:</p>

<h3>Visa/Mastercard</h3>
<p>The security code is a 3 digit number on the back of your credit card. It immediately follows your main card number.</p>

</div>
<div class="tooltipContent-right">
<div class="tooltipContent-rightimag">

  <img src="images/databggtool.png" width="133" height="85" alt=""></div>
</div>

</div>

</div>

</div>
 <form action="CreateRPProfileReceipt.php" method="POST">
<div class="visaaccount"><img src="images/visa.jpg" hspace="4" alt="" /> <img src="images/mastercard.jpg" hspace="4" /> <img src="images/discover.png" alt="" hspace="4"/>    <img src="images/americanexpress.png" alt="" hspace="4" />  </div>

<div class="formfillne">
<p>Card Number<img src="images/starIcon.png"/></p>
<input name="card_number" type="text" id="card_number" class="inputpaypal" maxlength="16"/>
<p>First Name<img src="images/starIcon.png"/></p>
<input name="fname" type="text" id="fname" class="inputpaypal"  maxlength="25"/>

 <p>Last Name<img src="images/starIcon.png"/></p>
<input name="lname" id="lname" type="text"  class="inputpaypal" maxlength="25"/>




<p>Street Address<img src="images/starIcon.png"/></p>
<input name="address" type="text" id="address" class="inputpaypal" maxlength="100"/>
<p>City<img src="images/starIcon.png"/></p>
<input name="city" type="text" id="city" class="inputpaypal" maxlength="25"/>


</div>





<div class="formfillne lmar">
<div class="formfillnefd">

<p>Expiration Date<img src="images/starIcon.png"/></p>
<div class="left_lnew">
	
<select name="expmo" id="expmo" class="stateinputmlnew">
<option value=1>01</option>
				<option value=2>02</option>
				<option value=3>03</option>
				<option value=4>04</option>
				<option value=5>05</option>
				<option value=6>06</option>
				<option value=7>07</option>
				<option value=8>08</option>
				<option value=9>09</option>
				<option value=10>10</option>
				<option value=11>11</option>
				<option value=12>12</option>
</select>
</div>



<div class="left_rnew">

<input type="text" value="Security" name="security" id="security"
 onblur="if (this.value == '') {this.value = 'Security';}"
 onfocus="if (this.value == 'Security') {this.value = '';}" class="stateinputmsecrity" />


</div>


<span id="sprytrigger1" onmouseover="showdiv();" onmouseout="hidediv();"><img src="images/waht.png" width="25" height="25" /></span>



<div style="clear:both;"></div>
</div>

<div class="formfillnefd">
<p>Card Type<img src="images/starIcon.png"/></p>
<div class="left_lnew">
	
<select name="cardType" id="cardType" class="stateinputmlnew">
				<option value=Visa selected>Visa</option>
				<option value=MasterCard>MasterCard</option>
				<option value=Discover>Discover</option>
				<option value=Amex>American Express</option>
</select>
</div>


<div class="left_mnew">
	<?php
		$current = date('Y');
		$endYear = $current+16;
	?>
	<select name="expyear" id="expyear" class="stateinputmmnew">
	<?php	
		for($current;$current<=$endYear;$current++){
		$cardYear = $current; 
	?>

	
				<option value=<?php echo $cardYear; ?>><?php echo $cardYear; ?></option>
	<?php } ?>
</select>
</div>
<div style="clear:both;"></div>
</div>
 




	
 
<div class="formfillnefd">
<div class="left_f">
<p>State/Province/Region<img src="images/starIcon.png"/></p>
<input name="state" id="state" type="text"  class="stateinput" maxlength="25"/>
</div>


<div class="left_r">
<p>ZIP/Postal Code<img src="images/starIcon.png"/></p>

<input name="zip" id="zip" type="text"  class="stateinput" maxlength="10"/>

</div>
<div style="clear:both;"></div>
</div>

<p>Country<img src="images/starIcon.png"/></p>

<select name="country" id="country" class="seclect">
<option value="">Choose a Country<img src="images/starIcon.png"/></option>
			       		
			   				<option value="US" >United States</option>
			      		
			   				<option value="CA" >Canada</option>
			      		
			   				<option value="GB" >United Kingdom</option>
			      		
			   				<option value="JP" >Japan</option>
			      		
			   				<option value="ES" >Spain</option>
			      		
			   				<option value="MX" >Mexico</option>
			      		
			   				<option value="FR" >France</option>
			      		
			   				<option value="DE" >Germany</option>
			      		
			   				<option value="IT" >Italy</option>
			      		
				        <option value="">-----</option>
				        
				            <option value="AF" >Afghanistan</option>
				        
				            <option value="AL" >Albania</option>
				        
				            <option value="DZ" >Algeria</option>
				        
				            <option value="AS" >American Samoa (US)</option>
				        
				            <option value="AD" >Andorra</option>
				        
				            <option value="AO" >Angola</option>
				        
				            <option value="AI" >Anguilla (UK)</option>
				        
				            <option value="AG" >Antigua and Barbuda</option>
				        
				            <option value="AR" >Argentina</option>
				        
				            <option value="AM" >Armenia</option>
				        
				            <option value="AW" >Aruba</option>
				        
				            <option value="AU" >Australia</option>
				        
				            <option value="AT" >Austria</option>
				        
				            <option value="AZ" >Azerbaijan</option>
				        
				            <option value="BS" >Bahamas</option>
				        
				            <option value="BH" >Bahrain</option>
				        
				            <option value="BD" >Bangladesh</option>
				        
				            <option value="BB" >Barbados</option>
				        
				            <option value="BY" >Belarus</option>
				        
				            <option value="BE" >Belgium</option>
				        
				            <option value="BZ" >Belize</option>
				        
				            <option value="BJ" >Benin</option>
				        
				            <option value="BM" >Bermuda (UK)</option>
				        
				            <option value="BT" >Bhutan</option>
				        
				            <option value="BO" >Bolivia</option>
				        
				            <option value="BA" >Bosnia and Herzegovina</option>
				        
				            <option value="BW" >Botswana</option>
				        
				            <option value="BR" >Brazil</option>
				        
				            <option value="VG" >British Virgin Islands (UK)</option>
				        
				            <option value="BN" >Brunei Darussalam</option>
				        
				            <option value="BG" >Bulgaria</option>
				        
				            <option value="BF" >Burkina Faso</option>
				        
				            <option value="BI" >Burundi</option>
				        
				            <option value="KH" >Cambodia</option>
				        
				            <option value="CM" >Cameroon</option>
				        
				            <option value="CA" >Canada</option>
				        
				            <option value="CV" >Cape Verde</option>
				        
				            <option value="KY" >Cayman Islands (UK)</option>
				        
				            <option value="CF" >Central African Republic</option>
				        
				            <option value="TD" >Chad</option>
				        
				            <option value="CL" >Chile</option>
				        
				            <option value="CN" >China</option>
				        
				            <option value="CX" >Christmas Island (AU)</option>
				        
				            <option value="CC" >Cocos (Keeling) Islands (AU)</option>
				        
				            <option value="CO" >Colombia</option>
				        
				            <option value="KM" >Comoros</option>
				        
				            <option value="CD" >Congo, Democratic Republic of the</option>
				        
				            <option value="CG" >Congo, Republic of the</option>
				        
				            <option value="CK" >Cook Islands (NZ)</option>
				        
				            <option value="CR" >Costa Rica</option>
				        
				            <option value="CI" >Cote DIvoire</option>
				        
				            <option value="HR" >Croatia</option>
				        
				            <option value="CU" >Cuba</option>
				        
				            <option value="CY" >Cyprus</option>
				        
				            <option value="CZ" >Czech Republic</option>
				        
				            <option value="DK" >Denmark</option>
				        
				            <option value="DJ" >Djibouti</option>
				        
				            <option value="DM" >Dominica</option>
				        
				            <option value="DO" >Dominican Republic</option>
				        
				            <option value="EC" >Ecuador</option>
				        
				            <option value="EG" >Egypt</option>
				        
				            <option value="SV" >El Salvador</option>
				        
				            <option value="GQ" >Equatorial Guinea</option>
				        
				            <option value="ER" >Eritrea</option>
				        
				            <option value="EE" >Estonia</option>
				        
				            <option value="ET" >Ethiopia</option>
				        
				            <option value="FK" >Falkland Islands (UK)</option>
				        
				            <option value="FO" >Faroe Islands (DK)</option>
				        
				            <option value="FJ" >Fiji</option>
				        
				            <option value="FI" >Finland</option>
				        
				            <option value="FR" >France</option>
				        
				            <option value="GF" >French Guiana (FR)</option>
				        
				            <option value="PF" >French Polynesia (FR)</option>
				        
				            <option value="GA" >Gabon</option>
				        
				            <option value="GM" >Gambia</option>
				        
				            <option value="GE" >Georgia</option>
				        
				            <option value="DE" >Germany</option>
				        
				            <option value="GH" >Ghana</option>
				        
				            <option value="GI" >Gibraltar (UK)</option>
				        
				            <option value="GR" >Greece</option>
				        
				            <option value="GL" >Greenland (DK)</option>
				        
				            <option value="GD" >Grenada</option>
				        
				            <option value="GP" >Guadeloupe (FR)</option>
				        
				            <option value="GU" >Guam (US)</option>
				        
				            <option value="GT" >Guatemala</option>
				        
				            <option value="GN" >Guinea</option>
				        
				            <option value="GW" >Guinea-Bissau</option>
				        
				            <option value="GY" >Guyana</option>
				        
				            <option value="HT" >Haiti</option>
				        
				            <option value="VA" >Holy See (Vatican City)</option>
				        
				            <option value="HN" >Honduras</option>
				        
				            <option value="HK" >Hong Kong (CN)</option>
				        
				            <option value="HU" >Hungary</option>
				        
				            <option value="IS" >Iceland</option>
				        
				            <option value="IN" >India</option>
				        
				            <option value="ID" >Indonesia</option>
				        
				            <option value="IR" >Iran</option>
				        
				            <option value="IQ" >Iraq</option>
				        
				            <option value="IE" >Ireland</option>
				        
				            <option value="IL" >Israel</option>
				        
				            <option value="IT" >Italy</option>
				        
				            <option value="JM" >Jamaica</option>
				        
				            <option value="JP" >Japan</option>
				        
				            <option value="JO" >Jordan</option>
				        
				            <option value="KZ" >Kazakhstan</option>
				        
				            <option value="KE" >Kenya</option>
				        
				            <option value="KI" >Kiribati</option>
				        
				            <option value="KP" >Korea, Democratic Peoples Republic (North)</option>
				        
				            <option value="KR" >Korea, Republic of (South)</option>
				        
				            <option value="KW" >Kuwait</option>
				        
				            <option value="KG" >Kyrgyzstan</option>
				        
				            <option value="LA" >Laos</option>
				        
				            <option value="LV" >Latvia</option>
				        
				            <option value="LB" >Lebanon</option>
				        
				            <option value="LS" >Lesotho</option>
				        
				            <option value="LR" >Liberia</option>
				        
				            <option value="LY" >Libya</option>
				        
				            <option value="LI" >Liechtenstein</option>
				        
				            <option value="LT" >Lithuania</option>
				        
				            <option value="LU" >Luxembourg</option>
				        
				            <option value="MO" >Macau (CN)</option>
				        
				            <option value="MK" >Macedonia</option>
				        
				            <option value="MG" >Madagascar</option>
				        
				            <option value="MW" >Malawi</option>
				        
				            <option value="MY" >Malaysia</option>
				
				            <option value="MV" >Maldives</option>
				        
				            <option value="ML" >Mali</option>
				        
				            <option value="MT" >Malta</option>
				        
				            <option value="MH" >Marshall Islands</option>
				        
				            <option value="MQ" >Martinique (FR)</option>
				        
				            <option value="MR" >Mauritania</option>
				        
				            <option value="MU" >Mauritius</option>
				        
				            <option value="YT" >Mayotte (FR)</option>
				        
				            <option value="MX" >Mexico</option>
				        
				            <option value="FM" >Micronesia, Federated States of</option>
				        
				            <option value="MD" >Moldova Republic of</option>
				        
				            <option value="MC" >Monaco</option>
				        
				            <option value="MN" >Mongolia</option>
				        
				            <option value="MS" >Montserrat (UK)</option>
				        
				            <option value="MA" >Morocco</option>
				        
				            <option value="MZ" >Mozambique</option>
				        
				            <option value="MM" >Myanmar</option>
				        
				            <option value="NA" >Namibia</option>
				        
				            <option value="NR" >Nauru</option>
				        
				            <option value="NP" >Nepal</option>
				        
				            <option value="NL" >Netherlands</option>
				        
				            <option value="AN" >Netherlands Antilles (NL)</option>
				        
				            <option value="NC" >New Caledonia (FR)</option>
				        
				            <option value="NZ" >New Zealand</option>
				        
				            <option value="NI" >Nicaragua</option>
				        
				            <option value="NE" >Niger</option>
				        
				            <option value="NG" >Nigeria</option>
				        
				            <option value="NU" >Niue</option>
				        
				            <option value="NF" >Norfolk Island (AU)</option>
				        
				            <option value="MP" >Northern Mariana Islands (US)</option>
				        
				            <option value="NO" >Norway</option>
				        
				            <option value="OM" >Oman</option>
				        
				            <option value="PK" >Pakistan</option>
				        
				            <option value="PW" >Palau</option>
				        
				            <option value="PA" >Panama</option>
				        
				            <option value="PG" >Papua New Guinea</option>
				        
				            <option value="PY" >Paraguay</option>
				        
				            <option value="PE" >Peru</option>
				        
				            <option value="PH" >Philippines</option>
				        
				            <option value="PN" >Pitcairn Islands (UK)</option>
				        
				            <option value="PL" >Poland</option>
				        
				            <option value="PT" >Portugal</option>
				        
				            <option value="PR" >Puerto Rico (US)</option>
				        
				            <option value="QA" >Qatar</option>
				        
				            <option value="RE" >Reunion (FR)</option>
				        
				            <option value="RO" >Romania</option>
				        
				            <option value="RU" >Russia</option>
				        
				            <option value="RW" >Rwanda</option>
				        
				            <option value="SH" >Saint Helena (UK)</option>
				        
				            <option value="KN" >Saint Kitts and Nevis</option>
				        
				            <option value="LC" >Saint Lucia</option>
				        
				            <option value="PM" >Saint Pierre &amp; Miquelon (FR)</option>
				        
				            <option value="VC" >Saint Vincent and the Grenadines</option>
				        
				            <option value="WS" >Samoa</option>
				        
				            <option value="SM" >San Marino</option>
				        
				            <option value="ST" >Sao Tome and Principe</option>
				        
				            <option value="SA" >Saudi Arabia</option>
				        
				            <option value="SN" >Senegal</option>
				        
				            <option value="CS" >Serbia and Montenegro</option>
				        
				            <option value="SC" >Seychelles</option>
				        
				            <option value="SL" >Sierra Leone</option>
				        
				            <option value="SG" >Singapore</option>
				        
				            <option value="SK" >Slovakia</option>
				        
				            <option value="SI" >Slovenia</option>
				        
				            <option value="SB" >Solomon Islands</option>
				        
				            <option value="SO" >Somalia</option>
				        
				            <option value="ZA" >South Africa</option>
				        
				            <option value="GS" >South Georgia &amp; South Sandwich Islands (UK)</option>
				        
				            <option value="ES" >Spain</option>
				        
				            <option value="LK" >Sri Lanka</option>
				        
				            <option value="SD" >Sudan</option>
				        
				            <option value="SR" >Suriname</option>
				        
				            <option value="SZ" >Swaziland</option>
				        
				            <option value="SE" >Sweden</option>
				        
				            <option value="CH" >Switzerland</option>
				        
				            <option value="SY" >Syria</option>
				        
				            <option value="TW" >Taiwan</option>
				        
				            <option value="TJ" >Tajikistan</option>
				        
				            <option value="TZ" >Tanzania</option>
				        
				            <option value="TH" >Thailand</option>
				        
				            <option value="TL" >Timor-Leste</option>
				        
				            <option value="TG" >Togo</option>
				        
				            <option value="TK" >Tokelau</option>
				        
				            <option value="TO" >Tonga</option>
				        
				            <option value="TT" >Trinidad and Tobago</option>
				        
				            <option value="TN" >Tunisia</option>
				        
				            <option value="TR" >Turkey</option>
				        
				            <option value="TM" >Turkmenistan</option>
				        
				            <option value="TC" >Turks and Caicos Islands (UK)</option>
				        
				            <option value="TV" >Tuvalu</option>
				        
				            <option value="UG" >Uganda</option>
				        
				            <option value="UA" >Ukraine</option>
				        
				            <option value="AE" >United Arab Emirates</option>
				        
				            <option value="GB" >United Kingdom</option>
				        
				            <option value="US" >United States</option>
				        
				            <option value="UY" >Uruguay</option>
				        
				            <option value="UZ" >Uzbekistan</option>
				        
				            <option value="VU" >Vanuatu</option>
				        
				            <option value="VE" >Venezuela</option>
				        
				            <option value="VN" >Vietnam</option>
				        
				            <option value="VI" >Virgin Islands (US)</option>
				        
				            <option value="WF" >Wallis and Futuna (FR)</option>
				        
				            <option value="EH" >Western Sahara</option>
				        
				            <option value="YE" >Yemen</option>
				        
				            <option value="ZM" >Zambia</option>
				        
				            <option value="ZW" >Zimbabwe</option>
				        
</select>
<p>Phone (Optional)</p>
<div class="inputpaypalvb"><input name="phone" type="text" id="phone" class="inputpaypal" maxlength="15"/> </div>

<!-- Hidden valuse for credit card payments -->
<input name="ccamount" type="hidden" value="<?php echo $price; ?>"   />
<input name="ccfrequency" type="hidden" value="<?php echo $frequency; ?>"   />
<input name="ccperiod" type="hidden" value="<?php echo $ccperiod; ?>"   />
<input name="ccprofileDesc" type="hidden" value="DataBagg Plan-<?php echo $planname; ?>"   />


</div>
</div>
<div class="upgradeall">
<div class="upgradebutton">
	<input type="image" src="images/upgradenew.png" border="0"  name="submit" alt="Make payments with Credit Card - it's fast, free and secure!"> 

</div>


<div class="cancelbutton">
	<a href="pricing.php"><img src="images/cancel.png" border="0" w name="cancel" alt="cancel"> </a>

</div>

</div>


</form>

<form action="payments.php" method="POST">
	
	 <input type="hidden" name="cmd" value="_xclick-subscriptions">
         <input type="hidden" name="no_note" value="1" />
         <input type="hidden" name="lc" value="USA" />
         <input type="hidden" name="currency_code" value="USD" />
         <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
         <input type="hidden" name="first_name" value="<?php echo $firstname; ?>"  />
         <input type="hidden" name="last_name" value="<?php echo $lastname; ?>"  />
         <input type="hidden" name="payer_email" value="<?php echo $email; ?>"  />
         <input type="hidden" name="item_number" value="<?php echo $planId; ?>" / >
         <input type="hidden" name="plan_name" value="<?php echo $planname; ?>" / >
	 <input type="hidden" name="userid" value="<?php echo $userId; ?>" / >
         <input type="hidden" name="price" value="<?php echo $price; ?>" / > 
         <input type="hidden" name="a3" value="<?php echo $price; ?>"> 
         <input type="hidden" name="p3" value="<?php echo $frequency;?>"> 
         <input type="hidden" name="t3" value="<?php echo $period; ?>"> 
         <input type="hidden" name="src" value="1"> 
         <input type="hidden" name="sra" value="1">            
         
		
<div class="trustee"><img src="images/trutee.jpg"  alt="" /></div> 
</div>
            <div id="content2" class="tabscontent">
          <div class="visaaccountmaintab"><p> How to complete sign up with PayPal:
Click the "Continue to PayPal" button below. You will be taken to PayPal's website to complete your order and then brought back to DataBagg</p></div>
	 <div class="con-paypal">
		<input type="image" src="images/continuepaypal.png" border="0" width="223" height="54" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
		 </div>
	 
<div class="trusteepaypal"><!-- Begin Official PayPal Seal --><a href="https://www.sandbox.paypal.com/us/verified/pal=sachin%2esharma%2dfacilitator%40cyfuture%2ecom" target="_blank"><img src="https://www.paypal.com/en_US/i/icon/verification_seal.gif" border="0" alt="Official PayPal Seal"></A><!-- End Official PayPal Seal --></div>

   </div>
</form>            
            
        </div>
    </div>
    <!-- /Tabs -->

</div>


 <div style="clear:both"></div> 
</div>
              
              
         <div style="clear:both"></div>    
    
    </div>
    
    
    
   <div style="clear:both"></div>
    </div>
    <div class="other-content-bottom"></div>
    <div style="clear:both"></div>
  
  </div>
  
  
	
    <div style="clear:both"></div>
</div>




<div class="callinimh"><img src="images/calling.jpg" alt="" width="1000" height="189" border="0" usemap="#Map" />
  <map name="Map" id="Map">
    <area shape="rect" coords="579,114,891,145" href="mailto:sales@databagg.com" />
  </map>
</div>









<div class="footer">

<div class="footer-in-top"> 
<ul>
<li><strong>Product</strong></li>
<li><a href="pricing.php">Pricing</a></li>
<li><a href="features.html">Features</a></li>
<li><a href="how-works.html">How it works</a></li><li><a href="Download.html">Download</a></li>

</ul>


<ul>
<li><strong>Company</strong></li>
<li><a href="about-us.html">About Us</a></li>               
<li><a href="blogs.html">Blogs</a></li>                       
<li><a href="news.html">News</a></li> 
<li><a href="press-release.html">Press Release</a></li>        

</ul>


<ul>
<li><strong>Learn More</strong></li>
<li><a href="support.html">Support</a></li>
<li><a href="help/index.php">Help</a></li>
<li><a href="tutorial.html">Tutorial</a></li>
<li><a href="privacy-policy.html">Privacy Policy</a></li>
</ul>




<div class="social-media">
<h2>Connect with us</h2>
	<div class="social-media-t">
    	
        <div class="social-media-t-l">
        	<div class="social-media-t-l-img"><img src="images/facebook.png" alt=""  /></div>
            	<div class="social-media-t-l-text"><a href="http://www.facebook.com/Databagg">Facebook</a></div>
        
        </div>
    
    
    
    <div class="social-media-t-r">
        	<div class="social-media-t-l-img"><img src="images/twitter.png" alt=""  /></div>
            	<div class="social-media-t-l-text"><a href="https://twitter.com/DataBagg">Twitter</a></div>
        
        </div>
    </div>
    
    
    
    
    
    <div class="social-media-b">
    	
        <div class="social-media-t-l">
        	<div class="social-media-t-l-img"><img src="images/gplus.png" alt=""  /></div>
            	<div class="social-media-t-l-text"><a href="https://plus.google.com/117226672667714086519/posts?hl=en-GB">Google+</a></div>
        
        </div>
    
    
    
    <div class="social-media-t-r">
        	<div class="social-media-t-l-img"><img src="images/in.png"  alt="" /></div>
            	<div class="social-media-t-l-text"><a href="http://in.linkedin.com/pub/databagg/62/9b4/570">Linkdin</a></div>
        
        </div>
    
    
    
    </div>
</div>

</div>
<div style="clear:both;"></div>
</div>


<div class="footer-in-bottom">    
 
   <div class="textfooter">Copyright &copy; 2012 <strong><a href="index.php">Data Bagg</a></strong>, Inc. All rights reserved.</div>
   
   	<div class="textfooterimg-right"> <a href="index.php"><img src="images/bottomlogo.png" alt="" border="0" /></a></div>
</div>
</body>
</html>
