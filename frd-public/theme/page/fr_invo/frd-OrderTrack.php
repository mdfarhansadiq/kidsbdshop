<?php
ob_start();

$FRc_Invoice_EncId_x = $url[1];
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
//+
//+
if ($fr_stat == 1) {
    $FRc_InvoStatus_HTML = "<span class=''><b> ইনভয়েস স্ট্যাটাস: </b> নতুন </span>";
}
if ($fr_stat == 2) {
    $FRc_InvoStatus_HTML = "<span class=''><b> ইনভয়েস স্ট্যাটাস: </b> ডেলিভারি প্রক্রিয়া শুরু হয়েছে </span>";
}
if ($fr_stat == 3) {
    $FRc_InvoStatus_HTML = "<span class=''><b> ইনভয়েস স্ট্যাটাস: </b> প্যাকেজিং সম্পন্ন হয়েছে </span> ";
}
if ($fr_stat == 4) {
    $FRc_InvoStatus_HTML = "<span class=''><b> ইনভয়েস স্ট্যাটাস: </b> কুরিয়ারে আছে </span> ";
}
if ($fr_stat == 5) {
    $FRc_InvoStatus_HTML = "<span class=''><b> ইনভয়েস স্ট্যাটাস: </b> ডেলিভারি সম্পন্ন হয়েছে </span> ";
}
if ($fr_stat == 6) {
    $FRc_InvoStatus_HTML = "<span class=''><b> ইনভয়েস স্ট্যাটাস: </b> হোল্ডে আছে </span> ";
}
if ($fr_stat == 7) {
    $FRc_InvoStatus_HTML = "<span class=''><b> ইনভয়েস স্ট্যাটাস: </b> ডেলিভারি ব্যর্থ হয়েছে </span>";
}
if ($fr_stat == 8) {
    $FRc_InvoStatus_HTML = "<span class=''><b> ইনভয়েস স্ট্যাটাস: </b> অর্ডারটি বাতিল করা হয়েছে </span>";
}
if ($fr_stat == 9) {
    $FRc_InvoStatus_HTML = "<span class=''><b> ইনভয়েস স্ট্যাটাস: </b> প্রি অর্ডার</span>";
}
if ($fr_stat == 10) {
    $FRc_InvoStatus_HTML = "<span class=''><b> ইনভয়েস স্ট্যাটাস: </b> পেমেন্ট পেন্ডিং </span>";
}
//++
//++

//++
if ($fr_invo_due > 0) {
    $FRc_PaymentStatus_HTML = " <span class='label label-danger'> UNPAID </span>";
} elseif ($fr_invo_due == 0) {
    $FRc_PaymentStatus_HTML = " <span class='label label-success'> PAID </span>";
} elseif ($fr_invo_due < 0) {
    $FRc_PaymentStatus_HTML = " <span class='label label-danger pip_pip_1s'> Will Get </span>";
}
//++
//++
if ($fr_cust_id == 1) {
    $FRc_OrderType_HTML = " <span class='label label-success'> অথিতি অর্ডার </span><br>";
} else {
    $FRc_OrderType_HTML = "";
}
//++
//++
$fr_cust_o_note_HTML = "";
if ($fr_cust_o_note !== "") {
    $fr_cust_o_note_HTML = "নোট : $fr_cust_o_note";
}
//END>>





require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "Invoice #$FRc_Invoice_Id_x - $fr_cmetatitle";
$FRc_META_TAG_HTML = "
<meta property='og:title' content='$FRc_PAGE_TITEL'>
<meta property='og:description' content='$fr_cmetades'>
<meta property='og:image' content='$FRD_HURL/frd-data/img/brandlogu/$fr_clogo'>
<meta property='og:url' content='$FR_THISPAGE'>
<meta property='og:image:type' content='image/jpeg'/>
<meta property='og:image:width' content='1200'/>
<meta property='og:image:height' content='300'/>
";
require_once("frd-public/theme/frd-header.php");
?>

