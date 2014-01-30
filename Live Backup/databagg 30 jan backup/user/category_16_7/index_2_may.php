<?php
session_start();
include("../../connect.php");
include("../../function.php"); 
error_reporting(0);
if($_REQUEST['bagid'])
$_SESSION['user_id']=base64_decode($_REQUEST['bagid']);
if(!$_SESSION['user_id'])
header("Location:../../login.php");



$list_contact="select * from users_contact where int_uid='".$_SESSION['user_id']."'";
$list_result=mysql_query($list_contact) or die(mysql_error());

if($_REQUEST['code'])
{   
    $share_link=random_id();
    $o_code=base64_decode($_REQUEST['code']);
     $select_exist_share="select * from category_data where int_cat_id='".$o_code."' and int_uid='".$_SESSION['user_id']."'";
   $result_exist_share=mysql_query($select_exist_share) or die(mysql_error());
    $fetch_share_link=mysql_fetch_array($result_exist_share);
    if(mysql_num_rows($result_exist_share)==1)
    {
    if($fetch_share_link['share_code']=="")
    {
    $update_cat_data="update category_data set share_code='".$share_link."' where int_cat_id='".$o_code."'";    
    mysql_query($update_cat_data);
    $_REQUEST['code']=$share_link;    
    }
    else
    {
     $_REQUEST['code']=$fetch_share_link['share_code'];
    }
    $flag="true";
    }
    else
    $flag="false";
    
    
    
}


if( $_REQUEST['manual-email'] || $_REQUEST['demo-input-facebook-theme'] )
{
    //print_r($_REQUEST);
    
    $getuseremail="select txt_first_name,txt_last_name,txt_email from tab_members where int_id='".$_SESSION['user_id']."'";
    $result_email=mysql_query($getuseremail) or die(mysql_error());
    $fetch_email=mysql_fetch_array($result_email);
    if($_REQUEST['manual-email'] && $_REQUEST['demo-input-facebook-theme'])
    {
    $_REQUEST['demo-input-facebook-theme'].=",";
    $_REQUEST['demo-input-facebook-theme'].=$_REQUEST['manual-email'];
    $arr_email=explode(",",$_REQUEST['demo-input-facebook-theme']);
    }
    else if($_REQUEST['manual-email'] && $_REQUEST['demo-input-facebook-theme']=="")
    {
    
    $arr_email=explode(",",$_REQUEST['manual-email']);
    }
    else if($_REQUEST['manual-email'])
    {
      $arr_email=explode(",",$_REQUEST['manual-email']);
    }
    else
    {
      $arr_email=explode(",",$_REQUEST['demo-input-facebook-theme']);    
    }
   // print_r($arr_email);
    
   $mid=$fetch_email['txt_email'];
   $fnm=$fetch_email['txt_first_name'];
   $lnm=$fetch_email['txt_last_name'];
   $header  = "MIME-Version: 1.0\r\n";
 $header .= "Content-type: text/html; charset: utf8\r\n";
    $subject="$fnm  $lnm ($mid) shared you a file on databagg";
    $header.="from:$fnm  $lnm ($mid) <sharing@databagg.com>";
    $content="hi <br> $fnm  $lnm  ($mid) share a file with you <br>";
    $cd=$_REQUEST['code1'];
    $tp=$_REQUEST['type_c'];
     $content.="<br> 
     <a style='text-decoration:none;' href='http://www.databagg.com/user/files/share/?code=$cd'>
     <span style='background-color:#15A0C8;border-radius:10px 10px 10px 10px;padding:5px 10px 5px 10px;color:white;font-size:17px;font-weight:bold;white-space:nowrap'>
     View</span> </a> <br>";
    $content.="<br> <br> Enjoy! <br> Team Databagg";
    foreach($arr_email as $mail_id)
    {
       
       //echo $mail_id;
        if($tp=="Gallary")
        mail_share_category_photo($mail_id,$cd,$fnm,$lnm,$mid);
        else
        mail_share_category($mail_id,$cd,$fnm,$lnm,$mid);
        //mail($mail_id, $subject, $content, $header);
        
    }
    $suc_msg="Mail send successfully";
}



    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Databagg</title>
<meta http-equiv="content-type" content="text/html; charset=windows-1252">
<link href="css/music1.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/tabcontent1.css">
<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="fonts/font.css">

