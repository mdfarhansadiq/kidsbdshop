<?php
$FRQ = $FR_CONN->query("SELECT frlc_carthide_txt,frlc_cartviewitem_txt ,frlc_tksymbol_txt,frlc_cartitems_txt,frlc_cartcheckout_1_txt,frlc_cartcheckout_2_txt FROM frd_themelan WHERE frlc_lang = '".$_SESSION['FRs_frtc_lang']."'");
extract($FRQ->fetch());

?>
<div class="frcart1">

    <div class="text-center frlogo_div">
        <a href="<?php echo $FRD_HURL ?>">
            <img title="Go To Home Page" id="frlogo" src="<?php echo "$FRD_HURL/frd-data/img/brandlogu/".$_SESSION['FRs_fr_clogo'].""; ?>" alt="Logo" style='height:auto;width:150px;margin:auto;'>
        </a>
    </div>

  <table class=carthead>
    <tr>
      <td>
        <h4 class='cart_title'> &#160; <span class="glyphicon glyphicon-shopping-cart alertt"></span> <span> <span id="cart_itemss2"></span> <?php echo "$frlc_cartitems_txt";?> </span> <small>[ <span class='carttotal'> <?php echo "$frlc_tksymbol_txt";?> <span id='cart_pricee2'></span></span> ]</small> </h4>
      </td>
      <td class="TAR"><button class="btn_cartclose FRtrig_CartClose" id="sidenaveclosebtn_right"><span class="glyphicon glyphicon-remove alertt"> </span> <?php echo "$frlc_carthide_txt";?></button> &#160; </td>
    </tr>
  </table>


  <?php 
  if (isset($_SESSION['FRs_Invo_Token'])){ ?>
    <div class='cart_items'>
      <table class='t_cartt'>
        <?php
          $FRs_Invo_Tokenn = $_SESSION['FRs_Invo_Token'];

          //FRD CHECKOUT TRIGER 1:-
          echo "<a class='frd_tdn' href='$FRD_HURL/checkout'><button class='btn_chackout'> &#160; $frlc_cartcheckout_2_txt <span class='glyphicon glyphicon-forward'></span> </button></a> <br><br>";


          //FRD USER PROFILE DATA:-
          $FRR = FR_QSEL("SELECT * FROM frd_order_items WHERE fr_invo_id = $FRs_Invo_Tokenn AND fr_stat = 0 ORDER BY id DESC", "ALL");
          if ($FRR['FRA'] == 1) {
            $FRc_CartItems = 0;
            $FRc_CartItemsTotalPrice = 0;
            foreach ($FRR['FRD'] as $FR_ITEM) {
              extract($FR_ITEM);

              $fr_t_price_exp = explode('.', $fr_t_price);
              $FRc_ItemTotalPricePoisa = $fr_t_price_exp[1];
              //++
              $FRc_ItemTotalPrice = number_format($fr_t_price);
              if($FRc_ItemTotalPricePoisa > 0){
                  $FRc_ItemTotalPrice = number_format($fr_t_price,2);
              }

              // COLOE NAME FINDER
              $FRQ = $FR_CONN->query("SELECT en_name FROM frd_colorr WHERE id = $r_color");
              $row_cnf_bx = $FRQ->fetch();
              $cus_color_en_name = $row_cnf_bx['en_name'];
              // SLUG NAME FINDER
              $FRQ = $FR_CONN->query("SELECT fr_slug FROM frd_products WHERE id = $fr_pro_id");
              extract($FRQ->fetch());
              // ORDER SIZE CUSTOMIZE 
              if ($fr_size_name == "") {
                $order_size_name_lmody = "";
              } else {
                $order_size_name_lmody = " | সাইজ: $fr_size_name";
              }
        ?>


              <tr>
                <td width="20px" class="text-center">
                  <span class="pro_qtyup_btn Frtrig_CartQtyUp glyphicon glyphicon-plus" value="<?php echo "$id"; ?>"></span><br />
                  <span class="cpro_qty"><?php echo "$fr_qty"; ?></span><br />
                  <span class="pro_qtydown_btn Frtrig_CartQtyDown  glyphicon glyphicon-minus" id="<?php echo "$id"; ?>"></span>
                </td>
                <td width="70px" class="text-center">
                  <img class="item-img" src="<?php echo "$FRD_HURL/frd-data/img/product/$fr_pro_pic_1"; ?>" alt="" class="img-responsive">
                </td>
                <td class="item_title">
                  <?php
                  echo "
                      
                      <span><a class='item_title' href='$FRD_HURL/product/$fr_pro_id/$fr_slug'> $fr_pro_title </a> </span>
                      <small> | রং: $cus_color_en_name </small>
                      <small> $order_size_name_lmody </small>
                  ";
                  echo "<br>";
                  echo "<span class='price'>৳ $FRc_ItemTotalPrice</span>";
                  ?>
                </td>

                <td width="20px" class="text-right"><button class="btn_proremove Frtrig_RemovCartItem" id="<?php echo "$id" ?>"> <span class='glyphicon glyphicon-remove'></span> </button></td>
              </tr>


          <?php
              $FRc_CartItems = ($FRc_CartItems + 1);
              $FRc_CartItemsTotalPrice = ($FRc_CartItemsTotalPrice + $fr_t_price);
            } //FOREACH END>
          } else {
            //  PR($FRR);
            $FRc_CartItems = 0;
            $FRc_CartItemsTotalPrice = 0;
            echo "<img src='$FRD_HURL/frd-public/theme/asset/img/cart_empty_1.jpg' alt='#' class='img-responsive frcartempty'>";
            echo "<style>.btn_chackout{display: none !important;}</style>";
          }
          //END>>
          ?>
          </table>
    </div>

        <?php
        //FRD CHECKOUT TRIGER 2:-
        echo "<a class='frd_tdn' href='$FRD_HURL/checkout'><button class='btn_chackout'> &#160; $frlc_cartcheckout_1_txt <span class='glyphicon glyphicon-forward'></span></button></a>";
        echo "<br><br><br><br>";
       ?>




       <?php
        $_SESSION['cart_items'] = $FRc_CartItems;
        $_SESSION['cart_price'] = $FRc_CartItemsTotalPrice;
        $_SESSION['s_keepcartopen'] = '786yes';
  } else {
        echo "<img src='$FRD_HURL/frd-public/theme/asset/img/cart_empty_1.jpg' alt='' class='img-responsive frcartempty'>";
        $_SESSION['cart_items'] = 0;
        $_SESSION['cart_price'] = 0;
        $_SESSION['s_keepcartopen'] = '786yes';
        // $FR_HURL_AT/page/mng_cart/frd-remove-cart-item.php
  }
   ?>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    ////////// view cart trigar configaration /////////////////       
    $('#cart_itemss').html(<?php echo $_SESSION['cart_items'] ?>);
    $('.cart_itemss').html(<?php echo $_SESSION['cart_items'] ?>);
    $('#cart_itemss2').html(<?php echo $_SESSION['cart_items'] ?>);
    $('#cart_pricee2').html(<?php echo $_SESSION['cart_price'] ?>);

  });
  FrFun_CartManeger();
</script>