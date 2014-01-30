<?php
if(isset($_POST["B1"]))
	{
	echo date("YmdHis");
	foreach($_FILES as $name=>$file)
		{
		$sub_name = $file['name'];
		$sub_name1 = $name;
		move_uploaded_file($file['tmp_name'], "user/profile_pic/default_image.jpg");
		}
	echo "<br>done " . date("YmdHis");
	}
?>

<form method="post" name="myform" action="testupload.php" enctype="multipart/form-data">
  <input type="file" name="F1" size="20">
  <input type="submit" value="Submit" name="B1">
</form>