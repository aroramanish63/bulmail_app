<?php
//include("connect.php");

//Welcome mail

include("mail_function.php");

function log_entry($description)
{   $last_time=time();
    $insert_log_data="insert into users_log (txt_log_time,txt_log_data)values('".$last_time."','".$description."')";
    mysql_query($insert_log_data);
}
function total_space_used()
{
    $select_total_used="select sum(int_file_size) as total from users_data where int_uid='".$_SESSION['user_id']."'";
$result_total=mysql_query($select_total_used);
$fetch_total=mysql_fetch_array($result_total);
$f='../nas/uploads/' . $_SESSION['user_id'] . '/sync';
$bytes = 0;
if(file_exists($f))
{
/*
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($f));
foreach ($iterator as $i) 
	$bytes += $i->getSize();
*/
$output = exec('du -sk ' . $f);
$bytes = trim(str_replace($f, '', $output)) * 1024;
}
 $tot=$fetch_total['total']+$bytes;
$total_mb=($tot/1024)/1024;
return number_format($total_mb,2,'.', '');
}

//function generate_code($id)
//{
//    $share_link="";
//    $path="";
//    
//    $select_exist_share="select txt_shared_link,txt_real_path from users_data where int_fid='".$id."'";
//    $result_exist_share=mysql_query($select_exist_share) or die(mysql_error());
//    $fetch_share_link=mysql_fetch_array($result_exist_share);
//    if($fetch_share_link['txt_shared_link']==0)
//    {
//    $rid=random_id();
//     $update_share_link="update users_data set txt_shared_link='".$rid."' where int_fid='".$id."'";
//    
//    $result_update_share=mysql_query($update_share_link) or die(mysql_error());
//    $select_exist_share_new="select txt_shared_link,txt_real_path from users_data where int_fid='".$id."'";
//    $result_exist_share_new=mysql_query($select_exist_share_new) or die(mysql_error());
//    $fetch_share_link_new=mysql_fetch_array($result_exist_share_new);
//    
//    }
//
//}
function generate_code($id)
{
    
    $share_link="";
    $path="";
    
    $select_share="select * from users_data where int_fid='".$id."'";
    $result_share=mysql_query($select_share) or die(mysql_error());
    $fetch_link=mysql_fetch_array($result_share);
    
    $select_exist_share="select txt_share_link from tab_share where int_fid='".$id."'";
   $result_exist_share=mysql_query($select_exist_share) or die(mysql_error());
    $fetch_share_link=mysql_fetch_array($result_exist_share);
    $nm=mysql_num_rows($result_exist_share);
    if($nm==0)
    {

    $rid=random_id();
      $update_share_link="insert into  tab_share (txt_share_link,txt_file_name,txt_real_path,int_is_folder,int_uid,int_fid)
      values('".$rid."','".$fetch_link['txt_file_name']."','".$fetch_link['txt_real_path']."','".$fetch_link['int_is_folder']."','".$_SESSION['user_id']."','".$id."')";
    
    $result_update_share=mysql_query($update_share_link) or die(mysql_error());
    //$select_exist_share_new="select txt_shared_link,txt_real_path from users_data where int_fid='".$id."'";
//    $result_exist_share_new=mysql_query($select_exist_share_new) or die(mysql_error());
//    $fetch_share_link_new=mysql_fetch_array($result_exist_share_new);
    
    }

}
function create_dir($new_dir_name)
{
     $select_exist_folder="select * from users_data where txt_file_name='".$new_dir_name."' and int_uid='".$_SESSION['user_id']."' and int_del_status=0 and int_is_folder=1";
             $result_exist_folder=mysql_query($select_exist_folder);
             $last_time=time();
        if(mysql_num_rows($result_exist_folder)==0)
        {
                $path_folder="../nas/uploads/".$_SESSION['user_id']."/".$new_dir_name;
               $insert_folder="insert into users_data (int_uid,int_pid,txt_file_name,int_file_size,txt_file_type,int_status,int_del_status,txt_last_modified,int_is_folder,int_is_shared,txt_shared_link,txt_sharer_emails,txt_real_path) 
               values ('".$_SESSION['user_id']."',0,'".$new_dir_name."','0','folder',1,0,'".$last_time."',1,0,'','','".$path_folder."')";
               mysql_query($insert_folder) or die(mysql_error());
               mkdir("../nas/uploads/".$_SESSION['user_id']."/".$new_dir_name);
                $description='Directory Added: '."../nas/uploads/".$_SESSION['user_id']."/".$new_dir_name;
                log_entry($description);
        }
        else
        {
                 $name=$new_dir_name;
            
                 $select_exist_folder1="select * from users_data where txt_file_name like '$name%' and int_uid='".$_SESSION['user_id']."' and int_is_folder=1 and int_del_status=0";
                 $result_exist_folder1=mysql_query($select_exist_folder1) or die(mysql_error());
                 $count=mysql_num_rows($result_exist_folder1);
            for($i=1;$i<=$count;$i++)
            {
                        $select_exist_folder2="select * from users_data where int_is_folder=1 and int_del_status=0 and int_uid='".$_SESSION['user_id']."' and txt_file_name='".$name."($i)"."'";
                        $result_exist_folder2=mysql_query($select_exist_folder2);
                        $counts=mysql_num_rows($result_exist_folder2);
                    if($counts==0)
                    {       $new_folder=$name."($i)";
                            $path_folder="../nas/uploads/".$new_folder;
                            $insert_folder_new="insert into users_data (int_uid,int_pid,txt_file_name,int_file_size,txt_file_type,int_status,int_del_status,txt_last_modified,int_is_folder,int_is_shared,txt_shared_link,txt_sharer_emails,txt_real_path) 
                             values ('".$_SESSION['user_id']."',0,'".$new_folder."','0','folder',1,0,'".$last_time."',1,0,'','','".$path_folder."')";
                                mysql_query($insert_folder_new) or die(mysql_error());
                                mkdir("../nas/uploads/".$_SESSION['user_id']."/".$new_folder);
                                $description='Directory Added: '."../nas/uploads/".$_SESSION['user_id']."/".$new_folder;
                                log_entry($description);
                                break;
                    }
            }
            //$name=$_REQUEST['new_dir_name'];
            //echo "Please provide another name for the new folder. Directory $name is already exists. "."<br>";
        }
}
function create_file($new_dir_name,$ftype)
{   
            if($ftype=="ppt")
            {
               $ext_type="application/vnd.ms-powerpoint";
               $new_dir_full_name=$new_dir_name.".ppt";
             }
               if($ftype=="doc")
             {
                
              $ext_type="application/vnd.ms-word";
              $new_dir_full_name=$new_dir_name.".doc";
              }
               if($ftype=="xls")
               {
               $ext_type="application/vnd.ms-excel";
               $new_dir_full_name=$new_dir_name.".xls";
               }
               if($ftype=="txt")
               {
               $ext_type="text/plain";
               $new_dir_full_name=$new_dir_name.".txt";
               }
     $select_exist_folder="select * from users_data where txt_file_name='".$new_dir_full_name."' and int_uid='".$_SESSION['user_id']."' and int_is_folder=0 and int_del_status=0";
             $result_exist_folder=mysql_query($select_exist_folder);
             $last_time=time();
        if(mysql_num_rows($result_exist_folder)==0)
        {
                $path_folder="../nas/uploads/".$_SESSION['user_id']."/".$new_dir_full_name;
               $insert_folder="insert into users_data (int_uid,int_pid,txt_file_name,int_file_size,txt_file_type,int_status,int_del_status,txt_last_modified,int_is_folder,int_is_shared,txt_shared_link,txt_sharer_emails,txt_real_path) 
               values ('".$_SESSION['user_id']."',0,'".$new_dir_full_name."','0','".$ext_type."',1,0,'".$last_time."',0,0,'','','".$path_folder."')";
               mysql_query($insert_folder) or die(mysql_error());
               //mkdir("uploads/".$_SESSION['user_id']."/".$new_dir_name);
               if($ftype=="ppt")
               copy("temp_files/temp.ppt","../nas/uploads/".$_SESSION['user_id']."/".$new_dir_name.".ppt");
               if($ftype=="doc")
               copy("temp_files/temp.doc","../nas/uploads/".$_SESSION['user_id']."/".$new_dir_name.".doc");
               if($ftype=="xls")
               copy("temp_files/temp.xls","../nas/uploads/".$_SESSION['user_id']."/".$new_dir_name.".xls");
               if($ftype=="txt")
               copy("temp_files/temp.txt","../nas/uploads/".$_SESSION['user_id']."/".$new_dir_name.".txt");
                $description='Files Added: '."../nas/uploads/".$_SESSION['user_id']."/".$new_dir_name;
                log_entry($description);
        }
        else
        {
                 $name=$new_dir_name;
            
                 $select_exist_folder1="select * from users_data where txt_file_name like '$new_dir_full_name%' and int_uid='".$_SESSION['user_id']."' and int_is_folder=0 and int_del_status=0";
                 $result_exist_folder1=mysql_query($select_exist_folder1) or die(mysql_error());
                 $count=mysql_num_rows($result_exist_folder1);
            for($i=1;$i<=$count;$i++)
            {
                        $select_exist_folder2="select * from users_data where int_is_folder=0 and int_del_status=0 and int_uid='".$_SESSION['user_id']."' and txt_file_name='".$new_dir_full_name."($i)"."'";
                        $result_exist_folder2=mysql_query($select_exist_folder2);
                        $counts=mysql_num_rows($result_exist_folder2);
                    if($counts==0)
                    {       $new_folder=$new_dir_full_name."($i)";
                            $path_folder="../nas/uploads/".$_SESSION['user_id']."/".$new_folder;
                            $insert_folder_new="insert into users_data (int_uid,int_pid,txt_file_name,int_file_size,txt_file_type,int_status,int_del_status,txt_last_modified,int_is_folder,int_is_shared,txt_shared_link,txt_sharer_emails,txt_real_path) 
                             values ('".$_SESSION['user_id']."',0,'".$new_folder."','0','".$ext_type."',1,0,'".$last_time."',0,0,'','','".$path_folder."')";
                                mysql_query($insert_folder_new) or die(mysql_error());
                                     if($ftype=="ppt")
                                    copy("temp_files/temp.ppt","../nas/uploads/".$_SESSION['user_id']."/".$new_folder);
                                    if($ftype=="doc")
                                   copy("temp_files/temp.doc","../nas/uploads/".$_SESSION['user_id']."/".$new_folder);
                                   if($ftype=="xls")
                                   copy("temp_files/temp.xls","../nas/uploads/".$_SESSION['user_id']."/".$new_folder);
                                   if($ftype=="txt")
                                   copy("temp_files/temp.txt","../nas/uploads/".$_SESSION['user_id']."/".$new_folder);
                                //mkdir("uploads/".$_SESSION['user_id']."/".$new_folder);
                                $description='Files Added: '."../nas/uploads/".$_SESSION['user_id']."/".$new_folder;
                                log_entry($description);
                                break;
                    }
            }
            //$name=$_REQUEST['new_dir_name'];
            //echo "Please provide another name for the new folder. Directory $name is already exists. "."<br>";
        }
}
function create_inner_file($new_dir_name,$pid,$ftype)
{
            if($ftype=="ppt")
            {
               $ext_type="application/vnd.ms-powerpoint";
               $new_dir_full_name=$new_dir_name.".ppt";
             }
               if($ftype=="doc")
             {
                
              $ext_type="application/vnd.ms-word";
              $new_dir_full_name=$new_dir_name.".doc";
              }
               if($ftype=="xls")
               {
               $ext_type="application/vnd.ms-excel";
               $new_dir_full_name=$new_dir_name.".xls";
               }
               if($ftype=="txt")
               {
               $ext_type="text/plain";
               $new_dir_full_name=$new_dir_name.".txt";
               }
    $added_path=return_path();
     $select_exist_folder="select * from users_data where txt_file_name='".$new_dir_full_name."' and int_uid='".$_SESSION['user_id']."' and int_is_folder=0 and int_pid='".$pid."'";
             $result_exist_folder=mysql_query($select_exist_folder);
             $last_time=time();
        if(mysql_num_rows($result_exist_folder)==0)
        {
                
                $path_folder="../nas/uploads/".$_SESSION['user_id']."/".$added_path."/".$new_dir_full_name;
               $insert_folder="insert into users_data (int_uid,int_pid,txt_file_name,int_file_size,txt_file_type,int_status,int_del_status,txt_last_modified,int_is_folder,int_is_shared,txt_shared_link,txt_sharer_emails,txt_real_path) 
               values ('".$_SESSION['user_id']."','".$pid."','".$new_dir_full_name."','0','".$ext_type."',1,0,'".$last_time."',0,0,'','','".$path_folder."')";
               mysql_query($insert_folder) or die(mysql_error());
                                if($ftype=="ppt")
                                    copy("temp_files/temp.ppt","../nas/uploads/".$_SESSION['user_id']."/".$added_path."/".$new_dir_name.".ppt");
                                    if($ftype=="doc")
                                   copy("temp_files/temp.doc","../nas/uploads/".$_SESSION['user_id']."/".$added_path."/".$new_dir_name.".doc");
                                   if($ftype=="xls")
                                   copy("temp_files/temp.xls","../nas/uploads/".$_SESSION['user_id']."/".$added_path."/".$new_dir_name.".xls");
                                   if($ftype=="txt")
                                   copy("temp_files/temp.txt","../nas/uploads/".$_SESSION['user_id']."/".$added_path."/".$new_dir_name.".txt");
               //mkdir("uploads/".$_SESSION['user_id']."/".$added_path."/".$new_dir_name);
                $description='files Added: '."../nas/uploads/".$_SESSION['user_id']."/".$new_dir_full_name;
                log_entry($description);
        }
        else
        {
                 $name=$new_dir_name;
            
                 $select_exist_folder1="select * from users_data where txt_file_name like '$new_dir_full_name%' and int_is_folder=0 and int_pid='".$pid."' and int_uid='".$_SESSION['user_id']."' ";
                 $result_exist_folder1=mysql_query($select_exist_folder1) or die(mysql_error());
                 $count=mysql_num_rows($result_exist_folder1);
            for($i=1;$i<=$count;$i++)
            {
                        $select_exist_folder2="select * from users_data where int_is_folder=0 and int_pid='".$pid."' and int_uid='".$_SESSION['user_id']."' and txt_file_name='".$new_dir_full_name."($i)"."'";
                        $result_exist_folder2=mysql_query($select_exist_folder2);
                        $counts=mysql_num_rows($result_exist_folder2);
                    if($counts==0)
                    {       $new_folder=$new_dir_full_name."($i)";
                            //$path_folder="uploads/".$new_folder;
                            $path_folder="../nas/uploads/".$_SESSION['user_id']."/".$added_path."/".$new_folder;
                            $insert_folder_new="insert into users_data (int_uid,int_pid,txt_file_name,int_file_size,txt_file_type,int_status,int_del_status,txt_last_modified,int_is_folder,int_is_shared,txt_shared_link,txt_sharer_emails,txt_real_path) 
                             values (1,'".$pid."','".$new_folder."','0','".$ext_type."',1,0,'".$last_time."',0,0,'','','".$path_folder."')";
                                mysql_query($insert_folder_new) or die(mysql_error());
                                //mkdir("uploads/".$new_folder);
                                if($ftype=="ppt")
                                    copy("temp_files/temp.ppt","../nas/uploads/".$_SESSION['user_id']."/".$added_path."/".$new_folder);
                                    if($ftype=="doc")
                                   copy("temp_files/temp.doc","../nas/uploads/".$_SESSION['user_id']."/".$added_path."/".$new_folder);
                                   if($ftype=="xls")
                                   copy("temp_files/temp.xls","../nas/uploads/".$_SESSION['user_id']."/".$added_path."/".$new_folder);
                                   if($ftype=="txt")
                                   copy("temp_files/temp.txt","../nas/uploads/".$_SESSION['user_id']."/".$added_path."/".$new_folder);
                                //mkdir("uploads/".$_SESSION['user_id']."/".$added_path."/".$new_folder);
                                $description='files Added: '."../nas/uploads/".$_SESSION['user_id']."/".$new_folder;
                                log_entry($description);
                                break;
                    }
            }
            //$name=$_REQUEST['new_dir_name'];
            //echo "Please provide another name for the new folder. Directory $name is already exists. "."<br>";
        }
}
function create_inner_dir($new_dir_name,$pid)
{
    $added_path=return_path();
     $select_exist_folder="select * from users_data where txt_file_name='".$new_dir_name."' and int_uid='".$_SESSION['user_id']."' and int_is_folder=1 and int_pid='".$pid."'";
             $result_exist_folder=mysql_query($select_exist_folder);
             $last_time=time();
        if(mysql_num_rows($result_exist_folder)==0)
        {
                
                $path_folder="../nas/uploads/".$_SESSION['user_id']."/".$added_path."/".$new_dir_name;
               $insert_folder="insert into users_data (int_uid,int_pid,txt_file_name,int_file_size,txt_file_type,int_status,int_del_status,txt_last_modified,int_is_folder,int_is_shared,txt_shared_link,txt_sharer_emails,txt_real_path) 
               values ('".$_SESSION['user_id']."','".$pid."','".$new_dir_name."','0','folder',1,0,'".$last_time."',1,0,'','','".$path_folder."')";
               mysql_query($insert_folder) or die(mysql_error());
               mkdir("../nas/uploads/".$_SESSION['user_id']."/".$added_path."/".$new_dir_name);
                $description='Directory Added: '."../nas/uploads/".$_SESSION['user_id']."/".$new_dir_name;
                log_entry($description);
        }
        else
        {
                 $name=$new_dir_name;
            
                 $select_exist_folder1="select * from users_data where txt_file_name like '$name%' and int_is_folder=1 and int_pid='".$pid."' and int_uid='".$_SESSION['user_id']."' ";
                 $result_exist_folder1=mysql_query($select_exist_folder1) or die(mysql_error());
                 $count=mysql_num_rows($result_exist_folder1);
            for($i=1;$i<=$count;$i++)
            {
                        $select_exist_folder2="select * from users_data where int_is_folder=1 and int_pid='".$pid."' and int_uid='".$_SESSION['user_id']."' and txt_file_name='".$name."($i)"."'";
                        $result_exist_folder2=mysql_query($select_exist_folder2);
                        $counts=mysql_num_rows($result_exist_folder2);
                    if($counts==0)
                    {       $new_folder=$name."($i)";
                            //$path_folder="uploads/".$new_folder;
                            $path_folder="../nas/uploads/".$_SESSION['user_id']."/".$added_path."/".$new_folder;
                            $insert_folder_new="insert into users_data (int_uid,int_pid,txt_file_name,int_file_size,txt_file_type,int_status,int_del_status,txt_last_modified,int_is_folder,int_is_shared,txt_shared_link,txt_sharer_emails,txt_real_path) 
                             values (1,'".$pid."','".$new_folder."','0','folder',1,0,'".$last_time."',1,0,'','','".$path_folder."')";
                                mysql_query($insert_folder_new) or die(mysql_error());
                                //mkdir("uploads/".$new_folder);
                                mkdir("../nas/uploads/".$_SESSION['user_id']."/".$added_path."/".$new_folder);
                                $description='Directory Added: '."../nas/uploads/".$_SESSION['user_id']."/".$new_folder;
                                log_entry($description);
                                break;
                    }
            }
            //$name=$_REQUEST['new_dir_name'];
            //echo "Please provide another name for the new folder. Directory $name is already exists. "."<br>";
        }


}

