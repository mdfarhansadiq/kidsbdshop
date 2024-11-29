<?php
if( isset($_GET['urll']) ){
    $url=explode('/',$_GET['urll']);
    // echo "<pre>"; print_r($url); echo "</pre>";
    $FR_PG_R=$url[0];
    $FR_THISPAGE = "$FRD_HURL/$FR_PG_R";

    //FRD REJERVED FOR ALL THEME:-
    if($FR_PG_R=="track"){$page_l='page/frd-mix/frd-OrderTrack.php';}
    if($FR_PG_R=="products"){$page_l="page/frd-mix/frd-products_frd.php";} 
    if($FR_PG_R=="shop"){$page_l="page/frd-mix/frd-products_frd.php";} 
    if($FR_PG_R=="product"){$page_l='page/frd-pro/frd-product.php';}

    if($FR_PG_R=="checkout"){$page_l="page/frd-mix/frd-checkout.php";}
    if($FR_PG_R=="checkout-complete"){$page_l="page/frd-mix/frd-checkout-complete.php";}
    if($FR_PG_R=="search"){$page_l="page/frd-mix/frd-search.php";}
    if($FR_PG_R=="feature-products"){$page_l="page/frd-mix/frd-feature-products.php";}
    if($FR_PG_R=="offers"){$page_l="page/frd-mix/frd-offers.php";}
    if($FR_PG_R=="categories_list"){$page_l="page/frd-mix/frd-categories_list.php";}

    if($FR_PG_R=="flash-sales"){$page_l="page/frd-mix/frd-FlashSales.php";}

    if($FR_PG_R=="categories"){$page_l="page/frd-mix/frd-categories.php";}
    if($FR_PG_R=="category"){$page_l="page/frd-mix/frd-category.php";}

    if($FR_PG_R=="brands"){$page_l="page/frd-mix/frd-brands.php";}
    if($FR_PG_R=="brand"){$page_l="page/frd-mix/frd-brand.php";}
    

    if($FR_PG_R=="writers"){$page_l="page/fr_writer/frd-writers.php";}
    if($FR_PG_R=="writer"){$page_l="page/fr_writer/frd-writer.php";}

    if($FR_PG_R=="page"){$page_l="page/frd-mix/frd-page.php";}
    if($FR_PG_R=="rating-review-give"){$page_l="page/frd-mix/frd-RatingReviewGive.php";}
    if($FR_PG_R=="RatingReviewList"){$page_l="page/frd-mix/frd-RatingReviewList.php";}

    //CUSTOMERS MANAGMENT
    if($FR_PG_R=="my_orders"){$page_l="page/mng_cust/frd-my_orders.php";}
    if($FR_PG_R=="my_profile"){$page_l="page/mng_cust/frd-my_profile.php";}
    if($FR_PG_R=="my_pswchange"){$page_l="page/mng_cust/frd-my_pswchange.php";}
    if($FR_PG_R=="my-rating-review"){$page_l="page/mng_cust/frd-my-rating-review.php";}
    if($FR_PG_R=="logout"){$page_l="page/mng_cust/frd-logout.php";}

    //FRD PARCEL DELIVERY:-
    if($FR_PG_R=="parcels_delivery"){$page_l="page/fr_pd/frd-parcels_delivery.php";}
    if($FR_PG_R=="track_parcel"){$page_l="page/fr_pd/frd-track_parcel.php";}
    if($FR_PG_R=="my_parcels"){$page_l="page/fr_pd/frd-my_parcels.php";}

    if($FR_PG_R=="CallbackBkash"){$page_l="page/mng_pg/bkash/frd-callback-bkash.php";}

    if($FR_PG_R=="frd_alert"){$page_l="page/uc/alert_frd.php";}
    if($FR_PG_R=="sslcmz_pay_success"){$page_l="page/mng_pg/sslcom/frd-payment-success.php";}
    if($FR_PG_R=="login"){$page_l="page/mng_login/login_frd.php";}

    if($FR_PG_R=="pc_builder"){$page_l="page/frd-mix/frd-pc_builder.php";}
    if($FR_PG_R=="pixel"){$page_l="page/frd-mix/frd-pixel.php";}
    if($FR_PG_R=="frd-lab"){$page_l="page/frd-mix/frd-lab.php";}
    if($FR_PG_R=="pos"){$page_l="page/frd-mix/frd-pos.php";}
    
    if(isset($page_l)){ 
        require_once("$page_l");
        exit;
    }else{
        FR_GO("$FRD_HURL/?FRH=404");
        exit;
    } 
}