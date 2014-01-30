<?php
if (!isset($_SESSION['role']['slider'])) {
    exit("You don't have permission to view this page!");
}
$adminFunc = new AdminFunctions();
$sliders = $adminFunc->getImages();

if (isset($_POST['saveButton'])) {
    $result = $adminFunc->saveSliderImages();
    if ($result == 'success') {
        $adminFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully saved'));
        $sliders = $adminFunc->getImages();
    }
    else
        $adminFunc->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
}
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
$slide = array();
if (is_array($sliders)) {
    foreach ($sliders as $slider) {
        if (isset($slider['id']) && $slider['id'] == $id) {
            $slide = $slider;
        }
    }
}
?>

<div>
    <ul class="breadcrumb">
        <li><a href="<?= $cfg['admin_url']; ?>">Home</a><span class="divider">/</span> </li>
        <li> <a href="#">Slider</a> </li>
    </ul>
</div>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> Add Slider Images</h2>
            <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
        </div>
        <div class="box-content">
            <?php echo $adminFunc->getAlertMessage(); ?>
            <form class="form-horizontal" enctype="multipart/form-data" name="sliderForm" id="sliderForm" method="post" action="">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="focusedInput"><span>*</span>Language</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <select data-rel="chosen" name="lang" id="lang">
                                    <option value="">Select Language</option>
                                    <option value="1">English</option>
                                    <option value="2">Spanish</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">File Upload</label>
                        <div class="controls">
                            <input type="file" class="input-xlarge" name="sliderimage" id="sliderimage">
                            <p class="help-block">Accepts jpg, .png, .gif up to 1MB. Recommended dimensions: 200px X 200px</p>
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
            <h2><i class="icon-picture"></i> Slider Images</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <br/>
            <?php if (is_array($sliders) && !is_null($sliders)) { ?>
                <ul class="thumbnails gallery">

                    <?php foreach ($sliders as $image) { ?>
                        <li id="image-<?php echo $image['id']; ?>" class="thumbnail">
                            <a style="background:url(<?php echo $cfg['upload_url'] . $image['image']; ?>)" title="Sample Image <?php echo $adminFunc->getLanguageName($image['lang_id']); ?>" href="<?php echo $cfg['upload_url'] . $image['image']; ?>"><img class="grayscale" src="<?php echo $cfg['upload_url'] . $image['image']; ?>" alt="Sample Image <?php echo $image['id']; ?>"></a>
                        </li>
                    <?php } ?>

                </ul>
            <?php } ?>
        </div>
    </div><!--/span-->

</div><!--/row-->

