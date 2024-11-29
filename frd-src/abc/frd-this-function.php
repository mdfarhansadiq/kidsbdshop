<?php
//FRD COUNT:- //FRD STATUS FULL 
 FUNCTION FRF_COMP_NAME(){
    global $FR_CONN;
    $FRR = [];
    $FRQ = $FR_CONN->query("SELECT fr_cname FROM frd_cprofile WHERE id = 1");
    $FRSD = $FRQ->fetch();
    $FRR['FRc_COMP_NAME'] = $FRSD['fr_cname'];
    return $FRR;
 }
 FUNCTION FR_USR_NAME($FR_U_ID){
    global $FR_CONN;
    $FRR = [];
    $FRQ = $FR_CONN->query("SELECT namee FROM frd_usr WHERE id = $FR_U_ID");
    $FRSD = $FRQ->fetch();
    $FRc_USR_NAME = $FRSD['namee'];
    $FRR['FRc_USR_NAME'] = $FRc_USR_NAME;
    return $FRR;
 }
 FUNCTION FR_USR_MINI_INFO($FR_U_ID){
    global $FR_CONN;
    $FRR = [];
    $FRQ = $FR_CONN->query("SELECT namee,picc,timee,phon1 FROM frd_usr WHERE id = $FR_U_ID");
    $FRSD = $FRQ->fetch();
    $FRR['FRc_USR_NAME'] = $FRSD['namee'];
    $FRR['FRc_USR_MOBILE1'] = $FRSD['phon1'];
    $FRR['FRc_USR_PIC'] = $FRSD['picc'];
    $FRR['FRc_USR_REG_TIME'] = $FRSD['timee'];
    return $FRR;
 }
 FUNCTION FRF_SHIP_PART_NAME($FR_SP_ID){ 
    global $FR_CONN;
    $FRR = [];
    $FRQ = $FR_CONN->query("SELECT frd_namee FROM frd_shippart WHERE id = $FR_SP_ID");
    $FRSD = $FRQ->fetch();
    $FRc_SHIP_PART_NAME = $FRSD['frd_namee'];
    $FRR['FRc_SHIP_PART_NAME'] = $FRc_SHIP_PART_NAME;
    return $FRR;
 }
 FUNCTION FRF_BRAND_NAME($FR_BID){
    global $FR_CONN;
    $FRR = [];
    $FRQ = $FR_CONN->query("SELECT bn_name FROM frd_brandss WHERE id = $FR_BID");
    $FRSD = $FRQ->fetch();
    $FRR['FRc_BRAND_NAME'] = $FRSD['bn_name'];
    return $FRR;
 }
 FUNCTION FRF_COLOR_NAME($FR_COID){
    global $FR_CONN;
    $FRR = [];
    $FRQ = $FR_CONN->query("SELECT en_name FROM frd_colorr WHERE id = $FR_COID");
    $FRSD = $FRQ->fetch();
    $FRR['FRc_COLOR_NAME'] = $FRSD['en_name'];
    return $FRR;
 }
 FUNCTION FRF_CATT_NAME($FR_CID){
    global $FR_CONN;
    $FRR = [];
    if($FR_CID > 0){
        $FRQ = $FR_CONN->query("SELECT bn_name FROM frd_categoriess WHERE id = $FR_CID");
        $FRSD = $FRQ->fetch();
        $FRR['FRc_CATT_NAME'] = $FRSD['bn_name'];
    }else{
        $FRR['FRc_CATT_NAME'] = "NA";
    }
    return $FRR;
 }
 FUNCTION FRF_COST_CAT_NAME($FR_ID){
    global $FR_CONN;
    $FRR = [];
    $FRQ = $FR_CONN->query("SELECT fr_cost_cat_name FROM frd_cost_cat WHERE id = $FR_ID");
    $FRSD = $FRQ->fetch();
    $FRR['FRc_COST_CAT_NAME'] = $FRSD['fr_cost_cat_name'];
    return $FRR;
 }
 function FRF_NAME_SUPPLIER($FR_ID){
    global $FR_CONN;
    $FRR = [];
    if($FR_ID > 0){
        $FRQ = $FR_CONN->query("SELECT fr_supp_name FROM frd_suppliers WHERE fr_supp_id = $FR_ID");
        $FRSD = $FRQ->fetch();
        $FRR['FRc_NAME_SUPPLIER'] = $FRSD['fr_supp_name'];
    }else{
        $FRR['FRc_NAME_SUPPLIER'] = "NA";
    }
    return $FRR;
 }

 function FRF_ORDER_STATUS_LABEL($FR_STATUS){
    $FRR = [];
    if($FR_STATUS == 1){ $L = "<span class='label label-default'> NEW </span>";}
    elseif($FR_STATUS == 2){ $L = "<span class='label label-success'> Confirmed </span>";}
    elseif($FR_STATUS == 3){ $L = "<span class='label label-success'> Print Complete </span>";}
    elseif($FR_STATUS == 4){ $L = "<span class='label label-primary'> Shipped </span>";}
    elseif($FR_STATUS == 5){ $L = "<span class='label label-success'> Delivered </span>";}
    elseif($FR_STATUS == 6){ $L = "<span class='label label-info'> Hold </span>";}
    elseif($FR_STATUS == 7){ $L = "<span class='label label-danger'> Failed </span>";}
    elseif($FR_STATUS == 8){ $L = "<span class='label label-danger'> Canceled </span>";}
    elseif($FR_STATUS == 9){ $L = "<span class='label label-warning'> Pre-Order </span>";}
    elseif($FR_STATUS == 10){ $L = "<span class='label label-primary'> Payment Pending </span>";}
    elseif($FR_STATUS == 11){ $L = "<span class='label label-primary'> Print complete </span>";}
    elseif($FR_STATUS == 12){ $L = "<span class='label label-info'> Entry complete </span>";}
    elseif($FR_STATUS == 13){ $L = "<span class='label label-danger'> Stock out </span>";}
    elseif($FR_STATUS == 14){ $L = "<span class='label label-warning'> Schedule </span>";}

    $FRR['FRc_ORDER_STATUS_LABEL'] = "$L";
    return $FRR;
  }



