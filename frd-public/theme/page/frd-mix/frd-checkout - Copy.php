<?php
require_once("frd-public/theme/frd-header-s.php");
ob_start();
$FRc_PAGE_TITEL = "Checkout - $fr_cmetatitle";
$FRc_META_TAG_HTML = "
    <meta name='keywords' content='$fr_cmetatag'>
    <meta name='author' content='$fr_cname'> 
    <meta name='publisher' content='$fr_cname'>
    <meta name='copyright' content='$fr_cname'>
    <meta name='description' content='$fr_cmetades'>
    <meta name='page-topic' content='Ecommerce'>
    <meta name='page-type' content='Product'>
    <meta name='audience' content='Everyone'>
    <meta name='robots' content='index'>
";


require_once("frd-public/theme/frd-header.php");
?>
<!--<h2 class="PT"> Checkout Add Ship Address </h2>-->
<style type="text/css">
/* FRD OVERWRITE FRO THIS PSGE FORM MOBILE DEVICE */    
@media (max-width: 768px) {
    body {
       margin-right: 0px !important;
    }
}

table.ordersum1{
        width: 100%;
        font-weight: 800;
    }
    table.ordersum1 tr td{
        border: 1px solid #ddd;
        padding: 3px;
    }
</style>
<?php 
//   //FRD CART ITEM PRESENT STOCK VC:--------------------------
//   //CIPSVC:::CAET ITEM PRESEBT STOCK VALIDATION CHECKING
//   if(isset($_SESSION['FRs_Invo_Token'])){ 

//     $FRc_token=$_SESSION['FRs_Invo_Token']; 
    
        //FRD CART ALL ITEM FINDER:----------------------  
        //  $FRQ = $FR_CONN->query("SELECT id,pro_id FROM frd_x_to WHERE tokenn = $FRc_token AND statuss = 0 ORDER BY id ASC");
        //  $FRc_CartAllItemsArr = $FRQ->fetchAll();
    
    
//         //FRD:---------------------
//             foreach ($FRc_CartAllItemsArr as $FR_item) {
//                  $FRc_id = $FR_item['id'];
//                  $FRc_proid = $FR_item['pro_id'];
    
//                  //FRD CART ITEM PRODUCT PRESENT INFO FINED:-
//                      $fr_q1 = "SELECT qtyy,statuss,visibi FROM frd_products WHERE id = $FRc_proid";
//                      $FRQ = $FR_CONN->query("$fr_q1");
//                      $fr_arr1 = $FRQ->fetch();
//                      $FRc_ItemNowQty=$fr_arr1['qtyy'];
//                      $FRc_ItemNowStat=$fr_arr1['statuss'];
//                      $FRc_ItemNowVisi=$fr_arr1['visibi'];
//                     //echo "<h4>PRODUCT_ID: $FRc_proid == QTY: $FRc_nowqty</h4>";
                
    
//                  //FRD CART ITEM REMOVE IF ITEM PRESENT STOCK 0:-
//                      if($FRc_ItemNowQty==0 or $FRc_ItemNowStat != 1 or $FRc_ItemNowVisi != 1){
                            //  $FR_CONN->exec("UPDATE frd_x_to SET statuss = 1 where id = $FRc_id");
//                      }
    
    
//             }      
//   }
//     //END>>
?>



<!-- 1 scripts s-->
<section>
<?php
//FRD_VC______________________________________________________:-
if(!isset($_SESSION['FRs_Invo_Token'])){
    FR_GO("$FR_THISHURL?FRH=fc162811bs");
    exit;
}else{
    $FRs_Invo_Token = $_SESSION['FRs_Invo_Token'];
    $FRs_Invo_EncId = $_SESSION['FRs_Invo_EncId'];
}
//++
//FRD_VC_________________________________________________________:-
if(!isset($_SESSION['s_cust_id'])){
    if($frd_gom=="frd_off"){
         header("location:$FRD_HURL/login?next_destination=$FRD_HURL/checkout"); 
    }
}




//----------------------------------------------------------------
//FRD PRODUCT DELIVERY CHARGE TYPE FINDER:-
//----------------------------------------------------------------
$FRc_DeliChargeTyp = 0;
$FRR = FR_QSEL("SELECT COUNT(id) AS FRc_DeliChargeTyp FROM frd_order_items WHERE deli_crg_typ = 2 AND fr_invo_id = $FRs_Invo_Token","");
if($FRR['FRA']==1){ 
    extract($FRR['FRD']);
} else{ 
    ECHO_4($FRR['FRM']);
 }






//FRD CUSTOMER DATA MAKING:-
if (isset($_SESSION['s_cust_pemail'])) {
    $FRc_CustomerIdx = $_SESSION['s_cust_id'];

    $FRR = FR_QSEL("SELECT * FROM frd_usr WHERE id = $FRc_CustomerIdx AND typee = 'cu' AND statuss = 1", "");
    if ($FRR['FRA'] == 1) {
        extract($FRR['FRD']);
    } else {
        ECHO_4($FRR['FRM']);
    }
    if ($typee != 'cu') {
        header("location:$FRD_HURL/logout?hc1573935");
    } //FRD VC

    $FRc_CustomerId = $id;
    $FRc_CustomerType = 1; //[1 = REGISTER CUSTOMER]
    $FRc_CustomerName = "$namee";
    $FRc_CustomerMobile = "$email1";
    $FRc_CustomerAddress = "$addresss";
    $FRc_CustomerGenger = "$genderr";
} else {
    $FRc_CustomerId = 1; //[1=GUEST CUSTOMER]
    $FRc_CustomerType = 2; //[2=GUEST CUSTOMERS]
    $FRc_CustomerGenger = "";
    $FRc_CustomerName = "";
    $FRc_CustomerMobile = "";
    $FRc_CustomerAddress = "";
}

