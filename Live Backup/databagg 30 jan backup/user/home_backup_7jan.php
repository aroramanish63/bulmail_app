<?php
session_start();
if(!$_SESSION['user_id'])
header("Location:login.php");

include("connect.php");
include("function.php");
//session_start();
error_reporting(0);

//create new directory with all its quality
if($_REQUEST['new_dir_id'])
{
    if($_REQUEST['new_dir_name']=="")
    $err_msg="Please provide a name for the new folder.";
    else
        {   
            if($_SESSION['dir'])
            create_inner_dir($_REQUEST['new_dir_name'],$_SESSION['new_id']);
            else
            create_dir($_REQUEST['new_dir_name']);
        $suc_msg="Folder created successfully.";
        }
}
if($_REQUEST['new_ppt_id'])
{
    if($_REQUEST['new_ppt_name']=="")
    $err_msg="Please provide a name for the Power-Point file.";
    else
        {   
            if($_SESSION['dir'])
            create_inner_file($_REQUEST['new_ppt_name'],$_SESSION['new_id'],"ppt");
            else
            create_file($_REQUEST['new_ppt_name'],"ppt");
        $suc_msg="File created successfully.";
        }
}
if($_REQUEST['new_excel_id'])
{
    if($_REQUEST['new_excel_name']=="")
    $err_msg="Please provide a name for the Excel file.";
    else
        {   
            if($_SESSION['dir'])
            create_inner_file($_REQUEST['new_excel_name'],$_SESSION['new_id'],"xls");
            else
            create_file($_REQUEST['new_excel_name'],"xls");
        $suc_msg="File created successfully.";
        }
}
if($_REQUEST['new_text_id'])
{
    if($_REQUEST['new_text_name']=="")
    $err_msg="Please provide a name for the Text file.";
    else
        {   
            if($_SESSION['dir'])
            create_inner_file($_REQUEST['new_text_name'],$_SESSION['new_id'],"txt");
            else
            create_file($_REQUEST['new_text_name'],"txt");
        $suc_msg="File created successfully.";
        }
}
if($_REQUEST['new_word_id'])
{
    if($_REQUEST['new_word_name']=="")
    $err_msg="Please provide a name for the Word file.";
    else
        {   
            if($_SESSION['dir'])
            create_inner_file($_REQUEST['new_word_name'],$_SESSION['new_id'],"doc");
            else
            create_file($_REQUEST['new_word_name'],"doc");
        $suc_msg="File created successfully.";
        }
}
if($_REQUEST['del_id'])
{
    $delete_file="update users_data set int_del_status=1 where int_fid='".$_REQUEST['del_id']."'";
    mysql_query($delete_file) ;
     //$description='Deleted: '.$upload->upload_dir.$upload->the_file;
          // log_entry($description);
}
//remove all history when home page lode
if($_REQUEST['dir']=="")
{
$_SESSION['dir']="";
$_SESSION['dir1']="";
$_SESSION['new_id']="";
}

//use session based array for history traverse and listing of data
if($_REQUEST['dir'])
{  
    $_SESSION['new_id']=$_REQUEST['dir'];
    if($_SESSION['dir']=="")
    $_SESSION['dir']=$_REQUEST['dir'];
    else
    {
      if($_SESSION['dir1'] && !strstr($_SESSION['dir1'],$_REQUEST['dir']))
      $_SESSION['dir1']=$_SESSION['dir1'];   //session dir1 is stored concatenated array of file ids
      else
      $_SESSION['dir1']=$_SESSION['dir'];
      
      $_SESSION['dir1'].=",";
      $_SESSION['dir1'].=$_REQUEST['dir'];  
    }
    $select_data="select * from users_data where int_uid='".$_SESSION['user_id']."' and int_status=1 and int_del_status=0 and int_pid='".$_REQUEST['dir']."'  order by int_is_folder desc";
    $result_data=mysql_query($select_data) or die(mysql_query());
}
else
{
    $select_data="select * from users_data where int_uid='".$_SESSION['user_id']."' and int_status=1 and int_pid=0 and int_del_status=0 order by int_is_folder desc";
    $result_data=mysql_query($select_data) or die(mysql_query());  
}
//print_r($_SESSION);
//print_r($_REQUEST);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>//Data Bagg//</title>
<link href="css/reset.css" rel="stylesheet" type="text/css" />

