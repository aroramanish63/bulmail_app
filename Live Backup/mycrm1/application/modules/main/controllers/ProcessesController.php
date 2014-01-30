<?php

class Main_ProcessesController extends Zend_Controller_Action
{

  public function processeslistAction()
    {
	
	
	/* Comments :  Fetching process list */
	
	
	$this->_helper->layout()->setLayout('layoutadmin');
        $processes = new Application_Model_ProcessesMapper();
     $this->view->processeslist = $processes->fetchAll();
	 
	 		 $request = $this->getRequest();
		$DeleteId = $request->getParam('DeleteId');
	
	
	/* Comments :  Deleting process w.r.t. Id */
		
		if($DeleteId!="")
		 {
					$DB = Zend_Registry::get('DB');
			$Sql = "delete from processes where Id='".$DeleteId."'";
			$Data = $DB->query($Sql);	 
			
		     $this->_redirect(SITE_URL_PUBLIC_P.'main/processes/processeslist');
		 } 

	}
	
	public function processesaeAction()
	 {
	   	$this->_helper->layout()->setLayout('layoutadmin');
		
		
		 $request = $this->getRequest();
		$EditId = $request->getParam('EditId');
		
		
		/* Comments : Editing process . findrow() function id defined in a model of process in which this function fetch the process depending upon the process id passed through it  */
		
		if($EditId!="")
		 {
		    $users = new Application_Model_ProcessesMapper();
			$this->view->users = $users->findrow($EditId);	   
		 }
		
         $this->view->actionc = SITE_URL_PUBLIC_P.'main/processes/processesprocess';
	 }
	 
	 public function processesprocessAction()
	  {
	    		$request = $this->getRequest();
		$Id = $request->getParam('Id');
		$Name = $request->getParam('Name');
		$Description = $request->getParam('Description');
		$ProcessDate = $request->getParam('ProcessDate');
		$IsActive = $request->getParam('IsActive');
		
		$data = array(
		    'Name'=>"$Name",
            'Description'=>"$Description",
            'ProcessDate'=>"$ProcessDate",
			'IsActive'=>"$IsActive"
		  );
		  
		  if($Id!="")
		   {
		  $data['Id'] = $Id;
		  }
		  
		  
		  /* Comments :  Pass the array  of recived data from inputs into the Application_Model_Processes to get the set value */
		  
		  $cc = new Application_Model_Processes($data);
		  
		  $mapper = new Application_Model_ProcessesMapper();
		  $mapper->save($cc);
		  
		  $this->_redirect(SITE_URL_PUBLIC_P.'main/processes/processeslist');
	  }


