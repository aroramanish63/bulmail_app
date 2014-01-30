<?php
$pagename="demo.php";
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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


<script type="text/javascript" src="../Script/accordation/jquery-latest.js"></script>
<script type="text/javascript" src="../js/jquery.min.js"></script>
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
  <div id="innerwrapper_container">
  <div class="helpcontent_container" style="padding-top:130px;">

  <div class="other-content">
  
    <div class="other-content-middle"><br />
    
<div class="avail-text-help"><ul>
<li><a href="index.php">Help</a></li>
<li>&raquo;</li>
<li class="active"><a href="demo.php">Demo</a></li>

</ul>
</div>
 
 
    <div class="feature-content">
    
    
   	 <div class="demo-text">
     
     <img src="../images/help/demo-text.png" alt="" border="0" usemap="#Map2" />
     <map name="Map2" id="Map2">
       <area shape="rect" coords="252,86,421,101" onclick="location.href='user/download.php?path=databagg.zip';"/>
     </map>
     </div>
      <div class="demotextmain">  
        
       <div class="demo-left"><img src="../images/help/demo-one.png" alt="" /></div>
         <div class="demo-right"><img src="../images/help/demo-two.png"  alt="" /></div>
          <div class="demo-right"><img src="../images/help/demo-three.png" alt="" /></div>
        
        	
 <div style="clear:both"></div>
        </div>
       
  
  
	
 <div style="clear:both"></div>
</div>
</div>
  <?php include('../calling.html');?>
  </div>
  </div>
  </div>
   <?php include('../footer.php');?>
  


<div style="clear:both;"></div>
</div>
</body>
</html>
