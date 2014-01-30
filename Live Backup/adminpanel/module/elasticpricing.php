<?php
if (!isset($_SESSION['role']['plans'])) {
    exit("You don't have permission to view this page!");
}
require_once($cfg['admin_path'] . "functions/elasticPlanFunctions.php");
$elasticFunc = new elasticPlans();

if (isset($_POST['saveButton'])) {
    $result = $elasticFunc->savePlans();
    if ($result == 'success') {
        $elasticFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully saved'));
    }
    else
        $elasticFunc->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
}
$elasticPlans = $elasticFunc->getPricing();
$field = isset($_REQUEST['field']) ? $_REQUEST['field'] : 0;
$eplans = array();
if (is_array($elasticPlans)) {
    foreach ($elasticPlans as $elPlans) {
        if (isset($elPlans[$field])) {
            $eplans[$elPlans['currency_code']][$elPlans['plan_property']] = $elPlans[$field];
        }
    }
}
?>

<div>
    <ul class="breadcrumb">
        <li> <a href="<?= $cfg['admin_url']; ?>">Home</a> <span class="divider">/</span> </li>
        <li> <a href="#">Elastic cloud Plans</a> </li>
    </ul>
</div>

<?php
if (isset($eplans) && count($eplans) > 0) {
    ?>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i> Add Elastic Cloud Plans</h2>
                <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
            </div>
            <div class="box-content">
                <?php
                echo $elasticFunc->getAlertMessage();
                ?>
                <form class="form-horizontal" name="elasticForm" id="elasticForm" method="post" action="">
                    <fieldset>
                        <?php
                        foreach ($eplans as $key => $value) {
                            ?>
                            <div class="control-group">
                                <h2> Plan -(<?php echo $key . ')' . $value[""]; ?></h2>
                                <label class="control-label" for="serverName"><span>*</span>Plan Link</label>
                                <div class="controls">
                                    <div class="fieldDiv">
                                        <textarea class="editfield" name="plan_link[<?php echo strtolower($key); ?>]" style="width: 100%"><?php echo $value['plan_link']; ?></textarea>
                                        <input type="hidden" name="plan_name" value="<?php echo $field; ?>" />

                                    </div>
                                </div>
                            </div>
                            <?php
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
                <tr>
                    <th>Plan Property</th>
                    <th>Server Type</th>
                    <th><a href="<?php echo $cfg['admin_url'] . $dir . '?page=elasticpricing&field=plan_2000'; ?>"> Rs 2000</a></th>
                    <th><a href="<?php echo $cfg['admin_url'] . $dir . '?page=elasticpricing&field=plan_5000'; ?>"> Rs 5000</a></th>
                    <th><a href="<?php echo $cfg['admin_url'] . $dir . '?page=elasticpricing&field=plan_10000'; ?>"> Rs 10000</a></th>
                    <th><a href="<?php echo $cfg['admin_url'] . $dir . '?page=elasticpricing&field=plan_25000'; ?>"> Rs 25000</a></th>
                    <th><a href="<?php echo $cfg['admin_url'] . $dir . '?page=elasticpricing&field=plan_50000'; ?>"> Rs 50000</a></th>
                </tr>
                <?php
                if (is_array($elasticPlans)) {
                    foreach ($elasticPlans as $elPlans) {
                        ?>
                        <tr>
                            <td class="center"><?php echo $elPlans['plan_property']; ?></td>
                            <td class="center"><?php echo $elPlans['plan_server_type']; ?></td>
                            <td class="center"><?php echo $elPlans['plan_2000']; ?></td>
                            <td class="center"><?php echo $elPlans['plan_5000']; ?></td>
                            <td class="center"><?php echo $elPlans['plan_10000']; ?></td>
                            <td class="center"><?php echo $elPlans['plan_25000']; ?></td>
                            <td class="center"><?php echo $elPlans['plan_50000']; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr><td class="center">No Pricing Found</td></tr>
                <?php } ?>
            </table>
        </div>
    </div>
    <!--/span-->

</div>
