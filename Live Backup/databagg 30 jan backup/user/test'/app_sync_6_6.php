<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
if(!isset($_SESSION["user_id"]))
	$_SESSION["user_id"]=0;
$pid=0;
$issync=1;
$fromwhere="web";
if(isset($_REQUEST["member_id"]))
	$_SESSION["user_id"]=$_REQUEST["member_id"];

if(isset($_REQUEST["pid"]))
	$pid=$_REQUEST["pid"];
		
if(isset($_REQUEST["issync"]))
	$issync=$_REQUEST["issync"];

if(isset($_REQUEST["fromwhere"]))
	$fromwhere=$_REQUEST["fromwhere"];
	?>
<br>

<style>
 .black_overlay1{
			display: none;
			position: fixed;
			top: 0%;
			left: 0%;
			width: 100%;
			height: 100%;
			background-color: white;
			z-index:1001;
			-moz-opacity: 0.1;
			opacity:.10;
			filter: alpha(opacity=10);
		}
	
        .white_content1 {
			display: none;
			position: fixed;
			top: 50%;
			left: 40%;
		
            
			padding: 10px;
		
			background-color: white;
            background: transparent;
			z-index:1002;
			overflow: hidden;
           
		}
         .white_content2 {
			display: none;
			position: fixed;
			top: 35%;
			left: 10%;
		  width: 300px;
          height: 80px;
            
			padding: 10px;
		
			background-color: #fff;
           
			z-index:1002;
			overflow: hidden;
              border: 1px solid #78B0DE;
            box-shadow: 0 0 5px #78B0DE;
           
		}
</style>

<style type="text/css">

#dhtmltooltip{
position: absolute;

border: 2px solid #b6e4fb;
padding: 2px;

visibility: hidden;
z-index: 100;
/*Remove below line to remove shadow. Below line should always appear last within this CSS*/
filter: progid:DXImageTransform.Microsoft.Shadow(color=gray,direction=135);
}

</style>

<div id="dhtmltooltip"></div>

<script type="text/javascript">



var offsetxpoint=100 //Customize x offset of tooltip
var offsetypoint=-50 //Customize y offset of tooltip
var ie=document.all
var ns6=document.getElementById && !document.all
var enabletip=false
if (ie||ns6)
var tipobj=document.all? document.all["dhtmltooltip"] : document.getElementById? document.getElementById("dhtmltooltip") : ""

function ietruebody(){
return (document.compatMode && document.compatMode!="BackCompat")? document.documentElement : document.body
}

function ddrivetip(thetext, thecolor, thewidth){
    //alert(thetext);
    final_text='<img style="max-height:150px;max-width:150px;" src=\''+thetext+' \'>';
 
if (ns6||ie){
//if (typeof thewidth!="undefined") tipobj.style.width=thewidth+"px"
if (typeof thecolor!="undefined" && thecolor!="") tipobj.style.backgroundColor=thecolor
tipobj.innerHTML=final_text
enabletip=true
return false
}
}

function positiontip(e){
if (enabletip){
var curX=(ns6)?e.pageX : event.clientX+ietruebody().scrollLeft;
var curY=(ns6)?e.pageY : event.clientY+ietruebody().scrollTop;
//Find out how close the mouse is to the corner of the window
var rightedge=ie&&!window.opera? ietruebody().clientWidth-event.clientX-offsetxpoint : window.innerWidth-e.clientX-offsetxpoint-20
var bottomedge=ie&&!window.opera? ietruebody().clientHeight-event.clientY-offsetypoint : window.innerHeight-e.clientY-offsetypoint-20

var leftedge=(offsetxpoint<0)? offsetxpoint*(-1) : -1000

//if the horizontal distance isn't enough to accomodate the width of the context menu
if (rightedge<tipobj.offsetWidth)
//move the horizontal position of the menu to the left by it's width
tipobj.style.left=ie? ietruebody().scrollLeft+event.clientX-tipobj.offsetWidth+"px" : window.pageXOffset+e.clientX-tipobj.offsetWidth+"px"
else if (curX<leftedge)
tipobj.style.left="5px"
else
//position the horizontal position of the menu where the mouse is positioned
tipobj.style.left=curX+offsetxpoint+"px"

//same concept with the vertical position
if (bottomedge<tipobj.offsetHeight)
tipobj.style.top=ie? ietruebody().scrollTop+event.clientY-tipobj.offsetHeight-offsetypoint+"px" : window.pageYOffset+e.clientY-tipobj.offsetHeight-offsetypoint+"px"
else
tipobj.style.top=curY+offsetypoint+"px"
tipobj.style.visibility="visible"
}
}

function hideddrivetip(){
if (ns6||ie){
enabletip=false
tipobj.style.visibility="hidden"
tipobj.style.left="-1000px"
tipobj.style.backgroundColor=''
tipobj.style.width=''
}
}

document.onmousemove=positiontip

