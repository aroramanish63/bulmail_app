<?php
if(session_id() == '') 
{
session_start();
    // session isn't started
}
?>
<style>
.control{
width: 200px;
height: 44px;
background: url("image/controlpanel.png") no-repeat;
float: left;
}
</style>
<div class="mid_container">
        <header class="innerheader">
        <div class="logo"><a href="https://www.databagg.com/index.php"></a></div>
        <nav>
        	<ul>
            <li><a href="https://www.databagg.com/index.php?id=1" >HOW IT WORKS</a></li>
             <li><a href="https://www.databagg.com/index.php?id=2">FEATURES</a></li>
            </ul>
        </nav>
        <?php
          if(!isset($_SESSION["user_id"]))
{
          ?>
          <div class="sign_button"><a class="signin"  href="https://www.databagg.com/login.php"></a><a class="signup" href="https://www.databagg.com/registration.php"></a></div>
        <?php
        }
        else
        {
        ?>
        <div class="sign_button"><a class="control" href="https://www.databagg.com/user/nindex.php"></a></div>
        <?php
        }
        ?>
        
        </header>
        </div>