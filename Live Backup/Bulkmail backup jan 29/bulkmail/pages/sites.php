<?php
/* 
 * Created By: Manish Arora
 * 
 * Purpose: For Display Sites
 */
if ( ! defined('BASE_PATH')) exit('No direct script access allowed');
global $siteConfig;
$siteConfig->check_login();

$siteConfig->load_class('sitesFunctions');  
    $sitefun  = new sitesFunctions;
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['saveButton']) && !empty($_POST['saveButton'])){        
        $result = $sitefun->addSites();
        if ($result == 'success') {
            $siteConfig->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully saved'));
        }
        else
            $siteConfig->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
        }
}
    $sites = $sitefun->getSites();        
?> 
<!-- Form elements -->    
 <div class="container_12">
            <div class="grid_12">
            
                <div class="module">
                     <h2><span>Add Sites Form</span></h2>                        
                     <div class="module-body">
                            <div>
                                <?php echo $siteConfig->getAlertMessage(TRUE); ?>
                            </div> 
                         <form action="" method="post" name="sites" id="sites" onsubmit="return validate_siteform();">                                                  
                            <p>
                                <label>Site Name:</label>
                                <input type="text" name="site_name" id="site_name" class="input-short" onkeyup="changecase(this);" />
                                <span id="siteerror"></span>
                            </p>
                            <p>
                                <label>Site Url:</label>
                                <input type="text" name="site_url" id="site_url" class="input-short" />
                                <span id="urlerror"></span>
                            </p>
                            <div id="dynamic"></div>
                            <fieldset>
                                <input class="submit-green" type="submit" value="Save" name="saveButton" id="saveButton" /> 
                                <input class="submit-gray" type="reset" value="Cancel" />
                            </fieldset>
                            <input type="hidden" id="counttextbox" value="0" style="display:none;" />
                             <div class="float-right">
<!--                                 <a style="cursor: pointer" onclick="addmore_category('cate_name');" class="button">
                                        <span>Add More Sites<img src="<?php echo IMAGEPATH; ?>plus-small.gif" width="12" height="9" alt="New article" /></span>
                                </a>-->
                            </div>
                          </form>
                     </div> <!-- End .module-body -->

                </div>  <!-- End .module -->
        		<div style="clear:both;"></div>
            </div>

<div class="grid_12">
                <!-- Example table -->
                <div class="module">
                	<h2><span>Sites Listing</span></h2>
                    
                    <div class="module-table-body">
                    	<form action="">
                        <table id="myTable" class="tablesorter">
                        	<thead>
                                <tr>
                                    <th style="width:5%">#</th>
                                    <th style="width:20%">Site Name</th>
                                    <th style="width:20%">Site URL</th>
                                    <th style="width:20%">Site ID</th>
                                    <th style="width:20%">Secret Key</th>
                                    <th style="width:21%">Add Date</th>
                                    <th style="width:13%">Status</th>                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
                               <?php if(is_array($sites)){ 
                                   $i = 1;
                                   foreach($sites as $site){ ?>
                                <tr>
                                    <td class="align-center"><?php echo $i; ?></td>
                                    <td><a href=""><?php echo $site['site_name']; ?></a></td>
                                    <td><?php echo $site['site_url']; ?></td>
                                    <td><?php echo $sitefun->base64encode($site['site_id']); ?></td>
                                    <td><?php echo $sitefun->base64encode($site['secret_key']); ?></td>
                                    <td><?php echo date('Y-m-d',  strtotime($site['add_date'])); ?></td>                                                                      
                                    <td>
                                    	<!--<input type="checkbox" />-->
                                        <a style="cursor:pointer;" onclick="statusChange('status<?php echo $i?>','<?php echo $site['id']; ?>','sitesFunctions');"><img id="status<?php echo $i?>" src="<?php echo ($site['active']  != 0) ? IMAGEPATH.'tick-circle.gif' : IMAGEPATH.'minus-circle.gif'; ?>" width="16" height="16" alt="published" /></a>
                                        <!--<a href=""><img src="<?php echo IMAGEPATH; ?>pencil.gif" width="16" height="16" alt="edit" /></a>-->
                                    </td>
                                </tr>
                                   <?php $i++; } }else { echo '<tr><td>No Sites Found.</td></tr>'; } ?>
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
                            <select class="input-medium" onchange="getvaluesByStatus(this.value,'getRecordsByStatus','sitesFunctions')">
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
