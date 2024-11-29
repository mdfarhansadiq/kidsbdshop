<?php 
$FR_OP_HTML = "";
//FRD VC NEED:-
    $FR_VC_SESSION = "";
    $FR_VC_POST = "";
//FRD VC________
    if(isset($_SESSION['sUsrId'])){ extract($_SESSION); $FR_VC_SESSION = 1; } else{ $FR_OP_HTML .= "<h6>Access Denied 1  </h6>"; goto THIS_LAST; }
//FRD VC________
    if( isset($_POST['FrType'])){
         $FRc_CustomerType = $_POST['FrType'];
         $FR_VC_POST = 1; 
    }
//FRD_VC_______________________
    if( isset($_POST['f_search_text']) ){
        $FRc_SearchText = $_POST['f_search_text'];
        $FR_VC_POST = 1;
    }
//FRD_VC_______________________
    if( isset($_POST['f_search_id']) ){
        $FRc_SearchCustomerId = $_POST['f_search_id'];
        $FR_VC_POST = 1;
    }

//FRD CUSTOM DATA MAKING:-
    $FRc_PHURL_THIS = $FR_SP_HURL_DP;
    
    $FRs_ASC_DESC = "DESC";
    if(isset($_SESSION['FRs_ASC_DESC'])){ $FRs_ASC_DESC = $_SESSION['FRs_ASC_DESC'];}



