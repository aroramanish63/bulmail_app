<?php
if(isset($_REQUEST['txt_feed_mail']))
{
    $comment="";
    $ans_grp_1="";
    $ans_grp_2="";
    $name=$_REQUEST['txt_feed_name'];
    $mail=$_REQUEST['txt_feed_mail'];
    $comment=$_REQUEST['txt_feed_comment'];
    if(!isset($_REQUEST['Field428']))
    $_REQUEST['Field428']='n';
    if(!isset($_REQUEST['Field429']))
    $_REQUEST['Field429']='n';
    if(!isset($_REQUEST['Field430']))
    $_REQUEST['Field430']='n';
    if(!isset($_REQUEST['Field431']))
    $_REQUEST['Field431']='n';
    if(!isset($_REQUEST['Field325']))
    $_REQUEST['Field325']='n';
    if(!isset($_REQUEST['Field326']))
    $_REQUEST['Field326']='n';
    if(!isset($_REQUEST['Field327']))
    $_REQUEST['Field327']='n';
    if(!isset($_REQUEST['Field328']))
    $_REQUEST['Field328']='n';
      
    $ans_grp_1.=$_REQUEST['Field428'];$ans_grp_1.="~";
    $ans_grp_1.=$_REQUEST['Field429'];$ans_grp_1.="~";
    $ans_grp_1.=$_REQUEST['Field430'];$ans_grp_1.="~";
    $ans_grp_1.=$_REQUEST['Field431'];
    
    $ans_grp_2.=$_REQUEST['Field325'];$ans_grp_2.="~";
    $ans_grp_2.=$_REQUEST['Field326'];$ans_grp_2.="~";
    $ans_grp_2.=$_REQUEST['Field327'];$ans_grp_2.="~";
    $ans_grp_2.=$_REQUEST['Field328'];
    
    
    $insert_feed="insert into tab_feedback values ('','$name','$mail','".$ans_grp_1."','".$ans_grp_2."','".$comment."')";
    mysql_query($insert_feed) or die($insert_feed);
    $msg="Thank you for your valuable feedback! ";
    
    
}

?>







  



    
    
<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>


<div class="container" style="font-family: 'PT Sans', sans-serif;">
<div class="fullcontainer">
<h1>FeedBack</h1>

<div class="fleft width" style="margin-top:20px;">
<hr >
</div>
 <div  class="fleft width">





<link href="css/form.css" rel="stylesheet">


<style>
.txt_ren {
border: 1px solid #999999;
box-shadow: 0 1px 1px rgba(0, 0, 0, 0.3), 0 0 0 #000000 inset;
height: 24px;
padding: 2px;
}
 .brt_ren{
          background:url(images/submitbg.jpg) no-repeat;
		  border:none;
	/*font-family: 'geoslab703_md_btbold';*/
	font-family: 'PT Sans', sans-serif;
	box-shadow:none !important;
    color: #FFF;
	font-weight:normal;
    cursor: pointer;
       font-size: 17px;
    margin-top: 15px;
	float:left;
    
    padding: 5px;
    pa
    text-align: center;
    width:89px;
	height:33px;
    border-radius: 3px;
        }
        
}
.info {
    border: 1px solid;
    margin: 10px 0px;
    padding:7px 10px 10px 14px;
    background-repeat: no-repeat;
    background-position: 10px center;
    color: #00529B;
    background-color: #BDE5F8;
    background-image: url('images/info.png');
    width: 350px;
}
</style>
<style>
textarea
{
   resize: none;
}
</style>
<div id="container" class="ltr">

<style>
.login{
	margin:5em auto;
	background:#fff;
	
	width:500px;
	
	-moz-box-shadow:0 0 10px #4e707c;
	-webkit-box-shadow:0 0 10px #4e707c;
	box-shadow:0 0 10px #4e707c;
	text-align:left;
	position:relative;
    margin-top:150px;
    height: 235px;
	}
    .login h1{
	background:#00A7E2;
	color:#fff;
	text-shadow:#007dab 0 1px 0;
	font-size:16px;
	padding:16px 0px;
	margin:0 0 1.5em 0;
	border-bottom:1px solid #007dab;
    width: 100%;
	}
</style>

<form id="form_feed" name="form_feed" class="wufoo  page" autocomplete="off" method="post" action="">

