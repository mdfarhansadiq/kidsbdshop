<style>
  .lp2_btn_want_to_order {
    font-weight: bold;
    font-size: 20px;
  }
</style>


<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 class="plp2_protitle" style="text-align: center !important;"><b><?php echo "$bn_name" ?></b></h2>
    </div>
  </div>
</div>

<?php require_once("comp/frd-sec-video.php"); ?>


<div class="container">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 jumbotron">
      <a href="#CheckOutFormPosi" class='fr-text-deco-none'>
        <button class="btn btn-success btn-block lp2_btn_want_to_order frsty_theme_super_btn"> অর্ডার করতে চাই <span class="glyphicon glyphicon-arrow-down"></span></button>
      </a>
    </div>
    <div class="col-md-2"></div>
  </div>
</div>

<!-- IMGAGES SECTION -->
<div class="container">
  <style>
    h2.plp2_protitle {
      font-size: 30px;
      text-align: center !important;
      /**/
    }

    @media screen and (max-width: 991px) {
      h2.plp2_protitle {
        font-size: 18px;
        text-align: center !important;
        /**/
      }
    }

    .plp2_market_price {
      font-size: 20px;
    }

    .plp2_sales_price {
      font-size: 25px;
    }
  </style>
  <div class="row">
    <div class="col-md-12 jumbotron">
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

      <div class="text-center boldd">
        <h2>
          <?php
          if ($discount_pri > 0) {
            echo "<span class='market_price plp2_market_price'><del> $FRc_MarketPrice $frlc_tksymbol_txt </del> &#160;&#160;</span>";
          }
          ?>
          <span class="sells_price plp2_sales_price"><?php echo "$FRc_SalesPrice" ?></span> <?php echo "$frlc_tksymbol_txt"; ?>
        </h2>
      </div>

      <!-- FLASH SALES ALERT  -->
      <?php
      if ($fr_flash_sale == 1) {
        $FRc_FLASH_SELLS_TIME_SRT = strtotime("$FR_FLASH_SELLS_TIME");
        if ($FR_FLASH_SELLS_MODE == "FRON") {
          if ($FRc_FLASH_SELLS_TIME_SRT > $FR_NOW_TIME) {
      ?>
            <div class="row row_flassaletimer">
              <div id='FRcountDownX' class="col-xs-12 text-center">
                <h4 class="text-center c_title"><span class='glyphicon glyphicon-flash pip_pip_1s'></span> <?php echo "$frtc_flash_sales_txt"; ?></h4>
                <div class="frcountdownnum" id="countdown">
                  <ul>
                    <li><span id="FRdays"></span> <i><?php echo "$frtc_flash_sales_days_txt"; ?></i> </li>
                    <li><span id="FRhours"></span> <i><?php echo "$frtc_flash_sales_hours_txt"; ?></i> </li>
                    <li><span id="FRminutes"></span> <i><?php echo "$frtc_flash_sales_minutes_txt"; ?></i> </li>
                    <li><span id="FRseconds"></span> <i><?php echo "$frtc_flash_sales_second_txt"; ?></i> </li>
                  </ul>
                </div>
              </div>
            </div>
            <script>
              $(document).ready(function() {
                FrFun_FlashSalesCD(FR_FLASH_SALES_END_TIME);
              });
            </script>
      <?php }
        }
      } ?>


      <!-- DELIVERY CHARGE FREE S -->
      <div class="text-center">
        <?php
        if ($deli_crg_typ == 2 && $frtc_delifreeimg_s_dp == 1) {
          echo "<img src='$FRD_HURL/frd-public/theme/asset/img/alert-free-delevery.gif' alt='#' style='max-height:100px;width:auto;margin:auto;'>";
        }
        ?>
      </div>
      <!-- DELIVERY CHARGE FREE E -->

      <br>
      <a href="#CheckOutFormPosi" class='fr-text-deco-none'>
        <button class="btn btn-success btn-block frsty_theme_super_btn lp2_btn_want_to_order"> অর্ডার করতে চাই <span class="glyphicon glyphicon-arrow-down"></span></button>
      </a>

    </div>
  </div>
</div>



<?php require_once("comp/frd-sec-long-description.php"); ?>


<div class="container">
  <div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8 jumbotron">
      <a href="#CheckOutFormPosi" class='fr-text-deco-none'>
        <button class="btn btn-success btn-block lp2_btn_want_to_order frsty_theme_super_btn"> অর্ডার করতে চাই <span class="glyphicon glyphicon-arrow-down"></span></button>
      </a>
    </div>
    <div class="col-md-2"></div>
  </div>
</div>






<?php require_once("comp/frd-sec-rating-review.php"); ?>






