<!DOCTYPE HTML>
<html>
<head>
<title>Databagg</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

<link rel="stylesheet" href="App_Theme/reset.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="App_Theme/newstyle.css" type="text/css" media="screen"/>
<link href="fonts/font.css" rel="stylesheet">
<script type="text/javascript" src="js/html5.js"></script>

<!--[if IE 7]>
<link rel="stylesheet" href="css/ie7.css" type="text/css" media="screen"/>
<![endif]-->

<!--[if lt IE 7]>

        <div style=' clear: both; text-align:center; position: relative;'>
            <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0"  alt="" /></a>
        </div>
	<![endif]-->
<!--[if lt IE 9]>
   		<script type="text/javascript" src="js/html5.js"></script>
        <link rel="stylesheet" href="App_Theme/ie.css" type="text/css" media="screen">
	<![endif]-->

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



</head>

<body>


<div id="innerwrapper_container">
	
    <!--Header start here-->
  <div class="innerheader_fixed">
   <?php include('inner-header.php')?>
  
  </div>
    <!--header end here-->
<!--inner mid section start here-->
<div class="innercontent_contatiner">
	<div class="mid_container">
    
    <div class="other-content">
 
   
   
   <div class="freetrialpricing">
   <div class="pricing-upgraderow">UPGRADE PLAN</div>
    <div class="freetrialpricing-row">Your Current plan - 5GB FREE</div>
    <div class="freetrialpricing-row-t">Good choice! You have selected 250 GB Plan </div>
    <div class="pricingtgreyrow">
    <div class="pricing_plan1"><input type="radio">Yearly Plan: $74.99 / year</div>
    <div class="pricing_plan2"><input type="radio">Monthly Plan: $7.49 / year</div>     
    
    </div>
        	
              <div class="captionnew">Pay with a credit card or payPal</div>
              
              <div class="newpricing-tab"><div class="center">
    <p>&nbsp;</p>
    <!-- Tabs -->
    <div id="tabsholder">

        <ul class="tabs">
         <li id="tab2" class="current">Pay with PayPal</li>
            <li id="tab1">Pay with Credit Card</li>
           
   
        </ul>
        <div class="contents marginbot">

            <div class="tabscontent" id="content1">


<div class="visaaccountmain">


<div id="tooltip" style="width:700px; position: relative; display:none;">

<div style="width:700px; position: absolute; top:110px; left:22px;">


<div id="sprytooltip1" class="tooltipContent">

<div class="tooltipContent-left">

<h2>Card security code</h2>
<p>Your card code is a 3 or 4 digit number that is found in these locations:</p>

<h3>Visa/Mastercard</h3>
<p>The security code is a 3 digit number on the back of your credit card. It immediately follows your main card number.</p>

</div>
<div class="tooltipContent-right">
<div class="tooltipContent-rightimag">

  <img width="133" height="85" alt="" src="images/databggtool.png"></div>
</div>

</div>

</div>

</div>
 <form method="POST" action="CreateRPProfileReceipt.php">
<div class="visaaccount"><img hspace="4" alt="" src="images/visa.jpg"> <img hspace="4" src="images/mastercard.jpg"> <img hspace="4" alt="" src="images/discover.png">    <img hspace="4" alt="" src="images/americanexpress.png">  </div>

<div class="formfillne">
<p>Card Number<img src="images/starIcon.png"></p>
<input type="text" maxlength="16" class="inputpaypal" id="card_number" name="card_number">
<p>First Name<img src="images/starIcon.png"></p>
<input type="text" maxlength="25" class="inputpaypal" id="fname" name="fname">

 <p>Last Name<img src="images/starIcon.png"></p>
<input type="text" maxlength="25" class="inputpaypal" id="lname" name="lname">




<p>Street Address<img src="images/starIcon.png"></p>
<input type="text" maxlength="100" class="inputpaypal" id="address" name="address">
<p>City<img src="images/starIcon.png"></p>
<input type="text" maxlength="25" class="inputpaypal" id="city" name="city">


