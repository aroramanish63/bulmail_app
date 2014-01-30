<?php
if(!isset($_REQUEST["member_id"]))
{
    
}
else
$_SESSION["user_id"]=$_REQUEST["member_id"];
//session_start();
//if(!$_SESSION['user_id'])
//header("Location:login.php");
//
//include("connect.php");
//include("function.php");
////session_start();
//error_reporting(0);
if($_REQUEST['spcldir'])
{
    $_SESSION['dir']=$_REQUEST['spcldir'];
}






if(!isset($_SESSION['class_list']))
$_SESSION['class_list']="field1";
//rename file and folder



//create new directory with all its quality

//remove all history when home page lode
if($_REQUEST['dir']=="")
{
$_SESSION['dir']="";
$_SESSION['dir1']="";
$_SESSION['new_id']="";
}

//session for sorting
if($_REQUEST['sorting_opt']==1)
$_SESSION['sorting_opt']=1;
else if($_REQUEST['sorting_opt']==3)
$_SESSION['sorting_opt']=3;
else
$_SESSION['sorting_opt']=2;

//use session based array for history traverse and listing of data
if(!$_REQUEST['s'])
$_REQUEST['s']="";



if(isset($_REQUEST['sync_dir']))
{
    $data_direct1=$_REQUEST['sync_dir'];
    $data_direct="/";
    $data_direct.=str_replace("|","/",$data_direct1);
    $_SESSION['dir']=$data_direct;
}

//print_r($_SESSION);

//print_r($_SESSION);
//print_r($_REQUEST);
?>


 

<?php
$vl=directory_view($_SESSION['dir']);
       
        
        $_SESSION['total_level']=count(explode(">>",$vl));
?>





<?php
if($suc_msg)
$_REQUEST['err']="";
?>



<br />
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
</style>
 <div id="div_loading" class="white_content1" >
 
        
        <img src="images/ajax-loader_dir_load.gif" /> <b style="color:#E85005"> Loading ... </b> 
 </div>
 <div id="fade_loading" class="black_overlay1"></div>
<h1>My Sync Folder</h1>
<hr>









 

    
  
<div class="sub_container">

<font color="#15a0c8">
<?php

        echo directory_view($_SESSION['dir']); // maintain tree structure for traverse files and folders
        
        ?>
        </font>
  




 



