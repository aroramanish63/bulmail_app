<?php
error_reporting(0);
session_start();
include("include/config.php");
if($_POST)
{	
	$errcnt=0;
	if(!get_magic_quotes_gpc())
	{
		$email=str_replace("$","\$",addslashes($_POST["email"]));
		$password=str_replace("$","\$",addslashes($_POST["password"]));
	}
	else
	{
		$email=str_replace("$","\$",$_POST["email"]);
		$password=str_replace("$","\$",$_POST["password"]);
	}
	
	
	if ( !isset($_POST["email"]) || (strlen(trim($_POST["email"])) == 0) )
	{
		$errs[$errcnt]="Email address is required field.";
		$errcnt++;
	}
	
	
	if ( !isset( $_POST["password"] ) || (strlen(trim($_POST["password"])) == 0) )
	{
		$errs[$errcnt]="Password is required field.";
		$errcnt++;
	}
	
	if($errcnt==0)
	{
		$password = md5($password);
		$sql = "SELECT * FROM users_register WHERE email = '$email' AND password = '$password'";
		$query=mysql_query($sql);
		if ($row=mysql_fetch_array($query))
		{
			if($row["password"]===$password)
			{
				if($row["status"] != 0)
				{
					$_SESSION["user_email"]=$row["email"];
					$_SESSION["user_id"]=$row["id"];
					header("Location: index.php");
					die();
				}
				else
				{
					$_SESSION['errormsg'] = "Login Failed! Please make sure that you enter the correct details and that you have activated your account.";
					header("Location: login.php");
					die();
				}
			}
			else
			{
				$errs[$errcnt]="Invalid Details! Please Enter Correct Login Details.";
				$errcnt++;
			}
		}
		else
		{
			$errs[$errcnt]="Invalid Details! Please Enter Correct Login Details.";
			$errcnt++;	
		}
	}
		
}

?>

<?php
	include("include/header.php");
?>
      <!--form right section start here-->
      
      <div class="form_rightsection">
        <div class="form_topbg"><img src="images/fromtopbg.png" width="772" height="40" alt="#" /></div>
        <div class="form_midbg">
          <div class="form_contentcontainer">
          <?php
		  if(isset($_SESSION['errormsg']) && $_SESSION['errormsg']!="")
			{
				echo "<div class=\"errordiv\">".$_SESSION['errormsg']."</div>";
				unset($_SESSION['errormsg']);	
			}
		  ?>
            <form action="login.php" method="post" id="form_login" name="form_login">
                <h1><span>Login with your account</span></h1>
                 <?php
					if($errcnt!=0)
					{
						?>
                        <table style="margin: 10px 0 0 0px; color:#C00">
                        <?php
						for($i=0;$i<$errcnt;$i++)
						{
							echo "<tr><td>".$errs[$i]."</td></tr>";
						}
						?>
						</table>
					<?php	
					}
					?>
                
                <label for="email" id="checkmail">Your Email </label>
                <input type="text" name="email" id="email" value="" class="inputbg" placeholder="Your email" />
                <span id="emailInfo"></span>
                
                <label>Password</label>
                <input type="password" name="password" id="password" value="" class="inputbg" placeholder="Password" />
                <span id="pass1Info"></span>
                
                <div style="clear:both;"></div>
                
                <input type="submit" name="submit" class="submitbutton" value=""/>
			</form>

          </div>
        </div>
        <div class="form_topbg"><img src="images/bottombg.png" width="772" height="230" alt="#" /></div>
      </div>
      <!--form right section end here--> 
      
    </div>
  </div>
</div>
</body>
</html>
