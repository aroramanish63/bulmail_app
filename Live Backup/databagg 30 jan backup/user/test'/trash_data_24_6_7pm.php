<?php
include("../include_user/include_home/common_function.php");
include("../include_user/include_home/untrash_functions.php");
//error_reporting(E_ALL);
if(!isset($_SESSION['class_list']))
$_SESSION['class_list']="field1";
//rename file and folder
if($_REQUEST['total_box_item'])
{
    $ids=$_REQUEST['total_box_item'];
    $delete_multiple="update users_data set  int_del_status=0 where int_fid in ($ids)";
    mysql_query($delete_multiple)or die(mysql_error());
    $suc_msg="Untrash successfully.";
}




if($_REQUEST['unshare_id'])
{
    
   // print_r($_REQUEST);
  doUntrash($_SESSION['user_id'],$_REQUEST['unshare_id']);
   
    $suc_msg="Untrash successfully.";
}




if($_REQUEST['per_del_id'])
{
    $delete_multiple="update users_data set  int_del_status=-2 where int_fid='".$_REQUEST['per_del_id']."'";
    mysql_query($delete_multiple)or die(mysql_error());
    $suc_msg="Deleted successfully.";
}






//create new directory with all its quality


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


if($_REQUEST['s'])
    {
     if($_SESSION['sorting_opt']==2)
     $select_data="SELECT * FROM `tab_version` as t1 WHERE `txt_local_path` not in (select `txt_local_path` from users_data where int_uid='".$_SESSION['user_id']."' ) and  int_uid='".$_SESSION['user_id']."' and int_id=(select max(int_id) from tab_version where txt_local_path=t1.txt_local_path) and txt_file_name like '%".$_REQUEST['s']."%'   order by txt_file_name asc";
    else if($_SESSION['sorting_opt']==3)
     $select_data="SELECT * FROM `tab_version` as t1 WHERE `txt_local_path` not in (select `txt_local_path` from users_data where int_uid='".$_SESSION['user_id']."' ) and  int_uid='".$_SESSION['user_id']."' and int_id=(select max(int_id) from tab_version where txt_local_path=t1.txt_local_path) and txt_file_name like '%".$_REQUEST['s']."%'  order by txt_last_modified desc";
    else
     $select_data="SELECT * FROM `tab_version` as t1 WHERE `txt_local_path` not in (select `txt_local_path` from users_data where int_uid='".$_SESSION['user_id']."' ) and  int_uid='".$_SESSION['user_id']."' and int_id=(select max(int_id) from tab_version where txt_local_path=t1.txt_local_path) and txt_file_name like '%".$_REQUEST['s']."%'  order by int_file_size desc";
     
    
    }
    else
    {

    if($_SESSION['sorting_opt']==2)
     $select_data="SELECT * FROM `tab_version` as t1 WHERE `txt_local_path` not in (select `txt_local_path` from users_data where int_uid='".$_SESSION['user_id']."' ) and  int_uid='".$_SESSION['user_id']."' and int_id=(select max(int_id) from tab_version where txt_local_path=t1.txt_local_path)    order by txt_file_name asc";
    else if($_SESSION['sorting_opt']==3)
     $select_data="SELECT * FROM `tab_version` as t1 WHERE `txt_local_path` not in (select `txt_local_path` from users_data where int_uid='".$_SESSION['user_id']."' ) and  int_uid='".$_SESSION['user_id']."' and int_id=(select max(int_id) from tab_version where txt_local_path=t1.txt_local_path)   order by txt_last_modified desc ";
    else
     $select_data="SELECT * FROM `tab_version` as t1 WHERE `txt_local_path` not in (select `txt_local_path` from users_data where int_uid='".$_SESSION['user_id']."' ) and  int_uid='".$_SESSION['user_id']."' and int_id=(select max(int_id) from tab_version where txt_local_path=t1.txt_local_path)  order by int_file_size desc ";
     }
     $result_data=mysql_query($select_data) or die(mysql_query());  

