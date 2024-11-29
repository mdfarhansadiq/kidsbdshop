<?php 
$FR_OP_HTML = "";
//FRD VC NEED:-
    $FR_VC_SESSION = "";
    $FR_VC_POST = "";
    
//FRD VC________
    if(isset($_SESSION['sUsrId'])){ extract($_SESSION); $FR_VC_SESSION = 1; } else{ $FR_OP_HTML .= "<h6>Access Denied 1  </h6>"; exit; }


//FRD VC________
if( isset($_POST['f_filt_SDATE'])){
        $FRc_SDATE = $_POST['f_filt_SDATE'];
        $FRc_EDATE = $_POST['f_filt_EDATE'];
        $f_filt_asc_desc = $_POST['f_filt_asc_desc'];
        $f_filt_limit = $_POST['f_filt_limit'];
        $FR_VC_POST = 1; 
}else{
    echo "<h6>Access Denied 2  </h6>"; exit;
}
?>


                <div class="row">          
                    <div class="col-md-12">
                      <?php
                        $FRQ = "SELECT fr_pprr_date, SUM(fr_ppr_amount) AS FRc_T_PPR_ReceivedProPrice, SUM(fr_ppr_qty) AS FRc_T_PPR_ReceivedProQty FROM  frd_order_items WHERE fr_pprr_stat = 1";
                       $FRQ .= " AND fr_pprr_date BETWEEN '$FRc_SDATE' AND '$FRc_EDATE' GROUP BY fr_pprr_date ORDER BY fr_pprr_date $f_filt_asc_desc LIMIT 0,$f_filt_limit";
                        // echo "$FRQ";
                        $FRR = FR_QSEL("$FRQ","ALL");
                        if($FRR['FRA']==1){ 
                               echo "<table class='t_print'>";
                               echo "
                                   <tr class='alert alert-success boldd text-center'>
                                       <td colspan='4'>PPR Received Statment Daily Based <br> <b class='text-primary'>".date('d-M-Y',strtotime("$FRc_SDATE"))."</b> To <b class='text-primary'>".date('d-M-Y',strtotime("$FRc_EDATE"))."</b></td>
                                   </tr>
                               ";
                               echo "
                                   <tr class='alert alert-success boldd'>
                                       <td>SL</td>
                                       <td>PPR Received Date</td>
                                       <td class='text-right'>PPR Received Product Qty</td>
                                       <td class='text-right'>PPR Received Product Price</td>
                                   </tr>
                               ";
                        
                                       $FRc_SL = 1;
                                       $FRc_FT_ReceivedProductQty = 0;
                                       $FRc_FT_ReceivedProductPrice = 0;
                                       foreach($FRR['FRD'] as $FR_ITEM){
                                           extract($FR_ITEM);
                                               echo "
                                                   <tr>
                                                       <td>$FRc_SL</td>
                                                       <td>".date('D d-M-Y',strtotime("$fr_pprr_date")) ."</td>
                                                       <td class='text-right'>$FRc_T_PPR_ReceivedProQty</td>
                                                       <td class='text-right'>$FRc_T_PPR_ReceivedProPrice"."৳</td>
                                                   </tr> 
                                               ";
                                               
                                           $FRc_SL = ($FRc_SL + 1);
                                           $FRc_FT_ReceivedProductQty = ($FRc_FT_ReceivedProductQty + $FRc_T_PPR_ReceivedProQty);
                                           $FRc_FT_ReceivedProductPrice = ($FRc_FT_ReceivedProductPrice + $FRc_T_PPR_ReceivedProPrice);
                                       }
                                       

                                                echo "
                                                   <tr class='alert alert-success boldd'>
                                                       <td colspan='2' class='text-right'>Total</td>
                                                       <td class='text-right'>".number_format($FRc_FT_ReceivedProductQty)."</td>
                                                       <td class='text-right'>".number_format($FRc_FT_ReceivedProductPrice,2)."৳</td>
                                                   </tr> 
                                               ";
                               
                               echo "</table>";

                               echo "
                               <div class='row'>
                                <div class='col-md-12 mt-10'>
                                    <div class='text-center'>
                                        <button class='btn btn-success btn-xs' onclick='FRcloseNavLS(),window.print()'><span class='glyphicon glyphicon-print'></span></button>
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