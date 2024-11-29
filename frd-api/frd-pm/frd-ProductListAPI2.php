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
        $f_filt_asc_desc = $_POST['f_filt_asc_desc'];
        $f_filt_limit = $_POST['f_filt_limit'];
        $FR_VC_POST = 1; 
    }


//FRD OPARATION START:-
     if($FR_VC_SESSION == 1 and $FR_VC_POST == 1){

         $FR_OP_HTML .="
        <div class=''>
        <div class='table-responsive'>
            <table class='t_print'>
                    <tr class='alert alert-info boldd'>
                        <td><span>SL</span></td>
                        <td><span>Id</span></td>
                        <td class='text-right'><span>Sku</span></td>
                        <td><span>Img</span></td>
                        <td><span>Product Title</span></td>
                        <td><span>Status</span></td>
                        <td class='text-right'><span>Stock</span></td>
                        <td class='text-right'><span>Buy Price</span></td>
                        <td class='text-right'><span>Total Buy Price</span></td>
                        <td class='text-right'><span>Sales Price</span></td>
                        <td class='text-right'><span>Total Sales Price</span></td>
                        <td class='text-right'><span>View</span></td>
                    </tr>
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
                            $FRQ .= " AND r_cat_1 = 0 ORDER BY id $FRs_ASC_DESC LIMIT 0,99";
                        }
                    }

                
                
                // echo "$FRQ";
                $FRR = FR_QSEL("$FRQ","ALL");
                if ($FRR['FRA'] == 1) {

                    $FRc_SL = 1;
                    $FRc_FT_STOCK = 0;
                    $FRc_FT_VIEW = 0;
                    $FRc_FT_SALES_PRICE = 0;
                    $FRc_FT_BUY_PRICE = 0;
                    foreach($FRR['FRD'] as $FR_ITEM){
                        extract($FR_ITEM);

                
                        if($statuss == 1){ $statuss_M = "Published"; $FR_cc1 = "label-success"; }
                        if($statuss == 2){ $statuss_M = "Unlisted"; $FR_cc1 = "label-info"; }
                        if($statuss == 3){ $statuss_M = "Private"; $FR_cc1 = "label-warning"; }
                        if($statuss == 4){ $statuss_M = "Trashed"; $FR_cc1 = "label-danger"; }


                        $FRc_QTY_M = $qtyy;
                        $FRc_TSealsPrice = ($sells_pri * $qtyy);
                        $FRc_TBuyPrice = ($buy_pri * $qtyy);

                        if($qtyy > 9999){ 
                            $FRc_QTY_M = "Unlimited";
                            $FRc_TSealsPrice = 0;
                            $FRc_TBuyPrice = 0;
                            $qtyy = 0;
                         }



                        $FR_OP_HTML .= "
                                <tr>
                                    <td>$FRc_SL</td>
                                    <td>#$id</td>
                                    <td class='text-right'> $skuu</td>
                                    <td>
                                    <img src='$FRD_HURL/frd-data/img/product/$pic_1' alt='' height='20px' width='20px'>
                                    </td>
                                    <td>$bn_name </td>
                                    <td><span class='label $FR_cc1'> $statuss_M </span></td>
                                    <td class='text-right'> $FRc_QTY_M</td>
                                    <td class='text-right'>$buy_pri"."৳</td>
                                    <td class='text-right'>$FRc_TBuyPrice"."৳</td>
                                    <td class='text-right'>$sells_pri"."৳</td>
                                    <td class='text-right'>$FRc_TSealsPrice"."৳</td>
                                    <td class='text-right'>$vieww</td>
                                </tr>
                        ";


                        $FRc_SL = ($FRc_SL + 1);
                        $FRc_FT_STOCK = ($FRc_FT_STOCK + $qtyy);
                        $FRc_FT_VIEW = ($FRc_FT_VIEW + $vieww);
                        $FRc_FT_SALES_PRICE = ($FRc_FT_SALES_PRICE + $FRc_TSealsPrice);
                        $FRc_FT_BUY_PRICE = ($FRc_FT_BUY_PRICE + $FRc_TBuyPrice);

                    }

                    $FR_OP_HTML .= "
                    <tr class='alert alert-info boldd'>
                        <td colspan='6'>Total</td>
                        <td class='text-right'>".number_format($FRc_FT_STOCK)."</td>
                        <td class='text-right'></td>
                        <td class='text-right'>".number_format($FRc_FT_BUY_PRICE,2)."৳</td>
                        <td class='text-right'></td>
                        <td class='text-right'>".number_format($FRc_FT_SALES_PRICE,2)."৳</td>
                        <td class='text-right'>".number_format($FRc_FT_VIEW)."</td>
                    </tr>
                    ";

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
            </table>
          </div>
        </div>


        <div class='row'>
        <div class='col-md-12 mt-10'>
            <div class='text-center'>
                <button class='btn btn-info btn-xs' onclick='FRcloseNavLS(),Frfun_FilterFormHied(),window.print()'><span class='glyphicon glyphicon-print'></span></button>
            </div>
        </div>
        </div>
                            
        ";
     }

THIS_LAST:
echo $FR_OP_HTML;