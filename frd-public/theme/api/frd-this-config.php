<?php 
if(!isset($_POST['f_spiderecommerce'])){echo "<h6>Access Denied!!!</h6>"; exit;}

$FR_PATH_HD = "../../../";
require_once($FR_PATH_HD."frd-src/abc/frd-config.php");//FRD CONFIG
require_once($FR_PATH_HD."frd-src/abc/frd-spider-function.php");//FRD SPIDER FUN PHP
require_once($FR_PATH_HD."frd-src/abc/frd-this-function.php");