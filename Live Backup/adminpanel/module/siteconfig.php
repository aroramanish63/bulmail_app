<?php
if (!isset($_SESSION['role']['site_config'])) {
    exit("You don't have permission to view this page");
}
require_once($cfg['admin_path'] . "functions/siteConfigFunction.php");
$configFunc = new siteConfigFunctions();
if (isset($_POST['saveButton'])) {
    $res = $configFunc->saveConfig();
    if ($res == 'success') {
        $configFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'Updated Successfully'));
    }
}
$config = $configFunc->getConfig();

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
?>


<div>
    <ul class="breadcrumb">
        <li> <a href="<?= $cfg['admin_url']; ?>">Home</a> <span class="divider">/</span> </li>
        <li> <a href="#">Module</a> </li>
    </ul>
</div>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> Site Configuration</h2>
            <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
        </div>
        <div class="box-content">
            <?php
            echo $configFunc->getAlertMessage();
            ?>
            <form class="form-horizontal" name="langForm" enctype="multipart/form-data" id="langForm" method="post" action="">
                <fieldset>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Config Name</th>
                                <th>Config Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input class="input-xlarge focused <?php echo isset($_REQUEST['id']) ? 'editfield' : ''; ?>" id="languageTitle1" name="config[<?php echo $id; ?>][config_name]" type="text" <?php
                                    foreach ($config as $con) {
                                        if ($con['id'] == $id) {
                                            echo ' value="' . $con['config_name'] . '"';
                                        }
                                    }
                                    ?> placeholder="Config Name"></td>
                                <td><input class="input-xlarge focused <?php echo isset($_REQUEST['id']) ? 'editfield' : ''; ?>" id="languageTitle" name="config[<?php echo $id; ?>][config_value]" type="text" <?php
                                    foreach ($config as $con) {
                                        if ($con['id'] == $id) {
                                            echo ' value="' . $con['config_value'] . '"';
                                        }
                                    }
                                    ?> placeholder="Config Value"></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary" name="saveButton" id="saveButton" value="<?php echo isset($_REQUEST['id']) ? 'Edit' : 'Save'; ?>">
                        <input type="button" class="btn" name="cancel" value="Cancel">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <!--/span-->

</div>
<!--/row-->
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> Site Configuration</h2>
            <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Config Name</th>
                        <th>Config Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($config as $val) {
                        ?>
                        <tr>
                            <td><a href="<?php echo $cfg['admin_url'] . $dir . '?page=siteconfig&id=' . $val['id']; ?>"><?php echo $val['config_name']; ?></a></td>
                            <td><?php echo $val['config_value']; ?></td>
                        </tr>

                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>