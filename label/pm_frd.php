<?php
$Callingg="FRD";//File access Validaion O Step
$FR_PATH_HD = "../";
require_once("../frd-src/abc/frd-config.php");
require_once("../frd-src/abc/frd-spider-function.php");
if(isset($_GET['urll'])){

    $url = explode('/',$_GET['urll']); 
    // PR($url);
    $P_R = $url[0];
    $FRc_Invoice_EncId_x = $url[1];


    //FRD  DATA:-
    $FRR = FR_QSEL("SELECT * FROM frd_cprofile WHERE id = 1","");
    if($FRR['FRA']==1){ 
    extract($FRR['FRD']);
    } else{ ECHO_4($FRR['FRM']); }
    //END>>


    //FRD ORDER INVOICE T DATA READ START:-
    $FRR = FR_QSEL("SELECT * FROM frd_order_invo WHERE fr_enc_id = '$FRc_Invoice_EncId_x' AND fr_stat != 0", "");
    if ($FRR['FRA'] == 1) {
        extract($FRR['FRD']);
        $FRc_Invoice_Id_x = $id;
        $FRc_Invo_Stat_x = $fr_stat;
    } else {
        ECHO_4($FRR['FRM']);
        exit;
    }
    //END>>



   if($P_R=="L1"){$P_L="page/label_1_frd.php";}
   if($P_R=="L2"){$P_L="page/label_2_frd.php";}
    
   if(isset($P_L)){require_once($P_L);}
    
}