</script>
 <div id="div_loading" class="white_content1" >
 
        
        <img src="images/ajax-loader_dir_load.gif" /> <b style="color:#E85005"> Loading ... </b> 
 </div>
 <div id="div_restrict" class="white_content2" >
 
         
         <a style="margin-left: 290px;"  href = "javascript:void(0)" onclick = "document.getElementById('div_restrict').style.display='none';document.getElementById('fade_loading').style.display='none';">
        
       <img src="image/close_u.png" />
        
        </a>
       
        <table  width='100%' border="0" cellspacing="0" cellpadding="0">
        <tr>
        <td width="15%" valign="middle">
        
        </td>
        <td valign='top' style="padding: 5px;">
         <b style="color:#E85005"> Unverified Account !  Please Verify it.  </b> 
         <br />
         Sharing feature is not avaialable <br /> for unverified members.
        </td>
        </tr>
        </table>
         
        <img src="images/alert.png" style="position: absolute;margin-top: -45px;" />
 </div>
 
 
 <div id="fade_loading" class="black_overlay1"></div>

<h2>View All Devices</h2>
<hr>
<?php echo dirStructure($pid);?>
<div class="sub_container">
<?php
if($pid==0)
	$result=mysql_query("select * from users_data where int_uid='".$_SESSION['user_id']."'  and int_pid=0 and int_is_sync=" . $issync . " order by int_is_folder desc,txt_file_name asc") or die(mysql_error());
else
	$result=mysql_query("select * from users_data where int_uid='".$_SESSION['user_id']."' and int_pid=" . $_REQUEST["pid"] . " order by int_is_folder desc,txt_file_name asc") or die(mysql_error());
while($row=mysql_fetch_array($result))
	{
	   generate_code($row['int_fid'],1);
?>
<div class="main">
<?php 
 if($row['txt_file_type']=="image/jpeg" || $row['txt_file_type']=="image/png" || $row['txt_file_type']=="image/gif" || $row['txt_file_type']=="image/jpg")
{
?>
<a href="#" class="icon" onmouseover="ddrivetip('<?php echo $row['txt_real_path']; ?>','white', 300);" onmouseout="hideddrivetip();" ><img src="<?php echo get_file_thumb($row['txt_file_type'],$row['txt_file_name']); ?>" alt="" /></a>
<?php
}
else
{
?>
<a href="#" class="icon"  ><img src="<?php echo get_file_thumb($row['txt_file_type'],$row['txt_file_name']); ?>" alt="" /></a>
<?php
}
?>
<div class="icon_sep">
	<h4>
<?php
if($row["txt_file_type"]=="folder")
{

	echo "<a href='app_index.php?name_page=app_sync&pid=" . $row["int_fid"] . "'>" . $row["txt_file_name"] . "</a>";
 }
    else
    {
        ?>
    <a target="_blank" href="download.php?path=<?php echo $row['txt_real_path']; ?>" ><?php echo $row["txt_file_name"];  ?>   </a>
    <?php
    }
?></h4>
    <h6><?php 
	if($row["txt_file_type"]!="folder")
		echo setFileSize($row["int_file_size"]) . "<br>";
	echo setModifiedDate($row["int_mod_date"],$row["int_mod_time"]); ?> </h6>
</div>
<?php 
$select_code="select txt_share_link from tab_share where int_fid='".$row['int_fid']."'";
                   $result_code=mysql_query($select_code);
                   $fetch_code=mysql_fetch_array($result_code);
?>
<div class="share_btns">
	<?php if($row["txt_file_type"]=="folder") { ?>
    <a target="_blank" href="test_zip_ext.php?path=<?php echo $row['int_fid']; ?>&nm=<?php echo $row["txt_file_name"];?>" class="download">Directory</a>
    <?php } else { ?>
    <a target="_blank" href="download.php?path=<?php echo $row['txt_real_path']; ?>" class="download">Directory</a>
    <?php } ?>
    <?php
    $select_user_data="select * from tab_members where int_id='".$_SESSION['user_id']."'";
$result_user_data=mysql_query($select_user_data) or die(mysql_error());
$fetch_user_data=mysql_fetch_array($result_user_data);
 if($fetch_user_data['int_verified']==0)
                                                 {
                                                    ?>
                                                     <a  title="<?php if($row['txt_file_type']=="folder")echo "Share This Folder"; else echo "Share This File";  ?> " href="javascript:restrict();" class="share">Upload</a><?php
                                                 }
                                                 else
                                                 {
                                                ?>
                                                 <a target="_blank" title="<?php if($row['txt_file_type']=="folder")echo "Share This Folder"; else echo "Share This File";  ?> " href="files/index.php?code=<?php echo $fetch_code['txt_share_link'] ?>&bagid=<?php echo base64_encode($_SESSION['user_id']); ?>" class="share">Upload</a><?php
                                               } 
    ?>    
      


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
		echo "<a href='app_index.php?name_page=app_sync&pid=" . $arrid[$i] . "&issync=1'>" . $arr[$i] . ">> </a>";
	}
?>
<script>
function restrict()
	{
	document.getElementById('div_restrict').style.display='block';
	document.getElementById('fade_loading').style.display='block';
	}
</script>