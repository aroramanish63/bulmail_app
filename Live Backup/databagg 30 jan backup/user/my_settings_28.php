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




<div class="container" >



<center>
<?php
       if($suc_msg)
     {
        ?>
        <div class="success" id="error_container1">
         <strong>&radic;</strong> <?php echo $suc_msg; ?>

        </div>
        <?php
     }
     ?>
</center>

<div class="fleft width" >

</div>
 <div id="main" class="fleft">


<div class="width fright">
<h1>My Settings</h1>



                 
                    
                          <div class="fright">  
                           <img src="<?php if($fetch_user_data['txt_image']){ echo "profile_pic/".$_SESSION['user_id']."/".$fetch_user_data['txt_image']; } else echo "images/avtar.jpg"; ?>" width="100px" height="100px" /> 
                           <a href="javascript:void(0);" onclick="javascript:opendialogbox('picture');" style="text-decoration: none;color: white;">
                            <div id="test" class="chk_msg_change"  >Change</a>
                             </div>
                             </div>
                          
                         
                         </div>
                            <div class="fleft contact_info">
                               <form id="form1" name="form1" action="#" method="post">
       
        <label for="name">First Name:</label>
       <input type="text" id="txt_first_name" name="txt_first_name" value="<?php echo $fetch_user_data['txt_first_name']; ?>"  class="input_box1"  />
        
        <label for="name">Last Name:</label>
       <input type="text" id="txt_lastt_name" name="txt_last_name" value="<?php echo $fetch_user_data['txt_last_name']; ?>"  class="input_box1"  />
       
       <label for="name">Company:</label>
       <input type="text" id="txt_company" name="txt_company" value="<?php echo $fetch_user_data['txt_company']; ?>"  class="input_box1" />
       
       
        
        <label for="name">Designation:</label>
       <input type="text" id="txt_designation" name="txt_designation" value="<?php echo $fetch_user_data['txt_designation']; ?>"  class="input_box1" />
        
        
        <label for="name">Phone:</label>
       <input type="text" id="txt_phone" name="txt_phone" value="<?php echo $fetch_user_data['txt_phone']; ?>"  class="input_box1"  />
       
       
       
       <label for="name">Address:</label>
       <textarea id="txt_address1" name="txt_address1"  class="input_box1" >
        <?php echo $fetch_user_data['txt_address1']; ?>
        </textarea>
        
        <label for="name">Country:</label>
       <select id="txt_country" name="txt_country" class="input_box1">
        <option value="India">India</option>
        <option value="Nepal">Nepal</option>
        <option value="Pakistan">Pakistan</option>
        </select>
        
        <label for="name">State:</label>
       <input type="text" id="txt_state" name="txt_state" value="<?php echo $fetch_user_data['txt_state']; ?>"  class="input_box1"  />
       
       <label for="name">City:</label>
       <input type="text" id="txt_city" name="txt_city" value="<?php echo $fetch_user_data['txt_city']; ?>"  class="input_box1"  />
        
        <label for="name">Zip:</label>
       <input type="text" id="txt_zip" name="txt_zip" value="<?php echo $fetch_user_data['txt_zip']; ?>"  class="input_box1"  />
       
        
        
        <input type="submit" value="Update"  class="submit_btn">
        
        
        </div>
        <input type="hidden" name="update_true" value="1" />
        <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
    </form>
       
                           
                            </div>     
                        </div>
                       
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
<script type="text/javascript" src="js/jquery.js"></script>  
<script type="text/javascript" src="js/jquery.pstrength-min.1.2.js">
</script>
<script type="text/javascript">
$(function() {
$('.password').pstrength();
});
</script>

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
<form id="uploadpic" name="form1" action="#" method="post"
 enctype="multipart/form-data"  onchange="this.submit();" >
		<input type="file" id="picture" name="picture"  style="display: none;;"/>
		<input type="hidden" name="upload_pic" value="1" />
<input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />	
</form>
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
.submit1{
    width:110px; height:25px;
    background:#d0c009;
    border:1px solid #978d15;
    text-align:center;
    padding:0 0 0 0;
    margin-top:15px;
    color:#555454;
    font-family:PT Sans;
    font-size:13px;
    cursor:pointer;
}
.submit1:hover{color: #199bbf; background: #d6eff7;}
</style>

<script>
function check_submit()
{
    new_pass=document.getElementById('Password').value;
    new_pass_confirm=document.getElementById('Password_new').value;
    
    if(new_pass_confirm=="")
    {
    alert("Please enter password!");
    return false;
    }
    if(new_pass_confirm!=new_pass)
    {
    alert("New password and confirm password is not same!");
    return false;
    }
    else
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
		var strURL="ajax_pass_check.php?add="+str;
        //alert(strURL);
		var req = testXML();
		
		if (req) {
			
			req.onreadystatechange = function() {
			 
				if (req.readyState == 4) {
					
					// only if "OK"
					if (req.status == 200) {
					
						
                        if(req.responseText=="failed")
                        {
                            
                        alert("Please enter corect password!");
                        document.getElementById('pass_prev').focus();
                        return false;
                        
                        }
                        else
                        {
                            
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