</div>





<div class="formfillne lmar">
<div class="formfillnefd">

<p>Expiration Date<img src="images/starIcon.png"></p>
<div class="left_lnew">
	
<select class="stateinputmlnew" id="expmo" name="expmo">
<option value="1">01</option>
				<option value="2">02</option>
				<option value="3">03</option>
				<option value="4">04</option>
				<option value="5">05</option>
				<option value="6">06</option>
				<option value="7">07</option>
				<option value="8">08</option>
				<option value="9">09</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
</select>
</div>



<div class="left_mnew">
		<select class="stateinputmmnew" id="expyear" name="expyear">
	
	
				<option value="2013">2013</option>
	
	
				<option value="2014">2014</option>
	
	
				<option value="2015">2015</option>
	
	
				<option value="2016">2016</option>
	
	
				<option value="2017">2017</option>
	
	
				<option value="2018">2018</option>
	
	
				<option value="2019">2019</option>
	
	
				<option value="2020">2020</option>
	
	
				<option value="2021">2021</option>
	
	
				<option value="2022">2022</option>
	
	
				<option value="2023">2023</option>
	
	
				<option value="2024">2024</option>
	
	
				<option value="2025">2025</option>
	
	
				<option value="2026">2026</option>
	
	
				<option value="2027">2027</option>
	
	
				<option value="2028">2028</option>
	
	
				<option value="2029">2029</option>
	</select>
</div>


<span onmouseout="hidediv();" onmouseover="showdiv();" id="sprytrigger1"><img width="25" height="25" src="images/waht.png"></span>



<div style="clear:both;"></div>
</div>

<div class="formfillnefd">
<p>Card Type<img src="images/starIcon.png"></p>
<div class="left_lnew">
	
<select class="stateinputmlnew" id="cardType" name="cardType">
				<option selected="" value="Visa">Visa</option>
				<option value="MasterCard">MasterCard</option>
				<option value="Discover">Discover</option>
				<option value="Amex">American Express</option>
</select>
</div>


<div class="left_rnew">

<input type="text" class="stateinputmsecrity" onfocus="if (this.value == 'Security') {this.value = '';}" onblur="if (this.value == '') {this.value = 'Security';}" id="security" name="security" value="Security">


</div>

<div style="clear:both;"></div>
</div>
 




	
 
<div class="formfillnefd">
<div class="left_f">
<p>State/Province/Region<img src="images/starIcon.png"></p>
<input type="text" maxlength="25" class="stateinput" id="state" name="state">
</div>


<div class="left_r">
<p>ZIP/Postal Code<img src="images/starIcon.png"></p>

<input type="text" maxlength="10" class="stateinput" id="zip" name="zip">

</div>
<div style="clear:both;"></div>
</div>

<p>Country<img src="images/starIcon.png"></p>

