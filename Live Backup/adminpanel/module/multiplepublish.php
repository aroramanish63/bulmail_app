<?php
if (!isset($_SESSION['role']['publish'])) {
    exit('You Don\'nt have permission to view this page');
}
require_once($cfg['admin_path'] . "functions/publishClass.php");
$adminFunc = new publishClass();
$languages = $adminFunc->select($cfg['db_prefix'] . 'language');
$regions = $adminFunc->select($cfg['db_prefix'] . 'site_region');
$message_err = '';
$message_success = '';
if (isset($_POST['btn_save'])) {
    if (!isset($_POST['region']) || !isset($_POST['language'])) {
        $message_err.='Select Page and Language to Publish';
    } else {
        $page_count = '';
        $page_count = count($_POST['region']);
        $count_lang = count($_POST['language']);
        $results = array();
        if (isset($page_count)) {
            $k = 0;
            while ($k <= $count_lang - 1) {
                $i = 0;
                while ($i <= $page_count - 1) {
                    $results[] = $adminFunc->publish($_POST['region'][$i], $_POST['language'][$k]);
                    $i++;
                }
                $k++;
            }
        }
        foreach ($results as $result) {
            if (isset($result['err'])) {
                $message_err.='Error (' . $result['err'] . ') ';
            } elseif (isset($result['success'])) {
                $message_success.= $result['success'] . '. ';
            }
        }
    }
}
?>

<?php
if ($message_err != '') {
    $adminFunc->setAlertMessage(array('err_type' => 'error', 'msg' => $message_err));
    echo $adminFunc->getAlertMessage();
}
if ($message_success != '') {
    $adminFunc->setAlertMessage(array('err_type' => 'success', 'msg' => $message_success));
    echo $adminFunc->getAlertMessage();
}
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
            <h2><i class="icon-edit"></i> Publish Multiple Pages</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>


        <div class="box-content">
            <div class="control-group">
                <label class="control-label" for="selectError2">Select Pages</label>
                <form name="frm" method="post" action="">
                    <div class="controls">
                        <select data-placeholder="Select Page" id="selectRegion" multiple data-rel="chosen" name="region[]">
                            <option value=""></option>
                            <?php foreach ($regions as $region) { ?>
                                <option value="<?php echo $region['id']; ?>" <?php
                                if (isset($_POST['region']) && $_POST['region'] == $region['id']) {
                                    echo 'selected';
                                }
                                ?>><?php echo $region['region_name']; ?></option>
                                    <?php } ?>
                        </select>&nbsp;&nbsp;&nbsp;&nbsp;
                        <select data-placeholder="Select Language to publish" id="selectLanguage" multiple data-rel="chosen" name="language[]">
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
