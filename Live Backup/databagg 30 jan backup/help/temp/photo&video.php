<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Databagg</title>

<link href="../App_Theme/mainstyle.css" rel="stylesheet" type="text/css" />
<link href="../App_Theme/help.css" rel="stylesheet" type="text/css" />

<link href='http://fonts.googleapis.com/css?family=PT+Sans:400' rel='stylesheet' type='text/css'>

<!-- Accordation menu start -->


<script type="text/javascript" src="../Script/accordation/jquery-latest.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
//Set default open/close settings
$('.acc_container').hide(); //Hide/close all containers
$('.acc_trigger:first').addClass('active').next().show(); //Add "active" class to first trigger, then show/open the immediate next container

//On Click
$('.acc_trigger').click(function(){
	if( $(this).next().is(':hidden') ) { //If immediate next container is closed...
		$('.acc_trigger').removeClass('active').next().slideUp(); //Remove all .acc_trigger classes and slide up the immediate next container
		$(this).toggleClass('active').next().slideDown(); //Add .acc_trigger class to clicked trigger and slide down the immediate next container
	}
	return false; //Prevent the browser jump to the link anchor
});

});
</script>
	

<!-- Accordation menu start -->


</head>
<body>
<div class="mainpageheader">
<?php include('../topmenu.html');?>  
  

  <div class="other-content">
  <div class="other-content-top"></div>
    <div class="other-content-middle"><br />
    
<div class="avail-text-help"><ul>
<li>Help Center</li>
<li>&raquo;</li>
<li class="active"><a href="photo&video.html">Photo &amp; Video</a></li>

</ul>
</div>
    
 
    <div class="feature-content">
    
       <div class="feature-help-left">
       
       <div class="container-accordsation">

	
    <h2 class="acc_trigger"><a href="#">
How do I create a photo album
<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
<p>Albums are the easiest way to organize and share a bunch of photos and videos in your DataBagg. Once you create an album, you can share it with friends, family, and colleagues—even if they don't have a DataBagg account.</p>
<ol>
<li>After signing in, click on My Albumstab.</li>
<li>Click on Create Album button.</li>
<li>Provide Album name and Select photos for the album.</li>
<li>Click on Create Album</li>
</ol>


<img src="../images/help/videoalbum.png" width="623" height="298" alt="" /></div>

	</div>
	

	
	<h2 class="acc_trigger"><a href="#">How do I share photos with other people?<br />
    <span> </span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
<p>You can easily share photos from DataBagg. Share a link to a single photo or an entire album you've created, such as for a special event. Anyone who receives the link can take a look, even if they don't have a DataBagg account.</p>
<ul>
<li>After signing in, click on My Data Baggtab</li>.
<li>Select your photo and click on Share button.</li>
</ul>

<img src="../images/help/howinsta.png" width="634" height="461" alt="" /></div>

	</div>
	<h2 class="acc_trigger"><a href="#">How do I add photos to an album?<br />
    <span></span>
    
    
    </a></h2>

	<div class="acc_container">
		<div class="block">
		
			<p>How do I add photos to an album?
You can add photos to an existing album on your Album page on the DataBagg website.</p>

<ol>
<li>After signing in, click on My Albumtab.</li>
<li>Click on Add More button.</li>
<li>Add your selected photo.</li>
</ol>    
<p>Adding photos to an album does not take up additional space in your account, nor does it change the locations of your files.</p>

<img src="../images/help/addalbum.png" width="624" height="330" alt="" /></div>

	</div>
	
	
	
    
    <h2 class="acc_trigger"><a href="#">How do I remove photos from an album?<br />
    <span></span>
    
    
    </a></h2>
	
    
    <div class="acc_container">
		<div class="block">
		
			<p>You can remove photos from an existing album on your Album page. Removing photos from an album will not delete them from your account.</p>
            <ol>
<li>After signing in, click on My Album tab.</li>
<li>Click on List Allbutton.</li>
<li>Delete any photo.</li>
</ol>
            <img src="../images/help/creatalbum.png" width="634" height="665" alt="" /></div>

	</div>
    
    
	
</div></div>
        
      <?php include('../rightpannel.html');?>
    
      <div style="clear:both"></div>
    </div>
    
    
    
        
    
    
  <div style="clear:both"></div>
  
  </div>
  
  
	
    <div style="clear:both"></div>
</div>

  <?php include('../calling.html');?>
   <?php include('../footer.html');?>
   <?php include('../bottom.html');?>



<div style="clear:both;"></div>
</div>
</body>
</html>
