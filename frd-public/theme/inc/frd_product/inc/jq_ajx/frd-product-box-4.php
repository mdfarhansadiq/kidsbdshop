<?php

  $market_pri_exp = explode('.', $market_pri);
  $FRc_MarketPricePoisa = $market_pri_exp[1];
  //+
  $sells_price_exp = explode('.', $sells_pri);
  $FRc_SalesPricePoisa = $sells_price_exp[1];

  
  $FRc_SalesPrice = number_format($sells_pri);
  if($FRc_SalesPricePoisa > 0){
    $FRc_SalesPrice = number_format($sells_pri,2);
  }
  //+
  $FRc_MarketPrice = number_format($market_pri);
  if($FRc_MarketPricePoisa > 0){
    $FRc_MarketPrice = number_format($market_pri,2);
  }


//FRD DISCOUNT AMOUNT CONFIG:-
    if ($discount_pri > 0) {
        $FRc_MarkPrice_Html = "<small class='markprice'><del> ৳ $FRc_MarketPrice</del></small> <br>";
    } else {
        $FRc_MarkPrice_Html = "";
    }
?>
<div class='col-xs-6 col-sm-4 col-md-2 col-lg-2'>

    <div class='fr_pbox_4'>
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
                <span class="pprice"><?php echo "$FRc_MarkPrice_Html $FRc_SalesPrice ৳"; ?></span>
            </div>
        </a>
        <div class="pbtn">
            <?php echo "<button class='frbtn_ordernow $frtc_on_btn_trig' id='$id' ProVariaTyp='$vry_typ' FrAT='ordernow'><span class='glyphicon glyphicon-flash'></span> $frd_ordernow_txt </button>";?>
        </div>
    </div>

</div>