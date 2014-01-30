<?php
/* 
 * Created By: Manish Arora
 * Purpose: Export Emails in Excel.
 */
if ( ! defined('BASE_PATH')) exit('No direct script access allowed');
global $siteConfig;
$siteConfig->check_login();

$siteConfig->load_class('emailFunctions');  
    $emailFun = new emailFunctions();
?> 
<!-- Form elements -->    
 <div class="container_12">     
            <div class="grid_12">
            
                <div class="module">
                     <h2><span>Export Emails Form</span></h2>                        
                     <div class="module-body">
                            <div>
                                <?php echo $siteConfig->getAlertMessage(TRUE); ?>
                            </div> 
                         <form action="<?php echo SITE_URL.'export.php' ?>" method="post" name="export_email" id="export_email">
                             <p>
                               <label>Select Site</label>
                               <select name="site_id" id="site_id" class="input-short" onchange="exportList(this.value,'getEmailsListing','<?php echo get_class($emailFun); ?>');">
                                    <?php $sites = $emailFun->getSites(); 
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
                           
                            <fieldset>
                                 <div id="dynamic">                                    
                                </div>
                                <!--<input class="submit-gray" type="reset" value="Cancel" />-->
                            </fieldset>                           
                          </form>
                     </div> <!-- End .module-body -->

                </div>  <!-- End .module -->
        		<div style="clear:both;"></div>
            </div>

                         <div style="clear:both;"></div>
 </div>