<style>
    div.frdiv_pay_method img {
        max-height: 30px;
    }
</style>


<!-- 1 scripts s-->
<section>
    <?php
    $FR_THIS_PAGE =  "$FRD_HURL/track/$FRc_Invoice_EncId_x";


    //---------------------------------------------------------
    //FRD PAYMENT GETWAY initialize :-
    //---------------------------------------------------------
    if (isset($_POST['f_PGW_Enc_Id'])) {
        //  PR($_POST);

        $FR_VC_PAY_AMOUNT_CNMTDA = "";

        if(isset($_POST['f_paymentamount'])){
            $FRc_PaymentAmount = $_POST['f_paymentamount'];
        }else{
            $f_pafrdhdjygf427bs27x = $_POST['f_pafrdhdjygf427bs27x']; //PAYMENT AMOUNT
            $FRc_PaymentAmount = base64_decode(base64_decode(base64_decode($f_pafrdhdjygf427bs27x)));
        }
        $f_PGW_Enc_Id = $_POST['f_PGW_Enc_Id']; //PAYMENT ENCCRIPT ID


        //FRD_VC______________________ PAYMENT AMOUNT CANT NOT MORE THAN DUE AMOUNT:-
        if($FRc_PaymentAmount <= $fr_invo_due){
          $FR_VC_PAY_AMOUNT_CNMTDA = 1;
        }else{
            FR_SWAL("পেমেন্ট অ্যামাউন্ট পরিশোধযোগ্য এমাউন্টের সমান বা কম হতে হবে!","","error");
        }


        if($FR_VC_PAY_AMOUNT_CNMTDA == 1){
            $FRQ = $FR_CONN->query("SELECT id AS FRthis_PgwId FROM frd_paygw_list WHERE fr_pgw_enc_id = '$f_PGW_Enc_Id'");
            extract($FRQ->fetch());
            $FRthis_PgwId;
    
            if ($FRthis_PgwId == 4) {
                create($FRc_Invoice_Id_x, $FRc_Invoice_EncId_x, $FRc_PaymentAmount);
            } elseif ($FRthis_PgwId == 5) {
                $FRc_SSLcom_InvoiceId = $FRc_Invoice_Id_x;
                $FRc_SSLcom_InvoiceEncId = $FRc_Invoice_EncId_x;
                $FRc_SSLcom_PayAmount = $FRc_PaymentAmount;
    
                $FRc_SSLcom_CB_CancelUrl = $FR_THIS_PAGE;
                $FRc_SSLcom_CB_FailedUrl = $FR_THIS_PAGE;
    
                $FRc_SSLcom_CustomerName = $fr_cust_name;
                $FRc_SSLcom_CustomerMobile = $fr_cust_mob1;
                require_once($FR_PATH_HD . "frd-public/theme/page/mng_pg/sslcom/frd-payment-ini.php");
            }
        }
    }
    //END>>



    //FRD AT LAST VIEW INVOICE ID KEEP SAVE IN COOKIES:-
    setcookie("FRcok_LastViesInvoeEncId", "$FRc_Invoice_EncId_x", time() + (86400 * 30), "/"); //Set Cooki

    ?>
</section>
<!-- 1 scripts e-->



