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
<li><?php echo "Hello "; ?></li>
<li>&raquo;</li>
<li class="active"><a href="uninstall&vancellation.html">Uninstall &amp; Cancellation</a></li>

</ul>
</div>
    
 
    <div class="feature-content">
    
       <div class="feature-help-left">
       
       <div class="container-accordsation">

	
    <h2 class="acc_trigger"><a href="#">
How do I cancel my account?
<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
<p>To cancel your account please email our cancellation team at <a href="mailto:Support@DataBagg.com">Support@DataBagg.com</a> outlining the reasons for your cancellation and they will do their best to help you quickly and efficiently.</p>

</div>

	</div>
	

	
	<h2 class="acc_trigger"><a href="#">How do I uninstall DataBagg?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
<p>To uninstall DataBagg please do the following:</p>

<p><strong>Windows XP </strong><br />
From the Start menu, select Control Panel > Add/Remove Programs >DataBagg. Click Uninstall. DataBagg will be completely removed from your system.</p> 

<p><strong>Windows Vista and Windows 7 </strong><br />
From the Start menu, select Control Panel > Programs>DataBagg. Click Uninstall/Change. DataBagg will be completely removed from your system.</p> 

<img src="../images/help/unin.png" width="605" height="239" alt="" /></div>

	</div>
	<h2 class="acc_trigger"><a href="#">I have unrecognized or unauthorized charges relating to DataBagg, who can I speak to?<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>If you have received a charge from DataBagg that is unrecognized, unauthorized or completely unfamiliar to you, rest assured, we are more than happy to refund it back to you and investigate how it could have occurred.

You can email us <a href="mailto:Support@DataBagg.com">Support@DataBagg.com</a> or, if you would prefer, can call us on:1-888-885-4570
</p>
       
            
            </div>

	</div>
	
	
	
    
    <h2 class="acc_trigger"><a href="#">I have been overcharged, who can I speak to?<br />
    <span></span>
    
    
    </a></h2>
	
    
    <div class="acc_container">
		<div class="block">
		
			<p>We are trying to help our customers by offering a cheaper price for a longer commitment. We are happy to refund any users who feel they have been overcharged.
The telephone support team is able to provide help with billing, unrecognized charges and renewal enquiries on :- 1-888-885-4570
Or please contact <a href="mailto:Support@DataBagg.com">Support@DataBagg.com</a> 
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
