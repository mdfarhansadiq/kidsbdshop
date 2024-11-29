<?php 
$FR_OP_HTML = "";
//FRD VC NEED:-
    $FR_VC_POST = "";
//FRD VC________
    if( isset($_POST['start'])){
        $FRc_Start = $_POST['start'];
        $FRc_Limit = $_POST['limit'];

         $FR_VC_POST = 1; 
    }
//FRD_VC_______________________:-
    if( isset($_POST['f_search_text']) ){
        $FRc_SearchText = $_POST['f_search_text'];
        $FR_VC_POST = 1; 
    }



//FRD OPARATION START:-
     if($FR_VC_POST == 1){
     
                $FRQ = "SELECT * FROM frd_writers WHERE id > 0";
                $FRQ .= " ORDER BY id ASC LIMIT $FRc_Start,$FRc_Limit";

                //FRD FULL OVERWRITE QUERY MAKE FOR SEARCH TEXT:-
                if(isset($FRc_SearchText)){
                    // $FRQ = "SELECT * FROM frd_tx_customers WHERE fr_comid = $FRs_CompId AND (fr_cust_name LIKE '%$FRc_SearchText%' OR fr_cust_mobile LIKE '%$FRc_SearchText%' OR fr_cust_address LIKE '%$FRc_SearchText%' OR id='$FRc_SearchText' OR fr_cust_gen='$FRc_SearchText') ORDER BY id DESC LIMIT 0,30";
                    
                }
                $FRR = FR_QSEL("$FRQ","ALL");
                if ($FRR['FRA'] == 1) {
                    foreach($FRR['FRD'] as $FR_ITEM){
                      extract($FR_ITEM);

                      //FRD TOTAL PRODUCT COUNT:-
                        $FRQ = $FR_CONN->query("SELECT COUNT(id) FROM frd_products WHERE statuss = 1 AND r_writer = $id");
                        $FRSD = $FRQ->fetch();
                        $FRc_T_Products = $FRSD['COUNT(id)'];

                        $FR_OP_HTML .= "
                                <div class='col-xs-6 col-sm-3 col-md-2'>
                                    <div class='frs_catbox_1'>
                                        <a href='$FRD_HURL/writer/$fr_writer_slug'>
                                        <img src='$FRD_HURL/frd-data/img/writers/$fr_writer_pic' alt='' class='img-responsive'>
                                        <h4 class='title'>$fr_writer_name <br> <small class='alert-success'>[ $FRc_T_Products ]</small></h4>
                                        </a>
                                    </div>
                                </div>
                        ";
                    }
                } else {
                    // PR($FRR);
                    $FR_OP_HTML .= "
                    <div class='col-md-12'>
                      <div class='text-center boldd alert alert-danger'> No More Writer Found </div>
                    </div>
                    ";
                   exit;
                }

         
     }


THIS_LAST:
echo $FR_OP_HTML;