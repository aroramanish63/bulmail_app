<div class="header">

<div class="fright">
<ul class="link">
       <li><a href="dashboard.php">Home</a></li>
   <li class="boder_right"><a href="index.php?name_page=my_settings"><img src="image/index_tp_img.png" alt="" />  Welcome  <strong><?php echo $fetch_user_data['txt_first_name']." ".$fetch_user_data['txt_last_name']; ?></strong></a></li>
   <li class="boder_right"><form id="inputwraper" action="" method="post">

<form action="#" id="searchform" method="post">
<input id="s" name="s" type='keywords'  class="search" value="<?php if($_REQUEST['s']) echo $_REQUEST['s']; else echo "Search"; ?>" onfocus="if(this.value=='Search'){this.value=''};" onblur="if(this.value==''){this.value='Search'};" />
<input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
</form></li>
</ul>
</div>

<div class="tp_logo">
<div class="logo"></div>
</div>
</div>

