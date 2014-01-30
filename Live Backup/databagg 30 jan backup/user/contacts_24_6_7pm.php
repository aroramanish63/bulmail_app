<?php
//session_start();
//include("connect.php");
//include("function.php"); 
error_reporting(0);

if(!$_REQUEST['s'])
$_REQUEST['s']="";
function checkduplicate($email)
{
    $select_email="select * from users_contact where txt_contact_email='".trim($email)."' and int_uid='".$_SESSION['user_id']."'";
    $result_email=mysql_query($select_email);
    if(mysql_num_rows($result_email)==0)
    return true;
    else
    return false;
}

if ($_FILES['csv']['size'] > 0) {

    $type = substr($_FILES['csv']['name'], strrpos($_FILES['csv']['name'], '.')+1);
    if($type=="csv" || $type=="CSV")
    {
    //get the csv file
    $file = $_FILES['csv']['tmp_name'];
    $handle = fopen($file,"r");
    $i=0;
    //loop through the csv file and insert into database
        
       while ($data = fgetcsv($handle,1000,","))
       { 
        if($i==0)
        {
            $fname=array_search('First Name', $data);
            $lname=array_search('Last Name', $data);
               $email_csv=array_search('E-mail Address', $data);
        //echo "sa".$fname." ".$lname." ".$email_csv."<br>";
        }
        
        if(!isset($email_csv) || $email_csv>0)
        {
        if($i>0)
            {
             
             $name=$data[$fname].$data[$lname];
           
             //echo $fname." ".$lname." ".$email_csv."<br>";
             //echo "INSERT INTO users_contact (int_uid, txt_contact_email, txt_contact_name) VALUES
//                (
//                    '".$_SESSION['user_id']."',
//                    '".$data[$email_csv]."',
//                    '".$name."'
//                )
//            ";
             if($data[$email_csv]!="")
             if(checkduplicate($data[$email_csv]))
        {
           
            mysql_query("INSERT INTO users_contact (int_uid, txt_contact_email, txt_contact_name) VALUES
                (
                    '".$_SESSION['user_id']."',
                    '".addslashes($data[$email_csv])."',
                    '".$name."'
                )
            ") ;
        $suc_msg="Contact added successfully";
        $err_msg="";
        }
        }
        $i++;
      }
      else
      {
         $suc_msg="";
         $err_msg="Invalid format, We accepting outlook csv format. Download an example from <a href='download.php?path=dummy.csv'>here</a>";
        
      }  
     }
     
     }
     else
     {
         $suc_msg="";
         $err_msg="Invalid file type, please upload CSV file";
         
     }
     fclose($file);
}

if($_REQUEST['del_id'])
{
    
     $delete_contact="delete from users_contact where int_contact_id=".safe(str_replace(" ","",$_REQUEST['del_id']));
     $result_data=mysql_query($delete_contact);
    
    if(!$result_data)

handle_mysql_error($delete_contact,"Error while deleting contact ","contacts");  
else

    $suc_msg="Contact deleted successfully";
    $err_msg="";
}
if($_REQUEST['total_email'])
{
    //echo $_REQUEST['total_email'];
    $arr_mail=explode(",",$_REQUEST['total_email']);
    $arr_name=explode(",",$_REQUEST['total_name1']);
    for($i=0;$i<count($arr_mail)-1;$i++)
    {
          if(checkduplicate($arr_mail[$i]))
        {
          $insert_query_gmail="insert into users_contact (int_uid,txt_contact_email,txt_contact_name)values('".$_SESSION['user_id']."','".$arr_mail[$i]."','".$arr_name[$i]."')";
        mysql_query($insert_query_gmail);  
        }
    }
}

if($_REQUEST['txt_contact_email'])
{
    if(checkduplicate($_REQUEST['txt_contact_email']))
    {
    $insert_query="insert into users_contact (int_uid,txt_contact_name,txt_contact_email)values('".$_SESSION['user_id']."','".$_REQUEST['txt_contact_name']."',
    '".$_REQUEST['txt_contact_email']."')";
    mysql_query($insert_query);
    $suc_msg="Contact successfully added";
    $err_msg="";
    }
    else
    {
     $suc_msg="";
     $err_msg="Email already exists";   
    }
}


$list_contact="select * from users_contact where int_uid='".$_SESSION['user_id']."' and txt_contact_email like '%".$_REQUEST['s']."%'";
$list_result=mysql_query($list_contact) or die(mysql_error());


?>
<script src="js/jquery-1.2.2.pack.js" type="text/javascript"></script>







  



    
    


