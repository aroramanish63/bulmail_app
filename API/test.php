<?php
session_start();
if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST['grab_coupan']) && !empty($_POST['grab_coupan'])) {
        if(isset($_POST['dc_captcha'])){                     
             $dc_name = $_POST['dc_name'];
             $dc_email = $_POST['dc_email'];
             $dc_contact = $_POST['dc_contact'];
             $add_date = date('Ymdhis');
//             if($_SESSION['captchaCode'] == $_POST['dc_captcha']){
                 
                 include 'app.php';                 
                 $siteConnect = new app(
                            array(
                                'site_id'=>'NEEwYUcxQWJ0QUFkMWExYTQxYmFnMVRUNg==',
                                'secret_key'=>'MWJBNWExMTAxVHRBYjU0'
                            )
                         );
                 
                 $siteConnect->curlRequest($_POST);
//                 include_once 'connect.php';
                 include_once 'upload.class.php';
                 require_once("/var/www/html/landingpage/PHPMailer/class.phpmailer.php");
                 $upload = new upload_class();
                 $file = $_FILES['userfile'];
//                 $image_name = $upload->handle_upload($file);
//                 if($image_name != ''){
//                     $sql = "INSERT INTO `discount_form_details`(`dc_name`,`dc_email`,`dc_contact`,`image_name`,`add_date`) VALUES('$dc_name','$dc_email','$dc_contact','$image_name','$add_date')";
                     if(1){
                            $_SESSION['discount_coupan'] = 'success';                         
                               
                                  $mail = new PHPMailer();
                                  $mail->IsSMTP();  
                                  $mail->SMTPAuth   = true; 


                                                $mail->SMTPSecure = "tls";
                                $mail->Port       = 25;                   
                                $mail->Host       = "103.10.189.48"; 
                                $mail->Username   = "support@go4hosting.com";     
                                $mail->Password   = "H24!@#IU*&//";            


                                        $header  = "MIME-Version: 1.0";
                                        $header .= "Content-type: text/html; charset: utf8";
                                    $subject="For Queries";
                                    $header.="from:Team Go4hosting <support@go4hosting.com>";
                                    $content="<br>";
                                        $content.= "Name: $dc_name <br/>";
                                        $content.= "Email: $dc_email <br/>";
                                        $content.= "Contact: $dc_contact <br/>";
//                                        $content.= "Url: $url <br/>";

                                    $content.="<br> <br>";


                                        $mail->SetFrom("support@go4hosting.com","Go4hosting");
                                        $mail->Subject  = "For Queries";
                                        $mail->MsgHTML($content);  
                                                $mail->AddAddress('aroramanish63@gmail.com');
                                    if($mail->Send())
                                           {
                                                  $msg = 'block';
                                                  $text = 'Thanks for successfully submission.';
                                                  $class= 'sucess';
                                           }

                                        $mail->ClearAllRecipients();
                     }
                     else
                     {
                            $msg = 'block';
                            $text = '* Form not submitted.';
                            $class= 'erorr';
                     }
//                 }
             

//                }
//                else{
//                        $msg = 'block';
//                        $text = '* Error in Captcha Code.';
//                        $class= 'erorr';
//                }
        }
}
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Discount Coupan</title>
<script type="text/javascript">
    /**
 * Comment
 */

<?php  if(isset($_SESSION['discount_coupan']) && !empty($_SESSION['discount_coupan'])){  ?>
    document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block';
    
<?php unset($_SESSION['discount_coupan']); } ?>
    
function clearerrors() {
    
        document.getElementById('nameerror').innerHTML = '';
        document.getElementById('emailerror').innerHTML = '';
        document.getElementById('contacterror').innerHTML = '';
        document.getElementById('fileerror').innerHTML = '';
        document.getElementById('captchaerror').innerHTML = '';
//        
//            document.getElementById('dc_name').style.border = '1px solid #cccccc'; 
//            document.getElementById('dc_email').style.border = '1px solid #cccccc';
//            document.getElementById('dc_contact').style.border = '1px solid #cccccc';
//            document.getElementById('file_browse').style.border = '1px solid #cccccc';
//            document.getElementById('dc_captcha').style.border = '1px solid #cccccc';
}

/**
 * Comment
 */
function setError(elementid,errorid,errormsg) {
//        document.getElementById(elementid).style.border='1px solid #FF0000';
        document.getElementById(elementid).focus();
        document.getElementById(errorid).className = 'erorr';
        document.getElementById(errorid).innerHTML = errormsg;
}
/**
 * Show file browse name on image
 */
