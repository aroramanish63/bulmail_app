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
        if ($result) {
             if(!@header('Location:'.SITE_URL.'?page=emails')){
                    echo '<script type="text/javascript">location.href = "'.SITE_URL.'?page=emails";</script>';
                }                
                exit();            
        }    
     }
     else if(isset($_POST['editButton']) && !empty($_POST['editButton']) && ($_POST['id'] != '')){        
        $result = $emailFun->updateEmail();
        if ($result == 'success') {
             if(!@header('Location:'.SITE_URL.'?page=emails')){
                    echo '<script type="text/javascript">location.href = "'.SITE_URL.'?page=emails";</script>';
                }
                exit();
            $siteConfig->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully updated.'));
        }
        else{
            $siteConfig->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
        }    
     }
}

$editid = '';
$editname = '';
$edituser = '';
$editphn = '';
$remarks = '';
$editsite = '';
$editemail = '';

if(isset($_GET['eid']) && !empty($_GET['eid'])){
   $editcat = $emailFun->getEmailByID($_GET['eid']);
   foreach($editcat as $edit){
       $editid = $edit['id'];
       $editsite = $edit['site_id'];
       $editemail = $edit['email_id'];
       $edituser = $edit['email_user'];
       $editclient = $edit['client_type_id'];
       $editphn = $edit['phone'];
       $remarks = $edit['remarks'];
   }
}

    $emails = $emailFun->getEmail();        
?>

