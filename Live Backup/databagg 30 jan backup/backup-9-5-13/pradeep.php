<?php
echo "hgisrdhe";
include("connect.php");

mysql_query("INSERT INTO `databagg_data`.`invititation` (`id`, `invitedby`, `fname`, `lname`, `email`, `uid`, `invitedon`, `free_space`, `uid_isused`) VALUES (NULL, '324', '234', '234', '324', '324', CURRENT_TIMESTAMP, '324', '1')");

?>