function showname(val) {
    console.log(val.length);
    if(val.length > 15){        
        document.getElementById('filename').innerHTML = val.substring(0,16); ;
    }
    else
        document.getElementById('filename').innerHTML = val;
}
	function validate(){                
            clearerrors();			
		var dc_name = document.getElementById('dc_name').value;
		var dc_email = document.getElementById('dc_email').value;
		var dc_contact = document.getElementById('dc_contact').value;
		var file_browse = document.getElementById('file_browse').value;
		var dc_captcha = document.getElementById('dc_captcha').value;
		
		if(dc_name == '' || dc_name.replace(/\s+$/, '') == ''){
                                setError('dc_name','nameerror','Enter your name.');
                                return false;
		}
		if(dc_email == '' || dc_email.replace(/\s+$/, '') == ''){
                                 setError('dc_email','emailerror','Enter your email.');
				return false;
						
			}
			else{
                                if(!checkEmail('dc_email')){
                                    setError('dc_email','emailerror','Enter valid email.');							
                                        return false;
                                }
			}
		if(dc_contact == '' || dc_contact.replace(/\s+$/, '') == ''){
                        setError('dc_contact','contacterror','Enter your contact no.');
			return false;
		}
		else{
			regexp = /^[0-9]+$/;
			if(dc_contact.match(regexp)){
				
			}
			else{
                                setError('dc_contact','contacterror','Enter valid contact no.');
				return false;
			}
		}

		if(file_browse == '' || file_browse.replace(/\s+$/, '') == ''){
                        setError('file_browse','fileerror','Please upload your ID Proof.');
			return false;
		}
                else{                    
                    var re = /(\.jpg|\.jpeg|\.bmp|\.gif|\.png)$/i;
                    if(!re.exec(file_browse))
                    {
                        setError('file_browse','fileerror','Please upload .jpg, .jpeg, .png, .gif extension file.');
			return false;
                    }
                }
		
		if(dc_captcha == '' || dc_captcha.replace(/\s+$/, '') == ''){
                         setError('dc_captcha','captchaerror','Enter captcha code.');
			return false;
		}
		
		window.clouddiscountform.submit();
	}
	
function checkEmail(elementid) {
        var email = document.getElementById(elementid);
        var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (!filter.test(email.value)) {
            return false;
        }
        else{
            return true;
        }
    }
	

</script>
<style type="text/css">
body{
	margin:0px;
}

.landingpagebg {
	background:  url(images/bg1.jpg) no-repeat center top;
	min-height:500px;
	background-color:#fefef6;
}
.landingpagecontainer {
	width: 1100px;
	margin:0px auto 0px auto;
	padding:70px 0px 0px 0px;
	overflow:hidden;
}

.landingpagecontainer .leftcontent {
	width:640px;
	float:left;
	margin:0px 50px 0px 50px;
	text-align:center;
}

.landingpagecontainer .leftcontent h2 {
	margin:0px 0px 30px 0px;
	padding:0px 0px 15px 0px;
	color:#063959;
	font-size:30px;
	font-family:Arial;
	font-weight:bold;
	text-transform:uppercase;
	line-height:40px;
	border-bottom:1px solid #3079a8;
}
.landingpagecontainer .leftcontent h2 span {
	margin:0px;
	padding:0px;
	color:#ffffff;
	font-size:20px;
	font-family:Arial;
	font-weight:normal;
	text-transform:uppercase;
}

.landingpagecontainer .leftcontent h3 {
	margin:0px 0px 30px 0px;
	padding:0px 0px 15px 0px;
	color:#ffffff;
	text-shadow: 3px 3px #114769;
	font-size:42px;
	font-family:Arial;
	font-weight:bold;
	text-transform:uppercase;
	line-height:40px;
	letter-spacing:-1px;
}

.landingpagecontainer .leftcontent h3 span {
	margin:0px;
	padding:0px;
	color:#ffffff;
	font-size:30px;
	text-shadow: 1px 1px #114769;
	font-family:Arial;
	font-weight:normal;
	text-transform:uppercase;
}

.landingpagecontainer .leftcontent .contentmain {
	width:640;
	display:block;
	font-size:20px;
	font-family:Arial;
	color:#063959;
	margin-bottom:40px;
	line-height:50px;
}

.landingpagecontainer .rightcontent {
	width:320px;
	margin:30px 20px 0px 20px;
	float:left;
	text-align:center;	
}

.landingpagecontainer .rightcontent .discountform {
	margin:0px 0px 0px 15px;
	padding:0px;
	list-style:none;
	text-align:left;
}

