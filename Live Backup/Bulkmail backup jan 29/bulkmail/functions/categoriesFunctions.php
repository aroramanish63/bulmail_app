<?php
if ( ! defined('BASE_PATH')) exit('No direct script access allowed');

class categoriesFunctions extends AllFunctions
{    
    //-----Initialization -------	
	function addCategories()
        {
            if(!isset($_POST['saveButton']))
            {
               return false;
            } 
            if($_POST['cate_name']!='' && !empty($_POST['cate_name']))
            {
                    $cate_name=$_POST;
                    if(is_array($cate_name['cate_name'])){
                        return $this->insertMultiplecat($cate_name['cate_name']);
                    }       
                    else{
                             $cate_name['add_date'] = date('Ymdhis');                        		 
                             $cate_name['active'] = 1;                   
                            unset($cate_name['saveButton']);
                            if(is_array($cate_name)){
                                $fields = array();
                                foreach($cate_name as $key=>$cat)
                                {
                                        if($cat!="" && isset($cat))
                                        {
                                            $fields[$key] = $cat;
                                        }                                    
                                }
                                $result=$this->insert($this->cfg['db_prefix'].'main_category',$fields);
                            } 
                  }
            }
            else
            {
                     return 'Please Fill the required Fields';
            }
		return isset($result['error'])?$result['error']:'success';
        }
	 
        
        function updateCategories(){
            if(!isset($_POST['editButton']))
            {
               return false;
            } 
            if($_POST['cate_name']!='' && !empty($_POST['cate_name']))
            {        
                                $fields = array();
                                $fields = array("cate_name" => $_POST['cate_name'], "update_date" => date('Ymdhis'));
                                $where = array("id" => $_REQUEST['id']);              
                                $result=$this->update($this->cfg['db_prefix'].'main_category',$fields,$where);             
            }
            else
            {
                     return 'Please Fill the required Fields';
            }
		return isset($result['error'])?$result['error']:'success';
        }
         function getCategoriesByID($id)
	 {		
	 	 return $this->select($this->cfg['db_prefix'].'main_category',"*",array("id"=>$id));
	 }
	 
         function getCategories()
	 {		                                        	 	 
	 	return $this->select($this->cfg['db_prefix'].'main_category',"*");
	 }
         
         function statusActiveInactive($id){
             if($id != ''){
                        $st = ($this->getStatus($id) == 0) ? 1 : 0;
                        $fields = array("active" => $st);
                        $where = array("id" => $id);
                        $result = $this->update($this->cfg['db_prefix'].'main_category', $fields, $where);
                    return isset($result['error'])?$result['error']:'success';
             }
         }
	   
         function getStatus($id){
             if($id != ''){                
                $result = $this->select($this->cfg['db_prefix'].'main_category',"active",array("id"=>$id));
                return $result[0]['active'];
             }
         }
         
         function insertMultiplecat($catname = array()){
             if(is_array($catname) && (strlen(implode($catname)) != 0)){
                 $cate_name = array();
                 foreach($catname as $cat){
                     $cate_name['cate_name'] = $cat;
                     $cate_name['add_date'] = date('Ymdhis');                        		 
                     $cate_name['active'] = 1;  
                     
                     $result=$this->insert($this->cfg['db_prefix'].'main_category',$cate_name);
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
                 $categories = $this->select($this->cfg['db_prefix'].'main_category','*',$where);
                 if(is_array($categories)){ 
                                   $i = 1;
                                   foreach($categories as $category){ ?>
                                <tr>
                                    <td class="align-center"><?php echo $i; ?></td>
                                    <td><a href="?page=categories&cid=<?php echo $category['id']; ?>"><?php echo $category['cate_name']; ?></a></td>
                                    <td><?php echo date('Y-m-d',  strtotime($category['add_date'])); ?></td>
                                    <!--<td><?php ?></td>-->                                    
                                    <td>
                                    	<!--<input type="checkbox" />-->
                                        <a style="cursor:pointer;" onclick="statusChange('status<?php echo $i?>','<?php echo $category['id']; ?>','categoriesFunctions');"><img id="status<?php echo $i?>" src="<?php echo ($category['active']  != 0) ? IMAGEPATH.'tick-circle.gif' : IMAGEPATH.'minus-circle.gif'; ?>" width="16" height="16" alt="published" /></a>
                                        <!--<a href=""><img src="<?php echo IMAGEPATH; ?>pencil.gif" width="16" height="16" alt="edit" /></a>-->
                                    </td>
                                </tr>
                                   <?php $i++; } }else { echo '<td>No Category Found.</td>'; }
             }
         }
}

?>