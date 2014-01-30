<?php
error_reporting(0);
session_start();
include("include/config.php");

if(isset($_REQUEST['code']) && $_REQUEST['code'])
{
	$code = $_REQUEST['code'];
	$sql = "select * from filedata where filecode='$code'";
	$query = mysql_query($sql);
	$row = mysql_fetch_array($query);

	// Link expiration
	$sqldate = $row['expiry_date'];
	$sqldate_connvrt = strtotime($sqldate);
	$expire_date = $sqldate_connvrt;
	$now = date("Y-m-d H:i:s", time());
	$now_conversion = strtotime($now);
	
}

// no. of file sent
$countfiles = mysql_num_rows(mysql_query("select * from tbl_files where filescode='$code'"));

$path = $root."/shares.php?code=".$row['filecode'];
?>

<?php
	include("include/header.php");
?>

      <!--form right section start here-->
      <div class="form_rightsection">
        <div class="form_topbg"><img src="images/fromtopbg.png" width="772" height="40" alt="#" /></div>
        <div class="form_midbg">
          <div class="form_contentcontainer">
            <div class="form_contentstep2">
              <h3>
			  <?php echo "<span>".$row['sendermail']."</span> sent you $countfiles file(s)"; ?></h3>
              
              <?php
				if($row["message"]!="")
				{
					echo "<div style=\"padding:0 0 0 10px;\">".$row['message']."</div>";
				}
				?>
                
              <div class="form_userdetails">
                <h2>Download the Files</h2>
                <ul>
                <?php
					$sql1 = "select * from tbl_files where filescode='$code'";
					$query1 = mysql_query($sql1);
					while($row1 = mysql_fetch_array($query1))
					{
						if ($expire_date>$now_conversion)
						{
							$availabity = "<div class=\"butdownload\"><a href=download.php?code=".$code."&filename=".$row1['file_name']." class=\"butdownload\"></a></div>";
						}
						else
						{
							$availabity = "<div class=\"link-expired\">Link Expired</div>";
						}
						
						//=========== Get the icon image regarding file extension
						//$extension = pathinfo($row1['file_name'], PATHINFO_EXTENSION); //Get extension of file
						if(preg_match("/(\.jpg|\.png|\.gif|\.bmp|\.jpeg)$/i",$row1['file_name'])){
							$image_icon = "<img src=\"images/icon_file/jpg.png\" alt=\"#\" />";	//Image files
						}
						else if(preg_match("/(\.mp3|\.wav)$/i",$row1['file_name'])){
							$image_icon = "<img src=\"images/icon_file/mp3.png\" alt=\"#\" />";	//Audio files
						}
						else if(preg_match("/(\.3gp|\.avi|\.flv|\.mkv|\.mov|\.mp4|\.mpeg|\.mpg|\.wmv)$/i",$row1['file_name'])){
							$image_icon = "<img src=\"images/icon_file/3gp.png\" alt=\"#\" />";	//Video files
						}
						else if(preg_match("/(\.doc|\.docx)$/i",$row1['file_name'])){
							$image_icon = "<img src=\"images/icon_file/doc.png\" alt=\"#\" />";	//DOC files
						}
						else if(preg_match("/(\.xls|\.xlsx)$/i",$row1['file_name'])){
							$image_icon = "<img src=\"images/icon_file/xls.png\" alt=\"#\" />";	//XLS files
						}
						else if(preg_match("/(\.ppt|\.pptx)$/i",$row1['file_name'])){
							$image_icon = "<img src=\"images/icon_file/ppt.png\" alt=\"#\" />";	//PPT files
						}
						else if(preg_match("/(\.txt)$/i",$row1['file_name'])){
							$image_icon = "<img src=\"images/icon_file/txt.png\" alt=\"#\" />";	//Text files
						}
						else if(preg_match("/(\.zip)$/i",$row1['file_name'])){
							$image_icon = "<img src=\"images/icon_file/zip.png\" alt=\"#\" />";	//Zip files
						}
						else if(preg_match("/(\.rar)$/i",$row1['file_name'])){
							$image_icon = "<img src=\"images/icon_file/rar.png\" alt=\"#\" />";	//Zip files
						}
						else if(preg_match("/(\.pdf)$/i",$row1['file_name'])){
							$image_icon = "<img src=\"images/icon_file/pdf.png\" alt=\"#\" />";	//PDF files
						}
						else{
							$image_icon = "<img src=\"images/icon_file/other.png\" alt=\"#\" />";	// Others
						}
						//========
						
						//============= Size Calculation
						if ($row1['file_size'] / 1024 > 1)
						{
							if ((($row1['file_size'] / 1024) / 1024) > 1) 
							{ 
								$file_size = (round((($row1['file_size'] / 1024) / 1024) * 100) / 100)." GB";	// in GB
							}
							else
							{ 
								$file_size = (round(($row1['file_size'] / 1024) * 100) / 100)." MB";	// in MB
							} 
						}
						else 
						{
							$file_size = (round($row1['file_size'] * 100) / 100)." KB";	// in KB
						}
						//========
						
						echo "<li>
						<div class=\"icon\">".$image_icon."</div>
						<div class=\"filename\">".$row1['file_name']."</div><div class=\"filesize\">".$file_size."</div>".$availabity."</li>";		
					}
				?>
                </ul>
                
                <div style="height:55px;"></div>
                <ul>
                <?php
					$expirydate = date('M d, Y \a\t H:i A \I\S\T',$sqldate_connvrt);
				?>
                <li><b>Link expires: </b> <?php echo $expirydate; ?></li>
                </ul>
              </div>
            </div>
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
