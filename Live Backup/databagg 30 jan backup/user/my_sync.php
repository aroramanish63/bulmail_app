<?php
//session_start();
//if(!$_SESSION['user_id'])
//header("Location:login.php");
//
//include("connect.php");
error_reporting(E_ALL);
ini_set("display_errors",1);
include("../include_user/common_function.php");
include("../include_user/drive_functions.php");
include("../include_user/upload_functions.php");
include("../include_user/dir_functions.php");
include("../include_user/space_functions.php");
include("../include_user/rename_functions.php");
include("../include_user/delete_functions.php");
////session_start();
error_reporting(0);
//print_r($_SESSION);

if(!isset($_SESSION['class_list']))
$_SESSION['class_list']="field1";
//rename file and folder
function get_parent_details($parrent_id)
{
    $select_local_path_info="select txt_local_path,txt_pc_name from users_data where int_fid='".$parrent_id."'";
	$result_local_path=mysql_query($select_local_path_info);
	$fetch_local_path_info3=mysql_fetch_array($result_local_path);
	return $fetch_local_path_info3;

}

if($_REQUEST['del_id'])
{
      // print_r($_REQUEST); 
      $fetch_parent_data=get_parent_details($_REQUEST['dir']);
      $fetch_current_data=get_parent_details($_REQUEST['del_id']);
      doDelete($_SESSION['user_id'],$fetch_parent_data['txt_pc_name'],$fetch_current_data['txt_local_path'],'');
      $suc_msg="File deleted successfully.";
}

if($_REQUEST['total_box_item'])
   
    {
        $ids=$_REQUEST['total_box_item'];
       
        $arr_del=explode(",",$ids);
       // print_r($arr_del);
        
        foreach($arr_del as $del)
        {
            
                
           $fetch_parent_data=get_parent_details($_REQUEST['dir']);
		  $fetch_current_data=get_parent_details($del);
		  doDelete($_SESSION['user_id'],$fetch_parent_data['txt_pc_name'],$fetch_current_data['txt_local_path'],'');
            
           
       
        
        }
        //
        $suc_msg="Deleted successfully.";
    }
    
if($_REQUEST['total_box_item_custom'])
   
    {
       // print_r($_REQUEST);
        $ids_custom=str_replace("on,","",$_REQUEST['total_box_item_custom']);
        
        $ids=substr($ids_custom,0,strlen($ids_custom)-1);
        
         $arr_del=explode(",",$ids);
		   // print_r($arr_del);
			
			foreach($arr_del as $del)
			{
				$fetch_parent_data=get_parent_details($_REQUEST['dir']);
				$fetch_current_data=get_parent_details($del);
				doDelete($_SESSION['user_id'],$fetch_parent_data['txt_pc_name'],$fetch_current_data['txt_local_path'],'');
			}
        
       
        	$suc_msg="Deleted successfully.";
    }

if($_REQUEST['file_name'])
   
    {
        if(trim($_REQUEST['file_name'])=="")
        $err_msg="Please provide a new name .";
        if (strpbrk(trim($_REQUEST['file_name']), "\\/?%*:|\"<>") == TRUE)
        $err_msg="New name contains  illegal character.";
        else
        {
		  // print_r($_REQUEST);
		  		$fetch_parent_data=get_parent_details($_REQUEST['dir']);
		  		$oldname=$fetch_parent_data['txt_local_path']."|".$_REQUEST['file_name_prev'];
		  		$newname=$fetch_parent_data['txt_local_path']."|".$_REQUEST['file_name'];
		   		doRename($_SESSION['user_id'],$fetch_parent_data['txt_pc_name'],$oldname,$newname);
		   //rename_file($_REQUEST['file_name'],$_REQUEST['file_id'],$_REQUEST['file_name_prev'],$_REQUEST['file_folder']);
				$suc_msg="Renamed successfully.";
        }
    }



//create new directory with all its quality
if($_REQUEST['new_dir_id'])
{
    
    
    if (strpbrk($_REQUEST['new_dir_name'], "\\/?%*:|\"<>") == TRUE)
    $err_msg="Name contains  illegal character.";
    else
        {   
           $fetch_parent_details=get_parent_details($_REQUEST['parent_id']);
             $localpath=$fetch_parent_details['txt_local_path']."|".urldecode($_REQUEST['new_dir_name']);
            
            doFolderCreate($_SESSION['user_id'],$fetch_parent_details['txt_pc_name'],$localpath,$_REQUEST['new_dir_name'],'',date("Ymd"),date("His"),'','','web');
            
          
        	$suc_msg="Folder created successfully.";
        }
}

