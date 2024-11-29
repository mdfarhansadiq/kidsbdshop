<?php 
$FR_OP_HTML = "";

$FR_VC_SESSION = "";
$FR_VC_POST = "";

$FRc_Filtering_HTML = "";
$FRc_SearchOPuser = "";
$FRc_Filt_OA_Usr = "";//FILTER ORDER Assignee USER
$FRc_filt_complain = "";
$FRc_schedule_d_date = "";

$FRc_BulkActionForm = 0;
$FRc_ShowProducts = 0;


$FRcc_frplug_api_steadfast = "frd_dn";
$FRcc_frplug_api_pathao = "frd_dn";
    
//FRD VC________
    if(isset($_SESSION['sUsrId'])){ extract($_SESSION); $FR_VC_SESSION = 1; } else{ $FR_OP_HTML .= "<h6>Access Denied 1  </h6>"; goto THIS_LAST; }

//FRD DATA RECEIVEING:-
    if( isset($_POST['f_search_stat'])){
         $FRc_InvoiceStatus = $_POST['f_search_stat'];
         $FRc_SearchDeliveryPart = $_POST['f_search_DeliveryPart'];
         $FRc_SDATE = $_POST['f_filt_SDATE'];
         $FRc_EDATE = $_POST['f_filt_EDATE'];
         $FRs_ASC_DESC = $_POST['f_filt_asc_desc'];
         $FRc_Limit = $_POST['f_filt_limit'];
         $FRc_Filt_OA_Usr = $_POST['f_Filt_OA_Usr'];
         $FR_VC_POST = 1; 
    }
if(isset($_POST['f_search_op_user']) ){ $FRc_SearchOPuser = $_POST['f_search_op_user']; }
if(isset($_POST['f_bulk_action_form']) ){ $FRc_BulkActionForm = $_POST['f_bulk_action_form']; }
if(isset($_POST['f_filt_complain']) ){ $FRc_filt_complain = $_POST['f_filt_complain']; }
if(isset($_POST['f_filt_schedule_d_date']) ){ $FRc_schedule_d_date = $_POST['f_filt_schedule_d_date']; }

//FRD_VC_______________________
if( isset($_POST['f_search_order_id']) ){
    $FRc_SearchOrderId = $_POST['f_search_order_id'];
    $FR_VC_POST = 1; 
}
//FRD_VC_______________________
if( isset($_POST['f_search_text']) ){
    $FRc_SearchText = $_POST['f_search_text'];
    $FR_VC_POST = 1; 
}





//FRD CUSTOM DATA MAKING:-
    $FRc_PHURL_THIS = $FR_SP_HURL_DP;
    $FRF_OPTION_SHIP_PART = FRF_OPTION_SHIP_PART();
    //FRD SOFTWARE CONFIG TABLE DATA:-
    $FRR = FR_QSEL("SELECT frplug_api_steadfast,frplug_api_pathao FROM frd_soft_config WHERE id = 1","");
    if($FRR['FRA']==1){ 
        extract($FRR['FRD']);
        if($frplug_api_steadfast == 1){ $FRcc_frplug_api_steadfast = "";}
        if($frplug_api_pathao == 1){ $FRcc_frplug_api_pathao = "";}
    } else{ 
        ECHO_4($FRR['FRM']);
        ECHO_4("FRH:JDJE7YEHDNXUX");
     }
    //END>>




    if(isset($FRc_SDATE)){ 

        if($FRc_InvoiceStatus == 1){ $FRc_FiltDateColumn = "fr_o_date";}
        elseif($FRc_InvoiceStatus == ""){ $FRc_FiltDateColumn = "fr_o_date";}
        elseif($FRc_InvoiceStatus == 2){ $FRc_FiltDateColumn = "fr_o_cnfirm_date";}
        elseif($FRc_InvoiceStatus == 3){ $FRc_FiltDateColumn = "fr_o_pack_date";}
        elseif($FRc_InvoiceStatus == 4){ $FRc_FiltDateColumn = "fr_o_ship_date";}
        elseif($FRc_InvoiceStatus == 5){ $FRc_FiltDateColumn = "fr_o_ddone_date";}
        elseif($FRc_InvoiceStatus == 7){ $FRc_FiltDateColumn = "fr_dfail_date";}
        elseif($FRc_InvoiceStatus == 8){ $FRc_FiltDateColumn = "fr_o_cancel_date";}

        if($FRs_ASC_DESC == "DESC"){
            $FRc_Filtering_HTML .= "<span class='text-success'> Old to New </span>";
        }else{
            $FRc_Filtering_HTML .= "<span class='text-success'> New to Old </span>";
        }
        $FRc_Filtering_HTML .= "<span class='text-danger'> & Date $FRc_SDATE Between $FRc_EDATE </span>";
    }

    


