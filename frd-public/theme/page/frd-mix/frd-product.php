<?php
require_once("frd-public/theme/frd-header-s.php");
ob_start();
$rtd_path = "rtd";
$fr_cat_bpro_url = "$FRD_HURL/category";
if (isset($_GET['urll'])) {
  $l_url = explode('/', $_GET['urll']);
  $product_id = $l_url[1]; //product id
  $product_name = $l_url[2]; //product title
  if (!isset($l_url[2])) {
    echo "<script>window.location.replace('$FRD_HURL?alert_frd=This Is Not Valid Product Url');</script>";
}


  //#// PRODUCT TABLE DATA F
  $q_frd = "SELECT * FROM frd_products WHERE id = $product_id AND statuss IN (1,2)";
  require("$rtd_path/1_frd.php");
  require("$rtd_path/productss_t_frd.php");

  // VALIDATION CHACKING
  if ($rowsnum_frd == 0) {
    header("location:$FRD_HURL?alert_frd=ThisProductPresentStatusShow [fc=1537]");
  }

  $FRc_StockStatusText = "$frlc_out_stock_tx";
  $FRc_OG_availability = "out of stock";
  if($pro_qtyy > 0){ $FRc_StockStatusText = "$frlc_in_stock_tx";   $FRc_OG_availability = "in stock"; }

  //CUSTOM PRODUCT ID MAKIN
  $cusl_pro_id = $pro_id;
  if($pro_type == 1){ $FRc_MP_IDx = $cusl_pro_id; } else{ $FRc_MP_IDx = $pro_v_mp_id; }

  $FRc_ThisProductLink = "$FRD_HURL/product/$cusl_pro_id/$fr_slug";


  $pro_market_price_exp = explode('.', $pro_market_price);
  $FRc_MarketPricePoisa = $pro_market_price_exp[1];
  //++
  $pro_sells_price_exp = explode('.', $pro_sells_price);
  $FRc_SalesPricePoisa = $pro_sells_price_exp[1];
  //++
  $FRc_SalesPrice = number_format($pro_sells_price);
  if($FRc_SalesPricePoisa > 0){
    $FRc_SalesPrice = number_format($pro_sells_price,2);
  }
  //+
  $FRc_MarketPrice = number_format($pro_market_price);
  if($FRc_MarketPricePoisa > 0){
    $FRc_MarketPrice = number_format($pro_market_price,2);
  }



  // FRD SINGLE PRODUCT TYPE DETECTING    
  if ($pro_vry_type == 2) {
    $frd_s_protyp = 'cvp';
  } //[2=color variation product]
  if ($pro_vry_type == 3) {
    $frd_s_protyp = 'svp';
  } //[3=size variation product]

  //ADD_TO_CART AND ORDER_NOW BTN SHOW PERMIN MANAGER
  if ($pro_qtyy > 0) {
    $frd_addrtocart_pmit = "frd_y";
  } else {
    $frd_addrtocart_pmit = "frd_n";
  }
  // PRODUCT BZOOM SMALL IMG SHOW QTY DISIDER
  $pro_img_show_qty = 4;
  if ($pro_pic_4 == "1.jpg") {
    $pro_img_show_qty = 3;
  }
  if ($pro_pic_3 == "1.jpg") {
    $pro_img_show_qty = 2;
  }
  if ($pro_pic_2 == "1.jpg") {
    $pro_img_show_qty = 1;
  }



  //PRODUCT BAND NAME FETCHERS:-
  $FRQ = $FR_CONN->query("SELECT en_name FROM frd_brandss WHERE id = $pro_r_brand");
  $rowdata_probrandname = $FRQ->fetch();
  $pro_r_brand_name = $rowdata_probrandname['en_name'];
  //PRODUCT COLOR NAME:-   
  $FRQ = $FR_CONN->query("SELECT en_name FROM frd_colorr WHERE id = $pro_r_color");
  $rowdata_procolorname = $FRQ->fetch();
  $pro_r_color_name = $rowdata_procolorname['en_name'];
  //PRODUCT DETAILS MODIFY 
  $pro_detailes_mody = preg_replace("/#/", '<span class="glyphicon glyphicon-apple" ></span>', $pro_detailes);




  ///***product relational catt name/ rcat path fetcher s:-
  //FRD DATA FOR GTM:-
  $pro_catt1_name_bn = "N/A";
  $pro_catt2_name_bn = "N/A";
  $pro_catt3_name_bn = "N/A";
  $pro_catt4_name_bn = "N/A";

  $pro_catt1_modyfecho = "";
  $pro_catt2_modyfecho = "";
  $pro_catt3_modyfecho = "";
  $pro_catt4_modyfecho = "";

  $frd_spp_self_cat_id = 0;

  if ($pro_r_cat_1 > 0) {
    $FRQ = $FR_CONN->query("SELECT * FROM frd_categoriess WHERE id = $pro_r_cat_1");
    $row_cat1_name = $FRQ->fetch();
    $pro_catt1_name_bn = $row_cat1_name['bn_name'];
    $pro_catt1_slug = $row_cat1_name['slugg'];
    $pro_catt1_path = "$fr_cat_bpro_url/$pro_catt1_slug";
    $pro_catt1_modyfecho = "<a href='$FRD_HURL'> $fr_tn_home_btn_txt </a> / <a href='$pro_catt1_path'> $pro_catt1_name_bn</a>";
    //SINGLE PRODUCT PAGE SELF CAT ID FIEND   
    $frd_spp_self_cat_id = $pro_r_cat_1;

    if ($pro_r_cat_2 > 0) {
      $FRQ = $FR_CONN->query("SELECT * FROM frd_categoriess WHERE id = $pro_r_cat_2");
      $row_cat2_name = $FRQ->fetch();
      $pro_catt2_name_bn = $row_cat2_name['bn_name'];
      $pro_catt2_slug = $row_cat2_name['slugg'];
      $pro_catt2_path = "$fr_cat_bpro_url/$pro_catt2_slug";
      $pro_catt2_modyfecho = "<a href='$pro_catt2_path'>/ $pro_catt2_name_bn</a>";
      //SINGLE PRODUCT PAGE SELF CAT ID FIEND   
      $frd_spp_self_cat_id = $pro_r_cat_2;
    }
    if ($pro_r_cat_3 > 0) {
      $FRQ = $FR_CONN->query("SELECT * FROM frd_categoriess WHERE id = $pro_r_cat_3");
      $row_cat3_name = $FRQ->fetch();
      $pro_catt3_name_bn = $row_cat3_name['bn_name'];
      $pro_catt3_slug = $row_cat3_name['slugg'];
      $pro_catt3_path = "$fr_cat_bpro_url/$pro_catt3_slug";
      $pro_catt3_modyfecho = "<a href='$pro_catt3_path'>/ $pro_catt3_name_bn</a>";
      //SINGLE PRODUCT PAGE SELF CAT ID FIEND   
      $frd_spp_self_cat_id = $pro_r_cat_3;
    }
    if ($pro_r_cat_4 > 0) {
      $FRQ = $FR_CONN->query("SELECT * FROM frd_categoriess WHERE id = $pro_r_cat_4");
      $row_cat4_name = $FRQ->fetch();
      $pro_catt4_name_bn = $row_cat4_name['bn_name'];
      $pro_catt4_slug = $row_cat4_name['slugg'];
      $pro_catt4_path = "$fr_cat_bpro_url/$pro_catt4_slug";
      $pro_catt4_modyfecho = "<a href='$pro_catt4_path'>/ $pro_catt4_name_bn</a>";
      //SINGLE PRODUCT PAGE SELF CAT ID FIEND   
      $frd_spp_self_cat_id = $pro_r_cat_4;
    }
  }

  //END>>       


  // FRD DEFAULT CUSTOM VALUE
  $frd_pro_show_mode = "RP";
  $frd_cus_sells_price = number_format($pro_sells_price);




  //DELIVERY AND PAMENT INFO NOTE INSIDE DHAKA:-
  $FRQ = $FR_CONN->query("SELECT page_body_en from frd_pages WHERE id = 12");
  $rd_sp_dpiidhak_kx = $FRQ->fetch();
  $frd_sp_dpiindhaka = $rd_sp_dpiidhak_kx['page_body_en'];
  //DELIVERY AND PAMENT INFO NOTE OUTSIDE DHAKA:-
  $FRQ = $FR_CONN->query("SELECT page_body_en from frd_pages WHERE id = 13");
  $rd_sp_dpioutdhak_kx = $FRQ->fetch();
  $frd_sp_dpioutdhaka = $rd_sp_dpioutdhak_kx['page_body_en'];

  //SINGLE PAGE SPACIAL NOTE or NOTICE:-
  $FRQ = $FR_CONN->query("SELECT * from frd_pages WHERE id = 14");
  $rd_spp_note_fc_kx = $FRQ->fetch();
  $frd_spp_note_fc_pt = $rd_spp_note_fc_kx['page_name_en'];
  $frd_spp_note_fcust = $rd_spp_note_fc_kx['page_body_en'];
}

