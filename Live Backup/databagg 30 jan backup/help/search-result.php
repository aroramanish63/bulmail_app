<?php 
include("../connect.php");
$shint=$_POST['shint'];
$sql="select * from tab_faq where question like '%$shint%'";
$query=mysql_query($sql);

$count=mysql_num_rows($query);

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
<li class="active"><a href="search-result.php">Search Result</a></li>

</ul>
</div>
  <div class="fl browsetext">Browse by Categories</div>  
 
    <div class="feature-content">
	
	<?php if($count>=1 && $shint!=""){ ?>
    
       <div class="feature-help-left">
       
       <div class="container-accordsation">
	   
	   <?php 
	   
	   while($result=mysql_fetch_array($query))
	   {
	   ?>

	
    <h2 class="acc_trigger"><a href="#"><?php echo $result['question']; ?><br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
<p><?php echo $result['answer']; ?></p>

<?php if($result['ansimage']!="")
{
?>
<img src="../images/help/faq-images/<?php echo $result['ansimage']; ?>" />
<?php
}

?>
		</div>

	</div>
	

	<?php 
	}
	?>


	


	
	
    
	
</div></div>

<?php 
}
else
{
 ?>
<div class="feature-help-left">
       
       <div class="container-accordsation">No Result Match</div> </div>
<?php }?>


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
 

</div>
<div style="clear:both;"></div>
</div>
</body>
</html>
