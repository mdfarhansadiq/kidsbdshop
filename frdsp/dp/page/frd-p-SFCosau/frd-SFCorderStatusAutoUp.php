<?php 
require_once('frd1_whoami.php');
$FR_ptitle="SFC OSAU";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');


//FRD TDR:-
$FRR = FR_QSEL("SELECT * FROM frd_qapi_steadfast WHERE id = 1","");
if($FRR['FRA']==1){ 
  extract($FRR['FRD']);
} else{ ECHO_4($FRR['FRM']); }
//END>>



?>
<h2 class="PT"> Dear Boss <?php echo "$UsrName !";?> <br>  I Am Your SteadFast Courier Order Status Auto Updating Manager </h2> <hr>

<style>
    .div-initializingimg{
        background: #000000 !important;
    }
    .div-initializingimg img{
        margin: auto;
    }
</style>


<section>
<div class="container">
<div class="col-md-11">

   
   <?php 
    if(!isset($_SESSION['FRs_SFC_OSAU_Initialized'])){
        $_SESSION['FRs_SFC_OSAU_Initialized'] = "SET";
        FR_GO("$FR_THIS_PAGE",7);
      ?>
        <div class="row">
            <div class="col-md-12 text-center">
                    <?php echo "
                    <div class='div-initializingimg'>
                      <img src='$FRD_HURL/frd-src/img/gif/initializing-system-1.gif' alt='#' class='img-responsive'>
                    </div>
                    "; ?>
                    <style>
                        body{
                            background: #000000 !important;
                        }
                    </style>
                
            </div>
        </div>
    <?php exit; } ?>

    

   <?php if(isset($_SESSION['FRs_SFC_OSAU_Initialized'])){ ?>
   <div class="row">
    <div class="col-md-12">
        <?php 
          //FRD QUICK DATA READ 2:-
            $FRR = FR_QSEL("SELECT * FROM frd_order_invo WHERE fr_stat IN(12,11,13,14,4) AND fr_ship_consignment_id != '' AND fr_osau_nextry < $FR_NOW_TIME ORDER BY id ASC LIMIT 0,30","ALL");
            // $FRR = FR_QSEL("SELECT * FROM frd_order_invo WHERE fr_stat IN(12,11,13,14,4) AND fr_osau_nextry < $FR_NOW_TIME ORDER BY id DESC LIMIT 0,30","ALL");
            if($FRR['FRA']==1){  
            $FRc_SL = 1;
            $FRc_ARRCOUNT = count($FRR['FRD']);
            foreach($FRR['FRD'] as $FR_ITEM){
                extract($FR_ITEM);

                //FRD NEXT TRY TIMESAVE SAVE:-
                    try{
                        $FRc_osau_nextry = ($FR_NOW_TIME + 3600);
                        $FR_CONN->exec("UPDATE frd_order_invo SET fr_osau_nextry = '$FRc_osau_nextry' WHERE id = $id AND fr_enc_id = '$fr_enc_id'");
                    }catch(PDOException $e){ $e->getMessage(); exit;}
                //END>>

                    $FRc_HitApi = "$fr_sf_base_url/status_by_cid/$fr_ship_consignment_id";
                    // $FRc_HitApi = "$fr_sf_base_url/status_by_invoice/$id";
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $FRc_HitApi,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTPHEADER => array(
                            "Api-Key: $fr_sf_api_key",
                            "Secret-Key: $fr_sf_secret_key",
                            "Content-Type: application/json",
                        ),
                        CURLOPT_SSL_VERIFYPEER => false
                    ));
                    $response = curl_exec($curl);

                    if (curl_errno($curl)) {
                        $error = curl_error($curl);
                        // Handle the error
                        echo "cURL Error: $error";
                        FR_GO("$FR_THIS_PAGE","3");
                        exit;
                    } else {
                            //HENDEL THE RESPONSE START:-
                                if($response == "Unauthorized Access"){ 
                                    ECHO_4("SL:$FRc_SL + Order #$id !","text-center alert alert-danger");
                                    ECHO_4("Unauthorized Access","text-center alert alert-danger"); 
                                    FR_GO("$FR_THIS_PAGE","3");
                                    exit;  
                                }

                                $FRcR_ARR =  json_decode($response, true);
                                $FRc_API_R_Stat = $FRcR_ARR["status"];
                                if($FRc_API_R_Stat == 200){
                                    $FRc_API_R_delivery_status = $FRcR_ARR["delivery_status"];

                                    if($FRc_API_R_delivery_status == "pending"){
                                        if($fr_stat != 4){
                                              extract(FRF_SHIP_PART_NAME($fr_ship_p_id));
                                               $FRc_ShipPartName = $FRc_SHIP_PART_NAME;
                                               $FRc_Stat = 4;
                                                $FRc_OrderProsHistory = "$fr_o_pros_history, প্রিয় $fr_cust_name! পার্সেলটি $FRc_ShipPartName কুরিয়ারে বুকিং দেওয়া হয়েছে। <br> পার্সেলটির সর্বশেষ আপডেট জানতে ক্লিক করুনঃ <a href='https://steadfast.com.bd/t/$fr_ship_track_code' target='_blank'> https://steadfast.com.bd/t/$fr_ship_track_code </a> <small>[By $UsrName][Auto]</small> * ".date('d-M-Y h:i A',$FR_NOW_TIME)."";

                                                try{
                                                    $FRQ = "UPDATE frd_order_invo SET 
                                                    fr_stat = :fr_stat,
                                                    fr_o_ship_date = :fr_o_ship_date,
                                                    fr_o_ship_time = :fr_o_ship_time,
                                                    fr_o_ship_by = :fr_o_ship_by,
                                                    fr_o_pros_history = :fr_o_pros_history
                                                    WHERE id = $id  AND fr_enc_id = '$fr_enc_id'";
                                                    $FRQ = $FR_CONN->prepare("$FRQ");
                                                    $FRQ->bindParam(':fr_stat', $FRc_Stat, PDO::PARAM_INT);
                                                    $FRQ->bindParam(':fr_o_ship_date', $FR_NOW_DATE, PDO::PARAM_STR);
                                                    $FRQ->bindParam(':fr_o_ship_time', $FR_NOW_TIME, PDO::PARAM_INT);
                                                    $FRQ->bindParam(':fr_o_ship_by', $UsrId, PDO::PARAM_STR);
                                                    $FRQ->bindParam(':fr_o_pros_history', $FRc_OrderProsHistory, PDO::PARAM_STR);
                                                    $FRQ->execute();
                                                    $FRQ_ROWS = $FRQ->rowCount();
                                                        if($FRQ_ROWS == 1){
                                                            // FRD ORDER ITEM TABLE STATUS UPDATE:-
                                                            try{
                                                                $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 4, fr_o_ship_date = '$FR_NOW_DATE' WHERE fr_invo_id = $id");
                                                                FR_TAL("Items Update Done", "success");
                                                            }catch(PDOException $e){
                                                                FR_TAL("Items Update Failed", "error");
                                                                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                                                                exit;
                                                            }
                                                            //END>>
                                                            ECHO_4("SL:$FRc_SL + Order #$id Shipped!","text-center alert alert-success");
                                                        }
                                                }catch(PDOException $e){
                                                    ECHO_4("ERROR: SL:$FRc_SL + Order #$id Shipped Status Update Failed!","text-center alert alert-danger");
                                                    exit;
                                                }

                                        }else{
                                            echo "<h3 class='text-warning text-center'>SL:$FRc_SL + Order #$id Already Shipped Before! </h3>"; 
                                        }
                                    }
                                    elseif($FRc_API_R_delivery_status == "delivered"){
                                        $FRc_Stat = 5;
                                        $FRc_OrderProsHistory = "$fr_o_pros_history, প্রিয় $fr_cust_name! আপনার অর্ডার ডেলিভারি সম্পূর্ণ হয়েছে। <small>[By $UsrName][Auto]</small> * " . date('d-M-Y h:i A', $FR_NOW_TIME) . "";
                                        try{
                                            $FRQ = "UPDATE frd_order_invo SET 
                                            fr_stat = :fr_stat,
                                            fr_o_ddone_date = :fr_o_ddone_date,
                                            fr_o_ddone_time = :fr_o_ddone_time,
                                            fr_o_ddone_by = :fr_o_ddone_by,
                                            fr_o_pros_history = :fr_o_pros_history
                                            WHERE id = $id  AND fr_enc_id = '$fr_enc_id'";
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
                                                                $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 5, fr_o_ddone_date = '$FR_NOW_DATE' WHERE fr_invo_id = $id");
                                                                FR_TAL("Items Update Done", "success");
                                                            }catch(PDOException $e){
                                                                FR_TAL("Items Update Failed", "error");
                                                                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                                                                exit;
                                                            }
                                                        //END>>
                            
                                                    //FRD SMS SEND STSRT:-
                                                        if($frsmsc_stc_rrl == 1){
                                                            extract(FR_USR_MINI_INFO($fr_cust_id));
                                                            $FRc_RatingReviewGiveLink = "$FRD_HURL/rating-review-give/".base64_encode($fr_cust_id)."/".base64_encode($FRc_USR_REG_TIME)."";
                                                            $FRc_Message = "Dear $fr_cust_name, Your order #$id Delivery Done. \n\nPlease Give Review  \n\n $FRc_RatingReviewGiveLink";
                                                            $FRR_SMS = FR_SEND_SMS($fr_cust_mob1, $FRc_Message);
                                                            if($FRR_SMS['FRA']==1){
                                                                FR_TAL("SMS SEND DONE","success");
                                                            }else{
                                                                FR_TAL("SMS SEND FAILED","error");
                                                            }
                                                        }
                                                    //END>>
                                                    ECHO_4("SL:$FRc_SL + Order #$id Delivered!","text-center alert alert-success");
                                                }
                                        }catch(PDOException $e){
                                            ECHO_4("ERROR: SL:$FRc_SL + Order #$id Delivered Status Update Failed!","text-center alert alert-danger");
                                            exit;
                                        }

                                    }
                                    elseif($FRc_API_R_delivery_status == "partial_delivered"){
                                        $FRc_Stat = 15;
                                        $FRc_OrderProsHistory = "$fr_o_pros_history, প্রিয় $fr_cust_name! আপনার অর্ডারটি পার্সিয়াল পেন্ডিং এ রেখেছে আমাদের প্রতিনিধি <small>[By $UsrName][Auto]</small> * " . date('d-M-Y h:i A', $FR_NOW_TIME) . "";
                                        try{
                                            $FRQ = "UPDATE frd_order_invo SET 
                                            fr_stat = :fr_stat,
                                            fr_o_pros_history = :fr_o_pros_history
                                            WHERE id = $id  AND fr_enc_id = '$fr_enc_id'";
                                            $FRQ = $FR_CONN->prepare("$FRQ");
                                            $FRQ->bindParam(':fr_stat', $FRc_Stat, PDO::PARAM_INT);
                                            $FRQ->bindParam(':fr_o_pros_history', $FRc_OrderProsHistory, PDO::PARAM_STR);
                                            $FRQ->execute();
                                            $FRQ_ROWS = $FRQ->rowCount();
                                                if($FRQ_ROWS == 1){
                                                       //FRD ORDER ITEM TABLE STATUS UPDATE:-
                                                        try{
                                                            $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 15 WHERE fr_invo_id = $id");
                                                            FR_TAL("Items Update Done", "success");
                                                        }catch(PDOException $e){
                                                            FR_TAL("Items Update Failed", "error");
                                                            echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                                                            exit;
                                                        }
                                                        //END>>
                                                        ECHO_4("SL:$FRc_SL + Order #$id Partial Pending Completed!","text-center alert alert-success");
                                                }
                                        }catch(PDOException $e){
                                            ECHO_4("ERROR UPDATE FAILED: SL:$FRc_SL + Order #$id Partial Pending Completed!","text-center alert alert-danger");
                                            exit;
                                        }

                                    }
                                    elseif($FRc_API_R_delivery_status == "cancelled"){
                                            $FRc_Stat = 7;
                                            $FRc_OrderProsHistory = "$fr_o_pros_history, প্রিয় $fr_cust_name! আপনার অর্ডার রিটার্ন করা হয়েছে। <small>[By $UsrName][Auto]</small>* " . date('d-M-Y h:i A', $FR_NOW_TIME) . "";

                                            try{
                                                $FRQ = "UPDATE frd_order_invo SET 
                                                fr_stat = :fr_stat,
                                                fr_dfail_date = :fr_dfail_date,
                                                fr_dfail_time = :fr_dfail_time,
                                                fr_dfail_by = :fr_dfail_by,
                                                fr_ppro_return = :fr_ppro_return,
                                                fr_o_pros_history = :fr_o_pros_history
                                                WHERE id = $id  AND fr_enc_id = '$fr_enc_id'";
                                                $FRQ = $FR_CONN->prepare("$FRQ");
                                                $FRQ->bindParam(':fr_stat', $FRc_Stat, PDO::PARAM_INT);
                                                $FRQ->bindParam(':fr_dfail_date', $FR_NOW_DATE, PDO::PARAM_STR);
                                                $FRQ->bindParam(':fr_dfail_time', $FR_NOW_TIME, PDO::PARAM_INT);
                                                $FRQ->bindParam(':fr_dfail_by', $UsrId, PDO::PARAM_STR);
                                                $FRQ->bindParam(':fr_ppro_return', $fr_pro_total, PDO::PARAM_STR);
                                                $FRQ->bindParam(':fr_o_pros_history', $FRc_OrderProsHistory, PDO::PARAM_STR);
                                                $FRQ->execute();
                                                $FRQ_ROWS = $FRQ->rowCount();
                                                    if($FRQ_ROWS == 1){
                                                           //FRD ORDER ITEM TABLE STATUS UPDATE:-
                                                                try{
                                                                    $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 7, fr_o_dfail_date = '$FR_NOW_DATE' WHERE fr_invo_id = $id");
                                                                    FR_TAL("Items Update Done", "success");
                                                                }catch(PDOException $e){
                                                                    FR_TAL("Items Update Failed", "error");
                                                                    echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                                                                    exit;
                                                                }
                                                            //END>>
                            
                                                            //FRD PPR MANAGMENT ADJESTMENT:- 
                                                                $FRR = FR_QSEL("SELECT id AS FRc_ThisItemId,fr_invo_id,fr_qty,fr_t_price FROM frd_order_items WHERE fr_invo_id = $id ", "ALL");
                                                                if ($FRR['FRA'] == 1) {
                                                                    foreach ($FRR['FRD'] as $FR_ITEM) {
                                                                        extract($FR_ITEM);
                                                                        try{
                                                                            $FR_CONN->exec("UPDATE frd_order_items SET 
                                                                            fr_ppr_qty = $fr_qty, 
                                                                            fr_ppr_amount = $fr_t_price, 
                                                                            fr_ppr_date = '$FR_NOW_DATE'  
                                                                            WHERE id = $FRc_ThisItemId AND fr_invo_id = $fr_invo_id");
                                                                        }catch(PDOException $e){
                                                                            FR_TAL("PPR Items Update Failed", "error");
                                                                            echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                                                                            exit;
                                                                        }
                                                                    }
                                                                } else {
                                                                    PR($FRR);
                                                                    ECHO_4("ERROR: PPR MANEGMENT FAILED","alert alert-danger");
                                                                    exit;
                                                                }
                                                            //END>>
                            
                                                        ECHO_4("SL:$FRc_SL + Order #$id Delivery Failed Completed!","text-center alert alert-success");
                                                    }
                                            }catch(PDOException $e){
                                                ECHO_4("ERROR UPDATE: SL:$FRc_SL + Order #$id Delivery Failed Completed!","text-center alert alert-danger");
                                                exit;
                                            }
                                    }
                                    elseif($FRc_API_R_delivery_status == "in_review"){
                                        ECHO_4("SL:$FRc_SL + Order #$id In review Yet!","text-center alert alert-danger");
                                    }
                                    else{
                                        ECHO_4("SL:$FRc_SL + Order #$id In [$FRc_API_R_delivery_status ] Status Yet!","text-center alert alert-warning");
                                    }


                                    if($FRc_SL == $FRc_ARRCOUNT){ 
                                        unset($_SESSION['FRs_SFC_OSAU_Initialized']);
                                        ECHO_4("Dear Boss $UsrName!<br>I am taking rest! I will start work after 20 second!! ","text-center h2 boldd alert alert-success");
                                        FR_GO("$FR_THIS_PAGE","20");
                                    }

                                    
                                }else{
                                    //HENDEL API RESPOND ERROR:-
                                    echo "<h4 class='text-danger text-center'>API RESPONSE NOT 200</h4>";
                                    echo "<h4 class='text-danger text-center'>RESPONSE: $response</h4>";
                                    unset($_SESSION['FRs_SFC_OSAU_Initialized']);
                                    FR_GO("$FR_THIS_PAGE","3");
                                    exit;
                                }
                            //HENDEL THE RESPONSE END>>
                    }
                    curl_close($curl);

              $FRc_SL = ($FRc_SL + 1);

            }
            } else{ 
                // PR($FRR);
                ECHO_4("Good Job Dear Boss $UsrName!<br> Your All Order Process Completed! <br><br> Right Now No More Order Found To Process! <br> Please Try Again Minimum After 1 hour Later!","text-center h2 boldd alert alert-success");
                unset($_SESSION['FRs_SFC_OSAU_Initialized']);
            }
            //END>>
        ?>
    </div>
   </div>
   <?php } ?>


</div>
</div>
</section>
<!-- 1 SCRIPT END -->    




   







<?php require_once('frd1_footer.php'); ?>   