<!-- Form elements -->    
 <div class="container_12">
            <div class="grid_12">
            
                <div class="module">
                     <h2><span><?php echo (isset($edituser) && $edituser != '') ? 'Edit' : 'Add'; ?> Email Form</span></h2>                        
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
                                            if(($editsite != '') && ($editsite == $site['id'])){
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
                               <label>Client Type</label>
                                <select name="client_type_id" id="client_type_id" class="input-short">
                                    <?php $clienttype = $emailFun->getClientTypes(); 
                                    echo '<option value="">Select client type</option>';
                                    if(is_array($clienttype)){
                                        foreach($clienttype as $clientt){
                                            if(($editclient != '') && ($editclient == $clientt['id'])){
                                                $select = 'selected = "selected"';
                                            }
                                            else
                                                $select = '';
                                            
                                           echo '<option value="'.$clientt['id'].'" '.$select.'>'.$clientt['client_type'].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                               <span id="clienterror"></span>
                            </p>
                            <p>
                                <label>Name:</label>
                                <input type="text" name="email_user" id="email_user" value="<?php echo (isset($edituser) && $edituser != '') ? $edituser : ''; ?>" class="input-short" />
                                <span id="emailusererror"></span>
                            </p>
                            <p>
                                <label>Email Address:</label>
                                <input type="text" name="email_id" id="email_id" value="<?php echo (isset($editemail) && $editemail != '') ? $editemail : ''; ?>" class="input-short" />
                                <span id="emailerror"></span>
                            </p>
                            <p>
                                <label>Phone:</label>
                                <input type="text" name="phone" id="phone" value="<?php echo (isset($editphn) && $editphn != '') ? $editphn : ''; ?>" class="input-short" />
                                <span id="emailerror"></span>
                            </p>
                            <p>
                                <label>Remarks</label>
                                <textarea rows="7" cols="90" name="remarks" id="remarks" class="input-short"><?php echo (isset($remarks) && $remarks != '') ? $remarks : ''; ?></textarea>
                            </p>
                            <div id="dynamic"></div>
                            <fieldset>
                                <input class="submit-green" type="submit" name="<?php echo (isset($editemail) && $editemail != '') ? 'editButton' : 'saveButton'; ?>" value="Save" id="saveButton" /> 
                                <input class="submit-gray" type="reset" value="Cancel" />
                            </fieldset>
                            <?php if(!isset($editemail) && $editemail == ''){ ?>
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
     <!--full conatiner first end here-->
                        <!--Drop down menu end here-->
  <style>
      .profile-container {  
     background-color: white;
    border: 1px solid #78B0DE;
    border-radius: 3px 3px 3px 3px;
    box-shadow: 0 0 5px #78B0DE;  left: 28%;
    min-height: 30%;
    overflow: hidden;
    padding: 10px;
    position: fixed;
    top: 10%;
    width: 700px;
    z-index: 1002;
                }
                .black_overlay {
    background-color: black;
    
    height: 100%;
    left: 0;
    opacity: 0.4;
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1001;
}

  </style>
   <div class="profile-container" id="light" style="display:none;">         
   </div>
   <div class="black_overlay" id="fade" style="display: none;"></div>
<div class="bottom-spacing">                
                    <!-- Table records filtering -->
                    Filter: 
                    <select name="filter_site_id" id="filter_site_id" onchange="filter(this.value,'site_id','filter','<?php echo get_class($emailFun); ?>');" class="input-short">
                                    <?php $sites = $emailFun->getSites(); 
                                    echo '<option value="">Select by site</option>';
                                    echo '<option value="0">All sites</option>';
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
                    OR
                    <select name="client_type_filter" id="client_type_filter" class="input-short" onchange="filter(this.value,'client_type_id','filter','<?php echo get_class($emailFun); ?>');">
                                    <?php $clienttype = $emailFun->getClientTypes(); 
                                    echo '<option value="">Select client type</option>';
                                    echo '<option value="0">All clients</option>';
                                    if(is_array($clienttype)){
                                        foreach($clienttype as $clientt){
                                            if(($editid != '') && ($editid == $site['id'])){
                                                $select = 'selected = "selected"';
                                            }
                                            else
                                                $select = '';
                                            
                                           echo '<option value="'.$clientt['id'].'" '.$select.'>'.$clientt['client_type'].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                </div>
                <!-- Example table -->
                <div class="module">
                	<h2><span>Emails Listing</span></h2>
                    
                    <div class="module-table-body">
                    	<form action="">
                        <table id="myTable" class="tablesorter">
                        	<thead>
                                <tr>
                                    <th style="width:5%">#</th>
                                    <th style="width:15%">Name</th>
                                    <th style="width:20%">Email Address</th>
                                    <th style="width:15%">Site</th>
                                    <th style="width:15%">Client Type</th>
                                    <th style="width:10%">Add Date</th>
                                    <th style="width:12%">Subscription Status</th>
                                    <th style="width:20%">Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                               <?php if(is_array($emails) && $emailFun->check_arrayempty($emails)){ 
                                   $i = 1;
                                   foreach($emails as $email){ ?>
                                <tr>
                                    <td class="align-center"><?php echo $i; ?></td>
                                    <td><?php echo $email['email_user']; ?></td>
                                    <td><a href="?page=emails&eid=<?php echo $email['id']; ?>"><?php echo $email['email_id']; ?></a></td>
                                    <td><?php  $sitename = $emailFun->getSites($email['site_id']); echo $sitename[0]['site_name']; ?></td>
                                    <td><?php  $siteclient = $emailFun->getClientTypes($email['client_type_id']); echo $siteclient[0]['client_type']; ?></td>
                                    <td><?php echo date('Y-m-d',  strtotime($email['add_date'])); ?></td>
                                    <!--<td><?php ?></td>-->                                    
                                    <td style="text-align:center;">
                                    	<!--<input type="checkbox" />-->
                                        <a style="cursor:pointer;" onclick="statusChange('status<?php echo $i?>','<?php echo $email['id']; ?>','emailFunctions');"><img id="status<?php echo $i?>" src="<?php echo ($email['active']  != 0) ? IMAGEPATH.'tick-circle.gif' : IMAGEPATH.'minus-circle.gif'; ?>" width="16" height="16" alt="published" /></a>
                                        <!--<a href=""><img src="<?php echo IMAGEPATH; ?>pencil.gif" width="16" height="16" alt="edit" /></a>-->
                                    </td>
                                    <td style="text-align:center;"><input type="button" onclick="emailPopup('<?php echo $email['id']; ?>','<?php echo get_class($emailFun); ?>');" class="submit-gray" name="sendemail" value="Send Email" id="sendemail<?php echo $i; ?>"></td>
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
                            <select class="input-medium" onchange="filter(this.value,'active','filter','<?php echo get_class($emailFun); ?>')">
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


