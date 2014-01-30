<?php


if($_REQUEST['Password'])
{
    $update_password="update tab_members set txt_password='".mysql_real_escape_string(base64_encode($_REQUEST['Password']))."' where int_id='".$_SESSION['user_id']."'";
    if(mysql_query($update_password))
    {
    $suc_msg="Password changed Successfully";
    
    }
    else
    $suc_msg="Password not changed";
}

if($_REQUEST['upload_pic'])
{
   

$allowedExts=array("jpg", "jpeg", "gif", "png");
//$extension=end(explode(".", $_FILES["picture"]["name"]));
if ((($_FILES["picture"]["type"] == "image/gif")
|| ($_FILES["picture"]["type"] == "image/jpeg")
|| ($_FILES["picture"]["type"] == "image/png")
|| ($_FILES["picture"]["type"] == "image/pjpeg")))
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
      createThumbs("profile_pic/".$_SESSION['user_id']."/" .$_FILES["picture"]["name"],"profile_pic/".$_SESSION['user_id']."/" .$_FILES["picture"]["name"],195,239);
      //echo "Stored in: " . "profile_pic/" . $_FILES["picture"]["name"];
      $update_user_photo="update tab_members set txt_image='".$_FILES["picture"]["name"]."' where int_id='".$_SESSION['user_id']."' ";
      mysql_query($update_user_photo);
    }
  }
else
  {
  echo "Invalid file";
  }
}
if($_REQUEST['update_true'])
{
    $update_user_data="update tab_members set txt_first_name='".mysql_real_escape_string($_REQUEST['txt_first_name'])."' , txt_last_name='".mysql_real_escape_string($_REQUEST['txt_last_name'])."' , txt_company='".mysql_real_escape_string($_REQUEST['txt_company'])."' ,txt_designation='".mysql_real_escape_string($_REQUEST['txt_designation'])."', txt_phone='".mysql_real_escape_string($_REQUEST['txt_phone'])."' ,
    txt_address1='".mysql_real_escape_string($_REQUEST['txt_address1'])."',txt_country='".mysql_real_escape_string($_REQUEST['txt_country'])."',txt_state='".mysql_real_escape_string($_REQUEST['txt_state'])."',txt_city='".mysql_real_escape_string($_REQUEST['txt_city'])."',txt_zip='".mysql_real_escape_string($_REQUEST['txt_zip'])."'
    where int_id='".$_SESSION['user_id']."' ";
    mysql_query($update_user_data) or die(mysql_error());
    $suc_msg="Profile updated Successfully";
}


$select_user_data="select * from tab_members where int_id='".$_SESSION['user_id']."'";
$result_user_data=mysql_query($select_user_data) or die(mysql_error());
$fetch_user_data=mysql_fetch_array($result_user_data);



?>
<script type="text/javascript" src="js/jquery.js"></script>
     <style>
.login_error {
		font-family: 'PT Sans', sans-serif;
	font-size:14px;
	
	background:url(images/errorbg.jpg) repeat-x #3d85a5;
	color:#FFF;
	text-align:center;
     border: 2px solid #FFF;
	padding:10px 5px 10px 10px;
	
	min-width:175px;
	position:absolute;
	margin: 33px 0 0 170px;
	display:none;
     box-shadow:0 0 5px #9a9a9a;
}
.arrow-left {
   /* border-bottom: 10px solid transparent;
    border-right: 10px solid #4089a8;
    border-top: 10px solid transparent;*/
	background:url(images/arrowbg.png) no-repeat left;
	width:13px;
	height:17px;
   float:left;
   position:absolute;
   top:10px;
   left:7px;
	margin:0 0 0 -20px;
}
</style>
    <!-- <link href="css/my_settings.css" type="text/css" rel="stylesheet" />  -->
      <link href="css/setting.css" type="text/css" rel="stylesheet" />
