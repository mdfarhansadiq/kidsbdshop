<!-- DELIVERY CHARGE HINKS DHAKA AND OUTSIDE DHAKA -->
<?php if($frtc_delicharg_s_dp == 1){ 
    //DELIVERY AND PAMENT INFO NOTE INSIDE DHAKA:-
    $FRQ = $FR_CONN->query("SELECT page_body_en from frd_pages WHERE id = 12");
    $rd_sp_dpiidhak_kx = $FRQ->fetch();
    $frd_sp_dpiindhaka = $rd_sp_dpiidhak_kx['page_body_en'];
    //DELIVERY AND PAMENT INFO NOTE OUTSIDE DHAKA:-
    $FRQ = $FR_CONN->query("SELECT page_body_en from frd_pages WHERE id = 13");
    $rd_sp_dpioutdhak_kx = $FRQ->fetch();
    $frd_sp_dpioutdhaka = $rd_sp_dpioutdhak_kx['page_body_en'];
    ?>
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