$FRc_OrderNote = "";
if(isset($_SESSION['FRs_ItmePlusMinus_Note'])){ $FRc_OrderNote = $_SESSION['FRs_ItmePlusMinus_Note']; }

$FRc_ShipCost = "";
if(isset($_SESSION['FRs_ItmePlusMinus_DeliCharge'])){ $FRc_ShipCost = $_SESSION['FRs_ItmePlusMinus_DeliCharge']; }

//END>>

    
    
    
    ///////////////////////////////////////////////////////////////
    // FRD CART  SUMMERY FINDER
    ///////////////////////////////////////////////////////////////
    $FRR = FR_QSEL("SELECT * FROM frd_order_invo WHERE id = $FRs_Invo_Token AND fr_stat = 0","");
        if($FRR['FRA']==1){ 
          extract($FRR['FRD']);
        } else{ 
            ECHO_4("NO INVOICE DATA FOUND","alert alert-danger text-center");
         }
    
    $FRR = FR_QSEL("SELECT COUNT(id) AS FRc_Invoice_Tot_Items, SUM(fr_qty) AS FRc_Invoice_Tot_Qty, SUM(fr_t_price) AS FRc_InvoiceItems_Tot_Price FROM frd_order_items WHERE fr_invo_id = $FRs_Invo_Token AND fr_stat = 0","");
    if($FRR['FRA']==1){ 
    extract($FRR['FRD']);
    } else{ 
        ECHO_4($FRR['FRM']);
    }





