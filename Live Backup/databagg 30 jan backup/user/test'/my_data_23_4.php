<?php
//session_start();
//if(!$_SESSION['user_id'])
//header("Location:login.php");
//error_reporting(0);
if($_REQUEST['type'])
$_SESSION['type']=$_REQUEST['type'];
else
$_SESSION['type']='playlist';
//include("connect.php");
//include("function.php");

if(!isset($_SESSION['class_list']))
$_SESSION['class_list']="field1";
//session_start();
if($_REQUEST['page_type']=='video')
$_SESSION['page_type']="video";
else if($_REQUEST['page_type']=='gallary')
$_SESSION['page_type']="gallary";
else if($_REQUEST['page_type']=='music')
$_SESSION['page_type']="";

if($_REQUEST['total_box_item'])
{
    
    $ids=$_REQUEST['total_box_item'];
    if($_SESSION['type']=='playlist')
    $delete_multiple="delete from category_data where int_cat_id in ($ids)";
    else
    $delete_multiple="update users_data set int_del_status='1' where int_fid in ($ids)";
    
    mysql_query($delete_multiple)or die(mysql_error());
    $suc_msg="Deleted successfully.";
}
if($_REQUEST['total_box_item_custom'])
{
    
    $ids_custom=str_replace("on,","",$_REQUEST['total_box_item_custom']);
    
    $ids=substr($ids_custom,0,strlen($ids_custom)-1);
    if($_SESSION['type']=='playlist')
    $delete_multiple="delete from category_data where int_cat_id in ($ids)";
    else
    $delete_multiple="update users_data set int_del_status='1' where int_fid in ($ids)";
    
    mysql_query($delete_multiple)or die(mysql_error());
    $suc_msg="Deleted successfully.";
}

//create playlist
if(isset($_REQUEST['pl_name']))
{
    //print_r($_REQUEST['select_item']);
    $tot_fid="";
    foreach ($_REQUEST['select_item'] as $selectedOption)
    {
     $tot_fid.=$selectedOption;
     $tot_fid.=",";   
    //print_r($selectedOption);
    }
    $tot_fid=substr($tot_fid,0,strlen($tot_fid)-1);
    
    
    if ($_SESSION['page_type']=="gallary")
        $insert_playlist="insert into category_data (txt_cat_type,txt_cat_name,int_uid,txt_fid,int_status) values('Gallary','".$_REQUEST['pl_name']."','".$_SESSION['user_id']."','".$tot_fid."',1)";
        else if ($_SESSION['page_type']=="video")
        $insert_playlist="insert into category_data (txt_cat_type,txt_cat_name,int_uid,txt_fid,int_status) values('Video','".$_REQUEST['pl_name']."','".$_SESSION['user_id']."','".$tot_fid."',1)";
        else
        $insert_playlist="insert into category_data (txt_cat_type,txt_cat_name,int_uid,txt_fid,int_status) values('Playlist','".$_REQUEST['pl_name']."','".$_SESSION['user_id']."','".$tot_fid."',1)";
        mysql_query($insert_playlist)or die(mysql_error());
}

//rename file and folder
if($_REQUEST['file_name'])
{
    //print_r($_REQUEST);
    if($_REQUEST['playlist_name']>0)
    {
        $select_fid="select txt_fid from category_data where int_cat_id='".$_REQUEST['playlist_name']."'";
        $result_fid=mysql_query($select_fid) or die(mysql_error());
        $fetch_fid=mysql_fetch_array($result_fid);
        if($fetch_fid['txt_fid']=="")
        {
            $update_playlist="update category_data set txt_fid='".$_REQUEST['file_id']."' where int_cat_id='".$_REQUEST['playlist_name']."' ";
            mysql_query($update_playlist);
        }
        else
        {
            $newfids=$fetch_fid['txt_fid'].",".$_REQUEST['file_id'];
            $update_playlist="update category_data set txt_fid='".$newfids."' where int_cat_id='".$_REQUEST['playlist_name']."' ";
            mysql_query($update_playlist);
        }
    }
    else
    {
        
        if ($_SESSION['page_type']=="gallary")
        $insert_playlist="insert into category_data (txt_cat_type,txt_cat_name,int_uid,txt_fid,int_status) values('Gallary','".$_REQUEST['new_list_name']."','".$_SESSION['user_id']."','".$_REQUEST['file_id']."',1)";
        else if ($_SESSION['page_type']=="video")
        $insert_playlist="insert into category_data (txt_cat_type,txt_cat_name,int_uid,txt_fid,int_status) values('Video','".$_REQUEST['new_list_name']."','".$_SESSION['user_id']."','".$_REQUEST['file_id']."',1)";
        else
        $insert_playlist="insert into category_data (txt_cat_type,txt_cat_name,int_uid,txt_fid,int_status) values('Playlist','".$_REQUEST['new_list_name']."','".$_SESSION['user_id']."','".$_REQUEST['file_id']."',1)";
        mysql_query($insert_playlist)or die(mysql_error());
        
    }
    
}