<link href="share/share.css" rel="stylesheet" type="text/css" />

<!--<link href="App_Theme/dashboard.css" rel="stylesheet" type="text/css" />-->

<link href='http://fonts.googleapis.com/css?family=PT+Sans:400' rel='stylesheet' type='text/css'>
</head>
<body class="body_wrap" style="font-family: 'PT Sans', sans-serif;">
<div class="data_container clearfix">
<div class="header">
<div class="logo"></div>
<div class="header_right" > 
<div style="float:left; margin-top:30px; margin-right:20px;"><a href="#"><img onclick="location.href='../download.php?path=databagg.zip';" src="share/images/install-img.png" width="162" height="32" alt="#" /></a></div>           
 <?php
 if(!isset($_SESSION['user_id']))
 {
 ?>
 <div class="login" style=" float:left; margin-top:30px; margin-right:10px; "><a target="_blank" href="http://www.databagg.com/login.php"><img width="81" height="36" border="0" alt="" src="share/images/login.png"></a></div>
           <div class="loginsign" style=" float:left; margin-top:30px;"><a target="_blank" href="http://www.databagg.com/registration.php"><img width="91" height="36" border="0" alt="" src="share/images/signup.png"></a></div> 
 <?php
 }
 ?>
            </div>
            </div>
           
</div>
 <div class="grey_bg" style="margin-top: 105px; height: 50px;">
 <div class="file_content">
 <div class="file_name" style="margin-top: 7px;"><?php if($flag=="false") echo "There is no item for Share! Thank you."; else echo $fetch_share_link['txt_cat_name']." ( ".$fetch_share_link['txt_cat_type']. " )"; ?></div>
 <div class="right-icon" style="display: none;"><a href="#"><img src="images/btn-download.png" width="115" height="31" alt="#" /></a></div>
 
 </div>
 	
 
 </div>
 

<!--<link href="../css/music.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="../css/tabcontent.css" /> -->

<script type="text/javascript" src="../js/tabcontent.js">

