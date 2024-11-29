<?php
$Callingg="FRD";//FRD 0 LEVEL VALIDATION
require_once('frd_lconfig.php');


$FR_VC_IEONIC = "";//ITEM EXIST OR NOT IN CART
$FR_VC_ProCurrStock = "";//ITEM EXIST OR NOT IN CART
$FR_VC_ProVariaHorN = "";//ITEM VARIATION HAVE OR NOTE
$FR_VC_WA_OrderHorN = "";//WHATSAPP ORDER HAVE OR NOTE

/*
FRA = 1 = ITEM ADD DONE TO CART
FRA = 2 = ITEM NOT ADDED TO CART
FRA = 3 = HAVE COLOR VARIATION
FRA = 4 = HAVE SIZE VARIATION
FRA = 5 = WHATSAPP ORDERS
*/

$FR_OUTPUT = [];

///////////////////////////////////////////////////////  
//FRD ORDER TOKEN STARTING
///////////////////////////////////////////////////////
    if(!isset($_SESSION['FRs_Invo_Token'])){ 
            $FRc_Enc_Id = uniqid();
            $arr = [];
            $arr['fr_enc_id'] = $FRc_Enc_Id;
            $arr['fr_stat'] = 0;
            $arr['fr_o_date'] = "$FR_NOW_DATE";
            $arr['fr_o_time'] = "$FR_NOW_TIME";
            $FRR = FR_DATA_IN("frd_order_invo",$arr);
            if($FRR['FRA']==1){
                $_SESSION['FRs_Invo_Token'] = $FRR['FR_LIID'];
                $_SESSION['FRs_Invo_EncId'] = $FRc_Enc_Id;
            }else{
                $FR_OUTPUT['FRA'] = 2;
                $FR_OUTPUT['FRM'] = "TOKEN START FAILED";
                goto THIS_LAST;
            }
    }
    if(!isset($_SESSION['FRs_Invo_Token'])){ 
        $FR_OUTPUT['FRA'] = 2;
        $FR_OUTPUT['FRM'] = "TOKEN ERROR";
        goto THIS_LAST;
    }



if(isset($_POST['pro_id'])){
    //SUBBIT DATA RECIVING:---
        $FRc_ProIdx = $_POST['pro_id'];
        $Frc_AT = $_POST['FrAT'];//ACTION TYPE [ordernow / addtocart ]
        $FRc_ProVariaTyp = $_POST['ProVariaTyp'];

    //FRD PRODUCT DATA:-
        $FRR = FR_QSEL("SELECT * FROM frd_products WHERE id = $FRc_ProIdx","");
        if($FRR['FRA']==1){ 
           extract($FRR['FRD']);

           $FRc_BRAND_NAME = "NA";
           $FRc_COLOR_NAME = "NA";
           $FRc_r_cat_1_Name = "NA";
           $FRc_r_cat_2_Name = "NA";
           $FRc_r_cat_3_Name = "NA";
           $FRc_r_cat_4_Name = "NA";
        
           if($r_brand > 0){ extract(FRF_BRAND_NAME($r_brand)); }
           if($r_color > 0){ extract(FRF_COLOR_NAME($r_color)); }
           if($r_cat_1 > 0){ extract(FRF_CATT_NAME($r_cat_1)); $FRc_r_cat_1_Name = $FRc_CATT_NAME; }
           if($r_cat_2 > 0){ extract(FRF_CATT_NAME($r_cat_2)); $FRc_r_cat_2_Name = $FRc_CATT_NAME; }
           if($r_cat_3 > 0){ extract(FRF_CATT_NAME($r_cat_3)); $FRc_r_cat_3_Name = $FRc_CATT_NAME; }
           if($r_cat_4 > 0){ extract(FRF_CATT_NAME($r_cat_4)); $FRc_r_cat_4_Name = $FRc_CATT_NAME; }

           $bn_name = preg_replace("/'/","\'",$bn_name);

           $FRc_CT_ItemName = preg_replace("/'/","",$bn_name);
           $FRc_CT_CategoryName = preg_replace("/'/","",$FRc_r_cat_1_Name);

        } else{ 
            $FR_OUTPUT['FRA'] = 2;
            $FR_OUTPUT['FRM'] = "No Product Found + ". $FRR['FRM'];
            goto THIS_LAST;
        }
    //END>>
    //+
    $FRc_ProtCurrStock = $qtyy;


    $FRQ = $FR_CONN->query("SELECT frplug_capi FROM frd_soft_config WHERE id = 1");
    extract($FRQ->fetch());
}


$FRc_Invo_Token = $_SESSION['FRs_Invo_Token'];



//FRD_VC_____________________________________PRODUCT VARIATION HAVE OR NOTE:-
if($FRc_ProVariaTyp == 1){
    $FR_VC_ProVariaHorN = 1;
}
elseif($FRc_ProVariaTyp == 2){
    $FR_OUTPUT['FRA'] = 3;
    $FR_OUTPUT['FRM'] = "Product Have Color Variation";
    $FR_OUTPUT['FR_V_MP_ID'] = $FRc_ProIdx;
    $FR_OUTPUT['FR_AT'] = "$Frc_AT";
    goto THIS_LAST;
}
elseif($FRc_ProVariaTyp == 3){
    $FR_OUTPUT['FRA'] = 4;
    $FR_OUTPUT['FRM'] = "Product Have Size Variation";
    $FR_OUTPUT['FR_V_MP_ID'] = $FRc_ProIdx;
    $FR_OUTPUT['FR_AT'] = "$Frc_AT";
    goto THIS_LAST;
} 

