<?php 
$FR_OP_HTML = "";
//FRD VC NEED:-
    $FR_VC_SESSION = "";
    $FR_VC_POST = "";

//FRD VC________
    if(isset($_POST['fr_rr_pro_id'])){
         $FRc_rr_pro_id = $_POST['fr_rr_pro_id'];
         $FR_VC_POST = 1; 
    } else{
        $FR_OP_HTML .= "<h6>Access Denied 1 </h6>";
    }
?>



       <?php if($FR_VC_POST == 1){ ?>
       <div class="row">
          <div class="col-xs-1"></div>
          <div class="col-xs-10 FrRatingReviewList">
            <?php
              $FRR = FR_QSEL("SELECT * FROM frd_rating_review WHERE fr_rr_pro_id = $FRc_rr_pro_id AND fr_rr_stat = 1 ORDER BY id DESC LIMIT 0,100","ALL");
              if($FRR['FRA']==1){
                $FRc_RR_SL = 1;  
                foreach($FRR['FRD'] as $FR_ITEM){
                  extract($FR_ITEM);
                  extract(FR_USR_MINI_INFO($fr_rr_cust_id));

                  if($fr_rating == 5){ $FRc_Rating = "★★★★★";}
                  elseif($fr_rating == 4){ $FRc_Rating = "★★★★";}
                  elseif($fr_rating == 3){ $FRc_Rating = "★★★";}
                  elseif($fr_rating == 2){ $FRc_Rating = "★★";}
                  elseif($fr_rating == 1){ $FRc_Rating = "★";}

                  $FRc_RatingDate = date('d-M-Y',$fr_rr_time);

                  $FRc_LeftMedia = "";
                  if($FRc_USR_PIC == "1.jpg"){
                    $FRc_LeftMedia = "<h2 class='boldd'>".substr($FRc_USR_NAME,0,1)."</h2>";
                  }else{
                    $FRc_LeftMedia = " <img class='media-object img-circle' src='$FRD_HURL/frd-data/img/customer/$FRc_USR_PIC' alt='#' width='60px' height='60%' >";
                  }

                  $FRc_UMP1 = substr($FRc_USR_MOBILE1,0,4);
                  $FRc_UMP2 = "*****";
                  $FRc_UMP3 = substr($FRc_USR_MOBILE1,9,11);
                  $FRc_USR_MOBILE1 = "$FRc_UMP1$FRc_UMP2$FRc_UMP3";

                  echo "
                  <div class='jumbotron'>
                  <div class='media FrMedia_rr fr-p-10'>
                    <div class='media-left'>
                      $FRc_LeftMedia
                    </div>
                    <div class='media-body'>
                        <small class='rating_time'>$FRc_RatingDate</small><br>
                        <h4 class='media-heading'> <b> $FRc_USR_NAME</b></h4>
                        <h5 class='media-heading'> <b> $FRc_USR_MOBILE1</b></h5>
                        <span class='rating_star'> $FRc_Rating </span><br>
                        $fr_review
                    </div>
                    </div>
                    </div>
                  ";

                  $FRc_RR_SL = ($FRc_RR_SL + 1);
                }
                 
               } else{ 
                //  PR($FRR);
                //  echo "<div class='alert alert-danger text-center'>No ratings and reviews found!</div>";
               }
            ?>
          </div>
          <div class="col-xs-1"></div>
      </div>
      <?php } ?>



<?php
THIS_LAST:
echo $FR_OP_HTML;
?>