<?php
if (!(isset($_SESSION['role']['site_region']) || isset($_SESSION['role']['seo']))) {
    exit("You don't have permission to view this page!");
}
require_once($cfg['admin_path'] . "functions/siteRegionFunctions.php");
$siteRegionFunc = new siteRegionFunction();
if (isset($_POST['saveButton']) && !isset($_REQUEST['id'])) {
    $result = $siteRegionFunc->addSiteRegion();
    if ($result == 'success') {
        $siteRegionFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully saved'));
    }
    else
        $siteRegionFunc->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
}
if (isset($_POST['saveButton']) && isset($_REQUEST['id'])) {
    $result = $siteRegionFunc->updateSiteRegion();
    if ($result == 'success') {
        $siteRegionFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully saved'));
    }
    else
        $siteRegionFunc->setAlertMessage(array('err_type' => 'error', 'msg' => 'Error on Updating'));
}
$languages = $siteRegionFunc->select($cfg['db_prefix'] . "language");
if (isset($_REQUEST['id']) && $_REQUEST['id'] != '') {
    $id = $_REQUEST['id'];
    $siteregion = $siteRegionFunc->getAllRegion($id);
    $sitedata = $siteRegionFunc->siteData($id);
}
$allSiteRegion = $siteRegionFunc->getAllRegion();
?>
<div> <?php echo $siteRegionFunc->getAlertMessage(); ?>
    <ul class="breadcrumb">
        <li> <a href="<?= $cfg['admin_url']; ?>">Home</a> <span class="divider">/</span> </li>
        <li> <a href="#">Site Region </a> </li>
    </ul>
</div>