//FRD OPARATION START:-
     if($FR_VC_SESSION == 1 and $FR_VC_POST == 1){


        $FR_OP_HTML .="
        <br>
        <form id='form_customer_list' action='' method='POST' target='_self'>

        <div class='table-responsive'>
            <table class='table'>
            <tr>
                <td>
                    <select class='form-control' name='f_bulk_action_type' id='f_bulk_action_type' required>
                        <option value=''>Bulk Action</option>
                        <option value=''>Send SMS</option>
                        <option value=''>Downlode</option>
                    </select>
                </td>
                <td>
                   <button type='submit' class='btn btn-success btn btn-block'> <span class='glyphicon glyphicon-flash'></span> Confirm & Go</button>
                </td>
            </tr>
            </table>
        </div>

        <div class='frUsrList1'>
        <div class='table-responsive'>
            <table class='table user-list'>
                <thead>
                    <tr class='alert alert-danger boldd'>
                        <th><span><input type='checkbox' id='frtrig_chacked_all'></span></th>
                        <th><span>Images</span></th>
                        <th><span>G</span></th>
                        <th><span>Customer</span></th>
                        <th><span>Contact</span></th>
                        <th><span>Registration</span></th>
                        <th><span>Status</span></th>
                        <th><span>Login</span></th>
                        <th><span>Edit</span></th>
                        <th><span>Login</span></th>
                    </tr>
                </thead>
                <tbody>
                 ";

                //FRD ORDER STSTUS BASE SEARCH:-
                    if(isset($FRc_CustomerType)){
                        $FRQ = "SELECT * FROM frd_usr WHERE typee = 'cu'";
                        if($FRc_CustomerType == "Male"){$FRQ .= " AND genderr = 1";}
                        if($FRc_CustomerType == "Female"){$FRQ .= " AND genderr = 2";}
                        if($FRc_CustomerType == "NA"){$FRQ .= " AND genderr = 3";}
                        $FRQ .= " ORDER BY id $FRs_ASC_DESC LIMIT 0,150";
                    }

                //FRD FULL OVERWRITE QUERY MAKE => FOR SEARCH TEXT:-
                    if(isset($FRc_SearchText)){
                        $FRQ = "SELECT * FROM frd_usr WHERE typee = 'cu'";
                        $FRQ .= " AND (namee LIKE '%$FRc_SearchText%' OR email1 LIKE '%$FRc_SearchText%' OR phon1 LIKE '%$FRc_SearchText%' OR addresss LIKE '%$FRc_SearchText%' ) ORDER BY id $FRs_ASC_DESC LIMIT 0,30";
                    }
                    
                //FRD FULLOVERWRITE QUERY MAKE => FOR ID SEARCH:-
                    if(isset($FRc_SearchCustomerId)){
                        $FRQ = "SELECT * FROM frd_usr WHERE typee = 'cu' AND id = '$FRc_SearchCustomerId'";
                    }

                
                //  echo "$FRQ";   
                $FRR = FR_QSEL("$FRQ","ALL");
                if ($FRR['FRA'] == 1) {

                    foreach($FRR['FRD'] as $FR_ITEM){
                        extract($FR_ITEM);

                        if($statuss == 1){ $fr_stat_M = "Active"; $FR_cc1 = "label-success"; }
                        if($statuss == 2){ $fr_stat_M = "Block"; $FR_cc1 = "label-danger"; }

                        if($genderr == 1){ $genderr_M = "Male"; $FR_cc2 = "label-primary"; }
                        if($genderr == 2){ $genderr_M = "Female"; $FR_cc2 = "label-info"; }
                        if($genderr == 3){ $genderr_M = "N/A"; $FR_cc2 = "label-danger"; }

                        $FR_cc3 = "";
                        $FR_cc4 = "";
                        if($fr_u_fb_profile_username == ""){$FR_cc3 = "frd_dn";}
                        if($fr_u_whatsapp_num == ""){$FR_cc4 = "frd_dn";}




                        $FR_OP_HTML .= "
                                <tr>
                                    <td><input type='checkbox' name='f_chacked_orders_id[]' class='f_chacked_orders_id' value='$id'></td>
                                    <td>
                                      <img src='$FRD_HURL/frd-data/img/customer/$picc' alt='' max-height='100px' width='auto'><br>
                                    </td>
                                    <td><span class='label $FR_cc2'> $genderr_M </span></td>
                                    <td title='$addresss'>[$id] $namee</td>
                                    <td>
                                    <a href='tel:$email1' class='fr-text-deco-none fr-color-111'><span class='glyphicon glyphicon-earphone'></span> $email1</a>

                                    <a href='https://facebook.com/$fr_u_fb_profile_username' class='btn btn-primary btn-xs $FR_cc3' target='_blank'><i class='fa-brands fa-facebook'></i></a>

                                    <a href='https://m.me/$fr_u_fb_profile_username' class='btn btn-danger btn-xs $FR_cc3' target='_blank'><i class='fa-brands fa-facebook-messenger'></i></a>

                                    <a href='https://wa.me/$fr_u_whatsapp_num' class='btn btn-info btn-xs $FR_cc4' target='_blank'><i class='fa-brands fa-whatsapp'></i></a>
                                    </td>

                                    <td>".date('d-M-Y',$timee)."</td>
                                    <td><span class='label $FR_cc1'> $fr_stat_M </span></td>
                                    <td class='text-center'>$loginn</td>
                                    <td>
                                      <a href='$FRc_PHURL_THIS/crm-CustomerEdit/?editid=$id' target='_self' class='text-decoration-none btn btn-primary btn-xs'> <i class='glyphicon glyphicon-pencil'></i> 
                                      </a>
                                    </td>
                                    <td>
                                      <a href='$FRc_PHURL_THIS/crm-LoginToCustomerP/cplogin/$id' target='_blank' class='text-decoration-none btn btn-danger btn-xs'> <i class='glyphicon glyphicon-log-in'></i>
                                    </td>
                                </tr>
                        ";
                    }
                } else {
                    // PR($FRR);
                    $FR_OP_HTML .= "
                    <tr>
                        <td colspan='8' class='text-center text-danger'>
                            No Custome Found
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
	

    $('#f_bulk_action_type').on('change', function() {
         var f_bulk_action_type = $(this).val();
        //  alert(f_bulk_action_type);
        $('#form_order_list').attr('action', f_bulk_action_type);
    });



    $("#frtrig_chacked_all").change(function() {
        if($(this).prop('checked')){
            $('.f_chacked_orders_id').attr('checked', true);
        }else{
            $('.f_chacked_orders_id').attr('checked', false);
        }
    });



    $('#f_bulk_action_type').on('change', function() {
         var f_bulk_action_type = $(this).val();
        //  alert(f_bulk_action_type);
        $('#form_customer_list').attr('action', f_bulk_action_type);
        swal("Comming Soon... This Features!","","info");

        //   if(f_bulk_action_type == "BulkInvoicePrint"){
        //     $('#form_order_list').attr('target', "_blank");
        //   }
    });



  
});
</script>