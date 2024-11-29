<?php 
header("Content-Type: text/html");
header("Access-Control-Allow-Origin: $FRD_HURL");

$FR_OP_HTML = "";
//FRD VC NEED:-
    $FR_VC_POST = "";
//FRD VC________
    if( isset($_POST['f_v_mp_id'])){
        $FRc_MainProId = $_POST['f_v_mp_id'];
        $FRc_AT = $_POST['f_at'];
        $FR_VC_POST = 1; 
    }

//FRD OPARATION START:-
     if($FR_VC_POST == 1){

        $FRQ = $FR_CONN->query("SELECT frtc_off_txt,stockout_frd,frd_ordernow_txt,addtocart_frd,fr_wporder_btn_txt FROM frd_themelan WHERE frlc_lang = '".$_SESSION['FRs_frtc_lang']."'");
        extract($FRQ->fetch());
     
                $FRQ = "SELECT * FROM frd_products WHERE statuss IN(1,2) AND v_mp_id = $FRc_MainProId AND vry_typ = 2";
                $FRR = FR_QSEL("$FRQ","ALL");
                if ($FRR['FRA'] == 1) {

                    $FR_OP_HTML .= "
                        <div class='frUsrList1'>
                          <div class='table-responsive'>
                            <table class='table user-list'>
                             <tbody>
                    ";
                    foreach($FRR['FRD'] as $FR_ITEM){
                        extract($FR_ITEM);

                        $sells_pri_exp = explode('.', $sells_pri);
                        $FRc_SalesPricePoisa = $sells_pri_exp[1];
                        //++
                        $FRc_SalesPrice = number_format($sells_pri);
                        if($FRc_SalesPricePoisa > 0){
                            $FRc_SalesPrice = number_format($sells_pri,2);
                        }

                        $FRc_StockOut_HTML = "";
                        $FRc_c1 = "";
                        if($qtyy == 0){$FRc_StockOut_HTML = "<span class='label label-danger'>out of stock</span>"; $FRc_c1 = "frd_dn";}

                        $FRQ = $FR_CONN->query("SELECT en_name FROM frd_colorr WHERE id = $r_color");
                        $rowdata_procolorname = $FRQ->fetch();
                        $FRc_ColorName = $rowdata_procolorname['en_name'];

  
                        if($FRc_AT == "ordernow"){
                            $FRc_AT_Button_HTML = "<button class='frbtn_vp_atc btn btn-success btn-xs frdtrig_atc $FRc_c1' id='$id' ProVariaTyp='1' FrAT='ordernow'><span class='glyphicon glyphicon-flash'></span>$frd_ordernow_txt</button>";
                        }
                        elseif($FRc_AT == "addtocart"){
                            $FRc_AT_Button_HTML = "<button class='frbtn_vp_atc btn btn-primary btn-xs frdtrig_atc $FRc_c1' id='$id' ProVariaTyp='1' FrAT='addtocart'><span class='glyphicon glyphicon-shopping-cart'></span> $addtocart_frd</button>";
                        }
                        elseif($FRc_AT == "waorder"){
                            $FRR = FR_QSEL("SELECT fr_whatsapp,fr_cname FROM frd_cprofile WHERE id = 1",""); if($FRR['FRA']==1){ extract($FRR['FRD']);}
                            $FRc_AT_Button_HTML = "
                            <a class='$FRc_c1' href='https://wa.me/$fr_whatsapp?text=Hi $fr_cname I Want To Buy $bn_name \n Color: $FRc_ColorName \n Price: $sells_pri ৳ \n $FRD_HURL/product/$id/$fr_slug' target='_blank'>
                                <button class='btn btn-success btn-xs frbtn_wao_vp_atc'><span class='fa-brands fa-whatsapp'></span> $fr_wporder_btn_txt </button>
                            </a>
                            ";
                        }

                            $FR_OP_HTML .= "
                                    <tr>
                                        <td> 
                                           $FRc_ColorName <br>
                                            <img src='$FRD_HURL/frd-data/img/product/$pic_1' alt='#' height='auto' max-width='100px'>
                                        </td>
                                        <td class='text-right'>৳ $FRc_SalesPrice</td>
                                        <td class='text-right' width='30px'>
                                          $FRc_AT_Button_HTML
                                          $FRc_StockOut_HTML
                                        </td>
                                    </tr>
                            ";
                    }
                    $FR_OP_HTML .= "
                              </tbody>
                             </table>
                            </div>
                        </div>
                    ";

                } else {
                    // PR($FRR);
                    $FR_OP_HTML .= "
                    <div class='col-md-12'>
                      <div class='text-center boldd alert alert-danger'> No Color Variation Found (Perhaps this product itself is it) ".$FRR['FRM']."</div>
                    </div>
                    ";
                }

         
     }


THIS_LAST:
echo $FR_OP_HTML;
?>
<script type="text/javascript">
FrFunAddToCartManger();
</script>