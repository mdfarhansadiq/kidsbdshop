<?php
header("Access-Control-Allow-Origin: $FRD_HURL");

$FR_OUTPUT = [];

//FRD VC NEED:-
    $FR_VC_FOS = "";//FAKE ORDER SOLUTION
    $FR_VC_POST = "";
    $FR_VC_PRODUCT_ID = "";
    $FR_VC_ORDER_TOKEN = "";
    $FR_VC_MobNumber = "";
    $FR_VC_DeliAddress = "";
    $FR_VC_ORDER_INVO_TDUP = "";//ORDER INVOICE TABLE DATA UPDATE
    $FR_VC_ORDER_ITEMS_TDUP = "";//ORDER ITEMS TABLE DATA UPDATE
//DEFAULT VALUE:-
    $FRc_CustomerId = 1;//[1=GUEST]
    $FRc_OrderPlaceUsrId = "0";
    $FRc_OrderPlaceUsrName = "NA";

//FRD DATA RECEIVING START:-
    if(isset($_POST['f_customer_name'])){
        $FRc_CustomerName = preg_replace("/'/"," ",$_POST['f_customer_name']);
        $FRc_CustomerMobile = $_POST['f_customer_mobile'];
        $FRc_CustomerAddress = preg_replace("/'/"," ",$_POST['f_customer_address']);
        $FRc_CustomerDeliNote = $_POST['f_delivery_note'];
        $FRc_ship_zone_id = $_POST['f_delivery_zone_id'];

        $FRc_devision = $_POST['f_devision'];
        $FRc_district = $_POST['f_district'];
        $FRc_thana = $_POST['f_thana'];
        
        $FR_VC_POST = 1; 
    }else{
        $FR_OUTPUT['FRA'] = 2;
        $FR_OUTPUT['FRM'] = "FRD ACCESS DENIED";
        goto THIS_LAST;
    }
//FRD DATA RECEIVING END>>
//FRD ORDER PLACE USER ID OVERWRITE:-
    if (isset($_SESSION['sUsrId'])) {
        $FRc_OrderPlaceUsrId = $_SESSION['sUsrId'];
        $FRc_OrderPlaceUsrName = $_SESSION['sUsrName'];
    }
//FRD CUSTOMR ID OVERWRITE:-
    if (isset($_SESSION['s_cust_id'])) {
        $FRc_CustomerId = $_SESSION['s_cust_id'];
    }
//FRD_VC_________________________________ MOBILE NUMBER COBVER BAN TO ENG:-
$FRc_CustomerMobile = preg_replace("/০/","0",$FRc_CustomerMobile);
$FRc_CustomerMobile = preg_replace("/১/","1",$FRc_CustomerMobile);
$FRc_CustomerMobile = preg_replace("/২/","2",$FRc_CustomerMobile);
$FRc_CustomerMobile = preg_replace("/৩/","3",$FRc_CustomerMobile);
$FRc_CustomerMobile = preg_replace("/৪/","4",$FRc_CustomerMobile);
$FRc_CustomerMobile = preg_replace("/৫/","5",$FRc_CustomerMobile);
$FRc_CustomerMobile = preg_replace("/৬/","6",$FRc_CustomerMobile);
$FRc_CustomerMobile = preg_replace("/৭/","7",$FRc_CustomerMobile);
$FRc_CustomerMobile = preg_replace("/৮/","8",$FRc_CustomerMobile);
$FRc_CustomerMobile = preg_replace("/৯/","9",$FRc_CustomerMobile);
//FRD_VC________________________ CUSTOMER MOBILE NUMBER VALIDATION CHECKING:-
$FRc_CustomerMobile = preg_replace("/-/","",$FRc_CustomerMobile);
$FRc_CustomerMobile = preg_replace("/ /","",$FRc_CustomerMobile);
if(substr($FRc_CustomerMobile, 0, 3) == "+88"){ $FRc_CustomerMobile = substr($FRc_CustomerMobile, 3); }
elseif(substr($FRc_CustomerMobile, 0, 2) == "88"){ $FRc_CustomerMobile = substr($FRc_CustomerMobile, 2); }
    if(preg_match('/^[0-9]{11}+$/', $FRc_CustomerMobile)) {
        $FR_VC_MobNumber = 1;
    }else{
        $FR_OUTPUT['FRA'] = 2;
        $FR_OUTPUT['FRM'] = "MOBILE NUMBER NOT VALID $FRc_CustomerMobile";
        goto THIS_LAST;
    }
