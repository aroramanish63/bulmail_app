<?php
$pagename="billing.php";
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="google-site-verification" content="zEL3MwzMYCf3OIz62XAEtXN1jPs8V6QLqibRye5fGEE" />
<title>DataBaGG</title>

<link href="../App_Theme/reset.css" rel="stylesheet" type="text/css" />
<link href="../App_Theme/newstyle.css" rel="stylesheet" type="text/css" />
<link href="../App_Theme/help.css" rel="stylesheet" type="text/css" />

<link href='https://fonts.googleapis.com/css?family=PT+Sans:400' rel='stylesheet' type='text/css'>
<!--[if lt IE 7]>

        <div style=' clear: both; text-align:center; position: relative;'>
            <a href="https://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="https://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0"  alt="" /></a>
        </div>
	<![endif]-->
<!--[if lt IE 9]>
   		<script type="text/javascript" src="../js/html5.js"></script>
        <link rel="stylesheet" href="../App_Theme/ie.css" type="text/css" media="screen">
	<![endif]-->

<!-- Accordation menu start -->

<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript" src="../Script/accordation/jquery-latest.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
//Set default open/close settings
$('.acc_container').hide(); //Hide/close all containers
$('.acc_trigger:first').addClass('active').next().show(); //Add "active" class to first trigger, then show/open the immediate next container

//On Click
$('.acc_trigger').click(function(){
	if( $(this).next().is(':hidden') ) { //If immediate next container is closed...
		$('.acc_trigger').removeClass('active').next().slideUp(); //Remove all .acc_trigger classes and slide up the immediate next container
		$(this).toggleClass('active').next().slideDown(); //Add .acc_trigger class to clicked trigger and slide down the immediate next container
	}
	return false; //Prevent the browser jump to the link anchor
});

});
</script>
	
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-40639007-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<!-- Accordation menu start -->

<script type="text/javascript">
  var __lc = {};
  __lc.license = 1373462;
  __lc.skill = 3;

  (function() {
    var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
    lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
  })();
</script>
</head>
<body>
<div class="mainpageheader">

  <div class="innerheader_fixed">
  <?php include('../inner-header.php');?>
  
</div>
<div id="innerwrapper_container">
  
<div class="helpcontent_container">
  <div class="other-content">
  <div class="other-content-top"></div>
    <div class="other-content-middle"><br />
    
<div class="avail-text-help"><ul>
<li><a href="index.php">Help</a></li>
<li>&raquo;</li>
<li class="active"><a href="help-billing.php">Billing</a></li>

</ul>
</div>
 <div class="fl browsetext">Browse by Categories</div>
    
 
    <div class="feature-content">
    
       <div class="feature-help-left">
       
       <div class="container-accordsation">

	
    <h2 class="acc_trigger"><a href="#">How much does DataBaGG cost?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
<p>DataBaGG offers different plans depending on how much space is required.</p>

<p>We offer yearly and monthly pricing plans. The longer you sign up for though the cheaper it works out in the long run.</p>

<p>Personal 100GB plan - $7.95 per month and $79.95 per year<br />
                250GB plan - $16.95 per month and $169.95 per year<br />
                500GB plan - $29.95 per month and $299.95 per year</p>

<p>Small Business 5TB(Storage, 5-User) $69.95 per month and $699.95 per year</p>

<p>Enterprise Unlimited(Storage, 10-User) $99.95 per month and $999.95 per year</p>
                

<p>Please contact <a href="mailto:billing@databagg.com">billing@databagg.com</a> for more information.</p>


		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">Why is DataBaGG better than other backup/storage companies?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>DataBaGG provides a unique combination of online backup, file syncing, file sharing and online storage. Not only this but DataBaGG does all of this for the price of a standard backup only service. </p>		
			
		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">What payment methods do you accept?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>We accept payment through Paypal.</p> 
<p>If you get a decline message it would be worth contacting your card provider to query the reason why the payment did not go through</p>.

<p>Our support team can be contacted via email <a href="mailto:billing@databagg.com">billing@databagg.com</a>
</p>
		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">Can I have an invoice for my DataBaGG Subscription?<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>You certainly can. When you first signed up for your DataBaGG Subscription an invoice would have been emailed to the email address you signed up with, please be sure to check your junk folders.</p>
			

		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">I chose the wrong plan<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>Please don't worry if you have accidentally purchased the wrong plan. Just contact our support team and we will immediately upgrade or downgrade you to the correct plan and if necessary refund the difference back to you.</p>

<p>We try to make this as clear as possible and are trying to help our customers by offering a cheaper price for a longer commitment.

<p>Or call us on:- 1-888-885-4570</p>

 </p>
		</div>

	</div>
	
    
    <h2 class="acc_trigger"><a href="#">I only wanted to pay monthly<br />
<span></span> </a></h2>

	<div class="acc_container">
		<div class="block">
	
			
			<p>We understand that sometimes users accidentally select the wrong payment plan.</p>

<p>If you wish to convert your account to monthly billing, this is not a problem. We will happily refund you the difference and move you to a monthly plan.</p>

<p>Simply email <a href="mailto:billing@databagg.com">billing@databagg.com</a>
</p>
		</div>
	</div>
	
	
	
	
	
	<h2 class="acc_trigger"><a href="#">How do I update my credit card?<br />
    <span></span></a>
    
    </h2>
	<div class="acc_container">
		<div class="block">

		
			
			<p class="redtext">
			<p>Coming Soon</p>

<p>The payment method should then become the default payment method on your account. </p>

<p>We accept payment through Paypal</p>

<p>If you have any queries relating to billing please email <a href="mailto:billing@databagg.com">billing@databagg.com</a>
</p>


		</div>
	</div>
    
    <h2 class="acc_trigger"><a href="#">Can I call you?<br />
    <span></span></a>
    
    </h2>
	<div class="acc_container">
		<div class="block">

		
			
<p>No technical support can be given over the phone. The telephone support team is able to provide help with billing, unrecognized charges and renewal enquiries. </p>

<p>Call us on:-1-888-885-4570.</p>

<p>If you require technical assistance please email <a href="mailto:billing@databagg.com">billing@databagg.com</a></p> 


		</div>
	</div>
    
    
    
    
    <h2 class="acc_trigger"><a href="#">How do I cancel my account?<br />
    <span></span></a>
    
    </h2>
	<div class="acc_container">
		<div class="block">

		
			
			<p>
            To cancel your account please email our  team at <a href="mailto:billing@databagg.com">billing@databagg.com</a> outlining the reasons for your cancellation and they will do their best to help you quickly and efficiently. 

</p>
		</div>
	</div>
    
    
    
    
    
    
	
</div></div>
        <?php include('../rightpannel.php');?>
    
    
      <div style="clear:both"></div>
    </div>
    
    
    
        
    
    
  <div style="clear:both"></div>
  
  </div>
  
  
	
    <div style="clear:both"></div>
</div>


 <?php include('../calling.html');?>
 </div>
 </div>
   <?php include('../footer.php');?>
   


<div style="clear:both;"></div>
</div>
</body>
</html>