<style type="text/css">
body {
	margin: 10px;
	
}
#main_container{
	
}
h2 {
	font-size: 2em;
	padding-bottom: 20px;
}
.black_overlay{
			display: none;
			position: absolute;
			top: 0%;
			left: 0%;
			width: 100%;
			height: 100%;
			background-color: black;
			z-index:1001;
			-moz-opacity: 0.5;
			opacity:.50;
			filter: alpha(opacity=50);
		}
		.white_content {
			display: none;
			position: absolute;
			top: 25%;
			left: 15%;
			width: 60%;
			height: 35%;
			padding: 16px;
		
			background-color: white;
			z-index:1002;
			overflow: auto;
		}
</style>

<link href="css/ui-lightness/jquery-ui-1.8.14.custom.css" rel="stylesheet" type="text/css" />
<link href="css/fileUploader.css" rel="stylesheet" type="text/css" />

<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.14.custom.min.js" type="text/javascript"></script>
<script src="js/jquery.fileUploader.js" type="text/javascript"></script>

<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<link href="css/style.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="css/balloontip.css" />
<link href="css/dropdown.css" media="screen" rel="stylesheet" type="text/css" />
<link href="css/default.advanced.css" media="screen" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/balloontip.js"></script>
<script>
	var lastclass="field1"
	function changeView(str1)
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

<body <?php if($err_msg || $suc_msg) { ?> onload = "autoHide();" <?php } ?>">
<a href="logout.php">Logout?</a>
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
</center>
<h1>My Data Bagg</h1>
<div class="fleft large_social">
	<a class="small" href="javascript:changeView('field1')" rel="balloon1">small</a>
	<a class="large" href="javascript:changeView('small-field1')" rel="balloon2">large</a>
	<a class="extra_large" href="javascript:changeView('large-field1')" rel="balloon3">extra large</a>
</div>

<div id="balloon1" class="balloonstyle">
small
</div>
<div id="balloon2" class="balloonstyle">
Large
</div>
<div id="balloon3" class="balloonstyle">
Ex Large
</div>

<div class="update_btns fleft">
	<a href="#" class="directory">Directory</a>
    <a class="upload active" href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">Upload</a>
    
 <!--<a class="new" href="javascript:void(0);" onclick="togle();">New</a>  -->

</div>

 <div  style="width:75px; float:left">
       <ul id="nav" class="dropdown dropdown-horizontal">
                               
                               <li><a href="javascript:void(0);" class="dir" ><img src="image/new.jpg" alt="" /></a>
                                       <ul>
                                               
                                               <li><a  href="javascript:void(0);" onclick="togle('folder');">Folder</a></li>
                                               <li><a href="javascript:void(0);" onclick="togle('doc');">Word Document</a></li>
                                               <li><a href="javascript:void(0);" onclick="togle('excel');">Excel Document</a></li>
                                                <li><a href="javascript:void(0);" onclick="togle('ppt');">Power-Point Document</a></li>
                                               <li><a href="javascript:void(0);" onclick="togle('txt');">Text File</a></li>
                                       </a></li>
                                       </ul>
                               </li>
                               
                       </ul>
</div>

 

    
    <div id="light" class="white_content" >
        <a style="margin-left: 575px;"  href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none';location.reload();">Close</a>
        <div id="main_container" style="margin-left:100px;">
        	<h2>Upload Here</h2>
        	
            
            <form action="upload.php" method="post" enctype="multipart/form-data">
        		<input type="file" name="userfile" class="fileUpload" multiple>
        		
        		<button id="px-submit" type="submit">Upload</button>
        		<button id="px-clear" type="reset">Clear</button>
        	</form>
        	<script type="text/javascript">
        		jQuery(function($){
        			$('.fileUpload').fileUploader();
        		});
        	</script>
        
        </div>
        
        
        </div>
        <div id="fade" class="black_overlay"></div>
<div class="fleft width" style="margin-top:20px;">
<hr >
<div class="sep width"></div>

<font color="#CCCCCC">
<?php
        echo traverse_history(); // maintain tree structure for traverse files and folders
        ?>
        </font>
 <div class="search-field1" class="fleft" id="new_dir" style="display: none;" >
