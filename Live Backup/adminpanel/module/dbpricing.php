<?php
if (!isset($_SESSION['role']['plans'])) {
    exit("You don't have permission to view this page!");
}
require_once($cfg['admin_path'] . "functions/dbPricingFunctions.php");
$dbPlanFunc = new dbPlans();

if (isset($_POST['saveButton'])) {
    $result = $dbPlanFunc->savePlans();
    if ($result == 'success') {
        $dbPlanFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully saved'));
    }
    else
        $dbPlanFunc->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
}
$dbPlans = $dbPlanFunc->getPricing();
$currencies = $dbPlanFunc->select($cfg['db_prefix'] . 'base_currency', '*', array('active' => 1));
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
$db_plans = array();
if (is_array($dbPlans)) {
    foreach ($dbPlans as $dbPrPlans) {
        if (isset($dbPrPlans['id']) && $dbPrPlans['id'] == $id) {
            $db_plans = $dbPrPlans;
        }
    }
}
?>

<div>
    <ul class="breadcrumb">
        <li> <a href="<?= $cfg['admin_url']; ?>">Home</a> <span class="divider">/</span> </li>
        <li> <a href="#">Database Price Plans</a> </li>
    </ul>
</div>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> Add DB Plans</h2>
            <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
        </div>
        <div class="box-content">
            <?php
            echo $dbPlanFunc->getAlertMessage();
            ?>
            <form class="form-horizontal" name="elasticForm" id="elasticForm" method="post" action="">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="db_name"><span>*</span>Database Type Id</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($db_plans['db_type']) ? 'editfield' : ''; ?>" id="db_name" name="db_name" type="text" <?php echo isset($db_plans['db_type']) ? ' value="' . $db_plans['db_type'] . '"' : ''; ?> placeholder="Database Type">
                                <input type="hidden" name="id" value="<?php echo isset($db_plans['id']) ? $db_plans['id'] : ''; ?>">
                            </div>
                        </div>
                    </div>


                    <div class="control-group">
                        <label class="control-label" for="db_name"><span>*</span>Database Type Name</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($db_plans['db_type_name']) ? 'editfield' : ''; ?>" id="db_type_name" name="db_type_name" type="text" <?php echo isset($db_plans['db_type_name']) ? ' value="' . $db_plans['db_type_name'] . '"' : ''; ?> placeholder="Database Type_name">
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="db_name"><span>*</span>Currency</label>
                        <div class="controls">
                            <select data-placeholder="Select Currency" id="region" data-rel="chosen" name="currency_code">
                                <option value=""></option>
                                <?php foreach ($currencies as $currency) { ?>
                                    <option value="<?php echo $currency['currency_code']; ?>" <?php
                                    if (isset($db_plans['currency_code']) && $db_plans['currency_code'] == $currency['currency_code']) {
                                        echo 'selected';
                                    }
                                    ?>><?php echo $currency['currency_code']; ?></option>
                                        <?php } ?>
                            </select>
                        </div>

                    </div>
                    <div class="control-group">
                        <label class="control-label" for="noCores"><span>*</span>No. Of Cores</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($db_plans['no_of_cores']) ? 'editfield' : ''; ?>" id="noCores" name="noCores" type="text" <?php echo isset($db_plans['no_of_cores']) ? ' value="' . $db_plans['no_of_cores'] . '"' : ''; ?> placeholder="No of Cores">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="hourlyPrice"><span>*</span>Hourly Price</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($db_plans['hourly_price']) ? 'editfield' : ''; ?>" id="hourlyPrice" name="hourlyPrice" type="text" <?php echo isset($db_plans['hourly_price']) ? ' value="' . $db_plans['hourly_price'] . '"' : ''; ?> placeholder="Hourly Price">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="monthlyPrice"><span>*</span>Monthly Price</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($db_plans['monthly_price']) ? 'editfield' : ''; ?>" id="monthlyPrice" name="monthlyPrice" type="text" <?php echo isset($db_plans['monthly_price']) ? ' value="' . $db_plans['monthly_price'] . '"' : ''; ?> placeholder="Monthly Price">
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Status</label>
                        <div class="controls">
                            <label class="radio">
                                <div class="radio" id="uniform-optionsRadios1"><span class="checked"><input type="radio" name="planStatus" id="planStatus1" value="1" <?php echo (isset($db_plans['active']) && $db_plans['active'] == '1') ? 'checked="checked"' : ''; ?> style="opacity: 0;"></span></div>
                                Active
                            </label>
                            <div style="clear:both"></div>
                            <label class="radio">
                                <div class="radio" id="uniform-optionsRadios2"><span class=""><input type="radio" name="planStatus" id="planStatus2" value="0" <?php echo (isset($db_plans['active']) && $db_plans['active'] == '0') ? 'checked="checked"' : ''; ?> style="opacity: 0;"></span></div>
                                Inactive
                            </label>
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary" name="saveButton" id="saveButton" value="<?php echo isset($db_plans['db_type']) ? 'Edit' : 'Save'; ?>">
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
            <h2><i class="icon-user"></i>Pricing  List</h2>
            <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th>Db Type Name</th>
                        <th>Currency Code</th>
                        <th>No. of Cores</th>
                        <th>Hourly Price</th>
                        <th>Monthly Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($dbPlans)) {
                        foreach ($dbPlans as $dbPrPlans) {
                            ?>
                            <tr>
                                <td class="center"><a href="<?php echo $cfg['admin_url'] . $dir . '?page=dbpricing&id=' . $dbPrPlans['id']; ?>"> <?php echo $dbPrPlans['db_type_name']; ?></a></td>
                                <td class="center"><?php echo $dbPrPlans['currency_code']; ?></td>
                                <td class="center"><?php echo $dbPrPlans['no_of_cores']; ?></td>
                                <td class="center"><?php echo ($dbPrPlans['hourly_price'] == 'Free') ? $dbPrPlans['hourly_price'] : $dbPrPlans['hourly_price']; ?></td>
                                <td class="center"><?php echo ($dbPrPlans['monthly_price'] == 'Free') ? $dbPrPlans['monthly_price'] : $dbPrPlans['monthly_price']; ?></td>
                                <td class="center"><?php echo ($dbPrPlans['active'] == '1') ? "<span class='label label-success'>Active</span>" : "<span class='label label-failure'>Inactive</span>"; ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr><td class="center">No DB Pricing Found</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--/span-->

</div>
