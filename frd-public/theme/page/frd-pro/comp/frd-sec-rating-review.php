<!-- FRD PRODUCT RATING REVIEW SECTION START -->
<div class="container">

  <?php 
  if($frtc_rating == 1){
  if($fr_t_rr_c > 0){
  ?>
  <div class="row jumbotron">
      <div class="col-md-6">

         <div class="FrAveRatingReviewDiv_Left">
            <?php 
            if($fr_a_rating == 5){$FRc_a_rating_HTML = "★★★★★<span></span>";} 
            elseif($fr_a_rating == 4){$FRc_a_rating_HTML = "★★★★<span>★</span>";}
            elseif($fr_a_rating == 3){$FRc_a_rating_HTML = "★★★<span>★★</span>";}
            elseif($fr_a_rating == 2){$FRc_a_rating_HTML = "★★<span>★★★</span>";}
            elseif($fr_a_rating == 1){$FRc_a_rating_HTML = "★<span>★★★★</span>";}
            elseif($fr_a_rating == 0){$FRc_a_rating_HTML = "<span>★★★★★</span>";}
            ?>
            <h1><?php echo "$fr_a_rating";?> <small>/5</small></h1>
              <span class="avarate_star_rating"> <?php echo "$FRc_a_rating_HTML";?> </span>
              <br>
            <small><?php echo "$fr_t_rr_c";?> Reviews <br> Average Rating <?php echo "$fr_a_rating";?></small>
         </div>


      

      </div>

      <div class="col-md-6">
                 
          <div class="FrAveRatingReviewDiv_right">
            <?php
             $FRc_t_5sr_prs = ($fr_t_5sr / $fr_t_rr_c * 100);
             $FRc_t_4sr_prs = ($fr_t_4sr / $fr_t_rr_c * 100);
             $FRc_t_3sr_prs = ($fr_t_3sr / $fr_t_rr_c * 100);
             $FRc_t_2sr_prs = ($fr_t_2sr / $fr_t_rr_c * 100);
             $FRc_t_1sr_prs = ($fr_t_1sr / $fr_t_rr_c * 100);
            ?>

            <div class="frline">
              <div class="div1"> ★★★★★ </div>
              <div class="div2">
                  <div class="progress"> <div class="progress-bar" style="width: <?php echo "$FRc_t_5sr_prs%";?>;"> <?php echo "$FRc_t_5sr_prs%";?> </div> </div>
              </div>
              <div class="div3"><?php echo "$fr_t_5sr";?></div>
            </div>

            <div class="frline">
              <div class="div1"> ★★★★ </div>
              <div class="div2">
                  <div class="progress"> <div class="progress-bar progress-bar-warning" style="width: <?php echo "$FRc_t_4sr_prs%";?>;"> <?php echo "$FRc_t_4sr_prs%";?> </div> </div>
              </div>
              <div class="div3"><?php echo "$fr_t_4sr";?></div>
            </div>

            <div class="frline">
              <div class="div1"> ★★★ </div>
              <div class="div2">
                  <div class="progress"> <div class="progress-bar progress-bar-warning" style="width: <?php echo "$FRc_t_3sr_prs%";?>;"> <?php echo "$FRc_t_3sr_prs%";?> </div> </div>
              </div>
              <div class="div3"><?php echo "$fr_t_3sr";?></div>
            </div>

            <div class="frline">
              <div class="div1"> ★★ </div>
              <div class="div2">
                  <div class="progress"> <div class="progress-bar progress-bar-warning" style="width: <?php echo "$FRc_t_2sr_prs%";?>;"> <?php echo "$FRc_t_2sr_prs%";?> </div> </div>
              </div>
              <div class="div3"><?php echo "$fr_t_2sr";?></div>
            </div>

            <div class="frline">
              <div class="div1"> ★ </div>
              <div class="div2">
                  <div class="progress"> <div class="progress-bar progress-bar-warning" style="width: <?php echo "$FRc_t_1sr_prs%";?>;"> <?php echo "$FRc_t_1sr_prs%";?></div> </div>
              </div>
              <div class="div3"><?php echo "$fr_t_1sr";?></div>
            </div>

           </div>
      </div>
  </div>

    <div class="row">
        <div class="col-md-3"></div>
        
          <div class="col-md-6 FrRatingReviewList">
            <?php
              $FRR = FR_QSEL("SELECT * FROM frd_rating_review WHERE fr_rr_pro_id = $FRc_ProductIdx AND fr_rr_stat = 1 ORDER BY id DESC LIMIT 0,5","ALL");
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

                  $FRc_UMP1 = substr($FRc_USR_MOBILE1,0,7);
                  $FRc_UMP2 = "**";
                  $FRc_UMP3 = substr($FRc_USR_MOBILE1,9,11);
                  $FRc_USR_MOBILE1 = "$FRc_UMP1$FRc_UMP2$FRc_UMP3";

                  echo "
                  <div class='media FrMedia_rr jumbotron'>
                    <div class='media-left'>
                      $FRc_LeftMedia
                    </div>
                    <div class='media-body'>
                        <small class='rating_time'>$FRc_RatingDate</small><br>
                        <h4 class='media-heading'> <b> $FRc_USR_NAME</b> <small></small></h4>
                        <h5 class='media-heading'> <b> $FRc_USR_MOBILE1</b></h5>
                        <span class='rating_star'> $FRc_Rating </span><br>
                        $fr_review
                    </div>
                    </div>
                  ";

                  $FRc_RR_SL = ($FRc_RR_SL + 1);
                }
                 
                 if($FRc_RR_SL > 5 ){
                   echo "<div class='text-center frdiv_seemore_rr'><button class='btn btn-default frsty_theme_super_btn frtrig_seemore_ratingreview' fr_rr_pro_id='$FRc_MP_IDx'><span class='glyphicon glyphicon-fullscreen'></span> $frlc_see_more_rating_r_tx </button></div> <br><br><br>";
                 }

               } else{ 
                //  PR($FRR);
                //  echo "<div class='alert alert-danger text-center'>No ratings and reviews found!</div>";
               }
            ?>
          </div>

        <div class="col-md-3"></div>
    </div>


        <script type="text/javascript">
        $(document).ready(function() {
          
          //FRD SEE MORE RATING REVIEW:-
            $(".frtrig_seemore_ratingreview").unbind().click(function() {
              var fr_rr_pro_id = $(this).attr("fr_rr_pro_id");
              // alert(FrPdfFileLink);
              $.ajax({
                url: FR_HURL_APII + "/SeeMoreRatingR",
                method: "POST",
                data: {
                  fr_rr_pro_id: fr_rr_pro_id
                },
                success: function(data) {
                  $('#FR_SPIDER_MODEL_DATA').html(data);
                  $('.modal-dialog').addClass('modal-dialog-centered');
                  $('#FR_SPIDER_MODEL').modal("show");
                }
              });
            });
          //END>>

          //FRD CODE FOR RATING REVIEW SECTION:-
            var rating_data = 0;
            $('#add_review').click(function(){
                $('#review_modal').modal('show');
            });
            $(document).on('mouseenter', '.submit_star', function(){
                var rating = $(this).data('rating');
                reset_background();
                for(var count = 1; count <= rating; count++)
                {
                    $('#submit_star_'+count).addClass('text-warning');
                }
            });
            function reset_background()
            {
                for(var count = 1; count <= 5; count++)
                {
                    $('#submit_star_'+count).addClass('star-light');
                    $('#submit_star_'+count).removeClass('text-warning');
                }
            }
            $(document).on('mouseleave', '.submit_star', function(){
                reset_background();
                for(var count = 1; count <= rating_data; count++)
                {
                    $('#submit_star_'+count).removeClass('star-light');
                    $('#submit_star_'+count).addClass('text-warning');
                }
            });
            $(document).on('click', '.submit_star', function(){
                rating_data = $(this).data('rating');
            });
          //END>>

        });
        //END>>
        </script>

  <?php } } ?>
</div>
<!-- FRD PRODUCT RATING REVIEW SECTION END -->