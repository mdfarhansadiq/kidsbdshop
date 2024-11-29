<?php
require_once('frd_lconfig.php');

$FR_OUTPUT = [];

//FRD  DATA:-
$FRR = FR_QSEL("SELECT * FROM frd_themeconfig WHERE id = 1","");
if($FRR['FRA']==1){ 
  extract($FRR['FRD']);
} else{ ECHO_4($FRR['FRM']); }
//END>>

$FR_VC_OVER_QTY_ADD = "";
$FR_MAX_ORDER_QTY = "";

$FRs_Invo_Token = $_SESSION['FRs_Invo_Token'];
$FRc_CartItemIdx = $_POST['item_id'];

//FRD CART ITEM INFO FIEND:--------------
$FRQ = $FR_CONN->query("SELECT fr_pro_id,fr_qty FROM frd_order_items WHERE id = $FRc_CartItemIdx");
$row_oiinfo = $FRQ->fetch();
$FRc_ItemProId = $row_oiinfo['fr_pro_id'];
$FRc_ItemCartQty = $row_oiinfo['fr_qty'];//CART ITEM PRESENT ORDER QTY
//++
//++
//FRD CART ITEM PRODUCT INFO FIEND:--------
$FRQ = $FR_CONN->query("SELECT qtyy FROM frd_products WHERE id = $FRc_ItemProId");
$row_propsc = $FRQ->fetch();
$FRc_Product_StockQtyHave = $row_propsc['qtyy'];
          

    
 //FRD_VC_____________________ OVER QTY ADDING :-
    if($FRc_Product_StockQtyHave > $FRc_ItemCartQty){
        $FR_VC_OVER_QTY_ADD =  1;
    }else{
        $FR_OUTPUT['FRA'] = 2;
        // $FR_OUTPUT['FRM'] = "পণ্যটি এর চেয়ে বেশি স্টকে নেই";
        $FR_OUTPUT['FRM'] = "No More Stock Available This Product";
    }


//FRD_VC________________________________- ITEM MAXIMUN ORDER QTY:-
    if($FR_MaxOrdQty > $FRc_ItemCartQty){
        $FR_MAX_ORDER_QTY = 1;
    }else{
        $FR_OUTPUT['FRA'] = 2;
        $FR_OUTPUT['FRM'] = "Maximum  Qty Allowed $FR_MaxOrdQty";
    }
    
         

//FRD CART ITEM QTY UP INI:-
    if($FR_VC_OVER_QTY_ADD == 1 and $FR_MAX_ORDER_QTY == 1){
            //UPDATE_DATA_S
            try{
                $FR_CONN->exec("UPDATE frd_order_items SET 
                fr_qty = fr_qty+1,
                fr_t_price = fr_t_price+fr_price
                WHERE id = $FRc_CartItemIdx AND fr_invo_id = $FRs_Invo_Token");
               $FR_OUTPUT['FRA'] = 1;
               $FR_OUTPUT['FRM'] = "পণ্যের পরিমাণ একটি বাড়ানো হয়েছে";
            }catch(PDOException $e){
                $FR_OUTPUT['FRA'] = 2;
                $FR_OUTPUT['FRM'] = "OTY UPDATE FAILED";
                $FR_OUTPUT['FRM_ERROR'] = $e->getMessage();
            }
        //UPDATE_DATA_E 
    }
//END>>

echo json_encode($FR_OUTPUT);