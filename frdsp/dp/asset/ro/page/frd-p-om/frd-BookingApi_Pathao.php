<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Pathao Bulk Booking API";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> Pathao Booking API </h2>


<!-- 1 SCRIPT S-->
<section> 
<?php 
  if(isset($_POST['f_chacked_orders_id'])){
        $FRc_InvoiceIdsArr = $_POST['f_chacked_orders_id']; 
  }else{
      FR_AL("$UsrName First Select The Orders");
      FR_GO("om-OPS2?=FRH=HSJEUYBNH","1");
      exit;
  }
//   PR($FRc_InvoiceIdsArr);



//FRD TDR:-
$FRR = FR_QSEL("SELECT * FROM frd_qapi_pathao WHERE fr_pat_id = 1","");
if($FRR['FRA']==1){ 
  extract($FRR['FRD']);
} else{ ECHO_4($FRR['FRM']); }
//END>>



extract(FRF_PATHAO_ATOKEN());
if($FRA == 2){ PR("PATHAO ACCESS TOKEN FAILED"); PR($FRM); }

?>
</section>
<!-- 1 SCRIPT E-->



<!DOCTYPE html>
<html>
<head>
        <meta charset='utf-8'/>
		<title><?php echo "$FR_ptitle";?></title>
    <style>

    </style>
</head>

<body>



    <section>
        <?php

        foreach ($FRc_InvoiceIdsArr as $FR_ITEM) {
            $FRc_InvoIdx = $FR_ITEM;

            //FRD ORDER INVOICE T DATA READ:-
            $FRR = FR_QSEL("SELECT * FROM frd_order_invo WHERE id = '$FRc_InvoIdx' AND fr_stat != 0", "");
            if ($FRR['FRA'] == 1) {

                $FR_VC_DuplicateEntry = "";
                $FR_VC_OrderStatus = "";
                $FR_VC_CityZoneArea = "";

                extract($FRR['FRD']);
               

                $fr_invo_due = substr($fr_invo_due,0,-3);

                $FRc_USR_NAME = "NA";
                if($fr_o_a_usrid > 1){extract(FR_USR_NAME($fr_o_a_usrid));}

                $FRc_merchant_order_id = "$id  $FRc_USR_NAME  $FR_NOW_DATE";

                $FRc_Instruction = "";
                if($fr_payment == 0){
                    $FRc_Instruction = "If customer returns the product, then collect delivery charge 150 tk";
                }

                $FRQ = $FR_CONN->query("SELECT SUM(fr_qty) FROM frd_order_items WHERE fr_invo_id = $id");
                $FRSD = $FRQ->fetch();
                $FRc_ItemQuantity = $FRSD['SUM(fr_qty)'];

                //FRD_VC_____________________________________________ :-
                if($fr_ship_consignment_id == ""){
                    $FR_VC_DuplicateEntry = 1;
                }else{
                    ECHO_4("Order ID #$id Entry Completed Before","alert alert-danger");
                }
                //FRD_VC_____________________________________________ :-
                if($fr_stat == 2 || $fr_stat == 11 || $fr_stat == 12 || $fr_stat == 3){
                    $FR_VC_OrderStatus = 1;
                }else{
                    ECHO_4("Order ID #$id Status Not Valid","alert alert-warning");
                }
                //FRD_VC_____________________________________________ :-
                if($fr_pq_city !="" AND $fr_pq_zone !="" AND $fr_pq_area !=""){
                    $FR_VC_CityZoneArea = 1;
                }else{
                    ECHO_4("For Order ID #$id. The recipient City,Zone And Area field is required","alert alert-danger text-center");
                }


                
                if($FR_VC_DuplicateEntry == 1 AND $FR_VC_OrderStatus == 1 AND $FR_VC_CityZoneArea == 1){

                    //Create a New Order Start:-
                        if(isset($FRc_PATHAO_ATOKEN)){
                            // Set the request URL
                            $request_url = "$fr_pat_base_url/aladdin/api/v1/orders";
                            // Set the request headers
                            $headers = array(
                                "Authorization:Bearer $FRc_PATHAO_ATOKEN",
                                'Content-Type: application/json',
                                'Accept: application/json'
                            );
                            // Set the request body parameters
                            $data = array(
                                'store_id' => "$fr_pat_store_id",
                                'merchant_order_id' => "$FRc_merchant_order_id",
                                'sender_name' => "$fr_cname",
                                'sender_phone' => "$fr_cmobile_1",
                                'recipient_name' => "$fr_cust_name",
                                'recipient_phone' => "$fr_cust_mob1",
                                'recipient_address' => "$fr_cust_addres",
                                'recipient_city' => "$fr_pq_city",
                                'recipient_zone' => "$fr_pq_zone",
                                'recipient_area' => "$fr_pq_area",
                                'delivery_type' => '48',
                                'item_type' => '2',
                                'special_instruction' => "$FRc_Instruction",
                                'item_quantity' => "$FRc_ItemQuantity",
                                'item_weight' => '0.5',
                                'amount_to_collect' => "$fr_invo_due",
                                'item_description' => "$fr_cust_o_note"
                            );
                            // Initialize cURL session
                            $ch = curl_init($request_url);
                            // Set cURL options
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            curl_setopt($ch, CURLOPT_POST, true);
                            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
                            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                            // Execute cURL session
                            $response = curl_exec($ch);
                            // Check for cURL errors
                            if (curl_errno($ch)) {
                                echo 'Curl error: ' . curl_error($ch);
                            }
                            // Close cURL session
                            curl_close($ch);

                            //FRD HENDEL THE RESPONSE START:-
                            $FRR =  json_decode($response, true);
                            if(isset($FRR["code"])){
                                
                                if($FRR["code"] == 200){
                                    // PR($FRR);
                                    $FRc_consignment_id = $FRR["data"]["consignment_id"];
                                    $FRc_merchant_order_id = $FRR["data"]["merchant_order_id"];
                                    $FRc_order_status = $FRR["data"]["order_status"];
                                    $FRc_delivery_fee = $FRR["data"]["delivery_fee"];
                                    try{
                                        $FR_CONN->exec("UPDATE frd_order_invo SET fr_ship_consignment_id = '$FRc_consignment_id' WHERE id = $id");
                                        ECHO_4("Order ID: #$id Entry complete! Consignment ID : $FRc_consignment_id","text-success");
                                    }catch(PDOException $e){
                                        echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                                        ECHO_4("Order ID: #$id Entry failed!","text-danger");
                                        exit;
                                    }
                                }
                                if($FRR["code"] == 422){
                                    //ERROR
                                    PR($FRR);
                                    exit;
                                }
                            }else{
                                echo "$response";
                            }
                            //FRD HENDEL THE RESPONSE END>>
                        }
                    //Create a New Order END>>
                }

            } else {
                // ECHO_4($FRR['FRM']);
                echo "<h6>No Data Found For Order Id #$FRc_InvoIdx</h6>";
            }
            //END>>

        }








        ?>
    </section>


</body>

</html>



 <?php require_once('frd1_footer.php'); ?>