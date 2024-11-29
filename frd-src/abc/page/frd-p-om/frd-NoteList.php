<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Note List";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Note List</h2>

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
                //   $FRR = FR_QSEL("SELECT *,COUNT(id) AS FRc_TotalNotes FROM frd_order_p_note GROUP BY fr_opn_order_id ORDER BY fr_opn_time DESC LIMIT 0,300","ALL");
                  $FRR = FR_QSEL("SELECT DISTINCT fr_opn_order_id FROM frd_order_p_note ORDER BY fr_opn_time DESC LIMIT 0,300","ALL");
                  if($FRR['FRA']==1){ 
                         echo "<div class='table-responsive'>";
                         echo "<table class='table table-bordered'>";
                         echo "
                             <tr class='h6 alert alert-success'>
                                 <td>SL</td>
                                 <td>Order Id</td>
                                 <td>Note</td>
                                 <td>By</td>
                                 <td>Time</td>
                             </tr>
                         ";
                  
                                 $FRc_SL = 1;
                                 foreach($FRR['FRD'] as $FR_ITEM){
                                     extract($FR_ITEM);

                                        $FRQ = $FR_CONN->query("SELECT * FROM frd_order_p_note WHERE fr_opn_order_id = $fr_opn_order_id ORDER BY id DESC");
                                        $row = $FRQ->fetch();
                                        $fr_opn_note = $row['fr_opn_note'];
                                        $fr_opn_by_name = $row['fr_opn_by_name'];
                                        $fr_opn_time = $row['fr_opn_time'];
                                        $FRc_OPN_Time = date('d-M-Y h:i A',$fr_opn_time);

                                         echo "
                                             <tr>
                                                 <td>$FRc_SL</td>
                                                 <td> 
                                                   #$fr_opn_order_id <br>
                                                   <a class='btn btn-success btn-xs btn-block' href='$FR_THISHURL/om-InvoToEditLink/$fr_opn_order_id'> <span class='glyphicon glyphicon-pencil'></span> </a>
                                                 </td>
                                                 <td>$fr_opn_note</td>
                                                 <td><small>$fr_opn_by_name</small></td>
                                                 <td><small>$FRc_OPN_Time</small></td>
                                             </tr> 
                                         ";
                                         
                                     $FRc_SL = ($FRc_SL + 1);
                                 }
                         
                         echo "</table>";
                         echo "</div>";
                  } else{ 
                    //   PR($FRR);
                    echo "<div class='text-center alert alert-danger'>No Notes Found</div>";
                  }
                ?>
            </div>
        </div>


    </div>
    </div>
</section>




<?php require_once('frd1_footer.php'); ?>   