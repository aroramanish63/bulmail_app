<?php
session_start();
include("../../../connect.php");
include("../../../function.php"); 
error_reporting(0);





if($_REQUEST['code'])
{   
    $share_link="";
    $path="";
    
    
      $select_exist_share="select * from category_data where share_code='".$_REQUEST['code']."'";
    $result_exist_share=mysql_query($select_exist_share) or die(mysql_error());
    $fetch_share_link=mysql_fetch_array($result_exist_share);
    
    
}

 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Databagg</title>

<link href="share.css" rel="stylesheet" type="text/css" />-->
<style type="text/css">
a, a img { outline: none; border:none;}
</style>
<!--<link href="App_Theme/dashboard.css" rel="stylesheet" type="text/css" />-->

<!--slider css start here-->
	<link type="text/css" href="base.css" rel="stylesheet" />
    <link type="text/css" href="left.css" rel="stylesheet" />
		<script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.jcarousel.min.js"></script>
		<script type="text/javascript" src="js/jquery.pikachoose.min.js"></script>
		<script language="javascript">
			$(document).ready(function (){
					$("#pikame").PikaChoose({carousel:true, carouselVertical:true});
				});
		</script>

<!--slider css end here--> 

<link href="fonts/font.css" rel="stylesheet" type="text/css" />

<!--<link href="App_Theme/dashboard.css" rel="stylesheet" type="text/css" />-->

<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
</head>
<body class="body_wrap" style="font-family: 'PT Sans', sans-serif;">
<div class="data_container clearfix">
<div class="header">
<div class="logo"></div>
<div class="header_right" > 
<div style="float:left; margin-top:30px; margin-right:20px;"><a href="#"><img onclick="location.href='../../DataBaGG.exe';" src="images/install-img.png" width="162" height="32" alt="#" /></a></div>           
 <div class="login" style=" float:left; margin-top:30px; margin-right:10px; "><a href="http://www.databagg.com/login.php"><img width="81" height="36" border="0" alt="" src="images/login.png"></a></div>
           <div class="loginsign" style=" float:left; margin-top:30px;"><a href="http://www.databagg.com/registration.php"><img width="91" height="36" border="0" alt="" src="images/signup.png"></a></div> 
            </div>
            </div>
</div>

<!-- slider start here-->
	<?php
if(mysql_num_rows($result_exist_share)>0)
{
?>
<div class="height"></div>
<div class="slider_container" style="height: 335px;text-align: center;">
<h2 style="font-family: 'geoslab703_md_btbold';color:#049cd4;margin: 0;padding: 0px;">
 Image Gallary</h2>


<div class="pikachoose">
	<ul id="pikame" class="jcarousel-skin-pika">
	<?php
     $select_list_data="select * from users_data where int_fid in(".$fetch_share_link['txt_fid'].") and int_del_status='0'";
    
    
    $result_list_data=mysql_query($select_list_data) or die(mysql_error());
     while($fetch_list_data=mysql_fetch_array($result_list_data))
    { 
    
        $path="../../../";
        $path.=$fetch_list_data['txt_real_path'];
        $nm=$fetch_list_data['txt_file_name'];
    ?>
    
		<li><img src="<?php echo $path; ?>"/></li>
	

    <?php
    }
    ?>

	</ul>
</div>


</div>
<br />
<center>

<img src="images/bottomlogo.png" />
    </center>
    
    
    
 
<?php
}


else
{
    echo "<div class='info_suc' id='suc'>";
echo "There is no item for download! Thank you. ";  
    
      echo "</div>";
}
?>



<div class="footer">
<p>&copy;<?php echo date('Y',time()); ?> <span>Databagg</span></p>
<ul id="footer" class="fleft">
    <li><a href="https://www.databagg.com/term-of-services.html" class="active">Terms</a></li>
    <li><a href="https://www.databagg.com/privacy-policy.html">Privacy Policy</a></li>
    
    <li ><a href="https://www.databagg.com/help/index.php" class="right_b">Help </a></li>
    </ul> </div>
    <div class="call_us"><img src="images/footer-right.png" alt="call_us" />

</div>


</body>
</html>



<style>
.info_suc {
    border: 1px solid;
    margin: 10px 0px;
    padding:4px 10px 6px 14px;
    background-repeat: no-repeat;
    background-position: 10px center;
    color: #fff;
    background-color: #00A7E2;
   
   
}
</style>


