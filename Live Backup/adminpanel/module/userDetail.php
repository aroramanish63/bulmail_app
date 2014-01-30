<?php
if (!isset($_SESSION['role']['user']) || !isset($_SESSION['role']['view_user'])) {
    exit("You don't have permission to view this page!");
}
require_once($cfg['admin_path'] . "functions/userFunctions.php");
$userFunc = new userFunction();
//echo '<pre>';var_dump($jobTitles); die;

if (isset($_POST['saveButton'])) {
    $result = $userFunc->saveUser();
    if ($result == 'success') {
        $userFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully saved'));
    }
    else
        $userFunc->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
}
$userdetails = $userFunc->getUsers();
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
$user = array();
if (is_array($userdetails)) {
    foreach ($userdetails as $userdetail) {
        if (isset($userdetail['id']) && $userdetail['id'] == $id) {
            $user = $userdetail;
        }
    }
}

$usergroup = $userFunc->getUserGroup();
$ugroup = array();
foreach ($usergroup as $ug) {
    if (isset($ug['id'])) {
        $ugroup[$ug['id']] = $ug['group_name'];
    }
}
?>

<div>
    <ul class="breadcrumb">
        <li> <a href="<?= $cfg['admin_url']; ?>">Home</a> <span class="divider">/</span> </li>
        <li> <a href="#">User</a> </li>
    </ul>
</div>

<?php
if (isset($_SESSION['role']['user'])) {
    ?>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i> Add User</h2>
                <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
            </div>
            <div class="box-content">
                <?php
                echo $userFunc->getAlertMessage();
                ?>
                <form class="form-horizontal" name="userForm" id="userForm" autocomplete="off" method="post" action="">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="focusedInput"><span>*</span>Username</label>
                            <div class="controls">
                                <div class="fieldDiv">
                                    <input class="input-xlarge focused <?php echo isset($user['username']) ? 'editfield' : ''; ?>" id="username" name="username" type="text" autocomplete="off" <?php echo isset($user['username']) ? ' value="' . $user['username'] . '"' : ''; ?> placeholder="username">
                                </div>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="siteRegion_parent"><span>*</span>User Group</label>
                            <div class="controls">
                                <select data-placeholder="User Group"   data-rel="chosen" name="user_group">
                                    <option value=""></option>
                                    <?php foreach ($usergroup as $group) { ?>
                                        <option value="<?php echo $group['id'] ?>" <?php echo isset($user['user_group']) && $user['user_group'] == $group['id'] ? 'selected' : ''; ?>><?php echo $group['group_name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><span>*</span>Password</label>
                            <div class="controls">
                                <div class="fieldDiv">
                                    <input class="input-xlarge focused <?php echo isset($user['password']) ? 'editfield' : ''; ?>" name="password" type="password" value="" placeholder="password"><?php echo isset($user['password']) ? 'Leave blank if you do not want to change ' : ''; ?>
                                </div>
                            </div>
                        </div>




                        <div class="control-group">
                            <label class="control-label" for="siteRegion_ispage"><span>*</span>Active</label>
                            <div class="controls">
                                <label class="radio">
                                    <div class="radio" id="uniform-optionsRadios2"><span class="">
                                            <input type="radio" checked name="active" id="sitelang_status2" value="0" style="opacity: 0;" <?php echo isset($user['active']) && $user['active'] == '0' ? 'checked' : ''; ?>  <?php echo isset($user['active']) ? 'class="editfield"' : ''; ?>>
                                        </span></div>
                                    No
                                </label>
                                <div style="clear:both"></div>
                                <label class="radio">
                                    <div class="radio" id="uniform-optionsRadios1"><span class="checked">
                                            <input type="radio" name="active" id="sitelang_status1" value="1" <?php echo isset($user['active']) && $user['active'] == '1' ? 'checked' : ''; ?>  style="opacity: 0;"  <?php echo isset($user['active']) ? 'class="editfield"' : ''; ?>></span></div>
                                    Yes
                                </label>
                            </div>
                        </div>


                        <div class="form-actions">
                            <input type="submit" class="btn btn-primary" name="saveButton" id="saveButton" value="<?php echo isset($user['username']) ? 'Edit' : 'Save'; ?>">
                            <input type="button" class="btn" name="cancel" value="Cancel">
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <!--/span-->

    </div>
    <!--/row-->
    <?php
}
?>

<?php
if (isset($_SESSION['role']['view_user'])) {
    ?>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i> Users List</h2>
                <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
            </div>
            <div class="box-content">
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>User Group</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (is_array($userdetails)) {
                            foreach ($userdetails as $userdetail) {
                                ?>
                                <tr>
                                    <td class="center"><a href="<?php echo $cfg['admin_url'] . $dir . '?page=userDetail&id=' . $userdetail['id']; ?>"><?php echo $userdetail['username']; ?></a></td>

                                    <td class="center"><?php if (isset($ugroup[$userdetail['user_group']])) echo $ugroup[$userdetail['user_group']]; ?></td>
                                    <td class="center">
                                        <?php echo ($userdetail['active'] == '1') ? "<span class='label label-success'>Active</span>" : "<span class='label label-failure'>Inactive</span>"; ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }else {
                            ?>
                            <tr><td class="center">No Users Found</td></tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!--/span-->

    </div>

    <?php
}
?>