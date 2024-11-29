 <!-- LONG DESCRIPTION  -->
 <div class="container">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 jumbotron">
            <style>
              div.div_long_description img{
                  width: 100% !important;
              }
            </style>
            <div class="div_long_description">
              <h3><b>পণ্যের বিস্তারিত বিবরণ:-</b></h3>

                <article>
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
                  <hr>
                  <?php
                  echo "$FRc_LongDescription";
                  ?>

                </article>
            </div>

      </div>
      <div class="col-md-2"></div>
    </div>
   </div>