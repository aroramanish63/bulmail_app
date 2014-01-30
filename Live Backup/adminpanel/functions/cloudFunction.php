<?php
class CloudFunctions extends AllFunctions
{    
    //-----Initialization -------	
	
	
	
	public function test(){
		return $this->select('country');	
	}
	
	
    function AddEmployee()
    {
        if(!isset($_POST['saveEmp']))
        {
           return false;
        }
        
        $formvars = array();
        
        $this->CollectRegistrationSubmission($formvars);
        
        if(!$this->SaveToDatabase($formvars))
        {
            return false;
        }
		
        return true;
    }
	
	function CollectRegistrationSubmission(&$formvars)
    {
        $formvars['firstName'] = $this->Sanitize($_POST['firstName']);
        $formvars['lastName'] = $this->Sanitize($_POST['lastName']);
    }
	
	function SaveToDatabase(&$formvars)
    {		
        if(!$this->DBLogin())
        {
            echo "Database login failed!";
			$this->HandleError("Database login failed!");
            return false;
        }        
                
        if(!$this->InsertIntoDB($formvars))
        {
            $this->HandleError("Inserting to Database failed!");
            return false;
        }
        return true;
    }
	
	function InsertIntoDB(&$formvars)
    {        
        echo $insert_query = 'insert into users(
                email,
                username,
                password,
                confirmcode,
				country,
				city,
				DOB,
				gender,
				registeredOn
                )
                values
                (
                "' . $this->SanitizeForSQL($formvars['email']) . '",
                "' . $this->SanitizeForSQL($formvars['username']) . '",
                "' . md5($formvars['password']) . '",
                "' . $confirmcode . '",
                "' . $this->SanitizeForSQL($formvars['country']) . '",
                "' . $this->SanitizeForSQL($formvars['city']) . '",
                "' . $this->SanitizeForSQL($formvars['dob']) . '",
				"' . $this->SanitizeForSQL($formvars['gender']) . '",
				"' . date('Ymd') . '"
                )'; die;     
        if(!mysql_query( $insert_query ,$this->connection))
        {
            $this->HandleDBError("Error inserting data to the table\n");
            return false;
        }        
        return true;
    }
	
	function StripSlashes($str)
    {
        if(get_magic_quotes_gpc())
        {
            $str = stripslashes($str);
        }
        return $str;
    }
	
	/*
    Sanitize() function removes any potential threat from the
    data submitted. Prevents email injections or any other hacker attempts.
    if $remove_nl is true, newline chracters are removed from the input.
    */
	function Sanitize($str,$remove_nl=true)
    {
        $str = $this->StripSlashes($str);

        if($remove_nl)
        {
            $injections = array('/(\n+)/i',
                '/(\r+)/i',
                '/(\t+)/i',
                '/(%0A+)/i',
                '/(%0D+)/i',
                '/(%08+)/i',
                '/(%09+)/i'
                );
            $str = preg_replace($injections,'',$str);
        }

        return $str;
    }
	
	function SanitizeForSQL($str)
    {
        if( function_exists( "mysql_real_escape_string" ) )
        {
              $ret_str = mysql_real_escape_string( $str );
        }
        else
        {
              $ret_str = addslashes( $str );
        }
        return $ret_str;
    }
    
    function adminlogin($uname,$pass){
        if(!$this->getConnectionId())
        {
            echo "Database login failed!";
			$this->HandleError("Database login failed!");
            return false;
        }  
        $tablename = $this->cfg['db_prefix'].'admin_master';
        if(!is_null($uname) && !is_null($pass)){
            $cpass = $this->returnMD5($pass);
            $where = array(
                'username'=>$uname,
                'password'=>$cpass,
                'status'=>1
            );
            $result = $this->select($tablename, '*', $where);
            
            if(is_array($result) && !is_null($result)){
                foreach ($result as $res){
                    $_SESSION['uid'] = $res['id'];
                    $_SESSION['username'] = $res['username'];
                    $_SESSION['email'] = $res['email'];
                    $_SESSION['firstname'] = $res['firstname'];
                } 
                return true;
            }
            else{
                return false;
            }
        }
    }        
	   
}
?>