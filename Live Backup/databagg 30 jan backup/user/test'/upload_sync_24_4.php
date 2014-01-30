<?php
include("classes/easy_upload/upload_class.php"); //classes is the map where the class file is stored
include("../connect.php");
include("../function.php");	
session_start();
$upload = new file_upload();

$upload->upload_dir =$_SESSION['sync_path']."/";

$upload->extensions = array('.png', '.jpg', '.zip', '.pdf' , '.mp4', '.wmv' , '.jpeg', '.txt', '.doc', '.xls', '.ppt', '.mp3', '.mp4', '.wav'); // specify the allowed extensions here
//$upload->rename_file = true;
$_SESSION['up']="a";

if(!empty($_FILES)) {
	$upload->the_temp_file = $_FILES['userfile']['tmp_name'];
	$upload->the_file = $_FILES['userfile']['name'];
    $upload->the_file_size = $_FILES['userfile']['size'];
    $upload->the_file_type = $_FILES['userfile']['type'];
	$upload->http_error = $_FILES['userfile']['error'];
    $last_time=time();
	$upload->do_filename_check = 'y'; // use this boolean to check for a valid filename
	
     $total_mb=($upload->the_file_size/1024)/1024;
            if(allocatted_space()<(total_space_used()+$total_mb))
            {
                       
             ?>
             <script>
             alert("Your allocatted space is allready filled by you.");
             document.getElementById('light').style.display='none';
             document.getElementById('fade').style.display='none'
             location.replace("index.php?name_page=pricing_selection");
             </script>
             <?php
             }
                        else
                        {
    if ($upload->upload()){
	  // error_reporting(E_ALL);
       
       $fpath="";
       $fpath.=$upload->upload_dir;
       $fpath.=$upload->the_file;
       //echo "<script>alert(\"" . $fpath . "\");</script>";
       
	   $newarr=explode("/",$fpath);
		$uniquefolder=$newarr[5];
       $fpath=substr($fpath,3,strlen($fpath));
        $insert_sync_db="insert into tab_webactions set int_member='".$_SESSION["user_id"]."' ,txt_action='Added' ,txt_type='File' ,txt_folname='".trim($_SESSION["folname"])."' ,txt_fullpath='".$fpath."', txt_uniquefolder='" . $uniquefolder . "'";
       //echo "<script>alert(\"" . $insert_sync_db . "\");</script>";
          
          //$quer=" insert into tab_webactions (int_member,txt_action,txt_type,txt_folname,txt_fullpath) values ('1','Added','File',' move containt right menu ','user/uploads/1/sync/W1-PC5CD2A481/move containt right menu/cell-phone.png') ";

        //mysql_query($quer) or die(mysql_error());
          
          mysql_query($insert_sync_db)or die(mysql_error());
	  
        
		
		echo '<div id="status">success</div>';
		echo "<div id='message'>Successfully Uploaded  </div>";
		//return the upload file
		echo '<div id="uploadedfile">'. $upload->file_copy .'</div>';
		
	} else {
		
		echo '<div id="status">failed</div>';
		echo '<div id="message">'. $upload->show_error_string() .'</div>';
		
	}
}
}

?>

