<?php
$Callingg = "FRD"; // File access Validaion O Step

$FR_PATH_HD = "../../../../../";
$rtd_path = $FR_PATH_HD . "rtd";
require_once($FR_PATH_HD . "frd-src/abc/frd-config.php");
$FR_HURL_AT = "$FRD_HURL/frd-public/theme";
$fr_cat_bpro_url = "$FRD_HURL/category";

//FRD SENDED DATA RECEIVING:-
$FR_start = $_POST["start"];
$limit = $_POST["limit"];
if (isset($_POST['searchshopn'])) {
     $FR_SShopName = $_POST["searchshopn"];
     $FRc_CACHE_ExT = "$FR_SShopName"; //FRD CACHE FILE PATH EXTRA TEXT
}