//////////////////////////////////////////////////////////////////////////////////////////////////
//FRD FINAL ORDER PLACING
/////////////////////////////////////////////////////////////////////////////////////////////////
if(isset($_POST['delivery_name'])){

    // PR($_POST);
    // exit;

    $FR_VC_MobNumber = "";

    $FR_VC_ORDER_INVO_TDUP = "";//ORDER INVOICE TABLE DATA UPDATE
    $FR_VC_ORDER_ITEMS_TDUP = "";//ORDER ITEMS TABLE DATA UPDATE

    $FR_VC_ProdStockMng = "";


    //FRD FORM DATA RECIVING:-
        $f_delivery_name = preg_replace("/'/"," ",$_POST['delivery_name']);
        $f_delivery_mobile1 = $_POST['delivery_mobile1'];

        if(isset($_POST['frf_ship_zone_id'])){
            $frf_ship_zone_id = $_POST['frf_ship_zone_id'];
        }else{
            $frf_ship_zone_id = 2;
        }

        $FRc_DeliNote = "";
        if(isset($_POST['delivery_note'])){ $FRc_DeliNote = $_POST['delivery_note']; }
    
        if($FR_DeliAddForm == "1"){
            $f_delivery_address = $_POST['delivery_address'];
            $FRc_DeliAddress = "$f_delivery_address";
        }
        elseif($FR_DeliAddForm=="2"){
                $frf_HomeOrAriax = $_POST['frf_HomeOrAria'];
                $frf_thananamex = $_POST['frf_thananame'];
                $frf_districx = $_POST['frf_distric'];
            $FRc_DeliAddress = " বাড়ি/এলাকা: $frf_HomeOrAriax & থানা: $frf_thananamex & জেলা: $frf_districx";
        }
        elseif($FR_DeliAddForm=="3"){
            $frf_divx = $_POST['frf_devision'];
            $FRc_DeliAddress = " বাড়ি/এলাকা: $frf_HomeOrAriax & থানা: $frf_thananamex & জেলা: $frf_districx & বিভাগ: $frf_divx";
        }


    //FRD SHIP ZONE TABLE DATA :-
    if($frf_ship_zone_id > 0){
        $FRR = FR_QSEL("SELECT * FROM frd_ship_zone WHERE id = $frf_ship_zone_id","");
        if($FRR['FRA']==1){ 
           extract($FRR['FRD']);
           $FRc_Ship_Zone_Id = $id;
        } else{ ECHO_4($FRR['FRM']); }
    }else{
       $fr_sz_shipcost = 0;//CUSTOM SHIP ZONE COST
    }
        
    //END>>  

    

    //FRD CUSTOM DATA MAKING:-
        $FRc_OrderProsHistory = "প্রিয় $f_delivery_name ধন্যবাদ! আপনার অর্ডারটি প্লেস হয়েছে। অতি শীঘ্রই আমাদের প্রতিনিধি আপনার সাথে যোগাযোগ করে অর্ডারটি কনফার্ম করবে। * ".date('d-M-Y h:i A',$FR_NOW_TIME)."";
        $FRc_OrderProsHistory .= ", প্রিয় $f_delivery_name! আপনার অর্ডারটি পেন্ডিং আছে। * ".date('d-M-Y h:i A',$FR_NOW_TIME)."";
        $FRc_OrderPlaceUsrId = 0;

    //FRD DATA OVERWRITING IF HAVE ADMIN LOGIN:-
    if(isset($_SESSION['sUsrId'])){ 
        $FRc_OrderProsHistory = "প্রিয় $f_delivery_name ধন্যবাদ! আপনার অর্ডারটি প্লেস হয়েছে। আমাদের প্রতিনিধি ".$_SESSION['sUsrName']." আপনার জন্য এই অর্ডারটি প্লেস করেছে ।* ".date('d-M-Y h:i A',$FR_NOW_TIME)."";
        $FRc_OrderProsHistory .= ", প্রিয় $f_delivery_name! আপনার অর্ডারটি পেন্ডিং আছে। * ".date('d-M-Y h:i A',$FR_NOW_TIME)."";
        $FRc_OrderPlaceUsrId = $_SESSION['sUsrId']; 
    }

    //FRD CUSTOM CALCULATING:-
        $FRc_SubTotal = ($FRc_InvoiceItems_Tot_Price + $fr_sz_shipcost);
        $FRc_Payable = $FRc_SubTotal;
        $FRc_InvoiceDue  = $FRc_SubTotal;


    //FRD MOBILE MUMBER REPLACE BANGLA TO ENGLISH:-
    if(!preg_match('/^[0-9]{11}+$/', $f_delivery_mobile1)) {
        $f_delivery_mobile1 = preg_replace("/০/","0",$f_delivery_mobile1);
        $f_delivery_mobile1 = preg_replace("/১/","1",$f_delivery_mobile1);
        $f_delivery_mobile1 = preg_replace("/২/","2",$f_delivery_mobile1);
        $f_delivery_mobile1 = preg_replace("/৩/","3",$f_delivery_mobile1);
        $f_delivery_mobile1 = preg_replace("/৪/","4",$f_delivery_mobile1);
        $f_delivery_mobile1 = preg_replace("/৫/","5",$f_delivery_mobile1);
        $f_delivery_mobile1 = preg_replace("/৬/","6",$f_delivery_mobile1);
        $f_delivery_mobile1 = preg_replace("/৭/","7",$f_delivery_mobile1);
        $f_delivery_mobile1 = preg_replace("/৮/","8",$f_delivery_mobile1);
        $f_delivery_mobile1 = preg_replace("/৯/","9",$f_delivery_mobile1);
    }

 //FRD________________________________VC PHOE NUMBER VALIDATION CHECKING:-
    if(preg_match('/^[0-9]{11}+$/', $f_delivery_mobile1)) {
        $FR_VC_MobNumber = 1;
    }else{
        echo "<script>toastr.error('PHON NUMBER NOT VALID');</script>";
        FR_SWAL("অনুগ্রহ করে সঠিক মোবাইল নাম্বার দিন","মোবাইল নাম্বার ইংলিশে লিখতে হবে","error");
        // FR_GO("$FR_THISPAGE",3);
    }

    //FRD CUSTOMER NAME AUTO SAVING FOR FUTURES:-
        if($FRc_CustomerId > 1 AND $FR_VC_MobNumber == 1){
            $FRQ = "UPDATE frd_usr SET namee = '$f_delivery_name', addresss = '$FRc_DeliAddress' WHERE id = $FRc_CustomerId";
            try{
                $FR_CONN->exec("$FRQ");
            }catch(PDOException $e){
               $FRR['FRM_ERROR'] = $e->getMessage();
            }
        }
    //END>>


    //FRD AUTO FILL FORM IF HAVE NOT PLACE ORDER:-
        $FRc_CustomerName = "$f_delivery_name";
        $FRc_CustomerMobile = "$f_delivery_mobile1";
        $FRc_CustomerAddress = "$FRc_DeliAddress";
        $FRc_OrderNote = "$FRc_DeliNote";


    
    //FRD ORDER INVOICE TABLE DATA UPDATE:-
        if($FR_VC_MobNumber == 1){
            $FRQ = "UPDATE frd_order_invo SET 
            fr_cust_id = '$FRc_CustomerId',
            fr_cust_gen = '$FRc_CustomerGenger',
            fr_cust_name = :fr_cust_name,
            fr_cust_mob1 = :fr_cust_mob1,
            fr_cust_addres = :fr_cust_addres,
            fr_cust_o_note = :fr_cust_o_note,

            fr_pro_total = '$FRc_InvoiceItems_Tot_Price',
            fr_ship_cost = '$fr_sz_shipcost',
            fr_sub_total = '$FRc_SubTotal',
            fr_payable = '$FRc_Payable',
            fr_invo_due = (fr_payable - fr_payment),

            fr_stat = '1',
            fr_o_date = '$FR_NOW_DATE',
            fr_o_time = '$FR_NOW_TIME',
            fr_o_p_usrid = $FRc_OrderPlaceUsrId,
            fr_o_pros_history = '$FRc_OrderProsHistory'
            WHERE id = $FRs_Invo_Token AND fr_stat = 0";
            try{
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':fr_cust_name', $f_delivery_name, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_cust_mob1', $f_delivery_mobile1, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_cust_addres', $FRc_DeliAddress, PDO::PARAM_STR);
                $FRQ->bindParam(':fr_cust_o_note', $FRc_DeliNote, PDO::PARAM_STR);
                $FRQ->execute();
                // FR_SWAL("ORDER INVOICE TABLE DATA UPDATE DONE","","success");
                $FR_VC_ORDER_INVO_TDUP = 1;
            }catch(PDOException $e){
                FR_SWAL("ORDER INVOICE TABLE DATA UPDATE FAILED","","error");
                FR_GO("$FR_THISPAGE","3");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                exit;
            }
        }
    //END>>
    //++
    //++
    //FRD ORDER ITEM TABLE DATA UPDATE:-
    if($FR_VC_ORDER_INVO_TDUP == 1){
        $FRQ = "UPDATE frd_order_items SET 
        fr_cust_id = $FRc_CustomerId,
        fr_stat = 1,
        fr_o_date = '$FR_NOW_DATE'
        WHERE fr_invo_id = $FRs_Invo_Token";
        $R2 = FR_DATA_UP("$FRQ");
        if($R2['FRA']==1){
            //  FR_SWAL("ORDER ITEMS TABLE DATA UPDATE DONE","","success");
             $FR_VC_ORDER_ITEMS_TDUP = 1;
                unset($_SESSION['FRs_Invo_Token']);
                unset($_SESSION['FRs_Invo_EncId']);
                unset($_SESSION['s_keepcartopen']);
                $_SESSION['cart_items']=0;
                $_SESSION['cart_price']=0;
        }else{
            FR_SWAL("ORDER ITEMS TABLE DATA UPDATE FAILED","","error");
            FR_GO("$FR_THISPAGE","3");
            exit;
        }
    }
    //END>>
    
    

    //FRD PRODUCT STOCK MANAGMENT START:-
        if($FR_VC_ORDER_ITEMS_TDUP == 1){
                $FRR = FR_QSEL("SELECT fr_pro_id,fr_qty FROM frd_order_items WHERE fr_invo_id = $FRs_Invo_Token AND fr_stat = 1","ALL");
                if($FRR['FRA']==1){  
                foreach($FRR['FRD'] as $FR_ITEM){
                    extract($FR_ITEM);
                            //FRD PROSESS PRODUCT PRESENT QTY FIEND:-
                                $FRq_PSM_2 = "SELECT qtyy FROM frd_products WHERE id = $fr_pro_id";
                                $FRQ = $FR_CONN->query("$FRq_PSM_2");
                                $FRrow_PSM_2 = $FRQ->fetch();
                                $FRc_Pro_Curr_Qty = $FRrow_PSM_2['qtyy'];
                
                            if($FRc_Pro_Curr_Qty > 0){
                                $FRQ = "UPDATE frd_products SET qtyy = qtyy-$fr_qty WHERE id = $fr_pro_id";
                                try{
                                    $FR_CONN->exec("$FRQ");
                                    // FR_SWAL("STOCK MANGMENT DONE","","success");
                                    $FR_VC_ProdStockMng = 1;
                                }catch(PDOException $e){
                                    FR_SWAL("STOCK MANGMENT FAILED","","error");
                                    echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                                }
                            }  
                    
                }
                } else{ PR($FRR);}
                
        }
    //END>



    //FRD THANK YOU SMS SENT TO CUSTOMERS:-
    if($FR_VC_ProdStockMng == 1){
        if($frsmsc_stc_otl == 1){
            $FRc_InvoiceLink = "$FRD_HURL/track/$FRs_Invo_EncId";
            $frd_sms_to = "$f_delivery_mobile1";
            $frd_sms_text = "$f_delivery_name Thanks! \nYour $fr_cname OrderId: #$FRs_Invo_Token \n\nPlease Check product, price, address & more \n $FRc_InvoiceLink";
            if($frd_smsapi_ex == "onn"){ FR_SEND_SMS($frd_sms_to, $frd_sms_text); }
        }
        if($frsmsc_sta_nopa == 1){
            $FRc_InvoiceLink = "$FRD_HURL/track/$FRs_Invo_EncId";
            $frd_sms_to = "$f_delivery_mobile1";
            $FRc_SMS_Text = "Hi $fr_cname \ New order #$FRs_Invo_Token placed on your site \n\nPlease check and start prosess \n\n $FRc_InvoiceLink";
            if($frd_smsapi_ex == "onn"){ FR_SEND_SMS($fr_cmobile_1, $FRc_SMS_Text); }
        }

    }
    //END>>
    //++
    //FRD ORDER PLACED EMAIL NOTIFICATION SEND TO ADMIN:-
    if($FR_VC_ProdStockMng == 1){
        if($FR_SERVER == 1){
            $email_to = "$fr_cemail_1"; 
            $email_subject = "Congrats $fr_cname New Orders Placed By $f_delivery_mobile1";
            $email_message = " Congrats $fr_cname One More New Orders Placed On Your Ecommerce Site!  \n Please start processing  Order Id: #$FRs_Invo_Token \n \n Invoice: $FRc_InvoiceLink ";
            $email_headers = "From: $fr_cname ".$_SERVER['SERVER_ADMIN']."";
            if(mail($email_to, $email_subject, $email_message, $email_headers)){
                //echo "<h3 class='g'>Mail Send Successfull</h3>";
            }else{
                //echo "<h3 class='r'>Mail Send Failed</h3>";
            }
        }
    }
    //END>>

    //FRD LAST ACTION:-
    if($FR_VC_ProdStockMng == 1){

        if(isset($_SESSION['sUsrId'])){ 
                if(isset($_SESSION['FRs_ItmePlusMinus'])){
                    FRF_CLOGOUT();
                    unset($_SESSION['FRs_ItmePlusMinus']);
                    unset($_SESSION['FRs_ItmePlusMinus_Note']);
                    unset($_SESSION['FRs_ItmePlusMinus_DeliCharge']);
                }

            FR_SWAL("".$_SESSION['sUsrName']." Order Placed Done! Going To Orders Prosess!","","success");
            FR_GO("$FRD_HURL/frdsp/dp/om-InvoiceEdit/$FRs_Invo_EncId",2);
            // FR_GO("$FRD_HURL",3);
            exit;
        }else{
            $_SESSION['FRs_GTM_purchase_Evnt_Fire'] = "1";
            FR_GO("$FRD_HURL/track/$FRs_Invo_EncId",1);
        }


        echo "<br><br><br><br><br><br><br><br><br><br><br><br><br>";
        echo "<br><br><br><br><br><br><br><br><br><br><br><br><br>";
    }
    //END>>

   
    
}
//END>>

    

   
?>
</section>
<!-- 1 scripts e-->
   


