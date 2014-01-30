<?php
define("ENC_KEY","cyfuture");
define("ERROR_HANDLE_MAIL","jnu.saurav@gmail.com");
if(strstr($_SERVER["HTTP_HOST"],"databagg.com"))
{
      mysql_connect("103.10.189.53","databagg_data","c4#ZL1D)+w7o") or die("Error in connection<br>".mysql_error());
	mysql_select_db("databagg_unstruct")or die("Error in opening DB<br>".mysql_error());
}
else
{
	mysql_connect('localhost','root','') or die("Error in connection<br>".mysql_error());
	mysql_select_db("databagg_data") or die("Error in opening DB<br>".mysql_error());
}


?>