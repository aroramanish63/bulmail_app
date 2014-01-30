<?php

/* Created By : Shambhulal Verma
 *
 *
 */
?>
<?php

class exportFunctions extends AllFunctions {

    function exportToExcel() {
        if (!isset($_POST['saveButton']) || $_POST['saveButton'] == '') {
            return false;
        }
        $pageRegion = $_POST['region'];
        $pageName = $this->select($this->cfg['db_prefix'].'site_region', 'region_name', array('id' => $pageRegion));
        $pagaKey = $this->select($this->cfg['db_prefix']."lang_keywords", array('lang_key', 'lang_value'), array('lang_id' => 1, 'key_region' => $pageRegion));
        if (isset($pageName[0]['region_name'])) {
            $this->Excel($pagaKey, $pageName[0]['region_name']);
        } else {
            $this->Excel($pagaKey);
        }
        return 'success';
    }

    function Excel($data, $fileName = 'Keywords') {
        $file_ending = "xls";
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        $sep = "\t"; //tabbed character
        foreach ($data as $dat) {
            $schema_insert = "";

            if ($dat['lang_key'] != "") {
                $schema_insert .= trim($dat['lang_key']) . $sep;
                $schema_insert .=str_replace("&apos;","'",html_entity_decode($dat['lang_value'])) . $sep;
            }
            $schema_insert = str_replace($sep . "$", "", $schema_insert);
            $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
            $schema_insert .= "\t";
            print(trim($schema_insert));
            print "\n";
        }
    }

}

?>