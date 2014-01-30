<?php
class EmpFunctions extends AllFunctions
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
	   
}
?>