//FRD ACCOUNTING START:-
function FRF_C_MTL_CUR_BAL(){
    global $FR_CONN;
    $FRR = [];
    $FRQ = $FR_CONN->query("SELECT fr_mtl_balance FROM frd_cprofile WHERE id = 1");
    $FRSD = $FRQ->fetch();
    $FRR['FRc_C_MTL_CUR_BAL'] = $FRSD['fr_mtl_balance'];
    return $FRR;
}
function FRF_BNK_AC_CUR_BAL($ID){
    global $FR_CONN;
    $FRR = [];
    $FRQ = $FR_CONN->query("SELECT fr_bnk_ac_balance FROM frd_bank_ac WHERE id = $ID");
    $FRSD = $FRQ->fetch();
    $FRR['FRc_BNK_AC_CUR_BAL'] = $FRSD['fr_bnk_ac_balance'];
    return $FRR;
}
function FRF_CASH_IN_HAND_BAL(){
    global $FR_CONN;
    $FRR = [];
    extract(FRF_BNK_AC_CUR_BAL(1));
    $FRR['FRc_CASH_IN_HAND_BAL'] = $FRc_BNK_AC_CUR_BAL;
    return $FRR;
}
function FRF_BANK_BALANCE(){
    global $FR_CONN;
    $FRR = [];
    $FRQ = $FR_CONN->query("SELECT SUM(fr_bnk_ac_balance) FROM frd_bank_ac WHERE id > 1");
    $FRSD = $FRQ->fetch();
    $FRR['FRc_BANK_BALANCE'] = $FRSD['SUM(fr_bnk_ac_balance)'];
    return $FRR;
}
function FRF_UpInvoDueAmount($FR_INVOID,$FR_INVOENCID){
    global $FR_NOW_TIME;
    $FRR = [];

        $FRQ = "UPDATE frd_order_invo SET 
        fr_sub_total = (fr_pro_total+fr_ship_cost+fr_pack_cost),
        fr_payable = (fr_sub_total-fr_cupo_discount-fr_payg_discount),
        fr_invo_due = (fr_payable-fr_payment-fr_pay_discount),
        dumy_txt = '$FR_NOW_TIME'
        WHERE id = $FR_INVOID  AND fr_enc_id = '$FR_INVOENCID'";
        $R = FR_DATA_UP("$FRQ");
        if ($R['FRA'] == 1) {
            $FRR['FRA'] =  1;
            $FRR['FRM'] =  "Update Done";
        } else {
            $FRR['FRA'] =  2;
            $FRR['FRM'] =  "Update Failed";
        }

    return $FRR;
}
function FRF_INVO_NET_PROFIT_UP($FR_INVOID){
    global $FR_NOW_TIME;
    $FRR = [];
        $FRQ = "UPDATE frd_order_invo SET 
        fr_net_profit = (fr_pro_total + fr_ship_cost - fr_pro_buyprice - fr_delivery_cost) 
        WHERE id = $FR_INVOID";
        $R = FR_DATA_UP("$FRQ");
        if ($R['FRA'] == 1) {
            $FRR['FRA'] =  1;
            $FRR['FRM'] =  "Update Done";
        } else {
            $FRR['FRA'] =  2;
            $FRR['FRM'] =  "Update Failed";
        }

    return $FRR;
}
function FRF_PAYMENT_UPDATE($FRthis_InvoId,$FRthis_InvoEncId,$FRthis_PaidAmount,$FRthis_PayGtwId,$FRthis_TrnId,$FRthis_BankAcId){
    global $FR_CONN, $FR_NOW_TIME, $FR_NOW_DATE, $FR_NOW_MONTH, $FR_NOW_YEAR;

    $FRR = [];

    $FR_VC_TAN_AMOUNT_D = "";
    $FR_VC_CNRMT_DUE_A = ""; //CAN'T RECEIVE MORE THEN DUE AMOUNT

    $FRc_trn_amount = $FRthis_PaidAmount;
    $FRc_bank_ac_id = $FRthis_BankAcId;
    $f_trn_note = "";
    extract(FRF_fr_pay_gtw_id_name($FRthis_PayGtwId));

    $FRQ = $FR_CONN->query("SELECT fr_cust_id,fr_invo_due FROM frd_order_invo WHERE id = $FRthis_InvoId AND fr_enc_id = '$FRthis_InvoEncId'");
    extract($FRQ->fetch());
    $FRc_AafterTran_Remaining_Due = ($fr_invo_due - $FRthis_PaidAmount);

    //FRD_VC TRANSACTION AMOUNT DATA __________________________________________:-
    if($FRc_trn_amount > 0 AND is_numeric($FRc_trn_amount) AND $FRc_bank_ac_id != ""){
        $FR_VC_TAN_AMOUNT_D = 1;
    }else{
        $FRR['FRA'] = 2;
        $FRR['FRM'] = "Your Access Denied for Spider Ecommerce System! Transition Data Not Valid";
    }

    $FRQ = $FR_CONN->query("SELECT fr_bank_name,fr_bnk_ac_number,fr_bnk_ac_balance FROM frd_bank_ac WHERE id = $FRc_bank_ac_id");
    extract($FRQ->fetch());
    extract(FRF_C_MTL_CUR_BAL());
    $FRc_AfterTran_ThisBankAcBal = ($fr_bnk_ac_balance + $FRc_trn_amount);
    $FRc_AfterTran_MTLBal = ($FRc_C_MTL_CUR_BAL + $FRc_trn_amount);

    //FRD_VC___________________________________________:-
    if ($FRc_trn_amount <= $fr_invo_due) {
        $FR_VC_CNRMT_DUE_A = 1;
    } else {
        $FRR['FRA'] = 2;
        $FRR['FRM'] = "Can Not Receive More Then $fr_invo_due /-";
    }


    if ($FR_VC_TAN_AMOUNT_D == 1 AND $FR_VC_CNRMT_DUE_A == 1) {

        try{
            $ARR = array();
            $ARR['fr_cd'] = 1;
            $ARR['fr_trn_typ'] = 2;
            $ARR['fr_trn_amount'] = $FRc_trn_amount;
            $ARR['fr_note'] = "$f_trn_note";
            $ARR['fr_time'] = "$FR_NOW_TIME";
            $ARR['fr_date'] = "$FR_NOW_DATE";
            $ARR['fr_month'] = "$FR_NOW_MONTH";
            $ARR['fr_year'] = "$FR_NOW_YEAR";
            $ARR['fr_b_ac_id'] = $FRc_bank_ac_id;
            $ARR['fr_b_name'] = "$fr_bank_name";
            $ARR['fr_b_ac_number'] = "$fr_bnk_ac_number";
            $ARR['fr_stat'] = 1;
            $ARR['fr_invo_id'] = $FRthis_InvoId;
            $ARR['fr_pay_gtw_id'] = $FRthis_PayGtwId;
            $ARR['fr_pay_gtw_name'] = "$FRc_fr_pay_gtw_id_name";
            $ARR['fr_trn_id'] = "$FRthis_TrnId";
            $ARR['fr_cust_id'] = $fr_cust_id;
            $FRc_Columns = implode(", ", array_keys($ARR));
            $FRc_ValuesBind = implode(", :", array_keys($ARR));
            $FRQ = "INSERT INTO frd_mtl ($FRc_Columns) VALUES (:$FRc_ValuesBind)";
            $FRQ = $FR_CONN->prepare("$FRQ");
            $FRQ->execute($ARR);
            $FRc_MTL_LastInsertId = $FR_CONN->lastInsertId();

            //FRD THIS INVOICE PAYMENT RECEIVE INFO UPDATE START:-
            $FR_CONN->exec("UPDATE frd_order_invo SET fr_payment = (fr_payment + $FRc_trn_amount) WHERE id = $FRthis_InvoId  AND fr_enc_id = '$FRthis_InvoEncId'");
            $FRR1 = FRF_UpInvoDueAmount($FRthis_InvoId, $FRthis_InvoEncId);
            if ($FRR1['FRA'] == 1) {
                $FRR['FRM_DUI'] = "Invoice Due Update Done!";
            } else {
                $FRR['FRM_DUI'] = "Invoice Due Update Failed!";
            }
            //END>>

            $FR_CONN->exec("UPDATE frd_bank_ac SET fr_bnk_ac_balance = (fr_bnk_ac_balance + $FRc_trn_amount), fr_bnk_ac_t_credit = (fr_bnk_ac_t_credit + $FRc_trn_amount) WHERE id = $FRc_bank_ac_id");
            $FR_CONN->exec("UPDATE frd_cprofile SET fr_mtl_balance = (fr_mtl_balance + $FRc_trn_amount) WHERE id = 1");
            $FR_CONN->exec("UPDATE frd_mtl SET fr_b_ac_cur_bal = $FRc_AfterTran_ThisBankAcBal, fr_mtl_cur_bal = $FRc_AfterTran_MTLBal  WHERE id = $FRc_MTL_LastInsertId");

            $FRR['FRA'] = 1;
            $FRR['FRM'] = "PAYMENT UPDATE DOEN";
            $FRR['FRD_MTL_LastInId'] = $FRc_MTL_LastInsertId;
        }catch(PDOException $e){
            $FRR['FRA'] = 2;
            $FRR['FRM'] = "PAYMENT UPDATE FAILED";
            $FRR['FRE'] = "ERROR: ".$e->getMessage()."";
        }
    }

    return $FRR;
}
//ACCOUNTING END>>




