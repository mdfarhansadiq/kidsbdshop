<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Product Collection Checklist";//PAGE TITLE
$p="ProductCollectionChecklist";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Daily Based Cost Reports </h2> -->



<!-- 1 SCRIPT START -->
<section>
 <?php
    $FRc_SDATE = $FR_NOW_DATE;
 ?>
</section>
<!-- 1 SCRIPT END -->





<section>
    <div class="container">
    <div class="col-md-11">

       <div class="row">
            <form id="" class="" action="">
             <div class='table-responsive'>
                 <table class="table">
                    <tr>
                        <td>
                            <small>Limit</small>
                            <select class='form-control' id="f_filt_limit" name='f_filt_limit'>
                                <option value='600'>600</option>
                                <option value='900'>900</option>
                                <option value='1500'>1500</option>
                                <option value='2000'>2000</option>
                                <option value='3000'>3000</option>
                                <option value='6000'>6000</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>
            </form>
                
       </div>

    
        <div class="row">
            <div class="col-md-12">
                <div id="FRD_LIST"></div>
            </div>
        </div>


        

    </div>
    </div>
</section>











<script>

$(document).ready(function(){

           let f_filt_limit = $('#f_filt_limit').val();
            $.ajax({
                url:FR_HURL_APII + "/ProductCollectionChecklist",
                method:"POST",
                data: {f_filt_limit:f_filt_limit},
                success:function(data){
                    $('#FRD_LIST').html(data);
                    $("#FRD_LIST").hide();
                    $("#FRD_LIST").show(300);
                }
            });


        $('#f_filt_limit').on('change', function() {
           let f_filt_limit = $('#f_filt_limit').val();
            $.ajax({
                url:FR_HURL_APII + "/ProductCollectionChecklist",
                method:"POST",
                data: {f_filt_limit:f_filt_limit},
                success:function(data){
                    $('#FRD_LIST').html(data);
                    $("#FRD_LIST").hide();
                    $("#FRD_LIST").show(300);
                }
            });
        });

});
</script>



 
<?php require_once('frd1_footer.php'); ?>   