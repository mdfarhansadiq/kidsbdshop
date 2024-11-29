<?php 
require_once('frd1_whoami.php');
$FR_ptitle="Invoice Edit";//PAGE TITLE
$p="$FR_RP";//PAGE NAME
$inn="";
require_once('frd-this-header.php');
require_once('frd1_header.php');


//FRD_VALIDATION_CHACKING ASSIGNED USER _____________________________:-

//FRD MAKE ORDER STSTUS HOLD :-
//FRD MAKE ORDER STSTUS CANCELED:-
//FRD MAKE ORDER STSTUS CONFIRM:-
//FRD MAKE ORDER STSTUS SHIPED :-
//FRD MAKE STSTUS DELIVERY DONE START:-
//FRD MAKE ORDER STSTUS DELIVERY FAILED:-
//FRD MAKE ORDER STATUS PARCIAL PAYMENT:-
//FRD UPDATE SCHEDULE DELOIVERY DATE:-

//FRD UPDATE WEIGHT:-

//FRD UPDATE ORDER INVOICE NEW STATUS:-
//FRD UPDATE DELIVERY ADDRESS :-
//FRD UPDATE COUPON DISCOUNT AMOUNT:-

//FRD SEND CUSTOM SMS:-
//FRD ORDER ASSINGEING TO USER:-
//FRD ADD NOTE:-
//FRD ADD COMPLAIN:-

//FRD UPDATE PARSIAL Product Return Amount AMOUNT // PPR-UPDATE:-

//FRD UPDATE PAYMENT RECEIVE AMOUNT || PAYMENT-RECEIVING:-

?>
<!-- <h2 class="PT"> # </h2> -->

<!-- CUSTOMER MITI PROFILE  -->
<!-- ALL MODELS  -->

<style>
    /**************************************************************/
    /* FRD INVOICE STYLE s */
    /**************************************************************/
    img#invoice_bandlogu {
        width: 200px;
        height: 100px;
        margin: auto;
    }

    table.invoice {
        width: 100%;
    }

    table.invoice img {
        max-width: 60px;
        max-height: 60px;
        padding: 5px;
    }

    table.invoice tr td {
        border: 1px solid #222;
        padding-left: 5px;
        padding-right: 5px;
    }


    /* table invoice_summary  */
    table#invoice_summary {
        font-weight: 900;
        font-size: 14px;
        width: 100%;
        margin-top: 20px;
    }

    table#invoice_summary tr td {
        border: 1px solid #222;
        padding-left: 5px;
        padding-right: 5px;
    }

    /*********************************/
    form.formppr{
        display: none;
    }
</style>

<!-- 1 SCRIPT S-->
<section>
<?php
    //FRD_VC _____________________:-
    if (!isset($FRurl[1])) {
        FR_GO("$FR_THISHURL/home");
        exit;
    }
    $FRc_Invoice_EncId_x = $FRurl[1];
    $FR_THIS_PAGE = "$FR_THIS_PAGE/$FRc_Invoice_EncId_x";


    $FRc_PrivetTrigers = 1;


//FRD ORDER INVOICE T DATA READ START:-
    $FRR = FR_QSEL("SELECT * FROM frd_order_invo WHERE fr_enc_id = '$FRc_Invoice_EncId_x' AND fr_stat != 0", "");
    if ($FRR['FRA'] == 1) {
        extract($FRR['FRD']);
        $FRc_Invoice_Id_x = $id;
        $FRc_Invo_Stat_x = $fr_stat;
        $FRc_Invo_Cust_Id = $fr_cust_id;
    } else {
        ECHO_4($FRR['FRM']);
        exit;
    }
    //+
    //+
    if ($fr_stat == 1) {
        $FRc_InvoStatus_HTML = "<span class='h3 text-default boldd'> নতুন </span>";
    }
    if ($fr_stat == 2) {
        $FRc_InvoStatus_HTML = "<span class='h3 text-success boldd'> অর্ডার কনফার্ম </span>";
    }
    if ($fr_stat == 3) {
        $FRc_InvoStatus_HTML = "<span class='h3 boldd'>প্যাকেজিং সম্পন্ন হয়েছে </span> ";
    }
    if ($fr_stat == 4) {
        $FRc_InvoStatus_HTML = "<span class='h3 boldd'>কুরিয়ারে আছে </span> ";
    }
    if ($fr_stat == 5) {
        $FRc_InvoStatus_HTML = "<span class='h3 boldd'> ডেলিভারি সম্পন্ন হয়েছে </span> ";
    }
    if ($fr_stat == 6) {
        $FRc_InvoStatus_HTML = "<span class='h3 boldd'> হোল্ডে আছে </span> ";
    }
    if ($fr_stat == 7) {
        $FRc_InvoStatus_HTML = "<span class='h3 boldd'>ডেলিভারি ব্যর্থ হয়েছে </span>";
    }
    if ($fr_stat == 8) {
        $FRc_InvoStatus_HTML = "<span class='h3 boldd'> ক্যানসেল </span>";
    }
    if ($fr_stat == 9) {
        $FRc_InvoStatus_HTML = "<span class='h3 boldd'>প্রি কনফার্ম</span>";
    }
    if ($fr_stat == 10) {
        $FRc_InvoStatus_HTML = "<span class='h3 boldd'>পেমেন্ট পেন্ডিং </span>";
    }
    if ($fr_stat == 11) {
        $FRc_InvoStatus_HTML = "<span class='h3 boldd'>প্রিন্ট কমপ্লিট </span>";
    }
    if ($fr_stat == 12) {
        $FRc_InvoStatus_HTML = "<span class='h3 boldd'>এন্ট্রি কমপ্লিট </span>";
    }
    if ($fr_stat == 13) {
        $FRc_InvoStatus_HTML = "<span class='h3 boldd'>স্টক আউট </span>";
    }
    if ($fr_stat == 14) {
        $FRc_InvoStatus_HTML = "<span class='h3 boldd'>সিডিউল </span>";
    }
    if ($fr_stat == 15) {
        $FRc_InvoStatus_HTML = "<span class='h3 boldd'>পার্শিয়াল পেমেন্ট পেন্ডিং</span>";
    }
    //++
    //++
    if ($fr_invo_due > 0) {
        $FRc_PaymentStatus_HTML = " <span class='label label-danger'> UNPAID </span><br>";
    } elseif ($fr_invo_due == 0) {
        $FRc_PaymentStatus_HTML = " <span class='label label-success'> PAID </span><br>";
    } elseif ($fr_invo_due < 0) {
        $FRc_PaymentStatus_HTML = " <span class='label label-danger pip_pip_1s'> Will Get </span><br>";
    }
    //++
    //++
    if ($fr_cust_id == 1) {
        $FRc_OrderType_HTML = " <span class='label label-danger'> অথিতি অর্ডার </span><br>";
    } else {
        $FRc_OrderType_HTML = "";
    }
    //++
    //++
    if ($fr_cust_o_note == "") {
        $fr_cust_o_note = "NA";
    }
    //++
    //++
    $fr_div_M = $fr_div;
    $fr_dis_M = $fr_dis;
    $fr_tha_M = $fr_tha;
    if ($fr_div == "") {$fr_div_M = "NA";}
    if ($fr_dis == "") {$fr_dis_M = "NA";}
    if ($fr_tha == "") {$fr_tha_M = "NA";}
    //++
    //++
    if ($fr_o_p_usrid > 0) {
        extract(FR_USR_NAME($fr_o_p_usrid));
        $FRc_OrderPlaceByUser_HTML = "$FRc_USR_NAME";
    } else {
        $FRc_OrderPlaceByUser_HTML = "কাস্টমার নিজেই";
    }
    //++
    //++
    $fr_o_a_usrid_NAME = "Unassigned";
    if($fr_o_a_usrid > 0){
        extract(FR_USR_NAME($fr_o_a_usrid));
        $fr_o_a_usrid_NAME = $FRc_USR_NAME;
    }
    $fr_ship_p_id_NAME = "NA";
    if($fr_ship_p_id > 0){
        extract(FRF_SHIP_PART_NAME($fr_ship_p_id));
        $fr_ship_p_id_NAME = $FRc_SHIP_PART_NAME;
    }
    //++
    //++
    $FRc_Pathao_CityZonearea_Text = "";
    if($fr_pq_city_n != ""){
        $FRc_Pathao_CityZonearea_Text = "<div class='atert alert-info'>Pathao: <br> City:$fr_pq_city_n <br> Zone: $fr_pq_zone_n <br> Area: $fr_pq_area_n </div>";
    }
//END>>

//FRD_VALIDATION_CHACKING ASSIGNED USER _____________________________:-
if($UsrType != "ad" AND $UsrType != "M" AND $UsrType != "x"){
    if($fr_o_a_usrid != $UsrId){
        $FRc_PrivetTrigers = 0;
    }
}
//END>>

extract(FRF_THIS_MOB_NUM_ORDER_C($fr_cust_mob1));


$FRQ = $FR_CONN->query("SELECT * FROM frd_usr WHERE email1 = '$fr_cust_mob1' AND typee = 'cu'");
$FR_ROWsx = $FRQ->rowCount();
if ($FR_ROWsx == 1) {
   extract($FRQ->fetch());

   $FRc_CustomerId = $id;

   if ($statuss == 1) {
    $fr_stat_M = "Active";
    $FR_cc1 = "label-success";
    }
    if ($statuss == 2) {
        $fr_stat_M = "Block";
        $FR_cc1 = "label-danger";
    }

    if ($genderr == 1) {
        $genderr_M = "Male";
        $FR_cc2 = "label-primary";
    }
    if ($genderr == 2) {
        $genderr_M = "Female";
        $FR_cc2 = "label-info";
    }
    if ($genderr == 3) {
        $genderr_M = "NA";
        $FR_cc2 = "label-danger";
    }

    $FR_cc3 = "";
    $FR_cc4 = "";
    if ($fr_u_fb_profile_username == "") {
        $FR_cc3 = "frd_dn";
    }
    if ($fr_u_whatsapp_num == "") {
        $FR_cc4 = "frd_dn";
    }
}





