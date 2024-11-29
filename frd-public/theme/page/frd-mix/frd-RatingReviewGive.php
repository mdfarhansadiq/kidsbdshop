<?php
require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "Product Rating Review Give - $fr_cmetatitle";
$FRc_META_TAG_HTML = "";
require_once("frd-public/theme/frd-header.php");
?>
<!-- <h2 class="PT"> PRODUCT RATING REVIEW GIVE </h2> -->
<!-- 1 scripts s-->


<section>
<?php 

//FRD_VC___________________________VALIDATION CHACKING:-
    if(!isset($url[2])){FR_GO("$FRD_HURL/?FRH=JDOE8HJDUUSDX");}

//FRD:-
$FRc_CustomerIdx = base64_decode($url[1]);
$FRc_CustomerPswx = base64_decode($url[2]);
$FR_THIS_PAGE = "$FR_THISPAGE/".$url[1]."/".$url[2]."";



//FRD CUSTOMER TABLE DATA READ:-
    $FRR = FR_QSEL("SELECT * FROM frd_usr WHERE typee = 'cu' AND id = $FRc_CustomerIdx AND timee = $FRc_CustomerPswx","");
    if($FRR['FRA']==1){ 
      extract($FRR['FRD']);
    }else{ 
        FR_GO("$FRD_HURL/FRH=hdiiwwkx"); exit;
    }
//END>>



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

        $FRc_ProductId = base64_decode(base64_decode(base64_decode($f_product_id)));
        $FRc_InvoItemId = base64_decode(base64_decode(base64_decode($f_invoice_item_id)));


                if($FR_VC_DATA_PROCESS == 1 and $FR_VC_ARF==1){

                        $arr = array();
                        $arr['fr_rr_pro_id'] = $FRc_ProductId;
                        $arr['fr_rr_cust_id'] = $FRc_CustomerIdx;
                        $arr['fr_rating'] = $f_star_rate;
                        $arr['fr_review'] = "$f_review_text";
                        $arr['fr_rr_stat'] = 0;
                        $arr['fr_rr_date'] = "$FR_NOW_DATE";
                        $arr['fr_rr_time'] = "$FR_NOW_TIME";
                        $FRR = FR_DATA_IN("frd_rating_review",$arr);
                        if($FRR['FRA']==1){
                            //FRD INVOICE ITEM UPDATE:-
                                try{
                                    $FR_CONN->exec("UPDATE frd_order_items SET fr_rr_stat = 1 WHERE id = $FRc_InvoItemId");
                                }catch(PDOException $e){
                                    FR_TAL("ORDER ITEM UPDATE FAILED","error");
                                }
                            //END>>

                            FR_SWAL("Review Add Done","","success");
                            FR_GO("$FR_THIS_PAGE",1); 
                            exit;
                        }else{
                            FR_SWAL("Review Add Done",$R['FRM'],"error");
                        }
                }
                        
}
THIS_LAST:
//END ADD>>



extract(FRF_T_PENDING_RR_C($FRc_CustomerIdx));


?>
</section>
<!-- 1 scripts e-->
   





<br>
<div class="container">

  <div class="row">
    <div class="col-md-3">
    <span class="label label-primary"><?php echo "Pending $FRc_T_PENDING_RR_C";?></span>
    </div>
    <div class="col-md-6 text-center">

       <?php 
        $FRR = FR_QSEL("SELECT * FROM frd_order_items WHERE fr_cust_id = $FRc_CustomerIdx AND fr_stat = 5 AND fr_rr_stat = 0 ORDER BY id ASC LIMIT 0,1","");
        if($FRR['FRA']==1){ 
          extract($FRR['FRD']);
          
        ?>

        <div class="div jumbotron">
            <img src="<?php echo "$FRD_HURL/frd-data/img/product/$fr_pro_pic_1";?>" alt="#" style='height:100px;width:auto;margin:auto;'>
             <h6><?php echo "$fr_pro_title";?></h6>
            <form action="" method="POST">
                <div class="FrStarRate">
                    <span class="star1 star checked" frid="1">★</span>
                    <span class="star2 star checked" frid="2">★</span>
                    <span class="star3 star checked" frid="3">★</span>
                    <span class="star4 star checked" frid="4">★</span>
                    <span class="star5 star checked" frid="5">★</span>
                </div>

                <input type="hidden" value="5" name="f_star_rate" id="f_star_rate">
                <input type="hidden" value="<?php echo base64_encode(base64_encode(base64_encode($fr_pro_id)));?>" name="f_product_id">
                <input type="hidden" value="<?php echo base64_encode(base64_encode(base64_encode($id)));?>" name="f_invoice_item_id">
                <textarea class="form-control" name="f_review_text" id="" cols="30" rows="3" placeholder="রিভিউ লিখুন" required></textarea>
                <br>
                <div class='text-right'>
                    <button type='submit' class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> নিশ্চিত </button>
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








  <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6 FrRatingReviewList">
            <?php
              $FRR = FR_QSEL("SELECT * FROM frd_rating_review WHERE fr_rr_cust_id = $FRc_CustomerIdx ORDER BY id DESC LIMIT 0,30","ALL");
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







<script>
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



<?php require_once("frd-public/theme/frd-footer.php");?>