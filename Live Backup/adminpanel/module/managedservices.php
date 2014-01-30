<?php
if (!isset($_SESSION['role']['plans'])) {
    exit("You don't have permission to view this page!");
}
require_once($cfg['admin_path'] . "functions/mngdServiceFunctions.php");
$managedServFunc = new managedServicesPlans();

if (isset($_POST['saveButton'])) {
    $result = $managedServFunc->savePlans();
    if ($result == 'success') {
        $managedServFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully saved'));
    }
    else
        $managedServFunc->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
}
$managedServicesPlans = $managedServFunc->getPricing();
$currencies = $managedServFunc->select($cfg['db_prefix'] . 'base_currency', '*', array('active' => 1));
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
$managedServices_plans = array();
if (is_array($managedServicesPlans)) {
    foreach ($managedServicesPlans as $managedSerPlan) {
        if (isset($managedSerPlan['id']) && $managedSerPlan['id'] == $id) {
            $managedServices_plans = $managedSerPlan;
        }
    }
}
?>

<div>
    <ul class="breadcrumb">
        <li><a href="<?= $cfg['admin_url']; ?>">Home</a> <span class="divider">/</span> </li>
        <li> <a href="#">Managed Services Plans</a> </li>
    </ul>
</div>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> Add Managed Services Plans</h2>
            <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
        </div>
        <div class="box-content">
            <?php
            echo $managedServFunc->getAlertMessage();
            ?>
            <form class="form-horizontal" name="managedServiceForm" id="managedServiceForm" method="post" action="">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="planType"><span>*</span>Plan Type</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($managedServices_plans['plan_type']) ? 'editfield' : ''; ?>" id="planType" name="planType" type="text" <?php echo isset($managedServices_plans['plan_type']) ? ' value="' . $managedServices_plans['plan_type'] . '"' : ''; ?> placeholder="Plan Type">
                                <input type="hidden" name="id" value="<?php echo isset($managedServices_plans['id']) ? $managedServices_plans['id'] : ''; ?>">
                            </div>
                        </div>
                    </div>


                    <div class="control-group">
                        <label class="control-label" for="planType"><span>*</span>Plan Name</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($managedServices_plans['plan_name']) ? 'editfield' : ''; ?>" id="planName" name="planName" type="text" <?php echo isset($managedServices_plans['plan_name']) ? ' value="' . $managedServices_plans['plan_name'] . '"' : ''; ?> placeholder="Plan Name">
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="silverPrice"><span>*</span>Silver pricing</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($managedServices_plans['silver_price']) ? 'editfield' : ''; ?>" id="silverPrice" name="silverPrice" type="text" <?php echo isset($managedServices_plans['silver_price']) ? ' value="' . $managedServices_plans['silver_price'] . '"' : ''; ?>  >
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="goldPrice"><span>*</span>Gold pricing</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($managedServices_plans['gold_price']) ? 'editfield' : ''; ?>" id="goldPrice" name="goldPrice" type="text" <?php echo isset($managedServices_plans['gold_price']) ? ' value="' . $managedServices_plans['gold_price'] . '"' : ''; ?>  >
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="platinumPrice"><span>*</span>Platinum pricing</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($managedServices_plans['platinum_price']) ? 'editfield' : ''; ?>" id="platinumPrice" name="platinumPrice" type="text" <?php echo isset($managedServices_plans['platinum_price']) ? ' value="' . $managedServices_plans['platinum_price'] . '"' : ''; ?>  >
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="titaniumPrice"><span>*</span>Titanium pricing</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($managedServices_plans['titanium_price']) ? 'editfield' : ''; ?>" id="titaniumPrice" name="titaniumPrice" type="text" <?php echo isset($managedServices_plans['titanium_price']) ? ' value="' . $managedServices_plans['titanium_price'] . '"' : ''; ?>  >
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label"><span>*</span>Currency Code</label>
                        <div class="controls">
                            <select data-placeholder="Select Currency Code" id="region" data-rel="chosen" name="currency_code">
                                <option value=""></option>
                                <?php foreach ($currencies as $currency) { ?>
                                    <option value="<?php echo $currency['currency_code']; ?>" <?php
                                    if (isset($managedServices_plans['currency_code']) && $managedServices_plans['currency_code'] == $currency['currency_code']) {
                                        echo 'selected';
                                    }
                                    ?>><?php echo $currency['currency_code']; ?></option>
                                        <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Status</label>
                        <div class="controls">
                            <label class="radio">
                                <div class="radio" id="uniform-optionsRadios1"><span class="checked"><input type="radio" name="planStatus" id="planStatus1" value="1" <?php echo (isset($managedServices_plans['active']) && $managedServices_plans['active'] == '1') ? 'checked="checked"' : ''; ?> style="opacity: 0;"></span></div>
                                Active
                            </label>
                            <div style="clear:both"></div>
                            <label class="radio">
                                <div class="radio" id="uniform-optionsRadios2"><span class=""><input type="radio" name="planStatus" id="planStatus2" value="0" <?php echo (isset($managedServices_plans['active']) && $managedServices_plans['active'] == '0') ? 'checked="checked"' : ''; ?> style="opacity: 0;"></span></div>
                                Inactive
                            </label>
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary" name="saveButton" id="saveButton" value="<?php echo isset($managedServices_plans['plan_type']) ? 'Edit' : 'Save'; ?>">
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
                        <th>Plan type</th>
                        <th>Plan Name</th>
                        <th>Silver Pricing/Hour</th>
                        <th>Gold Pricing/Hour</th>
                        <th>Platinum Pricing/Hour</th>
                        <th>Titanium Pricing/Hour</th>
                        <th>Currency Code</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($managedServicesPlans)) {
                        foreach ($managedServicesPlans as $managedSerPlan) {
                            ?>
                            <tr>
                                <td class="center"><a href="<?php echo $cfg['admin_url'] . $dir . '?page=managedservices&id=' . $managedSerPlan['id']; ?>"> <?php echo $managedSerPlan['plan_type']; ?></a></td>
                                <td class="center"><?php echo $managedSerPlan['plan_name']; ?></td>
                                <td class="center"><?php echo $managedSerPlan['silver_price']; ?></td>
                                <td class="center"><?php echo $managedSerPlan['gold_price']; ?></td>
                                <td class="center"><?php echo $managedSerPlan['platinum_price']; ?></td>
                                <td class="center"><?php echo $managedSerPlan['titanium_price']; ?></td>
                                <td class="center"><?php echo $managedSerPlan['currency_code']; ?></td>
                                <td class="center">     <?php echo ($managedSerPlan['active'] == '1') ? "<span class='label label-success'>Active</span>" : "<span class='label label-failure'>Inactive</span>"; ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr><td class="center">No Managed Service Plans Found</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--/span-->

</div>