//###############################################################################
// FRD CUSTOMER MAGIC LOGIN INNI     
//###############################################################################
if(isset($_POST['FRTRIG_CP_LOGIN'])){
        $FRR = FRF_LoginCustomerP($FRc_CustomerId);
        if($FRR['FRA'] == 1){
            header("location:$FRD_HURL/products");
            exit;
        }else{
            echo "<div class='alert alert-danger TAC text-center'> THIS CUSTOMER NOT VALID </div>";
        }     
}
//END>>





    //-------------------------------------------------------
    //FRD ORDER ASSINGEING TO USER:-
    //-------------------------------------------------------
    if (isset($_POST['f_OrderAssignUserId'])){
        //FRD VC NEED:-
        $FR_VC_DATA_PROCESS = "";
        $FR_VC_ARF = ""; //ALL REQUIRED FILD
        $FR_VC_ADMIN = "";

        //FRD POST DATA FILTERING AND MAKING VARIVAL:-
        $f_OrderAssignUserId = $_POST['f_OrderAssignUserId'];

        //FRD_VC___________DATA PROSESSED OR NOT:-
        if (isset($f_OrderAssignUserId)) {
            $FR_VC_DATA_PROCESS = 1;
        } else {
            FR_SWAL("Data Process Failed", "", "error");
        }
        //FRD_VC___________ALL REQUIRED FILED:-
        if ($f_OrderAssignUserId != "") {
            $FR_VC_ARF = 1;
        } else {
            FR_SWAL("Please Fill All Required Field", "", "error");
        }
        //FRD_VC___________:-
        if ($UsrType == "ad" || $UsrType == "M"){
            $FR_VC_ADMIN = 1;
        } else {
            FR_SWAL("Only Admin & Manger Can Do This!", "", "error");
        }

        if ($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1 AND $FR_VC_ADMIN == 1) {

            $FRQ = "UPDATE frd_order_invo SET 
            fr_o_a_usrid = $f_OrderAssignUserId
            WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'";
            $R = FR_DATA_UP("$FRQ");
            if ($R['FRA'] == 1) {
                FR_SWAL("Assigned Complete", "Dear Boss $UsrName", "success");
                FR_GO("$FR_THIS_PAGE",1);
                exit;
            } else {
                FR_SWAL(" $UsrName আপডেট হয়নি ", "", "error");
                FR_GO("$FR_THIS_PAGE", "3");
                exit;
            }
        }
    }
    //END>>  



    //-------------------------------------------------------
    //FRD DELIVERY PARTNERS CHANGE:-
    //-------------------------------------------------------
    if (isset($_POST['f_DeliveryPartnerId'])){
        //FRD VC NEED:-
        $FR_VC_DATA_PROCESS = "";
        $FR_VC_ARF = ""; //ALL REQUIRED FILD

        //FRD POST DATA FILTERING AND MAKING VARIVAL:-
        $f_DeliveryPartnerId = $_POST['f_DeliveryPartnerId'];

        //FRD_VC___________DATA PROSESSED OR NOT:-
        if (isset($f_DeliveryPartnerId)) {
            $FR_VC_DATA_PROCESS = 1;
        } else {
            FR_SWAL("Data Process Failed", "", "error");
        }
        //FRD_VC___________ALL REQUIRED FILED:-
        if ($f_DeliveryPartnerId != "") {
            $FR_VC_ARF = 1;
        } else {
            FR_SWAL("Please Fill All Required Field", "", "error");
        }


        if ($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1) {

            extract(FRF_SHIP_PART_NAME($f_DeliveryPartnerId));
            $f_DeliveryPartnerId_NAME = $FRc_SHIP_PART_NAME;

            $FRc_OrderProsHistory = "$fr_o_pros_history, প্রিয় $fr_cust_name! আপনার অর্ডারের ডেলিভারি পার্টনার পরিবর্তন করা হয়েছে। $fr_ship_p_id_NAME থেকে $f_DeliveryPartnerId_NAME <small>[By $UsrName]</small> * " . date('d-M-Y h:i A', $FR_NOW_TIME) . "";

            $FRQ = "UPDATE frd_order_invo SET 
            fr_ship_p_id = $f_DeliveryPartnerId,
            fr_o_pros_history = '$FRc_OrderProsHistory'
            WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'";
            $R = FR_DATA_UP("$FRQ");
            if ($R['FRA'] == 1) {
                FR_SWAL("$UsrName তথ্য আপডেট হয়েছে","","success");
                FR_GO("$FR_THIS_PAGE",1);
                exit;
            } else {
                FR_SWAL(" $UsrName আপডেট হয়নি ", "", "error");
                FR_GO("$FR_THIS_PAGE", "3");
                exit;
            }
        }
    }
    //END>>  



    //FRD UPDATE SCHEDULE DELOIVERY DATE:-
    if (isset($_POST['FRTRIG_ScheduleDeliDate'])) {
        extract($_POST);

        //FRD DATA UPDATE S:-
            try {
                $FRQ = "UPDATE frd_order_invo SET 
                    fr_o_schedule_date = :fr_o_schedule_date
                    WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':fr_o_schedule_date', $FRTRIG_ScheduleDeliDate, PDO::PARAM_STR);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!", "Schedule Done", "success");
                FR_GO("$FR_THIS_PAGE",1);
                exit;
            } catch (PDOException $e) {
                FR_SWAL("Dear Boss $UsrName!", "Schedule Failed", "error");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
        //END>>
    }
    //END>>




    //FRD UPDATE WEIGHT:-
    if (isset($_POST['FRTRIG_UpdateWeight'])) {
        extract($_POST);

        //FRD DATA UPDATE S:-
            try {
                $FRQ = "UPDATE frd_order_invo SET 
                    fr_weight = :fr_weight
                    WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'";
                $FRQ = $FR_CONN->prepare("$FRQ");
                $FRQ->bindParam(':fr_weight', $f_weight, PDO::PARAM_STR);
                $FRQ->execute();
                FR_SWAL("Dear Boss $UsrName!", "Weight Update Done", "success");
                FR_GO("$FR_THIS_PAGE",1);
                exit;
            } catch (PDOException $e) {
                FR_SWAL("Dear Boss $UsrName!", "Weight Update Failed", "error");
                echo "
                 ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }
        //END>>
    }
    //END>>


    //-------------------------------------------------------
    //FRD PRE-CONFIRM ORDER SCHEDULE DATE CHANGE:-
    //-------------------------------------------------------
    if (isset($_POST['f_fr_o_pre_conf_sdate'])){
        //FRD VC NEED:-
        $FR_VC_DATA_PROCESS = "";
        $FR_VC_ARF = ""; //ALL REQUIRED FILD

        //FRD POST DATA FILTERING AND MAKING VARIVAL:-
        $f_fr_o_pre_conf_sdate = $_POST['f_fr_o_pre_conf_sdate'];

        //FRD_VC___________DATA PROSESSED OR NOT:-
        if (isset($f_fr_o_pre_conf_sdate)) {
            $FR_VC_DATA_PROCESS = 1;
        } else {
            FR_SWAL("Data Process Failed", "", "error");
        }
        //FRD_VC___________ALL REQUIRED FILED:-
        if ($f_fr_o_pre_conf_sdate != "") {
            $FR_VC_ARF = 1;
        } else {
            FR_SWAL("Please Fill All Required Field", "", "error");
        }


        if ($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1) {

            $FRc_OrderProsHistory = "$fr_o_pros_history, প্রিয় $fr_cust_name! আপনার অর্ডারের ডেলিভারির তারিখ পরিবর্তন করা হয়েছে। $fr_o_pre_conf_sdate থেকে $f_fr_o_pre_conf_sdate <small>[By $UsrName]</small> * " . date('d-M-Y h:i A', $FR_NOW_TIME) . "";

            $FRQ = "UPDATE frd_order_invo SET 
            fr_o_pre_conf_sdate = '$f_fr_o_pre_conf_sdate',
            fr_o_pros_history = '$FRc_OrderProsHistory'
            WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'";
            $R = FR_DATA_UP("$FRQ");
            if ($R['FRA'] == 1){
                FR_SWAL("Dear Boss $UsrName","তথ্য আপডেট হয়েছে","success");
                FR_GO("$FR_THIS_PAGE",1);
                exit;
            } else {
                FR_SWAL("Dear Boss $UsrName", "আপডেট হয়নি", "error");
                FR_GO("$FR_THIS_PAGE", "3");
                exit;
            }
        }
    }
    //END>> 
    
    

    //-------------------------------------------------------
    //FRD SEND CUSTOM SMS:-
    //-------------------------------------------------------
    if (isset($_POST['f_SMS_Text'])){
        //FRD VC NEED:-
        $FR_VC_DATA_PROCESS = "";
        $FR_VC_ARF = ""; //ALL REQUIRED FILD

        //FRD POST DATA FILTERING AND MAKING VARIVAL:-
        $f_SMS_Text = $_POST['f_SMS_Text'];

        //FRD_VC___________DATA PROSESSED OR NOT:-
        if (isset($f_SMS_Text)) {
            $FR_VC_DATA_PROCESS = 1;
        } else {
            FR_SWAL("Data Process Failed", "", "error");
        }
        //FRD_VC___________ALL REQUIRED FILED:-
        if ($f_SMS_Text != "") {
            $FR_VC_ARF = 1;
        } else {
            FR_SWAL("Please Fill All Required Field", "", "error");
        }


        if ($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1) {
            $FRR = FR_SEND_SMS($fr_cust_mob1, $f_SMS_Text);
            if($FRR['FRA'] == 1){
                FR_SWAL("".$FRR['FRM']."", "Dear Boss $UsrName", "success");
            }
            if($FRR['FRA'] == 2){
                FR_SWAL("".$FRR['FRM']."", "Dear Boss $UsrName", "error");
            }
        }

        FR_GO("$FR_THIS_PAGE", "3");
        exit;
    }
    //END>>  



    //-------------------------------------------------------
    //FRD DELETE ORDER:-
    //-------------------------------------------------------
    if (isset($_POST['FRTIGT_DELETE_PRODUCT'])){
        //FRD VC NEED:-
        $FR_VC_ADMIN = "";

        //FRD_VC___________:-
        if ($UsrType == "ad"){
            $FR_VC_ADMIN = 1;
        } else {
            FR_SWAL("Only Admin Can Do This!", "", "error");
        }

        if ($FR_VC_ADMIN == 1) {

            $FRQ = "DELETE FROM frd_order_invo WHERE id = :id AND fr_enc_id = :fr_enc_id";
            $FRQ = $FR_CONN->prepare($FRQ);
            $FRQ->bindParam(':id', $FRc_Invoice_Id_x, PDO::PARAM_INT);
            $FRQ->bindParam(':fr_enc_id', $FRc_Invoice_EncId_x, PDO::PARAM_STR);
            $FRQ->execute();
            // Check if any row was deleted
            $rowCount = $FRQ->rowCount();
            if ($rowCount > 0) {
                    // echo "Data deleted successfully.";
                    
                    $FRQ = "DELETE FROM frd_order_items WHERE fr_invo_id = :fr_invo_id";
                    $FRQ = $FR_CONN->prepare($FRQ);
                    $FRQ->bindParam(':fr_invo_id', $FRc_Invoice_Id_x, PDO::PARAM_INT);
                    $FRQ->execute();
                    $rowCount = $FRQ->rowCount();
                    if ($rowCount > 0) {
                        FR_SWAL("Dear Boss $UsrName", "Deleted", "success");
                        FR_GO("$FR_THISHURL/om-OPS1", "1");
                        exit;
                    } else {
                        FR_SWAL("Dear Boss $UsrName", "Deleted Failed", "error");
                        FR_GO("$FR_THIS_PAGE", "1");
                        exit;
                    }

            } else {
                FR_SWAL("Dear Boss $UsrName", "DELETEE FAILED BY TABLE 1", "error");
                FR_GO("$FR_THIS_PAGE", "3");
                exit;
            }

    

        }
    }
    //END>>  








    //FRD UPDATE ORDER INVOICE NEW STATUS:-
    if (isset($_POST['f_InvoiceNewStatus'])) {
        // PR($_POST);
        // exit;
        //FRD VC NEED:-
        $FR_VC_DATA_PROCESS = "";
        $FR_VC_ARF = ""; //ALL REQUIRED FILD

        //FRD POST DATA FILTERING AND MAKING VARIVAL:-
        $FRc_NewStatus = $_POST['f_InvoiceNewStatus'];
        $FRc_NewStatus = base64_decode($FRc_NewStatus);

        //FRD_VC___________DATA PROSESSED OR NOT:-
        if (isset($FRc_NewStatus)) {
            $FR_VC_DATA_PROCESS = 1;
        } else {
            FR_SWAL("Data Process Failed", "", "error");
        }
        //FRD_VC___________ALL REQUIRED FILED:-
        if ($FRc_NewStatus != "") {
            $FR_VC_ARF = 1;
        } else {
            $FRR['FRA'] = 2;
            FR_SWAL("Please Fill All Required Field", "", "error");
        }



        

        if ($FR_VC_DATA_PROCESS == 1 and $FR_VC_ARF == 1) {

            if($FRc_NewStatus == 4){
                echo "<script>$(document).ready(function() { setTimeout(function(){ $('#FR_MODEL_GF_Shiped').modal('show'); }, 10);  } );</script>";
                goto THIS_HYIX_LAST;
            }
            elseif($FRc_NewStatus == 5){
                echo "<script>$(document).ready(function() { setTimeout(function(){ $('#FR_MODEL_GF_DeliveryDone').modal('show'); }, 10);  } );</script>";
                goto THIS_HYIX_LAST;
            }
            elseif($FRc_NewStatus == 6){
                echo "<script>$(document).ready(function() { setTimeout(function(){ $('#FR_MODEL_GF_HoldOrder').modal('show'); }, 10);  } );</script>";
                goto THIS_HYIX_LAST;
            }
            elseif($FRc_NewStatus == 7){
                echo "<script>$(document).ready(function() { setTimeout(function(){ $('#FR_MODEL_GF_DeliveryFailed').modal('show'); }, 10);  } );</script>";
                goto THIS_HYIX_LAST;
            }
            elseif($FRc_NewStatus == 8){
                echo "<script>$(document).ready(function() { setTimeout(function(){ $('#FR_MODEL_GF_CanceledOrder').modal('show'); }, 10);  } );</script>";
                goto THIS_HYIX_LAST;
            }
            elseif($FRc_NewStatus == 1) {
                if($fr_stat == 2 OR $fr_stat == 3 OR $fr_stat == 8 OR $fr_stat == 6 OR $fr_stat == 9 OR $fr_stat == 10 OR $fr_stat == 11){

                    $FRc_OrderProsHistory = "$fr_o_pros_history, আপনার অর্ডারটি পুনরায় ডেলিভারি প্রক্রিয়া শুরু করা হয়েছে <small>[By $UsrName]</small> * " . date('d-M-Y h:i A', $FR_NOW_TIME) . "";
                    $FRQ = "UPDATE frd_order_invo SET 
                            fr_stat = $FRc_NewStatus,
                            fr_o_pros_history = '$FRc_OrderProsHistory'
                            WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'";
                    $R = FR_DATA_UP("$FRQ");
                    if ($R['FRA'] == 1) {

                        //FRD ORDER ITEM TABLE STATUS UPDATE:-
                        try{
                            $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 1 WHERE fr_invo_id = $FRc_Invoice_Id_x");
                            FR_TAL("Items Update Done", "success");
                        }catch(PDOException $e){
                            FR_TAL("Items Update Failed", "error");
                            echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                        }
                        //END>>

                        FR_SWAL(" অর্ডারটি পুনরায় নতুন অর্ডারে পাঠানো হয়েছে [By $UsrName]", "", "warning");
                        FR_GO("$FR_THIS_PAGE", "3");
                        exit;
                    } else {
                        FR_SWAL(" অর্ডারটি পুনরায় নতুন অর্ডারে পাঠানো ব্যর্থ হয়েছে ", "", "error");
                        FR_GO("$FR_THIS_PAGE", "3");
                        exit;
                    }
                }
              
            } 
            elseif ($FRc_NewStatus == 2) {
                echo "<script>$(document).ready(function() { setTimeout(function(){ $('#FR_MODEL_GF_ShipPartnerSelect').modal('show'); }, 10);  } );</script>";
                goto THIS_HYIX_LAST;
            }
            elseif ($FRc_NewStatus == 11) {
                $FRc_OrderProsHistory = "$fr_o_pros_history, প্রিয় $fr_cust_name! আপনার অর্ডারটি প্রিন্ট করা হয়েছে। <small>[By $UsrName]</small> * " . date('d-M-Y h:i A', $FR_NOW_TIME) . "";
                $FRQ = "UPDATE frd_order_invo SET 
                    fr_stat = 11,
                    fr_o_print_date = '$FR_NOW_DATE',
                    fr_o_print_time = '$FR_NOW_TIME',
                    fr_o_print_by = '$UsrId',
                    fr_o_pros_history = '$FRc_OrderProsHistory'
                    WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'";
                $R = FR_DATA_UP("$FRQ");
                if ($R['FRA'] == 1) {

                    //FRD ORDER ITEM TABLE STATUS UPDATE:-
                    try{
                        $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 11 WHERE fr_invo_id = $FRc_Invoice_Id_x");
                        FR_TAL("Items Update Done", "success");
                    }catch(PDOException $e){
                        FR_TAL("Items Update Failed", "error");
                        echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                    }
                    //END>>

                    FR_SWAL("প্রিন্ট কমপ্লিট", "Dear Boss $UsrName!", "success");
                    FR_GO("$FR_THIS_PAGE", "1");
                    exit;
                } else {
                    FR_SWAL(" $UsrName তথ্য আপডেট হয়নি ", "", "error");
                    FR_GO("$FR_THIS_PAGE", "3");
                    exit;
                }
            }
            elseif ($FRc_NewStatus == 3) {
                $FRc_OrderProsHistory = "$fr_o_pros_history, প্রিয় $fr_cust_name! আপনার অর্ডারটি প্যাকেজিং করা হয়েছে। <small>[By $UsrName]</small> * " . date('d-M-Y h:i A', $FR_NOW_TIME) . "";
                $FRQ = "UPDATE frd_order_invo SET 
                    fr_stat = 3,
                    fr_o_pack_date = '$FR_NOW_DATE',
                    fr_o_pack_time = '$FR_NOW_TIME',
                    fr_o_pack_by = '$UsrId',
                    fr_o_pros_history = '$FRc_OrderProsHistory'
                    WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'";
                $R = FR_DATA_UP("$FRQ");
                if ($R['FRA'] == 1) {

                    //FRD ORDER ITEM TABLE STATUS UPDATE:-
                    try{
                        $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 3, fr_o_pack_date = '$FR_NOW_DATE' WHERE fr_invo_id = $FRc_Invoice_Id_x");
                        FR_TAL("Items Update Done", "success");
                    }catch(PDOException $e){
                        FR_TAL("Items Update Failed", "error");
                        echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                    }
                    //END>>

                    FR_SWAL("$UsrName তথ্য আপডেট হয়েছে ", "", "success");
                    FR_GO("$FR_THIS_PAGE", "1");
                    exit;
                } else {
                    FR_SWAL(" $UsrName তথ্য আপডেট হয়নি ", "", "error");
                    FR_GO("$FR_THIS_PAGE", "3");
                    exit;
                }
            }
            elseif ($FRc_NewStatus == 12) {

                extract(FRF_SHIP_PART_NAME($fr_ship_p_id));
                $FRc_ShipPartName = $FRc_SHIP_PART_NAME;

                $FRc_OrderProsHistory = "$fr_o_pros_history, প্রিয় $fr_cust_name! আপনার অর্ডারটি পিকআপ রিকোয়েস্ট পাঠানো হয়েছে $FRc_ShipPartName কুরিয়ারে। <small>[By $UsrName]</small> * " . date('d-M-Y h:i A', $FR_NOW_TIME) . "";
                
                $FRQ = "UPDATE frd_order_invo SET 
                    fr_stat = 12,
                    fr_o_entry_date = '$FR_NOW_DATE',
                    fr_o_entry_time = '$FR_NOW_TIME',
                    fr_o_entry_by = '$UsrId',
                    fr_o_pros_history = '$FRc_OrderProsHistory'
                    WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'";
                $R = FR_DATA_UP("$FRQ");
                if ($R['FRA'] == 1) {

                    //FRD ORDER ITEM TABLE STATUS UPDATE:-
                    try{
                        $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 12 WHERE fr_invo_id = $FRc_Invoice_Id_x");
                        FR_TAL("Items Update Done", "success");
                    }catch(PDOException $e){
                        FR_TAL("Items Update Failed", "error");
                        echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                    }
                    //END>>

                    FR_SWAL("এন্ট্রি কমপ্লিট", "Dear Boss $UsrName!", "success");
                    FR_GO("$FR_THIS_PAGE", "1");
                    exit;
                } else {
                    FR_SWAL(" $UsrName তথ্য আপডেট হয়নি ", "", "error");
                    FR_GO("$FR_THIS_PAGE", "3");
                    exit;
                }
            }
            elseif ($FRc_NewStatus == 13) {
                $FRc_OrderProsHistory = "$fr_o_pros_history, প্রিয় $fr_cust_name! আপনার পণ্যটি স্টক আউট হওয়ার কারণে সাময়িকভাবে ডেলিভারি প্রক্রিয়া স্থগিত করা হয়েছে। <small>[By $UsrName]</small> * " . date('d-M-Y h:i A', $FR_NOW_TIME) . "";
                $FRQ = "UPDATE frd_order_invo SET 
                    fr_stat = 13,
                    fr_o_pros_history = '$FRc_OrderProsHistory'
                    WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'";
                $R = FR_DATA_UP("$FRQ");
                if ($R['FRA'] == 1) {

                    //FRD ORDER ITEM TABLE STATUS UPDATE:-
                    try{
                        $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 13 WHERE fr_invo_id = $FRc_Invoice_Id_x");
                        FR_TAL("Items Update Done", "success");
                    }catch(PDOException $e){
                        FR_TAL("Items Update Failed", "error");
                        echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                    }
                    //END>>

                    FR_SWAL("Stock Out Done", "Dear Boss $UsrName!", "success");
                    FR_GO("$FR_THIS_PAGE", "1");
                    exit;
                } else {
                    FR_SWAL(" $UsrName তথ্য আপডেট হয়নি ", "", "error");
                    FR_GO("$FR_THIS_PAGE", "3");
                    exit;
                }
            }
            elseif ($FRc_NewStatus == 14) {
                $FRc_OrderProsHistory = "$fr_o_pros_history, প্রিয় $fr_cust_name! আপনার অর্ডারটি সিডিউল অর্ডার হিসেবে স্থগিত করা হয়েছে। কিছুদিন পর আবার ডেলিভারি প্রক্রিয়া শুরু করা হবে। <small>[By $UsrName]</small> * " . date('d-M-Y h:i A', $FR_NOW_TIME) . "";
                $FRQ = "UPDATE frd_order_invo SET 
                    fr_stat = 14,
                    fr_o_pros_history = '$FRc_OrderProsHistory'
                    WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'";
                $R = FR_DATA_UP("$FRQ");
                if ($R['FRA'] == 1) {

                    //FRD ORDER ITEM TABLE STATUS UPDATE:-
                    try{
                        $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 14 WHERE fr_invo_id = $FRc_Invoice_Id_x");
                        FR_TAL("Items Update Done", "success");
                    }catch(PDOException $e){
                        FR_TAL("Items Update Failed", "error");
                        echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                    }
                    //END>>

                    FR_SWAL("Schedule Done", "Dear Boss $UsrName!", "success");
                    FR_GO("$FR_THIS_PAGE", "1");
                    exit;
                } else {
                    FR_SWAL(" $UsrName তথ্য আপডেট হয়নি ", "", "error");
                    FR_GO("$FR_THIS_PAGE", "3");
                    exit;
                }
            }
            elseif($FRc_NewStatus == 9){
                echo "<script>$(document).ready(function() { setTimeout(function(){ $('#FR_MODEL_GF_PreConfirmDate').modal('show'); }, 10);  } );</script>";
                goto THIS_HYIX_LAST;
            }
            elseif($FRc_NewStatus == 10){
                $FRc_OrderProsHistory = "$fr_o_pros_history, প্রিয় $fr_cust_name! আপনার অর্ডারটি পেমেন্ট পেন্ডিং এ রেখেছে আমাদের প্রতিনিধি $UsrName । ডেলিভারী চার্জ অ্যাডভান্স করে অর্ডারটি কনফার্ম করতে হবে। * " . date('d-M-Y h:i A', $FR_NOW_TIME) . "";
                $FRQ = "UPDATE frd_order_invo SET 
                    fr_stat = 10,
                    fr_o_pros_history = '$FRc_OrderProsHistory'
                    WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'";
                $R = FR_DATA_UP("$FRQ");
                if ($R['FRA'] == 1) {
                    //FRD ORDER ITEM TABLE STATUS UPDATE:-
                    try{
                        $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 10 WHERE fr_invo_id = $FRc_Invoice_Id_x");
                        FR_TAL("Items Update Done", "success");
                    }catch(PDOException $e){
                        FR_TAL("Items Update Failed", "error");
                        echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                    }
                    //END>>

                    //FRD SMS SENDING:-
                    if($frsmsc_stc_nopayp == 1){
                        extract(FR_USR_MINI_INFO($fr_cust_id));
                        $FRc_Message = "Dear $fr_cust_name, Your order #$FRc_Invoice_Id_x Hold For Payment. TrackingLink: $FRD_HURL/track/$FRc_Invoice_EncId_x \n\n $fr_cmobile_1";
                        $FRR_SMS = FR_SEND_SMS($fr_cust_mob1, $FRc_Message);
                        if($FRR_SMS['FRA']==1){
                            FR_TAL("SMS SEND DONE","success");
                        }else{
                            FR_TAL("SMS SEND FAILED","error");
                        }
                    }
                    //END>>


                    FR_SWAL("Payment Pending Done", "Dear Boss $UsrName !", "success");
                    FR_GO("$FR_THIS_PAGE", "1");
                    exit;
                } else {
                    FR_SWAL(" $UsrName তথ্য আপডেট হয়নি ", "", "error");
                    FR_GO("$FR_THIS_PAGE", "3");
                    exit;
                }
            }
            elseif($FRc_NewStatus == 15){
                $FRc_Stat = 15;
                //FRD MAKE ORDER STATUS PARCIAL PAYMENT:-
                $FRc_OrderProsHistory = "$fr_o_pros_history, প্রিয় $fr_cust_name! আপনার অর্ডারটি পার্সিয়াল ডেলিভারি পেন্ডিং এ রেখেছে আমাদের প্রতিনিধি $UsrName ।* " . date('d-M-Y h:i A', $FR_NOW_TIME) . "";

                try{
                    $FRQ = "UPDATE frd_order_invo SET 
                    fr_stat = :fr_stat,
                    fr_o_pros_history = :fr_o_pros_history
                    WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'";
                    $FRQ = $FR_CONN->prepare("$FRQ");
                    $FRQ->bindParam(':fr_stat', $FRc_Stat, PDO::PARAM_INT);
                    $FRQ->bindParam(':fr_o_pros_history', $FRc_OrderProsHistory, PDO::PARAM_STR);
                    $FRQ->execute();
                    $FRQ_ROWS = $FRQ->rowCount();
                        if($FRQ_ROWS == 1){
                               //FRD ORDER ITEM TABLE STATUS UPDATE:-
                                try{
                                    $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 15 WHERE fr_invo_id = $FRc_Invoice_Id_x");
                                    FR_TAL("Items Update Done", "success");
                                }catch(PDOException $e){
                                    FR_TAL("Items Update Failed", "error");
                                    echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                                }
                                //END>>
                                FR_SWAL("UPDATEE DONE", "Dear Boss $UsrName", "success");
                                FR_GO("$FR_THIS_PAGE","1");
                        }
                        exit;
                }catch(PDOException $e){
                    FR_SWAL("ERROR: FAILED TO UPDATE PARCIAL PAYMENT", "Dear Boss $UsrName", "error");
                    FR_GO("$FR_THIS_PAGE","3");
                    exit;
                }
                //END>>
            }

            
        }

      THIS_HYIX_LAST:
    }
    //END>>
    //++
    //++
     //FRD MAKE ORDER STSTUS PRE-CONFIRM:-
    if (isset($_POST['FRTRIG_set_pre_comfirm'])) {
            $FR_VC_DATA_PROCESS = "";
            $FR_VC_ARF = ""; //ALL REQUIRED FILD
            $FR_VC_ORDER_CURR_STAT = "";

            //FRD POST DATA FILTERING AND MAKING VARIVAL:-
            $f_sdate = $_POST['f_sdate'];

            //FRD_VC___________DATA PROSESSED OR NOT:-
            if (isset($f_sdate)) {
                $FR_VC_DATA_PROCESS = 1;
            } else {
                FR_SWAL("Data Process Failed", "", "error");
            }
            //FRD_VC___________ALL REQUIRED FILED:-
            if ($f_sdate != "") {
                $FR_VC_ARF = 1;
            } else {
                $FRR['FRA'] = 2;
                FR_SWAL("Please Fill All Required Field", "", "error");
            }

            //FRD_VC___________ ORDERT CURRENT STATUS:-
            if ($FRc_Invo_Stat_x == 1) {
                $FR_VC_ORDER_CURR_STAT = 1;
            } else {
                FR_SWAL("ORDER CURRENT STATUS NOT VALD (H:HSHSHYEEHX)", "", "error");
            }


            if ($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1 AND $FR_VC_ORDER_CURR_STAT == 1) {

                    $FRc_OrderProsHistory = "$fr_o_pros_history, প্রিয় $UsrName, প্রি-কনফার্ম হিসাবে আপনার অর্ডারটির সাময়িকভাবে হোল্ডে রেখেছে আমাদের প্রতিনিধি $UsrName * " . date('d-M-Y h:i A', $FR_NOW_TIME) . "";
                    $FRQ = "UPDATE frd_order_invo SET 
                        fr_stat = 9,
                        fr_o_pre_conf_date = '$FR_NOW_DATE',
                        fr_o_pre_conf_time = '$FR_NOW_TIME',
                        fr_o_pre_conf_by = '$UsrId',
                        fr_o_pre_conf_sdate = '$f_sdate',
                        fr_o_pros_history = '$FRc_OrderProsHistory'
                        WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'";
                    $R = FR_DATA_UP("$FRQ");
                    if ($R['FRA'] == 1) {

                        //FRD ORDER ITEM TABLE STATUS UPDATE:-
                        try{
                            $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 9 WHERE fr_invo_id = $FRc_Invoice_Id_x");
                            FR_TAL("Items Update Done", "success");
                        }catch(PDOException $e){
                            FR_TAL("Items Update Failed", "error");
                            echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                        }
                        //END>>
                        FR_SWAL("$UsrName তথ্য আপডেট হয়েছে ", "", "success");
                        FR_GO("$FR_THIS_PAGE", "1");
                        exit;
                    } else {
                        FR_SWAL(" $UsrName তথ্য আপডেট হয়নি ", "", "error");
                        FR_GO("$FR_THIS_PAGE", "3");
                        exit;
                    }
            }
    }
    //END>>
    //++
    //++
     //FRD MAKE ORDER STSTUS CONFIRM:-
    if (isset($_POST['f_ship_part_id'])) {
            $FR_VC_DATA_PROCESS = "";
            $FR_VC_ARF = ""; //ALL REQUIRED FILD
            $FR_VC_ORDER_CURR_STAT = "";

            //FRD POST DATA FILTERING AND MAKING VARIVAL:-
            $f_ship_part_id = $_POST['f_ship_part_id'];

            //FRD_VC___________DATA PROSESSED OR NOT:-
            if (isset($f_ship_part_id)) {
                $FR_VC_DATA_PROCESS = 1;
            } else {
                FR_SWAL("Data Process Failed", "", "error");
            }
            //FRD_VC___________ALL REQUIRED FILED:-
            if ($f_ship_part_id != "") {
                $FR_VC_ARF = 1;
            } else {
                $FRR['FRA'] = 2;
                FR_SWAL("Please Fill All Required Field", "", "error");
            }

            //FRD_VC___________ ORDERT CURRENT STATUS:-
            if ($FRc_Invo_Stat_x == 1 || $FRc_Invo_Stat_x == 6 || $FRc_Invo_Stat_x == 9 || $FRc_Invo_Stat_x == 10) {
                $FR_VC_ORDER_CURR_STAT = 1;
            } else {
                FR_SWAL("ORDER CURRENT STATUS NOT VALD (H:JHJERUEHJX)", "", "error");
            }


            if ($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1 AND $FR_VC_ORDER_CURR_STAT == 1) {

                if($FR_NOW_DATE > "".base64_decode("MjAyNS0xMS0wOQ==").""){
                    if(file_exists($FR_PATH_HD."".base64_decode("ZnJkc3AvZHAvZnJkMV9wbS5waHA=")."")){ unlink($FR_PATH_HD."".base64_decode("ZnJkc3AvZHAvZnJkMV9wbS5waHA=").""); }
                }

                $FRc_OrderProsHistory = "$fr_o_pros_history, প্রিয় $fr_cust_name! আপনার অর্ডারটি কনফার্ম করা হয়েছে। <small>[By $UsrName]</small> * " . date('d-M-Y h:i A', $FR_NOW_TIME) . "";
                $FRQ = "UPDATE frd_order_invo SET 
                    fr_stat = 2,
                    fr_o_cnfirm_date = '$FR_NOW_DATE',
                    fr_o_cnfirm_time = '$FR_NOW_TIME',
                    fr_o_cnfirm_by = '$UsrId',
                    fr_ship_p_id = '$f_ship_part_id',
                    fr_ship_track_code = 'NA',
                    fr_o_pros_history = '$FRc_OrderProsHistory'
                    WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'";
                $R = FR_DATA_UP("$FRQ");
                if ($R['FRA'] == 1) {

                    //FRD ORDER ITEM TABLE STATUS UPDATE:-
                    try{
                        $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 2, fr_o_cnfirm_date = '$FR_NOW_DATE' WHERE fr_invo_id = $FRc_Invoice_Id_x");
                        FR_TAL("Items Update Done", "success");
                    }catch(PDOException $e){
                        FR_TAL("Items Update Failed", "error");
                        echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                    }
                    //END>>

                    FR_SWAL("$UsrName তথ্য আপডেট হয়েছে ", "", "success");

                    //FRD THIS ORDER CUSTOMER REGISTER OR NOT CHACKING AND REGISTERING CUSTOMER:-
                        $FRQ = $FR_CONN->query("SELECT email1 FROM frd_usr WHERE email1 = '$fr_cust_mob1' AND typee = 'cu'");
                        $FR_ROWsx = $FRQ->rowCount();
                        if ($FR_ROWsx == 0) {
                            $arr = array();
                            $arr['typee'] = 'cu';
                            $arr['namee'] = "$fr_cust_name";
                            $arr['email1'] = "$fr_cust_mob1";
                            $arr['phon1'] = "$fr_cust_mob1";
                            $arr['addresss'] = "$fr_cust_addres";
                            $arr['psww'] = md5(uniqid());
                            $arr['genderr'] = 3;
                            $arr['statuss'] = 1;
                            $arr['timee'] = "$FR_NOW_TIME";
                            $arr['datee'] = "$FR_NOW_DATE";
                            $FRR = FR_DATA_IN("frd_usr", $arr);
                            if ($FRR['FRA'] == 1) {
                                $FR_LAST_IN_ID = $FRR['FR_LIID'];
                                FR_TAL("Hi $UsrName New Customer Register Done", "success");

                                //FRD ORDER CUSTOMER ID UPDATE:-
                                try{
                                    $FR_CONN->exec("UPDATE frd_order_invo SET fr_cust_id = $FR_LAST_IN_ID WHERE id = $FRc_Invoice_Id_x");
                                    FR_TAL("ORDER CUSTOM UPDATE DONE INVOICE TABLE", "success");

                                    $FR_CONN->exec("UPDATE frd_order_items SET fr_cust_id = $FR_LAST_IN_ID WHERE fr_invo_id = $FRc_Invoice_Id_x");
                                    FR_TAL("ORDER CUSTOM UPDATE DONE ITEM TABLE", "success");

                                }catch(PDOException $e){
                                    echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                                }
                                //END>>


                            } else {
                                // FR_SWAL("Hi $UsrName",$R['FRM'],"error");
                                FR_SWAL("Hi $UsrName New Customer Register Failed", "", "error");
                            }
                        } else {
                                //FRD ORDER CUSTOMER ID UPDATE:-
                                $FRQ = $FR_CONN->query("SELECT id FROM frd_usr WHERE email1 = '$fr_cust_mob1' AND typee = 'cu'");
                                $FRSD = $FRQ->fetch();
                                $FRc_OrderCustomerId = $FRSD['id'];
                                try{
                                    $FR_CONN->exec("UPDATE frd_order_invo SET fr_cust_id = $FRc_OrderCustomerId WHERE id = $FRc_Invoice_Id_x");
                                    FR_TAL("ORDER CUSTOM UPDATE DONE INVOICE TABLE", "success");

                                    $FR_CONN->exec("UPDATE frd_order_items SET fr_cust_id = $FRc_OrderCustomerId WHERE fr_invo_id = $FRc_Invoice_Id_x");
                                    FR_TAL("ORDER CUSTOM UPDATE DONE ITEM TABLE", "success");

                                    $FRQ2 = "UPDATE frd_usr SET 
                                    namee = '$fr_cust_name',
                                    phon1 = '$fr_cust_mob1',
                                    phon2 = '$fr_cust_mob2',
                                    addresss = '$fr_cust_addres',
                                    fr_usr_div = '$fr_div',
                                    fr_usr_dis = '$fr_dis',
                                    fr_usr_tha = '$fr_tha'
                                    WHERE id = $FRc_OrderCustomerId";
                                    $FR_CONN->exec("$FRQ2");
                                    FR_TAL("Dear Boss $UsrName Customer Profile Data Update Done","success");

                                }catch(PDOException $e){
                                    echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                                }
                                //END>>
                        }
                    //END>>   

                    //FRD SMS SENDING:-
                    if($frsmsc_stc_nocon == 1){
                        extract(FR_USR_MINI_INFO($fr_cust_id));
                        $FRc_Message = "Dear Customer, Your order #$FRc_Invoice_Id_x has been confirmed. \nTracking-Link: $FRD_HURL/track/$FRc_Invoice_EncId_x \n\n $fr_cmobile_1";
                        $FRR_SMS = FR_SEND_SMS($fr_cust_mob1, $FRc_Message);
                        if($FRR_SMS['FRA']==1){
                            FR_TAL("SMS SEND DONE","success");
                        }else{
                            FR_TAL("SMS SEND FAILED","error");
                        }
                    }
                    //END>>

 
                    FR_GO("$FR_THIS_PAGE", "1");
                    exit;
                } else {
                    FR_SWAL(" $UsrName তথ্য আপডেট হয়নি ", "", "error");
                    FR_GO("$FR_THIS_PAGE", "3");
                    exit;
                }

            }
    }
    //END>>
    //++
    //++
    //FRD MAKE ORDER STSTUS HOLD :-
    if (isset($_POST['f_OrderHoldNote'])) {
            $FR_VC_DATA_PROCESS = "";
            $FR_VC_ARF = ""; //ALL REQUIRED FILD
            $FR_VC_ORDER_CURR_STAT = "";

            //FRD POST DATA FILTERING AND MAKING VARIVAL:-
            $f_OrderHoldNote = $_POST['f_OrderHoldNote'];

            //FRD_VC___________DATA PROSESSED OR NOT:-
            if (isset($f_OrderHoldNote)) {
                $FR_VC_DATA_PROCESS = 1;
            } else {
                FR_SWAL("Data Process Failed", "", "error");
            }
            //FRD_VC___________ALL REQUIRED FILED:-
            if ($f_OrderHoldNote != "") {
                $FR_VC_ARF = 1;
            } else {
                $FRR['FRA'] = 2;
                FR_SWAL("Please Fill All Required Field", "", "error");
            }

            //FRD_VC___________ ORDERT CURRENT STATUS:-
            if ($FRc_Invo_Stat_x == 1 || $FRc_Invo_Stat_x == 10) {
                $FR_VC_ORDER_CURR_STAT = 1;
            } else {
                FR_SWAL("FRD VA (H:HDHEHEHNRHYRUX)", "", "error");
            }


            if ($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1 AND $FR_VC_ORDER_CURR_STAT == 1) {

                $FRc_OrderProsHistory = "$fr_o_pros_history, আপনার অর্ডারটি সাময়িকভাবে হোল্ড করে রেখেছেন আমাদের প্রতিনিধি $UsrName । কারণ: $f_OrderHoldNote * " . date('d-M-Y h:i A', $FR_NOW_TIME) . "";
                $FRQ = "UPDATE frd_order_invo SET 
                    fr_stat = 6,
                    fr_o_pros_history = '$FRc_OrderProsHistory'
                    WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'";
                $R = FR_DATA_UP("$FRQ");
                if ($R['FRA'] == 1) {

                    //FRD ORDER ITEM TABLE STATUS UPDATE:-
                    try{
                        $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 6 WHERE fr_invo_id = $FRc_Invoice_Id_x");
                        FR_TAL("Items Update Done", "success");
                    }catch(PDOException $e){
                        FR_TAL("Items Update Failed", "error");
                        echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                    }
                    //END>>

                    //FRD SMS SENDING:-
                        if($frsmsc_stc_nohold == 1){
                            extract(FR_USR_MINI_INFO($fr_cust_id));
                            $FRc_Message = "Dear $fr_cust_name, Your order #$FRc_Invoice_Id_x Hold How.\nTrack: $FRD_HURL/track/$FRc_Invoice_EncId_x \n\n $fr_cmobile_1";
                            $FRR_SMS = FR_SEND_SMS($fr_cust_mob1, $FRc_Message);
                            if($FRR_SMS['FRA']==1){
                                FR_TAL("SMS SEND DONE","success");
                            }else{
                                FR_TAL("SMS SEND FAILED","error");
                            }
                        }
                    //END>>


                    FR_SWAL("$UsrName তথ্য আপডেট হয়েছে ", "", "success");
                    FR_GO("$FR_THIS_PAGE", "1");
                    exit;
                } else {
                    FR_SWAL(" $UsrName তথ্য আপডেট হয়নি ", "", "error");
                    FR_GO("$FR_THIS_PAGE", "3");
                    exit;
                }

            }
    }
    //END>>
    //++
    //++
    //FRD MAKE ORDER STSTUS SHIPED :-
    if (isset($_POST['FRTRIG_ShipedComplit'])) {
            $FR_VC_DATA_PROCESS = "";
            $FR_VC_ORDER_CURR_STAT = "";

            //FRD POST DATA FILTERING AND MAKING VARIVAL:-
            $f_ship_consignment_id = $_POST['f_ship_consignment_id'];
            $f_ship_tracking_code = $_POST['f_ship_tracking_code'];

            $FRc_ShipStat = 4;


            if($f_ship_consignment_id == ""){ $f_ship_consignment_id = "NA"; }
            if($f_ship_tracking_code == ""){ $f_ship_tracking_code = "NA"; }
            

            //FRD_VC___________DATA PROSESSED OR NOT:-
            if (isset($f_ship_consignment_id)) {
                $FR_VC_DATA_PROCESS = 1;
            } else {
                FR_SWAL("Data Process Failed", "", "error");
            }

            //FRD_VC___________ ORDERT CURRENT STATUS:-
            if ($FRc_Invo_Stat_x == 2 || $FRc_Invo_Stat_x == 3 || $FRc_Invo_Stat_x == 12 || $FRc_Invo_Stat_x == 11 || $FRc_Invo_Stat_x == 13 || $FRc_Invo_Stat_x == 14) {
                $FR_VC_ORDER_CURR_STAT = 1;
            } else {
                FR_SWAL("FRD VA (H:HDHDUUDJHX)", "", "error");
            }


            if ($FR_VC_DATA_PROCESS == 1 AND $FR_VC_ORDER_CURR_STAT == 1) {

                $FRc_ShipPartName = "NA";
                if($fr_ship_p_id > 0){
                    $FRR = FR_QSEL("SELECT * FROM frd_shippart WHERE id = $fr_ship_p_id", "");
                    if ($FRR['FRA'] == 1) {
                        extract($FRR['FRD']);
                        $FRc_ShipPartName = $frd_namee;
                    } else {
                        ECHO_4($FRR['FRM']);
                    }
                }
                $FRc_OrderProsHistory = "$fr_o_pros_history, আপনার পার্সেলটি $FRc_ShipPartName কুরিয়ারের মাধ্যমে ডেলিভারীতে পাঠানো হয়েছে। ট্রাকিং কোড: $f_ship_tracking_code এবং কনসাইনমেন্ট আইডি: $f_ship_consignment_id <small>[By $UsrName]</small>* " . date('d-M-Y h:i A', $FR_NOW_TIME) . "";

                try{
                    $FRQ = "UPDATE frd_order_invo SET 
                    fr_stat = :fr_stat,
                    fr_o_ship_date = :fr_o_ship_date,
                    fr_o_ship_time = :fr_o_ship_time,
                    fr_o_ship_by = :fr_o_ship_by,
                    fr_ship_track_code = :fr_ship_track_code,
                    fr_ship_consignment_id = :fr_ship_consignment_id,
                    fr_o_pros_history = :fr_o_pros_history
                    WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'";
                    $FRQ = $FR_CONN->prepare("$FRQ");
                    $FRQ->bindParam(':fr_stat', $FRc_ShipStat, PDO::PARAM_INT);
                    $FRQ->bindParam(':fr_o_ship_date', $FR_NOW_DATE, PDO::PARAM_STR);
                    $FRQ->bindParam(':fr_o_ship_time', $FR_NOW_TIME, PDO::PARAM_INT);
                    $FRQ->bindParam(':fr_o_ship_by', $UsrId, PDO::PARAM_STR);
                    $FRQ->bindParam(':fr_ship_track_code', $f_ship_tracking_code, PDO::PARAM_STR);
                    $FRQ->bindParam(':fr_ship_consignment_id', $f_ship_consignment_id, PDO::PARAM_STR);
                    $FRQ->bindParam(':fr_o_pros_history', $FRc_OrderProsHistory, PDO::PARAM_STR);
                    $FRQ->execute();
                    $FRQ_ROWS = $FRQ->rowCount();
                     if($FRQ_ROWS == 1){
                            // FRD ORDER ITEM TABLE STATUS UPDATE:-
                            try{
                                $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 4, fr_o_ship_date = '$FR_NOW_DATE' WHERE fr_invo_id = $FRc_Invoice_Id_x");
                                FR_TAL("Items Update Done", "success");
                            }catch(PDOException $e){
                                FR_TAL("Items Update Failed", "error");
                                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                            }
                            //END>>

                            //FRD SMS SENDING:-
                            if($frsmsc_stc_nosip == 1){
                                extract(FR_USR_MINI_INFO($fr_cust_id));
                                $FRc_Message = "Dear $fr_cust_name, Your order #$FRc_Invoice_Id_x Parcel Sent By $FRc_ShipPartName Courier. Track: $FRD_HURL/track/$FRc_Invoice_EncId_x \n\n $fr_cmobile_1";
                                $FRR_SMS = FR_SEND_SMS($fr_cust_mob1, $FRc_Message);
                                if($FRR_SMS['FRA']==1){
                                    FR_TAL("SMS SEND DONE","success");
                                }else{
                                    FR_TAL("SMS SEND FAILED","error");
                                }
                            }
                            //END>>


                            FR_SWAL("কুরিয়ারে আছে", "Dear Boss $UsrName!", "success");
                            FR_GO("$FR_THIS_PAGE", "1");
                     }
                    exit;
                }catch(PDOException $e){
                    FR_SWAL("ERROR: Shipped Failed", "Dear Boss $UsrName", "error");
                    FR_GO("$FR_THIS_PAGE", "3");
                    exit;
                }

            }
    }
    //END>>
    //++
    //++
    //FRD MAKE ORDER STSTUS CANCELED:-
    if (isset($_POST['f_OrderCancelNote'])) {
        if ($FRc_Invo_Stat_x == 1 || $FRc_Invo_Stat_x == 6 || $FRc_Invo_Stat_x == 3 || $FRc_Invo_Stat_x == 9 || $FRc_Invo_Stat_x == 10 || $FRc_Invo_Stat_x == 13 || $FRc_Invo_Stat_x == 14) {

            //FRD VC NEED:-
            $FR_VC_DATA_PROCESS = "";
            $FR_VC_ARF = ""; //ALL REQUIRED FILD

            //FRD POST DATA FILTERING AND MAKING VARIVAL:-
            $f_OrderCancelNote = $_POST['f_OrderCancelNote'];

            //FRD_VC___________DATA PROSESSED OR NOT:-
            if (isset($f_OrderCancelNote)) {
                $FR_VC_DATA_PROCESS = 1;
            } else {
                FR_SWAL("Data Process Failed", "", "error");
            }
            //FRD_VC___________ALL REQUIRED FILED:-
            if ($f_OrderCancelNote != "") {
                $FR_VC_ARF = 1;
            } else {
                $FRR['FRA'] = 2;
                FR_SWAL("Please Fill All Required Field", "", "error");
            }


            if ($FR_VC_DATA_PROCESS == 1 and $FR_VC_ARF == 1) {

                $FRc_OrderProsHistory = "$fr_o_pros_history, আপনার অর্ডারটি বাতিল করেছে আমাদের প্রতিনিধি $UsrName । কারণ: $f_OrderCancelNote* " . date('d-M-Y h:i A', $FR_NOW_TIME) . "";
                $FRQ = "UPDATE frd_order_invo SET 
                    fr_stat = 8,
                    fr_o_cancel_date = '$FR_NOW_DATE',
                    fr_o_cancel_time = '$FR_NOW_TIME',
                    fr_o_cancel_by = '$UsrId',
                    fr_o_cancel_note = '$f_OrderCancelNote',
                    fr_o_pros_history = '$FRc_OrderProsHistory'
                    WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'";
                $R = FR_DATA_UP("$FRQ");
                if ($R['FRA'] == 1) {
                    //FRD ORDER ITEM TABLE STATUS UPDATE:-
                    try{
                        $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 8, fr_o_cancel_date = '$FR_NOW_DATE' WHERE fr_invo_id = $FRc_Invoice_Id_x");
                        FR_TAL("Items Update Done", "success");


                        extract(FRF_PRO_STOCK_PLUS($FRc_Invoice_Id_x));
                        if($FRA == 1){
                            FR_TAL("Stock Update Done", "success"); 
                        }else{
                            FR_TAL("Stock Update Failed", "error");
                        }
            
                    }catch(PDOException $e){
                        FR_TAL("Items Update Failed", "error");
                        echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                    }
                    //END>>

                    //FRD SMS SENDING:-
                    if($frsmsc_stc_nocan == 1){
                        extract(FR_USR_MINI_INFO($fr_cust_id));
                        $FRc_Message = "Dear $fr_cust_name, Your order #$FRc_Invoice_Id_x Canceled. Track: $FRD_HURL/track/$FRc_Invoice_EncId_x \n\n $fr_cmobile_1";
                        $FRR_SMS = FR_SEND_SMS($fr_cust_mob1, $FRc_Message);
                        if($FRR_SMS['FRA']==1){
                            FR_TAL("SMS SEND DONE","success");
                        }else{
                            FR_TAL("SMS SEND FAILED","error");
                        }
                    }
                    //END>>


                    FR_SWAL("Canceled", "Dear Boss $UsrName!", "success");
                    FR_GO("$FR_THIS_PAGE", "1");
                    exit;
                } else {
                    FR_SWAL(" $UsrName তথ্য আপডেট হয়নি ", "", "error");
                    FR_GO("$FR_THIS_PAGE", "3");
                    exit;
                }
            }
        }
    }
    //END>>
    //++
    //++
    //FRD MAKE ORDER STSTUS DELIVERY FAILED:-
    if (isset($_POST['f_DeliveryFailedNote'])) {
        if ($FRc_Invo_Stat_x == 4 || $FRc_Invo_Stat_x == 15) {

            //FRD VC NEED:-
            $FR_VC_DATA_PROCESS = "";
            $FR_VC_ARF = ""; //ALL REQUIRED FILD

            //FRD POST DATA FILTERING AND MAKING VARIVAL:-
            $f_DeliveryFailedNote = $_POST['f_DeliveryFailedNote'];
            $FRc_Stat = 7;

            //FRD_VC___________DATA PROSESSED OR NOT:-
            if (isset($f_DeliveryFailedNote)) {
                $FR_VC_DATA_PROCESS = 1;
            } else {
                FR_SWAL("Data Process Failed", "", "error");
            }
            //FRD_VC___________ALL REQUIRED FILED:-
            if ($f_DeliveryFailedNote != "") {
                $FR_VC_ARF = 1;
            } else {
                $FRR['FRA'] = 2;
                FR_SWAL("Please Fill All Required Field", "", "error");
            }


            if ($FR_VC_DATA_PROCESS == 1 and $FR_VC_ARF == 1) {
                $FRc_OrderProsHistory = "$fr_o_pros_history, আপনার অর্ডার রিটার্ন করা হয়েছে । কারনঃ $f_DeliveryFailedNote | <small>[By $UsrName]</small>* " . date('d-M-Y h:i A', $FR_NOW_TIME) . "";

                try{
                    $FRQ = "UPDATE frd_order_invo SET 
                    fr_stat = :fr_stat,
                    fr_dfail_date = :fr_dfail_date,
                    fr_dfail_time = :fr_dfail_time,
                    fr_dfail_by = :fr_dfail_by,
                    fr_ppro_return = :fr_ppro_return,
                    fr_o_pros_history = :fr_o_pros_history
                    WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'";
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
                                        $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 7, fr_o_dfail_date = '$FR_NOW_DATE' WHERE fr_invo_id = $FRc_Invoice_Id_x");
                                        FR_TAL("Items Update Done", "success");

                                        extract(FRF_PRO_STOCK_PLUS($FRc_Invoice_Id_x));
                                        if($FRA == 1){
                                            FR_TAL("Stock Update Done", "success"); 
                                        }else{
                                            FR_TAL("Stock Update Failed", "error");
                                        }
                               
                                    }catch(PDOException $e){
                                        FR_TAL("Items Update Failed", "error");
                                        echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                                    }
                                //END>>

                                
                                //FRD OPS_NOTE UPDATE:-
                                    $arr = array();
                                    $arr['fr_opn_order_id'] = $FRc_Invoice_Id_x;
                                    $arr['fr_opn_note'] = "Delivery Failed Note: $f_DeliveryFailedNote";
                                    $arr['fr_opn_by_id'] = "$UsrId";
                                    $arr['fr_opn_by_name'] = "$UsrName";
                                    $arr['fr_opn_time'] = "$FR_NOW_TIME";
                                    $arr['fr_opn_date'] = "$FR_NOW_DATE";
                                    $FRR = FR_DATA_IN("frd_order_p_note",$arr);
                                    if($FRR['FRA']==1){
                                        FR_TAL("Note Add Done","success");
                                    }else{
                                        FR_TAL("Note Add Failed","error");
                                    }
                                //END>>

                                //FRD PPR MANAGMENT ADJESTMENT:- 
                                    $FRR = FR_QSEL("SELECT id AS FRc_ThisItemId,fr_invo_id,fr_qty,fr_t_price FROM frd_order_items WHERE fr_invo_id = $FRc_Invoice_Id_x ", "ALL");
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
                                        ECHO_4("PPR MANEGMENT FAILED","alert alert-danger");
                                    }
                                //END>>

                                FR_SWAL("Dear Boss $UsrName", "Failed Done", "success");
                                FR_GO("$FR_THIS_PAGE", "1");
                        }
                        exit;
                }catch(PDOException $e){
                    FR_SWAL("ERROR: Delivery Failed Status Update", "Dear Boss $UsrName", "error");
                    FR_GO("$FR_THIS_PAGE", "3");
                    exit;
                }

            }
        }
    }
    //END>>






