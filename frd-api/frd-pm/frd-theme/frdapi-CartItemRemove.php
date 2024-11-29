<?php
$FR_OUTPUT = [];

//FRD VC________
if(isset($_POST['cart_item_id']) AND isset($_SESSION['FRs_Invo_Token']) ){
    $FRs_Invo_Token = $_SESSION['FRs_Invo_Token'];
    $FRc_CartItemIdx = $_POST['cart_item_id'];
    $FR_VC_POST = 1;
}else{
    $FR_OUTPUT['FRA'] = 2;
    $FR_OUTPUT['FRM'] = "INVOICE TOKEN NOT FOUND";
}



if($FR_VC_POST == 1){
    try{
        $FR_CONN->exec("DELETE FROM frd_order_items WHERE id = $FRc_CartItemIdx AND fr_invo_id = $FRs_Invo_Token AND fr_stat = 0");
        $FR_OUTPUT['FRA'] = 1;
        $FR_OUTPUT['FRM'] = "Product removed from shopping cart";
    }catch(PDOException $e){
        $FR_OUTPUT['FRA'] = 2;
        $FR_OUTPUT['FRM'] = "ITEM REMOVED FAILED";
        $FR_OUTPUT['FRM_ERROR'] = $e->getMessage();
    }
}

echo json_encode($FR_OUTPUT);