.landingpagecontainer .rightcontent .discountform li {
background:  url(images/form-field-bg.png) no-repeat left top;
padding:0px 0px 20px 0px;
height:54px;
}


.landingpagecontainer .rightcontent .discountform li #file_browse_wrapper {
    width: 127px;
    height: 50px;
    background: url('images/file_browse_normal.png') 0 0 no-repeat;
    border:none;
    overflow:hidden;
	float:right;
	margin-right:18px;
}

.landingpagecontainer .rightcontent .discountform li #file_browse{
    margin-left:-105px;
	height:50px;
	cursor:pointer;
	 opacity:0.0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
}

.landingpagecontainer .rightcontent .discountform li .msg {
	font-size:11px;
	color:#333333;
	font-family:Arial;
	line-height:12px;
	float:left;
	margin:10px 0px 10px 0px;
}
.landingpagecontainer .rightcontent .discountform li .textfield1 {
	width:280px;
	margin:0px 0px 0px 7px;
	height:50px;
	line-height:50px;
	background-color:transparent;
	border:none;
	font-size:18px;
	color:#2f3e46;
	font-family:Arial;
}
.landingpagecontainer .rightcontent .discountform li .code
{
	width:90px;
	float:left;
	padding:5px;
	background-color:#ffffff;
	margin:5px;
	height:30px;
	line-height:30px;
	font-size:22px;
	font-weight:bold;
	text-align:center;
}
.landingpagecontainer .rightcontent .discountform li .textfield2 {
	width:170px;
	margin:0px 0px 0px 15px;
	height:50px;
	line-height:50px;
	background-color:transparent;
	border:none;
	font-size:18px;
	color:#2f3e46;
	font-family:Arial;
}
.landingpagecontainer .rightcontent .discountform li .submitbutton {
	width:287px;
	background:  url(images/form-button.png) no-repeat left top;
	height:54px;
	border:none;
	font-size:18px;
	color:#ffffff;
	text-shadow:1px 1px #000000;
	font-family:Arial;
	font-weight:bold;
	cursor:pointer;
	text-transform:uppercase;
	
}
.landingpagecontainer .rightcontent h3 {
	font-family:Arial;
	text-transform:uppercase;
	font-size:28px;
	font-weight:bold;
	color:#000000;
	margin:0px 0px 30px 0px;
	padding:0px;
}

.landingpagecontainer .rightcontent h3 span {
	font-family:Arial;
	text-transform:uppercase;
	font-size:24px;
	font-weight:normal;
	color:#000000;
}

.landingpagecontainer .rightcontent h3 .price {
	font-family:Arial;
	text-transform:uppercase;
	font-size:50px;
	font-weight:bold;
	color:#f15e22;
}


.landingpagecontainer .features {
	width: 1000px;
	float:left;
	text-align:center;
	margin:40px 50px 0px 50px;;
}
.landingpagecontainer .features h2 
	{
		font-family:Arial;
		text-transform:uppercase;
		position:absolute;
		font-weight:normal;
		color:#2e8dc9;
		font-size:30px;
		background-color:#ffffff;
		padding:5px;
		margin:-20px 0px 0px 415px;
	
	}

.landingpagecontainer .features ul {
	margin:0px;
	padding:0px;
	list-style:none;
	border-top:3px solid #509bcb;
}

.landingpagecontainer .features ul li {
	display:inline-block;
	background:  url(images/feature-partion.jpg) no-repeat right top;
	width:125px;
	float:left;
	text-align:center;
	font-family:Arial;
	text-transform:uppercase;
	font-weight:bold;
	font-size:16px;
	line-height:15px;
}

.landingpagecontainer .features ul li span {
	font-family:Arial;
	font-size:13px;
	font-weight:normal;
}
.landingpagecontainer .features ul li img {
	margin-bottom:15px;
}
.erorr{
	 color:#FF0000;
}
.sucess{
	 color:#0AD22A;
}



