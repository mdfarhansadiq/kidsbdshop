<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Supplier Base Product Collection Checklist";//PAGE TITLE
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
        
        <br>
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

            $.ajax({
                url:FR_HURL_APII + "/ProductCollectionChecklistSB",
                method:"POST",
                data: {f_a:1},
                success:function(data){
                    $('#FRD_LIST').html(data);
                    $("#FRD_LIST").hide();
                    $("#FRD_LIST").show(300);
                }
            });

});
</script>



 
<?php require_once('frd1_footer.php'); ?>   