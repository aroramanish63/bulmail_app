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
print_r($_SESSION);
?>

<br>
<h2>My Databagg</h2>
<hr>
<?php echo "ss";?>
<div class="sub_container">
<?php
if($_REQUEST['dir'])
            {
               
                           
              $dir_scan="uploads/".$_SESSION['user_id']."/sync".$_SESSION['dir'];  
              
              
             }
            else
            $dir_scan="uploads/".$_SESSION['user_id']."/sync";
            
            $_SESSION['sync_path']=$dir_scan;
            
            $_SESSION['base_sync_path']="uploads/".$_SESSION['user_id']."/sync";
            
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
<div class="main">
<a href="#" class="icon"><img src="<?php echo get_file_thumb($row['txt_file_type'],$row['txt_file_name']); ?>" alt="" /></a>
<div class="icon_sep">
	<h4>
    <?php
    echo "<a href='#' onclick=\"set_sess('$in_file_dir');\">".$in_file_dir."</a>";
    ?>

</h4>
    <h6>Mofifiled: 2012-12-11 </h6>
</div>

<div class="share_btns">
asasas
</div>
</div>
<?php
	}
    }
?>
</div>

<?php

?>

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
					
				location.href="app_index.php?name_page=app_sync1&dir="+val;
                	// only if "OK"
				//alert(req1.responseText);
				}				
			}			
			req1.open("GET", strURL, true);
			req1.send(null);
		}		
	
    
}
</script>