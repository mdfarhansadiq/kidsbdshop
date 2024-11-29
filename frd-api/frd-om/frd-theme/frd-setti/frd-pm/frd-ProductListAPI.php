<?php 
$FR_OP_HTML = "";
//FRD VC NEED:-
    $FR_VC_SESSION = "";
    $FR_VC_POST = "";



//FRD VC________
    if(isset($_SESSION['sUsrId'])){ $FR_VC_SESSION = 1; } else{ $FR_OP_HTML .= "<h6>Access Denied 1  </h6>"; goto THIS_LAST; }
//FRD VC________
    if( isset($_POST['f_filt_status'])){
        $f_filt_status = $_POST['f_filt_status'];
        $f_filter_cat = $_POST['f_filter_cat'];
        $f_filt_supplier = $_POST['f_filt_supplier'];
        $f_filt_asc_desc = $_POST['f_filt_asc_desc'];
        $f_filt_limit = $_POST['f_filt_limit'];
        $FR_VC_POST = 1; 
    }
//FRD_VC_______________________
    if( isset($_POST['f_search_text']) ){
        $FRc_SearchText = $_POST['f_search_text'];
        $FR_VC_POST = 1; 
    }
//FRD_VC_______________________
    if( isset($_POST['f_search_id']) ){
        $f_search_id = $_POST['f_search_id'];
        $FR_VC_POST = 1; 
    }