<div class="container" >
  <center>
    <?php
       if($suc_msg)
     {
        ?>
    <div class="success" id="error_container1" style="position: absolute;margin-left: 250px;"> <strong>&radic;</strong> <?php echo $suc_msg; ?> </div>
    <?php
     }
     ?>
  </center>
  <div class="fleft width" > </div>
  <div id="main" class="fleft">
    <div class="width fright">
      <div class="fullcontainer">
        <h1 >&nbsp; Account Setting</h1>
      </div>
      
      
      <!--setting page start here-->
      <div id="ac_setting_container">
      <div class="settingleft_section">
      	<div class="user_photo"><img src="<?php if($fetch_user_data['txt_image']){ echo "profile_pic/".$_SESSION['user_id']."/".$fetch_user_data['txt_image']; } else echo "images/avtar.jpg"; ?>"  alt="#"  /></div>
        <div class="upload_input">
        Upload a new photo<br />
        
      
       <style>
       .file-wrapper {
  cursor: pointer;
  display: inline-block;
  overflow: hidden;
  position: relative;
}
.file-wrapper input {
  cursor: pointer;
  font-size: 100px;
  height: 100%;
  filter: alpha(opacity=1);
  -moz-opacity: 0.01;
  opacity: 0.01;
  position: absolute;
  right: 0;
  top: 0;
}
.file-wrapper .button {
  background: #d0d0d0;
 border: 1px solid #bcbcbc;
  color: #7e7e7e;
  cursor: pointer;
  display: inline-block;
  font-size: 11px;
  font-weight: bold;
  margin-right: 5px;
  padding: 4px 8px;
  text-transform: uppercase;
}
.file-holder
{
    overflow: hidden;
    width: 220px;
    float: left;
}
       </style>
       <form id="uploadpic" name="uploadpic" action="#" method="post" enctype="multipart/form-data" >
                            <span class="file-wrapper">
                            
                            
		<input type="file" id="picture" name="picture"     />
        <span class="button">Choose a Photo</span>
		<input type="hidden" name="upload_pic" value="1" />
<input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />	





  
</span>
<br />
 <input name="buttonSub" id="buttonSub" type="button" onclick="sumt();" value="" class="submit2" />
</form> 
<script>
function sumt()
{
    if(document.getElementById('picture').value=="")
    {
    alert("Please select a picture to upload. ");
    return false;
    }
    else
    window.uploadpic.submit();
}
</script>
<script>
var SITE = SITE || {};
 
SITE.fileInputs = function() {
  var $this = $(this),
      $val = $this.val(),
      valArray = $val.split('\\'),
      newVal = valArray[valArray.length-1],
      $button = $this.siblings('.button'),
      $fakeFile = $this.siblings('.file-holder');
  if(newVal !== '') {
    $button.text('Photo Chosen');
    if($fakeFile.length === 0) {
      $button.after('<span class="file-holder">' + newVal + '</span>');
    } else {
      $fakeFile.text(newVal);
    }
  }
};
 
$(document).ready(function() {
  $('.file-wrapper input[type=file]').bind('change focus click', SITE.fileInputs);
});
</script>
                            
                            
 
 <div class="upload_text">Note : Clicking "Upload" will immediately replace your profile picture. This cannot be undone.</div>

       
        </div>
       
      </div>
      <div class="settingright_section">
      <h2><?php echo ucfirst($fetch_user_data['txt_first_name'])." ".ucfirst($fetch_user_data['txt_last_name']); ?><br />
<span><?php echo $fetch_user_data['txt_designation']; ?></span></h2>
<div id="AC_import" >
<ul class="tabs">

<li><a   href="#tab1">Profile Setting</a> </li>

<li><a   href="#tab2">Change Password</a> </li>
<li><a   href="#tab3">Bonus Space</a> </li>

</ul>