//print_r($_SESSION);
//print_r($_REQUEST);
//echo $select_data;
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
			-moz-opacity: 0.5;
			opacity:.50;
			filter: alpha(opacity=50);
		}
		.white_content {
			display: none;
			position: absolute;
			top: 25%;
			left: 25%;
			width: 45%;
		    min-height: 30%;
            
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


<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.14.custom.min.js" type="text/javascript"></script>


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


<h1>Trash Data Bagg</h1>
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




 

    
<div class="fleft width" style="margin-top:20px;">
<hr >
<div class="sep width"></div>

<font color="#15a0c8">
<?php
        //echo "<a href='index.php?name_page=trash_data'> Home </a>"; // maintain tree structure for traverse files and folders
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
<!--<input type="checkbox" onchange="checkedAll()"  class="fleft" />  -->
 <div id="test" class="chk_msg" >
 <a href="javascript:void(0);" onclick="delete_confirm();" style="text-decoration: none;color: white;">  Untrash All </a>
 
 </div>
 <script>
 function delete_confirm()
 {
    if(confirm("Are you sure want to Untrash these files."))
    window.total_box.submit();
    
 }
 </script>
<form id="total_box" name="total_box" method="post" action="#">
<input type="hidden" name="total_box_item" id="total_box_item" />
<input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
</form>
<script type="text/javascript">
checked=false;
 
function checkedAll () {
    var tot_id="";
   
	var aa= document.getElementById('frm7');
	 if (checked == false)
          {
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
</script>

 
<form id="frm7" name="frm7">
</div>

<?php

 if(mysql_num_rows($result_data)>0)
        {
            while($fetch_data=mysql_fetch_array($result_data))
            {
                //generate_code($fetch_data['int_fid']);
                ?>
<div class="<?php echo $_SESSION['class_list'];  ?>" class="fleft" >
<div class="section1  ">
<div class="fleft">
<!-- <input id="acceptTerms"   name="acceptTerms" type="checkbox" value="<?php echo $fetch_data['int_fid']; ?>"  />  -->
</div>

<div class="icon">

<?php if($fetch_data['txt_file_type']=="application/pdf") { ?>
                   <!-- <a href="download.php?path=uploads/<?php echo $fetch_data['txt_real_path']; ?>"> -->
                    <?php 
                    }
                    else if($fetch_data['txt_file_type']=="folder")
                    {
                        $fname_zip=$fetch_data['txt_file_name'];
                        $uid=$_SESSION['user_id'];
                        //echo "uploads/$uid/$fname_zip.zip";
                        //zip_directory($fetch_data['txt_real_path'], "uploads/$uid/$fname_zip.zip");
                        //echo $fetch_data['txt_real_path'];
                        ?>
                 <!--  <a href="download.php?path=<?php echo $fetch_data['txt_real_path'].".zip";  ?>"> -->
                        <?php
                    }
                    else if($fetch_data['txt_file_type']=="image/jpeg" || $fetch_data['txt_file_type']=="image/png" || $fetch_data['txt_file_type']=="image/gif" || $fetch_data['txt_file_type']=="image/jpg")
                    {
                    ?>
                    
                <!-- <a href="<?php echo $fetch_data['txt_real_path'];  ?>" rel="lightbox[plants]">  -->
                  <?php
                  }
                   else 
                  { ?>
               <!--  <a href="download.php?path=uploads/<?php echo $fetch_data['txt_real_path']; ?>">  -->   
                  <?php
                  }
                  ?>
<img src="<?php echo get_file_icon1(0,$fetch_data['txt_file_name']); ?>" />  

</div>
<div class="icon_sep" >
	<h4 >
    <?php if($fetch_data['txt_file_type']=="application/pdf") { ?>
                   <!-- <a href="download.php?path=uploads/<?php echo $fetch_data['txt_file_name']; ?>"> -->
                    <?php 
                    }
                    else if($fetch_data['txt_file_type']=="folder")
                    {
                        ?>
                    <a href="javascript:void(0);" > 
                        <?php
                    }
                    else if($fetch_data['txt_file_type']=="image/jpeg" || $fetch_data['txt_file_type']=="image/png" || $fetch_data['txt_file_type']=="image/gif" || $fetch_data['txt_file_type']=="image/jpg")
                    {
                    ?>
                    
               <!--  <a href="<?php echo $fetch_data['txt_real_path'];  ?>"  rel="lightbox[plants1]">  -->
                  <?php
                  }
                  else 
                  { ?>
                <!-- <a href="download.php?path=uploads/<?php echo $fetch_data['txt_file_name']; ?>">   -->
                  <?php
                  }
                  ?>
    <?php echo $fetch_data['txt_file_name']; ?>  
    
    
    
    
    </h4>
    <h6> <?php echo "Modified: ".setDateFormatAdvanced($fetch_data['txt_last_modified'],'Y-m-d'); ?></h6>
</div>
            <?php
             $select_previous_exist_confirm="select * from users_data  where txt_real_path='".$fetch_data['txt_real_path']."' and int_del_status=0";
                $result_prevoius_exist_confirm=mysql_query($select_previous_exist_confirm);
                $count_cnfrm=mysql_num_rows($result_prevoius_exist_confirm);
            ?>

       <ul id="nav" class="dropdown dropdown-horizontal" title="Options">
                               
                               <li><a href="javascript:void(0);" class="delete_dropdown"></a>
                               <ul class="position">
                                                
                                               
                                               <li><a  href="javascript:void(0);" onclick="verify(<?php echo $fetch_data['int_fid']; ?>,<?php echo $fetch_data['int_is_folder']; ?>,<?php echo $count_cnfrm; ?>)"> 
                                               <img  src="images/untrash.png" style="width: 10px; height: 10px; " align='texttop' />&nbsp;
                                               Untrash </a></li>
                                               <li><a  href="javascript:void(0);" onclick="verify_force(<?php echo $fetch_data['int_fid']; ?>)"> 
                                               <img  src="images/delete.png" style="width: 10px; height: 10px; " align='texttop' />&nbsp;
                                               Permanent Delete  </a></li>
                                               
                                       </a></li>
                                       </ul>
                               </li>
                               
                       </ul>
            
</div>
</div>
<?php
}
    }
    else
    {
    ?>
    <div class="width fleft" style="text-align: center;margin-top:25px ;"> 
<!--<img src="image/nothing_shared.jpg" /> -->
</div>
    <?php
    }
?>
</form>
</div>
 

   <form id="unshare" name="unshare" method="post" action="#">
   <input type="hidden" id="unshare_id" name="unshare_id" />
    <input type="hidden" id="is_f" name="is_f" />
    <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
   </form>
   
   <form id="per_del" name="per_del" method="post" action="#">
   <input type="hidden" id="per_del_id" name="per_del_id" />
    <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
   </form>
    
</body>
</html>
<script>
function trim(data)
{
    return data.replace(/^\s+|\s+$/g,'');
}


function verify(did,f_stat,count_cnfrm)
{
    
    
    if(confirm("Are you sure to untrash this file. "))
    {
        document.getElementById('unshare_id').value=did;
   document.getElementById('is_f').value=f_stat;
        if(count_cnfrm>0)
        {
            if(confirm("The destination already contains a same file . Are you sure to replace that file"))
            document.unshare.submit();
            else
            return false;
        }
        else
        {
          document.unshare.submit();
        }
    //
    }
}
function verify_force(did)
{
    
    
    if(confirm("Are you sure to delete this file permanently . "))
    {
    document.getElementById('per_del_id').value=did;
    document.per_del.submit();
    }
}

function next_level(id)
{
    location.href="index.php?name_page=shared_data&dir="+id;
}
function autoHide()
{  //hide after 5 seconds
   setTimeout(function(){document.getElementById('error_container').style.display='none';},5000);
   setTimeout(function(){document.getElementById('error_container1').style.display='none';},5000);
}
</script>

