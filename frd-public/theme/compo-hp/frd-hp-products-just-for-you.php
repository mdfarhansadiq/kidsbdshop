<!-- NEW PRODUCT SECTION -->
<section class="new_arrivel_secfrd hp_super_secfrd">
    <div class="container">

        <div class="row hp_sectitlfull">
            <div class="col-xs-8">
                <?php echo "<span class='hp_sectitlefrd'> $fr_hpc_text_justforyou_pro </span>"; ?>
            </div>
            <div class="col-xs-4 text-right">
                <a class="frs_moreseebtn" href="<?php echo "$FRD_HURL/products"; ?>"> <?php echo "$fr_hpc_view_more_btn_text "; ?><span class="glyphicon glyphicon-arrow-right pip_pip_1s"></span> </a>
            </div>
        </div>




            <div class="row">
                <div id="load_data"></div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <div id="load_data_message" class="d-block"></div>
                </div> 
            </div>
 




        <script type="text/javascript">

            const loading_gif = '<?php echo "$FRD_HURL/frd-src/img/gif/frd-loading-1.gif";?>';

            $(document).ready(function(){
            var limit = 100;
            var start = 0;
            var action = 'inactive';
            function load_data(limit, start)
            {
            $.ajax({
            url:"<?php echo "$FR_HURL_AT/inc/frd_product/inc/jq_ajx/fr_mixd_products.php";?>",
            method:"POST",
            data:{f_filt_rand:"1", limit:limit, start:start},
            cache:false,
            success:function(data)
            {
                $('#load_data').append(data);
                if(data == '')
                {
                alert(data);
                action = 'active';
                }
                else
                {
                    $('#load_data_message').html("No More Product Found");
                    action = "inactive";
                }
            }
            });
            }

            if(action == 'inactive')
            {
              action = 'active';
              load_data(limit, start);
            }
            $(window).scroll(function() {    
                var FRposition = $(window).scrollTop() + 400;
                var FRbottom = $(document).height() - $(window).height();

                    if(FRposition >= FRbottom && action == 'inactive'){
                        //    toastr.error('FRD DATA LODING Initializing...  ');
                        action = 'active';
                        start = start + limit;
                        setTimeout(function(){
                            load_data(limit, start);
                        }, 300);
                    }
            });
            
                
            });   
        </script>
        

    </div>
</section>