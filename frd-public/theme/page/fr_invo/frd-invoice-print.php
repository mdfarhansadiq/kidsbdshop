<?php
//FRD COMPANY DATA:-
$FRR = FR_QSEL("SELECT * FROM frd_cprofile WHERE id = 1", "");
if ($FRR['FRA'] == 1) {
    extract($FRR['FRD']);
} else {
    ECHO_4($FRR['FRM']);
}
//END>>

$FRc_Invoice_EncId_x = $url[1];


//FRD ORDER INVOICE T DATA READ Stext-rightT:-
$FRR = FR_QSEL("SELECT * FROM frd_order_invo WHERE fr_enc_id = '$FRc_Invoice_EncId_x' AND fr_stat != 0", "");
if ($FRR['FRA'] == 1) {
    extract($FRR['FRD']);
    $FRc_Invoice_Id_x = $id;
    $FRc_Invo_Stat_x = $fr_stat;
    $FRc_Invo_Cust_Id = $fr_cust_id;

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
    //++
    //++


    //++
    //++
    if ($fr_invo_due > 0) {
        $FRc_PaymentStatus_HTML = " <span class='label label-danger'> UNPAID </span><br>";
    } elseif ($fr_invo_due == 0) {
        $FRc_PaymentStatus_HTML = " <span class='label label-success'> PAID </span><br>";
    } elseif ($fr_invo_due < 0) {
        $FRc_PaymentStatus_HTML = " <span class='label label-danger pip_pip_1s'> Will Get </span><br>";
    }
    //++
    //++
    if ($fr_cust_id == 1) {
        $FRc_OrderType_HTML = " <span class='label label-danger'> অথিতি অর্ডার </span><br>";
    } else {
        $FRc_OrderType_HTML = "";
    }
    //++
    //++
    if ($fr_cust_o_note == "") {
        $fr_cust_o_note = "N/A";
    }


        $fr_ship_track_code_HTML = "";
        if($fr_ship_track_code != "" AND $fr_ship_track_code != "NA"){
            $fr_ship_track_code_HTML = "ট্র্যাকিং কোড: $fr_ship_track_code";
        }
        $fr_ship_consignment_id_HTML = "";
        if($fr_ship_consignment_id != ""){
            $fr_ship_consignment_id_HTML = "কনসাইনমেন্ট আইডি: $fr_ship_consignment_id";
        }

} else {
    ECHO_4($FRR['FRM']);
    exit;
}
//END>>
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8' />
    <title><?php echo "Invoice#$FRc_Invoice_Id_x - $fr_cust_name - $fr_cust_mob1 | $fr_cname  "; ?></title>
    <link href="<?php echo "$FRD_HURL/frd-public/theme/asset/fonts/SolaimanLipiNormal/styles.css" ?>" rel="stylesheet">
</head>

<body>