<select class="seclect" id="country" name="country">
<option value="">Choose a Country</option>
			       		
			   		    <option value="US">United States</option> 
			   		    <option value="CA">Canada</option> 
			   		    <option value="GB">United Kingdom</option> 
			   		    <option value="JP">Japan</option> 
			   		    <option value="ES">Spain</option> 
			   		    <option value="MX">Mexico</option> 
			   		    <option value="FR">France</option> 
			   		    <option value="DE">Germany</option> 
			   		    <option value="IT">Italy</option> 
				            <option value="">-----</option> 
				            <option value="AF">Afghanistan</option>				        
				            <option value="AL">Albania</option>				        
				            <option value="DZ">Algeria</option>				        
				            <option value="AS">American Samoa (US)</option>				        
				            <option value="AD">Andorra</option>				        
				            <option value="AO">Angola</option>
				        
				            <option value="AI">Anguilla (UK)</option>
				        
				            <option value="AG">Antigua and Barbuda</option>
				        
				            <option value="AR">Argentina</option>
				        
				            <option value="AM">Armenia</option>
				        
				            <option value="AW">Aruba</option>
				        
				            <option value="AU">Australia</option>
				        
				            <option value="AT">Austria</option>
				        
				            <option value="AZ">Azerbaijan</option>
				        
				            <option value="BS">Bahamas</option>
				        
				            <option value="BH">Bahrain</option>
				        
				            <option value="BD">Bangladesh</option>
				        
				            <option value="BB">Barbados</option>
				        
				            <option value="BY">Belarus</option>
				        
				            <option value="BE">Belgium</option>
				        
				            <option value="BZ">Belize</option>
				        
				            <option value="BJ">Benin</option>
				        
				            <option value="BM">Bermuda (UK)</option>
				        
				            <option value="BT">Bhutan</option>
				        
				            <option value="BO">Bolivia</option>
				        
				            <option value="BA">Bosnia and Herzegovina</option>
				        
				            <option value="BW">Botswana</option>
				        
				            <option value="BR">Brazil</option>
				        
				            <option value="VG">British Virgin Islands (UK)</option>
				        
				            <option value="BN">Brunei Darussalam</option>
				        
				            <option value="BG">Bulgaria</option>
				        
				            <option value="BF">Burkina Faso</option>
				        
				            <option value="BI">Burundi</option>
				        
				            <option value="KH">Cambodia</option>
				        
				            <option value="CM">Cameroon</option>
				        
				            <option value="CA">Canada</option>
				        
				            <option value="CV">Cape Verde</option>
				        
				            <option value="KY">Cayman Islands (UK)</option>
				        
				            <option value="CF">Central African Republic</option>
				        
				            <option value="TD">Chad</option>
				        
				            <option value="CL">Chile</option>
				        
				            <option value="CN">China</option>
				        
				            <option value="CX">Christmas Island (AU)</option>
				        
				            <option value="CC">Cocos (Keeling) Islands (AU)</option>
				        
				            <option value="CO">Colombia</option>
				        
				            <option value="KM">Comoros</option>
				        
				            <option value="CD">Congo, Democratic Republic of the</option>
				        
				            <option value="CG">Congo, Republic of the</option>
				        
				            <option value="CK">Cook Islands (NZ)</option>
				        
				            <option value="CR">Costa Rica</option>
				        
				            <option value="CI">Cote DIvoire</option>
				        
				            <option value="HR">Croatia</option>
				        
				            <option value="CU">Cuba</option>
				        
				            <option value="CY">Cyprus</option>
				        
				            <option value="CZ">Czech Republic</option>
				        
				            <option value="DK">Denmark</option>
				        
				            <option value="DJ">Djibouti</option>
				        
				            <option value="DM">Dominica</option>
				        
				            <option value="DO">Dominican Republic</option>
				        
				            <option value="EC">Ecuador</option>
				        
				            <option value="EG">Egypt</option>
				        
				            <option value="SV">El Salvador</option>
				        
				            <option value="GQ">Equatorial Guinea</option>
				        
				            <option value="ER">Eritrea</option>
				        
				            <option value="EE">Estonia</option>
				        
				            <option value="ET">Ethiopia</option>
				        
				            <option value="FK">Falkland Islands (UK)</option>
				        
				            <option value="FO">Faroe Islands (DK)</option>
				        
				            <option value="FJ">Fiji</option>
				        
				            <option value="FI">Finland</option>
				        
				            <option value="FR">France</option>
				        
				            <option value="GF">French Guiana (FR)</option>
				        
				            <option value="PF">French Polynesia (FR)</option>
				        
				            <option value="GA">Gabon</option>
				        
				            <option value="GM">Gambia</option>
				        
				            <option value="GE">Georgia</option>
				        
				            <option value="DE">Germany</option>
				        
				            <option value="GH">Ghana</option>
				        
				            <option value="GI">Gibraltar (UK)</option>
				        
				            <option value="GR">Greece</option>
				        
				            <option value="GL">Greenland (DK)</option>
				        
				            <option value="GD">Grenada</option>
				        
				            <option value="GP">Guadeloupe (FR)</option>
				        
				            <option value="GU">Guam (US)</option>
				        
				            <option value="GT">Guatemala</option>
				        
				            <option value="GN">Guinea</option>
				        
				            <option value="GW">Guinea-Bissau</option>
				        
				            <option value="GY">Guyana</option>
				        
				            <option value="HT">Haiti</option>
				        
				            <option value="VA">Holy See (Vatican City)</option>
				        
				            <option value="HN">Honduras</option>
				        
				            <option value="HK">Hong Kong (CN)</option>
				        
				            <option value="HU">Hungary</option>
				        
				            <option value="IS">Iceland</option>
				        
				            <option value="IN">India</option>
				        
				            <option value="ID">Indonesia</option>
				        
				            <option value="IR">Iran</option>
				        
				            <option value="IQ">Iraq</option>
				        
				            <option value="IE">Ireland</option>
				        
				            <option value="IL">Israel</option>
				        
				            <option value="IT">Italy</option>
				        
				            <option value="JM">Jamaica</option>
				        
				            <option value="JP">Japan</option>
				        
				            <option value="JO">Jordan</option>
				        
				            <option value="KZ">Kazakhstan</option>
				        
				            <option value="KE">Kenya</option>
				        
				            <option value="KI">Kiribati</option>
				        
				            <option value="KP">Korea, Democratic Peoples Republic (North)</option>
				        
				            <option value="KR">Korea, Republic of (South)</option>
				        
				            <option value="KW">Kuwait</option>
				        
				            <option value="KG">Kyrgyzstan</option>
				        
				            <option value="LA">Laos</option>
				        
				            <option value="LV">Latvia</option>
				        
				            <option value="LB">Lebanon</option>
				        
				            <option value="LS">Lesotho</option>
				        
				            <option value="LR">Liberia</option>
				        
				            <option value="LY">Libya</option>
				        
				            <option value="LI">Liechtenstein</option>
				        
				            <option value="LT">Lithuania</option>
				        
				            <option value="LU">Luxembourg</option>
				        
				            <option value="MO">Macau (CN)</option>
				        
				            <option value="MK">Macedonia</option>
				        
				            <option value="MG">Madagascar</option>
				        
				            <option value="MW">Malawi</option>
				        
				            <option value="MY">Malaysia</option>
				
				            <option value="MV">Maldives</option>
				        
				            <option value="ML">Mali</option>
				        
				            <option value="MT">Malta</option>
				        
				            <option value="MH">Marshall Islands</option>
				        
				            <option value="MQ">Martinique (FR)</option>
				        
				            <option value="MR">Mauritania</option>
				        
				            <option value="MU">Mauritius</option>
				        
				            <option value="YT">Mayotte (FR)</option>
				        
				            <option value="MX">Mexico</option>
				        
				            <option value="FM">Micronesia, Federated States of</option>
				        
				            <option value="MD">Moldova Republic of</option>
				        
				            <option value="MC">Monaco</option>
				        
				            <option value="MN">Mongolia</option>
				        
				            <option value="MS">Montserrat (UK)</option>
				        
				            <option value="MA">Morocco</option>
				        
				            <option value="MZ">Mozambique</option>
				        
				            <option value="MM">Myanmar</option>
				        
				            <option value="NA">Namibia</option>
				        
				            <option value="NR">Nauru</option>
				        
				            <option value="NP">Nepal</option>
				        
				            <option value="NL">Netherlands</option>
				        
				            <option value="AN">Netherlands Antilles (NL)</option>
				        
				            <option value="NC">New Caledonia (FR)</option>
				        
				            <option value="NZ">New Zealand</option>
				        
				            <option value="NI">Nicaragua</option>
				        
				            <option value="NE">Niger</option>
				        
				            <option value="NG">Nigeria</option>
				        
				            <option value="NU">Niue</option>
				        
				            <option value="NF">Norfolk Island (AU)</option>
				        
				            <option value="MP">Northern Mariana Islands (US)</option>
				        
				            <option value="NO">Norway</option>
				        
				            <option value="OM">Oman</option>
				        
				            <option value="PK">Pakistan</option>
				        
				            <option value="PW">Palau</option>
				        
				            <option value="PA">Panama</option>
				        
				            <option value="PG">Papua New Guinea</option>
				        
				            <option value="PY">Paraguay</option>
				        
				            <option value="PE">Peru</option>
				        
				            <option value="PH">Philippines</option>
				        
				            <option value="PN">Pitcairn Islands (UK)</option>
				        
				            <option value="PL">Poland</option>
				        
				            <option value="PT">Portugal</option>
				        
				            <option value="PR">Puerto Rico (US)</option>
				        
				            <option value="QA">Qatar</option>
				        
				            <option value="RE">Reunion (FR)</option>
				        
				            <option value="RO">Romania</option>
				        
				            <option value="RU">Russia</option>
				        
				            <option value="RW">Rwanda</option>
				        
				            <option value="SH">Saint Helena (UK)</option>
				        
				            <option value="KN">Saint Kitts and Nevis</option>
				        
				            <option value="LC">Saint Lucia</option>
				        
				            <option value="PM">Saint Pierre &amp; Miquelon (FR)</option>
				        
				            <option value="VC">Saint Vincent and the Grenadines</option>
				        
				            <option value="WS">Samoa</option>
				        
				            <option value="SM">San Marino</option>
				        
				            <option value="ST">Sao Tome and Principe</option>
				        
				            <option value="SA">Saudi Arabia</option>
				        
				            <option value="SN">Senegal</option>
				        
				            <option value="CS">Serbia and Montenegro</option>
				        
				            <option value="SC">Seychelles</option>
				        
				            <option value="SL">Sierra Leone</option>
				        
				            <option value="SG">Singapore</option>
				        
				            <option value="SK">Slovakia</option>
				        
				            <option value="SI">Slovenia</option>
				        
				            <option value="SB">Solomon Islands</option>
				        
				            <option value="SO">Somalia</option>
				        
				            <option value="ZA">South Africa</option>
				        
				            <option value="GS">South Georgia &amp; South Sandwich Islands (UK)</option>
				        
				            <option value="ES">Spain</option>
				        
				            <option value="LK">Sri Lanka</option>
				        
				            <option value="SD">Sudan</option>
				        
				            <option value="SR">Suriname</option>
				        
				            <option value="SZ">Swaziland</option>
				        
				            <option value="SE">Sweden</option>
				        
				            <option value="CH">Switzerland</option>
				        
				            <option value="SY">Syria</option>
				        
				            <option value="TW">Taiwan</option>
				        
				            <option value="TJ">Tajikistan</option>
				        
				            <option value="TZ">Tanzania</option>
				        
				            <option value="TH">Thailand</option>
				        
				            <option value="TL">Timor-Leste</option>
				        
				            <option value="TG">Togo</option>
				        
				            <option value="TK">Tokelau</option>
				        
				            <option value="TO">Tonga</option>
				        
				            <option value="TT">Trinidad and Tobago</option>
				        
				            <option value="TN">Tunisia</option>
				        
				            <option value="TR">Turkey</option>
				           
				            <option value="TM">Turkmenistan</option>
				        
				            <option value="TC">Turks and Caicos Islands (UK)</option>
				        
				            <option value="TV">Tuvalu</option>
				        
				            <option value="UG">Uganda</option>
				        
				            <option value="UA">Ukraine</option>
				        
				            <option value="AE">United Arab Emirates</option>
				        
				            <option value="GB">United Kingdom</option>
				        
				            <option value="US">United States</option>
				        
				            <option value="UY">Uruguay</option>
				        
				            <option value="UZ">Uzbekistan</option>
				        
				            <option value="VU">Vanuatu</option>
				        
				            <option value="VE">Venezuela</option>
				        
				            <option value="VN">Vietnam</option>
				        
				            <option value="VI">Virgin Islands (US)</option>
				        
				            <option value="WF">Wallis and Futuna (FR)</option>
				        
				            <option value="EH">Western Sahara</option>
				        
				            <option value="YE">Yemen</option>
				        
				            <option value="ZM">Zambia</option>
				        
				            <option value="ZW">Zimbabwe</option>
				        
