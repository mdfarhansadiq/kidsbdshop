
<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Customer Due Invoices";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Customer Due Invoices </h2>
<!-- 1 SCRIPT S-->
<section> 
<?php
//FRD VALIDATION CHACKING|| ONLY ADMIN CAN ACCESS THIS PAGE:-
if($UsrType != "ad" AND $UsrType != "M" AND $UsrType != "x"){
    FR_SWAL("ACCESS DENIED", "$UsrName", "error");
    FR_GO("$FR_SP_HURL_DP/om-OPS1",3);
    exit;
}
?>
</section>
<!-- 1 SCRIPT E-->





<section>
<div class="container">
<div class="col-md-11">


                <div class="row">          
                    <div class="col-md-12">
   
                      <?php
                        $FRQ = "SELECT id,fr_enc_id,fr_invo_due,fr_cust_name,fr_cust_mob1 FROM  frd_order_invo WHERE fr_stat = 5 AND fr_invo_due > 0 ORDER BY id ASC LIMIT 0,300";
                        // echo "$FRQ";
                        $FRR = FR_QSEL("$FRQ","ALL");
                        if($FRR['FRA']==1){ 
                               echo "<table class='t_print'>";
                               echo "
                                   <tr class='alert alert-danger boldd'>
                                       <td>SL</td>
                                       <td class='text-center'>Invoice Id</td>
                                       <td class='text-left'>Customer Name</td>
                                       <td class='text-left'>Customer Mobile</td>
                                       <td class='text-right'>Current Due</td>
                                   </tr>
                               ";
                        
                                       $FRc_SL = 1;
                                       $FRc_FT_DueAmount = 0;
                                       foreach($FRR['FRD'] as $FR_ITEM){
                                           extract($FR_ITEM);
                                               echo "
                                                   <tr>
                                                       <td>$FRc_SL</td>
                                                       <td class='text-center'>
                                                            <form action='$FR_THISHURL/om-InvoiceEdit/$fr_enc_id' method='POST'>
                                                            <button type='submit' class='btn btn-default btn-xs'> <span class='glyphicon glyphicon-arrow-right'></span> #$id </button>
                                                            </form>
                                                       </td>
                                                       <td>$fr_cust_name</td>
                                                       <td>$fr_cust_mob1</td>
                                                       <td class='text-right'>$fr_invo_due"."৳</td>
                                                   </tr> 
                                               ";
                                               
                                           $FRc_SL = ($FRc_SL + 1);
                                           $FRc_FT_DueAmount = ($FRc_FT_DueAmount + $fr_invo_due);
                                       }
                                       

                                                echo "
                                                   <tr class='alert alert-danger boldd'>
                                                       <td colspan='4' class='text-right'>Total</td>
                                                       <td class='text-right'>".number_format($FRc_FT_DueAmount,2)."৳</td>
                                                   </tr> 
                                               ";
                               
                               echo "</table>";

                               echo "
                               <div class='row'>
                                <div class='col-md-12 mt-10'>
                                    <div class='text-center'>
                                        <button class='btn btn-danger btn-xs' onclick='FRcloseNavLS(),window.print()'><span class='glyphicon glyphicon-print'></span></button>
                                    </div>
                                </div>
                                </div>
                               ";

                        } else{ 
                          //   PR($FRR);
                          echo "<div class='text-center alert alert-danger'> No Data Found </div>";
                        }
                      ?>
                  </div>

                  
                
              </div>


</div>
</div>
</section>




 
 <?php require_once('frd1_footer.php'); ?>