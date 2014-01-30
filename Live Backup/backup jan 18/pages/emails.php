<?php
/*
 * Created By: Manish Arora
 */
if ( ! defined('BASE_PATH')) exit('No direct script access allowed');
global $siteConfig;
$siteConfig->check_login();

$siteConfig->load_class('emailFunctions');  
    $emailFun = new emailFunctions();
    
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['saveButton']) && !empty($_POST['saveButton'])){        
        $result = $emailFun->addEmail();
        if ($result == 'success') {
            $siteConfig->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully saved'));
        }
        else{
            $siteConfig->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
        }    
     }
     else if(isset($_POST['editButton']) && !empty($_POST['editButton']) && ($_POST['id'] != '')){        
        $result = $emailFun->updateEmail();
        if ($result == 'success') {
            $siteConfig->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully updated.'));
        }
        else{
            $siteConfig->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
        }    
     }
}

$editid = '';
$editname = '';

if(isset($_GET['eid']) && !empty($_GET['eid'])){
   $editcat = $emailFun->getEmailByID($_GET['eid']);
   foreach($editcat as $edit){
       $editid = $edit['id'];
       $edituser = $edit['email_user'];
       $editname = $edit['site_name'];
   }
}

    $emails = $emailFun->getEmail();        
?> 
<!-- Form elements -->    
 <div class="container_12">
            <div class="grid_12">
            
                <div class="module">
                     <h2><span><?php echo (isset($editname) && $editname != '') ? 'Edit' : 'Add'; ?> Email Form</span></h2>                        
                     <div class="module-body">
                            <div>
                                <?php echo $siteConfig->getAlertMessage(TRUE); ?>
                            </div> 
                         <form action="" method="post" name="email_form" id="email_form" onsubmit="return validate_emailform();">
                            <p>
                               <label>Select Site</label>
                                <select name="site_id" id="site_id" class="input-short">
                                    <?php $sites = $emailFun->getSites(); 
                                    echo '<option value="">Select site</option>';
                                    if(is_array($sites)){
                                        foreach($sites as $site){
                                            if(($editid != '') && ($editid == $site['id'])){
                                                $select = 'selected = "selected"';
                                            }
                                            else
                                                $select = '';
                                            
                                           echo '<option value="'.$site['id'].'" '.$select.'>'.$site['site_name'].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                               <span id="selecterror"></span>
                            </p>
                            <p>
                                <label>Name:</label>
                                <input type="text" name="email_user" id="email_user" value="<?php echo (isset($edituser) && $edituser != '') ? $edituser : ''; ?>" class="input-short" />
                                <span id="emailusererror"></span>
                            </p>
                            <p>
                                <label>Email Address:</label>
                                <input type="text" name="email_id" id="email_id" value="<?php echo (isset($editname) && $editname != '') ? $editname : ''; ?>" class="input-short" />
                                <span id="emailerror"></span>
                            </p>
                            <div id="dynamic"></div>
                            <fieldset>
                                <input class="submit-green" type="submit" name="<?php echo (isset($editname) && $editname != '') ? 'editButton' : 'saveButton'; ?>" value="Save" id="saveButton" /> 
                                <input class="submit-gray" type="reset" value="Cancel" />
                            </fieldset>
                            <?php if(!isset($editname) && $editname == ''){ ?>
                            <input type="hidden" id="counttextbox" value="0" style="display:none;" />                            
                             <div class="float-right">
                                 <a style="cursor: pointer" onclick="addmore_category('email_id');" class="button">
                                        <span>Add More Emails<img src="<?php echo IMAGEPATH; ?>plus-small.gif" width="12" height="9" alt="New article" /></span>
                                </a>
                            </div>
                            <?php }else{ ?>
                                <input type="hidden" id="eid" name="id" value="<?php echo $editid; ?>" style="display:none;" /> 
                            <?php } ?>
                          </form>
                     </div> <!-- End .module-body -->

                </div>  <!-- End .module -->
        		<div style="clear:both;"></div>
            </div>

<div class="grid_12">

                <!-- Example table -->
                <div class="module">
                	<h2><span>Emails Listing</span></h2>
                    
                    <div class="module-table-body">
                    	<form action="">
                        <table id="myTable" class="tablesorter">
                        	<thead>
                                <tr>
                                    <th style="width:15%">#</th>
                                    <th style="width:20%">Name</th>
                                    <th style="width:20%">Email Address</th>
                                    <th style="width:20%">Site Url</th>
                                    <th style="width:21%">Add Date</th>
                                    <th style="width:13%">Status</th>                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                               <?php if(is_array($emails) && $emailFun->check_arrayempty($emails)){ 
                                   $i = 1;
                                   foreach($emails as $email){ ?>
                                <tr>
                                    <td class="align-center"><?php echo $i; ?></td>
                                    <td><?php echo $email['email_user']; ?></td>
                                    <td><?php echo $email['email_id']; ?></td>
                                    <td><?php  $sitename = $emailFun->getSites($email['site_id']); echo $sitename[0]['site_name']; ?></td>
                                    <td><?php echo date('Y-m-d',  strtotime($email['add_date'])); ?></td>
                                    <!--<td><?php ?></td>-->                                    
                                    <td>
                                    	<!--<input type="checkbox" />-->
                                        <a style="cursor:pointer;" onclick="statusChange('status<?php echo $i?>','<?php echo $email['id']; ?>','emailFunctions');"><img id="status<?php echo $i?>" src="<?php echo ($email['active']  != 0) ? IMAGEPATH.'tick-circle.gif' : IMAGEPATH.'minus-circle.gif'; ?>" width="16" height="16" alt="published" /></a>
                                        <!--<a href=""><img src="<?php echo IMAGEPATH; ?>pencil.gif" width="16" height="16" alt="edit" /></a>-->
                                    </td>
                                </tr>
                                   <?php $i++; } }else { echo '<tr><td>No Emails Found.</td></tr>'; } ?>
                            </tbody>
                        </table>
                        </form>
                        <?php if($emailFun->check_arrayempty($emails)){ ?>
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
                            <select class="input-medium" onchange="getvaluesByStatus(this.value,'emailFunctions')">
                                <option value="">Select action</option>
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            </div>
                            </form>
                        </div>
                        <?php } ?>
                        <div style="clear: both"></div>
                     </div> <!-- End .module-table-body -->
                </div> <!-- End .module -->                
			</div> <!-- End .grid_12 -->
                         <div style="clear:both;"></div>
 </div>


