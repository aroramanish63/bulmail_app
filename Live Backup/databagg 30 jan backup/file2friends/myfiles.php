<?php
error_reporting(0);
session_start();
include("include/config.php");
if(!isset($_SESSION['user_id']) && !isset($_SESSION['user_email'])){
	header("location: login.php");
	die;
}

//=================== File Deletion One by One
if(isset($_REQUEST['delfileid']) && !empty($_REQUEST['delfileid']) && isset($_REQUEST['filecode']))
{
	$file_data_row = mysql_fetch_array(mysql_query("select user_id,sent_on from filedata where filecode='".$_REQUEST['filecode']."'"));
	//print_r($file_data_row);die;
	$userid = $file_data_row['user_id'];
	$file_sql_date = strtotime($file_data_row['sent_on']); // get the sent date of file
	$foleder_name = date('Y-m-d',$file_sql_date);
	if($userid == $_SESSION['user_id'])
	{
		$sql_delete_files = mysql_fetch_array(mysql_query("select file_name from tbl_files where id=".$_REQUEST['delfileid']));
		$file_path_to_delete = "../nas/sendfilestofriends/".$foleder_name."/".$sql_delete_files['file_name'];
		if(mysql_query("DELETE from tbl_files where id= ".$_REQUEST['delfileid']))
		{
		 	unlink($file_path_to_delete); // Delete the file
			$_SESSION['message'] = "Deleted Successfully.";
			 header("location: myfiles.php");
			 die;
		}
	}
}
//================== End of File Deletion

//======= Deleting the Selected Files
if ($_POST) 
{
    foreach ($_POST as $variable) 
	{
        if (is_numeric($variable)) 
		{
			if (mysql_query("delete from tbl_files where id=$variable")) 
			{
               $_SESSION['message'] = "Selected file(s) are successfully deleted.";
            }
        }
    }
	header("location:myfiles.php");
	die;
}


$path = $root."/shares.php?code=".$row['filecode'];

?>

<?php
	include("include/header.php");
?>
<!--========== Confirmation for Delete =========-->
<script type="text/javascript">
function varifydelete(delid,filecode){
	cnfrm = confirm("Are you sure to delete this file.");
	if (cnfrm==true)
	{
		window.location.href = '?delfileid='+delid+'&filecode='+filecode;
	}
	else
	{
		return false;
	}
}
</script>
<!--===========================-->

<!--============== Checkbox delete all/selected ===========-->
<script type="text/javascript">
function delete_confirm()
{
	if(confirm("Are you sure want to delete these files."))
	window.myfile.submit();
}
</script>

