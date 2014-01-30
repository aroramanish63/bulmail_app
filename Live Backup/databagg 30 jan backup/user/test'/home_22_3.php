<?php
//session_start();
//if(!$_SESSION['user_id'])
//header("Location:login.php");
//
//include("connect.php");
//include("function.php");
////session_start();
//error_reporting(0);
//print_r($_SESSION);

if(!isset($_SESSION['class_list']))
$_SESSION['class_list']="field1";
//rename file and folder
if($_REQUEST['total_box_item'])
{
    $ids=$_REQUEST['total_box_item'];
    $delete_multiple="update users_data set int_del_status='1' where int_fid in ($ids)";
    mysql_query($delete_multiple)or die(mysql_error());
    $suc_msg="Deleted successfully.";
}
if($_REQUEST['total_box_item_custom'])
{
    
    $ids_custom=str_replace("on,","",$_REQUEST['total_box_item_custom']);
    
    $ids=substr($ids_custom,0,strlen($ids_custom)-1);
    $delete_multiple="update users_data set int_del_status='1' where int_fid in ($ids)";
    mysql_query($delete_multiple)or die(mysql_error());
    $suc_msg="Deleted successfully.";
}
if($_REQUEST['file_name'])
{
    if($_SESSION['dir'])
            rename_inner_file($_REQUEST['file_name'],$_REQUEST['file_id'],$_REQUEST['file_name_prev'],$_REQUEST['file_folder'],$_SESSION['new_id']);
            else
            rename_file($_REQUEST['file_name'],$_REQUEST['file_id'],$_REQUEST['file_name_prev'],$_REQUEST['file_folder']);
        $suc_msg="Renamed successfully.";
    
}


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
          $suc_msg="File deleted successfully.";
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
    if($_SESSION['sorting_opt']==2)
    $select_data="select * from users_data where int_uid='".$_SESSION['user_id']."' and int_status=1 and txt_file_name like '%".$_REQUEST['s']."%' and int_del_status=0 and int_pid='".$_REQUEST['dir']."'  order by int_is_folder desc,txt_file_name asc";
    else if($_SESSION['sorting_opt']==3)
    $select_data="select * from users_data where int_uid='".$_SESSION['user_id']."' and int_status=1 and txt_file_name like '%".$_REQUEST['s']."%' and int_del_status=0 and int_pid='".$_REQUEST['dir']."'  order by int_is_folder desc,txt_last_modified desc";
    else
    $select_data="select * from users_data where int_uid='".$_SESSION['user_id']."' and int_status=1 and txt_file_name like '%".$_REQUEST['s']."%' and int_del_status=0 and int_pid='".$_REQUEST['dir']."'  order by int_is_folder desc,int_file_size desc ";
    $result_data=mysql_query($select_data) or die(mysql_query());
}
else
{

    if($_SESSION['sorting_opt']==2)
     $select_data="select * from users_data where int_uid='".$_SESSION['user_id']."' and int_status=1 and txt_file_name like '%".$_REQUEST['s']."%' and int_pid=0 and int_del_status=0 order by int_is_folder desc,txt_file_name asc";
    else if($_SESSION['sorting_opt']==3)
     $select_data="select * from users_data where int_uid='".$_SESSION['user_id']."' and int_status=1 and txt_file_name like '%".$_REQUEST['s']."%' and int_pid=0 and int_del_status=0 order by int_is_folder desc,txt_last_modified desc";
    else
     $select_data="select * from users_data where int_uid='".$_SESSION['user_id']."' and int_status=1 and txt_file_name like '%".$_REQUEST['s']."%' and int_pid=0 and int_del_status=0 order by int_is_folder desc,int_file_size desc";
     $result_data=mysql_query($select_data) or die(mysql_query());  
}
$imgsrc=0;
if(mysql_num_rows($result_data)==0)
$imgsrc=1;
//print_r($_SESSION);
//print_r($_REQUEST);
?>


 


<style type="text/css">


