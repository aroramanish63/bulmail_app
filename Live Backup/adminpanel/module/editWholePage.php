<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php
if(file_exists('../includes/config.php')){ 
    include_once '../includes/config.php';
} 
$page='index.php';
include($cfg['base_path'].$page); 
?>