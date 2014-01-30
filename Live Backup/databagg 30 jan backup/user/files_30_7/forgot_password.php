<?php
session_start();
include("../connect.php");
include("../function.php"); 
error_reporting(0);

if(isset($_POST['submit']))
{
$username = $_POST['username'];
 $sql="SELECT * FROM tab_members WHERE txt_username ='$username'";
$query = mysql_query($sql);

if(!$query) 
    {
    die(mysql_error());
    }
    
$suc_msg="";
$err_msg="";
if(mysql_affected_rows() != 0)
    {
$row=mysql_fetch_array($query);
$password=$row["txt_password"];
$email=$row["txt_username"];
$nm=$row["txt_first_name"];
//$subject="your password";
//$header  = "MIME-Version: 1.0\r\n";
// $header .= "Content-type: text/html; charset: utf8\r\n";
//$header .= "from:Admin@databagg.com";
//$content.="<center><div style='color:#2399BA;width: 390px;height: 190px;background-color: white;border: 1px solid red;padding:5px;text-align:center;'>";
//
//$content.="your password is ".base64_decode($password);
//$content.="<br> <br> Enjoy! <br> Team Databagg";
//$content.="</div></center>";
//
//mail($email, $subject, $content, $header);
$pass=base64_decode($password);
mail_forgot($email,$nm,$pass);

$suc_msg="An email containing the password has been sent to you.";
    }
else 
    {
   $err_msg= "No such login in the system. please try again.";
    }
}
?>




<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Databagg</title>

<link href="files/share/share.css" rel="stylesheet" type="text/css" />-->

<!--<link href="App_Theme/dashboard.css" rel="stylesheet" type="text/css" />-->

<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
</head>
<body class="body_wrap">
<div class="data_container clearfix">
<div class="header">
<div class="logo"></div>
<div class="header_right" > 
<div style="float:left; margin-top:30px; margin-right:20px;"><a href="#"><img onclick="location.href='download.php?path=databagg.zip';" src="files/share/images/install-img.png" width="162" height="32" alt="#" /></a></div>           
 <div class="login" style=" float:left; margin-top:30px; margin-right:10px; "><a target="_blank" href="http://www.databagg.com/login.php"><img width="81" height="36" border="0" alt="" src="files/share/images/login.png"></a></div>
           <div class="loginsign" style=" float:left; margin-top:30px;"><a target="_blank" href="http://www.databagg.com/registration.php"><img width="91" height="36" border="0" alt="" src="files/share/images/signup.png"></a></div> 
            </div>
            </div>
</div>


<div class="mid-whitebg" style="position: relative;">

<?php 
if($suc_msg!="")
{
 ?>
 <script>
 location.href="../login.php?msg_fp=fp";
 </script>
 <?php
 
 //header("Location:../login.php?msg_fp=fp");
    echo "<div class='info_suc' id='suc'>";
echo $suc_msg;  
    
      echo "</div>";
}

if($err_msg!="")
{
echo "<div class='info_err' id='err'>";
echo $err_msg;      
      echo "</div>";

}
?>
    <h1>Forgot Your <span>P</span>assword?</h1>
    <form name="forgot" method="post" action="<?php $_SERVER['PHP_SELF'];?>">

 <div class="info">
       Enter your email address to reset your password. 
            </div>


<input type="text" onblur="watermark('username','E-mail');" onfocus="watermark('username','E-mail');" value="E-mail" id="username" name="username">
<p></p>
<input type="submit" value="" name="submit" class="but-submit" style="cursor: pointer;">

</form>
    <div style="clear:both;"></div>

</div>





</body>
</html>












<style>

.info_err {
    border: 1px solid;
    margin: 10px 0px;
    padding:4px 10px 6px 14px;
    background-repeat: no-repeat;
    background-position: 10px center;
    color: #fff;
    background-color: #e85005;
    width: 90%;
    position: absolute;
    bottom: 0px;
   font-family: 'PT Sans', sans-serif;
}
.info_suc {

    border: 1px solid #7ab722;
    
    padding:4px 10px 6px 14px;
    background-repeat: no-repeat;
    background-position: 10px center;
    color: #fff;
    background-color: #84c22c;
   width: 90%;
    position: absolute;
    
   font-family: 'PT Sans', sans-serif;
}
</style>











<script>
function watermark(inputId,text){
  var inputBox = document.getElementById(inputId);
    if (inputBox.value.length > 0){
      if (inputBox.value == text)
        inputBox.value = '';
    }
    else
      inputBox.value = text;
}
</script>

<script>
setTimeout(function(){document.getElementById('err').style.display='none';},10000);
setTimeout(function(){document.getElementById('suc').style.display='none';},10000);
</script>