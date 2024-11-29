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
                                    <td width="50%" class="TAL">
                                        <a href="<?php echo "$FRD_HURL";?>">
                                            <img src='<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_clogo";?>' style='width: 200px;'/>
                                        </a>
                                    </td>

                                    <td width="40%" class="TAR">
                                        <?php
                                        $barcode_frd = "$FRc_Invoice_Id_x";
                                        require($FR_PATH_HD . "frd-src/inc/php/barcode_configar_frd.php");
                                        echo "$Barcode_FRD";
                                        ?>
                                        <br>
                                        ইনভয়েস আইডি: <?php echo "#$FRc_Invoice_Id_x";?><br />
                                        অর্ডার টাইমঃ: <?php echo date('Y-M-d', $fr_o_time);?> <br />
                                        <small><?php echo "$FRc_SteadfastClientID_HTML";?></small><br>
                                        <small><?php echo "$fr_ship_consignment_id_HTML";?></small><br>
                                        <small><?php echo "$fr_ship_track_code_HTML";?></small>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr class='information'>
                        <td colspan='4'>
                            <table>
                                <tr>
                                    <td width="50%" class="TAL">
                                    <?php echo "
                                    <small><i>বিক্রেতা</i></small><br>
                                    $fr_cname <br>
                                    $fr_cmobile_1 <br>
                                    $fr_caddress_1
                                    ";?>
                                    <br>
                                    <small>www.<?php echo  substr($FRD_HURL,8) ;?></small>
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
                                    <td> পণ্যের মোট মূল্য </td>
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