<!-- ### -->
<section>
   <?php //if(!isset($_POST['dofrd_placeorder_inni'])){ ?>
     <div class="container">
       
        <div class="row fr-mt-10">
            <div class="col-md-4">

            </div>
            <div class="col-md-4">

                <!-- CHECKOUT-FORM -->
                <form class="fdeliAadd fcheckout" action="" method="post" class="" autocomplete="on">
                   
                    <h4 class="text-center boldd"><span class="glyphicon glyphicon-send"></span> <?php echo "$frlc_give_delivery_info_txt";?></h4>
                  <table class="t_deliform" width="100%">
                      <tr>
                          <td>
                               <small><?php echo "$frlc_full_name_txt";?></small>
                               <input class="form-control" type="text" name="delivery_name" id="f_delivery_name" placeholder="<?php echo "$frlc_full_name_txt";?>" value="<?php echo "$FRc_CustomerName"?>" required> 
                          </td>
                      </tr>
                      <tr>
                          <td class="boldd"> 
                              <small><?php echo "$frlc_mobile_number_txt";?></small>
                              <input class="form-control" type="text" name="delivery_mobile1" id="f_delivery_mobile1" placeholder="<?php echo "$frlc_mobile_number_txt";?>" value="<?php echo "$FRc_CustomerMobile"?>"  minlength="11" maxlength="11" required>
                          </td>
                      </tr>
                      
                      <?php if($FR_DeliAddForm=="1"){ ?>
                      <tr>
                          <td>
                             <!-- <i><small>[ উদাহরণস্বরূপ:  বাড়ির নাম্বার 24, রোড 21, ব্লক এ, গুলশান , ঢাকা 1212 ]</small></i> -->
                              <small class=""><?php echo "$frlc_delivery_address_txt";?> <?php if($frtc_cf_fildadress_r == 1){echo "*";}?></small>
                              <textarea class="form-control" name="delivery_address" id="f_delivery_address" cols="20" rows="2" placeholder="<?php echo "$frlc_delivery_address_txt";?>" <?php if($frtc_cf_fildadress_r == 1){echo "required";}?>> <?php echo "$FRc_CustomerAddress";?></textarea>
                          </td>
                      </tr>
                      <?php } ?>
                      
                      <?php 
                      if($FR_DeliAddForm=="2"){ 
                        ?>
                      <tr>
                          <td>
                          <br> 
                          বাড়ির নাম্বার *</td>
                          <td>
                              <br>
                               <input class="form-control" type="text" name="frf_HomeOrAria" placeholder=" বাড়ির নাম্বার / এলাকার নাম / গ্রাম *" value="<?php echo ""?>" required>
                          </td>
                      </tr>
                     <tr>
                          <td>
                          <br> 
                          থানা *</td>
                          <td>
                              <br>
                               <input class="form-control" type="text" name="frf_thananame" placeholder="থানার নাম *" value="<?php echo ""?>" required>
                          </td>
                      </tr>
                     <tr>
                          <td>
                          <br> 
                          জেলা *</td>
                          <td>
                              <br>
                               <input class="form-control" type="text" name="frf_distric" placeholder="জেলার নাম *" value="<?php echo ""?>" required>
                          </td>
                      </tr>
                       <?php } ?>
                       
                       
                       
                       
                       
                       <?php
                      //FRD DELIVERY FORM 3:---
                      if($FR_DeliAddForm=="3"){ ?>
                      <tr>
                          <td>বিভাগ * </td>
                          <td>
                              <br>
                               <select class="form-control" id="selectDivision" name="frf_devision" required >
                                    <option id="op" value="" >এখানে ক্লিক করে আপনার বিভাগ নির্বাচন করুন *</option>
                                    <option value="Barishal">Barishal</option>
                                    <option value="Chittagong">Chittagong</option>
                                    <option value="Dhaka">Dhaka</option>
                                    <option value="Khulna">Khulna</option>
                                    <option value="Mymensingh">Mymensingh</option>
                                    <option value="Rajshahi">Rajshahi</option>
                                    <option value="Rangpur">Rangpur</option>
                                    <option value="Sylhet">Sylhet</option>
                                </select>
                          </td>
                      </tr>
                      
                      <tr id="frf_discrick_sec" style="display: none;">
                          <td>
                              জেলা *
                          </td>
                          <td>
                             <br>
                              <select class='form-control' id='frf_discrick' name='frf_distric' required>
                
                              </select> 
                          </td>
                      </tr>
                         
                        <tr id="frf_thana_sec" style="display: none;">
                          <td>
                             থানা *
                          </td>
                          <td>
                             <br>
                              <select class='form-control' id='frf_thana' name='frf_thananame' required>

                               </select>  
                          </td>
                        </tr>
                         
                         <tr id="frf_HomeOrAria_Div" style="display: none;">
                          <td>
                             এলাকা *
                          </td>
                          <td>
                           <br>
                            <div>
                                <span>এলাকার নাম, রাস্তার নাম, বাসার নাম্বার, ফ্লোর  etc *</span>
                                <input type="text" class="form-control" id="frf_HomeOrAria" placeholder="Input এলাকার নাম, রাস্তার নাম, বাসার নাম্বার, ফ্লোর  etc *" value="" name="frf_HomeOrAria" required>
                            </div> 
                          </td>
                        </tr>
                       <?php } ?>
                       
                       

                    
                       
                      <?php if($FR_Dfild_Note=="YES"){ ?>
                      <tr>
                          <td>
                              <small class=""><?php echo "$frlc_note_txt";?> </small>
                              <textarea class="form-control" name="delivery_note" id="addnote_fild" cols="20" rows="2" placeholder="<?php echo "$frlc_note_txt";?>"><?php echo "$FRc_OrderNote";?></textarea>
                          </td>
                      </tr>
                      <?php } ?>
                      
                      <!-- <tr id="frf_delizoneSec">
                          <td>
                           <select class="form-control" name="frf_ship_zone_id" id="" required>

                                <?php
                                // //FRD:--
                                // if($FRc_DeliChargeTyp == 0){
                                //     echo "<option value=''> $frlc_select_delivery_zone_txt </option>";
                                //     $FRR = FR_QSEL("SELECT * FROM frd_ship_zone WHERE fr_sz_name !='' ORDER BY id ASC","ALL");
                                //     if($FRR['FRA']==1){ 
                                //                 foreach($FRR['FRD'] as $FR_ITEM){
                                //                     extract($FR_ITEM);
                                //                     echo "<option value='$id'> $fr_sz_name [ $frlc_delivery_charge_txt $fr_sz_shipcost $frlc_tksymbol_txt ]  </option>";    
                                //                 }
                                //     } else{ 
                                //         echo "<div class='text-center alert alert-danger'>No Spip Zone Found</div>";
                                //     }
                                // }

                                // //FRD:--
                                // elseif($FRc_DeliChargeTyp > 0){
                                //       echo "<option value='0'> $frlc_delivery_charge_free_txt </option>";
                                // }
                               ?>


                            </select>
                          </td>
                      </tr> -->


                      <tr id="frf_delizoneSec">
                          <td>
                            <div class="fr-mt-10"></div>
                             <small class="boldd"><?php echo "$frlc_select_delivery_zone_txt";?></small><br>

                             <?php
                                //FRD:--
                                if($FRc_DeliChargeTyp == 0){
                                    $FRR = FR_QSEL("SELECT * FROM frd_ship_zone WHERE fr_sz_name !='' ORDER BY id ASC","ALL");
                                    if($FRR['FRA']==1){ 
                                                $FRc_Checked = "";
                                                foreach($FRR['FRD'] as $FR_ITEM){
                                                    extract($FR_ITEM);

                                                    if($fr_sz_shipcost == $FRc_ShipCost){
                                                        $FRc_Checked = "checked";
                                                    }
                                                    
                                                    echo "&#160; <input type='radio' name='frf_ship_zone_id' class='f_sz_radiobtns' id='sz_radio_btn_$id' value='$id' $FRc_Checked> <span class='sz_radio_btn_text' id='$id' role='button'> $fr_sz_name [ $fr_sz_shipcost $frlc_tksymbol_txt ] </span> <br> ";

                                                }
                                    } else{ 
                                        echo "<div class='text-center alert alert-danger'>No Spip Zone Found</div>";
                                    }
                                }

                                //FRD:--
                                elseif($FRc_DeliChargeTyp > 0){
                                      echo "&#160; <input type='radio' name='frf_ship_zone_id' value='0' checked required> $frlc_delivery_charge_free_txt ";
                                }
                               ?>
                          </td>
                      </tr>


                     <tr>
                        <td>
                          <div id="FF_DATA_CART_ITEMLIST_2"></div>
                        </td>
                     </tr>
                    
    

                      <tr>
                          <td>
                         
                             <?php if($frtc_OrdrTimeIagree == 'YES'){ ?>
                                <hr>
                                <input type="checkbox" required>
                                <span><?php echo "$frlc_iagree_txt";?><u class='cfrd_qv_tramsccondi pointer' id='terms-and-conditions'><i> <?php echo "$fr_vp_tramsandcondition_txt";?> </i></u>, <u class='cfrd_qv_tramsccondi pointer' id='privacy-policy'><i><?php echo "$fr_vp_privacypolicy_txt";?> </i></u>, <u class='cfrd_qv_tramsccondi pointer' id='refund-policy'><i><?php echo "$fr_vp_returnpolicy_txt";?> </i></u>, <u class='cfrd_qv_tramsccondi pointer' id='delivery-policy'><i><?php echo "$fr_vp_deliverypolicy_txt";?> </i></u> </span>
                            <?php }; ?>

                            <br/><br/>

                              <?php 
                                 if($FRc_InvoiceItems_Tot_Price>=$frd_order_mintk){ 
                              ?>  
                              <button class="btn btn-success btn-block FrOrderPlaceBtnCF Frtrig_OrderPlace" type="submit" name="dofrd_placeorder_inni"><?php echo "$frd_placeorder_btn_txt";?> <span class="glyphicon glyphicon-arrow-right alertt"></span></button>
                            
                              <?php 
                                    }else{
                                        echo "<h4 class='alert alert-danger'> সর্বনিম্ন <i class='alertt'> $frd_order_mintk </i> টাকার শপিং করতে হবে,<br>  প্রয়োজনে পন্যের পরিমান বাড়িয়ে দিন অথবা অন্যান্য পন্য কার্টে যুক্ত করুন। </h4>";
                                    }
                               ?> 
                              
                          </td>
                      </tr>
                      
                  </table>
                
                </form>
                
            
                <br><br>
                <br><br>

                <?php 
                if($frd_gom=="frd_on"){ 
                    if(!isset($_SESSION['s_cust_pemail'])){
                ?>
                <form action="<?php echo "$FRD_HURL/login";?>" method="post">
                   <button type="submit" class="btn btn-default btn-block btn-sm FRorderWithloginSingupBtn_hycx" ><span class="glyphicon glyphicon-arrow-left alertt"></span><?php echo " $frlc_orderwihtlogin_txt";?></button>
                </form>
                <?php } }?>
                
            </div>
            <div class="col-md-4">   



            </div>
        </div>
        

        
    </div>
   <?php //} ?>
