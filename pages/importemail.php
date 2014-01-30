<?php
/*
 * Created By: Manish Arora
 * Purpose: For Import emails in the mysql table.
 */
if ( ! defined('BASE_PATH')) exit('No direct script access allowed');
global $siteConfig;
$siteConfig->check_login();

$siteConfig->load_class('importFunctions');  
    $importFun = new importFunctions();
    
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['saveButton']) && !empty($_POST['saveButton'])){        
        $result = $importFun->importFile();
        if ($result) {
             if(!@header('Location:'.SITE_URL.'?page=emails')){
                    echo '<script type="text/javascript">location.href = "'.SITE_URL.'?page=emails";</script>';
                }                
                exit();            
        }    
     }
}
       
?>

<!-- Form elements -->    
 <div class="container_12">
            <div class="grid_12">
            
                <div class="module">
                     <h2><span>Import Email Form</span></h2>                        
                     <div class="module-body">
                            <div>
                                <?php echo $siteConfig->getAlertMessage(TRUE); ?>
                            </div> 
                         <form action="" method="post" enctype="multipart/form-data" name="import_email_form" id="import_email_form">
                            <p>
                               <label>Select Site</label>
                                <select name="site_id" id="site_id" class="input-short">
                                    <?php $sites = $importFun->getSites(); 
                                    echo '<option value="">Select site</option>';
                                    if(is_array($sites)){
                                        foreach($sites as $site){                                            
                                           echo '<option value="'.$site['id'].'">'.$site['site_name'].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                               <span id="selecterror"></span>
                            </p>
                            <p>
                               <label>Client Type</label>
                                <select name="client_type_id" id="client_type_id" class="input-short">
                                    <?php $clienttype = $importFun->getClientTypes(); 
                                    echo '<option value="">Select client type</option>';
                                    if(is_array($clienttype)){
                                        foreach($clienttype as $clientt){                                            
                                           echo '<option value="'.$clientt['id'].'">'.$clientt['client_type'].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                               <span id="clienterror"></span>
                            </p>
                            <p>
                               <label>Select Additional Fields in Excel</label>                              
                                <div class="multiselect input-short">
                                    <label><input type="checkbox" value="all" name="field_all" id="field_all"/>&nbsp;All Fields</label>
                                    <label><input type="checkbox" value="email_user" name="field[]" id="email_user"/>&nbsp;Name</label>                                                                        
                                    <label><input type="checkbox" value="phone" name="field[]" id="phone"/>&nbsp;Phone</label>
                                    <label><input type="checkbox" value="remarks" name="field[]" id="remarks"/>&nbsp;Remarks</label>
                                </div>                               
                               <span id="clienterror"></span>
                            </p>
                            <p>
                               <label>Import Excel File</label>
                                <input id="file_name" name="file_name" type="file" placeholder=" " />
                               <span id="fileerror"></span>
                            </p>
                                  
                            <fieldset>
                                <input class="submit-green" type="submit" name="saveButton" value="Save" id="saveButton" /> 
                                <input class="submit-gray" type="reset" value="Cancel" />
                            </fieldset>                            
                          </form>
                     </div> <!-- End .module-body -->

                </div>  <!-- End .module -->
        		<div style="clear:both;"></div>
            </div>

                         <div style="clear:both;"></div>
 </div>





