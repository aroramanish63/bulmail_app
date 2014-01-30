<?php
include("classes/easy_upload/upload_class.php"); //classes is the map where the class file is stored
include("../connect.php");
include("../function.php");	
include("../calculate_space.php");
session_start();
$upload = new file_upload();
if($_SESSION['dir']=="")
$upload->upload_dir = '../nas/uploads/'.$_SESSION['user_id'].'/'; //"uploads/".$_SESSION['user_id']."/".
else
{
$added_path=dirStructure_path($_REQUEST['current_pid']);
$upload->upload_dir = '../nas/uploads/'.$_SESSION['user_id'].'/'.$added_path;
}
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
           if(allocatted_space()<(get_total_consumed_space($_SESSION['user_id'])+$total_mb))
            {
                       
             ?>
             <script>
             
             alert("Files not uploaded. Your allocated space is allready filled by you. Please visit our plan page. ");
              // location.replace("index.php?name_page=pricing_selection");
             //document.getElementById('light').style.display='none';
             //document.getElementById('fade').style.display='none'
             //location.replace("index.php?name_page=pricing_selection");
             </script>
             <?php
             }
                        else
                        {
	if ($upload->upload()){
	   if($upload->the_file_type =="image/jpeg" || $upload->the_file_type =="image/png" || $upload->the_file_type =="image/jpg" || $upload->the_file_type =="image/gif" )
       {
	   if(!is_dir("../nas/uploads/thumb/"))
       mkdir("../nas/uploads/thumb/");
	       createThumbs($upload->upload_dir.$upload->the_file,"../nas/uploads/thumb/".$upload->the_file,100,100);
           //createThumbsforProfiles("uploads/".$upload->the_file,"uploads/thumb/".$upload->the_file,50,50);
	    }
        
           
            
          
           if($_SESSION['dir'])
           {
           
            
            
            $select_exist="select * from users_data where txt_file_name='".$upload->the_file."' and int_uid='".$_SESSION['user_id']."' and int_pid='".$_SESSION['new_id']."' and int_del_status=0  ";
            $res_ex=mysql_query($select_exist);
            if(mysql_num_rows($res_ex)==0)
            {
            $insert_data="insert into users_data (int_uid,int_pid,txt_file_name,int_file_size,txt_file_type,int_status,int_del_status,txt_last_modified,int_is_folder,int_is_shared,txt_shared_link,txt_sharer_emails,txt_real_path) 
           values ('".$_SESSION['user_id']."','".$_SESSION['new_id']."','".$upload->the_file."','".$upload->the_file_size."','".$upload->the_file_type."',1,0,'".$last_time."',0,0,'','','".$upload->upload_dir.$upload->the_file."')";
           mysql_query($insert_data) or die(mysql_error());
            }
            else
            {
                $_SESSION['dup']="true";
            }
           }
           else
           {
             $select_exist="select * from users_data where txt_file_name='".$upload->the_file."' and int_uid='".$_SESSION['user_id']."' and int_pid=0  and int_del_status=0";
            $res_ex=mysql_query($select_exist);
            if(mysql_num_rows($res_ex)==0)
            {
           $insert_data="insert into users_data (int_uid,int_pid,txt_file_name,int_file_size,txt_file_type,int_status,int_del_status,txt_last_modified,int_is_folder,int_is_shared,txt_shared_link,txt_sharer_emails,txt_real_path) 
           values ('".$_SESSION['user_id']."',0,'".$upload->the_file."','".$upload->the_file_size."','".$upload->the_file_type."',1,0,'".$last_time."',0,0,'','','".$upload->upload_dir.$upload->the_file."')";
           mysql_query($insert_data) or die(mysql_error());
           }
           else
           {
            $_SESSION['dup']="true";
           }
           }
           $description='Added: '.$upload->upload_dir.$upload->the_file;
           log_entry($description);
		
		echo '<div id="status">success</div>';
		echo '<div id="message">Successfully Uploaded</div>';
		//return the upload file
		echo '<div id="uploadedfile">'. $upload->file_copy .'</div>';
		
	} else {
		
		echo '<div id="status">failed</div>';
		echo '<div id="message">'. $upload->show_error_string() .'</div>';
		
	}
    }
}

?>

