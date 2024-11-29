<section class="mainproduct_secfrd hp_super_secfrd">
    <div class="container">

        <div class="row hp_sectitlfull">
            <div class="col-xs-8">
                <?php echo "<span class='hp_sectitlefrd'> $fr_hpc_text_main_product  </span>"; ?>
            </div>
            <div class="col-xs-4 text-right">
                <a class="frs_moreseebtn" href="<?php echo "$FRD_HURL/feature-products"; ?>"> <?php echo "$fr_hpc_view_more_btn_text "; ?><span class="glyphicon glyphicon-arrow-right pip_pip_1s"></span> </a>
            </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <?php
                $FRc_PFQ = "SELECT * FROM frd_products WHERE statuss = 1 AND frpro_featurepro = 1 AND pro_typ = 1 ORDER BY frpro_priority DESC LIMIT 0,$fr_hpc_catbaspro_show";
                $FRR = FR_QSEL("$FRc_PFQ", "ALL");
                if ($FRR['FRA'] == 1) {
                    foreach ($FRR['FRD'] as $FR_ITEM) {
                        extract($FR_ITEM);
                        require("frd-public/theme/inc/frd_product/inc/jq_ajx/frd-product-box-$FRcf_ProBoxNum.php");
                    }
                } else {
                    echo "<div class='alert alert-danger text-center'>No Feature Product Found! </div>";
                }
                ?>
            </div>
        </div>

    </div>
</section>
<script type="text/javascript">
    FrFunAddToCartManger();
</script>