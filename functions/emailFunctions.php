<?php
/* 
 * Created By: Manish Arora
 * Purpose: Email Function Class
 */
if ( ! defined('BASE_PATH')) exit('No direct script access allowed');
class emailFunctions extends AllFunctions
{    
    public $tblname = 'tbl_email';
    //-----Initialization -------
        
    
	public function addEmail()
        {
            if(!isset($_POST['saveButton']))
            {
               return false;
            } 
            if($_POST['email_id']!='' && !empty($_POST['email_id']))
            {
                    $email_id=$_POST;
                             $email_id['add_date'] = date('Ymdhis');                        		 
                             $email_id['active'] = 1;                   
                            unset($email_id['saveButton']);
                            if(is_array($email_id)){
                                $fields = array();
                                foreach($email_id as $key=>$eid)
                                {
                                        if($eid!="" && isset($eid))
                                        {
                                            $fields[$key] = $eid;
                                        }                                    
                                }
                                $result=$this->insert($this->cfg['db_prefix'].'email',$fields);
                            } 
            }
            else
            {
                     return 'Please Fill the required Fields';
            }
		return isset($result['error'])?$this->setAlertMessage(array('err_type' => 'error', 'msg' => $result)):$this->setAlertMessage(array('err_type' => 'success', 'msg' => 'successfully saved'));
        }
	 
        
        public function updateEmail(){
            if(!isset($_POST['editButton']))
            {
               return false;
            } 
            if($_POST['email_id']!='' && !empty($_POST['email_id']))
            {        
                                $fields = array();
                                $fields = array("site_id"=>$_POST['site_id'],"email_id" => $_POST['email_id'],"email_user"=>$_POST['email_user'],"client_type_id"=>$_POST['client_type_id'],"phone"=>$_POST['phone'],"remarks"=>$_POST['remarks'], "update_date" => date('Ymdhis'));
                                $where = array("id" => $_REQUEST['id']);              
                                $result=$this->update($this->cfg['db_prefix'].'email',$fields,$where);             
            }
            else
            {
                     return 'Please Fill the required Fields';
            }
		return isset($result['error'])?$result['error']:'success';
        }
         public function getEmailByID($id)
	 {		
	 	 return $this->select($this->cfg['db_prefix'].'email',"*",array("id"=>$id));
	 }
	 
         public function getEmail()
	 {		                                        	 	 
	 	return $this->select($this->cfg['db_prefix'].'email',"*");
	 }
         
         public function statusActiveInactive($id){
             if($id != ''){
                        $st = ($this->getStatus($id) == 0) ? 1 : 0;
                        $fields = array("active" => $st);
                        $where = array("id" => $id);
                        $result = $this->update($this->cfg['db_prefix'].'email', $fields, $where);
                    return isset($result['error'])?$result['error']:'success';
             }
         }
	   
         public function getStatus($id){
             if($id != ''){                
                $result = $this->select($this->cfg['db_prefix'].'email',"active",array("id"=>$id));
                return $result[0]['active'];
             }
         }
         
         public function getSites($id=''){
              $fields = array(
                 'id',
                 'site_name'
             ); 
              if($id != ''){
                  $where = array(
                    'id' => $id  
                  );
              }
              else
                $where = '';
                return $this->select($this->cfg['db_prefix'].'sites',$fields,$where);  
         }
         