  public function processformsAction()
   {
   
   /* Comments : time_start is used to start call time */
   
    $time_start = microtime(true); 
   
     $this->_helper->layout()->setLayout('layoutadmin');
	


/* Comments : fetching all the information to show th records of the existing customer */	
	 
/* start */ 
$userprocessesdata1 = new Application_Model_UserproocessdataMapper();
$this->view->userprocesseslist1 = $userprocessesdata1->fetchAll();

$processes1 = new Application_Model_ProcessesMapper();
$this->view->processes1 = $processes1->fetchAll();

$users1 = new Application_Model_UsersMapper();
$this->view->users1 = $users1->fetchAll();

$userdetails1 = new Application_Model_UserproocessdatadetailsMapper(); 
$this->view->userdetails1 = $userdetails1->fetchAll();
/* end */ 
	   	 
	 
	
	 
	$request = $this->getRequest();
	$form  = new Application_Form_Processform();


$form->setAttrib('id', 'processform');




$searchtext = $request->getParam('searchtext');
$searchby = $request->getParam('searchby');


/* Comments : Search text on the basis of email and phone number*/

if($searchtext!="")
 {
   $this->view->searchtext = $searchtext;
   $this->view->searchby = $searchby;
   $sssssss = new Application_Model_UserproocessdataMapper();
   try
    {
   $this->view->searchresult = $sssssss->searchrow($searchtext,$searchby);
   }
   catch(Exception $e)
    {
	  $this->view->error = 'No record found';
	}
 }
 
		  


/* Comments : Assigning process in the drop down : Zend_Form*/

$ProcessesData = array();
$ProcessesData[''] = 'Select';
$processes = new Application_Model_ProcessesMapper();
$processeslist = $processes->fetchAll();
foreach($processeslist as $vv)
{
if(in_array($vv->getId(),$_SESSION['userprocess']) or $_SESSION['userttypeid']==1)
{
$ProcessesData[$vv->getId()] = $vv->getName();
}
}
$form->processid->setMultiOptions($ProcessesData);


$processplan = new Application_Model_ProcessplanMapper();
$this->view->processplanlist = $processplan->fetchAll();




/* Comments : Assigning Coupons in the drop  down : Zend_Form*/

$Arr = array(''=>'Select');

$Dbn = Zend_Registry::get('DBAsk');

$Sql = "select coupon_code,coupon_value from Coupon1 where coupon_code like 'GEN%'";

$Rrr = $Dbn->fetchAssoc($Sql);

foreach($Rrr as $key=>$val)
 {
  $Arr[$val['coupon_value']] =  $val['coupon_code'].' ( '.$val['coupon_value'].' ) ';
 }

$form->salesamount->setMultiOptions($Arr);




	     if ($this->_request->isPost()) {
            $formData = $this->_request->getPost();
			
			$Disposition = $request->getParam('disposition');

/* Comments : Making the fields : planid , salesamount , orderid required : if Dispostion Selected is Sales - 1*/

   if($Disposition=="1")
   {
   $form->planid->setRequired(true);
   $form->salesamount->setRequired(true);
   $form->orderid->setRequired(true);
   }

            if ($form->isValid($formData)) {
			
				
$Userprocessdataid = $request->getParam('userprocessdataid');
$Title = $request->getParam('title');
$Firstname = $request->getParam('firstname');
$Middlename = $request->getParam('middlename');
$Lastname = $request->getParam('lastname');
$Phonenumber = $request->getParam('phonenumber');
$Email = $request->getParam('email');
$Othersdetails = $request->getParam('othersdetails');
$Processid = $request->getParam('processid');
$Calltype = $request->getParam('calltype');
$Disposition = $request->getParam('disposition');
$Planid = $request->getParam('planid');
$Salesamount = $request->getParam('salesamount');
$Issues = $request->getParam('issues');
$Solutions = $request->getParam('solutions');
$Orderid = $request->getParam('orderid');
$Casenumber = $request->getParam('casenumber');
$Teamviewerid = $request->getParam('teamviewerid');
$Userid = $request->getParam('userid');
$Calldate = $request->getParam('calldate');
$Starttime = $request->getParam('starttime');
$Endtime = $request->getParam('endtime');
//$Salesagent = $request->getParam('salesagent');
$Salesagent = 'none';
$PaymentGateway = $request->getParam('paymentgateway');
$GatewayRefernceNumber = $request->getParam('gatewayreferncenumber');
$Bound = $request->getParam('bound');

$Middlename  = " ";
$Lastname  = " ";


$DB = Zend_Registry::get('DB');
$Sqlnn = "select * from processplan where Id = '$Planid'";

$Rrrnn = $DB->fetchRow($Sqlnn);
$price = $Rrrnn->Price;

/* Comments : Subtracting orignal price of the plan with the discount selected from the front end */
$Salesamount = (float)$price - (float)$Salesamount;



$arr1 = array(
'Title' => "$Title",
'Firstname' => "$Firstname",
'Middlename' => "$Middlename",
'Lastname' => "$Lastname",
'Phonenumber' => "$Phonenumber",
'Email' => "$Email",
'Othersdetails' => "$Othersdetails"
);

if($Userprocessdataid!="")
{
  $arr1['Id'] = $Userprocessdataid;
}
 

 
		  $cc1 = new Application_Model_Userproocessdata($arr1);
		 $mapper1 = new Application_Model_UserproocessdataMapper();
		 

		 
		  try
           {
	    	  $Customerid = $mapper1->save($cc1);
			  
			  $time_end = microtime(true);
			$arr2 = array(
			'Processid' => "$Processid",
			'Calltype' => "$Calltype",
			'Disposition' => "$Disposition",
			'Planid' => "$Planid",
			'Salesamount' => "$Salesamount",
			'Issues' => "$Issues",
			'Solutions' => "$Solutions",
			'Orderid' => "$Orderid",
			'Casenumber' => "$Casenumber",
			'Teamviewerid' => "$Teamviewerid",
			'Userid' => "$Userid",
			'Calldate' => date("Y-m-d H:i:s"),
			'Starttime' => "$time_start",
			'Endtime' => "$time_end",
			'Salesagent' => "$Salesagent",
			'PaymentGateway' => "$PaymentGateway",
			'GatewayRefernceNumber' => "$GatewayRefernceNumber",
			'Bound' => "$Bound",
			'Customerid' => "$Customerid"
			); 
			 // $arr2['Customerid'] = $Customerid;
			  
		 $cc2 = new Application_Model_Userproocessdatadetails($arr2);
		 $mapper2 = new Application_Model_UserproocessdatadetailsMapper(); 
		 $mapper2->save($cc2);
			   
		     $this->view->msg = 'Submitted successfully .. Thank you .';
		   }
		   catch(Exception $e)
		    {
			  $strr1 = strpos($e,'Duplicate');
			  $this->view->msg = str_replace('key','',str_replace('in D:\x','',substr($e,$strr1,$strr1-32)));
			  // substr($e,$strr1,$strr1-41);
			}
			
		  
            } else {
                $form->populate($formData);
            }
        }

        $this->view->form = $form;
		
   }

 
 public function getplansAction()
  {
   $this->_helper->layout()->disableLayout('layoutadmin');
   
   $request = $this->getRequest();
   $processid121 = $request->getParam('processiddd');

		if($processid121!="")
		{
			$processplan = new Application_Model_ProcessplanMapper();
			$processplanlist = $processplan->findrow($processid121);
			
			$arrPlanlist = array();
			foreach($processplanlist as $vvv)
			 {
			   $arrPlanlist[$vvv->Id] = $vvv->Title.' ( '.$vvv->Price.' ) ';  
			 }
		} 

   $this->view->arrPlanlist = $arrPlanlist;
  
  }  
  
   
   
