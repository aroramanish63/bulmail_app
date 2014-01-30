<?php
class keywordFunctions extends AllFunctions
{    
    //-----Initialization -------	
	   function addKeywords()
    {
        if(!isset($_POST['saveButton']))
        {
           return false;
        } 
		if($_POST['region_id']!='' && $_POST['name_key']!='' && !empty($_POST['langValue']))
		{
			$regionId=$_POST['region_id'];
			$keyName=$_POST['name_key'];
 	  //	echo "<pre>";print_r($_POST);echo "</pre>"; 
 			$keywordsList= $_POST;
		//	echo "<pre>";print_r($keywordsList);echo "</pre>";die;
		
 		 	$langKeywords=$_POST['langValue'];
			 	//  	echo "<pre>";print_r($langKeywords);echo "</pre>";die;

			foreach($langKeywords as $key=>$valKey)
			{
				if($valKey!="" && isset($valKey))
				{
				$fields=array("lang_id"=>$key,"lang_key"=>$keyName,"lang_value"=>$valKey,"key_region"=>$regionId);
					
	 			$result=$this->insert($this->cfg['db_prefix'].'lang_keywords',$fields);
				}
			}
		 	 
	    }
	 	else
		{
			 return 'Please Fill the required Fields';
		}
		return isset($result['error'])?$result['error']:'success';
    }
	 
	 function getKeyWordsEnglish()
	 {		
	 	 	 	return $this->select($this->cfg['db_prefix'].'lang_keywords',"*",array("id"=>"1"));

 
	 }
	  function getLanguageList()
	 {		                                        
	 	 
	 	return $this->select($this->cfg['db_prefix'].'language',"*");

	 }
	  function getSiteRegion()
	 {		                                        
	 	 
	 	return $this->select($this->cfg['db_prefix'].'site_region',"*");

	 }
	   
}
?>