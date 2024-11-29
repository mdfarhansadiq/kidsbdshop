<?php 
$FRc_FLASH_SELLS_TIME_SRT = strtotime("$FR_FLASH_SELLS_TIME");
if($FR_FLASH_SELLS_MODE == "FRON"){
if($FRc_FLASH_SELLS_TIME_SRT > $FR_NOW_TIME){
?>
<section  class="flashseals_secfrdhp hp_super_secfrd">
    
<div class="container">
        <div class="row hp_sectitlfull">
            <div class="col-xs-8">
                <?php echo "<span class='hp_sectitlefrd'> <span class='glyphicon glyphicon-flash pip_pip_1s'></span> $frtc_flash_sales_txt  </span>"; ?>
            </div>
            <div class="col-xs-4 text-right">
                <a class="frs_moreseebtn" href="<?php echo "$FRD_HURL/flash-sales";?>"> <?php echo "$fr_hpc_view_more_btn_text "; ?><span class="glyphicon glyphicon-arrow-right pip_pip_1s"></span> </a>
            </div>
        </div>

        <a href="<?php echo "$FRD_HURL/flash-sales";?>">
         <div class="row">
                <div id='FRcountDownX' class="col-xs-12 text-center">
                       <div class="frcountdownnum" id="countdown">
                            <ul>
                                <li><span id="FRdays"></span> <i><?php echo "$frtc_flash_sales_days_txt";?></i> </li>
                                <li><span id="FRhours"></span> <i><?php echo "$frtc_flash_sales_hours_txt";?></i> </li>
                                <li><span id="FRminutes"></span> <i><?php echo "$frtc_flash_sales_minutes_txt";?></i> </li>
                                <li><span id="FRseconds"></span> <i><?php echo "$frtc_flash_sales_second_txt";?></i> </li>
                            </ul>
                        </div>
                </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel owl-theme fr_oc_hp_flasseals pointer TAC catbasebuy">
                <?php
                $FRR = FR_QSEL("SELECT * from frd_products WHERE statuss = 1 AND pro_typ = 1 AND qtyy >= 0 AND fr_flash_sale = 1 ORDER BY RAND() LIMIT 0,30", "ALL");
                if ($FRR['FRA'] == 1) {
                    foreach ($FRR['FRD'] as $FR_ITEM) {
                    extract($FR_ITEM);

                    //FRD DISCOUNT AMOUNT CONFIG:-
                        if ($discount_pri > 0) {
                            $FRc_MarkPrice_Html = "<small><del> ৳ " . number_format(($market_pri)) . "</del> -$dis_persent% </small>  <br>";
                        } else {
                            $FRc_MarkPrice_Html = "";
                        }

                            echo "
                                <div class='item'>
                                    <img src='$FRD_HURL/frd-data/img/product/$pic_1' class='' style='max-height:100px;width:auto;margin:auto;'>
                                    <h4 class='boldd c_selasprice'> ".number_format(($sells_pri))." ৳ </h4>
                                    <h6 class='c_discountprice'>$FRc_MarkPrice_Html</h6>
                                </div>
                            ";
                    }
                } else {
                    // PR($FRR);
                    echo "<div class='item alert alert-danger text-center'> No Popular Product Categories Found </div>";
                }
                ?>
                </div>
            </div>
        </div>
     </a>

    </div>

</div>
</section>
<script type="text/javascript">
FrFunAddToCartManger();
$(document).ready(function () {
    FrFun_FlashSalesCD(FR_FLASH_SALES_END_TIME);
});
</script>
<?php }} ?>