<!-- COLOR VARIATION SHOWING -->
<div class="container">
  <?php if ($vry_typ == 2) {  ?>
    <div class="row">
      <style>
        .plp3-size-radio {
          display: none;
          /* Hide the default radio button */
        }

        .plp3-size-radio+.plp3-size-label {
          display: inline-block;
          padding: 10px 20px;
          margin: 5px;
          border: 2px solid #ccc;
          border-radius: 5px;
          cursor: pointer;
          transition: background-color 0.3s, border-color 0.3s;
          width: 100%;
        }

        .plp3-size-radio:checked+.plp3-size-label {
          background-color: #007bff;
          color: #fff;
          border-color: #007bff;
        }
      </style>
      <div class="col-md-2"></div>
      <div class="col-md-8 jumbotron">
        <h3><b>অর্ডার করার পূর্বে কালার নির্বাচন করুন:-</b></h3>
        <?php
        $FRQ = $FR_CONN->query("SELECT * FROM frd_products WHERE statuss IN(1,2) AND v_mp_id = $FRc_MP_IDx AND vry_typ = 2");
        foreach ($FRQ->fetchAll() as $FR_ITEM) {
          extract($FR_ITEM);

          $sells_pri_exp = explode('.', $sells_pri);
          $FRc_SalesPricePoisa = $sells_pri_exp[1];
          $FRc_SalesPrice = number_format($sells_pri);
          if ($FRc_SalesPricePoisa > 0) {
            $FRc_SalesPrice = number_format($sells_pri, 2);
          }

          extract(FRF_COLOR_NAME($r_color));

          echo "
        <div class='plp3-size-container' style='display: flex; align-items: center; gap: 15px; margin-bottom: 10px;'>
            <input type='radio' name='f_size_name' id='$id' value='$id' saleprice='$FRc_SalesPrice' val_sizename='$FRc_COLOR_NAME' class='plp3-size-radio f_size_name_id'>
            <label for='$id' class='plp3-size-label' style='display: flex; align-items: center; gap: 10px;'>
                <img src='$FRD_HURL/frd-data/img/product/$pic_1' alt='#' style='width:50px; height:50px;'> 
                $FRc_COLOR_NAME
            </label>
            <input type='number' name='quantity_$id' id='quantity_$id' min='1' value='1' class='plp3-quantity-input' style='width: 60px;' placeholder='Qty'>
        </div>
    ";
        }
        ?>

      </div>
      <div class="col-md-2"></div>
    </div>
  <?php } ?>
</div>



<!-- SIZE VARIATION SHOWING -->
<div class="container">
  <?php if ($vry_typ == 3) {  ?>
    <div class="row">
      <style>
        .plp3-size-radio {
          display: none;
          /* Hide the default radio button */
        }

        .plp3-size-radio+.plp3-size-label {
          display: inline-block;
          padding: 10px 20px;
          margin: 5px;
          border: 2px solid #ccc;
          border-radius: 5px;
          cursor: pointer;
          transition: background-color 0.3s, border-color 0.3s;
          width: 100%;
        }

        .plp3-size-radio:checked+.plp3-size-label {
          background-color: #007bff;
          color: #fff;
          border-color: #007bff;
        }
      </style>
      <div class="col-md-2"></div>
      <div class="col-md-8 jumbotron">
        <h3><b>অর্ডার করার পূর্বে নির্বাচন করুন:-</b></h3>
        <?php
        $FRQ = $FR_CONN->query("SELECT * FROM frd_products WHERE statuss IN(1,2) AND v_mp_id = $FRc_MP_IDx AND vry_typ = 3");
        foreach ($FRQ->fetchAll() as $FR_ITEM) {
          extract($FR_ITEM);

          $sells_pri_exp = explode('.', $sells_pri);
          $FRc_SalesPricePoisa = $sells_pri_exp[1];
          $FRc_SalesPrice = number_format($sells_pri);
          if ($FRc_SalesPricePoisa > 0) {
            $FRc_SalesPrice = number_format($sells_pri, 2);
          }

          echo "
        <div class='plp3-size-container' style='display: flex; align-items: center; gap: 15px; margin-bottom: 10px;'>
            <input type='radio' name='f_size_name' id='$id' value='$id' saleprice='$FRc_SalesPrice' val_sizename='$siz_name' class='plp3-size-radio f_size_name_id'>
            <label for='$id' class='plp3-size-label'>$siz_name - <small>$frlc_tksymbol_txt $FRc_SalesPrice</small></label>
            <input type='number' name='quantity_$id' id='quantity_$id' min='1' value='1' class='plp3-quantity-input' style='width: 60px;' placeholder='Qty'>
        </div>
    ";
        }
        ?>

      </div>
      <div class="col-md-2"></div>
    </div>
  <?php } ?>
</div>




