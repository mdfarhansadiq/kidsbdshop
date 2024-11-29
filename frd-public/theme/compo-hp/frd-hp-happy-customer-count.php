<?php
    ///////// TOTAL HAPPY CUSTOMER COUNT 
    $hcc_iconurl="$FRD_HURL/frd-data/img/brandlogu/$fr_cicon";

    $FRQ = $FR_CONN->query("SELECT count(id) AS FRc_HappyCustomers FROM frd_usr WHERE typee = 'cu'");
    extract($FRQ->fetch());
    $FRc_HappyCustomers = ($fr_hpc_def_customers + $FRc_HappyCustomers);


    //TOTAL LIVE PRODUCT COUNT:-
    $FRQ = $FR_CONN->query("SELECT count(id) FROM frd_products WHERE statuss = 1");
    $row_tlpro_c = $FRQ->fetch();
    $T_LiveProduct_c=$row_tlpro_c['count(id)'];
    //TOTAL LIVE CATEGORY COUNT:-
    $FRQ = $FR_CONN->query("SELECT count(id) FROM frd_categoriess WHERE statuss = 1");
    $row_tcat_c = $FRQ->fetch();
    $T_LiveCategory_c=$row_tcat_c['count(id)'];
    //TOTAL LIVE BRAND COUNt:-
    // $FRQ = $FR_CONN->query("SELECT count(id) from frd_brandss where statuss=1");
    // $row_tlbrand_c = $FRQ->fetch();
    // $T_LiveBrand_c=$row_tlbrand_c['count(id)'];
    //TOTAL DELIVERY SUCCESSED ORDER ITEM COUNT:-
    $FRQ = $FR_CONN->query("SELECT count(id) FROM frd_order_invo WHERE fr_stat = 5");
    $row_tsoic_c = $FRQ->fetch();
    $T_DelivSuccesOrderItems_c = $row_tsoic_c['count(id)'];
    $FRc_TDeliSeccOdrItems = ($fr_hpc_def_deli_items+$T_DelivSuccesOrderItems_c);
?>


<!-- TOTAL  HAPPY CUSTOMER  COUNT SECTION -->
<section class="hp_super_secfrd happy_cust_count_sec">
    <div class="container">

        <div class="row">
        <div class="col-md-12">
            <div class="owl-carousel owl-theme fr_oc_hp_hapy_cust_c pointer text-center">
            <?php
                echo "
                    <div class='item'>
                        <img src='$FRD_HURL/frd-data/img/brandlogu/$fr_cicon' class='img-responsive'>
                        <b class='frtitle h1'> $FRc_HappyCustomers + </b><br>
                        <span class='frshortdesc'> $fr_hpc_text_tothappy_customer </span>
                    </div>
                    <div class='item'>
                        <img src='$FRD_HURL/frd-data/img/brandlogu/$fr_cicon' class='img-responsive'>
                        <b class='frtitle h1'> $FRc_TDeliSeccOdrItems +</b><br>
                        <span class='frshortdesc'> $fr_hpc_text_tot_deli_done_order </span>
                    </div>
                    <div class='item'>
                        <img src='$FRD_HURL/frd-data/img/brandlogu/$fr_cicon' class='img-responsive'>
                        <b class='frtitle h1'> $T_LiveCategory_c +</b><br>
                        <span class='frshortdesc'> $fr_hpc_text_tot_category  </span>
                    </div>
                ";
            ?>
            </div>

        </div>
        </div>

    </div>
</section>