//create new directory with all its quality
if($_REQUEST['del_id_2'])
{
     $delete_file="delete from  category_data where int_cat_id='".$_REQUEST['del_id_2']."'";
    mysql_query($delete_file) ;
     //$description='Deleted: '.$upload->upload_dir.$upload->the_file;
          // log_entry($description);
          $suc_msg="Deleted successfully.";
}
if($_REQUEST['del_id'])
{
    $delete_file="update users_data set int_del_status=1 where int_fid='".$_REQUEST['del_id']."'";
    mysql_query($delete_file) ;
     //$description='Deleted: '.$upload->upload_dir.$upload->the_file;
          // log_entry($description);
          $suc_msg="Deleted successfully.";
}
//pagination
    $tableName="users_data";		
	$targetpage = "index.php?name_page=my_data"; 	
	$limit = 3; 
    if ($_SESSION['page_type']=="gallary")
    {
      $condition="txt_file_type in ('image/jpeg','image/png','image/gif','image/jpg','application/png','application/x-png','image/pjpeg','image/x-xbitmap','image/bmp','image/x-bmp')";  
    }
    else if ($_SESSION['page_type']=="video")
    {
      $condition="txt_file_type in ('video/mp4','audio/mp4','video/x-flv','audio/3gpp','video/3gpp','video/x-ms-wmv')";  
    }
    else
    {
       $condition="txt_file_type in ('audio/mpeg','audio/x-wav','audio/mp3','audio/wav','audio/ogg','audio/x-mp3', 'audio/mpeg3', 'audio/x-mpeg3', 'audio/mpg', 'audio/x-mpg', 'audio/x-mpegaudio','audio/mid', 'audio/m', 'audio/midi', 'audio/x-midi', 'application/x-midi', 'audio/soundtrack')";   
    }
	if($_REQUEST['s'])
    {
	$query = "SELECT COUNT(*) as num FROM $tableName where int_uid='".$_SESSION['user_id']."' and int_status=1  and int_del_status=0 and $condition and txt_file_name like '%".$_REQUEST['s']."%'";
	}
    else
    $query = "SELECT COUNT(*) as num FROM $tableName where int_uid='".$_SESSION['user_id']."' and int_status=1  and int_del_status=0 and $condition";
    $total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages[num];
	
	$stages = 3;
	$page = mysql_escape_string($_GET['page']);
	if($page){
		$start = ($page - 1) * $limit; 
	}else{
		$start = 0;	
		}	
    
    
    if($_REQUEST['s'])
    {
    if($_REQUEST['sorting_opt']==2)
     $select_data="select * from users_data where int_uid='".$_SESSION['user_id']."' and int_status=1  and int_del_status=0 and $condition and txt_file_name like '%".$_REQUEST['s']."%' order by txt_file_name asc LIMIT $start, $limit";
    else if($_REQUEST['sorting_opt']==3)
     $select_data="select * from users_data where int_uid='".$_SESSION['user_id']."' and int_status=1  and int_del_status=0 and $condition and txt_file_name like '%".$_REQUEST['s']."%' order by txt_last_modified desc LIMIT $start, $limit";
    else
     $select_data="select * from users_data where int_uid='".$_SESSION['user_id']."' and int_status=1  and int_del_status=0 and $condition and txt_file_name like '%".$_REQUEST['s']."%' order by int_file_size desc LIMIT $start, $limit";
     }
     else
     {
         if($_REQUEST['sorting_opt']==2)
     $select_data="select * from users_data where int_uid='".$_SESSION['user_id']."' and int_status=1  and int_del_status=0 and $condition order by txt_file_name asc LIMIT $start, $limit";
    else if($_REQUEST['sorting_opt']==3)
     $select_data="select * from users_data where int_uid='".$_SESSION['user_id']."' and int_status=1  and int_del_status=0 and $condition order by txt_last_modified desc LIMIT $start, $limit";
    else
    $select_data="select * from users_data where int_uid='".$_SESSION['user_id']."' and int_status=1  and int_del_status=0 and $condition order by int_file_size desc LIMIT $start, $limit";
     
     }
     $result_data=mysql_query($select_data) or die(mysql_query());  
     
     	if ($page == 0){$page = 1;}
	$prev = $page - 1;	
	$next = $page + 1;							
	$lastpage = ceil($total_pages/$limit);		
	$LastPagem1 = $lastpage - 1;					
	
	
	$paginate = '';
	if($lastpage > 1)
	{	
	

	
	
		$paginate .= "<div class='paginate'>";
		// Previous
		if ($page > 1){
			$paginate.= "<a href='$targetpage&page=$prev'>previous</a>";
		}else{
			$paginate.= "<span class='disabled'>previous</span>";	}
			

		
		// Pages	
		if ($lastpage < 7 + ($stages * 2))	// Not enough pages to breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page){
					$paginate.= "<span class='current'>$counter</span>";
				}else{
					$paginate.= "<a href='$targetpage&page=$counter'>$counter</a>";}					
			}
		}
		elseif($lastpage > 5 + ($stages * 2))	// Enough pages to hide a few?
		{
			// Beginning only hide later pages
			if($page < 1 + ($stages * 2))		
			{
				for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage&page=$counter'>$counter</a>";}					
				}
				$paginate.= "...";
				$paginate.= "<a href='$targetpage&page=$LastPagem1'>$LastPagem1</a>";
				$paginate.= "<a href='$targetpage&page=$lastpage'>$lastpage</a>";		
			}
			// Middle hide some front and some back
			elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
			{
				$paginate.= "<a href='$targetpage&page=1'>1</a>";
				$paginate.= "<a href='$targetpage&page=2'>2</a>";
				$paginate.= "...";
				for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage&page=$counter'>$counter</a>";}					
				}
				$paginate.= "...";
				$paginate.= "<a href='$targetpage&page=$LastPagem1'>$LastPagem1</a>";
				$paginate.= "<a href='$targetpage&page=$lastpage'>$lastpage</a>";		
			}
			// End only hide early pages
			else
			{
				$paginate.= "<a href='$targetpage&page=1'>1</a>";
				$paginate.= "<a href='$targetpage&page=2'>2</a>";
				$paginate.= "...";
				for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage&page=$counter'>$counter</a>";}					
				}
			}
		}
					
				// Next
		if ($page < $counter - 1){ 
			$paginate.= "<a href='$targetpage&page=$next'>next</a>";
		}else{
			$paginate.= "<span class='disabled'>next</span>";
			}
			
		$paginate.= "</div>";		
	
	
}