// //FRD_VC__________________________________________ CUSTOMER ADDRESS CAN NOT BE EMPTY:-
//     if ( strlen($FRc_CustomerAddress) > 3 ) {
//             $FR_VC_DeliAddress = 1;
//     }else{
//         $FR_OUTPUT['FRA'] = 2;
//         $FR_OUTPUT['FRM'] = "দয়া করে ডেলিভারি ঠিকানা লিখুন";
//         goto THIS_LAST;
//         exit;
//     }
//FRD_VC________________________________________________ ORDER TOKEN:-
if(isset($_SESSION['FRs_Invo_Token'])){
    $FR_VC_ORDER_TOKEN = 1;
    $FRc_Invo_Token = $_SESSION['FRs_Invo_Token'];
    $FRc_Invo_Token_Enc = $_SESSION['FRs_Invo_EncId'];
}
//FRD_VC_________________________FAKE ORDER SOLUTION:-
if(isset($frp_fos)){
  if($frp_fos == 1){

    //FRD_VC_________ UID BLOCK OR NOT FOR ORDER PLACE:-
        try {
            $FRQ = $FR_CONN->query("SELECT fr_cmobile_1 FROM frd_cprofile WHERE id = 1");
            extract($FRQ->fetch());

            $FRQ = $FR_CONN->prepare("SELECT * FROM frd_fos_bl_uid WHERE fr_bl_uid_val = :fr_bl_uid_val");
            $FRQ->bindParam(':fr_bl_uid_val', $FRc_USER_UID, PDO::PARAM_STR);
            $FRQ->execute();
            $FOS_BL_UID_ROWS = $FRQ->rowCount();
              if($FOS_BL_UID_ROWS == 1){
                $FR_OUTPUT['FRA'] = 2;
                $FR_OUTPUT['FRM'] = "$FRc_CustomerName You Can Not Place Order Right Now! Please Call [$fr_cmobile_1]";
                goto THIS_LAST;
              }
            
        } catch(PDOException $e) {
                $FR_OUTPUT['FRA'] = 2;
                $FR_OUTPUT['FRM'] = "Error". $e->getMessage();
                goto THIS_LAST;
        }
  }
}
//FRD_VC_________________________FAKE ORDER END>>




