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
$data="[";
while($fetch_list=mysql_fetch_array($list_result))
{
    $name=mysql_real_escape_string($fetch_list['txt_contact_name']);
    
    $email=$fetch_list['txt_contact_email'];
    $email=trim($email);
    $id=$fetch_list['int_contact_id'];
    
$data.="{\"name\":\"test\",\"id\":\"$id\",\"email\":\"$email\"},";
}
$data1=substr($data,0,strlen($data)-1);
$data1.="]";

$fpointer=fopen("contacts_dropdown_data.php",'w');
fwrite($fpointer,$data1);

fclose($fpointer);
copy("contacts_dropdown_data.php",'../contacts_dropdown_data.php');
if($_REQUEST['code'])
{   
    $share_link="";
    $path="";
    
     $updatefile="update tab_share set int_is_shared=1 where txt_share_link='".$_REQUEST['code']."' and int_uid='".$_SESSION['user_id']."' ";
     mysql_query($updatefile);
     $select_exist_share="select txt_share_link,txt_real_path from tab_share where txt_share_link='".$_REQUEST['code']."'";
    $result_exist_share=mysql_query($select_exist_share) or die(mysql_error());
    $fetch_share_link=mysql_fetch_array($result_exist_share);
    
    
}
if($_REQUEST['code1'])
{   
    $share_link=random_id();
    $full_path=$_REQUEST['code1']."/".$_REQUEST['nm'];
    $full_path1="../".$_REQUEST['code1']."/".$_REQUEST['nm'];
    
    $isf=0;
    if(is_dir($full_path1))
    $isf=1;
    
     $select_exist_share="select * from tab_share where txt_real_path='".$full_path."'";
   $result_exist_share=mysql_query($select_exist_share) or die(mysql_error());
    $fetch_share_link=mysql_fetch_array($result_exist_share);
    $nm=mysql_num_rows($result_exist_share);
    if($nm==0)
    {
     
    
   $update_share_link="insert into  tab_share (txt_share_link,txt_file_name,txt_real_path,int_is_folder,int_uid,int_is_shared)
      values('".$share_link."','".$_REQUEST['nm']."','".$full_path."','".$isf."','".$_SESSION['user_id']."',1)";
    
    $result_update_share=mysql_query($update_share_link) or die(mysql_error());
    $fetch_share_link=mysql_fetch_array($result_update_share);
    
    $_REQUEST['code']=$share_link;
    }
    
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
    $cd=$_REQUEST['code'];
     $content.="<br> 
     <a style='text-decoration:none;' href='http://www.databagg.com/user/files/share/?code=$cd'>
     <span style='background-color:#15A0C8;border-radius:10px 10px 10px 10px;padding:5px 10px 5px 10px;color:white;font-size:17px;font-weight:bold;white-space:nowrap'>
     View</span> </a> <br>";
    $content.="<br> <br> Enjoy! <br> Team Databagg";
    foreach($arr_email as $mail_id)
    {
       
       //echo $mail_id;
        mail_share($mail_id,$subject,$content,$header);
        //mail($mail_id, $subject, $content, $header);
        
    }
    $suc_msg="Mail send successfully";
}



    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<link href="../css/music.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="../css/tabcontent.css" />

<script type="text/javascript" src="../js/tabcontent.js">