//print_r($_SESSION);
//print_r($_REQUEST);
?>



    <style>
        .renamediv {
            
			  -moz-border-radius:3px;
    -webkit-border-radius:3px;
    border-radius:3px;
			background-color: white;
			z-index:1002;
			overflow: hidden;
            border: 1px solid #78B0DE;
            box-shadow: 0 0 5px #78B0DE;
            display: block;
			position: fixed;
			top: 10%;
			left: 35%;
			width: 30%;
			height: 5%;
			padding: 16px;
		
			
			z-index:2000;
			overflow: auto;
            
        }
        .brt_ren{
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
    width: auto;
    border-radius: 3px;
        }
        .brt_ren:hover{color: #FFF; background: #00a2dd; border:1PX solid #0093c8 !important;}
        .txt_ren{
            border: 1px solid #e5e5e5; width: 300px; padding: 4px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.3), 0 0 0 #000000 inset;
        }
        </style>
<link href='http://fonts.googleapis.com/css?family=PT+Sans:400' rel='stylesheet' type='text/css'>
<style type="text/css">

.black_overlay{
			display: none;
			position: fixed;
			top: 0%;
			left: 0%;
			width: 100%;
			height: 100%;
			background-color: black;
			z-index:1001;
			-moz-opacity: 0.4;
			opacity:.40;
			filter: alpha(opacity=40);
		}
		.white_content {
			display: none;
			position: fixed;
			top: 20%;
			left: 28%;
			width: 600px;
		    min-height: 30%;
            font-family: 'PT Sans', sans-serif;
			padding: 10px;
		    -moz-border-radius:3px;
    -webkit-border-radius:3px;
    border-radius:3px;
			background-color: white;
			z-index:1002;
			overflow: hidden;
            border: 1px solid #78B0DE;
            box-shadow: 0 0 5px #78B0DE;
		}
</style>

<link href="css/ui-lightness/jquery-ui-1.8.14.custom.css" rel="stylesheet" type="text/css" />
<link href="css/fileUploader.css" rel="stylesheet" type="text/css" />

<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.14.custom.min.js" type="text/javascript"></script>
<script src="js/jquery.fileUploader.js" type="text/javascript"></script>

<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
<!--<script type="text/javascript" src="js/lightbox.js"></script> -->
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />

<link rel="stylesheet" type="text/css" href="css/balloontip.css" />
<link href="css/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/default.advanced.css" media="screen" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/balloontip.js"></script>
<script>
	var xmlhttp;
function testXML(){

	if(window.XMLHttpRequest)
  {
	//code for IE7 and hiegher version
	xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=ActiveXObject("Microsoft.XMLHTTP");
	}
return xmlhttp;	
}

function changeView(str)
{   //alert("sasa");  

    //var lastclass="<?php if($_SESSION['class_list']) echo $_SESSION['class_list']; else echo "field1"; ?>";
		var strURL="ajax_change_class.php?add="+str;
        //alert(strURL);
		var req = testXML();
		
		if (req) {
			
			req.onreadystatechange = function() {
			 
				if (req.readyState == 4) {
					
					// only if "OK"
					if (req.status == 200) {
					
						//alert(req.responseText);
                        if(req.responseText=="success")
                        {
                            //location.reload(); 
                          changeView1(str);
                        
                        }
                        		
						
					} else {
					//	alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	
}


</script>
<script>
	var lastclass="<?php echo $_SESSION['class_list']; ?>";
	function changeView1(str1)
		{
		var obj= document.getElementsByClassName(lastclass)
		var list= new Array(obj.length)
		for(i=0; i<obj.length;i++)
			list[i]=obj[i]

		for(i=0; i<list.length; i++)
			list[i].className=str1
		lastclass=str1	
		}
</script>

</head>
<?php
if($suc_msg)
$_REQUEST['err']="";
?>

<body style="font-family: 'PT Sans', sans-serif;" <?php if($err_msg || $suc_msg || $_REQUEST['err']) { ?> onload = "autoHide();" <?php } ?>">


<?php
//total used
 //$select_total_used="select sum(int_file_size) as total from users_data where int_uid='".$_SESSION['user_id']."'";
//$result_total=mysql_query($select_total_used);
//$fetch_total=mysql_fetch_array($result_total);
//$total_mb=($fetch_total['total']/1024)/1024;
//echo "<font color='red'>".number_format($total_mb,2)."MB of 5GB Used </font>";
?>
<div class="fleft" style="background: #fff; width: 852px; margin: 0 0 0 -3px; overflow: hidden;">
<div class="container">
<center>
 <?php
     if($err_msg)
     {
        ?>
        <div class="error" id="error_container">
         <strong>&times;</strong> <?php echo $err_msg; ?>

        </div>
        <?php
     }
     ?>
     <?php
       if($suc_msg)
     {
        ?>
        <div class="success" id="error_container1">
         <strong>&radic;</strong> <?php echo $suc_msg; ?>

        </div>
        <?php
     }
     ?>
     <?php
       if($_REQUEST['err'])
     {
        ?>
        <div class="error" id="error_container2">
         <strong>&times;</strong> <?php echo "File already exists. Please try with another name"; ?>

        </div>
        <?php
     }
     ?>
</center>
<style>
.paginate {
font-family:Arial, Helvetica, sans-serif;
	padding: 3px;
	margin: 3px;
}

.paginate a {
	padding:2px 5px 2px 5px;
	margin:2px;
	border:1px solid #999;
	text-decoration:none;
	color: #666;
}
.paginate a:hover, .paginate a:active {
	border: 1px solid #999;
	color: #000;
}
.paginate span.current {
    margin: 2px;
	padding: 2px 5px 2px 5px;
		border: 1px solid #999;
		
		font-weight: bold;
		background-color: #999;
		color: #FFF;
	}
	.paginate span.disabled {
		padding:2px 5px 2px 5px;
		margin:2px;
		border:1px solid #eee;
		color:#DDD;
	}
	
	
	
</style>
<h1>
<?php if ($_SESSION['page_type']=="gallary") 
echo "My Gallery"; 
else if ($_SESSION['page_type']=="video") 
echo "My Video";
else
echo "My Music"; ?>

</h1>
<div class="fleft large_social">
	<a class="small" href="javascript:changeView('field1')" rel="balloon1">small</a>
	<a class="large" href="javascript:changeView('small-field1')" rel="balloon2">large</a>
	<a class="extra_large" href="javascript:changeView('large-field1')" rel="balloon3">extra large</a>
</div>
<!--<form action="#" id="searchform" method="post">
            <fieldset id="search">
                <input type="text" id="s" name="s" onclick="this.value='';" value="<?php if($_REQUEST['s']) echo $_REQUEST['s']; else "Search Music"; ?>" style="width: 200px;">
                <input type="image" class="btn" id="searchsubmit" value="Search" src="images/btn-search.gif" onmouseover="this.src='images/search_icon.gif';" onmouseout="this.src='images/btn-search.gif';" name="" style="margin-left:-5px;">
            </fieldset>
        
        </form>  -->
<div id="balloon1" class="balloonstyle">
small
</div>
<div id="balloon2" class="balloonstyle">
Large
</div>
<div id="balloon3" class="balloonstyle">
Ex Large
</div>



 

    
    <div id="light" class="white_content" >
         <a style="margin-left: 575px;"  href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none';">
        
       <img src="image/close_u.png" />
        
        </a>
        
        </div>
        <div id="fade" class="black_overlay"></div>
<div class="fleft width" style="margin-top:20px;">
<hr >
<div class="sep width"></div>
<style>
a.sp{
    text-decoration: none;
    color: grey;
}
a.sp:hover
{
    color: red;
}

</style>
<?php if ($_SESSION['page_type']=="gallary") { ?>
<button class="brt_ren" style="margin-bottom: 20px;" >Create Album</button>
<!-- <a class="sp" href="index.php?name_page=my_data&type=music"> Images  </a>  / <a class="sp" href="index.php?name_page=my_data&type=playlist">Gallery</a> -->
<?php } 
else if ($_SESSION['page_type']=="video") { ?>
<button class="brt_ren" style="margin-bottom: 20px;" >Create Video Gallary</button>
<!--<a class="sp" href="index.php?name_page=my_data&type=music"> Videos  </a>  / <a class="sp" href="index.php?name_page=my_data&type=playlist">Video Gallary</a>-->
<?php
}else { ?>
<button class="brt_ren" style="margin-bottom: 20px;" >Create Playlist</button>
<!--<a class="sp" href="index.php?name_page=my_data&type=music"> Songs  </a>  / <a class="sp" href="index.php?name_page=my_data&type=playlist">Playlists</a>-->
    <?php } ?>
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
</head>
<body>






<script>
$("button").click(function () {
$("#p1").toggle("slow");
});
</script>
        <br />
        <?php
         if(mysql_num_rows($result_data)>0)
         {
        ?>
        <form name="frm_sort" method="post" action="#">
        <p align="right" style="display: none;">
        Sort by
        <select name="sorting_opt" onchange="document.frm_sort.submit()">
        <option value="1" selected >Size</option>
        <option value="2" <?php if($_REQUEST['sorting_opt']==2) echo "selected"; ?>>Name</option>
        <option value="3" <?php if($_REQUEST['sorting_opt']==3) echo "selected"; ?>>Date</option>
        </select>
        </p>
        <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
        </form>
       
        
        <!-- select all / deselect all -->
<!-- <input type="checkbox" onchange="checkedAll()"  class="fleft" id="top_check" />  -->
 <?php
        }
        ?>
 <div id="test" class="chk_msg" >
 <a href="javascript:void(0);" onclick="delete_confirm();" style="text-decoration: none;color: white;">  Delete All </a>
 
 </div>
 <div id="test_selected" class="chk_msg"  >
 <a href="javascript:void(0);" onclick="delete_confirm_selected();" style="text-decoration: none;color: white;">  Delete Selected </a>
 
 </div>
 <script>
 function delete_confirm()
 {
    if(confirm("Are you sure want to delete these files."))
    window.total_box.submit();
    
 }
  function delete_confirm_selected()
 {
    if(confirm("Are you sure want to delete these files."))
    window.total_box_custom.submit();
    
 }
 </script>
<form id="total_box" name="total_box" method="post" action="#">
<input type="hidden" name="total_box_item" id="total_box_item" />
<input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
</form>
<form id="total_box_custom" name="total_box_custom" method="post" action="#">
<input type="hidden" name="total_box_item_custom" id="total_box_item_custom" />
<input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
</form>
<script type="text/javascript">

 
function checkedAll () {
    if(document.getElementById('top_check').checked==false)
        checked = true;
        else
        checked=false;
    var tot_id="";
   
	var aa= document.getElementById('frm7');
	 if (checked == false)
          {
            document.getElementById('test_selected').style.display='none';
        document.getElementById('test').style.display='inline-block';
	
		var obj= document.getElementsByClassName(lastclass)
		var list= new Array(obj.length)
		for(i=0; i<obj.length;i++)
			list[i]=obj[i]

		for(i=0; i<list.length; i++)
			list[i].style.background="#c2dff7";
			
		
           checked = true
          }
        else
          {
            
	document.getElementById('test').style.display='none';
		var obj= document.getElementsByClassName(lastclass)
		var list= new Array(obj.length)
		for(i=0; i<obj.length;i++)
			list[i]=obj[i]

		for(i=0; i<list.length; i++)
			list[i].style.background="";
            
          checked = false
          }
	for (var i =0; i < aa.elements.length; i++) 
	{
    tot_id+=aa.elements[i].value;
    tot_id+=",";
    
	 aa.elements[i].checked = checked;
	}
    limit=tot_id.length-1;
    tot_id=tot_id.substr(0,limit);
    //alert(tot_id);
    document.getElementById('total_box_item').value=tot_id;
    //alert(tot_id.length);
      }
      
      
      function countcbox()
{
    var data_selected="";
    var myform = document.getElementById('frm7');
var inputTags = document.getElementsByTagName('input');
var checkboxCount = 0;
for (var i=0, length = inputTags.length; i<length; i++) {
     if (inputTags[i].type == 'checkbox') {
        if (inputTags[i].checked==true)
        {
         checkboxCount++;
         data_selected+=inputTags[i].value;
         data_selected+=",";
        }
     }
}
if(checkboxCount==0)

document.getElementById('test_selected').style.display='none';
else
{
//alert(data_selected);
document.getElementById('total_box_item_custom').value=data_selected;
document.getElementById('test_selected').style.display='inline-block';
}
}
</script>
       
 
<!--<form id="frm7" name="frm7"> -->
</div>
<link rel="stylesheet" href="css/tipsy.css" type="text/css" />
<div class="fieldn" class="fleft">
<center>


<form id="form1" name="form1" action="#" method="post">
       
      
       <div id="p1" style="display: none;">
        <?php
                $select_data="select * from users_data where int_uid='".$_SESSION['user_id']."' and int_status=1  and int_del_status=0 and $condition  order by txt_file_name asc ";
               $res_all_data=mysql_query($select_data);
               if(mysql_num_rows($res_all_data)>0)
               {
                ?>
       <table>
       <tr>
       <td colspan="2">
       &nbsp;
       </td>
       </tr>
       
                <tr>
                
                <td>
                <?php
                if ($_SESSION['page_type']=="gallary")
                echo "Album Name";
                else if ($_SESSION['page_type']=="video")
                echo "Video Gallary Name";
                else
                echo "Playlist Name";
                ?>
                
                </td>
                <td>
                <input type="text" name="pl_name" id="pl_name" class="txt_ren" style="margin-left: 5px;width: 290px" />
                </td>
                
                </tr>
                <tr>
       <td colspan="2">
       &nbsp;
       </td>
       </tr>
                <tr>
                
                <td>
                 <?php
                if ($_SESSION['page_type']=="gallary")
                echo "Select Photos";
                else if ($_SESSION['page_type']=="video")
                echo "Select Videos";
                else
                echo "Select Songs";
                ?>
                </td>
                <td>
                
              
                <select class="txt_ren" style="margin-left: 5px;" title="Select one or more item" size="<?php echo $total_pages+1; ?>" multiple="multiple" name="select_item[]" id="select_item">
                <?php
               while($fetch_select_data=mysql_fetch_array($res_all_data))
               { ?>
               <option value="<?php echo $fetch_select_data['int_fid']; ?>"><?php echo $fetch_select_data['txt_file_name']; ?></option>
               <?php
                }
                ?>
                </select>
              
                </td>
                
                </tr>
       <tr>
       <td colspan="2">
       &nbsp;
       </td>
       </tr>
       <tr>
       <td colspan="2" align="right">
       <input class="brt_ren" type="button" onclick="val_new_item()" value=" <?php
                if ($_SESSION['page_type']=="gallary")
                echo "Create Album";
                else if ($_SESSION['page_type']=="video")
                echo "Create Video Gallary";
                else
                echo "Create Playlist";
                ?>" />
       </td>
       </tr>
       <?php
       }
                else
                {
                    ?>
                      <div class="tipsy tipsy-n" style=" visibility: visible; display: block; opacity: 0.8;"><div class="tipsy-arrow"></div>
                <div class="tipsy-inner">No data available related to this section, Please upload first.</div></div>
                <br />
                <?php
                }
               ?>
       </table>
       </div>
        
        <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
        
        </form>
</center>
</div>
<script>
function val_new_item()
{
    if(document.getElementById('pl_name').value=="")
    {
        alert("Please enter a name.");
        document.getElementById('pl_name').focus();
        return false;
    }
    if(document.getElementById('select_item').value=="")
    {
        alert("Please select one or more item.");
        document.getElementById('select_item').focus();
        return false;
    }
    window.form1.submit();
}
</script>













<style type="text/css">
.slideshow {  width: 432px; display: none; z-index: 1001; margin-left: 200px;margin-top: -150px; }
.slideshow img { padding: 15px; border: 1px solid #44B3D3; background-color: #eee; }
</style>
<!-- include jQuery library -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<!-- include Cycle plugin -->
<script src="js/jquery.cycle.all.latest.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $.getScript('js/jquery.cycle.all.latest.js', function(){
    $('.slideshow').cycle({
		fx: 'fade' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
	});
    });
});
</script>
<link href="css/video-js.css" rel="stylesheet">
<script src="js/video.js"></script>
	

<?php
if($_SESSION['type']=='playlist')
{
    if ($_SESSION['page_type']=="gallary")
    {
    if($_REQUEST['s'])
    $select_play_list_files="select * from category_data where txt_cat_type='Gallary' and int_uid='".$_SESSION['user_id']."' and txt_cat_name like '%".$_REQUEST['s']."%'  and int_status='1' order by txt_cat_name asc ";
    else
    $select_play_list_files="select * from category_data where txt_cat_type='Gallary' and int_uid='".$_SESSION['user_id']."' and int_status='1' order by txt_cat_name asc ";
    }
    else if ($_SESSION['page_type']=="video")
    {
    if($_REQUEST['s'])
    $select_play_list_files="select * from category_data where txt_cat_type='Video' and int_uid='".$_SESSION['user_id']."' and txt_cat_name like '%".$_REQUEST['s']."%'  and int_status='1' order by txt_cat_name asc ";
    else
    $select_play_list_files="select * from category_data where txt_cat_type='Video' and int_uid='".$_SESSION['user_id']."' and int_status='1' order by txt_cat_name asc ";
    }
    else
    {
      if($_REQUEST['s'])
    $select_play_list_files="select * from category_data where txt_cat_type='Playlist' and int_uid='".$_SESSION['user_id']."' and txt_cat_name like '%".$_REQUEST['s']."%'  and int_status='1' order by txt_cat_name asc ";
    else
    $select_play_list_files="select * from category_data where txt_cat_type='Playlist' and int_uid='".$_SESSION['user_id']."' and int_status='1' order by txt_cat_name asc ";
      
    }
    $result_playlist_files=mysql_query($select_play_list_files) or die(mysql_error());
    if(mysql_num_rows($result_playlist_files)>0)
    {
    while($fetch_playlist_file=mysql_fetch_array($result_playlist_files))
    {
?>

<div class="<?php echo $_SESSION['class_list'];  ?>" class="fleft" id="div_<?php echo $fetch_playlist_file['int_cat_id']; ?>"  >

<div class="section1  ">
<div class="fleft">
<!--<input id="acceptTerms_<?php echo $fetch_playlist_file['int_cat_id']; ?>"  name="acceptTerms_<?php echo $fetch_playlist_file['int_cat_id']; ?>" type="checkbox" onchange="togglecolor(this.value,this.id);"  value="<?php echo $fetch_playlist_file['int_cat_id']; ?>"  />--> </div>
<div class="icon">

<?php if ($_SESSION['page_type']=="gallary") { ?>
<img src="images/album-1.png" />
<?php } else if ($_SESSION['page_type']=="video") { ?>
<img src="images/video.png" />
<?php }  
else { ?>
<img src="images/audio.png" />
<?php } ?>

</div>
<div class=" icon_sep">

	<h4 ><?php echo $fetch_playlist_file['txt_cat_name']; ?></h4>
    <h6>Total <?php if ($_SESSION['page_type']=="gallary") echo "Photos"; else if ($_SESSION['page_type']=="video") echo "Videos"; else  echo "Songs"; ?>: <?php echo totalfile($fetch_playlist_file['txt_fid']); ?></h6>
</div>

<div style="float:right; ">

       <ul id="nav" class="dropdown dropdown-horizontal">
                               
                               <li><a href="javascript:void(0);" class="delete_dropdown"></a>
                                       <ul class="position">
                                               
                                            
                                               <li> <a class="delete"  href="javascript:void(0);" onclick="verify1('<?php echo $fetch_playlist_file['int_cat_id']; ?>')"  > 
                                               <img  src="images/delete.png" style="width: 10px; height: 10px; " align='texttop' />&nbsp;Delete </a></li>
                                               <?php if($_SESSION['page_type']!="video"){ ?>
                                                <li> <a class="delete"  href="category/?code=<?php echo base64_encode($fetch_playlist_file['int_cat_id']); ?>" target="_blank"   > 
                                               <img  src="images/icon_share.gif" style="width: 10px; height: 10px; " align='texttop' />&nbsp;Share </a></li>
                                               <li> <a class="delete"  href="javascript:void(0)" onclick="load_list_modify_add('<?php echo $fetch_playlist_file['txt_fid']; ?>','<?php echo $fetch_playlist_file['int_cat_id']; ?>','<?php echo addslashes($condition); ?>');"   > 
                                               <img  src="images/addmore.png" style="width: 10px; height: 10px; " align='texttop' />&nbsp;Add More </a></li>
                                               <li> <a class="delete"  href="javascript:void(0)" onclick="load_list_modify('<?php echo $fetch_playlist_file['txt_fid']; ?>','<?php echo $fetch_playlist_file['int_cat_id']; ?>');"   > 
                                               <img  src="images/list-all.png" style="width: 10px; height: 10px; " align='texttop' />&nbsp;List All </a></li>
                                               <?php 
                                               }
                                               ?>
                                       </a></li>
                                       </ul>
                               </li>
                               
                       </ul></div>
                        <div class="share_btns">
       <style>
       .field1 .share_btns a.pbut{
	width:29px; height:29px; display:block; float:left; text-indent:-9999px; background:url(image/sprite.png) no-repeat -210px -69px; margin:0 4px 0 0;}
    .field1 .share_btns a.pbut:hover{
	width:29px; height:29px; display:block; float:left; text-indent:-9999px; background:url(image/sprite.png) no-repeat -246px -69px; margin:0 4px 0 0;}
    .small-field1 .share_btns a.pbut{
	width:19px; height:18px; display:block; float:left; text-indent:-9999px; background:url(image/sprite.png) no-repeat -133px -100px; margin:0 2px 0 0;}
    .small-field1 .share_btns a.pbut:hover{
	width:19px; height:18px; display:block; float:left; text-indent:-9999px; background:url(image/sprite.png) no-repeat -153px -100px; margin:0 2px 0 0;} 	
    .large-field1 .share_btns a.pbut{
	width:19px; height:18px; display:block; float:left; text-indent:-9999px; background:url(image/sprite.png) no-repeat -133px -100px; margin:0 2px 0 0;}
    .large-field1 .share_btns a.pbut:hover{
	width:19px; height:18px; display:block; float:left; text-indent:-9999px; background:url(image/sprite.png) no-repeat -153px -100px; margin:0 2px 0 0;}
       </style>
      
                   <?php if ($_SESSION['page_type']=="gallary") { ?>
                                                    <a title="Play as slideshow"  class="pbut" href="javascript:void(0);" onclick="create_slide('<?php echo $fetch_playlist_file['txt_fid']; ?>');" > play </a>
                                                    <?php } 
                                                    else if ($_SESSION['page_type']=="video") { ?>
                                                   <a title="Play this video gallary"  class="pbut" href="javascript:void(0);" onclick="open_list_div('<?php echo $fetch_playlist_file['txt_fid']; ?>');" > play </a>
                                                    <?php } else
                                                    {
                                                        ?>
                                                        <a title="Play This Playlist"  class="pbut" href="javascript:void(0);" onclick="big('<?php echo $fetch_playlist_file['txt_fid']; ?>');" > play </a>
                                                        <?php
                                                    }
                                                    ?>
                    
              
</div>            
                       

</div>
</div>


<?php
}
}
else
{
    $add_data="";
    if(isset($_REQUEST['s']))
    $add_data="which matches with your search string";
    
     if ($_SESSION['page_type']=="gallary")
                $dt= " Album";
                else if ($_SESSION['page_type']=="video")
                $dt= " Video Gallary";
                else
                $dt="Playlist";
    echo " <div class='fieldn'  > <center> <br> <br> <div class='error' style='width:500px;'> You currently don't have any $dt $add_data. Create your  $dt now. </div> </center></div>" ;
}
}
?>
<?php
if($_SESSION['type']=='music')
{
?>
<?php
 if(mysql_num_rows($result_data)>0)
        {
            while($fetch_data=mysql_fetch_array($result_data))
            {
                ?>
<div class="<?php echo $_SESSION['class_list'];  ?>" class="fleft" id="div_<?php echo $fetch_data['int_fid']; ?>" >
<div class="section1  ">
<div class="fleft">
<!--<input id="acceptTerms_<?php echo $fetch_data['int_fid']; ?>"  name="acceptTerms_<?php echo $fetch_data['int_fid']; ?>" type="checkbox" value="<?php echo $fetch_data['int_fid']; ?>" onchange="togglecolor(this.value,this.id);"   /> --> </div>

<div class="icon">

<?php if($fetch_data['txt_file_type']=="application/pdf") { ?>
                    <a href="download.php?path=../nas/uploads/<?php echo $fetch_data['txt_file_name']; ?>"> 
                    <?php 
                    }
                    else if($fetch_data['txt_file_type']=="folder")
                    {
                        ?>
                    <a href="javascript:void(0);" onclick="next_level(<?php echo $fetch_data['int_fid']; ?>);"> 
                        <?php
                    }
                    else if($fetch_data['txt_file_type']=="image/jpeg" || $fetch_data['txt_file_type']=="image/png" || $fetch_data['txt_file_type']=="image/gif" || $fetch_data['txt_file_type']=="image/jpg" || $fetch_data['txt_file_type']=="image/bmp")
                    {
                    ?>
                    
                 <a href="<?php echo $fetch_data['txt_real_path'];  ?>" rel="lightbox[plants1]">  
                  <?php
                  }
                   else 
                    {
                    ?>
                    
                 <a href="">  
                  <?php
                  }
                  ?>
<img src="<?php echo get_file_thumb($fetch_data['txt_file_type'],$fetch_data['txt_file_name']); ?>" />  </a>

</div>
<div class=" icon_sep">
	<h4 >
    
    <?php
    if($fetch_data['txt_file_type']=="image/jpeg" || $fetch_data['txt_file_type']=="image/png" || $fetch_data['txt_file_type']=="image/gif" || $fetch_data['txt_file_type']=="image/jpg" || $fetch_data['txt_file_type']=="image/bmp")
     {
        ?>
        <a href="<?php echo $fetch_data['txt_real_path'];  ?>" rel="lightbox[plants]"> 
        <?php
     echo $fetch_data['txt_file_name'];
    
     ?>
     </a>
     <?php
   }
     else
     {
       echo $fetch_data['txt_file_name']; 
     }
     ?>
    
    
    </h4>
    <h6> <?php echo "Modified: ".date("Y-m-d",$fetch_data['txt_last_modified']); ?></h6>
</div>


<div style="float:right; ">
       <ul id="nav" class="dropdown dropdown-horizontal">
                               
                               <li><a href="javascript:void(0);" class="delete_dropdown"></a>
                                       <ul class="position">
                                               
                                               <li>	
                                               <?php if ($_SESSION['page_type']=="gallary") { ?>
<a href="javascript:void(0);" onclick="open_rename_div('<?php echo $fetch_data['int_fid'];  ?>','<?php echo $fetch_data['txt_file_name'];  ?>')"> 
<img  src="images/add-tiny-white.gif" style="width: 10px; height: 10px; " align='texttop' />&nbsp;Add to Album </a>
<?php } 
else if ($_SESSION['page_type']=="video") { ?>
<a href="javascript:void(0);" onclick="open_rename_div('<?php echo $fetch_data['int_fid'];  ?>','<?php echo $fetch_data['txt_file_name'];  ?>')"> 
<img  src="images/add-tiny-white.gif" style="width: 10px; height: 10px; " align='texttop' />&nbsp;Add to Video Gallary </a>
<?php }
else { ?>
<a href="javascript:void(0);" onclick="open_rename_div('<?php echo $fetch_data['int_fid'];  ?>','<?php echo $fetch_data['txt_file_name'];  ?>')"> 
<img  src="images/add-tiny-white.gif" style="width: 10px; height: 10px; " align='texttop' />&nbsp;Add to playlist </a>
<?php } ?>
                                               </li>
                                               <li><a class="delete" href="javascript:void(0);" onclick="verify(<?php echo $fetch_data['int_fid']; ?>)">
                                               <img  src="images/delete.png" style="width: 10px; height: 10px; " align='texttop' />&nbsp; Delete </a></li>
                                               
                                       </a></li>
                                       </ul>
                               </li>
                               
                       </ul></div>


</div>
</div>
<?php
}
    }
    else
    {
    ?>
    <div class="width fleft" style="text-align: center;margin-top:25px ;"> 
<img src="image/nofile_found.jpg" />
</div>
    <?php
    }

}
?>
</form>
<div style="float: left; width: 100%;display: block;">
<?php
if($_SESSION['type']=='music')
{
 echo $paginate;
 }
  ?>
</div>
<script>
function togglecolor(val,id)
{iddiv="div_"+val;

    if(document.getElementById(id).checked)
    {
        
       document.getElementById(iddiv).style.background="#c2dff7";
    }
    else
    
    {
      
       
        document.getElementById(iddiv).style.background="";
    document.getElementById('test').style.display='none';
    document.getElementById('top_check').checked=false;
        
    }
countcbox();
}


</script>


<style>

#search {
    float: right;
    height: 25px;
  
    
}

#search input {
    background: url("images/search-bgr.gif") repeat-x scroll center top transparent;
    border: 1px solid #FFFFFF;
    float: left;
    padding: 8px;
    
}
</style>