$FR_R = $FR_CONN->exec("UPDATE frd_products SET vieww = vieww+1 WHERE id = $product_id");



$FRc_PAGE_TITEL = "$fr_meta_title - $pro_catt1_name_bn";
$FRc_META_TAG_HTML = "
    <meta property='og:title' content='$FRc_PAGE_TITEL'>
    <meta property='og:description' content='$fr_meta_desc. $pro_catt1_name_bn'>
    <meta property='og:url' content='$FRD_HURL/product/$pro_id/$fr_slug'>
    <meta property='og:image' content='$pro_pic_1_path'>
    <meta property='product:brand' content='$pro_r_brand_name'>
    <meta property='product:availability' content='$FRc_OG_availability'>
    <meta property='product:condition' content='new'>
    <meta property='product:price:amount' content='$pro_sells_price'>
    <meta property='product:price:currency' content='BDT'>
    <meta property='product:retailer_item_id' content='$cusl_pro_id'>
    <meta property='product:item_group_id' content='$pro_skuu'>
    <meta property='og:image:type' content='image/jpeg'/>
    <meta property='og:image:width' content='auto'/>
    <meta property='og:image:height' content='800'/>

    
    <meta name='keywords' content='$pro_tag,$pro_catt1_name_bn,spiderecommerce.com,spider ecommerce'>
    <meta name='description' content='$fr_meta_desc'>
    <meta name='page-topic' content='$pro_catt1_name_bn'>
    <meta name='author' content='$fr_cname'> 
    <meta name='publisher' content='$fr_cname'>
    <meta name='copyright' content='$fr_cname'>
    <meta name='page-type' content='Product'>
    <meta name='audience' content='Everyone'>
    <meta name='robots' content='index'>
