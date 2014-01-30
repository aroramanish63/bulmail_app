<?php

class Index_IndexController extends Zend_Controller_Action
{

	
  public function indexAction()
    {
	

	/* Comments :  Login Action*/	
		
     $request = $this->getRequest();
     $Username = $request->getParam('myusername');
	 $Password = $request->getParam('mypassword');
	 
	 
		
	 if($Username!="" and $Password!="")
	  {
	  

	
	 $users = new Application_Model_UsersMapper();
     $userlist = $users->fetchAll();
	 

/* Comments :  for loop to  fetch all users */

	foreach($userlist as $vus)
	 {
	 
	 
	 /* Comments :  Compare the input users*/
	 
	   if($vus->getUsername()==$Username and $vus->getPassword()==$Password and $vus->getIsActive()=='1')
	    {
		  			 $_SESSION['userid'] = $vus->getId();
			 $_SESSION['userttypeid'] = $vus->getUserType();
			 $_SESSION['userName'] = $vus->getName();
			 $_SESSION['userprocess'] = array();
	 

 $uproc = array();
	 
	 
	 /* Comments :  Assign user process in session */
	 
	 
	 $userprocesses = new Application_Model_UserprocessMapper();
     $userprocesses = $userprocesses->fetchAll();
	 $sssss=0;
	 foreach($userprocesses as $vlll)
	  {
	    if($vlll->getUserId()==$vus->getId() and $vlll->getIsActive()=='1')
		 {
			 $uproc[$sssss] = $vlll->getProcessId();
			 $sssss++;
		 }
	  }		
        $_SESSION['userprocess'] = array_unique($uproc);    /* Comments :  Making th userprocess id unique */

			$this->_redirect(SITE_URL_PUBLIC_P.'index/index/panel');
		}
		else
		{
		 $this->view->error = 'Incorrect Username or Password';
		}
		

		
		
		
	 }

	
     }

	}

  public function panelAction()
   {
    
	/* Comments :  Landing page for user panel*/
	
	       $this->_helper->layout->setLayout('layoutadmin');
	
   }
   
    public function logoutAction()
	 {
	 
	 /* Comments :  logging out destroying all the session */
	 
	
		session_destroy();
		$this->_redirect(SITE_URL_PUBLIC_P.'index/index/index');
	 }

}
