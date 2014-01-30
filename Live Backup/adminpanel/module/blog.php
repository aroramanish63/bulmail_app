<?php
if (!isset($_SESSION['role']['blog'])) {
    exit("You don't have permission to view this page!");
}
date_default_timezone_set('Asia/Kolkata');
//$cfg['db_host'] = '103.10.189.53';
//$cfg['db_port'] = '';
//$cfg['db_name'] = 'databagg_unstruct';
//$cfg['db_user'] = 'databagg_data';
//$cfg['db_pass'] = 'c4#ZL1D)+w7o';
$adminFunc = new AdminFunctions();
$blogs = $adminFunc->getBlogs();
//echo '<pre>';var_dump($jobTitles); die;

$languages = $adminFunc->select($cfg['db_prefix'] . 'language');

if (isset($_POST['saveButton'])) {
    $result = $adminFunc->saveBlog();
    if ($result == 'success') {
        $adminFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully saved'));
        $blogs = $adminFunc->getBlogs();
    }
    else
        $adminFunc->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
}

if (isset($_POST['deleteBlog']) && isset($_POST['blogIds'])) {
    if ($adminFunc->deleteBlog()) {
        $adminFunc->setAlertMessage(array('err_type' => 'success', 'msg' => 'Deleted Successfully'));
        $blogs = $adminFunc->getBlogs();
    }
    else
        $adminFunc->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
}

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
$blogContent = array();
foreach ($blogs as $blog) {
    if (isset($blog['id']) && $blog['id'] == $id) {
        $blogContent = $blog;
    }
}
?>

<div>
    <ul class="breadcrumb">
        <li> <a href="<?= $cfg['admin_url']; ?>">Home</a> <span class="divider">/</span> </li>
        <li> <a href="module/?page=blog">Blog</a> </li>
    </ul>
</div>
<div class="row-fluid sortable">
    <div class="box span12">
        <div class="box-header well" data-original-title>
            <h2><i class="icon-user"></i> <?php echo isset($blogContent['id']) ? 'Edit' : 'Add'; ?> Blog</h2>
            <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
        </div>
        <div class="box-content">
            <a class="btn btn-info" href="module/?page=manageCategory">
                <i class="icon-info-sign icon-white"></i>
                Manage Category
            </a>
        </div>
        <div class="box-content">
            <?php
            echo $adminFunc->getAlertMessage();
            ?>
            <form class="form-horizontal" name="blogForm" id="blogForm" method="post" action="" enctype="multipart/form-data">
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="focusedInput"><span>*</span> Blog Language</label>
                        <div class="controls">
                            <select data-placeholder="Select Language to publish" id="selectError2" data-rel="chosen" name="language">
                                <option value=""></option>
                                <?php foreach ($languages as $language) {
                                    ?>
                                    <option value="<?php echo $language['id']; ?>" <?php
                                    if (isset($blogContent['langid']) && ($language['id'] == $blogContent['langid'])) {
                                        echo 'selected="selected"';
                                    }
                                    ?>><?php echo $language['language']; ?></option>
                                        <?php }
                                        ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="focusedInput"><span>*</span> Blog Title</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="input-xlarge focused <?php echo isset($blogContent['title']) ? 'editfield' : ''; ?>" id="blogTitle" name="blogTitle" type="text" <?php echo isset($blogContent['title']) ? ' value="' . $blogContent['title'] . '"' : ''; ?> placeholder="Blog Title">
                                <input type="hidden" name="id" value="<?php echo isset($blogContent['id']) ? $blogContent['id'] : ''; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="focusedInput"><span>*</span> Blog Categoty</label>
                        <div class="controls">
                            <?php $blogCategories = $adminFunc->select($cfg['db_prefix'] . 'blog_category'); ?>
                            <select id="selectBlogCat" name="blogCategory" class="<?php echo isset($blogContent['categoryId']) ? 'editfield' : ''; ?>">
                                <option value="">Select</option>
                                <?php foreach ($blogCategories as $blogCategory) {
                                    ?>
                                    <option value="<?php echo $blogCategory['id']; ?>" <?php
                                    if (isset($blogContent['categoryId']) && ($blogCategory['id'] == $blogContent['categoryId'])) {
                                        echo 'selected="selected"';
                                    }
                                    ?>><?php echo $blogCategory['catName']; ?></option>
                                        <?php }
                                        ?>
                            </select>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="focusedInput"><span>*</span> Blog Content</label>
                        <div class="controls">
                            <textarea class="cleditor editfield " name="blogcontent" id="blogcontent" rows="3"><?php echo isset($blogContent['content']) ? $blogContent['content'] : ''; ?></textarea>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="focusedInput"> Image</label>
                        <div class="controls">
                            <div class="fieldDiv">
                                <input class="<?php echo isset($blogContent['id']) ? 'editfield' : ''; ?>" name="uploadedFile" id="uploadedFile" type="file" >
                                <?php
                                if (isset($blogContent['blogImage']) && $blogContent['blogImage'] != "") {
                                    //echo '<img src="../articleimages/thumbs/'.$blogContent['blogImage'].'" width="50">';
                                    echo '<img src="../articleimages/' . $blogContent['blogImage'] . '" width="50">';
                                }
                                ?>
                            </div>
                            <div id="errorUpload"></div>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label" for="focusedInput"> Publish</label>
                        <div class="controls">
                            <select id="publish" name="publish" class="<?php echo isset($blogContent['status']) ? 'editfield' : ''; ?>">
                                <?php
                                $selected = "";
                                if (isset($blogContent['status']) && $blogContent['status'] == 0) {
                                    $selected = "selected";
                                }
                                ?>
                                <option value="1">Yes</option>
                                <option value="0" <?php echo $selected; ?>>No</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary" name="saveButton" id="saveButton" value="<?php echo isset($blogContent['title']) ? 'Edit' : 'Save'; ?>">
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
            <h2><i class="icon-user"></i> Blogs List</h2>
            <div class="box-icon"> <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a> <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a> </div>
        </div>
        <form name="deleteBlog" id="deleteBlog" action="" method="post">
            <div class="box-content">
                <div class="page-header" style="margin:3px 0 5px 0px; padding-bottom:7px;">
                    <?php if ($id != 0) { ?>
                        <a class="btn btn-success" href="module/?page=blog">
                            <i class="icon-plus icon-white"></i>
                            Add New
                        </a>
                    <?php } ?>
                    <button class="btn btn-danger" type="submit" name="deleteBlog" id="deleteBlog"><i class="icon-trash icon-white"></i> Delete</button>
                </div>
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll" value="" data-no-uniform="true"></th>
                            <th>Blog Title</th>
                            <th>Blog Category</th>
                            <th>Language</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($blogs as $blog) { ?>
                            <tr>
                                <td><input id="inlineCheckbox" class="inlineCheckbox" type="checkbox" name="blogIds[]" value="<?php echo $blog['id']; ?>" data-no-uniform="true"></td>
                                <td class="center"><a href="<?php echo $cfg['admin_url'] . $dir . '?page=blog&id=' . $blog['id']; ?>"><?php echo $blog['title']; ?></a></td>
                                <td class="center"><?php echo $adminFunc->getBlogCatName($blog['categoryId']); ?></td>
                                <td class="center"><?php echo $adminFunc->getLanguageName($blog['langid']); ?></td>
                                <td class="center"><?php
                                    if ($blog['status'] == 1) {
                                        echo 'Publish';
                                    }
                                    else
                                        echo 'Not Publish';
                                    ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <!--/span-->

</div>