function add_new_files($nm,$type,$pid)
{
    
        $extension=$type;
        $randomnumber=createRandomNumber(30,true) . date("YmdHisu") . rand();
        //$realpath=$upload->upload_dir. $randomnumber . "." . $extension;
        $fname=$randomnumber . "." . $extension;
        $nm=$nm.".".$extension;
        $fetch_parent_details=get_parent_details($pid);
             $localpath=$fetch_parent_details['txt_local_path']."|".urldecode($nm);
    
     $drive_name=getActiveDrive(10);
    checkDriveDirForMember($_SESSION['user_id'],$drive_name,'');
    
    $basic_path=$drive_name."/"."uploads/".$_SESSION['user_id']."/sync/";
    $realpath=$basic_path."".$fname;
    $realpath1="../".$basic_path."".$fname;
    if($extension=="ppt")
    copy("temp_files/temp.ppt",$realpath1);
    if($extension=="doc")
    copy("temp_files/temp.doc",$realpath1);
    if($extension=="xls")
    copy("temp_files/temp.xls",$realpath1);
    if($extension=="txt")
    copy("temp_files/temp.txt",$realpath1);
    

       doFileUpload($_SESSION['user_id'],$fetch_parent_details['txt_pc_name'],$localpath,urldecode($nm),'',date("Ymd"),date("His"),$realpath,'','web');
         
    
    
}

if($_REQUEST['new_ppt_id'])
{
   
    if (strpbrk($_REQUEST['new_ppt_name'], "\\/?%*:|\"<>") == TRUE)
    $err_msg="Name contains  illegal character.";
    else
        {   
          add_new_files($_REQUEST['new_ppt_name'],"ppt",$_REQUEST['parent_id']) ;
        $suc_msg="File created successfully.";
        }
}
if($_REQUEST['new_excel_id'])
{
   
    if (strpbrk($_REQUEST['new_excel_name'], "\\/?%*:|\"<>") == TRUE)
    $err_msg="Name contains  illegal character.";
    else
        {   
           add_new_files($_REQUEST['new_excel_name'],"xls",$_REQUEST['parent_id']) ;
        $suc_msg="File created successfully.";
        }
}
if($_REQUEST['new_text_id'])
{
   
    if (strpbrk($_REQUEST['new_text_name'], "\\/?%*:|\"<>") == TRUE)
    $err_msg="Name contains  illegal character.";
    else
        {   
          add_new_files($_REQUEST['new_text_name'],"txt",$_REQUEST['parent_id']) ;
        $suc_msg="File created successfully.";
        }
}
if($_REQUEST['new_word_id'])
{
   
    if (strpbrk($_REQUEST['new_word_name'], "\\/?%*:|\"<>") == TRUE)
    $err_msg="Name contains  illegal character.";
    else
        {   
            add_new_files($_REQUEST['new_word_name'],"doc",$_REQUEST['parent_id']) ;
        $suc_msg="File created successfully.";
        }
}


//remove all history when home page lode
if($_REQUEST['dir']=="")
{
$_SESSION['dir']="";
$_SESSION['dir1']="";
$_SESSION['new_id']="";
}

//session for sorting
if($_REQUEST['sorting_opt']==2)
$_SESSION['sorting_opt']=2;
if($_REQUEST['sorting_opt']==3)
$_SESSION['sorting_opt']=3;


//use session based array for history traverse and listing of data
if(!$_REQUEST['s'])
$_REQUEST['s']="";
if($_REQUEST['dir'])
{  
   
    if($_SESSION['sorting_opt']==2)
    $select_data="select * from users_data where int_is_sync=1 and int_uid='".$_SESSION['user_id']."' and int_status=1 and txt_file_name like '%".$_REQUEST['s']."%' and int_del_status=0 and int_pid='".$_REQUEST['dir']."'  order by int_is_folder desc,txt_file_name asc";
    else if($_SESSION['sorting_opt']==3)
    $select_data="select * from users_data where int_is_sync=1 and int_uid='".$_SESSION['user_id']."' and int_status=1 and txt_file_name like '%".$_REQUEST['s']."%' and int_del_status=0 and int_pid='".$_REQUEST['dir']."'  order by int_is_folder desc,txt_last_modified desc";
    else
    $select_data="select * from users_data where int_is_sync=1 and int_uid='".$_SESSION['user_id']."' and int_status=1 and txt_file_name like '%".$_REQUEST['s']."%' and int_del_status=0 and int_pid='".$_REQUEST['dir']."'  order by int_is_folder desc,int_file_size desc ";
    $result_data=mysql_query($select_data) ;
}
else
{

    if($_SESSION['sorting_opt']==2)
     $select_data="select * from users_data where int_is_sync=1 and int_uid='".$_SESSION['user_id']."' and int_status=1 and txt_file_name like '%".$_REQUEST['s']."%' and int_pid=0 and int_del_status=0 order by int_is_folder desc,txt_file_name asc";
    else if($_SESSION['sorting_opt']==3)
     $select_data="select * from users_data where int_is_sync=1 and int_uid='".$_SESSION['user_id']."' and int_status=1 and txt_file_name like '%".$_REQUEST['s']."%' and int_pid=0 and int_del_status=0 order by int_is_folder desc,txt_last_modified desc";
    else
     $select_data="select * from users_data where int_is_sync=1 and int_uid='".$_SESSION['user_id']."' and int_status=1 and txt_file_name like '%".$_REQUEST['s']."%' and int_pid=0 and int_del_status=0 order by int_is_folder desc,int_file_size desc";
     $result_data=mysql_query($select_data) ;  
}

