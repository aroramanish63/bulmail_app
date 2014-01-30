<?php
if(!isset($_REQUEST['type']))
header("Location:pricing.html");
include("connect.php");
include("function.php");
error_reporting(0);
if($_REQUEST['txt_first_name'])
{
    $insert_detail="insert into tab_members (txt_first_name,txt_last_name,txt_email,txt_username,txt_usertype,txt_password,int_reg_date) 
    values('".mysql_real_escape_string(trim($_REQUEST['txt_first_name']))."','".mysql_real_escape_string(trim($_REQUEST['txt_last_name']))."',
    '".mysql_real_escape_string(trim($_REQUEST['txt_email']))."','".mysql_real_escape_string(trim($_REQUEST['txt_email']))."',
    'free','".mysql_real_escape_string(base64_encode(trim($_REQUEST['txt_password'])))."','".time()."')";
    
    mysql_query($insert_detail) or die(mysql_error());
    
    //mail to user
    $nm=$_REQUEST['txt_first_name']; 
    //$em_enc=base64_encode($_REQUEST['txt_email']);
    mail_verify($_REQUEST['txt_email'],$nm);
    mail_welcome($_REQUEST['txt_email'],$nm);
    

    header("Location:login.php?msg=1");
    //end mail to user
    
    
    
    ?>
        <script>
        location.href="login.php?msg=1";
        </script>
        <?php
}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico" /> 
<link rel="shortcut icon" type="image/x-icon" href="images/favicon_gif.gif" />
<link rel="shortcut icon" type="image/png" href="images/favicon_png.png" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Databagg</title>

<link href='http://fonts.googleapis.com/css?family=PT+Sans:400' rel='stylesheet' type='text/css'>
<link href="App_Theme/mainstyle.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div class="mainpageheader">
<div class="databag-menu-login">
  <img src="images/loginlogo.png" alt="" border="0" usemap="#Map"   />
  <map name="Map" id="Map">
    <area shape="circle" coords="376,49,23" href="index.php" />
    <area shape="rect" coords="250,78,492,141" href="index.php" />
  </map>
</div>
<script src="user/js/jquery.js" type="text/javascript"></script>
  
    <style>
     .login_error { width:211px; height:30px;  top:380px; margin-left:-50px; color:#FFF;
      font-family:Verdana, Geneva, sans-serif; padding:5px 0 0 0; background:url(image/errorrmess-img.png) no-repeat; position: absolute;  }
     </style>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="frm" name="frm">
  <div class="other-content">
  
    <div class="creataccount">
    
    <div class="creataccount-left"><img src="images/creat-acc-left.png" width="113" height="633" alt="" /></div>
    <div class="creataccount-middle">
    <div class="creataccount-middle-t-text">
    
       <div class="creataccount-banner"><img src="images/crimg.png" width="525" height="105" alt="" /></div>
       
       <div class="other-content-login-area-mainrgsitere">     
     	<div class="other-content-login-area-leftregis">First Name: </div>
        <div class="other-content-login-area-right">
        <input type="text" id="txt_first_name" name="txt_first_name"  onfocus="this.select()" class="rightinput"  /><img src="images/starIcon.png"/>
        </div>
     
     </div>
       <center>
<span id="error_fname" class="login_error" style="display: none;">
 Enter first name
</span>
</center>
       
       <div class="other-content-login-area-mainrgsitere">     
     	<div class="other-content-login-area-leftregis">Last Name: </div>
        <div class="other-content-login-area-right">
        <input type="text" id="txt_last_name" name="txt_last_name"  onfocus="this.select()" class="rightinput" /><img src="images/starIcon.png"/>
        </div>
     
     </div>
     <center>
<span id="error_lname" class="login_error" style="display: none;top:445px;">
Enter last name
</span>
</center>
     
     <div class="other-content-login-area-mainrgsitere">     
     	<div class="other-content-login-area-leftregis">Email Address:</div>
        <div class="other-content-login-area-right">
        <input type="text" id="txt_email" name="txt_email" onFocus="this.select()" class="rightinput" /><img src="images/starIcon.png"/>
        </div>
     
     </div>
     <center>
