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
<li class="active"><a href="security&privacy.html">Security &amp; Privacy</a></li>

</ul>
</div>
    
 
    <div class="feature-content">
    
       <div class="feature-help-left">
       
       <div class="container-accordsation">

	
    <h2 class="acc_trigger"><a href="#">
How secure is my data?
<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
<p>DataBagg takes the security and privacy of your data extremely seriously. DataBagg stores all our own Data Center.Your data is also replicated within each data center</p>

<p>Currently, data is stored in Jaipur and Noida data centers only. </p>



</p>
</div>

	</div>
	<h2 class="acc_trigger"><a href="#">I have forgotten my password, how do I reset it?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>If you have forgotten your password please visit our forgotten password page here: http://www.databagg.com/user/forgot_password</p>

<p>Enter your email address at the forgot password page on the DataBagg website. An email will be sent to your registered email address with your password.</p>

<p>If you are not able to locate your reset password email please check your SPAM and Junk folders before contacting us

</p>

		<br /><br />
        
        <img src="../images/help/forgetpassword.png" width="619" height="309" alt="" /></div>

	</div>
	<h2 class="acc_trigger"><a href="#">What happens if my referral signs up with a different email address?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
<p>DataBagg will track that user anyway and will ensure that you are credited accordingly. If a friend receives multiple invitations from different users, the most recently clicked invitation will get the credit. </p>


		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">Where can I find the status of the invitations I've sent out for referrals?<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>Keep track of all the friends you have invited and their referral status from the view the status of your referrals tab of your Referral page.</p>
        <ul>    
<li>Sign in to the DataBagg website (if you haven't already)</li>
<li>Click on your Referral page</li>
<li>Click on view the status of your referrals button</li>
</ul>
</p>
            
            </div>

	</div>
	
	
	
    
    <h2 class="acc_trigger"><a href="#">What do each of the referral statuses mean?<br />
    <span></span>
    
    
    </a></h2>
	
    
    <div class="acc_container">
		<div class="block">
		
			<p>Once you invite your friends to join DataBagg, you can check the status of your referrals from the view the status of your referrals tab of your Referral page. There are four different referral statuses:</p>

<ul>
<li>Invited means that your friend has been invited to use DataBagg but hasn't registered yet.</li>
<li>Joined means that they have registered but not confirmed the email address.</li>
<li> Completed means that your friend has successfully sing in and confirmed the email address.</li>

</ul>

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