if(!$result_data)
handle_mysql_error($select_data,"Error while sub directory listing ","my_sync");  
$imgsrc=0;
if(mysql_num_rows($result_data)==0)
$imgsrc=1;
//echo $select_data;
//print_r($_SESSION);
//print_r($_REQUEST);
?>
<?php
$level_current=0;
function dirStructure($pid)
	{
 	  global $level_current;
	$cnt=0;
	while($pid!=0)
		{
		$result=mysql_query("Select int_pid,txt_file_name from users_data where int_fid=" . $pid) ;
         if(!$result)
        handle_mysql_error("Select int_pid,txt_file_name from users_data where int_fid=$pid","Error while sub directory listing-dirstructure ","my_sync");  
		$row=mysql_fetch_array($result);
		$arr[$cnt]=$row["txt_file_name"];
		$arrid[$cnt]=$pid;
		$pid=$row["int_pid"];
		$cnt++;
		}

	$arr[$cnt]="Home";
	$arrid[$cnt]=0;
    
   
	for($i=count($arr)-1;$i>=0;$i--)
		echo "<a href='index.php?name_page=my_sync&dir=" . $arrid[$i] . "'>" . $arr[$i] . "<img src='images/icon-arrow-blue.gif' style='margin-left:2px;'> </a>";
     
      $level_current= count($arr);
	}
    
?>

 <!--<link href="css/dropzone.css" type="text/css" rel="stylesheet" />
 

<script src="js/dropzone.js"></script>  -->


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
			/*position: absolute; */
			top: 20%;
			left: 28%;
			/*width: 600px; */
		    min-height: 30%;
            
			padding: 10px;
		    -moz-border-radius:3px;
    -webkit-border-radius:3px;
    border-radius:3px;
			background-color: white;
			z-index:1002;
			overflow: hidden;
            /*border: 1px solid #78B0DE; */
            box-shadow: 0 0 5px #78B0DE;
		}
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
			top: 60%;
			left: 50%;
		
            
			padding: 10px;
		
			background-color: white;
            background: transparent;
			z-index:1002;
			overflow: hidden;
           
		}
         .white_content2 {
			display: none;
			position: fixed;
			top: 45%;
			left: 31%;
		  width: 500px;
          height: 70px;
            
			padding: 10px;
		
			background-color: #fff;
           
			z-index:1002;
			overflow: hidden;
              border: 1px solid #78B0DE;
            box-shadow: 0 0 5px #78B0DE;
           
		}
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
            -moz-linear-gradient:(center top , #F6F7F8, #F6F7F8) repeat scroll 0 0 transparent;
             border: 1px solid #999999;
             box-shadow: 0 1px 1px rgba(0, 0, 0, 0.3), 0 0 0 #000000 inset;
             color: #666666;
             text-shadow: 0 1px 1px #CACACA;
             border-radius: 3px 3px 3px 3px;
             cursor: pointer;
             font-size: 13px;
             font-weight: 600;
             overflow: visible;
             padding: 4px 16px;
             text-align: center;
        }
        .txt_ren{
            border: 1px solid #999999;
    		box-shadow: 0 1px 1px rgba(0, 0, 0, 0.3), 0 0 0 #000000 inset;
        }
</style>

 <div id="div_restrict" class="white_content2" >
         
         <a style="margin-left: 490px;"  href = "javascript:void(0)" onclick = "document.getElementById('div_restrict').style.display='none';document.getElementById('fade_loading').style.display='none';">
        
       <img src="image/close_u.png" />
        
        </a>
       
        <table  width='100%' border="0" cellspacing="0" cellpadding="0">
        <tr>
        <td width="15%" valign="middle">
        
        </td>
        <td valign='top'>
         <b style="color:#E85005"> Unverified Account !  Please Verify it or <a href='index.php?name_page=home&mail=em_enc' > Resend e-mail </a>  </b> 
         <br />
         Sharing feature is not avaialable for unverified members, Please verify your account.
        </td>
        </tr>
        </table>
         
        <img src="images/alert.png" style="position: absolute;margin-top: -45px;" />
 </div>
 <div id="div_loading" class="white_content1" >
 
        
        <img src="images/ajax-loader_dir_load.gif" /> <b style="color:#E85005"> Loading ... </b> 
 </div>
  <div id="div_uploading" class="white_content1" >
 
        
        <img src="images/ajax-loader_dir_load.gif" /> <b style="color:#E85005"> Uploading ... </b> 
 </div>
 <div id="fade_loading" class="black_overlay1"></div>
 
