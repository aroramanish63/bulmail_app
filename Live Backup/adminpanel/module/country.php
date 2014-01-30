<?php
if (!isset($_SESSION['role']['manage_country'])) {
    exit("You don't have permission to view this page!");
}
require_once($cfg['admin_path'] . "functions/countryFunction.php");
$sitelangFunc = new siteLangFunctions();
if (isset($_POST['saveButton']) && !isset($_REQUEST['edit_id'])) {
    $result = $sitelangFunc->addSiteLanguage();
    if ($result == 'success') {
        $sitelangFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully saved'));
    }
    else
        $sitelangFunc->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
}
if (isset($_POST['saveButton']) && isset($_REQUEST['edit_id'])) {
    $result = $sitelangFunc->editSiteLanguage();
    if ($result == 'success') {
        $sitelangFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully saved'));
    }
    else
        $sitelangFunc->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
}
if (isset($_GET['delId'])) {
    $delete_id = $_GET['delId'];
    $result = $sitelangFunc->deleteSiteLanguage($delete_id);
    if ($result == 'success') {
        $sitelangFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'Successfully Deleted'));
    }
    else
        $sitelangFunc->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
}
$allSiteLangList = $sitelangFunc->getAllSiteLanguages();
$countryNameList = $sitelangFunc->getCountryList();
//$currencyList = $sitelangFunc->getCurrencyList();
$currencyList = $sitelangFunc->getSelectedCurrencyList();

if (isset($_REQUEST['edit_id'])) {
    foreach ($allSiteLangList as $editInfoLAnguage) {
        if ($editInfoLAnguage['id'] == $_REQUEST['edit_id']) {
            $editInfoLang = $editInfoLAnguage;
        }
    }
}
?>

<div>
    <script>
        function deleteConfirm()
        {
            var r = confirm("Do you want to delete this language!");

            if (r == true)
            {
                return true;
            }
            else
            {
                return false;
            }

        }
    </script>

    <?php echo $sitelangFunc->getAlertMessage(); ?>
    <ul class="breadcrumb">
        <li> <a href="<?= $cfg['admin_url']; ?>">Home</a> <span class="divider">/</span> </li>
        <li> <a href="#">Add Site Language</a> </li>
    </ul>
</div>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i>Add Site Language</h2>
            <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
        </div>
        <div class="box-content">

            <form class="form-horizontal" name="siteLanguageForm" id="siteLanguageForm" method="post" action="">
                <fieldset>


                    <div class="control-group">
                        <label class="control-label" for="countryName"><span>*</span>Select Country Name   </label>
                        <div class="controls">
                            <select  data-rel="chosen"   name="countryName" id="countryName">
                                <option value=""></option>

                                <?php
