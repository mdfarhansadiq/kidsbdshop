<?php
session_start();
require_once("$FR_PATH_HD"."frd-data/config/frd-private.php");
extract( json_decode( file_get_contents("$FR_PATH_HD"."frd-data/config/frd-public.json") ,true) );

$FR_SOFT_VERSION = "74";

try {
    $FR_options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
    ];
    $FR_CONN = new PDO("mysql:host=$FRhostN;dbname=$FRdbN", $FRusrN, $FRpsw, $FR_options);
} catch(PDOException $e) {
  echo "DB CONNECTION FAILED:" . $e->getMessage(); exit;
}

//FRD TIME ZONE CONFIG:--
    date_default_timezone_set("Asia/Dhaka");

// ECHO "<BR><BR><BR><BR>";    
//FRD MOST USE TIME FORMATE CONFIG:--
    $FR_NOW_TIME = time();//1708244570
    $FR_NOW_DATE = date('Y-m-d');//2024-02-18
    $FR_NOW_MONTH = date('Y-m');//2024-02
    $FR_NOW_YEAR = date('Y');//2024
    $FR_NOW_DAY_F = date('l');//Sunday
    $FR_NOW_MONTH_F = date('F');//February

//FRD HURL:--
    $FR_HURL_IMG = "$FRD_HURL/frd-data/img";
    $FR_HURL_API = "$FRD_HURL/frd-api";

    //FRD SHOP INVOICE
    $FRxx_OT="frd_order_invo";
    $FRx1_OT="orderstoken_t_frd.php";
    //FRD ORDERS ITEMS
    $FRxx_OI="frd_orditems";//ORDERS ITEMS
    $FRx1_OI="orderss_t_frd.php";
    //FRD COUPON
    $FRxx_coup="frd_couponn";
    $FRx1_coup="couponn_t_frd.php";
    //FRD COMPLAIN:-
    $FRxx_4="frd_complimng";
    $FRx1_4="complain_t_frdnux.php";
    //FRD REFUND HISTORY:-
    $FRxx_5="frd_nct";
    $FRx1_5="nct_t_frhux.php";

//FRD SUPER PANELS HURL CONFIG:--
    $FR_SP_HURL_DP="$FRD_HURL/frdsp/dp";//DEFAULT PANEL

//FRD TEMP:-
    $c_hurl_frd="$FRD_HURL/customer";
    if(isset($_SERVER['HTTP_REFERER'])){ $http_referer_frd=$_SERVER['HTTP_REFERER']; }

$FRSSCSERVER = [
    "0" => "http://localhost/p/p16_ssc/ssc-secom3-dfyix/frd-ssc-call.php",
    "1" => "https://fraiserver.fazlerabbidhali.com/ssc-secom3-dfyix/frd-ssc-call.php",
    "2" => "https://fraiserver.fazlerabbidhali.com/ssc-secom3-dfyix/frd-ssc-call.php",
    "3" => "https://fraiserver.fazlerabbidhali.com/ssc-secom3-dfyix/frd-ssc-call.php"
];



