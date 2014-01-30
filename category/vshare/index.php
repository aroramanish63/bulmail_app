<?php
session_start();
include("../../../connect.php");
include("../../../function.php"); 
error_reporting(0);





if($_REQUEST['code'])
{   
    $share_link="";
    $path="";
    
    
      $select_exist_share="select * from category_data where share_code='".$_REQUEST['code']."'";
    $result_exist_share=mysql_query($select_exist_share) or die(mysql_error());
    $fetch_share_link=mysql_fetch_array($result_exist_share);
    
    
}

 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><meta content="width=device-width, initial-scale=0.6" name="viewport">
<title>Databagg</title>
<style type="text/css">
a, a img { outline: none; border:none;}
</style>
<link href="share.css" rel="stylesheet" type="text/css" />
<link href="fonts/font.css" rel="stylesheet" type="text/css" />

<!--<link href="App_Theme/dashboard.css" rel="stylesheet" type="text/css" />-->

<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>

</head>
<body class="body_wrap" style="font-family: 'PT Sans', sans-serif;">
<div class="data_container clearfix">
<div class="header">
<div class="logo"></div>
<div class="header_right" > 
<div style="float:left; margin-top:30px; margin-right:20px;"><a href="#"><img onclick="location.href='../../DataBaGG.exe';" src="images/install-img.png" width="162" height="32" alt="#" /></a></div>           
 <?php
 if(!isset($_SESSION['user_id']))
 {
 ?>
 <div class="login" style=" float:left; margin-top:30px; margin-right:10px; "><a target="_blank" href="http://www.databagg.com/login.php"><img width="81" height="36" border="0" alt="" src="images/login.png"></a></div>
           <div class="loginsign" style=" float:left; margin-top:30px;"><a target="_blank" href="http://www.databagg.com/registration.php"><img width="91" height="36" border="0" alt="" src="images/signup.png"></a></div> 
 <?php
 }
 ?>
            </div>
            </div>
</div>

<div class="wrapper" style="margin-left: 12%;float: left;width: 900px;text-align: center;">
<h2 style="font-family: 'geoslab703_md_btbold';color:#049cd4;margin: 0;padding: 0px;">
 Video Gallary</h2>
<div style="float: left;">
	<?php
if(mysql_num_rows($result_exist_share)>0)
{
?>
    
    
   
       <?php
        $data="";
    $count=0;
    
  
    
    $select_list_data="select * from users_data where int_fid in(".$fetch_share_link['txt_fid'].") and int_del_status='0'";
    
    
    $result_list_data=mysql_query($select_list_data) or die(mysql_error());
  
       $data="";
   $data.="<font color='#049cd4' >Songs List </font><br>";
    $data.="<table style='width: 270px;' id='alternatecolor' class='altrowstable1'  >";
    while($fetch_list_data=mysql_fetch_array($result_list_data))
    { $count++;
    $imgsrc="../../../".$fetch_list_data['txt_real_path'];
  
      
            
            
          

     $data.="<tr >";
     
      $data.="<td  style='padding-left:5px;'>";
      
      $data.="<div style='width:240px;overflow:hidden;'>".$fetch_list_data['txt_file_name']."</div>";
      
       $data.="</td>";
        
        $data.="<td >";
        $data.="<img src='images/play-icon.png'  style='cursor:pointer;' title='Play Item' onclick='go(\"$imgsrc\");'>";
        $data.="</td>";
      $data.="</tr>";
    
       
       
        //$main_data="<a href='javascript:load_data(\"".$fetch_list_data['txt_file_name']."\");'>".$fetch_list_data['txt_file_name']."</a>";
        //$data=$data.$main_data;
        //$data.="</br></br>";
        
    }
     $data.="</table>";
    

 
  

        
        
       
        
   
       ?>
      
       <?php echo $data; ?>
       </div>
      
        <div id="play_container" style="float: left; background: #fff;margin-left: 50px;">
 <iframe id="dynamic_vdo"  src="test_vdo.php" style="width: 500px;height: 370px;border: none;"></iframe>
 </div>
   
     </div> 
  </body>
</html>

    
    
    <div style="clear:both;"></div>
<?php
}


else
{
    echo "<div class='info_suc' id='suc'>";
echo "There is no item for download! Thank you. ";  
    
      echo "</div>";
}
?>
</div>


<div class="footer">
<p>&copy;<?php echo date('Y',time()); ?> <span>Databagg</span></p>
<ul id="footer" class="fleft">
   <li><a href="https://www.databagg.com/term-of-services.html" class="active">Terms</a></li>
    <li><a href="https://www.databagg.com/privacy-policy.html">Privacy Policy</a></li>
    
    <li ><a href="https://www.databagg.com/help/index.php" class="right_b">Help </a></li>
    </ul> </div>
    <div class="call_us"><img src="images/footer-right.png" alt="call_us" />

</div>


</body>
</html>

 <script>
    function go(loc){
    document.getElementById('dynamic_vdo').src = "test_vdo.php?name="+loc;
}
function altRows(id){
	if(document.getElementsByTagName){  
		
		var table = document.getElementById(id);  
		var rows = table.getElementsByTagName("tr"); 
		 
		for(i = 0; i < rows.length; i++){          
			if(i % 2 == 0){
				rows[i].className = "evenrowcolor";
			}else{
				rows[i].className = "oddrowcolor";
			}      
		}
	}
}

window.onload=function(){
	altRows('alternatecolor');
    
}
    </script>

<style>
.info_suc {
    border: 1px solid;
    margin: 10px 0px;
    padding:4px 10px 6px 14px;
    background-repeat: no-repeat;
    background-position: 10px center;
    color: #fff;
    background-color: #00A7E2;
    width: 500px;
    text-align: center;
   
   
}

table.altrowstable {
font-family: 'PT Sans', sans-serif;
	font-size:14px;
	color:#333333;
	border-width: 1px;
	border-color: #e5e5e5;
    margin-top: 10px;
	
}
table.altrowstable th {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: black;
}
table.altrowstable td {
	border-width: 1px;
	padding: 8px;
	border-style: solid;
	border-color: #e5e5e5;
    overflow: hidden;
}
.oddrowcolor{
	background-color:#fff;
    border: 1px solid #e5e5e5;
}
.evenrowcolor{
	border: 1px solid #e5e5e5;
    background-color:#eee;
}

.delhov:hover{
    background: url(image/delete_hover.png);
}
.addhov:hover{
   background: url(image/addmore_hover.png); 
}

table.altrowstable {
font-family: 'PT Sans', sans-serif;
	font-size:14px;
	color:#333333;
	border-width: 1px;
	border-color: #e5e5e5;
    margin-top: 10px;
	
}
table.altrowstable1 th {
	border-width: 1px;

	border-style: solid;
	border-color: black;
}
table.altrowstable1 td {
	border-width: 1px;
	padding-top: 3px;
    padding-bottom: 3px;
	border-style: solid;
	border-color: #e5e5e5;
}
</style>