<span id="error_email" class="login_error" style="display: none;top:510px;">
Enter your email
</span>
</center>
     <div class="other-content-login-area-mainrgsitere">     
     	<div class="other-content-login-area-leftregis">Password: </div>
        <div class="other-content-login-area-right">
        <input type="password" id="txt_password" name="txt_password" onFocus="this.select()" class="rightinput" /><img src="images/starIcon.png"/>
        </div>
     
     </div>
       <center>
<span id="error_password" class="login_error" style="display: none;top:570px;margin-left:210px;">
Choose a password.
</span>
</center>
         <div class="submit-lchre"><span>
         <input type="checkbox"  id="check_agreement"  />
        
         </span> <span> I agree to the <a target="_blank" href="privacy-policy.html"><strong>DataBagg Policy</strong></a><strong></strong></span> </div>  
    
       <!-- <span>
        <table align='center'>
        <tr>
        <td>
         <img id="img_cap" src="php_captcha.php" />
         <a href="javascript:void(0);"  onClick="document.getElementById('img_cap').src='php_captcha.php'"><img title="Refresh" src="images/refresh-captcha.gif" /></a>
        </td>
        <td valign='top'>
        <input type="text" />
        </td>
        </tr>
        <tr>
        <td colspan="2">
        (Please enter the security code on left.)
        </td>
        </tr>
        </table>  
        
    </span>  -->
       
       
       
       <div class="submit-lctt"><img src="images/signin.png" width="151" height="56" alt="" onClick="validate();" style="cursor: pointer;" /></div>
         <div class="submit-lchrebottom">Already have an account? <strong><a href="login.php">Sign in</a></strong></div>
       
       
       
       
       
       
       </div>
    
    
    
    
    </div>
    <div class="creataccount-right"><img src="images/creat-acc-right.png" width="116" height="633" alt="" /></div>
    
    
    </div>
    
    
    
        
    
    
  <div style="clear:both"></div>
  
  </div>
  </form>
  
	
    <div style="clear:both"></div>
</div>














<div class="footer">

<div class="footer-in-top"> 
<ul>
<li><strong>Product</strong></li>
<li><a href="pricing.php">Pricing</a></li>
<li><a href="features.html">Features</a></li>
<li><a href="how-works.html">How it works</a></li><li><a href="registration.php?type=free">Download</a></li>

</ul>


<ul>
<li><strong>Company</strong></li>
<li><a href="about-us.html">About Us</a></li>               
<li><a href="blogs.html">Blogs</a></li>                       
<li><a href="news.html">News</a></li> 
<li><a href="press-release.html">Press Release</a></li>        

</ul>


<ul>
<li><strong>Learn More</strong></li>
<li><a href="support.html">Support</a></li>
<li><a href="help/index.php">Help</a></li>
<li><a href="tutorial.html">Tutorial</a></li>
<li><a href="privacy-policy.html">Privacy Policy</a></li>
</ul>




<div class="social-media">
<h2>Connect with us</h2>
	<div class="social-media-t">
    	
        <div class="social-media-t-l">
        	<div class="social-media-t-l-img"><img src="images/facebook.png" alt=""  /></div>
            	<div class="social-media-t-l-text"><a target="_blank" href="http://www.facebook.com/Databagg">Facebook</a></div>
        
        </div>
    
    
    
    <div class="social-media-t-r">
        	<div class="social-media-t-l-img"><img src="images/twitter.png" alt=""  /></div>
            	<div class="social-media-t-l-text"><a target="_blank" href="https://twitter.com/DataBagg">Twitter</a></div>
        
        </div>
    </div>
    
    
    
    
    
    <div class="social-media-b">
    	
        <div class="social-media-t-l">
        	<div class="social-media-t-l-img"><img src="images/gplus.png" alt=""  /></div>
            	<div class="social-media-t-l-text"><a target="_blank" href="https://plus.google.com/117226672667714086519/posts?hl=en-GB">Google+</a></div>
        
        </div>
    
    
    
    <div class="social-media-t-r">
        	<div class="social-media-t-l-img"><img src="images/in.png"  alt="" /></div>
            	<div class="social-media-t-l-text"><a target="_blank" href="http://in.linkedin.com/pub/databagg/62/9b4/570">Linkedin</a></div>
        
        </div>
    
    
    
    </div>
