<?php
require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "My Rating Review - $fr_cname";
$FRc_META_TAG_HTML = "";
require_once("frd-this-header.php");
require_once("frd-public/theme/frd-header.php");
?>
<!--<h2 class="PT"> MY PROFILE </h2>-->
<!-- 1 scripts s-->
<section>
<?php

extract(FRF_T_PENDING_RR_C($cust_id));

//FRD USER PROFILE DATA:-
$FRR = FR_QSEL("SELECT * FROM frd_usr WHERE id = $cust_id","");
if($FRR['FRA']==1){ 
   extract($FRR['FRD']);
} else{ ECHO_4($FRR['FRM']); }
//END>>

?>
</section>
<!-- 1 scripts e-->

   

<section>
    <div class="container">
        <div class="col-md-11">
            
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                  
                <div class="jumbotron text-center">
                   <h6>Pending Rating Review</h6>
                   <h3><?php echo "$FRc_T_PENDING_RR_C";?></h3>
                   <a href="<?php echo "$FRD_HURL/rating-review-give/".base64_encode($cust_id)."/".base64_encode($timee)."";?>"><button class="btn btn-success">Give Rating Review</button></a>
                </div>
                   

                </div>
                <div class="col-md-3"></div>
            </div>


        </div>
    </div>
</section>








<?php 
require_once("frd-this-footer.php");
require_once("frd-public/theme/frd-footer.php");
?>