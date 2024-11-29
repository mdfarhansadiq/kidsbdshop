<?php
header("Content-Type: text/html");
header("Access-Control-Allow-Origin: $FRD_HURL");

$FRQ = $FR_CONN->query("SELECT fr_clogo FROM frd_cprofile WHERE id = 1");
extract($FRQ->fetch());

$FRQ = $FR_CONN->query("SELECT FR_FLASH_SELLS_MODE,frtc_app_d_btn FROM frd_themeconfig WHERE id = 1");
extract($FRQ->fetch());

$FRQ = $FR_CONN->query("SELECT * FROM frd_themelan WHERE frlc_lang = '".$_SESSION['FRs_frtc_lang']."'");
extract($FRQ->fetch());



?>

<div class='snsl'>

    <div class="text-center">
      <a class="logolink" href="<?php echo $FRD_HURL ?>">
        <img title="Go To Home Page" id="logoo" src="<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_clogo"; ?>" alt="Logo" style='height:auto;width:150px;margin:auto;'>
      </a>
      <span class="glyphicon glyphicon-remove btn btn-default btn-xs frclosebtn" onclick="frfun_HideLeftSideNave()"></span>
    </div>

    <?php
    echo " <a href='$FRD_HURL'><span class='glyphicon glyphicon-home'></span> $fr_tn_home_btn_txt </a> ";

    if ($FR_FLASH_SELLS_MODE == "FRON") {
      echo "<a href='$FRD_HURL/flash-sales'> <span class='glyphicon glyphicon-flash pip_pip_1s'></span> $fr_tn_flash_sales_txt </a>";
    }

    echo "
      <a href='$FRD_HURL/products'><span class='glyphicon glyphicon-grain'></span>  $fr_tn_new_product_txt </a>
      <a href='$FRD_HURL/offers'><span class='glyphicon glyphicon-sunglasses'></span>  $fr_tn_offer_txt </a>
      <a href='$FRD_HURL/categories'><span class='glyphicon glyphicon-folder-open'></span> $fr_tn_cat_boxview_txt </a>
      <a href='$FRD_HURL/categories_list'><span class='glyphicon glyphicon-bookmark'></span> $fr_tn_cat_listmap_txt </a>
      <a href='$FRD_HURL/brands'><span class='glyphicon glyphicon-tasks'></span> $fr_tn_allbrand_txt </a>
      ";

      if($frtc_app_d_btn == 1){
        echo "<a href='$FRD_HURL/frd-data/mixd/$fr_cname.apk'><span class='glyphicon glyphicon-save'></span> $frlc_app_d_btn_txt </a>";
      }

    // if ($frtc_rating == 1) {
    //   echo "<a href='$FRD_HURL/RatingReviewList'><span class='glyphicon glyphicon-arrow-right'></span> All Rating Review </a>";
    // }
    if ($FRcf_ParcelBooki == "1") {
      echo "<a href='$FRD_HURL/parcels_delivery'><span class='glyphicon glyphicon-bed'></span>  পার্সেল ডেলিভারি বুকিং </a>";
    }


            
            //FRD CATEGORY LIST:-
            echo "<hr>";
             $q_frd = "SELECT * FROM frd_categoriess WHERE cat_type = 1 AND cat_father = 0 AND statuss = 1 ORDER BY id ASC";
            $FRQ = $FR_CONN->query("$q_frd");
            $rowsnum_frd = $FRQ->rowCount();
            for ($i = 1; $i <= $rowsnum_frd; $i++) { //For Loop S
                $rowfrd = $FRQ->fetch();
                $catt_id = $rowfrd['id'];
                $catt_slug = $rowfrd['slugg'];
                $catt_name = $rowfrd['en_name'];
                $catt_name_bn = $rowfrd['bn_name'];
                $catt_type = $rowfrd['cat_type'];
                echo "
                 <a href='$FRD_HURL/category/$catt_slug'><span class='glyphicon glyphicon-tags'> </span>  $catt_name_bn </a>
                ";

            } //For Loop E
            //END>>
            //FRD CATEGORY LIST:-
            echo "<hr>";
             $q_frd = "SELECT * FROM frd_categoriess WHERE cat_type = 2 AND statuss = 1 ORDER BY id ASC";
            $FRQ = $FR_CONN->query("$q_frd");
            $rowsnum_frd = $FRQ->rowCount();
            if($rowsnum_frd > 0){
                for($i = 1; $i <= $rowsnum_frd; $i++) { //For Loop S
                    $rowfrd = $FRQ->fetch();
                    $catt_id = $rowfrd['id'];
                    $catt_slug = $rowfrd['slugg'];
                    $catt_name = $rowfrd['en_name'];
                    $catt_name_bn = $rowfrd['bn_name'];
                    $catt_type = $rowfrd['cat_type'];
                    echo "
                    <a href='$FRD_HURL/category/$catt_slug'><span class='glyphicon glyphicon-tags'> </span>  $catt_name_bn </a>
                    ";
                } //For Loop E
            }
            //END>>









    echo "
      <hr>
      <a href='$FRD_HURL/page/contact'><span class='glyphicon glyphicon-check'></span> $fr_vp_contact_txt </a>
      <a href='$FRD_HURL/page/vision'><span class='glyphicon glyphicon-check'></span> $fr_vp_vision_txt </a>
      <a href='$FRD_HURL/page/mission'><span class='glyphicon glyphicon-check'></span> $fr_vp_mission_txt </a>
      <a href='$FRD_HURL/page/privacy-policy'><span class='glyphicon glyphicon-check'></span> $fr_vp_privacypolicy_txt </a>
      <a href='$FRD_HURL/page/delivery-policy'><span class='glyphicon glyphicon-check'></span> $fr_vp_deliverypolicy_txt </a>
      <a href='$FRD_HURL/page/terms-and-conditions'><span class='glyphicon glyphicon-check'></span> $fr_vp_tramsandcondition_txt </a>
      <a href='$FRD_HURL/page/contact'><span class='glyphicon glyphicon-check'></span> $fr_tn_helpline_txt </a>
      ";
    ?>

    <br>
    <div class="text-center">
      <span class="glyphicon glyphicon-remove btn btn-default btn-xs frclosebtn" onclick="frfun_HideLeftSideNave()"></span>
    </div>

  </div>
  <br><br>