/***********************************************
* Tab Content script v2.2- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
 <style type="text/css">


.black_overlay{
			display: none;
			position: fixed;
			top: 0%;
			left: 0%;
			width: 100%;
			height: 100%;
			background-color: black;
			z-index:1001;
			-moz-opacity: 0.4;
			opacity:.40;
			filter: alpha(opacity=40);
		}
		.white_content {
			display: none;
			position: fixed;
			top: 20%;
			left: 32%;
			width: 400px;
		    min-height: 30%;
            
			padding: 10px;
		    -moz-border-radius:3px;
    -webkit-border-radius:3px;
    border-radius:3px;
			background-color: white;
			z-index:1002;
			overflow: hidden;
            border: 1px solid #78B0DE;
            box-shadow: 0 0 5px #78B0DE;
		}
</style>  
<div id="light" class="black_overlay">
</div>
<div class="white_content" id="extra_contact">

<a style="margin-left: 375px;"  href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('extra_contact').style.display='none';">
        
       <img src="../image/close_u.png" />
        
        </a>
        <br />
        
        Select Contacts :
        <hr />
<form>
<table style="width: 100%;" id="alternatecolor" >


        <?php
        
        $list_contact="select * from users_contact where int_uid='".$_SESSION['user_id']."'";
$list_result=mysql_query($list_contact) or die(mysql_error());
$i=0;
if(mysql_num_rows($list_result)>0)
{
while($fetch_list=mysql_fetch_array($list_result))
{
    $i++;
    $name=mysql_real_escape_string($fetch_list['txt_contact_name']);
    
    $email=$fetch_list['txt_contact_email'];
    $email=trim($email);
    $id=$fetch_list['int_contact_id'];
?>
<tr>
<td>
<input type="checkbox" id='mail_<?php echo $i; ?>' name='mail_<?php echo $i; ?>' />
</td>
<td align="right">
<?php echo $email; ?>
<input type='hidden' id='mail_hidden<?php echo $i; ?>' name='mail_hidden<?php echo $i; ?>' value='<?php echo $email; ?>' />

</td>
</tr>

<?php

}


        ?>
<input type="hidden" id="length_mail" name="length_mail" value="<?php echo $i; ?>" />
<tr>
<td colspan="2" align="right">
<input type="hidden" value="" name="total_email" id="total_email"/>
<input type="button" class="submit" value="Add"  onclick="check_submit();" />
</td>
</tr>
<?php
}
else
{
    echo "No cantacts available";
}
?>
</table>  
</form>      

</div>
<script>
function check_submit()

{total_data="";
total_name="";
    count=document.getElementById('length_mail').value;
   //alert(count);
   for(j=1;j<=count;j++)
   {
    mail_datas="mail_"+j;
    mail_value="mail_hidden"+j;
  // alert(mail_datas);
    if(document.getElementById(mail_datas).checked)
    {
    total_data+=document.getElementById(mail_value).value;
    total_data+=",";
   
    }
   }
  total_data=total_data.substr(0,total_data.length-1) 
   if(document.getElementById('manual-email').value=="")
   document.getElementById('manual-email').value=total_data;
   else
   {
    document.getElementById('manual-email').value+=",";
    document.getElementById('manual-email').value+=total_data;
   }
   document.getElementById('extra_contact').style.display="none";
   document.getElementById('light').style.display='none';
  for(j=1;j<=count;j++)
   {
    mail_datas="mail_"+j;
    
   
    if(document.getElementById(mail_datas).checked)
    {
        document.getElementById(mail_datas).checked= false;
   document.getElementById(mail_datas).disabled = true ;
   
    }
   }
  //alert(total_data);
   
 
  
}
</script>

<body >
<style>
.info_suc {

    border: 1px solid #7ab722;
    
    padding:4px 10px 6px 14px;
    background-repeat: no-repeat;
    background-position: 10px center;
    color: #fff;
    background-color: #84c22c;
    width: 25%;
    position: absolute;
    margin-left: 35%;
   
}
</style>
<center>



<?php
if(isset($suc_msg))
{
  echo "<div class='info_suc' id='suc'>";
echo $suc_msg;  
    
      echo "</div>";
      echo "<br />
<br />";
}
?>
<br />
<?php
if($flag=="true")
{
?>
<div class="music_pattern listdiv" style="display:block;border:1px solid gray; width:585px;height: 300px; margin-bottom: 1em; padding-top: 10px;background-color: #FFF;">
<h1>Share <span>B</span>agg</h1>

<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="country1" class="selected">
<img src="images/email-icon.png" /> E-mail</a></li>
<li><a href="#" rel="country2">
<img src="images/icon_post.png" />
Post</a></li>
<li><a href="#" rel="country3">
<img src="images/external_link_icon.png" />
Embed</a></li>

</ul>



<div style="border-top:1px solid #2399BA; width:580px; margin-bottom: 1em; padding-top: 5px; background-color: #FFF;">

<div id="country1" class="tabcontent" style="background-color: #FFF;text-align: left;padding-left: 20px;">
<form method="post" action="#" id="frm_mail" name="frm_mail"> 
<!--<font color="#2399ba"> Send To: </font> --> <br />
<div>
       <!-- <input type="text" id="demo-input-facebook-theme" name="demo-input-facebook-theme" width="350px" /> -->
        
      
    </div>
<font color="#2399ba">Send To :  ( Multiple input using comma seperated) or <a style="text-decoration: none;" href="javascript:void(0);" onclick = "document.getElementById('light').style.display='block';document.getElementById('extra_contact').style.display='block';">Databagg Contacts </a>: </font>  <br />
<textarea rows="2" cols="46" id="manual-email" name="manual-email"></textarea>
 <br />

<input class="submit" type="button" value="Send"  onclick="valid();" />
<input type="hidden" name="code1" value="<?php echo $_REQUEST['code']; ?>" />
<input type="hidden" name="type_c" value="<?php echo $fetch_share_link['txt_cat_type']; ?>" />
</form>
</div>

<div id="country2" class="tabcontent" style="background-color: #FFF;">
<br />
<br />
<style>
img
{
    cursor: pointer;
}
</style>
<a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo "http://www.databagg.com/user/category/share/?code=".$_REQUEST['code']; ?>">
<img src="images/facebook-icon.jpg" width="64px" height="64px" title="Share this on Facebook"  /></a>
<a target="_blank" href="http://twitter.com/share?text='File shared @ Databagg&url=<?php echo "http://www.databagg.com/user/category/share/?code=".$_REQUEST['code']; ?>'">
<img src="images/twitter-icon.jpg" width="64px" height="64px" title="Share this on Twitter" style="padding-left: 10px;" /></a>
<a target="_blank" href="
http://www.linkedin.com/shareArticle?mini=true&url=<?php echo "http://www.databagg.com/user/category/share/?code=".$_REQUEST['code']; ?>&title=Share on databagg&summary=<?php echo "http://www.databagg.com/user/files/share/?code=".$_REQUEST['code']; ?>&source=databagg">
<img src="images/linkedin-icon.jpg" width="64px" height="64px" title="Share this on LinkedIn" style="padding-left: 10px;" />
</a>
<br /><br /><br> <br /><br /><br /><br /><br />

</div>

<div id="country3" class="tabcontent" style="background-color: #FFF;text-align: left;padding-left: 20px;">
<br />
<font color="#2399ba"> Embedded Code: </font> 
<br />
<textarea rows="3" cols="40">
<?php 
echo "http://www.databagg.com/user/category/share/?code=".$_REQUEST['code'];
 ?>
</textarea>
<br /><br /><br> <br /><br />
</div>



</div>

</div>
<?php
}
?>


<script type="text/javascript">

var countries=new ddtabcontent("countrytabs")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()



function valid()
{
    //
    var flag=1;
    
    
    //if(document.getElementById('demo-input-facebook-theme').value!="")
//    {
//     flag=1;   
//    }
//    
//    if(document.getElementById('demo-input-facebook-theme').value=="" && document.getElementById('manual-email').value==""  )
//    {
//        alert("please insert email id.");
//        return false;
//    }

if(document.getElementById('manual-email').value=="")
    {
        alert("please insert email id.");
        return false;
    }
    
    if(((document.getElementById('manual-email').value).replace(/^\s+|\s+$/g,''))!="")
    {
       var regex = /^[^@\s,]+@[^@\s,]+\.[^@\s,]+(,\s?[^@\s,]+@[^@\s,]+\.[^@\s,]+)*$/;
  if (((document.getElementById('manual-email').value).replace(/^\s+|\s+$/g,'')).match(regex)) 
        flag=1;  
         
       else
       {
        alert("please enter valid id and must be comma seperated");
        return false;
        }
    }
    
    
    if(flag==1)
    {
        document.frm_mail.submit(); 
    }
}
</script>


<style>
.submit {
    background:#6eb016;
    border: 1px solid #62a010 !important;
	/*font-family: 'geoslab703_md_btbold';*/
	font-family: 'PT Sans', sans-serif;
	box-shadow:none !important;
    color: #FFF;
	font-weight:normal;
    cursor: pointer;
       font-size: 17px;
    margin-top: 15px;
	float:left;
    padding: 3px 0px;
    text-align: center;
    width: 80px;
}
.submit:hover{color: #FFF; background: #00a2dd; border:1PX solid #0093c8 !important;}
</style>
<script type="text/javascript">
function altRows(id){
	if(document.getElementsByTagName){  
		
		var table = document.getElementById(id);  
		var rows = table.getElementsByTagName("tr"); 
		 
		for(i = 0; i < rows.length; i++){          
			if(i % 2 == 0){
				rows[i].className = "evenrowcolor";
			}else{
				rows[i].className = "oddrowcolor";
			}      
		}
	}
}
window.onload=function(){
	altRows('alternatecolor');
    
}
</script>


<style type="text/css">
table.altrowstable {
	font-family: verdana,arial,sans-serif;
	font-size:11px;
	color:#333333;
	border-width: 1px;
	border-color: #a9c6c9;
	
}
table.altrowstable th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: black;
}
table.altrowstable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: black;
}
.oddrowcolor{
	background-color:#d4e3e5;
    border: 1px solid black;
}
.evenrowcolor{
	border: 1px solid black;
    background-color:#c3dde0;
}


</style>
<div class="footer">
<p>&copy;<?php echo date('Y',time()); ?> <span>Databagg</span></p>
<ul id="footer" class="fleft">
    <li><a href="#" class="active">Terms</a></li>
    <li><a href="#">Privacy Policy</a></li>
    <li><a href="#">Partner with us</a></li>
    <li><a href="#">Contact Databagg</a></li>
    <li ><a href="#" class="right_b">Help </a></li>
    </ul> </div>
    <div class="call_us"><img src="share/images/footer-right.png" alt="call_us" />

</div>