</div>

</div>
<div style="clear:both;"></div>
</div>


<div class="footer-in-bottom">    
 
   <div class="textfooter">Copyright &copy; 2013 <strong><a href="index.php">Data Bagg</a></strong>, Inc. All rights reserved.</div>
   
   	<div class="textfooterimg-right"> <a href="index.php"><img src="images/bottomlogo.png" alt="" border="0" /></a></div>
</div>
</body>
</html>








<script>
function specialcharecter(val)
{
re = /^[A-Za-z]+$/;
if(re.test(val))
{
return true;
}
else
{
return false;

}

}
//function specialcharecter(val)
//
//            {
//                val=val.toLowerCase();
//
//                var iChars = "abcdefghijklmnopqrstuvwxyz";   
//
//                var data = val;
//
//                for (var i = 0; i < data.length; i++)
//
//                {      
//
//                    if (iChars.indexOf(data.charAt(i)) != -1)
//
//                    {    
//
//                     return false; 
//
//                    } 
//
//                }
//                return true;
//
//            }
            
            function specialcharecterforemail(val)

            {
                
                var ck_email = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i 
                if (!ck_email.test(val)) 
                return false;
                else
                return true

              //  var iChars = "!`#$%^&*()+=-[]\\\';,/{}|\":<>?~";   
//
//                var data = val;
//
//                for (var i = 0; i < data.length; i++)
//
//                {      
//
//                    if (iChars.indexOf(data.charAt(i)) != -1)
//
//                    {    
//
//                     return false; 
//
//                    } 
//
//                }
//                return true;

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
    document.getElementById("error_email").style.display='none';
    document.getElementById("error_password").style.display='none';
    
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
    if(trim_string_str(document.getElementById("txt_email").value)=="")
    {
         $('#error_email').fadeIn('slow');
        //document.getElementById("error_email").style.display='block';
        document.getElementById("txt_email").focus();
        return false;
    }
     if(trim_string_str(document.getElementById("txt_email").value)!="")
    {
        var x=document.getElementById("txt_email").value;
        var atpos=x.indexOf("@");
        var dotpos=x.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
             {
                 $('#error_email').fadeIn('slow');
                //document.getElementById("error_email").style.display='block';
                document.getElementById("error_email").innerHTML="Enter valid email.";
              document.getElementById("txt_email").focus();
                return false;
             }
    }
    if(!specialcharecterforemail(document.getElementById("txt_email").value))
    {
          $('#error_email').fadeIn('slow');
         //document.getElementById("error_email").style.display='block';
         document.getElementById("error_email").innerHTML="Remove special chars"
        document.getElementById("txt_email").focus();
        return false;
    }
  
    
    
    
    if(trim_string_str(document.getElementById("txt_password").value)=="")
    {
        $('#error_password').fadeIn('slow');
        document.getElementById("error_password").style.display='block';
        document.getElementById("txt_password").focus();
        return false;
    }
    if(document.getElementById("check_agreement").checked==false)
    {
        alert("Please check the agreement");
        document.getElementById("check_agreement").focus();
        return false;
    }
    if(trim_string_str(document.getElementById("txt_email").value)!="")
    {
       check_email(document.getElementById("txt_email").value);
    }
    
}
function validatemail()
{

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

function check_email(str)
{
		var strURL="ajax_email_check.php?add="+str;
   // alert(strURL);
		var req = testXML();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					
					// only if "OK"
					if (req.status == 200) {
					
						
                        if(req.responseText.match(/failed/gi))
                        {
                            //alert(req.responseText);
                        //document.getElementById("error_email").style.display='block';
                        $('#error_email').fadeIn('slow');
                         document.getElementById("error_email").innerHTML="Email already exists."; 
                        document.getElementById('txt_email').focus();
                        return false;
                        
                        }
                        else
                        {
                            document.frm.submit();
                            document.getElementById("error_fname").style.display='none';
                            document.getElementById("error_lname").style.display='none';
                            document.getElementById("error_email").style.display='none';
                            document.getElementById("error_password").style.display='none';
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