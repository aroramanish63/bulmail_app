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


<script type="text/javascript" src="js/jquery.js"></script>
  <style>
     .login_error { width:211px; height:30px;  top:380px;  color:#FFF;margin-left: 120px;
      font-family:Verdana, Geneva, sans-serif; padding:5px 0 0 20px; background:url(image/errorrmess-img.png) no-repeat; position: absolute;  }
     </style>
<link href="css/my_settings.css" type="text/css" rel="stylesheet" />
<div class="container" >



<center>
<?php
       if($suc_msg)
     {
        ?>
        <div class="success" id="error_container1" style="position: absolute;margin-left: 250px;">
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


                                                                                  <div class="AC_settings">
<h1>&nbsp; Account Setting</h1>


<div id="AC_import" class="width fleft">
                                                                                <ul class="tabs clearfix">
                                                                                    <li><a href="#tab1">Profile Setting</a></li>
                                                                                    <li><a href="#tab2">Change Password</a></li>
                                                                                    <li><a href="#tab3">Security</a></li>
                                                                                </ul>
                     
                                                                                <div class="tab_container">
                  
                                                                                    <div id="tab1" class="tab_content">
                                                                                        <p class="width" >
                                                                                       
                          
                         
                         
                            <div class="fleft contact_info">
                            
                           
                          <table width="100%">
                          <tr>
                          <td width="20%">
                          
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

 <input name="buttonSub" id="buttonSub" type="submit" value="Upload" class="submit2" />
</form> 
 <?php } else { ?>
 <a href="javascript:void(0);" onclick="javascript:opendialogbox('picture');" style="text-decoration: none;color: white;">
                           
                            <div id="test" class="chk_msg_change"  >Change</a>
                             </div>
 <?php } ?>
                            
                           
                           
                            
                          </td>
                          <td>
                         
                        
                      <!--  <input type="text" class="input_box1" style="width: 300px;"  />  -->
                            
                         
                          </td>
                          </tr>
                          </table>
                            
                            
                            
                            
                               <form id="form1" name="form1" action="#" method="post">
       
        <div id="error_fname" class="login_error" style="display: none;">
 Enter first name
</div>
        <label for="name">First Name:</label>
       <input type="text" id="txt_first_name" name="txt_first_name" value="<?php echo $fetch_user_data['txt_first_name']; ?>"  class="input_box1"  />
        
        <div id="error_lname" class="login_error" style="display: none;top: 433px;">
 Enter your last name
</div>
        
        <label for="name">Last Name:</label>
       <input type="text" id="txt_last_name" name="txt_last_name" value="<?php echo $fetch_user_data['txt_last_name']; ?>"  class="input_box1"  />
       
       
       
       <label for="name">Company:</label>
       <input type="text" id="txt_company" name="txt_company" value="<?php echo $fetch_user_data['txt_company']; ?>"  class="input_box1" />
       
       
        
        <label for="name">Designation:</label>
       <input type="text" id="txt_designation" name="txt_designation" value="<?php echo $fetch_user_data['txt_designation']; ?>"  class="input_box1" />
        
        <div id="error_phone" class="login_error" style="display: none;top: 589px;">
 Enter your phone
</div>
        
        <label for="name">Phone:</label>
       <input type="text" id="txt_phone" name="txt_phone" value="<?php echo $fetch_user_data['txt_phone']; ?>"  class="input_box1"  />
       
       
       
       <label for="name">Address:</label>
       <textarea id="txt_address1" name="txt_address1"  class="input_box1" ><?php echo $fetch_user_data['txt_address1']; ?></textarea>
        
          <div id="error_country" class="login_error" style="display: none;top: 729px;">
 Please select your country
</div>
        <label for="name">Country:</label>
       <select id="txt_country" name="txt_country" class="input_box1" style="width: 475px;">
        <?php 
        $select_con="select * from countries";
        $result_total=mysql_query($select_con);
        while($fetch_con=mysql_fetch_array($result_total))
        {
            ?>
            <option value="<?php echo $fetch_con['country_name']; ?>" <?php if(strtolower($fetch_user_data['txt_country'])==strtolower($fetch_con['country_name'])) echo "selected"; ?>><?php echo $fetch_con['country_name']; ?></option>
            <?php
        }
        ?>
        </select>
          <div id="error_state" class="login_error" style="display: none;top: 784px;">
 Enter your state name
</div>
        <label for="name">State:</label>
       <input type="text" id="txt_state" name="txt_state" value="<?php echo $fetch_user_data['txt_state']; ?>"  class="input_box1"  />
       
        <div id="error_city" class="login_error" style="display: none;top: 835px;">
 Enter your city name
</div>
       
       
       <label for="name">City:</label>
       <input type="text" id="txt_city" name="txt_city" value="<?php echo $fetch_user_data['txt_city']; ?>"  class="input_box1"  />
          <div id="error_zip" class="login_error" style="display: none;top: 888px;">
 Enter your zip-code
</div>
        <label for="name">Zip:</label>
       <input type="text" id="txt_zip" name="txt_zip" value="<?php echo $fetch_user_data['txt_zip']; ?>"  class="input_box1"  />
       
        
        
        <input type="button" value="Update" onclick="validate();"  class="submit2">
        
        
        </div>
        <input type="hidden" name="update_true" value="1" />
        <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
    </form>
       
                             </p>
                            </div>
                            
                            
                            <div id="tab2" class="tab_content">                           
                            <p class="width" >
                            
                          <div class="fleft contact_info">
                              <form action="#" method="post" id="frm_change" name="frm_change" >
       
       <!-- <label for="name">Old password: </label>
       
        <input class="input_box1"  type="password" id="pass_prev" name="pass_prev" onblur="check_pass(this.value);" /> -->
        
          <div id="error_pass" class="login_error" style="display: none;top: 250px;">
 Enter new password