//FRD ORDER FETCH QUERY MAKING:-
        $FRQ = "SELECT * FROM frd_order_invo WHERE fr_stat != 0";
        if($FRc_InvoiceStatus != ""){ 
            $FRQ .= " AND fr_stat = $FRc_InvoiceStatus"; 

            $FRR = FRF_INVOICE_STAT();
            $FRc_OrderStatusName = $FRR[$FRc_InvoiceStatus]['s_title'];
            $FRc_Filtering_HTML .= "<span class='text-primary'> & Order Status: $FRc_OrderStatusName </span>";
        }
        if($FRc_SearchDeliveryPart != ""){ 
            $FRQ .= " AND fr_ship_p_id = $FRc_SearchDeliveryPart"; 

            extract(FRF_SHIP_PART_NAME($FRc_SearchDeliveryPart));
            $FRc_Filtering_HTML .= "<span class='text-danger'> & Delivery Partner: $FRc_SHIP_PART_NAME </span>";
        }
        if($FRc_SearchOPuser != ""){ 
            $FRQ .= " AND fr_o_p_usrid = $FRc_SearchOPuser"; 

            extract(FR_USR_NAME($FRc_SearchOPuser));
            $FRc_Filtering_HTML .= "<span class='text-info'> & Order Place By: $FRc_USR_NAME </span>";
        }
        if($FRc_Filt_OA_Usr != ""){ 
            $FRQ .= " AND fr_o_a_usrid = $FRc_Filt_OA_Usr"; 
        }
        if($FRc_filt_complain != ""){ 
            $FRQ .= " AND fr_c_stat = $FRc_filt_complain"; 
        }
        $FRc_Filtering_HTML .= "<span class='text-info'> & Limit: $FRc_Limit </span>";
        if(isset($FRc_FiltDateColumn)){ $FRQ .= " AND $FRc_FiltDateColumn BETWEEN '$FRc_SDATE' AND '$FRc_EDATE'"; }
        $FRQ .= " ORDER BY id $FRs_ASC_DESC LIMIT 0,$FRc_Limit";


    //FRD FULLOVERWRITE QUERY MAKE => FOR SCHEDULE DELEVERY ORDER SEARCH:-
        if($FRc_schedule_d_date != ""){
            $FRQ = "SELECT * FROM frd_order_invo WHERE fr_stat != 0 AND fr_o_schedule_date = '$FRc_schedule_d_date'";
        }
    //FRD FULLOVERWRITE QUERY MAKE => FOR ORDER ID SEARCH:-
        if(isset($FRc_SearchOrderId)){
            $FRQ = "SELECT * FROM frd_order_invo WHERE fr_stat != 0 AND id = '$FRc_SearchOrderId'";
        }
    //FRD FULL OVERWRITE QUERY => FOR SEARCH TEXT:-
        if(isset($FRc_SearchText)){
            $FRQ = "SELECT * FROM frd_order_invo WHERE fr_stat != 0";
            $FRQ .= " AND (fr_cust_mob1 LIKE '%$FRc_SearchText%' OR fr_cust_name LIKE '%$FRc_SearchText%' OR fr_cust_addres LIKE '%$FRc_SearchText%' OR fr_cust_id='$FRc_SearchText' OR fr_cust_uid='$FRc_SearchText' OR fr_cust_ip='$FRc_SearchText') ORDER BY id $FRs_ASC_DESC LIMIT 0,30";
        }