//FRD COUNT:-
 FUNCTION FRF_SHIP_PART_CUR_ORDER_C($FR_SP_ID){
    global $FR_CONN;
    $FRR = [];
    $FRQ = $FR_CONN->query("SELECT COUNT(id) FROM frd_order_invo WHERE fr_stat = 4 AND fr_ship_p_id = $FR_SP_ID");
    $FRSD = $FRQ->fetch();
    $FRR['FRc_SHIP_PART_CUR_ORDER_C'] = $FRSD['COUNT(id)'];
    return $FRR;
 }
 FUNCTION FRF_THIS_CUST_ORDER_C($FR_ID){
    global $FR_CONN;
    $FRR = [];
    $FRQ = $FR_CONN->query("SELECT COUNT(id) FROM frd_order_invo WHERE fr_stat > 0 AND fr_cust_id = $FR_ID");
    $FRSD = $FRQ->fetch();
    $FRR['FRc_THIS_CUST_ORDER_C'] = $FRSD['COUNT(id)'];
    return $FRR;
 }
 FUNCTION FRF_THIS_MOB_NUM_ORDER_C($FR_MOBNUM){
    global $FR_CONN;
    $FRR = [];
    $FRQ = $FR_CONN->query("SELECT COUNT(id) FROM frd_order_invo WHERE fr_stat > 0 AND fr_cust_mob1 = '$FR_MOBNUM'");
    $FRSD = $FRQ->fetch();
    $FRR['FRc_THIS_MOB_NUM_ORDER_C'] = $FRSD['COUNT(id)'];
    return $FRR;
 }
 FUNCTION FRF_CUSTOMER_C(){
    global $FR_CONN;

    $FRQ = $FR_CONN->query("SELECT COUNT(id) FROM frd_usr WHERE typee = 'cu'");
    $FRSD = $FRQ->fetch();
    $FRc_T_CUSTOMER_ALL_C = $FRSD['COUNT(id)'];

    $FRQ = $FR_CONN->query("SELECT COUNT(id) FROM frd_usr WHERE typee = 'cu' AND genderr = 1");
    $FRSD = $FRQ->fetch();
    $FRc_T_CUSTOMER_MALE_C = $FRSD['COUNT(id)'];

    $FRQ = $FR_CONN->query("SELECT COUNT(id) FROM frd_usr WHERE typee = 'cu' AND genderr = 2");
    $FRSD = $FRQ->fetch();
    $FRc_T_CUSTOMER_FEMALE_C = $FRSD['COUNT(id)'];

    $FRQ = $FR_CONN->query("SELECT COUNT(id) FROM frd_usr WHERE typee = 'cu' AND genderr = 3");
    $FRSD = $FRQ->fetch();
    $FRc_T_CUSTOMER_NA_C = $FRSD['COUNT(id)'];

    
    $FRR = array(
        array(
            "fr_customer_type" => "All",
            "fr_customer_title" => "ALL",
            "fr_customer_count" => "$FRc_T_CUSTOMER_ALL_C",
        ),
        array(
            "fr_customer_type" => "Male",
            "fr_customer_title" => "Male",
            "fr_customer_count" => "$FRc_T_CUSTOMER_MALE_C",
        ),
        array(
            "fr_customer_type" => "Female",
            "fr_customer_title" => "Female",
            "fr_customer_count" => "$FRc_T_CUSTOMER_FEMALE_C",
        ),
        array(
            "fr_customer_type" => "NA",
            "fr_customer_title" => "N/A",
            "fr_customer_count" => "$FRc_T_CUSTOMER_NA_C",
        ),
      );

    return $FRR;
 }
 FUNCTION FRF_T_PENDING_RR_C($FR_CUSTID=''){
    global $FR_CONN;
    $FRR = [];

    $FRQ = "SELECT COUNT(id) FROM frd_order_items WHERE fr_stat = 5 AND fr_rr_stat = 0";
    if($FR_CUSTID != ""){$FRQ .= " AND fr_cust_id = $FR_CUSTID";}
    $FRQ = $FR_CONN->query("$FRQ");
    $FRSD = $FRQ->fetch();
    $FRR['FRc_T_PENDING_RR_C'] = $FRSD['COUNT(id)'];
    return $FRR;
 }
 FUNCTION FRF_T_INREVIEW_RR_C(){
    global $FR_CONN;
    $FRR = [];
    $FRQ = "SELECT COUNT(id) FROM frd_rating_review WHERE fr_rr_stat = 0";
    $FRQ = $FR_CONN->query("$FRQ");
    $FRSD = $FRQ->fetch();
    $FRR['FRc_T_INREVIEW_RR_C'] = $FRSD['COUNT(id)'];
    return $FRR;
 }
 FUNCTION FRF_T_APPROVE_RR_C(){
    global $FR_CONN;
    $FRR = [];
    $FRQ = "SELECT COUNT(id) FROM frd_rating_review WHERE fr_rr_stat = 1";
    $FRQ = $FR_CONN->query("$FRQ");
    $FRSD = $FRQ->fetch();
    $FRR['FRc_T_APPROVE_RR_C'] = $FRSD['COUNT(id)'];
    return $FRR;
 }
 FUNCTION FRF_T_NOTAPPROVE_RR_C(){
    global $FR_CONN;
    $FRR = [];
    $FRQ = "SELECT COUNT(id) FROM frd_rating_review WHERE fr_rr_stat = 2";
    $FRQ = $FR_CONN->query("$FRQ");
    $FRSD = $FRQ->fetch();
    $FRR['FRc_T_NOTAPPROVE_RR_C'] = $FRSD['COUNT(id)'];
    return $FRR;
 }
 //END>>



