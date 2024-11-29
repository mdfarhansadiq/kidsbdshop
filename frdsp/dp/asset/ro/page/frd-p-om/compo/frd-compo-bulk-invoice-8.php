<style>
/******************************************************************/
/*frd-bulk-invoice-8*/
/******************************************************************/
body{
    margin: 0;
    padding: 0;
}
.frd-bulk-invoice-8 .box {
    width: 288px;
    height: auto;
    display: inline-block;
    border: 1px #111111 solid;
    margin: 1px;
    padding: 5px;
    overflow: hidden;
    float: left;
    font-family: 'SolaimanLipi';
}
.frd-bulk-invoice-8 .box img.logo{
    width:100px;height:50px;margin:auto;display:block;
}

.frd-bulk-invoice-8 .box .barcode{
    text-align: center;
}

.frd-bulk-invoice-8 .text-center{
   text-align: center;
}
.frd-bulk-invoice-8 .FR{
        float: right;
}
.frd-bulk-invoice-8 .box table.items{
   border: 1px solid green;
   margin-top: 5px;
}

.frd-bulk-invoice-8 .box table.summery{
    border-collapse: collapse;
    width: 100%;
}
.frd-bulk-invoice-8 .box table.summery tr td{
    border: 1px solid #222222;
    padding-left: 2px;
    padding-right: 2px;
}


.frd-bulk-invoice-8 .box .TAR{
    text-align: right;
}
.frd-bulk-invoice-8 .box .TAC{
    text-align: center;
}
.frd-bulk-invoice-8 .box .bold{
    font-weight: bold;
}

</style>

<div class="frd-bulk-invoice-8">
    <div class="box">

        <div>
            <img class="logo" src="<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_clogo"; ?>" alt="#">
            <div class="text-center"><b><small><?php echo "8-$fr_cmobile_1";?></small></b></div>
            <div class="text-center"><b><small><?php echo  substr($FRD_HURL,8) ;?></small></b></div>
            <hr>
            <div class="barcode">
                <?php
                    $barcode_frd = $FRc_Invoice_Id_x;
                    require($FR_PATH_HD . "frd-src/inc/php/barcode_configar_frd.php");
                    echo "$Barcode_FRD";
                ?>
            </div>
        </div>

        <table class="">
            <tr>
                <td>
                    <?php
                    echo "
                        <small>ডেলিভারি ঠিকানাঃ-</small> <br>
                        নামঃ <b>$fr_cust_name </b><br>
                        মোবাইল নাম্বারঃ <b>$fr_cust_mob1 $fr_cust_mob2</b> <br>
                        ঠিকানাঃ <b>$fr_cust_addres</b> <br>
                        নোটঃ $fr_cust_o_note <br>
                        <hr>
                    ";

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
                                    
                                    ";

                                echo "
                                    <table class='items'>
                                        <tr>
                                            <td width='10%'>
                                            <img src='$FRD_HURL/frd-data/img/product/$fr_pro_pic_1' style='width: 30px; height: 30px'/>
                                            </td>
                                            <td width='90%'>
                                            <small>$fr_pro_title [#$fr_pro_id] $fr_size_name_M $FRsd_ProColorName_LM $frd_sv_pro_sku_lmody $fr_qty x " . number_format($fr_price) . " ৳ </small>
                                            </td>
                                        </tr>
                                    </table>
                                    ";
                            }
                        } else {
                            PR($FRR);
                        }
                    //END>
                    ?>



                        <br>
                        <table class="summery">
                                <tr>
                                    <td> মোট পণ্য </td>
                                    <td class="TAR"><?php echo "$FRc_ItemsTotalC";?> টি</td>
                                </tr>
                                <tr>
                                    <td> মোট পরিমাণ </td>
                                    <td class="TAR"><?php echo "$FRc_ItemsTotalQtyC";?> টি</td>
                                </tr>
                                <tr>
                                    <td> পণ্যের মোট মূল্য </td>
                                    <td class="TAR"><?php echo number_format($fr_pro_total, 2) . " ৳"; ?></td>
                                </tr>
                                <tr>
                                    <td> ডেলিভারি চার্জ (+)</td>
                                    <td class="TAR"><?php echo number_format($fr_ship_cost, 2); ?> ৳</td>
                                </tr>
                                <tr>
                                    <td class="TAR">মোট = </td>
                                    <td class="TAR"><?php echo number_format($fr_sub_total, 2); ?> ৳</td>
                                </tr>
                                <?php if($fr_cupo_discount > 0){ ?>
                                <tr>
                                    <td> কুপন ছাড় (-)</td>
                                    <td class="TAR"><?php echo number_format($fr_cupo_discount, 2) . " ৳"; ?></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td class="TAR"> পরিশোধযোগ্য = </td>
                                    <td class="TAR"><?php echo number_format($fr_payable, 2); ?> ৳</td>
                                </tr>
                                <tr>
                                    <td>পরিশোধ (-) </td>
                                    <td class="TAR"><?php echo number_format($fr_payment, 2); ?> ৳</td>
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
                                    <td class="TAR"><?php echo number_format($fr_invo_due, 2); ?> ৳</td>
                                </tr>
                        </table>

                    
                </td>
            </tr>
        </table>


    </div>
</div>