//rename
function rename_file($new_dir_name,$fid,$old_dir_name,$isfol)
{   
           if($isfol==0) 
     $select_exist_folder="select * from users_data where txt_file_name='".$new_dir_name."' and int_uid='".$_SESSION['user_id']."' and int_is_folder=0";
     else
     $select_exist_folder="select * from users_data where txt_file_name='".$new_dir_name."' and int_uid='".$_SESSION['user_id']."' and int_is_folder=1";
             $result_exist_folder=mysql_query($select_exist_folder);
             $last_time=time();
        if(mysql_num_rows($result_exist_folder)==0)
        {
                $path_folder="../nas/uploads/".$_SESSION['user_id']."/".$new_dir_name;
               $rename_folder="update users_data set txt_file_name='".$new_dir_name."', txt_real_path='".$path_folder."' where int_fid='".$fid."'";
               mysql_query($rename_folder) or die(mysql_error());
               //mkdir("uploads/".$_SESSION['user_id']."/".$new_dir_name);
              
               rename ("../nas/uploads/".$_SESSION['user_id']."/".$old_dir_name,"../nas/uploads/".$_SESSION['user_id']."/".$new_dir_name);
                if($isfol==0) 
               createThumbs("../nas/uploads/".$_SESSION['user_id']."/".$new_dir_name,"../nas/uploads/thumb/".$new_dir_name,60,60);
              // copy("temp_files/temp.txt","uploads/".$_SESSION['user_id']."/".$new_dir_name.".txt");
                $description='Files Renamed: '."../nas/uploads/".$_SESSION['user_id']."/".$new_dir_name;
                log_entry($description);
        }
        else
        {
               ?>
               <script>
               location.href="index.php?name_page=home&err=1";
               </script>
               <?php 
        }
}
function rename_inner_file($new_dir_name,$fid,$old_dir_name,$isfol,$pid)
{   
           $added_path=return_path();
    
            
           
           if($isfol==0) 
     $select_exist_folder="select * from users_data where txt_file_name='".$new_dir_name."' and int_uid='".$_SESSION['user_id']."' and int_is_folder=0 and int_pid='".$pid."'";
     else
     $select_exist_folder="select * from users_data where txt_file_name='".$new_dir_name."' and int_uid='".$_SESSION['user_id']."' and int_is_folder=1 and int_pid='".$pid."'";
             $result_exist_folder=mysql_query($select_exist_folder);
             $last_time=time();
        if(mysql_num_rows($result_exist_folder)==0)
        {
               $path_folder="../nas/uploads/".$_SESSION['user_id']."/".$added_path."/".$new_dir_name;
               $rename_folder="update users_data set txt_file_name='".$new_dir_name."', txt_real_path='".$path_folder."' where int_fid='".$fid."'";
               mysql_query($rename_folder) or die(mysql_error());
               //mkdir("uploads/".$_SESSION['user_id']."/".$new_dir_name);
              
               rename ("../nas/uploads/".$_SESSION['user_id']."/".$added_path."/".$old_dir_name,"../nas/uploads/".$_SESSION['user_id']."/".$added_path."/".$new_dir_name);
                if($isfol==0) 
               createThumbs("../nas/uploads/".$_SESSION['user_id']."/".$added_path."/".$new_dir_name,"../nas/uploads/thumb/".$new_dir_name,60,60);
              // copy("temp_files/temp.txt","uploads/".$_SESSION['user_id']."/".$new_dir_name.".txt");
                $description='Files Renamed: '."../nas/uploads/".$_SESSION['user_id']."/".$added_path."/".$new_dir_name;
                log_entry($description);
        }
        else
        {
               ?>
               <script>
               location.href="index.php?name_page=home&err=1";
               </script>
               <?php 
        }
}



