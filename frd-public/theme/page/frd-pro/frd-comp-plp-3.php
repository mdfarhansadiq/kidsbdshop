<style>
  img#xzoom-default{
     width: 340px;
  }
  @media screen and (max-width: 991px) {
    img#xzoom-default{
      width: 100%;
    }
  }


  .xzoom-thumbs img{
     width: 80px;
     margin-top: 10px;
  }
  @media screen and (max-width: 991px) {
    .xzoom-thumbs img{
      width: 70px;
    }
  }
</style>

<script type="text/javascript" src="<?php echo "$FRD_HURL/frd-src/inc/xzoom/xzoom.min.js"?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo "$FRD_HURL/frd-src/inc/xzoom/xzoom.min.css"?>" media="all" /> 


<div class="container plp">
      <div class="row">
        <div class="col-md-12">
            <?php
            //FRD CATEGORY PATH:- 
            if($frtc_catpath_dp == 1){
                echo "<h4>$FRc_CatPathHtml<h4>";
            }
            //END>> 
            if($frtc_pro_title_dp == 1){
                echo "<h1 class='protitle'>$bn_name</h1>";
            }
            ?>
        </div>
    </div>
</div>


<?php require_once("comp/frd-sec-video.php");?>


<div class="container plp3">


  <div class="row">

      <div class="col-md-5">
        <div class="xzoom-container">
          <img class="xzoom" id="xzoom-default" src="<?php echo "$FRD_HURL/frd-data/img/product/$pic_1";?>" xoriginal="<?php echo "$FRD_HURL/frd-data/img/product/$pic_1";?>" alt="<?php echo "$tagg";?>" />
          
          <div class="xzoom-thumbs">
            <a href="<?php echo "$FRD_HURL/frd-data/img/product/$pic_1";?>"><img class="xzoom-gallery" width="80" src="<?php echo "$FRD_HURL/frd-data/img/product/$pic_1";?>"  xpreview="<?php echo "$FRD_HURL/frd-data/img/product/$pic_1";?>" alt="<?php echo "$tagg";?>"></a>

            <?php
            if ($pic_2 !== "1.jpg") {
               echo "<a href='$FRD_HURL/frd-data/img/product/$pic_2'><img class='xzoom-gallery' src='$FRD_HURL/frd-data/img/product/$pic_2' alt='$tagg'></a>";
            }
            if ($pic_3 !== "1.jpg") {
               echo "<a href='$FRD_HURL/frd-data/img/product/$pic_3'><img class='xzoom-gallery' src='$FRD_HURL/frd-data/img/product/$pic_3' alt='$tagg'></a>";
            }
            if ($pic_4 !== "1.jpg") {
               echo "<a href='$FRD_HURL/frd-data/img/product/$pic_4'><img class='xzoom-gallery' src='$FRD_HURL/frd-data/img/product/$pic_4' alt='$tagg'></a>";
            }
            ?>
            
          </div>
        </div> 
      </div>



        <div class="col-md-7">
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
                  <script>
                    $(document).ready(function () {
                      FrFun_FlashSalesCD(FR_FLASH_SALES_END_TIME);
                    });
                  </script>
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
                if ($vry_typ == 2) { 
                $FRQ = $FR_CONN->query("SELECT * FROM frd_products WHERE statuss = 1 AND v_mp_id = $v_mp_id AND vry_typ = 2");
                foreach($FRQ->fetchAll() as $FR_ITEM){
                    extract($FR_ITEM);
                    echo "
                    <div class='color_vry_pro_sin'>
                        <a class='frd_tdn' href='$FRD_HURL/product/$id/$fr_slug'>
                        <img title='Click To See' src='$FRD_HURL/frd-data/img/product/$pic_1' alt=''class='img-rounded' width='50px' height='50px'>
                        </a>
                    </div>
                    ";
                }
                }
                ?>
            </div>
            </div>



          <br />
          <?php
           //FRD ORDER BUTTONS GROUPS:-
            if($frtc_on_btn_dp == 1){
              echo "<button class='sp_frdbtn_ordernow frsty_theme_super_btn frdtrig_atc btn btn-block btn-danger' id='$FRc_MP_IDx' ProVariaTyp='$vry_typ' FrAT='ordernow'><span class='glyphicon glyphicon-flash'></span>$frd_ordernow_txt</button>";
            }
            if($frtc_atc_btn_dp == 1){
              echo "<button class='sp_addtocart_btn frdtrig_atc' id='$FRc_MP_IDx' ProVariaTyp='$vry_typ' FrAT='addtocart'> <span class='glyphicon glyphicon-shopping-cart'></span> $addtocart_frd </button>";
            }
            if($frtc_wpo_btn_dp == 1){
              echo " <button class='sp_frdbtn_wao frdtrig_atc' id='$FRc_MP_IDx' ProVariaTyp='$vry_typ' FrAT='waorder'> <span class='fa-brands fa-whatsapp'></span> $fr_wporder_btn_txt </button>";
            }
            if($frtc_co_btn_dp == 1){
              echo " <button class='sp_frdbtn_co'> <span class='glyphicon glyphicon-phone'></span> <a href='tel:$fr_cmobile_1'>$fr_callorder_btn_txt <small>$fr_cmobile_1</small></a> </button>";
            }
          //END>>
          ?>




            <?php
            //FRD EXTAR ORDER NOW BUTTON:-
            if($frtc_order_btng2_dp == 1){
                if($frtc_on_btn_dp == 1){
                    echo "<button class='sp_frdbtn_ordernow frdtrig_atc btn btn-block btn-danger' id='$FRc_MP_IDx' ProVariaTyp='$vry_typ' FrAT='ordernow'><span class='glyphicon glyphicon-flash'></span>$frd_ordernow_txt</button>";
                }
                if($frtc_atc_btn_dp == 1){
                    echo "<button class='sp_addtocart_btn frdtrig_atc' id='$FRc_MP_IDx' ProVariaTyp='$vry_typ' FrAT='addtocart'> <span class='glyphicon glyphicon-shopping-cart'></span> $addtocart_frd </button>";
                }
                if($frtc_wpo_btn_dp == 1){
                    echo " <button class='sp_frdbtn_wao frdtrig_atc' id='$FRc_MP_IDx' ProVariaTyp='$vry_typ' FrAT='waorder'> <span class='fa-brands fa-whatsapp'></span> $fr_wporder_btn_txt </button>";
                }
                if($frtc_co_btn_dp == 1){
                    echo " <button class='sp_frdbtn_co'> <span class='glyphicon glyphicon-phone'></span> <a href='tel:$fr_cmobile_1'>$fr_callorder_btn_txt <small>$fr_cmobile_1</small></a> </button>";
                }
            }
            //END>>
            ?>
        </div>

  </div>
  <!--row end-->


</div>





<?php require_once("comp/frd-sec-long-description.php");?>



<?php require_once("comp/frd-sec-call-for-order.php");?>

<?php require_once("comp/frd-sec-rating-review.php");?>

<?php require_once("comp/frd-sec-offer-product.php");?>
<?php require_once("comp/frd-sec-related-product.php");?>

<?php require_once("comp/frd-sec-delivery-charge-hinks.php");?>
<?php require_once("comp/frd-sec-notes-for-customer.php");?>


<script type="text/javascript">
  $(document).ready(function() {

    //FRD AKTU PORAY DAKHUN:-
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
    //END>>

 
    $(".xzoom, .xzoom-gallery").xzoom({tint: '#333', Xoffset: 15});


  });
  //END>>
</script>

