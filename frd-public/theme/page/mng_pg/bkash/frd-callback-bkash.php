<?php 
ob_start();
require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "$fr_cname - $fr_ctagline";
$FRc_META_TAG_HTML = "";
require_once("frd-public/theme/frd-header.php");

?>
<!-- <h2 class="PT"> Bkash Callback </h2> -->
<!-- 1 scripts s-->
<section>
<?php   

// Exticute resposce:-
//     [statusCode] => 0000
//     [statusMessage] => Successful
//     [paymentID] => TR0011J81678890086623
//     [payerReference] =>  
//     [customerMsisdn] => 01770618575
//     [trxID] => ACF90AIJVB
//     [amount] => 170.00
//     [transactionStatus] => Completed
//     [paymentExecuteTime] => 2023-03-15T20:23:07:091 GMT+0600
//     [currency] => BDT
//     [intent] => sale
//     [merchantInvoiceNumber] => 9976


if (isset($_GET['status'])){
    if ($_GET['status'] == 'success'){
        $result_data = execute($_GET['paymentID']);
        $response = json_decode($result_data, true);
        
        if(isset($response['statusCode']) && $response['statusCode'] != '0000'){
             // Error case
             echo "
                <div class='text-center'>
                <img src='$FRD_HURL/frd-src/img/gif/frd-crose-1.gif' alt='#' style='width:auto;height:200px;margin:auto;'>
                <h3>Your payment failed</h3>
                <h4>Message: ".$response['statusMessage']."</h4>
                <a href='$FRD_HURL/track/".$_COOKIE['FRcok_LastViesInvoeEncId']."'> >>> Track Your Order </a>
                </div>
             ";
             FR_GO("$FRD_HURL/track/".$_COOKIE['FRcok_LastViesInvoeEncId']."",9);

        }else{
            // db insert operation strore $response data
            //echo "<h1 >Thank you !! your payment has been successfully done.</h1><p>Your Trx ID: ".$response['trxID']."</p>";

            $FRc_TranReference = $response['payerReference'];
            $FRc_TranExecutetime = $response['paymentExecuteTime'];
            $FRc_TranBkashPaymentID = $response['paymentID'];
            $FRc_PayInvoEncId = $response['payerReference'];
            $FRc_PayAmount = $response['amount'];
            $FRc_PayGtwId = 4;
            $FRc_PayTrnxId = $response['trxID'];
            $FRQ = $FR_CONN->query("SELECT id AS FRc_PayInvoId,fr_cust_name,fr_o_pros_history FROM frd_order_invo WHERE fr_enc_id = '$FRc_PayInvoEncId'");
            extract($FRQ->fetch());

            $FRQ = $FR_CONN->query("SELECT fr_bka_bank_ac_id FROM frd_paygw_bkash WHERE id = 1");
            extract($FRQ->fetch());

            // PR( FRF_PAYMENT_UPDATE($FRc_PayInvoId,$FRc_PayInvoEncId,$FRc_PayAmount,$FRc_PayGtwId,$FRc_PayTrnxId) );
            $FRR = FRF_PAYMENT_UPDATE($FRc_PayInvoId,$FRc_PayInvoEncId,$FRc_PayAmount,$FRc_PayGtwId,$FRc_PayTrnxId,$fr_bka_bank_ac_id);
            if($FRR['FRA'] == 1){
                //KEEP SAVE SOME MORE ADITIONAL INFORMATION OF THIS TRANJECTION:-
                 try{
                    $FRc_MTL_LastInId = $FRR['FRD_MTL_LastInId'];
                    $FR_CONN->exec("UPDATE frd_mtl SET fr_trn_reference = '$FRc_TranReference', fr_trn_executetime = '$FRc_TranExecutetime', fr_bka_paymentid = '$FRc_TranBkashPaymentID' WHERE id = $FRc_MTL_LastInId");
                 }catch(PDOException $e){ 
                    FR_TAL("Transection Additional Data Save Failed","error");
                 }
                //END>>
                //FRD ORDER PROCESS HISTORY DATA SAVE START:-
                try{
                    $FRc_OrderProsHistory = "$fr_o_pros_history ,প্রিয় $fr_cust_name ধন্যবাদ $FRc_PayAmount ৳ পেমেন্ট করার জন্য বিকাশ অনলাইন পেমেন্ট গেটওয়ের মাধ্যমে। ট্রানজেকশন আইডি: $FRc_PayTrnxId * ".date('d-M-Y h:i A',$FR_NOW_TIME)."";
                    $FR_CONN->exec("UPDATE frd_order_invo SET fr_o_pros_history = '$FRc_OrderProsHistory' WHERE id = $FRc_PayInvoId");
                 }catch(PDOException $e){ 
                    FR_TAL("Order Process History Data Save Failed","error");
                 }
                //END>>
                
                echo "
                    <div class='text-center'>
                    <img src='$FRD_HURL/frd-src/img/gif/frd-thank-you-1.gif' alt='#' style='width:300px;height:auto;margin:auto;'>
                    <h2>Dear $fr_cust_name Thank you !!</h2>
                    <h3>Your payment has been successfully done.</h3>
                    <h4>Message: ".$response['statusMessage']."</h4>
                    <a href='$FRD_HURL/track/$FRc_PayInvoEncId'> >>> Track Your Order </a>
                    </div>
                ";
                FR_GO("$FRD_HURL/track/$FRc_PayInvoEncId",3);
            }else{
                echo "
                    <div class='text-center'>
                    <img src='$FRD_HURL/frd-src/img/gif/frd-warning-1.gif' alt='#' style='width:auto;height:200px;margin:auto;'>
                    <h3>Payment Information Update Failed</h3>
                    <h3>Call Us For Give This Information: $fr_cmobile_1</h3>
                    <a href='$FRD_HURL/track/$FRc_PayInvoEncId'> >>> Track Your Order </a>
                    </div>
               ";
            }

        }
    }else{
            echo "
                <div class='text-center'>
                <img src='$FRD_HURL/frd-src/img/gif/frd-crose-1.gif' alt='#' style='width:auto;height:200px;margin:auto;'>
                <h3>Your payment failed</h3>
                <h4>Message: ".$_GET['status']."</h4>
                <a href='$FRD_HURL/track/".$_COOKIE['FRcok_LastViesInvoeEncId']."'> >>> Track Your Order </a>
                </div>
            ";
            FR_GO("$FRD_HURL/track/".$_COOKIE['FRcok_LastViesInvoeEncId']."",3);
    }
}else{
    FR_GO("$FRD_HURL/?FRH=JHSYH6YEHBVNX");
}
?>
</section>
<!-- 1 scripts e-->






<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>



<?php require_once("frd-public/theme/frd-footer.php"); ob_end_flush(); ?>