    public function processesassignAction()
	 {
	   $this->_helper->layout()->setLayout('layoutadmin');
	   
	   $request = $this->getRequest();
	   $UId = $request->getParam('PUId');
	   
	   
	     $users = new Application_Model_UsersMapper();
		$this->view->users = $users->findrow($UId);	  
	
	        $processes = new Application_Model_ProcessesMapper();
     $this->view->processeslist = $processes->fetchAll();	
	 
	 	        $userprocesses = new Application_Model_UserprocessMapper();
     $this->view->userprocesses = $userprocesses->fetchAll();		
	 }
   

   public function processesassignprocessAction()
    {
	
	 	   $request = $this->getRequest();
	   
	   $UserProcessId = $request->getParam('UserProcessId');
	   $UId = $request->getParam('PUId');
	   $ProcessId = $request->getParam('ProcessId');
	   $Active = $request->getParam('Active');
	   
	   if($Active=="") { $Active=0; }
	   
	   $data = array(
	   'UserId'=>"$UId",
	   'ProcessId'=>"$ProcessId",
	   'IsActive'=>"$Active"
	      );
		  
		  if($UserProcessId!="")
		   {
		     $data['Id'] = $UserProcessId;
		   }
		  
	   	   $cc = new Application_Model_Userprocess($data);
		  $mapper = new Application_Model_UserprocessMapper();
		  $mapper->save($cc);
	 
	 $this->_redirect(SITE_URL_PUBLIC_P.'main/processes/processesassign/PUId/'.$UId);
		  
	}

  
    public function processesplanlistAction()
	 {
	   $this->_helper->layout()->setLayout('layoutadmin');
	   
	   
	   $request = $this->getRequest();
	   $processid = $request->getParam('processid');
	   $this->view->processid = $processid;
	   
	   $processplan = new Application_Model_ProcessplanMapper();
       $this->view->processplanlist = $processplan->findrow($processid);
	   
	   
	   	 		 $request = $this->getRequest();
		$DeleteId = $request->getParam('DeleteID');
		
		if($DeleteId!="")
		 {
			$DB = Zend_Registry::get('DB');
			$Sql = "delete from processplan where Id='".$DeleteId."'";
			$Data = $DB->query($Sql);	 
		    $this->_redirect(SITE_URL_PUBLIC_P.'main/processes/processesplanlist/processid/'.$processid);
		 } 
		 

	  }
	  
	  
	  public function processesplanaeAction()
	 {
	   $this->_helper->layout()->setLayout('layoutadmin');
	   
	      $request = $this->getRequest();
	   $processid = $request->getParam('processid');
	   $this->view->processid = $processid;
	   
	     $EditId = $request->getParam('EditID');
	   		if($EditId!="")
		 {
		    $processplan = new Application_Model_ProcessplanMapper();
			$this->view->processplan = $processplan->findrowById($EditId);	   
		 }
		 
	   $this->view->action = SITE_URL_PUBLIC_P.'main/processes/processesplanprocess';
	  } 


   public function processesplanprocessAction()
    {
	
	 	   $request = $this->getRequest();
	   
	   $Id = $request->getParam('Id');
	   $Title = $request->getParam('Title');
	   $ProcessId = $request->getParam('ProcessId');
	   $Description = $request->getParam('Description');
	   $Price = $request->getParam('Price');
	   $Currency = $request->getParam('Currency');
	   $IsActive = $request->getParam('IsActive');
	   
	   if($IsActive=="") { $IsActive=0; }
	   
	   $data = array(
	   'Title'=>"$Title",
	   'ProcessId'=>"$ProcessId",
	   'Description'=>"$Description",
	   'Price'=>"$Price",
	   'Currency'=>"$Currency",
	   'IsActive'=>"$IsActive"
	      );
		  
		  if($Id!="")
		   {
		     $data['Id'] = $Id;
		   }
		  
	   	   $cc = new Application_Model_Processplan($data);
		  $mapper = new Application_Model_ProcessplanMapper();
		  $mapper->save($cc);
	 
	 $this->_redirect(SITE_URL_PUBLIC_P.'main/processes/processesplanlist/processid/'.$ProcessId);
		  
	}
	

}