";

require_once("frd-public/theme/frd-header.php");


//FRD CONVERTION TRACK DATA CUSTOMIZE START:-
$FRc_CT_ItemSealPrice = $pro_sells_price;
$FRc_CT_ItemId = $product_id;
$FRc_CT_ItemName = preg_replace("/'/","",$pro_bn_name);
$FRc_CT_ItemCatName = preg_replace("/'/","",$pro_catt1_name_bn);
//FRD CONVERTION TRACK DATA CUSTOMIZE END>>
?>



<div class="container">

  <div class="row">
    <!--row-->

    <!-- LEFT SIDE -->
    <div class="col-md-12 left_side sproduct_dislay_div">

      <!-- PRODUCT TITLE  -->
      <div class="col-md-12">
        <?php
         //FRD CATEGORY PATH:- 
         if($frtc_catpath_dp == 1){
            echo "<h4> <span class='rcsp_1'> $pro_catt1_modyfecho </span> <span class='rcsp_2'> $pro_catt2_modyfecho </span> <span class='rcsp_3'> $pro_catt3_modyfecho </span> <span class='rcsp_4'> $pro_catt4_modyfecho </span><h4>";
         }
         //END>> 
         if($frtc_pro_title_dp == 1){
            echo "<h1 class='protitle'>$pro_bn_name</h1>";
         }
        ?>
      </div>


      <div class="col-md-6">
        <?php
        //FRD READ A LITTLE TRIGER BUTTON:-
        if ($fr_read_a_little != "") {
          echo "<div class='frbdiv_aktu_poray_dakhun'><button class='btn btn-default frtrig_aktu_poray_dakhun' FrPdfFileLink='$FRD_HURL/frd-data/pdf/read-a-little/$fr_read_a_little'> <span class='glyphicon glyphicon-eye-open pip_pip_1s'></span> একটু পড়ে দেখুন <span class='glyphicon glyphicon-resize-full'></span></button></div>";
        }
        //END>>
        ?>

        <?php
        echo "<img class='img-responsive' src='$pro_pic_1_path' alt='$pro_tag' />";
        if ($pro_pic_2 !== "1.jpg") {
          echo "<br> <img class='img-responsive' src='$pro_pic_2_path' alt='$pro_tag' />";
        }
        if ($pro_pic_3 !== "1.jpg") {
          echo "<br>  <img class='img-responsive' src='$pro_pic_3_path' alt='$pro_tag' />";
        }
        if ($pro_pic_4 !== "1.jpg") {
          echo "<br>  <img class='img-responsive' src='$pro_pic_4_path' alt='$pro_tag' /> ";
        }
        ?>

        <div class="pro_video_div">
          <?php if ($pro_video !== "") { ?>
            <br>
            <iframe width="100%" height="300px" src="https://www.youtube.com/embed/<?php echo "$pro_video"; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
          <?php } ?>
        </div>
      </div>


      <div class="col-md-6">


            <!-- FLASH SALES ALERT  -->
              <?php 
                $FRc_FLASH_SELLS_TIME_SRT = strtotime("$FR_FLASH_SELLS_TIME");
                if($fr_flash_sale == 1){
                if($FR_FLASH_SELLS_MODE == "FRON"){
                if($FRc_FLASH_SELLS_TIME_SRT > $FR_NOW_TIME){
               ?>
              <div class="row row_flassaletimer">
                <div id='FRcountDownX' class="col-xs-12 text-center">
                      <h4 class="text-center c_title"><span class='glyphicon glyphicon-flash pip_pip_1s'></span> <?php echo "$frtc_flash_sales_txt";?></h4>
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
              <?php }}} ?>


        <!-- DELIVERY CHARGE FREE S -->
        <div class="text-center"> 
          <?php
          if ($deli_crg_typ == 2 && $frtc_delifreeimg_s_dp == 1) {
            // echo "<h6 class='alert alert-success text-center'> $frlc_delivery_charge_free_txt </h6>";
            echo "<img src='$FRD_HURL/frd-public/theme/asset/img/alert-free-delevery.gif' alt='#' style='max-height:100px;width:auto;margin:auto;'>";
          }
          ?>
        </div>
        <!-- DELIVERY CHARGE FREE E -->



        <?php if ($pro_discount_amount > 0) {
          echo "<span class='market_price'><del> $FRc_MarketPrice $frlc_tksymbol_txt </del> &#160;&#160;</span>";
        } ?>
        <span class="sells_price"><?php echo $FRc_SalesPrice ?> <?php echo "$frlc_tksymbol_txt";?> </span> <br>
        <?php 
        if($frtc_pro_id_dp == 1){
           echo "<span class='deal_code'><b>🎁 $frlc_product_id_tx:</b> $cusl_pro_id </span> <br>";
        }
        if ($pro_skuu !== "") {
          echo "<span><b>🎁 $frlc_product_sku_tx:</b> $pro_skuu </span> <br>";
        } 
        if($pro_r_color_name != "" AND $pro_r_color_name != "N/A"){
            echo "<span><b>$frlc_product_color_tx:</b> $pro_r_color_name </span> <br>";
        }
         if($frtc_pro_view_dp == 1){
            echo " <span class='pro_viewed'> <b>$frlc_view_tx:</b> $pro_view </span> <br>";
         }
         if($frtc_pro_instock_dp == 1){
           echo "<span class=''>$FRc_StockStatusText</span> <br>";
         }
        ?>


               
       


        

        


        <!-- COLOR VARIATION PRODUCT SHOWING ROW -->
        <div class="row">
          <style>
            .color_vry_pro_sin {
              float: left;
              padding: 5px;
            }
          </style>
          <div class="col-md-12">
            <?php
            if ($pro_vry_type == 2) {
              //echo "<span class='alertt'> পছন্দের রঙ নির্বাচিত করতে পছন্দের রঙের ছবিটি সিলেক্ট করুন </span> <br>";
              $q_frd = "SELECT * FROM frd_products WHERE statuss = 1 AND v_mp_id = $pro_v_mp_id AND vry_typ = 2";
              require("$rtd_path/1_frd.php");
              for ($i = 1; $i <= $rowsnum_frd; $i++) { //For Loop S
                require("$rtd_path/productss_t_frd.php");
                echo "
                  <div class='color_vry_pro_sin'>
                    <a class='frd_tdn' href='$FRD_HURL/product/$pro_id/$fr_slug'>
                      <img title='Click To See' src='$pro_pic_1_path' alt=''class='img-rounded' width='50px' height='50px'>
                    </a>
                  </div>
                ";
              } //For Loop E
            }
            ?>
          </div>
        </div>



          <br />
          <?php
           //FRD ORDER BUTTONS GROUPS:-
            if($frtc_on_btn_dp == 1){
              echo "<button class='sp_frdbtn_ordernow frdtrig_atc btn btn-block btn-danger' id='$FRc_MP_IDx' ProVariaTyp='$pro_vry_type' FrAT='ordernow'><span class='glyphicon glyphicon-flash'></span>$frd_ordernow_txt</button>";
            }
            if($frtc_atc_btn_dp == 1){
              echo "<button class='sp_addtocart_btn frdtrig_atc' id='$FRc_MP_IDx' ProVariaTyp='$pro_vry_type' FrAT='addtocart'> <span class='glyphicon glyphicon-shopping-cart'></span> $addtocart_frd </button>";
            }
            if($frtc_wpo_btn_dp == 1){
              echo " <button class='sp_frdbtn_wao frdtrig_atc' id='$FRc_MP_IDx' ProVariaTyp='$pro_vry_type' FrAT='waorder'> <span class='fa-brands fa-whatsapp'></span> $fr_wporder_btn_txt </button>";
            }
            if($frtc_co_btn_dp == 1){
              echo " <button class='sp_frdbtn_co'> <span class='glyphicon glyphicon-phone'></span> <a href='tel:$fr_cmobile_1'>$fr_callorder_btn_txt <small>$fr_cmobile_1</small></a> </button>";
            }
          //END>>
          ?>



         <style>
          div.div_long_description img{
               width: 100% !important;
          }
         </style>
         <!-- PRODUCT DETAILS DESCRIPTION  -->
        <div class="div_long_description">
          <article>
            <?php
            echo "<h2 class='text-center boldd'>$pro_bn_name</h2>";
            echo "
                $pro_detailes_mody
              ";
            ?>
          </article>
        </div>
        <br>

        <?php
        //FRD EXTAR ORDER NOW BUTTON:-
          if($frtc_order_btng2_dp == 1){
              if($frtc_on_btn_dp == 1){
                echo "<button class='sp_frdbtn_ordernow frdtrig_atc btn btn-block btn-danger' id='$FRc_MP_IDx' ProVariaTyp='$pro_vry_type' FrAT='ordernow'><span class='glyphicon glyphicon-flash'></span>$frd_ordernow_txt</button>";
              }
              if($frtc_atc_btn_dp == 1){
                echo "<button class='sp_addtocart_btn frdtrig_atc' id='$FRc_MP_IDx' ProVariaTyp='$pro_vry_type' FrAT='addtocart'> <span class='glyphicon glyphicon-shopping-cart'></span> $addtocart_frd </button>";
              }
              if($frtc_wpo_btn_dp == 1){
                echo " <button class='sp_frdbtn_wao frdtrig_atc' id='$FRc_MP_IDx' ProVariaTyp='$pro_vry_type' FrAT='waorder'> <span class='fa-brands fa-whatsapp'></span> $fr_wporder_btn_txt </button>";
              }
              if($frtc_co_btn_dp == 1){
                echo " <button class='sp_frdbtn_co'> <span class='glyphicon glyphicon-phone'></span> <a href='tel:$fr_cmobile_1'>$fr_callorder_btn_txt <small>$fr_cmobile_1</small></a> </button>";
              }
          }
        //END>>
        ?>


      </div>

    </div>

  </div>
  <!--row end-->
