<?php
/**
 * Created By: Manish Arora
 * 
 * Purpose : Send Mail Functions Class
 */

class sendMailFunctions extends AllFunctions{
    
     /*
      * function for get all emails using ajax requests
      */
     public function getAllemails(){
         $fields = array(
           'id',
           'email_id'
         );
         $result =  $this->select($this->cfg['db_prefix'].'email',$fields);
         if(is_array($result)){
             $str = '';
                  $i = 1;
            $str .= '<p><label>Select Emails</label><div class="multiselect input-short"><label><input type="checkbox" value="all" name="allemail" id="allemail" />&nbsp;All Emails</label>';
                foreach($result as $all){
                   $str .= '<label><input type="checkbox" value="'.$all['id'].'" name="emails[]" id="emails'.$i.'" />&nbsp;'.$all['email_id'].'</label>';
                   $i++;
                }
                $str .= '</div></p>';
               echo $str;                     
         }
     }
     
     /*
      * Get All emails by site using ajax requests
      */
     public function getEmailsbySite($siteid=0){
         if($siteid != 0){
             $fields = array( 'id','email_id');
             $where = array(
                 'site_id'=>$siteid
             );
             $result =  $this->select($this->cfg['db_prefix'].'email',$fields,$where);
              if(is_array($result)){
                         $str = '';
                              $i = 1;                        
                            foreach($result as $all){
                               $str .= '<label><input type="checkbox" value="'.$all['id'].'" name="emails[]" id="emails'.$i.'" />&nbsp;'.$all['email_id'].'</label>';
                               $i++;
                            }
                           echo $str;                     
                }
         }
     }
     
     /*
      * function for save details before sending emails.
      */
     public function saveMailbeforeSend(){
            if(!isset($_POST['saveButton']))
            {
               return false;
            } 
            if(($_POST['subject']!='' && !empty($_POST['subject'])) && ($_POST['message']!='' && !empty($_POST['message'])))
            {
               require_once(BASE_PATH."/PHPMailer/class.phpmailer.php");
//               $this->load_class('class.phpmailer', 'PHPMailer');
                        $mail = new PHPMailer(); 
                        $mail->IsSMTP();
                        $mail->SMTPAuth = true;
                        //$mail->SMTPSecure = "tls";
                        $mail->Port = 25;
                        //$mail->Host = "103.10.189.48";
                        $mail->Host = "localhost";
                        $mail->Username = "support@go4hosting.com";
                        $mail->Password = "OKI87%$#DD%^";                
                 
                $userid = $_SESSION['uid'];
                $subj = filter_input(INPUT_POST, 'subject',FILTER_SANITIZE_STRING);
                $message = filter_input(INPUT_POST, 'message',  FILTER_SANITIZE_STRING);
                $sites = (is_array($_POST['site'])) ? implode(',',$_POST['site']) : $_POST['site'];
                $emails = (is_array($_POST['emails'])) ? implode(',',$_POST['emails']) : $_POST['emails'];
                $send_date = date('Ymdhis');
                $fields = array(
                    'user_id'=>$userid,
                    'sites_id'=>$sites,
                    'emails_id'=>$emails,
                    'subject'=>$subj,
                    'message'=>$message,
                    'send_date'=>$send_date
                );     
               
                $result=$this->insert($this->cfg['db_prefix'].'sent_email',$fields);
                
                if($result){
                    if(is_array($_POST['emails']) && ($_POST['emails'] != '')){                                            
                    for($i=0;$i<count($_POST['emails']);$i++){
                            $header  = "MIME-Version: 1.0";
                            $header .= "Content-type: text/html; charset: utf8";
                            $subject=$subj;
                            $header.="from:Team Go4hosting <support@go4hosting.com>";
                            $content=$message;
                                $mail->SetFrom("support@go4hosting.com","Go4hosting");
                                $mail->Subject  = $subj;
                                $mail->MsgHTML($content);  
//                                    $mail->AddAddress('aroramanish63@gmail.com');
                                       
                                                $mail->AddAddress($this->getEmailByID($_POST['emails'][$i]));
//                                                $mail->Send();
                                         
                                $mail->Send();
                                $mail->ClearAllRecipients();
                       }
                  }
                  else {
                       $mail->SetFrom("support@go4hosting.com", "Go4hosting");
                       $mail->Subject = $subj;
                       $mail->MsgHTML($message);
                       $mail->AddAddress($this->getEmailByID($_POST['emails']));
                       $mail->IsHTML(true); // send as HTML  
                        if ($mail->Send()) {
                                 echo 'Mail sent successfully.';
//                                 return true;
                        }else{
                                 echo "Mailer Error: " . $mail->ErrorInfo;
//                                 return false;
                        }
                  }
                }
            }             
            else
            {
                     return 'Please Fill the required Fields';
            }
		return isset($result['error'])?$result['error']:'success';
        }
        
        
        /*
         * function for set mail configuration
         */
        function getMailConfig($mail){
            if(is_a($mail, 'PHPMailer')){                    
                    $mail->IsSMTP();  
                    $mail->SMTPAuth   = true; 
                    $mail->SMTPSecure = "tls";
                    $mail->Port       = 25;                   
                    $mail->Host       = "103.10.189.48"; 
                    $mail->Username   = "support@go4hosting.com";     
                    $mail->Password   = "H24!@#IU*&//";            
              }                          
        }     
        
         public function getEmailByID($id)
	 {		
	 	 $result =  $this->select($this->cfg['db_prefix'].'email',"email_id",array("id"=>$id));
                  return $result[0]['email_id'];
	 }
}

