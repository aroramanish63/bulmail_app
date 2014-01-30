<?php
include("connect.php");
include("function.php");

?>

<?php

$email=base64_decode($_REQUEST['code']);
$select_det="select * from tab_members where txt_email='".$email."'";
$res=mysql_query($select_det) or die("Something not good here");
if(mysql_num_rows($res)==1)
{
    $update_user="update tab_members set int_verified=1 where txt_email='".$email."'";
    mysql_query($update_user);
    
        ?>
        <script>
        location.href="login.php?msg_ver=1";
        </script>
        <?php
}
else
{
    echo "Try again later. Something not good here .";
}


?>