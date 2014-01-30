<?
function uploadFileFromPC($httpfile,$filepath,$tabname,$upfldname,$critfld,$critvalue,$thumbalso,$thumbwid,$thumbht,$fixname)
	{
	$tempname=str_replace(' ','',$_FILES[$httpfile]['tmp_name']);
	$orgname=$_FILES[$httpfile]['name'];

	if($tempname=="")
		return "nofile";

	$filename=generateUniqueNumber(10,true) . "_" . $orgname;
	if(!move_uploaded_file($tempname,$filepath . $filename))
		return "error";

	if($thumbalso==true)
		{
		// Thumb Image
		$dest2 = $filepath . "thumb_" . $filename;
		$path = $filepath . $filename; 
		$thumb = new Thumbnail($path);
		$thumb->resize($thumbwid,$thumbht);
		$thumb->save($dest2);
		}


	// unlink previous file
	$query="Select " . $upfldname . " from " . $tabname . " where " . $critfld . "='" . $critvalue . "'";
	$result=mysql_query($query) or die(mysql_error());
	$row=mysql_fetch_array($result);
	$prefile=$filepath . $row[$upfldname];
	if($thumbalso==true)
		$prethumbfile=$filepath . "thumb_" . $row[$upfldname];
	if($row[$upfldname]!="")
		{
		if(file_exists($prefile))
			{
			unlink($prefile);
			if($thumbalso==true)
				unlink($prethumbfile);
			}
		}

	// save new file
	$query="Update " . $tabname . " set " . $upfldname . "='" . $filename . "',txt_original_name='" . $orgname . "' where " . $critfld . "='" . $critvalue . "'";
	mysql_query($query) or die(mysql_error());
	return "success";
	}
?>