<?php
if (isset($siteregion[0]['region_name']) || isset($_SESSION['role']['site_region'])) {
    ?>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i><?php echo isset($siteregion[0]['region_name']) ? $siteregion[0]['region_name'] : 'Site Region'; ?></h2>
                <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" name="siteRegionForm" id="siteRegionForm" method="post" enctype="multipart/form-data" action="">
                    <fieldset>


                        <?php
                        if (isset($_SESSION['role']['site_region'])) {
                            ?>
                            <div class="control-group">
                                <label class="control-label" for="siteRegion_name"><span>*</span> Site Region Name</label>
                                <div class="controls">
                                    <input class="input-xlarge focused <?php echo isset($siteregion[0]['region_name']) ? 'editfield' : ''; ?>" id="siteRegion_name" name="siteRegion_name" type="text" placeholder="Enter Site Region Name" <?php echo isset($siteregion[0]['region_name']) ? 'value="' . $siteregion[0]['region_name'] . '"' : ''; ?> />
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="siteRegion_parent"><span>*</span>Parent Name</label>
                                <div class="controls">
                                    <select data-placeholder="Select Page Parent"   data-rel="chosen" name="siteRegion_parent"  <?php echo isset($siteregion[0]['region_name']) ? 'class="editfield"' : ''; ?>>
                                        <option value=""></option>
                                        <?php foreach ($allSiteRegion as $allparent) { ?>
                                            <option value="<?php echo $allparent['id'] ?>" <?php echo isset($siteregion[0]['breadcrumb_parent_id']) && $siteregion[0]['breadcrumb_parent_id'] == $allparent['id'] ? 'selected' : ''; ?>><?php echo $allparent['region_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="siteRegion_directory"><span>*</span>Directory</label>
                                <div class="controls">
                                    <select data-placeholder="Select Site Region" id="selectError2" data-rel="chosen" name="siteRegion_directory"  <?php echo isset($siteregion[0]['region_name']) ? 'class="editfield"' : ''; ?>>
                                        <option value=""></option>
                                        <option value="header" <?php echo isset($siteregion[0]['directory']) && $siteregion[0]['directory'] == 'header' ? 'selected' : ''; ?> >Header</option>
                                        <option value="footer" <?php echo isset($siteregion[0]['directory']) && $siteregion[0]['directory'] == 'footer' ? 'selected' : ''; ?>>Footer</option>
                                        <option value="contents" <?php echo isset($siteregion[0]['directory']) && $siteregion[0]['directory'] == 'contents' ? 'selected' : ''; ?>>Page</option>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="siteRegion_ispage"><span>*</span>Is Page</label>
                                <div class="controls">
                                    <label class="radio">
                                        <div class="radio" id="uniform-optionsRadios1"><span class="checked">
                                                <input type="radio" name="siteRegion_page" checked id="sitelang_status1" value="1" <?php echo isset($siteregion[0]['page']) && $siteregion[0]['page'] == '1' ? 'checked' : ''; ?>  style="opacity: 0;"  <?php echo isset($siteregion[0]['region_name']) ? 'class="editfield"' : ''; ?>></span></div>
                                        Yes
                                    </label>
                                    <div style="clear:both"></div>
                                    <label class="radio">
                                        <div class="radio" id="uniform-optionsRadios2"><span class="">
                                                <input type="radio" name="siteRegion_page" id="sitelang_status2" value="0" style="opacity: 0;" <?php echo isset($siteregion[0]['page']) && $siteregion[0]['page'] == '0' ? 'checked' : ''; ?>  <?php echo isset($siteregion[0]['region_name']) ? 'class="editfield"' : ''; ?>>
                                            </span></div>
                                        No
                                    </label>
                                </div>
                            </div>

                            <?php
                        }
                        ?>
                        <?php
                        if (isset($_SESSION['role']['seo'])) {
                            ?>
                            <div class="control-group">
                                <label class="control-label" for="siteRegion_title"><span>*</span>Page Title</label>
                                <div class="controls">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Language</th>
                                                <th>Page Title</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (is_array($languages)) {
                                                foreach ($languages as $language) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $language['language']; ?></td>
                                                        <td><textarea name="siteRegion[<?php echo $language['id']; ?>][title]"  <?php echo isset($siteregion[0]['region_name']) ? 'class="editfield"' : ''; ?>><?php echo isset($sitedata[$language['id']]['title']) ? $sitedata[$language['id']]['title'] : ''; ?></textarea></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="siteRegion_meta_key"><span>*</span>Meta Keywords</label>
                                <div class="controls">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Language</th>
                                                <th>Meta Keywords</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (is_array($languages)) {
                                                foreach ($languages as $language) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $language['language']; ?></td>
                                                        <td><textarea name="siteRegion[<?php echo $language['id']; ?>][meta_key]"  <?php echo isset($siteregion[0]['region_name']) ? 'class="editfield"' : ''; ?>><?php echo isset($sitedata[$language['id']]['title']) ? $sitedata[$language['id']]['meta_key'] : ''; ?></textarea></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="siteRegion_meta_desc"><span>*</span>Meta Description</label>
                                <div class="controls">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Language</th>
                                                <th>Meta Description</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (is_array($languages)) {
                                                foreach ($languages as $language) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $language['language']; ?></td>
                                                        <td><textarea name="siteRegion[<?php echo $language['id']; ?>][meta_desc]"  <?php echo isset($siteregion[0]['region_name']) ? 'class="editfield"' : ''; ?>><?php echo isset($sitedata[$language['id']]['title']) ? $sitedata[$language['id']]['meta_desc'] : ''; ?></textarea></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <?php
                        }
                        ?>

                        <?php
                        if (isset($_SESSION['role']['site_region'])) {
                            ?>
                            <div class="control-group">
                                <label class="control-label" for="siteRegion_bredcrumb"><span>*</span>Bread Crumb Link</label>
                                <div class="controls">
                                    <textarea name="breadcrumb_link"  <?php echo isset($siteregion[0]['region_name']) ? 'class="editfield"' : ''; ?>><?php echo isset($siteregion[0]['breadcrumb_link']) ? $siteregion[0]['breadcrumb_link'] : ''; ?></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="siteRegion_bredcrumb"><span>*</span>Bread Crumb Name</label>
                                <div class="controls">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Language</th>
                                                <th>Bread Crumb Page Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (is_array($languages)) {
                                                foreach ($languages as $language) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $language['language']; ?></td>
                                                        <td><textarea name="siteRegion[<?php echo $language['id']; ?>][breadcrumb]"  <?php echo isset($siteregion[0]['region_name']) ? 'class="editfield"' : ''; ?>><?php echo isset($sitedata[$language['id']]['title']) ? $sitedata[$language['id']]['breadcrumb'] : ''; ?></textarea></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="pageCode"><span>*</span>Page Code</label>
                                <div class="controls">
                                    <textarea  id="pageCode" style="width: 100%; height: 600px;" name="pageCode"  <?php echo isset($siteregion[0]['region_name']) ? 'class="editfield"' : ''; ?>><?php echo isset($siteregion[0]['page_code']) ? ($siteregion[0]['page_code']) : ''; ?></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="siteRegion_ispage"><span>*</span>Active</label>
                                <div class="controls">
                                    <label class="radio">
                                        <div class="radio" id="uniform-optionsRadios1"><span class="checked">
                                                <input type="radio" name="siteRegion_active" checked id="region_status1" value="1" <?php echo isset($siteregion[0]['active']) && $siteregion[0]['active'] == '1' ? 'checked' : ''; ?> style="opacity: 0;"  <?php echo isset($siteregion[0]['region_name']) ? 'class="editfield"' : ''; ?>></span></div>
                                        Yes
                                    </label>
                                    <div style="clear:both"></div>
                                    <label class="radio">
                                        <div class="radio" id="uniform-optionsRadios2"><span class="">
                                                <input type="radio" name="siteRegion_active" id="region_status2" value="0" style="opacity: 0;" <?php echo isset($siteregion[0]['active']) && $siteregion[0]['active'] == '0' ? 'checked' : ''; ?>  <?php echo isset($siteregion[0]['region_name']) ? 'class="editfield"' : ''; ?>>
                                            </span></div>
                                        No
                                    </label>
                                </div>
                            </div>

                            <?php
                        }
                        ?>


                        <div class="form-actions">
                            <input type="submit" class="btn btn-primary" name="saveButton" id="saveButton" value="<?php echo isset($siteregion[0]['region_name']) ? 'Edit"' : 'Save'; ?>">
                            <input type="button" class="btn" name="cancel" value="Cancel">
                        </div>


                    </fieldset>
                </form>
            </div>
        </div>
        <!--/span-->

    </div>
    <?php
}
?>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> Site Region</h2>
            <div class="box-icon"> <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Region Name</th>
                        <th>Region Directory</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($allSiteRegion)) {
                        foreach ($allSiteRegion as $allRegion) {
                            ?>
                            <tr>
                                <td><a href="<?php echo $cfg['admin_url'] . 'module/?page=addSiteRegion&id=' . $allRegion['id']; ?>"><?php echo ucwords($allRegion['region_name']); ?></a></td>
                                <td class="center"><?php echo $allRegion['directory']; ?></td>
                                <td class="center"><?php echo ($allRegion['active'] == '1') ? "<span class='label label-success'>Active</span>" : "<span class='label label-failure'>Inactive</span>"; ?></td>
                                <td class="center">
                                    <a class="btn btn-info" href="<?php echo $cfg['admin_url'] . 'module/?page=addSiteRegion&id=' . $allRegion['id']; ?>"></i> Edit </a>
                                    <?= isset($_SESSION['role']['site_region']) ? '<a class="btn btn-danger" href="#" onClick="return deleteConfirm();"> <i class="icon-trash icon-white"></i> Delete </a>' : ''; ?>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--/span-->

</div>