<?php if ($FR_NOW_TIME < $fr_o_time + 120) {
    //THANK YOU MESSAGE TO CUSTOMER PAGE DATA READ:-
    $FRQ = $FR_CONN->query("SELECT page_body_en from frd_pages WHERE id = 21");
    $FRQ_SPD = $FRQ->fetch();
    $FRc_ThankYouMessageToCustomer = $FRQ_SPD['page_body_en'];
    $FRc_ThankYouMessageToCustomer = preg_replace("/#CUSTOMER_NAME#/", "$fr_cust_name", $FRc_ThankYouMessageToCustomer);
?>
    <section>
        <div class="container jumbotron">
            <div class="row">
                <div class="col-md-12">
                    <?php echo "$FRc_ThankYouMessageToCustomer"; ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>






<!-- INVOICE  -->
<section>
<style>
    /******************************************************************/
    /*frd-bulk-invoice-1*/
    /******************************************************************/
    .frd-invoice-1 .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        font-size: 16px;
        line-height: 24px;
        font-family: 'SolaimanLipi';
        color: #555;
    }

    .frd-invoice-1 .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .frd-invoice-1 .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }


    .frd-invoice-1 .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .frd-invoice-1 .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .frd-invoice-1 .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .frd-invoice-1 .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .frd-invoice-1 .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .frd-invoice-1 .invoice-box table tr.item td {
        border-bottom: 1px solid #eee;
    }

    .frd-invoice-1 .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .frd-invoice-1 .invoice-box table tr.total{
        border-top: 2px solid #eee;
        font-weight: bold;
        text-align: right;
    }

    @media only screen and (max-width: 600px) {
       
    }

    /** RTL **/
    .frd-invoice-1 .invoice-box.rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .frd-invoice-1 .invoice-box.rtl table {
        text-align: right;
    }


    /* INVOICE SUMMERY TABLE  */
    .frd-invoice-1 div#invoice_summary{
        overflow: hidden;
        display: block;
    }
    .frd-invoice-1 div#invoice_summary table{
        font-weight: 800;
        font-size: 12px;
        width: 300px;
        float: right;
        border-collapse: collapse;
    }
    .frd-invoice-1 div#invoice_summary table tr td{
        border: 1px solid #222 !important;
        padding: 2px;
        margin: 0px;
    }
    .frd-invoice-1 div#invoice_summary table tr td:nth-child(2){
    text-align: right;
    }


    /*FRD CUSTOM STYTLE s*/
    .frd-invoice-1 .CondiAmount{
        text-align: center;
        color: brown;
    }
    .frd-invoice-1 div.itemTitle{
        display: inline-block;
        overflow: hidden;
        margin-left: 5px;
    }

    .frd-invoice-1 div.PrintBtn{
        text-align: center;
    }
    .frd-invoice-1 div.PrintBtn button{
        background: none;
        border: none;
        position: absolute;
        cursor: pointer;
    }


    .frd-invoice-1 .TAR{
        text-align: right !important;
    }
    .frd-invoice-1 .TAL{
        text-align: left !important;
    }
    .frd-invoice-1 .boldd{
        font-weight: bold;
    }

    /*FRD PRINT TABLE CSS */
    .frd-invoice-1 table.t_print{
        width: 100%;
        border-collapse: collapse;
    }
    .frd-invoice-1 table.t_print tr td{
        border: 1px solid #222;
        padding: 2px;
    }


    /* TRANJECTION STATMENT TABLE*/
    .frd-invoice-1 .fr-line-del {
        text-decoration: line-through;
    }
    .frd-invoice-1 .font10px{
        font-size: 10px;
    }
</style>

