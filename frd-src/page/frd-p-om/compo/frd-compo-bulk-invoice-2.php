<div class="frd-bulk-invoice-2">
    <div class="box">
        <div>
            <img class="logo" src="<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_clogo"; ?>" alt="#">
            <div class="text-center"><b><small><?php echo  substr($FRD_HURL,8) ;?></small></b></div>
            <hr>
            <h4 class="condition">কন্ডিশনঃ <?php echo "$fr_invo_due"; ?> ৳</h4>
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
                        নোটঃ $fr_cust_o_note
                    ";
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="barcode">
                        <?php
                        $barcode_frd = $FRc_Invoice_Id_x;
                        require($FR_PATH_HD . "frd-src/inc/php/barcode_configar_frd.php");
                        echo "$Barcode_FRD";
                        ?>
                    </div>
                </td>
            </tr>
        </table>
                <table width="100%">
                    <tr>
                        <td class="TAL">
                            <div class=""> 
                               <small><?php echo "$FRc_SteadfastClientID_HTML";?></small>
                            </div>
                        </td>
                        <td class="TAL">
                            <div class=""> 
                               <small><?php echo "$fr_ship_track_code_HTML";?></small>
                            </div>
                        </td>
                        <td class="FR">
                           <div class=""> 
                             <small><?php echo "$fr_ship_consignment_id_HTML";?></small>
                          </div>
                        </td>
                    </tr>
                </table>

    </div>
</div>