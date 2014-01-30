<?php 
if ( ! defined('BASE_PATH')) exit('No direct script access allowed');
global $siteConfig;
$siteConfig->check_login();

$siteConfig->load_class('subcategoriesFunctions');  
    $cateFun = new subcategoriesFunctions();
    
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['saveButton']) && !empty($_POST['saveButton'])){        
        $result = $cateFun->addsubCategories();
        if ($result == 'success') {
            $siteConfig->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully saved'));
        }
        else
            $siteConfig->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
        }
         else if(isset($_POST['editButton']) && !empty($_POST['editButton']) && ($_POST['id'] != '')){    
            
            $result = $cateFun->updatesubCategories();
            if ($result == 'success') {
                $siteConfig->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully updated.'));
            }
            else{
                $siteConfig->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
            }    
        }
}

$editcatid = '';
$editid = '';
$editname = '';

if(isset($_GET['sid']) && !empty($_GET['sid'])){
   $editcat = $cateFun->getsubCategoriesByID($_GET['sid']);
   foreach($editcat as $edit){
       $editcatid = $edit['cat_id'];
       $editid = $edit['id'];
       $editname = $edit['subcat_name'];
   }
}
    $categories = $cateFun->getsubCategories();
?> 
<!-- Form elements -->    
 <div class="container_12">
            <div class="grid_12">
            
                <div class="module">
                     <h2><span><?php echo (isset($editname) && $editname != '') ? 'Edit' : 'Add'; ?> Sub Categories Form</span></h2>                        
                     <div class="module-body">
                            <div>
                                <?php echo $siteConfig->getAlertMessage(TRUE); ?>
                            </div> 
                         <form action="" method="post" name="sub_categories" id="sub_categories" onsubmit="return validate_subcatform();">       
                           <p>
                               <label>Select Main Category</label>
                                <select name="cat_id" id="cat_id" class="input-short">
                                    <?php $main_cat = $cateFun->getmainCategory(); 
                                    echo '<option value="">Select Category</option>';
                                    if(is_array($main_cat)){
                                        foreach($main_cat as $cate){
                                            if(($editcatid != '') && ($editcatid == $cate['id'])){
                                                $select = 'selected = "selected"';
                                            }
                                            else
                                                $select = '';
                                            
                                           echo '<option value="'.$cate['id'].'" '.$select.'>'.$cate['cate_name'].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                               <span id="caterror"></span>
                            </p>
                            <p>
                                <label>Sub Category:</label>
                                <input type="text" name="subcat_name" id="subcat_name" value="<?php echo (isset($editname) && $editname != '') ? $editname : ''; ?>" class="input-short" />
                                <span id="subcaterror"></span>
                            </p>
                            <div id="dynamic"></div>
                            <fieldset>
                                <input class="submit-green" type="submit" value="Save" name="<?php echo (isset($editname) && $editname != '') ? 'editButton' : 'saveButton'; ?>" id="saveButton" /> 
                                <input class="submit-gray" type="reset" value="Cancel" />
                            </fieldset>
                            <?php if(!isset($editname) && $editname == ''){ ?>
                            <input type="hidden" id="counttextbox" value="0" style="display:none;" />                            
                             <div class="float-right">
                                 <a style="cursor: pointer" onclick="addmore_category('cate_name');" class="button">
                                        <span>Add More Category<img src="<?php echo IMAGEPATH; ?>plus-small.gif" width="12" height="9" alt="New article" /></span>
                                </a>
                            </div>
                            <?php }else{ ?>
                                <input type="hidden" id="sid" name="id" value="<?php echo $editid; ?>" style="display:none;" /> 
                            <?php } ?>
                          </form>
                     </div> <!-- End .module-body -->

                </div>  <!-- End .module -->
        		<div style="clear:both;"></div>
            </div>

<div class="grid_12">

                <div class="module">
                	<h2><span>Sub Categories Listing</span></h2>
                    
                    <div class="module-table-body">
                    	<form action="">
                        <table id="myTable" class="tablesorter">
                        	<thead>
                                <tr>
                                    <th style="width:15%">#</th>
                                    <th style="width:20%">Category Name</th>
                                    <th style="width:20%">Sub-category Name</th>
                                    <th style="width:21%">Add Date</th>
                                    <!--<th style="width:15%">Sub Category Count</th>-->
                                    <th style="width:13%">Status</th>                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                               <?php if(is_array($categories)){ 
                                   $i = 1;
                                   foreach($categories as $category){ ?>
                                <tr>
                                    <td class="align-center"><?php echo $i; ?></td>
                                    <td><a href="?page=categories&cid=<?php echo $category['cat_id']; ?>"><?php echo $cateFun->getmainCategory_name($category['cat_id']); ?></a></td>
                                    <td><a href="?page=subcategory&sid=<?php echo $category['id']; ?>"><?php echo $category['subcat_name']; ?></a></td>
                                    <td><?php echo date('Y-m-d',  strtotime($category['add_date'])); ?></td>
                                    <!--<td><?php ?></td>-->                                    
                                    <td>
                                    	<!--<input type="checkbox" />-->
                                        <a style="cursor:pointer;" onclick="statusChange('status<?php echo $i?>','<?php echo $category['id']; ?>','subcategoriesFunctions');"><img id="status<?php echo $i?>" src="<?php echo ($category['active']  != 0) ? IMAGEPATH.'tick-circle.gif' : IMAGEPATH.'minus-circle.gif'; ?>" width="16" height="16" alt="published" /></a>
                                        <!--<a href=""><img src="<?php echo IMAGEPATH; ?>pencil.gif" width="16" height="16" alt="edit" /></a>-->
                                    </td>
                                </tr>
                                   <?php $i++; } }else { echo '<td>No Sub-category Found.</td>'; } ?>
                            </tbody>
                        </table>
                        </form>
                        <div class="pager" id="pager">
                            <form action="">
                                <div>
                                <img class="first" src="<?php echo IMAGEPATH; ?>arrow-stop-180.gif" tppabs="http://www.xooom.pl/work/magicadmin/<?php echo IMAGEPATH; ?>arrow-stop-180.gif" alt="first"/>
                                <img class="prev" src="<?php echo IMAGEPATH; ?>arrow-180.gif" tppabs="http://www.xooom.pl/work/magicadmin/<?php echo IMAGEPATH; ?>arrow-180.gif" alt="prev"/> 
                                <input type="text" class="pagedisplay input-short align-center"/>
                                <img class="next" src="<?php echo IMAGEPATH; ?>arrow.gif" tppabs="http://www.xooom.pl/work/magicadmin/<?php echo IMAGEPATH; ?>arrow.gif" alt="next"/>
                                <img class="last" src="<?php echo IMAGEPATH; ?>arrow-stop.gif" tppabs="http://www.xooom.pl/work/magicadmin/<?php echo IMAGEPATH; ?>arrow-stop.gif" alt="last"/> 
                                <select class="pagesize input-short align-center">
                                    <option value="10" selected="selected">10</option>
                                    <option value="20">20</option>
                                    <option value="30">30</option>
                                    <option value="40">40</option>
                                </select>
                                </div>
                            </form>
                        </div>
                        <div class="table-apply">
                            <form action="">
                            <div>
                            <span>Apply action to selected:</span> 
                            <select class="input-medium" onchange="getvaluesByStatus(this.value,'getRecordsByStatus','subcategoriesFunctions')">
                                <option value="">Select action</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            </div>
                            </form>
                        </div>
                        <div style="clear: both"></div>
                     </div> <!-- End .module-table-body -->
                </div> <!-- End .module -->                
			</div> <!-- End .grid_12 -->
                         <div style="clear:both;"></div>
 </div>