<?php
$sells_pri = number_format($sells_pri); 

//FRD DISCOUNT AMOUNT CONFIG:-
    if ($discount_pri > 0) {
        $FRc_MarkPrice_Html = "<small class='markprice'><del> ৳ " . number_format(($market_pri)) . "</del></small> <br>";
    } else {
        $FRc_MarkPrice_Html = "";
    }
?>
<div class='col-xs-6 col-sm-4 col-md-2 col-lg-2'>

    <div class='fr_pbox_8'>
        <a title="<?php echo "$bn_name"?>" href="<?php echo "$FRD_HURL/product/$id/$fr_slug"; ?>" target="_self">
         <div class="frimgdiv">

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
         </div>
         
            <div class="frinfo">
                <?php echo "<span class='ptitel'>$bn_name</span>"; ?>
                <span class="pprice"><?php echo "$FRc_MarkPrice_Html $sells_pri ৳"; ?></span>
            </div>
        </a>
        <div class='buttons'>
          <?php echo "<button class='frbtn_ordernow $frtc_on_btn_trig' id='$id' ProVariaTyp='$vry_typ' FrAT='ordernow'><span class='glyphicon glyphicon-flash'></span> $frd_ordernow_txt </button>";?>

          <?php echo "<button class='frbtn_addtocart $frtc_on_btn_trig' id='$id' ProVariaTyp='$vry_typ' FrAT='addtocart'><span class='glyphicon glyphicon-shopping-cart'></span> $addtocart_frd </button>";?>
        </div>
    </div>

</div>