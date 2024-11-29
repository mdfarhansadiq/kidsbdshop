<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Complaint Resolved List";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT">Complaint Resolved</h2>

<!-- 1 SCRIPT START -->   
<section>
<?php 

?>   
</section>
<!-- 1 SCRIPT END -->    

   


<section>
    <div class="container">
    <div class="col-md-11">

        <div class="row">
            <div class="col-md-12">
                <?php 
                  $FRR = FR_QSEL("SELECT * FROM frd_order_invo WHERE fr_c_stat = 2 LIMIT 0,300","ALL");
                  if($FRR['FRA']==1){ 
                         echo "<div class='table-responsive'>";
                         echo "<table class='table table-bordered'>";
                         echo "
                             <tr class='alert alert-success boldd'>
                                 <td>SL</td>
                                 <td>Order Id</td>
                                 <td>Customer</td>
                                 <td>Complain</td>
                             </tr>
                         ";
                  
                                 $FRc_SL = 1;
                                 foreach($FRR['FRD'] as $FR_ITEM){
                                     extract($FR_ITEM);

                                        $FRQ = $FR_CONN->query("SELECT * FROM frd_order_p_note WHERE fr_opn_order_id = $id AND fr_opn_note LIKE '%Complain:%' ORDER BY id DESC");
                                        $row = $FRQ->fetch();
                                        $fr_opn_note = $row['fr_opn_note'];
                                        $fr_opn_by_name = $row['fr_opn_by_name'];
                                        $fr_opn_time = $row['fr_opn_time'];
                                        $FRc_OPN_Time = date('d-M-Y h:i A',$fr_opn_time);

                                    
                                         echo "
                                             <tr>
                                                 <td>$FRc_SL</td>
                                                 <td> 
                                                   #$id <br>

                                                   <a class='btn btn-danger btn-xs' href='$FR_THISHURL/om-InvoiceEdit/$fr_enc_id'> <span class='glyphicon glyphicon-pencil'></span> </a>
                                                 </td>
                                                 <td width='200px'> 
                                                   $fr_cust_name <br>
                                                   $fr_cust_mob1 <br>
                                                   $fr_cust_addres
                                                 </td>
                                                 <td>
                                                   $fr_opn_note  <br><br>
                                                  <small>[Time: $FRc_OPN_Time]</small> <br>
                                                  <small>[By: $fr_opn_by_name]</small>
                                                 </td>
                                             </tr> 
                                         ";
                                         
                                     $FRc_SL = ($FRc_SL + 1);
                                 }
                         
                         echo "</table>";
                         echo "</div>";
                  } else{ 
                    //   PR($FRR);
                    echo "<div class='text-center alert alert-danger'>No Resolved Complain Found</div>";
                  }
                ?>
            </div>
        </div>


    </div>
    </div>
</section>




<?php require_once('frd1_footer.php'); ?>   