<?php



session_start();
include("../../connect.php");
include("../../function.php"); 
error_reporting(0);
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
copy("contacts_dropdown_data.php",'../contacts_dropdown_data.php');
fclose($fpointer);

if($_REQUEST['code'])
{   
    $share_link="";
    $path="";
    
     $updatefile="update users_data set int_is_shared=1 where txt_shared_link='".$_REQUEST['code']."' and int_uid='".$_SESSION['user_id']."' ";
     mysql_query($updatefile);
     $select_exist_share="select txt_shared_link,txt_real_path,txt_file_type from users_data where txt_shared_link='".$_REQUEST['code']."'";
    $result_exist_share=mysql_query($select_exist_share) or die(mysql_error());
    $fetch_share_link=mysql_fetch_array($result_exist_share);
    
    
}



    
?>
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
<center>
<a href="">Share</a>
<a href="">Download</a>
<br />
<hr />
<br />
<div style="display:block;border:1px solid gray; width:450px;height: 300px; margin-bottom: 1em; padding-top: 10px;background-color: #F1F1F1;">
<strong> Share </strong>
<br />
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



<div style="border-top:1px solid gray; width:450px; margin-bottom: 1em; padding-top: 5px; background-color: #F1F1F1;">

<div id="country1" class="tabcontent" style="background-color: #F1F1F1;text-align: left;padding-left: 20px;">

Send To: <br />
<div>
        <input type="text" id="demo-input-facebook-theme" name="demo-input-facebook-theme" width="350px" />
        
        <script type="text/javascript">
        $(document).ready(function() {
            $("#demo-input-facebook-theme").tokenInput("contacts_dropdown_data.php", {
                theme: "facebook"
            });
        });
        </script>
    </div>

Message: <br />
<textarea rows="4" cols="46">

</textarea>
<br />
<input type="button" value="Send" style="margin-top: 5px;" />
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
<a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo $_SERVER["SERVER_NAME"]."/"; ?><?php echo $path; ?>">
<img src="../images/facebook_64.png" width="64px" height="64px" title="Share this on Facebook"  /></a>
<img src="../images/twitter_64.png" width="64px" height="64px" title="Share this on Twitter" style="padding-left: 10px;" />

<img src="../images/linkedin_64.png" width="64px" height="64px" title="Share this on LinkedIn" style="padding-left: 10px;" />



</div>

<div id="country3" class="tabcontent" style="background-color: #F1F1F1;text-align: left;padding-left: 20px;">
<br />
Embedded Code:
<br />
<textarea rows="3" cols="40">
<?php 

 ?>
</textarea>
</div>



</div>

</div>

<style type="text/css">
#main { background: #fff; margin: 20px; text-align: center }
a.media   { display: block; }
div.media { font-size: small; margin: 25px; margin: auto}
div.media div { font-style: italic; color: #888; }
#lr { border: 1px solid #eee; margin: auto }
div.example { padding: 20px; margin: 15px 0px; background: #ffe; clear:left; border: 1px dashed #ccc; text-align: left }
</style>
<script type="text/javascript" src="../js/jquery1.4.1.min.js"></script>
<script type="text/javascript" src="../js/chili-1.7.pack.js"></script>
<script type="text/javascript" src="../js/jquery.media.js"></script>
<script type="text/javascript" src="../js/jquery.metadata.js"></script>
<script type="text/javascript">
    $(function() {
        $('a.media').media({width:700, height:500});
    });
</script>
<?php if($fetch_share_link['txt_file_type']=="application/pdf") { ?>
<a class="media" href="<?php echo "../".$fetch_share_link['txt_real_path']; ?>">PDF File</a>
<?php } else if($fetch_share_link['txt_file_type']=="image/jpeg" || $fetch_share_link['txt_file_type']=="image/png" || $fetch_share_link['txt_file_type']=="image/gif" || $fetch_share_link['txt_file_type']=="image/jpg")  {?>
<img  src="<?php echo "../".$fetch_share_link['txt_real_path']; ?>"/>
<?php } else {
    ?>
    
 <OBJECT id='mediaPlayer' width='550' height='400' 
    classid='CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95'
    codebase='http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=5,1,52,701'
    standby='Loading Microsoft Windows Media Player components...' type='application/x-oleobject'>
    <param name='fileName' value='<?php echo "../".$fetch_share_link['txt_real_path']; ?>'>
    <param name='animationatStart' value='true'>
    <param name='transparentatStart' value='true'>
    <param name='autoStart' value='false'>
    <param name='showControls' value='true'>
    <param name ='ShowAudioControls'value='true'>
    <param name='ShowStatusBar' value='true'>
    <param name='loop' value='false'>
    <EMBED  type='application/x-mplayer2' pluginspage='http://microsoft.com/windows/mediaplayer/en/download/'
    id='mediaPlayer' name='mediaPlayer' displaysize='4' autosize='-1'
    bgcolor='darkblue' showcontrols='true' showtracker='-1'
    showdisplay='0' showstatusbar='-1' videoborder3d='-1' width='550' height='400' style="border:3px solid gray;"
    src='<?php echo "../".$fetch_share_link['txt_real_path']; ?>' autostart='false' designtimesp='5311' loop='false'>
    </EMBED>
    </OBJECT>
   
   <?php
    }
    ?>

</center>
<script type="text/javascript">

var countries=new ddtabcontent("countrytabs")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>



<?php 

?>