//FRD FUNCTIONS START:-
    function FRF_USER_IP(){
        $FRc_USER_IP = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $FRc_USER_IP = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $FRc_USER_IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $FRc_USER_IP = $_SERVER['HTTP_X_FORWARDED'];
        else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $FRc_USER_IP = $_SERVER['HTTP_FORWARDED_FOR'];
        else if (isset($_SERVER['HTTP_FORWARDED']))
            $FRc_USER_IP = $_SERVER['HTTP_FORWARDED'];
        else if (isset($_SERVER['REMOTE_ADDR']))
            $FRc_USER_IP = $_SERVER['REMOTE_ADDR'];
        else
            $FRc_USER_IP = 'UNKNOWN';
        
        return $FRc_USER_IP;
    }
    function FRF_getBrowserNandV($userAgent) {
        // Array of browser patterns and corresponding names
        $browserPatterns = array(
            'firefox' => '/Firefox\/([0-9.]+)/i',
            'chrome' => '/Chrome\/([0-9.]+)/i',
            'edge' => '/Edge\/([0-9.]+)/i',
            'safari' => '/Version\/([0-9.]+)/i',
            'opera' => '/OPR\/([0-9.]+)/i',
            'ie' => '/MSIE|rv:([0-9.]+)/i' // Internet Explorer
        );
    
        // Iterate through patterns and match with User-Agent
        foreach ($browserPatterns as $browserName => $pattern) {
            if (preg_match($pattern, $userAgent, $matches)) {
                // Return browser name and version
                return array('name' => $browserName, 'version' => $matches[1]);
            }
        }
    
        // If no match found, return unknown
        return array('name' => 'unknown', 'version' => 'unknown');
    }
    function FRF_G_USER_UID(){
        $FRc_USER_UID = uniqid();
        return $FRc_USER_UID;
    }
    

    function generateFbc($fbclid) {
        $version = 'fb';
        $subdomainIndex = 1; // Assuming the domain is 'facebook.com'
        $creationTime = round(microtime(true) * 1000); // UNIX time since epoch in milliseconds
        $fbcValue = "{$version}.{$subdomainIndex}.{$creationTime}.{$fbclid}";
        return $fbcValue;
    }
    function generateFbp() {
        $version = 'fb';
        $subdomainIndex = 1; // Assuming the domain is 'facebook.com'
        $creationTime = round(microtime(true) * 1000); // UNIX time since epoch in milliseconds
        $randomNumber = mt_rand(); // Random number
        $fbpValue = "{$version}.{$subdomainIndex}.{$creationTime}.{$randomNumber}";
        return $fbpValue;
    }
//FRD FUNCTIONS END>>



if(isset($_GET['fbclid'])){
    $fbc = generateFbc($_GET['fbclid']);
    setcookie('_fbc', $fbc, time() + (30 * 24 * 3600), '/'); // The cookie is valid for 30 days

    $fbp = generateFbp();
    setcookie('_fbp', $fbp, time() + (30 * 24 * 3600), '/'); // The cookie is valid for 30 days
}
if(!isset($_COOKIE['_FRc_USER_UID'])){
    $FRc_USER_UID = FRF_G_USER_UID();
    setcookie('_FRc_USER_UID', $FRc_USER_UID, time() + (365 * 24 * 3600), '/'); // The cookie is valid for 365 days
}
if(!isset($_COOKIE['_FRc_USER_AGENT'])){
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        $browserInfo = FRF_getBrowserNandV($userAgent);
        $browserName = $browserInfo['name'];
        $browserVersion = $browserInfo['version'];
    }else{
        $browserName = "User-Agent header is not present in the request.";
        $browserVersion = "User-Agent header is not present in the request.";
    }

    setcookie('_FRc_USER_AGENT', "$browserName", time() + (7 * 24 * 3600), '/'); // The cookie is valid for 7 days
}


$FRc_USER_IP = FRF_USER_IP();//254.254.254.254
$FRc_EXTERNAL_ID = hash('sha256', uniqid());
$FRc_EVENT_ID = uniqid();
$FRc_THIS_PAGE_URL = "$FRD_HURL".$_SERVER['REQUEST_URI'];

$FRc_USER_AGENT = "";//BROWSER INFO
if(isset($_COOKIE['_FRc_USER_AGENT'])){ $FRc_USER_AGENT = $_COOKIE['_FRc_USER_AGENT']; }

$FRc_USER_UID = "";
if(isset($_COOKIE['_FRc_USER_UID'])){ $FRc_USER_UID = $_COOKIE['_FRc_USER_UID']; }

$FRc_fbc = "";
if(isset($_COOKIE['_fbc'])){ $FRc_fbc = $_COOKIE['_fbc']; }

$FRc_fbp = "";
if(isset($_COOKIE['_fbp'])){ $FRc_fbp = $_COOKIE['_fbp']; }