<div id="CheckOutFormPosi"></div>
<!-- FRD INSTANK CHECKOUT FOEM  -->
<section>
  <div class="container">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 jumbotron">
        <div id="FR_DATA_ORDER_FORM"></div>
      </div>
      <div class="col-md-2"></div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      setTimeout(function() {
        let FRc_ProductQuantity = $("input[name='quantity_" + FRc_ProductIdxx + "']").val(); // Fetch the quantity value
        $.ajax({
          url: FRD_HURLL + "/frd-public/theme/api/frdapi-PopupCheckoutForm.php",
          method: "POST",
          data: {
            f_product_id: FRc_ProductIdxx,
            f_spiderecommerce: FRD_HURLL,
            f_product_quantity: FRc_ProductQuantity,
          },
          success: function(data) {
            $("#FR_DATA_ORDER_FORM").html(data);
          },
        });
      }, 0);
    }); //F D R E
  </script>
  <script>
    $(document).ready(function() {
      // Listen for changes in quantity input fields with dynamic IDs
      $(document).on('input', "input[name^='quantity_']", function() {
        let FRc_ProductIdxx = $(this).attr('name').split('_')[1]; // Extract product ID from name='quantity_$id'
        let FRc_ProductQuantity = $(this).val(); // Get the updated quantity value

        $.ajax({
          url: FRD_HURLL + "/frd-public/theme/api/frdapi-PopupCheckoutForm.php",
          method: "POST",
          data: {
            f_product_id: FRc_ProductIdxx,
            f_spiderecommerce: FRD_HURLL,
            f_product_quantity: FRc_ProductQuantity,
          },
          success: function(data) {
            $("#FR_DATA_ORDER_FORM").html(data);
            let FRc_Price = parseInt(document.getElementById("f_CHECKOUT_T_BILLL").value) * FRc_ProductQuantity;
            $("#FR_CHECKOUT_T_BILL_DATA").html(FRc_Price);
            $("#f_CHECKOUT_T_BILLL").val(FRc_Price);
          },
        });
      });
    });
  </script>
</section>





<section>
  <style>
    .frbtn-fb-waorder {
      background-color: #25D366;
      color: #fff;
      font-size: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }

    .frbtn-fb-waorder:hover {
      background-color: #1EBE56;
    }

    .frbtn-fb-messengerorder {
      background-color: #0084ff;
      color: #fff;
      font-size: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }

    .frbtn-fb-messengerorder:hover {
      background-color: #006bbf;
    }
  </style>
  <div class="container lp2_wp_mess_ord_btn_sec">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 jumbotron">
        <?php
        echo "
            <a class='fr-text-deco-none FrWaOrderLink' href='https://wa.me/$fr_whatsapp?text=Hi $fr_cname I Want To Buy $FRc_CT_ItemName \n Size: $FRc_SizeNamex \n Price: $FRc_SalesPricex ৳ \n $FRD_HURL/product/$FRc_ProductIdx/$fr_slug' target='_blank'>
               <button class='btn btn-success btn-block frbtn-fb-waorder'><span class='fa-brands fa-whatsapp'></span> $fr_wporder_btn_txt </button>
            </a>
            ";
        echo "
            <br>
            <a class='fr-text-deco-none FrFbMessOrderLink' href='$fr_messenger_link?text=Hi $fr_cname I Want To Buy $FRc_CT_ItemName \n Size: $FRc_SizeNamex \n Price: $FRc_SalesPricex ৳ \n $FRD_HURL/product/$FRc_ProductIdx/$fr_slug' target='_blank'>
               <button class='btn btn-success btn-block frbtn-fb-messengerorder'><span class='fa-brands fa-facebook-messenger'></span> মেসেঞ্জার অর্ডার </button>
            </a>
            ";
        ?>
      </div>
      <div class="col-md-2"></div>
    </div>
  </div>
</section>






<script type="text/javascript">
  $(document).ready(function() {

    $(".f_size_name_id").on("click", function() {
      let f_product_id = $(this).attr("value");
      let f_product_price = $(this).attr("saleprice");
      let val_sizename = $(this).attr("val_sizename");
      let f_product_quantity = $("input[name='quantity_" + f_product_id + "']").val();
      $(".sells_price").html(f_product_price);
      $(".f_product_id").attr('value', f_product_id);
      $(".f_CHECKOUT_T_BILLL").attr('value', f_product_price);
      $(".FR_CHECKOUT_T_BILL_DATA").html(f_product_price);

      let link = 'https://wa.me/' + FRc_Whatsappp + '?text=Hi ' + FRc_Cnamee + ' I Want To Buy ' + FRc_CT_ItemNamee + ' \n Size: ' + val_sizename + ' \n Price: ' + f_product_price + ' ৳ \n Quantity: ' + f_product_quantity + ' \n ' + FRD_HURLL + '/product/' + f_product_id + '/ ' + FRc_ProductSlug + '';
      $(".FrWaOrderLink").attr('href', link);

      let link2 = fr_messenger_linkk + '?text=Hi ' + FRc_Cnamee + ' I Want To Buy ' + FRc_CT_ItemNamee + ' \n Size: ' + val_sizename + ' \n Price: ' + f_product_price + ' ৳ \n ' + FRD_HURLL + '/product/' + f_product_id + '/ ' + FRc_ProductSlug + '';
      $(".FrFbMessOrderLink").attr('href', link2);
    });

    /////////////////////////////////////////// 
    //FRD POPULER CATEGORY OWL CAROSOL  
    ///////////////////////////////////////////  
    $('.fr_oc_pro_slider').owlCarousel({
      loop: true,
      margin: 10,
      nav: false,
      autoplay: true,
      autoplayTimeout: 3000,
      autoplayHoverPause: true,
      smartSpeed: 1000,
      dots: true,
      responsive: {
        0: {
          items: 1
        },
        600: {
          items: 4
        },
        1000: {
          items: 4
        }
      }
    });
    //END>>
  }); //F D R E    
</script>