<div class="container">
 <?php
       if($suc_msg)
     {
        
        ?>
        <div class="success" id="error_container1" style="margin-left: 170px;text-align: center;">
         <strong></strong> <?php echo $suc_msg; ?>

        </div>
        <?php
     }
     ?>
      <?php
       if($err_msg)
     {
        
        ?>
        
        <div class="error" id="error_container2" style="margin-left: 170px;text-align: center;">
         <strong></strong> <?php echo $err_msg; ?>

        </div>
        <?php
     }
     ?>
<h1>Contact List</h1>
<div class="fright imp_btn" onclick="document.getElementById('div_contact').style.display='block';"></div>
<div class="fleft width" style="margin-top:20px;">
<hr >
</div>
 <div  class="fleft width">







<?php
if(mysql_num_rows($list_result)>0)
{
?>
<table cellspacing="1" class="tablesorter_bg" >
	<thead>
		<tr>
			<th>Name</th>
			<th>Email Address</th>
			<th>Actions</th>	

		</tr>
	</thead>
	
	<tbody>
		<?php 

while($fetch_list=mysql_fetch_array($list_result))
{
?>
        <tr>
			<td><?php echo $fetch_list['txt_contact_name']; ?></td>
			<td><?php echo $fetch_list['txt_contact_email']; ?></td>
			<td><a href="javascript:cnfrm_del(<?php echo $fetch_list['int_contact_id'];  ?>);"><img src="image/delete.png" title="Delete Contact" style="margin-top: 3px;" /> </a></td>

		</tr>
        
  <?php
  }
  ?>
        
        
		</tbody>
</table>
<?php
}
else
{
?>
<div class="width fleft" style="text-align: center;margin-top:25px ;"> 
 <center>  <div class='error' style='width:400px;'>  Contact list is empty, Please add contacts. </div> </center> <br />

</div>
<?php
}
?>
</div>
</div>

<style>
.listdiv {
            
			
			position: fixed;
			top: 25%;
			left: 35%;
		
		
		
		
        }
</style>

<div class="listdiv" style="border:1px solid gray; width:450px;height: 300px; margin-bottom: 1em; padding-top: 10px;background-color: #F1F1F1;display:none;" id="div_contact_old">
<strong> Contacts </strong>
<br />
<ul id="countrytabs" class="shadetabs">
<li><a href="#" rel="country1" class="selected">
<img src="images/icon-add.gif" /> Add Contact</a></li>
<!--<li><a href="#" rel="country2">
<img src="images/icon_gmail.gif" />
Gmail</a></li> -->
<li><a href="#" rel="country3">
<img src="images/outlook.png" />
Outlook</a></li>


</ul>

</div>
<script type="text/javascript" src="js/jquery.js"></script>
  <style>
     .login_error { width:211px; height:30px;  top:380px;  color:#FFF;margin-left: 120px;
      font-family:Verdana, Geneva, sans-serif; padding:5px 0 0 20px; background:url(image/errorrmess-img.png) no-repeat; position: absolute;  }
     </style>
<!--<p><a href="#mydiv" rel="facebox">gmail</a></p>



<div id="mydiv" style="display:none">-->
<div class="music_pattern listdiv" id="div_contact" style="border:1px solid gray; width:450px;height: 300px; margin-bottom: 1em; padding-top: 10px;display:none;">

<h1>Add - Import <span>C</span>ontacts</h1>
<div class="music_close" onclick="document.getElementById('div_contact').style.display='none';" style="cursor: pointer;"><img src="image/close_u.png" alt="close" /></div>

<div id="import" class="width fleft">
                      <ul class="tabs clearfix">
                        <li><a href="#tab1">Add Contact</a></li>
                        <li><a href="#tab2">Gmail</a></li> 
                        <li><a href="#tab3">Outlook</a></li>
                    </ul>
                    
                    <div class="tab_container">
                 
                        <div id="tab1" class="tab_content">
                            <p class="width" >
                            Simply add you contacts from here<br />
                            Add contacts that can be used to share your databagg files.
                         </p>
                            <div class="fleft width mar22-12">
                               <form id="form1" name="form1" action="#" method="post">
       
        <label for="name">Contact Name:</label>
       
        <input type="text" id="txt_contact_name" name="txt_contact_name" class="gmail_input" />
        
        <div id="error_email" class="login_error" style="display: none;top: 197px;">
