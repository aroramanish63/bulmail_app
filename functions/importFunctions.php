<?php

include 'emailFunctions.php';
include BASE_PATH.'classes/simplexlsx.class.php';
class importFunctions extends emailFunctions {

    function importFile() {
        if (!isset($_POST['saveButton'])) {
            return false;
        }
        $siteid = $_POST['site_id'];
        $client_type_id = $_POST['client_type_id'];
//        $field = $_POST['field'];
        if ($_FILES['file_name']['type'] != 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
            return "Only Excel Files are Supported";
        }
        if ($_FILES['file_name']['tmp_name'] != '' && isset($_POST['saveButton'])) {
            $target_path = BASE_PATH.'uploads/';            
            $file = $_FILES['file_name']['tmp_name']; // UPLOADED EXCEL FILE
            $new_file = $target_path.date('Ymd').'_'.date('hisA').$_FILES['file_name']['name'];
            if(false === @ move_uploaded_file($file, $new_file)) {
//                return 'File Not Uploaded Correctly.!';
                $this->setFlashMessage(array('err_type'=>'error','msg'=>'File Not Uploaded Correctly.!'));
            }

            $xlsx = new SimpleXLSX($new_file);
           
            list($cols, $rows) = $xlsx->dimension();
            $sql = '';
            $q = "INSERT INTO tbl_email(`email_id`,`email_user`,`site_id`,`client_type_id`,`add_date`,`active`) VALUES ";
            foreach ($xlsx->rows() as $k => $r) { // LOOP THROUGH EXCEL WORKSHEET
                if (!empty($r[0])) {
                    $q .= " ("; // EXCEL DATA
                    $q .= "'" . trim(htmlspecialchars($r[0], ENT_QUOTES, 'UTF-8')) . "', "; // EXCEL DATA
                    $q .= "'" . trim(htmlspecialchars($r[1], ENT_QUOTES, 'UTF-8')) . "',"; // EXCEL DATA
                    $q .= "'" . trim($siteid) . "',"; // EXCEL DATA
                    $q .= "'" . trim($client_type_id) . "',"; // EXCEL DATA
                    $q .= "'" . trim(date('YmdHis')) . "',"; // EXCEL DATA
                    $q .= "'" . trim(1) . "'"; // EXCEL DATA
                    $q .= "),";
                }
            }
            $q = rtrim($q, ",");
            $sql.=$q;
//            echo $sql.'\n'; die;
            $result = mysqli_query($this->getConnectionId(), $sql);
//            var_dump($result);
//             die;
        } else {
            $this->setFlashMessage(array('err_type'=>'error','msg'=>'File Not Selected!'));
        }
        ($result) ? $this->setFlashMessage(array('err_type'=>'success','msg'=>'Emails Successfully uploded.')) : $this->setFlashMessage(array('err_type'=>'error','msg'=>'Error on importing. Please try later..'));
        return ;
    }

}

?>