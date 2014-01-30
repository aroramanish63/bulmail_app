<?php
error_reporting(E_ALL);
ini_set("display_errors",1);
$file_directory = './nas';
$output = exec('du -sk ' . $file_directory);
$filesize = trim(str_replace($file_directory, '', $output)) * 1024;
echo "size: " . $filesize;
?>