<link href="css/ui-lightness/jquery-ui-1.8.14.custom.css" rel="stylesheet" type="text/css" />
<link href="css/fileUploader.css" rel="stylesheet" type="text/css" />

<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.14.custom.min.js" type="text/javascript"></script>
<script src="js/jquery.fileUploader.js" type="text/javascript"></script>


<script src="js/jquery.smooth-scroll.min.js"></script>

<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />

<link rel="stylesheet" type="text/css" href="css/balloontip.css" />
<link href="css/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/default.advanced.css" media="screen" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/balloontip.js"></script>

<!--<script src="js/lightbox.js"></script> -->
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


<?php
if($suc_msg)
$_REQUEST['err']="";
?>

<body <?php if($err_msg || $suc_msg || $_REQUEST['err'] || $_SESSION['dup']) { ?> onload = "autoHide();" <?php } ?>"> 


<?php
//total used
 //$select_total_used="select sum(int_file_size) as total from users_data where int_uid='".$_SESSION['user_id']."'";
//$result_total=mysql_query($select_total_used);
//$fetch_total=mysql_fetch_array($result_total);
//$total_mb=($fetch_total['total']/1024)/1024;
//echo "<font color='red'>".number_format($total_mb,2)."MB of 5GB Used </font>";
?>
<div class="container fleft">
<center>
 <?php
     if($err_msg)
     {
        ?>
        <div class="error" id="error_container">
          <?php echo $err_msg; ?>

        </div>
        <?php
     }
     ?>
     <?php
       if($suc_msg)
     {
        ?>
        <div class="success" id="error_container1">
          <?php echo $suc_msg; ?>

        </div>
        <?php
     }
     ?>
     <?php
       if($_REQUEST['err'])
     {
        ?>
        <div class="error" id="error_container2">
          <?php echo "File already exists. Please try with another name"; ?>

        </div>
        <?php
     }
     ?>
     <?php
      if($_SESSION['dup']=="true")
     {
        ?>
        <div class="error" id="error_container2">
          <?php echo "Same file already exists."; ?>

        </div>
        <?php
       $_SESSION['dup']=""; 
     }
     
     ?>
</center>

<div  class="fullcontainer">
<div class="cont_heading">
<h1>My Sync Folder</h1></div>
<div class="fleft large_social">
	<a class="small" href="javascript:void(0);" onClick="changeView('field1')" rel="balloon1">Small</a>
	<a class="large" href="javascript:void(0);" onClick="changeView('small-field1')" rel="balloon2">Medium</a>
	<a class="extra_large" href="javascript:void(0);" onClick="changeView('large-field1')" rel="balloon3">Large</a>
</div>

<div id="balloon1" class="balloonstyle">
Small
</div>
<div id="balloon2" class="balloonstyle">
Medium
</div>
<div id="balloon3" class="balloonstyle">
Large
</div>


       <ul id="nav" class="dropdown dropdown-horizontal" style="display: none;">
                               
                               <li><a href="javascript:void(0);"  class="dir " style="margin:0 10px 0 7px;" ><img src="image/new.jpg" alt="" /></a>
                                       <ul>
                                               
                                               <li style="white-space: nowrap; "><!--<img  src="images/icon_edi.png" style="width: 10px; height: 10px;margin-left: 5px;" /> -->
                                             
                                                <a  href="javascript:void(0);" onClick="togle('folder');">
                                                 <img  src="images/folder-icon.png" style="width: 10px; height: 10px; " align='texttop' />&nbsp; Folder</a></li>
                                               <li ><a href="javascript:void(0);" onClick="togle('doc');">
                                                <img  src="images/word-icon.gif" style="width: 10px; height: 10px; " align='texttop' />&nbsp;Word Document</a></li>
                                               <li><a href="javascript:void(0);" onClick="togle('excel');">
                                                <img  src="images/excel_icon.gif" style="width: 10px; height: 10px; " align='texttop' />&nbsp;Excel Document</a></li>
                                                <li ><a href="javascript:void(0);" onClick="togle('ppt');">
                                                 <img  src="images/ppt_icon.gif" style="width: 10px; height: 10px; " align='texttop' />&nbsp;Power-Point Document</a></li>
                                               <li ><a href="javascript:void(0);" onClick="togle('txt');">
                                                <img  src="images/txt1.png" style="width: 10px; height: 10px; " align='texttop' />&nbsp;Text File</a></li>
                                       </a></li>
                                       </ul>
                               </li>
                               
                       </ul>
    <div class="update_btns fright" style="width: 100px;">
	<a href="javascript:void(0);" onClick="document.getElementById('content_dir').style.display='block';document.getElementById('fade').style.display='block';" class="directory">Directory</a>
    
   <!-- <a class="upload " href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">Upload</a>
    -->
 <!--<a class="new" href="javascript:void(0);" onclick="togle();">New</a>  -->

