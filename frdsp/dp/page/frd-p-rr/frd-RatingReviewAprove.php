<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Rating Review Approving";//PAGE TITLE
$p="RatingReviewAprove";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Page List</h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php 
 

//---------------------------------------------------------
//FRD # DATA INSERT
//---------------------------------------------------------
   if(isset($_POST['f_star_rate'])){
       //   PR($_POST);
        //FRD VC NEED:-
            $FR_VC_DATA_PROCESS = "";
            $FR_VC_ARF = "";//ALL REQUIRED FILD
        
        //FRD POST DATA FILTERING AND MAKING VARIVAL:-
            $keys = array_keys($_POST);
            foreach($keys as $key){
                $$key = $_POST["$key"];
                //echo "$key <br>";
            }
        //FRD_VC___________DATA PROSESSED OR NOT:-
            if(isset($f_star_rate)){  $FR_VC_DATA_PROCESS = 1; }else{ $FRR['FRA'] = 2; $FRR['FRM'] = "Data Process Failed";  FR_SWAL("Data Process Failed","","error"); goto THIS_LAST; }
    
        //FRD_VC___________ALL REQUIRED FILED:-
            if($f_star_rate != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; $FRR['FRM'] = "Please Fill All Required Field";  FR_SWAL("Please Fill All Required Field","","error"); goto THIS_LAST; }
    
            $f_product_id = base64_decode(base64_decode(base64_decode($f_product_id)));
            $FRc_RatingReviewId = base64_decode(base64_decode(base64_decode($f_rating_review_id)));


        //FRD CUSTOM DATA MAKING:-
            $FRc_ProductId = $f_product_id;
            $FRR = FR_QSEL("SELECT vry_typ,v_mp_id FROM frd_products WHERE id = $f_product_id","");
            if($FRR['FRA']==1){ 
               extract($FRR['FRD']);
               if($vry_typ == 3){ $FRc_ProductId = $v_mp_id; }
            } else{ ECHO_4($FRR['FRM']); }


    
    
                    if($FR_VC_DATA_PROCESS == 1 and $FR_VC_ARF==1){

                        $FRQ = "UPDATE frd_rating_review SET 
                        fr_rating = '$f_star_rate',
                        fr_review = '$f_review_text',
                        fr_rr_pro_id = '$FRc_ProductId',
                        fr_rr_stat = 1
                        WHERE id = $FRc_RatingReviewId AND fr_rr_stat = 0";
                        $R = FR_DATA_UP("$FRQ");
                        //PR($R);
                        if($R['FRA']==1){


                                //FRD PRODUCT TABLE DATA UPDATE:-
                                    $FRc_t_1sr = 0;
                                    $FRc_t_2sr = 0;
                                    $FRc_t_3sr = 0;
                                    $FRc_t_4sr = 0;
                                    $FRc_t_5sr = 0;

                                    if($f_star_rate == 5){ $FRc_t_5sr = 1;}
                                    elseif($f_star_rate == 4){ $FRc_t_4sr = 1;}
                                    elseif($f_star_rate == 3){ $FRc_t_3sr = 1;}
                                    elseif($f_star_rate == 2){ $FRc_t_2sr = 1;}
                                    elseif($f_star_rate == 1){ $FRc_t_1sr = 1;}

                                    $FRQ = "UPDATE frd_products SET 
                                    fr_t_rr_c = (fr_t_rr_c + 1),
                                    fr_t_rating = (fr_t_rating + $f_star_rate),
                                    fr_a_rating = (fr_t_rating / fr_t_rr_c),
                                    fr_t_1sr = (fr_t_1sr + $FRc_t_1sr),
                                    fr_t_2sr = (fr_t_2sr + $FRc_t_2sr),
                                    fr_t_3sr = (fr_t_3sr + $FRc_t_3sr),
                                    fr_t_4sr = (fr_t_4sr + $FRc_t_4sr),
                                    fr_t_5sr = (fr_t_5sr + $FRc_t_5sr)
                                    WHERE id = $FRc_ProductId";
                                    $R = FR_DATA_UP("$FRQ");
                                    //PR($R);
                                    if($R['FRA']==1){
                                        FR_SWAL("Approved","","success");
                                    }else{
                                        FR_SWAL("Not Approved","","error");
                                        FR_GO("$FR_THIS_PAGE","1");
                                        exit;
                                    }
                                //END>>

                            // FR_SWAL("Approved","","success");
                        }else{
                            FR_SWAL("Rating Review Table Data Update Failed","","error");
                            FR_GO("$FR_THIS_PAGE","3");
                            exit;
                        }
    
                    }
                            
    }
//END ADD>>




