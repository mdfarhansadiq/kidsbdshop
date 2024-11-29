<!-- RELATED PRODUCTS SHOWING S -->
<?php if($frtc_relatedproshow_s_dp == 1){ ?>
  <div class="section sec_related_product">
  <div class="container">
    <div class="row">
      <hr>
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
          var catt_id = '<?php echo "$FRc_RelatedProCatId" ?>';
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
        }, 4000);
      //END>>

    });
  </script>
<?php } ?>