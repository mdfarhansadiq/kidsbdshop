<?php
$FR_OUTPUT = [];

//FRD VC________
if(isset($_POST['item_id']) AND isset($_SESSION['FRs_Invo_Token']) ){
    $FRs_Invo_Token = $_SESSION['FRs_Invo_Token'];
    $FRc_CartItemIdx = $_POST['item_id'];
    $FR_VC_POST = 1; 
}else{
    $FR_OUTPUT['FRA'] = 2;
    $FR_OUTPUT['FRM'] = "INVOICE TOKEN NOT FOUND";
}



if($FR_VC_POST == 1){

           $FR_VC_QTY_LESS_1 = "";

            //FRD CART ITEM INFO FIEND:--------------
                $FRQ = $FR_CONN->query("SELECT fr_pro_id,fr_qty,fr_price FROM frd_order_items WHERE id = $FRc_CartItemIdx");
                $row_oiinfo = $FRQ->fetch();
                $FRc_ItemProId = $row_oiinfo['fr_pro_id'];
                $FRc_ItemCartQty = $row_oiinfo['fr_qty'];//CART ITEM PRESENT ORDER QTY
                $FRc_ItemSinPrice = $row_oiinfo['fr_price'];
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
                    fr_t_price = fr_t_price-fr_price,
                    fr_t_buyprice = fr_t_buyprice-fr_buyprice,
                    fr_t_profit = fr_t_profit-fr_profit
                    WHERE id = $FRc_CartItemIdx AND fr_invo_id = $FRs_Invo_Token");

                    $_SESSION['cart_items'] = ($_SESSION['cart_items'] - 1);
                    $_SESSION['cart_price'] = ($_SESSION['cart_price'] - $FRc_ItemSinPrice);
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


}

echo json_encode($FR_OUTPUT);