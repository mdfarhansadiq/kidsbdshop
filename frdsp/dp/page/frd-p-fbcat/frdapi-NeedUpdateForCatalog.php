<?php 
if(!isset($_POST['f_spiderecommerce'])){echo "<h6>Access Denied!!!</h6>"; exit;}

$FR_PATH_HD = "../../../../";
require_once($FR_PATH_HD."frd-src/abc/frd-config.php");//FRD CONFIG
require_once($FR_PATH_HD."frd-src/abc/frd-spider-function.php");//FRD SPIDER FUN PHP
require_once($FR_PATH_HD."frd-src/abc/frd-this-function.php");

header("Access-Control-Allow-Origin: $FRD_HURL");


$FR_OP_HTML = "";
//FRD VC NEED:-
    $FR_VC_SESSION = "";
    $FR_VC_POST = "";

//FRD VC________
    if(isset($_SESSION['sUsrId'])){ $FR_VC_SESSION = 1; } else{ $FR_OP_HTML .= "<h6>Access Denied 1  </h6>"; goto THIS_LAST; }
//FRD VC________
    if( isset($_POST['f_filt_asc_desc'])){
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
                        <td class='text-right'><span>Title</span></td>
                        <td class='text-right'><span>Short Description</span></td>
                        <td class='text-right'><span>Google Product Category ID</span></td>
                        <td class='text-right'><span>Edit</span></td>
                    </tr>
                 ";


     
                 $FRQ = "SELECT * FROM frd_products WHERE pro_typ = 1 AND statuss IN(1,2) AND (fr_short_desc = '' OR g_cat_id = 0) ORDER BY id $f_filt_asc_desc LIMIT 0,$f_filt_limit";
                
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


                        if($fr_short_desc != "") {  $fr_short_desc_M = "<span class='label label-success'> OK </span>"; }else{
                            $fr_short_desc_M = "<span class='label label-danger'> Missing </span>";
                        }

                        if($g_cat_id != 0) {  $g_cat_id_M = "<span class='label label-success'> OK </span>"; }else{
                            $g_cat_id_M = "<span class='label label-danger'> Missing </span>";
                        }

                        
                        if (preg_match('/[a-z]/', $bn_name)) {
                            // Contains lowercase letters
                            $bn_name_M = "<span class='label label-success'> OK </span>";
                        } else {
                            // All alphabetic characters are uppercase
                            $bn_name_M = "<span class='label label-danger'> UPPER CASE </span>";
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
                                    <td class='text-right'> $bn_name_M</td>
                                    <td class='text-right'> $fr_short_desc_M</td>
                                    <td class='text-right'>$g_cat_id_M</td>
                                    <td class='text-right'>
                                      <a href='$FR_SP_HURL_DP/pro-EditProduct/$id' target='_blank'>
                                            <span class='btn btn-sm btn-primary'> 
                                                <i class='glyphicon glyphicon-edit'></i>
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