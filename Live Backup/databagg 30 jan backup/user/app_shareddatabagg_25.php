<?php
$_SESSION["user_id"]=1;
if(!isset($_REQUEST["pid"]))
	$pid=0;
else
	$pid=$_REQUEST["pid"];

if(isset($_REQUEST['unshare_id']))
{
    $delete_multiple="update users_data set  int_is_shared=0 where int_fid='".$_REQUEST['unshare_id']."'";
    mysql_query($delete_multiple)or die(mysql_error());
    $suc_msg="Unshared successfully.";
    
}

?>
<br>
<h2>My Databagg</h2>
<hr>
<?php echo dirStructure($pid);?>
<div class="sub_container">
<?php

	$result=mysql_query("select * from users_data where int_uid='".$_SESSION['user_id']."' and int_status=1 and int_is_shared=1  and int_del_status=0 order by int_is_folder desc,txt_file_name asc") or die(mysql_error());
while($row=mysql_fetch_array($result))
	{
?>
<div class="main">
<a href="#" class="icon"><img src="<?php echo get_file_thumb($row['txt_file_type'],$row['txt_file_name']); ?>" alt="" /></a>
<div class="icon_sep">
	<h4>
<?php

	echo  $row["txt_file_name"] ;  ?>
</h4>
    <h6>Mofifiled: 2012-12-11 </h6>
</div>
<?php 
$select_code="select txt_shared_link from users_data where int_fid='".$row['int_fid']."'";
                   $result_code=mysql_query($select_code);
                   $fetch_code=mysql_fetch_array($result_code);
?>
<div class="share_btns">
	    <a  title="<?php if($row['txt_file_type']=="folder")echo "Unshare This Folder"; else echo "Unshare This File";  ?> " href="javascript:void(0);" onclick="verify(<?php echo $row['int_fid']; ?>)" class="share">Upload</a>   
</div>
</div>
<?
	}
?>
</div>

 <form id="unshare" name="unshare" method="post" action="#">
   <input type="hidden" id="unshare_id" name="unshare_id" />
    <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
   </form>

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
		echo "<a href='app_index.php?name_page=app_shareddatabagg&pid=" . $arrid[$i] . "'>" . $arr[$i] . ">> </a>";
	}
?>


<script>
function verify(did)
{
    
    
    if(confirm("Are you sure to unshare this file. "))
    {
    document.getElementById('unshare_id').value=did;
    document.unshare.submit();
    }
}

</script>