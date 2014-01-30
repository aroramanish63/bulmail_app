<?php
/* 
 * Created By: Manish Arora
 * 
 * Purpose: Send Mail
 */
if ( ! defined('BASE_PATH')) exit('No direct script access allowed');
global $siteConfig;
$siteConfig->check_login();

//require_once "richtexteditor/include_rte.php";


$siteConfig->load_class('emailFunctions');  
    $emailFun = new emailFunctions();
 
$siteConfig->load_class('sendMailFunctions');
$sendmailFun = new sendMailFunctions();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(isset($_POST['saveButton']) && !empty($_POST['saveButton'])){        
        $result = $sendmailFun->saveMailbeforeSend();
        if ($result == 'success') {
            $siteConfig->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully send'));
        }
        else{
            $siteConfig->setAlertMessage(array('err_type' => 'error', 'msg' => $result));
        }    
     }
    
}    
?> 
<!-- Form elements -->    
 <div class="container_12">
  
            <div class="grid_12">
            
                <div class="module">
                     <h2><span>Send Email Form</span></h2>                        
                     <div class="module-body">
                            <div>
                                <?php echo $siteConfig->getAlertMessage(TRUE); ?>
                            </div> 
                         <form action="<?php echo SITE_URL.'?page=sendmail' ?>" method="post" name="send_email_form" id="send_email_form" onsubmit="return validate_emailform();">
<!--                           <p>
                               <label>Client Type</label>
                                <select name="client_type_id" id="client_type_id" class="input-short">
                                    <?php // $clienttype = $emailFun->getClientTypes(); 
//                                    echo '<option value="">Select client type</option>';
//                                    if(is_array($clienttype)){
//                                        foreach($clienttype as $clientt){
//                                            if(($editclient != '') && ($editclient == $clientt['id'])){
//                                                $select = 'selected = "selected"';
//                                            }
//                                            else
//                                                $select = '';
//                                            
//                                           echo '<option value="'.$clientt['id'].'" '.$select.'>'.$clientt['client_type'].'</option>';
//                                        }
//                                    }
                                    ?>
                                </select>
                               <span id="clienterror"></span>
                            </p>  -->
                            <p>
                               <label>Select Site</label>                               
                                <div class="multiselect input-short">
                                    <?php $sites = $emailFun->getSites(); 
                                    if(is_array($sites)){ $i = 1;
                                    echo '<label><input type="checkbox" value="all" name="allsite" id="site_all" onclick="checkAll(this,\'site[]\')" />&nbsp;All Sites</label>';
                                        foreach($sites as $site){
                                           echo '<label><input type="checkbox" onclick="getemailsBysiteid(this,\'getEmailsbySite\',\'sendMailFunctions\')" value="'.$site['id'].'" name="site[]" id="site'.$i.'" />&nbsp;'.$site['site_name'].'</label>';
                                           $i++;
                                        }
                                    }
                                    ?>
                                </div>
                            </p>                               
                            <div id="dynamicemails" style="display:none;"></div>  
                            <div id="emailbysite" style="display:none;">
                                <p>
                                    <label>Select Emails</label>
                                    <div class="multiselect input-short">
                                        <!--<label><input type="checkbox" value="all" name="allemail" id="allemail" />&nbsp;All Emails</label>-->
                                    </div>
                                </p>
                            </div>                            
                            <p>
                                <label>Subject:</label>
                                <input type="text" name="subject" id="subject" class="input-short" />
                                <span id="emailusererror"></span>
                            </p>
                            <fieldset>
                                <label>Message Content:</label>
                               <script src="<?php echo SITE_URL.'ckeditor/' ?>ckeditor.js"></script>                               
                                <textarea id="message" name="message" rows="11" cols="90" name="desc"></textarea> 
                                <script type="text/javascript">
                                    CKEDITOR.replace( 'message' );
                               </script>
                            </fieldset>
                            <div id="dynamic"></div>
                            <fieldset>
                                <input class="submit-green" type="submit" name="saveButton" value="Send" id="saveButton" />                                
                            </fieldset>
                          
                          </form>
                     </div> <!-- End .module-body -->

                </div>  <!-- End .module -->
        		<div style="clear:both;"></div>
            </div>
                         <div style="clear:both;"></div>
 </div>