function traverse_history() {
        $dirvalues=$_SESSION['dir'];
        $data= "<a href='index.php?name_page=home'> Home </a>";
        if($_SESSION['dir1'])
        {
        $arr_ids=explode(",",$_SESSION['dir1']);
        $arr_ids=array_unique($arr_ids);
        foreach ($arr_ids as $value)
        {
            $folder_name=get_folder_name($value);
            $data.=">> ";
            $data.="<a href='index.php?name_page=home&dir=$value'> $folder_name </a> "; 
        }
        
        }
        else if($_SESSION['dir'])
        {
        $folder_name=get_folder_name($_SESSION['dir']);
        $data.=">> ";
        $data.="<a href='index.php?name_page=home&dir=$dirvalues'> $folder_name </a> "; 
        }
        return $data;
} 

function traverse_history_shared() {
        $dirvalues=$_SESSION['dir'];
        $data= "<a href='index.php?name_page=shared_data'> Home </a>";
        if($_SESSION['dir1'])
        {
        $arr_ids=explode(",",$_SESSION['dir1']);
        $arr_ids=array_unique($arr_ids);
        foreach ($arr_ids as $value)
        {
            $folder_name=get_folder_name($value);
            $data.=">> ";
            $data.="<a href='index.php?name_page=shared_data&dir=$value'> $folder_name </a> "; 
        }
        
        }
        else if($_SESSION['dir'])
        {
        $folder_name=get_folder_name($_SESSION['dir']);
        $data.=">> ";
        $data.="<a href='index.php?name_page=shared_data&dir=$dirvalues'> $folder_name </a> "; 
        }
        return $data;
} 
function traverse_history_sync() {
        $dirvalues=$_SESSION['dir'];
        $data= "<a href='index.php?name_page=my_sync'> Home </a>";
        //$data.="<a href='index.php?name_page=my_sync&dir_trav=$dirvalues'> $dirvalues</a>";
        return $data;
} 



