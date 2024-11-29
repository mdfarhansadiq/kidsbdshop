<style>
/******************************************************************/
/*frd-bulk-invoice-5*/
/******************************************************************/
.frd-bulk-invoice-5 {
  display: flex;
  justify-content: center;
  align-items: center;
}

.frd-bulk-invoice-5 .box{
    width: 480px;
    height: 768px;
    display: inline-block;
    border: 1px #777777 solid;
    margin: 10px;
    margin-top: 20px;
    padding: 5px;
    overflow: hidden;
    font-family: 'SolaimanLipi';
}
.frd-bulk-invoice-5 .box img.logo{
    width:auto;height:80px;margin:auto;display:block;
}



.frd-bulk-invoice-5 .box table.item{
    border-collapse: collapse;
    width: 100%;
    margin-right: 30px !important;
}
.frd-bulk-invoice-5 .box table.item tr td{
    border: 1px solid #222222;
    padding-left: 2px;
    padding-right: 2px;
}


.frd-bulk-invoice-5 .box table.barcode_summey{
    border-collapse: collapse;
    width: 100%;
    border: 1px solid #222222;
    border-top: none;
}


.frd-bulk-invoice-5 .box table.summery{
    border-collapse: collapse;
    width: 100%;
}
.frd-bulk-invoice-5 .box table.summery tr td{
    border: 1px solid #222222;
    padding-left: 2px;
    padding-right: 2px;
    border-top: none !important; 
    border-right: none !important; 
}



.frd-bulk-invoice-5 .box .condition{
    font-weight: bold;
    font-size: 20px;
}
.frd-bulk-invoice-5 .box .barcode{
    text-align: center;
    margin-top: 3px;
}

.frd-bulk-invoice-5 .box .TAR{
    text-align: right;
}
.frd-bulk-invoice-5 .box .TAC{
    text-align: center;
}
.frd-bulk-invoice-5 .box .bold{
    font-weight: bold;
}

</style>

<div class="frd-bulk-invoice-5">
    <div class="box">
            <div>
                <div class="TAC"><b><small>বিসমিল্লাহির রাহমানির রাহিম</small></b></div>
                <img class="logo" src="<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_clogo"; ?>" alt="#">
                <div class="TAC"><b><small><?php echo  "Mobile: $fr_cmobile_1"; ;?> Website: <?php echo  "www.".substr($FRD_HURL,8) ;?></small></b></div>
                <hr>
                <table width="100%">
                    <tr>
                        <td class="TAL">
                            <div class=""> <small><?php echo "অর্ডার টাইম: ".date('Y-M-d h:i A', $fr_o_time)." ";?></small></div>
                        </td>
                        <td class="TAR">
                           <div class=""> 
                            <small><?php echo "ইনভয়েস আইডি: #$FRc_Invoice_Id_x";?></small>
                          </div>
                        </td>
                    </tr>
                </table>
                <table width="100%">
                    <tr>
                        <td class="TAL">
                            <div class=""> 
                               <small><?php echo "$fr_ship_track_code_HTML";?></small>
                            </div>
                        </td>
                        <td class="TAR">
                           <div class=""> 
                             <small><?php echo "$FRc_SteadfastClientID_HTML";?></small><br>
                             <small><?php echo "$fr_ship_consignment_id_HTML";?></small>
                          </div>
                        </td>
                    </tr>
                </table>
                <?php
                echo "
                    নামঃ <b>$fr_cust_name </b><br>
                    মোবাইল নাম্বারঃ <b>$fr_cust_mob1 $fr_cust_mob2</b> <br>
                    ঠিকানাঃ <b>$fr_cust_addres</b>
                ";
                if($fr_cust_o_note != "NA"){ echo " <br> নোটঃ $fr_cust_o_note"; }
                ?>
            </div>
            <table class="item">
                <tr>
                    <td class='TAC'>ছবি</td>
                    <td class='TAC'>কোড</td>
                    <td class='TAC'>সাইজ</td>
                    <td class='TAC'>পরিমাণ</td>
                    <td class='TAR'>টাকা</td>
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
                                    $frd_sv_pro_sku_lmody = "NA";
                                } else {
                                    $frd_sv_pro_sku_lmody = "<b>$frd_sv_pro_sku </b>";
                                }

                                //ORDER SIZE CUSTOMIZE:- 
                                if ($fr_size_name == "") {
                                    $fr_size_name_M = "NA";
                                } else {
                                    $fr_size_name_M = "$fr_size_name";
                                }
                                echo "
                                <tr class='bold'>
                                    <td class='TAC' width='10%'>
                                        <img src='$FRD_HURL/frd-data/img/product/$fr_pro_pic_1' style='width: 30px; height: 30px'/>
                                    </td>
                                    <td class='TAC'>$frd_sv_pro_sku_lmody</td>
                                    <td class='TAC'>$fr_size_name_M</td>
                                    <td width='127px' class='TAC'>$fr_qty</td>
                                    <td width='101px' class='TAR'>" . number_format($fr_t_price) . " ৳</td>
                                </tr>
                                ";
                        }
                        } else {
                            PR($FRR);
                        }
                        //END>
                        ?>
            </table>
            
            <table width="100%" class="barcode_summey" >
                <tr>
                    <td width="50%">
                            <div class="barcode">
                                <?php
                                $barcode_frd = $FRc_Invoice_Id_x;
                                require($FR_PATH_HD . "frd-src/inc/php/barcode_configar_frd.php");
                                echo "$Barcode_FRD";
                                ?>
                            </div>
                    </td>
                    <td width="50%">
                        <table class="summery">
                            <tr>
                                <td>ডেলিভারি চার্জ</td>
                                <td width='100px' class='TAR'><?php echo number_format($fr_ship_cost);?> ৳</td>
                            </tr>
                            <tr>
                                <td>ডিসকাউন্ট</td>
                                <td width='100px' class='TAR'><?php echo number_format($fr_cupo_discount);?> ৳</td>
                            </tr>
                            <tr>
                                <td>অগ্রিম প্রদান</td>
                                <td width='100px' class='TAR'><?php echo number_format($fr_payment);?> ৳</td>
                            </tr>
                            <tr>
                                <td>মোট</td>
                                <td width='100px' class='TAR'><?php echo number_format($fr_invo_due);?> ৳</td>
                            </tr>
                            <tr class="condition">
                                <td>কন্ডিশনঃ</td>
                                <td width='100px' class='TAR'><?php echo number_format($fr_invo_due);?> ৳</td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
           
           
            

            
    
            

        

    </div>
</div>
<p style="page-break-after: always;"></p>