//FRD STATUS FULL MORM:-
function FRF_INVOICE_STAT(){
    $FRR = [];

    $FRR[1] = [
        "s_code" => "1",
        "s_title" => "New",
    ];
    $FRR[2] = [
        "s_code" => "2",
        "s_title" => "Confirmed",
    ];
    $FRR[3] = [
        "s_code" => "3",
        "s_title" => "Packaging Complete",
    ];
    $FRR[4] = [
        "s_code" => "4",
        "s_title" => "Shipped",
    ];
    $FRR[5] = [
        "s_code" => "5",
         "s_title" => "Delivered",
    ];
    $FRR[6] = [
        "s_code" => "6",
        "s_title" => "Hold",
    ];
    $FRR[7] = [
        "s_code" => "7",
        "s_title" => "Failed",
    ];
    $FRR[8] = [
        "s_code" => "8",
        "s_title" => "Canceled",
    ];
    $FRR[9] = [
        "s_code" => "9",
        "s_title" => "Pre-Confirmed",
    ];
    $FRR[10] = [
        "s_code" => "10",
        "s_title" => "Payment Pending",
    ];
    $FRR[11] = [
        "s_code" => "11",
        "s_title" => "Print complete",
    ];
    $FRR[12] = [
        "s_code" => "12",
        "s_title" => "Entry complete",
    ];
    $FRR[13] = [
        "s_code" => "13",
        "s_title" => "Stock out",
    ];
    $FRR[14] = [
        "s_code" => "14",
        "s_title" => "Schedule",
    ];
    $FRR[15] = [
        "s_code" => "15",
        "s_title" => "Partial Payment Pending",
    ];
    
    return $FRR;
}
function FRF_MTL_TRANS_TYP($ID){
    $FRR = [];
    
    if($ID == 1){$FRTYPE = "Money Invested";}
    elseif($ID == 2){$FRTYPE = "Online payment receive";}
    elseif($ID == 3){$FRTYPE = "Manual Payment receive";}
    elseif($ID == 4){$FRTYPE = "Manual COD payment receive";}
    elseif($ID == 5){$FRTYPE = "Property & equipment seals";}
    elseif($ID == 6){$FRTYPE = "Bank interest add";}
    elseif($ID == 7){$FRTYPE = "Money received";}
    elseif($ID == 8){$FRTYPE = "Reversal Credit";}

    elseif($ID == 31){$FRTYPE = "Invested Money withdraw";}
    elseif($ID == 32){$FRTYPE = "Cost Entry";}
    elseif($ID == 33){$FRTYPE = "Bank Cost";}
    elseif($ID == 34){$FRTYPE = "Money transfer";}
    elseif($ID == 36){$FRTYPE = "Payment to supplier";}
    elseif($ID == 37){$FRTYPE = "Revarsal Debit";}

    elseif($ID == 61){$FRTYPE = "Profit add to investor A/C";}
    elseif($ID == 62){$FRTYPE = "Loss add to investor A/C";}
    elseif($ID == 63){$FRTYPE = "Products Buy";}
    elseif($ID == 64){$FRTYPE = "Product Return";}

    $FRR['FRc_MTL_TRANS_TYP'] = "$FRTYPE";
    return $FRR;
 }

