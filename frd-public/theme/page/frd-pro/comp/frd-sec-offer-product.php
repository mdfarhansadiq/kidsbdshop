<!-- OFFER PRODUCTS SHOWING S -->
<?php if($frtc_offerpro_s_dp == 1){ ?>
  <div class="section sec_offer_product">
  <div class="container">
    <div class="row">
      <hr>
      <div class="col-md-12">
        <h3> <span class="glyphicon glyphicon-hand-right pip_pip_1s"></span> <?php echo "$fr_tn_offers_txt";?> </h3>
        <div id="load_data_offerpro"></div>
        <div id="load_data_message_offerpro"></div>
      </div>
    </div>
  </div>
  </div>
  <script>
    $(document).ready(function() {
      //FRD RELATED PRODUCTSFETCHING:-
       $('.sec_offer_product').hide();
        setTimeout(function(){ 
         var limit = 60;
          var start = 0;
          var action = 'inactive';
          var catt_id = '<?php echo "$FRc_RelatedProCatId" ?>';
          function load_data(limit, start) {
            $.ajax({
              url: "<?php echo "$FR_HURL_AT/inc/frd_product/inc/jq_ajx/fr_mixd_products.php"; ?>",
              method: "POST",
              data: {
                limit: limit,
                start: start,
                doffer: 'doffer'
              },
              cache: false,
              success: function(data) {
                $('#load_data_offerpro').append(data);
                $('.sec_offer_product').show();
                if (data == '') {
                  $('#load_data_message_offerpro').html("NO MORE OFFER FOUND");
                  action = 'active';
                } else {
                  $('#load_data_message_offerpro').html("");
                  action = "inactive";
                }
              }
            });
          }
          if (action == 'inactive') {
            action = 'active';
            load_data(limit, start);
          }
        }, 4000);
      //END>>

    });
  </script>
<?php } ?>