//END>>
   


//FRD OPARATION START:-
     if($FR_VC_SESSION == 1 and $FR_VC_POST == 1){

    
        if($FRc_Filtering_HTML != ""){
            // $FR_OP_HTML = "Filtering: $FRc_Filtering_HTML <br> <br>";
        }

         $FR_OP_HTML .="<form id='form_order_list' action='' method='POST' target='_self'>";


        if($FRc_BulkActionForm == 1){
             $FR_OP_HTML .= "
             <div class='table-responsive'>
                <table class='table'>
                <tr>
                    <td>
                        <select class='form-control' name='f_bulk_action_type' id='f_bulk_action_type' required>
                            <option value=''>Select Bulk Action</option>
                            <option value='om-BulkInvoicePrint'>Bulk Invoice Print</option>
                            <option value='om-BulkOrderAssigne'>Bulk Assigne</option>
                            <option value='om-BulkOrderUpdate'>Bulk Order Update</option>
                            <option value='om-BulkBookingXLS_Redx'>Redx Booking XLS File Downlode</option>
                            <option value='om-BulkBookingXLS_Pathow'>Pathao Booking XLS File Downlode</option>
                            <option value='om-BulkBookingXLS_steadfast'>Steadfast Booking XLS File Downlode</option>
                            <option class='$FRcc_frplug_api_steadfast' value='om-BookingApi_SteadFast'>Send pickup request to the SteadFast courier</option>
                            <option class='$FRcc_frplug_api_pathao' value='om-BookingApi_Pathao'>Pathao Booking By API</option>
                        </select>
                    </td>
                    <td id='f_bulk_next_status_td'>
                        <select class='form-control' name='f_bulk_next_status' id='f_bulk_next_status'>
                            <option value=''>Select Next Status</option>
                            <option value='EntryComplete'>Entry Complete</option>
                            <option value='PrintDone'>Print Complete</option>
                            <option value='Schedule'>Schedule</option>
                            <option value='StockOut'>Stock Out</option>
                            <option value='ShippedDone'>Shipped Complete</option>
                            <option value='DeliveryComplete'>Delivery Complete</option>
                        </select>
                    </td>
                    <td>
                    <button type='submit' class='btn btn-primary btn btn-block'> <span class='glyphicon glyphicon-flash'></span> Confirm & Go</button>
                    </td>
                </tr>
                </table>
            </div>
             ";
        }

         $FR_OP_HTML .="
            <div class='frUsrList1'>
            <div class='table-responsive'>
                <table class='table user-list'>
                    <thead>
                        <tr class='alert alert-danger boldd'>
                            <th><span><input type='checkbox' id='frtrig_chacked_all'></span></th>
                            <th><span>SL</span></th>
                            <th class='text-center'><span>Action</span></th>
                            <th><span>Customer</span></th>
                            <th><span>Product</span></th>
                            <th class='text-right'><span>Total</span></th>
                            <th><span>Assigned</span></th>
                            <th><span>Others</span></th>
                        </tr>
                    </thead>
                    <tbody>
                    ";

                    // echo "$FRQ";   
                    $FRR = FR_QSEL("$FRQ","ALL");
                    if ($FRR['FRA'] == 1) {

                        $FRc_SL = 1;
                        foreach($FRR['FRD'] as $FR_ITEM){
                            extract($FR_ITEM);
 
                            if($fr_stat == ""){ $fr_stat_M = ""; $FR_cc1 = ""; }
                            elseif($fr_stat == 1){ $fr_stat_M = "NEW"; $FR_cc1 = "label-default"; }
                            elseif($fr_stat == 2){ $fr_stat_M = "Confirmed"; $FR_cc1 = "label-success"; }
                            elseif($fr_stat == 3){ $fr_stat_M = "Packaging Complete"; $FR_cc1 = "label-success"; }
                            elseif($fr_stat == 4){ $fr_stat_M = "Shipped"; $FR_cc1 = "label-primary"; }
                            elseif($fr_stat == 5){ $fr_stat_M = "Delivered"; $FR_cc1 = "label-success"; }
                            elseif($fr_stat == 6){ $fr_stat_M = "Hold"; $FR_cc1 = "label-info"; }
                            elseif($fr_stat == 7){ $fr_stat_M = "Failed"; $FR_cc1 = "label-danger"; }
                            elseif($fr_stat == 8){ $fr_stat_M = "Canceled"; $FR_cc1 = "label-danger"; }
                            elseif($fr_stat == 9){ $fr_stat_M = "Pre-Order"; $FR_cc1 = "label-warning"; }
                            elseif($fr_stat == 10){ $fr_stat_M = "Payment Pending"; $FR_cc1 = "label-primary"; }
                            elseif($fr_stat == 11){ $fr_stat_M = "Print complete"; $FR_cc1 = "label-primary"; }
                            elseif($fr_stat == 12){ $fr_stat_M = "Entry complete"; $FR_cc1 = "label-info"; }
                            elseif($fr_stat == 13){ $fr_stat_M = "Stock out"; $FR_cc1 = "label-danger"; }
                            elseif($fr_stat == 14){ $fr_stat_M = "Schedule"; $FR_cc1 = "label-warning"; }
                            elseif($fr_stat == 15){ $fr_stat_M = "Partial Payment Pending"; $FR_cc1 = "label-warning"; }

                            $FRc_GuestOrderHTML = "";
                            if($fr_cust_id == 1){
                                $FRc_GuestOrderHTML = "&nbsp; &nbsp; <span class='label label-warning'> Guest </span>";
                            }else{
                                $FRc_GuestOrderHTML = "&nbsp; &nbsp; <span class='label label-default'>Customer</span>";
                            }

                            $fr_ship_p_id_M = "";
                            if($fr_ship_p_id != ""){
                                extract(FRF_SHIP_PART_NAME($fr_ship_p_id));
                                $fr_ship_p_id_M = "<br><span>$FRc_SHIP_PART_NAME</span>";
                            }

                    
                            $fr_ship_track_code_HTML = "";
                            if($fr_ship_track_code != "" AND $fr_ship_track_code != "NA"){
                                $fr_ship_track_code_HTML = "Tracking-Code: $fr_ship_track_code <br>";
                            }
                            $fr_ship_consignment_id_HTML = "";
                            if($fr_ship_consignment_id != ""){
                                $fr_ship_consignment_id_HTML = "Consignment-ID: $fr_ship_consignment_id <br>";
                            }


                            $fr_o_a_usrid_NAME = "NA";
                            if($fr_o_a_usrid > 0){
                                extract(FR_USR_NAME($fr_o_a_usrid));
                                $fr_o_a_usrid_NAME = $FRc_USR_NAME;
                            }

 
                        //FRD IVOICE ALL ITEM FETCH:-
                            $FRc_ProductsHtml = "";
                            $FRR = FR_QSEL("SELECT fr_pro_pic_1,fr_pro_title,fr_size_name FROM frd_order_items WHERE fr_invo_id = $id ", "ALL");
                            if ($FRR['FRA'] == 1) {
                                foreach ($FRR['FRD'] as $FR_ITEM) {
                                    extract($FR_ITEM);
                                    $FRc_ProductsHtml .= "
                                        <h6>
                                        <img src='$FRD_HURL/frd-data/img/product/$fr_pro_pic_1' style='width: 30px; height: 30px'/> $fr_pro_title $fr_size_name
                                        </h6>
                                    ";
                            }
                            } else {
                                PR($FRR);
                            }
                        //END>

                        $FRc_OrderProsNoteHtml = "";
                        $FRR = FR_QSEL("SELECT fr_opn_note,fr_opn_time,fr_opn_by_name FROM frd_order_p_note WHERE fr_opn_order_id = $id ORDER BY id DESC LIMIT 0,1","ALL");
                        if($FRR['FRA']==1){  
                                $FRc_Class = "active_event";
                                foreach($FRR['FRD'] as $FR_ITEM){
                                    extract($FR_ITEM);
                                    $FRc_OPN_Time = date('d-M-Y h:i A',$fr_opn_time);
                                    $FRc_OrderProsNoteHtml = "Note: $fr_opn_note <small>[By $fr_opn_by_name] [$FRc_OPN_Time]</small> <br>";
                                }
                        } else{ 
                            // $FRc_OrderProsNoteHtml = "No Note Found <br>";
                        }
                             


                            $FR_OP_HTML .= "
                                    <tr>
                                        <td>
                                        <input type='checkbox' name='f_chacked_orders_id[]' class='f_chacked_orders_id' value='$id'>
                                        </td>
                                        <td>
                                            SL: $FRc_SL <br>
                                            INVO-ID: #$id <br>
                                            $fr_ship_track_code_HTML
                                            $fr_ship_consignment_id_HTML
                                            <span class='label $FR_cc1'> $fr_stat_M </span>
                                        </td>

                                        <td width='50px' class='text-center'>
                                            <a href='$FRc_PHURL_THIS/om-InvoiceEdit/$fr_enc_id' target='_self' class='text-decoration-none btn btn-success btn-xs mb-5'> 
                                              <i class='glyphicon glyphicon-pencil'></i> 
                                            </a>

                                            <a href='$FRD_HURL/frdsp/dp/om-BulkInvoicePrint/$fr_enc_id' target='_blank' class='table-link'>
                                                <span class='btn btn-primary btn-xs mb-5'> 
                                                    <i class='glyphicon glyphicon-print'></i>
                                                </span>
                                            </a>


                                            <a href='$FRD_HURL/track/$fr_enc_id' target='_blank' class='table-link'>
                                                <span class='btn btn-info btn-xs mb-5'> 
                                                    <i class='glyphicon glyphicon-sunglasses'></i>
                                                </span>
                                            </a>
                                        </td>

                                        <td width='200px'>
                                         $fr_cust_name $FRc_GuestOrderHTML <br> $fr_cust_mob1 <br>
                                         <i>$fr_cust_addres</i><br>
                                         ".date('d-M-Y',$fr_o_time)." <br> 
                                        </td>

                                        <td>
                                          $FRc_ProductsHtml
                                        </td>

                                        <td class='text-right'>Payable:$fr_payable/- <br> Due:$fr_invo_due/-</td>
                                        <td>$fr_o_a_usrid_NAME</td>

                                        

                                        <td>
                                        $FRc_OrderProsNoteHtml
                                        $fr_ship_p_id_M
                                        </td>
                                    </tr>
                            ";

                            $FRc_SL = ($FRc_SL + 1);
                        }
                    } else {
                        // PR($FRR);
                        $FR_OP_HTML .= "
                        <tr>
                            <td colspan='12' class='text-center text-danger'>
                            কোন অর্ডার পাওয়া যায়নি
                            </td>
                        </tr>
                        ";
                    }


            $FR_OP_HTML .="
                    </tbody>
                </table>
            </div>
            </div>


        </form>
        ";
     }


THIS_LAST:
echo $FR_OP_HTML;
?>

<script>
$(document).ready(function(){
	
    $('#f_bulk_next_status_td').hide();
    $('#f_ParcelBookingId').hide();
  

    
    $('#f_bulk_action_type').on('change', function() {
         var f_bulk_action_type = $(this).val();
        //  alert(f_bulk_action_type);
        
        $('#form_order_list').attr('action', f_bulk_action_type);

          if(f_bulk_action_type == "om-BulkInvoicePrint"){
            $('#form_order_list').attr('target', "_blank");
          }
          if(f_bulk_action_type == "om-BulkOrderUpdate"){
             $('#f_bulk_next_status_td').show();
             $('#form_order_list').attr('target', "_self");
          }else{
            $('#f_bulk_next_status_td').hide();
          }
    });


    $('#f_bulk_next_status').on('change', function() {
         var f_bulk_next_status = $(this).val();
    });






    $("#frtrig_chacked_all").change(function() {
        if($(this).prop('checked')){
            $('.f_chacked_orders_id').attr('checked', true);
        }else{
            $('.f_chacked_orders_id').attr('checked', false);
        }
    });

});
</script>