</div>
 <form id="del_form" name="del_form" method="post" action="#">
        <input type="hidden" value="" id="del_id" name="del_id" />
        <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
        </form>
        <form id="del_form_2" name="del_form_2" method="post" action="#">
        <input type="hidden" value="" id="del_id_2" name="del_id_2" />
        <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
        </form>
         <form id="new_dir_form" name="new_dir_form" method="post" action="#">
        <input type="hidden" value="" id="new_dir_name" name="new_dir_name" />
        <input type="hidden" value="" id="new_word_name" name="new_word_name" />
         <input type="hidden" value="" id="new_excel_name" name="new_excel_name" />
          <input type="hidden" value="" id="new_text_name" name="new_text_name" />
          <input type="hidden" value="" id="new_ppt_name" name="new_ppt_name" />
        <input type="hidden" value="" id="new_dir_id" name="new_dir_id" />
        <input type="hidden" value="" id="new_word_id" name="new_word_id" />
        <input type="hidden" value="" id="new_excel_id" name="new_excel_id" />
        <input type="hidden" value="" id="new_text_id" name="new_text_id" />
        <input type="hidden" value="" id="new_ppt_id" name="new_ppt_id" />
        <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
        </form>
        <style>
        .renamediv {
            
			display: block;
			position: fixed;
			top: 25%;
			left: 35%;
			width: 35%;
			height: 20%;
			padding: 16px;
		
			background-color: gray;
			z-index:2000;
			overflow: auto;
            
        }
        .listdiv {
            
			display: none;
			position: fixed;
			top: 25%;
			left: 30%;
		
			
		
            
        }
        </style>
        
         <div class="music_pattern listdiv" id="list_div" style="display: none;width: 655px;border-radius: 0; border: 1px solid #78B0DE;
            box-shadow: 0 0 5px #78B0DE;">
          <div class="music_close" onclick="document.getElementById('list_div').style.display='none';">
          <img src="image/close_u.png" alt="close" /></div>
         <br />
         <div id="loading_container">
  
    <img src="images/ajax-loader.gif"/>
    <br />
    Loading..
            
 </div>
       <!-- <a href="javascript:void(0);" onclick="document.getElementById('list_div').style.display='none';" >close</a> -->
       
    </div>
    
    <div class="music_pattern listdiv" id="rename_div">
    <form id="frm_rename" name="frm_rename" method="post" action="#">
 <h1><?php if ($_SESSION['page_type']=="gallary") echo "Image "; else if ($_SESSION['page_type']=="video") echo "Video "; else echo "Music "; ?> <span>G</span>allery</h1>
 <div class="music_close" ><img src="image/close_music.png" style="cursor: pointer;"  onclick="document.getElementById('rename_div').style.display='none';" /></div>
 <h6><span id="ttl"></span></h6>
 <input type="hidden" id="file_name" name="file_name" />
 <div class="fleft pad-15 mar-8">
 <p>Add to <?php if ($_SESSION['page_type']=="gallary") echo "Album: "; else if ($_SESSION['page_type']=="video") echo "Video: "; else echo "PlayList: "; ?> 
  <select   class="select_box" id="playlist_name" name="playlist_name" onchange="enable_disable(this.value);">
    <option value="0">-Select-</option>
    <?php 
    if ($_SESSION['page_type']=="gallary")
    $select_playlist="select * from category_data where txt_cat_type='Gallary' and int_uid='".$_SESSION['user_id']."' and int_status=1";
    else if ($_SESSION['page_type']=="video")
    $select_playlist="select * from category_data where txt_cat_type='Video' and int_uid='".$_SESSION['user_id']."' and int_status=1";
    else
    $select_playlist="select * from category_data where txt_cat_type='Playlist' and int_uid='".$_SESSION['user_id']."' and int_status=1";
    $result_playlist=mysql_query($select_playlist) or die(mysql_error());
    while($fetch_playlist=mysql_fetch_array($result_playlist))
    {
     ?>
    <option value="<?php echo $fetch_playlist['int_cat_id']; ?>"><?php echo $fetch_playlist['txt_cat_name']; ?></option>
    
    <?php
    }
    ?>
    </select>
   
   </p>
    <p>&nbsp;Custom <?php if ($_SESSION['page_type']=="gallary") echo "Album "; else if ($_SESSION['page_type']=="video") echo "Video Galarry "; else echo "PlayList "; ?> Name 
  <input type="text" id="new_list_name" name="new_list_name" class="search_box" />
    </p>
    
 </div>
 
 
 <div class="fleft save_y mar-8" onclick="submit_rename_data()">Save</div>
  <div class="fleft delete_b mar-8" onclick="document.getElementById('rename_div').style.display='none';" >Cancel</div>
 <input type="hidden" id="file_name_prev" name="file_name_prev" />
    <input type="hidden" id="file_id" name="file_id" />
    <input type="hidden" id="file_folder" name="file_folder" />
    <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
 </form>
 </div>
    <style>
    .close_b {
font-family: “Helvetica Neue”, Helvetica Neue, Helvetica, Arial, sans-serif;
color: #686868;
font-size: 14px;
font-weight: bold;
border: 1px solid #AFAFAF;
-webkit-text-shadow: 0 1px 0 rgba(255, 255, 255, 0.8);
text-shadow: 0 1px 0 rgba(255, 255, 255, 0.8);
-webkit-box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.15);
box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.15);
padding: 5px;
cursor: pointer;
width: 50px;
height: 16px;
margin-left: 635px;
}
</style>
    </style>
    <div class="slideshow"  id="slide_show_dynamic" style="float: left;">

	</div>
    <div id="close_icn" style="display: none;" class="close_b" >
    <a onclick=" document.getElementById('slide_show_dynamic').style.display='none'; document.getElementById('close_icn').style.display='none';">Close</a>
    </div>
    
    <input type="hidden" id="refresh_cond" />
