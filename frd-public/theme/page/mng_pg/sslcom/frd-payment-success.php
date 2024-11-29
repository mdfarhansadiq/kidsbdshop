<?php 
require_once("frd-public/theme/frd-header-s.php");
ob_start();
$FRc_PAGE_TITEL = "";
$FRc_META_TAG_HTML = "";
$p_title="PS";//Page  Title
$p="#";//Page Name
$inn="";
require_once("frd-public/theme/frd-header.php");
?>
<!-- <h2 class="PT"> SSL COM PAYMENT SUCCESS </h2> -->
<!-- 1 scripts s-->
<section>
<?php
//FRD_____________________VC ORDER ID SET OR NOT     
   if(!isset($_GET['iid'])){ exit; }
 //FRD_____________________VC POST val_id Set or not :-
    if(!isset($_POST['val_id'])){header("location:$FRD_HURL/my_orders/?fc=163638bsb");}


//FRD VALIDATION NEED:-
    $FR_VC_PaymentStatus = "";

    $FRc_InvoiceEncIdx = $_GET['iid'];


//FRD  DATA:-
    $FRR = FR_QSEL("SELECT * FROM frd_paygw_sslcom WHERE id = 1","");
    if($FRR['FRA']==1){ 
    extract($FRR['FRD']);
    } else{ ECHO_4($FRR['FRM']); }
//END>>

//FRD ORDER INVOICE T DATA:-
    $FRR = FR_QSEL("SELECT * FROM frd_order_invo WHERE fr_enc_id = '$FRc_InvoiceEncIdx' AND fr_stat != 0","");
    if($FRR['FRA']==1){ 
    extract($FRR['FRD']);
      $FRc_Invoice_Id_x = $id;
    } else{ ECHO_4($FRR['FRM']); exit; }
//END>>



    // //## USER TABLE DATA
    // $q_frd="select * from frd_usr where id=$osi_custid AND typee='cu' AND statuss=1";
    // require("$rtd_path/1_frd.php");     
    // require("$rtd_path/usr_t_frd.php");
    

    $val_id = urlencode($_POST['val_id']); 
    $store_id = urlencode("$sslcom_storid_frd");
    $store_passwd = urlencode("$sslcom_storpsw_frd");


    
    
    if($FR_SERVER == 1){
        $requested_url = ("https://securepay.sslcommerz.com/validator/api/validationserverAPI.php?val_id=".$val_id."&store_id=".$store_id."&store_passwd=".$store_passwd."&format=json");
    }else{
        $requested_url = "https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=".$val_id."&store_id=".$store_id."&store_passwd=".$store_passwd."&format=json";
    }

    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $requested_url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
    curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC
    $result = curl_exec($handle);
    $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
    if($code == 200 && !( curl_errno($handle)))
    {

                  # TO CONVERT AS ARRAY
        //         $result = json_decode($result, true);
        //         $status = $result['status'];
        //         echo "<pre>"; print_r($result); echo "</pre>";
        //         exit;

        # TO CONVERT AS OBJECT
        $result = json_decode($result);

        # TRANSACTION INFO
            $status = $result->status;
            $tran_date = $result->tran_date;
            $tran_id = $result->tran_id;
            $val_id = $result->val_id;
            $amount = $result->amount;
            $store_amount = $result->store_amount;
            $bank_tran_id = $result->bank_tran_id;
            $card_type = $result->card_type;

        //FRD EXPLOED INNI:-
            $card_type_exp  =explode('-',$card_type); 
            $RFc_card_type = $card_type_exp[0];
        
        
    } else {
        echo "Failed to connect with SSLCOMMERZ";
    } 


  

    
    



//FRD_VC_____________________________________PAYMENT STATUS SET OR NOTE:-
if(!isset($status)){header("location:$FRD_HURL/my_orders"); exit;}

//FRD_VC_____________________________________PAYMENT STATUS:-
    if($status=='VALID' or $status=='VALIDATED'){
           $FR_VC_PaymentStatus = 1;
    }else{
        FR_SWAL("Payment Status Not Valid [$status ]","","");
    }


    
    
    
//FRD PAYMENT REPORT UPDATING IN DB S:-
if($FR_VC_PaymentStatus == 1){
        $FRc_PayGtwId = 5;
        $FRR = FRF_PAYMENT_UPDATE($FRc_Invoice_Id_x,$FRc_InvoiceEncIdx,$amount,$FRc_PayGtwId,$tran_id,$fr_sslcmz_bank_ac_id);
        if($FRR['FRA'] == 1){
            //KEEP SAVE SOME MORE ADITIONAL INFORMATION OF THIS TRANJECTION:-
            try{
                $FRc_MTL_LastInId = $FRR['FRD_MTL_LastInId'];
                $FR_CONN->exec("UPDATE frd_mtl SET fr_sslcardtyp = '$RFc_card_type', fr_sslbanktrnid = '$bank_tran_id' WHERE id = $FRc_MTL_LastInId");
            }catch(PDOException $e){ 
                FR_TAL("Transection Additional Data Save Failed","error");
            }
            //END>>
           FR_SWAL("Dear $fr_cust_name Thank you !!","your payment has been successfully done.","success");
           FR_GO("$FRD_HURL/track/$FRc_InvoiceEncIdx",3);
        }else{
            FR_SWAL("$fr_cust_name !!","your payment failed. please try again","error");
            FR_GO("$FRD_HURL/track/$FRc_InvoiceEncIdx",3);
        }
}
//END>> 
?>
</section>
<!-- 1 scripts e-->
   








<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<?php require_once("frd-public/theme/frd-footer.php");
ob_end_flush();
?>