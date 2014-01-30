<?php


class Main_UsersController extends Zend_Controller_Action
{

	

  public function userlistAction()
    {
	
	
	/* Comments :  Fetching list of users */
	
	
		$this->_helper->layout()->setLayout('layoutadmin');
		$users = new Application_Model_UsersMapper();
		$this->view->userlist = $users->fetchAll();
			 
		$request = $this->getRequest();
		$DeleteId = $request->getParam('DeleteId');



   /* Comments :  Delete the user on the basis of user id */

		if($DeleteId!="")
		{		
			$DB = Zend_Registry::get('DB');
			$Sql = "delete from users where Id='".$DeleteId."'";
			$Data = $DB->query($Sql);	 
			$this->_redirect(SITE_URL_PUBLIC_P.'main/users/userlist');
		}	
	}
	
	public function useraeAction()
	 {
	   	$this->_helper->layout()->setLayout('layoutadmin');
	
	/* Comments :  Sorting users having user type 1  or 3 */
		
			      $usersSort = new Application_Model_UsersMapper();
     $userlistsort = $usersSort->getDbTable();
	 $usrsort = $userlistsort->select()->where('UserType = 1 OR UserType = 3');
	 $this->view->userlistsort = $userlistsort->fetchAll($usrsort); 


		
		 $request = $this->getRequest();
		$EditId = $request->getParam('EditId');
		
		
		/* Comments :  Editing the user on the basis of user id , fetchrow is the function defined in Usermapper model , that fetch the user depending upon the user id */
		
		
		if($EditId!="")
		 {
		    $users = new Application_Model_UsersMapper();
			$this->view->users = $users->findrow($EditId);	   
		 }
		
         $this->view->actionc = SITE_URL_PUBLIC_P.'main/users/userprocess';
	 }
	 