function return_path()
{
    $upload_path="";
    if($_SESSION['dir1'])
    {
        $arr_ids_path=explode(",",$_SESSION['dir1']);
        $arr_ids_path=array_unique($arr_ids_path);
        foreach ($arr_ids_path as $value)
        {
            $folder_name=get_folder_name($value);
            $upload_path.="/";
            $upload_path.=$folder_name; 
        }
        return $upload_path;
    }
    else if($_SESSION['dir']) 
    {
        return get_folder_name($_SESSION['dir']);
        
        
    }
    
    
}

function totalfile($data)
{   $total_file=0;
    //$lenth=count(explode(',',$data));
    $arr_id=explode(',',$data);
    $arr_id=array_unique($arr_id);
    $lenth=count($arr_id);
    for($i=0;$i<$lenth;$i++)
    {
        $select_exist="select * from users_data where int_fid='".$arr_id[$i]."'";
        $res_exist=mysql_query($select_exist);
        if(mysql_num_rows($res_exist)>0)
        {
            $fetch_exist=mysql_fetch_array($res_exist);
            if($fetch_exist['int_del_status']==0)
            $total_file++;
        }
      
        
    }
  return $total_file;  
}

function get_folder_name($id)
{
    $select_folder_name="select txt_file_name from users_data where int_fid='".$id."'";
    $result_folder_name=mysql_query($select_folder_name) or die(mysql_error());
    $fetch_folder_name=mysql_fetch_array($result_folder_name);
    return $fetch_folder_name['txt_file_name'];
}  

