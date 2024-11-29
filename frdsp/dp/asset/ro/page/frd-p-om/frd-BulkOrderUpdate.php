<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Bulk Order Update";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Bulk Order Update </h2>
<!-- 1 SCRIPT S-->
<section> 
<?php


//---------------------------------------------------------
//FRD  
//---------------------------------------------------------
if(isset($_POST['f_chacked_orders_id'])){
    // PR($_POST);

    //FRD VC NEED:-
        $FR_VC_DATA_PROCESS = "";
        $FR_VC_ARF = "";//ALL REQUIRED FILD
    
	
        $FRc_OrdersIdsArr = $_POST['f_chacked_orders_id'];
        $FRc_bulk_next_status = $_POST['f_bulk_next_status'];
	
    //FRD_VC___________DATA PROSESSED OR NOT:-
        if(isset($FRc_bulk_next_status)){  $FR_VC_DATA_PROCESS = 1; }else{ FR_SWAL("Data Process Failed","","error");}

    //FRD_VC___________ALL REQUIRED FILED:-
        if($FRc_bulk_next_status != ""){ $FR_VC_ARF = 1; }else{  
            FR_SWAL("$UsrName Select Next Order Status","","error"); 
            FR_GO("om-InvoiceList?=FRH=HDHDUYUMXX","4");
            exit;
        }



        if($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1){



                //FRD BULK PRINT DONE UPDATE START:-
                if($FRc_bulk_next_status == "PrintDone"){
                    $FRc_SL = 1;
                    foreach($FRc_OrdersIdsArr AS $FRc_OrderId){
                        $FRQ = $FR_CONN->query("SELECT fr_o_pros_history,fr_stat FROM frd_order_invo WHERE id = $FRc_OrderId");
                        $FRSD = $FRQ->fetch();
                        $fr_stat = $FRSD['fr_stat'];
                        $fr_o_pros_history = $FRSD['fr_o_pros_history'];
                        $FRc_OrderProsHistory = "$fr_o_pros_history, প্রিন্ট করা হয়েছে <small>[By $UsrName]</small> * ".date('d-M-Y h:i A',$FR_NOW_TIME)."";


                        if($fr_stat == 2 || $fr_stat == 12){
                            $FRQ = "UPDATE frd_order_invo SET 
                            fr_stat = 11,
                            fr_o_print_date = '$FR_NOW_DATE',
                            fr_o_print_time = '$FR_NOW_TIME',
                            fr_o_print_by = '$UsrId',
                            fr_o_pros_history = '$FRc_OrderProsHistory'
                            WHERE id = $FRc_OrderId";
                            // echo "$FRQ";
                            $R = FR_DATA_UP("$FRQ");
                            if ($R['FRA'] == 1) {
                               
                                //FRD ORDER ITEM TABLE STATUS UPDATE:-
                                try{
                                    $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 11 WHERE fr_invo_id = $FRc_OrderId");
                                    //  FR_TAL("Items Update Done", "success");
                                     echo "<h4 class='text-success text-center'>SL:$FRc_SL + Order:#$FRc_OrderId + Print Complete! </h4>";
                                }catch(PDOException $e){
                                    FR_TAL("Items Update Failed", "error");
                                    echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                                }
                                //END>>

                            } else {
                                echo "<h3 class='text-danger text-center'>SL:$FRc_SL + Order:# $FRc_OrderId + Print complete! </h3>";
                            }
                        }else{
                            echo "<div class='alert alert-danger'>Status Not Update #$FRc_OrderId Because Order Current Status Not Valid! </div>";
                        }

                      $FRc_SL = ($FRc_SL + 1);
                    }
                }
                //END>>


                //FRD BULK PAKING DONE UPDATE START:-
                if($FRc_bulk_next_status == "PackingDone"){
                    $FRc_SL = 1;
                    foreach($FRc_OrdersIdsArr AS $FRc_OrderId){
                        $FRQ = $FR_CONN->query("SELECT fr_o_pros_history,fr_stat FROM frd_order_invo WHERE id = $FRc_OrderId");
                        $FRSD = $FRQ->fetch();
                        $fr_stat = $FRSD['fr_stat'];
                        $fr_o_pros_history = $FRSD['fr_o_pros_history'];
                        $FRc_OrderProsHistory = "$fr_o_pros_history, প্যাকেজিং করা হয়েছে <small>[By $UsrName]</small> * ".date('d-M-Y h:i A',$FR_NOW_TIME)."";


                        if($fr_stat == 2){
                            $FRQ = "UPDATE frd_order_invo SET 
                            fr_stat = 3,
                            fr_o_pack_date = '$FR_NOW_DATE',
                            fr_o_pack_time = '$FR_NOW_TIME',
                            fr_o_pack_by = '$UsrId',
                            fr_o_pros_history = '$FRc_OrderProsHistory'
                            WHERE id = $FRc_OrderId AND fr_stat = 2";
                            // echo "$FRQ";
                            $R = FR_DATA_UP("$FRQ");
                            if ($R['FRA'] == 1) {
                               
                                //FRD ORDER ITEM TABLE STATUS UPDATE:-
                                try{
                                    $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 3, fr_o_pack_date = '$FR_NOW_DATE' WHERE fr_invo_id = $FRc_OrderId");
                                    //  FR_TAL("Items Update Done", "success");
                                     echo "<h4 class='text-success text-center'>SL:$FRc_SL + Order:#$FRc_OrderId + Packing Done! </h4>";
                                }catch(PDOException $e){
                                    FR_TAL("Items Update Failed", "error");
                                    echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                                }
                                //END>>

                            } else {
                                echo "<h3 class='text-danger text-center'>$L:$FRc_SL + Order:#$FRc_OrderId + Packing Failed! </h3>";
                            }
                        }else{
                            echo "<div class='alert alert-danger'>Status Not Update #$FRc_OrderId Because Order Current Status Not Valid! (Received status orders allow only) </div>";
                        }

                      $FRc_SL = ($FRc_SL + 1);
                    }
                }
                //END>>




                //FRD BULK Entry Complete UPDATE START:-
                if($FRc_bulk_next_status == "EntryComplete"){
                    $FRc_SL = 1;
                    foreach($FRc_OrdersIdsArr AS $FRc_OrderId){
                        $FRQ = $FR_CONN->query("SELECT fr_o_pros_history,fr_stat,fr_ship_p_id,fr_cust_name FROM frd_order_invo WHERE id = $FRc_OrderId");
                        $FRSD = $FRQ->fetch();
                        $fr_stat = $FRSD['fr_stat'];
                        $fr_ship_p_id = $FRSD['fr_ship_p_id'];
                        $fr_cust_name = $FRSD['fr_cust_name'];
                        $fr_o_pros_history = $FRSD['fr_o_pros_history'];

            
                        $FRc_ShipPartName = "NA";
                            if($fr_ship_p_id != ""){
                                extract(FRF_SHIP_PART_NAME($fr_ship_p_id));
                                $FRc_ShipPartName = $FRc_SHIP_PART_NAME;
                            }

                        $FRc_OrderProsHistory = "$fr_o_pros_history, প্রিয় $fr_cust_name! আপনার অর্ডারটি পিকআপ রিকোয়েস্ট পাঠানো হয়েছে $FRc_ShipPartName কুরিয়ারে। <small>[By $UsrName]</small> * " . date('d-M-Y h:i A', $FR_NOW_TIME) . "";


                        if($fr_stat == 2 || $fr_stat == 11){
                            $FRQ = "UPDATE frd_order_invo SET 
                            fr_stat = 12,
                            fr_o_entry_date = '$FR_NOW_DATE',
                            fr_o_entry_time = '$FR_NOW_TIME',
                            fr_o_entry_by = '$UsrId',
                            fr_o_pros_history = '$FRc_OrderProsHistory'
                            WHERE id = $FRc_OrderId";
                            // echo "$FRQ";
                            $R = FR_DATA_UP("$FRQ");
                            if ($R['FRA'] == 1) {
                                //FRD ORDER ITEM TABLE STATUS UPDATE:-
                                try{
                                    $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 12 WHERE fr_invo_id = $FRc_OrderId");
                                    //  FR_TAL("Items Update Done", "success");
                                     echo "<h4 class='text-success text-center'>SL:$FRc_SL + Order:#$FRc_OrderId + Entry Complete! </h4>";
                                }catch(PDOException $e){
                                    FR_TAL("Items Update Failed", "error");
                                    echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                                }
                                //END>>

                            } else {
                                echo "<h3 class='text-danger text-center'>SL:$FRc_SL + Order:# $FRc_OrderId + Entry Failed! </h3>";
                            }
                        }else{
                            echo "<div class='alert alert-danger'>Status Not Update #$FRc_OrderId Because Order Current Status Not Valid! (Only Print Complete Allowed) </div>";
                        }

                      $FRc_SL = ($FRc_SL + 1);
                    }
                }
                //END>>



                //FRD BULK SHIPED DONE UPDATE START:-
                if($FRc_bulk_next_status == "ShippedDone"){

                        $FRc_SL = 1;
                        foreach($FRc_OrdersIdsArr AS $FRc_OrderId){
                            $FRQ = $FR_CONN->query("SELECT fr_o_pros_history,fr_stat,fr_ship_p_id,fr_ship_track_code FROM frd_order_invo WHERE id = $FRc_OrderId");
                            $FRSD = $FRQ->fetch();
                            $fr_stat = $FRSD['fr_stat'];
                            $fr_ship_p_id = $FRSD['fr_ship_p_id'];
                            $fr_ship_track_code = $FRSD['fr_ship_track_code'];
                            $fr_o_pros_history = $FRSD['fr_o_pros_history'];

                            $FRc_ShipPartName = "NA";
                            if($fr_ship_p_id != ""){
                                extract(FRF_SHIP_PART_NAME($fr_ship_p_id));
                                $FRc_ShipPartName = $FRc_SHIP_PART_NAME;
                            }
                            

                            $FRc_OrderProsHistory = "$fr_o_pros_history, পার্সেলটি $FRc_ShipPartName কুরিয়ারে বুকিং দেওয়া হয়েছে। বুকিং কোড: $fr_ship_track_code <small>[By  $UsrName]</small> * ".date('d-M-Y h:i A',$FR_NOW_TIME)."";
    
    
                            if($fr_stat == 2 || $fr_stat == 11 || $fr_stat == 3 || $fr_stat == 12 || $fr_stat == 13 || $fr_stat == 14){
                                $FRQ = "UPDATE frd_order_invo SET 
                                fr_stat = 4,
                                fr_o_ship_date = '$FR_NOW_DATE',
                                fr_o_ship_time = '$FR_NOW_TIME',
                                fr_o_ship_by = '$UsrId',
                                fr_o_pros_history = '$FRc_OrderProsHistory'
                                WHERE id = $FRc_OrderId";
                                // echo "$FRQ";
                                $R = FR_DATA_UP("$FRQ");
                                if ($R['FRA'] == 1) {
                            
                                    //FRD ORDER ITEM TABLE STATUS UPDATE:-
                                    try{
                                        $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 4, fr_o_ship_date = '$FR_NOW_DATE' WHERE fr_invo_id = $FRc_OrderId");
                                        echo "<h4 class='text-success text-center'>SL:$FRc_SL + #$FRc_OrderId Order Shipped! </h4>";
                                    }catch(PDOException $e){
                                        FR_TAL("Items Update Failed", "error");
                                        echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                                    }
                                    //END>>

                                } else {
                                    echo "<h3 class='text-danger text-center'>SL:$FRc_SL + #$FRc_OrderId Order Shipped Failed! </h3>";
                                }
                            }else{
                                echo "<h6 class='text-danger text-center'>SL:$FRc_SL + Status Not Update #$FRc_OrderId Because This Order Status Not Valid! + (Confirm Or Print Or Pack Or Entry Or Stock Out Or Schedule orders allow only) </h6>";
                            }

                            $FRc_SL = ($FRc_SL + 1);
                        }
                }
                //END>>



                //FRD BULK Delivery Complete UPDATE START:-
                if($FRc_bulk_next_status == "DeliveryComplete"){

                        $FRc_SL = 1;
                        foreach($FRc_OrdersIdsArr AS $FRc_OrderId){
                            $FRQ = $FR_CONN->query("SELECT fr_enc_id,fr_cust_id,fr_cust_name,fr_cust_mob1,fr_o_pros_history,fr_stat FROM frd_order_invo WHERE id = $FRc_OrderId");
                            $FRSD = $FRQ->fetch();
                            $fr_enc_id = $FRSD['fr_enc_id'];
                            $fr_cust_id = $FRSD['fr_cust_id'];
                            $fr_cust_name = $FRSD['fr_cust_name'];
                            $fr_cust_mob1 = $FRSD['fr_cust_mob1'];
                            $fr_stat = $FRSD['fr_stat'];
                            $fr_o_pros_history = $FRSD['fr_o_pros_history'];

                            $FRc_Stat = 5;//Next Status


                            if($fr_stat == 4){

                                $FRc_OrderProsHistory = "$fr_o_pros_history, আপনার অর্ডার ডেলিভারি সম্পূর্ণ হয়েছে। <small>[By $UsrName]</small> * " . date('d-M-Y h:i A', $FR_NOW_TIME) . "";

                                try{
                                    $FRQ = "UPDATE frd_order_invo SET 
                                    fr_stat = :fr_stat,
                                    fr_o_ddone_date = :fr_o_ddone_date,
                                    fr_o_ddone_time = :fr_o_ddone_time,
                                    fr_o_ddone_by = :fr_o_ddone_by,
                                    fr_o_pros_history = :fr_o_pros_history
                                    WHERE id = $FRc_OrderId";
                                    $FRQ = $FR_CONN->prepare("$FRQ");
                                    $FRQ->bindParam(':fr_stat', $FRc_Stat, PDO::PARAM_INT);
                                    $FRQ->bindParam(':fr_o_ddone_date', $FR_NOW_DATE, PDO::PARAM_STR);
                                    $FRQ->bindParam(':fr_o_ddone_time', $FR_NOW_TIME, PDO::PARAM_INT);
                                    $FRQ->bindParam(':fr_o_ddone_by', $UsrId, PDO::PARAM_STR);
                                    $FRQ->bindParam(':fr_o_pros_history', $FRc_OrderProsHistory, PDO::PARAM_STR);
                                    $FRQ->execute();
                                    $FRQ_ROWS = $FRQ->rowCount();
                                        if($FRQ_ROWS == 1){
                                                //FRD ORDER ITEM TABLE STATUS UPDATE:-
                                                    try{
                                                        $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 5, fr_o_ddone_date = '$FR_NOW_DATE' WHERE fr_invo_id = $FRc_OrderId");
                                                        FR_TAL("Items Update Done", "success");
                                                    }catch(PDOException $e){
                                                        FR_TAL("Items Update Failed", "error");
                                                        echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                                                    }
                                                //END>>
                    
                                            //FRD SMS SEND STSRT:-
                                                if($frsmsc_stc_rrl == 1){
                                                    extract(FR_USR_MINI_INFO($fr_cust_id));
                                                    $FRc_RatingReviewGiveLink = "$FRD_HURL/rating-review-give/".base64_encode($fr_cust_id)."/".base64_encode($FRc_USR_REG_TIME)."";
                                                    $FRc_Message = "Dear $fr_cust_name, Your order #$FRc_OrderId Delivery Completed. \n\nPlease Give Review  \n\n $FRc_RatingReviewGiveLink";
                                                    $FRR_SMS = FR_SEND_SMS($fr_cust_mob1, $FRc_Message);
                                                    if($FRR_SMS['FRA']==1){
                                                        FR_TAL("RR SMS SEND DONE","success");
                                                    }else{
                                                        FR_TAL("RR SMS SEND FAILED","error");
                                                    }
                                                }
                    
                                                    if($frsmsc_stc_nodc == 1){
                                                        extract(FR_USR_MINI_INFO($fr_cust_id));
                                                        $FRc_Message = "Dear $fr_cust_name, Your order #$FRc_OrderId Delivery Completed. Track: $FRD_HURL/track/$fr_enc_id \n\n $fr_cmobile_1";
                                                        $FRR_SMS = FR_SEND_SMS($fr_cust_mob1, $FRc_Message);
                                                        if($FRR_SMS['FRA']==1){
                                                            FR_TAL("DDN SMS SEND DONE","success");
                                                        }else{
                                                            FR_TAL("DDN SMS SEND FAILED","error");
                                                        }
                                                    }
                                            //END>>
                
                                            echo "<h4 class='text-success text-center'>SL:$FRc_SL + Order: #$FRc_OrderId Delivery Complete! </h4>";
                                            
                                        }
                                }catch(PDOException $e){
                                    echo "<h4 class='text-danger text-center'>SL:$FRc_SL + Order: #$FRc_OrderId Delivery Failed! </h4>";
                                    FR_GO("$FR_THIS_PAGE", "3");
                                    exit;
                                } 

                            }else{
                                echo "<h6 class='text-danger text-center'>SL:$FRc_SL + Status Not Update #$FRc_OrderId Because This Order Status Not Valid! + (Shipped orders allow only) </h6>";
                            }

                            $FRc_SL = ($FRc_SL + 1);
                        }
                }
                //END>>





                //FRD STOCK OUT UPDATE START:-
                if($FRc_bulk_next_status == "StockOut"){

                    $FRc_SL = 1;
                    foreach($FRc_OrdersIdsArr AS $FRc_OrderId){
                        $FRQ = $FR_CONN->query("SELECT fr_o_pros_history,fr_cust_name FROM frd_order_invo WHERE id = $FRc_OrderId");
                        $FRSD = $FRQ->fetch();
                        $fr_cust_name = $FRSD['fr_cust_name'];
                        $fr_o_pros_history = $FRSD['fr_o_pros_history'];

                        $FRc_OrderProsHistory = "$fr_o_pros_history, প্রিয় $fr_cust_name! আপনার পণ্যটি স্টক আউট হওয়ার কারণে সাময়িকভাবে ডেলিভারি প্রক্রিয়া স্থগিত করা হয়েছে। <small>[By $UsrName]</small> * " . date('d-M-Y h:i A', $FR_NOW_TIME) . "";

                            $FRQ = "UPDATE frd_order_invo SET 
                            fr_stat = 13,
                            fr_o_pros_history = '$FRc_OrderProsHistory'
                            WHERE id = $FRc_OrderId";
                            // echo "$FRQ";
                            $R = FR_DATA_UP("$FRQ");
                            if ($R['FRA'] == 1) {
                        
                                //FRD ORDER ITEM TABLE STATUS UPDATE:-
                                try{
                                    $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 13 WHERE fr_invo_id = $FRc_OrderId");
                                    echo "<h4 class='text-success text-center'>SL:$FRc_SL + #$FRc_OrderId Order Stock Out Complete! </h4>";
                                }catch(PDOException $e){
                                    FR_TAL("Items Update Failed", "error");
                                    echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                                }
                                //END>>
                            } else {
                                echo "<h3 class='text-danger text-center'>SL:$FRc_SL + #$FRc_OrderId Order Stock Out Failed! </h3>";
                            }
                        
                        $FRc_SL = ($FRc_SL + 1);
                    }
                }
                 //END>>


                //FRD STOCK OUT UPDATE START:-
                if($FRc_bulk_next_status == "Schedule"){

                    $FRc_SL = 1;
                    foreach($FRc_OrdersIdsArr AS $FRc_OrderId){
                        $FRQ = $FR_CONN->query("SELECT fr_o_pros_history,fr_cust_name FROM frd_order_invo WHERE id = $FRc_OrderId");
                        $FRSD = $FRQ->fetch();
                        $fr_cust_name = $FRSD['fr_cust_name'];
                        $fr_o_pros_history = $FRSD['fr_o_pros_history'];

                        $FRc_OrderProsHistory = "$fr_o_pros_history, প্রিয় $fr_cust_name! আপনার অর্ডারটি সিডিউল অর্ডার হিসেবে স্থগিত করা হয়েছে। কিছুদিন পর আবার ডেলিভারি প্রক্রিয়া শুরু করা হবে। <small>[By $UsrName]</small> * " . date('d-M-Y h:i A', $FR_NOW_TIME) . "";

                            $FRQ = "UPDATE frd_order_invo SET 
                            fr_stat = 14,
                            fr_o_pros_history = '$FRc_OrderProsHistory'
                            WHERE id = $FRc_OrderId";
                            // echo "$FRQ";
                            $R = FR_DATA_UP("$FRQ");
                            if ($R['FRA'] == 1) {
                        
                                //FRD ORDER ITEM TABLE STATUS UPDATE:-
                                try{
                                    $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 14 WHERE fr_invo_id = $FRc_OrderId");
                                    echo "<h4 class='text-success text-center'>SL:$FRc_SL + #$FRc_OrderId Order Schedule Complete! </h4>";
                                }catch(PDOException $e){
                                    FR_TAL("Items Update Failed", "error");
                                    echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                                }
                                //END>>
                            } else {
                                echo "<h3 class='text-danger text-center'>SL:$FRc_SL + #$FRc_OrderId Order Schedule Failed! </h3>";
                            }
                        
                        $FRc_SL = ($FRc_SL + 1);
                    }
                }
                 //END>>



        }
    

}else{
    FR_SWAL("$UsrName First Select The Order","","error");
    FR_GO("om-InvoiceList?=FRH=hdjdiryyccx","2");
    exit;
}
//END>>




    
// ?>
</section>
<!-- 1 SCRIPT E-->





 
 <?php require_once('frd1_footer.php'); ?>