</div>


<br>
<!-- CALL FOR ORFER SECTION-->
<div class="container">
  <div class="row">
    <div class="col-md-12">
        <?php
            if($frtc_callfororder_s_dp == 1){
              echo "
                <br>
                <div class='CallForOrderDiv text-center'>
                  <div class='textt'> <span class='glyphicon glyphicon-phone'></span> <br> $frlc_call_for_order_tx</div>
                  <a href='tel:$fr_cmobile_1'>$fr_cmobile_1</a>
                </div>
              ";
            }
        ?>
    </div>
  </div>
</div>



<!-- FRD PRODUCT RATING REVIEW -->
<br>
<div class="container">
  <?php 
  if($frtc_rating == 1){
  if($fr_t_rr_c > 0){
  ?>
  <div class="row jumbotron">

      <div class="col-md-6">

         <div class="FrAveRatingReviewDiv_Left">
            <?php 
            if($fr_a_rating == 5){$FRc_a_rating_HTML = "★★★★★<span></span>";} 
            elseif($fr_a_rating == 4){$FRc_a_rating_HTML = "★★★★<span>★</span>";}
            elseif($fr_a_rating == 3){$FRc_a_rating_HTML = "★★★<span>★★</span>";}
            elseif($fr_a_rating == 2){$FRc_a_rating_HTML = "★★<span>★★★</span>";}
            elseif($fr_a_rating == 1){$FRc_a_rating_HTML = "★<span>★★★★</span>";}
            elseif($fr_a_rating == 0){$FRc_a_rating_HTML = "<span>★★★★★</span>";}
            ?>
            <h1><?php echo "$fr_a_rating";?> <small>/5</small></h1>
              <span class="avarate_star_rating"> <?php echo "$FRc_a_rating_HTML";?> </span>
              <br>
            <small><?php echo "$fr_t_rr_c";?> Reviews <br> Average Rating <?php echo "$fr_a_rating";?></small>
         </div>


      

      </div>

      <div class="col-md-6">
                 
          <div class="FrAveRatingReviewDiv_right">
            <?php
             $FRc_t_5sr_prs = ($fr_t_5sr / $fr_t_rr_c * 100);
             $FRc_t_4sr_prs = ($fr_t_4sr / $fr_t_rr_c * 100);
             $FRc_t_3sr_prs = ($fr_t_3sr / $fr_t_rr_c * 100);
             $FRc_t_2sr_prs = ($fr_t_2sr / $fr_t_rr_c * 100);
             $FRc_t_1sr_prs = ($fr_t_1sr / $fr_t_rr_c * 100);
            ?>

            <div class="frline">
              <div class="div1"> ★★★★★ </div>
              <div class="div2">
                  <div class="progress"> <div class="progress-bar" style="width: <?php echo "$FRc_t_5sr_prs%";?>;"> <?php echo "$FRc_t_5sr_prs%";?> </div> </div>
              </div>
              <div class="div3"><?php echo "$fr_t_5sr";?></div>
            </div>

            <div class="frline">
              <div class="div1"> ★★★★ </div>
              <div class="div2">
                  <div class="progress"> <div class="progress-bar progress-bar-warning" style="width: <?php echo "$FRc_t_4sr_prs%";?>;"> <?php echo "$FRc_t_4sr_prs%";?> </div> </div>
              </div>
              <div class="div3"><?php echo "$fr_t_4sr";?></div>
            </div>

            <div class="frline">
              <div class="div1"> ★★★ </div>
              <div class="div2">
                  <div class="progress"> <div class="progress-bar progress-bar-warning" style="width: <?php echo "$FRc_t_3sr_prs%";?>;"> <?php echo "$FRc_t_3sr_prs%";?> </div> </div>
              </div>
              <div class="div3"><?php echo "$fr_t_3sr";?></div>
            </div>

            <div class="frline">
              <div class="div1"> ★★ </div>
              <div class="div2">
                  <div class="progress"> <div class="progress-bar progress-bar-warning" style="width: <?php echo "$FRc_t_2sr_prs%";?>;"> <?php echo "$FRc_t_2sr_prs%";?> </div> </div>
              </div>
              <div class="div3"><?php echo "$fr_t_2sr";?></div>
            </div>

            <div class="frline">
              <div class="div1"> ★ </div>
              <div class="div2">
                  <div class="progress"> <div class="progress-bar progress-bar-warning" style="width: <?php echo "$FRc_t_1sr_prs%";?>;"> <?php echo "$FRc_t_1sr_prs%";?></div> </div>
              </div>
              <div class="div3"><?php echo "$fr_t_1sr";?></div>
            </div>

           </div>
      </div>
  </div>

  <div class="row">
        <div class="col-md-3"></div>
        
          <div class="col-md-6 FrRatingReviewList">
            <?php
              $FRR = FR_QSEL("SELECT * FROM frd_rating_review WHERE fr_rr_pro_id = $cusl_pro_id AND fr_rr_stat = 1 ORDER BY id DESC LIMIT 0,5","ALL");
              if($FRR['FRA']==1){
                $FRc_RR_SL = 1;  
                foreach($FRR['FRD'] as $FR_ITEM){
                  extract($FR_ITEM);
                  extract(FR_USR_MINI_INFO($fr_rr_cust_id));

                  if($fr_rating == 5){ $FRc_Rating = "★★★★★";}
                  elseif($fr_rating == 4){ $FRc_Rating = "★★★★";}
                  elseif($fr_rating == 3){ $FRc_Rating = "★★★";}
                  elseif($fr_rating == 2){ $FRc_Rating = "★★";}
                  elseif($fr_rating == 1){ $FRc_Rating = "★";}

                  $FRc_RatingDate = date('d-M-Y',$fr_rr_time);

                  $FRc_LeftMedia = "";
                  if($FRc_USR_PIC == "1.jpg"){
                    $FRc_LeftMedia = "<h2 class='boldd'>".substr($FRc_USR_NAME,0,1)."</h2>";
                  }else{
                    $FRc_LeftMedia = " <img class='media-object img-circle' src='$FRD_HURL/frd-data/img/customer/$FRc_USR_PIC' alt='#' width='60px' height='60%' >";
                  }

                  $FRc_UMP1 = substr($FRc_USR_MOBILE1,0,4);
                  $FRc_UMP2 = "*****";
                  $FRc_UMP3 = substr($FRc_USR_MOBILE1,9,11);
                  $FRc_USR_MOBILE1 = "$FRc_UMP1$FRc_UMP2$FRc_UMP3";

                  echo "
                  <div class='media FrMedia_rr jumbotron'>
                    <div class='media-left'>
                      $FRc_LeftMedia
                    </div>
                    <div class='media-body'>
                        <small class='rating_time'>$FRc_RatingDate</small><br>
                        <h4 class='media-heading'> <b> $FRc_USR_NAME</b> <small></small></h4>
                        <h5 class='media-heading'> <b> $FRc_USR_MOBILE1</b></h5>
                        <span class='rating_star'> $FRc_Rating </span><br>
                        $fr_review
                    </div>
                    </div>
                  ";

                  $FRc_RR_SL = ($FRc_RR_SL + 1);
                }
                 
                 if($FRc_RR_SL > 5 ){
                   echo "<div class='text-center frdiv_seemore_rr'><button class='btn btn-default frsty_theme_super_btn frtrig_seemore_ratingreview' fr_rr_pro_id='$FRc_MP_IDx'><span class='glyphicon glyphicon-fullscreen'></span> $frlc_see_more_rating_r_tx </button></div> <br><br><br>";
                 }

               } else{ 
                //  PR($FRR);
                //  echo "<div class='alert alert-danger text-center'>No ratings and reviews found!</div>";
               }
            ?>
          </div>

        <div class="col-md-3"></div>
      </div>

  <?php } } ?>