</select>
<p>Phone (Optional)</p>
<div class="inputpaypalvb"><input type="text" maxlength="15" class="inputpaypal" id="phone" name="phone"> </div>

<!-- Hidden valuse for credit card payments -->
<input type="hidden" value="" name="ccamount">
<input type="hidden" value="12" name="ccfrequency">
<input type="hidden" value="Year" name="ccperiod">
<input type="hidden" value="DataBagg Plan-" name="ccprofileDesc">


</div>
</form></div>
<div class="upgradeall">
<div class="upgradebutton">
	<input type="image" border="0" alt="Make payments with Credit Card - it's fast, free and secure!" name="submit" src="images/upgradenew.png"> 

</div>


<div class="cancelbutton">
	<a href="pricing.php"><img border="0" alt="cancel" name="cancel" w="" src="images/cancel.png"> </a>

</div>

</div>




<form method="POST" action="payments.php">
	
	 <input type="hidden" value="_xclick-subscriptions" name="cmd">
         <input type="hidden" value="1" name="no_note">
         <input type="hidden" value="USA" name="lc">
         <input type="hidden" value="USD" name="currency_code">
         <input type="hidden" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" name="bn">
         <input type="hidden" value="Ritesh kumar" name="first_name">
         <input type="hidden" value="chhipa" name="last_name">
         <input type="hidden" value="webdesigner.riteshchhipa@gmail.com" name="payer_email">
         <input type="hidden" value="" name="item_number">
         <input type="hidden" value="" name="plan_name">
	 <input type="hidden" value="197" name="userid">
         <input type="hidden" value="" name="price"> 
         <input type="hidden" value="" name="a3"> 
         <input type="hidden" value="12" name="p3"> 
         <input type="hidden" value="" name="t3"> 
         <input type="hidden" value="1" name="src"> 
         <input type="hidden" value="1" name="sra">            
         
		
