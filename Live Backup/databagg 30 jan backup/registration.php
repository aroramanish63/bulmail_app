<?php
session_start();
include("connect.php");
include("function.php");
error_reporting(0);

if(!strstr($_SERVER["HTTP_REFERER"],"databagg.com"))
	{
	//die("invalid request");
	}

if(isset($_REQUEST['txt_first_name']) && strstr($_SERVER["HTTP_REFERER"],"databagg.com"))
{
     
    $emailadd=filter_var($_REQUEST['txt_email'], FILTER_VALIDATE_EMAIL);
	if(!$emailadd)
		{
		echo "<script>window.location.replace('./');</script>";
		exit;
		}
    
    
    $check_exists_email="select * from tab_members where txt_email='".$emailadd."'";
    $result_check=mysql_query($check_exists_email) or die(mysql_error());
    if(mysql_num_rows($result_check)>0 || isGmailUser($emailadd))
    {
        echo "<script>window.location.href='registration.php';</script>";
        die();
    }
    
   
   if(isset($_REQUEST['hidden_trial']))
    
   {
    $insert_detail="insert into tab_members (txt_first_name,txt_last_name,txt_email,txt_username,txt_usertype,txt_password,int_reg_date,is_trial,int_space_allotted,int_add_date,int_add_time) 
    values('".mysql_real_escape_string(trim($_REQUEST['txt_first_name']))."','".mysql_real_escape_string(trim($_REQUEST['txt_last_name']))."',
    '".mysql_real_escape_string(trim($emailadd))."','".mysql_real_escape_string(trim($emailadd))."',
    'free','".mysql_real_escape_string(base64_encode(trim($_REQUEST['txt_password'])))."','".time()."',1,104857600," . date("Ymd") . "," . date("His") . ")";
    }
    else if(isset($_REQUEST['hidden_trial_limit']))
    {
        $insert_detail="insert into tab_members (txt_first_name,txt_last_name,txt_email,txt_username,txt_usertype,txt_password,int_reg_date,is_trial,int_space_allotted,int_add_date,int_add_time) 
    values('".mysql_real_escape_string(trim($_REQUEST['txt_first_name']))."','".mysql_real_escape_string(trim($_REQUEST['txt_last_name']))."',
    '".mysql_real_escape_string(trim($emailadd))."','".mysql_real_escape_string(trim($emailadd))."',
    'free','".mysql_real_escape_string(base64_encode(trim($_REQUEST['txt_password'])))."','".time()."',1,10240," . date("Ymd") . "," . date("His") . ")";
        
    }
    else
    {
         $insert_detail="insert into tab_members (txt_first_name,txt_last_name,txt_email,txt_username,txt_usertype,txt_password,int_reg_date,int_add_date,int_add_time) 
    values('".mysql_real_escape_string(trim($_REQUEST['txt_first_name']))."','".mysql_real_escape_string(trim($_REQUEST['txt_last_name']))."',
    '".mysql_real_escape_string(trim($emailadd))."','".mysql_real_escape_string(trim($emailadd))."',
    'free','".mysql_real_escape_string(base64_encode(trim($_REQUEST['txt_password'])))."','".time()."'," . date("Ymd") . "," . date("His") . ")";
        
    }
   
   
   
   
   
    mysql_query($insert_detail) or die(mysql_error());
    
    //mail to user
    $nm=$_REQUEST['txt_first_name']; 
    //$em_enc=base64_encode($emailadd);
    mail_verify($emailadd,$nm);
    mail_welcome($emailadd,$nm);
    
    $check_user="select * from tab_members where txt_email='".mysql_real_escape_string($emailadd)."'";
    $result_check_user=mysql_query($check_user) or die(mysql_error());
    $fetch_detail=mysql_fetch_array($result_check_user);
    
    
    $_SESSION['user_id']=$fetch_detail['int_id'];
        $_SESSION['user_mail_for_feed']=$emailadd;
        $_SESSION['user_fname_for_feed']=$_REQUEST['txt_first_name'];
          $_SESSION['verified']='false';
    

    header("Location:download.php");
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

<!--[if IE 7]>
<link rel="stylesheet" href="App_Theme/ie7.css" type="text/css" media="screen"/>
<![endif]-->

<!--[if IE 8]>
<link rel="stylesheet" href="App_Theme/ie8.css" type="text/css" media="screen"/>
<![endif]-->

<script type="text/javascript">
  var __lc = {};
  __lc.license = 1373462;
  __lc.skill = 3;

  (function() {
    var lc = document.createElement('script'); lc.type = 'text/javascript'; lc.async = true;
    lc.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.livechatinc.com/tracking.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(lc, s);
  })();
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45624857-1', 'databagg.com');
  ga('send', 'pageview');

</script>

</head>

<body>

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
<li><span><img alt="" src="images/help/filesize.png"></span>2 GB file size limit</li>
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
     
     <style>
     div.hint {
	font-family: 'PT Sans', sans-serif;
	font-size:14px;
	
	background:url(images/errorbg.jpg) repeat-x #3d85a5;
	color:#FFF;
	position:absolute;
	
	text-align:center;
     border: 2px solid #FFF;
	padding:10px 5px 10px 10px;
	min-width:200px;
	
	margin: 10px 0 0 210px;
	display:none;
  box-shadow:0 0 5px #9a9a9a;
}
div.hint1 {
	font-family: 'PT Sans', sans-serif;
	font-size:14px;
	
	background:url(images/errorbg.jpg) repeat-x #3d85a5;
	color:#FFF;
	position:absolute;
	
	text-align:center;
     border: 2px solid #FFF;
	padding:10px 5px 10px 10px;
	min-width:200px;
	position:absolute;
	margin: 0px 0 0 210px;
	display:none;
     box-shadow:0 0 5px #9a9a9a;
}
div.hint2 {
		font-family: 'PT Sans', sans-serif;
	font-size:14px;
	
	background:url(images/errorbg.jpg) repeat-x #3d85a5;
	color:#FFF;
	position:absolute;
	
	text-align:center;
     border: 2px solid #FFF;
	padding:10px 5px 10px 10px;
	min-width:200px;
	position:absolute;
	margin: 70px 0 0 210px;
	display:none;
     box-shadow:0 0 5px #9a9a9a;
}
div.hint3 {
		font-family: 'PT Sans', sans-serif;
	font-size:14px;
	
	background:url(images/errorbg.jpg) repeat-x #3d85a5;
	color:#FFF;
	position:absolute;
	
	text-align:center;
     border: 2px solid #FFF;
	padding:10px 5px 10px 10px;
	min-width:200px;
	position:absolute;
	margin: 130px 0 0 210px;
	display:none;
     box-shadow:0 0 5px #9a9a9a;
}

div.hint4 {
		font-family: 'PT Sans', sans-serif;
	font-size:14px;
	
	background:url(images/errorbg.jpg) repeat-x #3d85a5;
	color:#FFF;
	position:absolute;
	
	text-align:center;
     border: 2px solid #FFF;
	padding:10px 5px 10px 10px;
	min-width:200px;
	position:absolute;
	margin: 192px 0 0 210px;
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
     <!--form left content2 end here-->
     
     
     
     
     <div class="form_right" style="width: 470px;">
     <div class="cr-img"><img src="images/createaccount-img.jpg" width="437" height="65" alt="#" /></div>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="frm" name="frm">
       <div class="formrows">
        <center>

</center>

  <input type="text" id="txt_first_name" name="txt_first_name"  class="inputfirst" placeholder="First Name" onFocus="checkEmptyValue(this,'First Name')"  autocomplete="off" />
  
 <center>

</center>

 <input type="text" id="txt_last_name" name="txt_last_name"  class="inputlastname" placeholder="Last Name" onFocus="checkEmptyValue(this,'Last Name')" autocomplete="off" />

 </div>
 <div id="error_fname"  class="hint">
 <div class="arrow-left"></div>Please enter your first name.
</div>
<div id="error_lname"  class="hint1">
<div class="arrow-left"></div>Please enter your last name.
</div>
 <div class="formrows">
  <input type="text" id="txt_email" name="txt_email" class="emailinput" placeholder="Email Address" onFocus="checkEmptyValue(this,'Email Address')" autocomplete="off" /></div>
 <div id="error_email"  class="hint2">
<div class="arrow-left"></div>Please enter your email address
</div>

 
 <div class="formrows-content" style="margin-bottom:15px;">
 
    <input type="password" id="txt_password" name="txt_password" onKeyPress="if(event.keyCode==13) {validate();}" placeholder=" Password"  onfocus="checkEmptyValue(this,'Your Password')"
 class="passinput" autocomplete="off" />
 </div>
 
 <div class="formrows-content">
 
    <input type="text" id="txt_phonenumber" name="txt_phonenumber" onKeyPress="if(event.keyCode==13) {validate();}" placeholder=" Phone Number"  onfocus="checkEmptyValue(this,'Your Password')"
 class="passinput"  autocomplete="off" />
 </div>
 <div id="error_phone" class="hint4">
<div class="arrow-left"></div>Please enter  your phonenumber.
</div>
 
 
 
 
 <center>
<div id="error_password" class="hint3">
<div class="arrow-left"></div>Please enter  your phonenumber.
</div>
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

function checkEmptyValue(obj,defval)
	{
	if(obj.value.toLowerCase()==defval.toLowerCase())
		obj.value="";
	else
		obj.select()
	}
    
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
    $( '#error_fname' ).animate({"left":"-150px"}, "slow");
    $( '#error_lname' ).animate({"left":"-150px"}, "slow");
    $( '#error_email' ).animate({"left":"-150px"}, "slow");
    $( '#error_password' ).animate({"left":"-150px"}, "slow");
    document.getElementById("error_fname").style.display='none';
    document.getElementById("error_lname").style.display='none';
    document.getElementById("error_email").style.display='none';
    document.getElementById("error_password").style.display='none';
	
   
    if(trim_string_str(document.getElementById("txt_first_name").value)=="First Name")
    {
        document.getElementById("txt_first_name").value="";
        
    }
    
    if(trim_string_str(document.getElementById("txt_first_name").value)=="")
    {
        //document.getElementById("error_fname").style.display='block';
      
       $('#error_fname').fadeIn('slow');
       $( '#error_fname' ).animate({"left":"150px"}, "slow");
        document.getElementById("txt_first_name").focus();
        return false;
    }
    if(!specialcharecter(document.getElementById("txt_first_name").value))
    {
         //document.getElementById("error_fname").style.display='block';
         $('#error_fname').fadeIn('slow');
         $( '#error_fname' ).animate({"left":"150px"}, "slow");
         document.getElementById("error_fname").innerHTML="<div class='arrow-left'></div>Please enter alphabetic characters only."
        document.getElementById("txt_first_name").focus();
        return false;
    }
    
    if(trim_string_str(document.getElementById("txt_first_name").value).length>25  )
    {
      
     $('#error_fname').fadeIn('slow');
     $( '#error_fname' ).animate({"left":"150px"}, "slow");
         document.getElementById("error_fname").innerHTML="<div class='arrow-left'></div>First name must be less than 25 characters.";
        document.getElementById("txt_first_name").focus();
        return false;
    }
     if(trim_string_str(document.getElementById("txt_last_name").value)=="Last Name")
    {
        document.getElementById("txt_last_name").value="";
        
    }
    
     if(trim_string_str(document.getElementById("txt_last_name").value)=="")
    {
        //document.getElementById("error_lname").style.display='block';
        $('#error_lname').fadeIn('slow');
        $( '#error_lname' ).animate({"left":"150px"}, "slow");
        document.getElementById("txt_last_name").focus();
        return false;
    }
    
     if(!specialcharecter(document.getElementById("txt_last_name").value))
    {
         //document.getElementById("error_lname").style.display='block';
          $('#error_lname').fadeIn('slow');
           $( '#error_lname' ).animate({"left":"150px"}, "slow");
         document.getElementById("error_lname").innerHTML="<div class='arrow-left'></div>Please enter alphabetic characters only.";
        document.getElementById("txt_last_name").focus();
        return false;
    }
    
     if(trim_string_str(document.getElementById("txt_last_name").value).length>25  )
    {
      
      $('#error_lname').fadeIn('slow');
       $( '#error_lname' ).animate({"left":"150px"}, "slow");
         document.getElementById("error_lname").innerHTML="<div class='arrow-left'></div>Last name must be less than 25 characters.";
        document.getElementById("txt_last_name").focus();
        return false;
    }
    if(trim_string_str(document.getElementById("txt_email").value)=="")
    {
         $('#error_email').fadeIn('slow');
         $( '#error_email' ).animate({"left":"150px"}, "slow");
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
                  $( '#error_email' ).animate({"left":"150px"}, "slow");
                //document.getElementById("error_email").style.display='block';
                document.getElementById("error_email").innerHTML="<div class='arrow-left'></div>Please enter a valid email address.";
              document.getElementById("txt_email").focus();
                return false;
             }
    }
    if(!specialcharecterforemail(document.getElementById("txt_email").value))
    {
          $('#error_email').fadeIn('slow');
           $( '#error_email' ).animate({"left":"150px"}, "slow");
         //document.getElementById("error_email").style.display='block';
         document.getElementById("error_email").innerHTML="<div class='arrow-left'></div>Please enter a valid email address."
        document.getElementById("txt_email").focus();
        return false;
    }
  
    if(trim_string_str(document.getElementById("txt_password").value)=="Your Password")
    {
        document.getElementById("txt_password").value="";
        
    }
    
    
    
    if(trim_string_str(document.getElementById("txt_password").value)=="")
    {
        $('#error_password').fadeIn('slow');
        $( '#error_password' ).animate({"left":"150px"}, "slow");
        document.getElementById("error_password").style.display='block';
        document.getElementById("txt_password").focus();
        return false;
    }
     if(trim_string_str(document.getElementById('txt_password').value).length<8 || trim_string_str(document.getElementById('txt_password').value).length>21 )
    {
      
     $('#error_password').fadeIn('slow');
     $( '#error_password' ).animate({"left":"150px"}, "slow");
    document.getElementById('error_password').innerHTML="<div class='arrow-left'></div>Please enter a password between 8 and 20 characters.";
    
        document.getElementById("txt_password").focus();
        return false;
    
       }
	
var rx=/^\d{10}$/;
var rxres=rx.test(trim_string_str(document.getElementById('txt_phonenumber').value));
	
     if(trim_string_str(document.getElementById('txt_phonenumber').value).length>0 && rxres==false)
    {
      
     $('#error_phone').fadeIn('slow');
     $( '#error_phone' ).animate({"left":"150px"}, "slow");
    document.getElementById('error_phone').innerHTML="<div class='arrow-left'></div>Please enter a valid phone number.";
    
        document.getElementById("txt_phonenumber").focus();
        return false;
    
       }
    if(document.getElementById("check_agreement").checked==false)
    {
        alert("Please agree to the terms of service");
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
                          $( '#error_email' ).animate({"left":"150px"}, "slow");
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
                            document.getElementById('long_pass').style.display="none";
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