.black_overlay{
			display: none;
			position: absolute;
			top: 0%;
			left: 0%;
			width: 100%;
			height: 100%;
			background-color: black;
			z-index:1001;
			-moz-opacity: 0.8;
			opacity:.80;
			filter: alpha(opacity=80);
		}
		.white_content {
			display: none;
			position: absolute;
			top: 25%;
			left: 25%;
			width: 600px;
		    min-height: 30%;
            background: url("image/pattern.jpg") repeat scroll 0 0 #FFFFFF;
			padding: 10px;
		    -moz-border-radius:6px;
    -webkit-border-radius:6px;
    border-radius:6px;
			background-color: white;
			z-index:1002;
			overflow: hidden;
            
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


<?php
if($suc_msg)
$_REQUEST['err']="";
?>

<!--<body <?php if($err_msg || $suc_msg || $_REQUEST['err']) { ?> onload = "autoHide();" <?php } ?>">  -->


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


<h1>My Data Bagg</h1>
<div class="fleft large_social">
	<a class="small" href="javascript:void(0);" onclick="changeView('field1')" rel="balloon1">small</a>
	<a class="large" href="javascript:void(0);" onclick="changeView('small-field1')" rel="balloon2">large</a>
	<a class="extra_large" href="javascript:void(0);" onclick="changeView('large-field1')" rel="balloon3">extra large</a>
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


       <ul id="nav" class="dropdown dropdown-horizontal">
                               
                               <li><a href="javascript:void(0);" class="dir " style="margin:0 10px 0 7px;" ><img src="image/new.jpg" alt="" /></a>
                                       <ul>
                                               
                                               <li style="white-space: nowrap; "><!--<img  src="images/icon_edi.png" style="width: 10px; height: 10px;margin-left: 5px;" /> -->
                                             
                                                <a  href="javascript:void(0);" onclick="togle('folder');">
                                                 <img  src="images/folder-icon.png" style="width: 10px; height: 10px; " align='texttop' />&nbsp; Folder</a></li>
                                               <li ><a href="javascript:void(0);" onclick="togle('doc');">
                                                <img  src="images/word-icon.gif" style="width: 10px; height: 10px; " align='texttop' />&nbsp;Word Document</a></li>
                                               <li><a href="javascript:void(0);" onclick="togle('excel');">
                                                <img  src="images/excel_icon.gif" style="width: 10px; height: 10px; " align='texttop' />&nbsp;Excel Document</a></li>
                                                <li ><a href="javascript:void(0);" onclick="togle('ppt');">
                                                 <img  src="images/ppt_icon.gif" style="width: 10px; height: 10px; " align='texttop' />&nbsp;Power-Point Document</a></li>
                                               <li ><a href="javascript:void(0);" onclick="togle('txt');">
                                                <img  src="images/txt1.png" style="width: 10px; height: 10px; " align='texttop' />&nbsp;Text File</a></li>
                                       </a></li>
                                       </ul>
                               </li>
                               
                       </ul>
    <div class="update_btns fright">
	<a href="#" class="directory">Directory</a>
    <a class="upload active" href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'">Upload</a>
    
 <!--<a class="new" href="javascript:void(0);" onclick="togle();">New</a>  -->

</div>






 

    
    <div id="light" class="white_content" >
        <a style="margin-left: 575px;"  href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none';if(document.getElementById('upd').value=='1')location.reload();">
        
       <img src="image/close_music.png" />
        
        </a>
        <div id="main_container" style="margin-left:130px;">
        	<h2 style="color:#2399ba ;padding-bottom: 5px;">UPLOAD HERE</h2>
        	
            
            <form action="upload.php" method="post" enctype="multipart/form-data">
        		<input type="hidden" id="upd" />
                <input type="file" name="userfile" class="fileUpload" multiple>
        		
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
        <div id="fade" class="black_overlay"></div>
<div class="fleft width" style="margin-top:20px;">
<hr >
<div class="sep width"></div>

<font color="#15a0c8">
<?php
        echo traverse_history(); // maintain tree structure for traverse files and folders
        ?>
        </font>
        <form name="frm_sort" method="post" action="#">
        <p align="right">
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
<input type="checkbox" onchange="checkedAll()"  class="fleft" id="top_check" /> 
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

 <div class="search-field1" class="fleft" id="new_dir" style="display: none;" >
<div class="section1  ">
<div class="icon"><img src="images/large_icon.png" alt="" /></div>

<input type="text" id="txt_new_dir" name="txt_new_dir" class="box" onblur="submit_data('folder');" onkeypress="if(event.keyCode==13) {submit_data('folder');}"/>
    

</div>
</div>
<div class="search-field1" class="fleft" id="new_word" style="display: none;" >
<div class="section1  ">
<div class="icon"><img src="images/doc.png" alt="" /></div>

<input type="text" id="txt_new_word" name="txt_new_word" class="box" onblur="submit_data('doc');" onkeypress="if(event.keyCode==13) {submit_data('doc');}"/>
    

</div>
</div>

<div class="search-field1" class="fleft" id="new_excel" style="display: none;" >
<div class="section1  ">
<div class="icon"><img src="images/xls.png" alt="" /></div>

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
<div class="icon"><img src="images/ppt-png_icon.png" alt="" /></div>

<input type="text" id="txt_new_ppt" name="txt_new_ppt" class="box" onblur="submit_data('ppt');" onkeypress="if(event.keyCode==13) {submit_data('ppt');}"/>
    

</div>
</div>
<form id="frm7" name="frm7">
</div>

<?php

 if(mysql_num_rows($result_data)>0)
        {
            while($fetch_data=mysql_fetch_array($result_data))
            {
                generate_code($fetch_data['int_fid']);
                ?>
<div class="<?php echo $_SESSION['class_list'];  ?>" class="fleft" id="div_<?php echo $fetch_data['int_fid']; ?>">
<div class="section1  ">
<div class="fleft"><input id="acceptTerms_<?php echo $fetch_data['int_fid']; ?>"  name="acceptTerms_<?php echo $fetch_data['int_fid']; ?>" type="checkbox" value="<?php echo $fetch_data['int_fid']; ?>" onchange="togglecolor(this.value,this.id);"   /></div>

<div class="icon">

<?php if($fetch_data['txt_file_type']=="application/pdf") { ?>
                    <a href="download.php?path=<?php echo $fetch_data['txt_real_path']; ?>"> 
                    <?php 
                    }
                    else if($fetch_data['txt_file_type']=="folder")
                    {
                        ?>
                    <a href="javascript:void(0);" onclick="next_level(<?php echo $fetch_data['int_fid']; ?>);"> 
                        <?php
                    }
                    else if($fetch_data['txt_file_type']=="image/jpeg" || $fetch_data['txt_file_type']=="image/png" || $fetch_data['txt_file_type']=="image/gif" || $fetch_data['txt_file_type']=="image/jpg")
                    {
                    ?>
                    
                 <a  href="<?php echo $fetch_data['txt_real_path'];  ?>" rel="lightbox[plants]" >  
                  <?php
                  }
                   else 
                  { ?>
                 <a href="download.php?path=<?php echo $fetch_data['txt_real_path']; ?>">   
                  <?php
                  }
                  ?>
<img src="<?php echo get_file_thumb($fetch_data['txt_file_type'],$fetch_data['txt_file_name']); ?>" />  </a>

</div>
<div class="icon_sep" >
	<h4 >
    <?php if($fetch_data['txt_file_type']=="application/pdf") { ?>
                    <a href="download.php?path=<?php echo $fetch_data['txt_real_path']; ?>"> 
                    <?php 
                    }
                    else if($fetch_data['txt_file_type']=="folder")
                    {
                        ?>
                    <a href="javascript:void(0);" onclick="next_level(<?php echo $fetch_data['int_fid']; ?>);"> 
                        <?php
                    }
                    else if($fetch_data['txt_file_type']=="image/jpeg" || $fetch_data['txt_file_type']=="image/png" || $fetch_data['txt_file_type']=="image/gif" || $fetch_data['txt_file_type']=="image/jpg")
                    {
                    ?>
                    
                 <a href="<?php echo $fetch_data['txt_real_path'];  ?>"  rel="lightbox[plants1]">  
                  <?php
                  }
                  else 
                  { ?>
                 <a href="download.php?path=<?php echo $fetch_data['txt_real_path']; ?>">   
                  <?php
                  }
                  ?>
    <?php echo $fetch_data['txt_file_name']; ?>  </a>
    
    
    
    
    </h4>
    <h6> <?php echo "Modified: ".date("Y-m-d",$fetch_data['txt_last_modified']); ?></h6>
</div>


       <ul id="nav" class="dropdown dropdown-horizontal" title="Options">
                               
                               <li><a href="javascript:void(0);" class="delete_dropdown"></a>
                               <ul class="position">
                                                <?php if($fetch_data['txt_file_type']!="folder") { ?>
                                               <li>	
                                               
                                              
 <a href="javascript:void(0);" onclick="open_rename_div('<?php echo $fetch_data['int_fid'];  ?>','<?php echo $fetch_data['txt_file_name'];  ?>','<?php echo $fetch_data['int_is_folder'];  ?>')">
 <img  src="images/skin-icon-rename.png" style="width: 10px; height: 10px; " align='texttop' />&nbsp; rename </a>
</li><?php } ?>
                                               <li><a  href="javascript:void(0);" onclick="verify(<?php echo $fetch_data['int_fid']; ?>)"> 
                                               <img  src="images/delete.png" style="width: 10px; height: 10px; " align='texttop' />&nbsp;
                                               Delete </a></li>
                                               
                                       </a></li>
                                       </ul>
                               </li>
                               
                       </ul>
      <div class="share_btns">
       
       <?php if($fetch_data['txt_file_type']=="folder") { ?>  
                    <a title="Download This Folder" class="download" href="test_zip.php?path=<?php echo $fetch_data['txt_real_path']; ?>"> Download </a>
                   <?php } else { ?>  
                   <a title="Download This File" class="download" href="download.php?path=<?php echo $fetch_data['txt_real_path']; ?>"> Download </a>
                   <?php } ?>
       </a>
   <?php 
                   $select_code="select txt_shared_link from users_data where int_fid='".$fetch_data['int_fid']."'";
                   $result_code=mysql_query($select_code);
                   $fetch_code=mysql_fetch_array($result_code);
                    ?>
                   <a class="share" title="<?php if($fetch_data['txt_file_type']=="folder")echo "Share This Folder"; else echo "Share This File";  ?> "                
                   href="files/index.php?code=<?php echo $fetch_code['txt_shared_link'] ?>" target="_blank"> Share  </a>
   
 


</div>                 
</div>
</div>
<?php
}
    }
else
{
?>
<div class="width fleft" style="text-align: center;margin-top:25px ;"> 
<img src="image/empty_light.jpg" />
</div>
<?php
}
?>
</form>

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

</div>
 <form id="del_form" name="del_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
        <input type="hidden" value="<?php echo $_REQUEST['dir']; ?>" id="dir" name="dir" />
        <input type="hidden" value="" id="del_id" name="del_id" />
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
			width: 25%;
			height: 5%;
			padding: 16px;
		
			background-color: gray;
			z-index:2000;
			overflow: auto;
            opacity: 0.7;
        }
        </style>

    <div class="renamediv" id="rename_div" style="display: none;border: 1px solid red;">
    <form id="frm_rename" name="frm_rename" method="post" action="#">
    <input type="text" id="file_name" name="file_name" />
    <input type="hidden" id="file_name_prev" name="file_name_prev" />
    <input type="hidden" id="file_id" name="file_id" />
    <input type="hidden" id="file_folder" name="file_folder" />
    <input type="button" id="btn_rename" value="Save" onclick="submit_rename_data()" />
    <input  type="button" value="Cancel" onclick="document.getElementById('rename_div').style.display='none';" />
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
    location.href="index.php?name_page=home&dir="+id;
}
function autoHide()
{  //hide after 5 seconds
   setTimeout(function(){document.getElementById('error_container').style.display='none';},5000);
   setTimeout(function(){document.getElementById('error_container1').style.display='none';},5000);
}
</script>