.profile-container {  background-color: white;
   
    border-radius: 10px;
    box-shadow: 0 0 10px #000;  left: 28%;
    min-height: 30%;
    overflow: hidden;
	height:500px;
   font-family: 'Square721BTRoman';
    position: absolute;
    top: 10%;
    width: 747px;
    z-index: 1002;
	}
	.black_overlay {
    background-color: black;
    
    height: 100%;
    left: 0;
    opacity: 0.9;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1001;
}
.popcontent { width:450px; margin:0 auto;  font-family: 'Square721BTRoman'; font-size:24px; color:#000; text-align:center;}
.popcontent h2 { font-size:50px; font-family: 'Square721BTBold'; color:#f15e22; margin:0; padding:0; }
.popcontent  li { width:100%; float:left; border-bottom:1px solid #cccccc; padding:20px 0 20px 0; list-style:none;}
</style>
</head>

<body>
    
    <!--POP UP START HERE-->

<div class="profile-container" id="light" style="display:none;">
  
   <a onclick="document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none';if(document.getElementById('upd').value=='1')location.reload();" href="javascript:void(0)" style="float:right; margin:-2px -1px 0 0 !important;">
        
       <img src="images/close.png">
        
        </a>
        
        <div style="clear:both; height:0px;"></div>
         <ul class="popcontent">
         <li>to avail this offer, use this coupon code</li>
         
          <li><h2>F36VY6HNK2</h2></li>
          
          <li>valid till 7-1-2014 to 22-1-2014<br />
for cloud INR products</li>

<li style="border-bottom:none;"><a href="#"><img src="images/click-processedbut.jpg"  alt="#" /></a></li>
         
         </ul>
         
         
   </div>
<div class="black_overlay" id="fade" style="display: none;"></div>
<!--POP UP END HERE-->
    
<div class="landingpagebg">
<div class="landingpagecontainer">
<div class="leftcontent"><h2><span>You have seen best of</span><br />
Amazon, Rackspace, and Egnyte!!!</h2>
<h3><span>Now Experience the</span><br />
advanced Cloud platform</h3>
<div class="contentmain">
WITH<br />
<img src="images/cloudoye.png" width="306" height="58" alt="CloudOYE" title="CloudOYE" /></div> <img src="images/server.png" width="569" height="268" alt="CloudOYE Server" title="CloudOYE Server" />
</div>


<div class="rightcontent"><h3><span>Fill the form and get</span><br />
<span class="price">RS.2000/-</span><br />
discount coupon</h3>
    <span id="msg" class="<?php echo isset($class) ? $class: ''; ?>" style="display:<?php if(isset($msg)) echo $msg; else echo 'none'; ?>;"><?php echo isset($text) ? $text : ''; ?></span>
    <form name="clouddiscountform" id="clouddiscountform" enctype="multipart/form-data" method="post" action="#" onsubmit="return validate();">
        <ul class="discountform" >
        <li><input name="dc_name" id="dc_name" type="text" class="textfield1" placeholder="Name" />
        <span id="nameerror"></span>
        </li>
        <li><input name="dc_email" id="dc_email" type="text" class="textfield1" placeholder="Email ID" />
        <span id="emailerror"></span>
        </li>
        <li><input name="dc_contact" id="dc_contact" type="text" class="textfield1" placeholder="Contact Number" />
        <span id="contacterror"></span></li>
        <li> <div id='file_browse_wrapper'>
                <input type='file' name="userfile" id='file_browse' onchange="showname(this.value);" />                        
                    </div>
            <span id="filename" class="textfield1"></span>            
        <span class="msg">Please share your photo id and address proof to
        sign up for 'CloudOYE' journey </span>
           
        </li><br />
 <span id="fileerror"></span>
        <li><div class="code"><img src="http://localhost/landingpage/captcha.php" width="90px" height="30px"/></div><input name="dc_captcha" id="dc_captcha" type="text" class="textfield2" placeholder="Enter Code" />
        <span id="captchaerror"></span></li>
        <li><input name="grab_coupan" id="grab_coupan" type="submit" class="submitbutton" value="Grab the Coupon Code"  /></li>
        </ul>
    </form>
</div>






<div class="features">
<h2>Features</h2>
<ul>
<li><img src="images/pay-as-you-go.jpg" /><br />
Pay<br /><span>as you Go</span></li>
<li><img src="images/hourly-billing.jpg" /><br />
Hourly<br /><span>Billing</span></li>
<li><img src="images/self-management.jpg"/><br />
Self<br /><span>Management<br />Portal</span></li>
<li><img src="images/uptime.jpg" /><br />
100%<br /><span>Uptime<br />Guaranteed</span></li>
<li><img src="images/rapid-scalability.jpg" /><br />
Rapid<br /><span>Scalability</span></li>
<li><img src="images/ultra-secured.jpg" /><br />Ultra<br /><span>Secured Data</span></li>
<li><img src="images/cloud-storage.jpg" /><br />Cloud<br /><span>Storage</span></li>
<li style="background:none"><img src="images/cdn.jpg" /><br />CDN</li>
</ul>
<img src="images/some-thing-beyond.jpg" style="margin:30px 0px 30px 0px"/></div>
</div>
</div>
</body>
</html>