</section>




<script type="text/javascript">
       $(document).ready(function(){

        //MIXD VARIVEL:-   
         var FR_DeliFormTyp = '<?php echo "$FR_DeliAddForm";?>';
         var FRdistricoptions = '<?php echo "$FRD_HURL/ginc/fr_plugin/a/fr1_bdthana/fr_districk_options.php";?>';
         var FRThanaptions = '<?php echo "$FRD_HURL/ginc/fr_plugin/a/fr1_bdthana/fr_thana_options.php";?>';

        $( ".Frtrig_OrderPlace" ).on( "click", function() {
            // event.preventDefault();
            let f_delivery_name = $('#f_delivery_name').val();
            let f_delivery_mobile1 = $('#f_delivery_mobile1').val();

            if(f_delivery_name !="" && f_delivery_mobile1 !=""){
                       $(".FrOrderPlaceBtnCF").hide();
                        // swal("Please Wait Your Order Is Placingi","","warning");
                        $('#FR_SPIDER_MODEL_DATA').html("<h3 class='text-center'>  <img src='frd-public/theme/asset/img/order-placing-wait.gif' alt='#' height='200px' width='auto'> <br> Please Wait Your Order Is Processing... </h3>");
                        $('#FR_SPIDER_MODEL .modal-dialog').addClass('modal-dialog-centered');
                        $('#FR_SPIDER_MODEL').modal("show");
            }else{
                toastr.warning("Please Fill All Required Field");
            }

            
         });

         //FRD TEXT CLICK RADIO BUTTON SELECT:-
         $( ".sz_radio_btn_text" ).on( "click", function() {
            let fr_this_radio_btn_id = $(this).attr("id"); 
            $('.f_sz_radiobtns').attr('checked', false);
            $('#sz_radio_btn_'+fr_this_radio_btn_id).attr('checked', true);
         });
         //END>>

        //FRD CART ITEMS 2 CALL:-
         $.ajax({  
            url: FR_HURL_APII +'/CartItems2',
            method:"post",
            data:{a:'a'},
            success:function(data){  
                $('#FF_DATA_CART_ITEMLIST_2').html(data);
            }  
        });
           
           

 
          
       


       //FRD QUICK VIEW  TRAMS & CONDITION AND  DELEVERY POLICY:-
       $('.cfrd_qv_tramsccondi').click(function(){  
           var frd_page_slug = $(this).attr("id");
           //alert(frd_page_slug);
            $.ajax({  
                url:"<?php echo "$FR_HURL_API/PageQuickView";?>",
                method:"post",
                data:{frd_page_slug:frd_page_slug},
                success:function(data){  
                    $('#model_masterpis_data').html(data);
                    $('#model_masterpis').modal("show");
                }  
           });
        });
           
           
        
     //FRD DELIVERY FORM 3 FORM START:-
       //HEARE IS SOMETHING    
       $("#selectDivision").unbind().change(function () {
                   var FR_SelectDivis = $(this).val();
                   //alert(FR_SelectDivis);
                         $.ajax({
                            url:FRdistricoptions,
                            method:"POST",
                            data:{FR_SelectDivis:FR_SelectDivis},  
                            success:function(data){ 
                                 //console.log(data);
                                 //alert(data);
                                 $('#frf_discrick_sec').show();
                                 $('#frf_discrick').html(data);
                                 
                                
                            },
                             error: function () {
                                console.log('AJAX ERROR');
                            },
                       });
       
                   $('#frf_discrick_sec').hide();
                   $('#frf_thana_sec').hide();
                   $('#frf_HomeOrAria_Div').hide();
       
              });
    
    
       $("#frf_discrick").unbind().change(function () {
                   var FR_SelectDistrick = $(this).val();
                    //alert(FR_SelectDistrick);
                         $.ajax({
                            url:FRThanaptions,
                            method:"POST",
                            data:{FR_SelectDistrick:FR_SelectDistrick},  
                            success:function(data){ 
                                 //alert(data);
                                 //console.log(data);
                                $('#frf_thana_sec').show();
                                 $('#frf_thana').html(data);
        
                            },
                             error: function () {
                                console.log('AJAX ERROR');
                            },
                       });
              });
           
          $("#frf_thana").unbind().change(function () {
                   //var FR_SelectThana = $(this).val();
                    //alert(FR_SelectThana);
                    $('#frf_HomeOrAria_Div').show();
              });
    //FRD DELIVERY FORM 3 FORM END> 

 

 });   
