<?php

class Application_Form_Processform extends Zend_Form
 {
   public function init()
    {
		
		
		$Userprocessdataid = new Zend_Form_Element_Hidden('userprocessdataid');
		
	$Bound = new Zend_Form_Element_Radio('bound');
	$Bound->setLabel('Bound')
	->addMultiOptions(array(
	'1' => 'In Bound',
	'2' => 'Out Bound'))
	->setSeparator('')
	->setRequired(true);
		
		$orderid = new Zend_Form_Element_Text('orderid');
		$orderid->setLabel('Order Id')
	//	->setRequired(true)
		->setAttribs(array('style'=>'width:150px'));
		//->addValidator('NotEmpty');
		
		$casenumber = new Zend_Form_Element_Text('casenumber');
		$casenumber->setLabel('Case Number')
		//->setRequired(true)
		->setAttribs(array('style'=>'width:150px'));
		//->addValidator('NotEmpty');
		
		$teamviewerid = new Zend_Form_Element_Text('teamviewerid');
		$teamviewerid->setLabel('Logmein Session ID')
		//->setRequired(true)
		->setAttribs(array('style'=>'width:150px'));
	//	->addValidator('NotEmpty');
		
	
		 $amount = new Zend_Form_Element_Select('salesamount');			 
		 $amount->setAttribs(array('style'=>'display:none;width:150px'));
		        //->addValidator('Float')
				//->addValidator(new Zend_Validate_Between(array('min' => 20, 'max' => 60)));
				
				/*		 $amount->setAttribs(array('style'=>'display:none;width:150px'))
		        ->addValidator('Float')
				->addValidator(new Zend_Validate_Between(array('min' => 20, 'max' => 60)));
			*/	
		     //   ->setAttribs(array('style'=>'width:150px'));
//		 $amount = new Zend_Form_Element_Hidden('salesamount');
/*		$amount->setLabel('Amount')
		           ->setAttribs(array('style'=>'width:150px'));*/
				   
		$ProcessId = new Zend_Form_Element_Select('processid');
        $ProcessId->setLabel('Process')
		          ->setAttribs(array('style'=>'width:160px'))
				  ->setAttrib('onchange', 'sortplans(this.value)')
				  ->setRequired(true)->addValidator('NotEmpty', true); 
	   
 		$UserId = new Zend_Form_Element_Hidden('userid');
		
		$title = new Zend_Form_Element_Select('title');
		$title->setLabel('Title')
				->setMultiOptions(array(''=>'Select','mr'=>'Mr', 'ms'=>'Ms', 'mrs'=>'Mrs'))
				->setAttribs(array('style'=>'width:160px'))
				->setRequired(true)->addValidator('NotEmpty', true);
				
	
				
        $firstName = new Zend_Form_Element_Text('firstname');
        $firstName->setLabel('Name')
                  ->setRequired(true)
				  ->setAttribs(array('style'=>'width:150px'))
                  ->addValidator('NotEmpty');

        $middleName = new Zend_Form_Element_Text('middlename');
		$middleName->setLabel('Middle Name')
		           ->setAttribs(array('style'=>'width:150px'))
				    ->setAttribs(array('style'=>'display:none;width:150px'));
		

        $lastName = new Zend_Form_Element_Text('lastname');
        $lastName->setLabel('Last name')
		         ->setAttribs(array('style'=>'width:150px'))
		         ->setAttribs(array('style'=>'display:none;width:150px'));
        
		$phoneNumber = new Zend_Form_Element_Text('phonenumber');
		$phoneNumber->setLabel('Phone Number')
		            ->setAttribs(array('style'=>'width:150px'))
					->addValidator('Digits')
		            ->setRequired(true);
		     
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email address')
              ->addFilter('StringToLower')
              ->addValidator('NotEmpty', true)
              ->addValidator('EmailAddress')
			  ->setAttribs(array('style'=>'width:150px'))
			   ->setRequired(true); 
        
		$othercontactdetails = new Zend_Form_Element_Textarea('othersdetails');
		$othercontactdetails->setLabel('Other Details')
		                     ->setAttrib('COLS',10)
		                     ->setAttrib('ROWS', '2')
							 ->setAttribs(array('style'=>'width:156px'));
							//  ->setRequired(true);
		
		
		$calltype = new Zend_Form_Element_Select('calltype');
		$calltype->setLabel('Call Type')
				->setAttribs(array('style'=>'width:160px'))
				->setMultiOptions(array(''=>'Select','1'=>'Sales','2'=>'Support','3'=>'Inquiry'))
				->setRequired(true)->addValidator('NotEmpty', true);	
				
		$disposition = new Zend_Form_Element_Select('disposition');
		$disposition->setLabel('Disposition')
				->setAttribs(array('style'=>'width:160px'))
				->setMultiOptions(array(''=>'Select','1'=>'Sale','2'=>'No Sale','3'=>'Wrong Number','4'=>'No Answer','5'=>'Promise to Buy','6'=>'Refund Request-Product','7'=>'Request- Subscription'))
				->setAttrib('onchange', 'showamount(this.value)')
				->setRequired(true);
				//->setRegisterInArrayValidator(FALSE);	
				
	
		$planid = new Zend_Form_Element_Select('planid');
		$planid->setLabel('Plan')
		       ->setMultiOptions(array(''=>'Select'))
			   ->setAttribs(array('style'=>'width:160px'))
			   ->setAttribs(array('style'=>'display:none'))
			   ->setRegisterInArrayValidator(FALSE);	
							
									 
		$issues = new Zend_Form_Element_Text('issues');
//		$issues->setLabel('Issues')
		$issues->setLabel('Tech Agent') //Assigned To
		  /*                   ->setAttrib('COLS',10)
		                     ->setAttrib('ROWS', '2')*/
							 ->setAttribs(array('style'=>'width:150px'));
							//  ->setRequired(true);
							
		$solutions = new Zend_Form_Element_Textarea('solutions');
//		$solutions->setLabel('Solution')
		$solutions->setLabel('Issues')  //Comments
		                     ->setAttrib('COLS',10)
		                     ->setAttrib('ROWS', '2')
							 ->setAttribs(array('style'=>'width:156px'));
							//  ->setRequired(true);						 
							 					       
        
		
		$salesagent = new Zend_Form_Element_Text('salesagent');
		$salesagent->setLabel('')
		            ->setAttribs(array('style'=>'width:150px'))
				    ->setAttribs(array('style'=>'display:none'));
		    //        ->setRequired(true);
					
					
$PaymentGateway = new Zend_Form_Element_Select('paymentgateway');
$PaymentGateway->setLabel('Payment Gateway')
	->setMultiOptions(array(''=>'Select','1'=>'Avangate', '2'=>'Safecart', '3'=>'Clever Bridge','4'=>'SYS_Gateway','5'=>'UpClick'))
	->setAttribs(array('style'=>'width:160px'));
			

		$gatewayreferncenumber = new Zend_Form_Element_Text('gatewayreferncenumber');
		$gatewayreferncenumber->setLabel('Gateway Refernce Number')
		            ->setAttribs(array('style'=>'width:150px'));
										
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Submit');
        
/*        $this->addElements(array($Userprocessdataid,$title,$firstName,$middleName,$lastName,$phoneNumber,$email,$othercontactdetails,$ProcessId,$calltype,$disposition,$planid,$amount,$salesagent,$issues,$solutions,$orderid,$casenumber,$teamviewerid,$UserId,$submit));*/

$this->addElements(array($Userprocessdataid,$Bound,$ProcessId,$title,$firstName,$middleName,$lastName,$phoneNumber,$email,$othercontactdetails,$calltype,$disposition,$planid,$amount,$orderid,$salesagent,$issues,$teamviewerid,$solutions,$PaymentGateway,$gatewayreferncenumber,$casenumber,$UserId,$submit));			
			
			

	 $this->clearDecorators();
	 

		  
     /*   $this->addDecorator('FormElements')
         ->addDecorator('HtmlTag', array('tag' => '<ul>'))
         ->addDecorator('Form');
        
        $this->setElementDecorators(array(
            array('ViewHelper'),
            array('Errors'),
            array('Description'),
            array('Label', array('separator'=>' ')),
            array('HtmlTag', array('tag' => 'li', 'class'=>'element-group')),
        ));

        // buttons do not need labels
        $submit->setDecorators(array(
            array('ViewHelper'),
            array('Description'),
            array('HtmlTag', array('tag' => 'li', 'class'=>'submit-group')),
        ));
		*/
		
		
		 $this->setElementDecorators(array(
                    'viewHelper',
                    'Errors',
                    array(array('data'=>'HtmlTag'),array('tag'=>'td')),
                    array('Label',array('tag'=>'td')),
                    array(array('row'=>'HtmlTag'),array('tag'=>'tr', 'class'=>'element-group'))
        ));
        
        $this->setDecorators(array(
                'FormElements',
                array(array('data'=>'HtmlTag'),array('tag'=>'table','class'=>'procss_frm_processform')),
                'Form'
        ));
		


$salesagent->removeDecorator('label')
                  ->removeDecorator('HtmlTag'); 
					  
		$UserId->removeDecorator('label')
                  ->removeDecorator('HtmlTag');  
				  
		$Userprocessdataid->removeDecorator('label')
                  ->removeDecorator('HtmlTag');  		  			  
					  
		
    }
	
 }