<section>
        <style>
            .comp-tagline{
                margin-top: -8px;
            }
            img.barcode {
                height: 60px;
            }
            .invoice-box {
                max-width: 800px;
                margin: auto;
                padding: 30px;
                border: 1px solid #eee;
                font-size: 16px;
                line-height: 24px;
                font-family: 'SolaimanLipi';
                color: #555;
            }

            .invoice-box table {
                width: 100%;
                line-height: inherit;
                text-align: left;
                margin: 0px !important;
            }

            .invoice-box table td {
                vertical-align: top;
                margin: 0px !important;
            }


            .invoice-box table tr td:nth-child(2) {
                text-align: right;
                margin: 0px !important;
            }

            .invoice-box table tr.top table td {
                padding-bottom: 0px;
                margin: 0px !important;
            }


            tr.condition_row h2 {
                padding: 0px;
                margin-top: 0px !important;
                margin-bottom: 10px;
            }

            .invoice-box table tr.heading td {
                background: #eee;
                border-bottom: 1px solid #ddd;
                font-weight: bold;
            }

            .invoice-box table tr.details td {
                padding-bottom: 0px;
            }

            .invoice-box table tr.item td {
                border-bottom: 1px solid #eee;
            }

            .invoice-box table tr.item.last td {
                border-bottom: none;
            }

            .invoice-box table tr.total td:nth-child(2) {
                border-top: 2px solid #eee;
                font-weight: bold;
            }

            @media only screen and (max-width: 600px) {
                .invoice-box table tr.top table td {
                    width: 100%;
                    display: block;
                    text-align: center;
                }

                .invoice-box table tr.information table td {
                    width: 100%;
                    display: block;
                    text-align: center;
                }
            }

            /** RTL **/
            .invoice-box.rtl {
                direction: rtl;
                font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            }

            .invoice-box.rtl table {
                text-align: right;
            }

            .invoice-box.rtl table tr td:nth-child(2) {
                text-align: left;
            }


            /* INVOICE SUMMERY TABLE  */
            div#invoice_summary {
                overflow: hidden;
                display: block;
            }

            div#invoice_summary table {
                font-weight: 800;
                font-size: 12px;
                width: 300px;
                float: right;
                border-collapse: collapse;
            }

            div#invoice_summary table tr td {
                border: 1px #222 solid;
                padding-left: 5px;
                padding-right: 5px;
            }


            /*FRD CUSTOM STYTLE s*/
            .CondiAmount {
                text-align: center;
                color: brown;
            }

            div.itemTitle {
                display: inline-block;
                position: absolute;
                overflow: hidden;
                margin-left: 5px;
            }

            div.PrintBtn {
                text-align: center;
            }

            div.PrintBtn button {
                background: none;
                border: none;
                position: absolute;
                cursor: pointer;
            }

            .TAR {
                text-align: right !important;
            }

            .TAL {
                text-align: left !important;
            }

            .boldd {
                font-weight: bold;
            }


            /*******************************************************************/
            /*FRD PRINT TABLE CSS */
            /*******************************************************************/
            table.t_print {
                width: 100%;
                border-collapse: collapse;
            }

            table.t_print tr td {
                border: 1px solid #222;
                padding: 2px;
            }


            /* TRANJECTION STATMENT TABLE*/
            .fr-line-del {
                text-decoration: line-through;
            }

            .font10px {
                font-size: 10px;
            }
        </style>

        <div id="invoice_pdf">
            <div class='invoice-box'>
                <table cellpadding='0' cellspacing='0'>
                    <tr class='top'>
                        <td colspan='2'>
                            <table>
                                <tr>
                                    <td>
                                        <a href="<?php echo "$FRD_HURL"; ?>">
                                            <img src='<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_clogo"; ?>' style='width: 100px; height: auto' />
                                        </a>
                                        <h6 class="comp-tagline">"<?php echo "$fr_ctagline";?>"</h6>
                                    </td>
                                    <td>
                                        <?php
                                        $barcode_frd = $FRc_Invoice_Id_x;
                                        require_once($FR_PATH_HD . "frd-src/inc/php/barcode_configar_frd.php");
                                        echo "$Barcode_FRD";
                                        ?>
                                        <br>
                                        <small>
                                            অর্ডার টাইমঃ: <?php echo date('Y-M-d', $fr_o_time); ?> 
                                        </small>
                                        <br/>
                                        <small><?php echo "$fr_ship_consignment_id_HTML";?></small><br>
                                        <small><?php echo "$fr_ship_track_code_HTML";?></small>

                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr class='information'>
                        <td colspan='2'>
                            <table>
                                <tr>
                                    <td>
                                        <?php echo "
                                            <small><i>বিক্রেতা</i></small><br>
                                            $fr_cname <br>
                                            $fr_cmobile_1 <br>
                                            $fr_caddress_1
                                            "; ?>
                                    </td>

                                    <td>
                                        <?php echo "
                                            <small><i>পণ্য ডেলিভারি ঠিকানাঃ</i></small><br>
                                            $fr_cust_name <br>
                                            $fr_cust_mob1 $fr_cust_mob2<br>
                                            $fr_cust_addres <br>
                                            নোট: $fr_cust_o_note
                                            "; ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <?php if ($fr_invo_due > 0) { ?>
                        <tr class="condition_row">
                            <td colspan="2">
                                <h2 class='CondiAmount'> <b>কন্ডিশনঃ <?php echo number_format($fr_invo_due); ?> ৳</b> </h2>
                            </td>
                        </tr>
                    <?php } ?>

                    <tr class='heading'>
                        <td>বিবরণ</td>
                        <td>মূল্য</td>
                    </tr>

                    <?php
                    $FRR = FR_QSEL("SELECT * FROM frd_order_items WHERE fr_invo_id = $FRc_Invoice_Id_x ", "ALL");
                    if ($FRR['FRA'] == 1) {
                        foreach ($FRR['FRD'] as $FR_ITEM) {
                            extract($FR_ITEM);
                            extract(FRF_COLOR_NAME($r_color));
                            if ($FRc_COLOR_NAME == "N/A") {
                                $FRc_COLOR_NAME_LM = "";
                            } else {
                                $FRc_COLOR_NAME_LM = " | Color: $FRc_COLOR_NAME";
                            }

                            //ORDER SIZE CUSTOMIZE:- 
                            if ($fr_size_name == "") {
                                $fr_size_name_M = "";
                            } else {
                                $fr_size_name_M = " | সাইজঃ $fr_size_name";
                            }

                            //PRODUCT SKU FINDER:-
                            $FRQ = $FR_CONN->query("SELECT skuu FROM frd_products WHERE id = $fr_pro_id");
                            $row_pskuf = $FRQ->fetch();
                            $frd_sv_pro_sku = $row_pskuf['skuu'];
                            if ($frd_sv_pro_sku == "") {
                                $frd_sv_pro_sku_lmody = "";
                            } else {
                                $frd_sv_pro_sku_lmody = "| <b> SKU: </b>$frd_sv_pro_sku |";
                            }


                            echo "
                                        <tr class='item last'>
                                            <td> 
                                                <img src='$FRD_HURL/frd-data/img/product/$fr_pro_pic_1' style='width: 50px; height: 50px' />
                                                <div class='itemTitle'> 
                                                    <span> $fr_pro_title <small>[#$fr_pro_id]</small> </span><br>
                                                    <small> $fr_size_name_M $FRc_COLOR_NAME_LM $frd_sv_pro_sku_lmody  $fr_qty x " . number_format($fr_price) . " ৳ </small>
                                                </div>
                                            </td>
                                            <td>" . number_format($fr_t_price) . " ৳</td>
                                        </tr>
                                        ";
                        }
                    } else {
                        PR($FRR);
                    }
                    //END>
                    ?>
                </table>


                <div id="invoice_summary">
                    <table id="invoice_summary_1" role="button">
                        <tr>
                            <td> পণ্যের মূল্য </td>
                            <td class="text-right"><?php echo number_format($fr_pro_total, 2) . " ৳"; ?></td>
                        </tr>
                        <tr>
                            <td> ডেলিভারি চার্জ (+)</td>
                            <td class="text-right FR_MODEL_UpDeliveryCharge"><?php echo number_format($fr_ship_cost, 2); ?> ৳</td>
                        </tr>
                        <tr>
                            <td class="TAR">মোট = </td>
                            <td class="text-right"><?php echo number_format($fr_sub_total, 2); ?> ৳</td>
                        </tr>

                        <?php if ($fr_cupo_discount > 0) { ?>
                            <tr>
                                <td> কুপন ছাড় (-)</td>
                                <td class="text-right FR_MODEL_UpCouponDiscount"><?php echo number_format($fr_cupo_discount, 2) . " ৳"; ?></td>
                            </tr>
                        <?php } ?>

                        <tr>
                            <td class="TAR"> পরিশোধযোগ্য = </td>
                            <td class="text-right"><?php echo number_format($fr_payable, 2); ?> ৳</td>
                        </tr>

                        <tr>
                            <td> পরিশোধ (-) </td>
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
                        $FRR = FR_QSEL("SELECT * FROM frd_mtl WHERE fr_invo_id = $FRc_Invoice_Id_x ORDER BY id ASC", "ALL");
                        if ($FRR['FRA'] == 1) {
                            echo "<div class='table-responsive'>";
                            echo "<table class='t_print'>";
                            echo "
                                                <tr class='alert alert-info boldd'>
                                                    <td>SL</td>
                                                    <td class='TAL'>TTID</td>
                                                    <td>Payment Date</td>
                                                    <td>Payment Gateway</td>
                                                    <td>Transaction ID</td>
                                                    <td class='text-right TAR'>Payment Amount</td>
                                                </tr>
                                            ";

                            $FRc_SL = 1;
                            $FRc_FT_Payment = 0;
                            foreach ($FRR['FRD'] as $FR_ITEM) {
                                extract($FR_ITEM);

                                if ($fr_rvs_stat == 1) {
                                    $FRc_FT_Payment = ($FRc_FT_Payment + $fr_trn_amount);
                                    $FRc_c1 = "alert alert-success";
                                } else {
                                    $FRc_c1 = "fr-line-del font10px";
                                }

                                echo "
                                                                <tr class='$FRc_c1'>
                                                                    <td>$FRc_SL</td>
                                                                    <td class='TAL'>$id</td>
                                                                    <td>" . date('D, d-M-Y h:i A', $fr_time) . "</td>
                                                                    <td>$fr_pay_gtw_name</td>
                                                                    <td>$fr_trn_id</td>
                                                                    <td class='text-right TAR'> $fr_trn_amount" . "৳</td>
                                                                </tr> 
                                                            ";
                                $FRc_SL = ($FRc_SL + 1);
                            }

                            echo "
                                                    <tr class='alert alert-info boldd'>
                                                        <td colspan='5'>Total Payment:</td>
                                                        <td class='text-right'> " . number_format($FRc_FT_Payment, 2) . "৳</td>
                                                    </tr> 
                                                    ";

                            echo "</table>";
                            echo "</div>";
                        } else {
                            echo "<div class='text-center alert alert-danger'>No Transaction Found</div>";
                        }
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </section>





    <?php if (!isset($_POST['PRINT_NO'])) { ?>
        <script>
            window.print();
        </script>
    <?php } ?>

</body>

</html>