<?php
require_once($cfg['admin_path'] . "functions/countryFunction.php");
$sitelangFunc = new siteLangFunctions();

if (isset($_POST['editButton'])) {

    $result = $sitelangFunc->editSiteLanguage();

    if ($result == 'success') {
        $sitelangFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully saved'));
    }
    else
        $sitelangFunc->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
}

if (isset($_GET['edit_id'])) {
    $editId = $_GET['edit_id'];
    $editInfoLAnguage = $sitelangFunc->getSiteEditInfo($editId);
    $editInfoLang = $editInfoLAnguage[0];
    ?>
    <?php echo $sitelangFunc->getAlertMessage(); ?>

    <div>
        <ul class="breadcrumb">
            <li> <a href="#">Home</a> <span class="divider">/</span> </li>
            <li> <a href="#">Edit Site Language</a> </li>
        </ul>
    </div>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i>Edit Site Language</h2>
                <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
            </div>
            <div class="box-content">

                <form class="form-horizontal" name="siteLanguageForm" id="siteLanguageForm" method="post" action=" ">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="language_name"><span>*</span> Language Name</label>
                            <div class="controls">
                                <input class="input-xlarge focused" id="language_name" name="language_name" value="<?php echo $editInfoLang['language_name']; ?>" type="text" placeholder=" " />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="language_code"><span>*</span> Language Code </label>
                            <div class="controls">
                                <div class="fieldDiv">
                                    <input class="input-xlarge focused " value="<?php echo $editInfoLang['language_code']; ?>" id="language_code" name="language_code" type="text" placeholder=" ">
                                </div>
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label" for="countryName"><span>*</span>Select Country Name   </label>
                            <div class="controls">
                                <select  data-rel="chosen"     name="countryName" id="countryName">
                                    <option value=""></option>

                                    <?php
                                    $countryNameList = $sitelangFunc->getCountryList();

                                    foreach ($countryNameList as $countryList) {
                                        echo '<option value="' . $countryList['cou_name'] . '" ' . (($countryList['cou_name'] == ucwords(strtolower($editInfoLang['country_name']))) ? 'selected="selected"' : "") . '>' . $countryList['cou_name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                        </div>
                        <div class="control-group">
                            <label class="control-label" for="countryCode"><span>*</span>Select Country Code   </label>
                            <div class="controls">
                                <select  data-rel="chosen"   name="countryCode" id="countryCode">
                                    <option value=""></option>

                                    <?php
                                    foreach ($countryNameList as $countryList) {
                                        echo '<option value="' . $countryList['cou_code'] . '" ' . (($countryList['cou_code'] == $editInfoLang['country_code']) ? 'selected="selected"' : "") . '>' . $countryList['cou_code'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                        </div>
                        <div class="control-group">
                            <label class="control-label" for="currencyCode"><span>*</span>Select Currency  </label>
                            <div class="controls">
                                <select  data-rel="chosen"   name="currencyCode" id="currencyCode">
                                    <option value=""></option>

                                    <?php
                                    $currencyList = $sitelangFunc->getCurrencyList();
                                    foreach ($currencyList as $currList) {
                                        echo '<option value="' . $currList['currency_code'] . '" ' . (($currList['currency_code'] == $editInfoLang['currency_code']) ? 'selected="selected"' : "") . '>' . $currList['currency_name'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                        </div>
                        <div class="control-group">
                            <label class="control-label">Status</label>
                            <div class="controls">
                                <label class="radio">
                                    <div class="radio" id="uniform-optionsRadios1"><span class="checked"><input type="radio" name="sitelang_status" id="sitelang_status1" value="1" <?php
                                            if ($editInfoLang['status'] == "1") {
                                                echo 'checked="checked"';
                                            }
                                            ?> style="opacity: 0;"></span></div>
                                    Active
                                </label>
                                <div style="clear:both"></div>
                                <label class="radio">
                                    <div class="radio" id="uniform-optionsRadios2"><span class=""><input type="radio" name="sitelang_status" id="sitelang_status2" value="0" <?php
                                            if ($editInfoLang['status'] == "0") {
                                                echo 'checked="checked"';
                                            }
                                            ?> style="opacity: 0;"></span></div>
                                    Inactive
                                </label>
                                <input type="hidden" value="<?php echo $editInfoLang['id'] ?>" name="updateId" />
                            </div>
                        </div>


                        <div class="form-actions">
                            <input type="submit" class="btn btn-primary" name="editButton" id="editButton" value="Edit">
                            <input type="button" class="btn" name="cancel" value="Cancel" >
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <!--/span-->

    </div>
    <?
}
?>

