<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Login History";//PAGE TITLE
$p="LoginHistory";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Login History </h2>

<!-- 1 SCRIPT START -->   
<section>
<?php 

?>   
</section>
<!-- 1 SCRIPT END -->    




<section id="">
    <div class="container">
        <div class="col-md-11">

            <div class="row">
                <div class="col-md-12">
                    <form id="" class="" action="">
                        <div class='table-responsive'>
                            <table class="table">
                                <tr>
                                    <td>
                                        <small>Filter New/Old</small>
                                        <select class='form-control' id="f_filt_asc_desc" name='f_filt_asc_desc'>
                                            <option value='DESC'>Old => New</option>
                                            <option value='ASC'>New => Old</option>
                                        </select>
                                    </td>
                                    <td>
                                        <small>Limit</small>
                                        <select class='form-control' id="f_filt_limit" name='f_filt_limit'>
                                            <option value='100'>100</option>
                                            <option value='300'>300</option>
                                            <option value='600'>600</option>
                                            <option value='900'>900</option>
                                            <option value='1500'>1500</option>
                                            <option value='2000'>2000</option>
                                            <option value='3000'>3000</option>
                                            <option value='6000'>6000</option>
                                            <option value='10000'>10000</option>
                                            <option value='15000'>15000</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div id="FRD_LIST_DATA"></div>
                </div>
            </div>

        </div>
    </div>
</section>




   



<script>
    $(document).ready(function() {
                let f_filt_asc_desc = $('#f_filt_asc_desc').val();
                let f_filt_limit = $('#f_filt_limit').val();
                $.ajax({
                    url: FRD_HURLL + "/frdsp/dp/page/frd-p-dp/frdapi-LoginHistory.php",
                    method: "POST",
                    data: {
                        f_filt_asc_desc: f_filt_asc_desc,
                        f_filt_limit: f_filt_limit,
                        f_spiderecommerce: 'spidereCommerce'
                    },
                    success: function(data) {
                        $('#FRD_LIST_DATA').html(data);
                        $("#FRD_LIST_DATA").hide();
                        $("#FRD_LIST_DATA").show(300);
                    }
                });
            

        $('#f_filt_asc_desc,#f_filt_limit').on('change', function() {
            let f_filt_asc_desc = $('#f_filt_asc_desc').val();
            let f_filt_limit = $('#f_filt_limit').val();
            $.ajax({
                url: FRD_HURLL + "/frdsp/dp/page/frd-p-dp/frdapi-LoginHistory.php",
                method: "POST",
                data: {
                    f_filt_asc_desc: f_filt_asc_desc,
                    f_filt_limit: f_filt_limit,
                    f_spiderecommerce: 'spidereCommerce'
                },
                success: function(data) {
                    $('#FRD_LIST_DATA').html(data);
                    $("#FRD_LIST_DATA").hide();
                    $("#FRD_LIST_DATA").show(300);
                }
            });
        });


    });
</script>




<?php require_once('frd1_footer.php'); ?>   