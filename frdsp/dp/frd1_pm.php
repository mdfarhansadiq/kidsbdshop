<?php
if(isset($_GET['url']) ){
$FRurl=explode('/',$_GET['url']);
// echo '<pre>'; print_r($FRurl); echo '</pre>';
$FR_RP = $FRurl[0];

$FRc_PnP = explode('-', $FRurl[0]);
$FRc_PAN = $FRc_PnP[0];
$FRc_PAG = $FRc_PnP[1];

$FR_RPL="page/frd-p-$FRc_PAN/frd-$FRc_PAG.php";
if(file_exists($FR_RPL)){
  require_once("$FR_RPL"); 
}else{
  require_once("page/frd-p-dp/frd-PageNotFound.php");
  exit;
}
}