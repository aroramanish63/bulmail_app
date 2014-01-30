<?php
require_once($cfg['admin_path'] . "functions/pricingFunctions.php");
$pricingFunc = new PricingFunctions();

if (isset($_POST['saveButton'])) {
    $result = $pricingFunc->savePlans();
    if ($result == 'success') {
        $pricingFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully saved'));
    }
    else
        $pricingFunc->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
}
$pricingPlans = $pricingFunc->getPricing();

$currencies = $pricingFunc->select('tbl_base_currency');
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
$plans = array();
if (is_array($pricingPlans)) {
    foreach ($pricingPlans as $prPlans) {
        if (isset($prPlans['id']) && $prPlans['id'] == $id) {
            $plans = $prPlans;
        }
    }
}
?>

<div>
    <ul class="breadcrumb">
        <li> <a href="#">Home</a> <span class="divider">/</span> </li>
        <li> <a href="#">Pricing</a> </li>
    </ul>
</div>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> Add Pricing</h2>
            <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
        </div>
        <div class="box-content">
            <?php
            echo $pricingFunc->getAlertMessage();
            ?>
            <form class="form-horizontal" name="priceForm" id="priceForm" method="post" action="">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="serverName"><span>*</span>Server Name</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($plans['server_type']) ? 'editfield' : ''; ?>" id="serverName" name="serverName" type="text" <?php echo isset($plans['server_type']) ? ' value="' . $plans['server_type'] . '"' : ''; ?> placeholder="Server Name">
                                <input type="hidden" name="id" value="<?php echo isset($plans['id']) ? $plans['id'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="planName"><span>*</span>Plan Name</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($plans['type_name']) ? 'editfield' : ''; ?>" id="planName" name="planName" type="text" <?php echo isset($plans['type_name']) ? ' value="' . $plans['type_name'] . '"' : ''; ?> placeholder="Plan Name">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="vcpu"><span>*</span>vCPU</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($plans['vcpu']) ? 'editfield' : ''; ?>" id="vcpu" name="vcpu" type="text" <?php echo isset($plans['vcpu']) ? ' value="' . $plans['vcpu'] . '"' : ''; ?> placeholder="vCPU">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="ram"><span>*</span>RAM</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($plans['ram']) ? 'editfield' : ''; ?>" id="ram" name="ram" type="text" <?php echo isset($plans['ram']) ? ' value="' . $plans['ram'] . '"' : ''; ?> placeholder="RAM">
                            </div>
                        </div>
                    </div><div class="control-group">
                        <label class="control-label" for="storage"><span>*</span>Storage</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($plans['storage']) ? 'editfield' : ''; ?>" id="storage" name="storage" type="text" <?php echo isset($plans['storage']) ? ' value="' . $plans['storage'] . '"' : ''; ?> placeholder="Storage">
                            </div>
                        </div>
                    </div><div class="control-group">
                        <label class="control-label" for="ip"><span>*</span>IP's</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($plans['ips']) ? 'editfield' : ''; ?>" id="ip" name="ip" type="text" <?php echo isset($plans['ips']) ? ' value="' . $plans['ips'] . '"' : ''; ?> placeholder="IP">
                            </div>
                        </div>
                    </div><div class="control-group">
                        <label class="control-label" for="dataTransfer"><span>*</span>Data Transfer</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($plans['data_transfer']) ? 'editfield' : ''; ?>" id="dataTransfer" name="dataTransfer" type="text" <?php echo isset($plans['data_transfer']) ? ' value="' . $plans['data_transfer'] . '"' : ''; ?> placeholder="Data Transfer">
                            </div>
                        </div>
                    </div><div class="control-group">
                        <label class="control-label" for="hourlyRate" ><span>*</span>Hourly Rate</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($plans['hrly']) ? 'editfield' : ''; ?>" id="hourlyRate" name="hourlyRate" type="text" <?php echo isset($plans['hrly']) ? ' value="' . $plans['hrly'] . '"' : ''; ?> placeholder="Hourly Rate">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="monthlyRate"><span>*</span>Monthly Rate</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($plans['mnthly']) ? 'editfield' : ''; ?>" id="monthlyRate" name="monthlyRate" type="text" <?php echo isset($plans['mnthly']) ? ' value="' . $plans['mnthly'] . '"' : ''; ?> placeholder="Monthly Rate">
                            </div>
                        </div>
                    </div>



                    <div class="control-group">
                        <label class="control-label" for="siteRegion_parent"><span>*</span>Currency</label>
                        <div class="controls">
                            <select data-placeholder="Select Page Parent"   data-rel="chosen" name="currency"  <?php echo isset($plans['currency_code']) ? 'class="editfield"' : ''; ?>>
                                <option value=""></option>
                                <?php foreach ($currencies as $currency) { ?>
                                    <option value="<?php echo $currency['currency_code'] ?>" <?php echo isset($plans['currency_code']) && $currency['currency_code'] == $plans['currency_code'] ? 'selected' : ''; ?>><?php echo $currency['currency_code'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="monthlyRate"><span>*</span>Plan Link</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <textarea name="plan_link" <?php echo isset($plans['plan_link']) ? 'class="editfield"' : ''; ?>><?php echo isset($plans['plan_link']) ? $plans['plan_link'] : ''; ?></textarea>

                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Status</label>
                        <div class="controls">
                            <label class="radio">
                                <div class="radio" id="uniform-optionsRadios1"><span class="checked"><input type="radio" name="planStatus" id="planStatus1" value="1" <?php echo (isset($plans['active']) && $plans['active'] == '1') ? 'checked="checked"' : ''; ?> style="opacity: 0;"></span></div>
                                Active
                            </label>
                            <div style="clear:both"></div>
                            <label class="radio">
                                <div class="radio" id="uniform-optionsRadios2"><span class=""><input type="radio" name="planStatus" id="planStatus2" value="0" <?php echo (isset($plans['active']) && $plans['active'] == '0') ? 'checked="checked"' : ''; ?> style="opacity: 0;"></span></div>
                                Inactive
                            </label>
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary" name="saveButton" id="saveButton" value="<?php echo isset($plans['server_type']) ? 'Edit' : 'Save'; ?>">
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
                        <th><input type="checkbox" id="check_all" value="option1"></th>
                        <th>Plan Name</th>
                        <th>Server Type</th>
                        <th>vCPU</th>
                        <th>RAM</th>
                        <th>Storage</th>
                        <th>IP's</th>
                        <th>Data Transfer</th>
                        <th>Hourly Rate</th>
                        <th>Monthly Rate</th>
                        <th>Currency</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($pricingPlans)) {
                        foreach ($pricingPlans as $prPlans) {
                            ?>
                            <tr>
                                <td><input type="checkbox" name="languages[]" value="<?php echo $prPlans['id']; ?>"></td>
                                <td class="center"><a href="<?php echo $cfg['admin_url'] . $dir . '?page=addpricing&id=' . $prPlans['id']; ?>"><?php echo $prPlans['type_name']; ?></a></td>
                                <td class="center"><?php echo $prPlans['server_type']; ?></td>
                                <td class="center"><?php echo $prPlans['vcpu']; ?></td>
                                <td class="center"><?php echo $prPlans['ram']; ?></td>
                                <td class="center"><?php echo $prPlans['storage']; ?></td>
                                <td class="center"><?php echo $prPlans['ips']; ?></td>
                                <td class="center"><?php echo $prPlans['data_transfer']; ?></td>
                                <td class="center"><?php echo $prPlans['hrly']; ?></td>
                                <td class="center"><?php echo $prPlans['mnthly']; ?></td>
                                <td class="center"><?php echo $prPlans['currency_code']; ?></td>
                                <td class="center">     <?php echo ($prPlans['active'] == '1') ? "<span class='label label-success'>Active</span>" : "<span class='label label-failure'>Inactive</span>"; ?>
                                </td>
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr><td class="center">No Pricing Found</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--/span-->

</div>
