<?php
session_start();

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
        <header>
        <div class="logo"><a href="javascript:scrollToLink(0)"></a></div>
        <nav>
        	<ul>
            <li><a href="javascript:scrollToLink(1)">HOW IT WORKS</a></li>
             <li><a href="javascript:scrollToLink(2)">FEATURES</a></li>
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