<!--tabing start here-->
<div class="height53"></div>
<div class="setting_outoorcon">


                                                                                <div class="tab_container">
                  
                                                                                    <div id="tab1" class="tab_content">
                                                                                        <p class="width" >
                                                                                       
                          
                         
                         
                            <div class="fleft contact_info">
                            
                           
                          <div class="setting_formmain">
                          
                            
                            
                            
                            
                               <form id="form1" name="form1" action="#" method="post">
                               
                               <div class="formrow_setting">
                               
                               <div class="form_cols fl">
                                <div id="error_fname" class="login_error" style="display: none;">
<div class="arrow-left"></div> Enter first name
</div>
<label>First Name:</label>
                    <input type="text" id="txt_first_name" name="txt_first_name" value="<?php echo $fetch_user_data['txt_first_name']; ?>"  />            
                               
                               </div>
                          <div class="form_cols fr">
                           <div id="error_lname" class="login_error" style="display: none;margin-left: 0px;margin-top: 40px;">
<div class="arrow-left"></div> Enter your last name
</div>
        <label>Last Name:</label>
       
       <input type="text" id="txt_last_name" name="txt_last_name" value="<?php echo $fetch_user_data['txt_last_name']; ?>"   />
                          </div>
       
       
       </div>
        
       <div class="formrow_setting">
        <div class="form_cols fl">
        <label>Company:</label>
         <input type="text" id="txt_company" name="txt_company" value="<?php echo $fetch_user_data['txt_company']; ?>" /></div>
         <div class="form_cols fr">
         <label for="name">Designation:</label>
         <input type="text" id="txt_designation" name="txt_designation" value="<?php echo $fetch_user_data['txt_designation']; ?>"   /></div>
       
       </div>  
       
       
      <div class="formrow_setting" >
      <div class="form_cols2 fl">
      <div class="form_cols fl">
       <div id="error_phone" class="login_error" style="display: none;">
<div class="arrow-left"></div> Enter your phone
</div>
<label for="name">Phone:</label>
 <input type="text" id="txt_phone" name="txt_phone" value="<?php echo $fetch_user_data['txt_phone']; ?>"    />
   </div> 
   
   <div class="form_cols fl">
       <div id="error_country" class="login_error" style="display: none;">
 <div class="arrow-left"></div>Please select your country
</div>
       <label for="name">Country:</label>
       <select id="txt_country" name="txt_country"  >
        <?php 
         $select_con="select * from countries";
        $result_total=mysql_query($select_con)or die(mysql_error());
        while($fetch_con=mysql_fetch_array($result_total))
        {
            ?>
            <option value="<?php echo $fetch_con['country_name']; ?>" <?php if(strtolower($fetch_user_data['txt_country'])==strtolower($fetch_con['country_name'])) echo "selected"; ?>><?php echo $fetch_con['country_name']; ?></option>
            <?php
        }
        ?>
        </select>
   </div>    
        
      
      </div>
     
      <div class="form_cols fr">
       <label >Address:</label>
      <textarea id="txt_address1" name="txt_address1"  class="textareainput" ><?php echo $fetch_user_data['txt_address1']; ?></textarea></div>
      </div> 
       
      
      
       
       <div class="formrow_setting">
        <div class="form_cols fl">
         <div id="error_state" class="login_error" style="display: none;">
<div class="arrow-left"></div> Enter your state name
</div>
       <label for="name">State:</label>
       <input type="text" id="txt_state" name="txt_state" value="<?php echo $fetch_user_data['txt_state']; ?>"    />
        
        </div>
        <div class="form_cols fr">
        <div id="error_city" class="login_error" style="display: none;margin-left: 0px;margin-top: 40px;">
 <div class="arrow-left"></div>Enter your city name
</div>
       
       
      <label for="name">City:</label>
       <input type="text" id="txt_city" name="txt_city" value="<?php echo $fetch_user_data['txt_city']; ?>"   />
        </div>
       </div> 
        
       
        <div class="formrow_setting"> 
        
         <div class="form_cols fl">
          <div id="error_zip" class="login_error" style="display: none;">