</body>
</html>
<script>
function open_list_div(cat_id)
{
   document.getElementById('list_div').style.display='block'; 
   load_data(cat_id);
}
function open_rename_div(id,name)
{
    document.getElementById('rename_div').style.display='block';
    document.getElementById('file_name').value=name;
    document.getElementById('file_id').value=id;
    document.getElementById('ttl').innerHTML=name;
    document.getElementById('file_name_prev').value=name;
}
function enable_disable(id)
{   //alert(id);
    if(id>0) {
        document.getElementById('new_list_name').value="";
        document.getElementById('new_list_name').setAttribute('disabled', true);}
     else {
       
        document.getElementById('new_list_name').disabled=false; }
}
function trim(data)
{
    return data.replace(/^\s+|\s+$/g,'');
}
function submit_rename_data()
{
    
    if(trim(document.getElementById('new_list_name').value)=="" &&  document.getElementById('playlist_name').value==0)
    {
    alert("Please provide a new playlist name.");
    document.getElementById('new_list_name').focus();
    return false;
    }
    document.frm_rename.submit();
}

function verify1(did)
{
    
    
    if(confirm("Are you sure to delete this file for permanent. "))
    {
    document.getElementById('del_id_2').value=did;
    document.del_form_2.submit();
    }
}
function verify(did)
{
    
    
    if(confirm("Are you sure to delete this file. "))
    {
    document.getElementById('del_id').value=did;
    document.del_form.submit();
    }
}
function togle(type)
{
    if(type=="folder")
    {
    if(document.getElementById('new_dir').style.display=="none")
    {
    document.getElementById('new_dir').style.display="block";
    document.getElementById('txt_new_dir').focus();
    }
    else
    {
    document.getElementById('new_dir').style.display="none";
    
    }
    }
    if(type=="doc")
    {
    if(document.getElementById('new_word').style.display=="none")
    {
    document.getElementById('new_word').style.display="block";
    document.getElementById('txt_new_word').focus();
    }
    else
    {
    document.getElementById('new_word').style.display="none";
    
    }
    }
     if(type=="excel")
    {
    if(document.getElementById('new_excel').style.display=="none")
    {
    document.getElementById('new_excel').style.display="block";
    document.getElementById('txt_new_excel').focus();
    }
    else
    {
    document.getElementById('new_excel').style.display="none";
    
    }
    }
    if(type=="txt")
    {
    if(document.getElementById('new_text').style.display=="none")
    {
    document.getElementById('new_text').style.display="block";
    document.getElementById('txt_new_text').focus();
    }
    else
    {
    document.getElementById('new_text').style.display="none";
    
    }
    }
    if(type=="ppt")
    {
    if(document.getElementById('new_ppt').style.display=="none")
    {
    document.getElementById('new_ppt').style.display="block";
    document.getElementById('txt_new_ppt').focus();
    }
    else
    {
    document.getElementById('new_ppt').style.display="none";
    
    }
    }
}
function submit_data(type)
{
    if(type=="folder")
    {
    document.getElementById('new_dir').style.display="none";
    document.getElementById('new_dir_id').value=1;
    document.getElementById('new_dir_name').value=document.getElementById('txt_new_dir').value;
    }
    if(type=="doc")
    {
    document.getElementById('new_word').style.display="none";
    document.getElementById('new_word_id').value=1;
    document.getElementById('new_word_name').value=document.getElementById('txt_new_word').value;
    }
    if(type=="excel")
    {
    document.getElementById('new_excel').style.display="none";
    document.getElementById('new_excel_id').value=1;
    document.getElementById('new_excel_name').value=document.getElementById('txt_new_excel').value;
    }
    if(type=="txt")
    {
    document.getElementById('new_text').style.display="none";
    document.getElementById('new_text_id').value=1;
    document.getElementById('new_text_name').value=document.getElementById('txt_new_text').value;
    }
    if(type=="ppt")
    {
    document.getElementById('new_ppt').style.display="none";
    document.getElementById('new_ppt_id').value=1;
    document.getElementById('new_ppt_name').value=document.getElementById('txt_new_ppt').value;
    }
    document.new_dir_form.submit();
}
function next_level(id)
{
    location.href="home.php?dir="+id;
}
function autoHide()
{  //hide after 5 seconds
   setTimeout(function(){document.getElementById('error_container').style.display='none';},5000);
   setTimeout(function(){document.getElementById('error_container1').style.display='none';},5000);
}
</script>
<script>
	var xmlhttp;
