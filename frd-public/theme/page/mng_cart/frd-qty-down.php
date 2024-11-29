<?php
require_once('frd_lconfig.php');

$FR_OUTPUT = [];

if(!isset($_POST['item_id'])){ exit; }//FRD VC

$FR_VC_QTY_LESS_1 = "";
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
          

    
 //FRD_VC_____________________ CART QTY LESS THEN 1 :-
    if($FRc_ItemCartQty == 1){
        $FR_OUTPUT['FRA'] = 2;
        // $FR_OUTPUT['FRM'] = "পণ্যের পরিমাণ একটি চেয়ে কম করা যাবে না";
        $FR_OUTPUT['FRM'] = "Product quantity cannot be less than one";
    }else{
        $FR_VC_QTY_LESS_1 = 1;
    }
    
         

//FRD CART ITEM QTY UP INI:-
    if($FR_VC_QTY_LESS_1 == 1){
            //UPDATE_DATA_S
            try{
                $FR_CONN->exec("UPDATE frd_order_items SET 
                fr_qty = fr_qty-1,
                fr_t_price = fr_t_price-fr_price
                WHERE id = $FRc_CartItemIdx AND fr_invo_id = $FRs_Invo_Token");
                $FR_OUTPUT['FRA'] = 1;
                $FR_OUTPUT['FRM'] = "পণ্যের পরিমাণ একটি কমানো হয়েছে";
            }catch(PDOException $e){
                $FR_OUTPUT['FRA'] = 2;
                $FR_OUTPUT['FRM'] = "QTY DOWNE FAILED";
                $FR_OUTPUT['FRM_ERROR'] = $e->getMessage();
            }
        //UPDATE_DATA_E 
    }
//END>>

echo json_encode($FR_OUTPUT);