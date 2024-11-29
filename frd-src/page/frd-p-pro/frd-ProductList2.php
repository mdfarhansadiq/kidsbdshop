<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Product List 2";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>

<!-- 1 SCRIPT S-->
<section> 
<?php
if($UsrType != "ad" AND $UsrType != "M"){
    ECHO_4("ACCESS DENIED","alert alert-danger text-center");
    FR_GO("$FR_THISHURL/pro-ProductList",2);
    exit;
}
?>
</section>
<!-- 1 SCRIPT E-->




<section>
    <div class="container">
    <div class="col-md-11">

    <form id="FilterForm" action="">
       <div class="row frd-card-1 text-left">
         <div class="col-md-3">
                <select class='form-control' id="f_filt_status" name='f_filt_status'>
                    <option value=''>All Status</option>
                    <option value='Published'>Published</option>
                    <option value='Unlisted'>Unlisted</option>
                    <option value='Private'>Private</option>
                    <option value='Trashed'>Trashed</option>
                    <option value='LowStock'>Low Stock</option>
                    <option value='StockOut'>Out of stock</option>
                    <option value='ColorVariation'>Color Variation</option>
                    <option value='SizeVariation'>Size Variation</option>
                </select>
         </div>
         <div class="col-md-3">
                <select class='form-control chosen' id="f_filter_cat" name='f_filter_cat'>
                    <option value=''>All Categories</option>
                    <?php echo FRF_OPTION_CAT(); ?>
                    <option value='0'>Uncategorized Product</option>
                </select>
         </div>
         <div class="col-md-2">
                <select class='form-control' id="f_filt_asc_desc" name='f_filt_asc_desc'>
                    <option value='ASC'>New => Old</option>
                    <option value='DESC'>Old => New</option>
                </select>
         </div>
         <div class="col-md-2 mt-5">
                <select class='form-control' id="f_filt_limit" name='f_filt_limit'>
                    <option value='60'>Limit 60</option>
                    <option value='300'>Limit 300</option>
                    <option value='600'>Limit 600</option>
                    <option value='900'>Limit 900</option>
                    <option value='1000'>Limit 1000</option>
                    <option value='2000'>Limit 2000</option>
                    <option value='3000'>Limit 3000</option>
                </select>
         </div>
       </div>
    </form>

        <div class="row">
            <div class="col-md-12">
                <h6 class="text-center"><?php echo "Product Report ".date('D d-M-Y h:i:s A',$FR_NOW_TIME)."";?></h6>
                <div id="FRD_LIST"></div>
            </div>
        </div>

    </div>
    </div>
</section>









<script>
$(document).ready(function(){

            let f_filt_status = $('#f_filt_status').val();
            let f_filt_limit = $('#f_filt_limit').val();
            let f_filt_asc_desc = $('#f_filt_asc_desc').val();
            $.ajax({
                url:FR_HURL_APII + "/ProductListAPI2",
                method:"POST",
                data: {f_filt_status:f_filt_status, f_filter_cat:'', f_filt_limit:f_filt_limit, f_filt_asc_desc:f_filt_asc_desc},
                success:function(data){
                    $('#FRD_LIST').html(data);
                    $("#FRD_LIST").hide();
                    $("#FRD_LIST").show(600);
                }
            });


        $('#f_filt_asc_desc,#f_filt_limit,#f_filt_status,#f_filter_cat').on('change', function() {
           let f_filt_asc_desc = $('#f_filt_asc_desc').val();
           let f_filt_limit = $('#f_filt_limit').val();
           let f_filt_status = $('#f_filt_status').val();
           let f_filter_cat = $('#f_filter_cat').val();

            $.ajax({
                url:FR_HURL_APII + "/ProductListAPI2",
                method:"POST",
                data: {f_filt_status:f_filt_status, f_filter_cat:f_filter_cat, f_filt_limit:f_filt_limit, f_filt_asc_desc:f_filt_asc_desc},
                success:function(data){
                    $('#FRD_LIST').html(data);
                    $("#FRD_LIST").hide();
                    $("#FRD_LIST").show(600);
                }
            });

      });

  
});
</script>
   

<?php require_once('frd1_footer.php'); ?>   