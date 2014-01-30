<?php
$memberid=$_REQUEST["memberid"];
$f='../user/nas/uploads/' . $memberid . '/sync';
$bytes = 0;
$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($f));
foreach ($iterator as $i) 
	$bytes += $i->getSize();
echo $bytes;

function getSizeIn($bytes,$unit)
	{
	if($unit=="b")
		return $bytes;
	else if($unit=="kb")
		return $bytes/1024;
	else if($unit=="mb")
		return $bytes/(1024*1024);	
	else if($unit=="gb")
		return $bytes/(1024*1024*1024);
	else if($unit=="tb")
		return $bytes/(1024*1024*1024*1204);
	}
?>