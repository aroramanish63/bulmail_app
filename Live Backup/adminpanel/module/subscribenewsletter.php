<?php
require_once($cfg['admin_path'] . "functions/subscribenewsletterFunctions.php");
$subsNewsletterFunc = new subscribenewsletter();

if (isset($_POST['saveButton'])) {
    $result = $subsNewsletterFunc->saveSubscribers();
    if ($result == 'success') {
        $subsNewsletterFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully saved'));
    }
    else
        $subsNewsletterFunc->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
}
$subscribe_newsletter = $subsNewsletterFunc->getSubscribersNewletters();
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
$subs_emailsr = array();
if (is_array($subscribe_newsletter)) {
    foreach ($subscribe_newsletter as $subscbnewsletter) {
        if (isset($subscbnewsletter['id']) && $subscbnewsletter['id'] == $id) {
            $subs_newsletter = $subscbnewsletter;
        }
    }
}
?>

<?php
echo $subsNewsletterFunc->getAlertMessage();
?>
<div>
    <ul class="breadcrumb">
        <li> <a href="<?= $cfg['admin_url']; ?>">Home</a> <span class="divider">/</span> </li>
        <li> <a href="#">Subscribe Newsletter</a> </li>
    </ul>
</div>
<?php if (isset($subs_newsletter['email_id'])) {
    ?>
    <div class="row-fluid sortable">
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-user"></i> Edit  Subscriber</h2>
                <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
            </div>
            <div class="box-content">
                <form class="form-horizontal" name="subscriberForm" enctype="multipart/form-data" id="currForm" method="post" action="">
                    <fieldset>
                        <div class="control-group">
                            <label class="control-label" for="emailsubscriber"><span>*</span>Select Emails  </label>
                            <div class="controls">
                                <input class="input-xlarge focused <?php echo isset($subs_newsletter['email_id']) ? 'editfield' : ''; ?>" id="subscribe_email" name="subscribe_email" type="text" placeholder="" <?php echo isset($subs_newsletter['email_id']) ? 'value="' . $subs_newsletter['email_id'] . '"' : ''; ?> />


                                <input type="hidden" name="id" value="<?php echo isset($subs_newsletter['id']) ? $subs_newsletter['id'] : ''; ?>">

                            </div>

                        </div>



                        <div class="control-group">
                            <label class="control-label" ><span>*</span>Active</label>
                            <div class="controls">
                                <label class="radio">
                                    <div class="radio" id="uniform-optionsRadios1"><span class="checked">
                                            <input type="radio" name="base_active"   id="base_active" value="1" <?php echo isset($subs_newsletter['active']) && $subs_newsletter['active'] == '1' ? 'checked' : ''; ?> style="opacity: 0;"  <?php echo isset($subs_newsletter['active']) ? 'class="editfield"' : ''; ?>></span></div>
                                    Yes
                                </label>
                                <div style="clear:both"></div>
                                <label class="radio" >
                                    <div class="radio" id="uniform-optionsRadios2"><span class="">
                                            <input type="radio" name="base_active" id="base_inactive" value="0" <?php echo isset($subs_newsletter['active']) && $subs_newsletter['active'] == '0' ? 'checked' : ''; ?> style="opacity: 0;"  <?php echo isset($subs_newsletter['active']) ? 'class="editfield"' : ''; ?>></span></div>
                                    No
                                </label>
                            </div>
                        </div>
                        <div class="form-actions">
                            <input type="submit" class="btn btn-primary" name="saveButton" id="saveButton" value="<?php echo isset($subs_newsletter['id']) ? 'Edit' : 'Save'; ?>">
                            <input type="button" class="btn" name="cancel" value="Cancel">
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <!--/span-->

    </div>
    <!--/row-->
    <?
}
?>

<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i>Subscribers List</h2>
            <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
        </div>
        <div class="box-content">
            <table class="table table-striped table-bordered bootstrap-datatable datatable">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="check_all" value="option1"></th>
                        <th>Email Id</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (is_array($subscribe_newsletter)) {
                        foreach ($subscribe_newsletter as $subscbnewsletter) {
                            ?>
                            <tr>
                                <td><input type="checkbox" name="emailId[]" value="<?php echo $subscbnewsletter['id']; ?>"></td>
                                <td class="center"><a href="<?php echo $cfg['admin_url'] . $dir . '?page=subscribenewsletter&id=' . $subscbnewsletter['id']; ?>"><?php echo $subscbnewsletter['email_id']; ?></a></td>
                                <td class="center"><?php echo ($subscbnewsletter['active'] == '1') ? "<span class='label label-success'>Active</span>" : "<span class='label'>Inactive</span>"; ?>
                                </td>

                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <tr><td class="center">No Subscribers Found</td></tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!--/span-->

</div>
