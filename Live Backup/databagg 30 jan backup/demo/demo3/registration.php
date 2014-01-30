<?php
session_start();
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
    
    $check_user="select * from tab_members where txt_email='".mysql_real_escape_string($_REQUEST['txt_email'])."'";
    $result_check_user=mysql_query($check_user) or die(mysql_error());
    $fetch_detail=mysql_fetch_array($result_check_user);
    
    
    $_SESSION['user_id']=$fetch_detail['int_id'];
        $_SESSION['user_mail_for_feed']=$_REQUEST['txt_email'];
        $_SESSION['user_fname_for_feed']=$_REQUEST['txt_first_name'];
          $_SESSION['verified']='false';
    

    header("Location:user/nindex.php");
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
<meta name="google-site-verification" content="zEL3MwzMYCf3OIz62XAEtXN1jPs8V6QLqibRye5fGEE" />

<title>Databagg</title>

<link href='https://fonts.googleapis.com/css?family=PT+Sans:400' rel='stylesheet' type='text/css'>
<link href="App_Theme/newstyle.css" rel="stylesheet" type="text/css" />
<link href="App_Theme/help.css" rel="stylesheet" type="text/css" />
<script src="user/js/jquery.js" type="text/javascript"></script>

<!--[if IE]>
<link href="App_Theme/ie.css" rel="stylesheet" type="text/css" />

<![endif]-->
</head>
<body <?php if($err_msg) { ?> onload = "autoHide();" <?php } ?>">
<div class="loginpage">
<div class="mid_container">
<div class="form_outoor">
<!--form left content start here-->
	<div class="form_leftcontent2">
    <div class="createaccount_logo"><a href="index.php"> <img src="images/sign_logo.jpg" width="298" height="114" alt="#" /></a></div>
    <div class="feature-text">
<h3>Features of Our Free Account</h3>

<ul>
<li><span><img alt="" src="images/help/user.png"></span>1 User</li>
<li><span><img alt="" src="images/help/webstorage.png"></span>5 GB+ of web-storage</li>
<li><span><img alt="" src="images/help/filesize.png"></span>250 MB file size limit</li>
<li><span><img alt="" src="images/help/sync.png"></span>Sync desktop files</li>
<li><span><img alt="" src="images/help/sharing.png"></span>Simple sharing and collaboration </li>
</ul>

</div>

<div class="callus">
<span>Need help deciding? Call</span> <br>
1-888-885-4570
</div>

<div class="mailus">
<span>MAIL TO </span><br/>
<a href=
"mailto:sales@databagg.com">sales@databagg.com</a>
</div>
    <!--<div class="form_social"><a href="#"><img src="images/login-fb.jpg" width="201" height="41" alt="#" /></a></div>
     <div class="form_social"><a href="#"><img src="images/login-twitter.jpg" width="201" height="41" alt="#" /></a></div>-->
     </div>
     
     
     <!--form left content2 end here-->
     
     
     
     
     <div class="form_right">
     <div class="cr-img"><img src="images/createaccount-img.jpg" width="437" height="65" alt="#" /></div>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="frm" name="frm">
       <div class="formrows">
        <center>
<span id="error_fname" class="login_error" style="display: none; top:95px; left:50px;">
 Enter first name
</span>
</center>

  <input type="text" id="txt_first_name" name="txt_first_name"  onfocus="this.select()"
 class="inputfirst" value="First Name" />
 <center>
<span id="error_lname" class="login_error" style="display: none;top:95px; left:300px;">
Enter last name
</span>
</center>

 <input type="text" id="txt_last_name" name="txt_last_name"  onfocus="this.select()" class="inputlastname" value="Last Name"  />

 </div>
 <div class="formrows">
  <input type="text" id="txt_email" name="txt_email" onFocus="this.select()"
 class="emailinput" value="Email Address" /></div>
 
 <center>
<span id="error_email" class="login_error" style="display:none; top:190px; left:145px;">
Enter your email
</span>
</center>
 
 <div class="formrows-content">
 
    <input type="password" id="txt_password" name="txt_password" onKeyPress="if(event.keyCode==13) {validate();}" value="Your Password" onClick="if(this.value=='Your Password')javascript:this.value='';" onFocus="this.select()"
 class="passinput" />
 </div>
 <center>
<span id="error_password" class="login_error" style="display: none;top:280px; left:145px;">
Choose a password.
</span>
</center>

 <div class="formrows-content">
<div class="submit-lchre-help"><span><input name="" id="check_agreement" type="checkbox"  value="" checked="checked" /></span> <span> I agree to the <a href="privacy-policy.php"><strong>Data Bagg Policy</strong></a><strong></strong></span> </div></div>


 <div class="submit-but"><img src="images/signin.png" width="151" height="56" alt="" onClick="validate();" style="cursor: pointer;" /></div>

    </form>
     
     
     </div>
  <div><img src="images/trutee.jpg" width="223" height="76" alt="#" /></div>

</div>

<div class="footer-login">
<div class="footer-loginleft">
<div class="footerlogin_logo"><img src="images/loginfooter-logo.jpg"  alt="#" /></div>
<div class="footerlogin-message">Already have an account? <strong><a href="login.php">Sign in</a></strong></div>

</div>

<div class="footerlogin_right">
<div class="connect-img"><img src="images/connecttext.jpg" width="165" height="61" alt="#" /></div>
<ul class="social_link">

<li><a href="https://www.facebook.com/Databagg" target="_blank"><img src="images/facebook.png" width="30" height="30" alt="#" /></a></li>
<li><a href="https://plus.google.com/117226672667714086519/posts?hl=en-GB" target="_blank"><img src="images/gplus.png" width="30" height="30" alt="#" /></a></li>
<li><a href="https://twitter.com/DataBagg" target="_blank"><img src="images/twitter.png" width="30" height="30" alt="#" /></a></li>
<li><a href="https://in.linkedin.com/pub/databagg/62/9b4/570" target="_blank"><img src="images/in.png" width="30" height="30" alt="#" /></a></li>


</ul>
</div>


</div>
</div>



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