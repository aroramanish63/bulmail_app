<?php
if (!isset($_SESSION['role']['imp_key'])) {
    exit("You don't have permission to view this page!");
}
require_once($cfg['admin_path'] . "functions/importFunctions.php");
require_once($cfg['admin_path'] . "classes/simplexlsx.class.php");
$importFunc = new importFunctions();
$regions = $importFunc->select($cfg['db_prefix'] . 'site_region');
$languages = $importFunc->select($cfg['db_prefix'] . 'language');
if (isset($_POST['saveButton'])) {
    $result = $importFunc->importFile();
    if ($result == 'success') {
        $importFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully saved'));
    }
    else
        $importFunc->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
}
?>

<div>

    <?php echo $importFunc->getAlertMessage(); ?>
    <ul class="breadcrumb">
        <li> <a href="<?= $cfg['admin_url']; ?>">Home</a> <span class="divider">/</span> </li>
        <li> <a href="#">Import File </a> </li>
    </ul>
</div>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i>Import File</h2>
            <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
        </div>
        <div class="box-content">

            <form class="form-horizontal" name="importForm" id="importForm" method="post" enctype="multipart/form-data" action="">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="file_name"><span>*</span>Select Site Region</label>
                        <div class="controls">
                            <select data-placeholder="Select Page" id="selectError2" data-rel="chosen" name="region">
                                <option value=""></option>
                                <?php foreach ($regions as $region) { ?>
                                    <option value="<?php echo $region['id']; ?>" <?php
                                    if (isset($_POST['region']) && $_POST['region'] == $region['id']) {
                                        echo 'selected';
                                    }
                                    ?>><?php echo $region['region_name']; ?></option>
                                        <?php } ?>
                            </select>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="file_name"><span>*</span>Select Language</label>
                        <div class="controls">
                            <select data-placeholder="Select Language" id="selectLang" data-rel="chosen" name="language">
                                <option value=""></option>
                                <?php foreach ($languages as $language) { ?>
                                    <option value="<?php echo $language['id']; ?>"><?php echo $language['language']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="file_name"><span>*</span>  Import Excel File</label>
                        <div class="controls">
                            <input class="input-xlarge focused" id="file_name" name="file_name" type="file" placeholder=" " />
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary" name="saveButton" id="saveButton" value="Save">
                        <input type="button" class="btn" name="cancel" value="Cancel">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <!--/span-->

</div>


