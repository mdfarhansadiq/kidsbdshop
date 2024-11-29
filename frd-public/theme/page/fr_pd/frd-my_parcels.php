<?php
require_once("frd-public/theme/frd-header-s.php");
$FRc_PAGE_TITEL = "My Parcels - $fr_cname";
$FRc_META_TAG_HTML = "";
require_once("frd-public/theme/frd-header.php");
?>
<!-- <h2 class="PT"> পার্সেল ট্রাকিং </h2> -->
<style>
    body{
        background: #FFF !important;
    }
</style>
<!-- 1 scripts s-->
<section>
<?php 

//FRD VALIDATION CHACKING:-
if(!isset($_SESSION['s_cust_id'])){ FR_GO("$FRD_HURL/?HINKS=HDYHRURIKBNRU8X"); exit;}

$FRc_CustIdx = $_SESSION['s_cust_id'];


//FRD ORDER TABLE DATA READ:-
    $FRR = FR_QSEL("SELECT * FROM frd_pd_orders WHERE fr_s_id = $FRc_CustIdx ORDER BY id DESC LIMIT 0,60","ALL");
     if($FRR['FRA']==1){  
        foreach($FRR['FRD'] as $FR_ITEM){
          extract($FR_ITEM);
          echo "
          
          ";
        }
       } else{ 
        //    PR($FRR);
         FR_SWAL("আপনি এখনো কোন পার্সের বুকিং  করেননি","","info");
         $FRc_Fire_NoParcelFoundSection = "FIRE";
       }



?>
</section>
<!-- 1 scripts e-->
   



<div class="container">
  <div class="row">
    <div class="col-md-12 text-right">
         <h3 class="parcel_deli_link_2"><a href="<?php echo "$FRD_HURL/parcels_delivery";?>" class="btn btn-success"> নতুন পার্সেল বুকিং + </a></h3>
    </div>
  </div>
</div>


<section class="section">
    <div class="container">
        <div class="col-md-12 jumbotron">

         <?php 
           $FRR = FR_QSEL("SELECT * FROM frd_pd_orders WHERE fr_s_id = $FRc_CustIdx ORDER BY id DESC LIMIT 0,60","ALL");
           if($FRR['FRA']==1){ 
                  echo "<table class='table table-bordered'>";
                  echo "
                      <tr class='f4 danger'>
                          <td>ক্রমিক</td>
                          <td>বুকিং আইডি</td>
                          <td>প্রাপক</td>
                          <td>একশন</td>
                      </tr>
                  ";
           
                          $FRc_SL = 1;
                          foreach($FRR['FRD'] as $FR_ITEM){
                              extract($FR_ITEM);
                                  echo "
                                      <tr>
                                          <td>$FRc_SL</td>
                                          <td>#$id</td>
                                          <td>$fr_s_name</td>
                                          <td><a class='btn btn-success' href='$FRD_HURL/track_parcel/$fr_encrip_id'>ট্রাক</a></td>
                                      </tr> 
                                  ";
                                  
                              $FRc_SL = ($FRc_SL + 1);
                          }
                  
                  echo "</table>";
           } else{ 
               //   PR($FRR);
               echo "<br><br><br><br><br><br><br><br>";
             FR_SWAL("আপনি এখনো কোন পার্সের বুকিং  করেননি","","info");
             echo "<div class='text-center alert alert-danger'>আপনি এখনো কোন পার্সের বুকিং  করেননি</div>";
             echo "<br><br><br><br><br><br><br><br>";
           }
         ?>
          

        </div>
    </div>
</section>






<?php require_once("frd-public/theme/frd-footer.php"); ?>