<?php
if ( ! defined('BASE_PATH')) exit('No direct script access allowed');

class subcategoriesFunctions extends AllFunctions
{    
    //-----Initialization -------	
	function addsubCategories()
        {
            if(!isset($_POST['saveButton']))
            {
               return false;
            } 
            if(($_POST['subcat_name']!='' && !empty($_POST['subcat_name'])) && ($_POST['cat_id']!='' && !empty($_POST['cat_id'])))
            {
                    $cate_name=$_POST;
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
                        $result=$this->insert($this->cfg['db_prefix'].'sub_category',$fields);
                    }
            }
            else
            {
                     return 'Please Fill the required Fields';
            }
		return isset($result['error'])?$result['error']:'success';
        }
	 
        
        function updatesubCategories(){
            if(!isset($_POST['editButton']))
            {
               return false;
            } 
            if(($_POST['subcat_name']!='' && !empty($_POST['subcat_name'])) && ($_POST['cat_id']!='' && !empty($_POST['cat_id'])))
            {
                                $fields = array("cat_id"=>$_POST['cat_id'],"subcat_name" => $_POST['subcat_name'], "update_date" => date('Ymdhis'));
                                $where = array("id" => $_POST['id']);  
                                $result = $this->update($this->cfg['db_prefix'].'sub_category', $fields, $where);
            }
            else
            {
                     return 'Please Fill the required Fields';
            }
		return isset($result['error'])?$result['error']:'success';
        }
	 function getsubCategoriesByID($id)
	 {		
             if($id != ''){
	 	 return $this->select($this->cfg['db_prefix'].'sub_category',"*",array("id"=>$id));
             }
             else
                 return false;
	 }
	 
         function getsubCategories()
	 {		                                        	 	 
	 	return $this->select($this->cfg['db_prefix'].'sub_category',"*");
	 }
         
         function statusActiveInactive($id){
             if($id != ''){
                        $st = ($this->getStatus($id) == 0) ? 1 : 0;
                        $fields = array("active" => $st);
                        $where = array("id" => $id);
                        $result = $this->update($this->cfg['db_prefix'].'sub_category', $fields, $where);
                    return isset($result['error'])?$result['error']:'success';
             }
         }
	   
         function getStatus($id){
             if($id != ''){                
                $result = $this->select($this->cfg['db_prefix'].'sub_category',"active",array("id"=>$id));
                return $result[0]['active'];
             }
         }
         
         // function for get main category name and id
         function getmainCategory(){
             $fields = array(
                 'id',
                 'cate_name'
             );              
                return $this->select($this->cfg['db_prefix'].'main_category',$fields);                          
         }
         
         function getmainCategory_name($catid=0){
             if($catid != ''){
                 $fields = array(
                     'cate_name'
                 );
                 $where = array("id" => $catid);
                 $result = $this->select($this->cfg['db_prefix'].'main_category',$fields,$where); 
                 return $result[0]['cate_name'];
             }
         }
         
          function getRecordsByStatus($status=0){
             if($status != ''){
                 $where = array(
                     'active'=>$status
                 );
                 $categories = $this->select($this->cfg['db_prefix'].'sub_category','*',$where);
                 if(is_array($categories)){ 
                                   $i = 1;
                                   foreach($categories as $category){ ?>
                                <tr>
                                    <td class="align-center"><?php echo $i; ?></td>
                                    <td><a href="?page=categories&cid=<?php echo $category['cat_id']; ?>"><?php echo $this->getmainCategory_name($category['cat_id']); ?></a></td>
                                    <td><a href="?page=subcategory&sid=<?php echo $category['id']; ?>"><?php echo $category['subcat_name']; ?></a></td>
                                    <td><?php echo date('Y-m-d',  strtotime($category['add_date'])); ?></td>
                                    <!--<td><?php ?></td>-->                                    
                                    <td>
                                    	<!--<input type="checkbox" />-->
                                        <a style="cursor:pointer;" onclick="statusChange('status<?php echo $i?>','<?php echo $category['id']; ?>','subcategoriesFunctions');"><img id="status<?php echo $i?>" src="<?php echo ($category['active']  != 0) ? IMAGEPATH.'tick-circle.gif' : IMAGEPATH.'minus-circle.gif'; ?>" width="16" height="16" alt="published" /></a>
                                        <!--<a href=""><img src="<?php echo IMAGEPATH; ?>pencil.gif" width="16" height="16" alt="edit" /></a>-->
                                    </td>
                                </tr>
                                   <?php $i++; } }else { echo '<td>No Sub-category Found.</td>'; }
             }
         }
}
?>
