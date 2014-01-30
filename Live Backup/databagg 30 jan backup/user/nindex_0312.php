<?php
 $arr=explode("/",$_SERVER["HTTP_REFERER"]);
$page= $arr[count($arr)-1];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  <title>Data Bagg</title>
  
  </head>


<frameset rows="0,*" frameborder="0" border="0" framespacing="0" id="main">
	<frame name="menu" id='menu' src="" marginheight="0" marginwidth="0" scrolling="auto" noresize>
	
    <frame name="content" id='content' src="<?php if($page=="refferal.php") echo "index.php?name_page=my_settings"; else echo "dashboard.php"; ?>" marginheight="0" marginwidth="0" scrolling="auto" noresize>

    

</frameset>
</html>