</div>





<!-- DELIVERY CHARGE HINKS DHAKA AND OUTSIDE DHAKA -->
  <?php if($frtc_delicharg_s_dp == 1){ ?>
    <br>
    <div class="container">
      <div class="row text-center">
        <div class="col-md-6">
        <div class="jumbotron insidedhakadcdiv">
          <h4> <img src="<?php echo "$FR_HURL_AT/asset/img/icon_2_dcidc.png";?>" alt="" width="30px">
            <br>
            <?php echo "$frd_sp_dpiindhaka"; ?>
          </h4>
        </div>
      </div>
      <div class="col-md-6">
        <div class="jumbotron outsidedhakadcdiv">
          <h4>
            <img src="<?php echo "$FR_HURL_AT/asset/img/icon_3_dcodc.png"; ?>" alt="" width="30px">
            <br>
            <?php echo "$frd_sp_dpioutdhaka"; ?>
          </h4>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
  
  
  
  
  
  <!-- NOTE FOR CUSTOMERs -->
  <?php if($frtc_notes_s_dp == 1){ ?>
    <br>
    <div class="container ">
    <div class="row">
      <div class="col-md-12">
        <div class="jumbotron ppp_note_sec">
          <div class="">
            <?php echo "$frd_spp_note_fcust"; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>
  



  
  
  
<!-- RELATED PRODUCTS SHOWING S -->
<?php if($frtc_relatedproshow_s_dp == 1){ ?>
  <div class="section sec_related_product">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h3> <span class="glyphicon glyphicon-hand-right pip_pip_1s"></span> <?php echo "$frlc_related_product_tx";?> </h3>
        <div id="load_data"></div>
        <div id="load_data_message"></div>
      </div>
    </div>
  </div>
  </div>
  <script>
    $(document).ready(function() {

    
      //FRD RELATED PRODUCTSFETCHING:-
       $('.sec_related_product').hide();
        setTimeout(function(){ 
         var limit = 60;
          var start = 0;
          var action = 'inactive';
          var catt_id = '<?php echo "$frd_spp_self_cat_id" ?>';
          function load_data(limit, start) {
            $.ajax({
              url: "<?php echo "$FR_HURL_AT/inc/frd_product/inc/jq_ajx/fr_mixd_products.php"; ?>",
              method: "POST",
              data: {
                limit: limit,
                start: start,
                catt_id: catt_id
              },
              cache: false,
              success: function(data) {
                $('#load_data').append(data);
                $('.sec_related_product').show();
                if (data == '') {
                  $('#load_data_message').html("NO MORE FOUND");
                  action = 'active';
                } else {
                  $('#load_data_message').html("");
                  action = "inactive";
                }
              }
            });
          }

          if (action == 'inactive') {
            action = 'active';
            load_data(limit, start);
          }
          $(window).scroll(function() {
            var FRposition = $(window).scrollTop() + 300;
            var FRbottom = $(document).height() - $(window).height();
            if (FRposition >= FRbottom && action == 'inactive') {
              //toastr.error('FRD DATA LODING Initializing...  ');
              // action = 'active';
              // start = start + limit;
              // setTimeout(function() {
              //   load_data(limit, start);
              // }, 200);

              // document.documentElement.scrollTop = FRposition-500;
            }
          });
        }, 3000);
      //END>>

    });
  </script>
<?php } ?>





<script type="text/javascript">

  const FRc_CT_ItemSealPricee = '<?php echo "$FRc_CT_ItemSealPrice";?>';
  const FRc_CT_ItemIdd = '<?php echo "$FRc_CT_ItemId";?>';
  const FRc_CT_ItemNamee = '<?php echo "$FRc_CT_ItemName";?>';
  const FRc_CT_ItemCatNamee = '<?php echo "$FRc_CT_ItemCatName";?>';

 //FRD NEW DOCUMENT START:-
  $(document).ready(function() {

    $(".frtrig_aktu_poray_dakhun").unbind().click(function() {
      var FrPdfFileLink = $(this).attr("FrPdfFileLink");
      // alert(FrPdfFileLink);

      $.ajax({
        url: FR_HURL_APII + "/PdfFileView",
        method: "POST",
        data: {
          FrPdfFileLink: FrPdfFileLink
        },
        success: function(data) {
          $('#FR_SPIDER_MODEL_DATA').html(data);
          $('.modal-dialog').addClass('modal-lg modal-dialog-centered');
          $('#FR_SPIDER_MODEL').modal("show");
        }
      });

    });


    $(".frtrig_seemore_ratingreview").unbind().click(function() {
      var fr_rr_pro_id = $(this).attr("fr_rr_pro_id");
      // alert(FrPdfFileLink);
      $.ajax({
        url: FR_HURL_APII + "/SeeMoreRatingR",
        method: "POST",
        data: {
          fr_rr_pro_id: fr_rr_pro_id
        },
        success: function(data) {
          $('#FR_SPIDER_MODEL_DATA').html(data);
          $('.modal-dialog').addClass('modal-dialog-centered');
          $('#FR_SPIDER_MODEL').modal("show");
        }
      });
    });

  });
  //END>>



    var rating_data = 0;
    $('#add_review').click(function(){
        $('#review_modal').modal('show');
    });

    $(document).on('mouseenter', '.submit_star', function(){
        var rating = $(this).data('rating');
        reset_background();
        for(var count = 1; count <= rating; count++)
        {
            $('#submit_star_'+count).addClass('text-warning');
        }
    });
  
    function reset_background()
    {
        for(var count = 1; count <= 5; count++)
        {
            $('#submit_star_'+count).addClass('star-light');
            $('#submit_star_'+count).removeClass('text-warning');
        }
    }

    $(document).on('mouseleave', '.submit_star', function(){
        reset_background();
        for(var count = 1; count <= rating_data; count++)
        {
            $('#submit_star_'+count).removeClass('star-light');
            $('#submit_star_'+count).addClass('text-warning');
        }
    });

    $(document).on('click', '.submit_star', function(){
        rating_data = $(this).data('rating');
    });

</script>




<?php if($frtex_PixelTrack == 1){ ?>
<script>
    $(document).ready(function() {
    if (typeof fbq === "function") {
        fbq('track', 'ViewContent', {
            plugin: 'SpiderEcommerceFBPixel'
        });
    }
    });
</script>
<?php } ?>

<?php 
if($frtex_PixelTrack == 2){ 
  //extract(FRF_CATT_NAME($r_cat_1));
  $pro_bn_name = preg_replace("/'/","",$pro_bn_name);
  $FRc_PAGE_TITEL = preg_replace("/'/","",$FRc_PAGE_TITEL);
  $pro_catt1_name_bn = preg_replace("/'/","",$pro_catt1_name_bn);
?>
<script>
    $(document).ready(function() {
      if (typeof fbq === "function") {
          fbq('track', 'ViewContent', {
              currency: 'BDT',
              value: <?php echo "$pro_sells_price";?>,
              product_price: <?php echo "$pro_sells_price";?>,
              content_category: '<?php echo "$pro_catt1_name_bn";?>',
              category_name: '<?php echo "$pro_catt1_name_bn";?>',
              content_ids: '<?php echo "$product_id";?>',
              content_name: '<?php echo "$pro_bn_name";?>',
              content_type: 'product',
              content_url: '<?php echo "$FRc_THIS_PAGE_URL";?>',
              landing_page: '<?php echo "$FRc_THIS_PAGE_URL";?>',
              post_id: '<?php echo "$product_id";?>',
              post_type: 'product',
              user_role: 'guest',

              domain: '<?php echo "$FRD_HURL";?>',
              page_title: '<?php echo "$FRc_PAGE_TITEL";?>',
              event_url: '<?php echo "$FRc_THIS_PAGE_URL";?>',
              event_source_url: '<?php echo "$FRc_THIS_PAGE_URL";?>',
              event_day: '<?php echo "$FR_NOW_DAY_F";?>',
              event_month: '<?php echo "$FR_NOW_MONTH_F";?>',
              event_time: '<?php echo "$FR_NOW_TIME";?>',
              fbc: '<?php echo "$FRc_fbc";?>',
              fbp: '<?php echo "$FRc_fbp";?>',
              plugin: 'PixelYourSiteBySpider'
          },
          {
             event_id: "vc"+FRc_EVENT_IDD
          }
          );
      }
    });
</script>
<?php } ?>



<?php if($frtcplug_GTMdataLayer == 1){ ?>
<script>
  // window.dataLayer = window.dataLayer || [];
  dataLayer.push({
    ecommerce: null
  }); // Clear the previous ecommerce object.
  dataLayer.push({
    event: "view_item",
    client_id: "<?php echo "$FRc_USER_AGENT";?>",
    ip_override: "<?php echo "$FRc_USER_IP";?>",
    user_id: "<?php echo "$FRc_USER_UID";?>",
    plugin: "SpiderEcommerceGTM4DL",
    ecommerce: {
      currency: "BDT",
      value: <?php echo "$pro_sells_price";?>,
      items: [{
        item_id: "<?php echo "$cusl_pro_id"; ?>",
        item_name: "<?php echo "$pro_bn_name"; ?>",
        affiliation: "NA",
        coupon: "NA",
        currency: "BDT",
        price: <?php echo "$pro_sells_price"; ?>,
        discount: <?php echo "$pro_discount_amount"; ?>,
        index: 0,
        item_brand: "<?php echo "$pro_r_brand_name"; ?>",
        item_category: "<?php echo "$pro_catt1_name_bn"; ?>",
        item_category2: "<?php echo "$pro_catt2_name_bn"; ?>",
        item_category3: "<?php echo "$pro_catt3_name_bn"; ?>",
        item_category4: "<?php echo "$pro_catt4_name_bn"; ?>",
        item_list_id: "NA",
        item_list_name: "NA",
        item_variant: "<?php echo "$pro_r_color_name"; ?>",
        location_id: "NA",
        quantity: 1
      }]
    }
  });
</script>
<?php } ?>


<?php require_once("frd-public/theme/frd-footer.php");?>

<script>
  FrFunAddToCartManger();
</script>
