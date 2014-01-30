<?php
if(!isset($_REQUEST["member_id"]))
{
    
}
else
$_SESSION["user_id"]=$_REQUEST["member_id"];
if(!isset($_REQUEST["pid"]))
	$pid=0;
else
	$pid=$_REQUEST["pid"];
?>
<br>
<h2>My Databagg</h2>
<hr>
<?php echo dirStructure($pid);?>
<div class="sub_container">
<?php
if($pid==0)
	$result=mysql_query("select * from users_data where int_uid='".$_SESSION['user_id']."' and int_status=1 and int_pid=0 and int_del_status=0 order by int_is_folder desc,txt_file_name asc") or die(mysql_error());
else
	$result=mysql_query("select * from users_data where int_uid='".$_SESSION['user_id']."' and int_status=1 and int_pid=" . $_REQUEST["pid"] . " and int_del_status=0 order by int_is_folder desc,txt_file_name asc") or die(mysql_error());
while($row=mysql_fetch_array($result))
	{
?>
<div class="main">
<a href="#" class="icon"><img src="<?php echo get_file_thumb($row['txt_file_type'],$row['txt_file_name']); ?>" alt="" /></a>
<div class="icon_sep">
	<h4>
<?php
if($row["txt_file_type"]=="folder")
	echo "<a href='app_index.php?name_page=app_mydatabagg&pid=" . $row["int_fid"] . "'>" . $row["txt_file_name"] . "</a>";
    else
    {
        ?>
    <a target="_blank" href="download.php?path=<?php echo $row['txt_real_path']; ?>" ><?php echo $row["txt_file_name"];  ?>   </a>
    <?php
    }
?></h4>
    <h6>Mofifiled: 2012-12-11 </h6>
</div>
<?php 
$select_code="select txt_shared_link from users_data where int_fid='".$row['int_fid']."'";
                   $result_code=mysql_query($select_code);
                   $fetch_code=mysql_fetch_array($result_code);
?>
<div class="share_btns">
	<?php if($row["txt_file_type"]=="folder") { ?>
    <a target="_blank" href="test_zip.php?path=<?php echo $row['txt_real_path']; ?>" class="download">Directory</a>
    <?php } else { ?>
    <a target="_blank" href="download.php?path=<?php echo $row['txt_real_path']; ?>" class="download">Directory</a>
    <?php } ?>
    <a target="_blank" title="<?php if($row['txt_file_type']=="folder")echo "Share This Folder"; else echo "Share This File";  ?> " href="files/index.php?code=<?php echo $fetch_code['txt_shared_link'] ?>&bagid=<?php echo base64_encode($_SESSION['user_id']); ?>" class="share">Upload</a>   
</div>
</div>
<?php
	}
?>
</div>

<?php
function dirStructure($pid)
	{
	$cnt=0;
	while($pid!=0)
		{
		$result=mysql_query("Select int_pid,txt_file_name from users_data where int_fid=" . $pid) or die(mysql_error());
		$row=mysql_fetch_array($result);
		$arr[$cnt]=$row["txt_file_name"];
		$arrid[$cnt]=$pid;
		$pid=$row["int_pid"];
		$cnt++;
		}

	$arr[$cnt]="Home";
	$arrid[$cnt]=0;

	for($i=count($arr)-1;$i>=0;$i--)
		echo "<a href='app_index.php?name_page=app_mydatabagg&pid=" . $arrid[$i] . "'>" . $arr[$i] . ">> </a>";
	}
?>