<div class="arrow-left"></div> Enter your zip-code
</div>
        <label for="name">Zip:</label>
       <input type="text" id="txt_zip" name="txt_zip" value="<?php echo $fetch_user_data['txt_zip']; ?>"   />
         
         </div>
         <div class="form_cols fr"> <input type="button" value="" onclick="validate();"  class="uploadbut">
        </div>
        </div>
        
       
       
       
       
       
       
        
         
         
       
        
         
       
        
        
       
        
        </div>
        <input type="hidden" name="update_true" value="1" />
        <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
    </form>
       </div>
                             </p>
                            </div>
                            
                            
                            <div id="tab2" class="tab_content">                           
                            <p class="width" >
                            
                          <div class="fleft contact_info">
                              <form action="#" method="post" id="frm_change" name="frm_change" >
       
         <div id="error_opass" class="login_error" style="display: none;top: 250px;">
 <div class="arrow-left"></div>Enter old password
</div>
       
         <label for="name">Old password: </label>
        <input class="setting_largeinput"  type="password" id="pass_prev" name="pass_prev"  /> 
        
          <div id="error_pass" class="login_error" style="display: none;top: 304px;">
 <div class="arrow-left"></div>Enter new password
</div>
        <label for="name">New password: </label>
       
        <input class="setting_largeinput"  type="password" id="Password" name="Password"  />
        
          <div id="error_cpass" class="login_error" style="display: none;top: 354px;">
 <div class="arrow-left"></div>Confirm password mismatch
</div>
        
       <label for="name">Confirm password: </label>
        <input class="setting_largeinput"  type="password" id="Password_new" name="Password_new"  />
       
        
        
        <div class="fleft width mar8">
        
        </div>
        <div class="width mar15" >
        <input type="button" value="" onclick="check_submit();" class="but_changepassword"  />
        
        </div>
        <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
        </form>
       
                           
                            </div>     
                           
                         </p>
                        </div> 
                         
                         
                         
                        
                                                       
                                                                                  
                                                                                    <div id="tab3" class="tab_content" style="width: 100%;">
                                                                                  <p class="width" >
                           <font style='margin-left:0px' color='#049CD4'>
                           <b>
                           You can earn upto unlimited space by referring your friends to Databagg!
                           </b>
                           </font>
                           
                           
                           <div class="fleft contact_info" style="margin-left:30px;">
                           
                             <img src="images/refferal-banner.jpg"  alt="#" /></div>
                           <?php
                            $select_invitation="select * from invititation where invitedby='".$_SESSION['user_id']."'";
                           $result_invitation=mysql_query($select_invitation);
                           if(mysql_num_rows($result_invitation)>0)
                           {
                           ?>
                            <table  style="width: 100%;margin-top: 30px;" id='alternatecolor' class='altrowstable '>
                           <tr>
                            <th>
                           Type
                            </th>
                              <th>
                            E-mail
                            </th>
                           <th>
                          Status
                           </th>
                           </tr>
                           <?php
                          
                           while($fetch_data_invite=mysql_fetch_array($result_invitation))
                           {
                           ?>
                           
                            <tr>
                            <td>
                            Referral
                            </td>
                              <td>
                           <?php echo $fetch_data_invite['email']; ?>
                            </td>
                           <td>
                           <?php if($fetch_data_invite['uid_isused']==0)
                           echo "Pending registration";
                           else echo"Space Earned"."<img src='images/gift_rcvd.png' style='margin-left:10px;'>"; ?>
                           </td>
                           </tr>
                         
                         <?php
                         }
                         ?>
                         
                         
                           </table>
                           
                         <?php
                         }
                         else
                         {
                            ?>
                            <div class="info_err">
                            You did not invite your any friend yet.
                            </div>
                            <?php
                         }
                         ?>
                         <a class="but_getrefferal"  href="../refral/invite.php" target="_blank" >
                         
                        </a>
                         </p>
                            
                                                                                 </div>
                            
                            
                                 
                        </div>
                        </div>