//---------------------------------------------------------
//FRD NOT APPROVING:-
//---------------------------------------------------------
   if(isset($_POST['f_ratingreview_id'])){
       //   PR($_POST);
        //FRD VC NEED:-
            $FR_VC_DATA_PROCESS = "";
            $FR_VC_ARF = "";//ALL REQUIRED FILD
        
        //FRD POST DATA FILTERING AND MAKING VARIVAL:-
            $keys = array_keys($_POST);
            foreach($keys as $key){
                $$key = $_POST["$key"];
                //echo "$key <br>";
            }
        //FRD_VC___________DATA PROSESSED OR NOT:-
            if(isset($f_ratingreview_id)){  $FR_VC_DATA_PROCESS = 1; }else{ $FRR['FRA'] = 2; $FRR['FRM'] = "Data Process Failed";  FR_SWAL("Data Process Failed","","error"); goto THIS_LAST; }
    
        //FRD_VC___________ALL REQUIRED FILED:-
            if($f_ratingreview_id != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; $FRR['FRM'] = "Please Fill All Required Field";  FR_SWAL("Please Fill All Required Field","","error"); goto THIS_LAST; }
    
            $FRc_RatingReviewId = base64_decode(base64_decode(base64_decode($f_ratingreview_id)));
    
    
                    if($FR_VC_DATA_PROCESS == 1 and $FR_VC_ARF==1){

                        $FRQ = "UPDATE frd_rating_review SET 
                        fr_rr_stat = 2
                        WHERE id = $FRc_RatingReviewId AND fr_rr_stat = 0";
                        $R = FR_DATA_UP("$FRQ");
                        //PR($R);
                        if($R['FRA']==1){
                            FR_SWAL("Not Approved Done","","success");
                        }else{
                            FR_SWAL("Not Approved Failed","","error");
                            FR_GO("$FR_THIS_PAGE","1");
                            exit;
                        }
    
                    }
                            
    }
    THIS_LAST:
//END ADD>>







extract(FRF_T_INREVIEW_RR_C());
extract(FRF_T_APPROVE_RR_C());
extract(FRF_T_NOTAPPROVE_RR_C());
?>   
</section>
<!-- 1 SCRIPT END -->    

 <style>
/*****************************************/
/*FRD REVIEW SUBMIT FORM*/
/*****************************************/
.FrStarRate {
    color: #ccc;
    font-size: 3em;
    cursor: pointer;
 }
 .FrStarRate span.checked{
    color: #FACA51;
 }
 </style>  


<br>
<section>
<div class="container">
<div class="col-md-11">

<span class="label label-danger"><?php echo "In Review: $FRc_T_INREVIEW_RR_C";?></span>
<span class="label label-success"><?php echo "Approved: $FRc_T_APPROVE_RR_C";?></span>
<span class="label label-primary"><?php echo "Not Approved: $FRc_T_NOTAPPROVE_RR_C";?></span>



<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6 text-center">

       <?php 
        $FRR = FR_QSEL("SELECT * FROM frd_rating_review WHERE fr_rr_stat = 0 ORDER BY id ASC LIMIT 0,1","");
        if($FRR['FRA']==1){ 
          extract($FRR['FRD']);
          $FRQ = $FR_CONN->query("SELECT pic_1,bn_name FROM frd_products WHERE id = $fr_rr_pro_id");
          $FRSD = $FRQ->fetch();
          $FRc_ProductPic = $FRSD['pic_1'];
          $FRc_ProductTitle = $FRSD['bn_name'];
        ?>

        <div class="div jumbotron">
             <img src="<?php echo "$FRD_HURL/frd-data/img/product/$FRc_ProductPic";?>" alt="#" style='height:100px;width:auto;margin:auto;'>
             <h6><?php echo "$FRc_ProductTitle [#$fr_rr_pro_id]";?></h6>

            <form action="" method="POST">
                <div class="FrStarRate">
                    <span class="star1 star" frid="1">★</span>
                    <span class="star2 star" frid="2">★</span>
                    <span class="star3 star" frid="3">★</span>
                    <span class="star4 star" frid="4">★</span>
                    <span class="star5 star" frid="5">★</span>
                </div>

                <input type="hidden" value="<?php echo "$fr_rating";?>" name="f_star_rate" id="f_star_rate">
                <input type="hidden" value="<?php echo base64_encode(base64_encode(base64_encode($fr_rr_pro_id)));?>" name="f_product_id">
                <input type="hidden" value="<?php echo base64_encode(base64_encode(base64_encode($id)));?>" name="f_rating_review_id">
                <textarea class="form-control" name="f_review_text" id="" cols="30" rows="3" placeholder="রিভিউ লিখুন" required><?php echo "$fr_review";?></textarea>
                <br>
                <div class='text-right'>
                    <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Approved </button>
                </div>
            </form>


            <br><br><br>
            <form action="" method="POST">
               <div class='text-right'>
                    <input type="checkbox" required> I am Sure
                    <input type="hidden" value="<?php echo base64_encode(base64_encode(base64_encode($id)));?>" name="f_ratingreview_id">
                    <button type='submit' class='btn btn-danger btn-xs'> <span class='glyphicon glyphicon-trash'></span> Not Approved </button>
                </div>
            </form>
        </div>

      <?php
        }else{ 
            // FR_GO("$FRD_HURL/FRH=JDUUFMKXCX"); exit;
        }
       ?>


    </div>
    <div class="col-md-3"></div>
  </div>
 


</div>
</div>
</section>



<script>
    const frc_fr_rating = '<?php echo "$fr_rating";?>';

    let ia = 1;
    for (ia = 1; ia <= frc_fr_rating; ++ia) {
        $('.star'+ia).addClass('checked');
        $('#f_star_rate').val(ia);
    }



    $(".star").on("mouseover", function () {
        let sratsl = $(this).attr("frid"); 

           star_bg_reset();
            let i = 1;
            for (i = 1; i <= sratsl; ++i) {
                // do something with `substr[i]`
                $('.star'+i).addClass('checked');
                $('#f_star_rate').val(i);
            }
    });

    function star_bg_reset(){
        $('.star1,.star2,.star3,.star4,.star5').removeClass('checked');
    }
</script>


<?php require_once('frd1_footer.php'); ?>   