</div>

</div>
   
<div id="fade" class="black_overlay"></div>
<div class="fleft width" style="margin-top:23px; margin-bottom:27px;">
<hr >
<div class="sep width"></div>
<div  class="fullcontainer">
<font color="#15a0c8" >
<?php
      //  echo traverse_history(); // maintain tree structure for traverse files and folders
        
        ?>
        <?php echo dirStructure($_REQUEST['dir']);
        //echo $level_current;
        
        ?>
        <?php  if($level_current>=3) 
        {
         ?>
         <script>
         //alert("sasa");
         document.getElementById('nav').style.display='block';
         </script>
         <?php
         }
         ?>
        </font>
        <form name="frm_sort" method="post" action="#">
        <p align="right">
        <?php
if(mysql_num_rows($result_data)>0)
{
?>
        Sort by
        
        <select name="sorting_opt" onChange="document.frm_sort.submit()">
        <option value="1" selected >Size</option>
        <option value="2" <?php if($_REQUEST['sorting_opt']==2) echo "selected"; ?>>Name</option>
        <option value="3" <?php if($_REQUEST['sorting_opt']==3) echo "selected"; ?>>Date</option>
        </select>
        <?php
        }
        ?>
        </p>
        <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
        </form>
<!--<form class="dropzone clickable" action="upload.php"></form> -->
<!-- select all / deselect all -->
<?php
if(mysql_num_rows($result_data)>0)
{
    if($level_current>=3){
?>
<input type="checkbox" onChange="checkedAll()"  class="fleft" id="top_check" /> 
<?php
}
}
?>
 <div id="test" class="chk_msg" >
 <a href="javascript:void(0);" onClick="delete_confirm();" style="text-decoration: none;color: white;">  Delete All </a>
 
 </div>
  <div id="test_selected" class="chk_msg"  >
 <a href="javascript:void(0);" onClick="delete_confirm_selected();" style="text-decoration: none;color: white;">  Delete Selected </a>
 
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
    var tot_id="";
   if(document.getElementById('top_check').checked==false)
        checked = true;
        else
        checked=false;
        
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
			list[i].style.background="#fffce9";
			
		
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


<!-- tooltip -->
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
</div>
<div class="section1" style=" width:100%; float:left;">

<!-- <link href="css/drag_drop_main.css" rel="stylesheet" type="text/css" />
        
        <div class="upload_form_cont" style="margin-top: 20px;" >
        
                <div id="dropArea" style="text-align: center;" title="Drag and drop files here.">
                 
                 <img src="images/drag.png" width="250px" height="66px"  title="Drag and drop files here." style="opacity:.4;"  />
                
                 </div>

                
                <div class="info">
                    <div style="display: none;">Files left: <span id="count">0</span></div>
                    <div style="display: none;">Destination url: <input id="url" value="upload_drag_drop.php" type="hidden"/></div>
                    <p></p>
                    <div id="result"></div>
                    
                    <canvas  height="30"  style="margin-left: 65px;"></canvas>
                </div>
            </div>
       
        <script src="js/script_drag_drop.js"></script>  -->
        
        
         <div id="light" class="white_content" style="display:<?php  if($level_current>=3) echo "block"; else echo "none"; ?>;margin-top: 25px;margin-bottom: 25px;" >
       <!-- <a style="margin-left: 575px;"  href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none';if(document.getElementById('upd').value=='1')location.reload();">
        
       <img src="image/close_u.png" />
        
        </a>  -->
        <div id="main_container" style="margin-left:200px;">
        	<h2 style="color:#049cd4 ;padding-bottom: 5px;font-size: 16px;">
            <img id="drop_img" src="images/drop-files.png" />
            </h2>
        	<br />
            
            <form action="upload_sync.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="current_pid" value="<?php echo $_REQUEST['dir']; ?>" />
                <input type="file" id="uf" name="userfile" class="fileUpload" multiple/>
        		<button id="px-submit" type="submit" style="margin-top: 0px;" onclick="document.getElementById('upd').value='1';">Upload</button>
        		<button id="px-clear" type="reset" style="margin-top: 0px;">Clear</button>
        	</form>
        	<script type="text/javascript">
        		jQuery(function($){
        			$('.fileUpload').fileUploader();
        		});
        	</script>
        
        </div>
        </div>
      </div>
