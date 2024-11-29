<?php
 $FRQ = $FR_CONN->query("SELECT * FROM frd_soft_config WHERE id = 1");
 extract($FRQ->fetch());
 
 //FRD USER CP DATA:-
 $FRR = FR_QSEL("SELECT * FROM frd_cprofile WHERE id = 1","");
 if($FRR['FRA']==1){ 
   extract($FRR['FRD']);
 } else{ ECHO_4($FRR['FRM']); }
 //END>>
//FRD USER TABLE DATA:-
$FRR = FR_QSEL("SELECT fr_uapp FROM frd_usr WHERE id = $UsrId","");
if($FRR['FRA']==1){ 
  extract($FRR['FRD']);
  $fr_uapp_ARR = explode(",",$fr_uapp);
} else{ ECHO_4($FRR['FRM']); }
//END>>
//FRD Theme CONFIG TABLE DATA:-
$FRR = FR_QSEL("SELECT * FROM frd_themeconfig WHERE id = 1","");
if($FRR['FRA']==1){ 
  extract($FRR['FRD']);
} else{ ECHO_4($FRR['FRM']); }
//END>>
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="900">
    <title><?php echo "$FR_ptitle";?></title>
	  <link rel="icon" href="<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_cicon";?>">
    <link href="<?php echo "$FR_SP_HURL_DP/asset/css/bootstrap.min.css";?>" rel="stylesheet">
    <link href="<?php echo "$FR_SP_HURL_DP/asset/css/style.css?v=$FR_SOFT_VERSION";?>" rel="stylesheet">
    <link href="<?php echo "$FR_SP_HURL_DP/asset/css/animatee.css";?>" rel="stylesheet">
    <link href="<?php echo "$FR_SP_HURL_DP/asset/css/chosen.css";?>" rel="stylesheet"> 
    <link href="<?php echo "$FR_SP_HURL_DP/asset/fonts/SolaimanLipiNormal/styles.css";?>" rel="stylesheet">
    <link href="<?php echo "$FR_SP_HURL_DP/asset/css/jquery-ui.min.css";?>" rel="stylesheet">
    <link href="<?php echo "$FR_SP_HURL_DP/asset/css/toastr.min.css";?>" rel="stylesheet">
    <link href="<?php echo "$FR_SP_HURL_DP/asset/summernote/summernote_mincss.css"?>" rel="stylesheet">
    <link href="<?php echo "$FRD_HURL/frd-src/inc/owl_caro/css/owl.carousel.min.css"?>" rel="stylesheet">
    <link href="<?php echo "$FRD_HURL/frd-src/inc/owl_caro/css/owl.theme.green.min.css"?>" rel="stylesheet">
    <!-- FONT AWESOM ICON CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <!-- --------------------------------------------------------- -->
    <script src="<?php echo "$FRD_HURL/frd-src/inc/js/jquery-3.4.1.min.js";?>"></script>
    <script src="<?php echo "$FRD_HURL/frd-src/inc/toastr/toastr.min.js";?>"></script>
    <script src="<?php echo "$FRD_HURL/frd-src/inc/js/sweetalert.min.js"?>"></script>
    <script src="<?php echo "$FRD_HURL/frd-src/inc/owl_caro/js/owl.carousel.min.js"?>"></script>
     <script>
        const FRD_HURLL = "<?php echo "$FRD_HURL";?>";
        const FR_HURL_APII = "<?php echo "$FR_HURL_API";?>";
        const FR_SERVERR = '<?php echo "$frd_server";?>';
        const FR_PHURL_THISS = '<?php echo "$FR_THISHURL";?>';
        const FRD_AKEY_2 = '<?php echo "$FR_AKEY_2";?>';
        const FRc_USER_NAMEE = '<?php echo $_SESSION['sUsrName'];?>';
        const FRc_ACTIVELINKK = "<?php echo "$FR_RP";?>";
        const FRc_PAN = "<?php echo "$FRc_PAN";?>";
    </script>
  </head>
<body>
<?php
require_once('frd1_nav_top.php');
require_once('frd1_nav_side.php');

//FRD VC ACCESS PERMITION HAVE OR NOT OF THIS USER:-
if(in_array($FRc_THIS_P_ID, $fr_uapp_ARR)){ }else{ FR_SWAL("Dear Boss $UsrName!","You are not allowed to enter here!","warning"); FR_GO("$FR_THISHURL/dp-panels","2"); exit;  }
//END>>