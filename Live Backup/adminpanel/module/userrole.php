<?php
if (!isset($_SESSION['role']['user_role'])) {
    exit("Yor don't have permission to view this page");
}
require_once($cfg['admin_path'] . "functions/userFunctions.php");
$userFunc = new userFunction();
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
if (isset($_POST['saveButton'])) {
    $res = $userFunc->saveUserRole();
    if ($res == 'success') {
        $userFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'Updated Successfully'));
    } else {
        $userFunc->setAlertMessage(array('err_type' => 'error', 'msg' => 'Data not saved'));
    }
}
$config = $userFunc->getUserRole();
?>


<div>
    <ul class="breadcrumb">
        <li><a href="<?= $cfg['admin_url']; ?>">Home</a> <span class="divider">/</span> </li>
        <li> <a href="#">Roles</a> </li>
    </ul>
</div>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i>User Roles</h2>
            <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
        </div>
        <div class="box-content">
            <?php
            echo $userFunc->getAlertMessage();
            ?>
            <form class="form-horizontal" name="langForm" enctype="multipart/form-data" id="langForm" method="post" action="">
                <fieldset>
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Role Name</th>
                                <th>Role Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input class="input-xlarge focused"  <?php echo isset($_REQUEST['id']) ? 'disabled ' : ''; ?> id="languageTitle1" name="config[<?php echo $id; ?>][role_name]" type="text" <?php
                                    foreach ($config as $con) {
                                        if ($con['id'] == $id) {
                                            echo ' value="' . $con['role_name'] . '"';
                                        }
                                    }
                                    ?> placeholder="Config Name"></td>
                                <td><input class="input-xlarge focused <?php echo isset($_REQUEST['id']) ? 'editfield' : ''; ?>" id="languageTitle" name="config[<?php echo $id; ?>][role_description]" type="text" <?php
                                    foreach ($config as $con) {
                                        if ($con['id'] == $id) {
                                            echo ' value="' . $con['role_description'] . '"';
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
                        <th>Role Name</th>
                        <th>Role Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($config as $val) {
                        ?>
                        <tr>
                            <td><a href="<?php echo $cfg['admin_url'] . $dir . '?page=userrole&id=' . $val['id']; ?>"><?php echo $val['role_name']; ?></a></td>
                            <td><?php echo $val['role_description']; ?></td>
                        </tr>

                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>