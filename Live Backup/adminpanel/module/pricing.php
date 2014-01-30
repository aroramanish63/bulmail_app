<?php
if (!isset($_SESSION['role']['plans'])) {
    exit("You don't have permission to view this page!");
}
require_once($cfg['admin_path'] . "functions/fixedPricingFunctions.php");
$pricingFunc = new fixedPricingFunctions();
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
$planame = isset($_GET['plan_name']) ? $_GET['plan_name'] : "";
$ser_type = isset($_GET['servertype']) ? $_GET['servertype'] : "";
if (isset($_POST['saveButton'])) {
    $result = $pricingFunc->saveFixedPlan();
    if ($result == 'success') {
        $pricingFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully saved'));
    }
    else
        $pricingFunc->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
}
$pricingPlans = $pricingFunc->getFixedplanName();

$allPlansByCurr = $pricingFunc->getallPlansbyCurr($planame);
$currencies = $pricingFunc->select($cfg['db_prefix'] . 'base_currency');
?>

<div>
    <ul class="breadcrumb">
        <li> <a href="<?= $cfg['admin_url']; ?>">Home</a> <span class="divider">/</span> </li>
        <li> <a href="#">Edit  Fixed Pricing</a> </li>
    </ul>
</div>
<?php if (isset($planame) && $planame != '') { ?>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i>Edit Fixed Pricing</h2>
                <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
            </div>
            <div class="box-content">
                <?php
                echo $pricingFunc->getAlertMessage();
                ?>
                <form class="form-horizontal" name="priceForm" id="priceForm" method="post" action="">
                    <?php
                    if (is_array($allPlansByCurr)) {
                        foreach ($allPlansByCurr as $prPlans) {
                            ?>
                            <div class="tooltip-demo well">
                                <h2><?php echo $planame . ' - ' . $prPlans['server_type'] . " (" . $prPlans['currency_code'] . ")"; ?></h2>
                                <p class="muted" style="margin-bottom: 0;">

                                <div class="control-group">
                                    <label class="control-label" for="hourlyRate" ><span>*</span>Hourly Rate</label>
                                    <div class="controls">
                                        <div class="fieldDiv">
                                            <input class="input-xlarge focused <?php echo isset($prPlans['hrly']) ? 'editfield' : ''; ?>" id="hourlyRate" name="price[<?php echo $prPlans['id'] . "][hrly]"; ?>" type="text" <?php echo isset($prPlans['hrly']) ? ' value="' . $prPlans['hrly'] . '"' : ''; ?> placeholder="Hourly Rate">
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" for="monthlyRate"><span>*</span>Monthly Rate</label>
                                    <div class="controls">
                                        <div class="fieldDiv">
                                            <input class="input-xlarge focused <?php echo isset($prPlans['mnthly']) ? 'editfield' : ''; ?>" id="monthlyRate" name="price[<?php echo $prPlans['id'] . "][mnthly"; ?>]" type="text" <?php echo isset($prPlans['mnthly']) ? ' value="' . $prPlans['mnthly'] . '"' : ''; ?> placeholder="Monthly Rate">
                                        </div>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label" for="monthlyRate"><span>*</span>Plan Link</label>
                                    <div class="controls">
                                        <div class="fieldDiv">
                                            <textarea name="price[<?php echo $prPlans['id'] . "][plan_link"; ?>]" <?php echo isset($prPlans['plan_link']) ? 'class="editfield"' : ''; ?> style="width:100%;"><?php echo isset($prPlans['plan_link']) ? $prPlans['plan_link'] : ''; ?></textarea>

                                        </div>
                                    </div>
                                </div>

                                </p>
                            </div>

                            <?php
                        }
                    }
                    ?>
                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary" name="saveButton" id="saveButton" value="<?php echo isset($prPlans['server_type']) ? 'Edit' : 'Save'; ?>">
                        <input type="button" class="btn" name="cancel" value="Cancel">
                    </div>
                </form>
            </div>
        </div>
        <!--/span-->

    </div>
    <!--/row-->
    <?php
}
?>
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
                        <th>Plan Name</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($pricingPlans)) {
                        foreach ($pricingPlans as $prPlans) {
                            ?>
                            <tr>
                                <td class="center"><a href="<?php echo $cfg['admin_url'] . $dir . '?page=pricing&plan_name=' . $prPlans['type_name'] . '&id=' . $prPlans['id'] . '&servertype=' . $prPlans['server_type']; ?>"><?php echo $prPlans['type_name']; ?></a></td>
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
