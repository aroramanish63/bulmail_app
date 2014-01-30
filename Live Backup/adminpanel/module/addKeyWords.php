<?php
if (!isset($_SESSION['role']['add_key'])) {
    exit("You don't have permission to view this page!");
}
require_once($cfg['admin_path'] . "functions/keywordFunctions.php");
$keywordFunc = new keywordFunctions();
$keywordsEnglish = $keywordFunc->getKeyWordsEnglish();
//echo "<pre>";print_r($keywordFunc->getKeyWordsEnglish());echo "</pre>";die;
if (isset($_POST['saveButton'])) {

    $result = $keywordFunc->addKeywords();

    if ($result == 'success') {
        $keywordFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully saved'));
    }
    else
        $keywordFunc->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
}
?>

<div>
    <ul class="breadcrumb">
        <li> <a href="<?= $cfg['admin_url']; ?>">Home</a> <span class="divider">/</span> </li>
        <li> <a href="#">Add Keywords</a> </li>
    </ul>
</div>
<?php echo $keywordFunc->getAlertMessage(); ?>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="i	con-user"></i> Add Keywords</h2>
            <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
        </div>
        <div class="box-content">
            <form class="form-horizontal" name="keywordForm" id="keywordForm" method="post" action="">
                <fieldset>
                    <div class="box-content">
                        <div class="control-group">
                            <label class="control-label" for="region_id"><span>*</span>Select Region </label>
                            <div class="controls">
<?php $regionList = $keywordFunc->getSiteRegion(); ?>
                                <select data-placeholder="Select Region of Keyword"  name="region_id" id="region_id" data-rel="chosen">
                                    <option value=""></option>
<?php foreach ($regionList as $regList) {
    ?>
                                        <option value="<?php echo $regList['id']; ?>"><?php echo $regList['region_name']; ?></option>
                                        <?php }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label" for="name_key"><span>*</span> Add Key Name</label>
                            <div class="controls">
                                <div class="fieldDiv">
                                    <input class="input-xlarge focused " id="name_key" name="name_key" type="text" placeholder=" "/>
                                </div>
                            </div>
                        </div>
<?php
$languageList = $keywordFunc->getLanguageList();
$i = 0;
foreach ($languageList as $langList) {
    //	echo "<option value=".$langList['abrv'].">".$langList['language']." </option>";
    ?>
                            <div class="control-group">
                                <label class="control-label" for="langValue_<?php echo $langList['id']; ?>"><span>*</span><?php echo $langList['language']; ?> &nbsp;Translation</label>
                                <div class="controls">
                                    <div class="fieldDiv">
                                        <input class="input-xlarge focused " id="langValue_<?php echo $langList['id']; ?>" name="langValue[<?php echo $langList['id']; ?>]" type="text" placeholder=" "/>
                                    </div>
                                </div>
                            </div>
    <?
    $i++;
}
?>
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