function FRF_fr_pay_gtw_id_name($ID){
    $FRR = [];
    
    if($ID == 0){$fr_pay_gtw_id_name  = "N/A";}
    elseif($ID == 1){$fr_pay_gtw_id_name = "RESERVED";}
    elseif($ID == 2){$fr_pay_gtw_id_name = "Manual";}
    elseif($ID == 3){$fr_pay_gtw_id_name = "Nagad Online";}
    elseif($ID == 4){$fr_pay_gtw_id_name = "Bkash Online";}
    elseif($ID == 5){$fr_pay_gtw_id_name = "Sslcommerz";}

    $FRR['FRc_fr_pay_gtw_id_name'] = "$fr_pay_gtw_id_name";
    return $FRR;
 }
//END>>




//FRD MIXD:-
function FRF_LoginCustomerP($FR_CUSTOMER_ID){
    global $FR_CONN, $FRD_HURL;
    $FRR = [];

    $frd_q = "SELECT id,namee,email1,typee,picc,genderr,psww FROM frd_usr WHERE id = $FR_CUSTOMER_ID AND typee = 'cu'";
    $FRQ = $FR_CONN->query("$frd_q");
    $FRQ_ROWS = $FRQ->rowCount();
    if($FRQ_ROWS == 1){
        $row = $FRQ->fetch();
        $FRc_CustomerName = $row['namee'];
        if($FRc_CustomerName == ""){ $FRc_CustomerName = $row['email1']; }
        $_SESSION['s_cust_id'] = $row['id'];
        $_SESSION['s_cust_Name'] = $FRc_CustomerName;
        $_SESSION['s_cust_pemail'] = $row['email1'];
        $_SESSION['s_cust_Type'] = $row['typee'];
        $_SESSION['s_cust_pic'] =  $row['picc'];
        $_SESSION['s_cust_gender'] = $row['genderr'];
        $_SESSION['s_cust_psw'] = $row['psww'];
        $_SESSION['customer_pic_path'] = "$FRD_HURL/frd-data/img/customer/".$row['picc']."";

        $FRR['FRA'] = 1;
        $FRR['FRM'] = "LOGIN DONE";
    }else{
        $FRR['FRA'] = 2;
        $FRR['FRM'] = "LOGIN FAILED";
    }

    return $FRR;
}
function FRF_CLOGOUT(){
    unset($_SESSION['s_cust_id']);
    unset($_SESSION['s_cust_Name']);
    unset($_SESSION['s_cust_Type']);
    unset($_SESSION['customer_pic_path']);
    unset($_SESSION['s_cust_pemail']);
    unset($_SESSION['s_cust_psw']);
    unset($_SESSION['s_cust_gender']);
}
//END>>



