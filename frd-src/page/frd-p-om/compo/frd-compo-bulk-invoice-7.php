<style>
/******************************************************************/
/*frd-bulk-invoice-7*/
/******************************************************************/
body{
    margin: 0;
    padding: 0;
}
.frd-bulk-invoice-7 .box {
    width: 288px;
    height: 384px;
    display: inline-block;
    border: 1px #111111 solid;
    margin: 1px;
    padding: 5px;
    overflow: hidden;
    float: left;
    font-family: 'SolaimanLipi';
}
.frd-bulk-invoice-7 .box img.logo{
    width:100px;height:50px;margin:auto;display:block;
}
.frd-bulk-invoice-7 .box .condition{
    text-align: center;
    color: brown;
    margin-top: -5px;
    margin-bottom: -5px;
    font-weight: 900;
    font-size: 30px;
}

.frd-bulk-invoice-7 .box .barcode{
    text-align: center;
}

.frd-bulk-invoice-7 .text-center{
   text-align: center;
}
.frd-bulk-invoice-7 .FR{
        float: right;
}
</style>

<div class="frd-bulk-invoice-7">
    <div class="box">
        <div>
            <img class="logo" src="<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_clogo"; ?>" alt="#">
            <div class="text-center"><b><small><?php echo "$fr_cmobile_1";?></small></b></div>
            <div class="text-center"><b><small><?php echo  substr($FRD_HURL,8) ;?></small></b></div>
            <hr>
            <div class="barcode">
                <?php
                    $barcode_frd = $FRc_Invoice_Id_x;
                    require($FR_PATH_HD . "frd-src/inc/php/barcode_configar_frd.php");
                    echo "$Barcode_FRD";
                ?>
            </div>
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
                        নোটঃ $fr_cust_o_note <br>

                        <small>
                            মোট পণ্য: $FRc_ItemsTotalC | পরিমাণ: $FRc_ItemsTotalQtyC | ডেলিভারি চার্জ: $fr_ship_cost ৳<br>
                        </small>
                    ";
                    ?>
                </td>
            </tr>
        </table>
    </div>
</div>