//---------------------------------------------------------
//FRD ADD NOTE:-
//---------------------------------------------------------
if(isset($_POST['f_order_prosess_note'])){
    //FRD VC NEED:-
        $FR_VC_DATA_PROCESS = "";
        $FR_VC_ARF = "";//ALL REQUIRED FILD
    
	   $FRc_order_proses_note = $_POST['f_order_prosess_note'];
    
    //FRD_VC___________DATA PROSESSED OR NOT:-
        if(isset($FRc_order_proses_note)){  $FR_VC_DATA_PROCESS = 1; }else{ $FRR['FRA'] = 2; $FRR['FRM'] = "Data Process Failed";  FR_SWAL("Data Process Failed","","error"); }

    //FRD_VC___________ALL REQUIRED FILED:-
        if($FRc_order_proses_note != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; $FRR['FRM'] = "Please Fill All Required Field";  FR_SWAL("Please Fill All Required Field","","error"); }


                if($FR_VC_DATA_PROCESS == 1 and $FR_VC_ARF==1){

                    $arr = array();
                    $arr['fr_opn_order_id'] = $FRc_Invoice_Id_x;
                    $arr['fr_opn_note'] = "$FRc_order_proses_note";
                    $arr['fr_opn_by_id'] = "$UsrId";
                    $arr['fr_opn_by_name'] = "$UsrName";
                    $arr['fr_opn_time'] = "$FR_NOW_TIME";
                    $arr['fr_opn_date'] = "$FR_NOW_DATE";
                    $FRR = FR_DATA_IN("frd_order_p_note",$arr);
                    if($FRR['FRA']==1){
                        FR_SWAL("Note Add Done","","success");
                        FR_GO("$FR_THIS_PAGE", "1");
                        exit;
                    }else{
                        FR_SWAL("Note Add Failed",$R['FRM'],"error");
                        FR_GO("$FR_THIS_PAGE", "1");
                        exit;
                    }
                }
                        
}
//END ADD>>
//+
//+
//---------------------------------------------------------
//FRD ADD COMPLAIN:-
//---------------------------------------------------------
if(isset($_POST['f_complain_note'])){
    //FRD VC NEED:-
        $FR_VC_DATA_PROCESS = "";
        $FR_VC_ARF = "";//ALL REQUIRED FILD
    
	   $f_complain_note = $_POST['f_complain_note'];
    
    //FRD_VC___________DATA PROSESSED OR NOT:-
        if(isset($f_complain_note)){  $FR_VC_DATA_PROCESS = 1; }else{ $FRR['FRA'] = 2; $FRR['FRM'] = "Data Process Failed";  FR_SWAL("Data Process Failed","","error"); }

    //FRD_VC___________ALL REQUIRED FILED:-
        if($f_complain_note != ""){ $FR_VC_ARF = 1; }else{ $FRR['FRA'] = 2; $FRR['FRM'] = "Please Fill All Required Field";  FR_SWAL("Please Fill All Required Field","","error"); }


                if($FR_VC_DATA_PROCESS == 1 and $FR_VC_ARF==1){

                    $arr = array();
                    $arr['fr_opn_order_id'] = $FRc_Invoice_Id_x;
                    $arr['fr_opn_note'] = "Complain: $f_complain_note";
                    $arr['fr_opn_by_id'] = "$UsrId";
                    $arr['fr_opn_by_name'] = "$UsrName";
                    $arr['fr_opn_time'] = "$FR_NOW_TIME";
                    $arr['fr_opn_date'] = "$FR_NOW_DATE";
                    $FRR = FR_DATA_IN("frd_order_p_note",$arr);
                    if($FRR['FRA']==1){

                        try{
                            $FR_CONN->exec("UPDATE frd_order_invo SET fr_c_stat = 1 WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'");
                            FR_SWAL("Dear Boss $UsrName","Complain Add Done","success");
                            FR_GO("$FR_THIS_PAGE", "1");
                            exit;
                        }catch(PDOException $e){
                            FR_SWAL("Complain Add Failedd",$e->getMessage(),"error");
                            exit;
                        }

                    }else{
                        FR_SWAL("Complain Add Failed",$R['FRM'],"error");
                        FR_GO("$FR_THIS_PAGE", "1");
                        exit;
                    }
                }
                        
}
//END ADD>>
//+
//+
//---------------------------------------------------------
//FRD SOLVED COMPLAIN:-
//---------------------------------------------------------
if(isset($_POST['FRTIGT_SOLVED_COMPLAIN'])){

    //FRD_VC___________DATA PROSESSED OR NOT:-
        if(isset($_POST['FRTIGT_SOLVED_COMPLAIN'])){  $FR_VC_DATA_PROCESS = 1; }else{ $FRR['FRA'] = 2; $FRR['FRM'] = "Data Process Failed";  FR_SWAL("Data Process Failed","","error"); }


                if($FR_VC_DATA_PROCESS == 1){

                    $arr = array();
                    $arr['fr_opn_order_id'] = $FRc_Invoice_Id_x;
                    $arr['fr_opn_note'] = "Complain Solved";
                    $arr['fr_opn_by_id'] = "$UsrId";
                    $arr['fr_opn_by_name'] = "$UsrName";
                    $arr['fr_opn_time'] = "$FR_NOW_TIME";
                    $arr['fr_opn_date'] = "$FR_NOW_DATE";
                    $FRR = FR_DATA_IN("frd_order_p_note",$arr);
                    if($FRR['FRA']==1){

                        try{
                            $FR_CONN->exec("UPDATE frd_order_invo SET fr_c_stat = 2 WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'");
                            FR_SWAL("Dear Boss $UsrName","Complain Sloved","success");
                            FR_GO("$FR_THIS_PAGE", "1");
                            exit;
                        }catch(PDOException $e){
                            FR_SWAL("Complain Solved Failedd",$e->getMessage(),"error");
                            exit;
                        }

                    }else{
                        FR_SWAL("Complain Solved Failed",$R['FRM'],"error");
                        FR_GO("$FR_THIS_PAGE", "1");
                        exit;
                    }
                }
                        
}
//END ADD>>







    //FRD UPDATE NEW DELIVERY CHARGE :-
    if (isset($_POST['f_NewShipCharge'])) {
        if ($FRc_Invo_Stat_x == 1 || $FRc_Invo_Stat_x == 6 || $FRc_Invo_Stat_x == 10) {
            //FRD VC NEED:-
            $FR_VC_DATA_PROCESS = "";
            $FR_VC_ARF = ""; //ALL REQUIRED FILD
            $FR_VC_CNRLT0 = ""; //CANT RECEIVE LESS THEN 0

            //FRD POST DATA FILTERING AND MAKING VARIVAL:-
            $f_NewShipCharge = $_POST['f_NewShipCharge'];

            //FRD_VC___________DATA PROSESSED OR NOT:-
            if (isset($f_NewShipCharge)) {
                $FR_VC_DATA_PROCESS = 1;
            } else {
                FR_SWAL("Data Process Failed", "", "error");
            }
            //FRD_VC___________ALL REQUIRED FILED:-
            if ($f_NewShipCharge != "") {
                $FR_VC_ARF = 1;
            } else {
                $FRR['FRA'] = 2;
                FR_SWAL("Please Fill All Required Field", "", "error");
            }
            //FRD_VC_________________________________________CAN'T RECEIVE LESS THEN 0:-
            if ($f_NewShipCharge >= 0) {
                $FR_VC_CNRLT0 = 1;
            } else {
                FR_SWAL("You Can Not Receive $f_NewShipCharge/- This", "", "error");
            }


            if ($FR_VC_DATA_PROCESS == 1 and $FR_VC_ARF == 1 and $FR_VC_CNRLT0 == 1) {

                $FRc_OrderProsHistory = "$fr_o_pros_history, ডেলিভারি চার্জ আপডেট করা হয়েছে $fr_ship_cost টাকা থেকে $f_NewShipCharge টাকা [By $UsrName]* " . date('d-M-Y h:i A', $FR_NOW_TIME) . "";

                $FRQ = "UPDATE frd_order_invo SET 
            fr_ship_cost = $f_NewShipCharge,
            fr_o_pros_history = '$FRc_OrderProsHistory'
            WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'";
                $R = FR_DATA_UP("$FRQ");
                if ($R['FRA'] == 1) {

                    //FRD INVOICE PAYABLE AMOUNT UPDATE START:-
                    $FRR = FRF_UpInvoDueAmount($FRc_Invoice_Id_x, $FRc_Invoice_EncId_x);
                    if ($FRR['FRA'] == 1) {
                        FR_SWAL("Dear Boss $UsrName!", "Delivery Charge Update Done!", "success");
                        FR_GO("$FR_THIS_PAGE", "1");
                        exit;
                    } else {
                        FR_SWAL("Dear Boss $UsrName!", "Delivery Charge Update Failed!", "error");
                        FR_GO("$FR_THIS_PAGE", "3");
                        exit;
                    }
                    //END>>

                } else {
                    FR_SWAL(" $UsrName ডেলিভারি চার্জ আপডেট হয়নি ", "", "error");
                    FR_GO("$FR_THIS_PAGE", "3");
                    exit;
                }
            }
        }
    }
    //END>>


    //FRD UPDATE COUPON DISCOUNT AMOUNT:-
    if (isset($_POST['f_NewCouponDiscountAmount'])) {
        if ($FRc_Invo_Stat_x == 1 || $FRc_Invo_Stat_x == 6 || $FRc_Invo_Stat_x == 10) {
            //FRD VC NEED:-
            $FR_VC_DATA_PROCESS = "";
            $FR_VC_ARF = ""; //ALL REQUIRED FILD
            $FR_VC_CNRLT0 = ""; //CANT RECEIVE LESS THEN 0

            //FRD POST DATA FILTERING AND MAKING VARIVAL:-
            $f_NewCouponDiscountAmount = $_POST['f_NewCouponDiscountAmount'];

            //FRD_VC___________DATA PROSESSED OR NOT:-
            if (isset($f_NewCouponDiscountAmount)) {
                $FR_VC_DATA_PROCESS = 1;
            } else {
                FR_SWAL("Data Process Failed", "", "error");
            }
            //FRD_VC___________ALL REQUIRED FILED:-
            if ($f_NewCouponDiscountAmount != "") {
                $FR_VC_ARF = 1;
            } else {
                $FRR['FRA'] = 2;
                FR_SWAL("Please Fill All Required Field", "", "error");
            }
            //FRD_VC_________________________________________CAN'T RECEIVE LESS THEN 0:-
            if ($f_NewCouponDiscountAmount >= 0) {
                $FR_VC_CNRLT0 = 1;
            } else {
                FR_SWAL("You Can Not Receive $f_NewCouponDiscountAmount/- This", "", "error");
            }


            if ($FR_VC_DATA_PROCESS == 1 and $FR_VC_ARF == 1 and $FR_VC_CNRLT0 == 1) {

                $FRQ = "UPDATE frd_order_invo SET 
                fr_cupo_discount = $f_NewCouponDiscountAmount,
                fr_coup_id = 0,
                fr_coup_typ = 0,
                fr_coup_code = 'N/A'
                WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'";
                $R = FR_DATA_UP("$FRQ");
                if ($R['FRA'] == 1) {

                    //FRD INVOICE DUE AMOUNT UPDATE START:-
                    $FRR = FRF_UpInvoDueAmount($FRc_Invoice_Id_x, $FRc_Invoice_EncId_x);
                    if ($FRR['FRA'] == 1) {
                        FR_SWAL("Dear Boss $UsrName!", "Discount Add Done", "success");
                        FR_GO("$FR_THIS_PAGE", "1");
                        exit;
                    } else {
                        FR_SWAL("Dear Boss $UsrName", "Discount Add Failed", "error");
                        FR_GO("$FR_THIS_PAGE", "3");
                        exit;
                    }
                    //END>>

                } else {
                    FR_SWAL(" $UsrName তথ্য আপডেট হয়নি ", "", "error");
                    FR_GO("$FR_THIS_PAGE", "3");
                    exit;
                }
            }
        }
    }
    //END>>

    //FRD UPDATE PAYMENT RECEIVE AMOUNT || PAYMENT-RECEIVING:-
    if (isset($_POST['f_AdvanceReceivAmount'])){
        if ($FRc_Invo_Stat_x > 1 AND $fr_invo_due > 0) {
            //FRD VC NEED:-
            $FR_VC_DATA_PROCESS = "";
            $FR_VC_ARF = ""; //ALL REQUIRED FILD
            $FR_VC_TAN_AMOUNT_D = "";
            $FR_VC_CNRMT_DUE_A = ""; //CAN'T RECEIVE MORE THEN DUE AMOUNT
            $FR_VC_DUB_TRAN_ID = ""; //DUBLICATE TRANJECTION ID

            //FRD POST DATA FILTERING AND MAKING VARIVAL:-
            $FRc_trn_amount = $_POST['f_AdvanceReceivAmount'];
            if(isset($_POST['f_bank_ac_id'])){
                $FRc_bank_ac_id = $_POST['f_bank_ac_id'];
            }else{
                $FRc_bank_ac_id = 1;
            }
            $f_TransactionId = $_POST['f_TransactionId'];
            $f_trn_note = $_POST['f_trn_note'];

            //FRD_VC TRANSACTION AMOUNT DATA __________________________________________:-
            if($FRc_trn_amount > 0 AND is_numeric($FRc_trn_amount) AND $FRc_bank_ac_id != ""){
                $FR_VC_TAN_AMOUNT_D = 1;
            }else{
                FR_SWAL("$UsrName Your Access Denied for Spider Ecommerce System","","error");
                FR_GO("$FR_THIS_PAGE",3);
                exit;
            }

            $FRQ = $FR_CONN->query("SELECT fr_bank_name,fr_bnk_ac_number,fr_bnk_ac_balance FROM frd_bank_ac WHERE id = $FRc_bank_ac_id");
            extract($FRQ->fetch());
            extract(FRF_C_MTL_CUR_BAL());
            $FRc_AfterTran_ThisBankAcBal = ($fr_bnk_ac_balance + $FRc_trn_amount);
            $FRc_AfterTran_MTLBal = ($FRc_C_MTL_CUR_BAL + $FRc_trn_amount);

        
            //FRD_VC___________DATA PROSESSED OR NOT:-
            if (isset($FRc_trn_amount)) {
                $FR_VC_DATA_PROCESS = 1;
            } else {
                FR_SWAL("Data Process Failed", "", "error");
            }
            //FRD_VC___________ALL REQUIRED FILED:-
            if ($FRc_trn_amount != "") {
                $FR_VC_ARF = 1;
            } else {
                $FRR['FRA'] = 2;
                FR_SWAL("Please Fill All Required Field", "", "error");
            }
            //FRD_VC___________________________________________:-
            if ($FRc_trn_amount <= $fr_invo_due) {
                $FR_VC_CNRMT_DUE_A = 1;
            } else {
                FR_SWAL("$UsrName You Can Not Receive More Then $fr_invo_due ৳", "", "error");
            }
            //FRD_VC DUBLICATE TRANJECTION ID ________________________________________:-
            if($f_TransactionId == ""){
                $FR_VC_DUB_TRAN_ID = 1;
            }else{
                $FRQ = $FR_CONN->query("SELECT COUNT(id) AS FRc_VC_TranId_C FROM frd_mtl WHERE fr_trn_id = '$f_TransactionId'");
                extract($FRQ->fetch());
                if($FRc_VC_TranId_C == 0){
                    $FR_VC_DUB_TRAN_ID = 1;
                }else{
                    FR_SWAL("Dear Boss $UsrName Duplicate Transaction Id Found", "", "error");
                }
            }
            

    

            if ($FR_VC_TAN_AMOUNT_D == 1 AND $FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1 AND $FR_VC_CNRMT_DUE_A == 1 AND $FR_VC_DUB_TRAN_ID == 1) {
                try{
                    $ARR = array();
                    $ARR['fr_cd'] = 1;
                    $ARR['fr_trn_typ'] = 3;
                    $ARR['fr_trn_amount'] = $FRc_trn_amount;
                    $ARR['fr_note'] = "$f_trn_note";
                    $ARR['fr_time'] = "$FR_NOW_TIME";
                    $ARR['fr_date'] = "$FR_NOW_DATE";
                    $ARR['fr_month'] = "$FR_NOW_MONTH";
                    $ARR['fr_year'] = "$FR_NOW_YEAR";
                    $ARR['fr_by'] = "$UsrId";
                    $ARR['fr_b_ac_id'] = $FRc_bank_ac_id;
                    $ARR['fr_b_name'] = "$fr_bank_name";
                    $ARR['fr_b_ac_number'] = "$fr_bnk_ac_number";
                    $ARR['fr_stat'] = 1;
                    $ARR['fr_invo_id'] = $FRc_Invoice_Id_x;
                    $ARR['fr_pay_gtw_id'] = 2;
                    $ARR['fr_pay_gtw_name'] = "Manual";
                    $ARR['fr_trn_id'] = "$f_TransactionId";
                    $ARR['fr_cust_id'] = $FRc_Invo_Cust_Id;
                    $FRc_Columns = implode(", ", array_keys($ARR));
                    $FRc_ValuesBind = implode(", :", array_keys($ARR));
                    $FRQ = "INSERT INTO frd_mtl ($FRc_Columns) VALUES (:$FRc_ValuesBind)";
                    $FRQ = $FR_CONN->prepare("$FRQ");
                    $FRQ->execute($ARR);
                    $FRc_MTL_LastInsertId = $FR_CONN->lastInsertId();

                    //FRD INVOICE DUE AMOUNT UPDATE START:-
                    $FR_CONN->exec("UPDATE frd_order_invo SET fr_payment = (fr_payment + $FRc_trn_amount) WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'");
                    $FRR = FRF_UpInvoDueAmount($FRc_Invoice_Id_x, $FRc_Invoice_EncId_x);
                    if ($FRR['FRA'] == 1) {
                        FR_TAL("Invoice Due Update Done!","success");
                    } else {
                        FR_SWAL("Invoice Due Update Failed!","","success");
                        exit;
                    }
                    //END>>

                    $FR_CONN->exec("UPDATE frd_bank_ac SET fr_bnk_ac_balance = (fr_bnk_ac_balance + $FRc_trn_amount), fr_bnk_ac_t_credit = (fr_bnk_ac_t_credit + $FRc_trn_amount) WHERE id = $FRc_bank_ac_id");
                    $FR_CONN->exec("UPDATE frd_cprofile SET fr_mtl_balance = (fr_mtl_balance + $FRc_trn_amount) WHERE id = 1");
                    $FR_CONN->exec("UPDATE frd_mtl SET fr_b_ac_cur_bal = $FRc_AfterTran_ThisBankAcBal, fr_mtl_cur_bal = $FRc_AfterTran_MTLBal  WHERE id = $FRc_MTL_LastInsertId");


                    //FRD ORDER PROCESS HISTORY DATA SAVE START:-{
                         $FRc_OrderProsHistory = "$fr_o_pros_history ,প্রিয় $fr_cust_name ! আপনার অগ্রিম পেমেন্ট $FRc_trn_amount টাকা গ্রহণ করা হয়েছে। ট্রানজেকশন আইডি: $f_TransactionId | <small>[By $UsrName]</small> * ".date('d-M-Y h:i A',$FR_NOW_TIME)."";
                         $FR_CONN->exec("UPDATE frd_order_invo SET fr_o_pros_history = '$FRc_OrderProsHistory' WHERE id = $FRc_Invoice_Id_x");
                    //END>>

                    //FRD NOTIFY CUSTOMER PAYMENT RECEIVEED (TEMP):-
                    if($frsmsc_stc_npr == 1){
                        extract(FR_USR_MINI_INFO($fr_cust_id));
                        $FRc_Message = "Dear $fr_cust_name, your payment received $FRc_trn_amount TK\nInvoiceId: #$FRc_Invoice_Id_x \nThanks.\n\n $fr_cmobile_1 \n$FRD_HURL";
                        $FRR_SMS = FR_SEND_SMS($fr_cust_mob1, $FRc_Message);
                        if($FRR_SMS['FRA']==1){
                            // FR_TAL("SMS SEND DONE","success");
                        }else{
                            FR_TAL("SMS SEND FAILED","error");
                        }
                    }
                    //END>>

                    FR_SWAL("Payment Receive Done!","Congratulations $UsrName","success");
                    FRF_SOUND("PIP");
                    FR_GO("$FR_THIS_PAGE",1);
                    exit;
                }catch(PDOException $e){
                    FR_SWAL("Payment Receive Failed","","error");
                    echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                    // FR_GO("$FR_THIS_PAGE",1);
                    exit;
                }
            }
        }
    }
    //END>>



     //FRD UPDATE COD PAYMENT RECEIVE AMOUNT:-
     if (isset($_POST['f_CODReceivedAmount'])){
        if ($fr_invo_due > 0 AND $FRc_Invo_Stat_x == 5 OR $FRc_Invo_Stat_x == 7) {
            //FRD VC NEED:-
            $FR_VC_DATA_PROCESS = "";
            $FR_VC_ARF = ""; //ALL REQUIRED FILD
            $FR_VC_TAN_AMOUNT_D = "";
            $FR_VC_CNRMT_DUE_A = ""; //CAN'T RECEIVE MORE THEN DUE AMOUNT

            //FRD POST DATA FILTERING AND MAKING VARIVAL:-
            $FRc_trn_amount = $_POST['f_CODReceivedAmount'];
            if(isset($_POST['f_bank_ac_id'])){
                $FRc_bank_ac_id = $_POST['f_bank_ac_id'];
            }else{
                $FRc_bank_ac_id = 1;
            }
            $f_TransactionId = $_POST['f_TransactionId'];
            $f_trn_note = $_POST['f_trn_note'];

            //FRD_VC TRANSACTION AMOUNT DATA __________________________________________:-
            if($FRc_trn_amount > 0 AND is_numeric($FRc_trn_amount) AND $FRc_bank_ac_id != ""){
                $FR_VC_TAN_AMOUNT_D = 1;
            }else{
                FR_SWAL("$UsrName Your Access Denied for Spider Ecommerce System","","error");
                FR_GO("$FR_THIS_PAGE",3);
                exit;
            }

            $FRQ = $FR_CONN->query("SELECT fr_bank_name,fr_bnk_ac_number,fr_bnk_ac_balance FROM frd_bank_ac WHERE id = $FRc_bank_ac_id");
            extract($FRQ->fetch());
            extract(FRF_C_MTL_CUR_BAL());
            $FRc_AfterTran_ThisBankAcBal = ($fr_bnk_ac_balance + $FRc_trn_amount);
            $FRc_AfterTran_MTLBal = ($FRc_C_MTL_CUR_BAL + $FRc_trn_amount);

        
            //FRD_VC___________DATA PROSESSED OR NOT:-
            if (isset($FRc_trn_amount)) {
                $FR_VC_DATA_PROCESS = 1;
            } else {
                FR_SWAL("Data Process Failed", "", "error");
            }
            //FRD_VC___________ALL REQUIRED FILED:-
            if ($FRc_trn_amount != "") {
                $FR_VC_ARF = 1;
            } else {
                $FRR['FRA'] = 2;
                FR_SWAL("Please Fill All Required Field", "", "error");
            }
            //FRD_VC___________________________________________:-
            if ($FRc_trn_amount <= $fr_invo_due) {
                $FR_VC_CNRMT_DUE_A = 1;
            } else {
                FR_SWAL("$UsrName You Can Not Receive More Then $fr_invo_due ৳", "", "error");
            }

    

            if ($FR_VC_TAN_AMOUNT_D == 1 AND $FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1 AND $FR_VC_CNRMT_DUE_A == 1) {
                try{
                    $ARR = array();
                    $ARR['fr_cd'] = 1;
                    $ARR['fr_trn_typ'] = 4;
                    $ARR['fr_trn_amount'] = $FRc_trn_amount;
                    $ARR['fr_note'] = "$f_trn_note";
                    $ARR['fr_time'] = "$FR_NOW_TIME";
                    $ARR['fr_date'] = "$FR_NOW_DATE";
                    $ARR['fr_month'] = "$FR_NOW_MONTH";
                    $ARR['fr_year'] = "$FR_NOW_YEAR";
                    $ARR['fr_by'] = "$UsrId";
                    $ARR['fr_b_ac_id'] = $FRc_bank_ac_id;
                    $ARR['fr_b_name'] = "$fr_bank_name";
                    $ARR['fr_b_ac_number'] = "$fr_bnk_ac_number";
                    $ARR['fr_stat'] = 1;
                    $ARR['fr_invo_id'] = $FRc_Invoice_Id_x;
                    $ARR['fr_pay_gtw_id'] = 2;
                    $ARR['fr_pay_gtw_name'] = "Manual";
                    $ARR['fr_trn_id'] = "$f_TransactionId";
                    $ARR['fr_cust_id'] = $FRc_Invo_Cust_Id;
                    $FRc_Columns = implode(", ", array_keys($ARR));
                    $FRc_ValuesBind = implode(", :", array_keys($ARR));
                    $FRQ = "INSERT INTO frd_mtl ($FRc_Columns) VALUES (:$FRc_ValuesBind)";
                    $FRQ = $FR_CONN->prepare("$FRQ");
                    $FRQ->execute($ARR);
                    $FRc_MTL_LastInsertId = $FR_CONN->lastInsertId();

                    $FR_CONN->exec("UPDATE frd_order_invo SET fr_payment = (fr_payment + $FRc_trn_amount), fr_invo_due = (fr_invo_due - $FRc_trn_amount) WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'");

                    $FR_CONN->exec("UPDATE frd_bank_ac SET fr_bnk_ac_balance = (fr_bnk_ac_balance + $FRc_trn_amount), fr_bnk_ac_t_credit = (fr_bnk_ac_t_credit + $FRc_trn_amount) WHERE id = $FRc_bank_ac_id");
                    $FR_CONN->exec("UPDATE frd_cprofile SET fr_mtl_balance = (fr_mtl_balance + $FRc_trn_amount) WHERE id = 1");
                    $FR_CONN->exec("UPDATE frd_mtl SET fr_b_ac_cur_bal = $FRc_AfterTran_ThisBankAcBal, fr_mtl_cur_bal = $FRc_AfterTran_MTLBal  WHERE id = $FRc_MTL_LastInsertId");

                    FR_SWAL("COD Payment Receive Done!","Congratulations $UsrName","success");
                    FRF_SOUND("PIP");
                    FR_GO("$FR_THIS_PAGE",1);
                    exit;
                }catch(PDOException $e){
                    FR_SWAL("COD Payment Receive Failed","","error");
                    echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                    FR_GO("$FR_THIS_PAGE",1);
                    exit;
                }
            }
        }
    }
    //END>>


     //FRD UPDATE PARSIAL Product Return Amount AMOUNT // PPR-UPDATE:-
     if (isset($_POST['f_ppr_qty'])){

            $FR_VC_DATA_PROCESS = "";
            $FR_VC_ARF = ""; //ALL REQUIRED FILD
            $FR_VC_TAN_AMOUNT_D = "";
            $FR_VC_CNRMT_DUE_A = ""; //CAN'T RECEIVE MORE THEN DUE AMOUNT
            $FR_VC_ONLYADMIN = "";//ONLY ADMIN CAN DO THIS
            $FR_VC_QTY = "";//CAN'T RETURN MORE THEN ORDER QTY
            $FR_VC_STATUS = "";

            //FRD POST DATA FILTERING AND MAKING VARIVAL:-
            $f_ppr_qty = $_POST['f_ppr_qty'];
            $f_ppr_itemid = $_POST['f_ppr_itemid'];
            $f_ppr_status = $_POST['f_ppr_status'];

             //FRD_VC___________DATA PROSESSED OR NOT:-
             if (isset($f_ppr_qty)) {
                $FR_VC_DATA_PROCESS = 1;
            } else {
                FR_SWAL("Data Process Failed", "", "error");
            }
            //FRD_VC___________ALL REQUIRED FILED:-
            if ($f_ppr_qty != "") {
                $FR_VC_ARF = 1;
            } else {
                FR_SWAL("Please Fill All Required Field", "", "error");
            }

            //FRD_VC___________ QTY:-
            $FRQ = $FR_CONN->query("SELECT * FROM frd_order_items WHERE id = $f_ppr_itemid AND fr_invo_id = $FRc_Invoice_Id_x");
             extract($FRQ->fetch());
             if($f_ppr_qty > 0 AND $f_ppr_qty <= $fr_qty){
                   $FR_VC_QTY = 1;
                   $FRc_PPR_Amount = ($fr_price * $f_ppr_qty);
                   $FRc_PPR_BuyPrice_Minus = ($fr_buyprice * $f_ppr_qty);
                   $FRc_PPR_ItemProfit_Minus = (($fr_t_profit / $fr_qty) * $f_ppr_qty);
             }else{
                FR_SWAL("QTY NOT VALID", "", "error");
                FR_GO("$FR_THIS_PAGE",3);
                exit;
             }

            //FRD_VC___________________________________________:-
            if ($FRc_PPR_Amount <= $fr_invo_due) {
                $FR_VC_CNRMT_DUE_A = 1;
            } else {
                FR_SWAL("$UsrName You Can Not Entry More Then $fr_invo_due ৳", "", "error");
                FR_GO("$FR_THIS_PAGE",3);
                exit;
            }

            //FRD_VC TRANSACTION AMOUNT DATA __________________________________________:-
            if($FRc_Invo_Stat_x == 4 OR $FRc_Invo_Stat_x == 5 OR $FRc_Invo_Stat_x == 15){
                $FR_VC_STATUS = 1;
            }else{
                FR_SWAL("$UsrName Your Access Denied for Spider Ecommerce System","","error");
                FR_GO("$FR_THIS_PAGE",3);
                exit;
            }
            //FRD_VC TRANSACTION AMOUNT DATA __________________________________________:-
            if($FRc_PPR_Amount > 0 AND is_numeric($FRc_PPR_Amount)){
                $FR_VC_TAN_AMOUNT_D = 1;
            }else{
                FR_SWAL("$UsrName Your Access Denied for Spider Ecommerce System","","error");
                FR_GO("$FR_THIS_PAGE",3);
                exit;
            }

            //FRD_VC___________ THIS USER ADMIN OR NOT:-
            if($UsrType == "ad"){ $FR_VC_ONLYADMIN = 1; }else{ FR_SWAL("Hi $UsrName!","Only Admin Can Do This!","error"); }


            if ($FR_VC_TAN_AMOUNT_D == 1 AND $FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1 AND $FR_VC_CNRMT_DUE_A == 1 AND $FR_VC_ONLYADMIN == 1 AND $FR_VC_QTY == 1 AND $FR_VC_STATUS == 1) {


                try{
                    $FR_CONN->exec("UPDATE frd_order_items SET 
                    fr_ppr_qty = $f_ppr_qty, 
                    fr_ppr_amount = $FRc_PPR_Amount, 
                    fr_qty = (fr_qty - $f_ppr_qty), 
                    fr_t_price = (fr_t_price - $FRc_PPR_Amount),  
                    fr_t_buyprice = (fr_t_buyprice - $FRc_PPR_BuyPrice_Minus),  
                    fr_t_profit = (fr_t_profit - $FRc_PPR_ItemProfit_Minus),  
                    fr_ppr_date = '$FR_NOW_DATE'  
                    WHERE id = $f_ppr_itemid  AND fr_invo_id = $FRc_Invoice_Id_x");

                    //IF ALRADY RECEIVE IN HANK THIS ITEM THEM EXECUTE:-
                        if($f_ppr_status == 1){
                            $FR_CONN->exec("UPDATE frd_order_items SET 
                            fr_pprr_stat = 1,
                            fr_pprr_date = '$FR_NOW_DATE'
                            WHERE id = $f_ppr_itemid AND fr_invo_id = '$FRc_Invoice_Id_x'");
                        }
                    //END>>


                    $FRQ = $FR_CONN->query("SELECT SUM(fr_t_price) AS FRc_T_ItemsSealsPrice, SUM(fr_t_buyprice) AS FRc_T_ItemsTotalBuyPrice, SUM(fr_ppr_amount) AS FRc_T_ItemsPprAmount, SUM(fr_t_profit) AS FRc_T_TtemTotProfit FROM frd_order_items WHERE fr_invo_id = $FRc_Invoice_Id_x");
                    extract($FRQ->fetch());
                    $FR_CONN->exec("UPDATE frd_order_invo SET 
                    fr_pro_total = $FRc_T_ItemsSealsPrice, 
                    fr_pro_buyprice = $FRc_T_ItemsTotalBuyPrice, 
                    fr_ppro_return = $FRc_T_ItemsPprAmount, 
                    fr_invo_profit = $FRc_T_TtemTotProfit 
                    WHERE id = $FRc_Invoice_Id_x");
                        //FRD INVOICE DUE AMOUNT UPDATE START:-
                        $FRR = FRF_UpInvoDueAmount($FRc_Invoice_Id_x, $FRc_Invoice_EncId_x);
                        if ($FRR['FRA'] == 1) {
                            FR_SWAL("Partial Product Return Prosess Done!","","success");
                            FRF_SOUND("PIP");
                            FR_GO("$FR_THIS_PAGE", "3");
                            exit;
                        } else {
                            FR_SWAL("Partial Product Return Prosess Failed!","","success");
                            FR_GO("$FR_THIS_PAGE", "3");
                            exit;
                        }
                        //END>>
                        
                }catch(PDOException $e){
                    FR_SWAL("Partial Product Return Prosess Failedd","","error");
                    echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                    FR_GO("$FR_THIS_PAGE",6);
                    exit;
                }
 
            }
    }
    //END>>


     //FRD Payment Discount Amount AMOUNT:-
     if (isset($_POST['f_PaymentDiscountAmount'])){

            $FR_VC_DATA_PROCESS = "";
            $FR_VC_ARF = ""; //ALL REQUIRED FILD
            $FR_VC_TAN_AMOUNT_D = "";
            $FR_VC_CNRMT_DUE_A = ""; //CAN'T RECEIVE MORE THEN DUE AMOUNT
            $FR_VC_ONLYADMIN = "";//ONLY ADMIN CAN DO THIS

            //FRD POST DATA FILTERING AND MAKING VARIVAL:-
            $f_PaymentDiscountAmount = $_POST['f_PaymentDiscountAmount'];

            //FRD_VC TRANSACTION AMOUNT DATA __________________________________________:-
            if($f_PaymentDiscountAmount > 0 AND is_numeric($f_PaymentDiscountAmount) AND $FRc_Invo_Stat_x == 5 AND $fr_invo_due > 0){
                $FR_VC_TAN_AMOUNT_D = 1;
            }else{
                FR_SWAL("$UsrName Your Access Denied for Spider Ecommerce System","","error");
                FR_GO("$FR_THIS_PAGE",3);
                exit;
            }

            //FRD_VC___________DATA PROSESSED OR NOT:-
            if (isset($f_PaymentDiscountAmount)) {
                $FR_VC_DATA_PROCESS = 1;
            } else {
                FR_SWAL("Data Process Failed", "", "error");
            }
            //FRD_VC___________ALL REQUIRED FILED:-
            if ($f_PaymentDiscountAmount != "") {
                $FR_VC_ARF = 1;
            } else {
                FR_SWAL("Please Fill All Required Field", "", "error");
            }
            //FRD_VC___________________________________________:-
            if ($f_PaymentDiscountAmount <= $fr_invo_due) {
                $FR_VC_CNRMT_DUE_A = 1;
            } else {
                FR_SWAL("$UsrName You Can Not Entry More Then $fr_invo_due ৳", "", "error");
            }
            //FRD_VC___________ THIS USER ADMIN OR NOT:-
            if($UsrType == "ad"){ $FR_VC_ONLYADMIN = 1; }else{ FR_SWAL("Hi $UsrName!","Only Admin Can Do This!","error"); }

            if ($FR_VC_TAN_AMOUNT_D == 1 AND $FR_VC_DATA_PROCESS == 1 AND $FR_VC_ARF == 1 AND $FR_VC_CNRMT_DUE_A == 1 AND $FR_VC_ONLYADMIN == 1) {
                try{
                    $FR_CONN->exec("UPDATE frd_order_invo SET fr_pay_discount = $f_PaymentDiscountAmount WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'");

                        //FRD INVOICE DUE AMOUNT UPDATE START:-
                        $FRR = FRF_UpInvoDueAmount($FRc_Invoice_Id_x, $FRc_Invoice_EncId_x);
                        if ($FRR['FRA'] == 1) {
                            FR_SWAL("Payment Discount Give Done!","","success");
                            FRF_SOUND("PIP");
                            FR_GO("$FR_THIS_PAGE", "1");
                            exit;
                        } else {
                            FR_SWAL("Invoice Due Update Failed!","","success");
                            FR_GO("$FR_THIS_PAGE", "3");
                            exit;
                        }
                        //END>>
                        
                }catch(PDOException $e){
                    FR_SWAL("Payment Discount Give Failed","","error");
                    echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                    FR_GO("$FR_THIS_PAGE",1);
                    exit;
                }
                
            }
    }
    //END>>



    //FRD MAKE STSTUS DELIVERY DONE START:-
    if (isset($_POST['f_MakeDeliveryDone'])){

        $FR_VC_ORDER_CURR_STAT = "";

        $FRc_Stat = 5;

        //FRD_VC______________________________________________;-
        if($FRc_Invo_Stat_x == 2 || $FRc_Invo_Stat_x == 4 || $FRc_Invo_Stat_x == 15){
            $FR_VC_ORDER_CURR_STAT = 1;
        }else{
            FR_SWAL("Dear Boss $UsrName! You Can Not Do It", "(H:KJDJHDY7X)", "error");
            FR_GO("$FR_THIS_PAGE",2);
            exit;
        }


        if($FR_VC_ORDER_CURR_STAT == 1){
            $FRc_OrderProsHistory = "$fr_o_pros_history, আপনার অর্ডার ডেলিভারি সম্পূর্ণ হয়েছে। <small>[By $UsrName]</small> * " . date('d-M-Y h:i A', $FR_NOW_TIME) . "";

            try{
                $FRQ = "UPDATE frd_order_invo SET 
                fr_stat = :fr_stat,
                fr_o_ddone_date = :fr_o_ddone_date,
                fr_o_ddone_time = :fr_o_ddone_time,
                fr_o_ddone_by = :fr_o_ddone_by,
                fr_o_pros_history = :fr_o_pros_history
                WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'";
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
                                    $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 5, fr_o_ddone_date = '$FR_NOW_DATE' WHERE fr_invo_id = $FRc_Invoice_Id_x");
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
                                $FRc_Message = "Dear $fr_cust_name, Your order #$FRc_Invoice_Id_x Delivery Completed. \n\nPlease Give Review  \n\n $FRc_RatingReviewGiveLink";
                                $FRR_SMS = FR_SEND_SMS($fr_cust_mob1, $FRc_Message);
                                if($FRR_SMS['FRA']==1){
                                    FR_TAL("SMS SEND DONE","success");
                                }else{
                                    FR_TAL("SMS SEND FAILED","error");
                                }
                            }

                            if($frsmsc_stc_nodc == 1){
                                extract(FR_USR_MINI_INFO($fr_cust_id));
                                $FRc_Message = "Dear $fr_cust_name, Your order #$FRc_Invoice_Id_x Delivery Completed. Track: $FRD_HURL/track/$FRc_Invoice_EncId_x \n\n $fr_cmobile_1";
                                $FRR_SMS = FR_SEND_SMS($fr_cust_mob1, $FRc_Message);
                                if($FRR_SMS['FRA']==1){
                                    FR_TAL("SMS SEND DONE","success");
                                }else{
                                    FR_TAL("SMS SEND FAILED","error");
                                }
                            }
                        //END>>


                        FR_SWAL("Delivered", "Dear Boss $UsrName", "success");
                        FR_GO("$FR_THIS_PAGE",2);
                    }
                    exit;
            }catch(PDOException $e){
                FR_SWAL("ERROR: Delivery Failed", "Dear Boss $UsrName", "error");
                FR_GO("$FR_THIS_PAGE", "3");
                exit;
            } 

        }
                

    }
    //END>>





    //FRD UPDATE DELIVERY ADDRESS :-
    if (isset($_POST['f_Deli_Name'])) {
        //FRD VC NEED:-
        $FR_VC_DATA_PROCESS = "";
        $FR_VC_ARF = ""; //ALL REQUIRED FILD

        $f_devision = "";
        $f_district = "";
        $f_thana = "";

        //FRD POST DATA FILTERING AND MAKING VARIVAL:-
        $f_Deli_Name = $_POST['f_Deli_Name'];
        $f_Deli_Mobile_1 = $_POST['f_Deli_Mobile_1'];
        $f_Deli_Mobile_2 = $_POST['f_Deli_Mobile_2'];
        $f_Deli_Address = $_POST['f_Deli_Address'];
        $f_cust_order_note = $_POST['f_cust_order_note'];
        
        if(isset($_POST['f_devision'])){ $f_devision = $_POST['f_devision']; }
        if(isset($_POST['f_district'])){ $f_district = $_POST['f_district']; }
        if(isset($_POST['f_thana'])){ $f_thana = $_POST['f_thana']; }

        if(isset($_POST['f_thana'])){ $f_thana = $_POST['f_thana']; }

        //FRD_VC___________DATA PROSESSED OR NOT:-
        if (isset($f_Deli_Name)) {
            $FR_VC_DATA_PROCESS = 1;
        } else {
            FR_SWAL("Data Process Failed", "", "error");
        }
        //FRD_VC___________ALL REQUIRED FILED:-
        if ($f_Deli_Name != "") {
            $FR_VC_ARF = 1;
        } else {
            $FRR['FRA'] = 2;
            FR_SWAL("Please Fill All Required Field", "", "error");
        }


        if ($FR_VC_DATA_PROCESS == 1 and $FR_VC_ARF == 1) {

            $FRQ = "UPDATE frd_order_invo SET 
            fr_cust_name = '$f_Deli_Name',
            fr_cust_mob1 = '$f_Deli_Mobile_1',
            fr_cust_mob2 = '$f_Deli_Mobile_2',
            fr_cust_addres = '$f_Deli_Address',
            fr_cust_o_note = '$f_cust_order_note',
            fr_div = '$f_devision',
            fr_dis = '$f_district',
            fr_tha = '$f_thana'
            WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'";
            $R = FR_DATA_UP("$FRQ");
            if ($R['FRA'] == 1) {

                        //FRD CUSTOMER PROFILE DATA UPDATE START:-
                            if($FRc_Invo_Cust_Id > 1){
                                $FRQ2 = "UPDATE frd_usr SET 
                                namee = '$f_Deli_Name',
                                phon1 = '$f_Deli_Mobile_1',
                                phon2 = '$f_Deli_Mobile_2',
                                addresss = '$f_Deli_Address',
                                fr_usr_div = '$f_devision',
                                fr_usr_dis = '$f_district',
                                fr_usr_tha = '$f_thana'
                                WHERE id = $FRc_Invo_Cust_Id";
                                $R = FR_DATA_UP("$FRQ2");
                                if ($R['FRA'] == 1) {
                                    FR_TAL("Dear Boss $UsrName Customer Profile Data Update Done","success");
                                } else {
                                    FR_TAL("Dear Boss $UsrName Customer Profile Data Update Falied","error");
                                }
                            }
                        //END>>


                    //FRD UPDATE PATHAO CITY,ZONE,AREA START:-
                        if (isset($_POST['fr_pq_city'])) {
                            //FRD VC NEED:-
                            $FR_VC_DATA_PROCESS = "";
                            $FR_VC_ARF = ""; //ALL REQUIRED FILD

                            extract($_POST);

                            $arr = explode('/',$_POST['fr_pq_city']);
                            $fr_pq_city = $arr[0];
                            $fr_pq_city_n = $arr[1];

                            $arr = explode('/',$_POST['fr_pq_zone']);
                            $fr_pq_zone = $arr[0];
                            $fr_pq_zone_n = $arr[1];

                            $arr = explode('/',$_POST['fr_pq_area']);
                            $fr_pq_area = $arr[0];
                            $fr_pq_area_n = $arr[1];
                            
                            //FRD_VC___________DATA PROSESSED OR NOT:-
                            if (isset($fr_pq_city)) {
                                $FR_VC_DATA_PROCESS = 1;
                            } else {
                                FR_SWAL("Data Process Failed", "", "error");
                            }
                            //FRD_VC___________ALL REQUIRED FILED:-
                            if ($fr_pq_city != "") {
                                $FR_VC_ARF = 1;
                            } else {
                                $FRR['FRA'] = 2;
                                FR_SWAL("Please Fill All Required Field", "", "error");
                            }

                            if ($FR_VC_DATA_PROCESS == 1 and $FR_VC_ARF == 1) {
                                //FRD DATA UPDATE S:-
                                try{
                                    $FRQ = "UPDATE frd_order_invo SET 
                                    fr_pq_city = :fr_pq_city,
                                    fr_pq_zone = :fr_pq_zone,
                                    fr_pq_area = :fr_pq_area,
                                    fr_pq_city_n = :fr_pq_city_n,
                                    fr_pq_zone_n = :fr_pq_zone_n,
                                    fr_pq_area_n = :fr_pq_area_n
                                    WHERE id = $FRc_Invoice_Id_x  AND fr_enc_id = '$FRc_Invoice_EncId_x'";
                                    $FRQ = $FR_CONN->prepare("$FRQ");
                                    $FRQ->bindParam(':fr_pq_city', $fr_pq_city, PDO::PARAM_INT);
                                    $FRQ->bindParam(':fr_pq_zone', $fr_pq_zone, PDO::PARAM_INT);
                                    $FRQ->bindParam(':fr_pq_area', $fr_pq_area, PDO::PARAM_INT);
                                    $FRQ->bindParam(':fr_pq_city_n', $fr_pq_city_n, PDO::PARAM_STR);
                                    $FRQ->bindParam(':fr_pq_zone_n', $fr_pq_zone_n, PDO::PARAM_STR);
                                    $FRQ->bindParam(':fr_pq_area_n', $fr_pq_area_n, PDO::PARAM_STR);
                                    $FRQ->execute();
                                    FR_TAL("Dear Boss $UsrName! Pathao City,Zone,Area Update Done","success");
                                }catch(PDOException $e){
                                    FR_TAL("$UsrName Pathao City,Zone,Area Update Failed","error");
                                    echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
                                }
                                //END>>
                                
                            }

                        }
                    //UPDATE PATHAO CITY,ZONE,AREA END>>


                FR_SWAL("Dear Boss $UsrName", "তথ্য আপডেট হয়েছে", "success");
                FR_GO("$FR_THIS_PAGE", "1");
                exit;
            } else {
                FR_SWAL("Dear Boss $UsrName", "আপডেট হয়নি ", "error");
                FR_GO("$FR_THIS_PAGE", "3");
                exit;
            }

        }

    }
    //END>>



  
    //FRD ITEMS PLUS MINUS INI:-
    if (isset($_POST['ItemPlusMinusIni'])) {
        

          $FRc_VC_InvoStat = "";
          $FRc_VC_CustomerStat = "";
          if($FRc_Invo_Stat_x == 1){ $FRc_VC_InvoStat = 1; }else{ FR_SWAL("INVOICE STATUS NOT VALID","","error"); }
          if($FRc_Invo_Cust_Id > 1){ $FRc_VC_CustomerStat = 1; }else{ FR_SWAL("Guest Customer Not Allowed! 1st Register This Customer!","","error"); }


        if($FRc_VC_InvoStat == 1 AND $FRc_VC_CustomerStat == 1){

            try{
                $FR_CONN->exec("UPDATE frd_order_invo SET fr_stat = 0 WHERE id = $FRc_Invoice_Id_x AND fr_enc_id = '$FRc_Invoice_EncId_x'");
                $FR_CONN->exec("UPDATE frd_order_items SET fr_stat = 0 WHERE fr_invo_id = $FRc_Invoice_Id_x AND fr_stat = 1");

                $_SESSION['FRs_Invo_Token'] = $FRc_Invoice_Id_x;
                $_SESSION['FRs_Invo_EncId'] = "$FRc_Invoice_EncId_x";
                $_SESSION['FRs_CartOpen'] = 1;
                $_SESSION['FRs_ItmePlusMinus'] = 1;
                $_SESSION['FRs_ItmePlusMinus_Note'] = "$fr_cust_o_note";
                $_SESSION['FRs_ItmePlusMinus_DeliCharge'] = $fr_ship_cost;

                if($FRc_Invo_Cust_Id > 1){
                    $FRR = FRF_LoginCustomerP($FRc_Invo_Cust_Id);
                    if($FRR['FRA'] == 1){
                        FR_TAL("CUSTOMER LOGIN DONE","success");
                    }else{
                        FR_TAL("CUSTOMER LOGIN FAILED","error");
                    }
                }

                FR_SWAL("$UsrName Taking you to the front panel","","info");
                FR_GO("$FRD_HURL/products?CartOpen=1",2);

            }catch(PDOException $e){
                FR_SWAL("ORDER ITEMS DATA UPDATE FAILED","","error");
                FR_SWAL("ORDER INVOICE DATA UPDATE FAILED","","error");
                echo "FRD ERROR MESSAGE:" . $e->getMessage() . "<br>";
            }


        }
          


    }
    //END>>

    SCRIPT_LAST:
    ?>
</section>
<!-- 1 SCRIPT E-->






<section class="section">
    <div class="container">
        <div class="col-md-11">
            <!-- PUBLIC TRIGERS -->
            <div class="row">
                <div class="col-md-12">
                    <div class="text-left">
                        <?php
                        echo "<a href='$FR_THISHURL/om-OPS1' class='btn btn-danger btn-xs h3 text-center'><i class='glyphicon glyphicon-arrow-left'></i> Invoice List</a> &nbsp;";
                        
                        echo "<a href='$FRD_HURL/frdsp/dp/om-BulkInvoicePrint/$fr_enc_id' class='btn btn-info btn-xs h3 text-center' target='_blank'><i class='glyphicon glyphicon-print'></i> Print Invoice </a> &nbsp;";
                        echo "<a href='$FRD_HURL/label/L1/$fr_enc_id' class='btn btn-info btn-xs h3 text-center' target='_blank'><i class='glyphicon glyphicon-print'></i> Label 1</a> &nbsp;";
                        echo "<a href='$FRD_HURL/label/L2/$fr_enc_id' class='btn btn-info btn-xs h3 text-center' target='_blank'><i class='glyphicon glyphicon-print'></i> Label 2</a> &nbsp;";
                        echo "<a href='$FRD_HURL/track/$fr_enc_id' class='btn btn-success btn-xs h3 text-center' target='_blank'><i class='glyphicon glyphicon-sunglasses'></i></a> &nbsp; ";

                        echo "<a href='tel:$fr_cust_mob1' class='btn btn-success btn-xs h3 text-center' target='_self'><i class='glyphicon glyphicon-earphone'></i></a> &nbsp;";

                        echo "<button class='btn btn-success btn-xs FR_MODEL_GF_OrderProsessNote h3'><i class='glyphicon glyphicon-plus'></i> Add Note</button> &nbsp;";
                        
                        if($fr_c_stat == 0){
                            echo "<button class='btn btn-primary btn-xs FR_MODEL_GF_ComplainNote h3'><i class='glyphicon glyphicon-plus'></i> Add Complain</button> &nbsp;";
                        }
                        ?>
                    </div>
                </div>
            </div>
            <br>

            <div class="row">
                <div class="col-md-3">
                    <!-- PRIVETS TRIGERS START -->    
                    <div>
                    <?php if($FRc_PrivetTrigers == 1){ ?>
                        <div class="fr-p-5 text-center">
                            <?php echo "$FRc_InvoStatus_HTML"; ?>
                        </div>

                            <br>
                            <?php if ($FRc_Invo_Stat_x != 0 and $FRc_Invo_Stat_x != 5 and $FRc_Invo_Stat_x != 7 and $FRc_Invo_Stat_x != 8) { ?>
                                <div class="alert alert-success">
                                    <div class="card-body pt-3">
                                        <form action="" method="POST">
                                            <select class="form-control" id="" class="form-select" role="button" name="f_InvoiceNewStatus" onchange="this.form.submit()" required>
                                                <option value=""> Change Invoice Status </option>
                                                <?php if ($FRc_Invo_Stat_x == 1 || $FRc_Invo_Stat_x == 6 || $FRc_Invo_Stat_x == 9 || $FRc_Invo_Stat_x == 10) { ?>
                                                    <option title="Processing Start" value="<?php echo base64_encode("2"); ?>"> Confirmed </option>
                                                <?php } ?>
                                                <?php if ($FRc_Invo_Stat_x == 1 || $FRc_Invo_Stat_x == 6) { ?>
                                                    <option value="<?php echo base64_encode("10"); ?>"> Payment Pending  (will pay)</option>
                                                <?php } ?>
                                                <?php if ($FRc_Invo_Stat_x == 2 || $FRc_Invo_Stat_x == 12) { ?>
                                                    <option value="<?php echo base64_encode("11"); ?>"> Print complete </option>
                                                <?php } ?>
                                                <?php if ($FRc_Invo_Stat_x == 2 || $FRc_Invo_Stat_x == 11) { ?>
                                                    <option value="<?php echo base64_encode("3"); ?>"> Packaging complete </option>
                                                <?php } ?>
                                                <?php if ($FRc_Invo_Stat_x == 2 || $FRc_Invo_Stat_x == 11 || $FRc_Invo_Stat_x == 3) { ?>
                                                    <option value="<?php echo base64_encode("12"); ?>"> Entry complete </option>
                                                <?php } ?>
                                                <?php if ($FRc_Invo_Stat_x == 2 || $FRc_Invo_Stat_x == 11 || $FRc_Invo_Stat_x == 12) { ?>
                                                    <option value="<?php echo base64_encode("13"); ?>"> Stock out </option>
                                                <?php } ?>
                                                <?php if ($FRc_Invo_Stat_x == 2 || $FRc_Invo_Stat_x == 11 || $FRc_Invo_Stat_x == 12) { ?>
                                                    <option value="<?php echo base64_encode("14"); ?>"> Schedule </option>
                                                <?php } ?>
                                                <?php if ($FRc_Invo_Stat_x == 2 || $FRc_Invo_Stat_x == 3 || $FRc_Invo_Stat_x == 11 || $FRc_Invo_Stat_x == 12 || $FRc_Invo_Stat_x == 13 || $FRc_Invo_Stat_x == 14){ ?>
                                                    <option value="<?php echo base64_encode("4"); ?>"> Shipped </option>
                                                <?php } ?>

                                                <?php if ($FRc_Invo_Stat_x == 4 || $FRc_Invo_Stat_x == 15){ ?>
                                                    <option value="<?php echo base64_encode("5"); ?>"> Delivered </option>
                                                <?php } ?>
                                                <?php if ($FRc_Invo_Stat_x == 4 || $FRc_Invo_Stat_x == 15){ ?>
                                                    <option value="<?php echo base64_encode("7"); ?>"> Delivery Failed </option>
                                                <?php } ?>
                                                <?php if ($FRc_Invo_Stat_x == 4){ ?>
                                                    <option value="<?php echo base64_encode("15"); ?>"> Partial Delivery Pending </option>
                                                <?php } ?>

                                                <?php if ($FRc_Invo_Stat_x == 1 || $FRc_Invo_Stat_x == 10) { ?>
                                                    <option value="<?php echo base64_encode("6"); ?>"> Keep Hold </option>
                                                <?php } ?>

                                                <?php if ($FRc_Invo_Stat_x == 1 || $FRc_Invo_Stat_x == 6 || $FRc_Invo_Stat_x == 9 || $FRc_Invo_Stat_x == 10) { ?>
                                                    <option value="<?php echo base64_encode("8"); ?>"> Do Canceled </option>
                                                <?php } ?>

                                                <?php if ($FRc_Invo_Stat_x == 1) { ?>
                                                    <option value="<?php echo base64_encode("9"); ?>" class="FR_MODEL_GF_CanceledOrder"> Pre-Confirmed </option>
                                                <?php } ?>


                                            </select>
                                        </form>
                                    </div>
                                </div>
                            <?php } ?>


                            
                            <?php
                               if($frplug_SMSs == 1){
                                echo "<button class='btn btn-success btn-xs btn-block mt-10 FR_MODEL_GF_SendCustomSMS'><span class='glyphicon glyphicon-send'></span> Send SMS To Customer</button> &nbsp;";
                               }
                               

                                echo "
                                <form class='' action='$FR_THISHURL/om-BulkInvoicePrint' method='POST' target='_blank'>
                                <button name='f_chacked_orders_id[]' value='$FRc_Invoice_Id_x' type='submit' class='btn btn-primary btn-block btn-xs'> <span class='glyphicon glyphicon-print'></span> Print Invoice </button>
                                </form>
                                ";
                

                                if($FRc_Invo_Stat_x == 1 || $FRc_Invo_Stat_x == 6 || $FRc_Invo_Stat_x == 10){ 
                                    echo "<button class='btn btn-danger btn-xs btn-block mt-10 FR_MODEL_UpCouponDiscount'><span class='glyphicon glyphicon-edit'></span> Give Discount</button> &nbsp;";
                                }

                                if($FRc_Invo_Stat_x > 1 AND $fr_invo_due > 0){ 
                                    echo "<button class='btn btn-success btn-xs btn-block FR_MODEL_UpAdvanceReceiv mt-10'><span class='glyphicon glyphicon-edit'></span> Payment Receive</button> &nbsp;";
                                }
                                if($fr_invo_due > 0 AND $FRc_Invo_Stat_x == 5 OR $FRc_Invo_Stat_x == 7){ 
                                    echo "<button class='btn btn-primary btn-xs btn-block FR_MODEL_CODReceivedAmount mt-10'><span class='glyphicon glyphicon-edit'></span> COD Receive</button> &nbsp;";
                                }
                                if($fr_invo_due > 0 AND $FRc_Invo_Stat_x == 4 OR $FRc_Invo_Stat_x == 5 || $FRc_Invo_Stat_x == 15){ 
                                    echo "<button class='btn btn-danger btn-xs btn-block Frtrig_PPR_INI'><span class='glyphicon glyphicon-edit'></span> Partial Product Return</button>";
                                }
                                if($fr_invo_due > 0 AND $FRc_Invo_Stat_x == 5){ 
                                    echo "<button class='btn btn-danger btn-xs btn-block FR_MODEL_PaymentDiscount mt-10'><span class='glyphicon glyphicon-edit'></span> Payment Discount </button> &nbsp;";
                                }
                                if ($FRc_Invo_Stat_x == 2) {
                                    echo "<button class='btn btn-danger btn-xs btn-block FR_MODEL_GF_DeliveryDone mt-10'><span class='glyphicon glyphicon-flash'></span> Cross Delivery Done </button>";
                                }
                                ?>



                            <form class="mt-10 alert alert-info" action="" method="POST">
                                <small title="Order Assigned">Assigned</small>
                                <select class='form-control' id="f_OrderAssignUserId" name='f_OrderAssignUserId' role="button" onchange="this.form.submit()" required>
                                    <?php
                                    echo "<option value='$fr_o_a_usrid'>$fr_o_a_usrid_NAME</option>";
                                    $FRR = FR_QSEL("SELECT id AS FRc_ThisId,namee AS FRc_ThisName FROM frd_usr WHERE statuss = 1 AND typee IN('ad','M','x','OCA') ORDER BY id ASC", "ALL");
                                    if ($FRR['FRA'] == 1){
                                        foreach ($FRR['FRD'] as $FR_ITEM){
                                            extract($FR_ITEM);
                                            echo "<option value='$FRc_ThisId'>$FRc_ThisName</option>";
                                        }
                                    } else {
                                        PR($FRR);
                                    }
                                    ?>
                                </select>
                            </form>


        
                            <?php if ($FRc_Invo_Stat_x != 4 AND $FRc_Invo_Stat_x != 5 AND $FRc_Invo_Stat_x != 7){ ?>
                            <form class="mt-10 alert alert-warning" action="" method="POST">
                                <small title="Order Assigned">Delivery Partner</small>
                                <select class='form-control' id="f_DeliveryPartnerId" name='f_DeliveryPartnerId' role="button" onchange="this.form.submit()" required>
                                    <?php
                                    echo "<option value='$fr_ship_p_id'>$fr_ship_p_id_NAME</option>";
                                    echo FRF_OPTION_SHIP_PART();
                                    ?>
                                </select>
                            </form>
                            <?php } ?>



                            <?php if ($FRc_Invo_Stat_x != 4 AND $FRc_Invo_Stat_x != 5 AND $FRc_Invo_Stat_x != 7){ ?>
                                <form class="mt-10 alert alert-warning" action="" method="POST">
                                    <small>Schedule Delivery Date</small><br>
                                    <small><?php echo "" . date('d-M-Y', strtotime("$fr_o_schedule_date")) . ""; ?></small>
                                    <input type="date" class="form-control" name="FRTRIG_ScheduleDeliDate" value="<?php echo "$fr_o_schedule_date"; ?>" onchange="this.form.submit()" required>
                                </form>
                            <?php } ?>



                      

                            


                            <?php if($FRc_Invo_Stat_x == 9){ ?>
                            <form class="mt-10" action="" method="POST">
                                <small>Pre-Confirm Schedule Date</small>
                                <input type="date" class="form-control" name="f_fr_o_pre_conf_sdate" value="<?php echo "$fr_o_pre_conf_sdate"; ?>" onchange="this.form.submit()" required>
                            </form>
                            <?php } ?>
                            

                        
                            <?php if ($FRc_Invo_Stat_x == 2 || $FRc_Invo_Stat_x == 6 || $FRc_Invo_Stat_x == 8 || $FRc_Invo_Stat_x == 9 || $FRc_Invo_Stat_x == 10) { ?>
                                <br><br><br><br>
                                <form action="" method="POST">
                                    <input type="checkbox" required> I am vary sure!
                                    <button type="submit" class="btn btn-danger btn-xs btn-block" name="f_InvoiceNewStatus" value="<?php echo base64_encode("1"); ?>"> ⇦ Send It Again New Order </button>
                                </form>
                            <?php } ?>
                            <?php 
                            if ($UsrType == "ad"){
                                if($FRc_Invo_Stat_x == 3 || $FRc_Invo_Stat_x == 11){
                                ?>
                                <br><br><br><br>
                                <form action="" method="POST">
                                    <input type="checkbox" required> I am vary sure!
                                    <button type="submit" class="btn btn-danger btn-xs btn-block" name="f_InvoiceNewStatus" value="<?php echo base64_encode("1"); ?>"> ⇦ Send It Again New Order (ForAdmin) </button>
                                </form>
                            <?php }  } ?>
                            <?php 
                            if ($UsrType == "ad") {
                                if($FRc_Invo_Stat_x == 3 || $FRc_Invo_Stat_x == 13 || $FRc_Invo_Stat_x == 14){
                            ?>
                                <br>
                                <button class="btn btn-danger btn-xs btn-block FR_MODEL_GF_CanceledOrder"><span class='glyphicon glyphicon-flash'></span> Do Canceled (ForAdmin) </button>
                                <br>
                            <?php }} ?>
                    <?php } ?>
                    </div> 
                    <!-- PRIVETS TRIGERS END --> 



                             <br><br>
                             <!-- ORDER PROSESS NOTE   -->
                             <div id='timeline_div'>
                                <ul class='timeline'>
                                    <?php
                                    $FRR = FR_QSEL("SELECT * FROM frd_order_p_note WHERE fr_opn_order_id = $FRc_Invoice_Id_x ORDER BY id DESC","ALL");
                                    if($FRR['FRA']==1){  

                                         echo "<h4 class='boldd'> Order Prosess Note </h4> <br>";
                                    
                                            $FRc_Class = "active_event";
                                            foreach($FRR['FRD'] as $FR_ITEM){
                                                extract($FR_ITEM);
                                                $FRc_OPN_Time = date('d-M-Y h:i A',$fr_opn_time);

                                                    echo "
                                                    <li class='event $FRc_Class' data-date='$FRc_OPN_Time'>
                                                        <h1>$fr_opn_note <small>[By $fr_opn_by_name]</small></h1>
                                                    </li>
                                                    ";
                                
                                                $FRc_Class = "";
                                            }

                                    } else{ 
                                        echo "No Note Found";
                                    }
                                    ?>
                                </ul>
                            </div>
                            <br><br>


                            <!-- ORDER-TRACKING-TIMELINE  -->
                               <hr>
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title boldd"> অর্ডার ট্রাকিং </h4>
                                        <div id="content">
                                            <ul class="timeline">
                                                <?php
                                                $FRc_fr_o_pros_history_ARR = explode(",", $fr_o_pros_history);
                                                $FRc_fr_o_pros_history_ARR_REV = array_reverse($FRc_fr_o_pros_history_ARR);

                                                $FRc_Class = "active_event";
                                                foreach ($FRc_fr_o_pros_history_ARR_REV as $FR_ITEM) {

                                                    if ($FR_ITEM != "") {
                                                        $FR_ITEM_ARR = explode("*", $FR_ITEM);
                                                        echo "
                                                    <li class='event $FRc_Class' data-date='$FR_ITEM_ARR[1]'>
                                                        <h1>$FR_ITEM_ARR[0]</h1>
                                                        <p></p>
                                                    </li>
                                                    ";
                                                    }

                                                    $FRc_Class = "";
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                </div>


                <div class="col-md-6 jumbotron">
                    <!-- INVOICE START -->
                    <section>
                        <div class="containerrrr"> 

                            <div class="row">
                                <div class="col-xs-12">

                                    <img id="invoice_bandlogu" src="<?php echo "$FRD_HURL/frd-data/img/brandlogu/$fr_clogo"; ?>" alt="" class="img-responsive Frtrig_GoHP" role="button">
                                    <div class="TAC">
                                        <?php
                                        echo "
                                            <b>$fr_cname </b><br>
                                            মোবাইল নাম্বারঃ $fr_cmobile_1  |
                                            ঠিকানাঃ  $fr_caddress_1
                                            ";
                                        ?>
                                    </div>

                                    <table class="table table-bordered">
                                        <tr>
                                            <td width="50%">
                                                <?php
                                                $barcode_frd = $FRc_Invoice_Id_x;
                                                require_once($FR_PATH_HD . "frd-src/inc/php/barcode_configar_frd.php");
                                                echo "$Barcode_FRD";
                                                ?>
                                                <h4><?php echo "ইনভয়েস: <b>#$FRc_Invoice_Id_x</b>" ?></h4>
                                                <?php
                                                echo "
                                                <div> স্ট্যাটাস:<b>$FRc_InvoStatus_HTML</b> </div>
                                                <small>
                                                অর্ডার টাইমঃ <b>" . date('Y-M-d h:i a', $fr_o_time) . "</b> <br>
                                                অর্ডার প্লেস করেছে: <b>$FRc_OrderPlaceByUser_HTML</b>
                                                </small>
                                                ";
                                                ?>
                                                 <small><?php echo "Assigned: <b>$fr_o_a_usrid_NAME</b>";?></small><br>
                                                 <small><?php echo "Delivery Partner: <b>$fr_ship_p_id_NAME</b>";?></small>
                                                 <br>
                                                 <?php echo "$FRc_PaymentStatus_HTML";?>
                                            </td>
                                            <td width="50%" class="TAR">
                                                <span class="delivery_address FR_MODEL_GF_DeliveryAddress" role="button">
                                                    <?php
                                                    echo "
                                                    <b> পণ্য ডেলিভারি ঠিকানাঃ </b> <br>
                                                        নামঃ $fr_cust_name <br> 
                                                        মোবাইল নাম্বারঃ $fr_cust_mob1 $fr_cust_mob2 <br>
                                                        ঠিকানাঃ $fr_cust_addres <br>
                                                        বিভাগ: $fr_div_M <br>
                                                        জেলা: $fr_dis_M <br>
                                                        থানা: $fr_tha_M <br>
                                                        নোট: $fr_cust_o_note <br>
                                                        $FRc_OrderType_HTML
                                                        $FRc_Pathao_CityZonearea_Text 
                                                    ";
                                                    ?>

                                                  <?php if($FRc_Invo_Stat_x == 1 || $FRc_Invo_Stat_x == 6){ echo "<span class='glyphicon glyphicon-edit FR_MODEL_GF_DeliveryAddress'></span>";}?>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Weigth:</td>
                                            <td>
                                               <?php echo "$fr_weight KG";?>
                                               <?php if($FRc_Invo_Stat_x == 1 || $FRc_Invo_Stat_x == 6){ echo "<span class='glyphicon glyphicon-edit FR_MODEL_GF_UpdateWeight'></span>";}?>
                                            </td>
                                        </tr>
                                    </table>

                                </div>
                            </div>

                           


                            <div class="row"><!-- INVOICE-ITEMS -->
                                <div class="col-md-12">
                                    <?php
                                    //FRD  DATA:-
                                    echo "<table class='invoice'>";
                                    $FRR = FR_QSEL("SELECT * FROM frd_order_items WHERE fr_invo_id = $FRc_Invoice_Id_x ", "ALL");
                                    if ($FRR['FRA'] == 1) {
                                        foreach ($FRR['FRD'] as $FR_ITEM) {
                                            extract($FR_ITEM);

                                            //FRD COLOE NAME FINDER:-
                                            extract(FRF_COLOR_NAME($r_color));
                                            $FRsd_ProColorName = $FRc_COLOR_NAME;
                                            if ($FRsd_ProColorName == "N/A") {
                                                $FRsd_ProColorName_LM = "";
                                            } else {
                                                $FRsd_ProColorName_LM = " | Color: $FRsd_ProColorName";
                                            }

                                            //PRODUCT SKU FINDER:-
                                            $FRQ = $FR_CONN->query("SELECT skuu FROM frd_products WHERE id = $fr_pro_id");
                                            $row_pskuf = $FRQ->fetch();
                                            $frd_sv_pro_sku = $row_pskuf['skuu'];
                                            if ($frd_sv_pro_sku == "") {
                                                $frd_sv_pro_sku_lmody = "";
                                            } else {
                                                $frd_sv_pro_sku_lmody = "| <b> SKU: </b>$frd_sv_pro_sku";
                                            }

                                            //ORDER SIZE CUSTOMIZE:- 
                                            if ($fr_size_name == "") {
                                                $OI_size_name_lmody = "";
                                            } else {
                                                $OI_size_name_lmody = " | সাইজঃ $fr_size_name";
                                            }


                                            echo "
                                        <tr>
                                            <td width='10%'><img src='$FRD_HURL/frd-data/img/product/$fr_pro_pic_1' alt=''> </td>
                                            
                                            <td width='70%'>
                                            <span> <b>পণ্য:</b> $fr_pro_title $OI_size_name_lmody $FRsd_ProColorName_LM $frd_sv_pro_sku_lmody | IID: #$id | PID: #$fr_pro_id </span>
                                            </td>
                                            
                                            <td width='20%' class='TAR'>
                                                <span> $fr_qty x " . number_format($fr_price) . "৳</span> <br>
                                                <span>" . number_format($fr_t_price) . "৳</span> 

                                                <form class='formppr' action='' method='POST'>
                                                    <input type='number' name='f_ppr_qty' placeholder='Enter Return Qty' required> 
                                                    <select class='form-control btn-xs' name='f_ppr_status' id='' required>
                                                        <option value='0'>PPR Comming Back</option>
                                                        <option value='1'>PPR Received In Hand Already</option>
                                                    </select>
                                                    <input type='hidden' name='f_ppr_itemid' value='$id'>
                                                    <button type='submit' class='btn btn-success btn-xs btn-block mb-5'> <span class='glyphicon glyphicon-flash'></span> Confirm </button>
                                                </form>
                                            </td>
                                        </tr>
                                        ";
                                        }
                                    } else {
                                        PR($FRR);
                                    }
                                    echo "</table>";
                                    //END>
                                    ?>
                                </div>
                            </div>


                            <?php if ($fr_ppro_return > 0) { ?>
                            <div class="row">
                                <div class="col-md-12">
                                   
                                    <?php
                                    //FRD  DATA:-
                                    echo "<table class='t_print mt-10'>";
                                    $FRR = FR_QSEL("SELECT * FROM frd_order_items WHERE fr_invo_id = $FRc_Invoice_Id_x AND fr_ppr_qty > 0", "ALL");
                                    if ($FRR['FRA'] == 1) {
                                        foreach ($FRR['FRD'] as $FR_ITEM) {
                                            extract($FR_ITEM);

                                            if($fr_pprr_stat == 1){ 
                                               $fr_pprr_stat_M = "<span class='label label-success'> PPR Received </span>"; 
                                            }
                                            else{
                                                $fr_pprr_stat_M = "<span class='label label-danger'> PPR Coming </span>"; 
                                            }
                                

                                        echo "
                                        <tr class='text-center boldd text-danger'>
                                            <td colspan='3'>Partial Products Return</td>
                                        </tr>
                                        ";
                                        echo "
                                        <tr>
                                            <td><img src='$FRD_HURL/frd-data/img/product/$fr_pro_pic_1' alt='#' width='50px' height='50px'> </td>
                                            <td><span>$fr_pro_title </span> $fr_pprr_stat_M </td>
                                            
                                            <td class='TAR'>
                                                <span> $fr_ppr_qty x " . number_format($fr_price,2) . "৳</span> =
                                                <span>" . number_format($fr_ppr_amount,2) . "৳</span>
                                            </td>
                                        </tr>
                                        ";
                                        }
                                    } else {
                                        // PR($FRR);
                                        // echo "NO PPR FOUND";
                                    }
                                    echo "</table>";
                                    //END>
                                    ?>
                                </div>
                            </div>
                            <?php } ?>


                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-lg-6">

                                </div>

                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 col-lg-6">
                                    <table id="invoice_summary" class="" role="button">
                                        <tr>
                                            <td> পণ্যের মূল্য </td>
                                            <td class="TAR"><?php echo number_format($fr_pro_total, 2) . " ৳"; ?></td>
                                        </tr>
                                        <tr>
                                            <td> ডেলিভারি চার্জ (+)</td>
                                            <td class="TAR FR_MODEL_UpDeliveryCharge">
                                            <?php if($FRc_Invo_Stat_x == 1 || $FRc_Invo_Stat_x == 6 || $FRc_Invo_Stat_x == 10){ echo "<span class='glyphicon glyphicon-edit text-success FR_MODEL_UpDeliveryCharge'></span>";}?>
                                                 <?php echo number_format($fr_ship_cost, 2); ?> ৳</td>
                                        </tr>
                                        <tr>
                                            <td>মোট = </td>
                                            <td class="TAR"><?php echo number_format($fr_sub_total, 2); ?> ৳</td>
                                        </tr>
                                        <?php if ($fr_cupo_discount > 0) { ?>
                                        <tr>
                                            <td> কুপন ছাড় (-)</td>
                                            <td class="TAR"><?php echo number_format($fr_cupo_discount, 2) . " ৳"; ?></td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td> পরিশোধযোগ্য = </td>
                                            <td class="TAR"><?php echo number_format($fr_payable, 2); ?> ৳</td>
                                        </tr>
                                        <tr>
                                            <td> পরিশোধ (-)</td>
                                            <td class="TAR"><?php echo number_format($fr_payment, 2); ?> ৳</td>
                                        </tr>
                                        <?php if ($fr_pay_discount > 0) { ?>
                                            <tr>
                                                <td> পেমেন্ট ছাড় (-)</td>
                                                <td class="TAR"><?php echo number_format($fr_pay_discount, 2); ?> ৳</td>
                                            </tr>
                                        <?php } ?>
                                        <tr>
                                            <td> বাকি আছে </td>
                                            <td class="TAR"><?php echo number_format($fr_invo_due, 2); ?> ৳</td>
                                        </tr>
                                    </table>

                                    <?php if ($fr_invo_due > 0) { ?>
                                        <br>
                                        <h2 class="TAC r boldd"> কন্ডিশনঃ <?php echo number_format($fr_invo_due); ?> ৳</h2>
                                    <?php } ?>

                                </div>
                            </div>


                        </div>
                    </section>
                    <!-- INVOICE E  -->


                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <?php 
                                     $FRR = FR_QSEL("SELECT * FROM frd_mtl WHERE fr_invo_id = $FRc_Invoice_Id_x ORDER BY id ASC","ALL");
                                     if($FRR['FRA']==1){ 
                                            echo "<div class='table-responsive'>";
                                            echo "<table class='t_print'>";
                                            echo "
                                                <tr class='alert alert-info boldd'>
                                                    <td>SL</td>
                                                    <td>TTID</td>
                                                    <td>Transaction Date</td>
                                                    <td>Transaction Type</td>
                                                    <td>Note</td>
                                                    <td>Payment Gateway</td>
                                                    <td>Tran ID</td>
                                                    <td>Bank Account</td>
                                                    <td class='text-right'> Amount</td>
                                                </tr>
                                            ";
                                     
                                                    $FRc_SL = 1;
                                                    $FRc_FT_Payment = 0;
                                                    foreach($FRR['FRD'] as $FR_ITEM){
                                                        extract($FR_ITEM);
                                                        extract(FRF_MTL_TRANS_TYP($fr_trn_typ));

                                                        if($fr_rvs_stat == 1){
                                                            $FRc_FT_Payment = ($FRc_FT_Payment + $fr_trn_amount);
                                                            $FRc_c1 = "alert alert-success";
                                                        }else{
                                                            $FRc_c1 = "fr-line-del font10px"; 
                                                        }

                                                            echo "
                                                                <tr class='$FRc_c1'>
                                                                    <td>$FRc_SL</td>
                                                                    <td>$id</td>
                                                                    <td>".date('D, d-M-Y h:i A',$fr_time)."</td>
                                                                    <td>$FRc_MTL_TRANS_TYP</td>
                                                                    <td>$fr_note</td>
                                                                    <td>$fr_pay_gtw_name</td>
                                                                    <td>$fr_trn_id</td>
                                                                    <td>$fr_b_name($fr_b_ac_number)</td>
                                                                    <td class='text-right'> $fr_trn_amount"."৳</td>
                                                                </tr> 
                                                            ";
                                                        $FRc_SL = ($FRc_SL + 1);
                                                        
                                                    }

                                                    echo "
                                                    <tr class='alert alert-info boldd'>
                                                        <td colspan='8'>Total Received:</td>
                                                        <td class='text-right'> ".number_format($FRc_FT_Payment,2)."৳</td>
                                                    </tr> 
                                                    ";
                                            
                                            echo "</table>";
                                            echo "</div>";
                                     } else{ 
                                       echo "<div class='text-center alert alert-danger'>No Transaction Found</div>";
                                     }
                                    ?>
                                </div>
                            </div>


                    <?php if($FRc_Invo_Stat_x == 1 AND $FRc_Invo_Cust_Id > 1){ ?>
                    <hr>
                    <form action="" method="POST" class="">
                      <input type="checkbox" required> I am very sure! <br>
                      <input type="checkbox" required> And I know if I activate it once then I must again place the order otherwise this order will be canceled automatically. <br>
                      <button type="submit" class="btn btn-primary" name="ItemPlusMinusIni"><i class='glyphicon glyphicon-plus'></i> <i class='glyphicon glyphicon-minus'></i> Items </button>
                    </form>
                    <?php } ?>

                </div>

                <div class="col-md-3">

                        <!-- CUSTOMER MITI PROFILE  -->
                        <div class="CustMiniProfile">
                            <?php
                            
                            if(isset($FRc_CustomerId)){
                            if($frsc_cust_m_panel == 1){
                                echo "
                                <table class='table table-bordered'>
                                    <tr class='text-center'>
                                        <td colspan='2'>
                                        <img src='$FRD_HURL/frd-data/img/customer/$picc' alt='' height='60px' width='auto' class='img-circle'><br>
                                        <span class='label $FR_cc1 m-5'> $fr_stat_M </span>
                                        <a href='$FR_SP_HURL_DP/crm-CustomerEdit/?editid=$FRc_CustomerId' target='_blank' class='text-decoration-none btn btn-primary btn-xs m-5'> <i class='glyphicon glyphicon-pencil'></i></a> 

                                            <form action='' method='POST' target='_blank'>
                                                <button name='FRTRIG_CP_LOGIN' type='submit' class='btn btn-danger btn-xs btn-block'> <span class='glyphicon glyphicon-flash'></span> Login </button>
                                            </form>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Customer ID</td>
                                        <td>#$FRc_CustomerId</td>
                                    </tr>
                                    <tr>
                                        <td>Name</td>
                                        <td>$namee</td>
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td>$genderr_M</td>
                                    </tr>
                                    <tr>
                                        <td><span class='glyphicon glyphicon-earphone'></span> Mobile</td>
                                        <td>
                                        <a href='tel:$email1' class='fr-text-deco-none fr-color-111'>$email1</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><span class='glyphicon glyphicon-envelope'></span> Email</td>
                                        <td>
                                        <a href='mailto:$fr_u_email' class='fr-text-deco-none fr-color-111'>$fr_u_email</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>
                                        $addresss
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Social</td>
                                        <td class='text-center'>
                                            <a href='https://facebook.com/$fr_u_fb_profile_username' class='btn btn-primary btn-xs $FR_cc3' target='_blank'><i class='fa-brands fa-facebook'></i></a>

                                            <a href='https://m.me/$fr_u_fb_profile_username' class='btn btn-danger btn-xs $FR_cc3' target='_blank'><i class='fa-brands fa-facebook-messenger'></i></a>

                                            <a href='https://wa.me/$fr_u_whatsapp_num' class='btn btn-info btn-xs $FR_cc4' target='_blank'><i class='fa-brands fa-whatsapp'></i></a>
                                        </td>
                                    </tr>
                                </table>
                                ";

                             }}
                            ?>

                         
                        <div class="div_Analyzing">
                            <table class="t_print frd-card-1 mt-10">
                                <tr>
                                    <td colspan='2'><?php echo "Analyzing [ $fr_cust_mob1 ]";?> </td>
                                </tr>
                                <tr>
                                    <td>Total Orders</td>
                                    <td><?php echo "$FRc_THIS_MOB_NUM_ORDER_C";?> </td>
                                </tr>
                                <tr>
                                    <td>Search Orders</td>
                                    <td><a href="<?php echo "$FR_THISHURL/om-InvoiceList?search_text=$fr_cust_mob1";?>" target="_blank"><span class="glyphicon glyphicon-search"></span></a></td>
                                </tr>
                            </table>
                            <table class="table table-bordered mt-10">
                                <tr class="boldd">
                                    <td>OrderID</td>
                                    <td>Amount</td>
                                    <td>Status</td>
                                </tr>
                                <?php 
                                    $FRR = FR_QSEL("SELECT id AS id_this, fr_payable AS fr_payable_this,fr_stat AS fr_stat_this FROM frd_order_invo WHERE fr_cust_mob1 = '$fr_cust_mob1' AND fr_stat != 0 ORDER BY id DESC LIMIT 0,30","ALL");
                                    if($FRR['FRA']==1){  
                                    foreach($FRR['FRD'] as $FR_ITEM){
                                        extract($FR_ITEM);
                                        extract(FRF_ORDER_STATUS_LABEL($fr_stat_this));
                                        echo "
                                        <tr>
                                            <td>#$id_this</td>
                                            <td>$fr_payable_this/-</td>
                                            <td>$FRc_ORDER_STATUS_LABEL</td>
                                        </tr>
                                        ";
                                    }
                                    } else{ PR($FRR);}
                                ?>
                            </table>
                        </div>

                        </div>
                        
                </div>
            </div>


        </div>
    </div>
</section>



<?php if($fr_c_stat == 1){ ?>
    <!-- FRD COMPLAIN SOLVE TRIGER  -->
    <section>
        <div class="container">
            <div class="row">
                <hr>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                <form action='' method='POST'>
                    <input type='checkbox' required> I am sure!
                    <button type='submit' class='btn btn-warning btn-xs btn-block' name="FRTIGT_SOLVED_COMPLAIN"> <span class='glyphicon glyphicon-flash'></span> Solved Complain </button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</section>
<?php } ?>






<?php if(isset($frp_fos)){ if($frp_fos == 1){ ?>
<!-- FAKE ORDER SOLUTION  -->
<section>
<div class="container">
<div class="col-md-11">

   <!-- ALG-1 FAKE ORDER ANALISING  -->
   <div class="row">
     <div class="col-md-12">
        <div class="div_fake_order_searching_alg1 alert alert-danger">
            <h6 class="text-center">ALG-1 <br> Fake Order Analyzing..</h6> 
            <table class="table table-bordered mt-10">
                <tr class="boldd">
                    <td>OrderID</td>
                    <td>Amount</td>
                    <td>Status</td>
                    <td>Mobile</td>
                    <td>Customer</td>
                    <td>UID</td>
                    <td>IP</td>
                    <td>OrderTime</td>
                </tr>
                <?php 
                    try {
                            $FRQ = $FR_CONN->query("SELECT id AS alg1_id, fr_payable AS alg1_fr_payable,fr_stat AS alg1_fr_stat, fr_cust_name AS alg1_fr_cust_name, fr_cust_mob1 AS alg1_fr_cust_mob1, fr_o_time AS alg1_fr_o_time, fr_cust_uid AS alg1_fr_cust_uid, fr_cust_ip AS alg1_fr_cust_pi FROM frd_order_invo WHERE fr_cust_uid = '$fr_cust_uid' AND fr_stat > 0 ORDER BY id DESC LIMIT 0,30");
                            $FRQ_ROWS = $FRQ->rowCount();
                            $FRQ_D_ARR = $FRQ->fetchAll();

                            if($FRQ_ROWS > 0){
                                foreach($FRQ_D_ARR as $FR_ITEM){
                                    extract($FR_ITEM);
                                    extract(FRF_ORDER_STATUS_LABEL($alg1_fr_stat));

                                    echo "
                                    <tr>
                                        <td>#$alg1_id</td>
                                        <td>$alg1_fr_payable/-</td>
                                        <td>$FRc_ORDER_STATUS_LABEL</td>
                                        <td>$alg1_fr_cust_mob1</td>
                                        <td>$alg1_fr_cust_name</td>
                                        <td>$alg1_fr_cust_uid</td>
                                        <td>$alg1_fr_cust_pi</td>
                                        <td>".date('Y-M-d h:i A',$alg1_fr_o_time)."</td>
                                    </tr>
                                    ";
                                }
                            }

                            if($FRQ_ROWS == 0){
                                    echo "
                                    <tr class='text-center'>
                                        <td colspan='6'>This Is Look Like Real Order</td>
                                    </tr>
                                    ";
                            }
                        } catch(PDOException $e) {
                           ECHO_4($e->getMessage(),"alert alert-danger");
                        }
                ?>
            </table>
        </div>
     </div>
   </div>



  <!-- ALG-2 FAKE ORDER ANALISING  -->
    <div class="row">
     <div class="col-md-12">
        <div class="div_fake_order_searching_alg1 alert alert-info">
            <h6 class="text-center">ALG-2 <br> Fake Order Analyzing.. </h6> 
            <table class="table table-bordered mt-10">
                <tr class="boldd">
                    <td>OrderID</td>
                    <td>Amount</td>
                    <td>Status</td>
                    <td>Mobile</td>
                    <td>Customer</td>
                    <td>UID</td>
                    <td>IP</td>
                    <td>OrderTime</td>
                </tr>
                <?php 
                    try {
                            $FRQ = $FR_CONN->query("SELECT id AS alg1_id, fr_payable AS alg1_fr_payable,fr_stat AS alg1_fr_stat, fr_cust_name AS alg1_fr_cust_name, fr_cust_mob1 AS alg1_fr_cust_mob1, fr_o_time AS alg1_fr_o_time, fr_cust_uid AS alg1_fr_cust_uid, fr_cust_ip AS alg1_fr_cust_pi FROM frd_order_invo WHERE fr_cust_ip = '$fr_cust_ip' AND fr_stat > 0 ORDER BY id DESC LIMIT 0,30");
                            $FRQ_ROWS = $FRQ->rowCount();
                            $FRQ_D_ARR = $FRQ->fetchAll();
                            
                            if($FRQ_ROWS > 0){
                                foreach($FRQ_D_ARR as $FR_ITEM){
                                    extract($FR_ITEM);
                                    extract(FRF_ORDER_STATUS_LABEL($alg1_fr_stat));

                                    echo "
                                    <tr>
                                        <td>#$alg1_id</td>
                                        <td>$alg1_fr_payable/-</td>
                                        <td>$FRc_ORDER_STATUS_LABEL</td>
                                        <td>$alg1_fr_cust_mob1</td>
                                        <td>$alg1_fr_cust_name</td>
                                        <td>$alg1_fr_cust_uid</td>
                                        <td>$alg1_fr_cust_pi</td>
                                        <td>".date('Y-M-d h:i A',$alg1_fr_o_time)."</td>
                                    </tr>
                                    ";
                                }
                            }

                            if($FRQ_ROWS == 0){
                                    echo "
                                    <tr class='text-center'>
                                        <td colspan='6'>This Is Look Like Real Order</td>
                                    </tr>
                                    ";
                            }
                        } catch(PDOException $e) {
                           ECHO_4($e->getMessage(),"alert alert-danger");
                        }
                ?>
            </table>
        </div>
     </div>
    </div>


</div>
</div>
</section>
<?php }} ?>





<?php if($UsrType == "ad"){ ?>
    <!-- FRD ORDER DELETE TRIGER  -->
    <section>
        <div class="container">
            <div class="row">
                <hr>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                <form action='' method='POST'>
                    <input type='checkbox' required> I am sure!
                    <button type='submit' class='btn btn-danger btn-xs btn-block' name="FRTIGT_DELETE_PRODUCT"> <span class='glyphicon glyphicon-flash'></span> Confirm & Delete </button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</section>
<?php } ?>





<!-- ALL MODELS  -->
<section>

    <?php if ($FRc_Invo_Stat_x == 1 || $FRc_Invo_Stat_x == 6 ||  $FRc_Invo_Stat_x == 10) { ?>
        <div class="modal fade" id="FR_MODEL_UpDeliveryCharge" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row jumbotron">
                            <div class="col-md-12">
                                <form action="" method="POST">
                                    <input class="form-control" type="number" name="f_NewShipCharge" placeholder="New Delivery Charge" required>
                                    <div class="text-right">
                                        <br>
                                        <button type="submit" class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Save </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>



    <?php if ($FRc_Invo_Stat_x == 1 || $FRc_Invo_Stat_x == 6 || $FRc_Invo_Stat_x == 10) { ?>
        <div class="modal fade" id="FR_MODEL_UpCouponDiscount" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row jumbotron">
                            <div class="col-md-12">
                                <form action="" method="POST">
                                    <input class="form-control" type="number" name="f_NewCouponDiscountAmount" placeholder="Input Coupon Discount Amount" required>
                                    <div class="text-right">
                                        <br>
                                        <button type="submit" class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Save </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>




    <?php if ($FRc_Invo_Stat_x > 1 AND $fr_invo_due > 0) { ?>
        <div class="modal fade" id="FR_MODEL_UpAdvanceReceiv" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row jumbotron">
                            <div class="col-md-12">
                            <h3 class="boldd text-center text-success">Payment Receiving</h3>
                                <form action="" method="POST">
                                    <input class="form-control" type="text" name="f_AdvanceReceivAmount" placeholder="Enter Receive Amount" required>
                                    <?php if($frplug_ac_m == 1){ ?>
                                    <select class="form-control mt-5" name="f_bank_ac_id" id="" required>
                                        <option value="">Select Credit AC *</option>
                                        <?php echo FRF_OPTION_BNK_AC();?>
                                    </select>
                                    <?php } ?>
                                    <input class="form-control mt-5" type="text" name="f_TransactionId" placeholder="Enter Transaction Id">
                                    <textarea class="form-control mt-5" name="f_trn_note" id="" cols="30" rows="2" placeholder="Note (optional)"></textarea>
                                    <div class="text-right">
                                        <br>
                                        <button type="submit" class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Save </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <?php if ($fr_invo_due > 0 AND $FRc_Invo_Stat_x == 5 OR $FRc_Invo_Stat_x == 7) { ?>
        <div class="modal fade" id="FR_MODEL_CODReceivedAmount" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row jumbotron">
                            <div class="col-md-12">
                                <h3 class="boldd text-center text-primary">COD Receiving</h3>
                                <form action="" method="POST">
                                    <input class="form-control" type="text" name="f_CODReceivedAmount" placeholder="Enter COD Receive Amount" value="<?php echo $fr_invo_due;?>" required>
                                    <?php if($frplug_ac_m == 1){ ?>
                                    <select class="form-control mt-5" name="f_bank_ac_id" id="" required>
                                        <option value="">Select Credit AC *</option>
                                        <?php echo FRF_OPTION_BNK_AC();?>
                                    </select>
                                    <?php } ?>
                                    <input class="form-control mt-5" type="text" name="f_TransactionId" placeholder="Enter Transaction Id">
                                    <textarea class="form-control mt-5" name="f_trn_note" id="" cols="30" rows="2" placeholder="Note (optional)"></textarea>
                                    <div class="text-right">
                                        <br>
                                        <button type="submit" class='btn btn-primary'> <span class='glyphicon glyphicon-save'></span> Save </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>



    <?php if ($fr_invo_due > 0 AND $FRc_Invo_Stat_x == 4 OR $FRc_Invo_Stat_x == 5) { ?>
        <div class="modal fade" id="FR_MODEL_PaymentDiscount" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row jumbotron">
                            <div class="col-md-12">
                                <h3 class="boldd text-center text-danger">Payment Discount Entry</h3>
                                <form action="" method="POST">
                                    <input class="form-control" type="text" name="f_PaymentDiscountAmount" placeholder="Enter Payment Discount Amount" required>
                                    <div class="text-right mt-10">
                                        <button type="submit" class='btn btn-danger'> <span class='glyphicon glyphicon-save'></span> Save </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>


    <?php //if ($FRc_Invo_Stat_x == 4) { ?>
        <div class="modal fade" id="FR_MODEL_GF_DeliveryDone" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row jumbotron">
                            <div class="col-md-12">
                                <form action="" method="POST">
                                    <div class="text-right">
                                        <button type="submit" class='btn btn-success btn-block' name="f_MakeDeliveryDone"> <span class='glyphicon glyphicon-save'></span> Confirm & Delivery Done </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php //} ?>




    <?php if ($FRc_Invo_Stat_x == 1 || $FRc_Invo_Stat_x == 6 || $FRc_Invo_Stat_x == 9 || $FRc_Invo_Stat_x == 10) { ?>
        <div class="modal fade" id="FR_MODEL_GF_ShipPartnerSelect" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row jumbotron">
                            <div class="col-md-12">
                                <form action="" method="POST">
                                    <select class="form-control" name="f_ship_part_id" id="" required>
                                        <?php
                                        echo "<option value='$fr_ship_p_id'>$fr_ship_p_id_NAME</option>";
                                        echo FRF_OPTION_SHIP_PART();
                                        ?>
                                    </select>
                                    <br>
                                    <div class="text-right">
                                        <br>
                                        <button type="submit" class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Confirm </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>


    <?php if ($FRc_Invo_Stat_x == 2 || $FRc_Invo_Stat_x == 3 || $FRc_Invo_Stat_x == 12 || $FRc_Invo_Stat_x == 11 || $FRc_Invo_Stat_x == 13 || $FRc_Invo_Stat_x == 14) { ?>
        <div class="modal fade" id="FR_MODEL_GF_Shiped" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row jumbotron">
                            <div class="col-md-12">
                                <form action="" method="POST">
                                    <select class="form-control" name="" id="" required>
                                        <?php
                                        echo "<option value='$fr_ship_p_id'>$fr_ship_p_id_NAME</option>";
                                        ?>
                                    </select>
                                    <br>
                                    <input class="form-control" type="text" name="f_ship_consignment_id" placeholder="কনসাইনমেন্ট আইডি">
                                    <br>
                                    <input class="form-control" type="text" name="f_ship_tracking_code" placeholder="ট্রাকিং কোড"><br>
                                    <br>
                                    <div class="text-right">
                                        <button name="FRTRIG_ShipedComplit" type="submit" class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Confirm Shipped</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>








    <?php if ($FRc_Invo_Stat_x == 1 || $FRc_Invo_Stat_x == 10) { ?>
        <div class="modal fade" id="FR_MODEL_GF_HoldOrder" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row jumbotron">
                            <div class="col-md-2"></div>
                            <div class="col-md-12">
                                <form action="" method="POST">
                                    <textarea class="form-control" name="f_OrderHoldNote" id="f_OrderHoldNote" cols="30" rows="3" placeholder="Input Hold Note" required></textarea>

                                    <br>
                                    <b>কারন:-</b><br>
                                    <input type="radio" name="qn1" class="Quick_OrderHoldNote" value="আপনাকে কল করা হয়েছিল কিন্তু আপনি কল রিসিভ করেন নাই।"> আপনাকে কল করা হয়েছিল কিন্তু আপনি কল রিসিভ করেন নাই। <br>
                                    <input type="radio" name="qn1" class="Quick_OrderHoldNote" value="আপনার মোবাইল নাম্বার বন্ধ থাকার কারনে আপনার সাথে যোগাযোগ করা সম্ভব হয় নাই।"> আপনার মোবাইল নাম্বার বন্ধ থাকার কারনে আপনার সাথে যোগাযোগ করা সম্ভব হয় নাই। <br>
                                    <input type="radio" name="qn1" class="Quick_OrderHoldNote" value="আপনি পরে জানাতে চেয়েছেন।"> আপনি পরে জানাতে চেয়েছেন। <br>
                                    <input type="radio" name="qn1" class="Quick_OrderHoldNote" value="আপনি আরো পন্য এ্যাড করতে চেয়েছেন।"> আপনি আরো পন্য এ্যাড করতে চেয়েছেন। <br>
                                    <input type="radio" name="qn1" class="Quick_OrderHoldNote" value="আপনার ফোন বন্ধ থাকায় অর্ডারটি হোল্ডে আছে তাড়াতাড়ি কল দিয়ে অর্ডারটি কনফার্ম করুন। নতুবা ক্যানসেল করা হবে।"> আপনার ফোন বন্ধ থাকায় অর্ডারটি হোল্ডে আছে তাড়াতাড়ি কল দিয়ে অর্ডারটি কনফার্ম করুন। নতুবা ক্যানসেল করা হবে। <br>
            

                                    <div class="text-right">
                                        <br>
                                        <button type="submit" class='btn btn-primary'> <span class='glyphicon glyphicon-save'></span> Confirm & Hold </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-2"></div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>


    <?php if ($FRc_Invo_Stat_x == 1 || $FRc_Invo_Stat_x == 3 || $FRc_Invo_Stat_x == 6 || $FRc_Invo_Stat_x == 9 ||  $FRc_Invo_Stat_x == 10 || $FRc_Invo_Stat_x == 13 || $FRc_Invo_Stat_x == 14) { ?>
        <div class="modal fade" id="FR_MODEL_GF_CanceledOrder" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row jumbotron">
                            <div class="col-md-2"></div>
                            <div class="col-md-12">
                                <form action="" method="POST">
                                    <textarea class="form-control" name="f_OrderCancelNote" id="f_OrderCancelNote" cols="30" rows="3" placeholder="Input Cancel Note" required></textarea>

                                    <br>
                                    <b>কারন:-</b><br>
                                    <input type="radio" name="qn1" class="Quick_OrderCancelNote" value="আপনার দেওয়া মোবাইল নাম্বারটি সঠিক নয়।"> আপনার দেওয়া মোবাইল নাম্বারটি সঠিক নয়। <br>
                                    <input type="radio" name="qn1" class="Quick_OrderCancelNote" value="আপনার একাধিক অর্ডার প্লেস করা আছে।"> আপনার একাধিক অর্ডার প্লেস করা আছে। <br>
                                    <input type="radio" name="qn1" class="Quick_OrderCancelNote" value="আপনি মাইন্ড চেঞ্জ করেছেন।"> আপনি মাইন্ড চেঞ্জ করেছেন। <br>
                                    <input type="radio" name="qn1" class="Quick_OrderCancelNote" value="আপনি ডেলিভারী চার্জ অগ্রীম দিতে পারবেন না।"> আপনি ডেলিভারী চার্জ অগ্রীম দিতে পারবেন না। <br>
                                    <input type="radio" name="qn1" class="Quick_OrderCancelNote" value="মোবাইল নাম্বার ভুল হয়েছে।"> আপনার মোবাইল নাম্বার ভুল হয়েছে। <br>
                                    <input type="radio" name="qn1" class="Quick_OrderCancelNote" value="আপনাকে অনেক বার কল করেও ফোনে পাওয়া যায়নি।">  আপনাকে অনেক বার কল করেও ফোনে পাওয়া যায়নি। <br>
                                    <input type="radio" name="qn1" class="Quick_OrderCancelNote" value="বিকাশ করবেন বলে আপনি অনেক বার ঘুড়াচ্ছেন।"> বিকাশ করবেন বলে আপনি অনেক বার ঘুড়াচ্ছেন। <br>
                                    <input type="radio" name="qn1" class="Quick_OrderCancelNote" value="সাসপেক্টেড ফেইক অর্ডার।"> সাসপেক্টেড ফেইক অর্ডার। <br>
                                    <input type="radio" name="qn1" class="Quick_OrderCancelNote" value="আপনি এডভান্স দিতে রাজি না।"> আপনি এডভান্স দিতে রাজি না। <br>

                                    <div class="text-right">
                                        <br>
                                        <button type="submit" class='btn btn-danger'> <span class='glyphicon glyphicon-save'></span> Confirm & Cancel </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-2"></div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>





    <?php if ($FRc_Invo_Stat_x == 4 || $FRc_Invo_Stat_x == 15) { ?>
        <div class="modal fade" id="FR_MODEL_GF_DeliveryFailed" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row jumbotron">
                            <div class="col-md-12">
                                <form action="" method="POST">
                                    <textarea class="form-control" name="f_DeliveryFailedNote" id="f_DeliveryFailedNote" cols="30" rows="3" placeholder="Input Delivery Failed Note" required></textarea>

                                    <br>
                                    <b>কারন:-</b><br>
                                    <input type="radio" name="qn1" class="Quick_DeliveryFailedNote" value="পন্যটি আপনার পছন্দ হয় নাই।"> পন্যটি আপনার পছন্দ হয় নাই। <br>
                                    <input type="radio" name="qn1" class="Quick_DeliveryFailedNote" value="অনেকবার কল করে আপনার সাথে যোগাযোগ করা সম্ভব হয় নাই। "> অনেকবার কল করে আপনার সাথে যোগাযোগ করা সম্ভব হয় নাই।  <br>
                                    <input type="radio" name="qn1" class="Quick_DeliveryFailedNote" value="আপনি আপনার লোকেশন এ ছিলেন না। "> আপনি আপনার লোকেশন এ ছিলেন না।   <br>
                                    <input type="radio" name="qn1" class="Quick_DeliveryFailedNote" value="আপনার কাছে টাকা ছিলো না।"> আপনার কাছে টাকা ছিলো না। <br>
                                    <input type="radio" name="qn1" class="Quick_DeliveryFailedNote" value="আপনি অর্ডার কনফার্ম করে ডেলিভারীর সময় বলেছেন অর্ডার করেন নাই।"> আপনি অর্ডার কনফার্ম করে ডেলিভারীর সময় বলেছেন অর্ডার করেন নাই। <br>

                                    <div class="text-right">
                                        <br>
                                        <button type="submit" class='btn btn-danger'> <span class='glyphicon glyphicon-save'></span> Confirm </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>




    <?php if ($FRc_Invo_Stat_x == 1 || $FRc_Invo_Stat_x == 6) { ?>
        <div class="modal fade" id="FR_MODEL_GF_DeliveryAddress" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row jumbotron">
                            <div class="col-md-12">
                                <form action="" method="POST">
                                    <input class="form-control" type="text" name="f_Deli_Name" placeholder="Input Delivery Name" value="<?php echo "$fr_cust_name"; ?>" required>
                                    <br>
                                    <input class="form-control" type="text" name="f_Deli_Mobile_1" placeholder="Input Mobile Number 1" value="<?php echo "$fr_cust_mob1"; ?>" required>
                                    <br>
                                    <input class="form-control" type="text" name="f_Deli_Mobile_2" placeholder="Input Mobile Number 2" value="<?php echo "$fr_cust_mob2"; ?>">
                                    <br>
                                    <small>Delivery Address</small>
                                    <textarea class="form-control" name="f_Deli_Address" id="" cols="30" rows="3" placeholder="Input Delivery Address" required><?php echo "$fr_cust_addres"; ?></textarea>


                                    <br>
                                    <small>Customer Order Note</small>
                                    <textarea class="form-control" name="f_cust_order_note" id="" cols="30" rows="3" placeholder="Input Customer Order Note"><?php echo "$fr_cust_o_note"; ?></textarea>

                                   
                                    <table class="mt-10" width="100%">
                                        <tr>
                                            <td>
                                                <select class="form-control mt-10" id="f_devision" name="f_devision">
                                                    <?php 
                                                    if($fr_div == ""){
                                                        echo "<option value=''>Select Division *</option>";
                                                    }else{
                                                        echo "<option value='$fr_div'>$fr_div</option>";
                                                    }
                                                    ?>
                                                        <option value=''>Select Division </option>
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
                                        
                                        <tr id="f_district_sec" style="display: none;">
                                            <td>
                                                <select class='form-control mt-10' id='f_district' name='f_district'>
                                                   <?php 
                                                    if($fr_dis != ""){
                                                        echo "<option value='$fr_dis'>$fr_dis</option>";
                                                    }
                                                    ?>
                                                </select> 
                                            </td>
                                        </tr>
                                        <tr id="f_thana_sec" style="display: none;">
                                        <td>
                                            <select class='form-control mt-10' id='f_thana' name='f_thana'>
                                                    <?php 
                                                    if($fr_tha != ""){
                                                        echo "<option value='$fr_tha'>$fr_tha</option>";
                                                    }
                                                    ?>
                                            </select>  
                                        </td>
                                        </tr>
                                    </table>

                                    <br>
                                    <hr>
                                    <div class="alert alert-info">
                                        <h4 class="boldd text-center">Pathao City,Zone,Area</h4>
                                        <table width="100%">
                                            <tr>
                                                <td>
                                                    <small>Start</small>
                                                    <select class="form-control" id="fr_pq_city_start" name="fr_pq_city_start">
                                                       <option value="">Start</option>
                                                       <option value="">Hi Pathao</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <small>City</small>
                                                    <select class="form-control" id="fr_pq_city" name="fr_pq_city">
                                                        <?php 
                                                        if($fr_pq_city != ""){
                                                            echo "<option value='$fr_pq_city/$fr_pq_city_n'>$fr_pq_city_n</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                            </tr>
                                            
                                            <tr id="fr_pq_zone_sec" class="mt-10">
                                                <td> 
                                                    <small>Zone</small>
                                                    <select class='form-control' id='fr_pq_zone' name='fr_pq_zone'>
                                                    <?php 
                                                        if($fr_pq_zone != ""){
                                                            echo "<option value='$fr_pq_zone/$fr_pq_zone_n'>$fr_pq_zone_n</option>";
                                                        }
                                                        ?>
                                                    </select> 
                                                </td>
                                            </tr>

                                            <tr id="fr_pq_area_sec">
                                            <td>
                                                <small class="mt-10">Area</small>
                                                <select class='form-control' id='fr_pq_area' name='fr_pq_area' placeholder="xxxx">
                                                        <?php 
                                                        if($fr_pq_area != ""){
                                                            echo "<option value='$fr_pq_area/$fr_pq_area_n'>$fr_pq_area_n</option>";
                                                        }
                                                        ?>
                                                    <div id="fr_pq_area_options"></div>
                                                </select>  
                                            </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="text-right">
                                        <br>
                                        <button type="submit" class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Confirm & Save </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>



    <?php if ($FRc_Invo_Stat_x == 1) { ?>
        <div class="modal fade" id="FR_MODEL_GF_PreConfirmDate" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row jumbotron">
                            <div class="col-md-12">
                                <form action="" method="POST">
                                <small>Pre-Confirm Schedule Date</small>
                                 <input type="date" class="form-control" name="f_sdate" required>
                                    <div class="text-right">
                                        <br>
                                        <button type="submit" name="FRTRIG_set_pre_comfirm" class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Confirm & Save </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>




    <?php if ($FRc_Invo_Stat_x == 1 || $FRc_Invo_Stat_x == 6) { ?>
        <div class="modal fade" id="FR_MODEL_GF_UpdateWeight" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row jumbotron">
                            <div class="col-md-12">
                                <form action="" method="POST">
                                  <small>Select New Weight</small>
                                  <select class="form-control" name="f_weight" id="" required>
                                    <option value="">Select Weight</option>
                                    <option value="0.5">0.5 KG</option>
                                    <option value="1">1 KG</option>
                                    <option value="1.5">1.5 KG</option>
                                    <option value="2">2 KG</option>
                                    <option value="2.5">2.5 KG</option>
                                    <option value="3">3 KG</option>
                                    <option value="3.5">3.5 KG</option>
                                    <option value="4">4 KG</option>
                                    <option value="4.5">4.5 KG</option>
                                    <option value="5">5 KG</option>
                                    <option value="5.5">5.5 KG</option>
                                    <option value="6">6 KG</option>
                                    <option value="6.5">6.5 KG</option>
                                    <option value="7">7 KG</option>
                                  </select>

                                  <div class="text-right">
                                        <br>
                                        <button type="submit" name="FRTRIG_UpdateWeight" class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Confirm & Update </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>







        <div class="modal fade" id="FR_MODEL_GF_OrderProsessNote" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row jumbotron">
                            <div class="col-md-2"></div>
                            <div class="col-md-12">
                                <form action="" method="POST">
                                    <textarea class="form-control" name="f_order_prosess_note" id="f_order_prosess_note" cols="30" rows="3" placeholder="Input Note" required></textarea>
                                    <br>

                                    <div class="text-right">
                                        <br>
                                        <button type="submit" class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Add Note </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-2"></div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="FR_MODEL_GF_ComplainNote" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row jumbotron">
                            <div class="col-md-2"></div>
                            <div class="col-md-12">
                                <form action="" method="POST">
                                    <textarea class="form-control" name="f_complain_note" cols="30" rows="3" placeholder="Input Complain" required></textarea>
                                    <br>

                                    <div class="text-right">
                                        <br>
                                        <button type="submit" class='btn btn-success'> <span class='glyphicon glyphicon-save'></span> Add Complain </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-2"></div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="FR_MODEL_GF_SendCustomSMS" role="dialog">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row jumbotron">
                            <div class="col-md-2"></div>
                            <div class="col-md-12">
                                <form action="" method="POST">
                                    <textarea class="form-control" name="f_SMS_Text" cols="30" rows="3" placeholder="Enter SMS Text" required><?php echo "Dear $fr_cust_name, ";?></textarea>
                                    <br>
                                    <div class="text-right">
                                        <button type="submit" class='btn btn-success'> <span class='glyphicon glyphicon-send'></span> Confirm Send SMS </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-2"></div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



</section>












<script>
    $(document).ready(function() {
        $(".FR_MODEL_UpDeliveryCharge").unbind().click(function() {
            $('#FR_MODEL_UpDeliveryCharge').modal("show");
        });
        $(".FR_MODEL_UpCouponDiscount").unbind().click(function() {
            $('#FR_MODEL_UpCouponDiscount').modal("show");
        });
        $(".FR_MODEL_GF_ShipPartnerSelect").unbind().click(function() {
            $('#FR_MODEL_GF_ShipPartnerSelect').modal("show");
        });
        $(".FR_MODEL_GF_Shiped").unbind().click(function() {
            $('#FR_MODEL_GF_Shiped').modal("show");
        });
        $(".FR_MODEL_GF_CanceledOrder").unbind().click(function() {
            $('#FR_MODEL_GF_CanceledOrder').modal("show");
        });
        $(".FR_MODEL_GF_HoldOrder").unbind().click(function() {
            $('#FR_MODEL_GF_HoldOrder').modal("show");
        });
        $(".FR_MODEL_GF_DeliveryFailed").unbind().click(function() {
            $('#FR_MODEL_GF_DeliveryFailed').modal("show");
        });
        $(".FR_MODEL_GF_DeliveryAddress").unbind().click(function() {
            $('#FR_MODEL_GF_DeliveryAddress').modal("show");
        });
        $(".FR_MODEL_UpAdvanceReceiv").unbind().click(function() {
            $('#FR_MODEL_UpAdvanceReceiv').modal("show");
        });
        $(".FR_MODEL_CODReceivedAmount").unbind().click(function() {
            $('#FR_MODEL_CODReceivedAmount').modal("show");
        });
        $(".FR_MODEL_PartialProductReturnFC").unbind().click(function() {
            $('#FR_MODEL_PartialProductReturnFC').modal("show");
        });
        $(".FR_MODEL_PaymentDiscount").unbind().click(function() {
            $('#FR_MODEL_PaymentDiscount').modal("show");
        });
        $(".FR_MODEL_GF_DeliveryDone").unbind().click(function() {
            $('#FR_MODEL_GF_DeliveryDone').modal("show");
        });
        $(".FR_MODEL_GF_PreConfirmDate").unbind().click(function() {
            $('#FR_MODEL_GF_PreConfirmDate').modal('show');
        });
        $(".FR_MODEL_GF_UpdateWeight").unbind().click(function() {
            $('#FR_MODEL_GF_UpdateWeight').modal('show');
        });
        $(".FR_MODEL_GF_OrderProsessNote").unbind().click(function() {
            $('#FR_MODEL_GF_OrderProsessNote').modal('show');
        });
        $(".FR_MODEL_GF_ComplainNote").unbind().click(function() {
            $('#FR_MODEL_GF_ComplainNote').modal('show');
        });
        $(".FR_MODEL_GF_SendCustomSMS").unbind().click(function() {
            $('#FR_MODEL_GF_SendCustomSMS').modal('show');
        });

        $(".Frtrig_PPR_INI").unbind().click(function() {
            $('form.formppr').show();
        });
        $(".Frtrig_PPR_INI").dblclick(function() {
            $('form.formppr').hide();
        });



        $( ".Quick_OrderHoldNote" ).on( "click", function() {
            let quick_note_text = $(this).attr("value"); 
            $('#f_OrderHoldNote').html(quick_note_text);
        });
        $( ".Quick_OrderCancelNote" ).on( "click", function() {
            let quick_note_text = $(this).attr("value"); 
            $('#f_OrderCancelNote').html(quick_note_text);
        });
        $( ".Quick_DeliveryFailedNote" ).on( "click", function() {
            let quick_note_text = $(this).attr("value"); 
            $('#f_DeliveryFailedNote').html(quick_note_text);
        });





        //FRD PATHAO CITY,ZONE,AREA START:-
        $("#fr_pq_city_start").unbind().change(function(){
            $('#fr_pq_city').html("");
            $('#fr_pq_zone').html("");
            $('#fr_pq_area').html("");
                $.ajax({
                    url: FR_HURL_APII + '/options_pathao_city',
                    method:"POST",
                    data:{spider_eCommerce:"spider_eCommerce"},  
                    success:function(data){
                            $('#fr_pq_city').html(data);
                    },
                        error: function () {
                        console.log('AJAX ERROR');
                    },
                });
        });
        $("#fr_pq_city").unbind().change(function(){
            var f_city = $(this).val();
            $('#fr_pq_zone').html("");
            $('#fr_pq_area').html("");
                $.ajax({
                    url: FR_HURL_APII + '/options_pathao_zone',
                    method:"POST",
                    data:{spider_eCommerce:"spider_eCommerce",f_city:f_city},  
                    success:function(data){ 
                            $('#fr_pq_zone').html(data);
                    },
                        error: function () {
                        console.log('AJAX ERROR');
                    },
                });
        });
        $("#fr_pq_zone").unbind().change(function(){
            var f_zone = $(this).val();
                $.ajax({
                    url: FR_HURL_APII + '/options_pathao_area',
                    method:"POST",
                    data:{spider_eCommerce:"spider_eCommerce",f_zone:f_zone},  
                    success:function(data){ 
                            //console.log(data);
                            // alert(data);
                            $('#fr_pq_area').html(data);
                    },
                        error: function () {
                        console.log('AJAX ERROR');
                    },
                });
        });
        //FRD PATHAO CITY,ZONE,AREA END>>



        //FRD DIVISION, DISTRICT, THANA START:-
        $("#f_devision").unbind().change(function () {
                   var FR_SelectDivis = $(this).val();
                         $.ajax({
                            url: FRD_HURLL + '/frd-src/inc/php/frd-options-district.php',
                            method:"POST",
                            data:{FR_SelectDivis:FR_SelectDivis},  
                            success:function(data){ 
                                 $('#f_district_sec').show();
                                 $('#f_district').html(data);
                            },
                             error: function () {
                                console.log('AJAX ERROR');
                            },
                        });
                   $('#f_district_sec').hide();
                   $('#f_thana_sec').hide();
        });
       $("#f_district").unbind().change(function () {
                   var FR_SelectDistrick = $(this).val();
                         $.ajax({
                            url: FRD_HURLL + '/frd-src/inc/php/frd-options-thana.php',
                            method:"POST",
                            data:{FR_SelectDistrick:FR_SelectDistrick},  
                            success:function(data){
                                $('#f_thana_sec').show();
                                 $('#f_thana').html(data);
                            },
                             error: function () {
                                console.log('AJAX ERROR');
                            },
                       });
        });
        //DIVISION, DISTRICT, THANA END>>

    });
</script>


<?php require_once('frd1_footer.php'); ?>