//FRD OPARATION START:-
     if($FR_VC_SESSION == 1 and $FR_VC_POST == 1){

         $FR_OP_HTML .="
        <form action='MultiInvoicePrint' method='POST' target='_blank'>
        <div class='frUsrList1'>
        <div class='table-responsive'>
            <table class='table user-list'>
                <thead>
                    <tr class='alert alert-info'>
                        <th><span>SL</span></th>
                        <th><span>Product Img</span></th>
                        <th><span>Stock</span></th>
                        <th><span>Stock Unit</span></th>
                        <th><span>Title</span></th>
                        <th class='text-right'><span>Price</span></th>
                        <th><span>Status</span></th>
                        <th class='text-center'><span>View</span></th>
                        <th><span>Add Date</span></th>
                        <th class='text-right'><span>Edit</span></th>
                        <th class='text-right'><span>Dupli</span></th>
                        <th class='text-right'><span>Open</span></th>
                        <th class='text-right'><span>Delete</span></th>
                    </tr>
                </thead>
                <tbody>
                 ";


                        
        
                //FRD FULL OVERWRITE QUERY MAKE FOR SEARCH TEXT:-
                    if(isset($f_search_id)){
                        $FRQ = "SELECT * FROM frd_products WHERE pro_typ = 1 AND id = '$f_search_id'";
                    }
    
                //FRD FULL OVERWRITE QUERY MAKE FOR SEARCH TEXT:-
                    elseif(isset($FRc_SearchText)){
                        $FRQ = "SELECT * FROM frd_products WHERE pro_typ = 1";
                        $FRQ .= " AND (bn_name LIKE '%$FRc_SearchText%' OR detailess LIKE '%$FRc_SearchText%' OR tagg LIKE '%$FRc_SearchText%' OR skuu LIKE '%$FRc_SearchText%') ORDER BY RAND() LIMIT 0,30";
                    }

                    elseif(isset($f_filt_status)){
                        $FRQ = "SELECT * FROM frd_products WHERE pro_typ = 1 AND statuss != 4";
                        if($f_filt_supplier !=""){$FRQ .= " AND r_supplier = $f_filt_supplier";}

                        if($f_filt_status !=""){
                            if($f_filt_status == "Published"){$FRQ .= " AND statuss = 1";}
                            if($f_filt_status == "Unlisted"){$FRQ .= " AND statuss = 2";}
                            if($f_filt_status == "Private"){$FRQ .= " AND statuss = 3";}
                            if($f_filt_status == "Trashed"){$FRQ .= " AND statuss = 4";}
                            if($f_filt_status == "LowStock"){$FRQ .= " AND qtyy > 0 AND qtyy <= 3 ";}
                            if($f_filt_status == "StockOut"){$FRQ .= " AND qtyy <= 0";}
                            if($f_filt_status == "ColorVariation"){$FRQ .= " AND pro_typ = 1 AND vry_typ = 2";}
                            if($f_filt_status == "SizeVariation"){$FRQ .= " AND pro_typ = 1 AND vry_typ = 3";}
                        }


                        if($f_filter_cat != ""){ $FRQ .= " AND (r_cat_1 = $f_filter_cat OR r_cat_2 = $f_filter_cat OR r_cat_3 = $f_filter_cat OR r_cat_4 = $f_filter_cat OR m_cat_1 = $f_filter_cat OR m_cat_2 = $f_filter_cat OR m_cat_3 = $f_filter_cat OR m_cat_4 = $f_filter_cat)"; }
                        $FRQ .= " ORDER BY id $f_filt_asc_desc LIMIT 0,$f_filt_limit";

                      //FRD FULL OVERWRITE QUERY MAKE FOR Uncategorized Product:-
                        if($f_filter_cat == "0"){
                            $FRQ = "SELECT * FROM frd_products WHERE pro_typ = 1";
                            $FRQ .= " AND r_cat_1 = 0 ORDER BY id $f_filt_asc_desc LIMIT 0,99";
                        }

                      //FRD FULL OVERWRITE QUERY MAKE FOR => TRAST PRODUCT:-
                        if($f_filt_status == "Trashed"){
                            $FRQ = "SELECT * FROM frd_products WHERE pro_typ = 1 AND statuss = 4 ORDER BY id $f_filt_asc_desc LIMIT 0,99";
                        }
                    }

                
                // echo "$FRQ";
                $FRR = FR_QSEL("$FRQ","ALL");
                if ($FRR['FRA'] == 1) {

                    $FRc_SL = 1;
                    foreach($FRR['FRD'] as $FR_ITEM){
                        extract($FR_ITEM);

                        if($statuss == 1){ $statuss_M = "Published"; $FR_cc1 = "label-success"; }
                        if($statuss == 2){ $statuss_M = "Unlisted"; $FR_cc1 = "label-info"; }
                        if($statuss == 3){ $statuss_M = "Private"; $FR_cc1 = "label-warning"; }
                        if($statuss == 4){ $statuss_M = "Trashed"; $FR_cc1 = "label-danger"; }

                        $FR_cc2 = "";
                        $qtyy_M = "$qtyy";
                        if($qtyy == 0){ $qtyy_M = "[$qtyy] out of stock"; $FR_cc2 = "label label-danger pip_pip_1s"; }
                        if($qtyy > 60000){ $qtyy_M = "Unlimited"; $FR_cc2 = "label label-success pip_pip_1s"; }
                        if($qtyy > 0 AND $qtyy <= 3){ $qtyy_M = "[$qtyy] Low Stock"; $FR_cc2 = "label label-warning pip_pip_1s"; }


                        $FR_OP_HTML .= "
                                <tr>
                                <td>$FRc_SL</td>
                                <td>
                                  <img src='$FRD_HURL/frd-data/img/product/$pic_1' alt='' max-height='100px' width='auto'>
                                </td>
                                    <td><span class='$FR_cc2'> $qtyy_M </span></td>
                                    <td>$fr_stock_unit</td>
                                    <td>$bn_name [#$id]</td>
                                    <td class='text-right'>$sells_pri/-</td>
                                    <td><span class='label $FR_cc1'> $statuss_M </span></td>
                                    <td class='text-center'>$vieww</td>
                                    <td>".date('d-M-Y',$timee)."</td>
                                    <td class='text-right'>
                                        <a href='$FR_SP_HURL_DP/pro-EditProduct/$id' target='_self'>
                                            <span class='btn btn-sm btn-primary'> 
                                                <i class='glyphicon glyphicon-edit'></i>
                                            </span>
                                        </a>
                                    </td>
                                    <td class='text-right'>
                                        <a href='$FR_SP_HURL_DP/pro-ProductList/duplicate/$id' target='_self' class='table-link'>
                                            <span class='btn btn-sm btn-warning'> 
                                                <i class='glyphicon glyphicon-duplicate'></i>
                                            </span>
                                        </a>
                                    </td>
                                    <td class='text-right'>
                                        <a href='$FRD_HURL/product/$id/$fr_slug ' target='_blank' class='table-link'>
                                            <span class='btn btn-sm btn-info'> 
                                                <i class='glyphicon glyphicon-new-window'></i>
                                            </span>
                                        </a>
                                    </td>
                                    <td class='text-right'>
                                        <a href='$FR_SP_HURL_DP/pro-ProductList/delete/$id' target='_self' class='table-link'>
                                            <span class='btn btn-sm btn-danger'> 
                                                <i class='glyphicon glyphicon-trash'></i>
                                            </span>
                                        </a>
                                    </td>

                                </tr>
                        ";

                        $FRc_SL = ($FRc_SL + 1);
                    }
                } else {
                    // PR($FRR);
                    $FR_OP_HTML .= "
                    <tr>
                        <td colspan='10' class='text-center text-danger'>
                           No Product Found
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