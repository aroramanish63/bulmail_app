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

<link href="share.css" rel="stylesheet" type="text/css" />
<style type="text/css">
a, a img { outline: none; border:none;}
</style>
<!--<link href="App_Theme/dashboard.css" rel="stylesheet" type="text/css" />-->

<link href='http://fonts.googleapis.com/css?family=PT+Sans:400' rel='stylesheet' type='text/css'>
</head>
<body class="body_wrap">
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

<div class="wrapper">
	<?php
if(mysql_num_rows($result_exist_share)>0)
{
?>
    
    
    <style>
      body { color: #666; font-family: sans-serif; line-height: 1.4; }
      h1 { color: #444; font-size: 1.2em; padding: 14px 2px 12px; margin: 0px; }
      h1 em { font-style: normal; color: #999; }
      a { color: #888; text-decoration: none; }
      #wrapper { width: 400px; margin-left: 15%  }
      
      ol { padding: 0px; margin: 0px; list-style: decimal-leading-zero inside; color: #ccc; width: 460px; border-top: 1px solid #ccc; font-size: 0.9em; }
      ol li { position: relative; margin: 0px; padding: 9px 2px 10px; border-bottom: 1px solid #ccc; cursor: pointer; }
      ol li a { display: block; text-indent: -3.3ex; padding: 0px 0px 0px 20px; }
      li.playing { color: #000; text-shadow: 1px 1px 0px rgba(255, 255, 255, 0.3); }
      li.playing a { color: #000; }
      li.playing:before { content: url(play.png); width: 14px; height: 14px; padding: 3px; line-height: 14px; margin: 0px; position: absolute; left: -50px; top: 9px; color:red; font-size: 13px; text-shadow: 1px 1px 0px rgba(0, 0, 0, 0.2); }
      
      #shortcuts { position: fixed; bottom: 0px; width: 100%; color: #666; font-size: 0.9em; margin: 60px 0px 0px; padding: 20px 20px 15px; background: #f3f3f3; background: rgba(240, 240, 240, 0.7); }
      #shortcuts div { width: 460px; margin: 0px auto; }
      #shortcuts h1 { margin: 0px 0px 6px; }
      #shortcuts p { margin: 0px 0px 18px; }
      #shortcuts em { font-style: normal; background: #d3d3d3; padding: 3px 9px; position: relative; left: -3px;
        -webkit-border-radius: 4px; -moz-border-radius: 4px; -o-border-radius: 4px; border-radius: 4px;
        -webkit-box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1); -moz-box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1); -o-box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1); box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1); }

      @media screen and (max-device-width: 480px) {
        #wrapper { position: relative; left: -3%; }
        #shortcuts { display: none; }
      }
    </style>
    <script src="../../jquery.js"></script>
    <script src="../../audio1.js"></script>
    <script>
      $(function() { 
        // Setup the player to autoplay the next track
        var a = audiojs.createAll({
          trackEnded: function() {
            var next = $('ol li.playing').next();
            if (!next.length) next = $('ol li').first();
            next.addClass('playing').siblings().removeClass('playing');
            audio.load($('a', next).attr('data-src'));
            audio.play();
          }
        });
        
        // Load in the first track
        var audio = a[0];
            first = $('ol a').attr('data-src');
        $('ol li').first().addClass('playing');
        audio.load(first);

        // Load in a track on click
        $('ol li').click(function(e) {
          e.preventDefault();
          $(this).addClass('playing').siblings().removeClass('playing');
          audio.load($('a', this).attr('data-src'));
          audio.play();
        });
        // Keyboard shortcuts
        $(document).keydown(function(e) {
          var unicode = e.charCode ? e.charCode : e.keyCode;
             // right arrow
          if (unicode == 39) {
            var next = $('li.playing').next();
            if (!next.length) next = $('ol li').first();
            next.click();
            // back arrow
          } else if (unicode == 37) {
            var prev = $('li.playing').prev();
            if (!prev.length) prev = $('ol li').last();
            prev.click();
            // spacebar
          } else if (unicode == 32) {
            audio.playPause();
          }
        })
      });
    </script>
  </head>
  <body>
    <div id="wrapper">
    
      <audio preload></audio>
      <ol style="display: block;">
       <?php
        $data="";
    $count=0;
    
  
    
    $select_list_data="select * from users_data where int_fid in(".$fetch_share_link['txt_fid'].") and int_del_status='0'";
    
    
    $result_list_data=mysql_query($select_list_data) or die(mysql_error());
  
       $data="";
    while($fetch_list_data=mysql_fetch_array($result_list_data))
    { $count++;
    
        $path="../../../";
        $path.=$fetch_list_data['txt_real_path'];
        $nm=$fetch_list_data['txt_file_name'];
       
       
        
 
   echo "<li><a href=\"#\" data-src=\"$path\"></a>$nm</li>";

 
  

        
        
       
        
    }
       ?>
       </ol>
    </div>
     <div style="text-align: center;margin-top: 2px;margin-left: 0% ">
       <!--Keyboard shortcuts:-
       &nbsp; <em>&rarr;</em> Next track
        <em>&larr;</em> Previous track
       <em>Space</em> Play/pause  -->
       <a href="javascript:next1();"><img src="../../image/next-icon.png" title="Next" /></a>
      <a href="javascript:prev1();"><img title="Previous" src="../../image/pre-icon.png" /></a>
      </div>
  </body>
</html>
<script>
function prev1()
{
    var prev = $('li.playing').prev();
            if (!prev.length) prev = $('ol li').last();
            prev.click();
}
function next1()
{
    var next = $('li.playing').next();
            if (!next.length) next = $('ol li').first();
            next.click();
}
</script>
    
    
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



<style>
.info_suc {
    border: 1px solid;
    margin: 10px 0px;
    padding:4px 10px 6px 14px;
    background-repeat: no-repeat;
    background-position: 10px center;
    color: #fff;
    background-color: #00A7E2;
   
   
}
</style>


