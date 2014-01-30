<?php
if (!isset($_SESSION['role']['publish'])) {
    exit('You Don\'nt have permission to view this page');
}
require_once($cfg['admin_path'] . "functions/publishClass.php");
$adminFunc = new publishClass();
$languages = $adminFunc->select($cfg['db_prefix'] . 'language');
$regions = $adminFunc->select($cfg['db_prefix'] . 'site_region');
if (isset($_POST['btn_save'])) {
    if ($_POST['region'] == '' || $_POST['language'] == '') {
        $message = array('err_type' => 'error', 'msg' => 'Select Page and Language to Publish');
        $adminFunc->setAlertMessage($message);
    } else {
        $result = $adminFunc->publish($_POST['region'], $_POST['language']);
        if (isset($result['err'])) {
            $message = array('err_type' => 'error', 'msg' => $result['err']);
            $adminFunc->setAlertMessage($message);
        } elseif (isset($result['success'])) {
            $message = array('err_type' => 'success', 'msg' => $result['success']);
            $adminFunc->setAlertMessage($message);
        }
    }
}
if (isset($_POST["savepage"])) {
    $adminFunc->savePageText();
}

if (isset($_POST["savepagenpublish"])) {
    $adminFunc->savePageText();
    $lang_id = $adminFunc->select($cfg['db_prefix'] . 'language', 'id', array('abrv' => $_SESSION['lang']));
    if (isset($_POST['langval']) && is_array($_POST['langval']) && count($_POST['langval']) > 0) {
        foreach ($_POST['langval'] as $key => $val) {
            $arrtxt = explode("_", $key);
            $region = $arrtxt[0];
        }
    }
    if (!isset($region) || !isset($lang_id[0]['id'])) {
        $message = array('err_type' => 'error', 'msg' => 'Select Region and Language');
        $adminFunc->setAlertMessage($message);
    } else {
        $result = $adminFunc->publish($region, $lang_id[0]['id']);
        if (isset($result['err'])) {
            $message = array('err_type' => 'error', 'msg' => $result['err']);
            $adminFunc->setAlertMessage($message);
        } elseif (isset($result['success'])) {
            $message = array('err_type' => 'success', 'msg' => $result['success']);
            $adminFunc->setAlertMessage($message);
        }
    }
}
?>

<div>
    <ul class="breadcrumb">
        <li> <a href="<?= $cfg['admin_url']; ?>">Home</a><span class="divider">/</span> </li>
        <li> <a href="#">Module</a> </li>
    </ul>
</div>
<?php echo $adminFunc->getAlertMessage(); ?>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> Publish</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>


        <div class="box-content">
            <div class="control-group">
                <label class="control-label" for="selectError2">Select Page</label>
                <form name="frm" method="post" action="">
                    <div class="controls">
                        <select data-placeholder="Select Page" id="selectRegion" data-rel="chosen" name="region">
                            <option value=""></option>
                            <?php foreach ($regions as $region) { ?>
                                <option value="<?php echo $region['id']; ?>" <?php
                                if (isset($_POST['region']) && $_POST['region'] == $region['id']) {
                                    echo 'selected';
                                }
                                ?>><?php echo $region['region_name']; ?></option>
                                    <?php } ?>
                        </select>&nbsp;&nbsp;&nbsp;&nbsp;
                        <select data-placeholder="Select Language to publish" id="selectLanguage" data-rel="chosen" name="language">
                            <option value=""></option>
                            <?php foreach ($languages as $language) {
                                ?>
                                <option value="<?php echo $language['id']; ?>"><?php echo $language['language']; ?></option>
                            <?php }
                            ?>
                        </select>
                    </div>
                    <div class="form-actions">
                        <input type="submit" name="btn_save" class="btn btn-primary" value="Publish">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
