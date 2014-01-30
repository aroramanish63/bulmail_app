<?php
error_reporting(0);
if(!isset($_REQUEST["member_id"]))
{
    
}
else
$_SESSION["user_id"]=$_REQUEST["member_id"];
if(!isset($_REQUEST["pid"]))
	$pid=0;
else
	$pid=$_REQUEST["pid"];
?>

<?php
if(isset($_REQUEST['upload_pic']))
{
   

$allowedExts=array("jpg", "jpeg", "gif", "png");
$extension=end(explode(".", $_FILES["picture"]["name"]));
if ((($_FILES["picture"]["type"] == "image/gif")
|| ($_FILES["picture"]["type"] == "image/jpeg")
|| ($_FILES["picture"]["type"] == "image/png")
|| ($_FILES["picture"]["type"] == "image/pjpeg"))
&& in_array($extension, $allowedExts))
  {
  if ($_FILES["picture"]["error"] > 0)
    {
    //echo "Return Code: " . $_FILES["picture"]["error"] . "<br>";
    }
  else
    {
    //echo "Upload: " . $_FILES["picture"]["name"] . "<br>";
    //echo "Type: " . $_FILES["picture"]["type"] . "<br>";
    //echo "Size: " . ($_FILES["picture"]["size"] / 1024) . " kB<br>";
    //echo "Temp file: " . $_FILES["picture"]["tmp_name"] . "<br>";
    if(!is_dir("profile_pic/".$_SESSION['user_id']."/"))
       mkdir("profile_pic/".$_SESSION['user_id']."/");
    
      move_uploaded_file($_FILES["picture"]["tmp_name"],      "profile_pic/".$_SESSION['user_id']."/" .$_FILES["picture"]["name"]);
      createThumbs("profile_pic/".$_SESSION['user_id']."/" .$_FILES["picture"]["name"],"profile_pic/".$_SESSION['user_id']."/" .$_FILES["picture"]["name"],100,100);
      //echo "Stored in: " . "profile_pic/" . $_FILES["picture"]["name"];
      $update_user_photo="update tab_members set txt_image='".$_FILES["picture"]["name"]."' where int_id='".$_SESSION['user_id']."' ";
      mysql_query($update_user_photo);
    }
  }
else
  {
  $msg= "Invalid file";
  }
}


if(isset($_REQUEST['update_true']))
{
    $update_user_data="update tab_members set txt_first_name='".mysql_real_escape_string($_REQUEST['txt_first_name'])."' , txt_last_name='".mysql_real_escape_string($_REQUEST['txt_last_name'])."' , txt_company='".mysql_real_escape_string($_REQUEST['txt_company'])."' ,txt_designation='".mysql_real_escape_string($_REQUEST['txt_designation'])."', txt_phone='".mysql_real_escape_string($_REQUEST['txt_phone'])."' ,
    txt_address1='".mysql_real_escape_string($_REQUEST['txt_address1'])."',txt_country='".mysql_real_escape_string($_REQUEST['txt_country'])."',txt_state='".mysql_real_escape_string($_REQUEST['txt_state'])."',txt_city='".mysql_real_escape_string($_REQUEST['txt_city'])."',txt_zip='".mysql_real_escape_string($_REQUEST['txt_zip'])."'
    where int_id='".$_SESSION['user_id']."' ";
    mysql_query($update_user_data) or die(mysql_error());
    $msg="Profile updated Successfully.";
}

?>

<?php

?>
<style>
.tablesorter_bg
{background-color: #FFFFFF;
    font-family: PT Sans;
    font-size: 13px;
    margin: 10px 0 15px;
    text-align: left;
    
}
table {
    border-collapse: collapse;
    border-spacing: 0;
}
</style>
<br>
<h2>My Profile</h2>
<hr>
<?php
if(isset($msg))
echo $msg;
?>
<div class="sub_container" >
 <style>

.sub{
background: none repeat scroll 0 0 #D0C009;
    border: 1px solid #978D15;
    color: #555454;
    cursor: pointer;
    font-family: PT Sans;
    font-size: 13px;
    height: 25px;
    
    padding: 0;
    text-align: center;
    width: 90px;
}
.sub1{
background: none repeat scroll 0 0 #D0C009;
    border: 1px solid #978D15;
    color: #555454;
    cursor: pointer;
    font-family: PT Sans;
    font-size: 13px;
    height: 25px;
    margin-top: 5px;
    padding: 0;
    text-align: center;
    width: 40px;
}
.gmail_input
{border: 1px solid #BEBEBE;
    color: #666666;
    display: block;
    font-family: PT Sans;
    font-size: 13px;
    height: 24px;
    width: 200px;}
</style>

</head>
<body>
<?php
$select_user_data="select * from tab_members where int_id='".$_SESSION['user_id']."'";
$result_user_data=mysql_query($select_user_data) or die(mysql_error());
$fetch_user_data=mysql_fetch_array($result_user_data);