function random_id()
{
    return substr(str_shuffle(MD5(microtime())), 0, 20);
}

function get_file_icon($name)
{
    $type = substr($name, strrpos($name, '.')+1);
    $type=strtolower($type);
    if($type=="jpeg" || $type=="png" || $type=="gif" || $type=="jpg" || $type=="bmp")
    return  "images/image_icon.png";
   if($type=="pdf")
   return "images/pdf.png";
  
    if($type=="doc")
   return "images/doc.png";
    if($type=="xls")
   return "images/xls.png";
    if($type=="ppt")
   return "images/ppt-png_icon.png";
   if($type=="txt")
   return "images/txt.png";
   if($type=="mp3")
   return "images/audio_icon.png";
   if($type=="mp4")
   return "images/video_icon.png";
   if($type=="zip" || $type=="rar")
   return "images/zip_icon.png";
   else
   return "images/other_icon.png";
   
   
   
   
   
    
    
}
function get_ext($name)
{
    return strtolower(substr($name, strrpos($name, '.')+1));
}
function get_file_icon1($isfol,$name)
{
    $type = substr($name, strrpos($name, '.')+1);
    $type=strtolower($type);
    if($type=="jpeg" || $type=="png" || $type=="gif" || $type=="jpg" || $type=="bmp")
    return  "images/image_icon.png";
   if($type=="pdf")
   return "images/pdf.png";
  
    if($type=="doc")
   return "images/doc.png";
    if($type=="xls")
   return "images/xls.png";
    if($type=="ppt")
   return "images/ppt-png_icon.png";
   if($type=="txt")
   return "images/txt.png";
   if($type=="mp3")
   return "images/audio_icon.png";
   if($type=="mp4")
   return "images/video_icon.png";
   if($type=="zip" || $type=="rar")
   return "images/zip_icon.png";
   if($isfol==1)
   return "images/large_icon.png";
     if($type=="docx" )
   return "images/doc.png";
    if($type=="xlsx" )
  return "images/xls.png";
   if($type=="pptx" )
  return "images/ppt-png_icon.png";
   else
   return "images/other_icon.png";
   
   
   
   
   
    
    
}