<!--tabing end here-->





      
      </div>
      
      </div>
      </div>
      <!--setting page end here-->
      
      
       </div>
    
    <!--</div>--> 
  </div>
  <style>
.info_err {
   text-align: center;
    border: 1px solid;
    margin: 10px 0px;
    padding:4px 10px 6px 14px;
    background-repeat: no-repeat;
    background-position: 10px center;
    color: #fff;
    background-color: #e85005;
    width: 40%;
    position: absolute;
    top: 396px;
   font-family: 'PT Sans', sans-serif;
    margin-left: 100px;
}
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
//    
}
</script>
  <style >


table.altrowstable {
font-family: 'PT Sans', sans-serif;
	font-size:14px;
	color:#333333;
	border-width: 1px;
	border-color: #e5e5e5;
    margin-top: 10px;
	
}
table.altrowstable th {
	border-bottom:1px solid #69c2d4;
	padding: 8px;
	
    color: #000;
}
table.altrowstable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #69c2d4;
    overflow: hidden;
}
.oddrowcolor{
	background-color:#fff;
    border: 1px solid #69c2d4;
}
.evenrowcolor{
	border: 1px solid #69c2d4;
    background-color:#eef6eb;
}
</style>
  
  <!--  <div id="tab2" class="tab_content">                             <p class="width" >
                            
                         </p>
                            <div class="fleft width mar22-12">
                              <form action="#" method="post" id="frm_change" name="frm_change" >
       
        <label for="name">Old password: </label>
       
        <input class="gmail_input"  type="password" id="pass_prev" name="pass_prev" onblur="check_pass(this.value);" />
        
        <label for="name">New password: </label>
       
        <input class="gmail_input"  type="password" id="Password" name="Password"  />
        
        <label for="name">Confirm password: </label>
       
        <input class="gmail_input"  type="password" id="Password_new" name="Password_new"  />
       
        
        
        <div class="fleft width mar8">
        
        </div>
        <div class="width mar15" style="text-align:center;">
        <input type="button" value="Change Password" onclick="check_submit();" class="submit1"  />
        
        </div>
        <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
        </form>
       
                           
                            </div>     
                           
                        </div>  --> 
  
  <!--</div>--> 
</div>

<!-- Javascript - jQuery --> 
<script src="js/jquery.min.js"></script> 
<script>window.jQuery || document.write('<script src="js/jquery-1.7.2.min.js"><\/script>')</script> 

<!--[if (gte IE 6)&(lte IE 8)]>
<script src="js/selectivizr.js"></script>
<![endif]--> 

<script src="js/scripts.js"></script> 

<!-- Asynchronous Google Analytics snippet. Change UA-XXXXX-X to be your site's ID. --> 
<script>
 var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
 (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
 g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
 s.parentNode.insertBefore(g,s)}(document,'script'));
</script> 
<script>
function opendialogbox(inputid){
document.getElementById(inputid).click();
}
</script>
<!--<form id="uploadpic" name="uploadpic" action="#" method="post"
 enctype="multipart/form-data" >
  <input type="file" id="picture" name="picture"  style="display: none;"  onchange="sumt();"  />
  <input type="hidden" name="upload_pic" value="1" />
  <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
</form> -->

<style>
.password {
font-size : 12px;
border : 1px solid black;
width : 200px;
font-family : arial, sans-serif;
}
.password1 {
font-size : 12px;
border : 1px solid black;
width : 200px;
font-family : arial, sans-serif;
}
.pstrength-minchar {
font-size : 10px;
}
.submit2{
   /* background:#6eb016;
    border: 1px solid #62a010 !important;
	/*font-family: 'geoslab703_md_btbold';*/
	width:101px;
	height:41px;
	background:url(images/but_upload.jpg);
     background-position: left top;

    

    cursor: pointer;
      border: none;
    margin-top: 15px;
	float:left;
  
   
   
   
}
.submit2:hover{
   background-position: left -41px;
   
}