function testXML(){

	if(window.XMLHttpRequest)
  {
	//code for IE7 and hiegher version
	xmlhttp=new XMLHttpRequest();
	}
	else
	{
		xmlhttp=ActiveXObject("Microsoft.XMLHTTP");
	}
return xmlhttp;	
}

function load_data(str)
{
		var strURL="ajax_load_list.php?cat_id="+str;

		var req = testXML();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					
					// only if "OK"
					if (req.status == 200) {
					
						
                        if(req.responseText=="failed")
                        {
                        
                        return false;
                        
                        }
                        else
                        {
                            //alert(req.responseText);
                            document.getElementById('loading_container').innerHTML=req.responseText;
                            
                        }
                       				
						
					} else {
					//	alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	
}
function load_list_modify(str,strid)
{
		var strURL="ajax_load_list_music_image.php?cat_id="+str+"&main_id="+strid;
        //alert(strURL);
		var req = testXML();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					
					// only if "OK"
					if (req.status == 200) {
					
						
                        if(req.responseText=="failed")
                        {
                        
                        return false;
                        
                        }
                        else
                        {
                            //alert(req.responseText);
                            document.getElementById('light').style.display='block';
                            document.getElementById('fade').style.display='block';
                            document.getElementById('light').innerHTML='<a style="margin-left: 575px;"  href = \'javascript:void(0)\' onclick = "document.getElementById(\'light\').style.display=\'none\';document.getElementById(\'fade\').style.display=\'none\';rld();"><img src="image/close_u.png" > </a><br>';
                            document.getElementById('light').innerHTML+=req.responseText;
                            altRows('alternatecolor');
                        }
                       				
						
					} else {
					//	alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	
}
function load_list_modify_add(str,strid,condition)
{
		var strURL="ajax_add_list_music_image.php?cat_id="+str+"&main_id="+strid+"&condition="+condition;
        //alert(strURL);
		var req = testXML();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					
					// only if "OK"
					if (req.status == 200) {
					
						
                        if(req.responseText=="failed")
                        {
                        
                        return false;
                        
                        }
                        else
                        {
                            //alert(req.responseText);
                            document.getElementById('light').style.display='block';
                            document.getElementById('fade').style.display='block';
                            document.getElementById('light').innerHTML='<a style="margin-left: 575px;"  href = \'javascript:void(0)\' onclick = "document.getElementById(\'light\').style.display=\'none\';document.getElementById(\'fade\').style.display=\'none\';rld();"><img src="image/close_u.png" > </a><br>';
                            document.getElementById('light').innerHTML+=req.responseText;
                            altRows('alternatecolor');
                        }
                       				
						
					} else {
					//	alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	
}



function create_slide(str)
{
    
    	var strURL="ajax_create_slide_show.php?cat_id="+str;

		var req = testXML();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					
					// only if "OK"
					if (req.status == 200) {
					
						
                        if(req.responseText=="failed")
                        {
                        
                        return false;
                        
                        }
                        else
                        {
                            //alert(req.responseText);
                            document.getElementById('slide_show_dynamic').style.display='block';
                            //document.getElementById('fade').style.display='block';
                            document.getElementById('close_icn').style.display='block';
                            document.getElementById('slide_show_dynamic').innerHTML=req.responseText;
                             $('.slideshow').cycle({
		               fx:    'shuffle', 
    delay: -4000 
	                               });
                        }
                       				
						
					} else {
					//	alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	
}


</script>
<script type="text/javascript">
function altRows(id){
	if(document.getElementsByTagName){  
		
		var table = document.getElementById(id);  
		var rows = table.getElementsByTagName("tr"); 
		 
		for(i = 0; i < rows.length; i++){          
			if(i % 2 == 0){
				rows[i].className = "evenrowcolor";
			}else{
				rows[i].className = "oddrowcolor";
			}      
		}
	}
}
//window.onload=function(){
//	altRows('alternatecolor');
//    
//}
</script>

<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
<link href='files/fonts/font.css' rel='stylesheet' type='text/css'>

<style type="text/css">

.heading_t{
    font-family: 'geoslab703_md_btbold';
    color: #15a0c8;
    font-size: 20px;
    padding-bottom: 5px;
}


table.altrowstable {
font-family: 'PT Sans', sans-serif;
	font-size:14px;
	color:#333333;
	border-width: 1px;
	border-color: #e5e5e5;
    margin-top: 10px;
	
}
table.altrowstable th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: black;
}
table.altrowstable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #e5e5e5;
}
.oddrowcolor{
	background-color:#fff;
    border: 1px solid #e5e5e5;
}
.evenrowcolor{
	border: 1px solid #e5e5e5;
    background-color:#eee;
}

.delhov:hover{
    background: url(image/delete_hover.png);
}
.addhov:hover{
   background: url(image/addmore_hover.png); 
}

</style>


<script>
function remove_list(str,category_id)
{
		var strURL="ajax_remove_list.php?id="+str+"&cat_id="+category_id;
//alert(strURL);
		var req = testXML();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					
					// only if "OK"
					if (req.status == 200) {
					
						
                        if(req.responseText=="failed")
                        {
                        
                        return false;
                        
                        }
                        else
                        {
                           document.getElementById('refresh_cond').value='1';
                           // alert(req.responseText);
                            //alert("Item successfully deleted from the list");
                           //window.location.reload();
                        }
                       				
						
					} else {
					//	alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	
}

function add_list(str,category_id)
{
		var strURL="ajax_add_list.php?id="+str+"&cat_id="+category_id;
//alert(strURL);
		var req = testXML();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					
					// only if "OK"
					if (req.status == 200) {
					
						
                        if(req.responseText=="failed")
                        {
                        
                        return false;
                        
                        }
                        else
                        {
                             document.getElementById('refresh_cond').value='1';
                           // alert(req.responseText);
                            //alert("Item successfully added into the list");
                           //window.location.reload();
                        }
                       				
						
					} else {
					//	alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}		
	
}



function hide_item(id,category_id)
{
    if(confirm("Are you sure to delete this one ?"))
    {
    remove_list(id,category_id);
    
    document.getElementById(id).style.display='none';
    
    }
}
function hide_item_add(id,category_id)
{
    if(confirm("Are you sure to add this one into list ?"))
    {
    add_list(id,category_id);
    
    document.getElementById(id).style.display='none';
    
    }
}
function rld()
{
   if(document.getElementById('refresh_cond').value=='1')
    window.location.reload();
}
</script>