	 public function userprocessAction()
	  {
	  
	  
	  /* Comments :  User process action . */
	  
	  
	  
	  
	  /* Comments : fetching data from all input  */
	  
	    		$request = $this->getRequest();
		$Id = $request->getParam('Id');
		$Name = $request->getParam('Name');
		$Username = $request->getParam('Username');
		$Password = $request->getParam('Password');
		$UserType = $request->getParam('UserType');
		$UserTypeTT = $request->getParam('UserTypeTT');
		$ReportTo = $request->getParam('ReportTo');
		$Center = $request->getParam('Center');
		$IsActive = $request->getParam('IsActive');
		
		$data = array(
		     'Name'   => "$Name",
            'Username' => "$Username",
            'Password' => "$Password",
			'UserType' => "$UserType",
			'UserTypeTT' => "$UserTypeTT",
			'ReportTo' => "$ReportTo",
			'Center' => "$Center",
			'IsActive' => "$IsActive"
		  );
		  
		  if($Id!="")
		   {
		  $data['Id'] = $Id;
		  }
		  
		  
		  /* Comments : Passing array into Model thus setting the parameter and getting it  */
		  
		  $cc = new Application_Model_Users($data);
		  
		  
		  /* Comments :  Save the data*/
		  
		  $mapper = new Application_Model_UsersMapper();
		  $mapper->save($cc);
		  
		  $this->_redirect(SITE_URL_PUBLIC_P.'main/users/userlist');
	  }
	  
	  
	  public function userreportAction()
	   {
	     	$this->_helper->layout()->setLayout('layoutadmin');
			

          /* Comments :  Report of the user */


/* Comments :  Fetching all the process */
		
		 $processes = new Application_Model_ProcessesMapper();
          $this->view->processes = $processes->fetchAll();
	   
	   
	 
	 /* Comments :  Fetching the users */
	   
	           $users = new Application_Model_UsersMapper();
     $this->view->users = $users->fetchAll();
	 
	 

	 /* Comments :  Fetching process plans */  
	   
	  $processplan = new Application_Model_ProcessplanMapper();
		$this->view->processplanlist = $processplan->fetchAll(); 
	   





/* Comments :  When clicked on the search bar ,  controller will get all the parameters */

$request = $this->getRequest();
	$bsubmit = $request->getParam('bsubmit');	
    if($bsubmit=="Search")
	 {		
	 
	 /* Comments : Assigning to the variables */
	 
		$DateFrom = $request->getParam('DateFrom');
		$DateTo = $request->getParam('DateTo');
		$FirstName = $request->getParam('FirstName');
		$MiddleName = $request->getParam('MiddleName');
		$LastName = $request->getParam('LastName');
		$PhoneNumber = $request->getParam('PhoneNumber');
		$Email = $request->getParam('Email');
		$Processid = $request->getParam('Processid');
		$Calltype = $request->getParam('Calltype');
		$Disposition = $request->getParam('Disposition');
		$Planid = $request->getParam('Planid');
		$Salesamount = $request->getParam('Salesamount');
		$Issues = $request->getParam('Issues');
		$Solutions = $request->getParam('Solutions');
		$Orderid = $request->getParam('Orderid');
		$Casenumber = $request->getParam('Casenumber');
		$Teamviewerid = $request->getParam('Teamviewerid');
		$Calldate = $request->getParam('Calldate');
		$Salesagent = $request->getParam('Salesagent');
		$PaymentGateway = $request->getParam('PaymentGateway');
		$Center = $request->getParam('Center');
		
        print_r($_REQUEST);

/* Comments :  then creating a variable view for it so as to get values on front end */

		$this->view->DateFrom = $DateFrom;
		$this->view->DateTo = $DateTo;
		$this->view->FirstName = $FirstName;
		$this->view->MiddleName = $MiddleName;
		$this->view->LastName = $LastName;
		$this->view->PhoneNumber = $PhoneNumber;
		$this->view->Email = $Email;
		
		$this->view->Processid = $Processid;
		$this->view->Calltype = $Calltype;
		$this->view->Disposition = $Disposition;
		$this->view->Planid = $Planid;
		$this->view->Salesamount = $Salesamount;
		$this->view->Issues = $Issues;
		$this->view->Solutions = $Solutions;
		$this->view->Orderid = $Orderid;
		$this->view->Casenumber = $Casenumber;
		$this->view->Teamviewerid = $Teamviewerid;
		$this->view->Calldate = $Calldate;
		$this->view->Salesagent = $Salesagent;
		$this->view->PaymentGateway = $PaymentGateway;
		$this->view->Center = $Center;
		
		
		$this->view->bsubmit = $bsubmit;
		


	 
	 
	 /* Comments :  in the code in between nis start and nis end ::  depending upon the value that need to be searched , query with the model is performed 
	 
 Note : in Date From - Date To :: Report is generated , with the increment of ::   [ date + 6 hours 45 minutes ]   
	 */
	 
	 
	 /*nis start*/
	 
	 $usersSort1 = new Application_Model_UserproocessdatadetailsMapper();
	$userlistsort = $usersSort1->getDbTable();
	$select = $userlistsort->select();
	
	
	 	 if($DateFrom!="" and $DateTo!="")
	  {
	  
		$DateFrom = strtotime($DateFrom)+(6 * 3600)+(45/60*3600);
		$DateTo = strtotime($DateTo)+(30 * 3600)+(45/60*3600)-1;
		$select->where('UNIX_TIMESTAMP(Calldate) >= ?',$DateFrom)->where('UNIX_TIMESTAMP(Calldate) <= ?',$DateTo);
		
	  }
	  
	  
	 if($Processid!="")
	  {
	    $select->where('Processid = ?', $Processid);
	  }
	  	 if($Calltype!="")
	  {
	    $select->where('Calltype = ?', $Calltype);
	  }
	  
	   if($Disposition!="")
	  {
	    $select->where('Disposition = ?', $Disposition);
	  }
	   	 if($Planid!="")
	  {
	    $select->where('Planid = ?', $Planid);
	  }
	   	 if($Salesamount!="")
	  {
	    $select->where('Salesamount = ?', $Salesamount);
	  }
	   	 if($Orderid!="")
	  {
	    $select->where('Orderid = ?', $Orderid);
	  }
	   	 if($Casenumber!="")
	  {
	    $select->where('Casenumber = ?', $Casenumber);
	  }
	   	 if($Teamviewerid!="")
	  {
	    $select->where('Teamviewerid = ?', $Teamviewerid);
	  }
	  
	  	 if($Calldate!="")
	  {
	    $select->where('DATE(Calldate) = ?', $Calldate);
	  }
	  
	  	   	 if($Salesagent!="")
	  {
	    $select->where('Userid = ?', $Salesagent);
	  }
	  
	    	   	 if($PaymentGateway!="")
	  {
	    $select->where('Paymentgateway = ?', $PaymentGateway);
	  }



if($Center!="")
 {
$select->setIntegrityCheck(false);
$select->from("userproocessdataz_details");
$select->join("users", "userproocessdataz_details.Userid = users.Id and users.Center = $Center");
}

 

	 //$this->view->userdetails = $userlistsort->fetchAll($select);
	
		 /*nis End*/
	
    
	 
	$usersSort1 = new Application_Model_UserproocessdataMapper();
	$userlistsort = $usersSort1->getDbTable();
	$select = $userlistsort->select();
	
	 if($FirstName!="")
	  {
	    $select->where('Firstname like ?', '%'.$FirstName.'%');
	  }
	  
	   if($MiddleName!="")
	  {
	    $select->where('Middlename = ?', '%'.$MiddleName.'%');
	  } 
	  
	  if($LastName!="")
	  {
	    $select->where('Lastname = ?', '%'.$LastName.'%');
	  }
	  
	    if($PhoneNumber!="")
	  {
	    $select->where('Phonenumber = ?', '%'.$PhoneNumber.'%');
	  }
	  
	      if($Email!="")
	  {
	    $select->where('Email = ?', '%'.$Email.'%');
	  }
	  var_dump($select);
      
	  //print_r($userlistsort->fetchAll($select));
	//$dfjd = $userlistsort->fetchAll($select);
$this->view->userprocesseslist = $userlistsort->fetchAll($select);

//print_r($userlistsort->fetchAll($select));
	//die("asasa11");	
   
     }
	 else
	 {
	 
	// 		$userprocessesdata = new Application_Model_UserproocessdataMapper();
	//	$this->view->userprocesseslist = $userprocessesdata->fetchAll();
		
		
	 //  	  $userdetails = new Application_Model_UserproocessdatadetailsMapper(); 
	//   $this->view->userdetails = $userdetails->fetchAll();
	 }

 
 
 /* Comments :  export the searched report to Excel i.e. .xls format */
 
	   $request = $this->getRequest();
	   $export = $request->getParam('export');
	   if($export==1)
	    {
		
		  $tt = $this->exportuserreportlist();
		  $this->_redirect(SITE_URL_PUBLIC_P.'main/users/userreport');
		}
		
			   if($export==2)
	    {
		
		  $tt = $this->exportagentreportlist();
		  $this->_redirect(SITE_URL_PUBLIC_P.'main/users/userreport');
		}
	   
	   }
	   
	  
 
