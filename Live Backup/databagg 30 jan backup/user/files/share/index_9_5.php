<?php
session_start();
include("../../../connect.php");
include("../../../function.php"); 
error_reporting(0);





if($_REQUEST['code'])
{   
    $share_link="";
    $path="";
    
    
    $select_exist_share="select * from tab_share where txt_share_link='".$_REQUEST['code']."' and int_is_shared=1";
    $result_exist_share=mysql_query($select_exist_share) or die(mysql_error());
    $fetch_share_link=mysql_fetch_array($result_exist_share);
    
    
}

 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Databagg</title>

<link href="share.css" rel="stylesheet" type="text/css" />

<!--<link href="App_Theme/dashboard.css" rel="stylesheet" type="text/css" />-->

<link href='http://fonts.googleapis.com/css?family=PT+Sans:400' rel='stylesheet' type='text/css'>
</head>
<style type="text/css">
a, a img { outline: none; border:none;}
</style>
<body class="body_wrap">
<div class="data_container clearfix">
<div class="header">
<div class="logo"></div>
<div class="header_right" > 
<div style="float:left; margin-top:30px; margin-right:20px;"><a href="#"><img onclick="location.href='../../download.php?path=databagg.zip';" src="images/install-img.png" width="162" height="32" alt="#" /></a></div>           
 <?php
 if(!isset($_SESSION['user_id']))
 {
 ?>
 <div class="login" style=" float:left; margin-top:30px; margin-right:10px; "><a target="_blank" href="http://www.databagg.com/login.php"><img width="81" height="36" border="0" alt="" src="images/login.png"></a></div>
           <div class="loginsign" style=" float:left; margin-top:30px;"><a target="_blank" href="http://www.databagg.com/registration.php"><img width="91" height="36" border="0" alt="" src="images/signup.png"></a></div> 
 <?php
 }
 ?>
            </div>
            </div>
</div>

<div class="wrapper">
	<?php
if(mysql_num_rows($result_exist_share)>0)
{
?>
    <div class="share-icon"><img src="../../<?php echo get_file_icon1($fetch_share_link['int_is_folder'],$fetch_share_link['txt_file_name']); ?>" width="84" height="96" alt="#" /></div>
    <div class="share-right-content">
    <h1><?php echo $fetch_share_link['txt_file_name']; ?></h1>
    	 <?php if($fetch_share_link['int_is_folder']==0) { ?>
     <a href="../../download.php?path=<?php echo $fetch_share_link['txt_real_path']; ?>" class="but-download"> <img src="images/btn-download.png" width="115" height="31" alt="#" /> </a>
     <?php }else { 
       if($fetch_share_link['int_is_sync']==0){ ?>
     <a href="../../test_zip_share.php?path=<?php echo $fetch_share_link['txt_real_path']; ?>" class="but-download"><img src="images/btn-download.png" width="115" height="31" alt="#" />  </a>
     <?php 
     
     } 
     
     else
     {
        ?>
       <a href="../../test_zip_sync.php?path=<?php echo $fetch_share_link['txt_real_path']; ?>" class="but-download"><img src="images/btn-download.png" width="115" height="31" alt="#" />  </a> 
        
        <?php
        
     }?>
        
       
    
   
<?php
}
}

else
{
    echo "<div class='info_suc' id='suc'>";
echo "There is no item for download! Thank you. ";  
    
      echo "</div>";
}
?>
 </div>
    <div style="clear:both;"></div>
</div>


<div class="footer">
<p>&copy;<?php echo date('Y',time()); ?> <span>Databagg</span></p>
<ul id="footer" class="fleft">
    <li><a href="#" class="active">Terms</a></li>
    <li><a href="#">Privacy Policy</a></li>
    <li><a href="#">Partner with us</a></li>
    <li><a href="#">Contact Databagg</a></li>
    <li ><a href="#" class="right_b">Help </a></li>
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


