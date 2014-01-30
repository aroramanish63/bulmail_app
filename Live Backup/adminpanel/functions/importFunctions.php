<?php

class importFunctions extends AllFunctions {

    function importFile() {
        if (!isset($_POST['saveButton'])) {
            return false;
        }
		global $cfg;
        $pageRegion = $_POST['region'];
        $languageId = $_POST['language'];
        if ($_FILES['file_name']['type'] != 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet') {
            return "Only Excel Files are Supported";
        }
        if ($_FILES['file_name']['tmp_name'] != '' && isset($_POST['saveButton'])) {
            $uniqeid=date('YmdHis');
            //echo "<pre>";print_r($_FILES);echo "</pre>";
            //echo "<pre>";print_r($_POST);echo "</pre>";die;
            $file = $_FILES['file_name']['tmp_name']; // UPLOADED EXCEL FILE
            
            $xlsx = new SimpleXLSX($file);

            list($cols, $rows) = $xlsx->dimension();
            $sql = '';
            $q = "INSERT INTO tbl_lang_keywords(lang_id,lang_key,lang_value,key_region,uniqueId) VALUE ";
            foreach ($xlsx->rows() as $k => $r) { // LOOP THROUGH EXCEL WORKSHEET
                if (!empty($r[0])) {
                    $q .= " ("; // EXCEL DATA
                    $q .= "'" . trim($languageId) . "', "; // EXCEL DATA
                    $q .= "'" . trim($r[0]) . "',"; // EXCEL DATA
                    $q .= "'" . trim(htmlspecialchars($r[1], ENT_QUOTES, 'UTF-8')) . "',"; // EXCEL DATA
                    $q .= "'" . trim($pageRegion) . "' ,"; // EXCEL DATA
                    $q .="'".$uniqeid."'";
                    $q .= "),";
                }
            }
            $q = rtrim($q, ",");
            $sql.=$q;
            //echo $sql;
            $result = mysqli_query($this->getConnectionId(), $sql);
			move_uploaded_file($file, $cfg['admin_path']."temp_excel/".$uniqeid.$_FILES['file_name']['name']);
            //var_dump($result);
            // die;
        } else {
            return 'File Not Selected!';
        }
        return ($result) ? $result : 'Error on importing. Please try later..';
    }

}

?>