 public function getuserdetailsAction()
  { 
 
		
		/* Comments :  This action is not in use right now , but it is not removed because it may be reqired in coming future .
		
		It has been created to fetch user details depending upon the customer id 
		*/
		
		
			$this->_helper->layout()->disableLayout('layout');
	
	
  
   $request = $this->getRequest();
   $exp = explode("^",$request->getParam('customerid'));
   
   $this->view->customerid = $exp[0];
   $this->view->shid = $exp[1];
$processid = $exp[2];
$bsubmit = $exp[3];
$calltype = $exp[4];
$Disposition = $exp[5];
$Planid = $exp[6];
$Salesamount = $exp[7];
$Issues = $exp[8];
$Solutions = $exp[9];
$Orderid = $exp[10];
$Casenumber = $exp[11];
$Teamviewerid = $exp[12];
$Calldate = $exp[13];
$Salesagent = $exp[14];
$PaymentGateway = $exp[15];

$DateFrom = $exp[16];
$DateTo = $exp[17];
   		
		 $processes = new Application_Model_ProcessesMapper();
          $this->view->processes = $processes->fetchAll();
	   
	   
		$processplan = new Application_Model_ProcessplanMapper();
		$this->view->processplanlist = $processplan->fetchAll();
			
			
		
			 
			 
	           $users = new Application_Model_UsersMapper();
     $this->view->users = $users->fetchAll();
	 


  if($bsubmit!="")
 {
	$usersSort1 = new Application_Model_UserproocessdatadetailsMapper();
	$userlistsort = $usersSort1->getDbTable();
	$select = $userlistsort->select();
	
	

	
	 	 if($DateFrom!="" and $DateTo!="")
	  {
	  
	  			$DateFrom = strtotime($DateFrom)+(6 * 3600)+(45/60*3600);
		$DateTo = strtotime($DateTo)+(30 * 3600)+(45/60*3600)-1;
		$select->where('UNIX_TIMESTAMP(Calldate) >= ?',$DateFrom)->where('UNIX_TIMESTAMP(Calldate) <= ?',$DateTo);
		
	
	  }
	  
	  
	 if($processid!="")
	  {
	    $select->where('Processid = ?', $processid);
	  }
	  	 if($calltype!="")
	  {
	    $select->where('Calltype = ?', $calltype);
	  }
	  
	   if($Disposition!="")
	  {
	    $select->where('Disposition = ?', $Disposition);
	  }
	   	 if($Planid!="")
	  {
	    $select->where('Planid = ?', $Planid);
	  }
	   	 if($Salesamount!="")
	  {
	    $select->where('Salesamount = ?', $Salesamount);
	  }
	   	 if($Orderid!="")
	  {
	    $select->where('Orderid = ?', $Orderid);
	  }
	   	 if($Casenumber!="")
	  {
	    $select->where('Casenumber = ?', $Casenumber);
	  }
	   	 if($Teamviewerid!="")
	  {
	    $select->where('Teamviewerid = ?', $Teamviewerid);
	  }
	  
	  	 if($Calldate!="")
	  {
	    $select->where('DATE(Calldate) = ?', $Calldate);
	  }
	  
	  	   	 if($Salesagent!="")
	  {
	    $select->where('Userid = ?', $Salesagent);
	  }
	  
	    	   	 if($PaymentGateway!="")
	  {
	    $select->where('Paymentgateway = ?', $PaymentGateway);
	  }
	  
	  
	$dfjd = $userlistsort->fetchAll($select);
    $this->view->userdetails = $dfjd;	  
 }
 else
  {	  	  
	$userdetails = new Application_Model_UserproocessdatadetailsMapper(); 
	$this->view->userdetails = $userdetails->fetchAll();
  }
  
}	  
	  
	   
  private function exportuserreportlist()
			{
			  
		
		/* Comments :  Export to Excels .xls */		 
			
			$xls=new PHP_XLS();                  //create excel object
			$xls->AddSheet('User Report');      //add a work sheet
			
			/*next section will create the styles for the cells (borders, background,...)*/
			$xls->NewStyle('hd_t');          //header with top border     
			$xls->StyleSetBackground('#3B9C9C');    //color
			$xls->StyleSetFont('arial', 10, '#FFFFFF', 1, 0, 0);  //font parameters
			$xls->StyleSetAlignment(-1, 0);         //cell alignment
			$xls->StyleAddBorder("Top", '#000000', 2);  //top border
			$xls->StyleAddBorder("Right", '#000000', 1);  //right thin border separating header cells
			$xls->CopyStyle('hd_t','hd_l');  // now we just copy the header with top border to header_left 
			$xls->StyleAddBorder("Left", '#000000', 2);  //and set the left border 
			$xls->CopyStyle('hd_t','hd_r');  //copy the header wit top border to header_right
			$xls->StyleAddBorder("Right", '#000000', 2);  //and thicken the right border so it will end the table
			
			/*we write the header content into the object*/
			$xls->SetActiveStyle('hd_l'); //first cell have header_left style
			
					 
				/*next we set the header cell sizes*/
			$xls->SetRowHeight(1,20);
			$xls->SetColWidth(1,150);
			$xls->Text(1,1,'#');
			$xls->SetColWidth(2,150);
			$xls->Text(1,2,'Date');
			$xls->SetColWidth(3,150);
			$xls->Text(1,3,'Time');
			$xls->SetColWidth(4,150);
			$xls->Text(1,4,'Customer name');
		/*	$xls->SetColWidth(5,150);
			$xls->Text(1,5,'Email id');
			$xls->SetColWidth(6,150);
			$xls->Text(1,6,'Contact Number');*/
			$xls->SetColWidth(5,150);
			$xls->Text(1,5,'Case number');
			$xls->SetColWidth(6,150);
			$xls->Text(1,6,'Call Type');
/*			$xls->SetColWidth(7,150);
			$xls->Text(1,7,'Process');*/
			$xls->SetColWidth(7,150);
			$xls->Text(1,7,'Plan name');
			$xls->SetColWidth(8,150);
			$xls->Text(1,8,'Sales price');
			$xls->SetColWidth(9,150);
			$xls->Text(1,9,'Order id');
			$xls->SetColWidth(10,150);
			$xls->Text(1,10,'Login Agent User');
			$xls->SetColWidth(11,150);
			$xls->Text(1,11,'Sales Agent');
/*			$xls->SetColWidth(13,150);
			$xls->Text(1,13,'Assigned to');*/
			$xls->SetColWidth(12,150);
			$xls->Text(1,12,'Campaign');
/*			$xls->SetColWidth(15,150);
			$xls->Text(1,15,'Time');*/
			$xls->SetColWidth(13,150);
			$xls->Text(1,13,'Team Viewer ID');
			$xls->SetColWidth(14,150);
			$xls->Text(1,14,'Assigned To');
			$xls->SetColWidth(15,450);
			$xls->Text(1,15,'Comments');
			$xls->SetColWidth(16,150);
			$xls->Text(1,16,'Payment Gateway');
			$xls->SetColWidth(17,150);
			$xls->Text(1,17,'Currency');
			$xls->SetColWidth(18,150);
			$xls->Text(1,18,'Gateway Reference Number');
			$xls->SetColWidth(19,150);
			$xls->Text(1,19,'Shift Date');
			$xls->SetColWidth(20,150);
			$xls->Text(1,20,'Center');
			//$xls->SetColWidth(21,150);
			//$xls->Text(1,21,'Email');

			
				
			$xls->SetActiveStyle('hd_r');  //and the cell in last column is header_right 
			/*now we have the header inserted into worksheet*/
			
			/*for the content we need a style with the top and right borders*/
			$xls->NewStyle('center');
			$xls->StyleSetAlignment(-1, 0);
			$xls->StyleAddBorder("Top", '#000000', 1);
			$xls->StyleAddBorder("Right", '#000000', 1);
			$xls->CopyStyle('center','center_l'); //this style is for the first column
			$xls->StyleAddBorder("Left", '#000000', 1);
			$xls->CopyStyle('center','center_r');  //last column
			$xls->StyleAddBorder("Right", '#000000', 1);
			
			/*Data export*/
			
			$disposition = array('select'=>'Select','1'=>'Sale','2'=>'No Sale','3'=>'Wrong Number','4'=>'No Answer','5'=>'Promise to Buy','6'=>'Refund Request-Product','7'=>'Request- Subscription');
		
			
			
		$paymentgateway = array(''=>'Select','1'=>'Avangate', '2'=>'Safecart', '3'=>'Clever Bridge','4'=>'SYS_Gateway');
			
			
/* Comments :  Exporting Xls depending upon the search parameters */
			
	$request = $this->getRequest();	
	$bsubmit = $request->getParam('bsubmit');	
    if($bsubmit=="Search")
	 {		
		$DateFrom = $request->getParam('DateFrom');
		$DateTo = $request->getParam('DateTo');
		$FirstName = $request->getParam('FirstName');
		$MiddleName = $request->getParam('MiddleName');
		$LastName = $request->getParam('LastName');
		$PhoneNumber = $request->getParam('PhoneNumber');
		$Email = $request->getParam('Email');
		$processid = $request->getParam('Processid');
		$calltype = $request->getParam('Calltype');
		$Disposition = $request->getParam('Disposition');
		$Planid = $request->getParam('Planid');
		$Salesamount = $request->getParam('Salesamount');
		$Issues = $request->getParam('Issues');
		$Solutions = $request->getParam('Solutions');
		$Orderid = $request->getParam('Orderid');
		$Casenumber = $request->getParam('Casenumber');
		$Teamviewerid = $request->getParam('Teamviewerid');
		$Calldate = $request->getParam('Calldate');
		$Salesagent = $request->getParam('Salesagent');
		$PaymentGateway = $request->getParam('PaymentGateway');
		$Center = $request->getParam('Center');
		
		$usersSort1 = new Application_Model_UserproocessdataMapper();
		$userlistsort = $usersSort1->getDbTable();
		$select = $userlistsort->select();
		
		if($FirstName!="")
		{
		$select->where('Firstname like ?', '%'.$FirstName.'%');
		}
		
		if($MiddleName!="")
		{
		$select->where('Middlename = ?', '%'.$MiddleName.'%');
		} 
		
		if($LastName!="")
		{
		$select->where('Lastname = ?', '%'.$LastName.'%');
		}
		
		if($PhoneNumber!="")
		{
		$select->where('Phonenumber = ?', '%'.$PhoneNumber.'%');
		}
		
		if($Email!="")
		{
		$select->where('Email = ?', '%'.$Email.'%');
		}
		
		
		$dfjd = $userlistsort->fetchAll($select);
		$userprocesseslist1 = $dfjd;
		
		
		
			$usersSort122 = new Application_Model_UserproocessdatadetailsMapper();
	$userlistsortss = $usersSort122->getDbTable();
	$selecttt = $userlistsortss->select();
	
	
	  if($DateFrom!="" and $DateTo!="")
	  {
	  
		
			  			$DateFrom = strtotime($DateFrom)+(6 * 3600)+(45/60*3600);
		$DateTo = strtotime($DateTo)+(30 * 3600)+(45/60*3600)-1;
		$selecttt->where('UNIX_TIMESTAMP(Calldate) >= ?',$DateFrom)->where('UNIX_TIMESTAMP(Calldate) <= ?',$DateTo);
	  }
	  
	  
	  
	 if($processid!="")
	  {
	    $selecttt->where('Processid = ?', $processid);
	  }
	  	 if($calltype!="")
	  {
	    $selecttt->where('Calltype = ?', $calltype);
	  }
	  
	   if($Disposition!="")
	  {
	    $selecttt->where('Disposition = ?', $Disposition);
	  }
	   	 if($Planid!="")
	  {
	    $selecttt->where('Planid = ?', $Planid);
	  }
	   	 if($Salesamount!="")
	  {
	    $selecttt->where('Salesamount = ?', $Salesamount);
	  }
	   	 if($Orderid!="")
	  {
	    $selecttt->where('Orderid = ?', $Orderid);
	  }
	   	 if($Casenumber!="")
	  {
	    $selecttt->where('Casenumber = ?', $Casenumber);
	  }
	   	 if($Teamviewerid!="")
	  {
	    $selecttt->where('Teamviewerid = ?', $Teamviewerid);
	  }
	  
	  	   	 if($Calldate!="")
	  {
	    $selecttt->where('DATE(Calldate) = ?', $Calldate);
	  }
	  
	  	   	 if($Salesagent!="")
	  {
	    $selecttt->where('Userid = ?', $Salesagent);
	  }
	  
	    	   	 if($PaymentGateway!="")
	  {
	    $selecttt->where('Paymentgateway = ?', $PaymentGateway);
	  }
	  
	  


/* Comments :  To sort the table w.r.t. center joining table to compare with Center  */

	  
if($Center!="")
 {
$selecttt->setIntegrityCheck(false);
$selecttt->from("userproocessdataz_details");
$selecttt->join("users", "userproocessdataz_details.Userid = users.Id and users.Center = $Center");
}

	$dfjdsdsd = $userlistsortss->fetchAll($selecttt);
    $userdetails1 = $dfjdsdsd;	
	
	
      }
	  
	  else
	  {
			$userprocessesdata = new Application_Model_UserproocessdataMapper();
			$userprocesseslist1 = $userprocessesdata->fetchAll();
			
			$userdetails = new Application_Model_UserproocessdatadetailsMapper(); 
			$userdetails1 = $userdetails->fetchAll();
	   }	
			
			$processes = new Application_Model_ProcessesMapper();
			$processes1 = $processes->fetchAll();
			
			$users = new Application_Model_UsersMapper();
			$users1 = $users->fetchAll();
			
			
	
	   
	    
		   $sn=1;
			$i=2;
			$processplan = new Application_Model_ProcessplanMapper();
$processplanlist = $processplan->fetchAll();


foreach($userdetails1 as $udl)
               { 		
					$xls->StyleSetBackground('#ECE5B6');    //color
					$xls->SetActiveStyle('center_r');
			
					
					foreach($userprocesseslist1 as $userprocesseslist)
                     {
					 if($udl->Customerid==$userprocesseslist->Id) {
					    
					$xls->Text($i,4,ucfirst($userprocesseslist->Title).' '.ucfirst($userprocesseslist->Firstname).' '.ucfirst($userprocesseslist->Middlename).' '.ucfirst($userprocesseslist->Lastname));
					/*$xls->Text($i,21,$userprocesseslist->Email);
					$xls->Text($i,6,$userprocesseslist->Phonenumber);*/
					  
					  $IDdd = $userprocesseslist->Id;
					  }
					 }
					 
					 
					 //if($udl->Customerid==$IDdd)
					  if($udl->Customerid==$IDdd)
					  {
					 
					 
					 		$xls->Text($i,1,$sn);
					$xls->Text($i,2,date("F j, Y",strtotime($udl->Calldate)));
					$xls->Text($i,3,date("H:i:s",strtotime($udl->Calldate)));

	$xls->Text($i,19,date("F j, Y",strtotime($udl->Calldate)-3600*6-(45/60*3600)));
						
					
					 $xls->Text($i,5,$udl->Casenumber);
			
			$calltype = array('0'=>'Select','1'=>'Sales','2'=>'Support','3'=>'Inquiry');
					 
	
			foreach($calltype as $key=>$val)
			 {
			   if($key==$udl->Calltype)
			    {
			     $xls->Text($i,6,$val); 
			    }
			 }
			 	// $xls->Text($i,6,$udl->Calltype); 
/*			foreach($processes1 as $vvv)
			 {
			   if($vvv->Id==$udl->Processid)
			    {
			     $xls->Text($i,7,$vvv->Name); 
			    }
			 }*/
			 			 
			foreach($processplanlist as $vvv)
			 {
			   if($vvv->Id==$udl->Planid)
			    {
			     $xls->Text($i,7,$vvv->Title.' ( '.$vvv->Price.' ) '); 
				 
				 $Currency = $vvv->Currency;
			    }
			 }
			 
			 
			  $xls->Number($i,8,$udl->Salesamount);
			  $xls->Text($i,9,$udl->Orderid);
			  
			foreach($users1 as $uuu)
			{
			if($uuu->Id==$udl->Userid)
			{
			$xls->Text($i,10,$uuu->Name);
			if($uuu->Center=="1") { $Center = 'Noida'; }
			if($uuu->Center=="2") { $Center = 'Jaipur'; }
			$xls->Text($i,20,$Center); 
			}
			}

             $xls->Text($i,11,$udl->Salesagent);
           // $xls->Text($i,13,$udl->Issues);
			
			
			  
				  foreach($processes1 as $processes)
					{
					if($processes->Id==$udl->Processid)
					{
						$xls->Text($i,12,$processes->Name);
					}
					}
			
					//$xls->Text($i,15,date("H:i:s",$udl->Starttime));
					$xls->Text($i,13,$udl->Teamviewerid);
					$xls->Text($i,14,$udl->Issues); //Issues
					$xls->Text($i,15,$udl->Solutions);  // Solutions
									  		
                   foreach($paymentgateway as $key=>$val)
				    {
					 if($key==$udl->PaymentGateway)
					  {
					   $xls->Text($i,16,$val); 
					  }
					}
					$xls->Text($i,17,$Currency); 
					
					 $xls->Text($i,18,$udl->GatewayRefernceNumber);
				
					
					
					$i++;
					$sn++;
					
					}
					
				}
				
			$xls->Output('CustomerReportDataSheet.xls');
			die;
			
			}



	   
  private function exportagentreportlist()
			{
				 
			
			$xls=new PHP_XLS();                  //create excel object
			$xls->AddSheet('Agent Report');      //add a work sheet
			
			/*next section will create the styles for the cells (borders, background,...)*/
			$xls->NewStyle('hd_t');          //header with top border     
			$xls->StyleSetBackground('#3B9C9C');    //color
			$xls->StyleSetFont('arial', 10, '#FFFFFF', 1, 0, 0);  //font parameters
			$xls->StyleSetAlignment(-1, 0);         //cell alignment
			$xls->StyleAddBorder("Top", '#000000', 2);  //top border
			$xls->StyleAddBorder("Right", '#000000', 1);  //right thin border separating header cells
			$xls->CopyStyle('hd_t','hd_l');  // now we just copy the header with top border to header_left 
			$xls->StyleAddBorder("Left", '#000000', 2);  //and set the left border 
			$xls->CopyStyle('hd_t','hd_r');  //copy the header wit top border to header_right
			$xls->StyleAddBorder("Right", '#000000', 2);  //and thicken the right border so it will end the table
			
			/*we write the header content into the object*/
			$xls->SetActiveStyle('hd_l'); //first cell have header_left style
			
					 
				/*next we set the header cell sizes*/
				$xls->SetRowHeight(1,20);
				$xls->SetColWidth(1,150);
				$xls->Text(1,1,'#');
				$xls->SetColWidth(2,150);
				$xls->Text(1,2,'Agent');
				$xls->SetColWidth(3,150);
				$xls->Text(1,3,'Customer Name');
				$xls->SetColWidth(4,150);
				$xls->Text(1,4,'Customer Phone Number');
				$xls->SetColWidth(5,150);
				$xls->Text(1,5,'Customer Email');
				$xls->SetColWidth(6,150);
				$xls->Text(1,6,'Others Details');
				$xls->SetColWidth(7,150);
				$xls->Text(1,7,'Process');
				$xls->SetColWidth(8,150);
				$xls->Text(1,8,'Call Type');
				$xls->SetColWidth(9,150);
				$xls->Text(1,9,'Disposition');
				$xls->SetColWidth(10,150);
				$xls->Text(1,10,'Issues');
				$xls->SetColWidth(11,150);
				$xls->Text(1,11,'Solutions');
				$xls->SetColWidth(12,150);
				$xls->Text(1,12,'Call Date Time');
				$xls->SetColWidth(13,150);
				$xls->Text(1,13,'Time Difference');

			
				
				$xls->SetActiveStyle('hd_r');  //and the cell in last column is header_right 
			/*now we have the header inserted into worksheet*/
			
			/*for the content we need a style with the top and right borders*/
			$xls->NewStyle('center');
			$xls->StyleSetAlignment(-1, 0);
			$xls->StyleAddBorder("Top", '#000000', 1);
			$xls->StyleAddBorder("Right", '#000000', 1);
			$xls->CopyStyle('center','center_l'); //this style is for the first column
			$xls->StyleAddBorder("Left", '#000000', 1);
			$xls->CopyStyle('center','center_r');  //last column
			$xls->StyleAddBorder("Right", '#000000', 1);
			
			/*Data export*/
			//$reg = $this->_em->getRepository('Account_Model_Registrations')->findBy(array('regIsDel'=>'0'));
				$disposition = array('select'=>'Select','1'=>'Sale','2'=>'No Sale','3'=>'Wrong Number','4'=>'No Answer','5'=>'Promise to Buy','6'=>'Refund Request-Product','7'=>'Request- Subscription');
			$calltype = array('select'=>'Select','1'=>'Sales','2'=>'Support','3'=>'Inquiry');
			
			$userprocessesdata = new Application_Model_UserproocessdataMapper();
			$userprocesseslist1 = $userprocessesdata->fetchAll();
			
			$processes = new Application_Model_ProcessesMapper();
			$processes1 = $processes->fetchAll();
			
			$users = new Application_Model_UsersMapper();
			$users1 = $users->fetchAll();
			
			
			$userdetails = new Application_Model_UserproocessdatadetailsMapper(); 
			$userdetails1 = $userdetails->fetchAll();
	   
	    
		   $sn=1;
			$i=2;
			foreach($userdetails1 as $udl)
               { 		
					$xls->StyleSetBackground('#ECE5B6');    //color
					$xls->SetActiveStyle('center_r');
					$xls->Text($i,1,$sn);
					
					
					
						   foreach($users1 as $uuu)
					{
					if($uuu->getId()==$udl->getUserid())
					{
				    $xls->Text($i,2,$uuu->getName()); 
					}
				   }
				   
					foreach($userprocesseslist1 as $userprocesseslist)
                     {
					 if($udl->getCustomerid()==$userprocesseslist->getId()) {
					    
						$xls->Text($i,3,ucfirst($userprocesseslist->getTitle()).' '.$userprocesseslist->getFirstname().' '.$userprocesseslist->getMiddlename().' '.$userprocesseslist->getMiddlename().' '.$userprocesseslist->getLastname());
						$xls->Text($i,4,$userprocesseslist->getPhonenumber());
						$xls->Text($i,5,$userprocesseslist->getEmail());
						$xls->Text($i,6,$userprocesseslist->getOthersdetails());
					  }
					 }
					 
				  foreach($processes1 as $processes)
					{
					if($processes->getId()==$udl->getProcessid())
					{
						$xls->Text($i,7,$processes->getName());
					}
					}
					
				   foreach($calltype as $key=>$vals)
					   {
						 if($key==$udl->getCalltype())
						 {
						   $xls->Text($i,8,$vals);
						 }
					   }
 
                      			
				   foreach($disposition as $key=>$vals)
				   {
					 if($key==$udl->getDisposition())
					 {
					    $xls->Text($i,9,$vals);
					 }
				   }
 
				$xls->Text($i,10,$udl->getIssues());
				$xls->Text($i,11,$udl->getSolutions()); 
				$xls->Text($i,12,$udl->getCalldate()); 
				$xls->Text($i,13,round($udl->getEndtime()-$udl->getStarttime(),3)); 
   
					$i++;
					$sn++;
				}
				
			$xls->Output('AgentReportDataSheet.xls');
			die;
			
			}




}
