<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Go Invoice Edit";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT">  </h2> -->
<!-- 1 SCRIPT S-->
<section> 
<?php
    
    if(!isset($FRurl[1]) OR $FRurl[1] == ""){
        FR_GO("$FR_THISHURL/PanelChanger/1/?FRH=NXJYSNXJX");
    }
    //++
    $FRc_InvoiceId = $FRurl[1];






    $FRR = FR_QSEL("SELECT fr_enc_id FROM frd_order_invo WHERE id = $FRc_InvoiceId AND fr_stat != 0", "");
    if ($FRR['FRA'] == 1) {
        extract($FRR['FRD']);
    } else {
        // ECHO_4($FRR['FRM']);
        FR_SWAL("This Is Not Valid Invoice", "", "error");
        FR_GO("$FR_THISHURL/InvoiceList/","2");
        exit;
    }

    FR_GO("$FR_THISHURL/om-InvoiceEdit/$fr_enc_id");
    exit;

    
?>
</section>
<!-- 1 SCRIPT E-->





 
 <?php require_once('frd1_footer.php'); ?>