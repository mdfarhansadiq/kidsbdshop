<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: $FRD_HURL");

$FRc_InputData = file_get_contents("php://input");
$FRc_ARR = json_decode($FRc_InputData, true);//CONVERT JSON DATA TO ARRAY
extract($FRc_ARR);

$FR_OUTPUT = [];

//FRD_VC___________ALL REQUIRED DATA FILED:-
if($f_order_id != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; $FRR['FRM'] = "Please Fill All Required Field"; goto THIS_LAST; }



$FRQ = $FR_CONN->query("SELECT frsmsc_stc_otl,frsmsc_sta_nopa,frsmsc_stc_rrl FROM frd_soft_config WHERE id = 1");
extract($FRQ->fetch());


$FRQ = $FR_CONN->query("SELECT fr_cname,fr_cmobile_1,fr_cemail_1 FROM frd_cprofile WHERE id = 1");
extract($FRQ->fetch());

$FRR = FR_QSEL("SELECT * FROM frd_order_invo WHERE id = $f_order_id");
if($FRR['FRA']==1){ 
    $FRc_OrderId = $FRR['FRD']['id'];
    $FRc_OrderEncId = $FRR['FRD']['fr_enc_id'];
    $fr_cust_mob1 = $FRR['FRD']['fr_cust_mob1'];
    $fr_cust_name = $FRR['FRD']['fr_cust_name'];
    $FR_OUTPUT['FRA'] = 1;
    $FR_OUTPUT['FRM'] = "ORDER Data Found";
} else{ 
    $FR_OUTPUT['FRA'] = 2;
    $FR_OUTPUT['FRM'] = "ORDER Data Not Found";
    goto THIS_LAST;
}


    if($frsmsc_stc_otl == 1){
        $FRc_InvoiceLink = "$FRD_HURL/track/$FRc_OrderEncId";
        // $FRc_SMS_TEXT = "Dear $fr_cust_name, Thanks! \nYour $fr_cname OrderId: #$FRc_OrderId \n\nPlease Check product, price, address and more \n $FRc_InvoiceLink";
        // $FRc_SMS_TEXT = "Dear $fr_cust_name, Thanks! \nYour $fr_cname OrderId: #$FRc_OrderId \n\Tracking Link: $FRc_InvoiceLink";
        // $FRc_SMS_TEXT = "Hi Dear Thanks! \nYour $fr_cname OrderId: #$FRc_OrderId \n\Tracking Link: $FRc_InvoiceLink";
        $FRc_SMS_TEXT = "Dear Customer, Thanks for placing the order on $fr_cname! \n\nYour Order Id: #$FRc_OrderId \n\Tracking Link: $FRc_InvoiceLink";

        FR_SEND_SMS($fr_cust_mob1, $FRc_SMS_TEXT);
    }


    if($frsmsc_sta_nopa == 1){
        $FRc_InvoiceLink = "$FRD_HURL/track/$FRc_OrderEncId";
        $FRc_SMS_TEXT = "Dear $fr_cname, \n New order #$FRc_OrderId placed on your site \n\nPlease check and start prosess \n\n $FRc_InvoiceLink";
        FR_SEND_SMS($fr_cmobile_1, $FRc_SMS_TEXT);
    }


    if($FR_SERVER == 1){
        $FRc_InvoiceLink = "$FRD_HURL/track/$FRc_OrderEncId";
        
        $email_to = "$fr_cemail_1"; 
        $email_subject = "Congrats $fr_cname New Orders Placed By $fr_cust_name";
        $email_message = " Congrats $fr_cname One More New Orders Placed On Your eCommerce Site!  \n Please start processing  Order Id: #$FRc_OrderId \n \n Invoice: $FRc_InvoiceLink ";
        $email_headers = "From: $fr_cname ".$_SERVER['SERVER_ADMIN']."";
        if(mail($email_to, $email_subject, $email_message, $email_headers)){
            //echo "<h3 class='g'>Mail Send Successfull</h3>";
        }else{
            //echo "<h3 class='r'>Mail Send Failed</h3>";
        }
    }           


THIS_LAST:
echo json_encode($FRR);