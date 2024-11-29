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

            <div class="row mt-10">
                <div class="col-md-12">
                    <?php
                    $FRQ = "SELECT * FROM  frd_order_items WHERE fr_ppr_qty > 0 AND fr_pprr_stat = 1";
                    $FRQ .= " AND fr_pprr_date BETWEEN '$FRc_SDATE' AND '$FRc_EDATE' ORDER BY fr_pprr_date $f_filt_asc_desc LIMIT 0,$f_filt_limit";
                    // echo "$FRQ";
                    $FRR = FR_QSEL("$FRQ", "ALL");
                    if ($FRR['FRA'] == 1) {
                        echo "<table class='t_print'>";
                        echo "
                                   <tr class='alert alert-success boldd text-center'>
                                       <td colspan='9'>PPR Received Statment Invoice Based <br> <b class='text-primary'>".date('d-M-Y',strtotime("$FRc_SDATE"))."</b> To <b class='text-primary'>".date('d-M-Y',strtotime("$FRc_EDATE"))."</b></td>
                                   </tr>
                                   <tr class='alert alert-success boldd'>
                                       <td>SL</td>
                                       <td class='text-center'>Entry Date</td>
                                       <td class='text-center'>Received Date</td>
                                       <td class='text-center'>Invoice</td>
                                       <td class='text-center'>IMG</td>
                                       <td class='text-left'>Product Name</td>
                                       <td class='text-right'>Price</td>
                                       <td class='text-center'>Qty</td>
                                       <td class='text-right'>Total Price</td>
                                   </tr>
                               ";

                        $FRc_SL = 1;
                        $FRc_FT_PPRPrice = 0;
                        $FRc_FT_PPRQty = 0;
                        foreach ($FRR['FRD'] as $FR_ITEM) {
                            extract($FR_ITEM);
                            echo "
                                                   <tr>
                                                       <td>$FRc_SL</td>
                                                       <td class='text-center'>" . date('d-M-Y', strtotime("$fr_ppr_date")) . "</td>
                                                       <td class='text-center'>" . date('d-M-Y', strtotime("$fr_pprr_date")) . "</td>
                                                       <td class='text-center Frtrig_ViewInvo' frinvoid='$fr_invo_id' role='button'>#$fr_invo_id</td>
                                                       <td class='text-center'><img src='$FRD_HURL/frd-data/img/product/$fr_pro_pic_1' alt='#' width='30px' height='30px'></td>
                                                       <td class='text-left'>$fr_pro_title</td>
                                                       <td class='text-right'>" . number_format($fr_price, 2) . "৳</td>
                                                       <td class='text-center'>$fr_ppr_qty</td>
                                                       <td class='text-right'>" . number_format($fr_ppr_amount, 2) . "৳</td>
    
                                                   </tr> 
                                               ";

                            $FRc_SL = ($FRc_SL + 1);
                            $FRc_FT_PPRPrice = ($FRc_FT_PPRPrice + $fr_ppr_amount);
                            $FRc_FT_PPRQty = ($FRc_FT_PPRQty + $fr_ppr_qty);
                        }


                        echo "
                                                   <tr class='alert alert-success boldd'>
                                                   <td colspan='7' class='text-right'>Total:</td>
                                                   <td class='text-center'>" . number_format($FRc_FT_PPRQty) . "</td>
                                                   <td class='text-right'>" . number_format($FRc_FT_PPRPrice, 2) . "৳</td>
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
                    } else {
                        //   PR($FRR);
                        echo "<div class='text-center alert alert-danger'> No Partial Product Receiving Found </div>";
                    }
                    ?>
                </div>
            </div>