</style>
<script>


function check_submit()
{
    $( '#error_pass' ).animate({"left":"100px"}, "slow");
    $( '#error_cpass' ).animate({"left":"100px"}, "slow");
    $( '#error_opass' ).animate({"left":"100px"}, "slow");
    document.getElementById("error_pass").style.display='none';
    document.getElementById("error_cpass").style.display='none';
    document.getElementById("error_opass").style.display='none';
    old_pass=trim_string_str(document.getElementById('pass_prev').value);
    new_pass=trim_string_str(document.getElementById('Password').value);
    new_pass_confirm=trim_string_str(document.getElementById('Password_new').value);
    
    if(old_pass=="")
    {
    $('#error_opass').fadeIn('slow');
     $( '#error_opass' ).animate({"left":"300px"}, "slow");
        document.getElementById("pass_prev").focus();
        return false;
    }
    
     
    
    if(new_pass=="")
    {
    $('#error_pass').fadeIn('slow');
     $( '#error_pass' ).animate({"left":"300px"}, "slow");
    document.getElementById('error_pass').innerHTML="<div class='arrow-left'></div>Enter new password.";
        document.getElementById("Password").focus();
        return false;
    }
    
    if(trim_string_str(document.getElementById('Password').value).length<8 || trim_string_str(document.getElementById('Password').value).length>21 )
    {
      
    $('#error_pass').fadeIn('slow');
     $( '#error_pass' ).animate({"left":"300px"}, "slow");
        document.getElementById('error_pass').innerHTML="<div class='arrow-left'></div>Please enter a password between 8 and 20 characters long.";
        document.getElementById("Password").focus();
        return false;
    }
    
    if(new_pass_confirm!=new_pass)
    {
      $('#error_cpass').fadeIn('slow');
       $( '#error_cpass' ).animate({"left":"300px"}, "slow");
        document.getElementById("Password_new").focus();
        return false;
    }
     if(old_pass!="")
    {
    
    check_pass(old_pass);
   
    }
    else
//alert("succ11");
    document.frm_change.submit();
}
</script> 
<script>
	var xmlhttp;
function testXML(){

	if(window.XMLHttpRequest)
  {
	//code for IE7 and hiegher version
	xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=ActiveXObject("Microsoft.XMLHTTP");
	}
return xmlhttp;	
}

