<?php
//FRD 0 STEP VALIDATION:-
if("$Callingg" !== "FRD"){ header('https://google.com'); }


//FRD  DATA:-
    $FRR = FR_QSEL("SELECT * FROM frd_paygw_sslcom WHERE id = 1","");
    if($FRR['FRA']==1){ 
    extract($FRR['FRD']);
    } else{ ECHO_4($FRR['FRM']); }
//END>>

// FRD CUSTOM DATA PASS FROM CALL PLACE:-
    // $FRc_SSLcom_InvoiceId = ;
    // $FRc_SSLcom_InvoiceEncId = ;
    // $FRc_SSLcom_PayAmount = ;
    // $FRc_SSLcom_CB_CancelUrl = ;
    // $FRc_SSLcom_CustomerName = ;
    // $FRc_SSLcom_CustomerMobile = ;
    

    
    
    /* PHP */
                        $post_data = array();
                        $post_data['store_id'] = $sslcom_storid_frd;
                        $post_data['store_passwd'] = $sslcom_storpsw_frd;
                        $post_data['total_amount'] = $FRc_SSLcom_PayAmount;
                        $post_data['currency'] = "BDT";
                        $post_data['tran_id'] = "SSLc_$FRc_SSLcom_InvoiceId";
                        $post_data['success_url'] = "$FRD_HURL/sslcmz_pay_success/?iid=$FRc_SSLcom_InvoiceEncId";
                        $post_data['fail_url'] = "$FRc_SSLcom_CB_FailedUrl";
                        $post_data['cancel_url'] = "$FRc_SSLcom_CB_CancelUrl";
                        # $post_data['multi_card_name'] = "mastercard,visacard,amexcard";  # DISABLE TO DISPLAY ALL AVAILABLE
    
                        # EMI INFO
                        $post_data['emi_option'] = "1";
                        $post_data['emi_max_inst_option'] = "36";
                        //$post_data['emi_selected_inst'] = "9";
    
                        # CUSTOMER INFORMATION
                        $post_data['cus_name'] = "$FRc_SSLcom_CustomerName";
                        $post_data['cus_email'] = "$FRc_SSLcom_CustomerMobile";
        
                        //$post_data['cus_add1'] = "$otok_deli_address";
                        //$post_data['cus_add2'] = "Customer Address 2";
                        //$post_data['cus_city'] = "Customer City";
                        //$post_data['cus_state'] = "Customer State";
                        //$post_data['cus_postcode'] = "1900";
                        //$post_data['cus_country'] = "Customer Country";
                        //$post_data['cus_phone'] = "$otok_deli_mob1";
                        //$post_data['cus_fax'] = "01711111111";
    
    
    
                        # SHIPMENT INFORMATION
                        /*
                        $post_data['ship_name'] = "Ship Name";
                        $post_data['ship_add1 '] = "Ship Address";
                        $post_data['ship_add2'] = "Ship address 2";
                        $post_data['ship_city'] = "Ship city";
                        $post_data['ship_state'] = "Ship state";
                        $post_data['ship_postcode'] = "Ship postcode";
                        $post_data['ship_country'] = "Ship country";
                        */
    
    
    
                        # OPTIONAL PARAMETERS
                        /*
                        $post_data['value_a'] = "ref001";
                        $post_data['value_b '] = "ref002";
                        $post_data['value_c'] = "ref003";
                        $post_data['value_d'] = "ref004";
                        */
    
    
                        # CART PARAMETERS
                        /*
                        $post_data['cart'] = json_encode(array(
                            array("product"=>"DHK TO BRS AC A1","amount"=>"200.00"),
                            array("product"=>"DHK TO BRS AC A2","amount"=>"200.00"),
                            array("product"=>"DHK TO BRS AC A3","amount"=>"200.00"),
                            array("product"=>"DHK TO BRS AC A4","amount"=>"200.00")
                        ));
                        $post_data['product_amount'] = "100";
                        $post_data['vat'] = "5";
                        $post_data['discount_amount'] = "5";
                        $post_data['convenience_fee'] = "3";
                        */    
    
                        # REQUEST SEND TO SSLCOMMERZ
                        if($FR_SERVER == 1){
                            $direct_api_url = "https://securepay.sslcommerz.com/gwprocess/v4/api.php";
                        }else{
                            $direct_api_url = "https://sandbox.sslcommerz.com/gwprocess/v3/api.php";
                        }
    
                        $handle = curl_init();
                        curl_setopt($handle, CURLOPT_URL, $direct_api_url );
                        curl_setopt($handle, CURLOPT_TIMEOUT, 30);
                        curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 30);
                        curl_setopt($handle, CURLOPT_POST, 1 );
                        curl_setopt($handle, CURLOPT_POSTFIELDS, $post_data);
                        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
                        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, FALSE); # KEEP IT FALSE IF YOU RUN FROM LOCAL PC
    
                        $content = curl_exec($handle );
    
                        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
    
                        if($code == 200 && !( curl_errno($handle))) {
                            curl_close( $handle);
                            $sslcommerzResponse = $content;
                        } else {
                            curl_close( $handle);
                            echo "FAILED TO CONNECT WITH SSLCOMMERZ API";
                             ////// Refresh BTN S    
                             echo "
                             <div class='row TAC'>
                               <form id='refresh' action='' method='post'>
                                <button type='submit' name='pay_with_sslcom_sub' class='TAC'> Try Again </button> 
                              </form>
                             </div>
                              ";
                           ////// Refresh BTN E
                            exit;
                        }
    
                        # PARSE THE JSON RESPONSE
                        $sslcz = json_decode($sslcommerzResponse, true );
    
                        if(isset($sslcz['GatewayPageURL']) && $sslcz['GatewayPageURL']!="" ) {
                                # THERE ARE MANY WAYS TO REDIRECT - Javascript, Meta Tag or Php Header Redirect or Other
                                # echo "<script>window.location.href = '". $sslcz['GatewayPageURL'] ."';</script>";
                            echo "<meta http-equiv='refresh' content='0;url=".$sslcz['GatewayPageURL']."'>";
                            # header("Location: ". $sslcz['GatewayPageURL']);
                            exit;
                        } else {
                            echo "<div class='alert alert-danger TAC alertt'>JSON Data parsing error!</div>";
                        }