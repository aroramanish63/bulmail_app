<?php
/* 
 * Created By: Manish Arora
 * Purpose: Email Function Class
 */
if ( ! defined('BASE_PATH')) exit('No direct script access allowed');
class emailFunctions extends AllFunctions
{    
    //-----Initialization -------	
	function addEmail()
        {
            if(!isset($_POST['saveButton']))
            {
               return false;
            } 
            if($_POST['email_id']!='' && !empty($_POST['email_id']))
            {
                    $email_id=$_POST;
//                    if(is_array($email_id['email_id'])){
//                        return $this->insertMultiplecat($email_id['email_id']);
//                    }       
//                    else{
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
//                  }
            }
            else
            {
                     return 'Please Fill the required Fields';
            }
		return isset($result['error'])?$result['error']:'success';
        }
	 
        
        function updateEmail(){
            if(!isset($_POST['editButton']))
            {
               return false;
            } 
            if($_POST['email_id']!='' && !empty($_POST['email_id']))
            {        
                                $fields = array();
                                $fields = array("email_id" => $_POST['email_id'], "update_date" => date('Ymdhis'));
                                $where = array("id" => $_REQUEST['id']);              
                                $result=$this->update($this->cfg['db_prefix'].'email',$fields,$where);             
            }
            else
            {
                     return 'Please Fill the required Fields';
            }
		return isset($result['error'])?$result['error']:'success';
        }
         function getEmailByID($id)
	 {		
	 	 return $this->select($this->cfg['db_prefix'].'email',"*",array("id"=>$id));
	 }
	 
         function getEmail()
	 {		                                        	 	 
	 	return $this->select($this->cfg['db_prefix'].'email',"*");
	 }
         
         function statusActiveInactive($id){
             if($id != ''){
                        $st = ($this->getStatus($id) == 0) ? 1 : 0;
                        $fields = array("active" => $st);
                        $where = array("id" => $id);
                        $result = $this->update($this->cfg['db_prefix'].'email', $fields, $where);
                    return isset($result['error'])?$result['error']:'success';
             }
         }
	   
         function getStatus($id){
             if($id != ''){                
                $result = $this->select($this->cfg['db_prefix'].'email',"active",array("id"=>$id));
                return $result[0]['active'];
             }
         }
         
         function insertMultiplecat($email_id = array()){
             if(is_array($email_id) && (strlen(implode($email_id)) != 0)){
                 $email_id = array();
                 foreach($catname as $cat){
                     $email_id['email_id'] = $cat;
                     $email_id['add_date'] = date('Ymdhis');                        		 
                     $email_id['active'] = 1;  
                     
                     $result=$this->insert($this->cfg['db_prefix'].'email',$email_id);
                 }
                 return isset($result['error'])?$result['error']:'success';
             }
             else
                return 'Please Fill the required Fields';
         }
         
         function getSites($id=''){
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
         function getEmailsListing($siteid){             
             if(!is_null($siteid) && ($siteid != '')){
                 $where = array(
                    'site_id' => $siteid  
                  );
                 return $this->get_num_rows($this->cfg['db_prefix'].'email','*',$where); 
             }
         }
         
         /*
          *Function for Export Emails of Websites 
          */
         
         function exportToExcel() {
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

        function Excel($data, $fileName = 'Emails') {
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
    function getRecordsByStatus($status=0){
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
                                    <td><?php echo $email['email_id']; ?></td>
                                    <td><?php  $sitename = $this->getSites($email['site_id']); echo $sitename[0]['site_name']; ?></td>
                                    <td><?php echo date('Y-m-d',  strtotime($email['add_date'])); ?></td>
                                    <!--<td><?php ?></td>-->                                    
                                    <td>
                                    	<!--<input type="checkbox" />-->
                                        <a style="cursor:pointer;" onclick="statusChange('status<?php echo $i?>','<?php echo $email['id']; ?>','emailFunctions');"><img id="status<?php echo $i?>" src="<?php echo ($email['active']  != 0) ? IMAGEPATH.'tick-circle.gif' : IMAGEPATH.'minus-circle.gif'; ?>" width="16" height="16" alt="published" /></a>
                                        <!--<a href=""><img src="<?php echo IMAGEPATH; ?>pencil.gif" width="16" height="16" alt="edit" /></a>-->
                                    </td>
                                </tr>
                                   <?php $i++; } }else { echo '<tr><td>No Emails Found.</td></tr>'; }
             }
         }
}



// For Ajax Requests
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  
    if(isset($_POST['ajx']) && ($_POST['ajx'] == 'Yes') && isset($_POST['func_name']) && !empty($_POST['func_name']) && isset($_POST['page']) && !empty($_POST['page'])){

            $func_name = $_POST['func_name'];            
            $emailObj = new emailFunctions();            
            
            switch($func_name){
            case "statusActiveInactive":
                    echo ($emailObj->$func_name($_POST['id']) == 'success') ? $emailObj->getStatus($_POST['id']) : '' ;
                    break;
            case "getEmailsListing":
                    echo $emailObj->$func_name($_POST['id']);
                    break;
             case "getRecordsByStatus":
                    echo $emailObj->$func_name($_POST['status']);
                    break;   
            }

    }
}
?>