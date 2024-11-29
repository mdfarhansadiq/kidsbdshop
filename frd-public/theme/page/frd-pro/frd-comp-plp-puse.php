<div class="container left_side sproduct_dislay_div">

  <!-- CAT PATH AND TITEL  -->
  <div class="row">
    <div class="col-md-12">
          <?php
          if($frtc_catpath_dp == 1){ echo "<h4>$FRc_CatPathHtml<h4>"; }
          if($frtc_pro_title_dp == 1){ echo "<h1 class='protitle'>$bn_name</h1>";}
          ?>
    </div>
  </div>




  <?php if ($videoo !== "") { ?>
   <!-- VIDEO SECTION  -->
   <style>
        .ProductVideoSec{
           display: none;
        }
        .ProductVideoSec iframe{
            width: 760px;
            height: 400px;
            background: #333333;
            border-radius: 8px;
            padding: 15px;
            box-shadow: rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px;
            cursor: pointer;
        }


        /* responcive  */
        @media only screen and (max-width: 414px) and (min-width: 375px){
          .ProductVideoSec iframe {
                margin-top: 80px;
                width: 100%;
                height: 300px;
            }
        }
        @media only screen and (max-width: 360px) and (min-width: 280px){
          .ProductVideoSec iframe {
                width: 100%;
                height: 270px;
            }
        }
        @media only screen and (max-width: 768px) and (min-width: 540px) {
          .ProductVideoSec iframe {
                width: 100%;
                height: 350px;
            }
        }
        @media only screen and (max-width: 280px) {
          .ProductVideoSec iframe {
                width: 100%;
                height: 250px;
            }
        }
    </style>
   <div class="row ProductVideoSec">
    <div class="col-md-2"></div>
    <div class="col-md-12 text-center">
    <!-- <iframe id='ProductVideo' width='100%' height='330px' src='' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe -->
       <iframe id="ProductVideo" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    </div>
    <div class="col-md-2"></div>
   </div>
   <script>
    $(document).ready(function(){
      setTimeout(function() {
          $("#ProductVideo").attr("src", 'https://www.youtube.com/embed/'+FRc_ProductVideoo);
          $(".ProductVideoSec").show();
      }, 2000);
    });
   </script>
  <?php } ?> 



    <!-- IMGAGES  -->
    <div class="row">
      <div class="col-md-12">
        <div class="owl-carousel owl-theme fr_oc_pro_slider pointer TAC">
          <?php
           echo "
           <div class='item'>
               <img class='img-responsive' src='$FRD_HURL/frd-data/img/product/$pic_1' alt='$tagg'/>
            </div>
           ";

            if ($pic_2 !== "1.jpg") {
              echo " 
              <div class='item'>
                <img class='img-responsive' src='$FRD_HURL/frd-data/img/product/$pic_2' alt='$tagg' />
              </div>
              ";
            }

            if ($pic_3 !== "1.jpg") {
              echo " 
              <div class='item'>
                <img class='img-responsive' src='$FRD_HURL/frd-data/img/product/$pic_3' alt='$tagg' />
              </div>
              ";
            }

            if ($pic_4 !== "1.jpg") {
              echo " 
              <div class='item'>
                <img class='img-responsive' src='$FRD_HURL/frd-data/img/product/$pic_4' alt='$tagg' />
              </div>
              ";
            }
          ?>
                      
        
        </div>
      </div>
    </div>





  <!-- MINI INFO  -->
  <br>
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 jumbotron">
            <!-- FLASH SALES ALERT  -->
            <?php 
                if($fr_flash_sale == 1){
                $FRc_FLASH_SELLS_TIME_SRT = strtotime("$FR_FLASH_SELLS_TIME");
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
              echo "<img src='$FRD_HURL/frd-public/theme/asset/img/alert-free-delevery.gif' alt='#' style='max-height:100px;width:auto;margin:auto;'>";
            }
            ?>
          </div>
          <!-- DELIVERY CHARGE FREE E -->


          <?php if ($discount_pri > 0) {
            echo "<span class='market_price'><del> $FRc_MarketPrice $frlc_tksymbol_txt </del> &#160;&#160;</span>";
          } ?>
          <span class="sells_price"><?php echo $FRc_SalesPrice ?> <?php echo "$frlc_tksymbol_txt";?> </span> <br>
          <?php 
          if($frtc_pro_id_dp == 1){
            echo "<span class='deal_code'><b>🎁 $frlc_product_id_tx:</b> $FRc_ProductIdx </span> <br>";
          }
          if ($skuu !== "") {
            echo "<span><b>🎁 $frlc_product_sku_tx:</b> $skuu </span> <br>";
          } 
          if($FRc_COLOR_NAME != "" AND $FRc_COLOR_NAME != "N/A"){
              echo "<span><b>$frlc_product_color_tx:</b> $FRc_COLOR_NAME </span> <br>";
          }
          if($frtc_pro_view_dp == 1){
              echo " <span class='pro_viewed'> <b>$frlc_view_tx:</b> $vieww </span> <br>";
          }
          if($frtc_pro_instock_dp == 1){
            echo "<span class=''>$FRc_StockStatusText</span> <br>";
          }
          ?>
    </div>
    <div class="col-md-2"></div>
  </div>



    <!-- COLOR VARIATION PRODUCT SHOWING - WITH ORDERS BUTTONS -->
    <?php if ($vry_typ == 2) {  ?>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 jumbotron">

          <div class='frUsrList1'>
              <div class='table-responsivex'>
                  <table class='table user-list'>
                      <tbody>
            <?php
              $FRQ = $FR_CONN->query("SELECT * FROM frd_products WHERE statuss = 1 AND v_mp_id = $FRc_MP_IDx AND vry_typ = 2");

              foreach($FRQ->fetchAll() as $FR_ITEM){
                extract($FR_ITEM);
                $sells_pri_exp = explode('.', $sells_pri);
                $FRc_SalesPricePoisa = $sells_pri_exp[1];
                //++
                $FRc_SalesPrice = number_format($sells_pri);
                if($FRc_SalesPricePoisa > 0){
                    $FRc_SalesPrice = number_format($sells_pri,2);
                }
                
                $FRc_StockOut_HTML = "";
                $FRc_c1 = "";
                if($qtyy == 0){$FRc_StockOut_HTML = "<span class='label label-danger'>out of stock</span>"; $FRc_c1 = "frd_dn";}

                $bn_name = preg_replace("/'/","",$bn_name);

                $FRc_ON_Button_HTML = "";
                $FRc_ATC_Button_HTML = "";
                $FRc_W_Button_HTML = "";

                extract(FRF_COLOR_NAME($r_color));

                if($frtc_on_btn_dp == 1){
                  $FRc_ON_Button_HTML = "<button class='frbtn_vp_atc btn btn-success btn-xs btn-block frdtrig_atc $FRc_c1' id='$id' ProVariaTyp='1' FrAT='ordernow'><span class='glyphicon glyphicon-flash'></span>$frd_ordernow_txt</button>";
                }
                if($frtc_atc_btn_dp == 1){
                  $FRc_ATC_Button_HTML = "<br> <button class='frbtn_vp_atc btn btn-primary btn-xs btn-block frdtrig_atc $FRc_c1' id='$id' ProVariaTyp='1' FrAT='addtocart'><span class='glyphicon glyphicon-shopping-cart'></span> $addtocart_frd</button>";
                }
                
                if($frtc_wpo_btn_dp == 1){
                  $FRc_W_Button_HTML = "
                  <br>
                  <a class='$FRc_c1' href='https://wa.me/$fr_whatsapp?text=Hi $fr_cname I Want To Buy $bn_name \n Size: $siz_name \n Price: $sells_pri ৳ \n $FRD_HURL/product/$id/$fr_slug' target='_blank'>
                      <button class='btn btn-success btn-xs btn-block frbtn_wao_vp_atc'><span class='fa-brands fa-whatsapp'></span> $fr_wporder_btn_txt </button>
                  </a>
                  ";
                }
                
                
                echo "
                    <tr>
                        <td>
                          <a class='frd_tdn' href='$FRD_HURL/product/$id/$fr_slug'>
                            <img title='Click To See' src='$FRD_HURL/frd-data/img/product/$pic_1' alt=''class='img-rounded' width='60px' height='60px'>
                          </a> <br>
                          $FRc_COLOR_NAME <br>   ৳ $FRc_SalesPrice
                        </td>
                        <td class='text-right' width='30px'>
                            $FRc_ON_Button_HTML
                            $FRc_ATC_Button_HTML
                            $FRc_W_Button_HTML
                            $FRc_StockOut_HTML
                        </td>
                    </tr>
                ";
              }
            ?>
                    </tbody>
                  </table>
              </div>
          </div>

      </div>
      <div class="col-md-2"></div>
    </div>
    <?php } ?>






    <!-- SIZE VARIATION PRODUCT SHOWING WITH ORDERS BUTTONS -->
    <?php if ($vry_typ == 3) {  ?>
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 jumbotron">

          <div class='frUsrList1'>
              <div class='table-responsive'>
                  <table class='table user-list'>
                      <tbody>
            <?php
              $FRQ = $FR_CONN->query("SELECT * FROM frd_products WHERE statuss IN(1,2) AND v_mp_id = $FRc_MP_IDx AND vry_typ = 3");

              foreach($FRQ->fetchAll() as $FR_ITEM){
                extract($FR_ITEM);
                $sells_pri_exp = explode('.', $sells_pri);
                $FRc_SalesPricePoisa = $sells_pri_exp[1];
                //++
                $FRc_SalesPrice = number_format($sells_pri);
                if($FRc_SalesPricePoisa > 0){
                    $FRc_SalesPrice = number_format($sells_pri,2);
                }
                
                $FRc_StockOut_HTML = "";
                $FRc_c1 = "";
                if($qtyy == 0){$FRc_StockOut_HTML = "<span class='label label-danger'>out of stock</span>"; $FRc_c1 = "frd_dn";}

                $bn_name = preg_replace("/'/","",$bn_name);

                $FRc_ON_Button_HTML = "";
                $FRc_ATC_Button_HTML = "";
                $FRc_W_Button_HTML = "";

                if($frtc_on_btn_dp == 1){
                  $FRc_ON_Button_HTML = "<button class='frbtn_vp_atc btn btn-success btn-xs btn-block frdtrig_atc $FRc_c1' id='$id' ProVariaTyp='1' FrAT='ordernow'><span class='glyphicon glyphicon-flash'></span>$frd_ordernow_txt</button>";
                }
                if($frtc_atc_btn_dp == 1){
                  $FRc_ATC_Button_HTML = "<br> <button class='frbtn_vp_atc btn btn-primary btn-xs btn-block frdtrig_atc $FRc_c1' id='$id' ProVariaTyp='1' FrAT='addtocart'><span class='glyphicon glyphicon-shopping-cart'></span> $addtocart_frd</button>";
                }
                
                if($frtc_wpo_btn_dp == 1){
                  $FRc_W_Button_HTML = "
                  <br>
                  <a class='$FRc_c1' href='https://wa.me/$fr_whatsapp?text=Hi $fr_cname I Want To Buy $bn_name \n Size: $siz_name \n Price: $sells_pri ৳ \n $FRD_HURL/product/$id/$fr_slug' target='_blank'>
                      <button class='btn btn-success btn-xs btn-block frbtn_wao_vp_atc'><span class='fa-brands fa-whatsapp'></span> $fr_wporder_btn_txt </button>
                  </a>
                  ";
                }
                
                

                echo "
                    <tr>
                        <td><h3>$siz_name</h3>  <h6>৳ $FRc_SalesPrice</h6></td>
                        <td class='text-right' width='30px'>
                            $FRc_ON_Button_HTML
                            $FRc_ATC_Button_HTML
                            $FRc_W_Button_HTML
                            $FRc_StockOut_HTML
                        </td>
                    </tr>
                ";
              }
            ?>
                    </tbody>
                  </table>
              </div>
          </div>

      </div>
      <div class="col-md-2"></div>
    </div>
    <?php } ?>






  <!-- ORDER BUTTON GROUP 1  -->
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 jumbotron">
        <?php

          if ($vry_typ == 1) {
              if($frtc_on_btn_dp == 1){
              echo "<button class='sp_frdbtn_ordernow frdtrig_atc btn btn-block btn-danger' id='$FRc_MP_IDx' ProVariaTyp='$vry_typ' FrAT='ordernow'><span class='glyphicon glyphicon-flash'></span>$frd_ordernow_txt</button>";
              }
              if($frtc_atc_btn_dp == 1){
                echo "<button class='sp_addtocart_btn frdtrig_atc' id='$FRc_MP_IDx' ProVariaTyp='$vry_typ' FrAT='addtocart'> <span class='glyphicon glyphicon-shopping-cart'></span> $addtocart_frd </button>";
              }
              if($frtc_wpo_btn_dp == 1){
                echo " <button class='sp_frdbtn_wao frdtrig_atc' id='$FRc_MP_IDx' ProVariaTyp='$vry_typ' FrAT='waorder'> <span class='fa-brands fa-whatsapp'></span> $fr_wporder_btn_txt </button>";
              }
          }

          if($frtc_co_btn_dp == 1){
            echo " <button class='sp_frdbtn_co'> <span class='glyphicon glyphicon-phone'></span> <a href='tel:$fr_cmobile_1'>$fr_callorder_btn_txt <small>$fr_cmobile_1</small></a> </button>";
          }
        //END>>
        ?>
    </div>
    <div class="col-md-2"></div>
  </div>




  <!-- LONG DESCRIPTION  -->
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 jumbotron">
          <style>
            div.div_long_description img{
                width: 100% !important;
            }
          </style>
          <!-- PRODUCT DETAILS DESCRIPTION  -->
          <div class="div_long_description">
            <article>
              <?php
              echo "<h2 class='text-center boldd'>$bn_name</h2>";
              echo "$FRc_LongDescription";

              // if ($FRc_Pic_1 !== "1.jpg") {
              //   echo "<br> <img class='img-responsive' src='$FRD_HURL/frd-data/img/product/$FRc_Pic_1' alt='$tagg' />";
              // }
              // if ($FRc_Pic_2 !== "1.jpg") {
              //   echo "<br> <img class='img-responsive' src='$FRD_HURL/frd-data/img/product/$FRc_Pic_2' alt='$tagg' />";
              // }
              // if ($FRc_Pic_3 !== "1.jpg") {
              //   echo "<br>  <img class='img-responsive' src='$FRD_HURL/frd-data/img/product/$FRc_Pic_3' alt='$tagg' />";
              // }
              // if ($FRc_Pic_4 !== "1.jpg") {
              //   echo "<br>  <img class='img-responsive' src='$FRD_HURL/frd-data/img/product/$FRc_Pic_4' alt='$tagg' /> ";
              // }
              ?>

            </article>
          </div>
    </div>
    <div class="col-md-2"></div>
  </div>



  <!-- ORDER BUTTON GROUP 2  -->
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <?php
            if($frtc_order_btng2_dp == 1){

                if ($vry_typ == 1) {
                  if($frtc_on_btn_dp == 1){
                  echo "<button class='sp_frdbtn_ordernow frdtrig_atc btn btn-block btn-danger' id='$FRc_MP_IDx' ProVariaTyp='$vry_typ' FrAT='ordernow'><span class='glyphicon glyphicon-flash'></span>$frd_ordernow_txt</button>";
                  }
                  if($frtc_atc_btn_dp == 1){
                    echo "<button class='sp_addtocart_btn frdtrig_atc' id='$FRc_MP_IDx' ProVariaTyp='$vry_typ' FrAT='addtocart'> <span class='glyphicon glyphicon-shopping-cart'></span> $addtocart_frd </button>";
                  }
                  if($frtc_wpo_btn_dp == 1){
                    echo " <button class='sp_frdbtn_wao frdtrig_atc' id='$FRc_MP_IDx' ProVariaTyp='$vry_typ' FrAT='waorder'> <span class='fa-brands fa-whatsapp'></span> $fr_wporder_btn_txt </button>";
                  }
                }


                if($frtc_co_btn_dp == 1){
                  echo " <button class='sp_frdbtn_co'> <span class='glyphicon glyphicon-phone'></span> <a href='tel:$fr_cmobile_1'>$fr_callorder_btn_txt <small>$fr_cmobile_1</small></a> </button>";
                }
            }
          //END>>
          ?>
    </div>
    <div class="col-md-2"></div>
  </div>
</div>


<?php require_once("comp/frd-sec-call-for-order.php");?>

<?php require_once("comp/frd-sec-rating-review.php");?>

<?php require_once("comp/frd-sec-instant-checkout-form.php");?>

<?php require_once("comp/frd-sec-related-product.php");?>


<hr>
<?php require_once("comp/frd-sec-delivery-charge-hinks.php");?>
<?php require_once("comp/frd-sec-notes-for-customer.php");?>





<script type="text/javascript">
      $(document).ready(function(){
        /////////////////////////////////////////// 
        //FRD POPULER CATEGORY OWL CAROSOL  
        ///////////////////////////////////////////  
        $('.fr_oc_pro_slider').owlCarousel({
                loop:true,
                margin:10,
                nav:false,
                autoplay:true,
                autoplayTimeout:3000,
                autoplayHoverPause:true,
                smartSpeed: 1000,
                dots:true,    
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:4
                    },
                    1000:{
                        items:4
                    }
                }
        });
         //END>>
      });//F D R E    
</script>