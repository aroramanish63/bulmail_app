<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', '1');
unset($_SESSION['planid']);
unset($_SESSION["planfreq"]);
include("connect.php");
$reqplan="";
if(isset($_REQUEST['plantype']))
{
$reqplan=$_REQUEST['plantype'];
}

function createPlanDesign($plantype)
	{
	$result=mysql_query("Select * from plans where plan_module='" . $plantype . "' and plan_status='1'") or die(mysql_error());
	while($row=mysql_fetch_array($result))
		{
		$temp="
       <li><div class='freetrial-right-pricing-clmun-o'>
       <div align='center' class='gbspace'>
          <img src='images/".$row['image']."' alt='' /></div>
		<form name='form1' id='form1' method='post' action='confirm_plan.php'>
		
		<div class='gbspace-price'>";
		
		$arr=explode(",","monthly_price,quarterly_price,semi_annually_price,yearly_price");
		$arrheading=explode(",","Monthly,Quarterly,Semi Annually,Yearly");	
		$arrfrequency=explode(",","1,3,6,12");
		for($i=0;$i<count($arr);$i++)
			{
			if($row[$arr[$i]]!=0)
				{
				$temp .= "<span><input name='planfreq' type='radio' value='" . $arrfrequency[$i] . "' checked /></span>&nbsp;$" . $row[$arr[$i]] . "/&nbsp;<span>" . $arrheading[$i] . "</span>";
				$temp .= "<br /><br />";
				//$temp .= "<input type='hidden' name='freq_" . $row["id"] . "' value='" . $arrfrequency[$i] . "'>";
				}
			}
		$temp .= "<input type='hidden' name='planid' value='" . $row["id"] . "'>";
		$temp .= "</div><input type='submit' value=''  class='buynowln'/></form></div></li>";
		echo $temp;
		}
	}
	$tabnum="";
	if($reqplan == "Personal" || $reqplan == "")
	{
	$tabnum=0;
	}
	if($reqplan=="Small_Business")
	{
	$tabnum=1;
	}
	if($reqplan=="Enterprise")
	{
	$tabnum=2;
	}
	if($reqplan=="Combo")
	{
	$tabnum=3;
	}

?>	 
 
<!DOCTYPE HTML>
<html>
<head>
<Title>Cloud Storage Plans & Pricing Details - DataBagg</title>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>

<meta name="description" content=" DataBagg provides cost affordable cloud data storage services for personal, business and enterprise usage. Try it now by free registration which allows you to store and share up to 5GB of data on its cloud. ">
<meta name="keywords" content="online storage plans, cloud storage plans, online storage cost, cloud storage, enterprise data storage plans, personal data storage plans, business data storage plans">

<link rel="stylesheet" href="App_Theme/reset.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="App_Theme/newstyle.css" type="text/css" media="screen"/>
<link href="fonts/font.css" rel="stylesheet">
<script type="text/javascript" src="js/html5.js"></script>
<script type="text/javascript" src="js/jquery.min.js" charset="utf-8"></script> 
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



<link rel="stylesheet" href="App_Theme/pricingtab.css" type="text/css" media="screen"/>
<script type="text/javascript" src="js/tabjquery.js"></script>
<script type="text/javascript">

$(document).ready(function() {

	$(".tab_content").hide();
	$(".tab_content:eq(<?php echo $tabnum; ?>)").show(); 
	$("ul.tabs li").click(function() {
		$("ul.tabs li").removeClass("active");
		$(this).addClass("active");
		$(".tab_content").hide();
		var activeTab = $(this).attr("rel"); 
		$("#"+activeTab).fadeIn(); 
	});
});

</script> 

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


<div id="innerwrapper_container" >
	
    <!--Header start here-->
  <div class="innerheader_fixed">
   <?php include('inner-header.php')?>
  
  </div>
    <!--header end here-->
<!--inner mid section start here-->
<div class="innercontent_contatiner">
	<div class="mid_container">
    <div class="avail"><img src="images/avail.png"  alt="" /></div>
    
    
    <div id="pricingcontainer">

  <ul class="tabs"> 
       <li rel="tab1" <?php if($reqplan=="Personal" ||$reqplan=="" ){ ?>class="active"<?php }?>> Personal</li>
        <li rel="tab2" <?php if($reqplan=="Small_Business"  ){ ?>class="active"<?php }?>> Small Business</li>
        <li rel="tab3" <?php if($reqplan=="Enterprise"  ){ ?>class="active"<?php }?>> Enterprise</li>
		 <li rel="tab4" <?php if($reqplan=="Combo"  ){ ?>class="active"<?php }?>> Combo</li>
       
    </ul>

<div class="tab_container"> 



     <div id="tab1" class="tab_content"> 
 
      
      <ul class="pricintab">

	  
	  <?php createPlanDesign("P");?>
	
	  </ul>
       
       
       
       
       
  

     </div><!-- #tab1 -->
	 
	 
	 
     <div id="tab2" class="tab_content"> 
       <ul class="pricintab">

	   <?php createPlanDesign("S");?>

	  </ul>

      

     </div><!-- #tab2 -->
     <div id="tab3" class="tab_content"> 
 
<ul class="pricintab">

	  
	  <?php createPlanDesign("E");?>

	  </ul>
  
  
          
         </ul>
     </div><!-- #tab3 -->
	 
	 <div id="tab4" class="tab_content"> 
 
<ul class="pricintab">

	  
	  <?php createPlanDesign("SP");?>

	  </ul>
  
  
          
         </ul>
     </div>
  
     
 </div> <!-- .tab_container --> 
 <div class="freetrialbootom"><img src="images/trutee.jpg" width="223" height="76" alt="#"></div>
</div>
    
    

    <!--FOOTER START HERE-->
 <?php include('footer.php');?>
  <!--FOOTER END HERE--> 
    
</div>
<!--unner mid section end here-->
   

</div>

<!--inner wrapper end here-->

 <a href="http://gazpo.com/downloads/tutorials/jquery/scrolltop/#" class="scrollup" style="display: none;">Scroll</a>

   
              
<!-- Google Code for pricing Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 980914352;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "tg8SCICCzQcQsKHe0wM";
var google_conversion_value = 10;
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/980914352/?value=10&amp;label=tg8SCICCzQcQsKHe0wM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>


</body>
</html>