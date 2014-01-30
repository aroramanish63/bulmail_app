<?php

if(strstr($_SERVER["HTTP_HOST"],"databagg.com"))
{
      mysql_connect("192.168.100.8","databagg_data","c4#ZL1D)+w7o") or die("Error in connection<br>".mysql_error());
	mysql_select_db("databagg_data")or die("Error in opening DB<br>".mysql_error());
}
else
{
	mysql_connect('localhost','root','') or die("Error in connection<br>".mysql_error());
	mysql_select_db("cloud") or die("Error in opening DB<br>".mysql_error());
}


?>