<div class="section1  ">
<div class="icon"><img src="images/folder.png" alt="" /></div>

<input type="text" id="txt_new_dir" name="txt_new_dir" class="box" onblur="submit_data('folder');" onkeypress="if(event.keyCode==13) {submit_data('folder');}"/>
    

</div>
</div>
<div class="search-field1" class="fleft" id="new_word" style="display: none;" >
<div class="section1  ">
<div class="icon"><img src="images/doc.jpg" alt="" /></div>

<input type="text" id="txt_new_word" name="txt_new_word" class="box" onblur="submit_data('doc');" onkeypress="if(event.keyCode==13) {submit_data('doc');}"/>
    

</div>
</div>

<div class="search-field1" class="fleft" id="new_excel" style="display: none;" >
<div class="section1  ">
<div class="icon"><img src="images/xls.gif" alt="" /></div>

<input type="text" id="txt_new_excel" name="txt_new_excel" class="box" onblur="submit_data('excel');" onkeypress="if(event.keyCode==13) {submit_data('excel');}"/>
    

</div>
</div>

<div class="search-field1" class="fleft" id="new_text" style="display: none;" >
<div class="section1  ">
<div class="icon"><img src="images/txt.png" alt="" /></div>

<input type="text" id="txt_new_text" name="txt_new_text" class="box" onblur="submit_data('txt');" onkeypress="if(event.keyCode==13) {submit_data('txt');}"/>
    

</div>
</div>

<div class="search-field1" class="fleft" id="new_ppt" style="display: none;" >
<div class="section1  ">
<div class="icon"><img src="images/ppt.jpg" alt="" /></div>

<input type="text" id="txt_new_ppt" name="txt_new_ppt" class="box" onblur="submit_data('ppt');" onkeypress="if(event.keyCode==13) {submit_data('ppt');}"/>
    

</div>
</div>

</div>

<?php
 if(mysql_num_rows($result_data)>0)
        {
            while($fetch_data=mysql_fetch_array($result_data))
            {
                ?>
<div class="field1" class="fleft">
<div class="section1  ">
<div class="fleft"><input id="acceptTerms"  name="acceptTerms" type="checkbox"  /></div>
<div class="icon">
<?php if($fetch_data['txt_file_type']=="application/pdf") { ?>
                    <a href="download.php?path=uploads/<?php echo $fetch_data['txt_file_name']; ?>"> 
                    <?php 
                    }
                    else if($fetch_data['txt_file_type']=="folder")
                    {
                        ?>
                    <a href="javascript:void(0);" onclick="next_level(<?php echo $fetch_data['int_fid']; ?>);"> 
                        <?php
                    }
                    else 
                    {
                    ?>
                    
                 <a href="<?php echo $fetch_data['txt_real_path'];  ?>" rel="lightbox">  
                  <?php
                  }
                  ?>
<img src="<?php echo get_file_thumb($fetch_data['txt_file_type'],$fetch_data['txt_file_name']); ?>" />  </a>

</div>
<div class=" icon-sep">
	<h4><?php echo $fetch_data['txt_file_name']; ?></h4>
    <h6> <?php echo "Modified: ".date("Y-m-d",$fetch_data['txt_last_modified']); ?></h6>
</div>
<div class="share_btns">
     <?php if($fetch_data['txt_file_type']=="folder") { ?>
                    <a class="download" href="javascript:void(0);" onclick="next_level(<?php echo $fetch_data['int_fid']; ?>);"> Download </a>
                   <?php } else { ?>  
                   <a class="download" href="download.php?path=<?php echo $fetch_data['txt_real_path']; ?>"> Download </a>
                   <?php } ?>
                   <a class="share" href="share.php?id=<?php echo $fetch_data['int_fid'] ?>" target="_blank"> Share  </a>
                   <a class="delete" href="javascript:void(0);" onclick="verify(<?php echo $fetch_data['int_fid']; ?>)"> Delete </a>
	
</div>
</div>
</div>
<?php
}
    }
?>

</div>
 <form id="del_form" name="del_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" value="" id="del_id" name="del_id" />
        </form>
         <form id="new_dir_form" name="new_dir_form" method="post" action="">
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
        </form>
</body>
</html>
<script>
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