<div class="trustee"><img alt="" src="images/trutee.jpg"></div> 
</form></div>
            <div class="tabscontent" id="content2" style="display: block;">
          <div class="visaaccountmaintab"><p> How to complete sign up with PayPal:
Click the "Continue to PayPal" button below. You will be taken to PayPal's website to complete your order and then brought back to DataBagg</p></div>
	 <div class="con-paypal">
		<input width="223" type="image" border="0" height="54" alt="Make payments with PayPal - it's fast, free and secure!" name="submit" src="images/continuepaypal.png">
		 </div>
	 
<div class="trusteepaypal"><!-- Begin Official PayPal Seal --><a target="_blank" href="https://www.sandbox.paypal.com/us/verified/pal=sachin%2esharma%2dfacilitator%40cyfuture%2ecom"><img border="0" alt="Official PayPal Seal" src="https://www.paypal.com/en_US/i/icon/verification_seal.gif"></a><!-- End Official PayPal Seal --></div>

   </div>
            
            
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

  <div style="clear:both"></div>
 <div class="callinimh"><img width="1000" border="0" height="189" usemap="#Map" alt="" src="images/calling.jpg">
  <map id="Map" name="Map">
    <area href="mailto:sales@databagg.com" coords="579,114,891,145" shape="rect">
  </map>
</div>
  </div>
    
    
    </div>

    <!--FOOTER START HERE-->
 <?php include('footer.php');?>
  <!--FOOTER END HERE--> 
    
</div>
<!--unner mid section end here-->
   

</div>

<!--inner wrapper end here-->

 <a href="http://gazpo.com/downloads/tutorials/jquery/scrolltop/#" class="scrollup" style="display: none;">Scroll</a>

   

</body>
</html>