<?php
if(isset($msg))
{
    ?>
    <div style="margin-left: 15%;margin-top: 20px;" class="login">
    
    <h1 align="center">
    Thanks for your feedback !
    </h1>
    
    
    <br />
    <center>
    <p style="width: 60%;" align="center">
    We are listening, and your response will help us to improve the quality of Databagg ! <br /><br />
    so we appreciate you for giving us your valuable feedback and time.
    </p>
    <br />
    <img  src="images/bottomlogo.png"/>
    </center>
    
    </div>
    <?php
}
else
{
?>

<ul>

<li id="foli426" class="notranslate       ">
<label class="desc" id="title426" for="Field426">
Your Name <font color='red'>*</font>
</label>
<div style="float: left;">
<input type="text" readonly class="txt_ren" size="45" id="txt_feed_name" name="txt_feed_name" value="<?php echo $_SESSION['user_fname_for_feed']; ?>" />
</div>
<div id="err_name" style="color: red;">

</div>
</li>
<li id="foli426" class="notranslate       ">
<label class="desc" id="title426" for="Field426">
Your Email <font color='red'>*</font>
</label>
<div style="float: left;">
<input type="text" readonly class="txt_ren" size="45" id="txt_feed_mail" name="txt_feed_mail" value="<?php echo $_SESSION['user_mail_for_feed']; ?>" />
</div>
<div id="err_mail" style="color: red;">

</div>
</li>

<li id="foli428" class="likert notranslate 
col5
 ">
<table cellspacing="0">
 <p > 
    <span class="ui-tooltip"style="margin-left: 500px;" >Please have a look at these questions !</span> 
</p> 
<caption id="title428">
How satisfied were you with the following aspects of the Website?
</caption>
<thead>
<tr >
<th style="background-color: #15A0C8;color: #fff;">&nbsp;</th>
<td style="background-color: #15A0C8;color: #fff;" >Very Unsatisfied</td>
<td style="background-color: #15A0C8;color: #fff;">Unsatisfied</td>
<td style="background-color: #15A0C8;color: #fff;">Neutral</td>
<td style="background-color: #15A0C8;color: #fff;">Satisfied</td>
<td style="background-color: #15A0C8;color: #fff;">Very Satisfied</td>
</tr>
</thead>
<tbody>
<tr class="statement428">
<th><label for="Field428">Graphic Design</label></th>
<td title="Very Unsatisfied">
<input id="Field428_1" name="Field428" type="radio" tabindex="3"  value="Very Unsatisfied" />
<label for="Field428_1">1</label>
</td>
<td title="Unsatisfied">
<input id="Field428_2" name="Field428" type="radio" tabindex="4" value="Unsatisfied" />
<label for="Field428_2">2</label>
</td>
<td title="Neutral">
<input id="Field428_3" name="Field428" type="radio" tabindex="5" value="Neutral" />
<label for="Field428_3">3</label>
</td>
<td title="Satisfied">
<input id="Field428_4" name="Field428" type="radio" tabindex="6" value="Satisfied" />
<label for="Field428_4">4</label>
</td>
<td title="Very Satisfied">
<input id="Field428_5" name="Field428" type="radio" tabindex="7" value="Very Satisfied"  />
<label for="Field428_5">5</label>
</td>
</tr>
<tr class="alt statement429">
<th><label for="Field429">Ease of Navigation</label></th>
<td title="Very Unsatisfied">
<input id="Field429_1" name="Field429" type="radio" tabindex="8" value="Very Unsatisfied" />
<label for="Field429_1">1</label>
</td>
<td title="Unsatisfied">
<input id="Field429_2" name="Field429" type="radio" tabindex="9" value="Unsatisfied" />
<label for="Field429_2">2</label>
</td>
<td title="Neutral">
<input id="Field429_3" name="Field429" type="radio" tabindex="10" value="Neutral" />
<label for="Field429_3">3</label>
</td>
<td title="Satisfied">
<input id="Field429_4" name="Field429" type="radio" tabindex="11" value="Satisfied" />
<label for="Field429_4">4</label>
</td>
<td title="Very Satisfied">
<input id="Field429_5" name="Field429" type="radio" tabindex="12" value="Very Satisfied"  />
<label for="Field429_5">5</label>
</td>
</tr>
<tr class="statement430">
<th><label for="Field430">Overall Impression</label></th>
<td title="Very Unsatisfied">
<input id="Field430_1" name="Field430" type="radio" tabindex="13" value="Very Unsatisfied" />
<label for="Field430_1">1</label>
</td>
<td title="Unsatisfied">
<input id="Field430_2" name="Field430" type="radio" tabindex="14" value="Unsatisfied" />
<label for="Field430_2">2</label>
</td>
<td title="Neutral">
<input id="Field430_3" name="Field430" type="radio" tabindex="15" value="Neutral" />
<label for="Field430_3">3</label>
</td>
<td title="Satisfied">
<input id="Field430_4" name="Field430" type="radio" tabindex="16" value="Satisfied" />
<label for="Field430_4">4</label>
</td>
<td title="Very Satisfied">
<input id="Field430_5" name="Field430" type="radio" tabindex="17" value="Very Satisfied"  />
<label for="Field430_5">5</label>
</td>
</tr>
<tr class="alt statement431">
<th><label for="Field431">Overall Satisfaction</label></th>
<td title="Very Unsatisfied">
<input id="Field431_1" name="Field431" type="radio" tabindex="18" value="Very Unsatisfied" />
<label for="Field431_1">1</label>
</td>
<td title="Unsatisfied">
<input id="Field431_2" name="Field431" type="radio" tabindex="19" value="Unsatisfied" />
<label for="Field431_2">2</label>
</td>
<td title="Neutral">
<input id="Field431_3" name="Field431" type="radio" tabindex="20" value="Neutral" />
<label for="Field431_3">3</label>
</td>
<td title="Satisfied">
<input id="Field431_4" name="Field431" type="radio" tabindex="21" value="Satisfied" />
<label for="Field431_4">4</label>
</td>
<td title="Very Satisfied">
<input id="Field431_5" name="Field431" type="radio" tabindex="22" value="Very Satisfied"  />
<label for="Field431_5">5</label>
</td>
</tr>
</tbody>
</table>
</li><li id="foli325" class="likert notranslate 
col5
 ">
<table cellspacing="0">
<caption id="title325">
How satisfied were you with the following aspects of the Desktop Application? 
</caption> 
<thead>
<tr style="background-color: #15A0C8;">
<th style="background-color: #15A0C8;color: #fff;">&nbsp;</th>
<td style="background-color: #15A0C8;color: #fff;" >Very Unsatisfied</td>
<td style="background-color: #15A0C8;color: #fff;">Unsatisfied</td>
<td style="background-color: #15A0C8;color: #fff;">Neutral</td>
<td style="background-color: #15A0C8;color: #fff;">Satisfied</td>
<td style="background-color: #15A0C8;color: #fff;">Very Satisfied</td>
</tr>
</thead>
<tbody>
<tr class="statement325">
<th><label for="Field325">Graphic Design</label></th>
<td title="Very Unsatisfied">
<input id="Field325_1" name="Field325" type="radio" tabindex="23" value="Very Unsatisfied" />
<label for="Field325_1">1</label>
</td>
<td title="Unsatisfied">
<input id="Field325_2" name="Field325" type="radio" tabindex="24" value="Unsatisfied" />
<label for="Field325_2">2</label>
</td>
<td title="Neutral">
<input id="Field325_3" name="Field325" type="radio" tabindex="25" value="Neutral" />
<label for="Field325_3">3</label>
</td>
<td title="Satisfied">
<input id="Field325_4" name="Field325" type="radio" tabindex="26" value="Satisfied" />
<label for="Field325_4">4</label>
</td>
<td title="Very Satisfied">
<input id="Field325_5" name="Field325" type="radio" tabindex="27" value="Very Satisfied"  />
<label for="Field325_5">5</label>
</td>
</tr>
<tr class="alt statement326">
<th><label for="Field326">Friendliness</label></th>
<td title="Very Unsatisfied">
<input id="Field326_1" name="Field326" type="radio" tabindex="28" value="Very Unsatisfied" />
<label for="Field326_1">1</label>
</td>
<td title="Unsatisfied">
<input id="Field326_2" name="Field326" type="radio" tabindex="29" value="Unsatisfied" />
<label for="Field326_2">2</label>
</td>
<td title="Neutral">
<input id="Field326_3" name="Field326" type="radio" tabindex="30" value="Neutral" />
<label for="Field326_3">3</label>
</td>
<td title="Satisfied">
<input id="Field326_4" name="Field326" type="radio" tabindex="31" value="Satisfied" />
<label for="Field326_4">4</label>
</td>
<td title="Very Satisfied">
<input id="Field326_5" name="Field326" type="radio" tabindex="32" value="Very Satisfied"  />
<label for="Field326_5">5</label>
</td>
</tr>
<tr class="statement327">
<th><label for="Field327">Efficiency</label></th>
<td title="Very Unsatisfied">
<input id="Field327_1" name="Field327" type="radio" tabindex="33" value="Very Unsatisfied" />
<label for="Field327_1">1</label>
</td>
<td title="Unsatisfied">
<input id="Field327_2" name="Field327" type="radio" tabindex="34" value="Unsatisfied" />
<label for="Field327_2">2</label>
</td>
<td title="Neutral">
<input id="Field327_3" name="Field327" type="radio" tabindex="35" value="Neutral" />
<label for="Field327_3">3</label>
</td>
<td title="Satisfied">
<input id="Field327_4" name="Field327" type="radio" tabindex="36" value="Satisfied" />
<label for="Field327_4">4</label>
</td>
<td title="Very Satisfied">
<input id="Field327_5" name="Field327" type="radio" tabindex="37" value="Very Satisfied"  />
<label for="Field327_5">5</label>
</td>
</tr>
<tr class="alt statement328">
<th><label for="Field328">Overall Satisfaction</label></th>
<td title="Very Unsatisfied">
<input id="Field328_1" name="Field328" type="radio" tabindex="38" value="Very Unsatisfied" />
<label for="Field328_1">1</label>
</td>
<td title="Unsatisfied">
<input id="Field328_2" name="Field328" type="radio" tabindex="39" value="Unsatisfied" />
<label for="Field328_2">2</label>
</td>
<td title="Neutral">
<input id="Field328_3" name="Field328" type="radio" tabindex="40" value="Neutral" />
<label for="Field328_3">3</label>
</td>
<td title="Satisfied">
<input id="Field328_4" name="Field328" type="radio" tabindex="41" value="Satisfied" />
<label for="Field328_4">4</label>
</td>
<td title="Very Satisfied">
<input id="Field328_5" name="Field328" type="radio" tabindex="42" value="Very Satisfied"  />
<label for="Field328_5">5</label>
</td>
</tr>
</tbody>
</table>
</li><li id="foli425" 
class="notranslate      "><label class="desc" id="title425" for="Field425">
How can we improve our product?
</label>

<div style="float: left;margin-right: 50px;">
<textarea id="txt_feed_comment" name="txt_feed_comment" class="field textarea medium" rows="10" cols="50"tabindex="43"  ></textarea>


</div>
</div>
<style>
/*
 *  François 'cahnory' Germain
 */
.ui-tooltip, .ui-tooltip-top, .ui-tooltip-right, .ui-tooltip-bottom, .ui-tooltip-left {
  color:#ffffff;
  cursor:normal;
  display:-moz-inline-stack;
  display:inline-block;
  font-size:13px;
  font-family: 'PT Sans', sans-serif;
  padding:.5em 1em;
  position:relative;
  text-align:center;
  /*text-shadow:0 -1px 1px #111111; */
  -webkit-border-top-left-radius:4px ;
  -webkit-border-top-right-radius:4px ;
  -webkit-border-bottom-right-radius:4px ;
  -webkit-border-bottom-left-radius:4px ;
  -khtml-border-top-left-radius:4px ;
  -khtml-border-top-right-radius:4px ;
  -khtml-border-bottom-right-radius:4px ;
  -khtml-border-bottom-left-radius:4px ;
  -moz-border-radius-topleft:4px ;
  -moz-border-radius-topright:4px ;
  -moz-border-radius-bottomright:4px ;
  -moz-border-radius-bottomleft:4px ;
  border-top-left-radius:4px ;
  border-top-right-radius:4px ;
  border-bottom-right-radius:4px ;
  border-bottom-left-radius:4px ;
 /* -o-box-shadow:0 1px 2px #000000, inset 0 0 0 1px #222222, inset 0 2px #666666, inset 0 -2px 2px #444444;
  -moz-box-shadow:0 1px 2px #000000, inset 0 0 0 1px #222222, inset 0 2px #666666, inset 0 -2px 2px #444444;
  -khtml-box-shadow:0 1px 2px #000000, inset 0 0 0 1px #222222, inset 0 2px #666666, inset 0 -2px 2px #444444;
  -webkit-box-shadow:0 1px 2px #000000, inset 0 0 0 1px #222222, inset 0 2px #666666, inset 0 -2px 2px #444444;
  box-shadow:0 1px 2px #000000, inset 0 0 0 1px #222222, inset 0 2px #666666, inset 0 -2px 2px #444444; */
  background-color:#44B3D3;
 
  background-image:-moz-linear-gradient(top,#44B3D3,#15A0C8);
  background-image:-webkit-gradient(linear,left top,left bottom,color-stop(0,#44B3D3),color-stop(1,#15A0C8));
  filter:progid:DXImageTransform.Microsoft.gradient(startColorStr=#44B3D3,EndColorStr=#15A0C8);
  -ms-filter:progid:DXImageTransform.Microsoft.gradient(startColorStr=#44B3D3,EndColorStr=#15A0C8);
}
.ui-tooltip:after, .ui-tooltip-top:after, .ui-tooltip-right:after, .ui-tooltip-bottom:after, .ui-tooltip-left:after {
  content:"\25B8";
  display:block;
  font-size:2em;
  height:0;
  line-height:0;
  position:absolute;
}
.ui-tooltip:after, .ui-tooltip-bottom:after {
  color:#15A0C8;
  bottom:-2px;
  left:1px;
  text-align:center;
  /*text-shadow:0px 0 0px #000000; */
  -ms-transform: rotate(90deg);
  -o-transform:rotate(90deg);
  -moz-transform:rotate(90deg);
  -khtml-transform:rotate(90deg);
  -webkit-transform:rotate(90deg);
  width:100%;
}
.ui-tooltip-top:after {
  bottom:auto;
  color:#4f4f4f;
  left:-2px;
  top:0;
  text-align:center;
  text-shadow:none;
  -o-transform:rotate(-90deg);
  -moz-transform:rotate(-90deg);
  -khtml-transform:rotate(-90deg);
  -webkit-transform:rotate(-90deg);
  width:100%;
}
.ui-tooltip-right:after {
  color:#222222;
  right:-0.375em;
  top:50%;
  margin-top:-.05em;
  text-shadow:0 1px 2px #000000;
  -o-transform:rotate(0);
  -moz-transform:rotate(0);
  -khtml-transform:rotate(0);
  -webkit-transform:rotate(0);
}
.ui-tooltip-left:after {
  color:#222222;
  left:-0.375em;
  top:50%;
  margin-top:.1em;
  text-shadow:0 -1px 2px #000000;
  -o-transform:rotate(180deg);
  -moz-transform:rotate(180deg);
  -khtml-transform:rotate(180deg);
  -webkit-transform:rotate(180deg);
}

/* demo css */
h2 { margin: 2em 0 1em; }
p { margin: 0 0 1em; }
</style>

</li>



 <li class="buttons ">
<div>

                    <input id="saveForm" name="saveForm" class="brt_ren"     type="button" value="" onclick="validate();" />
                    </div>
</li>

</ul>
</form> 

</div><!--container-->










</div>
</div>



<script>

function valButton(btn) {
    var cnt = -1;
    for (var i=btn.length-1; i > -1; i--) {
        if (btn[i].checked) {cnt = i; i = -1;}
    }
    if (cnt > -1) return btn[cnt].value;
    else return null;
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
   // document.getElementById('err_name').innerHTML="";
//    document.getElementById('err_mail').innerHTML="";
//    if(document.getElementById('txt_feed_name').value=="")
//    {
//        document.getElementById('err_name').innerHTML="Please enter your name.";
//        document.getElementById('txt_feed_name').focus();
//        return false;
//    }
//    
//     if(!specialcharecter(document.getElementById("txt_feed_name").value))
//    {
//         //document.getElementById("error_fname").style.display='block';
//         
//          document.getElementById('err_name').innerHTML="Only Alphabets allowed.";
//        document.getElementById('txt_feed_name').focus();
//        return false;
//    }
//    
//       
//     if(document.getElementById('txt_feed_mail').value=="")
//    {
//        document.getElementById('err_mail').innerHTML="Please enter your email.";
//        document.getElementById('txt_feed_mail').focus();
//        return false;
//    }
//    if(document.getElementById("txt_feed_mail").value!="")
//    {
//        var x=document.getElementById("txt_feed_mail").value;
//        var atpos=x.indexOf("@");
//        var dotpos=x.lastIndexOf(".");
//        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
//             {
//                document.getElementById('err_mail').innerHTML="Please enter a valid email.";
//        document.getElementById('txt_feed_mail').focus();
//                return false;
//             }
//    }
//    
//    
     if(trim_string_str(document.getElementById('txt_feed_comment').value)=="")
    {
        alert("Please share  your response with us.");
        document.getElementById('txt_feed_comment').focus();
        return false;
    }
    
    window.form_feed.submit();   
     
     
}
</script>

<?php
}
?>









