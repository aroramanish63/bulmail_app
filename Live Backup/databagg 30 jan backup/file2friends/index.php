<?php
//phpinfo();die;
session_start();
error_reporting(E_ALL);
ini_set("display_errors",0);
ini_set('post_max_size', '2G');
ini_set('upload_max_filesize', '2G');

include("include/config.php");
include("include/functions.php");

//mail("pankaj.garg@cyfuture.com","Test Subject","Hi This is testing.","From:pankajkumargrg@gmail.com");die;
//============= Expiration of files
$now = date("Y-m-d H:i:s", time());
$now_string = strtotime($now);
$sql_expire_records = "select filecode,sent_on from filedata where expiry_date < '$now'";
$query_expire_records = mysql_query($sql_expire_records);
while($row_expire_record = mysql_fetch_array($query_expire_records))
{
	//echo $row_expire_record['filecode'];
	$expirefile_sql_date = $row_expire_record['sent_on']; // get the sent date of file
	$expirefile_sql_date = strtotime($expirefile_sql_date);
	$foleder_name = date('Y-m-d',$expirefile_sql_date);
	
	$expire_filecode = $row_expire_record['filecode'];
	$sql_expire_files = "select * from tbl_files where filescode='$expire_filecode'";
	$query_expire_files = mysql_query($sql_expire_files);
	while($row_expire_files = mysql_fetch_array($query_expire_files))
	{
		 $file_path_to_delete = "../nas/sendfilestofriends/".$foleder_name."/".$row_expire_files['file_name'];
		 unlink($file_path_to_delete); // Delete the expired files
		//echo $row_expire_files['file_name'];echo "<br />";
	}
}
//================================

if(isset($_POST['submit']))
{
	$sendermail = $_POST['email']; // get sender email
	$frndsmail = $_POST['frndsmail'];
	$frndsmail_list_array=explode(',',$frndsmail);
	$fmail_list=array_unique($frndsmail_list_array); // frnds email array
	//print_r($fmail_list);
	
	if($_POST['msg']!="")
	{
		$msg = nl2br($_POST['msg']);
	}
	
	//=========================Get Upload files
	$n_image=$_FILES['uploadfile']['name'];
	//print_r($n_image);die;
	$tmn_image=$_FILES['uploadfile']['tmp_name'];
	$getfilesize=$_FILES["uploadfile"]["size"];
	$total_file_size = array_sum($getfilesize); //Total File Size in Bytes
	$total_file_size_kb = ($total_file_size/1024); //Total File Size in KB
	$total_file_size_mb = (($total_file_size/1024)/1024); //Total File Size in MB
	$total_file_size_gb = ((($total_file_size/1024)/1024)/1024); //Total File Size in GB
	$n_image_count=count($n_image);
	$tmp_image_count=count($tmn_image);
	
	//============================== End upload files
	
	$randomvalue = rand(10000,1000000);
	$randomstring = md5($randomvalue); //generate Code
	$sender_ip = $_SERVER['REMOTE_ADDR'];
	$userid = $_SESSION['user_id'];
	$currentDate = date('Y-m-d H:i:s');
	
	
	//$expiry_date = date("Y-m-d H:i:s", time()+1*1*2*60); // Make expiration time of 2 minutes demo
	
	if($_POST['planid']!="" && $_POST['userid']!="")
	{
		$query_total_size = mysql_fetch_array(mysql_query("select total_sent from users_register where id=".$_SESSION['user_id']));
		$total_sent = $query_total_size['total_sent'];
		if(($total_sent+$total_file_size_kb) > 5242880) //if size exceed 5 GB = 5242880 KB
		{
			$_SESSION['size_error'] = "Sorry!! You are about to reach the limit. Files are not sent. Please renew your plan. Click <a href=\"registration.php\">here</a> to Renew.";
			header("location: index.php");	
			die;
		}
		$timestamp = strtotime('+20 years'); // make time after 24 Years
		$expiry_date = date("Y-m-d H:i:s", $timestamp); // Make expiration time of 24 years
		$will_expire = 'no';	
	}
	else
	{
		if($total_file_size_kb > 1048576)	//if size exceed 1GB = 1048576 KB
		{
			$_SESSION['size_error'] = "Sorry!! You have crossed the limit of file size. Click <a href=\"registration.php\">here</a> to register plan.";
			header("location: index.php");	
			die;
		}
		$expiry_date = date("Y-m-d H:i:s", time()+2*24*60*60); // Make expiration time of 2 days
		$will_expire = 'yes';	
	}
	
	if(mysql_query("insert into filedata(user_id,sendermail,filecode,message,sender_ip,sent_on,expiry_date,will_expire) values('$userid','$sendermail','$randomstring','$msg','$sender_ip','$currentDate','$expiry_date','$will_expire')"))
	{
		$sbq_maxid="select max(id) as max_id from filedata where 1";
		$sbrow_maxid=mysql_fetch_array(mysql_query($sbq_maxid));
		$max_id=$sbrow_maxid["max_id"];
		
		/*if(!is_dir("../nas/sendfilestofriends/"))
		{
			mkdir("../nas/sendfilestofriends/", 0700);
		}*/
		if(!is_dir("../nas/sendfilestofriends/".date("Y-m-d")))
		{
			mkdir("../nas/sendfilestofriends/".date("Y-m-d"), 0700);
		}
		/*if(!is_dir("uploaded/".date("Y-m-d")))
		{
			mkdir("uploaded/".date("Y-m-d"), 0700);
		}*/
		
		foreach($fmail_list as $key => $value) 
		{
			$query_insertmail="insert into tbl_emaillist (receiveremail, filedata_id, filecode) values ('$value', $max_id,'$randomstring')";
			mysql_query($query_insertmail);
		}
		
		//====================complete file concept
		if($n_image[0]!=""){
			for($i=0;$i<$n_image_count;$i++)
			{
				$imagename = date("YmdHis").$n_image[$i];
				$imagename = str_replace(" ","_",$imagename); //Replace space into hypen
				$file_size= floor($getfilesize[$i]/1024);
				$imagepath = "../nas/sendfilestofriends/".date("Y-m-d")."/".$imagename;
				move_uploaded_file($tmn_image[$i], $imagepath);
				$query_image="insert into tbl_files(filedata_id, filescode, file_name, file_size) values($max_id, '$randomstring','$imagename','$file_size')";
				mysql_query($query_image);
				
				if(isset($_SESSION['user_id']) && $_SESSION['user_id']<>"" && $_POST['planid']!="")
				{
					// Update the total data size to sent
					$update_size = "update users_register set total_sent = total_sent+'$file_size' where id=".$_SESSION['user_id'];
					mysql_query($update_size);
				}
			}
		}
		
		sendmail($randomstring,$root,$fmail_list);	//Send mail to Recipients
		sendmailtosender($randomstring,$root,$fmail_list);	//Send mail to Sender
		header("location: success.php?code=".$randomstring);
		die();
	}
	else
	{
		echo "<font color='red'>Sorry! Some Error Occur. Try Again!</font>";	
	}
		
}
?>

