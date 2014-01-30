<?php
if (!isset($_SESSION['role']['manage_blog_cat'])) {
    exit("You don't have permission to view this page!");
}
$adminFunc = new AdminFunctions();
$categorylist = $adminFunc->getCategoryList();
//echo '<pre>';var_dump($jobTitles); die;
//$languages=$adminFunc->select('cms_tbl_language');

if (isset($_POST['saveButton'])) {
    $result = $adminFunc->saveCategory();
    if ($result == 'success') {
        $adminFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully saved'));
        $categorylist = $adminFunc->getCategoryList();
    }
    else
        $adminFunc->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
}

if (isset($_POST['deleteCategory']) && isset($_POST['categoryIds'])) {
    if ($adminFunc->deleteCategory()) {
        $adminFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'Deleted Successfully'));
        $categorylist = $adminFunc->getCategoryList();
    }
    else
        $adminFunc->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
}

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
$categorydata = array();
foreach ($categorylist as $category) {
    if (isset($category['id']) && $category['id'] == $id) {
        $categorydata = $category;
    }
}
?>

<div>
    <ul class="breadcrumb">
        <li> <a href="<?= $cfg['admin_url']; ?>">Home</a> <span class="divider">/</span> </li>
        <li> <a href="module/?page=blog">Blogs</a> <span class="divider">/</span> </li>
        <li> <a href="#">Manage Category</a></li>
    </ul>
</div>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> <?php echo isset($categorydata['id']) ? 'Edit' : 'Add'; ?> Category</h2>
            <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
        </div>

        <div class="box-content">
            <?php
            echo $adminFunc->getAlertMessage();
            ?>
            <form class="form-horizontal" name="addCatForm" id="addCatForm" method="post" action="" style="margin-bottom:0px;">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="focusedInput"><span>*</span>Category Name</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($categorydata['catName']) ? 'editfield' : ''; ?>" id="catName" name="catName" type="text" <?php echo isset($categorydata['catName']) ? ' value="' . $categorydata['catName'] . '"' : ''; ?> placeholder="Category Name">
                                <input type="hidden" name="id" value="<?php echo isset($categorydata['id']) ? $categorydata['id'] : ''; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary" name="saveButton" id="saveButton" value="<?php echo isset($categorydata['catName']) ? 'Edit' : 'Save'; ?>">
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
            <h2><i class="icon-user"></i> Category List</h2>
            <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
        </div>
        <form name="deleteCat" id="deletecat" action="" method="post">
            <div class="box-content">
                <div class="page-header" style="margin:3px 0;">
                    <button class="btn btn-danger" type="submit" name="deleteCategory" id="deleteCategory"><i class="icon-trash icon-white"></i> Delete</button>
                </div>
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th><input id="checkAll" type="checkbox" value="" data-no-uniform="true"></th>
                            <th>Category Name</th>
                            <th>Created Date/Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categorylist as $category) { ?>
                            <tr>
                                <td><input id="inlineCheckbox" class="inlineCheckbox" type="checkbox" name="categoryIds[]" value="<?php echo $category['id']; ?>" data-no-uniform="true"></td>
                                <td class="center"><a href="<?php echo $cfg['admin_url'] . $dir . '?page=manageCategory&id=' . $category['id']; ?>"><?php echo $category['catName']; ?></a></td>
                                <td class="center"><?php echo $category['createdOn']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <!--/span-->

</div>