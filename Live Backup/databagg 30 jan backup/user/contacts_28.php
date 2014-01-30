<?php
//session_start();
//include("connect.php");
//include("function.php"); 
//error_reporting(0);

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

if ($_FILES[csv][size] > 0) {

    if($_FILES[csv][type]=="application/vnd.ms-excel")
    {
    //get the csv file
    $file = $_FILES[csv][tmp_name];
    $handle = fopen($file,"r");
    $i=0;
    //loop through the csv file and insert into database
    
       while ($data = fgetcsv($handle,1000,",","'"))
       { 
        if($i==0)
        {
            $fname=array_search('First Name', $data);
            $lname=array_search('Last Name', $data);
            $email_csv=array_search('E-mail Address', $data);
        }
        //print_r($data);
        if($i>1)
            {
             $name=addslashes($data[$fname]).addslashes($data[$lname]);
             if($data[$email_csv]!="")
             if(checkduplicate($data[$email_csv]))
        {
            mysql_query("INSERT INTO users_contact (int_uid, txt_contact_email, txt_contact_name) VALUES
                (
                    '".$_SESSION['user_id']."',
                    '".addslashes($data[57])."',
                    '".$name."'
                )
            ");
        }
        }
        $i++;
        
     }
     }
     else
     {
        echo "Invalid file type, please upload CSV file";
     }
}

if($_REQUEST['del_id'])
{
    $delete_contact="delete from users_contact where int_contact_id='".$_REQUEST['del_id']."'";
    mysql_query($delete_contact) or die(mysql_error());
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
    }
}


$list_contact="select * from users_contact where int_uid='".$_SESSION['user_id']."' and txt_contact_email like '%".$_REQUEST['s']."%'";
$list_result=mysql_query($list_contact) or die(mysql_error());


?>
<script src="js/jquery-1.2.2.pack.js" type="text/javascript"></script>







  



    
    


<div class="container">
<h1>Contact List</h1>
<div class="fright imp_btn" onclick="document.getElementById('div_contact').style.display='block';"></div>
<div class="fleft width" style="margin-top:20px;">
<hr >
</div>
 <div  class="fleft width">








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
			<td><a href="index.php?name_page=contacts&del_id=<?php echo $fetch_list['int_contact_id'];  ?>"><img src="image/delete.png" title="Delete Contact" /> </a></td>

		</tr>
        
  <?php
  }
  ?>
        
        
		</tbody>
</table>


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
<li><a href="#" rel="country2">
<img src="images/icon_gmail.gif" />
Gmail</a></li>
<li><a href="#" rel="country3">
<img src="images/outlook.png" />
Outlook</a></li>


</ul>

</div>
<!--<p><a href="#mydiv" rel="facebox">gmail</a></p>



<div id="mydiv" style="display:none">-->
<div class="music_pattern listdiv" id="div_contact" style="border:1px solid gray; width:450px;height: 300px; margin-bottom: 1em; padding-top: 10px;background-color: #F1F1F1;display:none;">

<h1>Import <span>C</span>ontacts</h1>
<div class="music_close" onclick="document.getElementById('div_contact').style.display='none';"><img src="image/close_music.png" alt="close" /></div>

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
        
       
        <label for="username" >E-mail:</label>
       <input type="text" id="txt_contact_email" name="txt_contact_email" class="gmail_input" />
        
        <div class="fleft width mar8">
        <p></p>
        </div>
        <div class="width mar15" style="text-align:center;">
        <input type="button" value="Add" onclick="submit_form1();"  class="submit">
        
        <input type="button" value="Cancel" class="cancel" onclick="document.getElementById('div_contact').style.display='none';">
        </div>
        <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
        </form>
       
                           
                            </div>     
                        </div>
                       
                        <div id="tab2" class="tab_content">                             <p class="width" >
                            Login to your Gmail.com email account<br />
                            Import contacts that can be used to share your databagg files.
                         </p>
                            <div class="fleft width mar22-12" style="display: none;">
                               <form id="form2" name="form2" action="gmail.php" method="post">
       
        <label for="name">Username:</label>
       
        <input type="text" id="txt_user" name="txt_user" class="gmail_input" />
       
        <label for="username" >Password:</label>
       <input type="password" id="txt_pass" name="txt_pass" class="gmail_input" />
        
        <div class="fleft width mar8">
        <p><img src="image/import_lock.jpg" alt="" />&nbsp; &nbsp;We won't store the username and password.</p>
        </div>
        <div class="width mar15" style="text-align:center;">
        <input  class="submit" ype="button" value="Fetch" onclick="submit_form2();">
        <input type="button" value="Cancel" class="cancel" onclick="document.getElementById('div_contact').style.display='none';">
        </div>
        <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
        </form>
       
                           
                            </div>     
                          <input  class="submit" type="button" value="Click here" onclick="location.href='index.php?name_page=ReadyGetContact';"> 
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
        <input type="submit" name="Submit" value="Submit"   class="submit">
        <input type="button" value="Cancel" class="cancel" onclick="document.getElementById('div_contact').style.display='none';">
        </div>
        <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
        </form>
       
                           
                            </div>     
                     
                     </div>
                  </div>
            </div>


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
 

</body>
</html>
<script type="text/javascript">

var countries=new ddtabcontent("countrytabs")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>

<script>
function submit_form1()
{
    document.form1.submit();
}
function submit_form2()
{
    document.form2.submit();
}
</script>

