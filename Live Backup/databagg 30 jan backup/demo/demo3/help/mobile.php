<?php
$pagename="mobile.php";
 ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="google-site-verification" content="zEL3MwzMYCf3OIz62XAEtXN1jPs8V6QLqibRye5fGEE" />
<title>Databagg</title>

<link href="../App_Theme/reset.css" rel="stylesheet" type="text/css" />
<link href="../App_Theme/newstyle.css" rel="stylesheet" type="text/css" />
<link href="../App_Theme/help.css" rel="stylesheet" type="text/css" />

<link href='https://fonts.googleapis.com/css?family=PT+Sans:400' rel='stylesheet' type='text/css'>

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
	

<!-- Accordation menu start -->


</head>
<body>
<div class="mainpageheader">
<div class="innerheader_fixed">
  <?php include('../inner-header.php');?>
  
</div>
  
  <div id="innerwrapper_container" style="padding-top:53px;">
  
<div class="helpcontent_container" >
<div class="other-content">

    <div class="other-content-middle"><br />
    
<div class="avail-text-help"><ul>
<li><a href="index.php">Help</a></li>
<li>&raquo;</li>
<li class="active"><a href="mobile.php">Mobile</a></li>

</ul>
</div>
   <div class="fl browsetext">Browse by Categories</div> 
 
    <div class="feature-content">
    
       <div class="feature-help-left">
       
       <div class="container-accordsation">

	
    <h2 class="acc_trigger"><a href="#">
Can I access my account on a mobile device?
<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
<p>Coming Soon!!!!!

</p>
</div>

	</div>
	<h2 class="acc_trigger"><a href="#">Is there an iPhone or iPad app?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>Coming Soon!!!!!</p>

		<br /><br />
	</div>

	</div>
	<h2 class="acc_trigger"><a href="#">Is there an Android App?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
<p>Coming Soon!!!!!</p>


		</div>

	</div>
	<h2 class="acc_trigger"><a href="#">Can I download a DataBagg mobile application?<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>Coming Soon!!!!!</p>
            
            </div>

	</div>
	
	
	
    
    <h2 class="acc_trigger"><a href="#">How do I upload files from my phone or tablet?<br />
    <span></span>
    
    
    </a></h2>
	
    
    <div class="acc_container">
		<div class="block">
		
			<p>Coming Soon!!!!! </p>



</div>

	</div>
    
    
    
    <h2 class="acc_trigger"><a href="#">How do I use Camera Upload?<br />
    <span></span>
    
    
    </a></h2>
    
    
    <div class="acc_container">
		<div class="block">
		
			<p>Coming Soon!!!!!</p>




		</div>

	</div>
    
    <h2 class="acc_trigger"><a href="#">How much can I store on my phone or tablet?<br />
    <span></span>
    
    
    </a></h2>
    
    <div class="acc_container">
		<div class="block">
		
			<p>Coming Soon!!!!!</p>




		</div>

	</div>
    
    
    
    
     <h2 class="acc_trigger"><a href="#">Can I register for a Databagg account on my mobile device?<br />
    <span></span>
    
    
    </a></h2>
    
    <div class="acc_container">
		<div class="block">
		
			<p>Coming Soon!!!!!</p>




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
  </div></div>
   <?php include('../footer.php');?>
 



<div style="clear:both;"></div>
</div>
</body>
</html>
