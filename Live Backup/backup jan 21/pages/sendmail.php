<?php
/* 
 * Created By: Manish Arora
 * 
 * Purpose: Send Mail
 */
if ( ! defined('BASE_PATH')) exit('No direct script access allowed');
global $siteConfig;
$siteConfig->check_login();

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
     <style>
         .multiselect {
            height:8em;
            border:solid 1px #c0c0c0;
            overflow:auto;
        }

        .multiselect label {
            display:block;
            margin-bottom: 0;
        }

        .multiselect-on {
            color:#ffffff;
            background-color:#00ACE4;
        }
     </style>
            <div class="grid_12">
            
                <div class="module">
                     <h2><span>Send Email Form</span></h2>                        
                     <div class="module-body">
                            <div>
                                <?php echo $siteConfig->getAlertMessage(TRUE); ?>
                            </div> 
                         <form action="" method="post" name="send_email_form" id="send_email_form" onsubmit="return validate_emailform();">
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
                                    echo '<label><input type="checkbox" value="all" name="allsite" id="site_all" />&nbsp;All Sites</label>';
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
                                <textarea id="wysiwyg" name="message" rows="11" cols="90" name="desc"></textarea> 
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


