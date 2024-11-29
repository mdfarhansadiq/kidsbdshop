<?php
$FR_OUTPUT = [];

//FRD VC________
if(isset($_POST['FrPostDataArray']) AND isset($_SESSION['sUsrId']) ){
    $FRc_ReceivedDataArr = $_POST['FrPostDataArray']; 
    $FR_VC_POST = 1;
}else{
    $FR_OUTPUT['FRA'] = 2;
    $FR_OUTPUT['FRM'] = "ACCESS DENIED BY 1 - SPIDER ECOMMERCE";
}



if($FR_VC_POST == 1){

        $FRc_ARRAY_COUNT = count($_POST);
        $FRc_SL = 1;
        foreach($FRc_ReceivedDataArr as $FR_VAL){
                $FRQ = "UPDATE frd_hpserial SET 
                fr_hp_sec_serial = $FRc_SL,
                dumytxt = '$FR_NOW_TIME'
                WHERE id = '$FR_VAL'";
                $R = FR_DATA_UP("$FRQ");
                if($R['FRA']==1){
                    if($FRc_SL == $FRc_ARRAY_COUNT){
                        $FR_OUTPUT['FRA'] = 1;
                        $FR_OUTPUT['FRM'] = "Home Page Serialize Done";
                    }
                }else{
                    $FR_OUTPUT['FRA'] = 2;
                    $FR_OUTPUT['FRM'] = "Home Page Serialize Failed";
                }

            $FRc_SL = ($FRc_SL+1);
        }

}

echo json_encode($FR_OUTPUT);