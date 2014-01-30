<?php
if (!isset($_SESSION['role']['manage_language'])) {
    exit("You don't have permission to view this page!");
}
require_once($cfg['admin_path'] . "functions/adminFunction.php");
$adminFunc = new AdminFunctions();

if (isset($_POST['saveButton'])) {
    $result = $adminFunc->saveLanguange();
    if ($result == 'success') {
        $adminFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully saved'));
    }
    else
        $adminFunc->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
}
$languages = $adminFunc->getLanguages();
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
$lang = array();
if (is_array($languages)) {
    foreach ($languages as $language) {
        if (isset($language['id']) && $language['id'] == $id) {
            $lang = $language;
        }
    }
}
?>

<div>
    <ul class="breadcrumb">
        <li> <a href="<?= $cfg['admin_url']; ?>">Home</a> <span class="divider">/</span> </li>
        <li> <a href="#">Language</a> </li>
    </ul>
</div>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> Add Language</h2>
            <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
        </div>
        <div class="box-content">
            <?php
            echo $adminFunc->getAlertMessage();
            ?>
            <form class="form-horizontal" name="langForm" enctype="multipart/form-data" id="langForm" method="post" action="">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="focusedInput"><span>*</span>Language</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($lang['language']) ? 'editfield' : ''; ?>" id="languageTitle" name="languageTitle" type="text" <?php echo isset($lang['language']) ? ' value="' . $lang['language'] . '"' : ''; ?> placeholder="Language Name">
                                <input type="hidden" name="id" value="<?php echo isset($lang['id']) ? $lang['id'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="focusedInput"><span>*</span>Abbreviation</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($lang['abrv']) ? 'editfield' : ''; ?>" id="lang_abrv" name="lang_abrv" type="text" <?php echo isset($lang['abrv']) ? ' value="' . $lang['abrv'] . '"' : ''; ?> placeholder="Abbreviation">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"><span>*</span>Char set</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($lang['charset']) ? 'editfield' : ''; ?>" id="lang_charset" name="lang_charset" type="text" <?php echo isset($lang['charset']) ? ' value="' . $lang['charset'] . '"' : ''; ?> placeholder="Charset">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"><span>*</span>Default Currency</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($lang['default_currency']) ? 'editfield' : ''; ?>" id="lang_charset" name="default_currency" type="text" <?php echo isset($lang['default_currency']) ? ' value="' . $lang['default_currency'] . '"' : ''; ?> placeholder="Default Currency">
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="file_name"><span>*</span>Upload Language Icon (Only PNG)</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="file_name" name="icon_name" type="file" placeholder=" " />
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="siteRegion_ispage"><span>*</span>Active</label>
                        <div class="controls">
                            <label class="radio">
                                <div class="radio" id="uniform-optionsRadios2"><span class="">
                                        <input type="radio" checked name="active" id="sitelang_status2" value="0" style="opacity: 0;" <?php echo isset($lang['active']) && $lang['active'] == '0' ? 'checked' : ''; ?>  <?php echo isset($lang['active']) ? 'class="editfield"' : ''; ?>>
                                    </span></div>
                                No
                            </label>
                            <div style="clear:both"></div>
                            <label class="radio">
                                <div class="radio" id="uniform-optionsRadios1"><span class="checked">
                                        <input type="radio" name="active" id="sitelang_status1" value="1" <?php echo isset($lang['active']) && $lang['active'] == '1' ? 'checked' : ''; ?>  style="opacity: 0;"  <?php echo isset($lang['active']) ? 'class="editfield"' : ''; ?>></span></div>
                                Yes
                            </label>
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary" name="saveButton" id="saveButton" value="<?php echo isset($lang['language']) ? 'Edit' : 'Save'; ?>">
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
            <h2><i class="icon-user"></i> Language List</h2>
            <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="check_all" value="option1"></th>
                        <th>Languages</th>
                        <th>Abbreviation</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($languages)) {
                        foreach ($languages as $language) {
                            ?>
                            <tr>
                                <td><input type="checkbox" name="languages[]" value="<?php echo $language['id']; ?>"></td>
                                <td class="center"><a href="<?php echo $cfg['admin_url'] . $dir . '?page=language&id=' . $language['id']; ?>"><?php echo $language['language']; ?></a></td>
                                <td class="center"><?php echo $language['abrv']; ?></td>
                                <td class="center"><?php
                                    if ($language['active'] == 1) {
                                        echo 'Active';
                                    }
                                    else
                                        echo 'Inactive';
                                    ?></td>
                            </tr>
                            <?php
                        }
                    }else {
                        ?>
                        <tr><td class="center">No Languages Found</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--/span-->

</div>
