<?php
include("../../../connect.php");
include("../../../function.php"); 
error_reporting(0);






if($_REQUEST['code'])
{   
    $share_link="";
    $path="";
    
    
      $select_exist_share="select * from tab_share where txt_share_link='".$_REQUEST['code']."'";
    $result_exist_share=mysql_query($select_exist_share) or die(mysql_error());
    $fetch_share_link=mysql_fetch_array($result_exist_share);
    
    
}

 

?>
<body style="background: url(../../image/pattern.jpg);">
<style>
.info_suc {
    border: 1px solid;
    margin: 10px 0px;
    padding:4px 10px 6px 14px;
    background-repeat: no-repeat;
    background-position: 10px center;
    color: #000;
    background-color: #2ECCFA;
    width: 25%;
   
}
</style>
<center>
<table  style="width: 100%;">

    <tr >
        <td colspan="2" align="center">
        <img src="../../image/data_logo.png"/>
        </td>
    </tr>
    <tr>
    <td colspan="2">
    <hr style="border: 2px solid #15A0C8" />
    </td>
    
    </tr>

</table>
<style>
a{
    text-decoration: none;
    color: white;
}
</style>
<?php
if(mysql_num_rows($result_exist_share)>0)
{
?>
<table  style="width: 50%;">
    <tr>
    <td>
    <img src="../../<?php echo get_file_icon1($fetch_share_link['int_is_folder'],$fetch_share_link['txt_file_name']); ?>" />
    <?php echo $fetch_share_link['txt_file_name']; ?>
    </td>
    <td align="right">
    <span style='background-color:#15A0C8;border-radius:10px 10px 10px 10px;padding:5px 10px 5px 10px;color:white;font-size:13px;white-space:nowrap'>
     <?php if($fetch_share_link['int_is_folder']==0) { ?>
     <a href="../../download.php?path=<?php echo $fetch_share_link['txt_real_path']; ?>"> Download  </a>
     <?php }else { ?>
     <a href="../../test_zip.php?path=<?php echo $fetch_share_link['txt_real_path']; ?>"> Download  </a>
     <?php } ?>
     </span>
    </td>
    </tr>
</table>
<?php
}
else
{
    echo "<div class='info_suc' id='suc'>";
echo "There is no item for download! Thank you. ";  
    
      echo "</div>";
}
?>
</center>
</body>