function check_pass(str)
{
		var strURL="ajax_pass_check.php?val="+str+"&id=<?php echo $_SESSION['user_id']; ?>";
        //alert(strURL);
		var req = testXML();
		
		if (req) {
			
			req.onreadystatechange = function() {
			 
				if (req.readyState == 4) {
					
					// only if "OK"
					if (req.status == 200) {
				
						
                        if(req.responseText=="failed")
                        {
                            
                        
                        $('#error_opass').fadeIn('slow');
                        $( '#error_opass' ).animate({"left":"300px"}, "slow");
                         document.getElementById('error_opass').innerHTML="<div class='arrow-left'></div>Old password mismatch";
                        document.getElementById("pass_prev").focus();
                            return false;
                        
                        }
                        else
                        {
                        
                           document.frm_change.submit(); 
                        }
                       				
						
					} else {
					//	alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	
}


</script> 
<script>
function allnumeric(inputtxt)
   {
      var numbers = /^[0-9]+$/;
      if(inputtxt.match(numbers))
      {
      
      return true;
      }
      else
      {
     
      return false;
      }
   } 
function specialcharecternormalzip(val)

            {

                var iChars = "!`@#$%^&*()+=[]\\\';,./{}|\":<>?~_qwertyuioplkjhgfdsazxcvbnm";   

                var data =  val.toLowerCase();

                for (var i = 0; i < data.length; i++)

                {      

                    if (iChars.indexOf(data.charAt(i)) != -1)

                    {    

                     return false; 

                    } 

                }
                return true;

            }
function specialcharecternormal(val)

            {

                var iChars = "1234567890";   

                var data = val;

                for (var i = 0; i < data.length; i++)

                {      

                    if (iChars.indexOf(data.charAt(i)) != -1)

                    {    

                     return false; 

                    } 

                }
                return true;

            }
function specialcharecter(val)
{
re = /^[A-Za-z\s]+$/;
if(re.test(val))
{
return true;
}
else
{
return false;

}

}
            
            function specialcharecterforemail(val)

            {

                var iChars = "!`#$%^&*()+=-[]\\\';,/{}|\":<>?~";   

                var data = val;

                for (var i = 0; i < data.length; i++)

                {      

                    if (iChars.indexOf(data.charAt(i)) != -1)

                    {    

                     return false; 

                    } 

                }
                return true;

            }
            
            function alphanumeric(inputtxt)  
{   
var letters = /^[0-9a-zA-Z\s]+$/;  
if(inputtxt.match(letters))  
{  
 
return true;  
}  
else  
{  

return false;  
}  
} 
function trim_string_str(str1) {
     var ichar, icount;
     var strValue = str1
     ichar = strValue.length - 1;
     icount = -1;
     while (strValue.charAt(ichar)==' ' && ichar > icount)
         --ichar;
     if (ichar!=(strValue.length-1))
         strValue = strValue.slice(0,ichar+1);
     ichar = 0;
     icount = strValue.length - 1;
     while (strValue.charAt(ichar)==' ' && ichar < icount)
         ++ichar;
     if (ichar!=0)
         strValue = strValue.slice(ichar,strValue.length);
     return strValue;
 }
function validate()
{
    $( '#error_fname' ).animate({"left":"-100px"}, "slow");
    $( '#error_lname' ).animate({"left":"0px"}, "slow");
    $( '#error_phone' ).animate({"left":"-100px"}, "slow");
    $( '#error_country' ).animate({"left":"-100px"}, "slow");
    $( '#error_state' ).animate({"left":"-100px"}, "slow");
    $( '#error_city' ).animate({"left":"0px"}, "slow");
    $( '#error_zip' ).animate({"left":"-100px"}, "slow");
   
    
    document.getElementById("error_fname").style.display='none';
    document.getElementById("error_lname").style.display='none';
    document.getElementById("error_phone").style.display='none';
    document.getElementById("error_country").style.display='none';
    document.getElementById("error_state").style.display='none';
      document.getElementById("error_city").style.display='none';
    document.getElementById("error_zip").style.display='none';
    
    if(trim_string_str(document.getElementById("txt_first_name").value)=="")
    {
        //document.getElementById("error_fname").style.display='block';
       $('#error_fname').fadeIn('slow');
       $( '#error_fname' ).animate({"left":"100px"}, "slow");
        document.getElementById("txt_first_name").focus();
         $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    }
    if(!specialcharecter(document.getElementById("txt_first_name").value))
    {
         //document.getElementById("error_fname").style.display='block';
         $('#error_fname').fadeIn('slow');
          $( '#error_fname' ).animate({"left":"100px"}, "slow");
         document.getElementById("error_fname").innerHTML="<div class='arrow-left'></div>Only Alphabets allowed."
          $("html, body").animate({ scrollTop: 0 }, 600);
        document.getElementById("txt_first_name").focus();
        return false;
    }
    
    if(trim_string_str(document.getElementById("txt_first_name").value).length>25  )
    {
      
     $('#error_fname').fadeIn('slow');
      $( '#error_fname' ).animate({"left":"100px"}, "slow");
         document.getElementById("error_fname").innerHTML="<div class='arrow-left'></div>First name must be less than 25 characters."
          $("html, body").animate({ scrollTop: 0 }, 600);
        document.getElementById("txt_first_name").focus();
        return false;
    }
    
    if(trim_string_str(document.getElementById("txt_last_name").value)=="")
    {
        //document.getElementById("error_lname").style.display='block';
        $('#error_lname').fadeIn('slow');
        $( '#error_lname' ).animate({"left":"300px"}, "slow");
        document.getElementById("txt_last_name").focus();
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    }
     if(!specialcharecter(document.getElementById("txt_last_name").value))
    {
         //document.getElementById("error_lname").style.display='block';
          $('#error_lname').fadeIn('slow');
           $( '#error_lname' ).animate({"left":"300px"}, "slow");
          
         document.getElementById("error_lname").innerHTML="<div class='arrow-left'></div>Only Alphabets allowed."
         $("html, body").animate({ scrollTop: 0 }, 600);
        document.getElementById("txt_last_name").focus();
        return false;
    }
     if(trim_string_str(document.getElementById("txt_last_name").value).length>25  )
    {
      
      $('#error_lname').fadeIn('slow');
       $( '#error_lname' ).animate({"left":"300px"}, "slow");
         document.getElementById("error_lname").innerHTML="<div class='arrow-left'></div>Last name must be less than 25 characters.";
         $("html, body").animate({ scrollTop: 0 }, 600);
        document.getElementById("txt_last_name").focus();
        return false;
    }
    
   
    
     if(trim_string_str(document.getElementById("txt_phone").value)!="")
    if(!allnumeric(document.getElementById("txt_phone").value))
    {
          $('#error_phone').fadeIn('slow');
          $( '#error_phone' ).animate({"left":"100px"}, "slow");
         //document.getElementById("error_email").style.display='block';
         document.getElementById("error_phone").innerHTML="<div class='arrow-left'></div>Only numbers allowed"
         
        document.getElementById("txt_phone").focus();
        return false;
    } 
     if(trim_string_str(document.getElementById("txt_phone").value)!="")
    if(document.getElementById("txt_phone").value.length != 10)
    {
          $('#error_phone').fadeIn('slow');
          $( '#error_phone' ).animate({"left":"100px"}, "slow");
         //document.getElementById("error_email").style.display='block';
         document.getElementById("error_phone").innerHTML="<div class='arrow-left'></div>Number should be 10 Digits"
        document.getElementById("txt_phone").focus();
        return false;
    } 
    
     if(document.getElementById("txt_country").value=="")
    {
        //document.getElementById("error_fname").style.display='block';
       $('#error_country').fadeIn('slow');
       $( '#error_country' ).animate({"left":"100px"}, "slow");
        document.getElementById("txt_country").focus();
        return false;
    }
  
     if(trim_string_str(document.getElementById("txt_state").value)!="")
    if(!alphanumeric(document.getElementById("txt_state").value))
    {
          $('#error_state').fadeIn('slow');
           $( '#error_state' ).animate({"left":"100px"}, "slow");
         //document.getElementById("error_email").style.display='block';
         document.getElementById("error_state").innerHTML="<div class='arrow-left'></div>Only alphanumeric allowed"
        document.getElementById("txt_state").focus();
        return false;
    } 
      if(trim_string_str(document.getElementById("txt_city").value)!="")
    if(!alphanumeric(document.getElementById("txt_city").value))
    {
          $('#error_city').fadeIn('slow');
           $( '#error_city' ).animate({"left":"300px"}, "slow");
         //document.getElementById("error_email").style.display='block';
         document.getElementById("error_city").innerHTML="<div class='arrow-left'></div>Only alphanumeric allowed"
        document.getElementById("txt_city").focus();
        return false;
    } 
    
    
     
    if(trim_string_str(document.getElementById("txt_zip").value)!="")
    if(!allnumeric(document.getElementById("txt_zip").value))
    {
          $('#error_zip').fadeIn('slow');
           $( '#error_zip' ).animate({"left":"100px"}, "slow");
         //document.getElementById("error_email").style.display='block';
         document.getElementById("error_zip").innerHTML="<div class='arrow-left'></div>Only numbers allowed"
        document.getElementById("txt_zip").focus();
        return false;
    } 
   window.form1.submit();
   
    
}
</script>