<?php 
require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "My Orders - $fr_cname";
$FRc_META_TAG_HTML = "";
require_once("frd-this-header.php");
require_once("frd-public/theme/frd-header.php");
?>
<h2 class="PT"> আমার অর্ডার সমূহ </h2>
<style>

</style>
<!-- 1 scripts s-->
<section>
<?php

    
    
?>
</section>
<!-- 1 scripts e-->
   

   







<section class="section">
    <div class="container">
        <div class="col-md-12 jumbotron">

         <?php 
           $FRR = FR_QSEL("SELECT * FROM frd_order_invo WHERE fr_cust_id = $FR_CustIdx ORDER BY id DESC LIMIT 0,60","ALL");
           if($FRR['FRA']==1){ 
                  echo "<div class='table-responsive'>";
                  echo "<table class='table table-bordered'>";
                  echo "
                      <tr class='f4 danger'>
                          <td>ক্রমিক</td>
                          <td class='text-center'>ইনভয়েস আইডি</td>
                          <td class='text-right'>উপ মোট</td>
                          <td class='text-right'>একশন</td>
                          <td class='text-right'>অর্ডার তারিখ</td>
                      </tr>
                  ";
           
                          $FRc_SL = 1;
                          foreach($FRR['FRD'] as $FR_ITEM){
                              extract($FR_ITEM);
                                  echo "
                                      <tr>
                                          <td>$FRc_SL</td>
                                          <td class='text-center'>#$id</td>
                                          <td class='text-right'>$fr_sub_total ৳</td>
                                          <td class='text-right'><a class='btn btn-success' href='$FRD_HURL/track/$fr_enc_id'>বিস্তারিত দেখুন</a></td>
                                          <td class='text-right'>".date('d-M-Y',$fr_o_time)."</td>
                                      </tr> 
                                  ";
                                  
                              $FRc_SL = ($FRc_SL + 1);
                          }
                  
                  echo "</table>";
                  echo "</div>";
           } else{ 
               //   PR($FRR);
               echo "<br><br><br><br><br><br><br><br>";
               FR_SWAL("আপনি এখনো কোন অর্ডার  করেননি","","info");
               echo "<br><br><br><br><br><br><br><br>";
           }
         ?>
          

        </div>
    </div>
</section>












<script type="text/javascript">
    $(document).ready(function(){
        
    });
</script>

<?php 
require_once("frd-this-footer.php");
require_once("frd-public/theme/frd-footer.php");
?>