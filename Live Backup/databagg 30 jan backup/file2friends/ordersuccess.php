<?php
	session_start();
	include("include/header.php");
?>

      <!--form right section start here-->
      
      <div class="form_rightsection">
        <div class="form_topbg"><img src="images/fromtopbg.png" width="772" height="40" alt="#" /></div>
        <div class="form_midbg">
          <div class="form_contentcontainer">
            <h1><span>Thank You! Your order completed successfully.</span></h1>
            <br />
            <?php
			if(!isset($_SESSION['user_id'])){
			?>
			<div class="addmsgtext">Click <a href="login.php">here</a> to login with your account.</div>
            <?php
			}
			?>
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