/***********************************************
* Tab Content script v2.2- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="jquery.tokeninput.js"></script>

    <link rel="stylesheet" href="token-input.css" type="text/css" />
    <link rel="stylesheet" href="token-input-facebook.css" type="text/css" />
    
    <script type="text/javascript">
    $(document).ready(function() {
        $("input[type=button]").click(function () {
            //alert("Would submit: " + $(this).siblings("input[type=text]").val());
            
        });
    });
    </script>

<body style="background: url(../image/pattern.jpg);">
<style>
.info_suc {
    border: 1px solid;
    margin: 10px 0px;
    padding:4px 10px 6px 14px;
    background-repeat: no-repeat;
    background-position: 10px center;
    color: #000;
    background-color: #2ECCFA;
    width: 25%;
   
}
</style>
<center>
<table  style="width: 100%;">

    <tr >
        <td colspan="2" align="center">
        <img src="../image/data_logo.png"/>
        </td>
    </tr>
    <tr>
    <td colspan="2">
    <hr style="border: 2px solid #15A0C8" />
    </td>
    
    </tr>

</table>

<br />
<?php
if(isset($suc_msg))
{
  echo "<div class='info_suc' id='suc'>";
echo $suc_msg;  
    
      echo "</div>";
}
?>
<br />
<div class="music_pattern listdiv" style="display:block;border:1px solid gray; width:450px;height: 300px; margin-bottom: 1em; padding-top: 10px;background-color: #F1F1F1;">
<h1>Share <span>B</span>ox</h1>

<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="country1" class="selected">
<img src="../images/email-icon.png" /> E-mail</a></li>
<li><a href="#" rel="country2">
<img src="../images/icon_post.gif" />
Post</a></li>
<li><a href="#" rel="country3">
<img src="../images/external_link_icon.gif" />
Embed</a></li>

</ul>



<div style="border-top:1px solid #2399BA; width:450px; margin-bottom: 1em; padding-top: 5px; background-color: #F1F1F1;">

<div id="country1" class="tabcontent" style="background-color: #F1F1F1;text-align: left;padding-left: 20px;">
<form method="post" action="#" id="frm_mail" name="frm_mail"> 
<!--<font color="#2399ba"> Send To: </font> --> <br />
<div>
       <!-- <input type="text" id="demo-input-facebook-theme" name="demo-input-facebook-theme" width="350px" /> -->
        
        <script type="text/javascript">
        $(document).ready(function() {
            $("#demo-input-facebook-theme").tokenInput("contacts_dropdown_data.php", {
                theme: "facebook"
            });
        });
        </script>
    </div>
<font color="#2399ba">Send To :  ( Multiple input using comma seperated): </font>  <br />
<textarea rows="2" cols="46" id="manual-email" name="manual-email">

</textarea>
 <br />

<input class="submit" type="button" value="Send"  onclick="valid();" />
<input type="hidden" name="code" value="<?php echo $_REQUEST['code']; ?>" />
</form>
</div>

<div id="country2" class="tabcontent" style="background-color: #F1F1F1;">
<br />
<br />
<style>
img
{
    cursor: pointer;
}
</style>
<a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo "http://www.databagg.com/user/files/share/?code=".$_REQUEST['code']; ?>">
<img src="../images/facebook_64.png" width="64px" height="64px" title="Share this on Facebook"  /></a>
<a target="_blank" href="http://twitter.com/share?text='File shared @ Databagg&url=<?php echo "http://www.databagg.com/user/files/share/?code=".$_REQUEST['code']; ?>'">
<img src="../images/twitter_64.png" width="64px" height="64px" title="Share this on Twitter" style="padding-left: 10px;" /></a>
<a target="_blank" href="
http://www.linkedin.com/shareArticle?mini=true&url=<?php echo "http://www.databagg.com/user/files/share/?code=".$_REQUEST['code']; ?>&title=Share on databagg&summary=<?php echo "http://www.databagg.com/user/files/share/?code=".$_REQUEST['code']; ?>&source=databagg">
<img src="../images/linkedin_64.png" width="64px" height="64px" title="Share this on LinkedIn" style="padding-left: 10px;" />
</a>


</div>

<div id="country3" class="tabcontent" style="background-color: #F1F1F1;text-align: left;padding-left: 20px;">
<br />
<font color="#2399ba"> Embedded Code: </font> 
<br />
<textarea rows="3" cols="40">
<?php 
echo "http://www.databagg.com/user/files/share/?code=".$_REQUEST['code'];
 ?>
</textarea>
</div>



</div>

</div>


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
    background: none repeat scroll 0 0 #D0C009;
    border: 1px solid #978D15;
    color: #555454;
    cursor: pointer;
    font-family: PT Sans;
    font-size: 13px;
    height: 25px;
    margin-top: 15px;
    padding: 0;
    text-align: center;
    width: 60px;
}
.submit:hover{color: #199bbf; background: #d6eff7;}
</style>
<?php 

?>