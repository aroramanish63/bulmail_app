<?php
if(isset($_REQUEST['type']))
$_SESSION['page_type']=$_REQUEST['type'];
else
$_SESSION['page_type']="video";

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
<h2>My 
<?php
if ($_SESSION['page_type']=="picture")
            {
            echo "Gallery";
            }
            else if($_SESSION['page_type']=="video")
    {
        echo "Videos";
        
    }
    else
    echo "Playlists";
?>
</h2>
<hr>

<?php $tp=$_SESSION['page_type']; if($pid>0) echo "<a href='app_index.php?name_page=app_mycollection&type=$tp' >Back </a> "; ?>
<div class="sub_container">
<?php
if($pid!=0)
{
	   
             
 $select_play_list_files="select * from category_data where int_cat_id='".$pid."' and  int_uid='".$_SESSION['user_id']."' and int_status='1'";
              
           
}
else
{
        if ($_SESSION['page_type']=="picture")
            {
            
            $select_play_list_files="select * from category_data where txt_cat_type='Gallary' and int_uid='".$_SESSION['user_id']."' and int_status='1' order by txt_cat_name asc ";
            }
            else if ($_SESSION['page_type']=="video")
            {
           
            $select_play_list_files="select * from category_data where txt_cat_type='Video' and int_uid='".$_SESSION['user_id']."' and int_status='1' order by txt_cat_name asc ";
            }
            else
            {
             
            $select_play_list_files="select * from category_data where txt_cat_type='Playlist' and int_uid='".$_SESSION['user_id']."' and int_status='1' order by txt_cat_name asc ";
              
            }
           
        	
}
$result=mysql_query($select_play_list_files) or die(mysql_error());
if($pid==0)
{
while($row=mysql_fetch_array($result))
	{
?>
<div class="main">
<a href="#" class="icon">
<?php if ($_SESSION['page_type']=="picture") { ?>
<img src="images/album-1.png" />
<?php } else if ($_SESSION['page_type']=="video") { ?>
<img src="images/video.png" />
<?php }  
else { ?>
<img src="images/audio.png" />
<?php } ?>
</a>
<div class="icon_sep">
	<h4>
<?php

	echo "<a href='app_index.php?name_page=app_mycollection&type=$tp&pid=" . $row["int_cat_id"] . "'>" . $row["txt_cat_name"]."</a>";
?></h4>
   <h6>Total <?php if ($_SESSION['page_type']=="picture") echo "Photos"; else if ($_SESSION['page_type']=="video") echo "Videos"; else  echo "Songs"; ?>: <?php echo totalfile($row['txt_fid']); ?></h6>
</div>

<div class="share_btns">
	<a href="test_coll.php?path=<?php echo $row['int_cat_id'];  ?>" class="download">Directory</a>
   <!-- <a href="#" class="share">Upload</a>   -->
</div>
</div>
<?php
	}
    
    }
    else
    {
        
        $fetch_items_details=mysql_fetch_array($result);
        $file_id=$fetch_items_details['txt_fid'];
        
        
    
      $select_exist="select * from users_data where int_fid in ($file_id) and int_del_status=0 ";
        $res_exist=mysql_query($select_exist);
        while($row=mysql_fetch_array($res_exist))
	{
       
        ?>
        
        <div class="main">
        
       <a href="#" class="icon">
       <?php if($row['txt_file_type']=="image/jpeg" || $row['txt_file_type']=="image/png" || $row['txt_file_type']=="image/gif" || $row['txt_file_type']=="image/jpg")
                    {
                    
                    ?>
                    <img src="<?php echo $row['txt_real_path'];  ?>" />
                
                  <?php
                  } else {  ?>
<img src="<?php echo get_file_thumb($row['txt_file_type'],$row['txt_file_name']); ?>" /> 
            <?php } ?>
       </a>
       
        <div class="icon_sep">
        	<h4>
            <a href="download.php?path=<?php echo $row['txt_real_path'];  ?>" > 
        <?php
    if($row['txt_file_type']=="image/jpeg" || $row['txt_file_type']=="image/png" || $row['txt_file_type']=="image/gif" || $row['txt_file_type']=="image/jpg")
     {
        ?>
        
        <?php
     echo $row['txt_file_name'];
    
     ?>
    
     <?php
   }
     else
     {
       echo $row['txt_file_name']; 
     }
     ?>
      </a></h4>
           <h6>
           <?php echo "Modified: ".date("Y-m-d",$row['txt_last_modified']); ?>
           </h6>
        </div>
        
        <div class="share_btns">
        	<a href="download.php?path=<?php echo $row['txt_real_path'];  ?>" class="download">Download</a>
          <!--  <a href="#" class="share">Upload</a>  -->  
        </div>
        </div>
        
        
        <?php
    }
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