?>

 <img src="<?php if($fetch_user_data['txt_image']){ echo "profile_pic/".$_SESSION['user_id']."/".$fetch_user_data['txt_image']; } else echo "images/avtar.jpg"; ?>" width="100px" height="100px" /> 
                         <?php
                           function using_ie() 
                            { 
                             $u_agent = $_SERVER['HTTP_USER_AGENT']; 
                             $ub = False; 
                             if(preg_match('/MSIE/i',$u_agent)) 
                             { 
                             $ub = True; 
                             } 
                            
                             return $ub; 
                            }
                            ?>
                            <?php if (using_ie()){ ?> 
                            
 <form id="uploadpic" name="uploadpic" action="#" method="post"
 enctype="multipart/form-data" >
		<input type="file" id="picture" name="picture"     />
		<input type="hidden" name="upload_pic" value="1" />
<input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />	

 <input name="buttonSub" id="buttonSub" type="submit" value="Upload" class="sub" />
</form> 
 <?php } else { ?>
 <a href="javascript:void(0);" onclick="javascript:opendialogbox('picture');" style="text-decoration: none;color: white;">
                           
                            <div id="test" class="chk_msg_change"  >Change</a>
                             </div>
 <?php } ?>
                            

<form id="form1" name="form1" action="#" method="post">
       
        <label for="name">First Name:</label>
       <input type="text" id="txt_first_name" name="txt_first_name" value="<?php echo $fetch_user_data['txt_first_name']; ?>"  class="gmail_input"  />
        
        <label for="name">Last Name:</label>
       <input type="text" id="txt_lastt_name" name="txt_last_name" value="<?php echo $fetch_user_data['txt_last_name']; ?>"  class="gmail_input"  />
       
       <label for="name">Company:</label>
       <input type="text" id="txt_company" name="txt_company" value="<?php echo $fetch_user_data['txt_company']; ?>"  class="gmail_input" />
       
       
        
        <label for="name">Designation:</label>
       <input type="text" id="txt_designation" name="txt_designation" value="<?php echo $fetch_user_data['txt_designation']; ?>"  class="gmail_input" />
        
        
        <label for="name">Phone:</label>
       <input type="text" id="txt_phone" name="txt_phone" value="<?php echo $fetch_user_data['txt_phone']; ?>"  class="gmail_input"  />
       
       
       
       <label for="name">Address:</label>
       <textarea id="txt_address1" name="txt_address1"  class="gmail_input" ><?php echo $fetch_user_data['txt_address1']; ?></textarea>
        
        <label for="name">Country:</label>
       <select id="txt_country" name="txt_country" class="gmail_input">
        <option value="India">India</option>
        <option value="Nepal">Nepal</option>
        <option value="Pakistan">Pakistan</option>
        </select>
        
        <label for="name">State:</label>
       <input type="text" id="txt_state" name="txt_state" value="<?php echo $fetch_user_data['txt_state']; ?>"  class="gmail_input"  />
       
       <label for="name">City:</label>
       <input type="text" id="txt_city" name="txt_city" value="<?php echo $fetch_user_data['txt_city']; ?>"  class="gmail_input"  />
        
        <label for="name">Zip:</label>
       <input type="text" id="txt_zip" name="txt_zip" value="<?php echo $fetch_user_data['txt_zip']; ?>"  class="gmail_input"  />
       
        
        <br />
        <input type="submit" value="Update"  class="sub">
        
        
        </div>
        <input type="hidden" name="update_true" value="1" />
        <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
    </form>
    
    
</div>





<script>
function submit_form1()
{
    if(document.getElementById('txt_contact_name').value=="")
    {
        alert("Please enter a name");
        document.getElementById("txt_contact_name").focus();
        return false;
    }
    if(document.getElementById('txt_contact_email').value=="")
    {
        alert("Please enter an email");
        document.getElementById("txt_contact_email").focus();
        return false;
    }
    if(document.getElementById("txt_contact_email").value!="")
    {
        var x=document.getElementById("txt_contact_email").value;
        var atpos=x.indexOf("@");
        var dotpos=x.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
             {
                alert("Please enater a valid email address.");
              document.getElementById("txt_contact_email").focus();
                return false;
             }
    }
    
    
    document.form1.submit();
}
</script>
<script>
function opendialogbox(inputid){
document.getElementById(inputid).click();
}
</script>
<form id="uploadpic" name="uploadpic" action="#" method="post"
 enctype="multipart/form-data" >
		<input type="file" id="picture" name="picture"  style="display: none;"  onchange="sumt();"  />
		<input type="hidden" name="upload_pic" value="1" />
<input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />	
</form>
<script>
function sumt()
{
    window.uploadpic.submit();
}
</script>