//FRD QUICK ORDER INVOICE TOKEN START && ITEM ADD TO ORDER ITEMS TABLE:-
if(!isset($_SESSION['FRs_Invo_Token'])){ 
    //FRD_VC____________________________________ PRODUCT ID:-
    if(!isset($_POST['f_product_id'])){
        $FR_OUTPUT['FRA'] = 2;
        $FR_OUTPUT['FRM'] = "PRODUCT ID REQUIRED";
        goto THIS_LAST;
    }
    if($_POST['f_product_id'] == ""){
        $FR_OUTPUT['FRA'] = 2;
        $FR_OUTPUT['FRM'] = "PRODUCT ID NULL";
        goto THIS_LAST;
    }
    if($_POST['f_product_id'] == "NA"){
        $FR_OUTPUT['FRA'] = 2;
        $FR_OUTPUT['FRM'] = "PRODUCT ID NA";
        goto THIS_LAST;
    }
    $FRc_ProIdx = preg_replace('/[^A-Za-z0-9\-]/', '', $_POST['f_product_id']);
    //FRD_VC________________________ PRODUCT STOCK:-
    $FRQ = $FR_CONN->query("SELECT qtyy AS FRc_ProCurrStock FROM frd_products WHERE id = $FRc_ProIdx");
    extract($FRQ->fetch());
    if($FRc_ProCurrStock == 0){
        $FR_OUTPUT['FRA'] = 2;
        $FR_OUTPUT['FRM'] = "PRODUCT STOCK OUT";
        goto THIS_LAST;
    }

   

        //FRD ORDER TOKEN STARTING:-
            $FRc_Enc_Id = uniqid();
            $arr = [];
            $arr['fr_enc_id'] = $FRc_Enc_Id;
            $arr['fr_stat'] = 0;
            $arr['fr_o_date'] = "$FR_NOW_DATE";
            $arr['fr_o_time'] = "$FR_NOW_TIME";
            $FRR = FR_DATA_IN("frd_order_invo",$arr);
            if($FRR['FRA']==1){
                $FRc_Invo_Token = $FRR['FR_LIID'];
                $FRc_Invo_Token_Enc = $FRc_Enc_Id;
                
                        //FRD PRODUCT TDR:-
                            $FRR = FR_QSEL("SELECT * FROM frd_products WHERE id = $FRc_ProIdx","");
                            if($FRR['FRA']==1){ 
                                extract($FRR['FRD']);

                                $bn_name = preg_replace("/'/","\'",$bn_name);

                                $FRc_BRAND_NAME = "NA";
                                $FRc_COLOR_NAME = "NA";
                                $FRc_r_cat_1_Name = "NA";
                                $FRc_r_cat_2_Name = "NA";
                                $FRc_r_cat_3_Name = "NA";
                                $FRc_r_cat_4_Name = "NA";
                        
                                if($r_brand > 0){ extract(FRF_BRAND_NAME($r_brand)); }
                                if($r_color > 0){ extract(FRF_COLOR_NAME($r_color)); }
                                if($r_cat_1 > 0){ extract(FRF_CATT_NAME($r_cat_1)); $FRc_r_cat_1_Name = $FRc_CATT_NAME; }
                                if($r_cat_2 > 0){ extract(FRF_CATT_NAME($r_cat_2)); $FRc_r_cat_2_Name = $FRc_CATT_NAME; }
                                if($r_cat_3 > 0){ extract(FRF_CATT_NAME($r_cat_3)); $FRc_r_cat_3_Name = $FRc_CATT_NAME; }
                                if($r_cat_4 > 0){ extract(FRF_CATT_NAME($r_cat_4)); $FRc_r_cat_4_Name = $FRc_CATT_NAME; }

                                    //FRD ITEM ADDING:-
                                        $arr = [];
                                        $arr['fr_invo_id'] = $FRc_Invo_Token;
                                        $arr['fr_pro_id'] = $FRc_ProIdx;
                                        $arr['fr_pro_sku'] = "$skuu";
                                        $arr['fr_pro_title'] = "$bn_name";
                                        $arr['fr_size_name'] = "$siz_name";

                                        $arr['fr_pro_pic_1'] = "$pic_1";
                                        $arr['fr_qty'] = "1";
                                        $arr['fr_price'] = "$sells_pri";
                                        $arr['fr_t_price'] = "$sells_pri";

                                        $arr['fr_buyprice'] = "$buy_pri";
                                        $arr['fr_t_buyprice'] = "$buy_pri";

                                        $arr['fr_profit'] = ($sells_pri - $buy_pri);
                                        $arr['fr_t_profit'] = ($sells_pri - $buy_pri);

                                        $arr['r_cat_1'] = "$r_cat_1";
                                        $arr['r_cat_2'] = "$r_cat_2";
                                        $arr['r_cat_3'] = "$r_cat_3";
                                        $arr['r_brand'] = "$r_brand";
                                        $arr['r_color'] = "$r_color";
                                        $arr['r_supplier'] = "$r_supplier";

                                        $arr['fr_stat'] = "0";
                                        $arr['deli_crg_typ'] = "$deli_crg_typ";
                                        $arr['fr_o_date'] = "$FR_NOW_DATE";
                                        $FRR = FR_DATA_IN("frd_order_items",$arr);
                                        if($FRR['FRA']==1){
                                            $FR_VC_ORDER_TOKEN = 1;
                                        }else{
                                            $FR_OUTPUT['FRA'] = 2;
                                            $FR_OUTPUT['FRM'] = "Item Add Failed";
                                            // $FR_OUTPUT['FRM'] =  $FRR['FRM_ERROR'];
                                            goto THIS_LAST;
                                        }
                                    //ITEM ADDING END>>

                            } else{ 
                                $FR_OUTPUT['FRA'] = 2;
                                $FR_OUTPUT['FRM'] = "PRODUCT DATA READE FAILED | ". $FRR['FRM'];
                                goto THIS_LAST;
                            }
                        //PRODUCT TDR END>>

            }else{
                $FR_OUTPUT['FRA'] = 2;
                $FR_OUTPUT['FRM'] = "TOKEN START FAILED";
                goto THIS_LAST;
            }
        //ORDER TOKEN STARTING END:-
}
// QUICK ORDER INVOICE TOKEN START && ITEM ADD TO ORDER ITEMS TABLE END>>





