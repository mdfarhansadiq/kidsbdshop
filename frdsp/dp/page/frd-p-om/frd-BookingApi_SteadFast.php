<?php 
require_once('frd1_whoami.php');
$FR_ptitle="SteadFast Bulk Booking API";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');
?>
<h2 class="PT"> SteadFast Booking API </h2>


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
$FRR = FR_QSEL("SELECT * FROM frd_qapi_steadfast WHERE id = 1","");
if($FRR['FRA']==1){ 
  extract($FRR['FRD']);
} else{ ECHO_4($FRR['FRM']); }
//END>>

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
                extract($FRR['FRD']);

                if($fr_stat == 2 || $fr_stat == 3 || $fr_stat == 11 || $fr_stat == 12 || $fr_stat == 13 || $fr_stat == 14){
                        $data = array(
                            'invoice' => "$id",
                            'recipient_name' => "$fr_cust_name",
                            'recipient_phone' => "$fr_cust_mob1",
                            'recipient_address' => "$fr_cust_addres",
                            'cod_amount' => "$fr_invo_due",
                            'note' => "$fr_cust_o_note"
                        );
                        $jsonData = json_encode($data);
                        $FRc_HitAPI = "$fr_sf_base_url/create_order";
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => $FRc_HitAPI,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTPHEADER => array(
                                "Api-Key: $fr_sf_api_key",
                                "Secret-Key: $fr_sf_secret_key",
                                "Content-Type: application/json",
                            ),
                            CURLOPT_POST => true, // Set as POST request
                            CURLOPT_POSTFIELDS => $jsonData, // Set the POST data
                            CURLOPT_SSL_VERIFYPEER => false
                        ));
                        $response = curl_exec($curl);
                        
                        // Check for errors
                        if (curl_errno($curl)) {
                            $error = curl_error($curl);
                            //Handle the error
                            echo "cURL Error:";
                            PR($error);
                            exit;
                        } else {
                            // Handle the response
                            $FRR =  json_decode($response, true);
                            $FRc_status = $FRR["status"];
                            if($FRc_status == 200){
                                $FRc_tracking_code = $FRR["consignment"]["tracking_code"];
                                $FRc_consignment_id = $FRR["consignment"]["consignment_id"];
                                try{
                                    $FR_CONN->exec("UPDATE frd_order_invo SET fr_ship_track_code = '$FRc_tracking_code', fr_ship_consignment_id = '$FRc_consignment_id' WHERE id = $id");
                                     echo "<h6 class='text-success text-center'>Order Id: #$id Entry complete! Tracking Code: $FRc_tracking_code & Consignment ID : $FRc_consignment_id</h6>";
                                }catch(PDOException $e){
                                    echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                                    echo "<h6 class='text-danger'>Order Id: #$id Entry failed!</h6>";
                                    exit;
                                }
                            }else{
                                //HENDEL API RESPOND ERROR:-
                                echo "Invoice Id: $id";
                                PR($FRR);
                            }
                        }
                        // Close the cURL session
                        curl_close($curl);

                    
                }else{
                   echo "<h5>#$id Not Valid</h5>";
                }

            } else {
                // ECHO_4($FRR['FRM']);
                echo "<h6>No Data Found For Order Id #$FR_ITEM</h6>";
            }
            //END>>

        }




        
/*

{"status":200,"message":"Consignment has been created successfully.","consignment":{"consignment_id":40429245,"invoice":"frd-1","tracking_code":"268E6BDA6","recipient_name":"Rasel","recipient_phone":"01927445000","recipient_address":"dhaka mirpur","cod_amount":100,"status":"in_review","note":"test note 1","created_at":"2023-07-25T19:23:25.000000Z","updated_at":"2023-07-25T19:23:25.000000Z"}}


{"status":200,"message":"Consignment has been created successfully.","consignment":{"consignment_id":40430216,"invoice":"frd-2","tracking_code":"268EA8882","recipient_name":"Rasel","recipient_phone":"01927445000","recipient_address":"dhaka mirpur","cod_amount":100,"status":"in_review","note":"test note 1","created_at":"2023-07-25T19:39:14.000000Z","updated_at":"2023-07-25T19:39:14.000000Z"}}

*/



        ?>
    </section>


</body>

</html>





 
 <?php require_once('frd1_footer.php'); ?>