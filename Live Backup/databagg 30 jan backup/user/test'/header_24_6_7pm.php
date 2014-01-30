<script>
function hides()
{
    
    frameset=parent.document.getElementById("main");
    if(frameset.getAttribute("rows")=="0%,*")
    frameset.setAttribute("rows","12%,*");
    else
    frameset.setAttribute("rows","0%,*");
}
</script>

<div class="header">

<div class="fright">

<ul class="link">
<li>
 
 <a onclick="hides();" href="javascript:void(0);" >
 <div id="img1" style="display:<?php if($_SESSION['music_bar']) echo "block"; else echo "none"; ?>;">

 <img     src="images/bars.gif"  /><br> show/hide player 
 </div></a>
 
 
</li>
     
     
     
       <li>
       
       <a href="dashboard.php">Home</a>
       
       </li>
   <li class="boder_right"><a href="index.php?name_page=my_settings"><img src="image/index_tp_img.png" alt="" />  Welcome  
   <strong style="color: #049cd4;"><?php echo ucfirst($fetch_user_data['txt_first_name'])." ".ucfirst(substr($fetch_user_data['txt_last_name'],0,1))."."; ?>
   </strong></a>

   </li>
    
   <li class="boder_right"><form id="inputwraper" action="" method="post">

<form action="#" id="searchform" method="post">
<input id="s"  name="s" type='keywords' maxlength="17"  class="search" value="<?php if($_REQUEST['s']) echo $_REQUEST['s']; else echo "Search"; ?>" onfocus="if(this.value=='Search'){this.value=''};" onblur="if(this.value==''){this.value='Search'};" />
<input type="hidden" value="<?php echo $_REQUEST['name_page']; ?>" id="name_page" name="name_page" />
</form>

</li>
</ul>

</div>

<div class="tp_logo" >
<div class="logo" ></div>
<img onclick="location.href='../databagg.zip';" src="image/install-img.png" style="cursor: pointer;margin-left: 64%;" onmouseover="this.src='image/install-img-o.png';" onmouseout="this.src='image/install-img.png';" />
</div>
</div>