         /*
          * Function for get email listing   
          */
         public function getEmailsListing($siteid){             
             if(!is_null($siteid) && ($siteid != '')){
                 $where = array(
                    'site_id' => $siteid  
                  );
                 if($this->get_num_rows($this->cfg['db_prefix'].'email','*',$where) != 0){ ?>
                     <p>
                               <label>Client Type</label>
                                <select name="client_type_id" id="client_type_id" class="input-short">
                                    <?php $clienttype = $this->getClientTypes(); 
                                    echo '<option value="">Select client type</option>';
                                    if(is_array($clienttype)){
                                        foreach($clienttype as $clientt){
                                           echo '<option value="'.$clientt['id'].'" '.$select.'>'.$clientt['client_type'].'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                               <span id="clienterror"></span>
                            </p>
                <?php  } 
                 else
                     return $this->get_num_rows($this->cfg['db_prefix'].'email','*',$where);
             }
         }
         
         /*
          *Function for Export Emails of Websites 
          */
         
         public function exportToExcel() {
            if (!isset($_POST['saveButton']) || $_POST['saveButton'] == '') {
                return false;
            }
            if(isset($_POST['site_id']) && !empty($_POST['site_id'])){
                $site_id = $_POST['site_id'];
                $site_arr = $this->getSites($site_id);
                $sitename = $site_arr[0]['site_name'];
                $Emails = $this->select($this->cfg['db_prefix'].'email', array('email_id', 'add_date'), array('site_id' => $site_id));
                if (isset($sitename)) {
                    $this->Excel($Emails, $sitename);
                } else {
                    $this->Excel($Emails);
                }
                return 'success';
            }
        }

        public function Excel($data, $fileName = 'Emails') {
            $file_ending = "xls";
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="' . $fileName . '.xls"');
            header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
            header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header('Pragma: public'); // HTTP/1.0
            $sep = "\t"; //tabbed character
            foreach ($data as $dat) {
                $schema_insert = "";

                if ($dat['email_id'] != "") {
                    $schema_insert .= trim($dat['email_id']) . $sep;
                    $schema_insert .=str_replace("&apos;","'",html_entity_decode(date('d-m-Y H:i:s',  strtotime($dat['add_date'])))) . $sep;
                }
                $schema_insert = str_replace($sep . "$", "", $schema_insert);
                $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
                $schema_insert .= "\t";
                print(trim($schema_insert));
                print "\n";
            }
    }
    /*
     * Function for Ajax Request.
     */
    public function getRecordsByStatus($status=0){
             if($status != ''){
                 $where = array(
                     'active'=>$status
                 );
                 $emails = $this->select($this->cfg['db_prefix'].'email','*',$where);
                 if(is_array($emails) && $this->check_arrayempty($emails)){ 
                                   $i = 1;
                                   foreach($emails as $email){ ?>
                               <tr>
                                    <td class="align-center"><?php echo $i; ?></td>
                                    <td><?php echo $email['email_user']; ?></td>
                                    <td><a href="?page=emails&eid=<?php echo $email['id']; ?>"><?php echo $email['email_id']; ?></a></td>
                                    <td><?php  $sitename = $this->getSites($email['site_id']); echo $sitename[0]['site_name']; ?></td>
                                    <td><?php  $siteclient = $this->getClientTypes($email['client_type_id']); echo $siteclient[0]['client_type']; ?></td>
                                    <td><?php echo date('Y-m-d',  strtotime($email['add_date'])); ?></td>
                                    <!--<td><?php ?></td>-->                                    
                                    <td>
                                    	<!--<input type="checkbox" />-->
                                        <a style="cursor:pointer;" onclick="statusChange('status<?php echo $i?>','<?php echo $email['id']; ?>','emailFunctions');"><img id="status<?php echo $i?>" src="<?php echo ($email['active']  != 0) ? IMAGEPATH.'tick-circle.gif' : IMAGEPATH.'minus-circle.gif'; ?>" width="16" height="16" alt="published" /></a>
                                        <!--<a href=""><img src="<?php echo IMAGEPATH; ?>pencil.gif" width="16" height="16" alt="edit" /></a>-->
                                    </td>
                                     <td style="text-align:center;"><input type="button" onclick="emailPopup('<?php echo $email['id']; ?>','<?php echo get_class($this); ?>');" class="submit-gray" name="sendemail" value="Send Email" id="sendemail<?php echo $i; ?>"></td>
                                </tr>
                                   <?php $i++; } }else { echo '<tr><td>No Emails Found.</td></tr>'; }
             }
         }
         
         public function filter($filter = '',$id=0){
             if(($filter != '') && ($id != 0)){
                    $where = array(
                        $filter=>$id
                    );
             }
             else if($filter == 'active'){
                    $where = array(
                        $filter=>$id
                    );
             }
             else
                 $where = '';
             
                 $emails = $this->select($this->tblname,'*',$where);
                 if(is_array($emails) && $this->check_arrayempty($emails)){ 
                                   $i = 1;
                                   foreach($emails as $email){ ?>
                                <tr>
                                    <td class="align-center"><?php echo $i; ?></td>
                                    <td><?php echo $email['email_user']; ?></td>
                                    <td><a href="?page=emails&eid=<?php echo $email['id']; ?>"><?php echo $email['email_id']; ?></a></td>
                                    <td><?php  $sitename = $this->getSites($email['site_id']); echo $sitename[0]['site_name']; ?></td>
                                    <td><?php  $siteclient = $this->getClientTypes($email['client_type_id']); echo $siteclient[0]['client_type']; ?></td>
                                    <td><?php echo date('Y-m-d',  strtotime($email['add_date'])); ?></td>
                                    <!--<td><?php ?></td>-->                                    
                                    <td style="text-align:center;">
                                    	<!--<input type="checkbox" />-->
                                        <a style="cursor:pointer;" onclick="statusChange('status<?php echo $i?>','<?php echo $email['id']; ?>','emailFunctions');"><img id="status<?php echo $i?>" src="<?php echo ($email['active']  != 0) ? IMAGEPATH.'tick-circle.gif' : IMAGEPATH.'minus-circle.gif'; ?>" width="16" height="16" alt="published" /></a>
                                        <!--<a href=""><img src="<?php echo IMAGEPATH; ?>pencil.gif" width="16" height="16" alt="edit" /></a>-->
                                    </td>
                                     <td style="text-align:center;"><input type="button" onclick="emailPopup('<?php echo $email['id']; ?>','<?php echo get_class($this); ?>');" class="submit-gray" name="sendemail" value="Send Email" id="sendemail<?php echo $i; ?>"></td>
                                </tr>
                                   <?php $i++; } }else { echo '<tr><td></td><td colspan="5">No Emails Found.</td></tr>'; }
             
         }
         
         /*
          * function for get Client types
          */
         public function getClientTypes($client_type_id=0){
              $fields = array(
                 'id',
                 'client_type'
             ); 
              if($client_type_id != ''){
                  $where = array(
                    'id' => $client_type_id  
                  );
              }
              else{
                $where = array(
                    'active' => 1  
                  );
              } 
                return $this->select($this->cfg['db_prefix'].'client_type_master',$fields,$where); 
         }
         
         /*
          * function for send email popup on ajax requests.
          */
         function emailPopup($id=0){
             if($id != 0){
                $where = array(
                    'id' => $id  
                  );               
                $emails = $this->select($this->tblname,'*',$where);                
                if(is_array($emails)){ 
                    
                    ?>
                
                     <a onclick="document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none';" href="javascript:void(0)" style="float:right;">        
                        <img src="<?php echo IMAGEPATH ?>close_u.png">        
                    </a>
                                <span id="messsuc" class="notification" style="display:none;"></span>
                     <form action="<?php echo SITE_URL.'?page=sendmail' ?>" method="post" name="send_email_form" id="send_email_form">                                                        
                            <p>
                                <label>Email Address:</label>
                                <input type="text" name="email_id" value="<?php echo $emails[0]['email_id']; ?>" id="email_id" class="input-short" readonly="true" />
                                <span id="emailusererror"></span>
                            </p>
                            <p>
                                <label>Subject:</label>
                                <input type="text" name="subject" id="subject" class="input-short" />
                                <span id="emailusererror"></span>
                            </p>
                            <fieldset>
                                <label>Message Content:</label>
                                <textarea id="wysiwyg" name="message" rows="11" cols="85" name="desc"></textarea> 
                            </fieldset>
                            <input type="hidden" name="emails" id="emails" value="<?php echo $emails[0]['id']; ?>" />
                            <input type="hidden" name="site" id="site" value="<?php echo $emails[0]['site_id']; ?>" />
                            <fieldset>
                                <input class="submit-green" type="button" name="ajxButton" onclick="formValues($('#send_email_form').serializeArray());" value="Send" id="ajxButton" />                                
                                <img id="loader" style="display: none;" src="<?php echo IMAGEPATH.'ajax-loader.gif'; ?>" />
                            </fieldset>
                          
                          </form>                              
               <?php }
               else
                   echo '0';
             }
         }
                       
}

?>