function FRF_PRO_STOCK_PLUS($FR_INVO_ID){
    global  $FR_CONN;
    $FR_OUTPUT = [];

    //FRD STEP1:-
    try {
        $FRQ = $FR_CONN->prepare("SELECT fr_pro_id,fr_qty FROM frd_order_items WHERE fr_invo_id = :fr_invo_id");
        $FRQ->bindParam(':fr_invo_id', $FR_INVO_ID, PDO::PARAM_INT);
        $FRQ->execute();
        $Rows = $FRQ->rowCount();
        if($Rows > 0 ){
            $ThisInvoAllItemsArr = $FRQ->fetchAll();
        }else{
            $FR_OUTPUT['FRA'] = 2;
            $FR_OUTPUT['FRM'] = "ERROR: THIS INVOICE NO ITEM FOUND";
        }
    } catch(PDOException $e) {
        $FR_OUTPUT['FRA'] = 2;
        $FR_OUTPUT['FRM'] = "ERROR: THIS INVOICE ITEM READ FAILED".$e->getMessage();
    }

    //FRD STEP 2:-
    if(isset($ThisInvoAllItemsArr)){
        foreach($ThisInvoAllItemsArr as $FR_ITEM){
            extract($FR_ITEM);
            //THIS PRODUCT CURRENT STOCK CHECK:-
            $FRQ = $FR_CONN->query("SELECT qtyy FROM frd_products WHERE id = $fr_pro_id");
            extract($FRQ->fetch());
            //THIS PRODUCT STOCK PLUS:-
            try{
                $FRQ = "UPDATE frd_products SET qtyy = qtyy+$fr_qty WHERE id = $fr_pro_id";
                $FR_CONN->exec("$FRQ");
                $FR_OUTPUT['FRA'] = 1;
                $FR_OUTPUT['FRM'] = "PRODUCT STOCK PLUS DONE";
            }catch(PDOException $e){
                $FR_OUTPUT['FRA'] = 2;
                $FR_OUTPUT['FRM'] = "ERROR: PRODUCT STOCK MANGMENT FAILED". $e->getMessage();
            }
        }
    }

    return $FR_OUTPUT;
}



//FRD PATHAO ACCESS TOTAK START:-
function FRF_PATHAO_ATOKEN(){
    global  $FR_CONN;

    $FRQ = $FR_CONN->query("SELECT * FROM frd_qapi_pathao WHERE fr_pat_id = 1");
    extract($FRQ->fetch());
  
    // Set the request headers
    $headers = array(
        'Accept: application/json',
        'Content-Type: application/json',
    );
    // Set the request body
    $data = array(
        'client_id' => "$fr_pat_client_id",
        'client_secret' => "$fr_pat_client_secret",
        'username' => "$fr_pat_client_email",
        'password' => "$fr_pat_client_password",
        'grant_type' => 'password',
    );
    // Initialize cURL session
    $ch = curl_init();
    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, "$fr_pat_base_url/aladdin/api/v1/issue-token");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    // Execute cURL session and get the result
    $result = curl_exec($ch);
    // Check for cURL errors
    if (curl_errno($ch)) {
        echo 'Curl error: ' . curl_error($ch);
    }
    // Close cURL session
    curl_close($ch);

    $FRRD =  json_decode($result, true);
    if(isset($FRRD["access_token"])){
        // $FRc_refresh_token = $FRR["refresh_token"];
        $FRR['FRA'] = 1;
        $FRR['FRc_PATHAO_ATOKEN'] =  $FRRD["access_token"];
    }else{
        $FRR['FRA'] = 2;
        $FRR['FRM'] = $FRRD;
    }

    return $FRR;
}
//FRD PATHAO ACCESS TOTAK END>>






