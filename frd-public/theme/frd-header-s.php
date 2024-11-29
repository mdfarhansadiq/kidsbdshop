<?php
$Callingg="FRD";//FRD 0 STEP VALIDATION
$rtd_path="rtd";
$FR_DATAPATH_AT = "frd-data/theme";
$FR_THEMEPATH_AT = "frd-public/theme";
$FR_HURL_AT = "$FRD_HURL/frd-public/theme";
$FR_DATAHURL_AT = "$FRD_HURL/frd-data/theme";
$pageview_frd="$FRD_HURL/page";
$fr_cat_bpro_url="$FRD_HURL/category";
$FR_LOGIN_M_PSW = "ONN";//FRD PASSWORD LOGIN MODE [ONN/OFF]
$FR_THISHURL="$FRD_HURL";
$FR_HDPATH="";


// if(!isset($_SESSION['FRs_DDOSP'])){
//   $_SESSION['FRs_DDOSP'] = "1";
//   ECHO $FRc_targetURL = "$FRD_HURL".$_SERVER['REQUEST_URI'];
//   header("HTTP/1.1 301 Moved Permanently");
//   header("Location: $FRc_targetURL");
//   ECHO_4("PLZ WAIT","text-center");
//   exit;
// }

if($FR_SERVER == 1){
    if($_SERVER['REQUEST_SCHEME'] == "http"){
        $FRc_targetURL = "$FRD_HURL".$_SERVER['REQUEST_URI'];
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: $FRc_targetURL");
        exit();
    }else{
       if (strstr($_SERVER['HTTP_HOST'], 'www')) { 
            $FRc_targetURL = "$FRD_HURL".$_SERVER['REQUEST_URI'];
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: $FRc_targetURL");
            exit();
       }
    }
}

$FRQ = $FR_CONN->query("SELECT * FROM frd_soft_config WHERE id = 1");
extract($FRQ->fetch());

$FRQ = $FR_CONN->query("SELECT * FROM frd_cprofile WHERE id = 1");
extract($FRQ->fetch());
if(!isset($_SESSION['FRs_fr_clogo'])){$_SESSION['FRs_fr_clogo']="$fr_clogo";}

$FRQ = $FR_CONN->query("SELECT * FROM frd_themeconfig WHERE id = 1");
extract($FRQ->fetch());
if(!isset($_SESSION['FRs_frtc_lang'])){ $_SESSION['FRs_frtc_lang'] = "$frtc_lang"; }

$FRQ = $FR_CONN->query("SELECT * FROM frd_themelan WHERE frlc_lang = '".$_SESSION['FRs_frtc_lang']."'");
extract($FRQ->fetch());