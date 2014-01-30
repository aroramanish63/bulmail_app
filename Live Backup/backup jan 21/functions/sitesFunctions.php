<?php

/* 
 * Created By: Manish Arora
 *
 */
if ( ! defined('BASE_PATH')) exit('No direct script access allowed');
class sitesFunctions extends AllFunctions{
    
    //-----Initialization -------	
	function addSites()
        {
            if(!isset($_POST['saveButton']))
            {
               return false;
            } 
            if(($_POST['site_name']!='' && !empty($_POST['site_name'])) && ($_POST['site_url']!='' && !empty($_POST['site_url'])))
            {
                    $site_name=$_POST;
                    $site_name['site_id'] = $this->randString(25,strtoupper($_POST['site_name']).date('ymdhis').strtolower($_POST['site_name']));
                    $site_name['secret_key'] = $this->randString(15,date('ymdhis').strtoupper($_POST['site_name']).strtolower($_POST['site_name']));
                    $site_name['add_date'] = date('Ymdhis');                        		 
                    $site_name['active'] = 1;
                    unset($site_name['saveButton']);
                    if(is_array($site_name)){
                        $fields = array();
                        foreach($site_name as $key=>$site)
                        {
                                if($site!="" && isset($site))
                                {
                                    $fields[$key] = $site;
                                }                                    
                        }
                        $result=$this->insert($this->cfg['db_prefix'].'sites',$fields);
                    }
            }
            else
            {
                     return 'Please Fill the required Fields';
            }
		return isset($result['error'])?$result['error']:'success';
        }
	 
        
        
	 function getSiteByID()
	 {		
	 	 return $this->select($this->cfg['db_prefix'].'sites',"*",array("id"=>"1"));
	 }
	 
         function getSites()
	 {		                                        	 	 
	 	return $this->select($this->cfg['db_prefix'].'sites',"*");
	 }
         
         function statusActiveInactive($id){
             if($id != ''){
                        $st = ($this->getStatus($id) == 0) ? 1 : 0;
                        $fields = array("active" => $st);
                        $where = array("id" => $id);
                        $result = $this->update($this->cfg['db_prefix'].'sites', $fields, $where);
                    return isset($result['error'])?$result['error']:'success';
             }
         }
	   
         function getStatus($id){
             if($id != ''){                
                $result = $this->select($this->cfg['db_prefix'].'sites',"active",array("id"=>$id));
                return $result[0]['active'];
             }
         }  
         
          function getRecordsByStatus($status=0){
             if($status != ''){
                 $where = array(
                     'active'=>$status
                 );
                 $sites = $this->select($this->cfg['db_prefix'].'sites','*',$where);
                 if(is_array($sites)){ 
                                   $i = 1;
                                   foreach($sites as $site){ ?>
                                <tr>
                                    <td class="align-center"><?php echo $i; ?></td>
                                    <td><a href=""><?php echo $site['site_name']; ?></a></td>
                                    <td><?php echo $site['site_url']; ?></td>
                                    <td><?php echo $this->base64encode($site['site_id']); ?></td>
                                    <td><?php echo $this->base64encode($site['secret_key']); ?></td>
                                    <td><?php echo date('Y-m-d',  strtotime($site['add_date'])); ?></td>                                                                      
                                    <td>
                                    	<!--<input type="checkbox" />-->
                                        <a style="cursor:pointer;" onclick="statusChange('status<?php echo $i?>','<?php echo $site['id']; ?>','sitesFunctions');"><img id="status<?php echo $i?>" src="<?php echo ($site['active']  != 0) ? IMAGEPATH.'tick-circle.gif' : IMAGEPATH.'minus-circle.gif'; ?>" width="16" height="16" alt="published" /></a>
                                        <!--<a href=""><img src="<?php echo IMAGEPATH; ?>pencil.gif" width="16" height="16" alt="edit" /></a>-->
                                    </td>
                                </tr>
                                   <?php $i++; } }else { echo '<tr><td>No Sites Found.</td></tr>'; } 
             }
         }
}
