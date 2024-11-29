<!-- FRD BRAND -->
<section class="brand_marque_sec hp_super_secfrd">
    <div class="container">

        <div class="row hp_sectitlfull">
            <div class="col-xs-8">
                <?php echo "<span class='hp_sectitlefrd'> $fr_hpc_text_popu_brands </span>"; ?>
            </div>
            <div class="col-xs-4 text-right">
                <a class="frs_moreseebtn" href="<?php echo "$FRD_HURL/brands"; ?>"> <?php echo "$fr_hpc_view_more_btn_text "; ?><span class="glyphicon glyphicon-arrow-right pip_pip_1s"></span> </a>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel owl-theme fr_oc_hp_popu_brand pointer TAC catbasebuy">
                <?php
                $FRR = FR_QSEL("SELECT * FROM frd_brandss ORDER BY rand() LIMIT 1,30", "ALL");
                if ($FRR['FRA'] == 1) {
                    foreach ($FRR['FRD'] as $FR_ITEM) {
                    extract($FR_ITEM);
                        echo "
                            <div class='item'>
                            <a href='$FRD_HURL/brand/$slugg'>
                                <img src='$FRD_HURL/frd-data/img/brands_thum/$thumb_picc' class='img-responsive'>
                            </a>
                            <span class='cat_name'> $bn_name </span>
                            </div>
                        ";
                    }
                } else {
                    // PR($FRR);
                    echo "<div class='item alert alert-danger text-center'> No Popular Product Brand Found </div>";
                }
                ?>
                </div>
            </div>
            </div>

    </div>
</section>