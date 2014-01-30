<?php

function get_ext($name)
{
    return strtolower(substr($name, strrpos($name, '.')+1));
}
if(isset($_REQUEST['name']))
{
    $ext=get_ext($_REQUEST['name']);
    
    if($ext=="flv" || $ext=="mp4")
    {
        ?>
        <script src='AC_RunActiveContent.js' language='javascript'></script>
<!-- saved from url=(0013)about:internet -->
<script language='javascript'>
 AC_FL_RunContent('codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0', 'width', '400', 'height', '325', 'src', ((!DetectFlashVer(9, 0, 0) && DetectFlashVer(8, 0, 0)) ? 'OSplayer' : 'OSplayer'), 'pluginspage', 'http://www.macromedia.com/go/getflashplayer', 'id', 'flvPlayer', 'allowFullScreen', 'true', 'allowScriptAccess', 'always', 'movie', ((!DetectFlashVer(9, 0, 0) && DetectFlashVer(8, 0, 0)) ? 'OSplayer' : 'OSplayer'), 'FlashVars', 'movie=<?php echo $_REQUEST['name']; ?>&btncolor=0x333333&accentcolor=0x31b8e9&txtcolor=0xdddddd&volume=30&autoload=on&autoplay=on&vTitle=Super Mario Brothers Lego Edition&showTitle=yes');
</script>
<noscript>
 <object width='400' height='325' id='flvPlayer'>
  <param name='allowFullScreen' value='true'>
   <param name="allowScriptAccess" value="always"> 
  <param name='movie' value='OSplayer.swf?movie=<?php echo $_REQUEST['name']; ?>&btncolor=0x333333&accentcolor=0x31b8e9&txtcolor=0xdddddd&volume=30&autoload=on&autoplay=off&vTitle=Super Mario Brothers Lego Edition&showTitle=yes'>
  <embed src='OSplayer.swf?movie=<?php echo $_REQUEST['name']; ?>&btncolor=0x333333&accentcolor=0x31b8e9&txtcolor=0xdddddd&volume=30&autoload=on&autoplay=off&vTitle=Super Mario Brothers Lego Edition&showTitle=yes' width='400' height='325' allowFullScreen='true' type='application/x-shockwave-flash' allowScriptAccess='always'>
 </object>
</noscript>
        <?php
        
    }
    if($ext=="wmv" )
    {
       ?>
       <object id="mediaplayer" classid="clsid:22d6f312-b0f6-11d0-94ab-0080c74c7e95" codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#version=5,1,52,701" standby="loading microsoft windows media player components..." type="application/x-oleobject" width="320" height="310">
<param name="filename" value="<?php echo $_REQUEST['name']; ?>">
     <param name="animationatstart" value="true">
     <param name="transparentatstart" value="true">
     <param name="autostart" value="true">
     <param name="showcontrols" value="true">
     <param name="ShowStatusBar" value="true">
     <param name="windowlessvideo" value="true">
     <embed src="<?php echo $_REQUEST['name']; ?>" autostart="true" showcontrols="true" showstatusbar="1" bgcolor="white" width="350" height="320">
</object>
       <?php 
    }
    if($ext=="avi" || $ext=="mpg" || $ext=="3gp" )
    {
        ?>
   <object type="video/quicktime" data="<?php echo $_REQUEST['name']; ?>" width="320" height="340">

<param name="controller" value="true" >

<param name="autoplay" value="true">

</object>





        <?php
    }
  
    
    
    
}




?>
