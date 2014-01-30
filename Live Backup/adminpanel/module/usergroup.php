<?php
if (!isset($_SESSION['role']['user_group'])) {
    exit("You don't have permission to view this page");
}
require_once($cfg['admin_path'] . "functions/userFunctions.php");
$userFunc = new userFunction();
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
if (isset($_POST['saveButton'])) {
    $res = $userFunc->saveUserGroup();
    if ($res == 'success') {
        $userFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'Updated Successfully'));
    } else {
        $userFunc->setAlertMessage(array('err_type' => 'error', 'msg' => 'Data not saved'));
    }
}
$userRoles = $userFunc->getUserRole();
$config = $userFunc->getUserGroup();
$usergroup = array();

if (is_array($config) && count($config) > 0 && isset($_REQUEST['id'])) {
    foreach ($config as $con) {
        if (is_array($con) && count($con) > 0 && $con['id'] == $_REQUEST['id']) {
            foreach ($con as $k => $v) {
                if ($k == 'role_value') {
                    $roles = explode(",", $v);
                    if (count($roles) > 0) {
                        foreach ($roles as $r) {
                            $usergroup[$r] = 'set';
                        }
                    }
                } else {
                    $usergroup[$k] = $v;
                }
            }
        }
    }
}
?>
<div>
    <ul class="breadcrumb">
        <li> <a href="<?= $cfg['admin_url']; ?>">Home</a> <span class="divider">/</span> </li>
        <li> <a href="#">User Group</a> </li>
    </ul>
</div>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i>User Groups</h2>
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
                                <th>Group Name</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input class="input-xlarge focused <?php echo isset($_REQUEST['id']) ? 'editfield' : ''; ?>" id="languageTitle1" name="config[group_name]" type="text" <?= isset($usergroup['group_name']) ? ' value="' . $usergroup['group_name'] . '" ' : ''; ?> placeholder="Config Name"></td>
                                <td><input class="input-xlarge focused <?php echo isset($_REQUEST['id']) ? 'editfield' : ''; ?>" id="languageTitle" name="config[description]" type="text"<?= isset($usergroup['description']) ? ' value="' . $usergroup['description'] . '" ' : ''; ?> placeholder="Config Value"></td>
                            </tr>

                            <tr align="center">
                                <th colspan="2">Roles</th>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div>Roles</div>
                                    <ul style=" white-space:normal;">
                                        <?php
                                        if (isset($userRoles) && count($userRoles) > 0) {
                                            foreach ($userRoles as $role) {
                                                ?><li style="display:inline; padding:5px;" >
                                                    <label class="checkbox inline"  title="<?= $role['role_description']; ?>">
                                                        <input type="checkbox" id="<?= $role['role_name']; ?>" name="config[role][<?= $role['id']; ?>]" value="<?= $role['role_name']; ?>" <?= isset($usergroup[$role['id']]) ? ' checked ' : ''; ?>/><?= $role['role_name']; ?>
                                                    </label></li>
                                                <?
                                            }
                                        }
                                        ?>
                                    </ul>
                                </td>
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
                        <th>Group Name</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($config as $val) {
                        ?>
                        <tr>
                            <td><a href="<?php echo $cfg['admin_url'] . $dir . '?page=usergroup&id=' . $val['id']; ?>"><?php echo $val['group_name']; ?></a></td>
                            <td><?php echo $val['description']; ?></td>
                        </tr>

                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>