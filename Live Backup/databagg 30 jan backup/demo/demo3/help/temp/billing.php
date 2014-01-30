<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Databagg</title>

<link href="../App_Theme/mainstyle.css" rel="stylesheet" type="text/css" />
<link href="../App_Theme/help.css" rel="stylesheet" type="text/css" />

<link href='http://fonts.googleapis.com/css?family=PT+Sans:400' rel='stylesheet' type='text/css'>

<!-- Accordation menu start -->


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
	

<!-- Accordation menu start -->


</head>
<body>
<div class="mainpageheader">

  <?php include('../topmenu.html');?>
  

  <div class="other-content">
  <div class="other-content-top"></div>
    <div class="other-content-middle"><br />
    
<div class="avail-text-help"><ul>
<li>Help Center</li>
<li>&raquo;</li>
<li class="active"><a href="help-billing.html">Billing</a></li>

</ul>
</div>
    
 
    <div class="feature-content">
    
       <div class="feature-help-left">
       
       <div class="container-accordsation">

	
    <h2 class="acc_trigger"><a href="#">How much does DataBagg cost?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
<p>DataBagg offers different plans depending on how much space is required.</p>

<p>We offer 2 year, 1 year, semi-annual and monthly pricing plans. The longer you sign up for though the cheaper it works out in the long run.</p>

<p class="redtext">Not able to see the price. I Will update this once information will be available.</p>

<p>Please contact <a href="mailto:Support@DataBagg.com">Support@DataBagg.com</a> for a full breakdown of prices and any current discounts available. </p>

		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">Why is DataBagg better than other backup/storage companies?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>DataBagg provides a unique combination of online backup, file syncing, file sharing and online storage. Not only this but DataBagg does all of this for the price of a standard backup only service. </p>		
			
		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">What payment methods do you accept?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>We accept payment through Paypal and Avangate. </p> 
<p>If you get a decline message it would be worth contacting your card provider to query the reason why the payment did not go through</p>.

<p>Our support team can be contacted via email <a href="mailto:Support@DataBagg.com">Support@DataBagg.com</a> 
</p>
		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">Can I have an invoice for my DataBagg Subscription?<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>You certainly can. When you first signed up for your DataBagg Subscription an invoice would have been emailed to the email address you signed up with, please be sure to check your junk folders.</p>
			

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

<p>Simply email <a href="mailto:Support@DataBagg.com">Support@DataBagg.com</a>
</p>
		</div>
	</div>
	
	<h2 class="acc_trigger"><a href="#">How do I transfer my license to a new computer?<br />
    <span></span></a>
    
    </h2>
	<div class="acc_container">
		<div class="block">

		
			
			<p class="redtext">Waiting</p>
		</div>
	</div>
	
	
	
	<h2 class="acc_trigger"><a href="#">How do I update my credit card?<br />
    <span></span></a>
    
    </h2>
	<div class="acc_container">
		<div class="block">

		
			
			<p class="redtext">To update your payment method details please login to http://DataBagg.com and click My Account from the top tabs, then from the sub tabs click Billing and you will see a button titled Update payment information. Clicking the button will bring up a new window where credit card details and payment address details can be added. 

</p>

<p>The payment method should then become the default payment method on your account. </p>

<p>We accept payment through Paypal and Avangate.</p>

<p>If you have any queries relating to billing please email Support@DataBagg.com. 
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

<p>If you require technical assistance please email <a href="mailto:Support@DataBagg.com">Support@DataBagg.com</a></p> 


		</div>
	</div>
    
    
    
    
    <h2 class="acc_trigger"><a href="#">How do I cancel my account?<br />
    <span></span></a>
    
    </h2>
	<div class="acc_container">
		<div class="block">

		
			
			<p>
            To cancel your account please email our  team at support@DataBagg.com outlining the reasons for your cancellation and they will do their best to help you quickly and efficiently. 

</p>
		</div>
	</div>
    
    
    
    
    
    
	
</div></div>
        <?php include('../rightpannel.html');?>
    
    
      <div style="clear:both"></div>
    </div>
    
    
    
        
    
    
  <div style="clear:both"></div>
  
  </div>
  
  
	
    <div style="clear:both"></div>
</div>


 <?php include('../calling.html');?>
   <?php include('../footer.html');?>
   <?php include('../bottom.html');?>


<div style="clear:both;"></div>
</div>
</body>
</html>