//FRD BKASH PAYMENT GETEAY RELATED:-
    function getToken()
    {
        global  $FR_CONN;

        $FRQ = $FR_CONN->query("SELECT * FROM frd_paygw_bkash WHERE id = 1");
        extract($FRQ->fetch());

        $post_token = array(
            'app_key' => $fr_bka_app_key,
            'app_secret' => $fr_bka_app_secret
        );
        $url = curl_init("$fr_bka_base_url/checkout/token/grant");
        $post_token = json_encode($post_token);
        $header = array(
            'Content-Type:application/json',
            "password:". $fr_bka_password,
            "username:". $fr_bka_username
        );
        
        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $post_token);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $result_data = curl_exec($url);
        curl_close($url);
            
        $response = json_decode($result_data, true);

        $_SESSION["token"] = $response['id_token'];

        return $response['id_token'];
    }

    function create($FRthis_InvoNum,$FRthis_Reference,$FRthis_Amount)
    {       
        getToken();

        global  $FR_CONN,$FRD_HURL;
        $FRQ = $FR_CONN->query("SELECT * FROM frd_paygw_bkash WHERE id = 1");
        extract($FRQ->fetch());

        $post_token = array(
            'mode' => '0011',
            'amount' => $FRthis_Amount,
            'payerReference' => "$FRthis_Reference",
            'callbackURL' => "$FRD_HURL/CallbackBkash", // Your callback URL
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => "$FRthis_InvoNum"
        );

        $url = curl_init("$fr_bka_base_url/checkout/create");
        $post_token = json_encode($post_token);
        $header = array(
            'Content-Type:application/json',
            'Authorization:'. $_SESSION["token"],
            'X-APP-Key:'. $fr_bka_app_key
        );

        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $post_token);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $result_data = curl_exec($url);
        curl_close($url);

        $response = json_decode($result_data, true);

        header("Location: ".$response['bkashURL']); 
        exit;
    }

    function execute($paymentID)
    {
        global  $FR_CONN,$FRD_HURL;
        $FRQ = $FR_CONN->query("SELECT * FROM frd_paygw_bkash WHERE id = 1");
        extract($FRQ->fetch());

        $post_token = array(
            'paymentID' => $paymentID
        );
        
        $url = curl_init("$fr_bka_base_url/checkout/execute");
        $post_token = json_encode($post_token);
        $header = array(
            'Content-Type:application/json',
            'Authorization:'. $_SESSION["token"],
            'X-APP-Key:'. $fr_bka_app_key
        );
        
        curl_setopt($url, CURLOPT_HTTPHEADER, $header);
        curl_setopt($url, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($url, CURLOPT_POSTFIELDS, $post_token);
        curl_setopt($url, CURLOPT_FOLLOWLOCATION, 1);
        $result_data = curl_exec($url);
        curl_close($url);
        
        return $result_data;
    } 
//END>>






//FRD OPTION || HTML TYPE START:-
function FRF_OPTION_BNK_AC(){
    $FRR_HTML = "";

    $FRR = FR_QSEL("SELECT * FROM frd_bank_ac WHERE fr_stat = 'active' ORDER BY id ASC","ALL");
    if($FRR['FRA']==1){ 
        foreach($FRR['FRD'] as $FR_ITEM){
            extract($FR_ITEM);
            $FRR_HTML .="<option value='$id'>$fr_bank_name  [$fr_bnk_ac_number] [$fr_bnk_ac_balance ৳]</option>";
        }
    } else{ 
        //   PR($FRR);
        $FRR_HTML .= "<option value=''>No Data Found</option>";
    }

    return $FRR_HTML;
}
function FRF_OPTION_SHIP_PART(){
    $FRR_HTML = "";

    $FRR = FR_QSEL("SELECT * FROM frd_shippart ORDER BY id ASC","ALL");
    if($FRR['FRA']==1){ 
        foreach($FRR['FRD'] as $FR_ITEM){
            extract($FR_ITEM);
            $FRR_HTML .="<option value='$id'>$frd_namee</option>";
        }
    } else{ 
        //   PR($FRR);
        $FRR_HTML .= "<option value=''>No Data Found</option>";
    }

    return $FRR_HTML;
}

function FRF_OPTION_CAT(){
    $FRR_HTML = "";

    $FRR = FR_QSEL("SELECT * FROM frd_categoriess WHERE statuss = 1 ORDER BY id ASC","ALL");
    if($FRR['FRA']==1){ 
        foreach($FRR['FRD'] as $FR_ITEM){
            extract($FR_ITEM);
            $FRR_HTML .="<option value='$id'>$bn_name</option>";
        }
    } else{ 
        //   PR($FRR);
        $FRR_HTML .= "<option value=''>No Data Found</option>";
    }

    return $FRR_HTML;
}
function FRF_OPTION_COST_CAT(){
    $FRR_HTML = "";
    $FRR = FR_QSEL("SELECT * FROM frd_cost_cat WHERE fr_stat = 1 ORDER BY id ASC","ALL");
    if($FRR['FRA']==1){ 
        foreach($FRR['FRD'] as $FR_ITEM){
            extract($FR_ITEM);
            $FRR_HTML .="<option value='$id'>$fr_cost_cat_name</option>";
        }
    } else{ 
        $FRR_HTML .= "<option value=''>No Cost Category Found</option>";
    }
    return $FRR_HTML;
}
function FRF_OPTION_SUPPLIERS(){
    $FRR_HTML = "";
    $FRR = FR_QSEL("SELECT fr_supp_id,fr_supp_name FROM frd_suppliers WHERE fr_supp_stat = 'Active' ORDER BY fr_supp_t_payable ASC","ALL");
    if($FRR['FRA']==1){ 
        foreach($FRR['FRD'] as $FR_ITEM){
            extract($FR_ITEM);
            $FRR_HTML .="<option value='$fr_supp_id'>$fr_supp_name</option>";
        }
    } else{ 
        $FRR_HTML .= "<option value='0'>No Supplier Found</option>";
    }
    return $FRR_HTML;
}
//FRD OPTION || HTML TYPE END>>

function FRF_RADIO_COST_CAT(){
    $FRR_HTML = "";

    $FRR = FR_QSEL("SELECT * FROM frd_cost_cat WHERE fr_stat = 1 ORDER BY id ASC","ALL");
    if($FRR['FRA']==1){ 
        foreach($FRR['FRD'] as $FR_ITEM){
            extract($FR_ITEM);
            $FRR_HTML .="<input type='radio' name='f_cost_cat_id' value='$id' required> $fr_cost_cat_name <br>";
        }
    } else{ 
        $FRR_HTML .= "<span>No Cost Category Found</span>";
    }

    return $FRR_HTML;
}
function FRF_FBProFeedXmlData($FR_PATH_HD){
    global $FRD_HURL;

    extract(FRF_COMP_NAME());

    $FRc_OP_FbProFeedHtml = "<?xml version='1.0' encoding='utf-8'?>
      <rss version='2.0' xmlns:g='http://base.google.com/ns/1.0' xmlns:atom='http://www.w3.org/2005/Atom'>
        <channel> 
            <title> $FRc_COMP_NAME - Last Update: ".date('d-M-Y h:i:s A',time())."</title>
            <description>Product Feed for Facebook</description> 
            <link>$FRD_HURL</link>
            <atom:link href='$FRD_HURL/frd-data/mixd/FbShopProductFeed.xml' rel='self' type='application/rss+xml' />
    ";

    $FRR = FR_QSEL("SELECT * FROM frd_products WHERE statuss = 1 ORDER BY id LIMIT 0,3000","ALL");
    if($FRR['FRA']==1){ 

        foreach($FRR['FRD'] as $FR_ITEM){
            extract($FR_ITEM);

            if($qtyy > 0){ $FRc_Availability = "in stock"; }else{$FRc_Availability = "out of stock";}
            if($pro_typ == 1){ $v_mp_id = $id;}


            if($siz_name == ""){$FRc_SizeName = "NA";}else{ $FRc_SizeName = $siz_name; }
            $FRc_SizeName = preg_replace("/[^a-zA-Z0-9 ]/", "", $FRc_SizeName);


            $FRc_CATT_NAME = "NA";
            if($r_cat_1 > 0){ extract(FRF_CATT_NAME($r_cat_1)); }
            $FRc_CATT_NAME = preg_replace("/&/","and",$FRc_CATT_NAME);

            $FRc_BRAND_NAME = "NA";
            if($r_brand > 0){ extract(FRF_BRAND_NAME($r_brand)); }
            if($FRc_BRAND_NAME == ""){ $FRc_BRAND_NAME = "NA";}


            $bn_name = preg_replace("/&/","and",$bn_name);
            $fr_slug = preg_replace("/&/","and",$fr_slug);
            $fr_short_desc = preg_replace("/&/","and",$fr_short_desc);

            $FRc_OP_FbProFeedHtml .= "
                <item>
                    <g:item_group_id>IGID$v_mp_id</g:item_group_id>
                    <g:id>$id</g:id>
                    <g:size>$FRc_SizeName</g:size>
                    <g:brand>$FRc_BRAND_NAME</g:brand>
                    <g:availability>$FRc_Availability</g:availability>
                    <g:condition>New</g:condition>
                    <g:description>$fr_short_desc</g:description>
                    <g:image_link>$FRD_HURL/frd-data/img/product/$pic_1</g:image_link>
                    <g:link>$FRD_HURL/product/$id/$fr_slug</g:link>
                    <g:title>$bn_name</g:title>
                    <g:sale_price>BDT $market_pri</g:sale_price>
                    <g:price>BDT $sells_pri</g:price>
                    <g:google_product_category>$g_cat_id</g:google_product_category>
                    <g:product_type>$FRc_CATT_NAME</g:product_type>
                    <g:identifier_exists>no</g:identifier_exists>
                </item>
            ";
        }

        $FRc_OP_FbProFeedHtml .= "
            </channel>
        </rss>
        ";

            $FR_fh = fopen( $FR_PATH_HD."frd-data/mixd/FbShopProductFeed.xml", "w" );
            $FR_fdata = "$FRc_OP_FbProFeedHtml";
            if(fwrite( $FR_fh, $FR_fdata )){
                FR_TAL("FB Shop Feed XML Data Update Done","success");
            }else{
                FR_TAL("FB Shop Feed XML Data Update Failed","success");
            }
            fclose( $FR_fh );

    } else{ return "NO DATA FOUND"; }
}
//END>>