</div>
        <label for="name">New password: </label>
       
        <input class="input_box1"  type="password" id="Password" name="Password"  />
        
          <div id="error_cpass" class="login_error" style="display: none;top: 304px;">
 Confirm password mismatch
</div>
        <label for="name">Confirm password: </label>
       
        <input class="input_box1"  type="password" id="Password_new" name="Password_new"  />
       
        
        
        <div class="fleft width mar8">
        
        </div>
        <div class="width mar15" >
        <input type="button" value="Change Password" onclick="check_submit();" class="submit2"  />
        
        </div>
        <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
        </form>
       
                           
                            </div>     
                           
                         </p>
                        </div> 
                         
                         
                         
                        
                                                       
                                                                                  
                                                                                    <div id="tab3" class="tab_content">
                                                                                  <p class="width" >
                           <div class="fleft contact_info">
                           Upcomming content
                           </div>
                           
                         </p>
                            
                                                                                 </div>
                            
                            
                                 
                        </div>
                                                                                      
                                </div>
                                                                                   
                                                                                   
                                                                                   
                                                                                   
                                                                                    
                                                                                    
                                                                                                
                                                                  </div>
                                                </div>


<!--</div>-->
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
    padding-left: 10px;
    padding-right: 10px;
    text-align: center;
    border-radius: 3px;
    width: auto;
   
}
.submit2:hover{color: #FFF; background: #00a2dd; border:1PX solid #0093c8 !important;}
</style>

<script>
function check_submit()
{
    document.getElementById("error_pass").style.display='none';
    document.getElementById("error_cpass").style.display='none';
    new_pass=document.getElementById('Password').value;
    new_pass_confirm=document.getElementById('Password_new').value;
    
    if(new_pass=="")
    {
    $('#error_pass').fadeIn('slow');
        document.getElementById("Password").focus();
        return false;
    }
    if(new_pass_confirm!=new_pass)
    {
      $('#error_cpass').fadeIn('slow');
        document.getElementById("Password_new").focus();
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
        document.getElementById("txt_first_name").focus();
        return false;
    }
    if(!specialcharecter(document.getElementById("txt_first_name").value))
    {
         //document.getElementById("error_fname").style.display='block';
         $('#error_fname').fadeIn('slow');
         document.getElementById("error_fname").innerHTML="Only Alphabets allowed."
        document.getElementById("txt_first_name").focus();
        return false;
    }
    if(trim_string_str(document.getElementById("txt_last_name").value)=="")
    {
        //document.getElementById("error_lname").style.display='block';
        $('#error_lname').fadeIn('slow');
        document.getElementById("txt_last_name").focus();
        return false;
    }
     if(!specialcharecter(document.getElementById("txt_last_name").value))
    {
         //document.getElementById("error_lname").style.display='block';
          $('#error_lname').fadeIn('slow');
         document.getElementById("error_lname").innerHTML="Only Alphabets allowed."
        document.getElementById("txt_last_name").focus();
        return false;
    }
    
   
    
     if(trim_string_str(document.getElementById("txt_phone").value)!="")
    if(!allnumeric(document.getElementById("txt_phone").value))
    {
          $('#error_phone').fadeIn('slow');
         //document.getElementById("error_email").style.display='block';
         document.getElementById("error_phone").innerHTML="Only numbers allowed"
        document.getElementById("txt_phone").focus();
        return false;
    } 
     if(trim_string_str(document.getElementById("txt_phone").value)!="")
    if(document.getElementById("txt_phone").value.length != 10)
    {
          $('#error_phone').fadeIn('slow');
         //document.getElementById("error_email").style.display='block';
         document.getElementById("error_phone").innerHTML="Number should be 10 Digits"
        document.getElementById("txt_phone").focus();
        return false;
    } 
    
     if(document.getElementById("txt_country").value=="")
    {
        //document.getElementById("error_fname").style.display='block';
       $('#error_country').fadeIn('slow');
        document.getElementById("txt_country").focus();
        return false;
    }
  
     if(trim_string_str(document.getElementById("txt_state").value)!="")
    if(!alphanumeric(document.getElementById("txt_state").value))
    {
          $('#error_state').fadeIn('slow');
         //document.getElementById("error_email").style.display='block';
         document.getElementById("error_state").innerHTML="Only alphanumeric allowed"
        document.getElementById("txt_state").focus();
        return false;
    } 
      if(trim_string_str(document.getElementById("txt_city").value)!="")
    if(!alphanumeric(document.getElementById("txt_city").value))
    {
          $('#error_city').fadeIn('slow');
         //document.getElementById("error_email").style.display='block';
         document.getElementById("error_city").innerHTML="Only alphanumeric allowed"
        document.getElementById("txt_city").focus();
        return false;
    } 
    
    
     
    if(trim_string_str(document.getElementById("txt_zip").value)!="")
    if(!allnumeric(document.getElementById("txt_zip").value))
    {
          $('#error_zip').fadeIn('slow');
         //document.getElementById("error_email").style.display='block';
         document.getElementById("error_zip").innerHTML="Only numbers allowed"
        document.getElementById("txt_zip").focus();
        return false;
    } 
   window.form1.submit();
   
    
}
</script>