//FRD MAIN ORDER PLACEING PROSESS  START:-
if($FR_VC_POST == 1 AND $FR_VC_ORDER_TOKEN == 1){

    //FRD SHIP ZONE TDR :-
    if($FRc_ship_zone_id > 0){
        $FRR = FR_QSEL("SELECT * FROM frd_ship_zone WHERE id = $FRc_ship_zone_id","");
        if($FRR['FRA']==1){ 
           extract($FRR['FRD']);
           $FRc_Ship_Zone_Id = $id;
        } else{ 
            $FR_OUTPUT['FRA'] = 2;
            $FR_OUTPUT['FRM'] = $FRR['FRM'];
            goto THIS_LAST;
         }
    }else{
       $fr_sz_shipcost = 0;//CUSTOM SHIP ZONE COST
    }
   //FRD ORDER ITEMS TDR:-
    $FRR = FR_QSEL("SELECT COUNT(id) AS FRc_Invoice_Tot_Items, SUM(fr_qty) AS FRc_Invoice_Tot_Qty, SUM(fr_t_price) AS FRc_InvoItemsTotalPrice,SUM(fr_t_buyprice) AS FRc_ItemsTotalBuyPrice, SUM(fr_t_profit) AS FRc_ItemsTotalProfit FROM frd_order_items WHERE fr_invo_id = $FRc_Invo_Token AND fr_stat = 0", "");
    if ($FRR['FRA'] == 1) {
        extract($FRR['FRD']);
    } else {
        $FR_OUTPUT['FRA'] = 2;
        $FR_OUTPUT['FRM'] = "ERROR: ORDER INVOICE TDR FAILED";
        goto THIS_LAST;
    }
 //FRD CUSTOM CALCULATING:-
     $FRc_SubTotal = ($FRc_InvoItemsTotalPrice + $fr_sz_shipcost);
     $FRc_Payable = $FRc_SubTotal;
     $FRc_InvoiceDue  = $FRc_SubTotal;
     $FRc_InvoStatus = 1;


  //ORDER PROSESS HISTORI NOTE CUSTOMIZE:-
     $FRc_OrderProsHistory = "প্রিয় $FRc_CustomerName ধন্যবাদ! আপনার অর্ডারটি প্লেস হয়েছে। অতি শীঘ্রই আমাদের প্রতিনিধি আপনার সাথে যোগাযোগ করে অর্ডারটি কনফার্ম করবে। * ".date('d-M-Y h:i A',$FR_NOW_TIME)."";
    if($FRc_OrderPlaceUsrId > 0){
        $FRc_OrderProsHistory = "প্রিয় $FRc_CustomerName ধন্যবাদ! আপনার অর্ডারটি প্লেস হয়েছে। আমাদের প্রতিনিধি $FRc_OrderPlaceUsrName আপনার জন্য এই অর্ডারটি প্লেস করেছে ।* ".date('d-M-Y h:i A',$FR_NOW_TIME)."";
    }
    $FRc_OrderProsHistory .= ", প্রিয় $FRc_CustomerName! আপনার অর্ডারটি পেন্ডিং আছে। * ".date('d-M-Y h:i A',$FR_NOW_TIME)."";

        

    //FRD ORDER INVOICE TABLE DATA UPDATE:-
            $FRQ = "UPDATE frd_order_invo SET 
            fr_cust_id = :fr_cust_id,
            fr_cust_name = :fr_cust_name,
            fr_cust_mob1 = :fr_cust_mob1,
            fr_div = :fr_div,
            fr_dis = :fr_dis,
            fr_tha = :fr_tha,
            fr_cust_addres = :fr_cust_addres,
            fr_cust_o_note = :fr_cust_o_note,

            fr_pro_total = :fr_pro_total,
            fr_ship_cost = :fr_ship_cost,
            fr_sub_total = :fr_sub_total,
            fr_payable = :fr_payable,
            fr_invo_due = :fr_invo_due,

            fr_pro_buyprice = :fr_pro_buyprice,
            fr_delivery_cost = :fr_delivery_cost,
            fr_invo_profit = :fr_invo_profit,

            fr_stat = :fr_stat,
            fr_o_date = :fr_o_date,
            fr_o_time = :fr_o_time,
            fr_o_p_usrid = :fr_o_p_usrid,
            fr_o_pros_history = :fr_o_pros_history,

            fr_cust_ip = :fr_cust_ip,
            fr_cust_uid = :fr_cust_uid,
            fr_cust_browser = :fr_cust_browser
            WHERE id = $FRc_Invo_Token AND fr_stat = 0";
            try{
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':fr_cust_id', $FRc_CustomerId, PDO::PARAM_INT);
                $FRQ->bindParam(':fr_cust_name', $FRc_CustomerName, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_cust_mob1', $FRc_CustomerMobile, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_div', $FRc_devision, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_dis', $FRc_district, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_tha', $FRc_thana, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_cust_addres', $FRc_CustomerAddress, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_cust_o_note', $FRc_CustomerDeliNote, PDO::PARAM_STR);

                $FRQ->bindParam(':fr_pro_total', $FRc_InvoItemsTotalPrice, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_ship_cost', $fr_sz_shipcost, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_sub_total', $FRc_SubTotal, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_payable', $FRc_Payable, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_invo_due', $FRc_InvoiceDue, PDO::PARAM_STR);

                $FRQ->bindParam(':fr_pro_buyprice', $FRc_ItemsTotalBuyPrice, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_delivery_cost', $fr_sz_shipcost, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_invo_profit', $FRc_ItemsTotalProfit, PDO::PARAM_STR);

                $FRQ->bindParam(':fr_stat', $FRc_InvoStatus, PDO::PARAM_INT);
                $FRQ->bindParam(':fr_o_date', $FR_NOW_DATE, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_o_time', $FR_NOW_TIME, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_o_p_usrid', $FRc_OrderPlaceUsrId, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_o_pros_history', $FRc_OrderProsHistory, PDO::PARAM_STR);

                $FRQ->bindParam(':fr_cust_ip', $FRc_USER_IP, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_cust_uid', $FRc_USER_UID, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_cust_browser', $FRc_USER_AGENT, PDO::PARAM_STR);
                $FRQ->execute();
                
                $FR_VC_ORDER_INVO_TDUP = 1;
            }catch(PDOException $e){
                $FR_OUTPUT['FRA'] = 2;
                $FR_OUTPUT['FRM'] = "ERROR: ORDER INVOICE TABLE DATA UPDATE FAILED";
                // $FR_OUTPUT['FRM_ERROR'] = $e->getMessage();
                goto THIS_LAST;
            }
    //END>>
    //++
    //++
    //FRD ORDER ITEM TABLE DATA UPDATE:-
    if($FR_VC_ORDER_INVO_TDUP == 1){
        $FRQ = "UPDATE frd_order_items SET 
        fr_cust_id = :fr_cust_id,
        fr_stat = :fr_stat,
        fr_o_date = :fr_o_date
        WHERE fr_invo_id = $FRc_Invo_Token";
        try{
            $FRQ = $FR_CONN->prepare("$FRQ");
            $FRQ->bindParam(':fr_cust_id', $FRc_CustomerId, PDO::PARAM_INT);
            $FRQ->bindParam(':fr_stat', $FRc_InvoStatus, PDO::PARAM_INT);
            $FRQ->bindParam(':fr_o_date', $FR_NOW_DATE, PDO::PARAM_STR);
            $FRQ->execute();
            
            if(isset($_SESSION['FRs_Invo_Token'])){unset($_SESSION['FRs_Invo_Token']);}
            if(isset($_SESSION['FRs_Invo_EncId'])){unset($_SESSION['FRs_Invo_EncId']);}
            if(isset($_SESSION['s_keepcartopen'])){unset($_SESSION['s_keepcartopen']);}
            $_SESSION['cart_items']=0;
            $_SESSION['cart_price']=0;

            $FR_VC_ORDER_ITEMS_TDUP = 1;
        }catch(PDOException $e){
            $FR_OUTPUT['FRA'] = 2;
            $FR_OUTPUT['FRM'] = "ERROR: ORDER ITEMS TABLE DATA UPDATE FAILED";
            // $FR_OUTPUT['FRM_ERROR'] = $e->getMessage();
            goto THIS_LAST;
        }
    }
    //END>>





    
        if($FR_VC_ORDER_ITEMS_TDUP == 1){

            //FRD PRODUCT STOCK MANAGMENT START:-
                $FRR = FR_QSEL("SELECT fr_pro_id,fr_qty FROM frd_order_items WHERE fr_invo_id = $FRc_Invo_Token AND fr_stat = 1","ALL");
                if($FRR['FRA']==1){  
                    foreach($FRR['FRD'] as $FR_ITEM){
                        extract($FR_ITEM);
                                //FRD PROSESS PRODUCT PRESENT QTY FIEND:-
                                    $FRq_PSM_2 = "SELECT qtyy FROM frd_products WHERE id = $fr_pro_id";
                                    $FRQ = $FR_CONN->query("$FRq_PSM_2");
                                    $FRrow_PSM_2 = $FRQ->fetch();
                                    $FRc_Pro_Curr_Qty = $FRrow_PSM_2['qtyy'];
                    
                                if($FRc_Pro_Curr_Qty > 0 AND $FRc_Pro_Curr_Qty < 300000){
                                    $FRQ = "UPDATE frd_products SET qtyy = qtyy-$fr_qty WHERE id = $fr_pro_id";
                                    try{
                                        $FR_CONN->exec("$FRQ");
                                    }catch(PDOException $e){
                                        $FR_OUTPUT['FRA'] = 2;
                                        $FR_OUTPUT['FRM'] = "ERROR: PRODUCT STOCK MANGMENT FAILED";
                                        // $FR_OUTPUT['FRM_ERROR'] = $e->getMessage();
                                        goto THIS_LAST;
                                    }
                                }
                    }
                } else{
                    $FR_OUTPUT['FRA'] = 2;
                    $FR_OUTPUT['FRM'] = "ERROR: ORDER ITEM TABLE DATA READ FAILED";
                    goto THIS_LAST;
                }
            //PRODUCT STOCK MANAGMENT END>>


            //FRD INVOICE NET PROFIT UPDATE START:-
            extract(FRF_INVO_NET_PROFIT_UP($FRc_Invo_Token,$FRc_Invo_Token_Enc));
            if($FRA==2){
                $FR_OUTPUT['FRA'] = 2;
                $FR_OUTPUT['FRM'] = "ERROR: INVOICE NET PROFIT UPDATE FAILED";
                goto THIS_LAST;
            }
            //END>>


                //FRD CALLING API -> NEW ORDER THANK YOU SMS SEND:-
                    $data = [
                    "f_order_id"=> "$FRc_Invo_Token"
                    ];
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "$FR_HURL_API/NewOrderPlaceSMS");
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                    $FR_cRESPOND = curl_exec($ch);//JSON RECEIVED
                    curl_close($ch);
                    // $FRR = json_decode($FR_cRESPOND,true);
                    // if($FRR['FRA'] == 1){
                    //     echo "<h4 class='g TAC'>".$FRR['FRM']."</h4>";
                    // }else{
                    //     echo "<h4 class='r TAC'>".$FRR['FRM']."</h4>";
                    // }
                //END>>

                //FRD CUSTOMER NAME AUTO SAVING FOR FUTURES:-
                    if($FRc_CustomerId > 1 AND $FR_VC_MobNumber == 1){
                        $FRQ = "UPDATE frd_usr SET namee = '$FRc_CustomerName', addresss = '$FRc_CustomerAddress' WHERE id = $FRc_CustomerId";
                        try{
                            $FR_CONN->exec("$FRQ");
                        }catch(PDOException $e){
                            $FR_OUTPUT['FRA'] = 2;
                            $FR_OUTPUT['FRM'] = "ERROR: CNASFF";
                            goto THIS_LAST;
                        }
                    }
                //END>>



                    //FRD ORDER ASSINGING TO USER:-
                        $FRc_AssingUsrId = "";
                        $FRQ = $FR_CONN->query("SELECT id AS FRc_AssingUsrId FROM frd_usr WHERE typee = 'OCA' AND statuss = 1 ORDER BY RAND()");
                        $FRc_Rows = $FRQ->rowCount();
                        if($FRc_Rows > 0){ 
                            extract($FRQ->fetch());
                            if($FRc_OrderPlaceUsrId > 0){ $FRc_AssingUsrId = $FRc_OrderPlaceUsrId;}
                            try{
                                $FR_CONN->exec("UPDATE frd_order_invo SET fr_o_a_usrid = $FRc_AssingUsrId WHERE id = $FRc_Invo_Token");
                            }catch(PDOException $e){
                                $FR_OUTPUT['FRA'] = 2;
                                $FR_OUTPUT['FRM'] = "ERROR: OATU Falied";
                                // $FR_OUTPUT['FRM_ERROR'] = $e->getMessage();
                                goto THIS_LAST;
                            }
                        }
                    //END>>


                //FRD FINAL ACTION TAKING:-
                    if(isset($_SESSION['sUsrId'])){ 
                        if(isset($_SESSION['FRs_ItmePlusMinus'])){
                            FRF_CLOGOUT();
                            unset($_SESSION['FRs_ItmePlusMinus']);
                            unset($_SESSION['FRs_ItmePlusMinus_Note']);
                            unset($_SESSION['FRs_ItmePlusMinus_DeliCharge']);
                        }
                        $FR_OUTPUT['FRA'] = 1;
                        $FR_OUTPUT['FRM'] = "".$_SESSION['sUsrName']." Order Placed Completed! Going To Orders Prosess!";
                        $FR_OUTPUT['FRA_NEXT_URL'] = "$FRD_HURL/frdsp/dp/om-InvoiceEdit/$FRc_Invo_Token_Enc";
                    }else{
                        $FR_OUTPUT['FRA'] = 1;
                        $FR_OUTPUT['FRM'] = "Order Placed Completed!";
                        $FR_OUTPUT['FRA_NEXT_URL'] = "$FRD_HURL/checkout-complete";
                        $_SESSION['FRs_LastOrderEncId'] = "$FRc_Invo_Token_Enc";
                        $_SESSION['FRs_GTM_purchase_Evnt_Fire'] = "1";
                    }
                //END>>
                
        }
    //END>

}
//FRD MAIN ORDER PLACEING PROSESS END>>


THIS_LAST:
echo json_encode($FR_OUTPUT);