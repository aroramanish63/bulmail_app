<?php
if (!isset($_SESSION['role']['exp_kay'])) {
    exit("You don't have permission to view this page!");
}
require_once($cfg['admin_path'] . "functions/exportFunctions.php");
$exprotFunc = new exportFunctions();
if (isset($_POST['saveButton'])) {
    echo $_POST['region'];
    die;
    if (!isset($_POST['region']) || $_POST['region'] == '') {
        $exprotFunc->setAlertMessage(array('err_type' => 'error', 'msg' => 'Select Site Region'));
    } else {
        $result = $exprotFunc->exportToExcel();
        if ($result == 'success') {
            $exprotFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'Successfully Exported'));
        } else {
            $exprotFunc->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
        }
    }
}
$regions = $exprotFunc->select($cfg['db_prefix'] . 'site_region');
?>


<div>
    <?php echo $exprotFunc->getAlertMessage(); ?>
    <div id="err"></div>
    <ul class="breadcrumb">
        <li> <a href="<?= $cfg['admin_url']; ?>">Home</a><span class="divider">/</span> </li>
        <li> <a href="#">Export to excel </a> </li>
    </ul>
</div>
<script>
    $(document).ready(function() {
        $("#importForm").submit(function() {
            if ($("#region").val() == '') {
                $("#err").html('<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">×</button><i class="icon-ok-sign"></i>  <strong>Error:</strong>  Please Select Region</div>');
                return false;
            }
        });
    });

</script>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i>Export to excel</h2>
            <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
        </div>
        <div class="box-content">

            <form class="form-horizontal" name="importForm" id="importForm" method="post" action="<?php echo $cfg['admin_url']; ?>module/exporttoexcel.php">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="file_name"><span>*</span>Select Site Region</label>
                        <div class="controls">
                            <select data-placeholder="Select Page" id="region" data-rel="chosen" name="region">
                                <option value=""></option>
                                <?php foreach ($regions as $region) { ?>
                                    <option value="<?php echo $region['id']; ?>" <?php
                                    if (isset($_POST['region']) && $_POST['region'] == $region['id']) {
                                        echo 'selected';
                                    }
                                    ?>><?php echo $region['region_name']; ?></option>
                                        <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary" name="saveButton" id="saveButton" value="Export">
                        <input type="button" class="btn" name="cancel" value="Cancel">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>


