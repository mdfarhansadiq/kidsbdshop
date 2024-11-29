<?php 
$FR_OP_HTML = "";
//FRD VC NEED:-
    $FR_VC_SESSION = "";
    $FR_VC_POST = "";
    
//FRD VC________
    if(isset($_SESSION['sUsrId'])){ extract($_SESSION); $FR_VC_SESSION = 1; } else{ $FR_OP_HTML .= "<h6>Access Denied 1  </h6>"; exit; }

//FRD VC________
if( isset($_POST['f_a'])){
        $FR_VC_POST = 1;
}else{
    echo "<h6>Access Denied 2  </h6>"; exit;
}
?>


                <div class="row">          
                    <div class="col-md-12">
                      <?php
    
                        //FRD QUICK DATA READ 2:-
                        $FRR = FR_QSEL("SELECT r_supplier FROM frd_order_items WHERE fr_stat = 2 GROUP BY r_supplier","ALL");
                        if($FRR['FRA']==1){  
                        foreach($FRR['FRD'] as $FR_ITEM){
                            extract($FR_ITEM);
                            extract(FRF_NAME_SUPPLIER($r_supplier));


                            //FRD MAIN SCRIPT START:-
                               $FRQ = "SELECT *,COUNT(id) AS FRc_T_SealsItems, SUM(fr_qty) AS FRc_T_SellsQty, SUM(fr_t_price) AS FRc_T_SellsPrice FROM frd_order_items WHERE fr_stat = 2 AND r_supplier = $r_supplier";
                                $FRQ .= " GROUP BY fr_pro_id LIMIT 0,3000";

                                // echo "$FRQ";
                                $FRR = FR_QSEL("$FRQ","ALL");
                                if($FRR['FRA']==1){ 
                                    echo "<table class='t_print'>";
                                    echo "
                                        <tr class='alert alert-success boldd text-center'>
                                            <td colspan='10'>Supplier <b class='text-danger'>$FRc_NAME_SUPPLIER (#$r_supplier)</b> Product Collection Checklist <br> <b class='text-primary'></b></td>
                                        </tr>
                                    ";
                                    echo "
                                        <tr class='alert alert-success boldd'>
                                            <td>SL</td>
                                            <td>Image</td>
                                            <td title='Product Id'>P ID</td>
                                            <td class='text-left'>Product</td>
                                            <td class='text-left'>Invoice</td>
                                            <td class='text-left'>Size</td>
                                            <td class='text-center'>Sales Items</td>
                                            <td class='text-center'>Quantity</td>
                                        </tr>
                                    ";
                                
                                            $FRc_SL = 1;
                                            $FRc_FT_SellsItems = 0;
                                            $FRc_FT_SellsQty = 0;
                                            $FRc_FT_BuyPrice = 0;
                                            foreach($FRR['FRD'] as $FR_ITEM){
                                                extract($FR_ITEM);

                                                    //FRD IVOICE ALL ITEM FETCH:-
                                                        $FRc_InvoiceIdHtml = "";
                                                        $FRc_InvoiceSizeHtml = "";
                                                        if(1 == 1){
                                                            $FRR = FR_QSEL("SELECT fr_invo_id,fr_size_name FROM frd_order_items WHERE fr_pro_id = $fr_pro_id AND fr_stat = 2", "ALL");
                                                            if ($FRR['FRA'] == 1) {
                                                                foreach ($FRR['FRD'] as $FR_ITEM) {
                                                                    extract($FR_ITEM);
                                                                    $FRc_InvoiceIdHtml .= "<h6>$fr_invo_id</h6>";
                                                                    $FRc_InvoiceSizeHtml .= "<h6>$fr_size_name</h6>";
                                                            }
                                                            } else {
                                                                PR($FRR);
                                                            }
                                                        }
                                                    //END>


                                                    echo "
                                                        <tr>
                                                            <td>$FRc_SL</td>
                                                            <td><img src='$FRD_HURL/frd-data/img/product/$fr_pro_pic_1' style='width: auto; height: 50px'/></td>
                                                            <td>#$fr_pro_id</td>
                                                            <td class='text-left'>$fr_pro_title</td>
                                                            <td class='text-left'>$FRc_InvoiceIdHtml</td>
                                                            <td class='text-left'>$FRc_InvoiceSizeHtml</td>
                                                            <td class='text-center'>$FRc_T_SealsItems</td>
                                                            <td class='text-center'>$FRc_T_SellsQty</td>
                                                        </tr> 
                                                    ";
                                                    
                                                $FRc_SL = ($FRc_SL + 1);
                                                $FRc_FT_SellsItems = ($FRc_FT_SellsItems + $FRc_T_SealsItems);
                                                $FRc_FT_SellsQty = ($FRc_FT_SellsQty + $FRc_T_SellsQty);
                                            }
                                            

                                                        echo "
                                                        <tr class='alert alert-success boldd'>
                                                            <td colspan='6' class='text-right'>Total</td>
                                                            <td class='text-center'>".number_format($FRc_FT_SellsItems)."</td>
                                                            <td class='text-center'>".number_format($FRc_FT_SellsQty)."</td>
                                                        </tr> 
                                                    ";
                                    
                                    echo "</table>";

                                } else{ 
                                    //   PR($FRR);
                                    echo "<div class='text-center alert alert-danger'> No Data Found </div>";
                                }

                                echo "<br><br>";
                                echo "<p style='page-break-after: always;'></p>";
                                echo "<br><br>";
                            //FRD MAIN SCRIPT END>>
                        }
                        } else{ 
                            // PR($FRR);
                            ECHO_4("NO DATA FOUND","text-center text-danger alert alert-danger boldd");
                        }
                        //END>>



                                     echo "
                                    <div class='row'>
                                        <div class='col-md-12 mt-10'>
                                            <div class='text-center'>
                                                <button class='btn btn-success btn-xs' onclick='FRcloseNavLS(),window.print()'><span class='glyphicon glyphicon-print'></span></button>
                                            </div>
                                        </div>
                                        </div>
                                    ";
                      ?>
                  </div>

                  
                
              </div>