</script>


<?php if($frtcplug_GTMdataLayer == 1){ ?>
<!-- FRD GTM begin_checkout FIRE | FRD GTM EVERNT -->
<script>
$(document).ready(function(){

    dataLayer.push({ ecommerce: null });  // Clear the previous ecommerce object.
    dataLayer.push({
    event: "begin_checkout",
    ecommerce: {
        currency: "BDT",
        value: <?php echo $_SESSION['cart_price'];?>,
        affiliation: "<?php echo "$fr_cname"; ?>",
        coupon: "N/A",
        items: [

            <?php 
           $FRR = FR_QSEL("SELECT * FROM frd_order_items WHERE fr_invo_id = $FRs_Invo_Token ", "ALL");
           if ($FRR['FRA'] == 1) {
                  
            $FRc_ArrayC = count($FRR['FRD']);

                $FRc_Coma = ",";
                $FRc_SL = 1;
                foreach ($FRR['FRD'] as $FR_ITEM) {
                   extract($FR_ITEM);

                   if($FRc_SL == $FRc_ArrayC){ $FRc_Coma = ""; }

                    extract(FRF_BRAND_NAME($r_brand));
                    $pro_r_brand_name = $FRc_BRAND_NAME;

                    extract(FRF_COLOR_NAME($r_color));
                    $FRsd_ProColorName = $FRc_COLOR_NAME;

                    //FRD ITEM CATEGORY NAME FINDER:-
                        $pro_catt1_name_bn = "N/A";
                        $pro_catt2_name_bn = "N/A";
                        $pro_catt3_name_bn = "N/A";
                        $pro_catt4_name_bn = "N/A";

                            extract(FRF_CATT_NAME($r_cat_1));
                            $pro_catt1_name_bn = $FRc_CATT_NAME;

                            if ($r_cat_2 > 0) {
                                extract(FRF_CATT_NAME($r_cat_2));
                                $pro_catt2_name_bn = $FRc_CATT_NAME;
                            }
                            if ($r_cat_3 > 0) {
                                extract(FRF_CATT_NAME($r_cat_3));
                                $pro_catt3_name_bn = $FRc_CATT_NAME;
                            }
                            if ($r_cat_4 > 0) {
                                extract(FRF_CATT_NAME($r_cat_4));
                                $pro_catt4_name_bn = $FRc_CATT_NAME;
                            }
                        //END>> 

                   echo "
                   {
                    item_id: '$fr_pro_id',
                    item_name: '$fr_pro_title',
                    affiliation: '$fr_cname',
                    coupon: 'N/A',
                    currency: 'BDT',
                    discount: 'N/A',
                    index: 0,
                    item_brand: '$pro_r_brand_name',
                    item_category: '$pro_catt1_name_bn',
                    item_category2: '$pro_catt2_name_bn',
                    item_category3: '$pro_catt3_name_bn',
                    item_category4: '$pro_catt4_name_bn',
                    item_list_id: 'N/A',
                    item_list_name: 'N/A',
                    item_variant: '$FRsd_ProColorName $fr_size_name',
                    location_id: 'N/A',
                    price: $fr_t_price,
                    quantity: $fr_qty
                  }$FRc_Coma
                   ";

                 $FRc_SL = ($FRc_SL + 1);
               }
               
            }
        ?>

        ]
    }
    });

}); 
</script>
<?php } ?>


<?php require_once("frd-public/theme/frd-footer.php"); ob_end_flush();  ?>

<!-- THIS SCRIPT MUST HAVE  UNDER FOOTER -->
<script>
      $(document).ready(function(){
        //FRD CART HEID:-
        FRfun_CartHeid();
      });
</script>