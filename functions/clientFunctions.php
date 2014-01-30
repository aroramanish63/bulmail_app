<?php
if ( ! defined('BASE_PATH')) exit('No direct script access allowed');

class clientFunctions extends AllFunctions
{    
    //-----Initialization -------	
	function addClient()
        {
            if(!isset($_POST['saveButton']))
            {
               return false;
            } 
            if($_POST['client_type']!='' && !empty($_POST['client_type']))
            {
                    $client_type=$_POST;
                    if(is_array($client_type['client_type'])){
                        return $this->insertMultiplecat($client_type['client_type']);
                    }       
                    else{
                             $client_type['add_date'] = date('Ymdhis');                        		 
                             $client_type['active'] = 1;                   
                            unset($client_type['saveButton']);
                            if(is_array($client_type)){
                                $fields = array();
                                foreach($client_type as $key=>$cat)
                                {
                                        if($cat!="" && isset($cat))
                                        {
                                            $fields[$key] = $cat;
                                        }                                    
                                }
                                $result=$this->insert($this->cfg['db_prefix'].'client_type_master',$fields);
                            } 
                  }
            }
            else
            {
                     return 'Please Fill the required Fields';
            }
		return isset($result['error'])?$result['error']:'success';
        }
	 
        
        function updateClient(){
            if(!isset($_POST['editButton']))
            {
               return false;
            } 
            if($_POST['client_type']!='' && !empty($_POST['client_type']))
            {        
                                $fields = array();
                                $fields = array("client_type" => $_POST['client_type'], "update_date" => date('Ymdhis'));
                                $where = array("id" => $_REQUEST['id']);              
                                $result=$this->update($this->cfg['db_prefix'].'client_type_master',$fields,$where);             
            }
            else
            {
                     return 'Please Fill the required Fields';
            }
		return isset($result['error'])?$result['error']:'success';
        }
         function getClientByID($id)
	 {		
	 	 return $this->select($this->cfg['db_prefix'].'client_type_master',"*",array("id"=>$id));
	 }
	 
         function getClient()
	 {		                                        	 	 
	 	return $this->select($this->cfg['db_prefix'].'client_type_master',"*");
	 }
         
         function statusActiveInactive($id){
             if($id != ''){
                        $st = ($this->getStatus($id) == 0) ? 1 : 0;
                        $fields = array("active" => $st);
                        $where = array("id" => $id);
                        $result = $this->update($this->cfg['db_prefix'].'client_type_master', $fields, $where);
                    return isset($result['error'])?$result['error']:'success';
             }
         }
	   
         function getStatus($id){
             if($id != ''){                
                $result = $this->select($this->cfg['db_prefix'].'client_type_master',"active",array("id"=>$id));
                return $result[0]['active'];
             }
         }
         
         function insertMultiplecat($catname = array()){
             if(is_array($catname) && (strlen(implode($catname)) != 0)){
                 $client_type = array();
                 foreach($catname as $cat){
                     $client_type['client_type'] = $cat;
                     $client_type['add_date'] = date('Ymdhis');                        		 
                     $client_type['active'] = 1;  
                     
                     $result=$this->insert($this->cfg['db_prefix'].'client_type_master',$client_type);
                 }
                 return isset($result['error'])?$result['error']:'success';
             }
             else
                return 'Please Fill the required Fields';
         }
         
         function getRecordsByStatus($status=0){
             if($status != ''){
                 $where = array(
                     'active'=>$status
                 );
                 $client = $this->select($this->cfg['db_prefix'].'client_type_master','*',$where);
                 if(is_array($client)){ 
                                   $i = 1;
                                   foreach($client as $category){ ?>
                                <tr>
                                    <td class="align-center"><?php echo $i; ?></td>
                                    <td><a href="?page=client&cid=<?php echo $category['id']; ?>"><?php echo $category['client_type']; ?></a></td>
                                    <td><?php echo date('Y-m-d',  strtotime($category['add_date'])); ?></td>
                                    <!--<td><?php ?></td>-->                                    
                                    <td>
                                    	<!--<input type="checkbox" />-->
                                        <a style="cursor:pointer;" onclick="statusChange('status<?php echo $i?>','<?php echo $category['id']; ?>','clientFunctions');"><img id="status<?php echo $i?>" src="<?php echo ($category['active']  != 0) ? IMAGEPATH.'tick-circle.gif' : IMAGEPATH.'minus-circle.gif'; ?>" width="16" height="16" alt="published" /></a>
                                        <!--<a href=""><img src="<?php echo IMAGEPATH; ?>pencil.gif" width="16" height="16" alt="edit" /></a>-->
                                    </td>
                                </tr>
                                   <?php $i++; } }else { echo '<td>No Clients Found.</td>'; }
             }
         }
}

?>