Enter your email
</div>
        <label for="username" >E-mail:</label>
       <input type="text" id="txt_contact_email" name="txt_contact_email" class="gmail_input" />
        
        <div class="fleft width mar8">
        <p></p>
        </div>
        <div class="width mar15" style="text-align:center;">
        <input type="button" value="Add" onclick="submit_form1();"  class="submit2">
        
        <input type="button" value="Cancel" class="cancel2" onclick="document.getElementById('div_contact').style.display='none';">
        </div>
        <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
        </form>
       
                           
                            </div>     
                        </div>
                       
                        <div id="tab2" class="tab_content">                             <p class="width" >
                       
                      IMPORT YOUR GMAIL CONTACT CLICK THE IMAGE BELOW
                       
                        </p>
                        <br />
                        <br />
                        <br />
                        
                        
                        <a href="gmail/index.php" target="_blank">
                        
                        <img src='gmail/Icon-Gmail.png'/>
                        </a>
                        
                           <!-- Login to your Gmail.com email account<br />
                            Import contacts that can be used to share your databagg files.
                         </p>
                            <div class="fleft width mar22-12" style="display: block;">
                               <form id="form2" name="form2" action="gmail.php" method="post">
       
        <label for="name">Username:</label>
       
        <input type="text" id="txt_user" name="txt_user" class="gmail_input" />
       
        <label for="username" >Password:</label>
       <input type="password" id="txt_pass" name="txt_pass" class="gmail_input" />
        
        <div class="fleft width mar8">
        <p><img src="image/import_lock.jpg" alt="" />&nbsp; &nbsp;We won't store the username and password.</p>
        </div>
        <div class="width mar15" style="text-align:center;">
        <input  class="submit" type="button" value="Fetch" onclick="submit_form2();">
        <input type="button" value="Cancel" class="cancel" onclick="document.getElementById('div_contact').style.display='none';">
        </div>
        <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
        </form>
       
                           
                            </div>     
                          <input  class="submit2" type="button" value="Click here" onclick="location.href='index.php?name_page=ReadyGetContact';"> -->
                        </div>
                       
                        <div id="tab3" class="tab_content">
                          <p class="width" >
                            Import from Outlook .CSV file<br />
                            Choose your CSV file:
                         </p>
                            <div class="fleft width mar22-12">
                               <form action="#" method="post" enctype="multipart/form-data" name="form3" id="form3">
       
        <label for="name">CSV File:</label>
       
        
       
       <input name="csv" type="file" id="csv" class="gmail_input" />
        
        <div class="fleft width mar8">
        <p></p>
        </div>
        <div class="width mar15" style="text-align:center;">
        <input type="submit" name="Submit" value="Submit"   class="submit2">
        <input type="button" value="Cancel" class="cancel2" onclick="document.getElementById('div_contact').style.display='none';">
        </div>
        <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
        </form>
       
                           
                            </div>     
                     
                     </div>
                  </div>
            </div>


<!--</div>-->
</div>

<style>
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
.cancel2:hover{color: #FFF;  background:#6eb016; border:1PX solid #0093c8 !important;}
.cancel2{
    background: #00a2dd;
   
    border: 1px solid #0197ce !important;
	/*font-family: 'geoslab703_md_btbold';*/
	font-family: 'PT Sans', sans-serif;
	box-shadow:none !important;
    color: #FFF;
	font-weight:normal;
    cursor: pointer;
       font-size: 17px;
    margin-top: 15px;
    margin-left: 5px;
	float:left;
    padding-left: 10px;
    padding-right: 10px;
    text-align: center;
    border-radius: 3px;
    width: auto;
   
}
.submit2:hover{color: #FFF; background: #00a2dd; border:1PX solid #0093c8 !important;}
</style>





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
 

</body>
</html>
<script type="text/javascript">

var countries=new ddtabcontent("countrytabs")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>

<script>
function specialcharecter(val)

            {

                var iChars = "!`@#$%^&*()+=-[]\\\';,./{}|\":<>?~_1234567890";   

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
function submit_form1()
{
    //document.getElementById("error_name").style.display='none';
    document.getElementById("error_email").style.display='none';
    
    
  if(trim_string_str(document.getElementById("txt_contact_email").value)=="")
    {
         $('#error_email').fadeIn('slow');
        //document.getElementById("error_email").style.display='block';
        document.getElementById("txt_contact_email").focus();
        return false;
    }
    if(!specialcharecterforemail(document.getElementById("txt_contact_email").value))
    {
          $('#error_email').fadeIn('slow');
         //document.getElementById("error_email").style.display='block';
         document.getElementById("error_email").innerHTML="Remove special chars"
        document.getElementById("txt_contact_email").focus();
        return false;
    }
    if(trim_string_str(document.getElementById("txt_contact_email").value)!="")
    {
        var x=document.getElementById("txt_contact_email").value;
        var atpos=x.indexOf("@");
        var dotpos=x.lastIndexOf(".");
        if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length)
             {
                 $('#error_email').fadeIn('slow');
                //document.getElementById("error_email").style.display='block';
                document.getElementById("error_email").innerHTML="Enter valid email.";
              document.getElementById("txt_contact_email").focus();
                return false;
             }
    }
    document.form1.submit();
}
function submit_form2()
{
    document.form2.submit();
}

function cnfrm_del(id)
{
    if(confirm("Are you sure to delete this contact ?"))
    location.href="index.php?name_page=contacts&del_id="+id;
}
</script>