<?php

            //$temp_dir="uploads/1/Sync/";
            if($_REQUEST['dir'] || $_REQUEST['sync_dir'])
            {
               
                           
              $dir_scan="../nas/uploads/".$_SESSION['user_id']."/sync".$_SESSION['dir'];  
              
              
             }
            else
            $dir_scan="../nas/uploads/".$_SESSION['user_id']."/sync";
            
            $_SESSION['sync_path']=$dir_scan;
            
            $_SESSION['base_sync_path']="../nas/uploads/".$_SESSION['user_id']."/sync";
            
            $file_dir = scandir($dir_scan);
            $cnt=0;
            foreach($file_dir as $in_file_dir)
            {
               
                 if($in_file_dir != '.' && $in_file_dir != '..' && is_dir($dir_scan.'/'.$in_file_dir) ){
                    $arrdir[]=$in_file_dir;
                    }
            }
           // print_r($arrdir);
             if($_SESSION['sorting_opt']==2)
                   sort($arrdir); 
            foreach($arrdir as $in_file_dir)
            {
               
                 if($in_file_dir != '.' && $in_file_dir != '..' && is_dir($dir_scan.'/'.$in_file_dir) ){

                    $cnt++;
                ?>
<div class="main" >


<div class="icon">

<a href='javascript:void(0);' onclick="document.getElementById('div_loading').style.display='block';document.getElementById('fade_loading').style.display='block';set_sess('<?php echo $in_file_dir; ?>');">
<img src="images/large_icon.png" />
</a>

</div>


<div class="icon_sep" >
	<h4 >
   
    <?php 
    
  
           
           // echo "<a href='#' onclick=\"set_sess('$in_file_dir');\">".$in_file_dir."</a>";
            echo "<a href='#' onclick=\"document.getElementById('div_loading').style.display='block';document.getElementById('fade_loading').style.display='block';set_sess('$in_file_dir');\">".$in_file_dir."</a>";
          // index.php?name_page=my_sync&dir=$in_file_dir
            //if(is_dir($dir.'/'.$ff)) listFolderFiles($dir.'/'.$ff);
           
       
    ?>
    
    
    
    
    </h4>
   
</div>


    <!--  <ul id="nav" class="dropdown dropdown-horizontal" title="Options">
                               
                               <li><a href="javascript:void(0);" class="delete_dropdown"></a>
                               <ul class="position">
                                                
                                               <li>	
                                               
                                              
 <a href="javascript:void(0);" onclick="open_rename_div('<?php echo $in_file_dir;  ?>','<?php echo $in_file_dir;  ?>','<?php echo $in_file_dir;  ?>')">
 <img  src="images/skin-icon-rename.png" style="width: 10px; height: 10px; " align='texttop' />&nbsp; rename </a>
</li>
                                               <li><a  href="javascript:void(0);" onclick="verify('<?php echo $in_file_dir; ?>')"> 
                                               <img  src="images/delete.png" style="width: 10px; height: 10px; " align='texttop' />&nbsp;
                                               Delete </a></li>
                                               
                                       </a></li>
                                       </ul>
                               </li>
                               
                       </ul>  -->
     <div class="share_btns">
       
      
                    <a title="Download This Folder" target="_blank" class="download" href="test_zip.php?path=<?php echo $_SESSION['sync_path']."/".$in_file_dir; ?>"> Download </a>
                 <?php
                 if($_SESSION['total_level']>3)
{ ?>
                 <a target="_blank" href="files/index.php?code1=<?php echo $_SESSION['sync_path']; ?>&nm=<?php echo $in_file_dir; ?>&bagid=<?php echo base64_encode($_SESSION['user_id']); ?>" title="Share this folder" class="share">Upload</a>  
 <?php }
 ?>                 
     
   
   
 


</div>            
</div>


<?php
}
}
            foreach($file_dir as $in_file_dir)
            {
               
                 if($in_file_dir != '.' && $in_file_dir != '..' && !is_dir($dir_scan.'/'.$in_file_dir) ){
                    $arrfile[]=$in_file_dir;
                    }
                    }
                   if($_SESSION['sorting_opt']==2)
                   sort($arrfile); 
            foreach($arrfile as $in_file_dir)
            {
               
                 if($in_file_dir != '.' && $in_file_dir != '..' && !is_dir($dir_scan.'/'.$in_file_dir) ){
                    $cnt++;
                ?>
<div class="main">



<div class="icon">

<img src="<?php echo get_file_icon($in_file_dir); ?>" />

</div>
<div class="icon_sep" >
	<h4 >
   
    <?php 
    
  
           
            echo $in_file_dir;
           
            //if(is_dir($dir.'/'.$ff)) listFolderFiles($dir.'/'.$ff);
           
       
    ?>  </a>
    
    
    
    
    </h4>
    <h6> <?php //echo "Modified: ".date("Y-m-d",$fetch_data['txt_last_modified']); ?></h6>
</div>


    <!--  <ul id="nav" class="dropdown dropdown-horizontal" title="Options">
                               
                               <li><a href="javascript:void(0);" class="delete_dropdown"></a>
                               <ul class="position">
                                                
                                               <li>	
                                               
                                              
 <a href="javascript:void(0);" onclick="open_rename_div('<?php echo $in_file_dir;  ?>','<?php echo $in_file_dir;  ?>','<?php echo $in_file_dir;  ?>')">
 <img  src="images/skin-icon-rename.png" style="width: 10px; height: 10px; " align='texttop' />&nbsp; rename </a>
</li>
                                               <li><a  href="javascript:void(0);" onclick="verify('<?php echo $in_file_dir; ?>')"> 
                                               <img  src="images/delete.png" style="width: 10px; height: 10px; " align='texttop' />&nbsp;
                                               Delete </a></li>
                                               
                                       </a></li>
                                       </ul>
                               </li>
                               
                       </ul>  -->
  <div class="share_btns">
       
       
                   <a title="Download This File" class="download" href="download.php?path=<?php echo $_SESSION['sync_path']."/".$in_file_dir; ?>"> Download </a>
                   
        <?php
                 if($_SESSION['total_level']>3)
{ ?>
                 <a target="_blank" href="files/index.php?code1=<?php echo $_SESSION['sync_path']; ?>&nm=<?php echo $in_file_dir; ?>&bagid=<?php echo base64_encode($_SESSION['user_id']); ?>"  title="Share this file " href="#" class="share">Upload</a>  
 <?php }
 ?>                 
  

</div>          
</div>

<?php
}
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

</div>
 <form id="del_form" name="del_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
        <input type="hidden" value="<?php echo $_REQUEST['dir']; ?>" id="dir" name="dir" />
        <input type="hidden" value="" id="del_id" name="del_id" />
        </form>


   
    
</body>
</html>
<script>
function trim(data)
{
    return data.replace(/^\s+|\s+$/g,'');
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
function set_sess(val)
{
    	var strURL="ajax_set_sync_sess.php?add="+val;
        //alert(strURL);
		var req1 = testXML();
		
		if (req1) {
			
			req1.onreadystatechange = function() {
			 
				if (req1.readyState == 4) {
					
				location.href="app_index.php?name_page=app_sync&dir="+val;
                	// only if "OK"
				//alert(req1.responseText);
				}				
			}			
			req1.open("GET", strURL, true);
			req1.send(null);
		}		
	
    
}

</script>

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
	$arrid[$cnt]="";

	for($i=count($arr)-1;$i>=0;$i--)
		echo "<a href='index.php?name_page=my_sync&dir=" . $arrid[$i] . "'>" . $arr[$i] . ">> </a>";
	}

function directory_view($pth)
{
    $pth1=explode("/",$pth);
    $cn=0;
    $str="<a href='app_index.php?name_page=app_sync&dir='''> Home </a> >> ";
    $visitpath_prefix="";
    foreach($pth1 as $val)
    {
        if($cn>0)
        {
            $visitpath_prefix.="/";
            $visitpath_prefix.=$val;
            //$_SESSION['dir']="";
        $str.="<a href='app_index.php?name_page=app_sync&dir=$visitpath_prefix&spcldir=$visitpath_prefix' > $val </a>";
        $str.=" >> ";
        }
        if($cn==2)
        $_SESSION['folname']=$val;
        $cn++;
    }


    return $str;
    
}

?>
