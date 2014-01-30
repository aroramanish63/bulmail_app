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
	if ($upload->upload()){
	  
        
		
		echo '<div id="status">success</div>';
		echo '<div id="message">Successfully Uploaded</div>';
		//return the upload file
		echo '<div id="uploadedfile">'. $upload->file_copy .'</div>';
		
	} else {
		
		echo '<div id="status">failed</div>';
		echo '<div id="message">'. $upload->show_error_string() .'</div>';
		
	}
}

?>

