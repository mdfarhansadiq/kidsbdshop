<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Rating Review Pending";//PAGE TITLE
$p="RatingReviewPending";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<!-- <h2 class="PT"> Page List</h2> -->

<!-- 1 SCRIPT START -->   
<section>
<?php 
extract(FRF_T_PENDING_RR_C());
?>   
</section>
<!-- 1 SCRIPT END -->    




<br>
<section>
<div class="container">
<div class="col-md-11">

<span class="label label-danger"><?php echo "Pending Rating Review: $FRc_T_PENDING_RR_C";?></span>




  <div class="row">
    <div class="col-md-12">
        <?php
         $FRR = FR_QSEL("SELECT * FROM frd_order_items WHERE fr_stat = 5 AND fr_rr_stat = 0 ORDER BY id ASC LIMIT 0,30","ALL");
         if($FRR['FRA']==1){ 
                echo "<table class='table table-bordered'>";
                echo "
                    <tr class='h6 text-white bg-dark'>
                        <td>SL</td>
                        <td>Product</td>
                        <td>Customer</td>
                        <td class='text-right'> </td>
                    </tr>
                ";
         
                        $FRc_SL = 1;
                        foreach($FRR['FRD'] as $FR_ITEM){
                            extract($FR_ITEM);
                            extract(FR_USR_MINI_INFO($fr_cust_id));
                                echo "
                                    <tr>
                                        <td>$FRc_SL</td>
                                        <td>
                                        <img class='' src='$FRD_HURL/frd-data/img/product/$fr_pro_pic_1' alt='#' width='60px' height='60%' >
                                        </td>
                                        <td>
                                        <img class='' src='$FRD_HURL/frd-data/img/customer/$FRc_USR_PIC' alt='#' width='60px' height='60%' > <br>
                                        [#$fr_cust_id] $FRc_USR_NAME <br> $FRc_USR_MOBILE1
                                        </td>
                                        <td class='text-right'>
                                            <a class='btn btn-danger' href='$FRD_HURL/rating-review-give/".base64_encode($fr_cust_id)."/".base64_encode($FRc_USR_REG_TIME)."' target='_blank'> <span class='glyphicon glyphicon-flash' ></span>Give Rating Review</a>
                                          </td>
                                    </tr> 
                                ";
                                
                            $FRc_SL = ($FRc_SL + 1);
                        }
                
                echo "</table>";
         } else{ 
           //   PR($FRR);
           echo "<div class='text-center alert alert-danger'>No Data Found</div>";
         }
        ?>
    </div>
  </div>



</div>
</div>
</section>






<?php require_once('frd1_footer.php'); ?>   