<div class="search-field1" class="fleft" id="new_dir" style="display: none;" >
    <div class="section1">
    <div class="icon2"><img src="images/large_icon.png" alt="" /></div>
    <input type="text" id="txt_new_dir" name="txt_new_dir" class="box" onBlur="submit_data('folder');" onKeyPress="if(event.keyCode==13) {submit_data('folder');}"/>
    </div>
</div>
<div class="search-field1" class="fleft" id="new_word" style="display: none;" >
<div class="section1  ">
<div class="icon"><img src="images/doc.png" alt="" /></div>
<input type="text" id="txt_new_word" name="txt_new_word" class="box" onBlur="submit_data('doc');" onKeyPress="if(event.keyCode==13) {submit_data('doc');}"/>
</div>
</div>

<div class="search-field1" class="fleft" id="new_excel" style="display: none;" >
<div class="section1  ">
<div class="icon"><img src="images/xls.png" alt="" /></div>

<input type="text" id="txt_new_excel" name="txt_new_excel" class="box" onBlur="submit_data('excel');" onKeyPress="if(event.keyCode==13) {submit_data('excel');}"/>
    

</div>
</div>

<div class="search-field1" class="fleft" id="new_text" style="display: none;" >
<div class="section1  ">
<div class="icon"><img src="images/txt.png" alt="" /></div>

<input type="text" id="txt_new_text" name="txt_new_text" class="box" onBlur="submit_data('txt');" onKeyPress="if(event.keyCode==13) {submit_data('txt');}"/>
    

</div>
</div>

<div class="search-field1" class="fleft" id="new_ppt" style="display: none;" >
<div class="section1  ">
<div class="icon"><img src="images/ppt-png_icon.png" alt="" /></div>

<input type="text" id="txt_new_ppt" name="txt_new_ppt" class="box" onBlur="submit_data('ppt');" onKeyPress="if(event.keyCode==13) {submit_data('ppt');}"/>
    

</div>
</div>
<form id="frm7" name="frm7">
</div>

