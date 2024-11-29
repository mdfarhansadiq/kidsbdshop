<?php
$Callingg="FRD";//FRD LAVEL 0 VALIDATION
$FR_HDPATH="../..";
$FR_PATH_HD = "../../";
require_once($FR_PATH_HD."frd-src/abc/frd-config.php");
require_once($FR_PATH_HD."frd-src/abc/frd-spider-function.php");
require_once("$FR_HDPATH/frd-src/abc/frd-this-function.php");
$rtd_path="$FR_HDPATH/rtd";
$FR_THISHURL="$FR_SP_HURL_DP";
$FR_THIS_PAGE = "$FR_SP_HURL_DP/$FR_RP";
function FRfun_ab(){
    global $FR_SP_HURL_DP;
    header("location:$FR_SP_HURL_DP/dp-logout?FRH=Access Denied");
}
$a="active";




//FRD LEVEL 0 VALIDATION
if("$Callingg" !== "FRD"){ header("location:$FR_SP_HURL_DP/dp-logout?frd_h=FRD lavel-0 validation activated"); }
//FRD STEP 1 VALIDATION:-
if(!isset($_SESSION['sUsrEmail'])){ header("location:$FR_SP_HURL_DP/dp-logout?frd_h=FRD lavel-1 validation activated"); }

$UsrId=$_SESSION['sUsrId'];
$UsrName=$_SESSION['sUsrName'];
$UsrType=$_SESSION['sUsrType'];
$UsrEmail=$_SESSION['sUsrEmail'];//PRIMARY EMAIL
$UsrPicc=$_SESSION['sUsrPic'];
$FRs_ActivePanel = $_SESSION['FRs_ActivePanel'];

//FRD 2 step Usr Validatio clacking:-
if(!isset($_SESSION['2suv'])){
    $FRQ = $FR_CONN->query("SELECT email1,psww FROM frd_usr WHERE id = $UsrId");
    $row_2svc = $FRQ->fetch();
    if($row_2svc['email1'] !== $UsrEmail or $row_2svc['psww'] !== $_SESSION['sUsrPsw']){
        header("location:$FR_SP_HURL_DP/dp-logout");
    }else{
       $_SESSION['2suv']="Passed";//when Passed 2 Step User Validation then start this Session
       unset($_SESSION['sUsrPsw']);//Unset Usr Psw After 2 step validation    
    }
}
//++
//FRD STEP 2 VALIDATION:-
if(!isset($_SESSION['2suv'])){ header("location:$FR_SP_HURL_DP/dp-logout?frd_h=FRD lavel-2 validation activated"); }

ob_start();