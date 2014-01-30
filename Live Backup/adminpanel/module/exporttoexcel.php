<?php

include_once("../includes/config.php");
require_once($cfg['admin_path'] . "functions/exportFunctions.php");
$exprotFunc = new exportFunctions();
if (isset($_POST['saveButton'])) {
    $result = $exprotFunc->exportToExcel();
    if ($result == 'success') {
        $exprotFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'Successfully Exported'));
    }
    else
        $exprotFunc->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
}
?>