<section class="frd-invoice-1">
        <div id="invoice_pdf">
            <div class='invoice-box'>
                <table cellpadding='0' cellspacing='0'>
                    <tr class='top'>
                        <td colspan='4'>
                            <table>
                                <tr>
                                    <td>
                                        <a href="<?php echo "$FRD_HURL";?>">
                                            <img src='<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_clogo";?>' style='width: 200px;'/>
                                        </a>
                                        <br>
                                        <b><small><?php echo  substr($FRD_HURL,8) ;?></small></b>
                                    </td>

                                    <td class="TAR">
                                        <?php
                                        $barcode_frd = "$FRc_Invoice_Id_x";
                                        require($FR_PATH_HD . "frd-src/inc/php/barcode_configar_frd.php");
                                        echo "$Barcode_FRD";
                                        ?>
                                        <br>
                                        ইনভয়েস আইডি: <?php echo "#$FRc_Invoice_Id_x";?><br />
                                        অর্ডার টাইমঃ: <?php echo date('Y-M-d', $fr_o_time);?> <br />
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr class='information'>
                        <td colspan='4'>
                            <table>
                                <tr>
                                    <td width="50%">
                                    <?php echo "
                                    <small><i>বিক্রেতা</i></small><br>
                                    $fr_cname <br>
                                    $fr_cmobile_1 <br>
                                    $fr_caddress_1
                                    ";?>
                                    </td>

                                    <td width="50%" class='TAR'>
                                    <?php echo "
                                    <small><i>পণ্য ডেলিভারি ঠিকানাঃ</i></small><br>
                                    $fr_cust_name <br>
                                    $fr_cust_mob1 $fr_cust_mob2<br>
                                    $fr_cust_addres <br>
                                    নোট: $fr_cust_o_note
                                    ";?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <?php if ($fr_invo_due > 0) { ?>
                    <tr>
                        <td colspan="4">
                                <h2 class='CondiAmount'> <b>কন্ডিশনঃ <?php echo number_format($fr_invo_due); ?> ৳</b> </h2>
                        </td>
                    </tr>
                    <?php } ?>

                    <tr class='heading'>
                        <td>ছবি</td>
                        <td>বিবরণ</td>
                        <td class="TAR">পরিমাণ</td>
                        <td class="TAR">মোট মূল্য</td>
                    </tr>

                    <?php
                        //FRD IVOICE ALL ITEM FETCH:-
                        $FRR = FR_QSEL("SELECT * FROM frd_order_items WHERE fr_invo_id = $FRc_Invoice_Id_x ", "ALL");
                        if ($FRR['FRA'] == 1) {
                            foreach ($FRR['FRD'] as $FR_ITEM) {
                                extract($FR_ITEM);

                                //FRD COLOE NAME FINDER:-
                                $FRQ = $FR_CONN->query("SELECT en_name FROM frd_colorr WHERE id='$r_color'");
                                $row_cnf_bx = $FRQ->fetch();
                                $FRsd_ProColorName = $row_cnf_bx['en_name'];
                                if ($FRsd_ProColorName == "N/A") {
                                    $FRsd_ProColorName_LM = "";
                                } else {
                                    $FRsd_ProColorName_LM = " | Color: $FRsd_ProColorName";
                                }

                                //PRODUCT SKU FINDER:-
                                $FRQ = $FR_CONN->query("SELECT skuu FROM frd_products WHERE id = $fr_pro_id");
                                $row_pskuf = $FRQ->fetch();
                                $frd_sv_pro_sku = $row_pskuf['skuu'];
                                if ($frd_sv_pro_sku == "") {
                                    $frd_sv_pro_sku_lmody = "";
                                } else {
                                    $frd_sv_pro_sku_lmody = "| <b> SKU: </b>$frd_sv_pro_sku";
                                }

                                //ORDER SIZE CUSTOMIZE:- 
                                if ($fr_size_name == "") {
                                    $fr_size_name_M = "";
                                } else {
                                    $fr_size_name_M = " | সাইজঃ $fr_size_name";
                                }





                                echo "
                                <tr class='item last'>
                                    <td width='5%'>
                                        <img src='$FRD_HURL/frd-data/img/product/$fr_pro_pic_1' style='width: 50px; height: 50px'/>
                                    </td>
                                    <td width='70%'> 
                                        <div class='itemTitle'> 
                                            <span> $fr_pro_title <small>[#$fr_pro_id]</small> </span><br>
                                            <small> $fr_size_name_M $FRsd_ProColorName_LM $frd_sv_pro_sku_lmody </small>
                                        </div>
                                    </td>
                                    <td width='15%' class='TAR'>$fr_qty x " . number_format($fr_price) ."৳</td>
                                    <td width='10%'class='TAR'>" . number_format($fr_t_price) . "৳</td>
                                </tr>
                                ";
                        }
                        } else {
                            PR($FRR);
                        }
                        //END>
                        ?>





                    <tr class='total'>
                        <td colspan="4"><?php echo "পণ্যের সর্বমোট মূল্য: " . number_format($fr_pro_total) . "৳";?></td>
                    </tr>
                </table>


                        <br>
                        <div id="invoice_summary">
                            <table role="button">
                                <tr>
                                    <td> পণ্যের মূল্য </td>
                                    <td class="text-right"><?php echo number_format($fr_pro_total, 2) . "৳"; ?></td>
                                </tr>
                                <tr>
                                    <td> ডেলিভারি চার্জ (+)</td>
                                    <td class="text-right"><?php echo number_format($fr_ship_cost, 2); ?> ৳</td>
                                </tr>
                                <tr>
                                    <td class="TAR">মোট = </td>
                                    <td class="text-right"><?php echo number_format($fr_sub_total, 2); ?> ৳</td>
                                </tr>
                                <?php if($fr_cupo_discount > 0){ ?>
                                <tr>
                                    <td> কুপন ছাড় (-)</td>
                                    <td class="text-right"><?php echo number_format($fr_cupo_discount, 2) . " ৳"; ?></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td class="TAR"> পরিশোধযোগ্য = </td>
                                    <td class="text-right"><?php echo number_format($fr_payable, 2); ?> ৳</td>
                                </tr>
                                <tr>
                                    <td>পরিশোধ (-) </td>
                                    <td class="text-right"><?php echo number_format($fr_payment, 2); ?> ৳</td>
                                </tr>
                                <?php if ($fr_pay_discount > 0) { ?>
                                    <tr>
                                        <td> পেমেন্ট ছাড় (-)</td>
                                        <td class="TAR"><?php echo number_format($fr_pay_discount, 2); ?> ৳</td>
                                    </tr>
                                <?php } ?>
                                <?php if ($fr_ppro_return > 0) { ?>
                                    <tr>
                                        <td> আংশিক পণ্য ফেরত (-)</td>
                                        <td class="TAR"><?php echo number_format($fr_ppro_return, 2); ?> ৳</td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td class="TAR"> বাকি / কন্ডিশন =</td>
                                    <td class="text-right"><?php echo number_format($fr_invo_due, 2); ?> ৳</td>
                                </tr>
                            </table>
                        </div>

    
                

                        <br>
                <div class="row mt-5">
                        <div class="col-md-12">
                            <?php 
                                $FRR = FR_QSEL("SELECT * FROM frd_mtl WHERE fr_invo_id = $FRc_Invoice_Id_x ORDER BY id ASC","ALL");
                                if($FRR['FRA']==1){ 
                                    echo "<div class='table-responsive'>";
                                    echo "<table class='t_print'>";
                                    echo "
                                        <tr class='alert alert-info boldd'>
                                            <td>SL</td>
                                            <td>TTID</td>
                                            <td>Transaction Date</td>
                                            <td>Transaction Type</td>
                                            <td>Note</td>
                                            <td>Payment Gateway</td>
                                            <td>Tran ID</td>
                                            <td>Bank Account</td>
                                            <td class='text-right'> Amount</td>
                                        </tr>
                                    ";
                                
                                            $FRc_SL = 1;
                                            $FRc_FT_Payment = 0;
                                            foreach($FRR['FRD'] as $FR_ITEM){
                                                extract($FR_ITEM);
                                                extract(FRF_MTL_TRANS_TYP($fr_trn_typ));

                                                if($fr_rvs_stat == 1){
                                                    $FRc_FT_Payment = ($FRc_FT_Payment + $fr_trn_amount);
                                                    $FRc_c1 = "alert alert-success";
                                                }else{
                                                    $FRc_c1 = "fr-line-del font10px"; 
                                                }

                                                    echo "
                                                        <tr class='$FRc_c1'>
                                                            <td>$FRc_SL</td>
                                                            <td>$id</td>
                                                            <td>".date('D, d-M-Y h:i A',$fr_time)."</td>
                                                            <td>$FRc_MTL_TRANS_TYP</td>
                                                            <td>$fr_note</td>
                                                            <td>$fr_pay_gtw_name</td>
                                                            <td>$fr_trn_id</td>
                                                            <td>$fr_b_name($fr_b_ac_number)</td>
                                                            <td class='text-right'> $fr_trn_amount"."৳</td>
                                                        </tr> 
                                                    ";
                                                $FRc_SL = ($FRc_SL + 1);
                                                
                                            }

                                            echo "
                                            <tr class='alert alert-info boldd'>
                                                <td colspan='8'>Total Received:</td>
                                                <td class='text-right'> ".number_format($FRc_FT_Payment,2)."৳</td>
                                            </tr> 
                                            ";
                                    
                                    echo "</table>";
                                    echo "</div>";
                                } else{ 
                            //    echo "<div class='text-center alert alert-danger'>No Transaction Found</div>";
                                }
                            ?>
                        </div>
                    </div>
                

                
            </div>
        </div>
        <p style="page-break-after: always;"></p>
    </section>
</section>










<?php
//FRD PARCIAL PAYMENT ALERT MESSAGE START:-
if ($frtc_parti_pay == 1) {
    if ($fr_stat == 1 or $fr_stat == 6 or $fr_stat == 10) {
        if ($fr_payment == 0) {

            //MAUAL PAYMENT ACCOUNT INFO PAGE DATA READ:-
            $FRQ = $FR_CONN->query("SELECT page_body_en from frd_pages WHERE id = 19");
            $FRQ_SPD_MamualPayInfo = $FRQ->fetch();
            $FRc_ManualPaymentInfo = $FRQ_SPD_MamualPayInfo['page_body_en'];
            $FRc_ManualPaymentInfo = preg_replace("/#CUSTOMER_NAME#/", "$fr_cust_name", $FRc_ManualPaymentInfo);
            $FRc_ManualPaymentInfo = preg_replace("/#PARTIAL_PAYMENT_AMOUNT#/", number_format($frtc_parti_pay_tk), $FRc_ManualPaymentInfo);
            $FRc_ManualPaymentInfo = preg_replace("/#ORDER_NUMBER#/", number_format($FRc_Invoice_Id_x), $FRc_ManualPaymentInfo);

?>
            <br>
            <section>
                <section class="container">
                    <div class="row">

                        <div class="col-md-12">
                            <div class="jumbotron frd_div_ani_1 parcialpainfodiv">

                                <span class="d_b_1"></span>
                                <span class="d_b_2"></span>
                                <span class="d_b_3"></span>
                                <span class="d_b_4"></span>

                                <div class=''>
                                    <?php echo "$FRc_ManualPaymentInfo"; ?>
                                    <?php
                                    //FRD PAYMENT GETWAY LIST T DATA:-
                                    $FRR = FR_QSEL("SELECT * FROM frd_paygw_list WHERE fr_pgw_stat = 1 ORDER BY fr_pgw_dp ASC", "ALL");
                                    if ($FRR['FRA'] == 1) {
                                        $FRc_frtc_parti_pay_tk  = base64_encode(base64_encode(base64_encode($frtc_parti_pay_tk)));
                                        echo "<div class='text-center'>";
                                        foreach ($FRR['FRD'] as $FR_ITEM) {
                                            extract($FR_ITEM);
                                            echo "
                                            <form title='Click To Pay' action='' method='POST'>
                                                <input type='hidden' name='f_pafrdhdjygf427bs27x' value='$FRc_frtc_parti_pay_tk'>
                                                <input type='hidden' name='f_PGW_Enc_Id' value='$fr_pgw_enc_id'>
                                                    <button type='submit'>
                                                        Click To Pay $frtc_parti_pay_tk /- With <br>
                                                        <img src='$FRD_HURL/frd-public/theme/asset/img/$fr_pgw_pic' alt='#'>
                                                    </button>
                                                </form>
                                                <br>
                                            ";
                                        }
                                        echo "</div>";
                                    } else {
                                        // PR($FRR);
                                    }
                                    //END>>
                                    ?>


                                </div>
                            </div>



                        </div>
                    </div>
            </section>
<?php
        }
    }
}
//END>>
?>








<?php
if ($frtc_full_pay == 1) {
    if ($fr_stat == 1 or $fr_stat == 6){
    if ($fr_invo_due > 0){
 ?>
        <!-- FRD PAYMENT METHOD -->
        <section id="frsec_PayMetSelect">
            <div class="container">
                <br>
                <div class="row frdiv_pay_method">

                    <div class="col-md-12">
                        <div class="jumbotron">
                            <div class="text-center">
                                <span class="label label-success">সম্পূর্ণ মূল্য পরিশোধ</span>
                            </div>

                            <h3 class="text-center g"><?php echo "$fr_cust_name"; ?> আপনার পছন্দমত পেমেন্ট পদ্ধতির নির্বাচন করে পেমেন্ট করুন</h3>
                            <h2 class="text-center boldd">পরিশোধযোগ্য <?php echo number_format($fr_invo_due); ?> ৳</h2>
                            <form action="" method="POST">
                                <table class="table table-bordered table-hover" role="button">

                                    <?php
                                    //FRD PAYMENT GETWAY LIST T DATA:-
                                    $FRR = FR_QSEL("SELECT * FROM frd_paygw_list WHERE fr_pgw_stat = 1 ORDER BY fr_pgw_dp ASC", "ALL");
                                    if ($FRR['FRA'] == 1) {

                                        $FRc_fr_invo_due  = base64_encode(base64_encode(base64_encode($fr_invo_due)));

                                        foreach ($FRR['FRD'] as $FR_ITEM) {
                                            extract($FR_ITEM);
                                            echo "
                                            <tr>
                                                <td>
                                                    <input type='hidden' name='f_pafrdhdjygf427bs27x' value='$FRc_fr_invo_due'>
                                                    <input type='radio' name='f_PG' id='' value='$id' required> $fr_pgw_name

                                                    <input type='hidden' name='f_PGW_Enc_Id' value='$fr_pgw_enc_id'>
                                                </td>
                                                <td class='text-right'>
                                                    <img src='$FRD_HURL/frd-public/theme/asset/img/$fr_pgw_pic' alt='#'>
                                                </td>
                                            </tr>
                                        ";
                                        }
                                    } else {
                                        // PR($FRR);
                                        ECHO_4("You Have No Online Payment Method","text-center alert alert-danger");
                                    }
                                    //END>>
                                    ?>
                                </table>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-block"> পেমেন্ট </button>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </section>

<?php }} } ?>















<?php
if ($frtc_any_pay == 1) {
    if ($fr_invo_due > 0){
 ?>
        <!-- FRD ANY AMOUNT PAYMENT -->
        <section id="frsec_PayMetSelect">
            <div class="container">
                <br>
                <div class="row frdiv_pay_method">

                    <div class="col-md-12">
                        <div class="jumbotron">
                            <div class="text-center">
                                <span class="label label-success">আপনার ইচ্ছামত মূল্য পরিশোধ</span>
                            </div>

                            <h3 class="text-center g"><?php echo "$fr_cust_name"; ?> আপনার ইচ্ছামত এমাউন্ট পেমেন্ট করুন!</h3>
                            <h2 class="text-center boldd">বাকি আছে <?php echo number_format($fr_invo_due); ?> ৳</h2>
                            <form action="" method="POST">
                                <table class="table table-bordered table-hover" role="button">
                                    <?php
                                    //FRD PAYMENT GETWAY LIST T DATA:-
                                    $FRR = FR_QSEL("SELECT * FROM frd_paygw_list WHERE fr_pgw_stat = 1 ORDER BY fr_pgw_dp ASC", "ALL");
                                    if ($FRR['FRA'] == 1) {

 
                                        echo " <input class='form-control' type='number' name='f_paymentamount' value='$FRc_fr_invo_due' placeholder='ইচ্ছামতো এমাউন্ট লিখুন'> <br>";

                                        foreach ($FRR['FRD'] as $FR_ITEM) {
                                            extract($FR_ITEM);
                                            echo "
                                            <tr>
                                                <td>
                                                    <input type='radio' name='f_PG' id='' value='$id' required> $fr_pgw_name
                                                    <input type='hidden' name='f_PGW_Enc_Id' value='$fr_pgw_enc_id'>
                                                </td>
                                                <td class='text-right'>
                                                    <img src='$FRD_HURL/frd-public/theme/asset/img/$fr_pgw_pic' alt='#'>
                                                </td>
                                            </tr>
                                        ";
                                        }
                                    } else {
                                        // PR($FRR);
                                        ECHO_4("You Have No Online Payment Method","text-center alert alert-danger");
                                    }
                                    //END>>
                                    ?>
                                </table>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-block"> পেমেন্ট </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php }} ?>





<!--  ORDER PROSESS HISTORY -->
<section>
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <!-- ORDER-TRACKING-TIMELINE  -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title boldd"> অর্ডার ট্রাকিং </h4>
                        <div id="content">
                            <ul class="timeline">
                                <?php
                                $FRc_fr_o_pros_history_ARR = explode(",", $fr_o_pros_history);
                                $FRc_fr_o_pros_history_ARR_REV = array_reverse($FRc_fr_o_pros_history_ARR);

                                $FRc_Class = "active_event";
                                foreach ($FRc_fr_o_pros_history_ARR_REV as $FR_ITEM) {

                                    if ($FR_ITEM != "") {
                                        $FR_ITEM_ARR = explode("*", $FR_ITEM);
                                        echo "
                                    <li class='event $FRc_Class' data-date='$FR_ITEM_ARR[1]'>
                                        <h1>$FR_ITEM_ARR[0]</h1>
                                        <p></p>
                                    </li>
                                    ";
                                    }

                                    $FRc_Class = "";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>




<?php
//FRD ORDER TRACKING PAGE CUSTOM MESSAGE:-
if ($frtc_track_pg_ctom_mess == 1) {
    $FRQ = $FR_CONN->query("SELECT page_body_en from frd_pages WHERE id = 20");
    $FRQ_SPD = $FRQ->fetch();
    $FRc_TrackPageCustomMessage = $FRQ_SPD['page_body_en'];
?>
    <br>
    <section>
        <div class="container fr-mt-10">
            <div class="row">
                <div class="col-md-12 jumbotron trackp_notediv">
                    <?php echo "$FRc_TrackPageCustomMessage"; ?>
                </div>
            </div>
        </div>
    </section>
<?php
}
//END>>
?>





<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
    var DownlodeInvoiceName = '<?php echo "Invoice-#$FRc_Invoice_Id_x-$fr_cust_name"; ?>';


    $(document).ready(function() {

        $(".Frtrig_GoHP").unbind().click(function() {
            window.location.replace(FRD_HURLL);
        });


        // $(".FrTrigDownlodeInvo").unbind().click(function() {
        //     var frInvoicelink = $(this).attr("frInvoicelink");


        //     $.ajax({
        //         url: frInvoicelink,
        //         method: "POST",
        //         data: {
        //             PRINT_NO: 'NO'
        //         },
        //         success: function(data) {

        //             var element = data;
        //             var opt = {
        //                 margin: 1,
        //                 filename: DownlodeInvoiceName + '.pdf',
        //                 image: {
        //                     type: 'jpeg',
        //                     quality: 0.98
        //                 },
        //                 html2canvas: {
        //                     scale: 2
        //                 },
        //                 jsPDF: {
        //                     unit: 'mm',
        //                     format: 'a4'
        //                 }
        //             };
        //             html2pdf(element, opt);
        //         }
        //     });

        // });

        $(".FrTrigDownlodeInvo").unbind().click(function() {
            swal("Comming..", "", "warning");
        });


    });
</script>


<?php require_once("frd-public/theme/frd-footer.php");
ob_end_flush(); ?>