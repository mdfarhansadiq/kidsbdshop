<div class="frd-bulk-invoice-6">
    <div class="box">
        <div>
            <img class="logo" src="<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_clogo"; ?>" alt="#">
            <div class="text-center"><b><small><?php echo  "$fr_cmobile_1";; ?></small></b></div>
            <div class="text-center"><b><small><?php echo  "www." . substr($FRD_HURL, 8); ?></small></b></div>
            <hr>
        </div>
        <table width="100%">
            <tr>
                <td class="TAL">
                    <div class="">
                        <small><?php echo "অর্ডার টাইম: " . date('Y-M-d h:i A', $fr_o_time) . ""; ?></small>
                    </div>
                </td>
                <td class="TAL">
                    <div class="">
                        <small><?php echo "$FRc_SteadfastClientID_HTML";?></small>
                    </div>
                </td>
                <td class="TAL">
                    <div class="">
                        <small><?php echo "$fr_ship_track_code_HTML"; ?></small>
                    </div>
                </td>
                <td class="TAL">
                    <div class="">
                        <small><?php echo "$fr_ship_consignment_id_HTML"; ?></small>
                    </div>
                </td>
                <td class="FR">
                    <div class="">
                        <small><?php echo "ইনভয়েস আইডি: #$FRc_Invoice_Id_x"; ?></small>
                    </div>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td width="500px">
                    <br>
                    <h4 class="condition">কন্ডিশনঃ <?php echo "$fr_invo_due"; ?> ৳</h4>
                    <?php
                    echo "
                            কাস্টমার নামঃ <b>$fr_cust_name </b><br>
                            মোবাইল নাম্বারঃ <b>$fr_cust_mob1 $fr_cust_mob2</b> <br>
                            ঠিকানাঃ <b>$fr_cust_addres</b> <br>
                            নোটঃ $fr_cust_o_note
                        ";
                    ?>
                </td>
                <td width="250px">
                    <br>
                    <div class="barcode">
                        <?php
                        $barcode_frd = $FRc_Invoice_Id_x;
                        require($FR_PATH_HD . "frd-src/inc/php/barcode_configar_frd.php");
                        echo "$Barcode_FRD";
                        ?>
                    </div>
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
                </td>
            </tr>
        </table>

    </div>
</div>
<p style="page-break-after: always;"></p>