//                                echo '<textarea>';
//                                var_dump($countryNameList);
//                                echo '<br><br><br><br>';
//                                var_dump($editInfoLang);
//                                echo '</textarea>';

                                foreach ($countryNameList as $countryList) {
                                    $selectedcn = '';
                                    if (isset($editInfoLang['country_code']) && strtolower($countryList['cou_code']) == strtolower($editInfoLang['country_code'])) {
                                        $selectedcn = ' selected ';
                                    }
                                    echo "<option value=" . urlencode($countryList['cou_name']) . "  $selectedcn >" . $countryList['cou_name'] . " </option>";
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
                                    $selectedcc = '';
                                    if (isset($editInfoLang['country_code']) && $countryList['cou_code'] == $editInfoLang['country_code']) {
                                        $selectedcc = ' selected ';
                                    }

                                    echo "<option value=" . $countryList['cou_code'] . " $selectedcc >" . $countryList['cou_code'] . " </option>";
                                }
                                ?>
                            </select>
                        </div>

                    </div>

                    <div class="control-group">
                        <label class="control-label" for="language_name"><span>*</span>  Language Name</label>
                        <div class="controls">
                            <input class="input-xlarge focused<?php echo isset($_REQUEST['edit_id']) ? ' editfield' : ''; ?>" id="language_name" name="language_name" type="text" placeholder="Language name" <?php echo isset($editInfoLang['language_name']) ? 'value="' . $editInfoLang['language_name'] . '"' : ''; ?> />
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="language_code"><span>*</span>  Language Code </label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused<?php echo isset($_REQUEST['edit_id']) ? ' editfield' : ''; ?>" id="language_code" name="language_code" type="text" placeholder="Language Code"  <?php echo isset($editInfoLang['language_code']) ? 'value="' . $editInfoLang['language_code'] . '"' : ''; ?> >
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="currencyCode"><span>*</span>Select Currency  </label>
                        <div class="controls">
                            <select  data-rel="chosen"   name="currencyCode" id="currencyCode">
                                <option value=""></option>

                                <?php
                                foreach ($currencyList as $currList) {
                                    $selectedccn = '';
                                    if (isset($editInfoLang['currency_code']) && $currList['currency_code'] == $editInfoLang['currency_code']) {
                                        $selectedccn = ' selected ';
                                    }
                                    echo "<option value=" . $currList['currency_code'] . " $selectedccn >" . $currList['currency_code'] . " </option>";
                                }
                                ?>
                            </select>
                        </div>

                    </div>


                    <div class="control-group">
                        <label class="control-label" for="tollfree"><span>*</span> Toll Free</label>
                        <div class="controls">
                            <?php
                            $value = '';
                            if (isset($editInfoLang['custom_field'])) {
                                $unser = unserialize(base64_decode($editInfoLang['custom_field']));
                                if (isset($unser['tollfree'])) {
                                    $value = ' value="' . $unser['tollfree'] . '" ';
                                }
                            }
                            ?>
                            <input class="input-xlarge focused<?php echo isset($_REQUEST['edit_id']) ? ' editfield' : ''; ?>" id="tollfree" name="tollfree" type="text" placeholder=" "  <?php echo $value; ?>/>
                        </div>
                    </div>


                    <div class="control-group">
                        <label class="control-label">Status</label>
                        <div class="controls">
                            <label class="radio">
                                <div class="radio" id="uniform-optionsRadios1"><span class="checked">
                                        <input type="radio" name="active" id="sitelang_status1" value="1" <?php
                                        if (isset($editInfoLang['active']) && $editInfoLang['active'] == "1") {
                                            echo 'checked="checked"';
                                        }
                                        ?> style="opacity: 0;"></span></div>
                                Active
                            </label>
                            <div style="clear:both"></div>
                            <label class="radio">
                                <div class="radio" id="uniform-optionsRadios2"><span class="">
                                        <input type="radio" name="active" id="sitelang_status2" value="0" <?php
                                        if (isset($editInfoLang['active']) && $editInfoLang['active'] == "0") {
                                            echo 'checked="checked"';
                                        }
                                        ?> style="opacity: 0;"></span></div>
                                Inactive
                            </label>
                            <input type="hidden" value="<?php echo $editInfoLang['id'] ?>" name="updateId" />
                        </div>
                    </div>


                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary" name="saveButton" id="saveButton" <?php echo isset($_REQUEST['edit_id']) ? 'value="Edit"' : 'value="Save"' ?> >
                        <input type="button" class="btn" name="cancel" value="Cancel">
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
    <!--/span-->

</div>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> Site Languages</h2>
            <div class="box-icon">
                <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Language Name</th>
                        <th>Language Code</th>
                        <th>Country Name</th>
                        <th>Country Code</th>
                        <th>Currency Code</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($allSiteLangList as $allList) {
                        ?>
                        <tr>
                            <td><?php echo $allList['language_name']; ?></td>
                            <td class="center"><?php echo $allList['language_code']; ?></td>
                            <td class="center"><?php echo $allList['country_name']; ?></td>
                            <td class="center"><?php echo $allList['country_code']; ?></td>
                            <td class="center"><?php echo $allList['currency_code']; ?></td>

                            <td class="center">
                                <?php echo ($allList['active'] == '1') ? "<span class='label label-success'>Active</span>" : "<span class='label label-failure'>Inactive</span>"; ?>

                            </td>
                            <td class="center">
                                <!--<a class="btn btn-success" href="#">
                                        <i class="icon-zoom-in icon-white"></i>
                                        View
                                </a>-->
                                <a class="btn btn-info" href="<?php echo $cfg['admin_url'] . "module/?page=addCountry&edit_id=" . $allList['id']; ?>">
                                    <i class="icon-edit icon-white"></i>
                                    Edit
                                </a>
                                <a class="btn btn-danger" href="<?php echo $cfg['admin_url'] . "module/?page=addCountry&delId=" . $allList['id']; ?>" onClick="return deleteConfirm();">
                                    <i class="icon-trash icon-white"></i>
                                    Delete
                                </a>

                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div><!--/span-->

</div>
