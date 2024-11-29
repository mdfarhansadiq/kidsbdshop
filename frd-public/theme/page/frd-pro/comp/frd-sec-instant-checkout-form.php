<?php
if($fr_p_icf_dp == 1){ ?>
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
    $(document).ready(function(){
      setTimeout(function(){ 
        $.ajax({
            url: FR_HURL_APII + "/PopupCheckoutForm",
            method: "POST",
            data: { f_product_id: FRc_ProductIdxx },
            success: function (data) {
            $("#FR_DATA_ORDER_FORM").html(data);
            },
        });
      }, 3000);
    });//F D R E    
  </script>
</section>
<?php } ?>