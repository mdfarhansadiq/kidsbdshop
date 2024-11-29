<?php 
$FR_OP_HTML = "";
//FRD VC NEED:-
    $FR_VC_SESSION = "";
    $FR_VC_POST = "";
//FRD VC________
    if(isset($_SESSION['sUsrId'])){ extract($_SESSION); $FR_VC_SESSION = 1; } else{ $FR_OP_HTML .= "<h6>Access Denied 1  </h6>"; goto THIS_LAST; }
//FRD VC________
    if( isset($_POST['a'])){
         $FR_VC_POST = 1; 
    }
//FRD_VC_______________________:-
    if( isset($_POST['f_search_text']) ){
        $FRc_SearchText = $_POST['f_search_text'];
        $FR_VC_POST = 1; 
    }

    $FRc_UserId = $_SESSION['sUsrId'];

//FRD ASC DESC:-
    $FRs_ASC_DESC = "DESC";
    if(isset($_SESSION['FRs_ASC_DESC'])){ $FRs_ASC_DESC = $_SESSION['FRs_ASC_DESC'];}
   

//FRD OPARATION START:-
     if($FR_VC_SESSION == 1 and $FR_VC_POST == 1){
     
        $FR_OP_HTML .="
        <div class='frUsrList1'>
        <div class='table-responsive'>
            <table class='table user-list'>
                <thead>
                    <tr>
                         <th><span>Writer Picture</span></th>
                         <th><span>Writer Name</span></th>
                         <th><span>Add Date</span></th>
                         <th class='text-right'><span>Action</span></th>
                    </tr>
                </thead>
                <tbody>
                 ";


                $FRQ = "SELECT * FROM frd_writers WHERE id > 0";
                $FRQ .= " ORDER BY id DESC LIMIT 0,300";

                //FRD FULL OVERWRITE QUERY MAKE FOR SEARCH TEXT:-
                if(isset($FRc_SearchText)){
                    // $FRQ = "SELECT * FROM frd_tx_customers WHERE fr_comid = $FRs_CompId AND (fr_cust_name LIKE '%$FRc_SearchText%' OR fr_cust_mobile LIKE '%$FRc_SearchText%' OR fr_cust_address LIKE '%$FRc_SearchText%' OR id='$FRc_SearchText' OR fr_cust_gen='$FRc_SearchText') ORDER BY id DESC LIMIT 0,30";
                    
                }
                $FRR = FR_QSEL("$FRQ","ALL");
                if ($FRR['FRA'] == 1) {

                    foreach($FRR['FRD'] as $FR_ITEM){
                     extract($FR_ITEM);

                        $FR_OP_HTML .= "
                                <tr>
                                    <td> <img src='$FRD_HURL/frd-data/img/writers/$fr_writer_pic' alt='' width='auto' max-height='60px'> </td>
                                    <td> $fr_writer_name [#$id] </td>
                                    <td> ".date("d-M-Y",$fr_add_timee)." </td>
                                    <td>
                                       <div class='text-right'>
                                            <a href='Writers-EditWriter/$id' target='_self' class='btn btn-success'>
                                                <span class=''> <span class='glyphicon glyphicon-pencil'></span> </span>
                                            </a>
                                        </div>
                                    </td>

                                </tr>
                        ";
                    }
                } else {
                    // PR($FRR);
                    $FR_OP_HTML .= "
                    <tr>
                        <td colspan='7' class='text-center text-danger'>
                           No Writer Found
                        </td>
                    </tr>
                    ";
                }


          $FR_OP_HTML .="
                </tbody>
            </table>
          </div>
        </div>
        ";
         
     }


THIS_LAST:
echo $FR_OP_HTML;
?>

<script>
    $(document).ready(function(){

    // $(".FrCopyTrig").unbind().click(function(){
    //      toastr.success("লিংক কপি হয়েছে এখন শেয়ার করুন");
    // }); 
  
  });
</script>