<script type="text/javascript">
$(document).ready(function (){
    // add multiple select / deselect functionality
    $("#selectall").click(function () {
          $('.case').attr('checked', this.checked);
		  if (document.getElementById('selectall').checked == true)
		  {
				document.getElementById('deleteselectedbutton').style.display='none';
				document.getElementById('deleteallbutton').style.display='inline-block'; 
		  }
		  else
		  {
				document.getElementById('deleteallbutton').style.display='none';
		  }
    });	
 
    // if all checkbox are selected, check the selectall checkbox
    // and viceversa
    $(".case").click(function(){
 
        if($(".case").length == $(".case:checked").length) {
            $("#selectall").attr("checked", "checked");
        } else {
            $("#selectall").removeAttr("checked");
        }
		
		if($(".case:checked").length >= 1) {
			 document.getElementById('deleteallbutton').style.display='none';
             document.getElementById('deleteselectedbutton').style.display='inline-block';
        } else {
            document.getElementById('deleteselectedbutton').style.display='none';
        }
		 
    });
});
</script>
<!--================= Enf delete all/selected===================-->

      <!--form right section start here-->
      
      <div class="form_rightsection">
        <div class="form_topbg"><img src="images/fromtopbg.png" width="772" height="40" alt="#" /></div>
        <div class="form_midbg">
          <div class="form_contentcontainer">
          
          <?php
			if(isset($_SESSION['message']) && $_SESSION['message']!="")
			{
				echo "<div class=\"successdiv\">".$_SESSION['message']."</div>";
				unset($_SESSION['message']);	
			}
			?>
          
          	<form name="myfile" id="myfile" action="myfiles.php" method="post">
            <div class="form_contentstep2">
              <h1><span>My Files</span></h1>
              <?php // Get the total sent
				$query_total_size = mysql_fetch_array(mysql_query("select total_sent,plan_id from users_register where id=".$_SESSION['user_id']));
				$total_sent = $query_total_size['total_sent'];
				//$total_sent = 5242880;
				if ($total_sent / 1024 > 1)
				{
					if ((($total_sent / 1024) / 1024) > 1) 
					{ 
						$total_sent = (round((($total_sent / 1024) / 1024) * 100) / 100)." GB";	// in GB
					}
					else
					{ 
						$total_sent = (round(($total_sent / 1024) * 100) / 100)." MB";	// in MB
					} 
				}
				else 
				{
					$total_sent = (round($total_sent * 100) / 100)." KB";	// in KB
				} 
				
				?>
                <div style="float:left; width:auto; padding:12px 10px 0 0;"><input type="checkbox" id="selectall" /></div>
                <div style="float:left; display:none; width:auto;" id="deleteallbutton"><input type="button" name="deletefiles" class="deleteall" value="Delete All" onclick="delete_confirm();" href="javascript:void(0);"/></div>
                <div style="float:left; display:none; width:auto;" id="deleteselectedbutton"><input type="button" name="deletefiles" class="deleteall" value="Delete Selected" onclick="delete_confirm();" href="javascript:void(0);"/></div>
                <?php
				if($query_total_size['plan_id']!=0)
				{
				?>
              <div style="font-size:15px; width:auto; color:#0096CF; float:right;"><strong>File Status (Sent): <span style="color:#5D5D5D"><?php echo $total_sent; ?> (as your plan)</span></strong></div>
              <?php
				}
			  ?>
              <div style="height:20px; clear:both;"></div>
              <div class="form_userdetails">
                <ul>
                <?php
				$sql_data_count = "SELECT * FROM tbl_files as tf LEFT JOIN filedata as fd ON (tf.filedata_id=fd.id) where user_id=".$_SESSION['user_id']." order by sent_on desc";
				$query_data_count = mysql_query($sql_data_count);
				if(mysql_num_rows($query_data_count)>0)
				{
					$sql_data = "select * from filedata where user_id=".$_SESSION['user_id']." order by sent_on desc";
					$query_data = mysql_query($sql_data);
					$i = 0;
					while($row_data = mysql_fetch_array($query_data))
					{
						//print_r($row_data);
						$senton_sql = strtotime($row_data['sent_on']);
						$sent_on = date('M d,Y \a\t H:i A \I\S\T',$senton_sql);
						$code = $row_data['filecode'];
						$sql_files = "select * from tbl_files where filescode='$code'";
						$query_files = mysql_query($sql_files);
						while($row_files = mysql_fetch_array($query_files))
						{
							$i++;
							//========= Get the image icon regarding file extension
							//$extension = pathinfo($row1['file_name'], PATHINFO_EXTENSION); //Get extension of file
							if(preg_match("/(\.jpg|\.png|\.gif|\.bmp|\.jpeg)$/i",$row_files['file_name'])){
								$image_icon = "<img src=\"images/icon_file/jpg.png\" alt=\"#\" />";	//Image files
							}
							else if(preg_match("/(\.mp3|\.wav)$/i",$row_files['file_name'])){
								$image_icon = "<img src=\"images/icon_file/mp3.png\" alt=\"#\" />";	//Audio files
							}
							else if(preg_match("/(\.3gp|\.avi|\.flv|\.mkv|\.mov|\.mp4|\.mpeg|\.mpg|\.wmv)$/i",$row_files['file_name'])){
								$image_icon = "<img src=\"images/icon_file/3gp.png\" alt=\"#\" />";	//Video files
							}
							else if(preg_match("/(\.doc|\.docx)$/i",$row_files['file_name'])){
								$image_icon = "<img src=\"images/icon_file/doc.png\" alt=\"#\" />";	//DOC files
							}
							else if(preg_match("/(\.xls|\.xlsx)$/i",$row_files['file_name'])){
								$image_icon = "<img src=\"images/icon_file/xls.png\" alt=\"#\" />";	//XLS files
							}
							else if(preg_match("/(\.ppt|\.pptx)$/i",$row_files['file_name'])){
								$image_icon = "<img src=\"images/icon_file/ppt.png\" alt=\"#\" />";	//PPT files
							}
							else if(preg_match("/(\.txt)$/i",$row_files['file_name'])){
								$image_icon = "<img src=\"images/icon_file/txt.png\" alt=\"#\" />";	//Text files
							}
							else if(preg_match("/(\.zip)$/i",$row_files['file_name'])){
								$image_icon = "<img src=\"images/icon_file/zip.png\" alt=\"#\" />";	//Zip files
							}
							else if(preg_match("/(\.rar)$/i",$row_files['file_name'])){
								$image_icon = "<img src=\"images/icon_file/rar.png\" alt=\"#\" />";	//Zip files
							}
							else if(preg_match("/(\.pdf)$/i",$row_files['file_name'])){
								$image_icon = "<img src=\"images/icon_file/pdf.png\" alt=\"#\" />";	//PDF files
							}
							else{
								$image_icon = "<img src=\"images/icon_file/other.png\" alt=\"#\" />";	// Others
							}
							//========
							
							//============= Size Calculation
							if ($row_files['file_size'] / 1024 > 1)
							{
								if ((($row_files['file_size'] / 1024) / 1024) > 1) 
								{ 
									$file_size = (round((($row_files['file_size'] / 1024) / 1024) * 100) / 100)." GB";	// in GB
								}
								else
								{ 
									$file_size = (round(($row_files['file_size'] / 1024) * 100) / 100)." MB";	// in MB
								} 
							}
							else 
							{
								$file_size = (round($row_files['file_size'] * 100) / 100)." KB";	// in KB
							}
							//========
							echo "<li>";
							echo "<div class=\"leftcheckbox\"><input type=\"checkbox\" class=\"case\" name=\"c$i\" value=\"".$row_files['id']."\"/></div><div class=\"icon2\">".$image_icon."</div><div class=\"filename2\">".$row_files['file_name']."<br /><span>Sent: ".$sent_on."</span></div><div class=\"filesize\">".$file_size."</div><div class=\"myfile_rightoption2\"><a href=\"javascript:void(0);\" onClick=\"varifydelete(".$row_files['id'].",'$code')\"><img src=\"images/delete.png\" alt=\"Delete\" title=\"Delete this file\" /></a>&nbsp;&nbsp;<a href=download.php?code=".$code."&filename=".$row_files['file_name']."><img src=\"images/download.png\" alt=\"Download\" title=\"Download this file\" /></a></div>";
							echo "</li>";
						}
					}
				}
				else
				{
					echo "<div align=\"center\" style=\"height:20px; color: #C00; font-size: 15px; margin: 10px 0; text-align:center\">You didn't send any file.</div>";	
				}
				?>
                </ul>
                
              </div>
            </div>
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
