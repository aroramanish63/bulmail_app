<?php
require_once($cfg['admin_path'] . "functions/basecurrencyFunctions.php");
$basecuFunc = new basecurrency();

if (isset($_POST['saveButton'])) {
    $result = $basecuFunc->saveCurrency();
    if ($result == 'success') {
        $basecuFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully saved'));
    }
    else
        $basecuFunc->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
}
$base_currency = $basecuFunc->getCurrency();
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
$b_curr = array();
if (is_array($base_currency)) {
    foreach ($base_currency as $basecurrency) {
        if (isset($basecurrency['id']) && $basecurrency['id'] == $id) {
            $b_curr = $basecurrency;
        }
    }
}
$currencyList = $basecuFunc->getCurrencyList();
?>

<?php
echo $basecuFunc->getAlertMessage();
?>
<div>
    <ul class="breadcrumb">
        <li> <a href="#">Home</a> <span class="divider">/</span> </li>
        <li> <a href="#">Base Currency</a> </li>
    </ul>
</div>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> Add Base Currency</h2>
            <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
        </div>
        <div class="box-content">
            <form class="form-horizontal" name="currForm" enctype="multipart/form-data" id="currForm" method="post" action="">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="currencyCode"><span>*</span>Select Currency  </label>
                        <div class="controls">
                            <select  data-rel="chosen" <?php
                            if (isset($b_curr['currency_code'])) {
                                echo "disabled";
                            }
                            ?> name="currencyCode" id="currencyCode">
                                <option value=""></option>
                                <?php
                                foreach ($currencyList as $currList) {
                                    ?>
                                    <option value="<?php echo $currList['currency_code']; ?>" <?php
                                    if (isset($b_curr['currency_code']) && $currList['currency_code'] == $b_curr['currency_code']) {
                                        echo "selected";
                                    }
                                    ?>><?php echo $currList['currency_code']; ?></option>
                                            <?php
                                        }
                                        ?>
                            </select>
                            <input type="hidden" name="id" value="<?php echo isset($b_curr['id']) ? $b_curr['id'] : ''; ?>">

                        </div>

                    </div>

                    <div class="control-group">
                        <label class="control-label"><span>*</span>Currency Weight</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($b_curr['currency_weight']) ? 'editfield' : ''; ?>" id="currencyWeight" name="currencyWeight" type="text" <?php echo isset($b_curr['currency_weight']) ? ' value="' . $b_curr['currency_weight'] . '"' : ''; ?> placeholder="Currency Weigtht">
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" ><span>*</span>Active</label>
                        <div class="controls">
                            <label class="radio">
                                <div class="radio" id="uniform-optionsRadios1"><span class="checked">
                                        <input type="radio" name="base_active"   id="base_active" value="1" <?php echo isset($b_curr['active']) && $b_curr['active'] == '1' ? 'checked' : ''; ?> style="opacity: 0;"  <?php echo isset($b_curr['active']) ? 'class="editfield"' : ''; ?>></span></div>
                                Yes
                            </label>
                            <div style="clear:both"></div>
                            <label class="radio" >
                                <div class="radio" id="uniform-optionsRadios2"><span class="">
                                        <input type="radio" name="base_active" id="base_inactive" value="0" <?php echo isset($b_curr['active']) && $b_curr['active'] == '0' ? 'checked' : ''; ?> style="opacity: 0;"  <?php echo isset($b_curr['active']) ? 'class="editfield"' : ''; ?>></span></div>
                                No
                            </label>
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary" name="saveButton" id="saveButton" value="<?php echo isset($b_curr['currency_weight']) ? 'Edit' : 'Save'; ?>">
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
            <h2><i class="icon-user"></i> Currency List</h2>
            <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="check_all" value="option1"></th>
                        <th>Currency Code</th>
                        <th>Currency Name</th>
                        <th>Currency Weight</th>
                        <th>Active</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($base_currency)) {
                        foreach ($base_currency as $basecurrency) {
                            ?>
                            <tr>
                                <td><input type="checkbox" name="currrency[]" value="<?php echo $basecurrency['id']; ?>"></td>
                                <td class="center"><a href="<?php echo $cfg['admin_url'] . $dir . '?page=basecurrency&id=' . $basecurrency['id']; ?>"><?php echo $basecurrency['currency_code']; ?></a></td>
                                <td class="center"><?php
                                    foreach ($currencyList as $currency) {
                                        if ($currency['currency_code'] == $basecurrency['currency_code']) {
                                            echo $currency['currency_name'];
                                        }
                                    }
                                    ?>
                                </td>
                                <td class="center"><?php echo $basecurrency['currency_weight']; ?></td>
                                <td class="center">
                                    <?php echo ($basecurrency['active'] == '1') ? "<span class='label label-success'>Active</span>" : "<span class='label label-failure'>Inactive</span>"; ?>

                                </td>

                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr><td class="center">No Languages Found</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--/span-->

</div>
