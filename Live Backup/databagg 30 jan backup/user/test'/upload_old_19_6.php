<?php
session_start();
include("classes/easy_upload/upload_class.php"); //classes is the map where the class file is stored
include("../connect.php");
include("../function.php");	
include("../calculate_space.php");
include("../include_user/include_home/common_function.php");
include("../include_user/include_home/drive_functions.php");
include("../include_user/include_home/upload_functions.php");
include("../include_user/include_home/space_functions.php");


$upload = new file_upload();

$parrent_id=$_REQUEST['current_pid'];



//$upload->upload_dir =."/";



//$upload->extensions = array('.png', '.jpg', '.zip', '.pdf' , '.mp4', '.wmv' , '.jpeg', '.txt', '.doc', '.xls', '.ppt', '.mp3', '.mp4', '.wav'); // specify the allowed extensions here
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
	$f_name=$upload->the_file;
    $drive_name=getActiveDrive($upload->the_file_size);
    
    checkDriveDirForMember($_SESSION['user_id'],$drive_name,'..');
    
    $upload->upload_dir=$drive_name."/"."uploads/".$_SESSION['user_id']."/";
    
    
     $total_mb=($upload->the_file_size/1024)/1024;
            if(allocatted_space()<(get_total_consumed_space($_SESSION['user_id'])+$total_mb))
            {
                       
             ?>
             <script>
             alert("Files not uploaded. Your allocated space is allready filled by you. Please visit our plan page. ");
             </script>
             <?php
             }
                        else
                        {
            $extension=get_ext($upload->the_file);
        $randomnumber=createRandomNumber(30,true) . date("YmdHisu") . rand();
        $realpath=$upload->upload_dir. $randomnumber . "." . $extension;
        $upload->the_file=$randomnumber . "." . $extension;
        $upload->upload_dir="../".$upload->upload_dir;
    if ($upload->upload()){
	 
       
        
    //$localpath=$local_path."|".urldecode($f_name);
    
    

       doFileUpload($_SESSION['user_id'],$parrent_id,urldecode($f_name),$upload->the_file_size,date("Ymd"),date("His"),$realpath,'');
       
       updateUserSpace($_SESSION['user_id'],$upload->the_file_size,"+");
       updateDriveSpace($drive_name,$upload->the_file_size,"+");
       
       //$insert_data="insert into users_data (int_uid,int_pid,txt_file_name,
//       int_file_size,txt_file_type,int_status,int_del_status,
//       txt_last_modified,int_is_folder,int_is_shared,
//       txt_shared_link,txt_sharer_emails,txt_real_path) 
//           values ('".$_SESSION['user_id']."',
//           '".$_SESSION['new_id']."',
//           '".$upload->the_file."',
//           '".$upload->the_file_size."',
//           '".$upload->the_file_type."'
//           ,1,0,'".$last_time."',0,0,'',
//           '','".$upload->upload_dir.$upload->the_file."')";
//           mysql_query($insert_data) or die(mysql_error());
      
		
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