<?php
	include("include/header.php");
?>
      <!--form right section start here-->
      
      <div class="form_rightsection">
        <div class="form_topbg"><img src="images/fromtopbg.png" width="772" height="40" alt="#" /></div>
        <div class="form_midbg">
          <div class="form_contentcontainer">
          <?php
			if(isset($_SESSION['size_error']) && $_SESSION['size_error']!="")
			{
				?>
				 <table style="margin: 0 0 10px 0px; color:#C00">
					<?php
						echo "<tr><td>".$_SESSION['size_error']."</td></tr>";
					?>
				</table>
				<?php
				unset($_SESSION['size_error']);	
			}
			?>
            <form action="" id="form1" name="form1" method="post" enctype="multipart/form-data">
            
              <label style="margin-top:0px !important;">Your Email </label>
              <input type="text" name="email" id="email"
                    <?php
					if(isset($_SESSION['user_email']) && isset($_SESSION['user_id'])){
						echo "value=".$_SESSION['user_email']." "."readonly='readonly'";
					}else{
						echo "value=''";
					}
					?>
                    class="inputbg" placeholder="Your Email Address" />
              <span id="emailInfo"></span>
              
              <label>Your Friend's Email </label>
              <input name="frndsmail" type="text" value="" class="tags" id="tags_1" />
              <span id="frndemailInfo"></span>
              
              <label>Choose Files </label>
              <input type="file" id="uploadfile" name="uploadfile[]" class="multi max-10 fileinput"/>
              <span id="fileInfo"></span>
              
              <a class='ajax' href="ajax.html"></a> <!-- Call ajax when plan limit crossed -->
              
              <input name="userid" id="userid" type="hidden" value="<?php echo $session_user_id; ?>" />
              <input name="planid" id="planid" type="hidden" value="<?php echo $_SESSION["plan_id"]; ?>" />
              
              <div style="clear:both; padding:10px 0 0 0;"></div>
              <div class="addmsgtext"><a class="lnkCustom" onclick="$(this).parent().hide();$('#message-label').show();$('#msg').show();">Add a message</a></div>
              <label id="message-label" style="display:none;">Your Message </label>
              <textarea name="msg" id="msg" placeholder="Message here" style="display:none;"></textarea>
        
              <input type="submit" name="submit" class="sendbutton" value=""/>
            </form>
          </div>
        </div>
        <div class="form_topbg"><img src="images/bottombg.png" width="772" height="230" alt="#" /></div>
      </div>
      <!--form right section end here--> 
      
    </div>
  </div>
</div>
</body>
</html>
