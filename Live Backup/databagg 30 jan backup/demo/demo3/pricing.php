<?php
session_start();
unset($_SESSION['planid']);
?>
 
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


<script>
function submit1()
{
	document.form1.submit();
}
function submit2()
{
	document.form2.submit();
}
function submit3()
{
	document.form3.submit();
}
function submit4()
{
	document.form4.submit();
}
function submit5()
{
	document.form5.submit();
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
 
    <div class="other-content-middle">
   <div class="avail"><img src="images/avail.png"  alt="" /></div>
   <div class="freetrial">
    
    	<div class="freetrial-left-pricing">
        
        <h2>Personal</h2>
       
       <div class="pricing-new-top"></div>
       <div class="pricing-new-middle">
       
       <div class="freetrial-right-pricing-clmun-o">
       <div align="center" class="gbspace">
          <img src="images/100gb.png" alt="" /></div>
           <form name="form1" id="form1" method="post" action="confirm_plan.php">
          
          <div class="gbspace-price">
          
  <span><input name="planid" type="radio" value="1" checked="checked"  /></span>&nbsp;$7.95/&nbsp;<span>Monthly</span>
         <br /><br />
         <span><input name="planid" type="radio" value="2" /></span>&nbsp;$79.95/<span>Yearly</span>
         
         
          </div>
                   
        
         <input type="button" value=""  class="buynowln" onclick="submit1()"/> 
         </form>
          
          </div>
       	<div class="freetrial-right-pricing-clmun-t">
        
        <div align="center" class="gbspace">
          <img src="images/250gb.png" alt="" /></div> 
                 <form name="form2" id="form2" method="post" action="confirm_plan.php"> 
        <div class="gbspace-price">
          
         <span><input name="planid" type="radio" value="3" checked="checked"  /></span>&nbsp;$16.95/<span>Monthly </span><br /><br />
         
           <span><input name="planid" type="radio" value="4" /></span>&nbsp;$169.95/<span>Yearly</span>
          </div>
       
           <input type="button" value=""  class="buynowln"  onclick="submit2()"/>
          
          </form>
     
        </div>
        
        <div class="freetrial-right-pricing-clmun-th">
        <div align="center" class="gbspace">
          <img src="images/500gb.png" alt="" /></div>
                   <form name="form3" id="form3" method="post" action="confirm_plan.php"> 
        
        <div class="gbspace-pricen">
         
              <span><input name="planid" type="radio" value="5"  checked="checked" /></span>&nbsp;$29.95/<span> Monthly</span><br /><br />
         
         <span><input name="planid" type="radio" value="6" /></span>&nbsp;$299.95/<span>Yearly</span>
          </div>
          
        
         
           <input type="button" value=""  class="buynowln" onclick="submit3()" />
           </form>
          
          
        
        </div>
       
       
       </div>
       <div class="pricing-new-bottom"></div>
       
        <div style="clear:both"></div>
        </div> 
        	
            
            <div class="freetrial-right-pricing">
               <h2>Small Business</h2>
               <div class="h2last">Enterprise</div>
               
          <div class="freetrial-right-pricing-top"></div>
          <div class="freetrial-right-pricing-middle"> 
          <div class="freetrial-right-pricing-clmun-ol">
          
          <div align="center" class="gbspace">
          <img src="images/5tb.png" alt="" /></div>
              <form name="form4" id="form4" method="post" action="confirm_plan.php">
        
        <div class="gbspace-price">
          
                <span><input name="planid" type="radio" value="7" checked="checked"  /></span>&nbsp;$69.95/<span>Monthly</span><br />
         <br />
          <span><input name="planid" type="radio" value="8" /></span>&nbsp;$699.95/<span>Yearly</span>
          </div>
        
        
        <div > <input type="button" value=""  class="buynowln" onclick="submit4()"/></div>
         
          
    </form>
         
          
    
          
          
          </div>
       	<div class="freetrial-right-pricing-clmun-t">
       	  <div align="center" class="gbspace">
          <img src="images/unlimiteso-off.png" alt="" /></div>
                 <form name="form5" id="form5" method="post" action="confirm_plan.php">  
        
        <div class="gbspace-priceth">
         
          <span><input name="planid" type="radio" value="9" checked="checked"  /></span>&nbsp;$99.95/<span>Monthly</span><br /><br />
        <span><input name="planid" type="radio" value="10" /></span>&nbsp;$999.95<span>Yearly</span>
          </div>
        
       
   <input type="button" value=""  class="buynowln"  onclick="submit5()"/>

          </form>
       
         

          
         </div>
      
       </div>
          <div class="freetrial-right-pricing-bottom"></div>
            <div style="clear:both"></div>
            </div>
    
    </div>
   <div style="clear:both"></div>
   
    <div style="clear:both"></div>
  
  </div>
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

   
              
<script type="text/javascript" src="js/jquery.min.js" charset="utf-8"></script> 


</body>
</html>