//FRD_VC___________________________________ ITEM ALRADY EXIST OR NOT IN CART:-
       $q_frd_vc1 = "SELECT COUNT(id) from frd_order_items WHERE fr_invo_id = $FRc_Invo_Token AND fr_pro_id = $FRc_ProIdx AND fr_stat = 0";
       $FRQ = $FR_CONN->query("$q_frd_vc1");
       $row_frd_vc1 = $FRQ->fetch();
       //IF ITEM EXIST
       if($row_frd_vc1['COUNT(id)']==0){
           $FR_VC_IEONIC = 1;
       }else{
            $FR_OUTPUT['FRA'] = 2;
            $FR_OUTPUT['FRM'] = "The product is already added to your bag";
            $FR_OUTPUT['FR_AT'] = "$Frc_AT";
            goto THIS_LAST;
       }

//FRD_VC_________________________________________________PRODUCT CURRENT STOCK:-
   if($FRc_ProtCurrStock > 0){
      $FR_VC_ProCurrStock = 1;
   }else{
      $FR_OUTPUT['FRA'] = 2;
      $FR_OUTPUT['FRM'] = "This Product out of stock";
      goto THIS_LAST;
   }




//FRD_VC_________________________________________WHATSAPP ORDER HAVE OR NOTE:-
if($Frc_AT == "waorder"){
    $FRR = FR_QSEL("SELECT fr_whatsapp,fr_cname FROM frd_cprofile WHERE id = 1",""); if($FRR['FRA']==1){ extract($FRR['FRD']);}
    $FRc_WhatsappOrderLink = "https://wa.me/$fr_whatsapp?text=Hi $fr_cname I Want To Buy $bn_name \n Price: $sells_pri ৳ \n $FRD_HURL/product/$id/$fr_slug";
    $FR_OUTPUT['FRA'] = 5;
    $FR_OUTPUT['FR_WPOL'] = "$FRc_WhatsappOrderLink";//WHATS APP ORDER LINK
    goto THIS_LAST;
}else{
   $FR_VC_WA_OrderHorN = 1;
}

   

//FRD DATA INSERT:-
   if($FR_VC_IEONIC == 1 AND $FR_VC_ProCurrStock == 1 AND $FR_VC_ProVariaHorN == 1 AND $FR_VC_WA_OrderHorN == 1){
    $arr = array();
    $arr['fr_invo_id'] = $FRc_Invo_Token;
    $arr['fr_pro_id'] = $FRc_ProIdx;
    $arr['fr_pro_sku'] = "$skuu";
    $arr['fr_pro_title'] = "$bn_name";
    $arr['fr_size_name'] = "$siz_name";

    $arr['fr_pro_pic_1'] = "$pic_1";
    $arr['fr_qty'] = "1";
    $arr['fr_price'] = "$sells_pri";
    $arr['fr_t_price'] = "$sells_pri";

    $arr['fr_buyprice'] = "$buy_pri";
    $arr['fr_t_buyprice'] = "$buy_pri";

    $arr['fr_profit'] = ($sells_pri - $buy_pri);
    $arr['fr_t_profit'] = ($sells_pri - $buy_pri);

    $arr['r_cat_1'] = "$r_cat_1";
    $arr['r_cat_2'] = "$r_cat_2";
    $arr['r_cat_3'] = "$r_cat_3";
    $arr['r_brand'] = "$r_brand";
    $arr['r_color'] = "$r_color";
    $arr['r_supplier'] = "$r_supplier";

    $arr['fr_stat'] = "0";
    $arr['deli_crg_typ'] = "$deli_crg_typ";
    $arr['fr_o_date'] = "$FR_NOW_DATE";

    $FRR = FR_DATA_IN("frd_order_items",$arr);
    if($FRR['FRA']==1){
        $FRc_LastInProId = $FRR['FR_LIID'];
        $FR_OUTPUT['FRA'] = 1;
        $FR_OUTPUT['FRM'] = "Item Add Done To Cart";
        $FR_OUTPUT['FR_AT'] = "$Frc_AT";
        $GTM_EVENT = [
            "item_id"            => "$FRc_ProIdx",
            "item_name"          => "$bn_name",
            "affiliation"        => "NA",
            "discount"           => $discount_pri,
            "item_brand"         => "$FRc_BRAND_NAME",
            "item_category"      => "$FRc_r_cat_1_Name",
            "item_category2"     => "$FRc_r_cat_2_Name",
            "item_category3"     => "$FRc_r_cat_3_Name",
            "item_category4"     => "$FRc_r_cat_4_Name",
            "item_variant"       => "$FRc_COLOR_NAME",
            "price"              => $sells_pri,
            "FR_AT"              => "$Frc_AT"
        ];
        $FR_OUTPUT['FR_GTM_DATA'] = json_encode($GTM_EVENT);
        
    }else{
        $FR_OUTPUT['FRA'] = 2;
        $FR_OUTPUT['FRM'] = "Item Add Failed To Cart";
    }
}
//END>> 


THIS_LAST:
echo json_encode($FR_OUTPUT);