<?php

 if(mysql_num_rows($result_data)>0)
        {
            while($fetch_data=mysql_fetch_array($result_data))
            {
                generate_code($fetch_data['int_fid'],1);
                ?>
<div class="<?php echo $_SESSION['class_list'];  ?>" class="fleft" id="div_<?php echo $fetch_data['int_fid']; ?>">
<div class="section1  ">
<div class="fleft">
<?php
if($level_current>=3)
{
?>
<input id="acceptTerms_<?php echo $fetch_data['int_fid']; ?>"  name="acceptTerms_<?php echo $fetch_data['int_fid']; ?>" type="checkbox" value="<?php echo $fetch_data['int_fid']; ?>" onChange="togglecolor(this.value,this.id);"   />
<?php
}
?>
</div>

<div class="icon2">

<?php  if($fetch_data['txt_file_type']=="folder")
                    {
                        ?>
                    <a href="javascript:void(0);" onClick="next_level(<?php echo $fetch_data['int_fid']; ?>);"> 
                        <?php
                    }
                   
                   else 
                  { ?>
                 <a href="download_new.php?id=<?php echo $fetch_data['int_fid'];  ?>&path=<?php echo encrypt($fetch_data['txt_file_name']); ?>"
                 <?php if(get_ext($fetch_data['txt_file_name'])=="jpg" || get_ext($fetch_data['txt_file_name'])=="png" ||
                 get_ext($fetch_data['txt_file_name'])=="gif" ||get_ext($fetch_data['txt_file_name'])=="bmp" ||
                 get_ext($fetch_data['txt_file_name'])=="jpeg" ) { ?> onmouseover="ddrivetip('<?php echo "../".$fetch_data['txt_real_path']; ?>','white', 300);" onmouseout="hideddrivetip();" <?php } ?>
                 >   
                  <?php
                  }
                  ?>
<img src="<?php if($level_current==1) {if($fetch_data['txt_from_where'] == 'pc') echo "images/windows.jpg"; elseif($fetch_data['txt_from_where'] == 'android') echo "images/android.jpg"; elseif($fetch_data['txt_from_where'] == 'mac-pc') echo "images/mac.jpg"; elseif($fetch_data['txt_from_where'] == 'blackberry') echo "images/blackberry.jpg"; elseif($fetch_data['txt_from_where'] == 'ios') echo "images/iphone.jpg"; elseif($fetch_data['txt_from_where'] == 'windows') echo "images/windowsphonelarge.png"; else echo "images/windows.jpg";} elseif($level_current==2) {echo "images/sync_icon.png"; } else echo get_file_thumb($fetch_data['txt_file_type'],$fetch_data['txt_file_name']); ?>" />  </a>

</div>
<div class="icon_sep" >
	<h4>
    <?php  if($fetch_data['txt_file_type']=="folder")
                    {
                        ?>
                    <a href="javascript:void(0);" onClick="next_level(<?php echo $fetch_data['int_fid']; ?>);"> 
                        <?php
                    }
                   
                  
                  else 
                  { ?>
                 <a href="download_new.php?id=<?php echo $fetch_data['int_fid'];  ?>&path=<?php echo encrypt($fetch_data['txt_file_name']); ?>">   
                  <?php
                  }
                  ?>
    <?php echo $fetch_data['txt_file_name']; ?>  </a>
    
    
    
    
    </h4>
    <h6> <?php if($fetch_data["txt_file_type"]!="folder") echo "Size: ".setFileSize($fetch_data["int_file_size"]) . "<br>"; echo "Modified: ".setModifiedDate($fetch_data["int_mod_date"],$fetch_data["int_mod_time"]); ?></h6>
</div>


       <ul id="nav" class="dropdown dropdown-horizontal" title="Options" style="display:<?php  if($level_current>=3) echo "block"; else echo "none"; ?>">
                               
                               <li><a href="javascript:void(0);" class="delete_dropdown"></a>
                               <ul class="position">
                                                
                                               <li>	
                                               
                                              
 <a href="javascript:void(0);" onClick="open_rename_div('<?php echo $fetch_data['int_fid'];  ?>','<?php echo $fetch_data['txt_file_name'];  ?>','<?php echo $fetch_data['int_is_folder'];  ?>')">
 <img  src="images/skin-icon-rename.png" style="width: 10px; height: 10px; " align='texttop' />&nbsp; rename </a>
</li>  
                                               <li><a  href="javascript:void(0);" onClick="verify(<?php echo $fetch_data['int_fid']; ?>,<?php echo $fetch_data['int_is_folder']; ?>)"> 
                                               <img  src="images/delete.png" style="width: 10px; height: 10px; " align='texttop' />&nbsp;
                                               Delete </a></li>
                                               
                                       </a></li>
                                       </ul>
                               </li>
                               
                       </ul>
      <div class="share_btns" style="display:<?php  if($level_current>=3) echo "block"; else if($level_current == 2)  echo "block";  else echo "none"; ?>">
       
       <?php if($fetch_data['txt_file_type']=="folder") { ?>  
                    <a title="Download This Folder" class="download" href="test_zip.php?path=<?php echo $fetch_data['int_fid']; ?>&nm=<?php echo $fetch_data['txt_file_name']; ?>"> Download </a>
                   <?php } else { ?>  
                   <a title="Download This File" class="download" href="download_new.php?id=<?php echo $fetch_data['int_fid'];  ?>&path=<?php echo encrypt($fetch_data['txt_file_name']); ?>"> Download </a>
                   <?php } ?>
       </a>
   <?php 
                   $select_code="select txt_share_link from tab_share where int_fid='".$fetch_data['int_fid']."'";
                   $result_code=mysql_query($select_code);
                   $fetch_code=mysql_fetch_array($result_code);
                    ?>
                   <?php
                   if($fetch_user_data['int_verified']==0)
					{
					?>
					 <a class="share" title="<?php if($fetch_data['txt_file_type']=="folder")echo "Share This Folder"; else echo "Share This File";  ?>" href="javascript:restrict();"> Share </a>
					<?php
					}
					else
					{
                   ?>
                                       <a class="share" title="<?php if($fetch_data['txt_file_type']=="folder")echo "Share This Folder"; else echo "Share This File";?>" href="files/index.php?code=<?php echo $fetch_code['txt_share_link'] ?>&bagid=<?php echo base64_encode($_SESSION['user_id']);?>" target="_blank"> Share  </a>
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
?>

<div class="width fleft" style="text-align: center;margin-top:0px ;"> 
 <center> 
 <?php
 if($_REQUEST['s']!="")
 {
 ?>
  <div class='error' style='width:500px;'>  Sorry, There are no files or folders that match your search criteria. </div> 
  <?php
  }
  else
  {
    ?>
    <div class='error' style='width:500px;'>  Databagg is empty, Please upload. </div> 
  <?php
  }
  ?>
  </center> <br />
<img src="image/empty_light.jpg" />
</div>
<?php
}
?>
</form>

<script>
function restrict()
{
   document.getElementById('div_restrict').style.display='block';
    document.getElementById('fade_loading').style.display='block';
    
}
function togglecolor(val,id)
{iddiv="div_"+val;

    if(document.getElementById(id).checked)
    {
        
       document.getElementById(iddiv).style.background="#fffce9";
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

</div>
 <form id="del_form" name="del_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
        <input type="hidden" value="<?php echo $_REQUEST['dir']; ?>" id="dir" name="dir" />
        <input type="hidden" value="" id="del_id" name="del_id" />
        <input type="hidden" value="" id="is_f" name="is_f" />
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
        <input type="hidden" value="<?php echo $_REQUEST['dir']; ?>" id="parent_id" name="parent_id" />
        </form>
      
    <div class="renamediv" id="rename_div" style="display: none;">
        <form id="frm_rename" name="frm_rename" method="post" action="#">
            <input type="text" class="txt_ren" id="file_name" name="file_name" style="width: 220px;height: 20px;" />
            <input type="hidden" id="file_name_prev" name="file_name_prev" />
            <input type="hidden" id="file_id" name="file_id" />
            <input type="hidden" id="file_folder" name="file_folder" />
            <input class="brt_ren" type="button" id="btn_rename" value="Save" onClick="submit_rename_data()" />
            <input class="brt_ren"  type="button" value="Cancel" onClick="document.getElementById('rename_div').style.display='none';" />
            <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
        </form>
    </div>
    
</body>
</html>
<script>
function trim(data)
{
    return data.replace(/^\s+|\s+$/g,'');
}
function submit_rename_data()
{
    if(trim(document.getElementById('file_name_prev').value)==trim(document.getElementById('file_name').value))
    {
    document.getElementById('rename_div').style.display='none';
    return false;
    }
    if(trim(document.getElementById('file_name').value)=="")
    {
    alert("Please provide a file name.");
    document.getElementById('file_name').focus();
    return false;
    }
    document.frm_rename.submit();
}
function open_rename_div(id,name,ffid)
{
    document.getElementById('rename_div').style.display='block';
    document.getElementById('file_name').value=name;
    document.getElementById('file_id').value=id;
    document.getElementById('file_folder').value=ffid;
    document.getElementById('file_name_prev').value=name;
}
function verify(did,f_stat)
{
    //alert(is_f);
    
    if(confirm("Are you sure to delete this file. "))
    {
    document.getElementById('del_id').value=did;
    document.getElementById('is_f').value=f_stat;
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
    if(trim(document.getElementById('new_dir_name').value)=="")
    {
        alert("Please provide a name");
        return false;
    }
    }
    if(type=="doc")
    {
    document.getElementById('new_word').style.display="none";
    document.getElementById('new_word_id').value=1;
    document.getElementById('new_word_name').value=document.getElementById('txt_new_word').value;
    if(trim(document.getElementById('new_word_name').value)=="")
    {
        alert("Please provide a name");
        return false;
    }
    }
    if(type=="excel")
    {
    document.getElementById('new_excel').style.display="none";
    document.getElementById('new_excel_id').value=1;
    document.getElementById('new_excel_name').value=document.getElementById('txt_new_excel').value;
    if(trim(document.getElementById('new_excel_name').value)=="")
    {
        alert("Please provide a name");
        return false;
    }
    }
    if(type=="txt")
    {
    document.getElementById('new_text').style.display="none";
    document.getElementById('new_text_id').value=1;
    document.getElementById('new_text_name').value=document.getElementById('txt_new_text').value;
    if(trim(document.getElementById('new_text_name').value)=="")
    {
        alert("Please provide a name");
        return false;
    }
    }
    if(type=="ppt")
    {
    document.getElementById('new_ppt').style.display="none";
    document.getElementById('new_ppt_id').value=1;
    document.getElementById('new_ppt_name').value=document.getElementById('txt_new_ppt').value;
    if(trim(document.getElementById('new_ppt_name').value)=="")
    {
        alert("Please provide a name");
        return false;
    }
    }
    document.new_dir_form.submit();
}
function next_level(id)
{
    document.getElementById('div_loading').style.display='block';document.getElementById('fade_loading').style.display='block';
    location.href="index.php?name_page=my_sync&dir="+id;
}
function autoHide()
{  //hide after 5 seconds
   setTimeout(function(){document.getElementById('error_container').style.display='none';},10000);
   setTimeout(function(){document.getElementById('error_container1').style.display='none';},10000);
}
</script>


<?php
		   function using_ie() 
			{ 
				 $u_agent = $_SERVER['HTTP_USER_AGENT']; 
				 $ub = False; 
				 if(preg_match('/MSIE/i',$u_agent)) 
				 { 
					$ub = True; 
				 } 
				
				 return $ub; 
			}
			if($level_current>=3)
			if (using_ie()){ 
				echo "<script> document.getElementById('drop_img').src='images/select-files.png';
				alert(document.getElementById('dtxt').innerHTML);
				document.getElementById('dtxt').innerHTML='Select files here';
				 </script>";
					
			 } ?>


<?php 
include "tree_str_sync.php";
?>