function get_file_thumb($type,$name)
{
    $type1 = substr($name, strrpos($name, '.')+1);
    $type1=strtolower($type1);
    if($type=="image/jpeg" || $type=="image/png" || $type=="image/gif" || $type=="image/jpg" || $type=="1" || $type== 'application/png' || $type=='application/x-png' || $type== 'image/pjpeg' || $type== 'image/x-xbitmap'  || $type=='image/bmp'  || $type=='image/x-bmp')
    return  "../nas/uploads/thumb/".$name;
   if($type=="application/pdf")
   return "images/pdf.png";
   if($type=="folder")
   return "images/large_icon.png";
    if($type=="application/vnd.ms-word")
   return "images/doc.png";
    if($type=="application/vnd.ms-excel")
   return "images/xls.png";
    if($type=="application/vnd.ms-powerpoint")
   return "images/ppt-png_icon.png";
   if($type=="text/plain")
   return "images/txt.png";
   if($type=="audio/mpeg" || $type=='audio/mp3' || $type=='audio/wav' || $type=='audio/x-wav' || $type=='audio/ogg' || $type=='audio/x-mp3' || $type=='audio/mpeg3' || $type=='audio/x-mpeg3' || $type=='audio/mpg' || $type=='audio/x-mpg' || $type=='audio/x-mpegaudio' || $type=='audio/mid' || $type=='audio/m' || $type=='audio/midi' || $type=='audio/x-midi' || $type=='application/x-midi' || $type=='audio/soundtrack')
   return "images/audio_icon.png";
   if($type=="video/mp4" || $type=="audio/mp4" || $type=='video/x-flv' || $type=='audio/3gpp'  || $type=='video/3gpp'  || $type=='video/x-ms-wmv')
   return "images/video_icon.png";
   if($type1=="rar" || $type1=="RAR")
   return "images/rar_icon.png";
    if($type1=="zip" || $type1=="zip")
   return "images/zip_icon.png";
    if($type1=="docx" )
   return "images/doc.png";
    if($type1=="xlsx" )
  return "images/xls.png";
   if($type1=="pptx" )
  return "images/ppt-png_icon.png";
   else
   return "images/other_icon.png";
   
   
   
   
   
    
    
}
function createThumbs($source, $dest, $requiredWidth, $requiredHeight) {
$size = getimagesize($source);
$givenWidth = $size[0];
$givenHeight = $size[1];
    
    $requiredRatio = $requiredWidth / $requiredHeight;
    $middleWidth = ceil($givenHeight * $requiredRatio);
    if($middleWidth>$givenWidth){
        $requiredRatio = $requiredHeight / $requiredWidth;
        $middleHeight = ceil($givenWidth * $requiredRatio);
        $middleWidth = $givenWidth;
        $y = ceil(($givenHeight - $middleHeight)/2);
    }
    else{
        $middleHeight = $givenHeight;
        $middleWidth = ceil($givenHeight * $requiredRatio);
        $x = ceil(($givenWidth - $middleWidth)/2);
    }
    
$new_im = imagecreatetruecolor($requiredWidth,$requiredHeight);

$extention = strtolower(substr($source, strlen($source)-3, strlen($source)));
if ($extention == "jpg" || $extention == "jpeg") { $im = imagecreatefromjpeg($source); }
elseif ($extention == "gif")
 { 
 	$im = imagecreatefromgif($source); 
 }
elseif ($extention == "png") {
//echo $extention;
//echo $source; 
$im = imagecreatefrompng($source); 
}
elseif ($extention == "bmp") {
//echo $extention;
//echo $source; 
$im = @imagecreatefromwbmp($source); 
}
else { //echo("ERROR: Unknown image source file format");

 }

imagecopyresampled($new_im,$im,0,0,$x,$y,$requiredWidth,$requiredHeight,$middleWidth,$middleHeight);
imagejpeg($new_im,$dest,85);
}
 
?>