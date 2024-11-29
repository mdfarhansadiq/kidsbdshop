<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Rating Review Not Approved";//PAGE TITLE
$p="rrNotApproved";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Page List</h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php 
extract(FRF_T_NOTAPPROVE_RR_C());
?>   
</section>
<!-- 1 SCRIPT END -->    

 
<style>
     .FrRatingReviewList{}
 .FrMedia_rr span.rating_star{
   color: #FACA51;
   font-size: 1.5em;
 }
 .FrMedia_rr span.rating_star span{
   color: #999;
 } 
</style>




<section>
<div class="container">
<div class="col-md-11">

<span class="label label-danger"><?php echo "Not Approved: $FRc_T_NOTAPPROVE_RR_C";?></span>



<div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 FrRatingReviewList ">
            <?php
              $FRR = FR_QSEL("SELECT * FROM frd_rating_review WHERE fr_rr_stat = 2 ORDER BY id DESC LIMIT 0,90","ALL");
              if($FRR['FRA']==1){  
                foreach($FRR['FRD'] as $FR_ITEM){
                  extract($FR_ITEM);
                  extract(FR_USR_MINI_INFO($fr_rr_cust_id));

                  if($fr_rating == 5){ $FRc_Rating = "★★★★★";}
                  elseif($fr_rating == 4){ $FRc_Rating = "★★★★";}
                  elseif($fr_rating == 3){ $FRc_Rating = "★★★";}
                  elseif($fr_rating == 2){ $FRc_Rating = "★★";}
                  elseif($fr_rating == 1){ $FRc_Rating = "★";}

                  $FRc_RatingDate = date('d-M-Y',$fr_rr_time);

                  $FRQ = $FR_CONN->query("SELECT pic_1 FROM frd_products WHERE id = $fr_rr_pro_id");
                  $FRSD = $FRQ->fetch();
                  $FRc_ProductPic = $FRSD['pic_1'];

                  echo "
                  <div class='media FrMedia_rr jumbotron'>
                    <div class='media-left'>
                        <a href='#'>
                        <img class='media-object img-circle' src='$FRD_HURL/frd-data/img/customer/$FRc_USR_PIC' alt='#' width='60px' height='60%' >
                        </a>
                    </div>
                    <div class='media-body'>
                        <small class='rating_time'>$FRc_RatingDate</small><br>
                        <h4 class='media-heading'> <b> $FRc_USR_NAME</b></h4>
                        <img class='media-object' src='$FRD_HURL/frd-data/img/product/$FRc_ProductPic' alt='#' width='60px' height='60%' >
                        <span class='rating_star'> $FRc_Rating </span><br>
                        $fr_review
                    </div>
                    </div>
                   
                  ";
                }
               } else{ 
                //  PR($FRR);
                 echo "<div class='alert alert-danger text-center'>You have no ratings and reviews found!</div>";
               }
            ?>
      </div>
      <div class="col-md-3"></div>
  </div>
 


</div>
</div>
</section>






<?php require_once('frd1_footer.php'); ?>