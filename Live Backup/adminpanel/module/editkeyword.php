<?php
if (!isset($_SESSION['role']['edit_key'])) {
    exit("You don't have permission to view this page!");
}
require_once($cfg['admin_path'] . "functions/publishClass.php");
$adminFunc = new publishClass();
$regions = $adminFunc->select($cfg['db_prefix'] . 'site_region');

if (isset($_POST['region'])) {
    $file = '';
    foreach ($regions as $region) {
        if ($region['id'] == $_POST['region']) {
            $file = $region['directory'] . '/' . $region['region_name'];
        }
    }
    $where = array('key_region' => $_POST['region']);
    $keywords = $adminFunc->select($cfg['db_prefix'] . "lang_keywords", "*", $where);
    $jsonKeywords = json_encode($keywords);
    $languages = $adminFunc->select($cfg['db_prefix'] . "language");
    $lang = array();
    foreach ($languages as $language) {
        $lang[$language['id']] = $language['language'];
    }
    $jsonLang = json_encode($lang);
}
if (isset($_POST['btn_save_text'])) {
    $adminFunc->saveLangText();
}
?>

<div>
    <ul class="breadcrumb">
        <li> <a href="<?= $cfg['admin_url']; ?>">Home</a> <span class="divider">/</span> </li>
        <li> <a href="#">Module</a> </li>
    </ul>
</div>
<?php echo $adminFunc->getAlertMessage(); ?>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> Edit Content</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <div class="control-group">
                <label class="control-label" for="selectError2">Select Page to Edit</label>
                <form name="frm" method="post" action="">
                    <div class="controls">
                        <select data-placeholder="Select Page to Edit" id="region" data-rel="chosen" name="region" onchange="this.form.submit();">
                            <option value=""></option>
                            <?php foreach ($regions as $region) { ?>
                                <option value="<?php echo $region['id']; ?>" <?php
                                if (isset($_POST['region']) && $_POST['region'] == $region['id']) {
                                    echo 'selected';
                                }
                                ?>><?php echo $region['region_name']; ?></option>
                                    <?php } ?>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
                            $(document).ready(function(e) {
                                $("#selectKey").change(function(e) {
                                    $("#keyContent").html('<img src="<?php echo $cfg['admin_image_url']; ?>ajax-loaders/ajax-loader-1.gif" alt="loading..."/>');
                                    var lang_keys = $("#selectKey").val();
                                    var regions = $("#region").val();
                                    $.ajax({
                                        type: "POST",
                                        url: '<?php echo $cfg['site_url']; ?>adminpanel/module/index.php',
                                        data: {page: "editKeywords", ajx: "YES", region: regions, lang_key: lang_keys},
                                        success: function(data, msg, xhr) {
                                            $("#keyContent").html(data);
                                        }
                                    });
                                });
                                $(".fileContent").hide();
                                $("#content_en").show();
                                $(".content_lang").click(function(e) {
                                    $(".fileContent").hide();
                                    $("#content_" + this.value).show();
                                });
                            });
</script>
<?php
if (isset($keywords) && count($keywords) > 0) {
    ?>

    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-edit"></i>Edit Keywords</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <div class="control-group">
                    <label class="control-label" for="selectError2">Select keyword and Edit</label>

                    <div class="controls">
                        <select data-placeholder="Select Page to Edit" id="selectKey" data-rel="chosen" name="keyword">
                            <option value=""></option>
                            <?php
                            foreach ($keywords as $key) {
                                if ($key['lang_id'] == 1) {
                                    ?>
                                    <option value="<?php echo $key['lang_key']; ?>"><?php echo $key['lang_value']; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <form name="frm" method="post" action="">
                        <div id="keyContent">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-edit"></i>Edit Page</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="controls">
                <div class="box-content">
                    <div class="control-group">
                        <label class="control-label" for="selectError2">Edit Whole Page</label>
                        <a href="<?php echo $cfg['site_url']; ?>">Home Page</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php
}
?>