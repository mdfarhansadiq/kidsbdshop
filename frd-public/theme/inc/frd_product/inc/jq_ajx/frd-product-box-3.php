<?php
$sells_pri = number_format($sells_pri);

//FRD DISCOUNT AMOUNT CONFIG:-
    if ($discount_pri > 0) {
        $FRc_MarkPrice_Html = "<small class='markprice'><del> ৳ " . number_format(($market_pri)) . "</del></small> <br>";
    } else {
        $FRc_MarkPrice_Html = "";
    }

//FRD:-
    if ($vry_typ == 2) {
        $FRQ = $FR_CONN->query("SELECT MIN(sells_pri),MAX(sells_pri) from frd_products where v_mp_id = $id");
        $row_fcvpmmp = $FRQ->fetch();
        $frd_color_v_pro_mini_price = $row_fcvpmmp['MIN(sells_pri)'];
        $frd_color_v_pro_max_price = $row_fcvpmmp['MAX(sells_pri)'];
        $sells_pri = "<small style='font-size:10px;'>" . number_format($frd_color_v_pro_mini_price) . " To " . number_format($frd_color_v_pro_max_price) . "</small>";
    }
//FRD:-
    if ($vry_typ == 3) {
        $FRQ = $FR_CONN->query("SELECT MIN(sells_pri),MAX(sells_pri) from frd_products where v_mp_id = $id");
        $row_fsvpmp = $FRQ->fetch();
        $frd_size_v_pro_mini_price = $row_fsvpmp['MIN(sells_pri)'];
        $frd_size_v_pro_max_price = $row_fsvpmp['MAX(sells_pri)'];
        $sells_pri = "<small style='font-size:10px;'>" . number_format($frd_size_v_pro_mini_price) . " To " . number_format($frd_size_v_pro_max_price) . "</small>";
    }
?>
<div class='col-xs-6 col-sm-4 col-md-2 col-lg-2'>

    <div class='fr_pbox_3'>
        <a title="<?php echo "$bn_name" ?>" href="<?php echo "$FRD_HURL/product/$id/$fr_slug"; ?>" target="_self">
            <?php
            if ($dis_persent > 0 and $qtyy > 0) {
                echo "
            <div class='frs_discount'>
                <span> $dis_persent %<br> <span class='pip_pip_1s'>$frtc_off_txt</span> </span>
            </div>
            ";
            }
            if ($qtyy == 0) {
                echo "
                <div class='stock_out_alert'>
                    <span> $stockout_frd </span>
                </div>
                ";
            }
            ?>

            <img class="img-responsive" src="<?php echo "$FRD_HURL/frd-data/img/product/$pic_1"; ?>" alt="<?php echo "$tagg";?>">

            <div class="frinfo">
                <?php echo "<span class='ptitel'>$bn_name</span>"; ?>
                <span class="pprice"><?php echo "$FRc_MarkPrice_Html $sells_pri ৳"; ?></span>
            </div>
        </a>
    </div>

</div>